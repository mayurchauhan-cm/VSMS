<?php

	$conn = mysqli_connect("localhost", "root", "", "vsms");

	if(!$conn)
	{
		die("Connection Failed");
	}

		if(!isset($_GET['id']))
	{
		die("Invalid Vehicle ID");
	}

	$id = $_GET['id'];

	$sql = "SELECT * FROM vehicles WHERE vehicle_id='$id'";

	$result = mysqli_query($conn, $sql);

	$row = mysqli_fetch_assoc($result);
	
	$customers = mysqli_query($conn, "SELECT * FROM customers");
	
	if(isset($_POST['update']))
{
    $customer_id = $_POST['customer_id'];
    $vehicle_number = $_POST['vehicle_number'];
    $company = $_POST['company'];
    $model = $_POST['model'];
    $fuel_type = $_POST['fuel_type'];
    $color = $_POST['color'];
    $manufacturing_year = $_POST['manufacturing_year'];

    $sql = "UPDATE vehicles SET
            customer_id='$customer_id',
            vehicle_number='$vehicle_number',
            company='$company',
            model='$model',
            fuel_type='$fuel_type',
            color='$color',
            manufacturing_year='$manufacturing_year'
            WHERE vehicle_id='$id'";

    if(mysqli_query($conn, $sql))
    {
        echo "<script>
                alert('Vehicle Updated Successfully');
                window.location='vehicle.php';
              </script>";
    }
    else
    {
        echo "Update Failed : " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Edit Vehicle</title>
		
		<style>

body{
    font-family:Arial;
    background:#f4f4f4;
    margin:0;
}

.container{
    width:500px;
    margin:40px auto;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 10px #ccc;
}

h2{
    text-align:center;
}

label{
    font-weight:bold;
}

input[type=text],
input[type=number],
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
		<h2>Edit Vehicle</h2>
		
	<form method="POST">
	
	
		

    <label>Select Customer</label><br>

    <select name="customer_id">

        <?php
        while($customer = mysqli_fetch_assoc($customers))
        {
        ?>

        <option value="<?php echo $customer['customer_id']; ?>"

        <?php
        if($customer['customer_id'] == $row['customer_id'])
        {
            echo "selected";
        }
        ?>

        >

        <?php echo $customer['full_name']; ?>

        </option>

        <?php
        }
        ?>

    </select>
	
		<br><br>

    <label>Vehicle Number</label><br>
    <input type="text" name="vehicle_number" value="<?php echo $row['vehicle_number']; ?>">

    <br><br>

    <label>Company</label><br>
    <input type="text" name="company" value="<?php echo $row['company']; ?>">

    <br><br>

    <label>Model</label><br>
    <input type="text" name="model" value="<?php echo $row['model']; ?>">

    <br><br>

    <label>Fuel Type</label><br>

    <select name="fuel_type">

        <option value="Petrol" <?php if($row['fuel_type']=="Petrol") echo "selected"; ?>>Petrol</option>

        <option value="Diesel" <?php if($row['fuel_type']=="Diesel") echo "selected"; ?>>Diesel</option>

        <option value="CNG" <?php if($row['fuel_type']=="CNG") echo "selected"; ?>>CNG</option>

        <option value="Electric" <?php if($row['fuel_type']=="Electric") echo "selected"; ?>>Electric</option>

    </select>

    <br><br>

    <label>Color</label><br>
    <input type="text" name="color" value="<?php echo $row['color']; ?>">

    <br><br>

    <label>Manufacturing Year</label><br>
    <input type="number" name="manufacturing_year" value="<?php echo $row['manufacturing_year']; ?>">

    <br><br>

    <input class="btn update" type="submit" name="update" value="Update Vehicle">

		<br><br>

			<a class="btn back" href="vehicle.php">
				Back Vehicles
			</a>
	
	</form>
		</div>
	</body>
</html>