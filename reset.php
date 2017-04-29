<?php
session_start();

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

$password = mysqli_real_escape_string($db, $_POST["password"]);

if ((strpos($password, ' ') === false) && (strpos($password, ';') === false) && (strlen($password) > 6))
{
	$password = password_hash($password, PASSWORD_DEFAULT);
	$u_id = mysqli_real_escape_string($db, $_POST["id"]);

	$sql = "UPDATE user SET password='$password' WHERE u_id = '$u_id';";
	$sql_result = $db->query($sql);

	header("Location: index.php");
	exit();
}
else
{
	echo "<!DOCTYPE html>
<!--
Developed by Ben Girone
For use in CSC 351
Software prepared by Orchid-dev (see documentation for more info)
-->
<html>
    <head>
        <title>upGrade</title>
        <meta charset='windows-1252'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link type='text/css' rel='stylesheet' href='index.css'>
        <style type='text/css'>
        </style>
    </head>
    <body>
        <img style='height:100px; margin: auto; display: block;' src='graphics/logo.png'>
    	<div class='wrapper'>
    		Password contained illegal characters or was shorter than 7 characters. Please go back and try again.
    	</div>
    </body>
</html>";
}
