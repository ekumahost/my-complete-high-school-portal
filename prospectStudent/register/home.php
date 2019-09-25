<?php
require ('../../php.files/classes/pdoDB.php'); 
require ('../../php.files/classes/kas-framework.php'); 

require (constant('double_return').'php.files/classes/generalVariables.php'); 
	?>
<!DOCTYPE html>
<html class="bg-black">
<style type="text/css">
	.bg-black {  background: url(../../img/user_bg.jpg) repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover; }
	* { color: #000; }
</style>
<head>
	<meta charset="UTF-8">
	<title>Admission Registration</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<!---- page description -->
	<meta content="New Student Registration. Check Up and print your examination photo card. Complete your profile Powered by Hypertera" name="description">
	<meta content="School Portal, Login, Best School Portal" name="keywords">
	<meta content="HyperTera" name="author">
	<!---- page description ends --->
	<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
	<!-- bootstrap 3.0.2 -->
	<link href="<?php print constant('double_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- font Awesome -->
	<link href="<?php print constant('double_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="<?php print constant('double_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
	<!---password meter style -->
	<link href="<?php print constant('double_return') ?>css/pwd_style.css" rel="stylesheet" type="text/css" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body class="bg-black">
	<noscript><?php print '<center><div class="cant_register_div" style="margin: 10px auro; width:80%">';
	$kas_framework->showDangerCallout('If you are Seeing this, please enable <b>Javascript</b>. <a href="'.$kas_framework->help_url('?topic=jquery-not-detected').'" target="_blank">Explanation?</a>');
	print '</div></center>'; ?></noscript>
		<!-- Main content -->
	<form role="form" id="registration_form">
		<section class="content" style="max-width:800px; margin:50px auto 0 auto;">
		
				
		  <div style="text-align:center; font-size:24px">Admission Registration (<?php print $kas_framework->getValue('badge_name', 'tbl_admission', 'active', '1'); ?>)</div>
		  <!---- message for the login --->
		  
			<div id="signupMessage" align="center"></div>
			<?php if (isset($_POST['signup'])) {
				$kas_framework->showinfowithBlue('This Portal Cannot run on this Browser. <a href="'.$kas_framework->help_url('?topic=jquery-not-detected').'">Explanation?</a>');
			}	
			
			$admission_open = "SELECT * FROM tbl_admission WHERE active = '1' LIMIT 1";
			$db_admission_open = $dbh->prepare($admission_open);
			$db_admission_open->execute();
			$get_admission_open_rows = $db_admission_open->rowCount();
			$db_admission_open = null;
			
				if ($get_admission_open_rows == 0) {
					$kas_framework->showDangerCallout('<center>Sorry!. There is no Current Badge of Admission Running. Please Check Only when you see an Admission Open.  But Teranig have a question for you... How did you get here? Your IP has been Logged. </center>
					<br /><br /><center><a href="'.$kas_framework->server_root_dir('').'" class="btn bg-custom text-white btn-block" style="width:50%">
						<i class="fa fa-home text-white"></i> Go Back Home </a></center>');
						
				require (constant('double_return').'php.files/classes/PHPMailer/PHPMailerAutoload.php');
					require (constant('double_return').'php.files/classes/mailing_list.php');
						$mailing_list->mailHackingReport($kas_framework->returnUserSchool(''), 'A hacking attempt was just made on the portal of the schools name which appear above.
						<br />Destination: Prospective Student Portal. <br />Location: Registration. <br />User IP: '.$kas_framework->getUserIP().'<br />Please Respond.');
				} else {
			?>
			
			<div class="row">
			<!-- left column -->
				<div class="col-md-6">
					<!-- general form elements -->
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Starting Information</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<div class="box-body">
								<div class="form-group">
									<label><font color="red">*</font> Lastname (Surname)</label>
									<input type="text" name="lastname" required="required" class="form-control" placeholder="Surname" />
								</div>
							   <div class="form-group">
									<label><font color="red">*</font> Firstname </label>
									<input type="text" name="surname" required="required" class="form-control" placeholder="Firstname" />
								</div>
							   <div class="form-group">
								<label><font color="red">*</font> Sex </label>
									<select class="form-control" required="required" name="sex"><option></option><option>Male</option><option>Female</option></select>
							  </div> 
							  <div class="form-group">
								<label><font color="red">*</font> Entry Class </label>
								 <select class="form-control" required="required" name="entry_class"><option></option>
								 <?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id'); ?>
								 </select>
							</div>
							 <div class="form-group">
								<label><font color="red">*</font> Email </label>
								<input type="email" required="required" id="email" name="email" class="form-control" placeholder="Email Account" />
								<span style="float:right" id="emailmsg"></span> 
							</div>
							</div><!-- /.box-body -->
					</div><!-- /.box -->

						<!-- Form Element sizes -->
				   </div><!--/.col (left) -->
				<!-- right column -->
				<div class="col-md-6">
					<!-- general form elements disabled -->
					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">Login Information and Pin</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
								<div class="form-group">
									<label><font color="red">*</font> Choose Username (Uneditable) </label>
										<input type="text" required="required" id="user_username" name="user_username" class="form-control" placeholder="Chose Username" maxlength="20" />
									 <span style="float:right" id="user_usernamemsg"></span>
									 </div>
									 <div class="form-group">
									<label><font color="red">*</font> Choose Password </label>
										<input type="password" required="required" name="password1" id="password1" class="form-control" placeholder="Type password" maxlength="20"/>
										<span id="pwdMeter" class="neutral" style="float:right; display:none">Very Weak</span>
									</div>
									 <div class="form-group">
									<label><font color="red">*</font> Confirm Password </label>
										<input type="password" required="required" name="password2" id="password2" class="form-control" placeholder="Retype password" maxlength="20"/>
										<span style="float:right" id="password_match_span"></span>
									</div>
							<div class="form-group">
									<label><font color="red">*</font> Card Pin </label>
							 <input type="password" name="pin" required="required" class="form-control" placeholder="Card Pin"/>
									</div>
							<div class="form-group">
								<label><font color="red">*</font> Card Pin Serial </label>
							 <input type="text" name="pinserial" required="required" class="form-control" placeholder="Card Pin Serial Number"/>
								<input type="hidden" name="byepass" value="tedryD4TvdyuBD4r89opbNUSaq" />	
							</div>
							<div class="form-group">
									<label><font color="red">*</font> Simple Captcha: 
									<span id="load_captcha"></span></label>
								</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div><!--/.col (right) -->
			</div>   <!-- /.row -->
				 <div class="box-footer" align="center" style="max-width:300px; margin:0 auto;">
					<button type="submit" id="signup" name="signup" class="btn bg-custom text-white btn-block">Check me up</button>
					<a href="<?php print constant('double_return') ?>student/" class="text-center">Already done this?</a>
				</div>
			<?php } ?>
		</section><!-- /.content -->
	</form>
	<!-- jQuery 2.0.2 -->
		<script src="<?php print constant('double_return') ?>myjs/jquery.min.js" type="text/javascript"></script>
		<!-- Bootstrap -->
		<script src="<?php print constant('double_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
		<!----JQuery Password Meter--->
		<script src="<?php print constant('double_return') ?>js/jquery.pwdMeter.js" type="text/javascript"></script>
		 <!-- feccukcontroller -->
		<script type="text/javascript">
		/*check for jquery */
			$('.cant_register_div').css('display', 'none');
				/* email 
			$('#email').focusout(function(e) {
				email = $(this).val();
				byepass = 'jnjbgvycftyxCTFTTY';
				$.post('formValidator?type=email', {email:email, byepass:byepass}, function(data) {
					$('#emailmsg').html(data);	
				});
			}); */

			/*username check */
			$('#user_username').focusout(function(e) {
				user_username = $(this).val();
				byepass = 'jnjbgvycftyxCTFTTY';
				$.post('formValidator?type=user_username', {user_username:user_username, byepass:byepass}, function(data) {
					$('#user_usernamemsg').html(data);	
				});
			});

				/* register sending function */
		$('#registration_form').submit(function(e) {
			$('#signup').attr('disabled', 'disabled');
			$('#signupMessage').html('Preparing.  <?php $kas_framework->loading_h(); ?>');
				reg_values = $('#registration_form :input').serializeArray();
					$.post('student_register_script', reg_values, function(data) {
						$('#signupMessage').html(data); }); return false;  });
		
		$('#password1').pwdMeter({
			minLength: 6,
			displayGeneratePassword: true,
			generatePassText: 'Password Generator',
			generatePassClass: 'GeneratePasswordLink',
			RandomPassLength: 13
		});
		
		$('#password1').focusin(function() {
			$('.neutral').show();
		}).focusout(function() {
			$('.neutral').hide();
		})
		
		$('#load_captcha').load('<?php print constant('double_return') ?>inc.files/ult_captcha.php');
		
		$('#password2, #password1').keyup(function(e) {
			$('#password_match_span').text("");
			if ($('#password2').val().length !=0 && $('#password1').val().length !=0) {
			 pass2val = $('#password2').val();
			 pass1val = $('#password1').val();
			 $('#password_match_span').text("Passwords Do Not Match");
			 $('#password1, #password2').css('border', '1px solid red');
			 if (pass2val == pass1val) {
				$('#password_match_span').text("Passwords Match");
			 $('#password1, #password2').css('border', '1px solid green');
			 }
			}
		})
		</script>
<?php include (constant('double_return').'inc.files/fixedfooter.php') ?>
</body>
</html>