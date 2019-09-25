<?php 
require ('../../php.files/classes/pdoDB.php');
require ('../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
require (constant('double_return').'php.files/classes/generalVariables.php');
require (constant('double_return').'php.files/staff_details.php');
require (constant('double_return').'php.files/classes/staff.php');
require (constant('single_return').'inc.files/cookieWriter.php');
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DashPanel</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('double_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('double_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('double_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="<?php print constant('double_return') ?>css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
         <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php print constant('double_return') ?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('double_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- fancybox -->
		<link href="<?php print constant('double_return') ?>fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="../myjs/html5shiv.js"></script>
          <script src="../myjs/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
	
	<?php require (constant('single_return').'inc.files/header.php') ?>
	<p style="margin-top:18px">&nbsp;</p>
	<div class="wrapper row-offcanvas row-offcanvas-left">
	<?php require (constant('single_return').'inc.files/sidebar.php') ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                 <section class="content-header">
                    <h1>
                      <i class="fa fa-dashboard text-green"></i>  Staff DashPanel
                       <?php $staff->display_accessLevel(); ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
                    </ol>
                </section>

			 <!-- Main content -->
                <section class="content">
			<?php $staff->authConfirm($staff_status); 
					if ($staff_type == 'T') { //making sure its a teaching staff.
						$getClass = "SELECT * FROM teacher_grade_year WHERE teacher = '".$web_users_relid."' AND session = '".$current_year_id."'"; 
							$db_getClass = $dbh->prepare($getClass);
							$db_getClass->execute();
							$get_db_getClass_rows = $db_getClass->rowCount();
							$param_db_getClass_Obj = $db_getClass->fetch(PDO::FETCH_OBJ);
							$db_getClass = null;
							
							$class = $param_db_getClass_Obj->grade_class;
							$class_room = $param_db_getClass_Obj->grade_class_room;
								if ($class == '0') { $intro = 'Not Yet a Form Master'; } 
								else {
									$getClass = $kas_framework->userGradeClass($class_room, $class);
									//$getClass = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $class);
									$intro = 'Form Master of '.$getClass.' Class';
								}
					}
			?>
			
			<h2> <?php $kas_framework->displaySchoolLogo('50', 'circle', '0 5px 0 0');
					print $kas_framework->displayUserSchool($staff_school);  ?> </h2>	
					
			<?php print '<h4>Currrent Year: '. $current_year_full. ' &raquo; '. $currentTerm .'  &raquo; '.$intro.'</h4>'; 

			$kas_framework->getMessageforUser('staff'); ?>	
			<!-- Small boxes (Stat box) $user_student_grade_year_grade_id -->
                 
			
				  <div class="row">
                    <!-- Small boxes (Stat box) -->
						<div class="ultimrap">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h2> Payments </h2>
                                    <p> Bank Payment with ATM, Invoice. </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <a href="#" class="small-box-footer click_ult">
                                    Tutorial <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
		
				<?php /* checking if the user is a teacher so that this will not show*/ 
					if (($staff->checkTeacher($web_users_type) == true) and ($staff->basicPlan() == false)) { ?>
						<div class="ultimrap">
                            <!-- small box -->
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <h2> Academic Tools</h2>
                                    <p>Speaking Hour, Timetable, Homework</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-th-large"></i>
                                </div>
                                <a href="academicTools/" class="small-box-footer click_ult"> Open Panel <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div><!-- ./col -->
				<?php } ?>
                        <div class="ultimrap">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h2>My Tools</h2>
                                    <p>Calendar, Notepad and Gallery</p>
                                </div>
                                <div class="icon"> <i class="fa fa-table"></i> </div>
                                <a href="mytools/" class="small-box-footer click_ult">Open Content <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="ultimrap">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h2>Academic </h2>
                                    <p> Timetable, Homework and Library</p>
                                </div>
                                <div class="icon"><i class="fa fa-book"></i> </div>
                                <a href="academicTools/" class="small-box-footer click_ult"> Open Content <i class="fa fa-arrow-circle-right"></i> </a>
                            </div>
                        </div><!-- ./col -->
						
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section style="margin:16px"> 
                            <!-- Box (with bar chart removed) -->
							
							<!-- Custom tabs (Charts with tabs removed)-->
                                                
                            <!-- Calendar -->
                            <div class="box box-warning" id="schoolCalendar">
                                <div class="box-header">
                                    <i class="fa fa-calendar"></i>
                                    <div class="box-title">School Calendar</div>
                                    
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <!-- button with a dropdown -->

                                    </div><!-- /. tools -->                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <!--The calendar -->
                                    <div id="calendar"></div>
                                </div><!-- /.box-body -->
							</div><!-- /.box -->

                            <!-- quick email widget removed -->
                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-6 connectedSortable">
                            <!-- Map box removed -->
							<!-- Chat box removed -->
							<!-- TO DO List removed -->
						</section><!-- right col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

      
        <!-- jQuery 2.0.2 -->
        <script src="<?php print constant('double_return') ?>myjs/jquery.min.js"></script>
        <!---- my javascript controller -->
        <script src="<?php print constant('double_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
	     <!-- AdminLTE App -->
        <script src="<?php print constant('double_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('double_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="<?php print constant('double_return') ?>js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script type="text/javascript">
			$('#strapPanel').click(function(e){
				$('#teacher_student_pane').slideDown(1000);
				return false;
			})
		</script> 
	<?php include (constant('double_return').'inc.files/schoolCalendarPlugin.php') ?>
	<?php include (constant('double_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>