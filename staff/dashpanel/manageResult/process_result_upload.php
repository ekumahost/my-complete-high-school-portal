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

/***********************************************************************************/
	function deduce_grade_class($grade_class) {
		$newGeneral = new kas_framework();
		require ('../../../php.files/classes/pdoDB.php');
		$sel = "SELECT * FROM school_rooms WHERE room_grade = '".$grade_class."'";
		$db_sel = $dbh->prepare($sel);
		$db_sel->execute();
		$get_sel_rows = $db_sel->rowCount();
		$db_sel = null;
			if ($get_sel_rows == 0) {
				print '<input type="hidden" value="0" name="grade_room" />';
				$newGeneral->buttonController('#generate_button', 'enable');
			} else {
				print '<select name="grade_room" id="grade_room">';
					$newGeneral->getallFieldinDropdownOptionWithRestriction('school_rooms', 'school_rooms_desc', 'room_grade', $grade_class, 'school_rooms_id');
				print '</select>';
				$newGeneral->buttonController('#generate_button', 'enable');
			}
	}

	/***********************************************************************************/
	function check_if_result_is_uploaded_before_for_student($year, $term, $subject, $student, $grade): bool {
		require ('../../../php.files/classes/pdoDB.php');
		$exist_query = "SELECT * FROM grade_history_primary WHERE year = '".$year."' AND quarter = '".$term."'
							AND course_code = '".$subject."' AND student = '".$student."' AND level_taken = '".$grade."' LIMIT 1";
			$db_exist_query = $dbh->prepare($exist_query);
			$db_exist_query->execute();
			$get_exist_query_rows = $db_exist_query->rowCount();
			$db_exist_query = null;			
						return ($get_exist_query_rows >= 1)? true: false;
	}

	/***********************************************************************************/
	function generate_result() {
		$newGeneral = new kas_framework();
		extract($_POST);
		global $currentTerm_id;
		global $current_year_id;
		require ('../../../php.files/classes/pdoDB.php');
		
		if ($newGeneral->strIsEmpty($subject) or $newGeneral->strIsEmpty($grade) or $newGeneral->strIsEmpty($grade_room)) {
			$newGeneral->showDangerCallout('Please Select all the Fields.');
		} else {
			/* getting the names of the student for the result check */
			$get_students_details_for_check = "SELECT * FROM student_grade_year AS sgy, studentbio AS sb WHERE sgy.student_grade_year_grade = '".$grade."' 
											AND sgy.student_grade_year_class_room = '".$grade_room."' AND sb.admit = '1'
												AND sb.studentbio_id = sgy.student_grade_year_student";
					$db_get_students_details_for_check = $dbh->prepare($get_students_details_for_check);
					$db_get_students_details_for_check->execute();					
										
			while ($ooPCheck = $db_get_students_details_for_check->fetch(PDO::FETCH_OBJ)) {							
				if (check_if_result_is_uploaded_before_for_student($current_year_id, $currentTerm_id, $subject, $ooPCheck->studentbio_id, $grade) == true){
					$newGeneral->showDangerCallout('Fatal Error. This Result already Exist in the Database... Please Confirm');
					exit;
				}
			}						
		$db_get_students_details_for_check = null;		
		/* produce the table of students */
			$sn = 0; /* initializing the serial */
			$get_students_details_for_result = "SELECT * FROM student_grade_year AS sgy, studentbio AS sb WHERE sgy.student_grade_year_grade = '".$grade."' 
										AND sgy.student_grade_year_class_room = '".$grade_room."' AND sgy.student_grade_year_year = '".$current_year_id."'
											AND sb.studentbio_id = sgy.student_grade_year_student AND sb.admit = '1'";
								$db_get_students_details_for_result = $dbh->prepare($get_students_details_for_result);
								$db_get_students_details_for_result->execute();								
								$total_rows_gotten = $db_get_students_details_for_result->rowCount();
								
				print '<div class="row">
						 <div class="col-xs-12">
							<div class="box">
								<form action="" method="post" id="insert_result_form">
								<div class="box-header">
									<h3 class="box-title">All Students in the Selected Class ('.$total_rows_gotten.')</h3>                                    
								</div>
								<div class="box-body table-responsive">
									<table id="example1" class="table table-bordered table-striped">
									   <thead>
											<tr>
												<th>S/N</th>
												<th>Student</th>
												<th>Additional</th>
												<th>CA 1</th>
												<th>CA 2</th>
												<th>Exam</th>
												<th>Comment</th>
											</tr>
										</thead>
										<tbody>';
										
						while ($viewMyStds = $db_get_students_details_for_result->fetch(PDO::FETCH_OBJ)) {
							$stdImage = $viewMyStds->studentbio_pictures;
							$stdSex = $viewMyStds->studentbio_gender;
							$imgUrl = $newGeneral->imageDynamic($stdImage, $stdSex, $newGeneral->url_root('pictures/'));
							$student_deduced_id = $viewMyStds->studentbio_id;
							
							$sn = $sn + 1;
							print '<tr><td>'.$sn.'</td>
							<td>'.$viewMyStds->studentbio_internalid.' <br />'.$newGeneral->getValue('title_desc', 'tbl_titles', 'title_id', $viewMyStds->studentbio_title).' 
								'.$viewMyStds->studentbio_lname.' '.$viewMyStds->studentbio_fname.'&nbsp;&nbsp;<a href="'.$imgUrl.'" class="fancybox fancybox.image no-print" width="50" title="Picture"><i class="fa fa-picture-o"></i></a></td>
								<td>DOB: '.$viewMyStds->studentbio_dob.'<br />Sex: '.$stdSex.'</td>';
							print '<td><input type="text" required="required" class="ca" name="ca1[]" placeholder="20" maxlength="2" /></td>
							<td><input type="text" required="required" class="ca" name="ca2[]" placeholder="20" maxlength="2" /></td>
							<td><input type="text" required="required" class="exam" name="exam[]" placeholder="60" maxlength="3" /></td>
							<td><textarea name="comment[]" maxlength="60" required="required"  placeholder="Your Comment..."></textarea></td>
							<input type="hidden" name="student_id[]" value="'.$viewMyStds->studentbio_id.'" />
							</tr>';
						}
					$db_get_students_details_for_result = null;
							print '</tbody>
							</table>
						</div>
						<div class="box-footer">
								<input type="hidden" name="total_student_in_class" value="'.$total_rows_gotten.'" />
								<input type="hidden" name="subject" value="'.$subject.'" />
								<input type="hidden" name="level_taken" value="'.$grade.'" />
								<input type="hidden" name="byepass" value="UKH43dnRTVBIUuNUIHUjopi" />
								<a href="#" id="first_check" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Upload Result</a>
									
									<span id="insert_result_span" style="display:none">  Are you Sure of this? &nbsp;&nbsp;
										<button type="submit" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Send Result Online</button>
										<a id="dontInsert" class="btn btn-danger"><i class="fa fa-times"></i> Dont Send.. Wait </a>
									</span>
							</div>
						</form>
					</div>
				</div>
			</div>';
		} /* end the else for case not empty */
	}
	/***********************************************************************************/
	function insert_result($total_ret) {
		$newGeneral = new kas_framework();
		require ('../../../php.files/classes/pdoDB.php');
		global $currentTerm_id; global $current_year_id; global $web_users_relid; 
		extract($_POST);
		$dbh->beginTransaction();
		
		$count_insert = 0; 	$skipped_and_unskipped = 0;
		/* looping for the total student in the class */
		for ($i=0; $i < $total_ret; $i++) {
			/* checking if any student score was empty */
			if ($newGeneral->strIsEmpty($ca1[$i]) or $newGeneral->strIsEmpty($ca2[$i]) or $newGeneral->strIsEmpty($exam[$i]) or $newGeneral->strIsEmpty($comment[$i])) {
				$error_log = $i + 1;
				$newGeneral->showDangerCallout('One Field is Empty. Check around Serial Number "<b>'.$error_log.'</b>". Result Upload Failed.');
				exit;
			} else if ($ca1[$i] > 20 or $ca2[$i] > 20 or $exam[$i] > 60) {
				$error_log = $i + 1;
				$newGeneral->showDangerCallout('An Abnormal Score was Detected. Check around Serial Number "<b>'.$error_log.'</b>". CA or Exam Score Exceeds Maximum Score Allowed. Result Upload Failed.');
				exit;
			} else if ((!is_numeric($ca1[$i]) and $ca1[$i] != '-') or (!is_numeric($ca2[$i])  and $ca2[$i] != '-') or (!is_numeric($exam[$i])  and $exam[$i] != '-')) {
				$error_log = $i + 1;
				$newGeneral->showDangerCallout('A Non Numeric Input was Detected. Check around Serial Number "<b>'.$error_log.'</b>". Result Upload Failed.');
				exit;
			} else {
				/* making sure tha the subject has not been uploaded for the student before */
				if (check_if_result_is_uploaded_before_for_student($current_year_id, $currentTerm_id, $subject, $student_id[$i], $level_taken) == false){
					/* checking if dash was put in the students ca and exam and comment.... meaning that the student is not offering the subject*/
						if ($ca1[$i] == '-' and $ca2[$i] == '-' and $exam[$i] == '-' and $comment[$i] == '-') {
							/* meaning that the student is not offering the subject */
							/* just skip this student and then add the skipped and unskipped */
							$skipped_and_unskipped = $skipped_and_unskipped + 1; /* increment the total queries encountered */
						} else {
							/* otherwise, insert into the database */
						$insert = "INSERT INTO grade_history_primary (exam_type, student, year, quarter, course_code, ca_score1, ca_score2, exam_score, level_taken, `date`, aprove, notes, user) VALUES ('1', '".$student_id[$i]."', '".$current_year_id."', 
							'".$currentTerm_id."', '".$subject."', '".$ca1[$i]."', '".$ca2[$i]."', '".$exam[$i]."', '".$level_taken."', '".date('d/m/Y')."', '1', '".$comment[$i]."', '".$web_users_relid."')";
								$db_insert = $dbh->prepare($insert);
								$db_insert->execute();
								$get_rows = $db_insert->rowCount();								
									if ($get_rows == 1) {
										$count_insert = $count_insert + 1; /* increment the total uploaded*/
										$skipped_and_unskipped = $skipped_and_unskipped + 1; /* increment the total queries encountered */
									}
						}
					} /* making sure that the result is not uploaded beforte loop ends */
			}/* checking for empty strings ends */			
		} /* for loop initiation ends */	
		$db_insert = null;
		if ($total_ret == $skipped_and_unskipped) {
			$newGeneral->showInfoCallout($count_insert. ' of '.$total_ret.' Student(s) Result Uploaded Succesfully');
			print '<script> $(\'#proceed_div1\').slideUp(2000);</script>';
			$dbh->commit(); exit;
		} else {
			$newGeneral->showDangerCallout('Result Upload Failed. Maybe Result already Exist in the database Already');
			$dbh->rollBack(); exit;
		}	
	}	

/***********************************************************************************/
	function generate_result_for_edit() {
		$newGeneral = new kas_framework();
		extract($_POST);
		require ('../../../php.files/classes/pdoDB.php');
		
		if ($newGeneral->strIsEmpty($levelTaken) or $newGeneral->strIsEmpty($termTaken) or $newGeneral->strIsEmpty($courseCode) or $newGeneral->strIsEmpty($staffID) or $newGeneral->strIsEmpty($ultimYear)) {
			$newGeneral->showDangerCallout('Error Occured. Result cannot be Edited');
		} else {
			$dripQuery = "SELECT * FROM studentbio AS sb, grade_history_primary AS ghp WHERE ghp.level_taken = '".$levelTaken."' AND ghp.quarter = '".$termTaken."'
				AND ghp.course_code = '".$courseCode."' AND ghp.year = '".$ultimYear."' AND ghp.user = '".$staffID."' AND sb.studentbio_id = ghp.student AND sb.admit = '1'";
				$db_dripQuery = $dbh->prepare($dripQuery);
				$db_dripQuery->execute();
				$total_rows_gotten = $db_dripQuery->rowCount();
				
				$sn = 0; // initializing the serial
				print '<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<form action="" method="post" id="edit_result_form">
								<div class="box-header">
									<h3 class="box-title">All Result Uploaded for this Selection ('.$total_rows_gotten.')</h3>                                    
								</div>
								<div class="box-body table-responsive">
									<table id="example1" class="table table-bordered table-striped">
									   <thead>
											<tr>
												<th>S/N</th>
												<th>Student</th>
												<th>Additional</th>
												<th>CA 1</th>
												<th>CA 2</th>
												<th>Exam</th>
												<th>Comment</th>
											</tr>
										</thead>
										<tbody>';
										
								while ($reproduceResult = $db_dripQuery->fetch(PDO::FETCH_OBJ)) {
									$stdImage = $reproduceResult->studentbio_pictures;
									$stdSex = $reproduceResult->studentbio_gender;
									$imgUrl = $newGeneral->imageDynamic($stdImage, $stdSex, $newGeneral->url_root('pictures/'));
									$student_deduced_id = $reproduceResult->studentbio_id;
									
									$sn = $sn + 1;
									print '<tr><td>'.$sn.'</td>
									<td>'.$reproduceResult->studentbio_internalid.' <br />'.$newGeneral->getValue('title_desc', 'tbl_titles', 'title_id', $reproduceResult->studentbio_title).' 
										'.$reproduceResult->studentbio_lname.' '.$reproduceResult->studentbio_fname.'&nbsp;&nbsp;<a href="'.$imgUrl.'" class="fancybox fancybox.image no-print" width="50" title="Picture"><i class="fa fa-picture-o"></i></a></td>
										<td>DOB: '.$reproduceResult->studentbio_dob.'<br />Sex: '.$stdSex.'</td>';
									print '<td><input type="text" required="required" class="ca" name="ca1[]" value="'.$reproduceResult->ca_score1.'" maxlength="2" /></td>
									<td><input type="text" required="required" class="ca" name="ca2[]" value="'.$reproduceResult->ca_score2.'" maxlength="2" /></td>
									<td><input type="text" required="required" class="exam" name="exam[]" value="'.$reproduceResult->exam_score.'" maxlength="3" /></td>
									<td><textarea name="comment[]" maxlength="60" required="required">'.$reproduceResult->notes.'</textarea></td>
									<input type="hidden" name="student_id[]" value="'.$reproduceResult->studentbio_id.'" />
									</tr>';
								}
								$db_dripQuery = null;
							print '</tbody>
							</table>
						</div>
						<div class="box-footer">
								<input type="hidden" name="total_student_in_class" value="'.$total_rows_gotten.'" />
								<input type="hidden" name="subject" value="'.$courseCode.'" />
								<input type="hidden" name="level_taken" value="'.$levelTaken.'" />
								<input type="hidden" name="term_taken" value="'.$termTaken.'" />
								<input type="hidden" name="year_uploaded" value="'.$ultimYear.'" />
								<input type="hidden" name="byepass" value="UKH43dnRTVBIUuNUIHUjopi" />
								<button type="submit" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Upload Edited Result</button>
							</div>
						</form>
					</div>
				</div>
			</div>';
		}
	}
		
	/***********************************************************************************/
	function upload_edited_result($total_returned) {
		$newGeneral = new kas_framework();
		extract($_POST);
		global $web_users_relid;
		require ('../../../php.files/classes/pdoDB.php');
		/* print_r($_POST); exit(); */
		$dbh->beginTransaction();
		
		$count_update = 0; 	$skipped_and_unskipped = 0;
		/* looping for the total student in the class */
		for ($i=0; $i < $total_returned; $i++) {
			/* checking if any student score was empty */
			if ($newGeneral->strIsEmpty($ca1[$i]) or $newGeneral->strIsEmpty($ca2[$i]) or $newGeneral->strIsEmpty($exam[$i]) or $newGeneral->strIsEmpty($comment[$i])) {
				$error_log = $i + 1;
				$newGeneral->showDangerCallout('One Field is Empty. Check around Serial Number "<b>'.$error_log.'</b>". Result Upload Failed.');
				exit;
			} else if ($ca1[$i] > 20 or $ca2[$i] > 20 or $exam[$i] > 60) {
				$error_log = $i + 1;
				$newGeneral->showDangerCallout('An Abnormal Score was Detected. Check around Serial Number "<b>'.$error_log.'</b>". CA or Exam Score Exceeds Maximum Score Allowed. Result Upload Failed.');
				exit;
			} else if (!is_numeric($ca1[$i]) or !is_numeric($ca2[$i]) or !is_numeric($exam[$i])) {
				$error_log = $i + 1;
				$newGeneral->showDangerCallout('A Non Numeric Input was Detected. Check around Serial Number "<b>'.$error_log.'</b>". Result Upload Failed.');
				exit;
			} else {
					/* otherwise, insert into the database */
						$insert = "UPDATE grade_history_primary SET ca_score1 = '".$ca1[$i]."', ca_score2 = '".$ca2[$i]."', exam_score = '".$exam[$i]."', notes = '".$comment[$i]."' WHERE student = '".$student_id[$i]."' 
						AND year = '".$year_uploaded."' AND quarter = '".$term_taken."' AND course_code = '".$subject."' AND level_taken = '".$level_taken."' AND user = '".$web_users_relid."'";
							$db_insert = $dbh->prepare($insert);
							$db_insert->execute();
							$get_rows = $db_insert->rowCount();
							$db_insert = null;
								
							if ($get_rows == 1) {
								$count_update = $count_update + 1; /* increment the total edited */
								$skipped_and_unskipped = $skipped_and_unskipped + 1; /* increment the total queries encountered */
							} else {
								$skipped_and_unskipped = $skipped_and_unskipped + 1; /* increment the total queries encountered */
							}
						
			}/* checking for empty strings ends */			
		} /* for loop initiation ends */	
		
			if ($total_returned == $skipped_and_unskipped) {
				$dbh->commit();
				$changeCalloutType = ($count_update == 0)? 'showDangerCallout': 'showInfoCallout';
				$newGeneral->$changeCalloutType($count_update. ' of '.$total_returned.' Student(s) Result was Edited');
				print '<script> $(\'#proceed_div2\').slideUp(2000);</script>';
				exit;
			} else {
				$dbh->rollBack();
				$newGeneral->showDangerCallout('Result Upload Failed. Maybe Result already Exist in the database Already');
				exit;
			}	
	}
	/***************************************************************************************************************/
	function deleteResult() {
	$newGeneral = new kas_framework();
		extract($_POST);
		require ('../../../php.files/classes/pdoDB.php');
		//Array ( [ultimLevelTaken] => 15 [ultimTerm] => 3 [ultimYear] => 1 [ultimCourseCode] => 24 [myuserID] => 1 [byepass] => iU664dbH89YG66CFuihuiuY7Gv )
		$querySQL = "DELETE FROM grade_history_primary WHERE level_taken = '".$ultimLevelTaken."' AND quarter = '".$ultimTerm."' AND year = '".$ultimYear."'
			AND course_code = '".$ultimCourseCode."' AND user = '".$myuserID."'";
				$db_querySQL = $dbh->prepare($querySQL);
				$db_querySQL->execute();
				$get_db_querySQL_rows = $db_querySQL->rowCount();
				$db_querySQL = null;

				if ($get_db_querySQL_rows >= 1) {
					$newGeneral->showInfoCallout('<b>Nice Work! </b> You have Succesfully Deleted the Selected Result');
					echo '<script>self.location = home </script>';
				} else {
					$newGeneral->showDangerCallout('<b>Oops! </b> Could not Delete this Result. Please Try Again');
				}
	}
	/***********************************************************************************/
	
	
	/* checking the get variable and then deducing the accurate function to run it */
	if (isset($_GET['get_result'])) {
		deduce_grade_class($grade_val); // deducing the grade class
	} else if (isset($_GET['generate_result'])) {
		generate_result(); //run the generate result function
	} else if (isset($_GET['insert_result'])) {
		insert_result($total_student_in_class); //run the insert result function
	} else if (isset($_GET['editResult'])) {
		generate_result_for_edit(); // run the generator for the edit result
	} else if (isset($_GET['update_result'])) {
		upload_edited_result($total_student_in_class); // run the upload edited result function
	} else if (isset($_GET['deleteResult'])) { 
		deleteResult();
	} 
	/* checking the get variable and then deducing the accurate function to run it */
?>	
<script type="text/javascript">
	$('#first_check').click(function() {
		$(this).hide();
		$('#insert_result_span').show();
		return false;
	})
	
	$('#insert_result_form').on('submit', function(e){
		$('#proceed_div2').html('<?php $kas_framework->loading_h('center'); ?>');
		var mydata = $('#insert_result_form :input').serializeArray();
		$.post('process_result_upload?insert_result', mydata , function(data) {
			$('#proceed_div2').html(data).show();	
		});
		return false;
	})
	
	$('#dontInsert').click(function(){
		$('#insert_result_span').hide();
		$('#first_check').show();
	})
	
	$('#edit_result_form').on('submit', function(e){
		$('#proceed_div1_2').html('<?php $kas_framework->loading_h('center'); ?>').show();
		var mydata = $('#edit_result_form :input').serializeArray();
		$.post('process_result_upload?update_result', mydata , function(data) {
			$('#proceed_div1_2').html(data).show();	
		});
		return false;
	})
</script>