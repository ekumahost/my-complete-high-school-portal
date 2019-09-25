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
if (isset($_GET['add'])) {
	//grade, grade_room, term, year, schoolID;
	$checkExistence = "SELECT * FROM teacher_schedule WHERE teacher_schedule_year = '".$current_year_id."' AND teacher_schedule_schoolid = '".$staff_school."' AND teacher_schedule_termid = '".$currentTerm_id."' AND teacher_schedule_grade = '".$grade."' AND teacher_schedule_room = '".$grade_room."'";
	$db_checkExistence = $dbh->prepare($checkExistence);
	$db_checkExistence->execute();
	$get_db_checkExistence_rows = $db_checkExistence->rowCount();
	$db_checkExistence = null;
		
		if ($get_db_checkExistence_rows >= 1) {
			$kas_framework->showWarningCallout("This Timetable Has been Created. Do you Want to Edit it? 
			<a href='' class='btn btn-sm btn-default yespls' grade='".$grade."' graderoom='".$grade_room."'>Yes Please</a> <a href='' class='btn btn-danger nothanks'>No Thanks</a>");
		} else {
			//if the above is not true, then we can proceed with the result editing so that life can become more fun.
			print '<form action="" method="post" id="createTTForm">';
				generateClassTT(1);
				generateClassTT(2);
				generateClassTT(3);
				generateClassTT(4);
				generateClassTT(5);
			print '<div class="box-footer">
			<input type="hidden" name="byepass" value="hyvrRDEC346t587b" />
			<input type="hidden" name="grade" value="'.$grade.'" />
			<input type="hidden" name="grade_room" value="'.$grade_room.'" />
					<center><button type="submit" class="btn btn-default click_ult">
					<i class="fa fa-upload "></i> Create Time Table for this Class</button></center>
				</div>
			</form>';
		}
} 

if (isset($_GET['edit'])) {
	print '<form action="" method="post" id="EditTTForm">';
	generateClassTTforEditing(1, $grade, $graderoom);
	generateClassTTforEditing(2, $grade, $graderoom);
	generateClassTTforEditing(3, $grade, $graderoom);
	generateClassTTforEditing(4, $grade, $graderoom);
	generateClassTTforEditing(5, $grade, $graderoom); /**/
	print '<div class="box-footer">
	<input type="hidden" name="byepass" value="hyvrRDEC346t587b" />
	<input type="hidden" name="grade" value="'.$grade.'" />
	<input type="hidden" name="grade_room" value="'.$graderoom.'" />
			<center><button type="submit" class="btn btn-default click_ult">
			<i class="fa fa-upload "></i> Edit the Time Table for this Class</button></center>
		</div>
	</form>';
}

function generateClassTT($day) {
	$new_general = new kas_framework();
		require ('../../../php.files/classes/pdoDB.php');
		print ' <div class="col-md-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">'.$new_general->getValue('days_desc', 'tbl_days', 'days_id', $day).'</h3>                                    
							</div>
							<div class="box-body table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Period</th>
											<th>Time</th>
											<th>Teacher</th>
											<th>Subject</th>
										</tr>
									</thead>
									<tbody>';
				/* deducing the shit Time table */
				$peroidLoop = "SELECT * FROM school_class_periods";
				$peroidLoop = $dbh->prepare($peroidLoop);
				$peroidLoop->execute();
				
				
				$serial = 0;
				print '<input type="hidden" name="day[]" value="'.$day.'" />'; //getting the array of the day
				while ($allPeriod = $peroidLoop->fetch(PDO::FETCH_OBJ)) {
					$serial++;
					print '<tr>
							<td>'.$serial.'</td>
							<td>'.$new_general->getValue('desc', 'school_class_periods', 'id', $allPeriod->id).'</td>
							<td>'.$new_general->getValue('periods', 'school_class_periods', 'id', $allPeriod->id).'
							<input type="hidden" name="class_period'.$day.'[]" value="'.$new_general->getValue('id', 'school_class_periods', 'id', $allPeriod->id).'" /></td>
							<td><select name="staff_id'.$day.'[]"><option></option>';
							
							$allStaff = "SELECT * FROM staff WHERE staff_status = '1'";
							$db_allStaff = $dbh->prepare($allStaff);
							$db_allStaff->execute();
							
								while ($getStaffs = $db_allStaff->fetch(PDO::FETCH_OBJ)) { 
									print '<option value="'.$getStaffs->staff_id.'">'.$getStaffs->staff_fname .' '.$getStaffs->staff_lname. '</option>';
								}
							$db_allStaff = null;
							print '</select></td>
							<td><select name="subject_id'.$day.'[]"><option></option>';
						$new_general->getallFieldinDropdownOption('grade_subjects', 'grade_subject_desc', 'grade_subject_id', $matchField=false);
							print '</select></td>
						</tr>';
					}
				$peroidLoop = null;
						print '</tfoot>
						</table>
					</div>
				</div>
			</div>';
	}
	
	function generateClassTTforEditing($day, $grade, $graderoom) {
		global $currentTerm_id; global $current_year_id; global $staff_school;
		require ('../../../php.files/classes/pdoDB.php');
	$new_general = new kas_framework();
		print ' <div class="col-md-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">'.$new_general->getValue('days_desc', 'tbl_days', 'days_id', $day).'</h3>                                    
							</div>
							<div class="box-body table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Period</th>
											<th>Time</th>
											<th>Teacher</th>
											<th>Subject</th>
										</tr>
									</thead>
									<tbody>';
				/* deducing the shit Time table */
				$editQuery = "SELECT * FROM teacher_schedule WHERE teacher_schedule_year = '".$current_year_id."' AND teacher_schedule_schoolid = '".$staff_school."' AND teacher_schedule_termid = '".$currentTerm_id."' AND teacher_schedule_grade = '".$grade."' AND teacher_schedule_room = '".$graderoom."' AND teacher_schedule_days = '".$day."' ORDER BY teacher_schedule_classperiod ASC";
				$db_editQuery = $dbh->prepare($editQuery);
				$db_editQuery->execute();
			$serial = 0;
			print '<input type="hidden" name="day[]" value="'.$day.'" />'; //getting the array of the day
				while ($editingOptions = $db_editQuery->fetch(PDO::FETCH_OBJ)) {
					$serial++;
					print '<tr>
						<td>'.$serial.'</td>
						<td>'.$new_general->getValue('desc', 'school_class_periods', 'id', $editingOptions->teacher_schedule_classperiod).'</td>
						<td>'.$new_general->getValue('periods', 'school_class_periods', 'id', $editingOptions->teacher_schedule_classperiod).'
						<input type="hidden" name="class_period'.$day.'[]" value="'.$new_general->getValue('id', 'school_class_periods', 'id', $editingOptions->teacher_schedule_classperiod).'" /></td>
							</td><td><select name="staff_id'.$day.'[]"><option></option>';
							
							$allStaff = "SELECT * FROM staff WHERE staff_status = '1'";
							$db_allStaff = $dbh->prepare($allStaff);
							$db_allStaff->execute();
							
								while ($getStaffs = $db_allStaff->fetch(PDO::FETCH_OBJ)) {
									$selected = ($getStaffs->staff_id == $editingOptions->teacher_schedule_teacherid)? 'selected=selected': '';
									print '<option value="'.$getStaffs->staff_id.'" '.$selected.'>'.$getStaffs->staff_fname .' '.$getStaffs->staff_lname. '</option>';
								}	
							$db_allStaff = null;
							print '</select></td>
						<td><select name="subject_id'.$day.'[]"><option></option>';
						$new_general->getallFieldinDropdownOption('grade_subjects', 'grade_subject_desc', 'grade_subject_id', $editingOptions->teacher_schedule_subjectid);
						print '</select></td>
					</tr>';
				}
			$db_editQuery = null;
		
				print '</tfoot>
				</table>
			</div>
		</div>
	</div>';
	}
?>

<script type="text/javascript">
	$('#createTTForm').on('submit', function(returned_data) {
		$('#proceed_div2').html('<?php $kas_framework->loading_h('center'); ?>');
		var mydata = $('#createTTForm :input').serializeArray();
		$.post('timetable_uploader?insert_tt', mydata , function(data) {
			$('#proceed_div2').html(data).show();	
		});
		return false;
	})
	
	$('.yespls').click(function(e) {
       $('#proceed_div1').html('<?php $kas_framework->loading_h('center'); ?>').show();
			$('#proceed_div2').html('');
			grade = $(this).attr('grade');
			graderoom = $(this).attr('graderoom');
			byepass = 'kljhFREXTyuiy9pu';
			$.post('generate_timetable?edit', {byepass:byepass, grade:grade, graderoom:graderoom}, function(data_returned) {
				$('#proceed_div1').html(data_returned);
			})
		return false;
    });
	
	$('.nothanks').click(function(e) {
        $('#proceed_div1').html('');
		return false;
    });
	
	$('#EditTTForm').on('submit', function(returned_data) {
		$('#proceed_div2').html('<?php $kas_framework->loading_h('center'); ?>');
		var mydata = $('#EditTTForm :input').serializeArray();
		$.post('timetable_uploader?edit_tt', mydata , function(data) {
			$('#proceed_div2').html(data).show();	
		});
		return false;
	})
</script>