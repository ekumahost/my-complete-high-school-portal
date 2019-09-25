<?php 	
		
		  $sub_position = "SELECT student, SUM(ca_score1 + ca_score2 + exam_score) AS sumsubjectscore FROM grade_history_primary
			WHERE level_taken = '".$grade_taken."' AND course_code = '".$viewResultOpp->course_code."' AND exam_type='1'
				AND quarter LIKE '%%' AND year = '".$deduce_year."' group by student ORDER BY sumsubjectscore DESC";
				
				$db_sub_position = $dbh->prepare($sub_position);
				$db_sub_position->execute();
				$get_sub_position_rows = $db_sub_position->rowCount();
											
					$sub_position_for_subject = 0; //initializing the position
					$_SESSION['previous_subject_total'] = '0'; /* initializing the previous total average */
					$_SESSION['skip_next_position_for_subject'] = 'no';
				
				while ($getting_subject_position = $db_sub_position->fetch(PDO::FETCH_OBJ)) {
					$sub_position_for_subject = $sub_position_for_subject + 1; /* increment the class position*/
						if ($sub_position_for_subject == 1) {
							$peak_score =  $getting_subject_position->sumsubjectscore; //since the score is being sorted in descending order, then this must be the first
						}
					
						if ($_SESSION['previous_subject_total'] == $getting_subject_position->sumsubjectscore) {
							/* do not updgrade subject position  */
							$_SESSION['skip_next_position_for_subject'] = 'yes';
							$sub_position_for_subject = $sub_position_for_subject - 1; // return it back to the previous position
						} else {
							$_SESSION['previous_subject_total'] = $getting_subject_position->sumsubjectscore;
								/* checking for a skip in position */
								if ($_SESSION['skip_next_position_for_subject'] == 'yes') 
									{ // then we are to skip the next position in the result
										$_SESSION['skip_next_position_for_subject'] = 'no'; // reset the skip class position
										$sub_position_for_subject = $sub_position_for_subject + 1;
									}
						}
					
						/*getting the students position */
						if ($getting_subject_position->student == $__doncareStudentID) {
							$subject_position_in_class = $sub_position_for_subject;
							$subject_position_in_class = $result->getSuffixOfResult($subject_position_in_class);
						}
				
				$base_score = $getting_subject_position->sumsubjectscore; //since the score is being sorted in descending order, then this must be the last
				
				}
			$db_sub_position = null;	
?>