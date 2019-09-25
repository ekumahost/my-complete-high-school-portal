<?php
	$username = $_SESSION['tapp_prostd_username'];
	/* details from web_students */ 
	$querySQL = "SELECT * FROM web_students WHERE user_n = '".$username."' LIMIT 1";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();
	$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;	
	
	$useremail = $paramGetFields->email;
	$useridentify = $paramGetFields->identify;
	$userid = $paramGetFields->stdbio_id;
	$admission_badge = $paramGetFields->admission_badge;
	$form_no = $paramGetFields->form_no;
	
	/* details from studentbio */
	$studentbio = "SELECT * FROM studentbio WHERE studentbio_id = '".$userid."' LIMIT 1";
	$db_handle = $dbh->prepare($studentbio);
	$db_handle->execute();
	$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;	
	
	$student_id_original = $paramGetFields->studentbio_id;
	$usertitle = $paramGetFields->studentbio_title;
	$userlastname = $paramGetFields->studentbio_lname;
	$userfirstname = $paramGetFields->studentbio_fname;
	$usermname = $paramGetFields->studentbio_mname;
	$usergender = $paramGetFields->studentbio_gender;
	$userpicturepath = $paramGetFields->studentbio_pictures;
	$userethnicity = $paramGetFields->studentbio_ethnicity;
	$userdob = $paramGetFields->studentbio_dob;
	$user_bio_address = $paramGetFields->std_bio_address;
	$user_bio_resident_town = $paramGetFields->std_bio_resident_town;
	$user_bio_resident_state = $paramGetFields->std_bio_resident_state;
	$user_bio_mobile = $paramGetFields->std_bio_mobile;
	$userschool = $paramGetFields->studentbio_school;
	$userprevschoolname = $paramGetFields->studentbio_prevschoolname;
	$usergeneration = $paramGetFields->studentbio_generation;
	$user_bio_mobile = $paramGetFields->std_bio_mobile;
	$userbirthcity = $paramGetFields->studentbio_birthcity;
	$userbirthstate = $paramGetFields->studentbio_birthstate;
	$userbirthcountry = $paramGetFields->studentbio_birthcountry;
	$usersped = $paramGetFields->studentbio_sped;
	$userbus = $paramGetFields->studentbio_bus;
	$userpreviousSchooladdress = $paramGetFields->studentbio_prevschooladdress;
	$userpreviousSchoolcity = $paramGetFields->studentbio_prevschoolcity;
	$userpreviousSchoolstate = $paramGetFields->studentbio_prevschoolstate;
	$userpreviousSchoolzip = $paramGetFields->studentbio_prevschoolzip;
	$userpreviousSchoolcountry = $paramGetFields->studentbio_prevschoolcountry;
	$useradmitStatus = $paramGetFields->admit;
	$userhomed = $paramGetFields->studentbio_homed;
	$userprimaryContact = $paramGetFields->studentbio_primarycontact;
	$user_form_master = $paramGetFields->studentbio_form_master;
	//$userhomeroom = $paramGetFields->studentbio_homeroom;
	
	/* extra details added by major */
	$user_bio_living_with_parent = $paramGetFields->std_bio_living_with_parent; 
	
	/* details from the studentcontact which is the students parent guardian details */
	$studentparguard = "SELECT * FROM student_contact WHERE studentcontact_studentid = '".$student_id_original."'";
	$db_handle = $dbh->prepare($studentparguard);
	$db_handle->execute();
	$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;	
	
	$userparguardtitle = $paramGetFields->studentcontact_title;
	$userparguardfirstname = $paramGetFields->studentcontact_fname;
	$userparguardlastname = $paramGetFields->studentcontact_lname;
	$userparguardphone1 = $paramGetFields->studentcontact_phone1;
	$userparguardemail = $paramGetFields->studentcontact_email;
	$userparguardrel = $paramGetFields->studentcontact_relationship;
	$userparguardother = $paramGetFields->studentcontact_other; 
	$userparguardphone2 = $paramGetFields->studentcontact_phone2;
	$userparguardphone3 = $paramGetFields->studentcontact_phone3; 
	 $userparguardaddress1 = $paramGetFields->studentcontact_address1;
	$userparguardaddress2 = $paramGetFields->studentcontact_address2;
	$userparguardcity = $paramGetFields->studentcontact_city;
	$userparguardstate = $paramGetFields->studentcontact_state;
	$userparguardzip = $paramGetFields->studentcontact_zip; 
	
	/* details from ht students wallet 
	$student_wallet = "SELECT * FROM student_wallet WHERE student_id = '".$student_id_original."'";
	$db_handle = $dbh->prepare($student_wallet);
	$db_handle->execute();
	$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;	
	
	$student_balance = $paramGetFields->balance;
	$student_balance_date_last_used = $paramGetFields->date_last_used;
	*/
	/*checking for users profile completeness, we get something like this.. its long anyway. */
		$completeness = 10;
			if ($usertitle != 0) {	$completeness = $completeness + 4.3; } 
			if ($userlastname != '') {	$completeness = $completeness + 4.3; } 
			if ($userfirstname != '') { $completeness = $completeness + 4.3; } 
			if ($usermname != '') { $completeness = $completeness + 4.3;}
			if ($userethnicity != '0') { $completeness = $completeness + 4.3; } 
			if ($userdob != '') { $completeness = $completeness + 4.3; }
			if ($user_bio_address != '') { $completeness = $completeness + 4.3; }
			if ($user_bio_resident_town != '') { $completeness = $completeness + 4.3; }
			if ($user_bio_resident_state != '') { $completeness = $completeness + 4.3; }
			if ($user_bio_mobile != '') { $completeness = $completeness + 4.3; }
			if ($userparguardphone1 != '') { $completeness = $completeness + 4.3; }
			if ($userparguardfirstname != '') { $completeness = $completeness + 4.3; }
			if ($userparguardlastname != '') { $completeness = $completeness + 4.3; }
			if ($userparguardrel != 0) { $completeness = $completeness + 4.3; } 
			if ($userparguardtitle != '0') { $completeness = $completeness + 4.3; }
			if ($userparguardemail != '') { $completeness = $completeness + 4.3; }
			if ($userpicturepath != '') { $completeness = $completeness + 20; }
			
			if ($userparguardphone2 != '') { $completeness = $completeness + 4.3; }
			if ($userparguardaddress1 != '') { $completeness = $completeness + 4.3; }
			if ($userparguardaddress2 != '') { $completeness = $completeness + 4.3; }
			if ($userbirthcity != '') { $completeness = $completeness + 4.3; }
			if ($userbirthstate != '') { $completeness = $completeness + 4.3; }
			if ($userbirthcountry != '') { $completeness = $completeness + 4.3; }
			if ($userparguardzip != '') { $completeness = $completeness + 4.3; }
			if ($usergeneration != '0') { $completeness = $completeness + 4.3; }
			if ($userparguardphone3 != '') { $completeness = $completeness + 4.3; } 
			
			if ($completeness > 100) { $completeness = 99.9; }
?>