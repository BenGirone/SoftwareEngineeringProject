<?php
session_start();

$loginMessage = "<br />";

if (isset($_SESSION["loggedIn"]))
{
	header('Location: ../home.php');
	exit();
}

if (isset($_SESSION["RegistrationError"]))
{
    if ($_SESSION["RegistrationError"] ==  1)
    {
        $loginMessage = "That Username or E-mail is already taken";
    }
    else
    {
        if ($_SESSION["RegistrationError"] == 2)
        {
            $loginMessage = "That Username is already in our system";
        }
    }
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
    <style type="text/css">
                input[type=submit].red {
                    background-color: #E37366;
                }
                    input[type=submit].red:hover {
                        background-color: #F5AFA6;
                    }
        </style>
    <script type="text/javascript" src="passwordCheck.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <img style="height:100px; margin: auto; display: block;" src="../graphics/logo.png">
    <script type="text/javascript" src="passwordCheck.js"></script>
	<div class="wrapper">
            <form action="register.php" method="post">
                <table class="inputTable">
                    <tr class="inputTableHeader">
                        <td>
                            <span>Register</span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <span class="errorText"><?php echo ($loginMessage); ?></span>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <span>User Name:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td> <input type="text" name="username" required="true"> </td>
                    </tr>
                    

                    <tr><td><span class="errorText" id="passwordError"><br /></span></td></tr>


                    <tr>
                        <td>
                            <span>Password:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><input id="password" type="password" name="password" required="true" onkeyup="checkMatch('password', 'password2', 'passwordError', 'submit', 'Passwords Do Not Match')"></td>
                    </tr>
                    

                    <tr>
                        <td>
                            <span>Confirm Password:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><input id="password2" type="password" name="password2" required="true" onkeyup="checkMatch('password', 'password2', 'passwordError', 'submit', 'Passwords Do Not Match')"></td>
                    </tr>


                    <tr><td></td></tr>


                    <tr><td><span class="errorText" id="emailError"><br /></span></td></tr>


                    <tr>
                        <td>
                            <span>E-mail:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><input id="email" type="text" name="email" required="true" onkeyup="checkMatch('email', 'email2', 'emailError', 'submit', 'E-mail Accounts Do Not Match')"></td>
                    </tr>


                    <tr>
                        <td>
                            <span>Confirm E-mail:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><input id="email2" type="text" name="email2" required="true" onkeyup="checkMatch('email', 'email2', 'emailError', 'submit', 'E-mail Accounts Do Not Match')"></td>
                    </tr>


                    <tr>
                        <td><input class="red" type="submit" value="Register" id="submit"></td>
                    </tr>

                    <tr>
                        <td><div class="g-recaptcha" data-sitekey="6LcsNxgUAAAAAFrtrQb_LZL7B38j90-IN4rd7FbA"></div></td>
                    </tr>
                </table>
            </form>

            <form action="../">
                <table class="inputTable">
                    <tr>
                        <td>
                            <input type="submit" value="Return to Login">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</body>
</html>
