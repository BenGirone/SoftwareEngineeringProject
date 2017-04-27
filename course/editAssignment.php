<?php
session_start();

if (!(isset($_SESSION["loggedIn"])))
{
    header('Location: ../index.php');
    exit();
}

$errorMessage = ""; //have the inital login error message be blank

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
    <div class="wrapper">
            <form action="deleteAssignment.php">
                <table class="inputTable">
                    <tr>
                        <td>
                            <input class="yellow" type="submit" value="Delete Assignment">
                            <input type="hidden" name="a_id" <?php $i = $_GET["id"]; echo "value='$i'"; ?>>
                            <input type="hidden" name="c_id" <?php $i2 = $_GET["c"]; echo "value='$i2'"; ?>>
                        </td>
                    </tr>
                </table>
            </form>
            <form id="form1" action="editingAssignment.php" method="post">
                <input type="hidden" name="a_id" <?php $i = $_GET["id"]; echo "value='$i'"; ?>>
                <input type="hidden" name="c_id" <?php $i2 = $_GET["c"]; echo "value='$i2'"; ?>>
                <table class="inputTable">
                    <tr class="inputTableHeader">
                        <td>
                            <span>Update an Assignment</span>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <span class="errorText"><?php echo ($errorMessage); ?></span>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <span>Reset Grade:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td> <input style="width: 100%;" type="checkbox" name="reset"> </td>
                    </tr>


                    <tr>
                        <td>
                            <span>Assignment Title:</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td> <input type="text" name="title"> </td>
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
                        <td> <input type="text" name="weight"> </td>
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
                            $c_id = mysqli_real_escape_string($db, $_GET["c"]);

                            //execute query to aquire all the records from the table
                            $query = "SELECT a_id, a_name FROM assignments WHERE c_id='$c_id'";
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