<!DOCTYPE html>
<!--
Developed by Ben Girone
For use in CSC 351
Software prepared by Orchid-dev (see documentation for more info)
-->
<html>
<head>
    <title>upGrade</title>
    <meta charset='windows-1252'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link type='text/css' rel='stylesheet' href='index.css'>
    <style type='text/css'>
                input[type=submit].red {
                    background-color: #E37366;
                }
                    input[type=submit].red:hover {
                        background-color: #F5AFA6;
                    }
        </style>
    <script type='text/javascript' src='passwordCheck.js'></script>
</head>
<body>
	<img style="height:100px; margin: auto; display: block;" src="graphics/logo.png">
    <script type='text/javascript' src='register/passwordCheck.js'></script>
    <div class='wrapper'>
		<?php
		session_start();

		//connect to MySQL database
		$db_user = 'upGrade';
		$db_password = 'OrchidDev1!';
		$db_name='upgrade';
		$db = new mysqli('127.0.0.1', $db_user, $db_password, $db_name);

		//test if the connection was successful
		if ($db->connect_errno)
		{
		    header('Location: error.php');
		    exit();
		}

		$code = mysqli_real_escape_string($db, $_GET["code"]);

		$sql = "SELECT u_id FROM user WHERE registrationCode='$code';";
		$sql_result = $db->query($sql);

		if ($sql_result->num_rows)
		{
			$row = $sql_result->fetch_row();
			$u_id = $row[0];
			$js = "checkMatch('password','password2','passwordError','submit','Passwords Do Not Match')";
			echo ("
					<form action='reset.php' method='post'>
		                <table class='inputTable'>
		                    <tr class='inputTableHeader'>
		                        <td>
		                            <span>Reset Password</span>
		                        </td>
		                    </tr>

		                    <tr><td><span class='errorText' id='passwordError'><br /></span></td></tr>

		                    <tr>
		                        <td>
		                            <span>Password:</span>
		                        </td>
		                    </tr>
		                    
		                    <tr>
		                        <td><input id='password' type='password' name='password' required='true' onkeyup=\"$js\"></td>
		                    </tr>
		                    

		                    <tr>
		                        <td>
		                            <span>Confirm Password:</span>
		                        </td>
		                    </tr>
		                    
		                    <tr>
		                        <td><input id='password2' type='password' name='password2' required='true' onkeyup=\"$js\"></td>
		                    </tr>

		                    <tr>
		                        <td><input type='hidden' name='id' value='$u_id'></td>
		                    </tr>


		                    <tr>
		                        <td><input class='red' type='submit' value='Update Password' id='submit'></td>
		                    </tr>
		                </table>
		            </form>

		            <form action='index.php'>
		                <table class='inputTable'>
		                    <tr>
		                        <td>
		                            <input type='submit' value='Return to Login'>
		                        </td>
		                    </tr>
		                </table>
		            </form>
				");
		}
		else
		{
			echo "Sorry, this code is not a valid reset code.";
		}
		?>
    </div>
</body>
</html>