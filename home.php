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
        	border:4px solid black;
        }
        </style>
    </head>
    <body>
    	<div class="header">
    		<table>
    			<tr>
    				<td>
    					My Courses
    				</td>

    				<td>
    					Notifications
    				</td>

    				<td>
    					New Course
    				</td>

    				<td>
    					About
    				</td>
    			</tr>
    		</table>
    	</div>


        <div class="wrapper">
        	<table class="courseTable">
	            <tr>
	            	<td>
		            	<div>
			            	<a href="">
				            	<span>
				            		Title
				            	</span>
			            	</a>

			            	<p>
			            		This is the decription
			            	</p>
		            	</div>
	            	</td>
	            </tr>

	            <tr>
	            	<td>
		            	<div>
			            	<a href="">
				            	<span>
				            		Title
				            	</span>
			            	</a>

			            	<p>
			            		This is the decription
			            	</p>
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