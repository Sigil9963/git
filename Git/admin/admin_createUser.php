<?php
	require_once('includes\init.php');
	//confirm_logged_in()
	
	if(isset($_POST['submit'])){	
		
		//echo "it werks";
		$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		$username = trim($_POST['username']);
		$email = ($_POST['email']);
		$level = $_POST['lvllist'];
		//echo $fname, $lname, $username, $password, $level;
		
		//Generate password. Password is 10 characters from $possibleChars.
		$length = 10;
		$possibleChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $password = '';
		//For loop to scramble chars.
        for($i = 0; $i < $length; $i++) {
            $rand = rand(0, strlen($possibleChars) - 1);
            $password .= substr($possibleChars, $rand, 1);
        }

		if(empty($level)){
			//echo "No User Level";
			$message = "Please select a user level";
			$autofname = $fname;
			$autolname = $lname;
			$autoname = $username;
			$autopass = $password;
			$automail = $email;
		}
		else{
		//echo "Form filled out.";
		//Creates user, sends email to user's email address containing credentials and where to login.
		$result = createUser($fname, $lname, $username, $password, $level);
		$sendMail = submitMessage($name, $email, $message);
		$message = "Your username is "+$username+", your password is "+$password+". Please log-in <a href='admin_login.php'>here.</a>";
		}
		
	}
?>	

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Create User</title>
</head>
<h2>Create User</h2>
<?php if(!empty($message)){echo $message;}?>
<form action="admin_createUser.php" method="post">
        <label>User's First Name:</label><br>
       <input type="text" name="fname" value="<?php if(!empty($autofname)){echo $autofname;} ?>"><br><br>
       <label>User's Last Name:</label><br>
       <input type="text" name="lname" value="<?php if(!empty($autolname)){echo $autolname;} ?>"><br><br>
        <label>Create User's Username:</label><br>
       <input type="text" name="username" value="<?php if(!empty($autoname)){echo $autoname;} ?>"><br><br>
       <label>Create User's Password:</label><br>
       <input type="text" name="password" value="<?php if(!empty($autopass)){echo $autopass;} ?>"><br><br>
       <label>Input User Email:</label><br>
       <input type="email" name="email" value="<?php if(!empty($automail)){echo $automail;} ?>"><br><br>
       <label>Set User's Level:</label><br>
       <select name="lvllist">
            <option value="">Please Select User Level...</option>
             <option value="2">Web Admin</option>
           <option value="1">Web Master</option>
       </select>
       <br><br>
       <input type="submit" name="submit" value="Create User"><br><br>

</form>
<a href="admin_index.php">back</a>


<body>
</body>
</html>