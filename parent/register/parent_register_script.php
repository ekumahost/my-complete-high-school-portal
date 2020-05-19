<?php
require ('../../php.files/classes/pdoDB.php');
require ('../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
require (constant('double_return').'php.files/classes/PHPMailer/PHPMailerAutoload.php');
require (constant('double_return').'php.files/classes/mailing_list.php');
extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($byepass)) {
	exit('File Is Classified');
}
 function reloadCaptcha() {
	print '<script type="text/javascript">$(\'#load_captcha\').load(\''.constant('double_return').'inc.files/ult_captcha.php\');</script>';
 }

//the general functions
if ($kas_framework->strIsEmpty($firstname) or $kas_framework->strIsEmpty($lastname) or $kas_framework->strIsEmpty($email) or $kas_framework->strIsEmpty($sex) or $kas_framework->strIsEmpty($contact_address) or $kas_framework->strIsEmpty($mobile_no) or $kas_framework->strIsEmpty($web_parents_username) or $kas_framework->strIsEmpty($password1) or $kas_framework->strIsEmpty($password2)) {
	$kas_framework->showDangerCallout('One or More Fields Empty');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
	
} /* else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
	$kas_framework->showDangerCallout('You didnt yield Warning. Email is Wrong');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
	
} */  else if ($kas_framework->check_username_from_all($web_parents_username) == true) {
	$kas_framework->showDangerCallout('You didnt yield Warning. Username already taken');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
	
} else if (strcmp($password1, $password2) != 0) {
	$kas_framework->showDangerCallout('Passwords do not Match !!!');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
		
} else if ($captcha_answer_raw != $captcha_answer) {
	$kas_framework->showDangerCallout('Captcha is Incorrect. Please try Again!');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
	
}  else {
	$dbh->beginTransaction();
	
	$confirmation_code = $kas_framework->generateRandomString(); /* default value is 10*/
	
	$insert_into_student_parents = "INSERT INTO student_parents 
		(student_parents_firstname, student_parents_lastname, student_parents_email, student_parents_sex, student_parents_contactaddress1, student_parents_mobile1) VALUES 
		(:firstname, :lastname, :email, '".$sex."', :contact_address, :mobile_no)";
			$db_insert_into_student_parents = $dbh->prepare($insert_into_student_parents);
			$db_insert_into_student_parents->bindParam(':firstname', $firstname); $db_insert_into_student_parents->bindParam(':lastname', $lastname); $db_insert_into_student_parents->bindParam(':email', $email);
			$db_insert_into_student_parents->bindParam(':contact_address', $contact_address); $db_insert_into_student_parents->bindParam(':mobile_no', $mobile_no);
			$db_insert_into_student_parents->execute();
			$get_insert_into_student_parents_rows = $db_insert_into_student_parents->rowCount();
			$db_insert_into_student_parents = null;
	
	$insert_id_default = $dbh->lastInsertId();
	if ($get_insert_into_student_parents_rows == 0) {
	 	$kas_framework->buttonController('#signup', 'enable');
	 exit($kas_framework->showDangerCallout('Could not Create Parent details account <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
	}
	
	$insert_into_web_parents = "INSERT INTO web_parents (web_parents_type, web_parents_relid, web_parents_username, web_parents_password, web_parents_flname, web_parents_active, online) 
		VALUES ('C', '".$insert_id_default."', :web_parents_username, '".md5($password1)."', :firstname, '".$confirmation_code."', '0')";
		$db_insert_into_web_parents = $dbh->prepare($insert_into_web_parents);
		$db_insert_into_web_parents->bindParam(':web_parents_username', $web_parents_username); $db_insert_into_web_parents->bindParam(':firstname', $firstname);
		$db_insert_into_web_parents->execute();
		$get_insert_into_web_parents_rows = $db_insert_into_web_parents->rowCount();
		$db_insert_into_web_parents = null;
	if ($get_insert_into_web_parents_rows == 0) {
		$kas_framework->buttonController('#signup', 'enable');
		exit($kas_framework->showDangerCallout('Could not Create Login account <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
	}
	 
	 //the mailing sequence.
	$school_mail = $kas_framework->getValue('email', 'tbl_school_profile', 'id', '1');
	$send_mail = $mailing_list->SendUserConfirmationEmail($email, $web_parents_username, $school_mail, $confirmation_code, $kas_framework->returnUserSchool(''), 'parent');
	if ($send_mail == false) {
	  	$kas_framework->buttonController('#signup', 'enable');
	  exit($kas_framework->showDangerCallout('Could not send mail <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
	 }
	
	if ($get_insert_into_student_parents_rows > 0 and $get_insert_into_web_parents_rows > 0 and ($send_mail == true)) {
	//at this point, we try commit
		$dbh->commit();
		$kas_framework->showsuccesswithGreen('Sign Up Successful. Please Complete your Profile...');
		$_SESSION['tapp_par_username'] = $web_parents_username;
		/* redirect to the complete profile panel*/
		print '<script type="text/javascript"> self.location = "'.$kas_framework->url_root('parent/dashpanel/profile/editprofile?complete').'" </script>';
		$kas_framework->buttonController('#signup', 'enable');
		
	} else {
		$dbh->rollBack();
		$kas_framework->buttonController('#signup', 'enable');	
	}	
}

?>