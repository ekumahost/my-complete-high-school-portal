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
	<title>Mailbox</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
	<!-- bootstrap 3.0.2 -->
	<link href="<?php print constant('tripple_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- font Awesome -->
	<link href="<?php print constant('tripple_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link href="<?php print constant('tripple_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- bootstrap wysihtml5 - text editor -->
	<link href="<?php print constant('tripple_return') ?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="<?php print constant('tripple_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

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
				  <i class="fa fa-envelope"></i> Mailbox
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>DashPanel</a></li>
					<li class="active"><i class="fa fa-envelope"></i>&nbsp;&nbsp;Mailbox</li>
				</ol>
			</section>
			<!-- Main content -->
			<section class="content">
				<?php $staff->authConfirm($staff_status); $staff->checkBasicPlan(); ?>
				<?php include (constant('tripple_return').'php.files/mailbox_handlers/mailbox-full-body.php'); ?>
			</section><!-- /.content -->
		</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->

	<!-- COMPOSE MESSAGE MODAL -->
		<?php include (constant('tripple_return').'php.files/mailbox_handlers/compose-modal.php'); ?>

	<!-- jQuery 2.0.2 -->
	<script src="<?php print constant('tripple_return') ?>myjs/jquery.min.js"></script>
	 <!---- my javascript controller -->
	<script src="<?php print constant('tripple_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
	<!-- Bootstrap -->
	<script src="<?php print constant('tripple_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
	<!-- AdminLTE App -->
	<script src="<?php print constant('tripple_return') ?>js/AdminLTE/app_demolized.js" type="text/javascript"></script>        
	<!-- Bootstrap WYSIHTML5 -->
	<script src="../jsplugins//bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
	<!-- Page script -->
	<script src="<?php print constant('tripple_return') ?>myjs/mail_js.js" type="text/javascript"></script>
<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>
</body>
</html>
</html>