<?php
session_start();

if (!(isset($_SESSION["loggedIn"])))
{
	header('Location: ../index.php');
	exit();
}

$errorMessage = "";
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
                input[type=submit].yellow {
                    background-color: #E3DB66;
                }
                    input[type=submit].yellow:hover {
                        background-color: #E6E2AC;
                    }
                input[type=checkbox]
		        {
		          /* Double-sized Checkboxes */
		          -ms-transform: scale(2); /* IE */
		          -moz-transform: scale(2); /* FF */
		          -webkit-transform: scale(2); /* Safari and Chrome */
		          -o-transform: scale(2); /* Opera */
		          padding: 10px;
		        }
    </style>
</head>
<body>
    <img style="height:100px; margin: auto; display: block;" src="../graphics/logo.png">
	<div class="wrapper">
			<form action="deleteCourse.php">
                <table class="inputTable">
                    <tr>
                        <td>
                            <input class="yellow" type="submit" value="Delete Course">
                            <input type="hidden" name="c_id" <?php $i = $_GET["id"]; echo ("value='$i'"); ?>>
                        </td>
                    </tr>
                </table>
            </form>
            <form id="form1" action="editingCourse.php" method="post">
                <table class="inputTable">
                    <tr class="inputTableHeader">
                        <td>
                            <span>Edit A Course</span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <span class="errorText"><?php echo ($errorMessage); ?></span>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <span>Reset All Grades:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td> <input style="width: 100%;" type="checkbox" name="reset"> <?php $c_id = $_GET["id"]; echo("<input type='hidden' name='c_id' value='$c_id'>"); ?></td>
                    </tr>


                    <tr>
                        <td>
                            <span>Course Title:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td> <input type="text" name="title"> </td>
                    </tr>
                    

                    <tr><td><br /></td></tr>


                    <tr>
                        <td>
                            <span>Course Description:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="text-align: center;"><textarea style="width:100%;
height:100%; 
box-sizing: border-box;         /* For IE and modern versions of Chrome */
-moz-box-sizing: border-box;    /* For Firefox                          */
-webkit-box-sizing: border-box; /* For Safari                           */" name="description" form="form1" placeholder="enter description here..." rows="15" cols=""></textarea></td>
                    </tr>
                    

                    <tr><td><br /></td></tr>
                    

                    <tr>
                        <td>
                            <span>Start Date (optional):</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="text-align: center;"><input style="height: 40px; width: 100%;" type="date" name="start"></td>
                    </tr>

                    <tr>
                        <td>
                            <span>End Date (optional):</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="text-align: center;"><input style="height: 40px; width: 100%;" type="date" name="end"></td>
                    </tr>

                 
                    <tr>
                        <td><input class="red" type="submit" value="Update Course" id="submit"></td>
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
