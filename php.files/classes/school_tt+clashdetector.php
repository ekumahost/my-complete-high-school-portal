<style type="text/css">
	select { padding:8px; } 
</style>
<?php

class timetable extends kas_framework {
 public function teachingTT($dayID, $term, $session, $grade_class, $grade_room, $school) {
	global $dbh;
		print ' <div class="col-md-9">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">'.$this->getValue('days_desc', 'tbl_days', 'days_id', $dayID).'</h3>                                    
							</div>
							<div class="box-body table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Period</th>
											<th>Time</th>
											<th>Subject</th>
											<th>Class</th>
											<th>Teacher</th>
										</tr>
									</thead>
									<tbody>';
		/* looping all the default periods for display....  */
		$querySQL = "SELECT * FROM school_class_periods";
		$db_handleBB = $dbh->prepare($querySQL);
		$db_handleBB->execute();

		$serial = 0;
			while ($allPeriod = $db_handleBB->fetch(PDO::FETCH_OBJ)) {
			$serial = $serial + 1;
				/* after getting all the periods, we loop through and get all the subjects */
					 $realTTQuery = "SELECT * FROM teacher_schedule WHERE teacher_schedule_classperiod = '".$allPeriod->id."'
									AND teacher_schedule_termid = '".$term."' AND teacher_schedule_grade = '".$grade_class."'
									AND teacher_schedule_year = '".$session."' AND teacher_schedule_days = '".$dayID."'
									AND teacher_schedule_room = '".$grade_room."' AND teacher_schedule_schoolid = '".$school."'";
									
									$db_handle = $dbh->prepare($realTTQuery);
									$db_handle->execute();
									$get_rows = $db_handle->rowCount();
									
									if ($get_rows > 1) {
										$refLink = '?clashdetected&period='.$allPeriod->id.'&day='.$dayID.'&grade='.$grade_class.'&room='.$grade_room.'&school='.$school.'&term='.$term.'&session='.$session.'';
											$clashIndicator = '<br /><a href="'.$refLink.'"><font color="red">[Clash Detected]</a></font>';
										} else {
											$clashIndicator	= '';
										}
									
									$obj__TT = $db_handle->fetch(PDO::FETCH_OBJ);
									if ($get_rows > 0) {
										/* getting staff details... */
										$staffSQL = "SELECT * FROM staff WHERE staff_id = '".$obj__TT->teacher_schedule_teacherid."'";
										$db_handle = $dbh->prepare($staffSQL);
										$db_handle->execute();
										$paramGetFieldsX = $db_handle->fetch(PDO::FETCH_OBJ);
										$db_handle = null;		
										
										$staffFname = @$paramGetFieldsX->staff_fname;
										$staffLname = @$paramGetFieldsX->staff_lname;
										$staffImg = @$paramGetFieldsX->staff_image;
										$staffSex = @$paramGetFieldsX->staff_sex;
										$staff_title_id = @$paramGetFieldsX->staff_title;
										$staffTitle = $this->getValue('title_desc', 'tbl_titles', 'title_id', $staff_title_id); 
										$fancyRetrieve = ($staffImg == '' and $staffSex == '')? '': $this->imageDynamic($staffImg, $staffSex);
									} else {
										$staffFname = ''; $staffLname = ''; $staffImg = ''; $staffSex = '';
										$staff_title_id = ''; $staffTitle = ''; $fancyRetrieve = '';
									}
									
							
							print '<tr>
										<td>'.$serial.'</td>
										<td>'.$this->getValue('desc', 'school_class_periods', 'id', $allPeriod->id).'</td>
										<td>'.$this->getValue('periods', 'school_class_periods', 'id', $allPeriod->id).'</td>
										<td>'.$this->getValue('grade_subject_desc', 'grade_subjects', 'grade_subject_id', @$obj__TT->teacher_schedule_subjectid).' '.$clashIndicator.'</td>
										<td>'.$this->userGradeClass(@$obj__TT->teacher_schedule_room, @$obj__TT->teacher_schedule_grade).'</td><td>';
										if ($staffFname != '' and $staffLname != '') {
											print ''.$staffTitle.' '.$staffFname.' '.$staffLname.'<a href="'.$fancyRetrieve.'" style="cursor:pointer" class="fancybox fancybox.image no-print"> | <i class="fa fa-picture-o"></i></a>';
										}
										print '</td></tr>';
								
			}		
			$db_handle = null;
						   print '</tfoot>
						</table>
					</div>
				</div>
			</div>';
	}
	
	public function checkGradeForArms($grade_class) {
		require ('pdoDB.php');
		$sel = "SELECT * FROM school_rooms WHERE room_grade = '".$grade_class."'";
		$db_handle = $dbh->prepare($sel);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$paramGetFieldsX = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;	
		
			if ($get_rows == 0) {
				$grade_room = 0;
			} else {
				$this->showWarningCallout("This Class has been Detected to Have Arms. Please Select an Arm to Proceed.. All other Selections has been Disabled.");
				
				print '<center><form action="?classtimetable" method="post">
				Please Select an Arm...<select name="grade_room">';
					$this->getallFieldinDropdownOptionWithRestriction('school_rooms', 'school_rooms_desc', 'room_grade', $grade_class, 'school_rooms_id');
				print '</select>&nbsp;&nbsp;
				<input type="hidden" name="grade" value="'.$grade_class.'">
				<input type="hidden" name="grade_terms" value="'.$_POST['grade_terms'].'">
				<input type="hidden" name="escapeGradeCheck" value="skip">
				<button type="submit" class="btn btn-primary click_ult">
						<i class="fa fa-check"></i> Proceed </button></form></center>';
				exit;
			}
		return $grade_room;
	}
	
	public function viewClash($dayID, $term, $period, $session, $grade_class, $grade_room, $school) {
		require ('pdoDB.php');
		print ' <div class="col-xs-9">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">'.$this->getValue('days_desc', 'tbl_days', 'days_id', $dayID).' [Clash Peroids and Teachers]</h3>                                    
							</div>
							<div class="box-body table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Period</th>
											<th>Time</th>
											<th>Subject</th>
											<th>Class</th>
											<th>Teacher</th>
										</tr>
									</thead>
									<tbody>';
						$clashQ = "SELECT * FROM teacher_schedule WHERE teacher_schedule_classperiod = '".$period."'
									AND teacher_schedule_termid = '".$term."'
									AND teacher_schedule_grade = '".$grade_class."'
									AND teacher_schedule_year = '".$session."'
									AND teacher_schedule_days LIKE '".$dayID."'
									AND teacher_schedule_room = '".$grade_room."'
									AND teacher_schedule_schoolid LIKE '".$school."'";
									
									$db_handleB = $dbh->prepare($clashQ);
									$db_handleB->execute();
									$get_rows = $db_handleB->rowCount();
									
									$serial = 0;
									
								while ($obj__TT = $db_handleB->fetch(PDO::FETCH_OBJ)) {
									$serial = $serial + 1;
									/* getting staff details... */
									$staffSQL = "SELECT * FROM staff WHERE staff_id = '".@$obj__TT->teacher_schedule_teacherid."'";
									$db_handle = $dbh->prepare($staffSQL);
									$db_handle->execute();
									$paramGetFieldsX = $db_handle->fetch(PDO::FETCH_OBJ);
									$db_handle = null;
									
									$staffFname = $paramGetFieldsX->staff_fname;
									$staffLname = $paramGetFieldsX->staff_lname;
									$staffImg = $paramGetFieldsX->staff_image;
									$staffSex = $paramGetFieldsX->staff_sex;
									$staff_title_id = $paramGetFieldsX->staff_title;
									
									$staffTitle = $this->getValue('title_desc', 'tbl_titles', 'title_id', $staff_title_id); 
									
									$fancyRetrieve = $this->imageDynamic($staffImg, $staffSex);
							
							print '<tr>
										<td>'.$serial.'</td>
										<td>'.$this->getValue('desc', 'school_class_periods', 'id', $period).'</td>
										<td>'.$this->getValue('periods', 'school_class_periods', 'id', $period).'</td>
										<td>'.$this->getValue('grade_subject_desc', 'grade_subjects', 'grade_subject_id', @$obj__TT->teacher_schedule_subjectid).'</td>
										<td>'.$this->userGradeClass(@$obj__TT->teacher_schedule_room, @$obj__TT->teacher_schedule_grade).'</td>
										
										<td>'.$staffTitle.' '.$staffFname.' '.$staffLname.'| <a href="'.$fancyRetrieve.'" style="cursor:pointer" class="fancybox fancybox.image no-print">Image</a></td>
										</tr>';
								}
						   print '</tfoot>
						</table>
					</div>
				</div>
			</div>';
	}
}
$timetable = new timetable();
?>