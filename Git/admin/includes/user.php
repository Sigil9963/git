<?php 
function createUser($fname, $lname, $username, $password, $level){
	//echo "From user.php";
	include("connect.php");
	$fname  = mysqli_real_escape_string($link, $fname);
	$lname  = mysqli_real_escape_string($link, $lname);
	$username  = mysqli_real_escape_string($link, $username);
	$password  = mysqli_real_escape_string($link, $password);
	
	$ip = 0;
	$userstring = "INSERT INTO tbl_user VALUES(NULL, '{$fname}', '{$lname}', '{$username}', '{$password}', '{$level}', '{$ip}')";
	echo $userstring;	
	$userquery = mysqli_query($link, $userstring);
	if($userquery){
		redirect_to("admin_index.php");
	}else{
		$message = "There was an problem creating the user, please try again later.";
		return $message;
	}
	mysqli_close($link);
	
}
?>