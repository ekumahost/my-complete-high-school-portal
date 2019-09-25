<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/staff_details.php');
extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed via Link');
}
	
	if ($kas_framework->strIsEmpty($infrac_code) or $kas_framework->strIsEmpty($sdate) or $kas_framework->strIsEmpty($edate) or $kas_framework->strIsEmpty($action) 
	or $kas_framework->strIsEmpty($note) or $kas_framework->strIsEmpty($reporter)) {
		$kas_framework->showDangerCallout('Please All fields are Compulsory. Fill them');
		$kas_framework->buttonController('.btn-primary', 'enable');
	} else {
		$insertQ = "INSERT INTO discipline_history (discipline_history_student, discipline_history_school, discipline_history_term, discipline_history_grade, discipline_history_year, discipline_history_code, 
		discipline_history_date, discipline_history_sdate, discipline_history_edate, discipline_history_action, discipline_history_notes, discipline_history_reporter, discipline_history_user)
		VALUES ('".$student."', '".$student_school."', '".$term."', '".$grade."', '".$year."', '".$infrac_code."', 
				'".$date_submitted."', '".$sdate."', '".$edate."', :action, :note, :reporter, '".$who_submitted."')";
				$db_insertQ = $dbh->prepare($insertQ);
				$db_insertQ->bindParam(':action', $action); $db_insertQ->bindParam(':note', $note); $db_insertQ->bindParam(':reporter', $reporter); 
				$db_insertQ->execute();
				$get_insertQ_rows = $db_insertQ->rowCount();
				$db_insertQ = null;
			/* checking if the query ran  // if (!$runQ) { print print mysql_error(); } */
				if ($get_insertQ_rows == 1) {
					$kas_framework->showInfoCallout('Updated Succesfully. Please Refresh the Panel to View Details.');
					echo '<script type="text/javascript"> self.location = "#studentDisciplineTable" </script>';
					$kas_framework->formReset('#update_discipline');
				} else {
					$kas_framework->showWarningCallout('Update Failed. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
					$kas_framework->buttonController('.btn-primary', 'enable');
					//print mysql_error();
				}
	}

?>