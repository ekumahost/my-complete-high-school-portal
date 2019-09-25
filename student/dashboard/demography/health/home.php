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
        <title>Health</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('quad_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- DATA TABLES -->
		<link href="<?php print constant('quad_return') ?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<!-- Bootstrap time Picker -->
        <link href="<?php print constant('quad_return') ?>css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Ionicons -->
        <link href="<?php print constant('quad_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('quad_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
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
                    <h1><i class="fa fa-plus-square"></i> My Health <?php $student->display_accessLevel(); ?></h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
						<li class="click_ult"><a href="../"><i class="fa fa-th-large"></i>Demography</a></li>
						<li class="active"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Health</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				
				<?php //$student->authConfirm($useradmitStatus); ?>
					<?php $decode_std_id = $userid;
					require (constant('quad_return').'php.files/classes/health_retriever.php');
					include (constant('quad_return').'inc.files/student_health_catalogue.php') ?>
					 
					 
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
		<!-- DATA TABES SCRIPT -->
		<script src="<?php print constant('quad_return') ?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
		<script src="<?php print constant('quad_return') ?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
			//data table
			 $(function() {  $("#example1").dataTable(); });
				
        </script>
		<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>