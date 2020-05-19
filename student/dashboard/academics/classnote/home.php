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
        <title>Class Note</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('quad_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- Bootstrap time Picker -->
        <link href="<?php print constant('quad_return') ?>css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Ionicons -->
        <link href="<?php print constant('quad_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('quad_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
		<!-- fancybox -->
		<link href="<?php print constant('quad_return') ?>fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
        
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
                    <h1><i class="fa fa-ticket text-blue"></i> Class Note <?php $student->display_accessLevel(); ?></h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
						<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dot-circle-o"></i>Academics</a></li>
						<li class="active"><i class="fa fa-suitcase"></i>&nbsp;&nbsp;Classnote</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				
				<?php //$student->authConfirm($useradmitStatus); ?>
					<div class="row">
                     <?php 
						if (!isset($_GET['proceed_download'])) {
							$kas_framework->showWarningCallout('The charge unit for downloading class note is N'.number_format(classnote_download_fee).' and this will be deducted without warning.'); 
						} else { //check the balance and deduce the fees from there
							//classnote_download_fee
							if ($student_wallet_status == '0') {
								$kas_framework->showDangerCallout('Your Wallet has been Locked Down. <a href="'.$kas_framework->help_url('?topic=wallet#walletlock').'" target="blank">Explanation?</a>');
							} else if (classnote_download_fee > $student_balance) {
								$kas_framework->showDangerCallout('You do not Have enough credit in your Wallet. Please Recharge your Wallet.
										<a href="'.$kas_framework->help_url('?topic=payment-options').'" target="blank">Explanation?</a>');
							} else {
								$dbh->beginTransaction();
								$new_student_balance = $student_balance - classnote_download_fee;
								$updateStudentWallet = "UPDATE student_wallet SET balance = '".$new_student_balance."',
									date_last_used = '".date('d/m/Y')."' WHERE student_id = '".$student_id_original."' LIMIT 1";
									 
									 $paidby = (isset($_SESSION['tapp_par_username']))? "Parent": "Student";
									$insertintoreceipt = "INSERT INTO payment_receipts (tution_paid_by_user_id, tution_paid_by_std_par, tution_amount_paid, tution_paid_sch_years, tution_paid_grade, tution_paid_terms, tution_paid_type, school_item_price_relid, qty, tution_paid_date)
															VALUES ('".$student_id_original."', '".$paidby."', '".classnote_download_fee."', '".$current_year_id."', '".$user_student_grade_year_grade_id."', '".$currentTerm_id."', '11', '0', '1', '".date('d/m/Y')."')";
									
									$db_handle = $dbh->prepare($updateStudentWallet); $db_handle_receipt = $dbh->prepare($insertintoreceipt);
									$db_handle->execute();	$db_handle_receipt->execute();
									$get_rows = $db_handle->rowCount(); $get_rowsX = $db_handle_receipt->rowCount();
									$db_handle = null;	$db_handle_receipt = null;	
																		
									
									if ($get_rows == 0 or $get_rowsX == 0) {
										$dbh->rollBack();
										echo $kas_framework->showDangerCallout('Fatal Error: Could not Deduce from your Balance. Please Try Again. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>');
									} else { //do the main download now.
										$dbh->commit();
										$file_loc = $kas_framework->url_root('files/classnote_files/'). base64_decode($_GET['dd']);
										$kas_framework->showInfoCallout("The sum of N".classnote_download_fee." has been deducted from your account. Please download note here <a class='btn btn-default btn-sm' href='".$file_loc."'><i class='fa fa-cloud-download text-blue'></i> Download</a>");
									}
							}
						}
					?>	 
					<!------------------------------------------------------------------------------------------------------>
					<div class="col-md-9">
					 <?php
					 
						$dyn_grade_year = (isset($_POST['school_years']))? $_POST['school_years']:  $current_year_id;
						$dyn_grade_history_term = (isset($_POST['grade_terms']))? $_POST['grade_terms']:  $currentTerm_id;
						$dyn_grade = (isset($_POST['grade']))? $_POST['grade']: $user_student_grade_year_grade_id;
					 
								 
						print '<div class="box">
							<div class="box-header">
									<h3 class="box-title">My Class Notes</h3>                                    
								</div>
								<div class="box-body table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>S/N</th>
												<th>Subject</th>
												<th>Name</th>
												<th>Set Date</th>
												<th>Added Info</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>'; 
										//encoding and decoding scripts  {base64_decode(base64_encode($string))}
							$hwQuery = "SELECT * FROM classnote WHERE session LIKE '".$dyn_grade_year."' AND term LIKE '".$dyn_grade_history_term."'
									AND grade LIKE '".$dyn_grade."' ORDER BY classnote_id DESC";
									$db_handle = $dbh->prepare($hwQuery);
									$db_handle->execute();
										$serial = 0;
									while ($obj__TT = $db_handle->fetch(PDO::FETCH_OBJ)) {
										$serial = $serial + 1;
										$file_loc = $kas_framework->url_root('files/classnote_files/'). $obj__TT->classnote_file;
									print '<tr>
											<td>'.$serial.'</td>
											<td>'.$kas_framework->getValue('grade_subject_desc', 'grade_subjects', 'grade_subject_id', $obj__TT->subject).'</td>
											<td>'.$obj__TT->name.'</td>
											<td>'.$obj__TT->date_uploaded.'</td>
											<td>'.$obj__TT->added_info.'</td>
											<td> <a class="btn btn-default btn-sm" href="?proceed_download&dd='.base64_encode($obj__TT->classnote_file).'"><i class="fa fa-cloud-download text-blue"></i> Download</a></td>
											</tr>';
									}
							   print '</tfoot>
							</table>
						</div>
					</div>';
				?>
			</div>		
	<!------------------------------------------------------------------------------------------------------>											
			<?php include ('classnote_Sidebar.php') ?>
                    </div><!-- ./row -->
			
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
		<!-- bootstrap time picker -->
        <script src="<?php print constant('quad_return') ?>js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
		<!-- FancyBox -->
		<script src="<?php print constant('quad_return') ?>fancybox/jquery.fancybox.js" type="text/javascript"></script>
		<script src="<?php print constant('quad_return') ?>fancybox/media_helper.js" type="text/javascript"></script>
        <!-- CK Editor -->
        <script src="<?php print constant('quad_return') ?>js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php print constant('quad_return') ?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('editor1');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
			
			//Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
        </script>

	<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>