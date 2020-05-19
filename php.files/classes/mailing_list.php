<?php 

class mailing_list extends kas_framework {

	public $_Port 				= 25;
	public $_CharSet 			= 'utf-8';
	public $_Hostname 			= 'mail.supremecluster.com';
	public $_Username 			= 'info@kastechnet.com';
	public $_Password 			= 'kas_mail2016';
	//For portal attempted hacking reports
	public $_HackReportMail		= 'hackreport@kastechnet.com';

	public function SendUserConfirmationEmail($send_to_mail, $reg_user_name, $from_email, $confirmation_code, $schoolname, $user) {
		$mailer				 	= new PHPMailer();  //new instance of the mailer   
		$mailer->IsSMTP(); // telling the class to use SMTP
		$mailer->SMTPDebug  = 0;                     // enables SMTP debug information (for testing), // 1 = errors and messages, // 2 = messages only
		$mailer->SMTPAuth   = true;                  // enable SMTP authentication   
		$mailer->CharSet 	= 'utf-8';   
		$mailer->Host       = $this->_Hostname; // sets the SMTP server
		$mailer->Port       = $this->_Port;	               // set the SMTP port for the GMAIL server
		$mailer->Username   = $this->_Username; // SMTP account username
		$mailer->Password   = $this->_Password;        // SMTP account password           
        $mailer->AddAddress($send_to_mail, $reg_user_name);        
        $mailer->Subject 	 	= "Your Registration With ".$schoolname;
        $mailer->From 			= $from_email;
        $mailer->FromName 		= $schoolname;
        $mailer->AddReplyTo($from_email);
		
		if ($user == 'student') {  $confirm_url = $this->url_root('student/confirmreg?cid=').$confirmation_code; }
		else if ($user == 'staff') {  $confirm_url = $this->url_root('staff/confirmreg?cidp=').$confirmation_code; }
		else if ($user == 'parent') {  $confirm_url = $this->url_root('parent/confirmreg?cidp=').$confirmation_code; }
		
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
		$mailer				 	= new PHPMailer();  //new instance of the mailer   
		$mailer->IsSMTP(); // telling the class to use SMTP
		$mailer->SMTPDebug  = 0;                     // enables SMTP debug information (for testing), // 1 = errors and messages, // 2 = messages only
		$mailer->SMTPAuth   = true;                  // enable SMTP authentication   
		$mailer->CharSet 	 	= 'utf-8';   
		$mailer->Host       = $this->_Hostname; // sets the SMTP server
		$mailer->Port       = $this->_Port;	               // set the SMTP port for the GMAIL server
		$mailer->Username   = $this->_Username; // SMTP account username
		$mailer->Password   = $this->_Password;        // SMTP account password   
        $mailer->AddAddress($send_to_mail, $reg_user_name);
        $mailer->Subject 		= "Your reset password request at ".$schoolname;
		$mailer->FromName 		= $schoolname;
		$mailer->From		= $from_email;
        $mailer->AddReplyTo($from_email);  
       
		if ($user == 'student') {
			$reset_url = $this->url_root('student').'/resetpwd?email='.urlencode($send_to_mail).'&code='.urlencode($this->saltifyID($users_password));
		} else if ($user == 'parent') {
			$reset_url = $this->url_root('parent').'/resetpwd?email='.urlencode($send_to_mail).'&code='.urlencode($this->saltifyID($users_password));
		} else if ($user == 'staff') {
			$reset_url = $this->url_root('staff').'/resetpwd?email='.urlencode($send_to_mail).'&code='.urlencode($this->saltifyID($users_password));
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
        $mailer				 	= new PHPMailer();  //new instance of the mailer   
		$mailer->IsSMTP(); // telling the class to use SMTP
		$mailer->SMTPDebug  = 0;                     // enables SMTP debug information (for testing), // 1 = errors and messages, // 2 = messages only
		$mailer->SMTPAuth   = true;                  // enable SMTP authentication   
		$mailer->CharSet 	 	= 'utf-8';   
		$mailer->Host       = $this->_Hostname; // sets the SMTP server
		$mailer->Port       = $this->_Port;	               // set the SMTP port for the GMAIL server
		$mailer->Username   = $this->_Username; // SMTP account username
		$mailer->Password   = $this->_Password;        // SMTP account password   
        $mailer->AddAddress($this->_HackReportMail, 'Hacking-Report');
        $mailer->Subject 		= $schoolname. ": Hacking Auto Generated Report";
		$mailer->FromName 		= $schoolname;
		$mailer->From			= $schoolname;
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