<?php
require ('classes/pdoDB.php');
require ('classes/kas-framework.php');
$kas_framework->safesession();

extract($_POST);
//echo md5('open');

//make sure that the file is not directly accessed from the url
if (!isset($byepass)) {
	exit('This File is Classified');
}

if ($kas_framework->strIsEmpty($username) or $kas_framework->strIsEmpty($password)) {
	$kas_framework->showinfowithBlue('Username or Password Empty!');
	$kas_framework->buttonController('#signin', 'enable');
} else {
	$querySQL = "SELECT * FROM web_students WHERE (user_n = :username OR email = :username) AND pass = '".md5($password)."' LIMIT 1";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->bindParam(':username', $username);
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();
	$loginObj = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;		
	

	if ($get_rows == 1 and $loginObj->pass == md5($password)) {		
		if ($loginObj->status != '1') {
			$kas_framework->showDangerCallout('This Account is not Active or has been Blocked. <a href="'.$kas_framework->server_root_dir('student/confirmreg').'">Activate?</a> 
				<br /><a href="'.$kas_framework->help_url('?topic=blocked-check-in').'" target="_blank">&raquo;Explanation?</a>');
				$kas_framework->buttonController('#signin', 'disable');
		} else {
			
			$student_rel_id = $loginObj->stdbio_id;
			$admit_status = $kas_framework->getValue('admit', 'studentbio', 'studentbio_id', $student_rel_id);
				
				/* checking for the admit status and then refering to the right link */
				if ($admit_status == '0') { /* meaning that its a prospect student*/
					$_SESSION['tapp_prostd_username'] = $loginObj->user_n;
					$salt = $kas_framework->generateRandomString(20). $kas_framework->generateRandomString(20). $kas_framework->generateRandomString(20) .'&press=pst';
				
				} else if ($admit_status == '1') { /* meaning that its a current and running student */
					$_SESSION['tapp_std_username'] = $loginObj->user_n;
					$_SESSION['loadDiscussionData'] = 0;
					$salt = $kas_framework->generateRandomString(20). $kas_framework->generateRandomString(20). $kas_framework->generateRandomString(20) .'&press=st';
				
				}  else if ($admit_status == '2') { /* meaning that its a graduate... set to classic */
					$_SESSION['tapp_std_username'] = $loginObj->user_n;
					$_SESSION['BasicPlanStudent'] = 'Classic'; /* set the basic plan */
					$salt = $kas_framework->generateRandomString(20). $kas_framework->generateRandomString(20). $kas_framework->generateRandomString(20) .'&press=st';
				
				} else if ($admit_status == '3') { /* meaning that student is suspended */
					$kas_framework->showDangerCallout('You have been Suspended From School. Please Wait until the Ban is Lifted.');
				
				} else if ($admit_status == '4') { /* meaning that student is expelled */
					$kas_framework->showDangerCallout('You have been Expelled From School. Please meet the Admin for any in for this account.');
				
				} else if ($admit_status == '5') { /* meaning that student is transfered */
					$kas_framework->showDangerCallout('Transfered Student Not yet Configured. Please meet the Admin for any in for this account.');
				
				} else if ($admit_status == '6') { /* meaning that student is withdrawn */
					$kas_framework->showDangerCallout('Withdrawn Student Not yet Configured. Please meet the Admin for any in for this account.');
				
				} else if ($admit_status == '7') { /* meaning that student is deceased */
					$kas_framework->showDangerCallout('This account belongs to a Deceased Student. Are you a ghost? Please meet the Admin for any in for this account');
				}
				

			/* update the last logged in info  */
			
			if ($admit_status == '0' or $admit_status == '1' or $admit_status == '2') {
				$kas_framework->showInfoCallout('Logged in. Please wait...');
				$querySQL = "UPDATE web_students SET last_log = '".date('d/m/Y @ H:i:s')."' WHERE user_n = '".$username."' LIMIT 1";
				$db_handle = $dbh->prepare($querySQL);
				$db_handle->execute();
				$db_handle = null;				
				print '<script type="text/javascript"> self.location = "'.$kas_framework->server_root_dir('redirect?httptrack='). $salt. '"</script>';
			}
		
		}
		
	} else {
		//login attempt for the button
		$login_attempt = @$_SESSION['login_atempt'] + 1; //gettting the total login attempts
		$_SESSION['login_atempt'] = $login_attempt;
			
			if ($_SESSION['login_atempt'] >= 3) {
				$kas_framework->showDangerCallout('Check in Temporarily Suspended.
				<br /><a href="'.$kas_framework->help_url('?topic=check-in-suspended').'" target="_blank">&raquo;Explanation?</a>');
				$kas_framework->buttonController('#signin', 'disable');
				$_SESSION['login_atempt'] = 0;  //resetting the total login attempt
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