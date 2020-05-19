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
	exit('Error 404: File Cannot be Accessed Via Link');
}

	if ($kas_framework->strIsEmpty($att_code) or $kas_framework->strIsEmpty($note)) {
		$kas_framework->showDangerCallout('Please All fields are Compulsory. Fill them.');
		$kas_framework->buttonController('.btn-primary', 'enable');
	} else {
		$checkDuplicate = "SELECT * FROM attendance_history WHERE attendance_history_student = '".$student."'
		AND attendance_history_school = '".$student_school."' AND attendance_history_date = '".$date_submitted."'";
		$db_checkDuplicate = $dbh->prepare($checkDuplicate);
		$db_checkDuplicate->execute();
		$get_checkDuplicate_rows = $db_checkDuplicate->rowCount();
		$db_checkDuplicate = null;
			
				if ($get_checkDuplicate_rows > 0) {
					$kas_framework->showDangerCallout('A Record has been Added for this Child Missing Attendance today. Please Check the Table below. Someone else updated this.
					If the Record Updated for this Child is Wrong, <a href="'.$kas_framework->url_root('staff/dashpanel/mailbox?folder=indox&&report=admin').'">Drop a Query to the Admin?</a>');
					$kas_framework->buttonController('.btn-primary', 'enable');
				} else {
					$insertQ = "INSERT INTO attendance_history (attendance_history_student, attendance_history_school, attendance_history_term, attendance_history_grade, attendance_history_year, attendance_history_date, attendance_history_code, attendance_history_notes, attendance_history_user)
					VALUES ('".$student."', '".$student_school."','".$term."', '".$grade."', '".$year."', '".$date_submitted."', '".$att_code."', :note, '".$who_submitted."')";
						$db_insertQ = $dbh->prepare($insertQ);
						$db_insertQ->bindParam(':note', $note);
						$db_insertQ->execute();
						$get_insertQ_rows = $db_insertQ->rowCount();
						$db_insertQ = null;
						
					/* checking if the query ran if (!$runQ) { print print mysql_error(); } */	
						if ($get_insertQ_rows == 1) {
							$kas_framework->showInfoCallout('Updated Succesfully. Please Refresh the Panel to View Details.');
							print '<script type="text/javascript"> self.location = "#studentAttendanceTable" </script>';
							$kas_framework->formReset('#update_attendance');
						} else {
							$kas_framework->showWarningCallout('Update Failed. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
							$kas_framework->buttonController('.btn-primary', 'enable');
							//print mysql_error();
						}
				}
	}

?>