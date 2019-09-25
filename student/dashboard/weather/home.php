<?php 
	require ('../../../php.files/classes/pdoDB.php');
	require ('../../../php.files/classes/kas-framework.php');
	$kas_framework->safesession();
	$kas_framework->checkAuthStudent();
	require (constant('tripple_return').'php.files/classes/generalVariables.php');
	require (constant('tripple_return').'php.files/classes/students.php');
	require (constant('tripple_return').'php.files/student_details.php');	
	require (constant('tripple_return').'php.files/classes/device_detect.php');		
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Weather</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('tripple_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('tripple_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('tripple_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('tripple_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="myjs/html5shiv.js"></script>
          <script src="myjs/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
	
	<?php require (constant('double_return').'inc.files/header.php') ?>
	<p style="margin-top:18px">&nbsp;</p>
	<div class="wrapper row-offcanvas row-offcanvas-left">
	<?php require (constant('double_return').'inc.files/sidebar.php') ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><i class="fa fa-cloud"></i> Weather Update <?php $student->display_accessLevel(); ?></h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="../"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="active"><i class="fa fa-cloud"></i>&nbsp;&nbsp;Weather</li>
                    </ol>
                </section>

			 <!-- Main content -->
                <section class="content">
		<?php //$student->authConfirm($useradmitStatus); ?>
				  <div class="box box-success">
		<div class="box-header">
			<h3 class="box-title"><i class="fa fa-cloud"></i> Nigeria</h3>
			<?php if ($device != 'mobile') { ?>
			<div class="determiner">
				<script type="text/javascript" src="http://www.freemeteo.com/weather.fm?key=F783EC05203554C4639E07E95C56DDB0305741"></script>
			</div>
			<?php } ?>
			<div class="messageForSmallScreen" style="margin:60px auto 0 auto; width:90%;">
			<?php $kas_framework->showinfowithBlue("This Feauture is Only available for Screens with a Minimum of 960px wide. 
			This Feature will not apply on this device. Please use a Laptop or a palmtop for this. Thanks") ?>
			</div>
		</div>
		
		<style type="text/css">
		@media only screen and (min-width:980px) {
			.messageForSmallScreen { display:none; }
		} 
		@media only screen and (max-width:979px) {
			.determiner { display: none; }
		}
		</style>

	</div><!-- /.box (chat box) -->
	</div><!-- /.box (chat box) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="<?php print constant('tripple_return') ?>myjs/jquery.min.js"></script>
        <!---- my javascript controller -->
        <script src="<?php print constant('tripple_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?php print constant('tripple_return') ?>js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('tripple_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php print constant('tripple_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>   
		<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>