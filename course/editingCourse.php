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

$u_id = mysqli_real_escape_string($db, $_SESSION["ID"]);
$c_id = mysqli_real_escape_string($db, $_POST["c_id"]);

if (isset($_POST["reset"]))
{
	$reset_sql = "DELETE FROM gradegiven WHERE a_id IN (SELECT a_id FROM assignments WHERE c_id = '$c_id');";
	$reset_sql_result = $db->query($reset_sql);
}

if (isset($_POST["title"]))
{
	if ($_POST["title"] != "")
	{
		$title = mysqli_real_escape_string($db, $_POST["title"]);
		$sql_title = "UPDATE course SET c_name = '$title' WHERE c_id = '$c_id';";
		$sql_title_result = $db->query($sql_title);
	}
}

if (isset($_POST["description"]))
{
	if ($_POST["description"] != "")
	{
		$description = mysqli_real_escape_string($db, $_POST["description"]);
		$sql_desc = "UPDATE course SET c_desc = '$description' WHERE c_id = '$c_id';";
		$sql_desc_result = $db->query($sql_desc);
	}
}

if (isset($_POST["start"]))
{
	if ($_POST["start"] != "")
	{
		$start = mysqli_real_escape_string($db, date("Y-m-d", strtotime($_POST['start'])));
		$sql_start = "UPDATE course SET date_beg = '$start' WHERE c_id = '$c_id';";
		$sql_start_result = $db->query($sql_start);
	}
}

if (isset($_POST["end"]))
{
	if ($_POST["end"] != "")
	{
		$end = mysqli_real_escape_string($db, date("Y-m-d", strtotime($_POST['end'])));
		$sql_end = "UPDATE course SET date_end = '$end' WHERE c_id = '$c_id';";
		$sql_end_result = $db->query($sql_end);
	}
}

if (isset($_POST["grade"]) && isset($_POST["rule"]))
{
	if ($_POST["grade"] != "" && $_POST["rule"] != "")
	{
		$grade = mysqli_real_escape_string($db, floatval($_POST['grade']));
		$rule = mysqli_real_escape_string($db, $_POST['rule']);
		$sql_grade = "INSERT INTO graderule (c_id, grade_letter, g_value) VALUES ('$c_id', '$rule', '$grade');";
		$sql_grade_result = $db->query($sql_grade);
	}
}

header("Location: ../home.php");
exit();