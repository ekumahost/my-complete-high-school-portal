<?php
	if (file_exists('../php.files/classes/kas-framework.php')) {
		include ('../php.files/classes/pdoDB.php');
		include ('../php.files/classes/kas-framework.php');
		$kas_framework->safesession();
		include ('../php.files/classes/generalVariables.php');
		include ('../php.files/staff_details.php');
	} else if (file_exists('php.files/classes/kas-framework.php')) {
		include ('php.files/classes/pdoDB.php');
		include ('php.files/classes/kas-framework.php');
		$kas_framework->safesession();
		include ('php.files/classes/generalVariables.php');
		include ('php.files/staff_details.php');
	}
	
	//updating the last seen
	$querySQL = "UPDATE web_users SET last_log = '".date('d/m/Y H:i:s')."' WHERE web_users_relid = '".$web_users_relid."'";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();
	$db_handle = null;	
	if ($get_rows == 1) {
		//log you out
		print 'Checking Out...'; unset($_SESSION['tapp_staff_username']);
		print '<script type="text/javascript">self.location = "'.$kas_framework->url_root('redirect').'" </script>';
		exit;
	} else {
		print '<font color="red">Sign Out Failed!</font>';
	}
	
		
?>