<?php
session_start();

$loginMessage = "<br />";

if (isset($_SESSION["loggedIn"]))
{
	header('Location: ../home.php');
	exit();
}

if (isset($_SESSION["failedRegistration"]))
{
    $loginMessage = "* Invalid Registration";
}
?>

<!DOCTYPE html>
<!--
Developed by Ben Girone
For use in CSC 351
Software prepared by Orchid-dev (see documentation for more info)
-->
<html>
<head>
	<title>upGrade</title>
    <meta charset="windows-1252">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../index.css">
    <script type="text/javascript" src="passwordCheck.js"></script>
</head>
<body>
    <script type="text/javascript" src="passwordCheck.js"></script>
	<div class="wrapper">
            <form action="register.php" method="post">
                <table class="loginTable">
                    <tr class="loginHeader">
                        <td>
                            <span>Register</span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <span class="invalidLogin"><?php echo ($loginMessage); ?></span>
                        </td>
                    </tr>


                    <tr class="loginText">
                        <td>
                            <span>User Name:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td> <input type="text" name="username" required="true"> </td>
                    </tr>
                    

                    <tr><td><span class="errorText" id="passwordError"><br /></span></td></tr>


                    <tr class="loginText">
                        <td>
                            <span>Password:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><input id="password" type="password" name="password" required="true" onkeyup="checkPasswordMatch()"></td>
                    </tr>
                    

                    <tr class="loginText">
                        <td>
                            <span>Confirm Password:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><input id="password2" type="password" name="password2" required="true" onkeyup="checkPasswordMatch()"></td>
                    </tr>


                    <tr><td><br /></td></tr>


                    <tr class="loginText">
                        <td>
                            <span>E-mail:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><input type="text" name="email" required="true"></td>
                    </tr>


                    <tr>
                        <td><input class="register" type="submit" value="Register"></td>
                    </tr>
                </table>
            </form>
        </div>
</body>
</html>