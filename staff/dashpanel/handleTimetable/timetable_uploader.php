<?php
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/staff_details.php');

extract($_POST);
if (!isset($byepass)) {
	exit('This File is Classified');
}

if (isset($_GET['insert_tt'])) {
	extract($_POST);

	$dbh->beginTransaction(); 
	$totalINSERTED = 0;
	$totalSUCCESS = 0;
	$totalTableDataProduced = 0;
	
	foreach ($day AS $deduceDays) { //since the order of the day dosent change

	//inserting for fridays only and this is the least because there is no saturday
	if ($deduceDays == '5') { //if day is friday
			$totalPeriods5 = count($class_period5);
			$totalTableDataProduced = $totalTableDataProduced + $totalPeriods5;
				for ($day5=0; $day5<$totalPeriods5; $day5++) {
					$querySQLF = "INSERT INTO teacher_schedule (teacher_schedule_year, teacher_schedule_schoolid,
						 teacher_schedule_teacherid, teacher_schedule_subjectid, teacher_schedule_termid, teacher_schedule_classperiod
						 	, teacher_schedule_days, teacher_schedule_grade, teacher_schedule_room) 
								VALUES ('".$current_year_id."', '".$staff_school."', '".$staff_id5[$day5]."', '".$subject_id5[$day5]."',
							 '".$currentTerm_id."', '".$class_period5[$day5]."', '".$deduceDays."', '".$grade."', '".$grade_room."')";
							 
							$db_querySQLF = $dbh->prepare($querySQLF);
							$db_querySQLF->execute();
							$get_querySQLF_rows = $db_querySQLF->rowCount();
							$db_querySQLF = null;
							 
									if ($get_querySQLF_rows == 1 and $staff_id5[$day5] != '' and $subject_id5[$day5] != '') {
										$totalINSERTED = $totalINSERTED + 1;
										$totalSUCCESS = $totalSUCCESS + 1;
									} else {
										$totalINSERTED = $totalINSERTED + 1;	
									}
				}
		}
		
	//inserting for thursday days only
	if ($deduceDays == '4') { //if day is thursday
			$totalPeriods4 = count($class_period4);
			$totalTableDataProduced = $totalTableDataProduced + $totalPeriods4;
				for ($day4=0; $day4<$totalPeriods4; $day4++) {
					$querySQLTH = "INSERT INTO teacher_schedule (teacher_schedule_year, teacher_schedule_schoolid,
						 teacher_schedule_teacherid, teacher_schedule_subjectid, teacher_schedule_termid, teacher_schedule_classperiod
						 	, teacher_schedule_days, teacher_schedule_grade, teacher_schedule_room) 
						VALUES ('".$current_year_id."', '".$staff_school."', '".$staff_id4[$day4]."', '".$subject_id4[$day4]."',
							 '".$currentTerm_id."', '".$class_period4[$day4]."', '".$deduceDays."', '".$grade."', '".$grade_room."')";
							 
							$db_querySQLTH = $dbh->prepare($querySQLTH);
							$db_querySQLTH->execute();
							$get_querySQLTH_rows = $db_querySQLTH->rowCount();
							$db_querySQLTH = null;
							
									if ($get_querySQLTH_rows == 1 and $staff_id4[$day4] != '' and $subject_id4[$day4] != '') {
										$totalINSERTED = $totalINSERTED + 1;
										$totalSUCCESS = $totalSUCCESS + 1;
									} else {
										$totalINSERTED = $totalINSERTED + 1;	
									}
				}
		}
		
			//inserting for wednesday days only
	if ($deduceDays == '3') { //if day is wednesday
			$totalPeriods3 = count($class_period3);
			$totalTableDataProduced = $totalTableDataProduced + $totalPeriods3;
				for ($day3=0; $day3<$totalPeriods3; $day3++) {
					$querySQLW = "INSERT INTO teacher_schedule (teacher_schedule_year, teacher_schedule_schoolid,
						 teacher_schedule_teacherid, teacher_schedule_subjectid, teacher_schedule_termid, teacher_schedule_classperiod
						 	, teacher_schedule_days, teacher_schedule_grade, teacher_schedule_room) 
						VALUES ('".$current_year_id."', '".$staff_school."', '".$staff_id3[$day3]."', '".$subject_id3[$day3]."',
							 '".$currentTerm_id."', '".$class_period3[$day3]."', '".$deduceDays."', '".$grade."', '".$grade_room."')";
									
									$db_querySQLW = $dbh->prepare($querySQLW);
									$db_querySQLW->execute();
									$get_querySQLW_rows = $db_querySQLW->rowCount();
									$db_querySQLW = null;
									
									if ($get_querySQLW_rows == 1 and $staff_id3[$day3] != '' and $subject_id3[$day3] != '') {
										$totalINSERTED = $totalINSERTED + 1;
										$totalSUCCESS = $totalSUCCESS + 1;
									} else {
										$totalINSERTED = $totalINSERTED + 1;	
									}
				}
		}
		
				//inserting for tuesdays days only
		if ($deduceDays == '2') { //if day is tuesday
			$totalPeriods2 = count($class_period2);
			$totalTableDataProduced = $totalTableDataProduced + $totalPeriods2;
				for ($day2=0; $day2<$totalPeriods2; $day2++) {
					$querySQLT = "INSERT INTO teacher_schedule (teacher_schedule_year, teacher_schedule_schoolid,
						 teacher_schedule_teacherid, teacher_schedule_subjectid, teacher_schedule_termid, teacher_schedule_classperiod
						 	, teacher_schedule_days, teacher_schedule_grade, teacher_schedule_room) 
						VALUES ('".$current_year_id."', '".$staff_school."', '".$staff_id2[$day2]."', '".$subject_id2[$day2]."',
							 '".$currentTerm_id."', '".$class_period2[$day2]."', '".$deduceDays."', '".$grade."', '".$grade_room."')";
							 
									$db_querySQLT = $dbh->prepare($querySQLT);
									$db_querySQLT->execute();
									$get_querySQLT_rows = $db_querySQLT->rowCount();
									$db_querySQLT = null;
									
									if ($get_querySQLT_rows == 1 and $staff_id2[$day2] != '' and $subject_id2[$day2] != '') {
										$totalINSERTED = $totalINSERTED + 1;
										$totalSUCCESS = $totalSUCCESS + 1;
									} else {
										$totalINSERTED = $totalINSERTED + 1;	
									}
				}
		}
		
		if ($deduceDays == '1') { //if day is monday
			$totalPeriods1 = count($class_period1);
			$totalTableDataProduced = $totalTableDataProduced + $totalPeriods1;
				for ($day1=0; $day1<$totalPeriods1; $day1++) {
					$querySQLM = "INSERT INTO teacher_schedule (teacher_schedule_year, teacher_schedule_schoolid,
						 teacher_schedule_teacherid, teacher_schedule_subjectid, teacher_schedule_termid, teacher_schedule_classperiod
						 	, teacher_schedule_days, teacher_schedule_grade, teacher_schedule_room) 
						VALUES ('".$current_year_id."', '".$staff_school."', '".$staff_id1[$day1]."', '".$subject_id1[$day1]."',
							 '".$currentTerm_id."', '".$class_period1[$day1]."', '".$deduceDays."', '".$grade."', '".$grade_room."')";
							 
							 $db_querySQLM = $dbh->prepare($querySQLM);
									$db_querySQLM->execute();
									
									$get_db_querySQLM_rows = $db_querySQLM->rowCount();
									$db_querySQLM = null;
									
									if ($get_db_querySQLM_rows == 1 and $staff_id1[$day1] != '' and $subject_id1[$day1] != '') {
										$totalINSERTED = $totalINSERTED + 1;
										$totalSUCCESS = $totalSUCCESS + 1;
									} else {
										$totalINSERTED = $totalINSERTED + 1;	
									}
				}
		}
		
	}
	
		
	if ($totalINSERTED == $totalTableDataProduced) {
		$dbh->commit();
		$kas_framework->showInfoCallout('<b>'.$totalSUCCESS.'</b> of <b>'.$totalTableDataProduced.'</b> Timetable Field Inserted. Please Review it for any clash in your Menu <b>Academic Tools</b> &raquo; <b>School Timetable</b>');
		print '<script> $(\'#proceed_div1\').slideUp(2000);</script>'; /**/
		exit;
	} else {
		$kas_framework->showWarningCallout('Could not Insert timetable. Please try again some other time');
		$dbh->rollBack();
		exit;	
	}
}

if (isset($_GET['edit_tt'])) {
	extract($_POST);
	$dbh->beginTransaction(); 
	$totalINSERTED = 0;
	$totalSUCCESS = 0;
	$totalTableDataProduced = 0;
	
	foreach ($day AS $deduceDays) { //since the order of the day dosent change
		//editing for fridays only and this is the least because there is no saturday
		if ($deduceDays == '5') { //if day is friday
				$totalPeriods5 = count($class_period5);
				$totalTableDataProduced = $totalTableDataProduced + $totalPeriods5;
					for ($day5=0; $day5<$totalPeriods5; $day5++) {
						$querySQLF = "UPDATE teacher_schedule SET teacher_schedule_subjectid = '".$subject_id5[$day5]."', teacher_schedule_teacherid = '".$staff_id5[$day5]."' WHERE teacher_schedule_year = '".$current_year_id."' AND teacher_schedule_schoolid = '".$staff_school."' AND teacher_schedule_termid = '".$currentTerm_id."' AND teacher_schedule_classperiod = '".$class_period5[$day5]."' AND teacher_schedule_days = '".$deduceDays."' AND teacher_schedule_grade = '".$grade."' AND teacher_schedule_room = '".$grade_room."'";
						$db_querySQLF = $dbh->prepare($querySQLF);
						$db_querySQLF->execute();
						$get_querySQLF_rows = $db_querySQLF->rowCount();
						$db_querySQLF = null;
						if ($get_querySQLF_rows == 1) {
							$totalINSERTED = $totalINSERTED + 1;
							$totalSUCCESS = $totalSUCCESS + 1;
						} else {
							$totalINSERTED = $totalINSERTED + 1;	
						}
					}
			}
			
			//editing for thursdays only
		if ($deduceDays == '4') { //if day is thursday
				$totalPeriods4 = count($class_period4);
				$totalTableDataProduced = $totalTableDataProduced + $totalPeriods4;
					for ($day4=0; $day4<$totalPeriods4; $day4++) {
						$querySQLTH = "UPDATE teacher_schedule SET teacher_schedule_subjectid = '".$subject_id4[$day4]."', teacher_schedule_teacherid = '".$staff_id4[$day4]."' WHERE teacher_schedule_year = '".$current_year_id."' AND teacher_schedule_schoolid = '".$staff_school."' AND teacher_schedule_termid = '".$currentTerm_id."' AND teacher_schedule_classperiod = '".$class_period4[$day4]."' AND teacher_schedule_days = '".$deduceDays."' AND teacher_schedule_grade = '".$grade."' AND teacher_schedule_room = '".$grade_room."'";
						$db_querySQLTH = $dbh->prepare($querySQLTH);
						$db_querySQLTH->execute();
						$get_querySQLTH_rows = $db_querySQLTH->rowCount();
						$db_querySQLTH = null;
						if ($get_querySQLTH_rows == 1) {
							$totalINSERTED = $totalINSERTED + 1;
							$totalSUCCESS = $totalSUCCESS + 1;
						} else {
							$totalINSERTED = $totalINSERTED + 1;	
						}
					}
			}
			
		//editing for wednesdays
		if ($deduceDays == '3') { //if day is wednesdays
				$totalPeriods3 = count($class_period3);
				$totalTableDataProduced = $totalTableDataProduced + $totalPeriods3;
					for ($day3=0; $day3<$totalPeriods3; $day3++) {
						$querySQLW = "UPDATE teacher_schedule SET teacher_schedule_subjectid = '".$subject_id3[$day3]."', teacher_schedule_teacherid = '".$staff_id3[$day3]."' WHERE teacher_schedule_year = '".$current_year_id."' AND teacher_schedule_schoolid = '".$staff_school."' AND teacher_schedule_termid = '".$currentTerm_id."' AND teacher_schedule_classperiod = '".$class_period3[$day3]."' AND teacher_schedule_days = '".$deduceDays."' AND teacher_schedule_grade = '".$grade."' AND teacher_schedule_room = '".$grade_room."'";
						$db_querySQLW = $dbh->prepare($querySQLW);
						$db_querySQLW->execute();
						$get_querySQLW_rows = $db_querySQLW->rowCount();
						$db_querySQLW = null;
						if ($get_querySQLW_rows == 1) {
							$totalINSERTED = $totalINSERTED + 1;
							$totalSUCCESS = $totalSUCCESS + 1;
						} else {
							$totalINSERTED = $totalINSERTED + 1;	
						}
					}
			}
			
				//editing for tuesdays only
		if ($deduceDays == '2') { //if day is tuesday
				$totalPeriods2 = count($class_period2);
				$totalTableDataProduced = $totalTableDataProduced + $totalPeriods2;
					for ($day2=0; $day2<$totalPeriods2; $day2++) {
						$querySQLT = "UPDATE teacher_schedule SET teacher_schedule_subjectid = '".$subject_id2[$day2]."', teacher_schedule_teacherid = '".$staff_id2[$day2]."' WHERE teacher_schedule_year = '".$current_year_id."' AND teacher_schedule_schoolid = '".$staff_school."' AND teacher_schedule_termid = '".$currentTerm_id."' AND teacher_schedule_classperiod = '".$class_period2[$day2]."' AND teacher_schedule_days = '".$deduceDays."' AND teacher_schedule_grade = '".$grade."' AND teacher_schedule_room = '".$grade_room."'";
						$db_querySQLT = $dbh->prepare($querySQLT);
						$db_querySQLT->execute();
						$get_querySQLT_rows = $db_querySQLT->rowCount();
						$db_querySQLT = null;
						if ($get_querySQLT_rows == 1) {
							$totalINSERTED = $totalINSERTED + 1;
							$totalSUCCESS = $totalSUCCESS + 1;
						} else {
							$totalINSERTED = $totalINSERTED + 1;	
						}
					}
			}
			
				//editing for mondays only
		if ($deduceDays == '1') { //if day is monday
				$totalPeriods1 = count($class_period1);
				$totalTableDataProduced = $totalTableDataProduced + $totalPeriods1;
					for ($day1=0; $day1<$totalPeriods1; $day1++) {
						$querySQLM = "UPDATE teacher_schedule SET teacher_schedule_subjectid = '".$subject_id1[$day1]."', teacher_schedule_teacherid = '".$staff_id1[$day1]."' WHERE teacher_schedule_year = '".$current_year_id."' AND teacher_schedule_schoolid = '".$staff_school."' AND teacher_schedule_termid = '".$currentTerm_id."' AND teacher_schedule_classperiod = '".$class_period1[$day1]."' AND teacher_schedule_days = '".$deduceDays."' AND teacher_schedule_grade = '".$grade."' AND teacher_schedule_room = '".$grade_room."'";
						$db_querySQLM = $dbh->prepare($querySQLM);
						$db_querySQLM->execute();
						$get_querySQLM_rows = $db_querySQLM->rowCount();
						$db_querySQLM = null;
						if ($get_querySQLM_rows == 1) {
							$totalINSERTED = $totalINSERTED + 1;
							$totalSUCCESS = $totalSUCCESS + 1;
						} else {
							$totalINSERTED = $totalINSERTED + 1;	
						}
					}
			}

	}
	
	if ($totalINSERTED == $totalTableDataProduced) {
		$dbh->commit();
		$calloutWaver = ($totalSUCCESS == 0)? 'showDangerCallout': 'showInfoCallout';
		$kas_framework->$calloutWaver('<b>'.$totalSUCCESS.'</b> of <b>'.$totalTableDataProduced.'</b> Timetable Field Edited. Please Review it for any clash in your Menu <b>Academic Tools</b> &raquo; <b>School Timetable</b>');
		/*print '<script> $(\'#proceed_div1\').slideUp(2000);</script>'; */
		exit;
	} else {
		$dbh->rollBack();
		$kas_framework->showWarningCallout('Could not Edit this Timetable. Please try again some other time');
		exit;	
	}
}

if (isset($_GET['hyperCopy'])) {
	extract($_POST);
	//print_r($_POST);
	//Array ( [gradeYear] => 1 [schoolID] => 0 [termID] => 2 [byepass] => kljbGVTYECERDFNUYmi )
	//values from general $current_year_id; $currentTerm_id
	$getAllTT = "SELECT * FROM teacher_schedule WHERE teacher_schedule_year = '".$gradeYear."' AND teacher_schedule_schoolid = '".$schoolID."'AND teacher_schedule_termid = '".$termID."'";
	$db_getAllTT = $dbh->prepare($getAllTT);
	$db_getAllTT->execute();
	$total_values_in_db = $db_getAllTT->rowCount();
	
	//Making sure that the current year and session are not being repeated
	if (($gradeYear == $current_year_id) and ($currentTerm_id == $termID)) {
		$kas_framework->showWarningCallout("Error! This timetable seems to exist in our database. Please verify the term and the Academic Year");
	} else {
		$countInserted = 0;
		$dbh->beginTransaction();
		//copying all the timetable to the current term, we run this crazy script.
		while ($detailsFromotherTerm = $db_getAllTT->fetch(PDO::FETCH_OBJ)) {
			$querySQL = "INSERT INTO teacher_schedule (teacher_schedule_year, teacher_schedule_schoolid,
						 teacher_schedule_teacherid, teacher_schedule_subjectid, teacher_schedule_termid, teacher_schedule_classperiod
						 	, teacher_schedule_days, teacher_schedule_grade, teacher_schedule_room) 
						VALUES ('".$current_year_id."', '".$staff_school."', '".$detailsFromotherTerm->teacher_schedule_teacherid."', 
						'".$detailsFromotherTerm->teacher_schedule_subjectid."', '".$currentTerm_id."', 
						'".$detailsFromotherTerm->teacher_schedule_classperiod."', '".$detailsFromotherTerm->teacher_schedule_days."', 
						'".$detailsFromotherTerm->teacher_schedule_grade."', '".$detailsFromotherTerm->teacher_schedule_room."')"; /**/
							$db_querySQL = $dbh->prepare($querySQL);
							$db_querySQL->execute();
							$get_db_querySQL_rows = $db_querySQL->rowCount();
							$db_querySQL = null;
								if ($get_db_querySQL_rows == 1) {
									$countInserted = $countInserted + 1;
								}
			}
			$db_getAllTT = null;
		if ($countInserted == $total_values_in_db) {
			$dbh->commit();
			$kas_framework->showInfoCallout("Nice Job! Time Table Copied to this Current Term. Timetable is available for editing.");
		} else {
			$dbh->rollBack();
			$kas_framework->showWarningCallout("Error! Could not Copy Time table. Please Try again later.");
		}
	}
		
}
?>