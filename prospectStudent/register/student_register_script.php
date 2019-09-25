<?php
require ('../../php.files/classes/pdoDB.php');
require ('../../php.files/classes/kas-framework.php');

require (constant('double_return').'php.files/classes/generalVariables.php');
require (constant('double_return').'php.files/classes/PHPMailer/PHPMailerAutoload.php');
require (constant('double_return').'php.files/classes/mailing_list.php');

$kas_framework->safesession();

extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($byepass)) {
	exit('File Is Classified');
}
	function reloadCaptcha() {
		print '<script type="text/javascript">$(\'#load_captcha\').load(\''.constant('double_return').'inc.files/ult_captcha.php\');</script>';
	}

	$currentYearOfReg = $kas_framework->getValue('current_year', 'tbl_config', 'id', '1');
//class for the pin and the serial
class check_pin_and_serial extends kas_framework {
	public function validate_pin_and_serial($pin, $serial) {
		require ('../../php.files/classes/pdoDB.php');
	$checkPin = "SELECT * FROM reg_pins WHERE codec = :pin AND sn = :serial AND status = '0' LIMIT 1";
	 $db_checkPin = $dbh->prepare($checkPin);
	 $db_checkPin->bindParam(':pin', $pin); $db_checkPin->bindParam(':serial', $serial);
		$db_checkPin->execute();
		$get_checkPin_rows = $db_checkPin->rowCount();
		$paramObj = $db_checkPin->fetch(PDO::FETCH_OBJ);
		$db_checkPin = null;
	 	if ($get_checkPin_rows == 1) { return true; } else { return false; }
	}
}
$check_pin_and_serial = new check_pin_and_serial;

//the general functions
if ($kas_framework->strIsEmpty($surname) or $kas_framework->strIsEmpty($lastname) or $kas_framework->strIsEmpty($email) or $kas_framework->strIsEmpty($sex) or $kas_framework->strIsEmpty($pin) or $kas_framework->strIsEmpty($entry_class) or $kas_framework->strIsEmpty($pinserial) or $kas_framework->strIsEmpty($user_username) or $kas_framework->strIsEmpty($password1) or $kas_framework->strIsEmpty($password2)) {
	$kas_framework->showDangerCallout('One or More Fields Empty');
	$kas_framework->buttonController('#signup', 'enable');
	reloadCaptcha();
	
} /* else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
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
	
} else {
	$dbh->beginTransaction();
	
	$user_identify_serial = $kas_framework->generateIdentify();	
	$confirmation_code = $kas_framework->generateRandomString(); /* default value is 10*/

	$insert_into_studentbio = "INSERT INTO studentbio
		(studentbio_internalid, studentbio_lname, studentbio_fname, studentbio_generation, studentbio_entry_year, studentbio_entry_grade, 
		studentbio_gender, studentbio_ethnicity, admit, std_bio_class_control, std_bio_living_with_parent, admission_badge)
		VALUES ('".$user_identify_serial."', :lastname, :surname, '4', '".$current_year_id."', '".$entry_class."', '".$sex."', '1', '0', 'Change Grade', '1', '".$admission_batch_id."')";
		
		$db_insert_into_studentbio = $dbh->prepare($insert_into_studentbio);
		$db_insert_into_studentbio->bindParam(':lastname', $lastname); $db_insert_into_studentbio->bindParam(':surname', $surname);
		$db_insert_into_studentbio->execute();
		$get_insert_into_studentbio_rows = $db_insert_into_studentbio->rowCount();
		$db_insert_into_studentbio = null;
		
			$insert_id_default = $dbh->lastInsertId();
			if ($get_insert_into_studentbio_rows == 0) {
				//print mysql_error();
				$kas_framework->buttonController('#signup', 'enable');
				exit($kas_framework->showDangerCallout('Could not Create Student Basic Account <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
			}
	
		$update_pin = "UPDATE reg_pins SET used_by = '".$insert_id_default."', status = '1' WHERE codec = '".$pin."' AND sn = '".$pinserial."' LIMIT 1";
		$db_update_pin = $dbh->prepare($update_pin);
		$db_update_pin->execute();
		$get_update_pin_rows = $db_update_pin->rowCount();
		$db_update_pin = null;
		
		if ($get_update_pin_rows == 0) {
			//print mysql_error();
			$kas_framework->buttonController('#signup', 'enable');
			exit($kas_framework->showDangerCallout('Could not Verify Pin <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">Explanation?</a>'));
		}
	
	/* no need to change the insert positions // all will be inserted */
	$insert_into_web_students = "INSERT INTO web_students 
		(stdbio_id, identify, email, user_n, pass, status, reg_date, admission_badge)
		VALUES ('".$insert_id_default."', '".$user_identify_serial."', :email, :user_username, '".md5($password1)."', :confirmation_code, '".date('d/m/Y')."', '".$admission_batch_id."')";
			$db_insert_into_web_students = $dbh->prepare($insert_into_web_students);
			$db_insert_into_web_students->bindParam(':email', $email); $db_insert_into_web_students->bindParam(':user_username', $user_username); $db_insert_into_web_students->bindParam(':confirmation_code', $confirmation_code);
			$db_insert_into_web_students->execute();
			$get_insert_into_web_students_rows = $db_insert_into_web_students->rowCount();
			$db_insert_into_web_students = null;
			if ($get_insert_into_web_students_rows == 0) {
				$kas_framework->buttonController('#signup', 'enable');
				//print mysql_error();
				exit($kas_framework->showDangerCallout('Could not Create Login Account <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
			}
	
	$insert_into_studentcontact = "INSERT INTO student_contact (studentcontact_studentid)  VALUES ('".$insert_id_default."')";
	$db_insert_into_studentcontact = $dbh->prepare($insert_into_studentcontact);
	$db_insert_into_studentcontact->execute();
	$get_insert_into_studentcontact_rows = $db_insert_into_studentcontact->rowCount();
	$db_insert_into_studentcontact = null;
			if ($get_insert_into_studentcontact_rows == 0) {
				//print mysql_error();
				$kas_framework->buttonController('#signup', 'enable');
				exit($kas_framework->showDangerCallout('Could not Create Parents Record Account <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
			}
	
	/*
		$insert_into_student_wallet = mysql_query("INSERT INTO student_wallet (student_id, balance, date_last_used)
		VALUES ('".$insert_id_default."', '0', '".date('d/m/Y')."')");
			if (!$insert_into_student_wallet) {
			print mysql_error();
				$kas_framework->buttonController('#signup', 'enable');
			 exit($kas_framework->showDangerCallout('Could not Create Wallet Account <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
			}
	
		$insert_into_student_grade_year = mysql_query("INSERT INTO student_grade_year
			(student_grade_year_student, student_grade_year_year, student_grade_year_grade)
			VALUES ('".$insert_id_default."', '".$current_year_id."', '".$entry_class."')");
		if (!$insert_into_student_grade_year) {
		print mysql_error();
			$kas_framework->buttonController('#signup', 'enable');
		 exit($kas_framework->showDangerCallout('Could not Create Context <a href="'.$kas_framework->help_url().'?help?topic=query-failed" target="blank">&raquo;Explanation?</a>'));
		}
	 */
	 
	 //the mailing sequence.
	 /* $school_mail = $kas_framework->getValue('email', 'tbl_school_profile', 'id', '1');
	 $send_mail = $mailing_list->SendUserConfirmationEmail($email, $user_username, $school_mail, $confirmation_code, $kas_framework->returnUserSchool(''), 'student');
		 if (!$send_mail) {
			$kas_framework->buttonController('#signup', 'enable');
		  exit($kas_framework->showDangerCallout('Could not Send Mail <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
		 } */
	
	if ($get_update_pin_rows > 0 and $get_insert_into_web_students_rows > 0 and $get_insert_into_studentbio_rows > 0 and $get_insert_into_studentcontact_rows > 0 /* and ($send_mail == true) */) {
	//at this point, we try commit
		$dbh->commit();
		$kas_framework->showsuccesswithGreen('Sign Up Succesful. Please Complete your Profile now... Loading...');
		$_SESSION['tapp_prostd_username'] = $user_username;
		$_SESSION['loadDiscussionData'] = 0; 
		
		/*redirect to the complete profile panel */
		print '<script type="text/javascript"> self.location = "'.$kas_framework->server_root_dir('prospectStudent/dashboard/profile/editprofile?complete').'" </script>';
		$kas_framework->buttonController('#signup', 'disable');
		
	} else {
		$dbh->rollBack();
		$kas_framework->buttonController('#signup', 'enable');	
	}	
}
	$kas_framework->buttonController('#signup', 'enable');	
?>