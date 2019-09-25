<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/staff_details.php');
require (constant('tripple_return').'php.files/classes/staff.php');
require (constant('double_return').'inc.files/handleFixedFormat.php');

	function getCognitiveDomain($student_id, $cog_domain_id) {
		global $currentTerm_id;  global $current_year_id;  global $teacher_grade_class;
		require ('../../../php.files/classes/pdoDB.php');
		  $deduce_query = "SELECT * FROM std_report_cards WHERE student = '".$student_id."' AND session = '".$current_year_id."' AND term = '".$currentTerm_id."' AND grade = '".$teacher_grade_class."'";
		  $db_deduce_query = $dbh->prepare($deduce_query);
			$db_deduce_query->execute();
			$get_deduce_query_rows = $db_deduce_query->rowCount();
			$deduce_obj = $db_deduce_query->fetch(PDO::FETCH_OBJ);
			$db_deduce_query = null;	

			$cognitive_domain_column = 'cog_'.$cog_domain_id; //gettinh the column for the retieval
			$get_cog_domain_value = $deduce_obj->$cognitive_domain_column; //getting the value of the cognitive domain in the database
			//the only way i can do this selected stuff now is to do it manually. Let us begin the whole stuff...
				$sel1 = ''; $sel2 = ''; $sel3 = ''; $sel4 = ''; $sel5 = '';
					if ($get_cog_domain_value == '1') { $sel1 = 'selected="selected"'; }
					if ($get_cog_domain_value == '2') { $sel2 = 'selected="selected"'; }
					if ($get_cog_domain_value == '3') { $sel3 = 'selected="selected"'; }
					if ($get_cog_domain_value == '4') { $sel4 = 'selected="selected"'; }
					if ($get_cog_domain_value == '5') { $sel5 = 'selected="selected"'; }
					
				print '<select id="cog_'.$cog_domain_id.'_'.$student_id.'">';				
				print '<option value="0">--</option><option '.$sel1.'>1</option><option '.$sel2.'>2</option>
					<option '.$sel3.'>3</option><option '.$sel4.'>4</option><option '.$sel5.'>5</option>';					
				print '</select>';
	}

	$check_principals_request = "SELECT * FROM std_report_cards WHERE term = '".$currentTerm_id."' AND session = '".$current_year_id."' AND grade = '".$teacher_grade_class."'";
	$db_check_principals_request = $dbh->prepare($check_principals_request);
	$db_check_principals_request->execute();
	$get_check_principals_request_rows = $db_check_principals_request->rowCount();
	$paramObj = $db_check_principals_request->fetch(PDO::FETCH_OBJ);
	$db_check_principals_request = null;
	
		if ($get_check_principals_request_rows == 0) {
			print $kas_framework->showWarningCallout('Dont be in a hurry. Result sheet not Initialized by the Admin. If this is done, a list of all your students will be displayed with their Result link.');
		} else {
			$complxQ = "SELECT * FROM student_grade_year AS sgy, studentbio AS stdb, teacher_grade_year AS tgy, staff AS stf
						WHERE stdb.studentbio_id = sgy.student_grade_year_student
						AND tgy.grade_class = sgy.student_grade_year_grade AND tgy.grade_class_room = sgy.student_grade_year_class_room
						AND tgy.grade_class != '0' AND stf.staff_school = stdb.studentbio_school
						AND sgy.student_grade_year_grade = '".$teacher_grade_class."' AND sgy.student_grade_year_year = '".$current_year_id."'
						AND tgy.session = '".$current_year_id."' AND stf.staff_id = '".$web_users_relid."' AND tgy.teacher = '".$web_users_relid."'";
						$db_querySQL = $dbh->prepare($complxQ);
						$db_querySQL->execute();
						//$myStdQuery = mysql_query($complxQ);
		
	  print '<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-body table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Details</th>
										<th>Cognitive</th>
										<th>Comment Box</th>
										<th>Result</th>
									</tr>
								</thead>
								<tbody>';
								while ($viewMyStds = $db_querySQL->fetch(PDO::FETCH_OBJ)) {
									$stdImage = $viewMyStds->studentbio_pictures;
									$stdSex = $viewMyStds->studentbio_gender;
									$imgUrl = $kas_framework->imageDynamic($stdImage, $stdSex, $kas_framework->server_root_dir('pictures/'));
										print '<tr>
												<td><p style="height:60px; width: 35%; float:left">
												<img src="'.$imgUrl.'" href="'.$imgUrl.'" style="cursor:pointer; width:50px; float:left; margin:0 5px 0 0" class="fancybox fancybox.image" /></p>
												DOB: '.$viewMyStds->studentbio_dob.' <br />
												Sex: '.$stdSex.'<br />
												'.$viewMyStds->studentbio_internalid.'<br />'.$kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $viewMyStds->studentbio_title).' 
												'.$viewMyStds->studentbio_lname.' '.$viewMyStds->studentbio_fname.'<br />
												Ethnicity: '.$kas_framework->getValue('ethnicity_desc', 'ethnicity', 'ethnicity_id', $viewMyStds->studentbio_ethnicity).'<br /></td>
												<td>
													<form action="" id="cognitive_domain_report_form"><table>
													<tr><td>'.$kas_framework->getValue('value', 'cognitive_domain', 'id', '1') .'</td><td>: ';
													print getCognitiveDomain($viewMyStds->studentbio_id, '1').'&nbsp;&nbsp;&nbsp;</td>
														<td>'.$kas_framework->getValue('value', 'cognitive_domain', 'id', '2') .'</td><td>: ';
													print getCognitiveDomain($viewMyStds->studentbio_id, '2') .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
													</tr>
													
													<tr><td>'.$kas_framework->getValue('value', 'cognitive_domain', 'id', '3') .'</td><td>: ';
													print getCognitiveDomain($viewMyStds->studentbio_id, '3') .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
													<td>'.$kas_framework->getValue('value', 'cognitive_domain', 'id', '4') .'</td><td>: ';
													print getCognitiveDomain($viewMyStds->studentbio_id, '4') .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
													
													<tr><td colspan="2"> <input type="submit" class="btn btn-sm btn-flat cog_domain_button" value="Update Cognitive" student_id="'.$viewMyStds->studentbio_id.'" /></td>
													<td colspan="2"><span id="cognitive_domain_report'.$viewMyStds->studentbio_id.'"></span></td></tr>														
													</table></td></form>
												<td>';
												//for the loading if ready or not
													$check_principal_comment_query = "SELECT * FROM std_report_cards
														WHERE term = '".$currentTerm_id."' AND session = '".$current_year_id."' 
															AND grade = '".$teacher_grade_class."' AND student = '".$viewMyStds->studentbio_id."' ";
															$db_check_principal_comment_query = $dbh->prepare($check_principal_comment_query);
																$db_check_principal_comment_query->execute();
																$get_check_principal_comment_query_rows = $db_check_principal_comment_query->rowCount();
																$query_obj = $db_check_principal_comment_query->fetch(PDO::FETCH_OBJ);
																$db_check_principal_comment_query = null;	
															
																	if ($get_check_principal_comment_query_rows == 0) {
																		print ' Awaiting Report Generation';
																	} else {
																		if ($query_obj->c_form_teacher == '') {
																			print '<div id="comment_div_holder_'.$viewMyStds->studentbio_id.'"><textarea class="form-control comment_text'.$viewMyStds->studentbio_id.'"></textarea>
																			<button class="btn btn-sm pull-left std_comment_button" std_id="'.$viewMyStds->studentbio_id.'"> Comment</button>
																			<span class="margin" style="font-size:12px" id="result_drop'.$viewMyStds->studentbio_id.'"></span></div>';
																		} else {
																			print '<div id="comment_div_holder_'.$viewMyStds->studentbio_id.'">
																			<textarea disabled="disabled" class="form-control edit_comment_text'.$viewMyStds->studentbio_id.'">'.$query_obj->c_form_teacher.'</textarea>
																				<a href="#" class="btn btn-sm pull-left enable_edit" std_id="'.$viewMyStds->studentbio_id.'"> Enable Edit</a>
																				<button class="btn btn-sm pull-left std_edit_comment_button" std_id="'.$viewMyStds->studentbio_id.'"> Update</button>
																				</div>';
																			print '<br /><div class="margin" style="font-size:12px" id="result_drop'.$viewMyStds->studentbio_id.'"></div>';
																		}
																	}
												
												//for the loading if ready or not
												print '</td><td><button class="btn btn-default btn-flat student_loop" student_id="'.$viewMyStds->studentbio_id.'"><i class="fa fa-list-alt"></i> View Result</button><br />
																<button class="btn btn-default btn-flat student_cumulative" student_id="'.$viewMyStds->studentbio_id.'"><i class="fa fa-list-alt"></i> View Cumulative</button>
												</td>
											</tr>'; 
									}
									$db_querySQL = null;
								print '</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>';
		}
	?>
<script type="text/javascript">
$('.student_loop').on('click', function(e) {
	$('#sponsor_div2').html('<?php $kas_framework->loading('center'); ?>').show();
	$('#sponsor_div1').fadeOut(1000);

	$('.load_list_again').show();
		
		__doncareStudentID = $(this).attr('student_id');
		byepass = 'kuUK543eYTBOUYbutvtryc';
		grade_terms = '<?php print $currentTerm_id ?>';
		grade_taken = '<?php print $teacher_grade_class ?>';
		session = '<?php print $current_year_id ?>';
		
		$.post('<?php print constant('tripple_return') ?>student/dashboard/results/view_result?staff_byepass', {__doncareStudentID:__doncareStudentID, byepass:byepass, grade_terms:grade_terms, grade_taken:grade_taken, session:session}, function(data){
			$('#sponsor_div2').html(data).show();
		})
	
})

$('.student_cumulative').on('click', function(e) {
	$('#sponsor_div2').html('<?php $kas_framework->loading('center'); ?>').show();
	$('#sponsor_div1').fadeOut(1000);

	$('.load_list_again').show();
		
		__doncareStudentID = $(this).attr('student_id');
		byepass = 'kuUK543eYTBOUYbutvtryc';
		grade_terms = '%%';
		grade_taken = '<?php print $teacher_grade_class ?>';
		session = '<?php print $current_year_id ?>';
		
		$.post('<?php print constant('tripple_return') ?>student/dashboard/results/cumulative_view_result?staff_byepass', {__doncareStudentID:__doncareStudentID, byepass:byepass, grade_terms:grade_terms, grade_taken:grade_taken, session:session}, function(data){
			$('#sponsor_div2').html(data).show();
		})
	
})

$('.std_comment_button').on('click', function(e){
	std_id = $(this).attr('std_id');
	$('#result_drop' + std_id).html('Inserting...');
	byepass = 'opuy546c3e54xceVFV5CV65DC6';
	comment_text = $('.comment_text' + std_id).val();
	grade_taken = '<?php print $teacher_grade_class ?>';
		$.post('process_comment?action=update_comment', {grade_taken:grade_taken, byepass:byepass, std_id:std_id, comment_text:comment_text}, function(fdata){
			$('#result_drop' + std_id).html(fdata).show();
		})
})

$('.std_edit_comment_button').on('click', function(e){
	std_id = $(this).attr('std_id');
	$('#result_drop' + std_id).html('Updating...');
	byepass = 'opuy546c3e54xceVFV5CV65DC6';
	comment_text = $('.edit_comment_text' + std_id).val();
	grade_taken = '<?php print $teacher_grade_class ?>';
		$.post('process_comment?action=update_comment', {grade_taken:grade_taken, byepass:byepass, std_id:std_id, comment_text:comment_text}, function(fdata){
			$('#result_drop' + std_id).html(fdata).show();
		})
})

$('.cog_domain_button').on('click', function(e){
	std_id = $(this).attr('student_id');
	grade_taken = '<?php print $teacher_grade_class ?>';
	$('#cognitive_domain_report' + std_id).html('Updating...');
	byepass = 'opuy546eVFV5CV65DC6';
	cog_1 = $('#cog_1_' + std_id).val(); 
	cog_2 = $('#cog_2_' + std_id).val();  
	cog_3 = $('#cog_3_' + std_id).val(); 
	cog_4 = $('#cog_4_' + std_id).val();
		 $.post('process_comment?action=update_cog_domain', {std_id:std_id, byepass:byepass, cog_1:cog_1, cog_2:cog_2, cog_3:cog_3, cog_4:cog_4, grade_taken:grade_taken}, function(fdata){
			$('#cognitive_domain_report' + std_id).html(fdata).show();
		}) 
	return false;
})

$('.enable_edit').on('click', function(e) {
	stdID = $(this).attr('std_id');
	$('.edit_comment_text'+stdID).removeAttr('disabled');
	return false;
})
</script>