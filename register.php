<?php 
$username=$email=$password=$gender='';
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
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$gender = $_POST['gender'];
	function checkName($name)
	{
		$name = filter_var($name,FILTER_SANITIZE_STRING);
		$pattern = '/[^a-zA-Z0-9 _]/';
		if(preg_match($pattern,$name))
		{return false;}
	return true;
	}
	$var1=$var2=$var3=true;
	$var1=checkName($username);
	$var2=checkName($gender);
	$var3=checkName($password);
	filter_var($email,FILTER_VALIDATE_EMAIL);
	if($var1&&$var2&&$var3)
	{
		$hashedpassword = password_hash($password,PASSWORD_DEFAULT);
		$qu="insert into users(username, email, password, gender)";
		$qu .=" values('{$username}', '{$email}', '{$hashedpassword}', '{$gender}')";
		$add_user = mysqli_query($connection,$qu);
		
		if(!$add_user)
			die('QUERY FAILED' . mysqli_error($connection));
	}
	
}
	?>

<html>
<link rel="stylesheet" href="bootstrap.css">
<head>
	<title>Registration</title>
</head>
<body>
	<form method="POST" action="register.php">
		<p>Username</p>
		<input type = "text" value ="" name = "username">
		<p>Email</p>
		<input type = "text" value ="" name = "email">
		<p>Password</p>
		<input type = "password" value ="" name = "password">
		<p>Gender</p>
		<label>Male</label>
		<input type="radio" value = "male" name = "gender">
		<label>Female</label>
		<input type="radio" value = "female" name = "gender">
		<br>
		<input type="submit">
	</form>


</body>
</html>