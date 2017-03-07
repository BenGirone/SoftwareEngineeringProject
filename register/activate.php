<?php
session_start(); //connect to the current session

//if the user is already logged in, redirect them to the home page
if (isset($_SESSION["loggedIn"]))
{
	header('Location: ../home.php');
	exit();
}


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

$code = $_GET["code"];

echo $code;

?>

<!DOCTYPE html>
<html>
<head>
	<title>upGrade</title>
</head>
<body>

</body>
</html>