<?php 

	$gradeTD = "SELECT * FROM grade_terms_days WHERE grade_terms_days_session LIKE '".$dyn_grade_year."' AND grade_terms_days_term LIKE '".$dyn_grade_history_term."'";
		$db_handle = $dbh->prepare($gradeTD);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		
			if ($get_rows == 0) { $no_of_dys = '0';
			} else {
				$sumUp = 0;
					while ($attendanceDys = $db_handle->fetch(PDO::FETCH_OBJ)) {
						$sumUp = $sumUp + $attendanceDys->grade_terms_days_no_of_days;
					}
					$no_of_dys = $sumUp;
			}
	
	class dtto extends kas_framework {
		
	public function getAttendancePercentage($std_id, $term, $sessn, $no_of_dys) {
		global $dbh;
		$percentQ = "SELECT * FROM attendance_history WHERE attendance_history_student = '".$std_id."' AND attendance_history_term LIKE '".$term."' AND attendance_history_year LIKE '".$sessn."'";
			$db_handle = $dbh->prepare($percentQ);
			$db_handle->execute();
			$get_rows = $db_handle->rowCount();					
				
				if ($get_rows == 0) {
					$this->showInfoCallout('Clean Sheet Record. 100% Attendance Attained. Keep It Up');
				} else {
					if ($no_of_dys == 0) {
					/*then display the normal thing that is meant to be displayed*/
						$this->showWarningCallout('Missed School <b>'.$get_rows.'</b> time(s). <br />
						The Percentage cant be Calculated because the portal dont know the total number of days that school is supposed to attend school. <br />
						Check again Later.');
					} else {
						$percentage_miss = ($get_rows / $no_of_dys) * 100;
						$_SESSION['attendance_data'] = substr((100 - $percentage_miss), 0, 4);						
						$this->showWarningCallout('You have Missed School <b>'.$get_rows.'</b> time(s) out of the normal <b>'.$no_of_dys.'</b> Times attendance<br />
						which sums up it to '.$_SESSION['attendance_data'].'% Attendance ');
					}
				}
		$db_handle = null;
	}
	
	public function getAttendanceDigit($std_id, $term, $sessn, $no_of_dys) {
		global $dbh;
		$percentQ = "SELECT * FROM attendance_history WHERE attendance_history_student = '".$std_id."' AND attendance_history_term LIKE '".$term."' AND attendance_history_year LIKE '".$sessn."'";
			$db_handle = $dbh->prepare($percentQ);
			$db_handle->execute();
			$get_rows = $db_handle->rowCount();
			$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
			$db_handle = null;
				
				if ($get_rows == 0) {
					$data = 100;
				} else {
					if ($no_of_dys == 0) {	
						$data = 100;
					} else {
						$percentage_miss = ($get_rows / $no_of_dys) * 100;
						$data = substr((100 - $percentage_miss), 0, 4); }
				}
			return $data;
		}
		
}

$dtto = new dtto(); ?>