<?php
require ('classes/pdoDB.php');
require ('classes/kas-framework.php');
$kas_framework->safesession();

extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($byepass)) {
	exit('This File is Classified');
}

if ($kas_framework->strIsEmpty($username) or $kas_framework->strIsEmpty($password)) {
	$kas_framework->showinfowithBlue('Username or Password Empty!');
	$kas_framework->buttonController('#signin', 'enable');
} else {

	$querySQL = "SELECT * FROM web_users AS wu, staff AS s WHERE (wu.web_users_username = :username or s.staff_email = :username) AND wu.web_users_password = '".md5($password)."' AND (wu.web_users_type = 'T' or wu.web_users_type = 'S') AND s.staff_id = wu.web_users_relid LIMIT 1";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->bindParam(':username', $username); $db_handle->bindParam(':username', $username); 
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();
	$loginObj = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;	
	
	if ($get_rows == 1 and $loginObj->web_users_password == md5($password)) {
		
		if ($loginObj->web_users_active != '1') {
			$kas_framework->showDangerCallout('Account not Activated.  <a href="'.$kas_framework->server_root_dir('staff/confirmreg').'">Activate?</a> 
				<br /><a href="'.$kas_framework->help_url('?topic=blocked-check-in').'" target="_blank">&raquo;Explanation?</a>');
				$kas_framework->buttonController('#signin', 'disable');
		} else {
			$kas_framework->showInfoCallout('Logged in. Please wait...');
			$_SESSION['tapp_staff_username'] = $loginObj->web_users_username;
			$_SESSION['loadDiscussionData'] = 0;
			print '<script type="text/javascript"> self.location = "'.$kas_framework->server_root_dir('redirect?httptrack='). $kas_framework->generateRandomString(20). $kas_framework->generateRandomString(20). $kas_framework->generateRandomString(20). '&press=sf"</script>'; //other browsers
			exit();
		}
		
	} else {
		//login attempt for the button
		$login_attempt = @$_SESSION['login_atempt'] + 1; //gettting the total login attempts
		$_SESSION['login_atempt'] = $login_attempt;
			
			if ($_SESSION['login_atempt'] >= 3) {
				$kas_framework->showDangerCallout('Login Temporarily Suspended.
				<br /><a href="'.$kas_framework->help_url('?topic=check-in-suspended').'" target="_blank">&raquo;Explanation?</a>');
				$kas_framework->buttonController('#signin', 'disable');
				$_SESSION['login_atempt'] = 0; //resetting the total login attempt
			} else {
				//display a normal login error message
					$kas_framework->showDangerCallout('Incorrect Username and Password
					<br /><a href="'.$kas_framework->help_url('?topic=incorrect-details').'" target="_blank">&raquo;Explanation?</a>');
					$kas_framework->buttonController('#signin', 'enable');
			}		
		//print mysql_error();	
	}
		
}

?>