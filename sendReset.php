
<!DOCTYPE html>
<html>
<head>
	<title>upGrade</title>
	<meta charset="windows-1252">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="index.css">
</head>
<body>
	<div class = "wrapper">
		<?php
		if($_SERVER["REQUEST_METHOD"] === "POST")
		{
		    //form submitted

		    //check if other form details are correct

		    //verify captcha
		    $recaptcha_secret = "6LcsNxgUAAAAANYI0PdsXd5FdqEHpC1F39rXX2eV";
		    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
		    $response = json_decode($response, true);
		    if($response["success"] === true)
		    {
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

				$email = mysqli_real_escape_string($db, $_POST["email"]);

				$sql = "SELECT username, registrationCode FROM user WHERE email='$email';";
				$sql_result = $db->query($sql);

				if ($sql_result->num_rows)
				{
					$row = $sql_result->fetch_row();
					$username = $row[0];
					$code = $row[1];
					$url = str_replace("sendReset.php", "passwordReset.php", "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?code=");
					echo shell_exec("cd shell && ./passwordEmail.sh '$email' '$username' '$code' '$url'");
				}
				else
				{
					echo "The email address you entered is not in our system.";
				}
			}
			else
			{
				echo "You are a robot.";
			}
		}
		else
		{
			echo "There was an error with this page";
		}
		?>
	</div>
</body>
</html>