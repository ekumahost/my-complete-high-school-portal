<?php
class prospectStudent extends kas_framework {
	function __construct() {
		global $dbh;
		//log the student out if the student can log in has been set to 0
		$querySQL = "SELECT * FROM tbl_app_config WHERE module = 'student_login' LIMIT 1";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;
		
		if ($paramGetFields->status == '0') {
			unset($_SESSION['tapp_prostd_username']); //destroy the prospective student session
			print '<script> self.location = "'.$this->url_root('').'" </script>';
		}
	}

	public function check_profile_completeness($percentage) {
		if ($percentage < 94) {
			$link = $this->url_root('prospectStudent/dashboard/profile/editprofile?complete');
			print '<script type="text/javascript"> self.location = "'.$link.'" </script>';
		}
	}
}
$prospectStudent = new prospectStudent();
?>