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
$a_id = mysqli_real_escape_string($db, $_POST["a_id"]);
$c_id = $_POST["c_id"];

if (isset($_POST["reset"]))
{
	$reset_sql = "DELETE FROM gradegiven WHERE a_id = '$a_id' AND u_id = '$u_id';";
	$reset_sql_result = $db->query($reset_sql);
}

if (isset($_POST["title"]))
{
	if ($_POST["title"] != "")
	{
		$title = mysqli_real_escape_string($db, $_POST["title"]);
		$sql_title = "UPDATE assignments SET a_name = '$title' WHERE a_id = '$a_id';";
		$sql_title_result = $db->query($sql_title);
	}
}

if (isset($_POST["description"]))
{
	if ($_POST["description"] != "")
	{
		$description = mysqli_real_escape_string($db, $_POST["description"]);
		$sql_desc = "UPDATE assignments SET a_desc = '$description' WHERE a_id = '$a_id';";
		$sql_desc_result = $db->query($sql_desc);
	}
}

if (isset($_POST["weight"]))
{
	if ($_POST["weight"] != "")
	{
		$weight = mysqli_real_escape_string($db, $_POST["weight"]);
		$sql_weight = "UPDATE assignments SET grade_weight = '$weight' WHERE a_id = '$a_id';";
		$sql_weight_result = $db->query($sql_weight);
	}
}

if (isset($_POST["parent"]))
{
	if ($_POST["parent"] != "")
	{
		$parent = mysqli_real_escape_string($db, $_POST["parent"]);
		$sql_parent = "UPDATE assignments SET p_id = '$parent' WHERE a_id = '$a_id';";
		$sql_parent_result = $db->query($sql_parent);
	}
}

if (isset($_POST["start"]))
{
	if ($_POST["start"] != "")
	{
		$start = mysqli_real_escape_string($db, date("Y-m-d", strtotime($_POST['start'])));
		$sql_start = "UPDATE assignments SET date_assigned = '$start' WHERE a_id = '$a_id';";
		$sql_start_result = $db->query($sql_start);
	}
}

if (isset($_POST["end"]))
{
	if ($_POST["end"] != "")
	{
		$end = mysqli_real_escape_string($db, date("Y-m-d", strtotime($_POST['end'])));
		$sql_end = "UPDATE assignments SET date_due = '$end' WHERE a_id = '$a_id';";
		$sql_end_result = $db->query($sql_end);
	}
}

header("Location: view.php?id=$c_id");
exit();