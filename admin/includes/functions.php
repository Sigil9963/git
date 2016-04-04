<?php
	function redirect_to($location) {
		if($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}
	
	function submitMessage($name, $email, $message) {
			$to = $email;
			$subj = "Message From Customer submitted via site.com";
			$extra = $email."\r\nReply-To: ".$email."\r\n";			
			$msg = "Name: ".$name."\n\nEmail address: ".$email."\n\nComments: ".$message;
			$go = mail($to,$subj,$message,$extra);			
			
	}
?>