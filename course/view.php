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
        <link type="text/css" rel="stylesheet" href="../index.css">
        <link type="text/css" rel="stylesheet" href="../course.css">
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
    					<a href="../home.php"><div>My Courses</div></a>
    				</td>

    				<td>
    					<a href="../notifications/"><div>Notifications</div></a>
    				</td>

    				<td>
    					<a href="../course/add.php"><div>New Course</div></a>
    				</td>

    				<td>
    					<a href="../about.php"><div>About</div></a>
    				</td>

    				<td>
    					<a href="https://github.com/BenGirone/SoftwareEngineeringProject/wiki"><div>GitHub Page</div></a>
    				</td>

    				<td>
    					<a href="../signout.php"><div>Sign Out</div></a>
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
				    	header('Location: ../error.php');
						exit();
				    }

	            	$u_id = mysqli_real_escape_string($db, $_SESSION["ID"]);
	            	$c_id = mysqli_real_escape_string($db, $_GET["id"]);
					$sql = "SELECT	
							    assignments.a_id,
							    assignments.p_id,
							    assignments.grade_weight,
							    assignments.a_name,
							    gradegiven.grade_given,
							    gradegiven.u_id
							FROM gradegiven RIGHT JOIN assignments ON (gradegiven.a_id = assignments.a_id AND gradegiven.u_id='$u_id')
							WHERE assignments.c_id='$c_id';";
					$sql_result = $db->query($sql);

					while ($row = $sql_result->fetch_row())
                    {
                    	$a_id = $row[0];
                        $title = $row[3];
                        $grade = $row[4];
                        $points = $row[2];
                        $pointsEarned = ($grade/100) * $points;

                        if (!is_null($grade))
                        {
                            //output
                            echo ("<tr><td><div><a href='course/viewAssignment.php?id=$a_id'><span>" . $title . "</span></a><p>" . $grade . "%<br />" . $pointsEarned . "/" . $points . " Points Earned</p>" . "</div></td></tr>");
                        }
                        else
                        {
                            //output
                            echo ("<tr><td><div><a href='course/viewAssignment.php?id=$a_id'><span>" . $title . "</span></a><p>Uncompleted</p>" . "</div></td></tr>");
                        }
                    }
	            ?>

	            <tr>
	            	<td style="text-align: center;">
		            	<div>
			            	<a href="course/addAssignment.php">
				            	<span>
				            		Add A New Assignment
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
        				<a href="../resources/contact.php">Contact</a>
        			</td>

        			<td>
        				<a href="https://github.com/BenGirone/SoftwareEngineeringProject/wiki">Wiki</a>
        			</td>

        			<td>
        				<a href="../resources/spongebob-law.jpg">Legal</a>
        			</td>
        		</tr>

        		<tr>
        			<td>
        				<a href="https://github.com/BenGirone/SoftwareEngineeringProject">Contribute</a>
        			</td>

        			<td>
        				<a href="../resources/facebook-sucks.jpg">Facebook</a>
        			</td>

        			<td>
        				<a href="../resources/meme.jpg">dank meme</a>
        			</td>
        		</tr>
        	</table>
        </div>
    </body>
</html>