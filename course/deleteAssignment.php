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

$a_id = mysqli_real_escape_string($db, $_GET["a_id"]);
$c_id = $_GET["c_id"];

$sql = "DELETE FROM assignments WHERE a_id='$a_id';";
$sql_result = $db->query($sql);

header("Location: view.php?id=$c_id");
exit();
?>