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
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <img style="height:100px; margin: auto; display: block;" src="graphics/logo.png">
    <div class="wrapper">
            <form action="sendReset.php" method="post">
                <table class="inputTable">
                    <tr class="inputTableHeader">
                        <td>
                            <span>Enter Email</span>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <span>Email:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><input type="text" name="email" required="true" ></td>
                    </tr>

                    <tr>
                        <td><div class="g-recaptcha" data-sitekey="6LcsNxgUAAAAAFrtrQb_LZL7B38j90-IN4rd7FbA"></div></td>
                    </tr>

                    <tr>
                        <td><input class="red" type="submit" value="Send Email" id="submit"></td>
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
