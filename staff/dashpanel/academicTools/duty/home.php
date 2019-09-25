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
        <title>Speak Peroids</title>
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
                        <i class="fa fa-volume-up text-ult_custom"></i> Duty Roaster
                    </h1>
                    <ol class="breadcrumb">
                        <li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
						<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-th-large"></i>Academic Tools</a></li>
                        <li class="active"><i class="fa fa-volume-up"></i>&nbsp;&nbsp;duty</li>
                    </ol>
                </section>
			<?php 	
				
				/* making sure that there is no get variable in the url for the deducing of parameters passed to the table */
				$dyn_grade_year = (isset($_POST['school_years']))? $_POST['school_years'] :  $current_year_id;
				$dyn_grade_history_term = (isset($_POST['grade_terms']))? $_POST['grade_terms'] :  $currentTerm_id;
				/* making sure that there is no get variable in the url for the deducing of parameters passed to the table and beyond */ 
				
			?>				
				<!-- Main content -->
			<section class="content">
				<?php $staff->checkBasicPlan(); ?>
					<div class="row">
                        <div class="col-md-9">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Roaster</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Day</th>
												<th>Date</th>
                                                <th>Period</th>
                                                <th>Explanation</th>
                                                <th>Term</th>
												<th>Session</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
										$speak = "SELECT * FROM speak WHERE speak_teacherid = '".$web_users_relid."'
													AND speak_term LIKE '".$dyn_grade_history_term."'
													AND speak_session LIKE '".$dyn_grade_year."' ORDER by speak_id DESC";
												$db_speak = $dbh->prepare($speak);
												$db_speak->execute();												
													$sn = 0;
													while ($speakPeriod = $db_speak->fetch(PDO::FETCH_OBJ)) {
														$sn = $sn + 1;
														print '<tr>
																<td>'.$sn.'</td>
																<td>'.$kas_framework->getValue('days_desc', 'tbl_days', 'days_id', $speakPeriod->speak_day).'</td>
																<td>'.$speakPeriod->speak_date.'</td>
																<td>'.$kas_framework->getValue('desc', 'school_class_periods', 'id', $speakPeriod->speak_period).' 
																('.$kas_framework->getValue('periods', 'school_class_periods', 'id', $speakPeriod->speak_period).')</td>
																<td>'.$speakPeriod->speak_note.'</td>
																<td>'.$kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $speakPeriod->speak_term).'</td>
																<td>'.$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $speakPeriod->speak_session).'</td>
															</tr>';
													}
												$db_speak = null; // close the database prepare connection
										?>
                                        </tfoot>
									</table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
						<?php include ('duty_Sidebar.php') ?>	
					</div>
				</div><!-- /.col -->
                </section><!-- /.content -->
				
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


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
        <!-- page script -->
        <script type="text/javascript">
            $(function() {  $("#example1").dataTable(); });
        </script>
<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>