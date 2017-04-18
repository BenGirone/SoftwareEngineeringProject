<?php
session_start();

if (!(isset($_SESSION["loggedIn"])))
{
    header('Location: ../index.php');
    exit();
}

$errorMessage = ""; //have the inital login error message be blank

if (isset($_SESSION["failedAssignmentAdd"]))
{
    $errorMessage = "You already have an assignment with this name.";
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
    <div class="wrapper">
            <form id="form1" action="addingAssignment.php" method="post">
                <table class="inputTable">
                    <tr class="inputTableHeader">
                        <td>
                            <span>Create A New Assignment</span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <span class="errorText"><?php echo ($errorMessage); ?></span>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <span>Assignment Title:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td> <input type="text" name="title" required="true"> </td>
                    </tr>
                    

                    <tr><td><br /></td></tr>


                    <tr>
                        <td>
                            <span>Assignment Description:</span>
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
                            <span>Assignment Grade Weight:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td> <input type="text" name="weight" required="true"> </td>
                    </tr>
                    

                    <tr><td><br /></td></tr>


                    <tr>
                        <td>
                            <span>Parent Assignment (optional):</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                        <input type="hidden" name="parent" id="dropdownValue">
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

                            //execute query to aquire all the records from the table
                            $query = "SELECT a_id, a_name FROM assignments WHERE c_id='$c_id' AND p_id IS NULL";
                            $result = $db->query($query);

                            //create the dropdown
                            echo("<select id='selectBox' onchange='changeFunc()'>");
                            echo ('<option></option>'); //make a blank option
                            while ($row = $result->fetch_row())
                            {
                                $id = $row[0];
                                $title = $row[1];
                                
                                //output an option to the dropdown
                                echo ("<option data-id='$id'>" . $title . "</option>");
                                
                            }
                            echo('</select>');
                            echo("<input type='hidden' name='id' value='$c_id'>");
                            ?>
                        </td>
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
                        <td><input class="red" type="submit" value="Create Assignment" id="submit"></td>
                    </tr>

                </table>
            </form>

            <form <?php echo ("action='view.php?id=4'"); ?>>
                <table class="inputTable">
                    <tr>
                        <td>
                            <input type="submit" value="Return to Course">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</body>
</html>