<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthParent();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/parents_details.php');
extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed Via Link');
}

class update_profile extends kas_framework {
	
	public function updatePersonalInfo($web_parents_relid) {
		extract($_POST);
		require ('../../../php.files/classes/pdoDB.php');
	//student_parents_firstname, student_parents_lastname, student_parents_sex, parent_title
	$updatePIQuery = "UPDATE student_parents SET student_parents_title = '".$parent_title."', student_parents_occupation = :parents_occupation, student_parents_firstname = :parents_firstname, student_parents_mi = :parents_mi WHERE student_parents_id = '".$web_parents_relid."' LIMIT 1";
	$db_updatePIQuery = $dbh->prepare($updatePIQuery);
	$db_updatePIQuery->bindParam(':parents_occupation', $parents_occupation); $db_updatePIQuery->bindParam(); $db_updatePIQuery->bindParam(':parents_firstname', $parents_firstname);  $db_updatePIQuery->bindParam(':parents_mi', $parents_mi); 
	$db_updatePIQuery->execute();
	$get_updatePIQuery_rows = $db_updatePIQuery->rowCount();
	$db_updatePIQuery = null;
	
		if ($get_updatePIQuery_rows == 1) {
			$this->showInfoCallout('Your Personal Information was Succesfully Updated');
			$this->buttonController('#updatePersonalInfo', 'enable');
		} else {
			$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
			$this->buttonController('#updatePersonalInfo', 'enable');
			//print mysql_error();
		}
	}
	
	public function updateContact($web_parents_relid) {
//parents_contactaddress1, parents_contactaddress2, parents_mobile1, parents_mobile2, parents_city, parents_state, parents_country
	extract($_POST);
	require ('../../../php.files/classes/pdoDB.php');
	$updatePIQuery = "UPDATE student_parents SET student_parents_contactaddress1 = :parents_contactaddress1, student_parents_contactaddress2 = :parents_contactaddress2, student_parents_mobile1 = :parents_mobile1, 
			student_parents_mobile2 = :parents_mobile2, student_parents_city = :parents_city, student_parents_state = :parents_state, student_parents_country = '".$parents_country."' WHERE student_parents_id = '".$web_parents_relid."' LIMIT 1";
	$db_updatePIQuery = $dbh->prepare($updatePIQuery);
	$db_updatePIQuery->bindParam(':parents_contactaddress1', $parents_contactaddress1); $db_updatePIQuery->bindParam(':parents_contactaddress2', $parents_contactaddress2); $db_updatePIQuery->bindParam(':parents_mobile1', $parents_mobile1); 
	$db_updatePIQuery->bindParam(':parents_mobile2', $parents_mobile2); $db_updatePIQuery->bindParam(':parents_city', $parents_city); $db_updatePIQuery->bindParam(':parents_state', $parents_state); 
	$db_updatePIQuery->execute();
	$get_updatePIQuery_rows = $db_updatePIQuery->rowCount();
	$db_updatePIQuery = null;
	
		if ($get_updatePIQuery_rows == 1) {
			$this->showInfoCallout('Your Contact Information was Succesfully Updated');
			$this->buttonController('#updateContact', 'enable');
		} else {
			$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'">Explanation?</a>');
			$this->buttonController('#updateContact', 'enable');
		}
	}
	
	public function updatePassword($web_parents_relid) {
	//password0,password1,password2
			extract($_POST);
			if (strcmp($password1, $password2) == 0) {
			$updPassw = "UPDATE web_parents SET web_parents_password = '".md5($password1)."' WHERE web_parents_relid = '".$web_parents_relid."' AND `web_parents_password` = '".md5($password0)."' LIMIT 1";
			$updPassw = $dbh->prepare($updPassw);
			$updPassw->execute();
			$get_updPassw_rows = $updPassw->rowCount();
			$updPassw = null;
			
			if ($get_updPassw_rows == 0) {
				$this->showWarningCallout('Could Not Change Password. Your Previous password is not Correct');
				$this->buttonController('#updatePassword', 'enable');
				} elseif ($get_updPassw_rows == 1) {
				$this->showInfoCallout('Password Changed Successfully');
				unset($_SESSION['tapp_par_username']);
				print '<script type="text/javascript"> self.location = "'.$this->server_root_dir('parent').'" </script>';	
				}
			} else {
				$this->showWarningCallout('Passwords do not Match');
				$this->buttonController('#updatePassword', 'enable');
			}
	}
}

$updateProfile = new update_profile;
$request_type = $_GET['type'];

if ($request_type == 'parent_update_personal') {
	$updateProfile->updatePersonalInfo($web_parents_relid);	
} else if ($request_type == 'update_contact') {
	$updateProfile->updateContact($web_parents_relid);	
} else if ($request_type == 'parent_update_password') {
	$updateProfile->updatePassword($web_parents_relid);	
}
?>