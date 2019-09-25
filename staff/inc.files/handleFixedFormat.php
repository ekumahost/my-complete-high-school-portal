<?php

class handleStudentList extends kas_framework {
	public function viewStdList($parameter, $xtraAttd=false, $xtraDis=false) {
		global $no_of_dys;
		global $dyn_grade_year;
		global $dyn_grade_history_term;
		//require ('pdoDB.php');
		
		if ($xtraAttd == true) {
			$dtto = new dtto();
		} else if ($xtraDis == true){
			function getTotalDiscipline($stdid, $term, $session) {
				require ('../../../php.files/classes/pdoDB.php');
				$t_disc = "SELECT * FROM discipline_history WHERE discipline_history_student = '".$stdid."' AND discipline_history_term LIKE '".$term."' AND discipline_history_year LIKE '".$session."'";
					$db_t_disc = $dbh->prepare($t_disc);
					$db_t_disc->execute();
					$get_db_t_disc_rows = $db_t_disc->rowCount();
					$db_t_disc = null;
					return $get_db_t_disc_rows;
			}
		}
		
		while ($viewMyStds = $parameter->fetch(PDO::FETCH_OBJ)) {
			$stdImage = $viewMyStds->studentbio_pictures;
			$stdSex = $viewMyStds->studentbio_gender;
			$imgUrl = $this->imageDynamic($stdImage, $stdSex, $this->server_root_dir('pictures/'));
			$student_deduced_id = $viewMyStds->studentbio_id;
			
			/* deducing the class of the student */
			$grade_class_id = $this->getValue('student_grade_year_grade', 'student_grade_year', 'student_grade_year_student', $student_deduced_id);
			$grade_room_id = $this->getValue('student_grade_year_class_room', 'student_grade_year', 'student_grade_year_student', $student_deduced_id);
	
					print '<tr>
						<td>'.$this->userGradeClass($grade_room_id, $grade_class_id).'<br />
							'.$viewMyStds->studentbio_internalid.'</td>
						<td>'.$this->getValue('title_desc', 'tbl_titles', 'title_id', $viewMyStds->studentbio_title).' 
						'.$viewMyStds->studentbio_lname.' '.$viewMyStds->studentbio_fname.'<br />
						DOB: '.$viewMyStds->studentbio_dob.'</td>
						<td>Sex: '.$stdSex.'<br />
						Ethnicity: '.$this->getValue('ethnicity_desc', 'ethnicity', 'ethnicity_id', $viewMyStds->studentbio_ethnicity).'<br />
						Resid. State: '.$this->getValue('state_name', 'tbl_states', 'state_css', $viewMyStds->std_bio_resident_state).'</td>';
						print ($xtraAttd == true)? '<td>'.$dtto->getAttendanceDigit($student_deduced_id, $dyn_grade_history_term, $dyn_grade_year, $no_of_dys).'</td>': '';
						print ($xtraDis == true)? '<td>'.getTotalDiscipline($student_deduced_id, $dyn_grade_history_term, $dyn_grade_year).'</td>': '';
						print '<td><img src="'.$imgUrl.'" width="54" href="'.$imgUrl.'" style="cursor:pointer" class="fancybox fancybox.image" /></td>
						<td class="no-print"><a target="_blank" class="btn btn-default btn-flat" href="updateStudent?click='.$this->generateRandomString(20).'&&stdid='.$this->saltifyID($viewMyStds->studentbio_id).'&&ref='.$this->generateRandomString(20).'">
						Manage</a></td></tr>';
		} 
	}
}

$viewStdList = new handleStudentList;
?>
