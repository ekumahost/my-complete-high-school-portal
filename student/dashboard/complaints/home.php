<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('tripple_return').'php.files/classes/students.php');
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/student_details.php');	
	
 ?>
 
 <?php if (isset($_GET['message'])) {
		extract($_POST);
		if ($kas_framework->strIsEmpty($email) or $kas_framework->strIsEmpty($fullname) or $kas_framework->strIsEmpty($subject) or $kas_framework->strIsEmpty($message)) {
			$kas_framework->showDangerCallout('Please Fill in all Fields.');
			$kas_framework->buttonController('#submit_request', 'enable');
		} else  {
			if ($kas_framework->tapp_admin_mail($email, $fullname, $subject, $message) == true) {
				$kas_framework->showInfoCallout('Message Received Succesfully');
			} else {
				$kas_framework->showDangerCallout('Message Sending Failed. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
				$kas_framework->buttonController('#submit_request', 'enable');
			}
		}
	exit; 
} ?>
		
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Complaints</title>
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

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="myjs/html5shiv.js"></script>
          <script src="myjs/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
	
	<?php require (constant('double_return').'inc.files/header.php') ?>
	<p style="margin-top:18px">&nbsp;</p>
	<div class="wrapper row-offcanvas row-offcanvas-left">
	<?php require (constant('double_return').'inc.files/sidebar.php') ?>

 <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                      <i class="fa fa-bug text-blue"></i> Lay Complaints
                        <small>admin messaging</small>
                    </h1>
                    <ol class="breadcrumb">
                       <li class="click_ult"><a href="../"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="active"><i class="fa fa-bug"></i>&nbsp;&nbsp;Complaints</li>
                    </ol>
                </section>

			 <!-- Main content -->
                <section class="content">
								<!-- row -->
			<div class="row"> 
			<?php
			$email_address = $useremail;
				$fullname = $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $usertitle).' '.$userlastname.' '.$userfirstname.' '.$usermname;
			?>
				<div class="col-md-12">
					<!-- The time line -->
					<ul class="discussion">
					<!-- discussion item -->
						<li>
							<div class="discussion-item">
								<span class="time">Date: <i class="fa fa-clock-o"></i> <?php print date('d/m/Y'); ?></span><br />
								<div class="discussion-body">
					
									<form action="" method="post" id="complaint_form">
										<div class="form-group">
											<label> Fullname </label>
											<input disabled="disabled" class="form-control" value="<?php print $fullname; ?>">
											<input type="hidden" name="fullname" value="<?php print $fullname; ?>">
										</div>
										
										<div class="form-group">
											<label>My Email</label>
											<input class="form-control" disabled="disabled" value="<?php print $email_address ?>">
											<input type="hidden" name="email" value="<?php print $email_address ?>">
										</div>
										
										<div class="form-group">
											<label>Subject</label>
											<input type="text" required="required" name="subject" class="form-control" placeholder="Subject of Discussion">
										</div>
										
										<div class="form-group">
											<label>Message</label>
											<textarea name="message" required="required" class="form-control" placeholder="Message to School Admin"></textarea>
										</div>
										<button type="submit" name="send_msg" id="submit_request" class="btn btn-primary"><i class="fa fa-send"></i> Send Message</button>
									</form>
									<br />
									<span id="send_message_display"></span>
								</div>
							</div>
						</li>
							<!-- END timeline item -->
                            </ul>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="<?php print constant('tripple_return') ?>myjs/jquery.min.js"></script>
        <!---- my javascript controller -->
        <script src="<?php print constant('tripple_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?php print constant('tripple_return') ?>js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('tripple_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php print constant('tripple_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>   
		<script type="text/javascript">
			$('#complaint_form').submit(function(e){
				$('#submit_request').attr('disabled', 'disabled');
				$('#send_message_display').html('<?php $kas_framework->loading_h('center'); ?>');
				var mydata = $('#complaint_form :input').serializeArray();
				$.post('?message', mydata, function(fdata){
					$('#send_message_display').html(fdata);
				})
				return false;
			})
		</script>
		<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>