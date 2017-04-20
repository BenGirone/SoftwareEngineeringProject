<?php
session_start(); //connect to the current session

if (!(isset($_SESSION["loggedIn"])))
{
	header('Location: index.php');
	exit();
}

session_unset();
session_destroy();

header('Location: index.php');
exit();
?>