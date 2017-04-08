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
        .courseTable > tbody > tr > td {
            width: 50%;
            height: 100%;
        }
        .courseTable > tbody > tr > td > div {
            height: 100%;
        }
        .assignmentOption {
            font-size: 20px;
            padding: 10px;
            text-decoration: none;

        }
        input[type=text], select {
            height: 20px;
            width: 30%;
        }
        </style>
        <script type='text/javascript'>  
                function changeFunc() {
                    var selectBox = document.getElementById("selectBox");
                    var selectedValue = selectBox.options[selectBox.selectedIndex];
                    var box = document.getElementById("dropdownValue");
                    
                    if (selectedValue.value != '')
                    {    
                        box.value = selectedValue.dataset.id;
                    }
                    else
                    {
                        box.value = '';
                    }
                }  
        </script>
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
            <form <?php $i = $_GET['id']; echo ("action='view.php?id=$i'"); ?> method="post">
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
                        $p_id = $row[1];
                        $title = $row[3];
                        $grade = $row[4];
                        $points = $row[2];
                        $pointsEarned = ($grade/100) * $points;
                        $guess = false;
                        if (isset($_POST["$a_id"]))
                        {
                            $newGrade = mysqli_real_escape_string($db, $_POST["$a_id"]);
                            
                            $sql_check = "SELECT gg_id FROM gradegiven WHERE a_id='$a_id' AND u_id='$u_id';";
                            $sql_check_result = $db->query($sql_check);

                            if ($sql_check_result->num_rows)
                            {
                                $add_grade_sql="UPDATE gradegiven SET grade_given='$newGrade' WHERE a_id='$a_id' AND u_id='$u_id';";
                                $add_grade_sql_result = $db->query($add_grade_sql);
                            }
                            else
                            {
                                $add_grade_sql="INSERT INTO gradegiven (a_id, u_id, grade_given) VALUES('$a_id', '$u_id', '$newGrade');";
                                $add_grade_sql_result = $db->query($add_grade_sql);
                                echo ("<script>alert($_POST['$a_id']);</script>");
                            }
                            $grade = $newGrade;
                        }
                        if (isset($_POST["2$a_id"]))
                        {
                            $grade = $_POST["2$a_id"];
                            $pointsEarned = ($grade/100) * $points;
                            $guess = true;
                        }

                        if (!is_null($grade))
                        {
                            //output
                            echo ("<tr>
                                    <td>
                                        <div>
                                            <a style='float: left;' href='viewAssignment.php?id=$a_id'>
                                                <span>"
                                                 . $title .
                                                "</span>
                                            </a>

                                            <div style='text-align: right;'>
                                                <a class='assignmentOption' href=''>edit</a>
                                            </div>

                                            <span style='font-size: 15px;'>Change Grade:</span>
                                            <input type='text' name='$a_id'>%
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span style='float: left;'>Current Grade:</span>");
                            if ($guess)
                            {

                                            echo ("<div style='text-align: right;'>
                                                    <a class='assignmentOption' href=''>reset guess</a>
                                                </div>");
                            }
                                            echo("<p style='text-align: center;'>"
                                             . $grade . "%<br /><br />" . $pointsEarned . "/" . $points . " Points Earned
                                            </p>
                                        </div>
                                    </td>
                                </tr>");
                        }
                        else
                        {
                            //output
                            echo ("<tr>
                                    <td>
                                        <div>
                                            <a style='float: left;' href='viewAssignment.php?id=$a_id'>
                                                <span>"
                                                 . $title .
                                                "</span>
                                            </a>

                                            <div style='text-align: right;'>
                                                <a class='assignmentOption' href=''>edit</a>
                                            </div>

                                            <span style='font-size: 15px;'>Change Grade:</span>
                                            <input type='text' name='$a_id'>%

                                            <br />

                                            <span style='font-size: 15px;'>Guess Grade:&nbsp;&nbsp;</span>
                                            <input type='text' name='2$a_id'>%
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span>Uncompleted:</span>
                                            <p style='text-align: center;'>"
                                             . $grade . "%<br /><br />" . $pointsEarned . "/" . $points . " Points Earned
                                            </p> 
                                        </div>
                                    </td>
                                </tr>");
                        }
                    }
	            ?>

	            <tr>
	            	<td style="text-align: center;">
		            	<div>
			            	<?php echo "<a href='addAssignment.php?id=$c_id'>";?>
				            	<span>
				            		Add A New Assignment
				            	</span>
			            	</a>
		            	</div>
	            	</td>
                    <td>
                        <div>
                            <span>
                                <input type="submit" value="Update">
                                <input type="text" name="gradeDesired" id="dropdownValue">
                                <?php
                                    //execute query to aquire all the records from the table
                                    $query = "SELECT grade_letter, g_value FROM graderule WHERE c_id='$c_id'";
                                    $result = $db->query($query);

                                    //create the dropdown
                                    echo("<select id='selectBox' onchange='changeFunc()'>");
                                    echo ('<option></option>'); //make a blank option
                                    while ($row = $result->fetch_row())
                                    {
                                        $letter = $row[0];
                                        $value = $row[1];
                                        
                                        //output an option to the dropdown
                                        echo ("<option data-id='$value'>" . $letter . "</option>");
                                        
                                    }
                                    echo('</select>');
                                ?>
                            </span>
                        </div>
                    </td>
	            </tr>
            </table>
            </form>
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