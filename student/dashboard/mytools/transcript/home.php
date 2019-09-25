<?php 
require ( '../../../../php.files/classes/pdoDB.php');	
require ( '../../../../php.files/classes/kas-framework.php');	
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('quad_return').'php.files/classes/students.php');
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/student_details.php');	
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <title>Request Transcript</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('quad_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('quad_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('quad_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -- and (min-width: 554px) -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.<?php print constant('quad_return') ?>js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
		<?php require (constant('tripple_return').'inc.files/header.php') ?>
				<p style="margin-top:18px">&nbsp;</p>
					<div class="wrapper row-offcanvas row-offcanvas-left">
						<!-- Left side column. contains the logo and sidebar -->
				<?php require (constant('tripple_return').'inc.files/sidebar.php') ?>
					<!-- Right side column. Contains the navbar and content of the page -->
						<aside class="right-side">
							<!-- Content Header (Page header) -->
							<section class="content-header">
								<h1><i class="fa fa-send text-red"></i> My Transcript <?php $student->display_accessLevel(); ?></h1>
								<ol class="breadcrumb">
									<li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
									<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-th-large"></i>My Tools</a></li>
									<li class="active"><i class="fa fa-send"></i>&nbsp;&nbsp;Transcript</li>
								</ol>
							</section>

							<!-- Main content -->
							<section class="content">
						<?php $student->checkBasicPlanStudent(); //$student->authConfirm($useradmitStatus); ?>
						<!-- row -->
						<div class="row"> 

							<div class="col-md-12">
								<!-- The time line -->
								<ul class="discussion">
								<!-- discussion item -->
									<li>
										<div class="discussion-item">
											<span class="time">Date: <i class="fa fa-clock-o"></i> <?php print date('d/m/Y'); ?></span><br />
											<div class="discussion-body">
								<?php $kas_framework->showalertwarningwithPaleYellow("A Transcript is a tranfser certificate given by your current School to your new school stating your previous results, behaviour and all other traits. <br />The transer certificate will be prepared by the school in less than 120 Hours and sent to you via the method you choose.<br />
								Another copy also will be sent to the school you are been transfered to for authentication.If you havent cleared your previous Term/Session Fees, Please do not apply to avoid embarasment. <br />
								If any of the information submitted below is wrong, your request will be a Failure"); 
								
								?>
								<div id="trans_message"></div>
								<form action="" method="post" id="transcript_form">
									<div class="form-group">
										<label> Delivery Option </label>
										<select name="delivery_option" class="form-control">
											<option value="">-- Select Your Delivery Method --</option>
											<option value="Manually">I want it given to Me Manually</option>
											<option value="Portal Mail">I want it sent to my Portal Mailbox</option>
											<option value="External Mail">I want it sent to my External Mailbox</option>
											<option value="School Only">I want it sent to my School Only</option>

										</select>
									</div>
									
									<div class="form-group">
										<label> New School Address </label>
										<input name="new_school_address" class="form-control" placeholder="New School Address">
									</div>
									
									<div class="form-group">
										<label> New School Email Address </label>
										<input name="new_school_email_address" class="form-control" placeholder="New School Email Address">
									</div>
									
									<div class="form-group">
										<label> Transcript Format </label>
										<select name="format_option" class="form-control">
											<option value="">-- Select Your Format Type --</option>
											<option value="PDF">I want it in PDF (Portable Document Format)</option>
											<option value="DOC(X)">I want it in DOC(X) (Microsot Word)</option>
											<option value="JPEG">I want it in GIF(JPEG) (Picture)</option>
										</select>
										<input type="hidden" name="byepass" value="kyyE43ty9u09jNHJBG" />
									</div>
									
									<button type="submit" name="send_mail" id="submit_request" class="btn btn-primary"><i class="fa fa-send"></i> Request Transcript</button>
								</form>
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

        <!-- jQuery 2.0.2 -->
        <script src="<?php print constant('quad_return') ?>myjs/jquery.min.js"></script>
		<!---- my javascript controller -->
        <script src="<?php print constant('quad_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('quad_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php print constant('quad_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>
		<!--- The Infinite Scroll -->
		<script type="text/javascript">			
		  $('#submit_request').click(function(e) {
			$(this).attr('disabled', 'disabled');
			  $('#trans_message').html('<center>Preparing. <?php $kas_framework->loading_h(); ?></center>');
				values = $('#transcript_form :input').serializeArray();
					$.post('transcript_processing', values, function(data) {
						$('#trans_message').html(data); }); return false;  });
	</script>
		<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>