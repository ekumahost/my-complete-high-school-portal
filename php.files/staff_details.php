<?php
	$username = $_SESSION['tapp_staff_username'];
	//details from web_users
	$querySQL = "SELECT * FROM web_users WHERE web_users_username = '".$username."' LIMIT 1";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->execute();
	$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;
	
	$web_users_relid = $paramGetFields->web_users_relid;
	$web_users_flname = $paramGetFields->web_users_flname;
	$web_users_active = $paramGetFields->web_users_active;
	$web_users_type = $paramGetFields->web_users_type;
	$staff_type = $web_users_type;
	
	//details from teacher_
	$staff = "SELECT * FROM staff WHERE staff_id = '".$web_users_relid."' LIMIT 1";
	$db_handle = $dbh->prepare($staff);
	$db_handle->execute();
	$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;
	
	$staff_firstname =$paramGetFields->staff_fname;
	$staff_lastname =$paramGetFields->staff_lname;
	$staff_mi =$paramGetFields->staff_mi;
	$staff_email =$paramGetFields->staff_email;
	$staff_school =$paramGetFields->staff_school;
	$staff_title =$paramGetFields->staff_title;
	$staff_status =$paramGetFields->staff_status;
	$staff_country =$paramGetFields->staff_country;
	$staff_state =$paramGetFields->staff_state;
	$staff_dob =$paramGetFields->staff_dob;
	$staff_mobile =$paramGetFields->staff_mobile;
	$staff_address =$paramGetFields->staff_adress;
	$staff_image =$paramGetFields->staff_image;
	$staff_bank =$paramGetFields->staff_bank;
	$staff_account =$paramGetFields->staff_account;
	$staff_account_type =$paramGetFields->staff_act_type;
	$staff_bank_sort =$paramGetFields->staff_bank_sort;
	$staff_id_no =$paramGetFields->staff_id_no;
	$staff_sex =$paramGetFields->staff_sex;
	$teaching_type =$paramGetFields->teaching_type;
	/* new fields added by ben*/
	$staff_res_town =$paramGetFields->staff_res_town;
	$staff_res_state =$paramGetFields->staff_res_state;
	$staff_ethnicity =$paramGetFields->staff_ethnicity;
	$staff_birth_city =$paramGetFields->staff_birth_city;
	$staff_acc_name =$paramGetFields->staff_acc_name;
	$staff_kin_name =$paramGetFields->staff_kin_name;
	$staff_kin_phone =$paramGetFields->staff_kin_phone;
	$staff_kin_email =$paramGetFields->staff_kin_email;
	$staff_kin_adress =$paramGetFields->staff_kin_adress;
	$staff_kin_relationship =$paramGetFields->staff_kin_relationship;
	$staff_biography =$paramGetFields->staff_biography;
	
	//details from staff_role
	$querySQL = "SELECT * FROM staff_role WHERE staff_id = '".$web_users_relid."' LIMIT 1";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->execute();
	$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;	
	
	$staff_liberian = $paramGetFields->liberian;
	$staff_discipline = $paramGetFields->discipline;
	$staff_attendance = $paramGetFields->attendance;
	$staff_health = $paramGetFields->health;
	$staff_receipt = $paramGetFields->receipt;
       $staff_timetable = $paramGetFields->timetable;
	
	if ($web_users_type == 'T') {
	/* meaning that the staff is ateaching staff */
		$querySQL = "SELECT * FROM teacher_grade_year WHERE teacher = '".$web_users_relid."' AND session = '".$current_year_id."' LIMIT 1";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;	
		
		$teacher_grade_class = $paramGetFields->grade_class;
		$teacher_main_teacher = $paramGetFields->main_teacher;
			
	}
	
	$completeness = 15;
	
	if ($staff_firstname != '') { $completeness = $completeness + 2.5; }
	if ($staff_lastname != '') { $completeness = $completeness + 2.5; } 
	if ($staff_email != '') { $completeness = $completeness + 2.5; }
	if ($staff_mi != '') { $completeness = $completeness + 2.5; }
	if ($staff_title != '') { $completeness = $completeness + 2.5; }
	if ($staff_country != '') { $completeness = $completeness + 2.5; }
	if ($staff_dob != '') { $completeness = $completeness + 2.5; }
	if ($staff_mobile != '') { $completeness = $completeness + 2.5; }
	if ($staff_address != '') { $completeness = $completeness + 2.5; }
	if ($staff_bank != '') { $completeness = $completeness + 2.5; }
	if ($staff_account != '') { $completeness = $completeness + 2.5; }
	if ($staff_account_type != '') { $completeness = $completeness + 2.5; }
	if ($staff_bank_sort != '') { $completeness = $completeness + 2.5; }
	
	if ($staff_res_town != '') { $completeness = $completeness + 2.5; }
	if ($staff_res_state != '') { $completeness = $completeness + 2.5; }
	if ($staff_ethnicity != '') { $completeness = $completeness + 2.5; }
	if ($staff_birth_city != '') { $completeness = $completeness + 2.5; }
	if ($staff_acc_name != '') { $completeness = $completeness + 2.5; }
	if ($staff_kin_name != '') { $completeness = $completeness + 2.5; }
	if ($staff_kin_phone != '') { $completeness = $completeness + 2.5; }
	if ($staff_kin_email != '') { $completeness = $completeness + 2.5; }
	if ($staff_kin_relationship != '') { $completeness = $completeness + 2.5; }
	if ($staff_biography != '') { $completeness = $completeness + 10; }
	
	if ($staff_image != '') { $completeness = $completeness + 20; }

	
	if ($completeness >= 100) { $completeness = 99.9; } /* */

?>