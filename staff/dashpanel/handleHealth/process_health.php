<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/staff_details.php');
extract($_POST);

//make sure that the file is not directly accessed from the url
/* student, student_school, year, date_submitted, term, grade, who_submitted*/
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed Via Link');
}
	if ($_GET['request'] == 'add_allergy') {
		if ($kas_framework->strIsEmpty($allergy_code) or $kas_framework->strIsEmpty($allergy_note)) {
			$kas_framework->showDangerCallout('Please All fields are Compulsory. Fill them');
			$kas_framework->buttonController('.btn-primary', 'enable');
		} else {
			$check_duplicate_allergy = "SELECT COUNT(*) AS cnt FROM health_allergy_history WHERE health_allergy_history_student = '".$student."' 
					AND health_allergy_history_year = '".$year."' AND health_allergy_history_code = '".$allergy_code."' AND health_allergy_history_term = '".$term."'";
					$db_check_duplicate_allergy = $dbh->prepare($check_duplicate_allergy);
					$db_check_duplicate_allergy->execute();
					$db_check_Obj =  $db_check_duplicate_allergy->fetch(PDO::FETCH_OBJ);
					$get_check_duplicate_allergy_rows = $db_check_Obj->cnt;
					$db_check_duplicate_allergy = null;
						//if (!$check_duplicate_allergy) { print mysql_error(); }
						if ($get_check_duplicate_allergy_rows >= 1) {
							$kas_framework->showDangerCallout('Duplicate Entry for Allergy. Check.. this entry has been Added before.');
							$kas_framework->buttonController('.btn-primary', 'enable');
						} else {
							$insert_allergy = "INSERT INTO health_allergy_history (health_allergy_history_student, health_allergy_history_year, health_allergy_history_term, health_allergy_history_school, health_allergy_history_code, health_allergy_history_date, health_allergy_history_notes, health_allergy_history_user) 
								VALUES ('".$student."', '".$year."', '".$term."', '".$student_school."', '".$allergy_code."', 
												'".$date_submitted."', '".$kas_framework->secureStr($allergy_note)."', '".$who_submitted."')";
												$db_insert_allergy = $dbh->prepare($insert_allergy);
												$db_insert_allergy->execute();
												$get_insert_allergy_rows = $db_insert_allergy->rowCount();
												$db_insert_allergy = null;
													if ($get_insert_allergy_rows == 1) {
														$kas_framework->showInfoCallout('Updated Succesfully.');
														$kas_framework->buttonController('.btn-primary', 'enable');
														$kas_framework->formReset('#allergy_form');
													} else {
														$kas_framework->showWarningCallout('Update Failed. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
														$kas_framework->buttonController('.btn-primary', 'enable');
														$kas_framework->formReset('#allergy_form');
														//print mysql_error();
				}
						}
		}
	} else if ($_GET['request'] == 'add_immunz') {
		if ($kas_framework->strIsEmpty($immunz_code) or $kas_framework->strIsEmpty($immunz_note)) {
			$kas_framework->showDangerCallout('Please All fields are Compulsory. Fill them');
			$kas_framework->buttonController('.btn-primary', 'enable');
		} else {
			$check_duplicate_immunz = "SELECT COUNT(*) AS cnt FROM health_immunz_history WHERE health_immunz_history_student = '".$student."' 
					AND health_immunz_history_year = '".$year."' AND health_immunz_history_code = '".$immunz_code."'
					AND health_immunz_history_term = '".$term."' AND health_immunz_history_date = '".$date_submitted."'";
					$db_check_duplicate_immunz = $dbh->prepare($check_duplicate_immunz);
					$db_check_duplicate_immunz->execute();
					$db_check_Obj =  $db_check_duplicate_immunz->fetch(PDO::FETCH_OBJ);
					$get_check_duplicate_imunize_rows = $db_check_Obj->cnt;
					$db_check_duplicate_immunz = null;
						//if (!$check_duplicate_immunz) { print mysql_error(); }
						
						if ($get_check_duplicate_imunize_rows >= 1) {
							$kas_framework->showDangerCallout('Duplicate Entry for Immunize. Check.. this entry has been Added before.');
							$kas_framework->buttonController('.btn-primary', 'enable');
						} else {
							$insert_allergy = "INSERT INTO health_immunz_history (health_immunz_history_student, health_immunz_history_year, health_immunz_history_term, health_immunz_history_school, health_immunz_history_code, health_immunz_history_date, health_immunz_history_notes, health_immunz_history_user)
								VALUES ('".$student."', '".$year."', '".$term."', '".$student_school."', '".$immunz_code."', 
											'".$date_submitted."', '".$kas_framework->secureStr($immunz_note)."', '".$who_submitted."')";
											$db_insert_allergy = $dbh->prepare($insert_allergy);
											$db_insert_allergy->execute();
											$get_insert_allergy_rows = $db_insert_allergy->rowCount();
											$db_insert_allergy = null;
								if ($get_insert_allergy_rows == 1) {
										$kas_framework->showInfoCallout('Updated Succesfully.');
										$kas_framework->buttonController('.btn-primary', 'enable');
										$kas_framework->formReset('#immunz_form');
									} else {
										$kas_framework->showWarningCallout('Update Failed. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
										$kas_framework->buttonController('.btn-primary', 'enable');
										//print mysql_error();
									}
						}
		}
	} else if ($_GET['request'] == 'add_health_history') {
		if ($kas_framework->strIsEmpty($health_code) or $kas_framework->strIsEmpty($health_med1) or $kas_framework->strIsEmpty($health_note)) {
			$kas_framework->showDangerCallout('Please All fields are Compulsory. Fill them');
			$kas_framework->buttonController('.btn-primary', 'enable');
			} else {
				$check_duplicate_health = "SELECT COUNT(*) AS cnt FROM health_history WHERE health_history_student = '".$student."' 
					AND health_history_year = '".$year."' AND health_history_code = '".$health_code."'
					AND health_history_term = '".$term."' AND health_history_date = '".$date_submitted."'";
						//if (!$check_duplicate_immunz) { print mysql_error(); }
						$db_check_duplicate_health = $dbh->prepare($check_duplicate_health);
						$db_check_duplicate_health->execute();
						$db_check_Obj =  $db_check_duplicate_health->fetch(PDO::FETCH_OBJ);
						$get_check_duplicate_health_rows = $db_check_Obj->cnt;
						$db_check_duplicate_health = null;
						if ($get_check_duplicate_health_rows >= 1) {
							$kas_framework->showDangerCallout('Duplicate Entry for Health History. Check.. this entry has been Added before.');
							$kas_framework->buttonController('.btn-primary', 'enable');
						} else {
						$insert = "INSERT INTO health_history (health_history_student, health_history_school, health_history_year, health_history_term, health_history_code, health_history_medicine_1, health_history_medicine_2, health_history_date, health_history_notes, health_history_user)
							VALUES ('".$student."', '".$student_school."', '".$year."', '".$term."', '".$health_code."', 
							'".$health_med1."', '".$health_med2."', '".$date_submitted."', :health_note, '".$who_submitted."')";
								$db_insert = $dbh->prepare($insert);
								$db_insert->bindParam(':health_note', $health_note);
								$db_insert->execute();
								$get_insert_rows = $db_insert->rowCount();
								$db_insert_allergy = null;
											
								if ($get_insert_rows == 1) {
									$kas_framework->showInfoCallout('Updated Succesfully.');
									$kas_framework->buttonController('.btn-primary', 'enable');
									$kas_framework->formReset('#health_history_form');
								} else {
									$kas_framework->showWarningCallout('Update Failed. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
									$kas_framework->buttonController('.btn-primary', 'enable');
									//print mysql_error();
								}
						}
			} //end of else
	}

?>	