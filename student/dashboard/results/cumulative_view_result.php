<?php
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();

require (constant('tripple_return').'php.files/classes/students.php');
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/classes/result.php');
require (constant('tripple_return').'php.files/classes/attendance.php');
//require (constant('tripple_return').'php.files/student_details.php');

	extract($_POST);
	//making sure tat the file was not accessed by the url
	if (!isset($_POST['byepass'])) {
		exit('Error 404: File Cannot be Accessed');
	}

		if ($kas_framework->strisEmpty(@$grade_taken) or $kas_framework->strisEmpty(@$grade_terms) or $kas_framework->strisEmpty(@$session)) {
			$kas_framework->showWarningCallout("Hey!!! Dont be in a Hurry. You have not Selected your Your Class, Year and Term. If you dont see anything above, then please be calm. No Result for you yet.");
		} else {
			$stdObjQuery = "SELECT * FROM studentbio WHERE studentbio_id = '".$__doncareStudentID."' LIMIT 1";
			$db_stdObjQuery = $dbh->prepare($stdObjQuery);
			$db_stdObjQuery->execute();
			$get_rows = $db_stdObjQuery->rowCount();
				$stdObj = $db_stdObjQuery->fetch(PDO::FETCH_OBJ);
				$db_stdObjQuery = null;
				
					$deduce_year = $session; //gotten from the dynamic related form deducing the session.
					//$deduced_year_taken = @mysql_result($deduce_year, 0, 'year');
					$std_full_name = $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $stdObj->studentbio_title) .' '. $stdObj->studentbio_lname .' '. $stdObj->studentbio_fname .' '. $stdObj->studentbio_mname;
					// Getting the grades domain 
					$grades_domain_id = $kas_framework->getValue('grades_domain', 'grades', 'grades_id', $grade_taken);
					//getting the charge for the student wallet result checking
					$charge = $kas_framework->getValue('term_result_fee', 'tbl_grade_domains', 'id', $grades_domain_id);

            //checking the initialization of the form masters and principals report initialization and also checking the check result level
			//------------------------------------------------------------------
            $form_comment = "SELECT * FROM std_report_cards WHERE student = '".$__doncareStudentID."'
					AND grade = '".$grade_taken."' AND session = '".$deduce_year."' LIMIT 1";
					$db_form_comment = $dbh->prepare($form_comment);
						$db_form_comment->execute();
						$get_rows_db_form_comment = $db_form_comment->rowCount();							

					if ($get_rows_db_form_comment != 0) {
                       $getCommentary = $db_form_comment->fetch(PDO::FETCH_OBJ);
						$db_form_comment = null;
                       //plenty things goes here
					   //lets check if the student has paid for this result checking in the database

                        if (isset($_GET['staff_byepass'])) { //since the staff also views result from here, then they should byepass this blockage so that the student will not cry at last
                            //just do nothing and byepass the whole billing and incremental stuff
                        } else { //otherwise, those validations can now come in
                            if ($getCommentary->check_result == 0) {
                                $kas_framework->showdangerwithRed("You have not paid for this Term. The sum of <b> N".number_format($charge) ."</b> will be deducted from your wallet. Available Wallet Fund: <b>N<span id='user_classic_balance'>".number_format($student_balance)."</span></b>.
                                            <a class='btn btn-danger btn-sm' grade_tkn='".$grade_taken."' term_tkn='".$grade_terms."' session_tkn='".$deduce_year."' studentid='".$__doncareStudentID."' charge='".$charge."' href='#' id='result_wallet_button'>Proceed to Deduction?</a>");
                                ?>
                                <!-- this jquery script will handle the pay button for the deduction when clicked --->
                                <div id="messageDiv"></div>
                                <script type="text/javascript">
                                    $("#result_wallet_button").on('click', function(e){
                                        $(this).attr('disabled', 'disabled');
                                        //lets collect all the variables from the users click button
                                        amountCharge     = $(this).attr('charge');
                                        std_id_passed    = $(this).attr('studentid');
                                        session_tkn      = $(this).attr('session_tkn');
                                        term_tkn         = $(this).attr('term_tkn');
                                        grade_tkn        = $(this).attr('grade_tkn');
                                        byepass          = "hygtrf4fvTFR5C4vbugti";
                                        $('#messageDiv').html('<?php $kas_framework->loading_h('center'); ?>').show();
                                        $.post('result_wallet_processing', {byepass:byepass, grade_tkn:grade_tkn, term_tkn:term_tkn, session_tkn:session_tkn, std_id_passed:std_id_passed, amountCharge:amountCharge}, function(returnedData){
                                            $('#messageDiv').html(returnedData);
                                        })
                                        e.preventDefault();
                                    })
                                </script>
                                <?php
                                exit(); //exit the rest of the script so that the result will not be seen
                            } else {
                                //making sure that the incrementing does not exceed 5 times, set to 0 if more than 5
                                if ($getCommentary->check_counter >= 5) {
                                    $querySQL = "UPDATE std_report_cards SET check_counter = '0', check_result = '0' WHERE student = '".$__doncareStudentID."'
                                                       AND grade = '".$grade_taken."' AND term = '".$grade_terms."' AND session = '".$deduce_year."' LIMIT 1";
											$db_querySQL = $dbh->prepare($querySQL);
											$db_querySQL->execute();
											$db_querySQL = null;	
                                } else {
                                    //do the result counter and upgrade the counter.
                                    $increment_counter = $getCommentary->check_counter + 1;
                                    $querySQL = "UPDATE std_report_cards SET check_counter = '".$increment_counter."' WHERE student = '".$__doncareStudentID."'
                                                    AND grade = '".$grade_taken."' AND term = '".$grade_terms."' AND session = '".$deduce_year."' LIMIT 1";
											$db_querySQL = $dbh->prepare($querySQL);
											$db_querySQL->execute();
											$db_querySQL = null;	
                                }
                            }
                        } // end the staff checker skipper



                    } else {
                        $kas_framework->showDangerCallout('Result Initialization Failed. ');
                        exit();
                    }
	?>
	<!-- Main content -->
	<section class="content keliv_printer">                    
		<!-- title row -->
		<div class="row">
			<div class="col-xs-12">
				<h2 class="page-header">
					<i class="fa fa-list-alt text-green"></i> Result Sheet
					<small class="pull-right">Date: <?php print date('d/m/Y') ?></small>
				</h2>                            
			</div><!-- /.col -->
		</div>
		<!-- info row -->
				<div class="row main_header_wrap">
					<div class="col-sm-2 left_col">
						<address>
						<?php $kas_framework->displaySchoolLogo('90', 'circle', '5px'); ?>
						</address>
					</div><!-- /.col -->
					<div class="col-sm-8 center_of_excellence">
					<center><p id="school_title"><?php print $kas_framework->returnUserSchool('') ?></p>
						<p><?php print $kas_framework->getValue('adress', 'tbl_school_profile', 'id', '1'); ?>, <?php print $kas_framework->getValue('state', 'tbl_school_profile', 'id', '1'); ?>,
						<?php print $kas_framework->getValue('country', 'tbl_school_profile', 'id', '1'); ?> (<?php print $kas_framework->getValue('mobile', 'tbl_school_profile', 'id', '1'); ?>)<br />
						Class: <?php print $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $grade_taken);
							print '. ' .$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $deduce_year). ' Session Cumulative Result.'; ?>
						<br />Name: <?php print $std_full_name ?>.&nbsp;&nbsp;&nbsp;&nbsp;Reg. Number: <?php print $stdObj->studentbio_internalid ?></p>
						</center>
					</div><!-- /.col -->
					<div class="col-sm-2 right_col">
				<?php $dynamicimage = $kas_framework->imageDynamic($stdObj->studentbio_pictures, $stdObj->studentbio_gender, $kas_framework->server_root_dir('pictures/'));
						print '<img src="'.$dynamicimage.'" class="" style="width:90px" alt="User Image" />'; ?>
					</div><!-- /.col -->
				</div><!-- /.row -->
		<!-- Table row -->
		<div class="row">
			<div class="col-xs-12 table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>S/N</th><th>Subject Offered</th><th>1st Term</th><th>2nd Term</th><th>3rd Term</th><th>Total</th>
                            <th>Average</th><th>Peak</th><th>Base</th><th>Position</th>
							<?php  
							if ($grades_domain_id  == 5) { /* meaning that its for senior secondary */
								print '	<th>Grade</th>';
							} ?>
							<th>Comment</th>
						</tr>                                    
					</thead>
					<tbody>
			<?php
				$result_deduction = "SELECT * FROM grade_history_primary WHERE level_taken = '".$grade_taken."' AND year = '".$deduce_year."'
					 AND student = '".$__doncareStudentID."' AND exam_type='1' GROUP BY course_code ORDER BY course_code";
					 $db_result_deduction = $dbh->prepare($result_deduction);
						$db_result_deduction->execute();
						$get_rows_db_result_deduction = $db_result_deduction->rowCount();						
                         //checking if the result selection is valid
                            if ($get_rows_db_result_deduction == 0) {
                                $kas_framework->showDangerCallout('This Result selection is invalid. Please select the right Session, Term and Class to View Result. Result could not be displayed.');
                                exit;
                            }
                            $sn = 0; /* initializing the serial */
                            $total_sub_passed = 0; /* initializing the total subject passed */
                            $overall_total = 0; /* initializing the overall total score*/
							$overall_session_average = 0; /* Initilizing the overall Average */

			//lets get the total for each subject in each term
					function getTotalSubject_Termly($term, $course_code, $__doncareStudentID, $grade_taken, $deduce_year) {
						require ('../../../php.files/classes/pdoDB.php');
						$total_in_subject_in_term = "SELECT *, SUM(ca_score1 + ca_score2 + exam_score) AS sumsubjectscore FROM grade_history_primary
								 WHERE level_taken = '".$grade_taken."' AND year = '".$deduce_year."' AND exam_type='1' AND student = '".$__doncareStudentID."' AND course_code = '".$course_code."' AND quarter = '".$term."'";
							$db_total_in_subject_in_term = $dbh->prepare($total_in_subject_in_term);
							$db_total_in_subject_in_term->execute();
							$get_rows = $db_total_in_subject_in_term->rowCount();
						
							$subject_obj_deduction = $db_total_in_subject_in_term->fetch(PDO::FETCH_OBJ);
							$db_total_in_subject_in_term = null;	
						if ($subject_obj_deduction->sumsubjectscore == "") { $added_total = "-";
							} else { $added_total = $subject_obj_deduction->sumsubjectscore; }
							return $added_total;
						}

                             while ($viewResultOpp = $db_result_deduction->fetch(PDO::FETCH_OBJ)) {
                                    // this is the loop of the whole result so far.. lets get the individual subjects
                                    //Array ( [session] => 2 [grade_taken] => 15 [byepass] => u644x2w465545trviUB89UYt [__doncareStudentID] => 3 )\
                                     $sn = $sn + 1;
                                    $subject_deduction = $kas_framework->getValue('grade_subject_desc', 'grade_subjects', 'grade_subject_id', $viewResultOpp->course_code);
                                     //lets get the summation for the whole term.
                                     $first_term_total = getTotalSubject_Termly('1', $viewResultOpp->course_code, $__doncareStudentID, $grade_taken, $deduce_year); //first term
                                     $second_term_total = getTotalSubject_Termly('2', $viewResultOpp->course_code, $__doncareStudentID, $grade_taken, $deduce_year); //second term
                                     $third_term_total = getTotalSubject_Termly('3', $viewResultOpp->course_code, $__doncareStudentID, $grade_taken, $deduce_year); //third term
								
                                    $divisor = 0;
                                    if (!is_numeric($first_term_total)) {$first_term_total_score = "0"; } else { $first_term_total_score = $first_term_total; $divisor = $divisor + 1; }
                                    if (!is_numeric($second_term_total)) {$second_term_total_score = "0"; } else { $second_term_total_score = $second_term_total; $divisor = $divisor + 1; }
                                    if (!is_numeric($third_term_total)) {$third_term_total_score = "0"; } else { $third_term_total_score = $third_term_total; $divisor = $divisor + 1; }

                                 $summation = $first_term_total_score + $second_term_total_score + $third_term_total_score;
								 $overall_total = $overall_total + $summation;
                                 $session_average = $summation/$divisor;
								 $overall_session_average = $overall_session_average + $session_average;
								 
								 include ('cumulative_position_subject_picker.php'); //for the position in class->deducing the paremeters from the query above ($viewResultOpp)
				

                                    print '<tr>';
                                    print '<td>'.$sn.'</td><td>'.$subject_deduction.'</td>';
                                    print '<td>'.$first_term_total.'</td>
                                            <td>'.$second_term_total.'</td>
                                            <td>'.$third_term_total.'</td>
                                            <td>'.$summation.'</td>
                                            <td>'.substr($session_average, 0, 5).'</td>';
									print '<td>'.$peak_score.'</td>
										<td>'.$base_score.'</td>
										<td>'.$subject_position_in_class.'</td>';
                                            /* detecting the grade taken and picking the right result format */
											if ($grades_domain_id == 2) {
												print '<td>'.$result->commentNursery($session_average).'</td>';
												if ($session_average > 40) { $total_sub_passed = $total_sub_passed + 1; }
												
											} else if ($grades_domain_id == 3) {
												print '<td>'.$result->commentPrimary($session_average).'</td>';
												if ($session_average > 40) { $total_sub_passed = $total_sub_passed + 1; }
												
											} else if ($grades_domain_id == 4) {
												print '<td>'.$result->gradeJuniorSecondary($session_average).'</td>
														<td>'.$result->commentJuniorSecondary($session_average).'</td>';
														if ($session_average > 45) { $total_sub_passed = $total_sub_passed + 1; }
														
											} else if ($grades_domain_id == 5) {
												print '<td>'.$result->gradeSeniorSecondary($session_average).'</td>
														<td>'.$result->commentSeniorSecondary($session_average).'</td>';
														if ($session_average > 40) { $total_sub_passed = $total_sub_passed + 1; }
											}
                                 print '</tr>';
                            }
						$db_result_deduction = null;
						?>
					</tbody>
				</table>                    
			</div><!-- /.col -->
		</div><!-- /.row -->
	
		<?php
        if ($getCommentary->c_form_teacher == '' or $getCommentary->c_principal == '') {
            $kas_framework->showDangerCallout('This Result is not Ready yet. Please Check Later... Principal and Form Master\'s comment not ready. You can\'t print out this result now.');
        }
		?>
		<div class="row">
			<!-- Other Comments -->
			<div class="col-xs-5 col-sm-5">
				<p style="font-size:12px; font-weight:500">Form Teacher's Comment</p>
				<p class="well well-sm no-shadow" style="margin-top: -3px;">
					<?php print @$getCommentary->c_form_teacher ?>
				</p>
				<?php $scHead = ($grades_domain_id == '1' or $grades_domain_id == '2')? 'Head Teacher\'s': 'Principal\'s'; ?>
				<p style="font-size:12px; font-weight:500"><?php print $scHead ?> Comment</p>
				<p class="well well-sm no-shadow" style="margin-top: -3px;">
					<?php print @$getCommentary->c_principal ?>
				</p>
				
				
				<div class="col-md-6 pull-left">
					<?php  print 'Director\'s Signature <br />
					<img src="'.$kas_framework->server_root_dir('files/signatures/directors_signature.jpg').'" height="55px" />'; ?>
				</div>
				
				<div class="col-md-6 pull-right">
					<?php if ($grades_domain_id == '1' or $grades_domain_id == '2') {
						print 'Head Master\'s Signature<br />
						<img src="'.$kas_framework->server_root_dir('files/signatures/head_masters_signature.jpg').'" height="55px" />';
					} else {
						print 'Principal\'s Signature<br />
						<img src="'.$kas_framework->server_root_dir('files/signatures/principals_signature.jpg').'" height="55px" />';
					} ?>
				</div>
				
				
			</div><!-- /.col -->
			
			<?php  include ('cumulative_position_best_picker.php');	$sn = ($sn == '0')? '1': $sn; 
						$dyn_grade_history_term = "%%"; 					// set to all because its a cummulative result
						$dyn_grade_year			= $deduce_year;				//the year set to be viewed
					
				//getting the cummulative for the session for the cognitive domain
				function getcummulative($column) {
					global $__doncareStudentID; global $deduce_year; global $grade_taken;
					require ('../../../php.files/classes/pdoDB.php');
						$cog_domain_cumm = "SELECT * FROM std_report_cards WHERE student = '".$__doncareStudentID."'
									AND grade = '".$grade_taken."' AND term LIKE '%%' AND session = '".$deduce_year."'";
					
						$db_cog_domain_cumm = $dbh->prepare($cog_domain_cumm);
						$db_cog_domain_cumm->execute();
						$total_returned = $db_cog_domain_cumm->rowCount();
						
						$get_addition = 0; //Initialize the addition
						while ($get_cog_head = $db_cog_domain_cumm->fetch(PDO::FETCH_OBJ)) {
							$get_addition = $get_addition + $get_cog_head->$column;
						}
						$db_cog_domain_cumm = null;	
						return $cumm = ($get_addition / $total_returned) * 20;
				}
				
			?>
			
			<div class="col-xs-3 col-sm-3">
				<p class="lead">Cognitive Domain</p>
				<div class="table-responsive">
					<table class="table">
						<tr><th><?php print $kas_framework->getValue('value', 'cognitive_domain', 'id', '1') ?></th>
							<td><?php print getcummulative('cog_1') ?>%</td>
						</tr>
						<tr><th><?php print $kas_framework->getValue('value', 'cognitive_domain', 'id', '2') ?></th>
							<td><?php print getcummulative('cog_2') ?>%</td>
						</tr>
						<tr><th><?php print $kas_framework->getValue('value', 'cognitive_domain', 'id', '3') ?></th>
							<td><?php print getcummulative('cog_3') ?>%</td>
						</tr>
						<tr><th><?php print $kas_framework->getValue('value', 'cognitive_domain', 'id', '4') ?></th>
							<td><?php print getcummulative('cog_4') ?>%</td>
						</tr>
						<tr><th>Attendance:</th>
							<td><?php print $dtto->getAttendanceDigit($__doncareStudentID, "%%", $deduce_year, $no_of_dys). '%' ?></td>
						</tr>
					</table>
				</div>
			</div><!-- /.col -->
			
			
			<div class="col-xs-4 col-sm-4">
				<p class="lead">Result Summary</p>
				<div class="table-responsive">
					<table class="table">
						<tr><th>Subject(s) Passed</th>
							<td><?php print $total_sub_passed .'/'.$sn ; ?></td>
						</tr>
						<tr><th>Subject(s) Failed</th>
							<td><?php print $sn - $total_sub_passed .'/'.$sn ; ?></td>
						</tr>
						<tr><th>Performance</th>
							<td><?php print substr(($overall_session_average/$sn), 0, 6). '%' ?>  <?php // print substr((($overall_session_average/$sn) * 100), 0, 6). '%'; ?></td>
						</tr>
						<tr><th>Position in Class:</th>
							<td><?php print $result->getSuffixOfResult(@$ultimate_position_in_class) .' out of '.$total_std_in_class ?></td>
						</tr>
						<tr><th>Best in Class:</th>
							<td><?php print substr(@$bestAverageInClass, 0, 6). '%' ?></td>
						</tr>
					</table>
				</div>
			</div><!-- /.col -->
			
			</div><!-- /.row -->

		<!-- this row will not appear when printing -->
        <div class="row no-print">
            <?php if ($getCommentary->c_form_teacher != '' and $getCommentary->c_principal != '') { ?>
                <div class="col-xs-12">
                    <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                </div>
            <?php } ?>
        </div>
		
	</section><!-- /.content -->
<?php	} ?>