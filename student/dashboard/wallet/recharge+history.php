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
        <title>Recharge History</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('tripple_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('tripple_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('tripple_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?php print constant('tripple_return') ?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
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
                    <h1><i class="fa fa-list"></i> Recharge History <?php $student->display_accessLevel(); ?></h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
						 <li class="click_ult"><a href="<?php print constant('single_return') ?>wallet/"><i class="fa fa-briefcase"></i> Wallet</a></li>
						<li class="active"><i class="fa fa-list"></i> History</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				<?php print $student->showAvailableBalance($student_balance, $student_balance_date_last_used);
				?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Your Recharge History</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Amount</th>
                                                <th>Recharge Type</th>
												<th>Recharged By</th>
												<th>Term</th>
												<th>Grade</th>
                                                <th>Date Recharged</th>
											 </tr>
                                        </thead>
                                        <tbody>
										<?php  
											$receipt = "SELECT * FROM payment_recharge_receipts 
													WHERE tution_recharge_by_user_id = '".$student_id_original."' ORDER BY tuition_history_id DESC";
													$db_receipt = $dbh->prepare($receipt);
													$db_receipt->execute();
											
											$sn = 0;
											while ($receipt_det = $db_receipt->fetch(PDO::FETCH_OBJ)) {
											$sn = $sn + 1;
												print '<tr>
														<td>'.$sn.'</td>
														<td><span style="text-decoration:line-through">N</span>'.number_format($receipt_det->tution_amount_recharged).'</td>
														<td>'.$receipt_det->recharge_means.'</td>
														<td>'.$receipt_det->tution_recharge_by_std_par.'</td>
														<td>'.$kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $receipt_det->tution_recharge_terms).'</td>
														<td>'.$kas_framework->getValue('grades_desc', 'grades', 'grades_id', $receipt_det->tution_recharge_grade).'</td>
														<td>'.$receipt_det->tution_recharge_date.'</td>
														</tr>';
											}
											$db_receipt = NULL;
										?>
                                        </tfoot>
									</table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
         <script src="<?php print constant('tripple_return') ?>myjs/jquery.min.js"></script>
		<!---- my javascript controller -->
        <script src="<?php print constant('tripple_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('tripple_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?php print constant('tripple_return') ?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php print constant('tripple_return') ?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php print constant('tripple_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- page script -->
        <script type="text/javascript">
            $(function() {  $("#example1").dataTable(); });
        </script>
<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>