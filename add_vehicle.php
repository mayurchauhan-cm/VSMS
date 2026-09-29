<?php

	$conn = mysqli_connect("localhost","root","","vsms");

	if(!$conn)
	{
		die("Connection Failed");
	}
	// Customers ko database se lana
	$customer = "SELECT * FROM customers";

	$result = mysqli_query($conn, $customer);
	
	
	if(isset($_POST['save']))
 {
    $customer_id = $_POST['customer_id'];
    $vehicle_number = $_POST['vehicle_number'];
    $company = $_POST['company'];
    $model = $_POST['model'];
    $fuel_type = $_POST['fuel_type'];
    $color = $_POST['color'];
    $manufacturing_year = $_POST['manufacturing_year'];

    $sql = "INSERT INTO vehicles
    (customer_id, vehicle_number, company, model, fuel_type, color, manufacturing_year)
    VALUES
    ('$customer_id','$vehicle_number','$company','$model','$fuel_type','$color','$manufacturing_year')";

    if(mysqli_query($conn, $sql))
    {
        echo "<script>alert('Vehicle Added Successfully');</script>";
    }
    else
    {
        echo mysqli_error($conn);
    }
 }

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add Vehicle</title>
		
		<style>

body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#f4f4f4;
}

.container{
    width:450px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.2);
}

h2{
    text-align:center;
    color:#2c3e50;
    margin-bottom:25px;
}

label{
    font-weight:bold;
}

input,
select{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
    box-sizing:border-box;
}

.btn{
    width:100%;
    padding:12px;
    background:#3498db;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-size:16px;
}

.btn:hover{
    background:#2980b9;
}

.back-btn{
    display:block;
    text-align:center;
    margin-top:15px;
    text-decoration:none;
    background:#2c3e50;
    color:white;
    padding:12px;
    border-radius:5px;
}

.back-btn:hover{
    background:#34495e;
}

</style>
		
	</head>
	
	<body>
		<div class="container">
		
		<h2>Add Vehicle</h2>
		
		<form method="POST">
		
			<a class="back-btn" href="vehicle.php">
				Back Vehicle List
			</a>
			<br><br>
			
			<label>Select Customer</label>
			<br>
			
			<select name="customer_id">
				<option value="">--Select Customer--</option>
				
				<?php
					while($row = mysqli_fetch_assoc($result))
					{	
				?>
					<option value="<?php echo $row['customer_id'];?>">
						<?php echo $row['full_name'];?>
					</option>
					<?php
					}
					?>
			</select>
			<br><br>
			
			<label>Vehicle Number</label><br>
			<input type="text" name="vehicle_number">
			<br><br>
			
			<label>Company</label><br>
			<input type="text" name="company">
			<br><br>
			
			<label>Fuel Type</label><br>
			<select name="fuel_type">
				<option value="">Select Fuel Type</option>
				<option>Petrol</option>
				<option>Diesel</option>
				<option>CNG</option>
				<option>Electric</option>
			</select>
			<br><br>
			
			<label>Model</label><br>
			<input type="text" name="model">
			<br><br>
			
			<label>Color</label><br>
			<input type="text" name="color">
			<br><br>
			
			<label>Manufacturing year</label><br>
			<input type="number" name="manufacturing_year">
			<br><br>
			
			<input class="btn" type="submit" name="save" value="Save Vehicle">
			
		</form>
		</div>
	</body>
</html>