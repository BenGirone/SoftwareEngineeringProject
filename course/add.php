<?php
session_start();

if (!(isset($_SESSION["loggedIn"])))
{
	header('Location: ../index.php');
	exit();
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
</head>
<body>
	<div class="wrapper">
            <form id="form1" action="register.php" method="post">
                <table class="inputTable">
                    <tr class="inputTableHeader">
                        <td>
                            <span>Create A New Course</span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <span class="errorText"><?php echo ""; ?></span>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <span>Course Title:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td> <input type="text" name="title" required="true"> </td>
                    </tr>
                    

                    <tr><td><br /></td></tr>


                    <tr>
                        <td>
                            <span>Course Description:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="text-align: center;"><textarea form="form1" placeholder="enter description here..." rows="10" cols="50"></textarea></td>
                    </tr>
                    

                    <tr>
                        <td>
                            <span>Start Date (optional):</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="text-align: center;"><input type="date" name="start" required="true"</td>
                    </tr>

                    <tr>
                        <td>
                            <span>End Date (optional):</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="text-align: center;"><input type="date" name="end" required="true"</td>
                    </tr>


                    <tr>
                        <td><input class="red" type="submit" value="Create Course" id="submit"></td>
                    </tr>

                </table>
            </form>

            <form action="../home.php">
                <table class="inputTable">
                    <tr>
                        <td>
                            <input type="submit" value="Return to Home">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</body>
</html>
