<?php
	require_once('includes/init.php');
	$ip = $_SERVER["REMOTE_ADDR"];
	$date = date('F d Y\, h:i:s A');	
	//echo $ip;
	
	if(isset($_POST['submit'])) {
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);		
		//echo $username, $password;
		if($username !="" && $password !=""){
			$result = login($username, $password, $ip, $date);
			$message = $result;
		}else{
			$message = "Please fill out all fields.";
		}
	}
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Welcome Company Name</title>
</head>
<body>
Content Management<br><br>
<?php if(!empty($message)){echo $message;} ?>
<form action="admin_login.php" method="post">
	<label>username:</label> 
	<input type="text" name="username" value="">
	<br>
	<label>password:</label>
	<input type="password" name="password" value="">
	<input type="submit" name="submit" value="go">
</form>
</body>
</html>
