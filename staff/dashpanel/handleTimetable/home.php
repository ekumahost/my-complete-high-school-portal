<?php 
	require ('../../../php.files/classes/pdoDB.php');
	require ('../../../php.files/classes/kas-framework.php');
	$kas_framework->safesession();
	$kas_framework->checkAuthStaff();
	require (constant('tripple_return').'php.files/classes/generalVariables.php');
	require (constant('double_return').'inc.files/handleFixedFormat.php');
	require (constant('tripple_return').'php.files/classes/attendance.php');
	
	require (constant('tripple_return').'php.files/staff_details.php');
	require (constant('tripple_return').'php.files/classes/staff.php');	
 ?>
<!DOCTYPE html>
<html>
<style type="text/css">
	select { padding:8px; } 
</style>	
			
    <head>
        <meta charset="UTF-8">
        <title>Manage Timatable</title>
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
                        <i class="fa fa-table text-red"></i> Manage School Timetable
                    </h1>
                    <ol class="breadcrumb">
						<li><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="active"><i class="fa fa-ellipsis-h"></i>&nbsp;&nbsp;Attendance</li>
                    </ol>
                </section>
				
			<!-- Main content -->
             <section class="content">
			 <?php $staff->checkBasicPlan();
			 
				if ($staff_timetable == '0') {
					print ($kas_framework->showDangerCallout('You dont Have the Priviledge to Manage the The Attendance of the Whole Students. Tell the Admin to grant you the Priviledge. 
					<a href="'.$kas_framework->server_root_dir('staff/dashpanel/').'">Visit the DashPanel?</a>'));
					print '<center><img src="'.$kas_framework->server_root_dir('img/restricted.png').'" width="60%"/>
					<img src="'.$kas_framework->server_root_dir('img/sorry.png').'" width="50%"/></center>';
				} else {
			?>
				
			<?php // $student->authConfirm($useradmitStatus); ?>
					<div class="row"> 
						<div class="col-md-9">
                            <div class="box">
								 <div class="box-body table-responsive">
								 <form action="" method="post" id="select_form">									
									<label for="grade"><font color="red">*</font>Set/Edit Timetable For Grade</label>
									<select id="grade" name="grade"><option value="<?php print $kas_framework->getValue('grades_id', 'grades', 'grades_id', @$_POST['grade']) ?>">
									<?php print $kas_framework->getValue('grades_desc', 'grades', 'grades_id', @$_POST['grade']) ?></option>
									<?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id')  ?>
									</select>
									<input type="hidden" value="khnBGVTCYDTRXx45cyv6" name="byepass">
									<span id="grade_class_deduction"></span>
										<input name="byepass" type="hidden" value="omUIYTVRC4x325467890k90J9MNUBY" />
										<button id="generate_button" disabled="disabled" type="submit" name="create_result" class="btn btn-primary"><i class="fa fa-th-list"></i> Proceed</button>
								 </form>  
								</div>
							</div>
							
							 
								<div id="proceed_div1"></div>
								<div id="proceed_div2"> </div>
							
						</div>
						
					<?php include ('tt_sidebar.php') ?>
				</div><!-- ./row -->
					
				<?php  } ?>
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
		 $('#grade').on('change', function() {
			grade_val = $(this).val();
			if (grade_val != '') {
				$('#grade_class_deduction').html('wait...');
				byepass = 'oiU6545342X4cruvtobyno';
				//to get the sub classes for the timetable generation. process is enhanced by ajax jquery
					$.post('../manageResult/process_result_upload?get_result', {grade_val:grade_val, byepass:byepass}, function(fdata){
						$('#grade_class_deduction').html(fdata);
						$('#proceed_div1, #proceed_div2').html('');
					})
			} else {
				$('#generate_button').attr('disabled', 'disabled');
				$('#grade_class_deduction').html('');
				$('#proceed_div1, #proceed_div2').html('');
			}
			
		})
		
		$('#select_form').on('submit', function(e){
			$('#proceed_div1').html('<?php $kas_framework->loading_h('center'); ?>').show();
			$('#proceed_div2').html('');
			var mydata = $('#select_form :input').serializeArray();
			$.post('generate_timetable?add', mydata, function(data_returned) {
				$('#proceed_div1').html(data_returned);
			})
			return false;
		})
        </script>
    </body>
</html>