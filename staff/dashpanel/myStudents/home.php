<?php 
	require ('../../../php.files/classes/pdoDB.php');
	require ('../../../php.files/classes/kas-framework.php');
		$kas_framework->safesession();
		$kas_framework->checkAuthStaff();
	require (constant('tripple_return').'php.files/classes/generalVariables.php');
	require (constant('tripple_return').'php.files/staff_details.php');
	require (constant('tripple_return').'php.files/classes/staff.php');
	require ('table_picker.php');	
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>My Students</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
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
                    <h1><i class="fa fa-desktop"></i> My Students <small>Manager</small> </h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="active"><i class="fa fa-users"></i>&nbsp;&nbsp;My Students</li>
                    </ol>
                </section>
				
				 <!-- Main content -->
                <section class="content">
					<?php $staff->checkBasicPlan(); ?>
				<?php 
				/* maKing sure that the user is a teacher */
				if ($staff->checkTeacher($web_users_type) == false){
					exit($kas_framework->showDangerCallout('This Panel is for Teachers Only. Please <a href="'.constant('single_return').'">Visit the Dashboard</a>'));
				}
				
				if (isset($_GET['myStudents'])) {
					print '<a href="?myClass" class="click_ult"><button class="btn bg-ash btn-flat margin">
						<i class="fa fa-chevron-left"></i> Switch To My Assigned Class</button> </a>';
						$kas_framework->showInfoCallout('Currrently Viewing Your <b>Assigned Students</b>. Use the Buttons Above to Switch');
						include ('myStudents.php');
						
				} else if (isset($_GET['myClass'])) {
					print '<a href="?myStudents" class="click_ult"><button class="btn bg-ash btn-flat margin">
						Switch To My Assigned Students <i class="fa fa-chevron-right"></i></button> </a>';
						$kas_framework->showInfoCallout('Currrently Viewing Your <b>Assigned Class</b>. Use the Buttons Above to Switch');
						include ('myClass.php');
						
				} else {
					$kas_framework->showWarningCallout('Please Click on any Of the Buttons Below to Give you the Assigned Page..');
					print '<a href="?myClass"><button class="btn bg-blue btn-flat margin click_ult">
						<i class="fa fa-chevron-left"></i> Switch To My Assigned Class </button> </a>';
					print '<a href="?myStudents"><button class="btn bg-maroon btn-flat margin click_ult">
						Switch To My Assigned Students <i class="fa fa-chevron-right"></i> </button> </a>';
							
				}
				
				?>
				
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
            $(function() {  $("#example1").dataTable(); });
        </script>
<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>