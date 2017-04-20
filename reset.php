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
$password = password_hash($password, PASSWORD_DEFAULT);
$u_id = mysqli_real_escape_string($db, $_POST["id"]);

$sql = "UPDATE user SET password='$password' WHERE u_id = '$u_id';";
$sql_result = $db->query($sql);

header("Location: index.php");
exit();
