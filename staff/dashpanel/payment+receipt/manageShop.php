<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/staff_details.php');
require (constant('tripple_return').'php.files/classes/staff.php');

require ('shopForms.php');
		
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage Shop</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
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
                    <h1>
                        <i class="fa fa-shopping-cart text-ult_custom"></i> Manage School Sales
                    </h1>
                    <ol class="breadcrumb">
                       <li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="active"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Manage Sales</li>
                    </ol>
                </section>
				
			<!-- Main content -->
                <section class="content">
				<?php $staff->checkBasicPlan(); ?>
				<?php
				if ($staff_receipt == '0') {
					print ($kas_framework->showDangerCallout('You dont Have the Priviledge to manage the School Sales. Tell the Admin to grant you the Priviledge. 
					<br />	<a href="'.$kas_framework->url_root('staff/dashpanel/').'">Visit the DashPanel?</a>'));
					print '<center><img src="'.$kas_framework->url_root('img/restricted.png').'" width="60%"/>
					<img src="'.$kas_framework->url_root('img/sorry.png').'" width="50%"/></center>';
				} else {
				?>
				
		   <div class="row">
			<div class="col-md-5">
				<a class="btn bg-blue text-white click_ult" style="margin:8px 10px" href="home"> <i class="fa fa-money"></i> Payment Recipts </a>
				<a class="btn bg-blue text-white click_ult" style="margin:8px 10px" href="?act=addItem"> <i class="fa fa-plus"></i> Add Item </a>
				<a class="btn bg-blue text-white click_ult" style="margin:8px 10px" href="managelocations"> <i class="fa fa-building-o"></i> Manage Sales Locations </a>
			</div>	
			
			<div class="col-md-7">
				<?php  $kas_framework->showWarningCallout('Contents here will be displayed in the Shop.'); ?>
             </div>
          
		</div><!-- /.row -->   
				
		<div class="row">
		<?php 
			if (@$_GET['act'] == 'delete') {
				$decodeID = $kas_framework->unsaltifyID($_GET['item']);
				$myshopForms->confirmDeletion($decodeID);
			} else if (@$_GET['act'] == 'addItem') {
				($myshopForms->yes_domain_exist() == true)? $myshopForms->addItemForm(): $myshopForms->add_domain_form();
			} else if (@$_GET['act'] == 'edit') {
				$decodeID = $kas_framework->unsaltifyID($_GET['item']);
					$editLine = "SELECT * FROM school_item_price WHERE id = '".$decodeID."' LIMIT 1";
					$db_editLine = $dbh->prepare($editLine);
					$db_editLine->execute();
					$get_editLine_rows = $db_editLine->rowCount();
					$lineObject = $db_editLine->fetch(PDO::FETCH_OBJ);
					$myshopForms->editForm($lineObject);
					$db_editLine = null;
			}
		?>
				<div class="col-xs-12" id="shoptable">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">All shop Items</h3>                                    
						</div><!-- /.box-header -->
						<div class="box-body table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Category</th>
										<th>Location Name</th>
										<th>Item Name</th>
										<th>Description</th>
										<th>Price (N)</th>
										<th>Qty Left</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php  
									$shop_details = "SELECT * FROM school_item_price ORDER by id DESC";
									$db_shop_details = $dbh->prepare($shop_details);
									$db_shop_details->execute();
									
									$sn = 0;
									while ($shopDeduction = $db_shop_details->fetch(PDO::FETCH_OBJ)) {
									$sn = $sn + 1;
									$status = ($shopDeduction->status == '1')? 'Active': 'In-Active';
										print '<tr> 
												<td>'.$sn.'</td>
												<td>'.$kas_framework->getValue('tuition_codes_desc', 'tuition_codes', 'tuition_codes_id', $shopDeduction->tution_code_rel_id).'</td>
												<td>'.$kas_framework->getValue('tuition_codes_domain_name', 'tuition_codes_domain', 'tuition_codes_domain_id', $shopDeduction->tuition_codes_domain).'</td>
												<td>'.$shopDeduction->school_item_name.'</td>
												<td>'.$shopDeduction->school_item_desc.'</td>
												<td>'.$shopDeduction->school_item_price.'</td>
												<td>'.$shopDeduction->school_item_quantity_left.'</td>
												<td>'.$status.'</td>
												<td>
													<div class="btn-group">
														<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Options <i class="fa fa-angle-down"></i></button>
														<ul class="dropdown-menu" role="menu">
															<li><a href="?act=edit&click='.$kas_framework->generateRandomString(20).'&item='.$kas_framework->saltifyID($shopDeduction->id).'&ref='.$kas_framework->generateRandomString(20).'"><i class="fa fa-edit text-green"></i> Edit</a></li>
															<li><a href="?act=delete&click='.$kas_framework->generateRandomString(20).'&item='.$kas_framework->saltifyID($shopDeduction->id).'&ref='.$kas_framework->generateRandomString(20).'"><i class="fa fa-trash-o text-red"></i> Delete</a></li>
														</ul>
													</div>
												</td>
											</tr>';
									}
									$db_shop_details = null;
								?>
								</tfoot>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
		<?php  } ?>
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
	   
	   /* delete scripts */
		$('#confirm_no').click(function(e){
			$('#deleteDiv').hide();
		})
			
	
		$('#confirm_yes').click(function(e){
			$('#deleteDiv').html('<?php $kas_framework->loading_h('center'); ?>');
			passingId = $(this).attr('value');
			byepass = 'nuyE3svb90Y8r75dcrDTGFfuyt';
				$.post('shop_processing?instruction=deleteItem', {passingId:passingId, byepass:byepass}, function(data) {
				$('#deleteDiv').html(data);	
			});
				
		})

	/* update item codez */
	$('#updateItemForm').submit(function(e) {
		$('#updateItemButton').attr('disabled', 'disabled');
        $('#message_for_updateItem').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#updateItemForm :input').serializeArray();		
		$.post('shop_processing?instruction=updateItem', mydata, function(data) {
			$('#message_for_updateItem').html(data);	
		});
		
		return false;
    });
	
	
	/* add item codez */
	$('#addItemForm').submit(function(e) {
		$('#addItemButton').attr('disabled', 'disabled');	
        $('#message_for_addItem').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#addItemForm :input').serializeArray();		
		$.post('shop_processing?instruction=additem', mydata, function(data) {
			$('#message_for_addItem').html(data);	
		});
		
		return false;
    });
	
	/* add item codez */
	$('#addDomainForm').submit(function(e) {	
		$('#addDomainButton').attr('disabled', 'disabled');
        $('#message_for_addDomain').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#addDomainForm :input').serializeArray();		
		$.post('shop_processing?instruction=add_domain', mydata, function(data) {
			$('#message_for_addDomain').html(data);	
		});
		
		return false;
    });
	
        </script>
<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>