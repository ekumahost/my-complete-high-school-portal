<?php 
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
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
        <title>Receipt</title>
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
		<style type="text/css"> </style>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
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
                    <h1><i class="fa fa-print text-yellow"></i> Print Receipt <?php $student->display_accessLevel(); ?></h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-tags"></i>Payments</a></li>
						<li class="active"><i class="fa fa-print"></i> Receipt</li>
                    </ol>
                </section>

                <div class="pad margin no-print">
                    <div class="alert alert-info" style="margin-bottom: 0!important;">
                        <i class="fa fa-info"></i>
                        <b>Note:</b> Please Print this Receipt for your Personal Up Keep.Its not 100% Safe to keep it here.
                    </div>
                </div>
		<?php 
			
				$receipt_id_gotten = $kas_framework->unsaltifyID(@$_GET['print']);
				
				$receipt_details = "SELECT * FROM payment_receipts WHERE tuition_history_id = '".$receipt_id_gotten."' LIMIT 1";
				$db_handle_receipt_details = $dbh->prepare($receipt_details);
				$db_handle_receipt_details->execute();
				$get_rowsX = $db_handle_receipt_details->rowCount();
				$paramGetFieldsX = $db_handle_receipt_details->fetch(PDO::FETCH_OBJ);
				$db_handle_receipt_details = null;
				
				if ($get_rowsX == 0) {
							$kas_framework->showDangerCallout('You Just Committed an Offense that is Punishable. You Just tried Hijacking a URL. A report has been Sent for Scrutiny. This Page have been Freezed. <a href="'.$kas_framework->server_root_dir('student/dashboard/').'">Visit the DashPanel</a> or <a href="'.$kas_framework->help_url('?topic=invalid-url-parameter').'" target="new">Explanation? <a>');
								print '<center><img src="'.$kas_framework->server_root_dir('img/restricted.png').'" width="60%"/>
								<img src="'.$kas_framework->server_root_dir('img/sorry.png').'" width="50%"/></center>';
									
								require (constant('quad_return').'php.files/classes/PHPMailer/PHPMailerAutoload.php');
									require (constant('quad_return').'php.files/classes/mailing_list.php');
										$mailing_list->mailHackingReport($kas_framework->returnUserSchool(''), 'A hacking attempt was just made on the portal of the schools name which appear above.
										<br />Destination: Student Portal. <br />Location: Payment Receipt Printing. <br />User IP: '.$kas_framework->getUserIP().'<br />
										Student Details: Username: '.$username.' &raquo; Fullname: '.$userlastname.' '.$userfirstname.'<br />Please Respond.');
									
									exit();
						}
				
					$tution_paid_by_user_id = $paramGetFieldsX->tution_paid_by_user_id;
					$tution_amount_paid = $paramGetFieldsX->tution_amount_paid;
					$tution_paid_sch_years = $paramGetFieldsX->tution_paid_sch_years;
					$tution_paid_grade = $paramGetFieldsX->tution_paid_grade;
					$tution_paid_terms = $paramGetFieldsX->tution_paid_terms;
					$tution_paid_type = $paramGetFieldsX->tution_paid_type;
					$tution_paid_date = $paramGetFieldsX->tution_paid_date;
					$tution_school_item_price_relid = $paramGetFieldsX->school_item_price_relid;
					$qty_ordered = $paramGetFieldsX->qty;

		?>  
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
					   <strong> Receipt Details </strong>
						<address>
							<?php print $kas_framework->displayUserSchool($userschool); ?><br>
							Receipt Type: <?php print $kas_framework->getValue('tuition_codes_desc', 'tuition_codes', 'tuition_codes_id', $tution_paid_type). ',' ?><br>
							<?php print $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $tution_paid_grade); ?>
							<?php print $kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $tution_paid_terms); ?><br>
							For <?php print $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $tution_paid_sch_years); ?> Session<br>
							Date Paid: <?php print $tution_paid_date ?><br>
						</address>
					</div><!-- /.col -->
					<div class="col-sm-4 invoice-col">
					   <strong> User Details </strong>
						<address>
						   <?php print $userfirstname .' '. $userlastname .' '.$usermname ?><br>
							Registration Number: <?php print $useridentify; ?><br>
							<?php print $useremail ?><br>
						   Mobile: <?php print $user_bio_mobile ?><br/>
							Status: Paid and Cleared
						</address>
					</div><!-- /.col -->
					<div class="col-sm-4 invoice-col">
				<?php $dynamicimage = $kas_framework->imageDynamic($userpicturepath, $usergender, $kas_framework->server_root_dir('pictures/'));
				print '<img src="'.$dynamicimage.'" width="120" alt="User Image" />';
				?>
					</div><!-- /.col -->
				</div><!-- /.row -->
			<?php if ($tution_paid_type == 1) {
			/*Meaning that its a school fees receipt that is to be printed*/
			//but if the school fees receipt to be printed is a single amount from the school item, he/she should be told to go and print receipt for the current term fees
				if ($qty_ordered > 0) { //because there cant be a quantity ordered for school fees which is always set to 0, means that its a school item under school fees
					print '<div class="row">
								<div class="col-xs-12 table-responsive">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>S/N</th>
												<th>Details</th>
												<th>Breakdown</th>
												<th>Amount</th>
											</tr>                                    
										</thead>
										<tbody>
										<tr><td>1. </td><td>'.$kas_framework->getValue('school_item_name', 'school_item_price', 'id', $tution_school_item_price_relid).'</td>
										<td>'.$kas_framework->getValue('school_item_desc', 'school_item_price', 'id', $tution_school_item_price_relid).'</td>
										<td>N'.number_format($tution_amount_paid).'</td></tr>
										</tbody></table><br /><br />';
					
				} else { //print the normal school fees receipt --- edited version V1.1	
						print '<div class="row">
								<div class="col-xs-12 table-responsive">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>S/N</th>
												<th>Breakdown</th>
												<th>Amount</th>
											</tr>                                    
										</thead>
										<tbody>';
						$get_school_fees_breakdown = "SELECT * FROM school_fees WHERE grades = '".$tution_paid_grade."' AND grades_term = '".$tution_paid_terms."' AND school_year = '".$tution_paid_sch_years."' AND component != 'total'";
						$db_get_school_fees_breakdown = $dbh->prepare($get_school_fees_breakdown);
						$db_get_school_fees_breakdown->execute();
						
						$sn = 0; $sub_total_total = 0;
						while ($breakdown = $db_get_school_fees_breakdown->fetch(PDO::FETCH_OBJ)) {
							$sn = $sn + 1;
							$sub_total_total = $sub_total_total + $breakdown->price;
								print '<tr><td>'.$sn.'</td>
								<td>'.$breakdown->component.'</td> 
								<td>N'.number_format($breakdown->price).'</td> </tr>';
						}
						$db_handle = null;
						
						// adding other details from school items under school fees for the term, we have the following coding...
						$school_item_integration = "SELECT * FROM payment_receipts WHERE tution_paid_by_user_id = '".$student_id_original."' AND tution_paid_sch_years = '".$tution_paid_sch_years."' 
						AND tution_paid_grade = '".$tution_paid_grade."' AND tution_paid_terms = '".$tution_paid_terms."' AND tution_paid_type = '1' AND school_item_price_relid != '0' AND qty != '0'";
							$db_school_item_integration = $dbh->prepare($school_item_integration);
							$db_school_item_integration->execute();
							$get_rows = $db_school_item_integration->rowCount();
							 $adding_sch_item_price = 0;
							 
							while ($sch_item_sub = $db_school_item_integration->fetch(PDO::FETCH_OBJ)) {
								$sn = $sn + 1;
								$sub_total_total = $sub_total_total + $sch_item_sub->tution_amount_paid;
								$adding_sch_item_price = $adding_sch_item_price + $sch_item_sub->tution_amount_paid;
								print '<tr><td>'.$sn.'</td>
								<td>'.$kas_framework->getValue('school_item_name', 'school_item_price', 'id', $sch_item_sub->school_item_price_relid).'</td> 
								<td>N'.number_format($sch_item_sub->tution_amount_paid).'</td> </tr>';
							}
							$db_school_item_integration = null;
						
							$other_break_downs = ($tution_amount_paid + $adding_sch_item_price) - $sub_total_total;
							$sn = $sn + 1; //incrementing the count of the other totals incase of more additions
							print '<tr><td>'.$sn.'</td><td>Miscellaneous</td> <td>N'.number_format($other_break_downs).'</td> </tr>';
							$sn = $sn + 1; //incrementing the count of the total or thegrand total
							print '<tr><td>'.$sn.'</td><td>Total</td> <td>N'.number_format($tution_amount_paid + $adding_sch_item_price).'</td> </tr>'; 

							$pronounSex = ($usergender == 'Male')? 'His': 'Her';
							print '</tbody></table>';
				}				
			
					print '<br />
							This Receipt was generated based on the fact that the Students details and Passport which appeared above has 
							Paid '.$pronounSex.' School Fees for the Session and Term under the School which Appears Above.
								<br />Note:  Any Attempt to Forge this Reciept will be taken as a Criminal Offence which is Punishable.	<br /><br />					
						</div>
					</div>';
			/* School Fees Receipt Ends here*/
			} else if ($tution_paid_type == '2') {
                /* meaning that its hostel */

            } else if ($tution_paid_type == '10') {
                /* meaning that its a result check */
                print '<div class="row">
					<div class="col-xs-12 table-responsive">
						<table class="table">
							<thead>
								<tr> <th>S/N</th> <th>Item</th> <th>Description</th> <th>Amount</th> </tr>
							</thead>
							<tbody>';
						$decode_print_item_id = $kas_framework->unsaltifyID($_GET['print']);
						$school_item_amount = $kas_framework->getValue('tution_amount_paid', 'payment_receipts', 'tuition_history_id', $decode_print_item_id);

						//$listing = mysql_fetch_object($getItemDetails);
						print '<tr><td>1</td>
									<td>Result Check</td>
									<td>Receipt for Result Checking for the Term displayed above </td>
									<td><span style="text-decoration:line-through">N</span>'.$school_item_amount.'</td>
								</tr>';
						print '</tbody>
						</table>
					</div>
				</div>';
			} else if ($tution_paid_type == '11') {
                /* meaning that its a class note download check */
                print '<div class="row">
					<div class="col-xs-12 table-responsive">
						<table class="table">
							<thead>
								<tr> <th>S/N</th> <th>Item</th> <th>Description</th> <th>Amount</th> </tr>
							</thead>
							<tbody>';
						$decode_print_item_id = $kas_framework->unsaltifyID($_GET['print']);
						$school_item_amount = $kas_framework->getValue('tution_amount_paid', 'payment_receipts', 'tuition_history_id', $decode_print_item_id);

						//$listing = mysql_fetch_object($getItemDetails);
						print '<tr><td>1</td>
									<td>Class Note Download</td>
									<td>Receipt for Downloading Class note as displayed above </td>
									<td><span style="text-decoration:line-through">N</span>'.$school_item_amount.'</td>
								</tr>';
						print '</tbody>
						</table>
					</div>
				</div>';
			} else {
			/* meaning that its other receipts */
				print '<div class="row">
					<div class="col-xs-12 table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>S/N</th>
									<th>Item</th>
									<th>Description</th>
									<th>Quantity</th>
									<th>Amount</th>
								</tr>                                    
							</thead>
							<tbody>';
							
					$decode_print_item_id = $kas_framework->unsaltifyID($_GET['print']);
					$school_item_price_id = $kas_framework->getValue('school_item_price_relid', 'payment_receipts', 'tuition_history_id', $decode_print_item_id);
					$school_item_qty = $kas_framework->getValue('qty', 'payment_receipts', 'tuition_history_id', $decode_print_item_id);
					$school_item_amount = $kas_framework->getValue('tution_amount_paid', 'payment_receipts', 'tuition_history_id', $decode_print_item_id);

					$getItemDetails = "SELECT * FROM school_item_price WHERE id = '".$school_item_price_id."' LIMIT 1";
					$db_getItemDetails = $dbh->prepare($getItemDetails);
					$db_getItemDetails->execute();
					$listing = $db_getItemDetails->fetch(PDO::FETCH_OBJ);
					$db_getItemDetails = null;
			
						print '<tr><td>1</td>
						<td>'.$listing->school_item_name.'</td> 
						<td>'.$listing->school_item_desc.'</td>
						<td>'.$school_item_qty.'</td>
						<td><span style="text-decoration:line-through">N</span>'.$school_item_amount.'</td>

						</tr>';
				//$kas_framework->getValue($field, $table, $priKeyField, $priKeyValue);
				
				$getting_tuition_code_domain_name = $kas_framework->getValue('tuition_codes_domain_name', 'tuition_codes_domain', 'tuition_codes_domain_id', $listing->tuition_codes_domain);
				$getting_tuition_code_domain_location = $kas_framework->getValue('tuition_codes_domain_location', 'tuition_codes_domain', 'tuition_codes_domain_id', $listing->tuition_codes_domain);
					
					
			print '</tbody>
				</table><br />This Item Paid for is to be collected at <b>'.$getting_tuition_code_domain_name.'</b> which is eventually located at <b>'.$getting_tuition_code_domain_location.'.</b> Please you might want to proceed with this Receipt
				<br /><br /><br /><br />
					This Receipt was generated based on the fact that the Students details and Passport which appeared above has 
					Paid for the item detailed above and should be taken like a cash paymnent under the Session and Term for the School which Appears Above.
						<br />Note:  Any Attempt to Forge this Reciept will be taken as a Criminal Offence which is Punishable.	<br /><br />					
			</div>
		</div>';
		}	
	?>

			<div class="row">
				<!-- accepted payments column -->
				<div class="col-xs-6">
					<!-- accepted payments column --> 
				</div><!-- /.col -->

			</div><!-- /.row -->

				<!-- this row will not appear when printing -->
				<div class="row no-print">
					<div class="col-xs-12">
						<button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
					</div>
				</div>
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
    </body>
</html>