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

//get the code from the activation link
$code = mysqli_real_escape_string($db, $_GET["code"]);

//see reference 1
$sql = "UPDATE user SET registered = 1 WHERE registrationCode = '$code'";

$page = "";

//check if the registration code is assigned to an unregistered user in the database
$sql_result = $db->query($sql);
if ($sql_result->affected_rows)
{
	
}
else
{

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>upGrade</title>
</head>
<body>
	<div class = "wrapper">
		<span class="centeredText">
			<?php echo "$page";?>
		</span>
	</div>
</body>
</html>