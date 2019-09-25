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
         <title>Birthdays</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('quad_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- DATA TABLES -->
		<link href="<?php print constant('quad_return') ?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('quad_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('quad_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- Bootsrap -->
        <link href="<?php print constant('quad_return') ?>fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
		<!-- fullCalendar -->
        <link href="<?php print constant('quad_return') ?>css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.<?php print constant('quad_return') ?>js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue" style="min-height:auto">
	<!-- go top scroller --><div id="comment"></div>
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
				<h1> <i class="fa fa-gift"></i> Birthday <?php $staff->display_accessLevel(); ?> </h1>
				<ol class="breadcrumb">
					<li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
					<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-windows"></i>Social</a></li>
					<li class="active"><i class="fa fa-gift"></i>&nbsp;&nbsp;Birthday</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
			<?php $staff->checkBasicPlan(); ?>
				<!-- row -->
				
				<div class="row">
					<?php include (constant('quad_return').'inc.files/today_birthday_plugin.php') ?>
					<?php include (constant('quad_return').'inc.files/birthday_Sidebar.php') ?>
			</div><!-- /.row -->
			

			<!-- Calendar -->
			   <div class="col-md-9">
				<div class="box box-warning" id="schoolCalendar">
					<div class="box-header">
						<i class="fa fa-calendar"></i>
						<div class="box-title">Birthday Calendar for <?php print date('2015') ?></div>
						
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
			</div> 
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
	<!-- fullCalendar -->
	<script src="<?php print constant('quad_return') ?>js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
	 <!-- FancyBox -->
	<script src="<?php print constant('quad_return') ?>fancybox/jquery.fancybox.js" type="text/javascript"></script>
	<script src="<?php print constant('quad_return') ?>fancybox/media_helper.js" type="text/javascript"></script>
	<!--------- my Script or Loaderz ------------>
	<script type="text/javascript"> $(function() {  $("#example1").dataTable(); }); </script>
	<?php include (constant('quad_return').'inc.files/allBdayCalendarPlugin.php'); ?>
	<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>