<?php
session_start();

include("config.php");

if(!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}

$customer = mysqli_query($conn, "SELECT COUNT(*) AS total FROM customers");
$customer_data = mysqli_fetch_assoc($customer);

$vehicle = mysqli_query($conn, "SELECT COUNT(*) AS total FROM vehicles");
$vehicle_data = mysqli_fetch_assoc($vehicle);

$booking = mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings");
$booking_data = mysqli_fetch_assoc($booking);

$completed = mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings WHERE status='Completed'");
$completed_data = mysqli_fetch_assoc($completed);

$pending = mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings WHERE status='Pending'");
$pending_data = mysqli_fetch_assoc($pending);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Dashboard</title>
		
	<style>

/* Body */

body{
    margin:0;
    font-family:Arial, sans-serif;

    background-image:
    linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)),
    url("images/ok1.jpg");

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    background-attachment:fixed;
}

/* Navbar */

.navbar{
    background:rgba(44,62,80,0.90);
    padding:15px;
}

.navbar a{
    color:white;
    text-decoration:none;
    margin-right:20px;
    font-size:18px;
    font-weight:bold;
}

.navbar a:hover{
    color:#f1c40f;
}

/* Header */

.header{
    background:rgba(52,73,94,0.75);
    color:white;
    text-align:center;
    padding:30px;
    text-shadow:2px 2px 5px black;
}

.header h1{
    margin:0;
    font-size:36px;
}

.header p{
    margin-top:10px;
    font-size:18px;
}

/* Cards */

.cards{
    display:flex;
    justify-content:center;
    flex-wrap:wrap;
    gap:20px;
    padding:30px;
}

.card{
    width:220px;
    background:rgba(255,255,255,0.92);
    border-radius:12px;
    text-align:center;
    padding:20px;
    box-shadow:0 6px 15px rgba(0,0,0,0.35);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-8px);
}

.card h3{
    margin:0;
    color:#555;
}

.card h1{
    font-size:38px;
    margin-top:15px;
    color:#2c3e50;
}

/* Card Colors */

.blue{
    border-top:6px solid #3498db;
}

.green{
    border-top:6px solid #27ae60;
}

.orange{
    border-top:6px solid #f39c12;
}

.purple{
    border-top:6px solid #8e44ad;
}

.red{
    border-top:6px solid #e74c3c;
}

/* Dashboard Buttons */

.menu{
    text-align:center;
    margin-bottom:30px;
}

.menu-btn{
    display:inline-block;
    background:#2980b9;
    color:white;
    padding:12px 25px;
    margin:10px;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
    transition:0.3s;
}

.menu-btn:hover{
    background:#1abc9c;
    transform:scale(1.05);
}

.logout-btn{
    background:#c0392b;
}

.logout-btn:hover{
    background:#e74c3c;
}

/* Footer */

.footer{
     background:rgba(52,73,94,0.75);
    color:white;
    text-align:center;
    padding:30px;
    text-shadow:2px 2px 5px black;
	margin-top:100px;
}

.footer h3{
    margin:0 0 10px;
    color:#f1c40f;
    font-size:20px;
}

.footer p{
    margin:4px 0;
    font-size:14px;
}

	</style>
		
		
	</head>
	
	<body>

    <div class="navbar"><center>

        <a href="dashboard.php">Dashboard</a>

        <a href="view_customers.php">Customers</a>

        <a href="vehicle.php">Vehicles</a>

        <a href="booking_list.php">Bookings</a>

        <a href="add_booking.php">Add Booking</a>

        <a href="logout.php">Logout</a>

    </center></div>


    <div class="header">

        <h1>Vehicle Service Management System</h1>

        <p>Welcome, <?php echo $_SESSION['email']; ?></p>

    </div>


    <div class="cards">

        <div class="card blue">
            <h3>Total Customers</h3>
            <h1><?php echo $customer_data['total']; ?></h1>
        </div>

        <div class="card green">
            <h3>Total Vehicles</h3>
            <h1><?php echo $vehicle_data['total']; ?></h1>
        </div>

        <div class="card orange">
            <h3>Total Bookings</h3>
            <h1><?php echo $booking_data['total']; ?></h1>
        </div>

        <div class="card purple">
            <h3>Completed Bookings</h3>
            <h1><?php echo $completed_data['total']; ?></h1>
        </div>

        <div class="card red">
            <h3>Pending Bookings</h3>
            <h1><?php echo $pending_data['total']; ?></h1>
        </div>

    </div>


	
	<div class="footer">

		<h3>Developer Information</h3>

		<p><b>Developer:</b> Mayur Chauhan And Dhaval Patel</p>

		<p><b>Location:</b> Ahmedabad, Gujarat, India</p>

		<p><b>Contact:</b> +91-6354149463</p>

		<p><b>Email:</b> vsms1212@gmail.com</p>

		<p>© 2026 All Rights Reserved</p>

	</div>

</body>
</html>