<?php
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/classes/result.php');
require (constant('tripple_return').'php.files/staff_details.php');

	extract($_POST);
	//making sure tat the file was not accessed by the url
	if (!isset($_POST['byepass'])) {
		exit('Error 404: File Cannot be Accessed');
	}
	
	/* Array ( [year] => 1 [term] => 1 [byepass] => omUIYTVRC4x325467890k90J9MNUBY )  */
if ($kas_framework->strIsEmpty(@$year) or $kas_framework->strIsEmpty(@$term)) {
	$kas_framework->showWarningCallout('Please Select a Year and a Term to View. If nothing shows up for selection, then you have not uploaded any result');
} else {
	$subjectSel = "SELECT DISTINCT course_code FROM grade_history_primary
		WHERE year = '".$year."' AND quarter = '".$term."' AND user = '".$web_users_relid."' ORDER BY id DESC";
		$db_subjectSel = $dbh->prepare($subjectSel);
			$db_subjectSel->execute();
			$get_subjectSel_rows = $db_subjectSel->rowCount();
			
			if ($get_subjectSel_rows == 0) {
				$kas_framework->showDangerCallout('<b>Oops! </b> There is no Result for this Selection. Please Confirm Your selection');
			} else {
				$kas_framework->showWarningCallout('<b>Result Count! </b>'. $get_subjectSel_rows. ' result(s) retrieved from the database');
				/* first while loop to bring out the total subjects uploaded by staff */
				while ($subjectSelSegregation = $db_subjectSel->fetch(PDO::FETCH_OBJ)) {
					print '<div class="row">
							<div class="col-xs-12">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title"><i class="fa fa-folder-o"></i> '.$kas_framework->getValue('grade_subject_desc', 'grade_subjects', 'grade_subject_id', $subjectSelSegregation->course_code).'</h3>
									</div>
									<div class="box-body table-responsive no-padding">
										<table class="table table-hover">
											<tr>
												<th>S/N</th>
												<th>Class</th>
												<th>Total Uploaded</th>
												<th>Date Uploaded</th>
												<th>Status</th>
												<th>Action</th>
											</tr>';
									
								$getDistinctClass = "SELECT DISTINCT level_taken, `date` FROM grade_history_primary WHERE course_code = '".$subjectSelSegregation->course_code."'
										AND year = '".$year."' AND quarter = '".$term."' AND user = '".$web_users_relid."'";
											$db_getDistinctClass = $dbh->prepare($getDistinctClass);
											$db_getDistinctClass->execute();
											$serial = 0;
											/* second while loop to produce the classes result was uploaded for */
												while ($getClassfromQuery = $db_getDistinctClass->fetch(PDO::FETCH_OBJ)) {
												$serial = $serial + 1;	
													print '<tr>
															<td>'.$serial.'</td>
															<td>'.$kas_framework->getValue('grades_desc', 'grades', 'grades_id', $getClassfromQuery->level_taken).'</td>';
															
															/* getting the total number of students results uploaded that day */
															$ttl = "SELECT COUNT(*) AS cnt FROM grade_history_primary WHERE level_taken = '".$getClassfromQuery->level_taken."' AND course_code = '".$subjectSelSegregation->course_code."'
																AND year = '".$year."' AND quarter = '".$term."' AND user = '".$web_users_relid."'";
																$db_ttl = $dbh->prepare($ttl);
																$db_ttl->execute();
																$paramObj = $db_ttl->fetch(PDO::FETCH_OBJ);
																$get_ttl_rows = $paramObj->cnt;
																$db_ttl = null;	
															print '<td>'.$get_ttl_rows.' Students Result Uploaded</td>';
															print '<td>'.$getClassfromQuery->date.'</td>
															<td><span class="label label-success">Submitted</span></td>
															<td><a class="btn btn-default btn-sm edit_result" href="#" ultimYear = "'.$year.'" ultimLevelTaken="'.$getClassfromQuery->level_taken.'" ultimCourseCode="'.$subjectSelSegregation->course_code.'" ultimTerm="'.$term.'"><i class="fa fa-edit"></i> Edit</a>
															<a class="btn btn-danger btn-sm delete_result" href="#" ultimYear = "'.$year.'" ultimLevelTaken="'.$getClassfromQuery->level_taken.'" ultimCourseCode="'.$subjectSelSegregation->course_code.'" ultimTerm="'.$term.'"><i class="fa text-white fa-trash-o"></i> Delete</a></td>
														</tr>';
												}
										   $db_getDistinctClass = null;
										print '</table>
									</div>
								</div>
							</div>
						</div>';
			}
		$db_subjectSel = null;
	}
}
	
?>
	<script>
	$('.edit_result').on('click', function(e) {
		$('#proceed_div2').html('<?php $kas_framework->loading_h('center'); ?>').show();
		$('#proceed_div1_2').hide();
		ultimLevelTaken = $(this).attr('ultimLevelTaken');
		ultimTerm = $(this).attr('ultimTerm');
		ultimCourseCode = $(this).attr('ultimCourseCode');
		ultimYear = $(this).attr('ultimYear');
		myuserID = '<?php print $web_users_relid; ?>';
		byepass = 'iU664dbH89YG66CFuihuiuY7Gv';
		//alert('CourseCode: '+ ultimCourseCode+ '>Term: '+ ultimTerm + 'Year: '+ultimLevelTaken);
		$.post('process_result_upload?editResult', {levelTaken:ultimLevelTaken, termTaken:ultimTerm, courseCode:ultimCourseCode, ultimYear:ultimYear, staffID:myuserID, byepass:byepass}, function(data){
			$('#proceed_div2').html(data).show();
		})
		
	})
	
		$('.delete_result').on('click', function(e) {
			deleteConfirmation = window.confirm('Do you want to Delete this Result?');
				if (deleteConfirmation == true) {
					$('#proceed_div2').html('<?php $kas_framework->loading_h('center'); ?>').show();
					ultimLevelTaken = $(this).attr('ultimLevelTaken');
					ultimTerm = $(this).attr('ultimTerm');
					ultimCourseCode = $(this).attr('ultimCourseCode');
					myuserID = '<?php print $web_users_relid; ?>';
					ultimYear = $(this).attr('ultimYear');
					byepass = 'iU664dbH89YG66CFuihuiuY7Gv';
					//alert('CourseCode: '+ ultimCourseCode+ '>Term: '+ ultimTerm + 'Year: '+ultimLevelTaken);
					$.post('process_result_upload?deleteResult', {ultimLevelTaken:ultimLevelTaken, ultimTerm:ultimTerm, ultimYear:ultimYear, ultimCourseCode:ultimCourseCode, myuserID:myuserID, byepass:byepass}, function(data){
						$('#proceed_div2').html(data).show();
					})
			}
	})
	</script>