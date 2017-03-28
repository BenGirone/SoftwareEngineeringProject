<?php
session_start(); //connect to the current session
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
    	<div class="header">
    		<table>
    			<tr>
    				<td>
    					<a href=""><div>My Courses</div></a>
    				</td>

    				<td>
    					<a href="Notifications/"><div>Notifications</div></a>
    				</td>

    				<td>
    					<a href="course/add.php"><div>New Course</div></a>
    				</td>

    				<td>
    					<a href="about.php"><div>About</div></a>
    				</td>

    				<td>
    					<a href="https://github.com/BenGirone/SoftwareEngineeringProject/wiki"><div>GitHub Page</div></a>
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
					    //display an error
					    echo ("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
					}

	            	$u_id = mysqli_real_escape_string($db, $_SESSION["ID"]);
					$sql = "SELECT sub.* 
							FROM (SELECT course.c_id, course.t_id, user_course_int.u_id, course.c_name, course.c_desc
								  FROM course
								  INNER JOIN user_course_int ON course.c_id=user_course_int.c_id) sub
							WHERE sub.t_id = 4 OR sub.u_id = 4;";
					$sql_result = $db->query($sql);

					while ($row = $sql_result->fetch_row())
                    {
                    	$c_id = $row[0];
                        $title = $row[3];
                        $description = $row[4];
                        
                        //output an option to the dropdown
                        echo ("<tr><td><div><a href='course/view.php?id=$c_id'><span>" . $title . "</span></a><p>" . $description . "</p>" . "</div></td></tr>");
                        
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
        	I am the footer
        </div>
    </body>
</html>