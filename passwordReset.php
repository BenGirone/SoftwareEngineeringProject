<?php
session_start();
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
    <script type="text/javascript" src="passwordCheck.js"></script>
</head>
<body>
    <script type="text/javascript" src="passwordCheck.js"></script>
    <div class="wrapper">
            <form action="reset.php" method="post">
                <table class="inputTable">
                    <tr class="inputTableHeader">
                        <td>
                            <span>Reset Password</span>
                        </td>
                    </tr>


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


                    <tr>
                        <td><input class="red" type="submit" value="Update Password" id="submit"></td>
                    </tr>
                </table>
            </form>

            <form action="index.php">
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
