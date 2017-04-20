<?php
session_start(); //connect to the current session

//if the user is already logged in, redirect them to the home page
if (isset($_SESSION["loggedIn"]))
{
	header('Location: home.php');
	exit();
}

//check if the required fields have been entered. (Non HTML5 browsers only)
if(isset($_POST["username"]) && isset($_POST["password"]))
{
	//connect to MySQL database
	$db_user = 'upGrade';
	$db_password = 'OrchidDev1!';
	$db_name='upgrade';
	$db = new mysqli('127.0.0.1', $db_user, $db_password, $db_name);

	//test if the connection was successful
    if ($db->connect_errno)
    {
        header('Location: error.php');
		exit();
    }

    //retrieve login info
	$username = mysqli_real_escape_string($db, $_POST["username"]);
	$password = mysqli_real_escape_string($db, $_POST["password"]);
	$password = password_hash($password, PASSWORD_DEFAULT);

	//see reference 1
	$sql = "SELECT u_id FROM user WHERE username = '$username' AND password = '$password' AND isRegistered = 1";

	//check if the user is in the database
	$sql_result = $db->query($sql);
	if ($sql_result->num_rows)
	{
		//log in the user
		$row = $sql_result->fetch_row();
		$u_id = $row[0];
		$_SESSION["ID"] = $u_id;
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
		$_SESSION["loggedIn"] = 1;
		$_SESSION["failedLogin"] = NULL;
		header('Location: home.php');
		exit();
	}
	else
	{
		//return the user to the login page
		$_SESSION["failedLogin"] = 1;
		header('Location: index.php');
		exit();
	}
}
else
{
	$_SESSION["failedLogin"] = 1;
	header('Location: index.php');
	exit();
}

?>