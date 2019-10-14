<?php
require ('../../php.files/classes/pdoDB.php');
require ('../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
require (constant('double_return').'php.files/classes/generalVariables.php');
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
if ($kas_framework->strIsEmpty($firstname) or $kas_framework->strIsEmpty($lastname) or $kas_framework->strIsEmpty($email) or $kas_framework->strIsEmpty($sex) or $kas_framework->strIsEmpty($contact_address) or $kas_framework->strIsEmpty($staff_type) or $kas_framework->strIsEmpty($mobile_no) or $kas_framework->strIsEmpty($web_users_username) or $kas_framework->strIsEmpty($password1) or $kas_framework->strIsEmpty($password2)) {
	$kas_framework->showDangerCallout('One or More Fields Empty');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
	
} /* else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
	$kas_framework->showDangerCallout('You didnt yield Warning. Email is Wrong');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
	
}*/ else if ($kas_framework->check_username_from_all($web_users_username) == true) {
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
	
	//$insert_into_staff = "INSERT INTO staff (staff_fname, staff_lname, staff_email, staff_sex, staff_adress, staff_mobile, staff_entry_year) VALUES (:firstname, :lastname', :email, '".$sex."', :contact_address, :mobile_no, '".$current_year_id.")";
	$insert_into_staff = "INSERT INTO staff (staff_fname, staff_lname, staff_email, staff_sex, staff_adress, staff_mobile, staff_entry_year) VALUES (:firstname, :lastname, :email, '".$sex."', :contact_address, :mobile_no, '".$current_year_id."')";

	$db_insert_into_staff = $dbh->prepare($insert_into_staff);
	$db_insert_into_staff->bindParam(':firstname', $firstname);
	$db_insert_into_staff->bindParam(':lastname', $lastname);
	$db_insert_into_staff->bindParam(':email', $email);
	$db_insert_into_staff->bindParam(':contact_address', $contact_address);
	$db_insert_into_staff->bindParam(':mobile_no', $mobile_no);
	$db_insert_into_staff->execute();
	$get_insert_into_staff_rows = $db_insert_into_staff->rowCount();
	//$db_insert_into_staff = null;
	
	//$insert_id_default = $db_insert_into_staff->lastInsertId();
	$insert_id_default = $dbh->lastInsertId();
	if ($get_insert_into_staff_rows == 0) {
		$kas_framework->buttonController('#signup', 'enable'); 
		//print mysql_error();
	 exit($kas_framework->showDangerCallout('Could not Create Staff details account <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
	}
	
	$insert_into_web_users = "INSERT INTO web_users (web_users_type, web_users_relid, web_users_username, web_users_password, web_users_flname, web_users_active, online) 
	VALUES('".$staff_type."', '".$insert_id_default."', :web_users_username, '".md5($password1)."', :firstname, '".$confirmation_code."', '0')";

	$db_insert_into_web_users = $dbh->prepare($insert_into_web_users);
    $db_insert_into_web_users->bindParam(':web_users_username', $web_users_username);
    $db_insert_into_web_users->bindParam(':firstname', $firstname);
	$db_insert_into_web_users->execute();
	$get_insert_into_web_users_rows = $db_insert_into_web_users->rowCount();
	//$paramObj = $db_insert_into_web_users->fetch(PDO::FETCH_OBJ);
	//$db_insert_into_web_users = null;

	if (!$insert_into_web_users) {
		$kas_framework->buttonController('#signup', 'enable');
	  exit($kas_framework->showDangerCallout('Could not Create Login account <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
	}
	 
	$insert_into_staff_role = "INSERT INTO staff_role (staff_id) VALUES ('$insert_id_default')";
	$db_insert_into_staff_role = $dbh->prepare($insert_into_staff_role);
	$db_insert_into_staff_role->execute();
	$get_db_insert_into_staff_role_rows = $db_insert_into_staff_role->rowCount();
	//$db_insert_into_staff_role = null;

	if ($get_db_insert_into_staff_role_rows == 0) {
		$kas_framework->buttonController('#signup', 'enable');
	  exit($kas_framework->showDangerCallout('Could not Create Staff Role <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
	}
	
	/* inseertin into the user teacher_grade_year table for the teachers only */
	
	if ($staff_type == 'T') {
		$insert_into_tea_grade_year = "INSERT INTO teacher_grade_year (teacher, session) VALUES ('".$insert_id_default."', '".$current_year_id."')";
		$db_insert_into_tea_grade_year = $dbh->prepare($insert_into_tea_grade_year);
		$db_insert_into_tea_grade_year->execute();
		$get_db_insert_into_tea_grade_year_rows = $db_insert_into_tea_grade_year->rowCount();
		
		if ($get_db_insert_into_tea_grade_year_rows == 0) {
			$kas_framework->buttonController('#signup', 'enable');
		  exit($kas_framework->showDangerCallout('Could not Create Staff Context <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
		}
	}
		
	//the mailing sequence.
	 $school_mail = $kas_framework->getValue('email', 'tbl_school_profile', 'id', '1');
	$send_mail = $mailing_list->SendUserConfirmationEmail($email, $web_users_username, $school_mail, $confirmation_code, $kas_framework->returnUserSchool(''), 'staff');
	if ($send_mail == false) {
		$kas_framework->buttonController('#signup', 'enable');
	  exit($kas_framework->showDangerCallout('Could not Send Mail <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
	 }
	
	if ($get_db_insert_into_tea_grade_year_rows > 0 and $get_db_insert_into_staff_role_rows > 0 and $get_insert_into_web_users_rows > 0 and ($send_mail == true)) {
	//at this point, we try commit
		$dbh->commit();
		$kas_framework->showsuccesswithGreen('Sign Up Successful. Please Complete your Profile now... Loading...');
		$_SESSION['tapp_staff_username'] = $web_users_username;
		// redirect to the complete profile panel 
		print '<script type="text/javascript"> self.location = "'.$kas_framework->server_root_dir('staff/dashpanel/profile/editprofile?uploadpicx').'" </script>';
		$kas_framework->buttonController('#signup', 'disable');
		
	} else {
		$dbh->rollBack();
		$kas_framework->buttonController('#signup', 'enable');	
	}	
}

