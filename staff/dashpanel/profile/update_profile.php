<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/staff_details.php');
extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed Via Link');
}

class update_profile extends kas_framework {
	
	public function updatePersonalInfo($web_users_relid) {
		extract($_POST);
		require ('../../../php.files/classes/pdoDB.php');
	 $updatePIQuery = "UPDATE staff SET staff_title = '".$staff_title."', staff_fname = :staff_firstname, staff_ethnicity = '".$ethnicity."', staff_mi = :staff_mi, staff_dob = :dob, 
				staff_state = :staff_state, staff_birth_city = '".$staff_birth_city."' WHERE staff_id = '".$web_users_relid."' LIMIT 1";
		$db_updatePIQuery = $dbh->prepare($updatePIQuery);
		$db_updatePIQuery->bindparam(':staff_firstname', $staff_firstname); $db_updatePIQuery->bindparam(':staff_mi', $staff_mi); $db_updatePIQuery->bindparam(':dob', $dob); 
		$db_updatePIQuery->bindparam(':staff_state', $staff_state); 
		$db_updatePIQuery->execute();
		$get_updatePIQuery_rows = $db_updatePIQuery->rowCount();
		$db_handle = null;
		
		if ($get_updatePIQuery_rows == 1) {
			$this->showInfoCallout('Your Personal Information was Succesfully Updated');
			$this->buttonController('#updatePersonalInfo', 'enable');
		} else {
			$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
			$this->buttonController('#updatePersonalInfo', 'enable');
			//print mysql_error();
		}
	}
	
	public function updateContact($web_users_relid) {
		extract($_POST);
		require ('../../../php.files/classes/pdoDB.php');
	$updatePIQuery = "UPDATE staff SET staff_adress = :staff_contactaddress, staff_mobile = :staff_mobile, staff_country = '".$staff_country."', staff_res_town = '".$staff_res_town."', staff_res_state = '".$staff_res_state."' WHERE staff_id = '".$web_users_relid."' LIMIT 1";
	$db_updatePIQuery = $dbh->prepare($updatePIQuery);
	$db_updatePIQuery->bindParam(':staff_contactaddress', $staff_contactaddress); $db_updatePIQuery->bindParam(':staff_mobile', $staff_mobile);
	$db_updatePIQuery->execute();
	$get_updatePIQuery_rows = $db_updatePIQuery->rowCount();
	$db_updatePIQuery = null;
		if ($get_updatePIQuery_rows == 1) {
			$this->showInfoCallout('Your Contact Information was Succesfully Updated');
			$this->buttonController('#updateContact', 'enable');
		} else {
			$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'">Explanation?</a>');
			$this->buttonController('#updateContact', 'enable');
			//print mysql_error();
		}
	}
	
	public function updateBank($web_users_relid) {
		extract($_POST);
		require ('../../../php.files/classes/pdoDB.php');
	$updatePIQuery = "UPDATE staff SET staff_bank = :staff_bank, staff_act_type = :staff_acc_type, staff_account = :staff_acc_no, staff_bank_sort = :staff_bank_sort, staff_acc_name = '".$staff_acc_name."' WHERE staff_id = '".$web_users_relid."' LIMIT 1";
	$db_updatePIQuery = $dbh->prepare($updatePIQuery);
	$db_updatePIQuery->bindParam(':staff_bank', $staff_bank); $db_updatePIQuery->bindParam(':staff_acc_type', $staff_acc_type); $db_updatePIQuery->bindParam(':staff_acc_no', $staff_acc_no); $db_updatePIQuery->bindParam(':staff_bank_sort', $staff_bank_sort); 
	$db_updatePIQuery->execute();
	$get_updatePIQuery_rows = $db_updatePIQuery->rowCount();
	$db_updatePIQuery = null;
	
		if ($get_updatePIQuery_rows == 1) {
			$this->showInfoCallout('Your Bank Details was Succesfully Updated');
			$this->buttonController('#updatebank', 'enable');
		} else {
			$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'">Explanation?</a>');
			$this->buttonController('#updatebank', 'enable');
			//print mysql_error();
		}
	}
	
	public function updateKin($web_users_relid) {
		extract($_POST);
	require ('../../../php.files/classes/pdoDB.php');
	if (filter_var($staff_kin_email, FILTER_VALIDATE_EMAIL) === false){
		$this->showWarningCallout('Wrong Email Address. Check the Email address <b>"'. $staff_kin_email .'"</b>');
	} else {
			$updateKinQuery = "UPDATE staff SET staff_kin_name = :staff_kin_name, staff_kin_phone = :staff_kin_phone, staff_kin_email = :staff_kin_email, staff_kin_adress = :staff_kin_adress, staff_kin_relationship = '".$staff_kin_relationship."' WHERE staff_id = '".$web_users_relid."' LIMIT 1";
				$db_updateKinQuery = $dbh->prepare($updateKinQuery);
				$db_updateKinQuery->bindParam(':staff_kin_name', $staff_kin_name); $db_updateKinQuery->bindParam(':staff_kin_phone', $staff_kin_phone); 
				$db_updateKinQuery->bindParam(':staff_kin_email', $staff_kin_email); $db_updateKinQuery->bindParam(':staff_kin_adress', $staff_kin_adress); 
				$db_updateKinQuery->execute();
				$get_updateKinQuery_rows = $db_updateKinQuery->rowCount();
				$db_updateKinQuery = null;
				
					if ($get_updateKinQuery_rows == 1) {
						$this->showInfoCallout('Your Next of Kin Details was Succesfully Updated');
						$this->buttonController('#updateKin', 'enable');
					} else {
						$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'">Explanation?</a>');
						$this->buttonController('#updateKin', 'enable');
						//print mysql_error();
					}
	}

	}
	
	public function updateBiography($web_users_relid) {
		extract($_POST);
		require ('../../../php.files/classes/pdoDB.php');
	if (strlen($staff_biography_text) < 10) {
		$this->showWarningCallout('Your Biography is too short. At least 10 Characters are needed');
			$this->buttonController('#updatebiography', 'enable');
	} else {
		$updateBiographyQuery = "UPDATE staff SET staff_biography = '".$this->secureStr($staff_biography_text)."' WHERE staff_id = '".$web_users_relid."' LIMIT 1";
		$db_updateBiographyQuery = $dbh->prepare($updateBiographyQuery);
		$db_updateBiographyQuery->execute();
		$get_updateBiographyQuery_rows = $db_updateBiographyQuery->rowCount();
		$db_updateBiographyQuery = null;
		
			if ($get_updateBiographyQuery_rows == 1) {
				$this->showInfoCallout('Your Biography was Succesfully Updated');
				$this->buttonController('#updatebiography', 'enable');
			} else {
				$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'">Explanation?</a>');
				$this->buttonController('#updatebiography', 'enable');
				//print mysql_error();
			}
		}
	}
		
	
	
	public function updatePassword($web_users_relid) {
	//password0,password1,password2
			extract($_POST);
			require ('../../../php.files/classes/pdoDB.php');
			if (strcmp($password1, $password2) == 0) {
			$passwordQ = "UPDATE web_users SET web_users_password = '".$this->secureStr(md5($password1))."' WHERE web_users_relid = '".$web_users_relid."' AND `web_users_password` = '".$this->secureStr(md5($password0))."' LIMIT 1";
			$db_passwordQ = $dbh->prepare($passwordQ);
			$db_passwordQ->execute();
			$get_passwordQ_rows = $db_passwordQ->rowCount();
			$db_passwordQ = null;
			
			if ($get_passwordQ_rows == 0) {
					$this->showWarningCallout('Could Not Change Password. Your Previous password is not Correct');
					$this->buttonController('#updatebank', 'enable');
				} else if ($get_passwordQ_rows==1) {
					$this->showInfoCallout('Password Changed Successfully');
					unset($_SESSION['tapp_staff_username']);
					print '<script type="text/javascript"> self.location = "'.$this->server_root_dir('').'" </script>';	
				}
			} else {
				$this->showWarningCallout('Passwords do not Match');
				$this->buttonController('#updatebank', 'enable');
			}
	}
}

$updateProfile = new update_profile;
$request_type = $_GET['type'];

if ($request_type == 'staff_update_personal') {
	$updateProfile->updatePersonalInfo($web_users_relid);	
} else if ($request_type == 'update_contact') {
	$updateProfile->updateContact($web_users_relid);	
} else if ($request_type == 'staff_update_password') {
	$updateProfile->updatePassword($web_users_relid);	
} else if ($request_type == 'updatebank') {
	$updateProfile->updateBank($web_users_relid);	
} else if ($request_type == 'updatekin') {
	$updateProfile->updateKin($web_users_relid);	
} else if ($request_type == 'staff_update_biography') {
	$updateProfile->updateBiography($web_users_relid);	
}
?>