<?php 

class staff extends kas_framework {
	
	function __construct() {
		global $dbh;
		//log the student out if the student can log in has been set to 0
		$querySQL = "SELECT * FROM tbl_app_config WHERE module = 'staff_login' LIMIT 1";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;	
		if ($paramGetFields->status == '0') {
			unset($_SESSION['tapp_staff_username']); //destroy the staff session
			print '<script> self.location = "'.$this->url_root('').'" </script>';
		}
	}
	
	public function getAllUniquesValsWithUsername(string $table, string $unique, $value) : int {
		global $dbh;
		//if (($mcy = mc_get('uniqueUsername_'.$table.'_'.$value)) !== false)
		//	return $mcy;
		$querySQL = "SELECT COUNT(*) AS cnt FROM `$table` WHERE $unique = '".$value."'";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;	
		$count = $paramGetFields->cnt;
		//mc_set('uniqueUsername_'.$table.'_'.$value, $total);
		return $count;
	}
	
	public function authConfirm($status) {
	($status != '1')?$this->showdangerwithRed('Alert: The School has not Confirmed you as a Staff. Advanced Modules have been Hidden from you.
		Please <b><a href="'.$this->url_root('staff/dashpanel/profile/editprofile').'">Complete Your Profile</a></b> 
		so that the admin can approve your account &raquo; <a href="'.$this->help_url('?topic=not-yet-authenticated-yet').'" target="_blank">Why did this Happen?</a>'): '';	
	}
	
	public function restrictFunctionality($status) {
		return ($status != 1)? false: true;
	}
	
	public function display_accessLevel() {
			print isset($_SESSION['BasicPlan'])? '<small> ...Classic Plan </small>': '<small> ...Premium Plan </small>';
		}
		
	public function basicPlan() {
		return isset($_SESSION['BasicPlan'])?true: false;
	}

	public function checkBasicPlan() {
		if ($this->basicPlan() === true) { 
			exit($this->showWarningCallout('For Advanced Plans Only. Please Wait so that your Account will be confirmed by the Admin... <a href="'.$this->url_root('staff/dashpanel/profile/editprofile').'">complete your profile</a> for easy confirmation'));
		}
	}
	
	public function checkTeacher($web_users_type) {
		return ($web_users_type == 'T')? true: false;
	}
	
	public function restrictFunctionalityFor() {
		
	}
	
	public function teachingTT($dayID, $term, $session, $staff_school, $web_users_relid) {
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
										</tr>
									</thead>
									<tbody>';
							/*deducing the shit Time table */
							$querySQL = "SELECT * FROM teacher_schedule WHERE teacher_schedule_days = '".$dayID."' 
								AND teacher_schedule_teacherid = '".$web_users_relid."' AND teacher_schedule_termid = '".$term."'
								AND teacher_schedule_year = '".$session."' AND teacher_schedule_schoolid = '".$staff_school."' ORDER BY teacher_schedule_classperiod ASC";
								$db_handle = $dbh->prepare($querySQL);
								$db_handle->execute();
					
								$serial = 0;
								while ($obj__TT = $db_handle->fetch(PDO::FETCH_OBJ)) {
								$serial = $serial + 1;
									print '<tr>
											<td>'.$serial.'</td>
											<td>'.$this->getValue('desc', 'school_class_periods', 'id', $obj__TT->teacher_schedule_classperiod).'</td>
											<td>'.$this->getValue('periods', 'school_class_periods', 'id', $obj__TT->teacher_schedule_classperiod).'</td>
											<td>'.$this->getValue('grade_subject_desc', 'grade_subjects', 'grade_subject_id', $obj__TT->teacher_schedule_subjectid).'</td>
											<td>'.$this->userGradeClass($obj__TT->teacher_schedule_room, $obj__TT->teacher_schedule_grade).'</td>
											</tr>';
									}
								$db_handle = null;	
						   print '</tfoot>
						</table>
					</div>
				</div>
			</div>';
		$db_handle = NULL;
	}
	
	public function countStaffwithPics(string $staff_school): int { 
		global $dbh;
		//if (($mc = mc_get('count-' . $table)) !== false)
		//	return $mc;
		$sql_query = "SELECT COUNT(*) AS cnt FROM staff WHERE staff_school = '".$staff_school."' AND staff_image != ''";
		$db_handle = $dbh->prepare($sql_query);
		$db_handle->execute();
		$fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ);
		$cnt = $fetch_obj->cnt;
		$db_handle = null;
		//mc_set('count-' . $table, $cnt);
		return $cnt;
	}
}

$staff = new staff();
	/* Making sure that your student user account is active first */
		if ($staff->restrictFunctionality($staff_status) === false) { 
			$_SESSION['BasicPlan'] = 'Basic Plan'; /* set the basic plan */
		} else {
			unset($_SESSION['BasicPlan']);
		}
?>