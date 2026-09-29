<?php

	$conn = mysqli_connect("localhost", "root", "", "vsms");

	if(!$conn)
	{
		die("Connection Failed");
	}
	
		if(isset($_GET['search']))
{
    $search = $_GET['search'];

    $sql = "SELECT
    customers.full_name,
    vehicles.vehicle_id,
    vehicles.vehicle_number,
    vehicles.company,
    vehicles.model,
    vehicles.fuel_type,
    vehicles.color,
    vehicles.manufacturing_year
    FROM vehicles
    INNER JOIN customers
    ON vehicles.customer_id = customers.customer_id
    WHERE
    vehicles.vehicle_number LIKE '%$search%' OR
    vehicles.company LIKE '%$search%' OR
    vehicles.model LIKE '%$search%' OR
    customers.full_name LIKE '%$search%'";
}
else
{
    $sql = "SELECT
    customers.full_name,
    vehicles.vehicle_id,
    vehicles.vehicle_number,
    vehicles.company,
    vehicles.model,
    vehicles.fuel_type,
    vehicles.color,
    vehicles.manufacturing_year
    FROM vehicles
    INNER JOIN customers
    ON vehicles.customer_id = customers.customer_id";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Vehicle list</title>
		
	<style>

body{
    margin:0;
    font-family:Arial, sans-serif;

    background-image:
    linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)),
    url("images/ok3.jpg");

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    background-attachment:fixed;
}

.container{
    width:30%;
    margin:40px auto;
    background:rgba(255,255,255,0.95);
    padding:5px;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.4);
}

h2{
    text-align:center;
    color:#2c3e50;
}

.search-box{
    text-align:center;
    margin:20px 0;
}

.search-box input[type=text]{
    width:300px;
    padding:10px;
    border-radius:5px;
    border:1px solid #ccc;
}

.search-box input[type=submit]{
    padding:10px 20px;
    background:#3498db;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

.search-box input[type=submit]:hover{
    background:#2980b9;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

th{
    background:#2c3e50;
    color:white;
    padding:12px;
}

td{
    padding:10px;
    text-align:center;
}

tr:nth-child(even){
    background:#f2f2f2;
}

tr:hover{
    background:#d6eaf8;
}

.btn{
    display:inline-block;
    padding:8px 15px;
    border-radius:5px;
    color:white;
    text-decoration:none;
    margin:3px;
}

.add{
    background:#3498db;
}

.add:hover{
    background:#2980b9;
}

.edit{
    background:#27ae60;
}

.edit:hover{
    background:#1e8449;
}

.delete{
    background:#e74c3c;
}

.delete:hover{
    background:#c0392b;
}
	</style>
		
	</head>
	
	<body>
	
<br><br>
<a class="btn add" href="add_vehicle.php">Add Vehicle</a>

<div class="search-box">
<form method="GET">
<input type="text" name="search" placeholder="Search Vehicle">
<input type="submit" value="Search">
</form>
</div>

<div class="container">

<h2>Vehicle List</h2>

</div>

<!-- Table -->

<br>

		<br>
		
		<table border="1" cellpadding="10">
		
			<tr>
				<th>ID</th>
				<th>Customer Name</th>
				<th>Vehicle Number</th>
				<th>Company</th>
				<th>Model</th>
				<th>Fuel Type</th>
				<th>Color</th>
				<th>Manufacturing year</th>
				<th>Action</th>
				
			</tr>
			
			
			<?php
				while($row = mysqli_fetch_assoc($result))
			{
			?>
			<tr>

				<td><?php echo $row['vehicle_id']; ?></td>

				<td><?php echo $row['full_name']; ?></td>

				<td><?php echo $row['vehicle_number']; ?></td>

				<td><?php echo $row['company']; ?></td>

				<td><?php echo $row['model']; ?></td>

				<td><?php echo $row['fuel_type']; ?></td>

				<td><?php echo $row['color']; ?></td>

				<td><?php echo $row['manufacturing_year']; ?></td>
				
				<td>
					<a class="btn edit" 
						href="edit_vehicle.php?id=<?php echo $row['vehicle_id']; ?>">
						Edit
					</a>
				
					<a class="btn delete"
					   href="delete_vehicle.php?id=<?php echo $row['vehicle_id']; ?>"
					   onclick="return confirm('Are you sure you want to delete this vehicle?');">
					   Delete
					</a>
				</td>

			</tr>

			<?php
			}
			?>
		</table>
		
			<br><br>

			<a class="btn add" href="dashboard.php">
				Back Dashboard
			</a>
		
	</body>
</html>