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
        <title>My Wallet</title>
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
                    <h1><i class="fa fa-briefcase text-blue"></i> Wallet <?php $student->display_accessLevel(); ?></h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
						<li class="active"><i class="fa fa-briefcase"></i> Wallet</li>
                    </ol>
                </section>

                <!-- Main content -->
               <section class="content">
				<?php print $student->showAvailableBalance($student_balance, $student_balance_date_last_used);
				 $kas_framework->showWarningCallout("You can recharge your Account through any Of the Methods Below &raquo; <a href='".$kas_framework->help_url('?topic=payment-options')."' target='blank'>Explanation?</a>"); ?>	 
	<!---------------------------------------------------------------------------------------------------->
	                    <div class="row">
                        <div class="col-md-6">

                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Credit Card Panel</h3>
                                </div>
                                <div class="box-body">
									
						<!-- accepted payments column -->
                       <style type="text/css"> .mcards { margin:0 0 8px 8px; width:68px} </style>
                            <p class="lead">Select your Card:</p>
                            <a href="#"><img src="<?php print constant('tripple_return') ?>img/credit/visa.png" alt="Visa" class="mcards" /></a>
                            <a href="#"><img src="<?php print constant('tripple_return') ?>img/credit/mastercard.png" alt="Mastercard" class="mcards" /></a>
                            <a href="#"><img src="<?php print constant('tripple_return') ?>img/credit/american-express.png" alt="American Express" class="mcards" /></a>
                            <a href="#"><img src="<?php print constant('tripple_return') ?>img/credit/paypal2.png" alt="Paypal" class="mcards" /></a>
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                               We Support all the Type of Payment Listed above. You can also use the Bank Card Pin Recharge.
                            </p>
									
								</div><!-- /.box-body -->
                            </div><!-- /.box -->

                        </div><!-- /.col (left) -->
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Bank Card Pin Recharge</h3>
                                </div>
                                <div class="box-body">
								<form action="" method="post" id="updateWalletForm">
                                  <div class="box-body">
										<!-- Date dd/mm/yyyy -->
										<div class="form-group">
											<label> Card Serial Number </label>
											<input type="text" required="required" name="serial" class="form-control" placeholder="Card Serial" />
											</div>
										<div class="form-group">
											<label> Card Pin </label>
											<input type="password" required="required" name="pin" class="form-control" placeholder="Card Pin" />
                                            <input type="hidden" name="byepass" value="gHJ5n6TN7tvgG5F6bg6gb6G6" />										
										</div>
									</div><!-- /.box-body -->
								<button type="submit" class="btn btn-primary flr-left" id="creditWalletButton">
								<span style="text-decoration:line-through">N</span> Credit Wallet</button>
								</form><br />
							   </div><!-- /.box-body -->
								<div id="rechargeMessage" align="center"></div>
							 </div>
						 
                          </div><!-- /.box -->
						</div><!-- /.col (right) -->
                    </div><!-- /.row -->
	<!---------------------------------------------------------------------------------------------------->
					 
				</section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- jQuery 2.0.2 -->
        <script src="<?php print constant('tripple_return') ?>myjs/jquery.min.js"></script>
		<!---- my javascript controller -->
        <script src="<?php print constant('tripple_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('tripple_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php print constant('tripple_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>
		<script type="text/javascript">
			/*credit Wallet js*/
			$('#updateWalletForm').submit(function(e) {
				$('#rechargeMessage').html('<?php $kas_framework->loading_h(); ?>');
				$('#creditWalletButton').attr('disabled', 'disabled');
				var mydata = $('#updateWalletForm :input').serializeArray();		
				$.post('wallet_recharge_processor', mydata, function(data) {
					$('#rechargeMessage').html(data);	
				});
				
				return false;
			});
		
		</script>
		
	<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>	
    </body>
</html>