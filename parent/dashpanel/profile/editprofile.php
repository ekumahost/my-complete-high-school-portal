<?php 
	require ('../../../php.files/classes/pdoDB.php');
	require ('../../../php.files/classes/kas-framework.php');
	$kas_framework->safesession();
	$kas_framework->checkAuthParent();
	require (constant('tripple_return').'php.files/classes/generalVariables.php');
	require (constant('tripple_return').'php.files/parents_details.php');
	require (constant('tripple_return').'php.files/classes/parents.php');
			
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Profile</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
	<!-- bootstrap 3.0.2 -->
	<link href="<?php print constant('tripple_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- font Awesome -->
	<link href="<?php print constant('tripple_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link href="<?php print constant('tripple_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="<?php print constant('tripple_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />`
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
	<?php require (constant('double_return').'inc.files/parentheader.php') ?>
	<p>&nbsp;</p>
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
	   <?php require (constant('double_return').'inc.files/parentsidebar.php') ?>
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
					<li class="click_ult"><a href="<?php print constant('single_return') ?>profile/"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Profile</a></li>
					<li class="active"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Profile</li>
				</ol>
			</section>
			
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- left column -->
					<div class="col-md-6">
			<?php if (isset($_GET['complete'])) {
						print $kas_framework->showDangerCallout('Please Complete your Profile Very Important...');
					}	?>
					<!-- Input addon -->
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">My Personal Information</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form role="form" action="" method="post" id="personalForm">
							<div class="box-body">
								<div class="form-group">
									<label for="parguard_title">Title</label>
									<select name="parent_title" class="form-control">
									<option></option>
									<?php $kas_framework->getallFieldinDropdownOption('tbl_titles', 'title_desc', 'title_id', $student_parents_title) ?>
									</select>
								</div>
								<div class="form-group">
									<label for="parents_lastname">Lastname (Surname)</label>
									<input type="text" class="form-control" disabled="disabled" name="parents_lastname" placeholder="Your Lastname" value="<?php print $student_parents_lastname; ?>">
								</div>
								<div class="form-group">
									<label for="parents_firstname">Firstname</label>
									<input type="text" class="form-control" name="parents_firstname" placeholder="Your Firstname" value="<?php print $student_parents_firstname; ?>">
								</div>
								<div class="form-group">
									<label for="parents_firstname">Middlename</label>
									<input type="text" class="form-control" name="parents_mi" placeholder="Your Middle Name" value="<?php print $student_parents_mi; ?>">
								</div>
								<div class="form-group">
									<label for="parents_sex">Sex</label>
									<input type="text" class="form-control" name="parents_sex" maxlength="6" value="<?php print $student_parents_sex; ?>" disabled >
									<input type="hidden" name="byepass" value="gHJ5n6TN7tvgG5F6bg6gb6G6" />
								</div>
								<div class="form-group">
									<label for="parents_occupation">Occupation</label>
									<input type="text" class="form-control" name="parents_occupation" placeholder="Your Occupation" value="<?php print $student_parents_occupation; ?>">
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
								<h3 class="box-title">Change Password <small> &nbsp;...user login password</small></h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="" method="post" id="passwordForm">
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
										<h3 class="box-title">Picture  <small><font color="red">(Max: 3MB) </font></small></h3>
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
											<?php $dynamicimage = $parent->imageDynamic($student_parents_image, $student_parents_sex, $kas_framework->server_root_dir('pictures/'));
											print '<img src="'.$dynamicimage.'" href="'.$dynamicimage.'" class="fancybox fancybox.image" alt="User Image" style="border:1px solid #000; cursor:pointer; height:100px;" />'; ?>
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
										<label for="parents_email">Email</label>
										<input type="text" class="form-control" name="parents_email" placeholder="Email Address" value="<?php print $student_parents_email; ?>" disabled>
									</div>
									<div class="form-group">
										<label for="parents_contactaddress1">Contact Address 1</label>
										<input type="text" class="form-control" name="parents_contactaddress1" placeholder="Address 1" value="<?php print $student_parents_contactaddress1; ?>">
									</div>
									<div class="form-group">
										<label for="parents_contactaddress2">Contact Address 2</label>
										<input type="text" class="form-control" name="parents_contactaddress2" placeholder="Address 2" value="<?php print $student_parents_contactaddress2; ?>">
									</div>
									<div class="form-group">
										<label for="parents_mobile1">Mobile 1</label>
										<input type="text" class="form-control" name="parents_mobile1" placeholder="Mobile 1" value="<?php print $student_parents_mobile1; ?>">
									</div>
									<div class="form-group">
										<label for="parents_mobile2">Mobile 2</label>
										<input type="text" class="form-control" name="parents_mobile2" placeholder="Mobile 2" value="<?php print $student_parents_mobile2; ?>">
									</div>
									<div class="form-group">
										<label for="parents_city">City</label>
										<input type="text" class="form-control" name="parents_city" placeholder="City" value="<?php print $student_parents_city; ?>">
									</div>
									<div class="form-group">
										<label for="parents_state">State</label>
										<select name="parents_state" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('tbl_states', 'state_name', 'state_code', $student_parents_state) ?>
										</select>
										</div>
										
									<div class="form-group">
										<label for="parents_country">Country</label>
										<select name="parents_country" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('country', 'name', 'id', ($student_parents_country == '')? 'NG': $student_parents_country) ?>
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
     <script type="text/javascript">	
	/*update personal info*/
	$('#updatePersonalInfo').click(function(e) {
		$(this).attr('disabled', 'disabled');
        $('#message_for_updatePersonalInfo').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#personalForm :input').serializeArray();
		$.post('update_profile?type=parent_update_personal', mydata, function(data) {
			$('#message_for_updatePersonalInfo').html(data);	
		});
		
		return false;
    });
	/*update parents guardian information info*/
	$('#updateContact').click(function(e) {
		$(this).attr('disabled', 'disabled');
        $('#message_for_updatecontact').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#update_contactForm :input').serializeArray();
		$.post('update_profile?type=update_contact',mydata , function(data) {
			$('#message_for_updatecontact').html(data);	
		});
		
		return false;
    });
	
	/*update password*/
	$('#updatePassword').click(function(e) {
		$(this).attr('disabled', 'disabled');
        $('#message_for_updatepassword').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#passwordForm :input').serializeArray();		
		$.post('update_profile?type=parent_update_password', mydata, function(data) {
			$('#message_for_updatepassword').html(data);	
		});
		
		return false;
    });
	
	</script>	
</body>
</html>