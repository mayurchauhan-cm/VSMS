<?php
	$conn = mysqli_connect("localhost", "root", "", "vsms");
	
	if(!$conn)
	{
		die("Connection Failed");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Customer List</title>
		<style>
			body
			{
				font-family:Arial;
				background:#f4f4f4;
			}
			table
			{
				width:90%;
				margin:auto;
				border-collapse:collapse;
				background:white;
			}
			th,td
			{
				border:1px solid black;
				padding:10px;
				text-align:center;
			}
			th
			{
				background:#007bff;
				color:white;
			}
			h2
			{
				text-align:center;
			}
		</style>
	</head>
	
	<body>
		<h2>Customer List</h2>
		
		<table>
			<tr>
				<th>Customer ID</th>
				<th>Full Name</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Action</th>
				<th>Action</th>
			</th>
			
			<?php
				$sql = "SELECT * FROM customers";
				
				$result = mysqli_query($conn,$sql);
				
				while($row = mysqli_fetch_assoc($result))
				{
			?>
			
			<tr>
				<td><?php echo $row['customer_id'];?></td>
				<td><?php echo $row['full_name'];?></td>
				<td><?php echo $row['email'];?></td>
				<td><?php echo $row['mobile'];?></td>
				<td>
					<a href="edit_customer.php?id=<?php echo $row['customer_id'];?>">
						Edit
					</a>
				</td>
				<td>
					<a href="edit_customer.php?id=<?php echo $row['customer_id']; ?>"></a> 

					<a href="delete_customer.php?id=<?php echo $row['customer_id']; ?>"
					   onclick="return confirm('Are you sure you want to delete this customer?');">
					   Delete
					</a>
				</td>
			</tr>
			
			<?php
				}
				?>
		</table>
	</body>
</html>