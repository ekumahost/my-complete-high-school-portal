<?php 

class mailing_list extends kas_framework {

	public function SMTPAuthentication() { 
		$mail             = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPDebug  = 2;                     // // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Host       = "mail.kashost.com"; // sets the SMTP server
		$mail->Port       = 25;	               // set the SMTP port for the GMAIL server
		$mail->Username   = "info@kastechnet.com"; // SMTP account username
		$mail->Password   = "kas_mail2016";        // SMTP account password
	}

	public function SendUserConfirmationEmail($send_to_mail, $reg_user_name, $from_email, $confirmation_code, $schoolname, $user) {
		$this->SMTPAuthentication(); // run the authentication for the SMTP;
	    $mailer				 	= new PHPMailer();  //new instance of the mailer      
        $mailer->CharSet 	 	= 'utf-8';        
        $mailer->AddAddress($send_to_mail, $reg_user_name);        
        $mailer->Subject 	 	= "Your Registration With ".$schoolname;
        $mailer->From 			= $from_email;
        $mailer->FromName 		= $schoolname;
        $mailer->AddReplyTo($from_email);
		
		if ($user == 'student') {  $confirm_url = $this->server_root_dir('student/confirmreg?cid=').$confirmation_code; }
		else if ($user == 'staff') {  $confirm_url = $this->server_root_dir('staff/confirmreg?cidp=').$confirmation_code; }
		else if ($user == 'parent') {  $confirm_url = $this->server_root_dir('parent/confirmreg?cidp=').$confirmation_code; }
		
        $messageBody 					= "Hello ".$reg_user_name.". <br /> 
		Thanks for your registration with ".$schoolname.". <br />
		Please click the link below to confirm your registration. <br /><br /><a href='".$confirm_url."'>Confirmation Link</a>.<br />
		Or use the confirmation code (".$confirmation_code.") on the portal<br /><br />
        Regards.<br />". $schoolname;
		
		$mailer->MsgHTML($messageBody); // encoding the message body with html
		
        if(!$mailer->Send())   {
            return false;
		} else { return true; }
    }
	
	public function SendResetPasswordLink_viaEmail($send_to_mail, $reg_user_name, $users_password, $schoolname, $from_email, $user)  {      
        $this->SMTPAuthentication(); // run the authentication for the SMTP;
		$mailer 				= new PHPMailer();         
        $mailer->CharSet 		= 'utf-8';
        $mailer->AddAddress($send_to_mail, $reg_user_name);
        $mailer->Subject 		= "Your reset password request at ".$schoolname;
		$mailer->FromName 		= $schoolname;
		$mailer->From		= $from_email;
        $mailer->AddReplyTo($from_email);  
       
		if ($user == 'student') {
			$reset_url = $this->server_root_dir('student').'/resetpwd?email='.urlencode($send_to_mail).'&code='.urlencode($this->saltifyID($users_password));
		} else if ($user == 'parent') {
			$reset_url = $this->server_root_dir('parent').'/resetpwd?email='.urlencode($send_to_mail).'&code='.urlencode($this->saltifyID($users_password));
		} else if ($user == 'staff') {
			$reset_url = $this->server_root_dir('staff').'/resetpwd?email='.urlencode($send_to_mail).'&code='.urlencode($this->saltifyID($users_password));
		}
		
      $messageBody 					= "Hello ".$reg_user_name.".<br /> 
        There was a request to reset your password at ".$schoolname.".<br /> 
        Please click the link below to complete the request. <br /> <a href='".$reset_url."'>Reset Password Link </a><br /> 
        <br />Regards.<br />". $schoolname;
        
		$mailer->MsgHTML($messageBody); // encoding the message body with html
		
        if(!$mailer->Send()) {
            return false;
        } else {
			return true;
		}
    }
	//end of class
	
	public function mailHackingReport($schoolname, $messageBody)  {      
        $this->SMTPAuthentication(); // run the authentication for the SMTP;
		$mailer 				= new PHPMailer();         
        $mailer->CharSet 		= 'utf-8';
        $mailer->AddAddress('hackreport@hypertera.ng', 'Hacking-Report');
        $mailer->Subject 		= $schoolname. ": Hacking Auto Generated Report";
		$mailer->FromName 		= $schoolname;
		$mailer->From			=  $schoolname;
        $mailer->AddReplyTo($schoolname); 
        
		$mailer->MsgHTML($messageBody); // encoding the message body with html
		
        if(!$mailer->Send()) {
            return false;
        } else {
			return true;
		}
    }
	//end of class

}
$mailing_list = new mailing_list;

?>