<?php 
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/student_details.php');
extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed Via Link');
}

class update_profile extends kas_framework {
	
	public function updatePersonalInfo($student_id_original) {
		extract($_POST);
		require ('../../../php.files/classes/pdoDB.php');	
		$updatePIQuery = "UPDATE studentbio SET studentbio_title = '".$title."', studentbio_fname = :fname, studentbio_mname = :mname, 
					studentbio_generation = :generation, studentbio_ethnicity = :ethnicity, studentbio_dob = :dob, studentbio_birthcity = :birthcity, 
					studentbio_birthstate = :birthstate, studentbio_birthcountry = '".$birthcountry."', std_bio_mobile = '".$usermobile."', 
					std_bio_address = :student_bio_address, std_bio_resident_town = :std_bio_resident_town, std_bio_resident_state = :user_resident_state, std_bio_living_with_parent = '".$user_bio_living_with_parent."' WHERE studentbio_id = '".$student_id_original."' LIMIT 1";
		$db_updatePIQuery = $dbh->prepare($updatePIQuery);
		$db_updatePIQuery->bindParam(':fname', $fname);  $db_updatePIQuery->bindParam(':mname', $mname);  $db_updatePIQuery->bindParam(':generation', $generation);  
		$db_updatePIQuery->bindParam(':ethnicity', $ethnicity);  $db_updatePIQuery->bindParam(':dob', $dob); $db_updatePIQuery->bindParam(':birthcity', $birthcity);
		$db_updatePIQuery->bindParam(':birthstate', $birthstate);	$db_updatePIQuery->bindParam(':student_bio_address', $student_bio_address);	$db_updatePIQuery->bindParam(':std_bio_resident_town', $std_bio_resident_town);
		$db_updatePIQuery->bindParam(':user_resident_state', $user_resident_state);	
		$db_updatePIQuery->execute();
		$get_db_updatePIQuery_rows = $db_updatePIQuery->rowCount();
		$db_updatePIQuery = null;		

		if ($get_db_updatePIQuery_rows == 1) {
			$this->showInfoCallout('Your Personal Information was Succesfully Updated');
			$this->buttonController('#updatePersonalInfo', 'enable');
		} else {
			//echo mysql_error();
			$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
			$this->buttonController('#updatePersonalInfo', 'enable');
		}
	}
	
	public function updatePassword($useridentify) {
		extract($_POST);
		require ('../../../php.files/classes/pdoDB.php');
		if (strcmp($password1, $password2) == 0) {
			$qaff = "UPDATE web_students SET pass = '".md5($password1)."' WHERE identify = '".$useridentify."' AND `pass` = '".md5($password0)."' LIMIT 1";
			$db_qaff = $dbh->prepare($qaff);
			$db_qaff->execute();
			$get_qaff_rows = $db_qaff->rowCount();
			$db_qaff = null;
			
			if ($get_qaff_rows == 0) {
				$this->showWarningCallout('Could Not Change Password. Your Previous password is not Correct');
				$this->buttonController('#updatePassword', 'enable');
			} elseif ($get_qaff_rows == 1) {
				$this->showInfoCallout('Password Changed Successfully');
				unset($_SESSION['tapp_std_username']);
				print '<script type="text/javascript"> self.location = "'.$this->url_root('').'"</script>';	
			}
		} else {
			$this->showWarningCallout('Passwords do not Match');
			$this->buttonController('#updatePassword', 'enable');
		}
	}
	
	public function updatePreviousSchoolInfo($student_id_original) {
	extract($_POST);
	require ('../../../php.files/classes/pdoDB.php');
	$updatePIQuery = "UPDATE studentbio SET studentbio_prevschoolname =:prev_sch_name, studentbio_prevschooladdress = :prev_sch_address, studentbio_prevschoolcity = :prev_sch_city, 
			studentbio_prevschoolstate = :prev_sch_state, studentbio_prevschoolzip = :prev_sch_zip, studentbio_prevschoolcountry = '".$prev_sch_country."'  WHERE studentbio_id = '".$student_id_original."' LIMIT 1";
	$db_updatePIQuery = $dbh->prepare($updatePIQuery);
	$db_updatePIQuery->bindParam(':prev_sch_name', $prev_sch_name); $db_updatePIQuery->bindParam(':prev_sch_address', $prev_sch_address); $db_updatePIQuery->bindParam(':prev_sch_city', $prev_sch_city);
	$db_updatePIQuery->bindParam(':prev_sch_state', $prev_sch_state); $db_updatePIQuery->bindParam(':prev_sch_zip', $prev_sch_zip); 
	$db_updatePIQuery->execute();
	$get_updatePIQuery_rows = $db_updatePIQuery->rowCount();
	$db_updatePIQuery = null;	
	
		if ($get_updatePIQuery_rows == 1) {
			$this->showInfoCallout('Your Previous School Information was Succesfully Updated');
			$this->buttonController('#updatePrevSch', 'enable');
		} else {
			$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
			$this->buttonController('#updatePrevSch', 'enable');
		}
	}
	
	public function updateParGuardInfo($student_id_original) {
		extract($_POST);
		require ('../../../php.files/classes/pdoDB.php');
	$updatePIQuery = "UPDATE student_contact SET studentcontact_title = :parguard_title, studentcontact_fname = :parguard_fname, studentcontact_lname = :parguard_lname, 
			studentcontact_relationship = '".$parguard_relationship."', studentcontact_address1 = :parguard_addr1, studentcontact_address2 = :parguard_addr2, studentcontact_city = :parguard_city, 
			studentcontact_state = :parguard_state, studentcontact_zip = :parguard_zip, studentcontact_phone1 = :phone1, studentcontact_phone2 = :phone2, studentcontact_phone3 = :phone3, studentcontact_email = :parguard_email  WHERE studentcontact_studentid = '".$student_id_original."' LIMIT 1";
	$db_updatePIQuery = $dbh->prepare($updatePIQuery);
	$db_updatePIQuery->bindParam(':parguard_title', $parguard_title); $db_updatePIQuery->bindParam(':parguard_fname', $parguard_fname); $db_updatePIQuery->bindParam(':parguard_lname', $parguard_lname);
	$db_updatePIQuery->bindParam(':parguard_addr1', $parguard_addr1); $db_updatePIQuery->bindParam(':parguard_addr2', $parguard_addr2); $db_updatePIQuery->bindParam(':parguard_city', $parguard_city);
	$db_updatePIQuery->bindParam(':parguard_state', $parguard_state); $db_updatePIQuery->bindParam(':parguard_zip', $parguard_zip); $db_updatePIQuery->bindParam(':phone1', $phone1);
	$db_updatePIQuery->bindParam(':phone2', $phone2); $db_updatePIQuery->bindParam(':phone3', $phone3);$db_updatePIQuery->bindParam(':parguard_email', $parguard_email);
	$db_updatePIQuery->execute();
	$get_updatePIQuery_rows = $db_updatePIQuery->rowCount();
	$db_updatePIQuery = null;
	
		if ($get_updatePIQuery_rows == 1) {
			$this->showInfoCallout('Your Alternative Contact Information was Succesfully Updated');
			$this->buttonController('#updateParGuard', 'enable');
		} else {
		//print mysql_error();
			$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
			$this->buttonController('#updateParGuard', 'enable');
		}
	}
}

	$updateProfile = new update_profile;
	$request_type = $_GET['type'];

	if ($request_type == 'std_update_profile') {
		$updateProfile->updatePersonalInfo($student_id_original);	
	} else if ($request_type == 'std_update_password') {
		$updateProfile->updatePassword($useridentify);	
	} else if ($request_type == 'std_update_prevsch') {
		$updateProfile->updatePreviousSchoolInfo($student_id_original);
	} else if ($request_type == 'std_update_parguard') {
		$updateProfile->updateParGuardInfo($student_id_original);	
	}
?>