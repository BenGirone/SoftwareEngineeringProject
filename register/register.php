<?php
session_start(); //connect to the current session

//if the user is already logged in, redirect them to the home page
if (isset($_SESSION["loggedIn"]))
{
	header('Location: ../home.php');
	exit();
}

//check if the required fields have been entered. (Non HTML5 browsers only)
if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]))
{

	//ToDo: create user name validation function
	//ToDo: make password validation function

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
	$sql = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";

	//check if the user is in the database
	$sql_result = $db->query($sql);
	if ($sql_result->num_rows)
	{
		$_SESSION["RegistrationError1"] = 1;
		header('Location: index.php');
		exit();
	}
	else
	{
		$code = "$username" . rand(10000, 99999);
		$url = str_replace("register.php", "activate.php", "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?code=");

		echo shell_exec("cd .. && cd shell && ./registrationEmail.sh '$email' '$username' '$code' '$url'");

		//ToDo: include sql for registration
	}
}
else
{
	echo "ERROR: You did not enter values for all the required fields";
}


/*references
	1. ToDo: link to appropriate github page
*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registering...</title>
</head>
<body>

</body>
</html>