<?php
require ( '../../../../php.files/classes/pdoDB.php');
require ( '../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/student_details.php');
extract($_POST);
	if (!isset($_POST['byepass'])) {
		exit('Error 404: File is Classified');
	}
	
	$deleQ = "DELETE FROM student_calendar WHERE id = '".$_POST['d_id']."' AND creator_id = '".$student_id_original."' LIMIT 1";
	$db_deleQ = $dbh->prepare($deleQ);
	$db_deleQ->execute();
	$get_deleQ_rows = $db_deleQ->rowCount();
	$db_deleQ = null;
	
		if ($get_deleQ_rows == 1) {
			$kas_framework->showInfoCallout('Selected Event was Succesfully Deleted');
			print '<script type="text/javascript"> self.location = "../calendar/#calendar" </script>';
		} else {
			$kas_framework->showalertwarningwithPaleYellow('You cant delete this Event. Its Confidential. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="_blank">Explanation?</a>');
		}
	$db_handle = null;
?>