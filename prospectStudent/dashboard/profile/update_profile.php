<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthPros_Std();
require (constant('tripple_return').'php.files/prospectStudent_details.php');
extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed Via Link');
}

class update_profile extends kas_framework {
	
	public function updatePersonalInfo($student_id_original) {
		extract($_POST);
		require ('../../../php.files/classes/pdoDB.php');
	$updatePIQuery = "UPDATE studentbio SET studentbio_title = '".$title."', studentbio_mname = :mname, studentbio_fname = :fname, studentbio_ethnicity = :ethnicity, studentbio_dob = :dob,  std_bio_mobile = '".$usermobile."', 
				std_bio_address = :student_bio_address, std_bio_resident_town = :std_bio_resident_town, std_bio_resident_state = :user_resident_state WHERE studentbio_id = '".$student_id_original."' LIMIT 1";
	$db_updatePIQuery = $dbh->prepare($updatePIQuery);
	$db_updatePIQuery->bindParam(':mname', $mname); $db_updatePIQuery->bindParam(':fname', $fname); $db_updatePIQuery->bindParam(':ethnicity', $ethnicity); $db_updatePIQuery->bindParam(':dob', $dob); 
	$db_updatePIQuery->bindParam(':student_bio_address', $student_bio_address); $db_updatePIQuery->bindParam(':std_bio_resident_town', $std_bio_resident_town); $db_updatePIQuery->bindParam(':user_resident_state', $user_resident_state); 
	$db_updatePIQuery->execute();
	$get_updatePIQuery_rows = $db_updatePIQuery->rowCount();
	$db_updatePIQuery = null;
	
		if ($get_updatePIQuery_rows == 1) {
			$this->showInfoCallout('Your Personal Information was Succesfully Updated');
		} else {
			echo mysql_error();
			$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
		}
	}
	
	public function updatePassword($useridentify) {
			extract($_POST);
			require ('../../../php.files/classes/pdoDB.php');
			if (strcmp($password1, $password2) == 0) {
			$querySQL = "UPDATE web_students SET pass = '".md5($password1)."' WHERE identify = '".$useridentify."' AND `pass` = '".md5($password0)."' LIMIT 1";
			$db_querySQL = $dbh->prepare($querySQL);
			$db_querySQL->execute();
			$get_querySQL_rows = $db_querySQL->rowCount();
			$db_querySQL = null;
						
			if ($get_querySQL_rows == 0) {
				$this->showWarningCallout('Could Not Change Password. Your Previous password is not Correct');
				} elseif ($get_querySQL_rows == 1) {
				$this->showInfoCallout('Password Changed Successfully');
				unset($_SESSION['tapp_std_username']);
				print '<script type="text/javascript"> self.location = "'.$this->server_root_dir('').'"</script>';	
				}
			} else {
			$this->showWarningCallout('Passwords do not Match');
			}
	}
	
	public function updatePreviousSchoolInfo($student_id_original) {
	extract($_POST);
	$updatePIQuery = "UPDATE studentbio SET studentbio_prevschoolname = :prev_sch_name, studentbio_prevschooladdress = :prev_sch_address, studentbio_prevschoolcity = :prev_sch_city, studentbio_prevschoolstate = :prev_sch_state, studentbio_prevschoolzip = :prev_sch_zip, studentbio_prevschoolcountry = '".$prev_sch_country."'  WHERE studentbio_id = '".$student_id_original."' LIMIT 1";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->bindParam(':prev_sch_name', $prev_sch_name); $db_handle->bindParam(':prev_sch_address', $prev_sch_address); $db_handle->bindParam(':prev_sch_city', $prev_sch_city); $db_handle->bindParam(':prev_sch_state', $prev_sch_state); $db_handle->bindParam(':prev_sch_zip', $prev_sch_zip); 
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();
	$db_handle = null;
	
		if ($get_rows == 1) {
			$this->showInfoCallout('Your Previous School Information was Succesfully Updated');
		} else {
			$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
		}
	}
	
	public function updateParGuardInfo($student_id_original) {
		extract($_POST);
		require ('../../../php.files/classes/pdoDB.php');
	$updatePIQuery = "UPDATE student_contact SET studentcontact_title = :parguard_title, studentcontact_fname = :parguard_fname, studentcontact_lname = :parguard_lname, studentcontact_relationship = '".$parguard_relationship."', studentcontact_phone1 = :phone1, studentcontact_email = :parguard_email  WHERE studentcontact_studentid = '".$student_id_original."' LIMIT 1";
	$db_updatePIQuery = $dbh->prepare($updatePIQuery);
	$db_updatePIQuery->bindParam(':parguard_title', $parguard_title); $db_updatePIQuery->bindParam(':parguard_fname', $parguard_fname); $db_updatePIQuery->bindParam(':parguard_lname', $parguard_lname); $db_updatePIQuery->bindParam(':phone1', $phone1); $db_updatePIQuery->bindParam(':parguard_email', $parguard_email);
	$db_updatePIQuery->execute();
	$get_updatePIQuery_rows = $db_updatePIQuery->rowCount();
	$db_updatePIQuery = null;
		if ($get_updatePIQuery_rows == 1) {
			$this->showInfoCallout('Your Alternative Contact Information was Succesfully Updated');
		} else {
			//print mysql_error();
			$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
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