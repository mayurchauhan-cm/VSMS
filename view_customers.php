<?php
	session_start();

	if(!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}

	$conn = mysqli_connect("localhost", "root", "", "vsms");

	if(!$conn)
{
    die("Connection Failed");
}

		if(isset($_GET['search']))
	{
		$search = $_GET['search'];

		$query = "SELECT * FROM customers
              WHERE full_name LIKE '%$search%'
              OR email LIKE '%$search%'
              OR mobile LIKE '%$search%'";
	}
		else
	{
		$query = "SELECT * FROM customers";
	}

		$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>View Customers</title>
		
<style>

body{
    margin:0;
    font-family:Arial, sans-serif;

    background-image:
    linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)),
    url("images/ok2.jpg");

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    background-attachment:fixed;
}

.container{
    width:90%;
    margin:40px auto;
    background:rgba(255,255,255,0.95);
    padding:25px;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.4);
}

h2{
    text-align:center;
    color:#2c3e50;
    margin-bottom:25px;
}

.search-box{
    text-align:center;
    margin-bottom:20px;
}

.search-box input[type=text]{
    width:300px;
    padding:10px;
    border:1px solid #ccc;
    border-radius:5px;
}

.search-box input[type=submit]{
    padding:10px 18px;
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
    text-decoration:none;
    color:white;
    margin:2px;
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

</style>
		
	</head>
	
	<body>
		<h2>Customers List</h2>
		
	<div class="search-box">
	<form method="GET">

		<input type="text" name="search" placeholder="Search Customer">

		<input type="submit" value="Search">

	</form>
	</div>

		<br>
		
		<table border="1" cellpadding="10">
			<tr>
				<th>Customer ID</th>
				<th>Full Name</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Action</th>
			</tr>
			
			<?php
					while($row = mysqli_fetch_assoc($result))
		{
			?>
			<tr>
				<td><?php echo $row['customer_id']; ?></td>

				<td><?php echo $row['full_name']; ?></td>

				<td><?php echo $row['email']; ?></td>

				<td><?php echo $row['mobile']; ?></td>
				
				<td>

					<a class="btn edit"
					   href="edit_customer.php?id=<?php echo $row['customer_id']; ?>">
					   Edit
					</a>

					<a class="btn delete"
					   href="delete_customer.php?id=<?php echo $row['customer_id']; ?>"
					   onclick="return confirm('Are you sure you want to delete this customer?');">
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
