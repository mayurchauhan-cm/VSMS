<?php
include("config.php");

if(!isset($_GET['id']))
{
    die("Invalid Booking ID");
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM bookings WHERE booking_id='$id'");

$row = mysqli_fetch_assoc($query);


if(isset($_POST['update']))
{
    $service_type = $_POST['service_type'];
    $booking_date = $_POST['booking_date'];
    $problem = $_POST['problem'];
    $status = $_POST['status'];

    $update = mysqli_query($conn,"UPDATE bookings SET

    service_type='$service_type',
    booking_date='$booking_date',
    problem='$problem',
    status='$status'

    WHERE booking_id='$id'");

    if($update)
    {
        echo "<script>alert('Booking Updated Successfully');</script>";
        echo "<script>window.location='booking_list.php';</script>";
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
    <title>Edit Booking</title>
	
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
input[type=date],
select,
textarea{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
    box-sizing:border-box;
}

textarea{
    height:100px;
    resize:none;
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

<h2>Edit Booking</h2>

<form method="POST">

    <label>Service Type</label><br>
    <input type="text" name="service_type"
           value="<?php echo $row['service_type']; ?>">

    <br><br>

    <label>Booking Date</label><br>
    <input type="date" name="booking_date"
           value="<?php echo $row['booking_date']; ?>">

    <br><br>

    <label>Problem</label><br>
    <textarea name="problem"><?php echo $row['problem']; ?></textarea>

    <br><br>

    <label>Status</label><br>

   <select name="status">

	<option value="Pending"
	<?php if($row['status']=="Pending") echo "selected"; ?>>
	Pending
	</option>

	<option value="In Progress"
	<?php if($row['status']=="In Progress") echo "selected"; ?>>
	In Progress
	</option>

	<option value="Completed"
	<?php if($row['status']=="Completed") echo "selected"; ?>>
	Completed
	</option>

	</select>

    <br><br>

		<input class="btn update" type="submit" name="update" value="Update Booking">
		
		<br><br>

		<a class="btn back" href="booking_list.php">
			Back Bookings
		</a>
</form>
</div>
</body>
</html>