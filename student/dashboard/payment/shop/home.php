<?php
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();	
$kas_framework->checkAuthStudent();
require (constant('quad_return').'php.files/classes/students.php');
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/student_details.php');
	
	if (isset($_GET['calculate_amount'])) {
		extract($_POST);
		$total = $pass_item_price * $value_of_qty;
		print ' Total: N'.number_format($total);
		exit;
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>School Item</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- DATA TABLES -->
		<link href="<?php print constant('quad_return') ?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
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
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
		<?php require ('../../../inc.files/header.php') ?>
	<p style="margin-top:18px">&nbsp;</p>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
			<?php require ('../../../inc.files/sidebar.php') ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><i class="fa fa-shopping-cart text-red"></i> School Item<?php $student->display_accessLevel(); ?></h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="../../"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="click_ult"><a href="../"><i class="fa fa-tags"></i>Payments</a></li>
						<li class="active"><i class="fa fa-shopping-cart"></i> Shop</li>
                    </ol>
                </section>

                <!-- Main content -->
               <section class="content">
				<?php //$student->authConfirm($useradmitStatus); ?>
					<?php if (isset($_GET['click']) and isset($_GET['selected']) and isset($_GET['ref'])) {
						$decodeURL = $kas_framework->unsaltifyID($_GET['selected']);
						$queryF = "SELECT * FROM school_item_price WHERE id = '".$decodeURL."' LIMIT 1";
							$db_handle = $dbh->prepare($queryF);
							$db_handle->execute();
							$get_rows = $db_handle->rowCount();
							$item_sel = $db_handle->fetch(PDO::FETCH_OBJ);
							$db_handle = null;							
								
								if ($get_rows == 0) {
									$kas_framework->showDangerCallout('You Just Committed an Offense that is Punishable. You Just tried Hijacking a URL. A report has been Sent for Scrutiny. This Page have been Freezed. <a href="'.$kas_framework->server_root_dir('student/dashboard/').'">Visit the DashPanel</a> or <a href="'.$kas_framework->help_url('?topic=invalid-url-parameter').'" target="new">Explanation? <a>');
										print '<center><img src="'.$kas_framework->server_root_dir('img/restricted.png').'" width="60%"/>
										<img src="'.$kas_framework->server_root_dir('img/sorry.png').'" width="50%"/></center>';
											
										require (constant('quad_return').'php.files/classes/PHPMailer/PHPMailerAutoload.php');
											require (constant('quad_return').'php.files/classes/mailing_list.php');
												$mailing_list->mailHackingReport($kas_framework->returnUserSchool(''), 'A hacking attempt was just made on the portal of the schools name which appear above.
												<br />Destination: Student Portal. <br />Location: School Schop Purchase. <br />User IP: '.$kas_framework->getUserIP().'<br />
												Student Details: Username: '.$username.' &raquo; Fullname: '.$userlastname.' '.$userfirstname.'<br />Please Respond.');
											
											exit();
								}
						
						print ' <div class="box box-success" style="box-shadow:3px 4px 20px #ccc; padding:12px" id="list_form">
								<input type="hidden" value="'.$item_sel->school_item_price.'" id="pass_item_price">
								<input type="hidden" value="'.$item_sel->tution_code_rel_id.'" id="pass_tution_code_rel_id">
								<input type="hidden" value="'.$item_sel->school_item_quantity_left.'" id="qty_left_for_item">
								<input type="hidden" value="'.$decodeURL.'" id="pass_item_id">
									<aside style="font-size:17px"><div class="box-body pad table-responsive">
										<i class="fa fa-shopping-cart text-red"></i> "'.$item_sel->school_item_name.'"
										at N'.number_format($item_sel->school_item_price).'. Quantity: <select name="qty" id="qty">';
										for ($sel=0; $sel<=$item_sel->school_item_quantity_left; $sel++) {
											print '<option>'.$sel.'</option>';
										}
								print '</select>
								<span id="final_pay_button_span" style="margin:0 0 0 10px; display:none"><a href="#" id="final_pay_button" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Purchase</a></span>
									<span id="jquery_get_total"></span></div></aside>
									<div id="final_all_Result"></div>
								</div>';
						} 
						print $student->showAvailableBalance($student_balance, $student_balance_date_last_used);?>
			<div class="row">
			  <div class="col-md-12">
			  <!------->
					<div class="box box-primary" id="list_form">
						<div class="box-body pad table-responsive">
							<table id="example1" class="table table-bordered">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Category</th>
										<th>Name</th>
										<th>Description</th>
										<th>Price</th>
										<th>Qty Left</th>
										<th>Buy?</th>
									</tr>
								</thead>
								<tbody>
								<?php  
								$shopQ = "SELECT * FROM school_item_price WHERE status = '1' ORDER BY tution_code_rel_id";
								$db_shopX = $dbh->prepare($shopQ);
								$db_shopX->execute();
								$get_rows = $db_shopX->rowCount();
								
								$sn = 0;
								while ($shopObjX = $db_shopX->fetch(PDO::FETCH_OBJ)) {
								$sn = $sn + 1;
									print '<tr>
											<td>'.$sn.'</td>
											<td>'.$kas_framework->getValue('tuition_codes_desc', 'tuition_codes', 'tuition_codes_id', $shopObjX->tution_code_rel_id).'</td>
											<td>'.$shopObjX->school_item_name.'</td>
											<td>'.$shopObjX->school_item_desc.'</td>
											<td><span style="text-decoration:line-through">N</span>'.number_format($shopObjX->school_item_price).'</td>
											<td>'.$shopObjX->school_item_quantity_left.'</td>
											<td>
											<a href="?click='.$kas_framework->generateRandomString(20).'&selected='.$kas_framework->saltifyID($shopObjX->id).'&ref='.$kas_framework->generateRandomString(20).'" class="btn btn-success click_ult">
											<i class="fa fa-check"></i> Select</a></td>
										</tr>';
									
								}
								$db_shopX = null;
								?>
								</tbody>
							</table>
							
						  </div>	
					</div>
				<!------->
			</div>  
				
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
		<!-- DATA TABES SCRIPT -->
		<script src="<?php print constant('quad_return') ?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
		<script src="<?php print constant('quad_return') ?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
			$(function() {  $("#example1").dataTable(); });
			
			$('#qty').change(function() {
			$('#final_pay_button_span').hide();
				value_of_qty = $(this).val();
				pass_item_price = $('#pass_item_price').val();
				if (value_of_qty == '0') {
					$('#final_pay_button_span').hide();
					$('#jquery_get_total').html('');
				} else {
					$('#final_pay_button_span').fadeIn(3000);
					$.post('?calculate_amount', {pass_item_price:pass_item_price, value_of_qty:value_of_qty}, function(fdata){
						$('#jquery_get_total').html(fdata);
					})
				}
				
			})
			
			$('#final_pay_button').click(function(e){
				$(this).attr('disabled', 'disabled')
				
				$('#final_all_Result').html('<?php $kas_framework->loading_h('center'); ?>');
				byepass = '098767543SDVBYgnhhbihoPO';
				qty = $('#qty').val();
				pass_item_price = $('#pass_item_price').val();
				pass_tution_code_rel_id = $('#pass_tution_code_rel_id').val();
				pass_item_id = $('#pass_item_id').val();
				quantity_purchased = $('#qty').val();
				qty_left_for_item = $('#qty_left_for_item').val();
				$.post('shop_processing', {byepass:byepass, qty_left_for_item:qty_left_for_item, pass_item_id:pass_item_id, quantity_purchased:quantity_purchased, qty:qty, pass_item_price:pass_item_price, pass_tution_code_rel_id:pass_tution_code_rel_id}, function(fdata){
					$('#final_all_Result').html(fdata);
				})
			})
			
		</script>
		<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>