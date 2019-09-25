<?php 

class parents extends kas_framework {
	
	function __construct() {
		global $dbh;
		//log the student out if the student can log in has been set to 0
		$querySQL = "SELECT * FROM tbl_app_config WHERE module = 'parent_login' LIMIT 1";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;
		
		if ($paramGetFields->status == '0') {
			unset($_SESSION['tapp_par_username']); //destroy the prospective student session
			print '<script> self.location = "'.$this->server_root_dir('').'" </script>';
		}
	}
	
	public function authConfirm($status) {
		($status != '1')?$this->showdangerwithRed('Alert: The School has not Confirmed you as a Parent. Advanced Modules have been Hidden from you. 
			Please <a href="'.$this->server_root_dir('parent/dashpanel/profile/editprofile').'">Complete Your Profile</a> so that the admin can approve your account
			<a href="'.$this->help_url('?topic=not-yet-authenticated-yet').'" target="_blank">Explanation?</a>'): '';	
	}
		
	public function restrictFunctionality($status) {
		return ($status != 1)?true: false;
	}
	
	public function display_accessLevel() {
			print isset($_SESSION['BasicPlanParent'])?'<small> ...Classic Plan </small>': '<small> ...Premium Plan </small>';
		}
		
	public function BasicPlanParent() {
		return isset($_SESSION['BasicPlanParent'])?true: false;
	}

	public function checkBasicPlanParent() {
		if ($this->BasicPlanParent() === true) { 
			exit($this->showWarningCallout('For Premium Plans Only. Please Wait so that your Account will be confirmed by the Admin...
			<a href="'.$this->server_root_dir('parent/dashpanel/profile/editprofile').'">complete your profile</a> for easy confirmation.'));
		}
	}
}

$parent = new parents();
	/* Making sure that your student user account is active first   */
		if ($parent->restrictFunctionality($student_parents_status) === true) { 
			$_SESSION['BasicPlanParent'] = 'Basic Plan'; /* set the basic plan */
		} else {
			unset($_SESSION['BasicPlanParent']);
		}
?>