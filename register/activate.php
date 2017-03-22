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
$sql = "UPDATE user SET isRegistered = 1 WHERE registrationCode = '$code'";
$sql2 = "SELECT registrationCode FROM user WHERE registrationCode = '$code'";

$page = "";
$bigButton = "";

//check if the registration code is assigned to an unregistered user in the database
$sql_result = $db->query($sql);
$sql_result2 = $db->query($sql2);
if ($sql_result2->num_rows)
{
	$page = "Welcome! You are now an officially registered upGrade user. You may now login and access all the site's features.";
	$bigButton = "<a href='../index.php'><div><span>Return To Login</span></div></a>";
}
else
{
	$page = "Ooops! It looks like the activation link you entered did not work. You may have clicked an expired link (we reset them once a day). Please try registering again.";
	$bigButton = "<a href='index.php'><div><span>Return To Registration</span></div></a>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>upGrade</title>
	<meta charset="windows-1252">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../index.css">
</head>
<body>
	<div class = "wrapper">
		<table>
			<tr class="centeredRow">
				<td>
					<span>
						<?php echo $page; ?>
					</span>
				</td>
			</tr>
		</table>

		<table>
			<tr class='centeredLinkButtonRow'>
				<td>
					<span>
						<?php echo $bigButton; ?>
					</span>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>