<?php 			/* deducing the position in class -- the ultimate way of doing things */
			$rawPositionDeducer = "SELECT student, AVG(ca_score1 + ca_score2 + exam_score) as ttl_avg 
						FROM grade_history_primary WHERE level_taken = '".$grade_taken."' AND exam_type='1' 
							AND quarter = '".$grade_terms."' AND year = '".$deduce_year."' group by student order by ttl_avg DESC";
							$db_rawPositionDeducer = $dbh->prepare($rawPositionDeducer);
							$db_rawPositionDeducer->execute();
							$get_rows = $db_rawPositionDeducer->rowCount();							
				
					$result_class_position = 0; /* initializing the position */
					$total_std_in_class = 0; /* initializing the total in class */
					$_SESSION['previous_total_average'] = '0'; /* initializing the previous total average */
					$_SESSION['skip_next_position'] = 'no';
					
					while ($fishing = $db_rawPositionDeducer->fetch(PDO::FETCH_OBJ)) {
							
						$total_std_in_class = $total_std_in_class + 1;
						$result_class_position = $result_class_position + 1; /* increment the class position*/
						
							/* getting the best in the class */
							if ($total_std_in_class == '1') {
								$bestAverageInClass = $fishing->ttl_avg;
							}
								
							if ($_SESSION['previous_total_average'] == $fishing->ttl_avg) {
								/* do not updgrade result class position  */
								$_SESSION['skip_next_position'] = 'yes';
								$result_class_position = $result_class_position - 1;
							} else {
								/* setting the current score */
								$_SESSION['previous_total_average'] = $fishing->ttl_avg;
									/* checking for a skip in position */
									if ($_SESSION['skip_next_position'] == 'yes') { // then we are to skip the next position in the result
										$_SESSION['skip_next_position'] = 'no'; // reset the skip class position
										$result_class_position = $result_class_position + 1;
									}
							}
							
						/*getting the students position */
							if ($fishing->student == $__doncareStudentID) {
								$ultimate_position_in_class = $result_class_position;
							}
					}
				$db_rawPositionDeducer = null;
?>