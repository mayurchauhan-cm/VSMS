<?php
	$conn = mysqli_connect("localhost", "root", "", "vsms");
	
	if(!$conn)
	{
		die("connection Failed");
	}
	$id = $_GET['id'];
	
	$sql = "SELECT * FROM customers WHERE customer_id='$id'";
	
	$result = mysqli_query($conn,$sql);
	
	$row = mysqli_fetch_assoc($result);
	
		if(isset($_POST['update']))
	 {
		$full_name = $_POST['full_name'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];

		$update = "UPDATE customers SET
                full_name='$full_name',
                email='$email',
                mobile='$mobile'
                WHERE customer_id='$id'";

			if(mysqli_query($conn, $update))
		{
			echo "<script>
                alert('Customer Updated Successfully');
                window.location='view_customers.php';
              </script>";
		}
		else
		{
			echo "Update Failed";
		}
	 }	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Edit Customer</title>
		
		<style>

body{
    font-family:Arial;
    background:#f4f4f4;
    margin:0;
}

.container{
    width:450px;
    margin:50px auto;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0px 0px 10px #ccc;
}

h2{
    text-align:center;
}

label{
    font-weight:bold;
}

input[type=text],
input[type=email]{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
    box-sizing:border-box;
}

.btn{
    display:inline-block;
    padding:10px 20px;
    border:none;
    border-radius:5px;
    color:white;
    text-decoration:none;
    cursor:pointer;
}

.update{
    background:green;
}

.update:hover{
    background:#006400;
}

.back{
    background:#3498db;
}

.back:hover{
    background:#2980b9;
}

</style>
		
	</head>
	
	<body>
	 <div class="container">
		<h2>Edit Customer</h2>
		
		<form method="POST">
			<label>Full Name:</label><br>
			<input type="text" name="full_name" value="<?php echo $row['full_name'];?>">
			<br><br>
			
			<label>Email:</label><br>
			<input type="email" name="email" value="<?php echo $row['email'];?>">
			<br><br>
			
			<label>Mobile:</label><br>
			<input type="text" name="mobile" value="<?php echo $row['mobile'];?>">
			<br><br>
			
			<input type="submit" name="update" value="Update">
			<br><br>

			<a class="btn back" href="view_customers.php">
				Back Customers
			</a>
			
			
			
		</form>
	 </div>
	</body>
</html>