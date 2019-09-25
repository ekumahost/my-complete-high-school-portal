<?php 
require ('../../../../php.files/classes/pdoDB.php');	
require ('../../../../php.files/classes/kas-framework.php');	
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('quad_return').'php.files/classes/students.php');
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/student_details.php');	
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Homework</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('quad_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- Bootstrap time Picker -->
        <link href="<?php print constant('quad_return') ?>css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Ionicons -->
        <link href="<?php print constant('quad_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('quad_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
		<!-- fancybox -->
		<link href="<?php print constant('quad_return') ?>fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
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
                    <h1><i class="fa fa-suitcase text-ult_custom"></i> Homework <?php $student->display_accessLevel(); ?></h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
						<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dot-circle-o"></i>Academics</a></li>
						<li class="active"><i class="fa fa-suitcase"></i>&nbsp;&nbsp;Homework</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				
				<?php //$student->authConfirm($useradmitStatus); ?>
					<div class="row">
     <!------------------------------------------------------------------------------------------------------>
					<div class="col-md-9">
					 <?php
					 
						$dyn_grade_year = (isset($_POST['school_years']))? $_POST['school_years']:  $current_year_id;
						$dyn_grade_history_term = (isset($_POST['grade_terms']))? $_POST['grade_terms']:  $currentTerm_id;
						$dyn_grade = (isset($_POST['grade']))? $_POST['grade']: $user_student_grade_year_grade_id;
					 
					 if (isset($_GET['readonly'])) { include (constant('quad_return').'inc.files/read_homework_plugin.php'); }
					 
					$hwQuery = "SELECT * FROM homework WHERE session LIKE '".$dyn_grade_year."' AND term LIKE '".$dyn_grade_history_term."'
							AND grade LIKE '".$dyn_grade."' ORDER BY homework_id DESC";
							$db_handle = $dbh->prepare($hwQuery);
							$db_handle->execute();
							$get_rows = $db_handle->rowCount();
							
						if ($get_rows == 0) { print $kas_framework->showWarningCallout('No Homework Set yet. Please Wait till your Instructor tells you that there is a homework'); }
							$serial = 0;
							
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
												<th></th>
											</tr>
										</thead>
										<tbody>';
									while ($obj__TT = $db_handle->fetch(PDO::FETCH_OBJ)) {
										$serial = $serial + 1;
								
									print '<tr>
											<td>'.$serial.'</td>
											<td>'.$kas_framework->getValue('grade_subject_desc', 'grade_subjects', 'grade_subject_id', $obj__TT->subject).'</td>
											<td>'.$obj__TT->name.'</td>
											<td>'.$obj__TT->date_assigned.'</td>
											<td>'.$obj__TT->date_due.'</td>
											<td> <a rel="chuvin" href="?readonly='.$kas_framework->generateRandomString(20).'&&hmid='.$kas_framework->saltifyID($obj__TT->homework_id).'&&ref='.$kas_framework->generateRandomString(20).'" class="btn btn-default click_ult"><i class="fa fa-file-text-o "></i> View Homework</a></td>
											</tr>';
									}
							   print '</tfoot>
							</table>
						</div>
					</div>';
				?>
			</div>		
	<!------------------------------------------------------------------------------------------------------>											
			<?php include ('homework_Sidebar.php') ?>
                    </div><!-- ./row -->
			
			</section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


          <!-- jQuery 2.0.2 -->
        <script src="<?php print constant('quad_return') ?>myjs/jquery.min.js"></script>
		 <!---- my javascript controller -->
        <script src="<?php print constant('quad_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('quad_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php print constant('quad_return') ?>js/AdminLTE/app.js" type="text/javascript"></script> 
		<!-- bootstrap time picker -->
        <script src="<?php print constant('quad_return') ?>js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
		<!-- FancyBox -->
		<script src="<?php print constant('quad_return') ?>fancybox/jquery.fancybox.js" type="text/javascript"></script>
		<script src="<?php print constant('quad_return') ?>fancybox/media_helper.js" type="text/javascript"></script>
        <!-- CK Editor -->
        <script src="<?php print constant('quad_return') ?>js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php print constant('quad_return') ?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('editor1');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
			
			//Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
        </script>

	<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>