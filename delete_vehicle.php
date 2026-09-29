<?php

	$conn = mysqli_connect("localhost","root","","vsms");

	if(!$conn)
	{
		die("Connection Failed");
	}

	$id = $_GET['id'];

	$sql = "DELETE FROM vehicles WHERE vehicle_id='$id'";

	if(mysqli_query($conn,$sql))
	{
		echo "<script>
            alert('Vehicle Deleted Successfully');
            window.location='vehicle.php';
          </script>";
	}
	else
	{
		echo "Delete Failed";
	}

?>