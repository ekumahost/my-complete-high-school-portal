<?php 
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/staff_details.php');
require (constant('quad_return').'php.files/classes/staff.php');
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Homework</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('quad_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('quad_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?php print constant('quad_return') ?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('quad_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- fancybox -->
		<link href="<?php print constant('quad_return') ?>fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.<?php print constant('quad_return') ?>js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
		<?php require (constant('tripple_return').'inc.files/header.php') ?>
		<p style="margin-top:18px">&nbsp;</p>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
		<?php require (constant('tripple_return').'inc.files/sidebar.php') ?>
			<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <i class="fa fa-suitcase text-blue"></i> View Homework
                    </h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-th-large"></i>Academic Tools</a></li>
						<li class="click_ult"><a href="../homework/"><i class="fa fa-suitcase"></i>Homework</a></li>
                        <li class="active"><i class="fa fa-suitcase"></i>&nbsp;&nbsp;View Homework</li>
                    </ol>
                </section>
	<?php 	
		
		/* making sure that there is no get variable in the url for the deducing of parameters passed to the table */
		$dyn_grade_year = (isset($_POST['school_years']))? $_POST['school_years'] :  $current_year_id;
		$dyn_grade_history_term = (isset($_POST['grade_terms']))? $_POST['grade_terms'] :  $currentTerm_id;
		
		$sequencGradeClass = ($teacher_grade_class != 0)? $teacher_grade_class : '%%';
		$dyn_grade = (isset($_POST['grade']))? $_POST['grade'] :  $sequencGradeClass;
		
		/* making sure that there is no get variable in the url for the deducing of parameters passed to the table and beyond */ 
		
	?>				
				<!-- Main content -->
			<section class="content">
				<div class="row">
				   <?php 	
					print ' <div class="col-xs-9">';
						
						if (!isset($_GET['readonly']) and !isset($_GET['deleted'])) {
							$session_to_display = $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $dyn_grade_year);
							$session_to_display = ($session_to_display != '')? $session_to_display: 'All';
							
							$term_to_display = $kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $dyn_grade_history_term);
							$term_to_display = ($term_to_display != '')? $term_to_display: 'All';
							
							$grade_to_display = ($dyn_grade != '%%')? $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $dyn_grade): 'All';
							
							$kas_framework->showWarningCallout('Viewing ... SESSION: '.$session_to_display.' &raquo;&raquo; TERM: '.$term_to_display.' &raquo;&raquo; GRADE: '.$grade_to_display.' ');
						}

						/* for reading homeworks already set by the staff */	
						if (isset($_GET['readonly'])) { include (constant('quad_return').'inc.files/read_homework_plugin.php'); }
							
							
						/* for deleting of homeworks */	
						if (isset($_GET['deleted'])) {
								$delID = $kas_framework->unsaltifyID($_GET['hmid']);
								$DelQ = "DELETE FROM homework WHERE homework_id = '".$delID."' LIMIT 1";
								$db_DelQ = $dbh->prepare($DelQ);
								$db_DelQ->execute();
								$get_db_DelQ_rows = $db_DelQ->rowCount();
								$db_DelQ = null;
									if ($get_db_DelQ_rows == 1) {
										$kas_framework->showInfoCallout('Homework Deleted Succesfully');
									} else {
										$kas_framework->showDangerCallout('Could not Delete Homework. <a href="'.$kas_framework->help_url('?topic=query-failed').'">Explanation?</a>');
									}
							}
						
								print '<div class="box">
									<div class="box-header">
											<h3 class="box-title">My Homework</h3>                                    
										</div>
										<div class="box-body table-responsive">
											<table id="example1" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>S/N</th>
														<th>Subject</th>
														<th>Name</th>
														<th>Set Date</th>
														<th>Due Date</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>';
									$hwQuery = "SELECT * FROM homework WHERE teacher_id = '".$web_users_relid."' 
											AND session LIKE '".$dyn_grade_year."' AND term LIKE '".$dyn_grade_history_term."'
											AND grade LIKE '".$dyn_grade."' ORDER BY homework_id DESC";
											$db_hwQuery = $dbh->prepare($hwQuery);
												$db_hwQuery->execute();
												
											$serial = 0;
											while ($obj__TT = $db_hwQuery->fetch(PDO::FETCH_OBJ)) {
												$serial = $serial + 1;
										
												print '<tr>
													<td>'.$serial.'</td>
													<td>'.$kas_framework->getValue('grade_subject_desc', 'grade_subjects', 'grade_subject_id', $obj__TT->subject).'</td>
													<td>'.$obj__TT->name.'</td>
													<td>'.$obj__TT->date_assigned.'</td>
													<td>'.$obj__TT->date_due.'</td>
													<td>
														<div class="btn-group">
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
															Action <i class="fa fa-angle-down"></i></button>
																<ul class="dropdown-menu" role="menu">
																<li class="click_ult"><a href="?readonly='.$kas_framework->generateRandomString(20).'&&hmid='.$kas_framework->saltifyID($obj__TT->homework_id).'&&ref='.$kas_framework->generateRandomString(20).'"><i class="fa fa-file-text text-green"></i> View</a></li>
																<li class="click_ult"><a href="?deleted='.$kas_framework->generateRandomString(20).'&hmid='.$kas_framework->saltifyID($obj__TT->homework_id).'&&ref='.$kas_framework->generateRandomString(20).'"><i class="fa fa-trash-o text-red"></i> Delete</a></li>
																</ul>
														</div>
													</td>
													</tr>';
											}
										$db_hwQuery = null;
									   print '</tfoot>
									</table>
								</div>
							</div>
						</div>';
										
					 include ('homework_Sidebar.php') ?>	
				</div>
			</section><!-- /.content -->
			</aside><!-- /.right-side -->
		</div><!-- /.col -->


        <!-- jQuery 2.0.2 -->
         <script src="<?php print constant('quad_return') ?>myjs/jquery.min.js"></script>
		<!---- my javascript controller -->
        <script src="<?php print constant('quad_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('quad_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?php print constant('quad_return') ?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php print constant('quad_return') ?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php print constant('quad_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>
		<!-- FancyBox -->
		<script src="<?php print constant('quad_return') ?>fancybox/jquery.fancybox.js" type="text/javascript"></script>
		<script src="<?php print constant('quad_return') ?>fancybox/media_helper.js" type="text/javascript"></script><script type="text/javascript">

            $(function() {  $("#example1").dataTable(); });
			 //Datemask dd/mm/yyyy
             $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        </script>
<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>