<?php 	
	class health_retriever extends kas_framework {
		
	public function get_allergy($student_id) {
	global $dbh;
	$get_details = "SELECT * FROM health_allergy_history WHERE health_allergy_history_student = '".$student_id."' ORDER BY health_allergy_history_id DESC";
	$db_handle = $dbh->prepare($get_details);
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();

		print '<div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-ambulance text-red"></i> Health Allergy</h3>                                    
                                </div>
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Session</th>
                                                <th>Term</th>
                                                <th>School</th>
                                                <th>Allergy</th>
                                                <th>Date</th>
                                                <th>Note</th>
                                             </tr>
                                        </thead>
                                        <tbody>';
						$sn = 0;
							while ($allergy_obj = $db_handle->fetch(PDO::FETCH_OBJ)) {
							$sn = $sn + 1;
								print '<tr><td>'.$sn.'</td>
								<td>'.$this->getValue('school_years_desc', 'school_years', 'school_years_id', $allergy_obj->health_allergy_history_year).'</td>
								<td>'.$this->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $allergy_obj->health_allergy_history_term).'</td>
								<td>'.$this->returnUserSchool($allergy_obj->health_allergy_history_school).'</td>
								<td>'.$this->getValue('health_allergy_desc', 'health_allergy', 'health_allergy_id', $allergy_obj->health_allergy_history_code).'</td>
								<td>'.$allergy_obj->health_allergy_history_date.'</td>
								<td>'.$allergy_obj->health_allergy_history_notes.'</td></tr>';/* */							
							}
									print '</tbody>
                                        </tfoot>
									</table>
                                </div>
                            </div>
                        </div>
                    </div>';
			$db_handle = NULL;
	}
	
	public function get_immunz($student_id) {
		global $dbh;
		$get_details2 = "SELECT * FROM health_immunz_history WHERE health_immunz_history_student = '".$student_id."' ORDER BY health_immunz_history_id DESC";
		$db_handle = $dbh->prepare($get_details2);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
			
		print '<div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-user-md text-red"></i> Health Immunize History</h3>                                    
                                </div>
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Session</th>
                                                <th>Term</th>
                                                <th>School</th>
                                                <th>Immunization</th>
                                                <th>Date</th>
                                                <th>Note</th>
                                             </tr>
                                        </thead>
                                        <tbody>';
							$sn = 0;
							while ($immunz_obj = $db_handle->fetch(PDO::FETCH_OBJ)) {
							$sn = $sn + 1;
								print '<tr><td>'.$sn.'</td>
								<td>'.$this->getValue('school_years_desc', 'school_years', 'school_years_id', $immunz_obj->health_immunz_history_year).'</td>
								<td>'.$this->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $immunz_obj->health_immunz_history_term).'</td>
								<td>'.$this->returnUserSchool($immunz_obj->health_immunz_history_school).'</td>
								<td>'.$this->getValue('health_immunz_desc', 'health_immunz', 'health_immunz_id', $immunz_obj->health_immunz_history_code).'</td>
								<td>'.$immunz_obj->health_immunz_history_date.'</td>
								<td>'.$immunz_obj->health_immunz_history_notes.'</td></tr>';/* */							
							}
										

										print '</tbody>
                                        </tfoot>
									</table>
                                </div>
                            </div>
                        </div>
                    </div>';
		$db_handle = null;	
	}	
	
	public function get_health_history($student_id) {
		global $dbh;
		$get_details2 = "SELECT * FROM health_history WHERE health_history_student = '".$student_id."' ORDER BY health_history_id DESC";
		$db_handle = $dbh->prepare($get_details2);
		$db_handle->execute();			

		print '<div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-hospital-o text-red"></i> Health History</h3>                                    
                                </div>
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Session</th>
                                                <th>Term</th>
                                                <th>School</th>
                                                <th>Health Issue</th>
												<th>Medicine 1</th>
												<th>Medicine 2</th>
                                                <th>Date</th>
                                                <th>Note</th>
                                             </tr>
                                        </thead>
                                        <tbody>';
						$sn = 0;
							while ($immunz_obj = $db_handle->fetch(PDO::FETCH_OBJ)) {
							$sn = $sn + 1;
								print '<tr><td>'.$sn.'</td>
								<td>'.$this->getValue('school_years_desc', 'school_years', 'school_years_id', $immunz_obj->health_history_year).'</td>
								<td>'.$this->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $immunz_obj->health_history_term).'</td>
								<td>'.$this->returnUserSchool($immunz_obj->health_history_school).'</td>
								<td>'.$this->getValue('health_codes_desc', 'health_codes', 'health_codes_id', $immunz_obj->health_history_code).'</td>
								<td>'.$this->getValue('health_medicine_desc', 'health_medicine', 'health_medicine_id', $immunz_obj->health_history_medicine_1).'</td>
								<td>'.$this->getValue('health_medicine_desc', 'health_medicine', 'health_medicine_id', $immunz_obj->health_history_medicine_2).'</td>
								<td>'.$immunz_obj->health_history_date.'</td>
								<td>'.$immunz_obj->health_history_notes.'</td></tr>';/* */							
							}
										

										print '</tbody>
                                        </tfoot>
									</table>
                                </div>
                            </div>
                        </div>
                    </div>';
			$db_handle = null;	
	}
}

$health_retriever = new health_retriever(); ?>