<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
	$kas_framework->safesession();
	$kas_framework->checkAuthStaff();
	require (constant('tripple_return').'php.files/classes/generalVariables.php');
	require (constant('double_return').'inc.files/handleFixedFormat.php');
	require (constant('tripple_return').'php.files/classes/attendance.php');
	
	require (constant('tripple_return').'php.files/staff_details.php');
	require (constant('tripple_return').'php.files/classes/staff.php');	
 ?>
<!DOCTYPE html>
<html>
<style type="text/css">
	select { padding:8px; } 
</style>	
			
    <head>
        <meta charset="UTF-8">
        <title>Copy Timatable</title>
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
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
		<?php require (constant('double_return').'inc.files/header.php') ?>
		<p style="margin-top:18px">&nbsp;</p>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
		<?php require (constant('double_return').'inc.files/sidebar.php') ?>
			<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       <i class="fa fa-copy text-red"></i> Copy School Timetable
                    </h1>
                    <ol class="breadcrumb">
						<li><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="active"><i class="fa fa-ellipsis-h"></i>&nbsp;&nbsp;Attendance</li>
                    </ol>
                </section>
				
			<!-- Main content -->
             <section class="content">
			 <?php $staff->checkBasicPlan();
			 
				if ($staff_timetable == '0') {
					print ($kas_framework->showDangerCallout('You dont Have the Priviledge to Manage the The Attendance of the Whole Students. Tell the Admin to grant you the Priviledge. 
					<a href="'.$kas_framework->server_root_dir('staff/dashpanel/').'">Visit the DashPanel?</a>'));
					print '<center><img src="'.$kas_framework->server_root_dir('img/restricted.png').'" width="60%"/>
					<img src="'.$kas_framework->server_root_dir('img/sorry.png').'" width="50%"/></center>';
				} else {
			?>
				
			<?php // $student->authConfirm($useradmitStatus); ?>
					<div class="row"> 
						<div class="col-md-9 table-responsive">
						
						<?php 	$checkExistenceofTT = "SELECT * FROM teacher_schedule WHERE teacher_schedule_year = '".$current_year_id."' AND teacher_schedule_schoolid = '".$staff_school."' AND teacher_schedule_termid = '".$currentTerm_id."' GROUP BY teacher_schedule_termid";
									$db_checkExistenceofTT = $dbh->prepare($checkExistenceofTT);
									$db_checkExistenceofTT->execute();
									$rowCount = $db_checkExistenceofTT->rowCount();
									$db_checkExistenceofTT = null;
									
									if ($rowCount > 1) {
											$kas_framework->showWarningCallout("There is an Existing Timetable for this Term. Please Use the copy if you want to Duplicate a previous terms timetable. Copy will not work this term."); 
											$copyLnk = 'disabled';
										} else {
											$kas_framework->showInfoCallout("Please Select a Timetable to Copy to this Term. Action is Reversible. Editing is Possible"); 
											$copyLnk = 'enabled';
										}
						?>
					<div id="proceed_div1"></div>
							<table class="table table-striped">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Term</th>
										<th>Session</th>
										<th>Class Detected</th>
										<th>Action</th>
									</tr>                                    
								</thead>
								<tbody>
							<?php 
								$deduceAllTT = "SELECT * FROM teacher_schedule GROUP BY teacher_schedule_termid";
								$db_deduceAllTT = $dbh->prepare($deduceAllTT);
								$db_deduceAllTT->execute();
								$get_deduceAllTT_rows = $db_deduceAllTT->rowCount();
								
									$serial = 0;
										while ($thisExisting = $db_deduceAllTT->fetch(PDO::FETCH_OBJ)) {
										$serial++;
												print '<tr>
													<td>'.$serial.'</td>
													<td>'.$kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $thisExisting->teacher_schedule_termid).'</td>
													<td>'.$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $thisExisting->teacher_schedule_year).'</td>
													<td>';
														$gradesInTerm = "SELECT DISTINCT teacher_schedule_grade FROM teacher_schedule WHERE teacher_schedule_year = '".$thisExisting->teacher_schedule_year."' AND teacher_schedule_schoolid = '".$thisExisting->teacher_schedule_schoolid."' AND teacher_schedule_termid = '".$thisExisting->teacher_schedule_termid."'";
														$db_gradesInTerm = $dbh->prepare($gradesInTerm);
														$db_gradesInTerm->execute();
														$classes = $db_gradesInTerm->rowCount();
														$db_gradesInTerm = null;
														
														$suffix = ($classes == 1)? ' Class': ' Classes';														
														print $classes .$suffix .' detected';
													print '</td><td>';
													if ($copyLnk == 'disabled') {
														print '<a href="#" class="btn btn-sm btn-danger"><i class="fa fa-copy"></i> Copy Disabled for this Term</a>';
													} else if ($copyLnk == 'enabled') {
														print '<a href="#" class="btn btn-sm btn-default copier" yr="'.$thisExisting->teacher_schedule_year.'" schid="'.$thisExisting->teacher_schedule_schoolid.'" termid="'.$thisExisting->teacher_schedule_termid.'"><i class="fa fa-copy"></i> Copy to this Term</a>';
													}
												print '</td></tr>';
										}								
											$db_deduceAllTT = null;  
										
								?>
								</tbody>
							</table>                    
					</div><!-- /.col -->
						
					<?php include ('tt_sidebar.php') ?>
				</div><!-- ./row -->
					
				<?php  } ?>
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
		
		$('.copier').on('click', function(e){
			confirmation = window.confirm('Do you Want to Copy this Term Timetable to Current Term?');
			if (confirmation == true) {
				$('#proceed_div1').html('<?php $kas_framework->loading_h('center'); ?>').show();
				gradeYear = $(this).attr('yr');
				schoolID = $(this).attr('schid');
				termID = $(this).attr('termid');
				byepass = 'kljbGVTYECERDFNUYmi';
					$.post('timetable_uploader?hyperCopy', {gradeYear:gradeYear, schoolID:schoolID, termID:termID, byepass:byepass}, function(returned_data){
						$('#proceed_div1').html(returned_data);
					})
			}
			return false;
		})
        </script>
    </body>
</html>