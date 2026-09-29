<?php
	session_start();

	$conn = mysqli_connect("localhost", "root", "", "vsms");

	if(!$conn)
{
    die("Connection Failed");
}
?> 

<!DOCTYPE html>
<html>
	<head>
		<title>Customer Login</title>
		
		<style>

body{
    margin:0;
    font-family:Arial;
    background:#f4f4f4;
}

.login-box{
    width:380px;
    margin:80px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 15px #ccc;
}

h2{
    text-align:center;
    color:#2c3e50;
    margin-bottom:25px;
}

label{
    font-weight:bold;
}

input[type=email],
input[type=password]{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
    box-sizing:border-box;
}

input[type=submit]{
    width:100%;
    padding:12px;
    background:#3498db;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-size:16px;
}

input[type=submit]:hover{
    background:#2980b9;
}

.footer{
    text-align:center;
    margin-top:20px;
    color:#555;
    font-size:14px;
}

</style>
		
	</head>
	
	<body>
		<div class="login-box">
		
		<h2>Vehicle Service Management System</>

		<h3 style="text-align:center;color:#666;">
			Customer Login
		</h3>
		
		<form method="post">
		
			<br>

			<p>
				New Customer?
			<a href="register.php">Register Here</a>
			</p>
			
			<label>Email:</label>
			<input type="email" name="email" required>
			<br><br>
			
			<label>Password:</label>
			<input type="password" name="password" required>
			<br><br>
			
			<input type="submit" name="login" value="Login">
			
		</form>
		
		<?php
			if(isset($_POST['login']))
			{
				$email = $_POST['email'];
				$password = $_POST['password'];
				
				$query = "SELECT * FROM customers WHERE email='$email' AND password='$password'";
				
				$result = mysqli_query($conn, $query);
				
				if(mysqli_num_rows($result) > 0)
				{
					$_SESSION['email'] = $email;
					
					header("Location: dashboard.php");
					exit();  
				}
				else
				{
					echo "<p style='color:red;text-align:center;'>
						  Invalid Email or Password
						 </p>";
				}
			}
			
		?>
		
		<div class="footer">
			Vehicle Service Management System<br>
			Developed by Mayur Chauhan
		</div>

	</div>
		
	</body>
</html>