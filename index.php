<?php
session_start(); //connect to the current session

$loginMessage = "<br />"; //have the inital login error message be blank

//if the user is already logged in, redirect them to the home page
if (isset($_SESSION["loggedIn"]))
{
    header('Location: home.php');
    exit();
}

//if the user was redirected back to this page after a failed login, change the login error message
if (isset($_SESSION["failedLogin"]))
{
    $loginMessage = "* Invalid Login";
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
        <link type="text/css" rel="stylesheet" href="index.css">
        <style type="text/css">
                input[type=submit].red {
                    background-color: #E37366;
                }
                    input[type=submit].red:hover {
                        background-color: #F5AFA6;
                    }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <form action="login.php" method="post">
                <table class="inputTable">
                    <tr class="inputTableHeader">
                        <td>
                        	<img style="height:100px; margin: auto; display: block;" src="graphics/logo.png">
                        	<br />
                            <span>Login</span>
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
                    
                    <tr>
                        <td>
                            <span>Password:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><input type="password" name="password" required="true"></td>
                    </tr>
                    
                    <tr>
                        <td><input type="submit" value="Login"></td>
                    </tr>
                </table>
            </form>

            <span style="text-align: center;"><a href="enterEmail.php">Forgot My Password</a></span>  

            <form action="register/">
                <table class="inputTable">
                    <tr>
                        <td>
                            <input class="red" type="submit" value="Register">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
