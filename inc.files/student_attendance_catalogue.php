 <div class="row" id="studentAttendanceTable">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Attendance History Details</h3>                                    
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>S/N</th>
							<th>Date</th>
							<th>Term</th>
							<th>Grade</th>
							<th>Session</th>
							<th>Notice</th>
							<th>Note</th>
						</tr>
					</thead>
					<tbody>
					<?php  
					$Discipline = "SELECT * FROM attendance_history WHERE attendance_history_student = '".$__dontcareStudentID."'
					AND attendance_history_term LIKE '".$dyn_grade_history_term."' AND attendance_history_year LIKE '".$dyn_grade_year."' ORDER by attendance_history_id DESC";
					
					$db_handle = $dbh->prepare($Discipline);
					$db_handle->execute();
					$get_rows = $db_handle->rowCount();
					
					$sn = 0;
					while ($viewDetails = $db_handle->fetch(PDO::FETCH_OBJ)) {
					$sn = $sn + 1;
						print '<tr>
								<td>'.$sn.'</td>
								<td>'.$viewDetails->attendance_history_date.'</td>
								<td>'.$kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $viewDetails->attendance_history_term).'</td>
								<td>'.$kas_framework->getValue('grades_desc', 'grades', 'grades_id', $viewDetails->attendance_history_grade).'</td>
								<td>'.$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $viewDetails->attendance_history_year).'</td>
								<td>'.$kas_framework->getValue('attendance_codes_desc', 'attendance_codes', 'attendance_codes_id', $viewDetails->attendance_history_code).'</td>
								<td>'.$viewDetails->attendance_history_notes.'</td>
							</tr>';
					}
					$db_handle = NULL;
					?>
					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
</div>

