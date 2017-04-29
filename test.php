<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$s = $_POST["input"];

	if ((strpos($s, ' ') === false) && (strpos($s, ';') === false) && (strlen($s) > 5))
	{
		echo "validated";
	}
	else
	{
		
	}
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>
<form method="post" action="test.php">
	Enter Stuff: 
	<input type="text" name="input">
	<input type="submit" name="submit">
</form>
</body>
</html>