<?php
session_start();

if (isset($_SESSION["loggedIn"]))
{
	header('Location: index.php');
	exit();
}

if(isset($_POST["username"]) && isset($_POST["password"]))
{
	//connect to MySQL database
	$db_user = 'upGrade';
	$db_password = 'OrchidDev1!';
	$db_name='upGrade';
	$db = new mysqli('127.0.0.1', $db_user, $db_password, $db_name);

	//test if the connection was successful
    if ($db->connect_errno)
    {
        //display an error
        echo ("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
    }

    //retrieve login info
	$username = mysqli_real_escape_string($db, $_POST["username"]);
	$password = mysqli_real_escape_string($db, $_POST["password"]);

	//see reference 1
	$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";

	//check if the user is in the database
	$sql_result = $db->query($sql);
	if ($sql_result->num_rows)
	{
		//log in the user
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
		$_SESSION["loggedIn"] = 1;
		$_SESSION["failedLogin"] = 0;
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