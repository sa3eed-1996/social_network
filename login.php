<?php

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$pdo = new PDO('mysql:host=localhost;dbname=sn','root','');
	if($pdo ===false)
		 die ("connection failed");
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sql = "select password from users where email = ?";
	$stmt=$pdo->prepare($sql);
	$stmt->execute(array($email));
	if($hashedPassword = $stmt->fetchColumn())
	{
	   if(password_verify($password,$hashedPassword))
	   {
		   session_start();
		   $_SESSION['email']=$email;
		   header('Location:home.php');
	   }
	   else
	   {
		   echo "email and password does not match";
	   }
	}
	else
	{
	}
}

?>


<html>
<link rel="stylesheet" href="bootstrap.css">
<head>
	<title>login</title>
</head>
<body>
	<div class="container">
	<div class="row">
	
	<form method="POST" action="login.php">
		<div class="form-group">
		<p>Email</p>
		<input class="form-control" type = "email" value ="" name = "email" required>
		</div>
		<div class="form-group">
		<p>Password</p>
		<input class="form-control" type = "password" value ="" name = "password" required>
		</div>
		<input class="btn btn-primary" value="login" type="submit">
        <a href="register.php" class="btn btn-success">Register</a>
	</form>
	</div>
</div>

</body>
</html>