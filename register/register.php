<?php
session_start(); //connect to the current session

//if the user is already logged in, redirect them to the home page
if (isset($_SESSION["loggedIn"]))
{
	header('Location: ../home.php');
	exit();
}
//captcha test
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
        //check if the required fields have been entered. (Non HTML5 browsers only)
		if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]))
		{

			//ToDo: create user name validation function
			//ToDo: make password validation function

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
			$username = mysqli_real_escape_string($db, $_POST["username"]);
			$email = mysqli_real_escape_string($db, $_POST["email"]);
			$password = mysqli_real_escape_string($db, $_POST["password"]);

			//see reference 1
			$sql_check_0 = "SELECT * FROM user WHERE (username = '$username' OR email = '$email') AND isRegistered = 1";

			//check if the user is in the database
			$sql_result_0 = $db->query($sql_check_0);

			//if username or email is already registered
			if ($sql_result_0->num_rows)
			{
				$_SESSION["RegistrationError"] = 1;
				header('Location: index.php');
				exit();
			}
			else
			{
				//see reference 2
				$sql_check_1 = "SELECT registrationCode FROM user WHERE username = '$username' AND email = '$email'";
				$sql_result_1 = $db->query($sql_check_1);

				//if username and email are already in registration process, resend the email
				if ($sql_result_1->num_rows)
				{
					$row = $sql_result_3->fetch_row();
					$code = $row[0];
					$url = str_replace("register.php", "activate.php", "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?code=");
					
					echo shell_exec("cd .. && cd shell && ./registrationEmail.sh '$email' '$username' '$code' '$url'");
				}
				else
				{
					//see reference 3
					$sql_check_2 = "SELECT * FROM user WHERE username = '$username'";
					$sql_result_2 = $db->query($sql_check_2);

					//if the username is already taken return to registration with an error
					if ($sql_result_2->num_rows)
					{
						$_SESSION["RegistrationError"] = 2;
						header('Location: index.php');
						exit();
					}
					else
					{
						//see reference 4
						$sql_check_3 = "SELECT registrationCode FROM user WHERE email = '$email'";
						$sql_result_3 = $db->query($sql_check_3);

						//if the email is already in the registration process, update the username and resend the email
						if ($sql_result_3->num_rows)
						{
							//see reference 5
							$sql_update_user = "UPDATE user SET username = '$username' WHERE email = '$email'";
							$sql_result_4 = $db->query($sql_update_user);

							$row = $sql_result_3->fetch_row();
							$code = $row[0];
							$url = str_replace("register.php", "activate.php", "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?code=");

							echo shell_exec("cd .. && cd shell && ./registrationEmail.sh '$email' '$username' '$code' '$url'");
						}
						else //create a new user from scatch
						{
							$code = "$username" . rand(10000, 99999);
							$url = str_replace("register.php", "activate.php", "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?code=");

							//see reference 6
							$sql_add_user = "INSERT INTO user (username, email, password, registrationCode) VALUES ('$username','$email','$password','$code')";
							$sql_add_user_result = $db->query($sql_add_user);

							echo shell_exec("cd .. && cd shell && ./registrationEmail.sh '$email' '$username' '$code' '$url'");
						}
					}
				}
			}
		}
		else
		{
			echo "ERROR: You did not enter values for all the required fields";
		}
    }
    else
    {
        echo "You failed the captcha. Please go back and try again.";
    }
}

/*references
	1. ToDo: link to appropriate github page
	2. ToDo: link to appropriate github page
	3. ToDo: link to appropriate github page
	4. ToDo: link to appropriate github page
	5. ToDo: link to appropriate github page
	6. ToDo: link to appropriate github page
*/
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
		
	</div>
</body>
</html>