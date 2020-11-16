<?php
	$username = $_SESSION['tapp_std_username'];
	/* details from web_students */ 
	$querySQL = "SELECT * FROM web_students WHERE user_n = '".$username."' LIMIT 1";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();
	$getStdObj = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;	

	
	$useremail = $getStdObj->email;
	$useridentify = $getStdObj->identify;
	$userid = $getStdObj->stdbio_id;
	$admission_badge = $getStdObj->admission_badge;
	$form_no = $getStdObj->form_no;
	
	/* details from studentbio */
	$querySQL = "SELECT * FROM studentbio WHERE studentbio_id = '".$userid."' LIMIT 1";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();
	$getBioObj = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;	
	
	$student_id_original =$getBioObj->studentbio_id;
	$usertitle =$getBioObj->studentbio_title;
	$userlastname =$getBioObj->studentbio_lname;
	$userfirstname =$getBioObj->studentbio_fname;
	$usermname =$getBioObj->studentbio_mname;
	$usergeneration =$getBioObj->studentbio_generation;
	$usersped =$getBioObj->studentbio_sped;
	$usergender =$getBioObj->studentbio_gender;
	$userpicturepath =$getBioObj->studentbio_pictures;
	$userethnicity =$getBioObj->studentbio_ethnicity;
	$userdob =$getBioObj->studentbio_dob;
	$userbirthcity =$getBioObj->studentbio_birthcity;
	$userbirthstate =$getBioObj->studentbio_birthstate;
	$userbirthcountry =$getBioObj->studentbio_birthcountry;
	$userprevschoolname =$getBioObj->studentbio_prevschoolname;
	$userpreviousSchooladdress =$getBioObj->studentbio_prevschooladdress;
	$userpreviousSchoolcity =$getBioObj->studentbio_prevschoolcity;
	$userpreviousSchoolstate =$getBioObj->studentbio_prevschoolstate;
	$userpreviousSchoolzip =$getBioObj->studentbio_prevschoolzip;
	$userpreviousSchoolcountry =$getBioObj->studentbio_prevschoolcountry;
	$userschool =$getBioObj->studentbio_school;
	//$userhomed =$getBioObj->studentbio_homed;
	$userprimaryContact =$getBioObj->studentbio_primarycontact;
	$user_form_master =$getBioObj->studentbio_form_master;
	$userbus =$getBioObj->studentbio_bus;
	$useradmitStatus =$getBioObj->admit;
	/* extra details added by major */
	/*$userhomeroom =$getBioObj->studentbio_homeroom; */
	$user_bio_address =$getBioObj->std_bio_address;
	$user_bio_resident_town =$getBioObj->std_bio_resident_town;
	$user_bio_resident_state =$getBioObj->std_bio_resident_state;
	$user_bio_mobile =$getBioObj->std_bio_mobile;
	$user_bio_living_with_parent =$getBioObj->std_bio_living_with_parent;
	
	
	/* details from the studentcontact which is the students parent guardian details */
	$studentparguard = "SELECT * FROM student_contact WHERE studentcontact_studentid = '".$student_id_original."' LIMIT 1";
	$db_handle = $dbh->prepare($studentparguard);
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();
	$getContactObj = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;		

	$userparguardtitle = $getContactObj->studentcontact_title;
	$userparguardfirstname = $getContactObj->studentcontact_fname;
	$userparguardlastname = $getContactObj->studentcontact_lname;
	$userparguardaddress1 = $getContactObj->studentcontact_address1;
	$userparguardaddress2 = $getContactObj->studentcontact_address2;
	$userparguardcity = $getContactObj->studentcontact_city;
	$userparguardstate = $getContactObj->studentcontact_state;
	$userparguardzip = $getContactObj->studentcontact_zip;
	$userparguardphone1 = $getContactObj->studentcontact_phone1;
	$userparguardphone2 = $getContactObj->studentcontact_phone2;
	$userparguardphone3 = $getContactObj->studentcontact_phone3;
	$userparguardemail = $getContactObj->studentcontact_email;
	$userparguardother = $getContactObj->studentcontact_other;
	$userparguardrel = $getContactObj->studentcontact_relationship;
		
	/*details from the student grade year which will tell us the particular year of the student and the class he/she belongs */
	$student_grade_year = "SELECT * FROM student_grade_year WHERE student_grade_year_student = ? AND student_grade_year_year = ? LIMIT 1";
	$db_handle = $dbh->prepare($student_grade_year);
	$db_handle->execute([ $student_id_original, $current_year_id ]);

	if ($db_handle->rowCount() == 0) {
		//Student is now a Graduate. Alumi in progress.
		$user_student_grade_year_year_id = -1;
		$user_student_grade_year_grade_id = -1;
		$user_student_grade_year_class_room_id = -1;
	} else {
		
		$stdGradeObj = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;
		$user_student_grade_year_year_id = $stdGradeObj->student_grade_year_year;
		$user_student_grade_year_grade_id = $stdGradeObj->student_grade_year_grade;
		$user_student_grade_year_class_room_id = $stdGradeObj->student_grade_year_class_room;
	}
	
	/*details from the students wallet*/
	
	$student_wallet = "SELECT * FROM student_wallet WHERE student_id = '".$student_id_original."' LIMIT 1";
	$db_handle = $dbh->prepare($student_wallet);
	$db_handle->execute();
	$walletObj = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;	
	
	$student_balance = @$walletObj->balance;
	$student_balance_date_last_used = @$walletObj->date_last_used;
	$student_wallet_status = @$walletObj->status;
	
	/*checking for users profile completeness, we get something like this.. its long anyway. */
		$completeness = 10;
			if ($userlastname != '') {	$completeness = $completeness + 2.3; } 
			if ($userfirstname != '') { $completeness = $completeness + 2.3; } 
			if ($usermname != '') { $completeness = $completeness + 2.3;} 
			if ($usergeneration != '0') { $completeness = $completeness + 2.3; }
			if ($userethnicity != '0') { $completeness = $completeness + 2.3; } 
			if ($userdob != '') { $completeness = $completeness + 2.3; }
			if ($userbirthcity != '') { $completeness = $completeness + 2.3; }
			if ($userbirthstate != '') { $completeness = $completeness + 2.3; }
			if ($userbirthcountry != '') { $completeness = $completeness + 2.3; }
			if ($userprevschoolname != '') { $completeness = $completeness + 2.3; }
			if ($userpreviousSchooladdress != '') { $completeness = $completeness + 2.3; }
			if ($userpreviousSchoolcity != '') { $completeness = $completeness + 2.3; }
			if ($userpreviousSchoolstate != '') { $completeness = $completeness + 2.3; }
			if ($userpreviousSchoolzip != '') { $completeness = $completeness + 2.3; }
			if ($userpreviousSchoolcountry != '') { $completeness = $completeness + 2.3; }
			if ($user_bio_address != '') { $completeness = $completeness + 2.3; }
			if ($user_bio_resident_town != '') { $completeness = $completeness + 2.3; }
			if ($user_bio_resident_state != '') { $completeness = $completeness + 2.3; }
			if ($user_bio_mobile != '') { $completeness = $completeness + 2.3; }
			if ($userparguardtitle != '0') { $completeness = $completeness + 2.3; }
			if ($userparguardfirstname != '') { $completeness = $completeness + 2.3; }
			if ($userparguardlastname != '') { $completeness = $completeness + 2.3; }
			if ($userparguardaddress1 != '') { $completeness = $completeness + 2.3; }
			if ($userparguardaddress2 != '') { $completeness = $completeness + 2.3; }
			if ($userparguardcity != '') { $completeness = $completeness + 2.3; }
			if ($userparguardstate != '0') { $completeness = $completeness + 2.3; }
			if ($userparguardzip != '') { $completeness = $completeness + 2.3; }
			if ($userparguardrel != 0) { $completeness = $completeness + 2.3; }
			if ($userparguardphone1 != '') { $completeness = $completeness + 2.3; }
			if ($userparguardphone2 != '') { $completeness = $completeness + 2.3; }
			if ($userparguardphone3 != '') { $completeness = $completeness + 2.3; }
			if ($userparguardemail != '') { $completeness = $completeness + 2.3; }
			if ($userpicturepath != '') { $completeness = $completeness + 20; }
			
			if ($completeness > 100) { $completeness = 99.9; }
?>
