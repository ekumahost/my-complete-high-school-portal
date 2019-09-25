<?php require ('../php.files/classes/pdoDB.php');
		require ('../php.files/classes/kas-framework.php');
		$kas_framework->safesession();
	if (isset($_SESSION['tapp_std_username'])) {
		print '<script type="text/javascript"> self.location = "dashboard/" </script>';
	} else if (isset($_SESSION['tapp_prostd_username'])) {
		print '<script type="text/javascript"> self.location = "'.$kas_framework->server_root_dir('prospectStudent/dashboard/').'" </script>';
	}
	
	if (($kas_framework->getCookie('hold_username') != '') and ($kas_framework->getCookie('hold_image') != '')) {
		print '<script type="text/javascript"> self.location = "welcomeback" </script>';
	}

 ?>
<!DOCTYPE html>
<html class="bg-black">
<style type="text/css">
.bg-black {background: url(../img/user_bg.jpg) repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;}
</style>
    <head>
        <meta charset="UTF-8">
        <title>Student | Check In</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
		<?php if (@$_GET['ref'] == 'bounce') {
			$kas_framework->showWarningCallout('Please Log In');
		} ?>
		
		<noscript>
			<?php $kas_framework->showDangerCallout('If you are Seeing this, Please Enable <b>Javascript.</b> <a href="'.$kas_framework->help_url('?topic=jquery-not-detected').'" target="_blank">Explanation?</a>'); ?>
		</noscript>
		
		<div class="header"> <a href="../"><?php $kas_framework->displaySchoolLogo('60', 'circle', '0 5px 0 -10px'); ?></a>Students Check In</div>

		<?php if ($kas_framework->app_config_setting('student_login') == false) {
		$kas_framework->showDangerCallout('<font color="black"><center> Sorry! Student Login has been closed. See the School Administrator for this.  But Teranig have a question for you... How did you get here? Your IP has been Logged. </font></center>
					<br /><br /><center><a href="'.$kas_framework->server_root_dir('').'" class="btn bg-custom text-white btn-block" style="width:50%">
						<i class="fa fa-dashboard text-white"></i> Go Home </a></center>');
					
					require (constant('single_return').'php.files/classes/PHPMailer/PHPMailerAutoload.php');
					require (constant('single_return').'php.files/classes/mailing_list.php');
						$mailing_list->mailHackingReport($kas_framework->returnUserSchool(''), 'A hacking attempt was just made on the portal of the schools name which appear above.
						<br />Destination: Student Portal. <br />Location: Login. <br />User IP: '.$kas_framework->getUserIP().'<br />Please Respond.');
						
			} else { ?>		

		   <form action="" method="post" id="loginForm">
                <div class="body bg-gray">
                    <div class="form-group">
					Username or Email
                        <input type="text" required name="username" class="form-control" placeholder="Username or Email Adress"/>
                    </div>
                    <div class="form-group">
					Password
                        <input type="password" required name="password" class="form-control" placeholder="Password"/>
						<input type="hidden" name="byepass" value="g6TB5g5byY5Byg5gbYBBG5G" />
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                </div>
                <div class="footer" align="center">                                                               
                    <button type="submit" class="btn bg-custom text-white btn-block" name="signin" id="signin">Check me in</button>  
                    <p><a href="resetpwd">Forgot Password</a> &laquo; &raquo; <a href="../" class="text-center">Navigate Away</a></p>
                    </form>
                     <br />
                 <span id="loginMessage"></span>

				 <?php if (isset($_POST['signin'])) {
						$kas_framework->showinfowithBlue('This Portal Cannot run on this Browser. <a href="'.$kas_framework->help_url('?topic=jquery-not-detected').'" target="_blank">Explanation?</a>');
					}				 ?>
                </div>
		<div class="margin text-center"></div>
		<?php } ?>
        </div>


        <!-- jQuery 2.0.2 -->
        <script type="text/javascript" src="../myjs/jquery.min.js"></script>
		 <!-- feccukcontroller -->
        <script type="text/javascript" src="../myjs/feccukcontroller.js"></script>
		<script type="text/javascript">

		/* login sending function */
		$('#signin').click(function(e) {
			$(this).attr('disabled', 'disabled');
			$('#loginMessage').html(' <?php $kas_framework->loading_h('center'); ?>');
			
			loginVals = $('#loginForm :input').serializeArray();
			$.post('../php.files/student_login_script', loginVals, function(data) {
				$('#loginMessage').html(data);
			});
			
			return false;
		});
		</script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>  
		<?php include ('../inc.files/fixedfooter.php') ?>		
    </body>
</html>