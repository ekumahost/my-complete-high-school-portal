<?php
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/staff_details.php');
require (constant('tripple_return').'php.files/classes/staff.php');
		
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Review Broadsheet</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('tripple_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('tripple_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('tripple_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?php print constant('tripple_return') ?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('tripple_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- Bootsrap -->
        <link href="<?php print constant('tripple_return') ?>fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
	<style type="text/css">
		select { padding:5px 10px; } 
		.ca { width:40px; padding:4px }
		.exam { width:50px; padding:4px }
	</style>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
		<?php require (constant('double_return').'inc.files/header.php') ?>
		<p style="margin-top:18px" class="no-print">&nbsp;</p>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
		<?php // require (constant('double_return').'inc.files/sidebar.php') ?>
			<!-- Right side column. Contains the navbar and content of the page -->
            <aside  style="margin:10px">
              <!-- Main content -->
                <section class="content">
				<?php $staff->checkBasicPlan(); 
				
				/* making sure that the user is a teacher */
				if ($staff->checkTeacher($web_users_type) == false){
				$kas_framework->showDangerCallout('This Panel is for Teachers Only. Please <a href="'.constant('single_return').'">Visit the Dashboard</a>');
				print '<center><img src="'.$kas_framework->server_root_dir('img/restricted.png').'" width="60%"/>
					<img src="'.$kas_framework->server_root_dir('img/sorry.png').'" width="50%"/></center>';
					//exit();
				} else { 
				//getting the parameter from the URL, we have the following...
				$grade_year = $_GET['year'];   $grade_term = $_GET['term'];   $grade_to_view = $_GET['grade'];    
				
				?>
						
					
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-xl-12">
				<div class="box">
						<div class="box-header">
						  <h3 class="box-title"><i class="fa fa-table text-red"></i> View Broadsheet: <?php print $kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $grade_term) ?>
						  &raquo;<?php print $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $grade_to_view) ?>
                         &raquo;<?php print $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $grade_year). ' Session' ?>
						  </h3> <a href="" class="pull-right fancybox " style="margin: 7px 20px 0 0"> Get Navigation Help? </a>
						</div><!-- /.box-header -->
                    <?php
                        //php is going to get a little bit crazy here
                    $get_broadsheet_courses = "SELECT DISTINCT course_code FROM grade_history_primary WHERE exam_type = '1' AND year = '".$grade_year."' AND quarter = '".$grade_term."'
                        AND level_taken = '".$grade_to_view."' ORDER BY course_code DESC"; // don't know why you cant get a while loop from the same query twice
                     $get_broadsheet_student = "SELECT DISTINCT student FROM grade_history_primary WHERE exam_type = '1' AND year = '".$grade_year."' AND quarter = '".$grade_term."'
                        AND level_taken = '".$grade_to_view."' ORDER BY course_code DESC";
							$db_get_broadsheet_courses = $dbh->prepare($get_broadsheet_courses); $db_get_broadsheet_student = $dbh->prepare($get_broadsheet_student);
							$db_get_broadsheet_courses->execute(); $db_get_broadsheet_student->execute();
							$get_get_broadsheet_courses_rows = $db_get_broadsheet_courses->rowCount();	$get_get_broadsheet_student_rows = $db_get_broadsheet_student->rowCount();
							$get_get_broadsheet_courses_rows = null;

                    function getScoreforStudent($student, $course) {
						require ('../../../php.files/classes/pdoDB.php');
                       $getScore = "SELECT * FROM grade_history_primary WHERE student = '".$student."' AND course_code = '".$course."'
                        AND exam_type = '1' AND year = '".$_GET['year']."' AND quarter = '".$_GET['term']."' AND level_taken = '".$_GET['grade']."'";
						$db_getScore = $dbh->prepare($getScore);
							$db_getScore->execute();
							$get_rows = $db_getScore->rowCount();
							//$db_getScore = null;	
							$getScoreObj = $db_getScore->fetch(PDO::FETCH_OBJ);
                            if ($get_rows == 0) {
                                $total_subjectScore = '--';
                            } else {
                                $total_subjectScore = $getScoreObj->ca_score1 + $getScoreObj->ca_score2 + $getScoreObj->exam_score;
                            }
                        return $total_subjectScore;
                    }
                    ?>
						<div class="box-body">
						  <table id="example1" class="table table-bordered table-striped">
							<thead>
							  <tr>
								<th>Full Name</th>
                                  <?php  //getting the courses the students offered at that time
									while ( $get_row = $db_get_broadsheet_courses->fetch(PDO::FETCH_OBJ)) {
                                          print '<th>'.$kas_framework->getValue('code', 'grade_subjects', 'grade_subject_id', $get_row->course_code).'</th>';
                                      }
                                  ?>
                                  <th>Total</th>
                                  <th>Avg.</th>
							  </tr>
							</thead>
							<tbody>

                                 <?php
                                    while ($get_row_names = $db_get_broadsheet_student->fetch(PDO::FETCH_OBJ)) {
                                        print '<tr>';
                                        print '<td>'.$kas_framework->getValue('studentbio_fname', 'studentbio', 'studentbio_id', $get_row_names->student).'
                                         '.$kas_framework->getValue('studentbio_lname', 'studentbio', 'studentbio_id', $get_row_names->student).'</td>';
                                             //here, we have to start checking the name of the student with the course in the header since they are following thesame pattern
                                            //so we get another query for the deduction loop so that we can start smiling at each other
											
                                            $get_broadsheet_courses_for_std = "SELECT DISTINCT course_code FROM grade_history_primary WHERE exam_type = '1' AND year = '".$grade_year."' AND quarter = '".$grade_term."'
                                                  AND level_taken = '".$grade_to_view."' ORDER BY course_code DESC"; // for the courses
												  $db_get_broadsheet_courses_for_std = $dbh->prepare($get_broadsheet_courses_for_std);
													$db_get_broadsheet_courses_for_std->execute();
                                                //initialize the values for the addition and the divider
                                                 $total_subject_Scores = 0;
                                                  $divisor_for_average = 0;
												  
                                                     while ($get_all_courses = $db_get_broadsheet_courses_for_std->fetch(PDO::FETCH_OBJ)) {
                                                        print '<td>';
                                                         $subject_score_adder = getScoreforStudent($get_row_names->student, $get_all_courses->course_code);
                                                         print $subject_score_adder .'</td>';
                                                         //lets add up the subjects to that we can have the total
                                                           if ($subject_score_adder == '--') {
                                                               $actual_score = '0';
                                                           } else {
                                                               $actual_score = $subject_score_adder;
                                                               $divisor_for_average = $divisor_for_average + 1;
                                                           }

                                                         $total_subject_Scores = $total_subject_Scores + $actual_score;
                                                         $divisor_for_average = ($divisor_for_average == 0)? '1': $divisor_for_average;//since we cant divide by 0, then we turn divisor to 1 if its 0
                                                         $total_subject_Scores_average = $total_subject_Scores/$divisor_for_average;
                                                    }
												$db_get_broadsheet_courses_for_std = null;	
                                            print '<td>'.$total_subject_Scores.'</td>';
                                            print '<td>'.substr($total_subject_Scores_average, 0, 5).'</td>';
                                            print '</tr>';
                                    }
									$db_get_broadsheet_student = null;	
                                 ?>

							</tbody>
							<tfoot>
							 <!--- <tr>
								<th>Rendering engine</th>
								<th>Browser</th>
								<th>Platform(s)</th>
								<th>Engine version</th>
								<th>CSS grade</th>
							  </tr> --->
							</tfoot>
						  </table>
						</div><!-- /.box-body -->
					  </div><!-- /.box -->
					
				</div>
				
			</div>
				<?php } ?>
                </section><!-- /.content -->
				
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
         <script src="<?php print constant('tripple_return') ?>myjs/jquery.min.js"></script>
		<!---- my javascript controller -->
        <script src="<?php print constant('tripple_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('tripple_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?php print constant('tripple_return') ?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php print constant('tripple_return') ?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php print constant('tripple_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>
		<!-- FancyBox -->
		<script src="<?php print constant('tripple_return') ?>fancybox/jquery.fancybox.js" type="text/javascript"></script>
		<script src="<?php print constant('tripple_return') ?>fancybox/media_helper.js" type="text/javascript"></script>
        <!-- page script -->
        <script type="text/javascript">
            $(function() {  $("#example1").dataTable(); });
			
			/* add books form */
			$('#select_form').submit(function(e) {
				$('#proceed_div1').html('<?php $kas_framework->loading_h('center'); ?>');
				$('#proceed_div2').hide();
				$('#proceed_div1_2').hide();
				
				var mydata = $('#select_form :input').serializeArray();		
				$.post('view_results_uploaded', mydata, function(data) {
					$('#proceed_div1').html(data).show();	
				});
				
				return false;
			});	
	
        </script>

<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>