<?php
session_start(); //connect to the current session

if (!(isset($_SESSION["loggedIn"])))
{
	header('Location: ../index.php');
	exit();
}
?>

<?php
//functions
function getNewGrade(&$a_id, &$grade, &$u_id, &$db)
{
    if (isset($_POST["input$a_id"]))
    {
        if ($_POST["input$a_id"] != "")
        {
            $newGrade = mysqli_real_escape_string($db, floatval($_POST["input$a_id"]));
                                        
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
            }
            $grade = $newGrade;
        }
    }

    if (isset($_POST["input2$a_id"]) && $grade == NULL)
    {
        if ($_POST["input2$a_id"] != "")
        {
            $grade = floatval($_POST["input2$a_id"]);
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}

function outputAssignment($hasGrade, $isParent, $isGuess, &$title ,&$grade, &$pointsEarned, &$points, &$a_id, &$c_id)
{
    $guessValue;
    $status;
    $guessInput;
    $divOpener;

    if ($isGuess)
        $guessValue = "value='$grade'";
    else
        $guessValue = "";

    if ($hasGrade)
    {
        $status = "<span id='status$a_id'>Current Grade:</span>";
        if ($isGuess)
            $guessInput = "<span style='font-size: 15px;'>Guess Grade:&nbsp;&nbsp;</span><input type='text' name='input2$a_id' $guessValue >%";
        else
            $guessInput = "";
    }
    else
    {
        $status = "<span id='status$a_id'>Uncompleted:</span>";
        $guessInput = "<span style='font-size: 15px;'>Guess Grade:&nbsp;&nbsp;</span><input type='text' name='input2$a_id' $guessValue >%";
    }

    if ($isParent)
        $divOpener = "<div style='border-left: 2px solid blue;'>";
    else
        $divOpener = "<div style='width: 80%; float: right;'>";

    echo ("<tr>
            <td>
                $divOpener
                    <a style='float: left;' href='viewAssignment.php?id=$a_id'>
                        <span>"
                         . $title .
                        "</span>
                    </a>

                    <div style='text-align: right;'>
                        <a class='assignmentOption' href='editAssignment.php?id=$a_id&c=$c_id'>edit</a>
                    </div>
                    
                    <div id='$a_id'>
                    <span style='font-size: 15px;'>Change Grade:</span>
                    <input type='text' name='input$a_id'>%

                    <br />
                    $guessInput
                    </div>
                </div>
            </td>
            <td>
                <div>
                    $status
                    <p style='text-align: center;'><span id='grade$a_id'>"
                     . $grade . "</span>%<br /><br /><span id='points$a_id'>" . $pointsEarned . "</span>/" . $points . " Points Earned
                    </p>
                </div>
            </td>
        </tr>");
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
    					<a href="https://docs.google.com/presentation/d/1HLN6jSotTdy5wylEdhUbeF6X0gQM22RvyRIiBTwPChs/edit?usp=sharing"><div>About</div></a>
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

                    //retrieve the user and course ID
	            	$u_id = mysqli_real_escape_string($db, $_SESSION["ID"]);
	            	$c_id = mysqli_real_escape_string($db, intval($_GET["id"]));

                    $sql_check_user = "SELECT t_id FROM course WHERE c_id = '$c_id'";
                    $sql_check_user_result = $db->query($sql_check_user);
                    $row = $sql_check_user_result->fetch_row();
                    if ($row[0] != $u_id)
                        exit();
 
                    //The query to select the user parent assignments for the course
					$sql = "SELECT 
                                assignments.a_id,
                                assignments.p_id,
                                assignments.grade_weight,
                                assignments.a_name,
                                gradegiven.grade_given,
                                gradegiven.u_id
                            FROM
                                gradegiven
                                    RIGHT JOIN
                                assignments ON (gradegiven.a_id = assignments.a_id
                                    AND gradegiven.u_id = '$u_id')
                            WHERE
                                (assignments.c_id = '$c_id' AND assignments.p_id IS NULL)
                            ORDER BY assignments.p_id;";
					$sql_result = $db->query($sql);

                    
                    $calculationStr = "";

                    //calculate needed grade of parents
                    while ($row = $sql_result->fetch_row())
                    {
                        //retrieve info from an assignment
                        $a_id = $row[0];
                        $grade = $row[4];
                        $points = $row[2];
                        $guess = getNewGrade($a_id, $grade, $u_id, $db);

                        if ($grade != NULL)
                        {
                            $grade *= 0.01;
                            $calculationStr .= "$grade" . '_' . "$points" . '_';
                        }
                        else
                        {
                            $calculationStr .= '-1_' . "$points" . '_';
                        }
                    }

                    $neededGrade = NULL;
                    $currentGrade = NULL;
                    if (isset($_POST["gradeDesired"]) && $calculationStr != "")
                    {
                        if ($_POST["gradeDesired"] != "")
                        {
                            $calculationStr .= (floatval($_POST["gradeDesired"]) * 0.01) . '_';
                            $output = shell_exec("cd ../ && cd C && ./binary $calculationStr"); //Linux
                            //$output = shell_exec("deleteMe.exe $calculationStr"); //Windows
                            $i = strpos($output, '_');
                            $neededGrade = substr($output, 0, $i) * 100;
                            $currentGrade = substr($output, $i + 1) * 100;
                        }
                    }
                    $neededGrade *= 0.01;
                    $sql_result->data_seek(0);

                    $calculationStr = "";
                    $childCalculationStr = "";

                    //calculate needed grades of children and output results
					while ($row = $sql_result->fetch_row())
                    {
                        //retrieve info from an assignment
                    	$a_id = $row[0];
                        $title = $row[3];
                        $grade = $row[4];
                        $points = $row[2];
                        $guess = getNewGrade($a_id, $grade, $u_id, $db);
                        $pointsEarned = ($grade/100) * $points;

                        //print an assignment 
                        outputAssignment($grade != NULL, true, ($guess), $title, $grade, $pointsEarned, $points, $a_id, $c_id);

                        $get_child_sql = "  SELECT 
                                                assignments.a_id,
                                                assignments.p_id,
                                                assignments.grade_weight,
                                                assignments.a_name,
                                                gradegiven.grade_given,
                                                gradegiven.u_id
                                            FROM
                                                gradegiven
                                                    RIGHT JOIN
                                                assignments ON (gradegiven.a_id = assignments.a_id
                                                    AND gradegiven.u_id = '$u_id')
                                            WHERE
                                                (assignments.p_id = '$a_id')
                                            ORDER BY assignments.p_id;";                                
                        $get_child_sql_result = $db->query($get_child_sql);

                        $calculateChild = true;
                        $childCount = $get_child_sql_result->num_rows;
                        $counter = 0;
                        while ($row = $get_child_sql_result->fetch_row())
                        {
                            //retrieve info from an assignment
                            $a_id_c = $row[0];
                            $title_c = $row[3];
                            $grade_c = $row[4];
                            $points_c = $row[2];
                            $guess_c = getNewGrade($a_id_c, $grade_c, $u_id, $db);
                            $pointsEarned_c = ($grade_c/100) * $points_c;

                            //print an assignment 
                            outputAssignment($grade_c != NULL, false, ($guess_c), $title_c, $grade_c, $pointsEarned_c, $points_c, $a_id_c, $c_id);

                            if ($grade_c != NULL)
                            {
                                $grade_c *= 0.01;
                                $childCalculationStr .= "$grade_c" . '_' . "$points_c" . '_';
                                $calculateChild = true;
                            }
                            else
                            {
                                $childCalculationStr .= '-1_' . "$points_c" . '_';
                            }
                        }

                        $childNeededGrade = NULL;
                        if ($childCount)
                        {
                            echo ("<script>document.getElementById('$a_id').innerHTML = '<br />Parent Assigment';</script>");

                            if ($calculateChild)
                            {
                                $childCalculationStr .= $neededGrade . '_';
                                $output = shell_exec("cd ../ && cd C && ./binary $calculationStr"); //Linux
                                //$output = shell_exec("deleteMe.exe $childCalculationStr"); //Windows
                                $i = strpos($output, '_');
                                $childNeededGrade = substr($output, 0, $i) * 100;
                                $grade = substr($output, $i + 1);
                                $newPointsEarned = ($grade) * $points;
                                $grade *= 100;
                                echo ("<script>document.getElementById('grade$a_id').innerHTML = '$grade'; document.getElementById('points$a_id').innerHTML = '$newPointsEarned'; document.getElementById('status$a_id').innerHTML = 'Current Grade:';</script>");
                            }
                            echo("<tr><td></td><td><div style='font-size: 20px'>You need to recieve atleast a(n): " . $childNeededGrade . "% on these assignments in order to receive a " . ($neededGrade * 100) . "% on the parent assignment</div></td>");
                        }

                        $childCalculationStr = "";

                        if ($grade != NULL)
                        {
                            $grade *= 0.01;
                            $calculationStr .= "$grade" . '_' . "$points" . '_';
                        }
                        else
                        {
                            $calculationStr .= '-1_' . "$points" . '_';
                        }
                    }

                    $neededGrade = NULL;
                    $currentGrade = NULL;
                    if (isset($_POST["gradeDesired"]) && $calculationStr != "")
                    {
                        if ($_POST["gradeDesired"] != "")
                        {
                            $calculationStr .= (floatval($_POST["gradeDesired"]) * 0.01) . '_';
                            $output = shell_exec("cd ../ && cd C && ./binary $calculationStr"); //Linux
                            //$output = shell_exec("deleteMe.exe $calculationStr"); //Windows
                            $i = strpos($output, '_');
                            $neededGrade = substr($output, 0, $i) * 100;
                            $currentGrade = substr($output, $i + 1) * 100;
                        }
                    }
	            ?>
                <tr>
                    <td>
                        <div>
                            <table>
                                <tr>
                                    <td style="font-size: 20px;">
                                        Desired Grade:
                                    </td>
                                    <td>
                                        <input type="text" name="gradeDesired" id="dropdownValue" style="width: 80%;" <?php if (!empty($_POST["gradeDesired"])) {$i = floatval($_POST["gradeDesired"]); echo ("value='$i'");} else {echo ("value='0'");}?>>
                                    </td>
                                    <td>
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
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td>
                        <div style="font-size: 20px">
                            Current total grade is: <?php echo ($currentGrade);?>% You need to receive atleast a(n): <?php echo ($neededGrade);?>% on all remaining parent assignments
                        </div>
                    </td>
                </tr>

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
