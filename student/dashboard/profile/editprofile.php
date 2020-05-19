<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('tripple_return').'php.files/classes/students.php');
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/student_details.php');
			
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Edit Profile</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
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
				<h1><i class="fa fa-edit"></i> Edit My Profile <?php $student->display_accessLevel(); ?></h1>
				<ol class="breadcrumb">
					 <li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
					<li class="click_ult"><a href="<?php print constant('single_return') ?>profile/"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Profile</a></li>
					<li class="active"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Profile</li>
				</ol>
			</section>
			
			<!-- Main content -->
			<section class="content">
			<?php  
			if (isset($_SESSION['tapp_par_username'])) {
				$kas_framework->showdangerwithRed('Only Students Can Edit their Profile. If you are a parent, Tell your Child to do this.
				<a href="'.constant('single_return').'">Return To Dashboard</a>');
				//$student->checkBasicPlan(); 
				}

				$student->checkBasicPlanStudent(); //$student->authConfirm($useradmitStatus); ?>
				<div class="row">
					<!-- left column -->
					<div class="col-md-6">
					<?php if (isset($_GET['uploadpicx'])) {
						print $kas_framework->showDangerCallout("Please Upload Your Picture. Very Important...");
					}	?>
						<!-- general form elements -->
					 <div class="box box-danger">
					<form role="form" id="picture_formID" action="upload_picture" method="post" enctype="multipart/form-data">
							<div class="box-header">
									<h3 class="box-title">Picture  <small><font color="red">(Max: 3MB) </font> &nbsp;...Irreversible</small></h3>
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
										<?php $dynamicimage = $student->imageDynamic($userpicturepath, $usergender, $kas_framework->url_root('pictures/'));
										print '<img src="'.$dynamicimage.'" href="'.$dynamicimage.'" class="fancybox fancybox.image" alt="User Image" style="border:1px solid #000; height:100px; cursor:pointer" />'; ?>
									</div>
								</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary" id="picture_upload_button" name="changePicture">Upload</button>
							</div>
							<span id="picture_message_div"></span>
					</form>
						</div><!-- /.box -->
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
									<label for="lastname">Lastname (Surname)</label>
									<input type="text" class="form-control" disabled="disabled" name="lastname" value="<?php print $userlastname; ?>">
								</div>
								<div class="form-group">
									<label for="surname">Firstname</label>
									<input type="text" class="form-control" name="fname" placeholder="Your Firstname" value="<?php print $userfirstname; ?>">
								</div>
								<div class="form-group">
									<label for="mi">Middle Name</label>
									<input type="text" class="form-control" name="mname" placeholder="Your Middle Initial" value="<?php print $usermname; ?>">
								</div>
								<div class="form-group">
										<label for="generation">Generation</label>
										<select name="generation" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('generations', 'generations_desc', 'generations_id', $usergeneration) ?>
										</select>
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
								<div class="form-group">
										<label for="birthcity">Birth City</label>
										<input type="text" class="form-control" name="birthcity" placeholder="Your Birth City" value="<?php print $userbirthcity; ?>">
								</div>
								<div class="form-group">
										<label for="birthstate">Birth State</label>
										<select name="birthstate" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('tbl_states', 'state_name', 'state_css', $userbirthstate) ?>
										</select>
								</div>
								
								<div class="form-group">
										<label for="birthcountry">Birth Country</label>
										<select name="birthcountry" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('country', 'name', 'id', ($userbirthcountry == '')? 'NG': $userbirthcountry) ?>
										</select>
								</div>
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
								<div class="form-group">
										<label for="user_bio_living_with_parent">Staying With Parents</label>
										<select name="user_bio_living_with_parent" class="form-control">
										<option value="0" <?php echo ($user_bio_living_with_parent == '0')? 'selected': ''; ?>>No</option>
										<option value="1"<?php echo ($user_bio_living_with_parent == '1')? 'selected': ''; ?>>Yes</option>
										</select>
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
								<h3 class="box-title"><a href="#toggle_login" id="toggleFormPassword">Change Password </a><small> &nbsp;...user login password</small></h3>
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
					<!-- general form elements-->
						<div class="box box-success">
							<div class="box-header">
								<h3 class="box-title">Previous School Informaion </h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="" method="post" id="prevschForm">
								<div class="box-body">
									<div class="form-group">
										<label for="prev_sch_name">Previous School Name</label>
										<input type="text" class="form-control" name="prev_sch_name" placeholder="Previous School Name" value="<?php print $userprevschoolname; ?>">
									</div>
									<div class="form-group">
										<label for="prev_sch_address">Previous School Address</label>
										<input type="text" class="form-control" name="prev_sch_address" placeholder="Previous School Address" value="<?php print $userpreviousSchooladdress; ?>">
									</div>
									<div class="form-group">
										<label for="prev_sch_city">Previous School City</label>
										<input type="text" class="form-control" name="prev_sch_city" placeholder="Previous School City" value="<?php print $userpreviousSchoolcity; ?>">
									</div>
									<div class="form-group">
										<label for="prev_sch_state">Previous School State</label>
										<select name="prev_sch_state" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('tbl_states', 'state_name', 'state_css', $userpreviousSchoolstate) ?>
										</select>
									</div>
									<div class="form-group">
										<label for="prev_sch_zip">Previous School Zip</label>
										<input type="text" class="form-control" name="prev_sch_zip" placeholder="Previous School Zip" value="<?php print $userpreviousSchoolzip; ?>">
									</div>
									
									<div class="form-group">
										<label for="prev_sch_country">Previous School Country</label>
										<select name="prev_sch_country" class="form-control">
										<option></option>
										<?php 
											$kas_framework->getallFieldinDropdownOption('country', 'name', 'id',($userpreviousSchoolcountry == '')? 'NG': $userpreviousSchoolcountry) ?>
										</select>
										<input type="hidden" name="byepass" value="gHJ5n6TN7tvgG5F6bg6gb6G6" />
									</div>
								</div><!-- /.box-body -->

								<div class="box-footer">
									<button type="submit" class="btn btn-primary" id="updatePrevSch">Update Previous School Details</button>
								</div>
								<center><span id="message_for_updatePrevSch"></span></center>
							</form>
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
									<div class="form-group">
										<label for="parguard_addr1">Address 1</label>
										<input type="text" class="form-control" name="parguard_addr1" placeholder="Parents/Guardian Address 1" value="<?php print $userparguardaddress1; ?>">
									</div>
									<div class="form-group">
										<label for="parguard_addr2">Address 2</label>
										<input type="text" class="form-control" name="parguard_addr2" placeholder="Parents/Guardian Address 2" value="<?php print $userparguardaddress2; ?>">
									</div>
									<div class="form-group">
										<label for="parguard_city">City</label>
										<input type="text" class="form-control" name="parguard_city" placeholder="Parents/Guardian City" value="<?php print $userparguardcity; ?>">
									</div>
									<div class="form-group">
										<label for="parguard_state">State</label>
										<select name="parguard_state" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('tbl_states', 'state_name', 'state_css', $userparguardstate) ?>
										</select>
										</div>
									<div class="form-group">
										<label for="parguard_zip">Zip</label>
										<input type="text" class="form-control" name="parguard_zip" placeholder="Parents/Guardian Zip" value="<?php print $userparguardzip; ?>">
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
									<!-- phone mask -->
                                    <div class="form-group">
                                        <label>Phone 2</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" class="form-control" name="phone2" data-inputmask='"mask": "99999999999"' data-mask  value="<?php print $userparguardphone2 ?>" />
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
									<div class="form-group">
										<label for="parguard_zip">Phone 3</label>
										<input type="text" class="form-control" name="phone3" placeholder="Parents/Guardian Other Lines " value="<?php print $userparguardphone3; ?>">
									</div>
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
		$(this).attr('disabled', 'disabled');
        $('#message_for_updatePersonalInfo').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#personalForm :input').serializeArray();
		$.post('update_profile?type=std_update_profile', mydata, function(data) {
			$('#message_for_updatePersonalInfo').html(data);	
		});
		
		return false;
    });
	
	/*update password*/
	$('#updatePassword').click(function(e) {
		$(this).attr('disabled', 'disabled');
        $('#message_for_updatepassword').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#passwordForm :input').serializeArray();		
		$.post('update_profile?type=std_update_password', mydata, function(data) {
			$('#message_for_updatepassword').html(data);	
		});
		
		return false;
    });
	
	/*update previous school info*/
	$('#updatePrevSch').click(function(e) {
		$(this).attr('disabled', 'disabled');
        $('#message_for_updatePrevSch').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#prevschForm :input').serializeArray();
		$.post('update_profile?type=std_update_prevsch', mydata, function(data) {
			$('#message_for_updatePrevSch').html(data);	
		});
		
		return false;
    });
	
	/*update parents guardian information info*/
	$('#updateParGuard').click(function(e) {
		$(this).attr('disabled', 'disabled');
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

			//Timepicker
			$(".timepicker").timepicker({
				showInputs: false
			});
		});
	</script>	
	<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>
</body>
</html>