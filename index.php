<?php
session_start();

$loginMessage = "<br />";

if (isset($_SESSION["loggedIn"]))
{
    header('Location: home.php');
    exit();
}

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
    </head>
    <body>
        <div class="wrapper">
            <form action="login.php" method="post">
                <table class="loginTable">
                    <tr class="loginHeader">
                        <td>
                            <span>Login</span>
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
                    
                    <tr class="loginText">
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
        </div>
    </body>
</html>
