<?php
	//echo "From Login"
	function login($username, $password, $ip, $date){
		require_once('connect.php');
		
		$username = mysqli_real_escape_string($link, $username);
		$password = mysqli_real_escape_string($link, $password);		
		
		$loginstring = "SELECT * FROM tbl_user WHERE user_name ='{$username}' AND user_pass = '{$password}'";
		//echo $loginstring;
		$user_set = mysqli_query($link, $loginstring);
		
		if(mysqli_num_rows($user_set)){
			
			//Declare session variables to pass info between pages
			$found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
			$id = $found_user['user_id'];
			$_SESSION['user_id'] = $id;
			$_SESSION['user_name'] = $found_user['user_name'];
			$_SESSION['user_lastdate'] = $date;
			
			$attempts = $found_user['user_attempts'];
			$_SESSION['user_attempts'] = $attempts;
			
			//echo $attempts;
			//echo $id;
			
			if(mysqli_query($link, $loginstring)){
				//Update the values of the ip and date for the account with a matching id, reset login attempts.
				$updatestring = "UPDATE tbl_user SET user_ip='($ip)', user_lastdate='($date)', user_attempts=0 WHERE user_id=($id)";
				$updatequery = mysqli_query($link, $updatestring);
				//echo $updatestring;
			}
			redirect_to("admin_index.php");
		}else{
			//If no attempts remain, then return to index.
			if($attempts = 3){
				$message = "Too many failed attempts. Account locked.";	
				return $message;
				redirect_to("../index.php");
			//else incrememnt attempt count and display fail message			
			}else{
				"UPDATE tbl_user SET user_attempts=(user_attempts+1)";
				$message = "Username or Password incorrect. Please try again. You have $attempts attempt(s) remaining.";	
				return $message;
				
			}
			
		}
	}
?>
