<?php
session_start();

if (!(isset($_SESSION["loggedIn"])))
{
    header('Location: ../index.php');
    exit();
}

//connect to MySQL database
$db_user = 'upGrade';
$db_password = 'OrchidDev1!';
$db_name='upgrade';
$db = new mysqli('127.0.0.1', $db_user, $db_password, $db_name);

//test if the connection was successful
if ($db->connect_errno)
{
    header('Location: ../error.php');
    exit();
}

$c_id = mysqli_real_escape_string($db, $_GET["c_id"]);

$sql = "DELETE FROM course WHERE c_id='$c_id';";
$sql_result = $db->query($sql);

header("Location: ../home.php");
exit();
?>