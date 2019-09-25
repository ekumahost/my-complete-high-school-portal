<?php
require ('../../php.files/classes/pdoDB.php');
require ('../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('double_return').'php.files/classes/students.php');
require (constant('double_return').'php.files/classes/generalVariables.php');
require (constant('double_return').'php.files/student_details.php');

require (constant('single_return').'inc.files/cookieWriter.php');
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Not Initialized</title>
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
                    <h1><i class="fa fa-warning text-red"></i> Plugin not Installed <?php $student->display_accessLevel(); ?> </h1>
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Not Initialized</li>
                    </ol>
                </section>

			 <!-- Main content -->
                <section class="content">
				  <div class="row">
					<div class="box box-success">
						<div class="box-header">
							<h3 class="box-title"><i class="fa fa-warning"></i> Plugin not Installed</h3>
						</div>
							<p style="padding:20px">Plugin has not been Initialized yet! The School Administrator will get back to you when the Integration is done.</p>

						</div><!-- /.box (chat box) -->
                    </div><!-- /.row -->

                    <!-- /.row -->
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