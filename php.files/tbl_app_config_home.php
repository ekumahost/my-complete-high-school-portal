<?php
require ('classes/pdoDB.php');

function admission_badge() {
	
	require ('classes/pdoDB.php');
		$admission_open = "SELECT * FROM tbl_admission WHERE active = '1' LIMIT 1";
		$db_handle = $dbh->prepare($admission_open);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;
		
		if ($get_rows == 0) {
			$link = '#'; $admission_status = '<font color="red" style="font-size:12px"> (Closed)</font>';
		} else {
			$link = 'prospectStudent/register/'; $admission_status = '<font color="green" style="font-size:12px"> ('. $paramGetFields->badge_name .') </font>';
		}
	return '<span><a href="'.$link.'"><label> </label>Student Admission'. $admission_status .'</a></span>' ;
	
}

	function general_link_control($module, $link_name, $link_address) {
		require ('classes/pdoDB.php');
		$admission_open = "SELECT * FROM tbl_app_config WHERE module = '".$module."' LIMIT 1";
		$db_handle = $dbh->prepare($admission_open);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;
		
		if ($paramGetFields->status == 0) {
			$link = '#'; $status = '<font color="red" style="font-size:12px"> (Closed)</font>';
		} else {
			$link = $link_address; $status = '<font color="green" style="font-size:12px"> (Open) </font>';
		}
	return '<span><a href="'.$link.'"><label> </label>'.$link_name. $status .'</a></span>';
}

?>