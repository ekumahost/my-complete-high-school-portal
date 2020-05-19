<?php
require ('../../php.files/classes/pdoDB.php');
require ('../../php.files/classes/kas-framework.php');
require (constant('double_return').'php.files/classes/generalVariables.php');
require (constant('double_return').'php.files/classes/PHPMailer/PHPMailerAutoload.php');
require (constant('double_return').'php.files/classes/mailing_list.php');

$kas_framework->safesession();
$kas_framework->buttonController('#signup', 'enable');
extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($byepass)) {
	exit('File Is Classified');
}

//class for the pin and the serial
class check_pin_and_serial extends kas_framework {
	public function validate_pin_and_serial($pin, $serial) {
		global $dbh;
		$querySQL = "SELECT * FROM reg_pins_old WHERE codec = ? AND sn = ? AND status = '0' LIMIT 1";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute([$pin, $serial]);
		$get_rows = $db_handle->rowCount();
		$db_handle = null;		
		return ($get_rows == '1')? true: false;
	}
}
	
	function reloadCaptcha() {
		print '<script type="text/javascript">$(\'#load_captcha\').load(\''.constant('double_return').'inc.files/ult_captcha.php\');</script>';
	}
$check_pin_and_serial = new check_pin_and_serial;

//the general functions
if ($kas_framework->strIsEmpty($surname) or $kas_framework->strIsEmpty($lastname) or $kas_framework->strIsEmpty($email) or $kas_framework->strIsEmpty($sex) or $kas_framework->strIsEmpty($pin) or $kas_framework->strIsEmpty($entry_class) or $kas_framework->strIsEmpty($pinserial) or $kas_framework->strIsEmpty($user_username) or $kas_framework->strIsEmpty($password1) or $kas_framework->strIsEmpty($password2)) {
	$kas_framework->showDangerCallout('One or More Fields Empty');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
	
 } /*else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
	$kas_framework->showDangerCallout('Email Adress "'.$email.'" is Wrong. Try Again');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
	
}*/ else if ($kas_framework->check_username_from_all($user_username) == true) {
	$kas_framework->showDangerCallout('Username already taken. Choose Another');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
	
} else if (strcmp($password1, $password2) != 0) {
	$kas_framework->showDangerCallout('Passwords do not Match !!!. Please Retype');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
	
} else if ($captcha_answer_raw != $captcha_answer) {
	$kas_framework->showDangerCallout('Captcha is Incorrect. Please try Again!');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
	
} else if ($check_pin_and_serial->validate_pin_and_serial($pin, $pinserial) == false) {
	$kas_framework->showDangerCallout('Invalid Pin and(or) Serial !!!. Check Pin and Serial');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
	
} else if ($kas_framework->valueExist('email', 'web_students', $email) == true) {
	$kas_framework->showDangerCallout('Email Address is already registered');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
	
} else {
	//begin query
	$dbh->beginTransaction();
	
	$confirmation_code = $kas_framework->generateRandomString(); /* default value is 10*/
	$querySQL = "INSERT INTO studentbio
		(studentbio_internalid, studentbio_lname, studentbio_fname, studentbio_generation, studentbio_entry_year, studentbio_entry_grade, 
		studentbio_gender, studentbio_ethnicity, admit, std_bio_class_control, std_bio_living_with_parent)
		VALUES ('".$reg_no."', :lastname, :surname, '4', '".$current_year_id."', '".$entry_class."', '".$sex."', '1', '1', 'Change Grade', '1')";
		
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->bindParam(':lastname', $lastname); $db_handle->bindParam(':surname', $surname); 
		$db_handle->execute();
		$get_rows1 = $db_handle->rowCount();
		$insert_id_default = $dbh->lastInsertId();
		$db_handle = null;		


	if ($get_rows1 == '0') {
		//print mysql_error();
	 	$kas_framework->buttonController('#signup', 'enable');
		exit($kas_framework->showDangerCallout('Could not Create Student Basic Account <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
	}
	
	$querySQL = "UPDATE reg_pins_old SET used_by = '".$insert_id_default."', status = '1' WHERE codec = '".$pin."' AND sn = '".$pinserial."' LIMIT 1";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->execute();
	$get_rows2 = $db_handle->rowCount();
	$db_handle = null;		

	if ($get_rows2 == '0') {
		//print mysql_error();
	 	$kas_framework->buttonController('#signup', 'enable');
		exit($kas_framework->showDangerCallout('Could not Verify Pin <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">Explanation?</a>'));
	}
	
	$querySQL = "INSERT INTO web_students (stdbio_id, identify, email, user_n, pass, status, reg_date) VALUES ('".$insert_id_default."', '".$reg_no."', :email, :user_username, '".md5($password1)."', :confirmation_code, '".date('d/m/Y')."')";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->bindParam(':email', $email);  $db_handle->bindParam(':user_username', $user_username);  $db_handle->bindParam(':confirmation_code', $confirmation_code);
	$db_handle->execute();
	$get_rows3 = $db_handle->rowCount();
	$db_handle = null;		
	
		/* no need to change the insert positions // all will be inserted */
		if ($get_rows3 == '0') {
			$kas_framework->buttonController('#signup', 'enable');
			//print mysql_error();
		  exit($kas_framework->showDangerCallout('Could not Create Login Account <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
		}
	
	$insert_into_studentcontact = "INSERT INTO student_contact (studentcontact_studentid) VALUES ('".$insert_id_default."')";
	$db_handle = $dbh->prepare($insert_into_studentcontact);
	$db_handle->execute();
	$get_rows4 = $db_handle->rowCount();
	$db_handle = null;		

		if ($get_rows4 == '0') {
			//print mysql_error();
			$kas_framework->buttonController('#signup', 'enable');
		 exit($kas_framework->showDangerCallout('Could not Create Parents Record Account <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
		}
	
		$insert_into_studentwallet = "INSERT INTO student_wallet (student_id, balance, date_last_used) VALUES ('".$insert_id_default."', '0', '".date('d/m/Y')."')";
		$db_handle = $dbh->prepare($insert_into_studentwallet);
		$db_handle->execute();
		$get_rows5 = $db_handle->rowCount();
		$db_handle = null;	
	
			if ($get_rows5 == '0') {
				//print mysql_error();
				$kas_framework->buttonController('#signup', 'enable');
				exit($kas_framework->showDangerCallout('Could not Create Wallet Account <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
			}
	
	$insert_into_student_grade_year = "INSERT INTO student_grade_year (student_grade_year_student, student_grade_year_year, student_grade_year_grade)
		VALUES ('".$insert_id_default."', '".$current_year_id."', '".$entry_class."')";
		$db_handle = $dbh->prepare($insert_into_student_grade_year);
		$db_handle->execute();
		$get_rows6 = $db_handle->rowCount();
		$db_handle = null;		

			if ($get_rows6 == '0') {
				//print mysql_error();
				$kas_framework->buttonController('#signup', 'enable');
			 exit($kas_framework->showDangerCallout('Could not Create Context Grade <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
			}
	 
	 //the mailing sequence.
	 $school_mail = $kas_framework->getValue('email', 'tbl_school_profile', 'id', '1');
	/* $send_mail = $mailing_list->SendUserConfirmationEmail($email, $user_username, $school_mail, $confirmation_code, $kas_framework->returnUserSchool(''), 'student');
		 if ($send_mail == false) {
			$kas_framework->buttonController('#signup', 'enable');
			exit($kas_framework->showDangerCallout('Could not Send Mail <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
		 }
	*/
	if ($get_rows1 > 0 and $get_rows2 > 0 and $get_rows3 > 0 and $get_rows4 > 0 and $get_rows5 > 0 and $get_rows6 > 0 /* and ($send_mail == true) */ ) {
	//at this point, we try commit
		$dbh->commit();
		$kas_framework->showsuccesswithGreen('Sign Up Succesful. Please Complete your Profile now... Loading Portal...');
		$_SESSION['tapp_std_username'] = $user_username;
		$_SESSION['loadDiscussionData'] = 0;
		/* redirect to the complete profile panel*/
		print '<script type="text/javascript"> self.location = "'.$kas_framework->url_root('student/dashboard/profile/editprofile').'" </script>';
		$kas_framework->buttonController('#signup', 'disable');
		
	} else {
		$dbh->rollBack();
		$kas_framework->buttonController('#signup', 'enable');	
	}	
}

?>