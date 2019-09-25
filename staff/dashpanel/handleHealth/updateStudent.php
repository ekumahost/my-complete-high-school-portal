<?php 
	require ('../../../php.files/classes/pdoDB.php');
	require ('../../../php.files/classes/kas-framework.php');
	$kas_framework->safesession();
	$kas_framework->checkAuthStaff();
	require (constant('tripple_return').'php.files/classes/generalVariables.php');
	require (constant('tripple_return').'php.files/staff_details.php');
	require (constant('tripple_return').'php.files/classes/staff.php'); 
	
	/* making sure that a student is selected */
		if (!isset($_GET['click']) or !isset($_GET['stdid']) or !isset($_GET['ref'])) {
			$redirect = ($web_users_type == 'T')? $kas_framework->server_root_dir('staff/dashpanel/myStudents/?myStudents'): $kas_framework->server_root_dir('staff/dashpanel/handleHealth/');
			print '<script type="text/javascript">self.location = "'.$redirect.'" </script>';
		}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Manage Health</title>
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
	<!-- iCheck for checkboxes and radio inputs -->
	<link href="<?php print constant('tripple_return') ?>css/iCheck/all.css" rel="stylesheet" type="text/css" />
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
				   <i class="fa fa-plus-square text-red"></i> Manage Health 
				</h1>
				<ol class="breadcrumb">
                        <li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="click_ult"><a href="../handleHealth"><i class="fa fa-plus-square"></i> Health</a></li>
						<li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp;Student</li>
                    </ol>
			</section>
			
			<!-- Main content -->
			<section class="content">
			<?php $staff->checkBasicPlan(); ?>
			<?php
				if ($staff_discipline == '0' and $web_users_type != 'T') {
					exit($kas_framework->showDangerCallout('You dont Have the Priviledge to Manage the The Discipline of the Students. Tell the Admin to grant you the Priviledge'));
				} else {
					$decodeStdID = $kas_framework->unsaltifyID($_GET['stdid']);
					$getStdDetails = "SELECT * FROM studentbio, student_grade_year WHERE studentbio.studentbio_id = '".$decodeStdID."' AND studentbio.studentbio_id = student_grade_year.student_grade_year_student";
					$db_getStdDetails = $dbh->prepare($getStdDetails);
					$db_getStdDetails->execute();
					$get_getStdDetails_rows = $db_getStdDetails->rowCount();
					$studentObj = $db_getStdDetails->fetch(PDO::FETCH_OBJ);
					$db_getStdDetails = null;
					if ($get_getStdDetails_rows == 0) {
							$kas_framework->showDangerCallout('You Just Committed an Offense that is Punishable. You Just tried Hijacking a URL. A report has been Sent for Scrutiny. This Page have been Freezed. <a href="'.$kas_framework->server_root_dir('staff/dashpanel/').'">Visit the DashPanel</a> or <a href="'.$kas_framework->help_url('?topic=invalid-url-parameter').'" target="new">Explanation? <a>');
								print '<center><img src="'.$kas_framework->server_root_dir('img/restricted.png').'" width="60%"/>
								<img src="'.$kas_framework->server_root_dir('img/sorry.png').'" width="50%"/></center>';
							
						require (constant('tripple_return').'php.files/classes/PHPMailer/PHPMailerAutoload.php');
							require (constant('tripple_return').'php.files/classes/mailing_list.php');
								$mailing_list->mailHackingReport($kas_framework->returnUserSchool(''), 'A hacking attempt was just made on the portal of the schools name which appear above.
								<br />Destination: Staff Portal. <br />Location: Update Students Health. <br />User IP: '.$kas_framework->getUserIP().'<br />
								Staff Details: Username: '.$username.' &raquo; Fullname: '.$staff_firstname.' '.$staff_lastname.'<br />Severity: High. <br />Please Respond.');
									exit();
						}
				}
				
			if ($staff_discipline == '1') {
			print '<a href="../handleHealth/"><button class="btn bg-ash btn-flat margin">
						<i class="fa fa-chevron-left"></i> Back to Health Students List</button> </a>';
			}  else {
			print '<a href="../myStudents/?myStudents"><button class="btn bg-ash btn-flat margin">
						<i class="fa fa-chevron-left"></i> Back to My Students List</button> </a>';
			}
			
			print '<a class="btn bg-ult_green text-white click_ult margin" href="../handleAttendance/updateStudent?click='.$_GET['click'].'&stdid='.$_GET['stdid'].'&ref='.$_GET['ref'].'"> <i class="fa fa-ellipsis-h"></i> Manage Attendance</a>';
			print '<a class="btn bg-maroon text-white click_ult margin" href="../handleDiscipline/updateStudent?click='.$_GET['click'].'&stdid='.$_GET['stdid'].'&ref='.$_GET['ref'].'"> <i class="fa fa-smile-o"></i> Manage Discipline</a>';
			?>
			
				<div class="row">
					<!-- left column -->
					<div class="col-md-7">
					<!-- Input addon -->
						
					<?php if (isset($_GET['main'])) { ?>
					<!--- the main add health history form goes here --->
							
					<!-- Input addon -->
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title"> <i class="fa fa-medkit text-red"></i> Add Health History</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form role="form" action="#studentDisciplineTable" method="post" id="health_history_form">
							<div class="box-body">
								<div class="form-group">
									<label for="health_code"><font color="red">*</font> What is Wrong with Student? </label>
										<select required="required" name="health_code" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('health_codes', 'health_codes_desc', 'health_codes_id') ?>
									</select>
								</div>
								<div class="form-group">
									<label for="health_med1"><font color="red">*</font> Which Medicine was Used? </label>
										<select required="required" name="health_med1" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('health_medicine', 'health_medicine_desc', 'health_medicine_id') ?>
									</select>
								</div>
								<div class="form-group">
									<label for="health_med2">Any Aditional Medicine Used? </label>
										<select required="required" name="health_med2" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('health_medicine', 'health_medicine_desc', 'health_medicine_id') ?>
									</select>
								</div>
								<div class="form-group"> 
									<label><font color="red">*</font> Short Note</label> 
									<textarea required="required" class="form-control" rows="2" name="health_note" placeholder="Give a Short Note on this"></textarea> 
                                 </div> 
								<?php include ('hidden_form_values.php') ?>
							</div>

							<div class="box-footer">
								<button type="submit" id="addhealth" class="btn btn-primary">Add Health History</button>
							</div>
							<center><span id="message_for_addHealthHistory"></span></center>
						</form>
					</div><!-- /.box -->	
						
						
					<?php  } else { ?>
					<!---   the other health forms goes here ---->
							<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title"> <i class="fa fa-ambulance text-red"></i> Add a Health Allergy</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form role="form" action="#studentDisciplineTable" method="post" id="allergy_form">
							<div class="box-body">
							<div class="form-group">
										<label for="allergy_code"><font color="red">*</font> Student is Allergic to: </label>
										<select required="required" name="allergy_code" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('health_allergy', 'health_allergy_desc', 'health_allergy_id') ?>
										</select>
								</div>
								<div class="form-group"> 
									<label><font color="red">*</font> Short Note</label> 
									<textarea required="required" class="form-control" rows="2" name="allergy_note" placeholder="Give a Short Note on this"></textarea> 
                                 </div> 
								<?php include ('hidden_form_values.php') ?>
							</div><!-- /.box-body  getallFieldinDropdownOption($table, $field) -->

							<div class="box-footer">
								<button type="submit" class="btn btn-primary">Add Alergy</button>
							</div>
							<center><span id="message_for_addAllergy"></span></center>
						</form>
					</div><!-- /.box -->
					
					
					<!-- Input addon -->
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title"> <i class="fa fa-user-md text-red"></i> Add an Immunization History</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form role="form" action="#studentDisciplineTable" method="post" id="immunz_form">
							<div class="box-body">
							<div class="form-group">
										<label for="immunz_code"><font color="red">*</font> Student was Immunized Of: </label>
										<select required="required" name="immunz_code" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('health_immunz', 'health_immunz_desc', 'health_immunz_id') ?>
										</select>
								</div>
								<div class="form-group"> 
									<label><font color="red">*</font> Short Note</label> 
									<textarea required="required" class="form-control" rows="2" name="immunz_note" placeholder="Give a Short Note on this"></textarea> 
                                 </div> 
								<?php include ('hidden_form_values.php') ?>
							</div>

							<div class="box-footer">
								<button type="submit" class="btn btn-primary">Add Immunize</button>
							</div>
							<center><span id="message_for_addImmunz"></span></center>
						</form>
					</div><!-- /.box -->
					<?php  } ?>

					</div><!--/.col (left) -->
					<!-- right column -->
					<?php $__dontcareStudentID = $decodeStdID;
					include (constant('double_return').'inc.files/studentDetailsPane.php') ?>
					<div class="col-md-5" style="float:right; margin:0 0 5px 0">	
					<center>
					<?php
						if (isset($_GET['main'])) {
							print '<a class="btn btn-primary click_ult" href="?click='.$_GET['click'].'&stdid='.$_GET['stdid'].'&ref='.$_GET['ref'].'"> <i class="fa fa-hospital-o"></i> Manage Allergy and Immunize</a>';
						} else {
							print '<a class="btn btn-primary text-white click_ult" href="?click='.$_GET['click'].'&stdid='.$_GET['stdid'].'&ref='.$_GET['ref'].'&main"><i class="fa fa-hospital-o"></i> Manage this Student\'s Health</a>';
						}
					?>
					</center>
					</div>
				</div>   <!-- /.row -->
			<?php 
				$decode_std_id = $kas_framework->unsaltifyID($_GET['stdid']);
				require (constant('tripple_return').'php.files/classes/health_retriever.php');
			include (constant('tripple_return').'inc.files/student_health_catalogue.php') ?>
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
	<!-- InputMask -->
	<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
	<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
	<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script type="text/javascript">

	/*update allergy information info*/
	$('#allergy_form').submit(function(e) {
	$('.btn-primary').attr('disabled', 'disabled');
        $('#message_for_addAllergy').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#allergy_form :input').serializeArray();
		$.post('process_health?request=add_allergy', mydata , function(data) {
			$('#message_for_addAllergy').html(data);	
		});
		return false;
    });
	
	/*update immunz information info*/
	$('#immunz_form').submit(function(e) {
	$('.btn-primary').attr('disabled', 'disabled');
        $('#message_for_addImmunz').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#immunz_form :input').serializeArray();
		$.post('process_health?request=add_immunz', mydata , function(data) {
			$('#message_for_addImmunz').html(data);	
		});
		return false;
    });
	
	/*update health history information info*/
	$('#health_history_form').submit(function(e) {
	$('.btn-primary').attr('disabled', 'disabled');
        $('#message_for_addHealthHistory').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#health_history_form :input').serializeArray();
		$.post('process_health?request=add_health_history', mydata , function(data) {
			$('#message_for_addHealthHistory').html(data);	
		});
		return false;
    });
	
	 $(function() {  $("#example1").dataTable(); });
	
		$(function() {
		//Datemask dd/mm/yyyy
		$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
		//Datemask2 mm/dd/yyyy
		$("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
		//Money Euro
		$("[data-mask]").inputmask();
	});
	</script>	
</body>
</html>