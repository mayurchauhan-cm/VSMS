<?php
	$conn = mysqli_connect("localhost", "root", "", "vsms");
	
	if (!$conn)
	{
		die("Connection Failed: " .mysqli_connect_error());
	}
	
	//echo "Database Connected Successfully!";
	
?>