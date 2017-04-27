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
        <style type="text/css">
        .wrapper {
        	width: 50%;
        	background-color: white;
            color:black;
            font-size: 15px;
        	border-left:4px solid black;
        	border-right:4px solid black;
        }
        span {
            font-weight: bold;
        }
        </style>
    </head>
    <body>
        <img style="height:100px; margin: auto; display: block;" src="../graphics/logo.png">
    	<div class="header">
    		<table>
    			<tr>
    				<td>
    					<a href="../home.php"><div>My Courses</div></a>
    				</td>

    				<td>
    					<a href="add.php"><div>New Course</div></a>
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

            	$a_id = mysqli_real_escape_string($db, $_GET["id"]);
				$sql = "SELECT a_name, a_desc, date_assigned, date_due, grade_weight, p_id FROM assignments WHERE a_id = '$a_id';";
				$sql_result = $db->query($sql);

				while ($row = $sql_result->fetch_row())
                {
                	$title = $row[0];
                    $description = $row[1];
                    $start = $row[2];
                    $end = $row[3];
                    $weight = $row[4];
                    $parent = $row[5];
                    
                    //output an option to the dropdown
                    echo ("<span>Title: </span>" . "$title" . "<br /><span>Desciption: </span><br />" . nl2br($description) . "<br /><span>Grade Weight: </span>" . $weight . "<br /><span>Date Assigned: </span>" . $start . "<br /><span>Date Due: </span>" . $end);

                    if ($parent != NULL)
                    {
                        $sql2 = "SELECT a_name FROM assignments WHERE a_id = '$parent';";
                        $sql_result2 = $db->query($sql2);
                        while ($row = $sql_result2->fetch_row())
                        {
                            $parentName = $row[0];
                            echo ("<br /><span>This is a sub-assignment of: </span>" . $parentName);
                        }
                    }
                    
                }
            ?>
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
        				<a href="../resources/facebooksucks.jpg">Facebook</a>
        			</td>

        			<td>
        				<a href="../resources/meme.jpg">dank meme</a>
        			</td>
        		</tr>
        	</table>
        </div>
    </body>
</html>
