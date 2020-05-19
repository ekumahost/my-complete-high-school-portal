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
        <title>Form Master</title>
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
		select { padding:5px; } 
		.ca { width:40px; padding:4px }
		.exam { width:50px; padding:4px }
	</style>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
		<?php require (constant('double_return').'inc.files/header.php') ?>
		<p style="margin-top:18px" class="no-print">&nbsp;</p>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
		<?php require (constant('double_return').'inc.files/sidebar.php') ?>
			<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <i class="fa fa-comment-o text-ult_custom1"></i> Form Masters Comment
                    </h1>
                    <ol class="breadcrumb">
                        <li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="active"><i class="fa fa-comment-o "></i>&nbsp;&nbsp;FM Comments</li>
                    </ol>
                </section>
				
			<!-- Main content -->
                <section class="content">
				<?php $staff->checkBasicPlan(); 
				print '<div class="no-print col-sm-6 col-xl-6">';
				/* maKing sure that the user is a teacher */
				if ($staff->checkTeacher($web_users_type) == false){
					$kas_framework->showDangerCallout('This Panel is for Teachers Only. Please <a href="'. constant('single_return').'">Visit the Dashboard</a>');
					print '<center><img src="'.$kas_framework->url_root('img/restricted.png').'" width="60%"/>
						<img src="'.$kas_framework->url_root('img/sorry.png').'" width="50%"/></center>';
					//exit();
				} else { 
					$getClass = "SELECT * FROM teacher_grade_year WHERE teacher = '".$web_users_relid."'"; 
					$db_getClass = $dbh->prepare($getClass);
					$db_getClass->execute();
					$get_getClass_rows = $db_getClass->rowCount();
					$paramObj = $db_getClass->fetch(PDO::FETCH_OBJ);
					$db_getClass = null;	
					
						$class = $paramObj->grade_class;
						$class_room = $paramObj->grade_class_room;
							if ($class == '0') { 
								$kas_framework->showWarningCallout('You are not the Form Master of Any Class!!!. Dont Bother About this Page. Have You <a href="upload" class="click_ult"> Uploaded Your Result?</a>.
								If you have Uploaded your result, then you can <a href="../manageResult/" class="click_ult"> View your Uploads</a> too.'); 
								} else {
								$getClass = $kas_framework->userGradeClass($class_room, $class);
								//$getClass = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $class);
								$kas_framework->showInfoCallout('You Have been Assigned to Manage '.$getClass.' Class');
								
					print '</div>';
					print '<div class="no-print col-sm-6 col-xl-6">';	?>
						
						 <form action="broadsheet" method="get" id="select_form" target="_blank">
									<select name="year"> 
									<option></option>
									<?php $kas_framework->getDistinctField('grade_history_primary', 'year', 'exam_type', '1', 'school_years', 'school_years_desc', 'school_years_id', $current_year_id); ?>
									</select>
									
									<select id="term" name="term">
									 <option></option>
									<?php $kas_framework->getDistinctField('grade_history_primary', 'quarter', 'user', $web_users_relid, 'grade_terms', 'grade_terms_desc', 'grade_terms_id', $currentTerm_id) ?>
									</select>
									<span id="grade_class_deduction"></span>
										<input name="grade" type="hidden" value="<?php print $class ?>" />
										<button id="generate_button" type="submit" name="create_result" class="btn btn-primary"><i class="fa fa-th-list"></i> Broadsheet</button>
								 </form> 
						
				<?php	print '</div><br /><br /><br /><br />';
								
								print '<div id="sponsor_div101" class="no-print">
											<button style="display:none" class="btn btn-default btn-flat load_list_again"><i class="fa fa-list-alt"></i> <i class="fa fa-mail-reply"></i>  Go Back to the List Again</button>
										</div>';
								print '<div id="sponsor_div2"></div>';
								print '<div id="sponsor_div1"></div>';
				
				}
			} ?>
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
		 $('#sponsor_div1').html('<?php $kas_framework->loading('center'); ?>');
            $(function() {  $("#example1").dataTable(); });
				$(document).on('ready', function(e){
					$('#sponsor_div1').delay(500).load('formMaster_classList_load').show();
				})
				
				$('.load_list_again').on('click', function(e){
					$(this).hide();
					$('#sponsor_div2').hide();
					$('#sponsor_div1').delay(500).load('formMaster_classList_load').show();
				});
			
        </script>
		
<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>