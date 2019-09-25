<style type="text/css">
		select { padding:8px; } 
	</style>
 <div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"> View Other Sessions </h3>                                    
				</div><!-- /.box-header -->
				<div class="box-body table-responsive">
				<form action="#example1" method="post">
					Session: <select name="school_years"> <option value="%%">All</option>
					<?php $kas_framework->getDistinctField('discipline_history', 'discipline_history_year', 'discipline_history_student', $__dontcareStudentID, 'school_years', 'school_years_desc', 'school_years_id', $dyn_grade_year) ?>
					</select>
					Term: <select name="grade_terms"><option value="%%">All</option>
					<?php $kas_framework->getDistinctField('discipline_history', 'discipline_history_term', 'discipline_history_student', $__dontcareStudentID, 'grade_terms', 'grade_terms_desc', 'grade_terms_id', $dyn_grade_history_term) ?>
					</select>
					<button type="submit" class="btn btn-default btn-flat click_ult" name="proceed_button">Proceed</button>
				</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>


				<div class="row" id="studentDisciplineTable">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Discipline History Details</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Reason</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
												<th>Term</th>
												<th>Grade</th>
												<th>Session</th>
                                                <th>Action</th>
                                                <th>Note</th>
                                                <th>Reporter</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
										$Discipline = "SELECT * FROM discipline_history WHERE discipline_history_student = '".$__dontcareStudentID."' 
										AND discipline_history_term LIKE '".$dyn_grade_history_term."' AND discipline_history_year LIKE '".$dyn_grade_year."' ORDER by discipline_history_id DESC";
										
										$db_handle = $dbh->prepare($Discipline);
										$db_handle->execute();
										$get_rows = $db_handle->rowCount();
										$sn = 0;
										
										while ($viewDetails = $db_handle->fetch(PDO::FETCH_OBJ)) {
										$sn = $sn + 1;
											print '<tr>
													<td>'.$sn.'</td>
													<td>'.$kas_framework->getValue('infraction_codes_desc', 'infraction_codes', 'infraction_codes_id', $viewDetails->discipline_history_code).'</td>
													<td>'.$viewDetails->discipline_history_sdate.'</td>
													<td>'.$viewDetails->discipline_history_edate.'</td>
													<td>'.$kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $viewDetails->discipline_history_term).'</td>
													<td>'.$kas_framework->getValue('grades_desc', 'grades', 'grades_id', $viewDetails->discipline_history_grade).'</td>
													<td>'.$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $viewDetails->discipline_history_year).'</td>
													<td>'.$viewDetails->discipline_history_action.'</td>
													<td>'.$viewDetails->discipline_history_notes.'</td>
													<td>'.$viewDetails->discipline_history_reporter.'</td>
												</tr>';
										}
										$db_handle = NULL;
										?>
                                        </tfoot>
									</table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

