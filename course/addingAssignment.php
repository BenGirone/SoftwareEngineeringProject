<?php
session_start(); //connect to the current session

//if the user is already logged in, redirect them to the home page
if (!(isset($_SESSION["loggedIn"])))
{
	header('Location: ../index.php');
	exit();
}

//check if the required fields have been entered. (Non HTML5 browsers only)
if(isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["weight"]))
{
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

    //retrieve login info
    $c_id = mysqli_real_escape_string($db, $_POST["id"]);
    $parent = mysqli_real_escape_string($db, $_POST["parent"]);
	$title = mysqli_real_escape_string($db, $_POST["title"]);
	$description = mysqli_real_escape_string($db, $_POST["description"]);
	$weight = mysqli_real_escape_string($db, floatval($_POST["weight"]));
	$start = mysqli_real_escape_string($db, date("Y-m-d", strtotime($_POST['start'])));
	$end = mysqli_real_escape_string($db, date("Y-m-d", strtotime($_POST['end'])));

	//see reference 1
	$sql = "SELECT a_id FROM assignment WHERE a_name = '$title' AND c_id='$c_id'";

	//check if the course is in the database
	$sql_result = $db->query($sql);
	if ($sql_result->num_rows)
	{
		//return the user to the course add page
		$_SESSION["failedAssignmentAdd"] = 1;
		header('Location: addAssignment.php');
		exit();
	}
	else
	{
		//add the course
		$sql_add_course = "";

		if ($_POST['start'] != "" && $_POST['end'] != "")
		{
			if ($_POST["parent"] != "")
			{
				$sql_add_course = "INSERT INTO assignments (p_id, a_name, a_desc, date_assigned, date_due, grade_weight, c_id) VALUES ('$parent', '$title', '$description', '$start', '$end', '$weight', '$c_id');";
			}
			else
			{
				$sql_add_course = "INSERT INTO assignments (a_name, a_desc, date_assigned, date_due, grade_weight, c_id) VALUES ('$title', '$description', '$start', '$end', '$weight', '$c_id');";
			}
		}
		else
		{
			if ($_POST['start'] != "")
			{
				if ($_POST["parent"] != "")
				{
					$sql_add_course = "INSERT INTO assignments (p_id, a_name, a_desc, date_assigned, grade_weight, c_id) VALUES ('$parent', '$title', '$description', '$start', '$weight', '$c_id');";
				}
				else
				{
					$sql_add_course = "INSERT INTO assignments (a_name, a_desc, date_assigned, grade_weight, c_id) VALUES ('$title', '$description', '$start', '$weight', '$c_id');";
				}
			}
			else
			{
				if ($_POST['end'] != "")
				{
					if ($_POST["parent"] != "")
					{
						$sql_add_course = "INSERT INTO assignments (p_id, a_name, a_desc, date_due, grade_weight, c_id) VALUES ('$parent', '$title', '$description', '$end', '$weight', '$c_id');";
					}
					else
					{
						$sql_add_course = "INSERT INTO assignments (a_name, a_desc, date_due, grade_weight, c_id) VALUES ('$title', '$description', '$end', '$weight', '$c_id');";
					}
				}
				else
				{
					if ($_POST["parent"] != "")
					{
						$sql_add_course = "INSERT INTO assignments (p_id, a_name, a_desc, grade_weight, c_id) VALUES ('$parent', '$title', '$description', '$weight', '$c_id');";
					}
					else
					{
						$sql_add_course = "INSERT INTO assignments (a_name, a_desc, grade_weight, c_id) VALUES ('$title', '$description', '$weight', '$c_id');";
					}
				}
			}
		}

		$sql_add_course_result = $db->query($sql_add_course);

		$_SESSION["failedAssignmentAdd"] = NULL;
		header("Location: view.php?id=$c_id");
		exit();
	}
}
else
{
	echo "You did not enter a required value. Please go back and try again.";
}
?>

