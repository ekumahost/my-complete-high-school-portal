<?php
require ('../classes/pdoDB.php');
require ('../classes/kas-framework.php');
$kas_framework->safeSession();

extract($_POST);
	/* sweet mailbox cruzer */
		if (isset($_SESSION['tapp_par_username'])) {
			$my_username = $_SESSION['tapp_par_username'];
			$from_category = 'parent';	
		} else if (isset($_SESSION['tapp_std_username'])) {
			$my_username = $_SESSION['tapp_std_username'];
			$from_category = 'student';	
		} else if (isset($_SESSION['tapp_prostd_username'])) {
			$my_username = $_SESSION['tapp_prostd_username'];
			$from_category = 'student';	
		} else if (isset($_SESSION['tapp_staff_username'])) {
			$my_username = $_SESSION['tapp_staff_username'];
			$from_category = 'staff';	
		}

	/* sweet mailbox cruzer */
	$querySQL = "SELECT * FROM general_mailing WHERE id = '".$mailid."' LIMIT 1";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();
	$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;
	
	//processing the sent mail for the starred
	if ($sentOrReceived == 'sent' and $paramGetFields->from_starred == '1') {
		//print 'Star Mail';
		$star_sent_mail = "UPDATE general_mailing SET from_starred = '0' WHERE id = '".$mailid."' AND `from` = '".$my_username."' LIMIT 1";
		$db_handle = $dbh->prepare($star_sent_mail);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$db_handle = null;	

			if ($get_rows == 1) {
				print $kas_framework->showWarningCallout("Starred Succesfully. This Mail will now be in Starred");
				print '<script type="text/javascript"> self.location = "../mailbox/?folder=sent" </script>'; 
			}
	}
	
	//processing the inbox for the starred
	if ($sentOrReceived == 'inbox' and $paramGetFields->to_starred == '1') {
		//print 'Star Mail';
		$star_sent_mail = "UPDATE general_mailing SET to_starred = '0' WHERE id = '".$mailid."' AND `to` = '".$my_username."'";
		$db_handle = $dbh->prepare($star_sent_mail);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		
			if ($get_rows == 1) {
				print $kas_framework->showWarningCallout("Starred Succesfully. This Mail will now be in Starred");
				print '<script type="text/javascript"> self.location = "../mailbox/?folder=inbox" </script>'; 
			}
	} 
	
	//processing the starred folder so that it can be unstarred
	//mailid, session, sentOrRecieved
	
	if ($sentOrReceived == 'unstarred' and $paramGetFields->from_starred == '0') {
		$unstar_starred_mail_1 = "UPDATE general_mailing SET from_starred = '1' WHERE id = '".$mailid."' AND `from` = '".$my_username."'";
		$db_handle = $dbh->prepare($unstar_starred_mail_1);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$db_handle = null;
		
			if ($get_rows == 1) {
				print $kas_framework->showWarningCallout("Unstarred Succesfully. This Mail is restored to its Original Directory");
				print '<script type="text/javascript"> self.location = "../mailbox/?folder=starred" </script>'; 
			}
	} else if ($sentOrReceived == 'unstarred' and $paramGetFields->to_starred == '0') {
		$unstar_starred_mail_2 = "UPDATE general_mailing SET to_starred = '1' WHERE id = '".$mailid."' AND `to` = '".$my_username."'";
		$db_handle = $dbh->prepare($unstar_starred_mail_2);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$db_handle = null;
		
			if ($get_rows == 1) {
				print $kas_framework->showWarningCallout("Unstarred Succesfully. This Mail is restored to its Original Directory");
				print '<script type="text/javascript"> self.location = "../mailbox/?folder=starred" </script>'; 
			}
	}
?>
