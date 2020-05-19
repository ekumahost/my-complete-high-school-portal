<?php
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthParent();

extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($byepass)) {
	exit('This File is Classified');
}

	/* check if the child id is already on the list owned by another parent */
	if ($kas_framework->valueExist('student_id', 'parent_to_kids', $childID) == true) {
	  $kas_framework->showDangerCallout('There was an Error Selecting this child. This child is engaged in one activity or the other. If this student is really your Child, Please Contact the School Admin. ');
	} else {
		/***************** proceed by checking if the child has been added before this time************/
	$checkQ = "SELECT * FROM parent_to_kids WHERE parent_id = '".$parentID."' AND student_id = '".$childID."'";
	$db_checkQ = $dbh->prepare($checkQ);
	$db_checkQ->execute();
	$get_checkQ_rows = $db_checkQ->rowCount();
	$db_checkQ = null;
	
		if ($get_checkQ_rows >= 1) {
			$kas_framework->showWarningCallout('This Child Is Already In your List. Please Check. If its not there, then report to the School Admin');
		} else {
	/**********************proceed with the addition and all the wholw stuff *********************/
		$insertion = "INSERT INTO parent_to_kids (parent_id, student_id, confirmation) VALUES('".$parentID."', '".$childID."', '0')";
		$db_insertion = $dbh->prepare($insertion);
		$db_insertion->execute();
		$get_insertion_rows = $db_insertion->rowCount();
		$db_insertion = null;
		
			if ($get_insertion_rows == 1) {
				$kas_framework->showInfoCallout('Child Selection Succesfull. Ownership will be Confirmed by the School');
				print '<script type="text/javascript"> self.location = "'.$kas_framework->url_root('parent/dashpanel/childselector').'" </script>';
			} else {
				$kas_framework->showWarningCallout('Error Processing Request. <a href="'.$kas_framework->help_url('?topic=query-failed').'">Explanation?</a>');
			}
		}
	}
?>