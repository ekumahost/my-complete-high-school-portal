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
        <title>Generate Receipt</title>
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
                        <b>Note:</b> This Receipt was arranged by date. If you dont want to print a day's receipt, then go to the item and Click on print. Select a date and then click generate.
                    </div>
                </div> 
		<style type="text/css">
			select { padding:8px; } 
		</style>	    
				<section class="content no-print">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-success" style="box-shadow:3px 4px 20px #ccc; padding:12px">
								<form action="" method="get">Please Select  Receipt Date:
								<?php $dist_raw_query = "SELECT DISTINCT tution_paid_date, tution_paid_terms, tution_paid_grade, tution_paid_sch_years FROM payment_receipts
											WHERE tution_paid_by_user_id = '".$userid."' AND school_item_price_relid NOT IN (0, 11) ORDER BY tuition_history_id DESC";
											$db_dist_raw_query = $dbh->prepare($dist_raw_query);
												$db_dist_raw_query->execute();
											
									print '<select name="print@date"><option></option>';
									echo '<option value="" selected="selected"> -- Select a Date -- </option>';
										while ($data_select = $db_dist_raw_query->fetch(PDO::FETCH_OBJ)) {
											print '<option>'.$data_select->tution_paid_date.'</option>';
									}	print '</select>'; 
									
									//get the second 
										$db_dist_raw_queryX = $dbh->prepare($dist_raw_query);
											$db_dist_raw_queryX->execute();
											$varX = $db_dist_raw_queryX->fetch(PDO::FETCH_OBJ);
									
									?>
								<button type="submit" class="btn btn-default btn-flat click_ult" value="start+generating" name="proceed_button">Generate</button>
								</form>
							</div>
						</div>  
				
                    </div><!-- ./row -->
				</section><!-- /.content -->	
				
			<!-- Main content -->
			<?php if (isset($_GET['print@date']) and $_GET['print@date'] != '') { ?>
				<section class="content invoice"> 
			<?php $receipt_date_gotten = urldecode($_GET['print@date']);
					if ($receipt_date_gotten == '') {
					print 'Please Select a Receipt Date to Generate';
					} else { ?>
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
				
				<div class="row invoice-info">
					<div class="col-sm-4 invoice-col">
					   <strong> Receipt Details </strong>
						<address>
							<?php print $kas_framework->displayUserSchool($userschool); ?><br>
							Receipt Type: - <br>
							<?php print $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $varX->tution_paid_grade) ?>
							<?php print $kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $varX->tution_paid_terms); ?><br>
							For <?php print $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $varX->tution_paid_sch_years); ?> Session<br>
							Date Paid: <?php print $receipt_date_gotten ?><br>
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
		<?php		
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
						
						// NOT IN - in the query means not school fees (0) and class notes(11) because they are not in the "school_item_price" table
						$while_selection = "SELECT * FROM payment_receipts WHERE tution_paid_date = '".$receipt_date_gotten."' AND school_item_price_relid NOT IN (0, 11) ORDER BY tuition_history_id DESC";
						$db_while_selection = $dbh->prepare($while_selection);
						$db_while_selection->execute();
						$get_rows = $db_while_selection->rowCount();
				
						if ($get_rows == 0) { print '<tr><td colspan="5"> No View On this Date. Maybe the Only Payment Made here was a School Fees Payment. Open the "Wallet" panel and then click on "payment History". There you will see the School Fees </td></tr>'; }
						  $sn = 0;
							while ($getallReceipt = $db_while_selection->fetch(PDO::FETCH_OBJ)) {
							$sn = $sn + 1;
									$school_item_price_relid = $kas_framework->getValue('school_item_price_relid', 'payment_receipts', 'tuition_history_id', $getallReceipt->tuition_history_id);
									$school_item_qty = $kas_framework->getValue('qty', 'payment_receipts', 'tuition_history_id', $getallReceipt->tuition_history_id);
									$school_item_amount = $kas_framework->getValue('tution_amount_paid', 'payment_receipts', 'tuition_history_id', $getallReceipt->tuition_history_id);

								$getItemDetails = "SELECT * FROM school_item_price WHERE tution_code_rel_id = '".$school_item_price_relid."' LIMIT 1";
									$db_getItemDetails = $dbh->prepare($getItemDetails);
									$db_getItemDetails->execute();
									$listing = $db_getItemDetails->fetch(PDO::FETCH_OBJ);
									$db_getItemDetails = null;
									$itemName = (@$listing->school_item_name == '')? 'Could not get Name': $listing->school_item_name;
									$itemDesc = (@$listing->school_item_desc == '')? 'Could not get Description': $listing->school_item_name;
								
											print '<tr><td>'.$sn.'</td>
											<td>'.$itemName.'</td> 
											<td>'.$itemDesc.'</td>
											<td>'.$school_item_qty.'</td>
											<td><span style="text-decoration:line-through">N</span>'.number_format($school_item_amount).'</td>

											</tr>';
						}			
						$db_while_selection = null;
						//$kas_framework->getValue($field, $table, $priKeyField, $priKeyValue);
						
						print '</tbody>
						</table><br /><br /><br /><br /><br />
							This Receipt was generated based on the fact that the Students details and Passport which appeared above has 
							Paid for the item(s) detailed above and should be taken like a cash paymnent under the Session and Term for the School which Appears Above.
								<br />Note:  Any Attempt to Forge this Reciept will be taken as a Criminal Offence which is Punishable.	<br /><br />					
					</div>
				</div>';
	
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
		<?php } 
		} else {
			$kas_framework->showWarningCallout('Select a Date and click on the Generate Receipt button');
		} ?>
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