<?php 
	require ('../../../php.files/classes/pdoDB.php');
	require ('../../../php.files/classes/kas-framework.php');
	$kas_framework->safesession();
	$kas_framework->checkAuthStaff();
	require (constant('tripple_return').'php.files/classes/generalVariables.php');	
	require (constant('tripple_return').'php.files/staff_details.php');
	require (constant('tripple_return').'php.files/classes/staff.php');
	extract($_POST);
	
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Upload Result</title>
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
	<style type="text/css">
		select { padding:5px; } 
		.ca { width:40px; padding:4px }
		.exam { width:50px; padding:4px }
	</style>
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
                        <i class="fa fa-cloud-upload text-ult_custom4"></i> Upload Result
                    </h1>
                    <ol class="breadcrumb">
                        <li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="active"><i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;Result Upload</li>
                    </ol>
                </section>
				
			<!-- Main content -->
             <section class="content">
			 <?php $staff->checkBasicPlan(); ?>
			<?php
				/* maKing sure that the user is a teacher */
				if ($staff->checkTeacher($web_users_type) == false){
				$kas_framework->showDangerCallout('This Panel is for Teachers Only. Please <a href="'.constant('single_return').'">Visit the Dashboard</a>');
				print '<center><img src="'.$kas_framework->url_root('img/restricted.png').'" width="60%"/>
					<img src="'.$kas_framework->url_root('img/sorry.png').'" width="50%"/></center>';
					//exit();
				} else { 
					
				if ($kas_framework->app_config_setting('student_result_uploading') == false) {
						$kas_framework->showDangerCallout('<center> Sorry! You can not upload results at the Moment. Please meet the admin if the need arises. </center>'); 
						print '<center><img src="'.$kas_framework->url_root('img/restricted.png').'" width="60%"/>
						<img src="'.$kas_framework->url_root('img/sorry.png').'" width="50%"/></center>';
					} else { ?>				
				
				<div style="background-color:none; padding:6px 10px; border:2px solid #CCC; display:none" id="div_msg_warning">You are About to Upload Results for a Class.
					Only two test scores and an Exam score will be Uploaded, the portal will do the rest.</div>
					
					<div class="row">
						<div class="col-xs-12">
                            <div class="box">
								 <div class="box-body table-responsive">
								 <form action="" method="post" id="select_form">
									<label for="subject"><font color="red">*</font> Subject</label>
									<select name="subject"><option value="<?php print $kas_framework->getValue('grade_subject_id', 'grade_subjects', 'grade_subject_id', @$_POST['subject']) ?>"> 
									<?php print $kas_framework->getValue('grade_subject_desc', 'grade_subjects', 'grade_subject_id', @$_POST['subject']) ?></option>
									<?php $kas_framework->getallFieldinDropdownOption('grade_subjects', 'grade_subject_desc', 'grade_subject_id')  ?>
									</select>
									
									<label for="grade"><font color="red">*</font> Grade</label>
									<select id="grade" name="grade"><option value="<?php print $kas_framework->getValue('grades_id', 'grades', 'grades_id', @$_POST['grade']) ?>">
									<?php print $kas_framework->getValue('grades_desc', 'grades', 'grades_id', @$_POST['grade']) ?></option>
									<?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id')  ?>
									</select>
									<span id="grade_class_deduction"></span>
										<input name="byepass" type="hidden" value="omUIYTVRC4x325467890k90J9MNUBY" />
										<button id="generate_button" disabled="disabled" type="submit" name="create_result" class="btn btn-primary"><i class="fa fa-th-list"></i> Proceed</button>
								 </form>  
								</div>
							</div>
						</div>
						
						<div class="col-xs-12">
							<div id="proceed_div1"></div>
							<div id="proceed_div2"> </div>
						</div>
					</div>
					<?php } /* end of the checking of tbl_app_config */ ?>
					
				<?php } /* end of the checking if the user type is a staff */ ?>
                </section><!-- /.content -->
				
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
         <script src="<?php print constant('tripple_return') ?>myjs/jquery.min.js"></script>
		<!---- my javascript controller -->
        <script src="<?php print constant('tripple_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('tripple_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
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
				$('#div_msg_warning').slideDown(1000);
				$('#grade_class_deduction').html('wait...');
				byepass = 'oiU6545342X4cruvtobyno';
					$.post('process_result_upload?get_result', {grade_val:grade_val, byepass:byepass}, function(fdata){
						$('#grade_class_deduction').html(fdata);
						$('#proceed_div1, #proceed_div2').html('');
					})
			} else {
				$('#generate_button').attr('disabled', 'disabled');
				$('#grade_class_deduction').html('');
				$('#proceed_div1, #proceed_div2').html('');
			}
			
		})

			$('#select_form').on('submit', function(){
				$('#proceed_div1').html('<?php $kas_framework->loading('center'); ?>').show();
				$('#div_msg_warning').slideUp(1000);
				var mydata = $('#select_form :input').serializeArray();
				$.post('process_result_upload?generate_result', mydata , function(data) {
					$('#proceed_div1').html(data).show();	
					$('#proceed_div2').html('');
					$('#proceed_div1_2').html('');
					$('#div_msg_warning').html('Please put dash(-) for any student that is not offering this Subject.').slideDown(1000);
				});
				
				return false;
			})
			
        </script>

    </body>
</html>