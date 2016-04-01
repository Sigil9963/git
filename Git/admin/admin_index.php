<?php
	require_once('includes\init.php');
	confirm_logged_in();
	
	//Compare login time to determine greeting
	//Morning
	if((time() >= strtotime("04:00:00")) && (time() < strtotime("12:00:00"))){
		$greeting = "Good morning ";
	
	//Afternoon
	}elseif((time() >= strtotime("12:00:00")) && (time() < strtotime("20:00:00"))){
		$greeting = "Good afternoon ";
	
	//Night
	}else{
		$greeting = "Good evening ";
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome to your CMS</title>
</head>

<body>
<h2><?php echo $greeting; echo $_SESSION['user_name']?>, welcome to your CMS.</h2>
<p>It is currently <?php echo date('F d Y\, h:i:s A')?>.</p>
<p>Your last login time was at <?php echo $_SESSION['user_lastdate']?>.</p>

<a href="admin_createUser.php">Create User</a>
<a href="admin_editUser.php">Edit My Account</a>
<a href="admin_deleteUser.php">Delete User</a>
<a href="admin_addMovie.php">Add Movie</a>
<a href="includes/caller.php?caller_id=logout">Sign Out</a>

</body>
</html>
