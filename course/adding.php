<?php
session_start(); //connect to the current session

//if the user is already logged in, redirect them to the home page
if (!(isset($_SESSION["loggedIn"])))
{
	header('Location: ../index.php');
	exit();
}

//check if the required fields have been entered. (Non HTML5 browsers only)
if(isset($_POST["title"]) && isset($_POST["description"]))
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
    $u_id = mysqli_real_escape_string($db, $_SESSION["ID"]);
	$title = mysqli_real_escape_string($db, $_POST["title"]);
	$description = mysqli_real_escape_string($db, $_POST["description"]);
	$start = mysqli_real_escape_string($db, $_POST["start"]);
	$end = mysqli_real_escape_string($db, $_POST["end"]);

	//see reference 1
	$sql = "SELECT c_id FROM course WHERE c_name = '$title' AND t_id = '$u_id';";

	//check if the course is in the database
	$sql_result = $db->query($sql);
	if ($sql_result->num_rows)
	{
		//return the user to the course add page
		$_SESSION["failedCourseAdd"] = 1;
		header('Location: add.php');
		exit();
	}
	else
	{
		//add the course
		$sql_add_course = "";

		if (is_null($_POST["start"]) && is_null($_POST["end"]))
		{
			$sql_add_course = "INSERT INTO course (t_id, c_name, c_desc, date_beg, date_end) VALUES ('$u_id', '$title', '$description', '$start', '$end');'";
			echo "option1";
			echo " ". $start;
		}
		else
		{
			if (is_null($_POST["start"]))
			{
				$sql_add_course = "INSERT INTO course (t_id, c_name, c_desc, date_beg) VALUES ('$u_id', '$title', '$description', '$start');'";
				echo "option2";
			}
			else
			{
				if (is_null($_POST["end"]))
				{
					$sql_add_course = "INSERT INTO course (t_id, c_name, c_desc, date_end) VALUES ('$u_id', '$title', '$description', '$end');'";
					echo "option3";
				}
				else
				{
					$sql_add_course = "INSERT INTO course (t_id, c_name, c_desc) VALUES ('$u_id', '$title', '$description');'";
					echo "option4";
				}
			}
		}

		$sql_add_course_result = $db->query($sql_add_course);
		echo ($db->error);

		$_SESSION["failedCourseAdd"] = NULL;
		//header('Location: ../home.php');
		//exit();
	}
}
else
{
	echo "You did not enter a required value. Please go back and try again.";
}
?>