<?php
include("config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking List</title>
	
	<style>

body{
    margin:0;
    font-family:Arial, sans-serif;

    background-image:
    linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)),
    url("images/ok4.jpg");

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    background-attachment:fixed;
}

.container{
    width:30%;
    margin:40px auto;
    background:rgba(255,255,255,0.95);
    padding:2px;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.4);
}

h2{
    text-align:center;
    color:#2c3e50;
    margin-bottom:20px;
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
    text-decoration:none;
    color:white;
    margin:3px;
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

.back{
    background:#3498db;
}

.back:hover{
    background:#2980b9;
}

.pending{
    color:orange;
    font-weight:bold;
}

.progress{
    color:#3498db;
    font-weight:bold;
}

.completed{
    color:green;
    font-weight:bold;
}

	</style>
	
</head>
<body>

	<div class="container">

<h2>Booking List</h2>

<!-- Booking Table -->

<br>

	</div>

<form method="GET">

    <input type="text" name="search" placeholder="Search Booking">

    <input class="btn back" type="submit" value="Search">

</form>

<br>


<a class="btn back" href="add_booking.php">
	Add Booking
</a>

<br><br>


<table border="1" cellpadding="10">

<tr>
    <th>Booking ID</th>
    <th>Customer Name</th>
    <th>Vehicle Number</th>
    <th>Service Type</th>
    <th>Booking Date</th>
    <th>Problem</th>
    <th>Status</th>
	<th>Action</th>
	
</tr>

<?php

if(isset($_GET['search']))
{
    $search = $_GET['search'];

    $sql = "SELECT
    bookings.booking_id,
    customers.full_name,
    vehicles.vehicle_number,
    bookings.service_type,
    bookings.booking_date,
    bookings.problem,
    bookings.status

    FROM bookings

    INNER JOIN customers
    ON bookings.customer_id = customers.customer_id

    INNER JOIN vehicles
    ON bookings.vehicle_id = vehicles.vehicle_id

    WHERE
    customers.full_name LIKE '%$search%' OR
    vehicles.vehicle_number LIKE '%$search%' OR
    bookings.service_type LIKE '%$search%' OR
    bookings.status LIKE '%$search%'";
}
else
{
    $sql = "SELECT
    bookings.booking_id,
    customers.full_name,
    vehicles.vehicle_number,
    bookings.service_type,
    bookings.booking_date,
    bookings.problem,
    bookings.status

    FROM bookings

    INNER JOIN customers
    ON bookings.customer_id = customers.customer_id

    INNER JOIN vehicles
    ON bookings.vehicle_id = vehicles.vehicle_id";
}

$query = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($query))
{
?>

<tr>

<td><?php echo $row['booking_id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['vehicle_number']; ?></td>

<td><?php echo $row['service_type']; ?></td>

<td><?php echo $row['booking_date']; ?></td>

<td><?php echo $row['problem']; ?></td>

<td>

	<?php

		if($row['status']=="Pending")
	{
		echo "<span style='color:orange; font-weight:bold;'>Pending</span>";
	}
		elseif($row['status']=="Completed")
	{
		echo "<span style='color:green; font-weight:bold;'>Completed</span>";
	}
		elseif($row['status']=="In Progress")
	{
		echo "<span style='color:blue; font-weight:bold;'>In Progress</span>";
	}

	?>

</td>

<td>

<a class="btn edit"
href="edit_booking.php?id=<?php echo $row['booking_id']; ?>">
Edit
</a>

<a class="btn delete"
href="delete_booking.php?id=<?php echo $row['booking_id']; ?>"
onclick="return confirm('Are you sure you want to delete this booking?');">
Delete
</a>

</td>


</tr>

<?php
}
?>

</table>

	<br><br>

	<a class="btn back" href="dashboard.php">
		Back Dashboard
	</a>

</body>
</html>