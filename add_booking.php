<?php
include("config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Booking</title>
	
<style>

body{
    font-family:Arial;
    background:#f4f4f4;
    margin:20px;
}

.container{
    width:500px;
    margin:auto;
    background:white;
    padding:20px;
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
    text-decoration:none;
    border:none;
    border-radius:5px;
    color:white;
    cursor:pointer;
}

.save{
    background:#27ae60;
}

.save:hover{
    background:#219150;
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


<h2>Service Booking Form</h2>

<?php

if(isset($_POST['submit']))
{
    $customer_id = $_POST['customer_id'];
    $vehicle_id = $_POST['vehicle_id'];
    $service_type = $_POST['service_type'];
    $booking_date = $_POST['booking_date'];
    $problem = $_POST['problem'];

    $sql = "INSERT INTO bookings
    (customer_id, vehicle_id, service_type, booking_date, problem, status)
    VALUES
    ('$customer_id', '$vehicle_id', '$service_type', '$booking_date', '$problem', 'Pending')";

    $result = mysqli_query($conn, $sql);

    if($result)
    {
        echo "<script>alert('Booking Added Successfully');</script>";
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
}

?>

<form method="POST">

    
    <label>Customer</label><br>

	<select name="customer_id">

    <option value="">Select Customer</option>

    <?php
    $query = mysqli_query($conn, "SELECT * FROM customers");

    while($row = mysqli_fetch_assoc($query))
    {
    ?>

    <option value="<?php echo $row['customer_id']; ?>">
        <?php echo $row['full_name']; ?>
    </option>

    <?php
    }
    ?>
	</select>
	
	<br><br>

	<label>Vehicle</label><br>

	<select name="vehicle_id">

    <option value="">Select Vehicle</option>

    <?php
    $query = mysqli_query($conn, "SELECT * FROM vehicles");

    while($row = mysqli_fetch_assoc($query))
    {
    ?>

    <option value="<?php echo $row['vehicle_id']; ?>">
        <?php echo $row['vehicle_number']; ?>
    </option>

    <?php
    }
    ?>

	</select>

    <br><br>

    <label>Service Type</label><br>
    <input type="text" name="service_type">

    <br><br>

    <label>Booking Date</label><br>
    <input type="date" name="booking_date">

    <br><br>

    <label>Problem</label><br>
	<textarea name="problem" id="problem" required></textarea>

    <br><br>
	
	<div id="aiSuggestion"
		 style="margin-top:10px;
		 padding:10px;
		 background:#eef7ff;
		 border-left:5px solid #3498db;
		 display:none;">
	</div>
	
	<br><br>

    <input class="btn save" type="submit" name="submit" value="Book Service">

</form>

	<br><br>

<a class="btn back" href="dashboard.php">
	Back Dashboard
</a>

</div>

<script>

const problem = document.getElementById("problem");
const aiBox = document.getElementById("aiSuggestion");

problem.addEventListener("keyup", function(){

    let text = problem.value.toLowerCase();

    let suggestion = "";
	
	let cost = "";

    if(text.includes("engine"))
    {
        suggestion = "🤖 AI Suggestion:<br>✔ Engine Inspection<br>✔ Oil Check<br>✔ Engine Diagnostics";
		cost = "💰 Estimated Cost: ₹3,000 - ₹8,000";
    }
    else if(text.includes("brake"))
    {
        suggestion = "🤖 AI Suggestion:<br>✔ Brake Inspection<br>✔ Brake Oil Check<br>✔ Brake Pad Replacement";
		cost = "💰 Estimated Cost: ₹2,000 - ₹5,000";
    }
    else if(text.includes("battery"))
    {
        suggestion = "🤖 AI Suggestion:<br>✔ Battery Check<br>✔ Charging System Test";
		cost = "💰 Estimated Cost: ₹3,500 - ₹7,000";
    }
    else if(text.includes("tyre"))
    {
        suggestion = "🤖 AI Suggestion:<br>✔ Tyre Repair<br>✔ Wheel Alignment";
		cost = "💰 Estimated Cost: ₹500 - ₹2,500";
    }
    else if(text.includes("oil"))
    {
        suggestion = "🤖 AI Suggestion:<br>✔ Oil Change<br>✔ Oil Filter Replacement";
		cost = "💰 Estimated Cost: ₹800 - ₹1,500";
    }
    else
    {
        suggestion = "";
    }

    if(suggestion != "")
    {
        aiBox.style.display = "block";
        aiBox.innerHTML = suggestion + "<br><br>" + cost;
    }
    else
    {
        aiBox.style.display = "none";
    }

});

</script>

</body>
</html>