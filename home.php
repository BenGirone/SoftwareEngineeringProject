<?php
session_start(); //connect to the current session

if (!(isset($_SESSION["loggedIn"])))
{
	header('Location: index.php');
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
        <link type="text/css" rel="stylesheet" href="index.css">
        <link type="text/css" rel="stylesheet" href="course.css">
        <style type="text/css">
        .wrapper {
        	width: 50%;
        	background-color: lightgrey;
        	border-left:4px solid black;
        	border-right:4px solid black;
        }
        </style>
    </head>
    <body>
        <img style="height:100px; margin: auto; display: block;" src="graphics/logo.png">
    	<div class="header">
    		<table>
    			<tr>
    				<td>
    					<a href=""><div>My Courses</div></a>
    				</td>

    				<td>
    					<a href="course/add.php"><div>New Course</div></a>
    				</td>

    				<td>
    					<a href="https://docs.google.com/presentation/d/1HLN6jSotTdy5wylEdhUbeF6X0gQM22RvyRIiBTwPChs/edit?usp=sharing"><div>About</div></a>
    				</td>

    				<td>
    					<a href="https://github.com/BenGirone/SoftwareEngineeringProject/wiki"><div>GitHub Page</div></a>
    				</td>

    				<td>
    					<a href="signout.php"><div>Sign Out</div></a>
    				</td>
    			</tr>
    		</table>
    	</div>


        <div class="wrapper">
        	<table class="courseTable">
	            <?php
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

	            	$u_id = mysqli_real_escape_string($db, $_SESSION["ID"]);
					$sql = "SELECT DISTINCT sub.* 
							FROM (SELECT course.c_id, course.t_id, user_course_int.u_id, course.c_name, course.c_desc, course.date_beg, course.date_end
								  FROM course
								  INNER JOIN user_course_int ON course.c_id=user_course_int.c_id) sub
							WHERE (sub.t_id = '$u_id' AND sub.u_id = '$u_id') OR sub.u_id = '$u_id';";
					$sql_result = $db->query($sql);

					while ($row = $sql_result->fetch_row())
                    {
                    	$c_id = $row[0];
                        $title = $row[3];
                        $description = $row[4];
                        $start = $row[5];
                        $end = $row[6];
                        
                        //output an option to the dropdown
                        echo ("<tr><td><div><a style='float: left;' href='course/view.php?id=$c_id'><span>" . $title . "</span></a><div style='text-align: right;'>
                        <a class='assignmentOption' href='course/editCourse.php?id=$c_id'>edit</a>
                    </div><p>" . nl2br($description) . "</p><p>Start Date: $start <br />End Date: $end </p></div></td></tr>");
                        
                    }
	            ?>

	            <tr>
	            	<td style="text-align: center;">
		            	<div>
			            	<a href="course/add.php">
				            	<span>
				            		Add A New Course
				            	</span>
			            	</a>
		            	</div>
	            	</td>
	            </tr>
            </table>
        </div>


        <div class="footer">
        	Additional Resources
        	<table>
        		<tr>
        			<td>
        				<a href="resources/contact.php">Contact</a>
        			</td>

        			<td>
        				<a href="https://github.com/BenGirone/SoftwareEngineeringProject/wiki">Wiki</a>
        			</td>

        			<td>
        				<a href="resources/spongebob-law.jpg">Legal</a>
        			</td>
        		</tr>

        		<tr>
        			<td>
        				<a href="https://github.com/BenGirone/SoftwareEngineeringProject">Contribute</a>
        			</td>

        			<td>
        				<a href="resources/facebooksucks.jpg">Facebook</a>
        			</td>

        			<td>
        				<a href="resources/meme.jpg">dank meme</a>
        			</td>
        		</tr>
        	</table>
        </div>
    </body>
</html>
