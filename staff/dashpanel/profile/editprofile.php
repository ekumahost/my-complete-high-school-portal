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
	<!-- Bootstrap time Picker -->
	<link href="<?php print constant('tripple_return') ?>css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
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
				   <i class="fa fa-cogs"></i> My Profile
					<small>Preview</small>
				</h1>
				<ol class="breadcrumb">
					<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
					<li class="click_ult"><a href="../profile/"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Profile</a></li>
					<li class="active"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Profile</li>
				</ol>
			</section>
			
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- left column -->
					<div class="col-md-6">
						<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">My Personal Information</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form role="form" action="" method="post" id="personalForm">
							<div class="box-body">
							<div class="form-group">
										<label for="staff_title">Title</label>
										<select name="staff_title" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('tbl_titles', 'title_desc', 'title_id', $staff_title) ?>
										</select>
								</div>
								<div class="form-group">
									<label for="parents_lastname">Lastname (Surname)</label>
									<input type="text" class="form-control" name="staff_lastname" disabled="disabled" value="<?php print $staff_lastname; ?>">
								</div>
								<div class="form-group">
									<label for="staff_firstname">Firstname</label>
									<input type="text" class="form-control" name="staff_firstname" placeholder="Your Firstname" value="<?php print $staff_firstname; ?>">
								</div>
								<div class="form-group">
									<label for="staff_mi">Middle Initial</label>
									<input type="text" class="form-control" name="staff_mi" placeholder="Your Middlename" value="<?php print $staff_mi; ?>">
								</div>
								<div class="form-group">
									<label for="parents_sex">Sex</label>
									<input type="text" class="form-control" name="parents_sex" maxlength="6" value="<?php print $staff_sex; ?>" disabled="disabled" />
									</div>
								<div class="form-group">
                                        <label>Date of Birth:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" placeholder="dd/mm/yyyy" name="dob" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="<?php print $staff_dob; ?>" />
                                        </div><!-- /.input group -->
                                 </div><!-- /.form group -->
								 <div class="form-group">
									<label for="staff_state">State of Birth</label>
									<select name="staff_state" class="form-control">
									<option></option>
									<?php $kas_framework->getallFieldinDropdownOption('tbl_states', 'state_name', 'state_css', $staff_state) ?>
									</select>
								</div>
								<div class="form-group">
									<label for="staff_birth_city">City Of Birth</label>
									<input type="text" class="form-control" name="staff_birth_city" value="<?php print $staff_birth_city; ?>"  />
								</div>
								<div class="form-group">
									<label for="ethnicity">Ethnicity</label>
									<select name="ethnicity" class="form-control">
									<option></option>
									<?php $kas_framework->getallFieldinDropdownOption('ethnicity', 'ethnicity_desc', 'ethnicity_id', $staff_ethnicity) ?>
									</select>
									<input type="hidden" name="byepass" value="gHJ5n6TN7tvgG5F6bg6gb6G6" />
								</div>
							</div><!-- /.box-body  getallFieldinDropdownOption($table, $field) -->

							<div class="box-footer">
								<button type="submit" id="updatePersonalInfo" class="btn btn-primary">Update My Record</button>
							</div>
							<center><span id="message_for_updatePersonalInfo"></span></center>
						</form>
					</div><!-- /.box -->	
						
						<div class="box box-primary">
							<div class="box-header">
								<h3 class="box-title">Next of Kin Information </h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="" method="post" id="update_kinForm">
								<div class="box-body">
									<div class="form-group">
										<label for="staff_kin_name"> Next of kin Name</label>
										<input type="text" class="form-control" name="staff_kin_name" placeholder="Name of Next of Kin" value="<?php print $staff_kin_name; ?>">
									</div>
									<div class="form-group">
										<label for="staff_kin_phone"> Next of kin Phone</label>
										<input type="text" class="form-control" name="staff_kin_phone" placeholder="Phone of Next of Kin" maxlength="11" value="<?php print $staff_kin_phone; ?>">
									</div>
									<div class="form-group">
										<label for="staff_kin_email"> Next of kin Email</label>
										<input type="email" class="form-control" name="staff_kin_email" placeholder="Email of Next of Kin" value="<?php print $staff_kin_email; ?>">
									</div>
									<div class="form-group">
										<label for="staff_kin_adress"> Next of kin Address</label>
										<input type="text" class="form-control" name="staff_kin_adress" placeholder="Email of Next of Kin" value="<?php print $staff_kin_adress; ?>">
									</div>
									<div class="form-group">
										<label for="staff_kin_relationship"> Next of kin Relationship</label>
											<select name="staff_kin_relationship" class="form-control">
											<option></option>
											<?php $kas_framework->getallFieldinDropdownOption('relations_codes', 'relation_codes_desc', 'relation_codes_id', $staff_kin_relationship, $staff_kin_relationship); ?>
										</select>
										<input type="hidden" name="byepass" value="gHJ5n6TN7tvgG5F6bg6gb6G6" />
									</div>
								</div><!-- /.box-body -->
							<div class="box-footer">
									<button type="submit" class="btn btn-primary" id="updateKin">Update Kin Details</button>
								</div>
								<center><span id="message_for_updatekin"></span></center>
							</form>
						</div><!-- /.box -->
						
						<div class="box box-primary" id="toggleFormPassword">
							<div class="box-header">
								<h3 class="box-title">Change Password <small> &nbsp;...user login password</small></h3>
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

						<!-- Form Element sizes -->

					</div><!--/.col (left) -->
					<!-- right column -->
					<div class="col-md-6">	
						<?php if (isset($_GET['uploadpicx'])) {
								print $kas_framework->showDangerCallout("Please Upload Your Picture. Very Important...");
							}	?>
								<!-- general form elements -->
							 <div class="box box-danger">
							<form role="form" id="picture_formID" action="upload_picture" method="post" enctype="multipart/form-data">
									<div class="box-header">
										<h3 class="box-title">Picture  <small><font color="red">(Max: 3MB) </font> </small></h3>
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
										<?php $dynamicimage = $kas_framework->imageDynamic($staff_image, $staff_sex, $kas_framework->url_root('pictures/'));
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
								<h3 class="box-title">Contact Information</h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="" method="post" id="update_contactForm">
								<div class="box-body">
									<div class="form-group">
										<label for="staff_email">Email</label>
										<input type="text" class="form-control" name="staff_email" placeholder="Email Address" value="<?php print $staff_email; ?>" disabled>
									</div>
									<div class="form-group">
										<label for="staff_contactaddress">Contact Address</label>
										<input type="text" class="form-control" name="staff_contactaddress" placeholder="Contact Address" value="<?php print $staff_address; ?>">
									</div>
									<div class="form-group">
										<label for="staff_mobile">Mobile</label>
										<input type="text" class="form-control" name="staff_mobile" placeholder="Mobile" value="<?php print $staff_mobile; ?>">
									</div>
									<div class="form-group">
										<label for="staff_res_state">Resident State</label>
										<select name="staff_res_state" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('tbl_states', 'state_name', 'state_css', $staff_res_state) ?>
										</select>
									</div>
									<div class="form-group">
										<label for="staff_res_town">Resident Town</label>
										<input type="text" class="form-control" name="staff_res_town" placeholder="Resident Town" value="<?php print $staff_res_town; ?>">
									</div>
									<div class="form-group">
										<label for="staff_country">Country</label>
										<select name="staff_country" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('country', 'name', 'id', ($staff_country == '')? 'NG': $staff_country) ?>
										</select>
										<input type="hidden" name="byepass" value="gHJ5n6TN7tvgG5F6bg6gb6G6" />
									</div>
								</div><!-- /.box-body -->

								<div class="box-footer">
									<button type="submit" class="btn btn-primary" id="updateContact">Update Contact Info</button>
								</div>
								<center><span id="message_for_updatecontact"></span></center>
							</form>
						</div><!-- /.box -->
						
						<div class="box box-primary">
							<div class="box-header">
								<h3 class="box-title">Bank Details </h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="" method="post" id="update_bankForm">
								<div class="box-body">
									<div class="form-group">
										<label for="staff_bank">Bank</label>
										<select name="staff_bank" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('bank', 'name', 'id', $staff_bank) ?>
										</select>
									</div>
									<div class="form-group">
										<label for="staff_acc_type">Account Type</label>
											<select name="staff_acc_type" class="form-control">
											<option><?php print $staff_account_type ?></option>
											<option>Savings</option><option>Current</option><option>Domicilary</option><option>Fixed</option>
										</select>
									</div>
									<div class="form-group">
										<label for="staff_acc_name">Account Name</label>
										<input type="text" class="form-control" name="staff_acc_name" placeholder="Your Account Name" value="<?php print $staff_acc_name; ?>">
									</div>
									<div class="form-group">
										<label for="staff_acc_no">Account Number (10 digit)</label>
										<input type="text" class="form-control" maxlength="10" name="staff_acc_no" placeholder="Your Account Number" value="<?php print $staff_account; ?>">
									</div>
									<div class="form-group">
										<label for="staff_bank_sort">Sort Code</label>
										<input type="text" class="form-control" name="staff_bank_sort" placeholder="Enter Your Bank Sort Number" value="<?php print $staff_bank_sort; ?>">
										<input type="hidden" name="byepass" value="gHJ5n6TN7tvgG5F6bg6gb6G6" />
									</div>
								</div><!-- /.box-body -->

								<div class="box-footer">
									<button type="submit" class="btn btn-primary" id="updatebank">Update Bank Details</button>
								</div>
								<center><span id="message_for_updatebank"></span></center>
							</form>
						</div><!-- /.box -->
						
						<div class="box box-primary">
							<div class="box-header">
								<h3 class="box-title">Biography</h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="" method="post" id="update_biographyForm">
								<div class="box-body">
									<div class="form-group">
										<textarea name="staff_biography_text" placeholder="About Me..." class="form-control"><?php print $staff_biography ?></textarea>	
										<input type="hidden" name="byepass" value="hnkBGYTY543WC2345r6779umn" />
									</div>
								</div><!-- /.box-body -->

								<div class="box-footer">
									<button type="submit" class="btn btn-primary" id="updatebiography">Update Biography</button>
								</div>
								<center><span id="message_for_updatebiography"></span></center>
							</form>
						</div><!-- /.box -->
						
					</div><!--/.col (right) -->
				</div>   <!-- /.row -->
			</section><!-- /.content -->
		</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->
	 <!-- jQuery 2.0.2 -->
	<script src="<?php print constant('tripple_return') ?>myjs/jquery.min.js"></script>
	 <!---- my javascript controller -->
	<script src="<?php print constant('tripple_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
	<script src="<?php print constant('tripple_return') ?>myjs/keliv_profile_picture_upload.js" type="text/javascript"></script>
	<!-- Bootstrap -->
	<script src="<?php print constant('tripple_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
	<!-- AdminLTE App -->
	<script src="<?php print constant('tripple_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>	
		<!-- FancyBox -->
	<script src="<?php print constant('tripple_return') ?>fancybox/jquery.fancybox.js" type="text/javascript"></script>
	<script src="<?php print constant('tripple_return') ?>fancybox/media_helper.js" type="text/javascript"></script>
	<!-- InputMask -->
	<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
	<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
	<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script type="text/javascript">

		/* toogle password form */
	$('#toggleFormPassword').hover(function(e){
		$('#passwordForm').slideDown(1000);
		return false;
	});
	
	/*update personal info*/
	$('#personalForm').submit(function(e) {
		$('#updatePersonalInfo').attr('disabled', 'disabled');
        $('#message_for_updatePersonalInfo').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#personalForm :input').serializeArray();
		$.post('update_profile?type=staff_update_personal', mydata, function(data) {
			$('#message_for_updatePersonalInfo').html(data);	
		});
		
		return false;
    });
	
	/*update contact information info*/
	$('#update_contactForm').submit(function(e) {
	$('#updateContact').attr('disabled', 'disabled');
        $('#message_for_updatecontact').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#update_contactForm :input').serializeArray();
		$.post('update_profile?type=update_contact',mydata , function(data) {
			$('#message_for_updatecontact').html(data);	
		});
		
		return false;
    });

	/*update bank information info*/
	$('#update_bankForm').submit(function(e) {
	$('#updatebank').attr('disabled', 'disabled');
        $('#message_for_updatebank').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#update_bankForm :input').serializeArray();
		$.post('update_profile?type=updatebank',mydata , function(data) {
			$('#message_for_updatebank').html(data);	
		});
		
		return false;
    });

	/*update kin information info*/
	$('#update_kinForm').submit(function(e) {
	$(this).attr('disabled', 'disabled');
        $('#message_for_updatekin').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#update_kinForm :input').serializeArray();
		$.post('update_profile?type=updatekin',mydata , function(data) {
			$('#message_for_updatekin').html(data);	
		});
		
		return false;
    });
	
	/*update password*/
	$('#passwordForm').submit(function(e) {
	$('#updateKin').attr('disabled', 'disabled');
        $('#message_for_updatepassword').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#passwordForm :input').serializeArray();		
		$.post('update_profile?type=staff_update_password', mydata, function(data) {
			$('#message_for_updatepassword').html(data);	
		});
		
		return false;
    });
	
	/*update biography*/
	$('#update_biographyForm').submit(function(e) {
	$('#updatebiography').attr('disabled', 'disabled');
        $('#message_for_updatebiography').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#update_biographyForm :input').serializeArray();		
		$.post('update_profile?type=staff_update_biography', mydata, function(data) {
			$('#message_for_updatebiography').html(data);	
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

			//Timepicker
			$(".timepicker").timepicker({
				showInputs: false
			});
		});
	</script>	
</body>
</html>