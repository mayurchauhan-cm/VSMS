<?php
	include("config.php");

	if (isset($_POST['register'])) {

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
	
	$confirm_password = $_POST['confirm_password'];

	if($password != $confirm_password)
{
    echo "<script>alert('Passwords do not match');</script>";
    exit();
}

    $sql = "INSERT INTO customers (full_name, email, mobile, password)
            VALUES ('$full_name', '$email', '$mobile', '$password')";

    if(mysqli_query($conn, $sql))
{
    echo "<script>
            alert('Registration Successful');
            window.location='login.php';
          </script>";
}
     else {
        echo "Error : " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Customer Registration</title>
		
		<style>

body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#f4f4f4;
}

.container{
    width:420px;
    margin:50px auto;
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

input{
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
    background:#3498db;
    color:white;
    border:none;
    padding:12px;
    font-size:16px;
    border-radius:5px;
    cursor:pointer;
}

.btn:hover{
    background:#2980b9;
}

.login-link{
    text-align:center;
    margin-top:20px;
}

.login-link a{
    text-decoration:none;
    color:#3498db;
    font-weight:bold;
}

.login-link a:hover{
    color:#2c3e50;
}

</style>
		
	</head>
	
	<body>

<div class="container">

    <h2>Customer Registration</h2>

    <form action="" method="POST">

        <label>Full Name</label>
        <input type="text" name="full_name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Mobile</label>
        <input type="text" name="mobile" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Confirm Password</label>
        <input type="password" name="confirm_password" required>

        <input class="btn" type="submit" name="register" value="Register">

    </form>

    <div class="login-link">

        Already have an account?

        <a href="login.php">Login Here</a>

    </div>

</div>

</body>
</html>