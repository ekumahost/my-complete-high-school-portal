<?php
	if (file_exists('../php.files/classes/kas-framework.php')) {
		include ('../php.files/classes/pdoDB.php');
		include ('../php.files/classes/kas-framework.php');
		$kas_framework->safesession();
		include ('../php.files/classes/generalVariables.php');
		include ('../php.files/student_details.php');
	} else if (file_exists('php.files/classes/kas-framework.php')) {
		include ('php.files/classes/pdoDB.php');
		include ('php.files/classes/kas-framework.php');
		$kas_framework->safesession();
		$kas_framework->freeDBConnect();
		include ('php.files/classes/generalVariables.php');
		include ('php.files/student_details.php');
	}

	
	if (isset($_SESSION['tapp_par_username'])) {
		/* if the basic plan is logged in.. that is the parent or others */
		print 'Checking Out...';
			unset($_SESSION['tapp_std_username']);
			unset($_SESSION['BasicPlanStudent']);
			print '<script type="text/javascript">self.location = "'.$kas_framework->server_root_dir('parent/dashpanel/childselector').'" </script>';
			exit;
	} else {
		//updating the last seen
			$logOutQ = "UPDATE web_students SET last_log = '".date('d/m/Y H:i:s')."' WHERE stdbio_id = '".$userid."'";
			$db_handleD = $dbh->prepare($logOutQ);
			$db_handleD->execute();
			$get_rows = $db_handleD->rowCount();
			$db_handleD = null;
		/* else logs out the normal user and redirects to the index page */
			if ($get_rows == 1) {
				//log you out
				print 'Checking Out...';
					unset($_SESSION['tapp_std_username']);
					unset($_SESSION['BasicPlanStudent']);
					print '<script type="text/javascript">self.location = "'.$kas_framework->server_root_dir('redirect').'" </script>';
				exit;
			} else {
				print '<font color="red">Sign Out Failed!</font>';
			}
	}
		
?>