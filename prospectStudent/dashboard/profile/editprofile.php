<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthPros_Std();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/prospectStudent_details.php');
require (constant('tripple_return').'php.files/classes/prospectStudent.php'); 
			
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Edit Profile</title>
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
	<!-- iCheck for checkboxes and radio inputs -->
	<link href="<?php print constant('tripple_return') ?>css/iCheck/all.css" rel="stylesheet" type="text/css" />
	<!-- Bootstrap time Picker -->
	<link href="<?php print constant('tripple_return') ?>css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
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
				<h1><i class="fa fa-edit"></i> Edit My Profile </h1>
				<ol class="breadcrumb">
					 <li class="click_ult"><a href="../"><i class="fa fa-dashboard"></i>Dashboard</a></li>
					<li class="click_ult"><a href="../profile/"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Profile</a></li>
					<li class="active"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Profile</li>
				</ol>
			</section>
			
			<!-- Main content -->
			<section class="content">
			<?php  
			if (!isset($_SESSION['tapp_prostd_username'])) {
				exit($kas_framework->showdangerwithRed('Only Students Can Edit their Profile. If you are a parent, Tell your Child to do this.
				<a href="../">Return To Dashboard</a>'));
				//$student->checkBasicPlan(); 
				} ?>
				<div class="row">		
					<?php if (isset($_GET['complete'])) {
						print $kas_framework->showDangerCallout("Please Complete Every Detail of Your Profile. Photo Card Can not be Printed without Completing your Profile.");
					}	?>
					<!-- left column -->
					<div class="col-md-6">
					<!-- Input addon -->
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">My Personal Information</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form role="form" action="" method="post" id="personalForm">
							<div class="box-body">
								<div class="form-group">
									<label for="title">Title</label>
									<select name="title" class="form-control">
									
									<option></option>
									<?php $kas_framework->getallFieldinDropdownOption('tbl_titles', 'title_desc', 'title_id', $usertitle) ?>
									</select>
								</div>
								<div class="form-group">
									<label for="lastname">Firstname</label>
									<input type="text" class="form-control" name="fname" placeholder="Your Lastname" value="<?php print $userfirstname; ?>">
								</div>
								<div class="form-group">
									<label for="lastname">Lastname (lastname)</label>
									<input type="text" class="form-control" disabled="disabled" name="lastname" placeholder="Your Lastname" value="<?php print $userlastname; ?>">
								</div>
								<div class="form-group">
									<label for="mi">Middle Name</label>
									<input type="text" class="form-control" name="mname" placeholder="Your Middle Initial" value="<?php print $usermname; ?>">
								</div>
								<div class="form-group">
									<label for="sex">Sex</label>
									<input type="text" class="form-control" name="sex" maxlength="1" value="<?php print $usergender; ?>" disabled >
								</div>
								<div class="form-group">
										<label for="ethnicity">Ethnicity</label>
										<select name="ethnicity" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('ethnicity', 'ethnicity_desc', 'ethnicity_id', $userethnicity) ?>
										</select>
								</div>
								<div class="form-group">
                                        <label>Date of Birth:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" placeholder="dd/mm/yyyy" name="dob" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="<?php print $userdob; ?>" />
                                        </div><!-- /.input group -->
                                 </div><!-- /.form group -->
								<!-- phone mask -->
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" class="form-control" name="usermobile" data-inputmask='"mask": "99999999999"' data-mask  value="<?php print $user_bio_mobile ?>" />
											<input type="hidden" name="byepass" value="gHJ5n6TN7tvgG5F6bg6gb6G6" />
										</div><!-- /.input group -->
                                    </div><!-- /.form group -->
								<div class="form-group">
										<label for="student_bio_address">Home Address</label>
										<input type="text" class="form-control" name="student_bio_address" placeholder="Your House Address" value="<?php print $user_bio_address; ?>">
								</div>
								<div class="form-group">
										<label for="std_bio_resident_town">Residence Town</label>
										<input type="text" class="form-control" name="std_bio_resident_town" placeholder="Your Home Town" value="<?php print $user_bio_resident_town; ?>">
								</div>
								<div class="form-group">
										<label for="user_resident_state">Residence State</label>
										<select name="user_resident_state" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('tbl_states', 'state_name', 'state_css', $user_bio_resident_state) ?>
										</select>
								</div>
							</div><!-- /.box-body  getallFieldinDropdownOption($table, $field) -->

							<div class="box-footer">
								<button type="submit" id="updatePersonalInfo" class="btn btn-primary">Update My Record</button>
							</div>
							<center><span id="message_for_updatePersonalInfo"></span></center>
						</form>
					</div><!-- /.box -->

						<!-- Form Element sizes -->

					</div><!--/.col (left) -->
					<!-- right column -->
					<div class="col-md-6">
						<!-- general form elements -->
					 <div class="box box-danger">
					<form role="form" id="picture_formID" action="upload_picture" method="post" enctype="multipart/form-data">
								<div class="box-header">
									<h3 class="box-title">Picture  <small><font color="red">(Max: 1MB) </font> &nbsp;...Irreversible</small></h3>
								</div>
								<div class="row">
									<div class="col-md-8">	
										<div class="btn btn-success btn-file" style="margin:0 0 10px 10px">
											<i class="fa fa-camera"></i> Picture
											<input type="file" name="imagename" class="ult_attach_file" />  
											<input type="hidden" name="byepass" value="gJUthjGYUTR6cyB0" />   
										</div> <span class="ult_attach_span"> </span>
									</div>
									<style type="text/css">
									@media only screen and (min-width:1009px) {
										#picture_message_preview { margin-top: -40px}
									} 
									@media only screen and (max-width:1008px) {
										#picture_message_preview { margin-left: 20px}
									} 
									
									</style>
									<div class="col-md-4" id="picture_message_preview">	
									 <?php $dynamicimage = $kas_framework->imageDynamic($userpicturepath, $usergender, $kas_framework->server_root_dir('pictures/'));
										print '<img href="'.$dynamicimage.'" src="'.$dynamicimage.'" class="fancybox fancybox.image" alt="User Image" style="border:1px solid #000; height:100px; cursor:pointer" />'; ?>
									</div>
								</div>
								<div class="box-footer">
									<button type="submit" class="btn btn-primary" id="picture_upload_button" name="changePicture">Upload</button>
								</div>
							</form>
							<span id="picture_message_div"></span>
						</div><!-- /.box -->	
						
						<div class="box box-success">
							<div class="box-header">
								<h3 class="box-title">My Alternative Contact Information</h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="" method="post" id="parguardForm">
								<div class="box-body">
									<div class="form-group">
										<label for="parguard_title">Title</label>
										<select name="parguard_title" class="form-control">
										
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('tbl_titles', 'title_desc', 'title_id', $userparguardtitle) ?>
										</select>
									</div>
									<div class="form-group">
										<label for="parguard_fname">First Name</label>
										<input type="text" class="form-control" name="parguard_fname" placeholder="Parents/Guardian Firstname" value="<?php print $userparguardfirstname; ?>">
									</div>
									<div class="form-group">
										<label for="parguard_lname">Last Name</label>
										<input type="text" class="form-control" name="parguard_lname" placeholder="Parents/Guardian Lastname" value="<?php print $userparguardlastname; ?>">
									</div>
									<div class="form-group">
										<label for="parguard_relationship">Relationship</label>
										<select name="parguard_relationship" class="form-control">
										
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('relations_codes', 'relation_codes_desc', 'relation_codes_id', $userparguardrel, $userparguardrel); ?>
										</select>
									</div>
									<!-- phone mask -->
                                    <div class="form-group">
                                        <label>Phone 1</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" class="form-control" name="phone1" data-inputmask='"mask": "99999999999"' data-mask value="<?php print $userparguardphone1 ?>" />
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
									<div class="form-group">
										<label for="parguard_email">Email</label>
										<input type="text" class="form-control" name="parguard_email" placeholder="Parents/Guardian Email" value="<?php print $userparguardemail; ?>">
										<input type="hidden" name="byepass" value="gHJ5n6TN7tvgG5F6bg6gb6G6" />
									</div>
								</div><!-- /.box-body -->

								<div class="box-footer">
									<button type="submit" class="btn btn-primary" id="updateParGuard">Update Alternative Contact Info</button>
								</div>
								<center><span id="message_for_updateparguard"></span></center>
							</form>
						</div><!-- /.box -->
											
						<div class="box box-primary">
							<div class="box-header">
								<h3 class="box-title"><a href="#toggle_password" id="toggleFormPassword">Change Password </a><small> &nbsp;...user login password</small></h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="" method="post" id="passwordForm" style="display:none">
								<div class="box-body">
									<div class="form-group">
										<label for="old_password">Old Password</label>
										<input type="password" class="form-control" name="password0" placeholder="Old Password">
									</div>
									<div class="form-group">
										<label for="new_password1">New Password</label>
										<input type="password" class="form-control" name="password1" placeholder="New Password">
									</div>
									<div class="form-group">
										<label for="new_password2">New Password Again</label>
										<input type="password" class="form-control" name="password2" placeholder="Confirm Password">
										<input type="hidden" name="byepass" value="gHJ5n6TN7tvgG5F6bg6gb6G6" />
									</div>
								</div><!-- /.box-body -->

								<div class="box-footer">
									<button type="submit" class="btn btn-primary" id="updatePassword">Change Password</button>
								</div>
								<center><span id="message_for_updatepassword"></span></center>
							</form>
						</div><!-- /.box -->
					</div><!--/.col (right) -->
				</div>   <!-- /.row -->
			</section><!-- /.content -->
		</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->
	 <!-- jQuery 2.0.2 -->
	<script src="<?php print constant('tripple_return') ?>myjs/jquery.min.js"></script>
	<script src="<?php print constant('tripple_return') ?>myjs/keliv_profile_picture_upload.js" type="text/javascript"></script>
	 <!---- my javascript controller -->
	<script src="<?php print constant('tripple_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
	<!-- Bootstrap -->
	<script src="<?php print constant('tripple_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
	<!-- AdminLTE App -->
	<script src="<?php print constant('tripple_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>
	<!-- InputMask -->
	<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
	<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
	<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>	
	<!-- FancyBox -->
	<script src="<?php print constant('tripple_return') ?>fancybox/jquery.fancybox.js" type="text/javascript"></script>
	<script src="<?php print constant('tripple_return') ?>fancybox/media_helper.js" type="text/javascript"></script>
	<script type="text/javascript">
		
	/* toogle password form */
	$('#toggleFormPassword').hover(function(e){
		$('#passwordForm').slideDown(1000);
		return false;
	});
	
	/*update personal info*/
	$('#updatePersonalInfo').click(function(e) {
        $('#message_for_updatePersonalInfo').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#personalForm :input').serializeArray();
		$.post('update_profile?type=std_update_profile', mydata, function(data) {
			$('#message_for_updatePersonalInfo').html(data);	
		});
		
		return false;
    });
	
	/*update password*/
	$('#updatePassword').click(function(e) {
        $('#message_for_updatepassword').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#passwordForm :input').serializeArray();		
		$.post('update_profile?type=std_update_password', mydata, function(data) {
			$('#message_for_updatepassword').html(data);	
		});
		
		return false;
    });
	
	/*update previous school info*/
	$('#updatePrevSch').click(function(e) {
        $('#message_for_updatePrevSch').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#prevschForm :input').serializeArray();
		$.post('update_profile?type=std_update_prevsch', mydata, function(data) {
			$('#message_for_updatePrevSch').html(data);	
		});
		
		return false;
    });
	
	/*update parents guardian information info*/
	$('#updateParGuard').click(function(e) {
        $('#message_for_updateparguard').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#parguardForm :input').serializeArray();
		$.post('update_profile?type=std_update_parguard',mydata , function(data) {
			$('#message_for_updateparguard').html(data);	
		});
		
		return false;
    });
	
		$(function() {
			//Datemask dd/mm/yyyy
			$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
			//Datemask2 mm/dd/yyyy
			$("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
			//Money Euro
			$("[data-mask]").inputmask();

			//Date range picker
			$('#reservation').daterangepicker();
			//Date range picker with time picker
			$('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
			//Date range as a button
			$('#daterange-btn').daterangepicker(
					{
						ranges: {
							'Today': [moment(), moment()],
							'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
							'Last 7 Days': [moment().subtract('days', 6), moment()],
							'Last 30 Days': [moment().subtract('days', 29), moment()],
							'This Month': [moment().startOf('month'), moment().endOf('month')],
							'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
						},
						startDate: moment().subtract('days', 29),
						endDate: moment()
					},
			function(start, end) {
				$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			}
			);
			
			//Colorpicker
			$(".my-colorpicker1").colorpicker();
			//color picker with addon
			$(".my-colorpicker2").colorpicker();

			//Timepicker
			$(".timepicker").timepicker({
				showInputs: false
			});
		});
	</script>	
	<?php include (constant('tripple_return').'/inc.files/fixedfooter.php') ?>
</body>
</html>