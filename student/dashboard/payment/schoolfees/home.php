<?php 
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();	
$kas_framework->checkAuthStudent();
require (constant('quad_return').'php.files/classes/students.php');
require (constant('quad_return').'php.files/classes/generalVariables.php');
require ('../../../../php.files/student_details.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Invoice - School Fees</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('quad_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('quad_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('quad_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
	<style type="text/css">
	#edz { padding:1px 6px; background-color:#fff; margin-top:2px;  }
	select { padding:5px; } 
	</style>
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
				<h1><i class="fa fa-credit-card"></i> Invoice <?php $student->display_accessLevel(); ?></h1>
				<ol class="breadcrumb">
					<li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
					<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-tags"></i>Payments</a></li>
					<li class="active"><i class="fa fa-tags"></i> Schoolfees</li>
				</ol>
			</section>
			
		<div class="col-md-9">

			<div class="pad margin no-print">
			<?php //getting the year, class, and session
				$school_years = ((@$_POST['school_years']) != '')? $_POST['school_years']: $kas_framework->getValue('current_year', 'tbl_config', 'id', '1');
				$grade_class = ((@$_POST['grade_class']))? $_POST['grade_class']: $user_student_grade_year_grade_id;
				$grade_terms = ((@$_POST['grade_terms']))? $_POST['grade_terms']: $kas_framework->getValue('grade_terms_id', 'grade_terms', 'current', '1');
			
			 print $student->showAvailableBalance($student_balance, $student_balance_date_last_used); ?>
                </div>

                <!-- Main content -->
                <section class="content invoice">                    
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                 <?php  $kas_framework->displaySchoolLogo('40', 'circle', '0 5px 0 0');
								$kas_framework->displayUserSchool($userschool); ?>
                                <small class="pull-right">Date: <?php print date('d/m/Y'); ?></small>
                            </h2>                            
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong><?php $kas_framework->displayUserSchool($userschool) ?></strong>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong><?php print $userfirstname. ' '. $userlastname .'('.$usergender.')' ?></strong>
                                <br />Reg. No: <?php print $useridentify; ?>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Invoice: <b><?php print '#'. mt_rand(111111, 999999); ?></b><br/>
                            Payment Due:<b> <?php print date('d/m/Y'); ?></b><br/>
						 </div><!-- /.col -->
                    </div><!-- /.row -->

				<!-- Table row -->
				<div class="row" id="feesBreakdown">
				  <div class="col-xs-12 table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>SN</th>
								<th>Breakdown</th>
								<th>Amount</th>
							 </tr>                                 
						</thead>
						<tbody>
                                    
			<?php 
				$fees_sub_tt_query = "SELECT * FROM school_fees WHERE grades = '".$grade_class."' AND grades_term = '".$grade_terms."' AND school_year = '".$school_years."' AND component != 'total'";
				$db_handle_fees_sub_tt_query = $dbh->prepare($fees_sub_tt_query);
				$db_handle_fees_sub_tt_query->execute();
				$get_rowsX = $db_handle_fees_sub_tt_query->rowCount();
				
				$fees_tt_query = "SELECT * FROM school_fees WHERE grades = '".$grade_class."' AND grades_term = '".$grade_terms."' AND school_year = '".$school_years."' AND component = 'total'";
				$db_handle_fees_tt_query = $dbh->prepare($fees_tt_query);
				$db_handle_fees_tt_query->execute();
				$paramGetFieldsX = $db_handle_fees_tt_query->fetch(PDO::FETCH_OBJ);
				$get_rowsY = $db_handle_fees_tt_query->rowCount();
				
				//if (!$fees_total) { print mysql_error(); }
					
					if ($get_rowsX > 0 or $get_rowsY > 0) {
					//means that a fatal error occured during the process of selecting the school fees
					$sn = 0;
					$grand_total = $paramGetFieldsX->price; //grand total
					$sub_total_total = 0;
					
					while ($sub_total = $db_handle_fees_sub_tt_query->fetch(PDO::FETCH_OBJ)) {
						$sub_total_total = $sub_total_total + $sub_total->price;
						$sn = $sn + 1;
							print '<tr><td>'.$sn.'</td>
							<td>'.$sub_total->component.'</td> 
							<td>N'.number_format($sub_total->price).'</td> </tr>';
					}
					$db_handle_fees_sub_tt_query = null;
					/* exists the page is the sub total is more than the grand total or security */					
					if ($sub_total_total > $grand_total) {
						$kas_framework->showdangerwithRed("<b>Fatal Error: </b> If you are seeing this, please check again later. The admin is setting the fees for this term");
						exit();
					}
					/* exists the page is the sub total is more than the grand total or security */	
					
					$other_break_downs = $grand_total - $sub_total_total;
					$sn = $sn + 1; //incrementing the count of the other totals incase of more additions
					print '<tr><td>'.$sn.'</td><td>Other Break downs not Listed</td> <td>N'.number_format($other_break_downs).'</td> </tr>';
					$sn = $sn + 1; //incrementing the count of the total or thegrand total
					print '<tr><td>'.$sn.'</td><td>Total</td> <td>N'.number_format($grand_total).'</td> </tr>'; 
						$paidby = (isset($_SESSION['tapp_par_username']))? "Parent": "Student";
						define ('continue', 'yes'); //continue with the print button and the summary
					} else {
						$kas_framework->showDangerCallout('Fatal Error Occured. Please Select the Appropriate Options from the Sidebar. If this Continues, Contact the school admin Immediately');
						define ('continue', 'no'); //continue with the print button and the summary
					}
					
					$db_handle_fees_sub_tt_query = null;
					?> 
                                 </tbody>
                            </table>                            
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <?php if (constant('continue') == 'yes') { ?>
					<div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            <p class="lead">Payment Methods:</p>
                            <a href="#"><img src="<?php print constant('quad_return') ?>img/credit/visa.png" alt="Visa" class="mcards" /></a>
                            <a href="#"><img src="<?php print constant('quad_return') ?>img/credit/mastercard.png" alt="Mastercard" class="mcards" /></a>
                            <a href="#"><img src="<?php print constant('quad_return') ?>img/credit/american-express.png" alt="American Express" class="mcards" /></a>
                            <a href="#"><img src="<?php print constant('quad_return') ?>img/credit/paypal2.png" alt="Paypal" class="mcards" /></a>
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                               We Support all the Type of Payment Listed above. But you should pay from your Wallet 
                            </p>
                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead">Amount Due <?php print date('d/m/Y'); ?></p>
                            <div class="table-responsive">
                                <table class="table">
									<tr><th style="width:50%">Subtotal:</th> <td>N<?php print number_format($grand_total) ?></td></tr>
                                    <tr><th>VAT:</th> <td>N0</td></tr>
                                    <tr><th>Grand Total:</th> <td>N<?php $total_grand_total = $grand_total; print number_format($grand_total); ?></td></tr>
                                    <tr><th style="width:50%">My Wallet:</th> <td>N<span id="user_classic_balance_mod"><?php print number_format($student_balance) ?></span></td></tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                            <a href="#payfees">
							<button class="btn btn-success pull-right" id="paybutton"><i class="fa fa-credit-card"></i> Submit Payment</button></a>
                        </div>
                    </div><br />
				
					
			<div id="payfees"></div>
			<?php } ?>
                </section><!-- /.content -->
			</div><!-- /.col -->
			<br />		
				<?php include ('school_fees_SideBar.php'); ?>
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
		<!---- ----->
		<script type="text/javascript">
			$('#paybutton').click(function(e){
				$(this).attr('disabled', 'disabled');
				$('#payfees').html('<?php $kas_framework->loading_h('center'); ?>').show();
				userid = "<?php print $student_id_original ?>";
				paidby = "<?php print $paidby ?>";
				amount_paid = "<?php print $total_grand_total ?>";
				school_years = "<?php print $school_years ?>";
				grade_class = "<?php print $grade_class ?>";
				paid_terms = "<?php print $grade_terms ?>";
				paid_type = "1";
				byepass = "uyrtBY4E8NYp87e3bvC2W3SEuviybo";
				$.post('schfees_processing', {userid:userid, paidby:paidby, amount_paid:amount_paid, school_years:school_years, grade_class:grade_class, paid_terms:paid_terms, paid_type:paid_type, byepass:byepass}, function(data){
					$('#payfees').html(data);
				})
				
			})
		</script>
    </body>
</html>