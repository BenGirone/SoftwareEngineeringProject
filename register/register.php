<?php
session_start();

if (isset($_SESSION["loggedIn"]))
{
	header('Location: ../home.php');
	exit();
}

if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]))
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
	$email = mysqli_real_escape_string($db, $_POST["email"]);

	//see reference 1
	$sql = "SELECT * FROM user WHERE username = '$username'";

	//check if the user is in the database
	$sql_result = $db->query($sql);
	if ($sql_result->num_rows)
	{
		$_SESSION["RegistrationError2"] = 1;
		header('Location: index.php');
		exit();
	}
	else
	{
		//$letters = array('a', 'b', 'c', 'd', 'e' 'f');
		//$code = rand(10000, 99999) . $letters[rand(0,5)];
		$code = '1';
		echo shell_exec("cd .. && cd shell && pwd");
		echo shell_exec("cd .. && cd shell && ./registrationEmail.sh '$email' '$username' '$code'");
	}
}
else
{
	$_SESSION["RegistrationError1"] = 1;
	header('Location: index.php');
	exit();
}

?>
