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
        <title>Teaching Time Table</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
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
                        <i class="fa fa-table text-green"></i> Teaching TimeTable
                    </h1>
                    <ol class="breadcrumb">
                        <li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
						<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-th-large"></i>Academic Tools</a></li>
                        <li class="active"><i class="fa fa-table"></i>&nbsp;&nbsp;Teaching TT</li>
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
	<!------------------------------------------------------------------------------------------------------>
			<?php 
			$currentYear = $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $dyn_grade_year);
			$currentTerm = $kas_framework->getValue('grade_terms_id', 'grade_terms', 'grade_terms_id', $dyn_grade_history_term);
			$kas_framework->showInfoCallout('<b>Note:</b> Showing your teaching ime table for: SESSION: '.$currentYear.' &raquo&raquo TERM '.$currentTerm.' ');
				/* dont get scared... its just a crazy function */
				$staff->teachingTT(1, $dyn_grade_history_term, $dyn_grade_year, $staff_school, $web_users_relid); /* for monday */
				$staff->teachingTT(2, $dyn_grade_history_term, $dyn_grade_year, $staff_school, $web_users_relid); /* for tuesday */
				$staff->teachingTT(3, $dyn_grade_history_term, $dyn_grade_year, $staff_school, $web_users_relid); /* for wednesday */
				$staff->teachingTT(4, $dyn_grade_history_term, $dyn_grade_year, $staff_school, $web_users_relid); /* for thursday */
				$staff->teachingTT(5, $dyn_grade_history_term, $dyn_grade_year, $staff_school, $web_users_relid); /* for friday */
			?>
	<!------------------------------------------------------------------------------------------------------>											
						
						<?php  include ('teaching_tt_Sidebar.php') ?>	
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
        <!-- AdminLTE App -->
        <script src="<?php print constant('quad_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- page script -->

<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>