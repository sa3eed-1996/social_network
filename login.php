<?php

if($_SERVER['REQUEST_METHOD']=='POST')
{
	
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "sn";

foreach($db as $key => $value){
    define(strtoupper($key),$value);
}

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	
	if($connection->connect_error){
		die("Connection Failed.");
	}
	
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql  = "SELECT password FROM users WHERE email = 'saiedabbar@gmail.com'";
	$hashedPassword = mysqli_query($connection,$sql);
	if(!$hashedPassword){
            die('QUERY FAILED' . mysqli_error($connection));
	}
	else
	{
			echo $hashedPassword;
		if($hashedPassword==$password)
		{
			echo 'test2';
			session_start();
			$_SESSION['email']=$email;
			header('location:home.php');
		}
		//else
		//	die('QUERY FAILED' . mysqli_error($connection));	
}
	//else
	//		die('QUERY FAILED' . mysqli_error($connection));
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