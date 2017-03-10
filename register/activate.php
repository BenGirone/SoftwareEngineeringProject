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
$bigButton = "";

//check if the registration code is assigned to an unregistered user in the database
$sql_result = $db->query($sql);
if ($sql_result->affected_rows)
{
	$page = "Welcome! You are now officially a registered upGrade user. You may now login and experience all the features.";
	$bigButton = "<div class='bigButton'><span>Return To Login</span></div>";
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