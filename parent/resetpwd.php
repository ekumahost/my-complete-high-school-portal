<?php
require ('../php.files/classes/pdoDB.php'); 
require ('../php.files/classes/kas-framework.php'); 

require ('../php.files/classes/PHPMailer/PHPMailerAutoload.php');
require ('../php.files/classes/mailing_list.php'); 
require ('../php.files/classes/confirmationz.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reset Password</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
		<header class="header">
            <a href="../" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                MySchoolApp
            </a>
		</header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Reset Your Password: Parent
                    </h1>
                    <ol class="breadcrumb">
                        <li class="click_ult"><a href="../"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><i class="fa fa-asterisk"></i>&nbsp;&nbsp;Reset password</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 
                  <?php $email_input_form = '<div class="error-page">
					<form role="form" action="resetpwd" method="post">
							<div class="box-body">
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" required="required" class="form-control" name="username" placeholder="Enter Username">
								</div>
							</div>
							<div class="box-footer">
								<button type="submit" name="send_link_butt" class="btn btn-primary ">Send Reset Link</button>
							</div>
						</form>
                    </div>'; 
					
					$password_reset_form = '<div class="error-page">
					<form role="form" action="" method="post">
							<div class="box-body">
								<div class="form-group">
									<label for="password1">New Password</label>
									<input type="password" class="form-control" name="password1" id="password1" placeholder="Enter New Password">
								</div>
								<div class="form-group">
									<label for="password2">Confirm Password</label>
									<input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm New Password">
								</div>
								<span style="float:right" id="password_match_span"></span>
							</div>
						<div class="box-footer">
								<button type="submit" name="reset_pwd_final" class="btn btn-primary ">Change Password</button>
							</div>
						</form>
                    </div>';
					
					//////////////////////// if its for reset, display the password form ///////////////	
					if (isset($_GET['code']) and isset($_GET['email'])) {
						$decode_email = urldecode($_GET['email']);
						$pwd_code = $kas_framework->unsaltifyID($_GET['code']);
						if ($confirmation->confirm_reset_parent($decode_email, $pwd_code) == true) {
						
						$pick_username = "SELECT * FROM web_parents AS wu, student_parents AS sp WHERE wu.web_parents_relid = sp.student_parents_id AND sp.student_parents_email = '".$decode_email."' AND wu.web_parents_password = '".$pwd_code."' LIMIT 1";
						$db_pick_username = $dbh->prepare($pick_username);
						$db_pick_username->execute();
						$paramObj = $db_pick_username->fetch(PDO::FETCH_OBJ);
						$db_pick_username = null;
						
						$users_username = $paramObj->web_parents_username;
							
						$kas_framework->showWarningCallout('Hello <b>'.ucfirst($users_username).':</b> Change your Password. Make sure it is something you can remember');
							(isset($_POST['reset_pwd_final']))? $confirmation->change_password_parent($decode_email, $pwd_code): '';
							print $password_reset_form;
							
						} else {
							$kas_framework->showDangerCallout('Bad Reset Code. Please Enter your email address again.');
							print $email_input_form;
						}
					//////////////////////// if not the form, display the email form ///////////////	
					} else {
						(isset($_POST['send_link_butt']))? $confirmation->confirm_email_send_link_parent($_POST['username']): '';
						print $email_input_form;
					}

					?>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="../myjs/jquery.min.js"></script>
		 <!-- feccukcontroller -->
        <script src="../myjs/feccukcontroller.js" type="text/javascript" ></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../js/AdminLTE/app.js" type="text/javascript"></script>
		<!-------- my jquery --->
		<script type="text/javascript">
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
		<?php include ('../inc.files/fixedfooter.php') ?>
    </body>
</html>