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
        <title>Manage Locations</title>
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
                        <i class="fa fa-building-o text-ult_custom"></i> Manage Sales Location
                    </h1>
                    <ol class="breadcrumb">
                       <li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="active"><i class="fa fa-building-o"></i>&nbsp;&nbsp;Sales Location</li>
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
			<div class="col-md-6">
				<a class="btn bg-blue text-white click_ult" style="margin:8px 10px" href="home"> <i class="fa fa-money"></i> Payment Recipts </a>
				<a class="btn bg-blue text-white click_ult" style="margin:8px 10px" href="manageShop?act=addItem"> <i class="fa fa-plus"></i> Add Shop Item </a>
			</div>	
			
			<div class="col-md-6">
				<?php  //$kas_framework->showWarningCallout('Manage Sales Locations Effectively'); ?>
             </div>
          
		</div><!-- /.row -->   
				
		<div class="row">
		<?php  
			if (!isset($_GET['action'])) {
				$myshopForms->add_domain_form();
			} else if ($_GET['action'] == 'edit'){
				$decodeID = $kas_framework->unsaltifyID($_GET['code']);
					$editLine = "SELECT * FROM tuition_codes_domain WHERE tuition_codes_domain_id = '".$decodeID."' LIMIT 1";
					$db_editLine = $dbh->prepare($editLine);
					$db_editLine->execute();
					$lineObject = $db_editLine->fetch(PDO::FETCH_OBJ);
					$db_editLine = null;
						$myshopForms->edit_domain_form($lineObject);
			} else if ($_GET['action'] == 'delete') {
					$decodeID = $kas_framework->unsaltifyID($_GET['item']);
					$myshopForms->confirmDeletion($decodeID);
			}	?>
				<div class="col-xs-12" id="shoptable">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">All Sales Locations </h3>                                    
						</div><!-- /.box-header -->
						<div class="box-body table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Name</th>
										<th>Location</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php  
									$loc_details = "SELECT * FROM tuition_codes_domain ORDER by tuition_codes_domain_id DESC";
									$db_loc_details = $dbh->prepare($loc_details);
									$db_loc_details->execute();
									$sn = 0;
									while ($locDeduction = $db_loc_details->fetch(PDO::FETCH_OBJ)) {
									$sn = $sn + 1;
										print '<tr> 
												<td>'.$sn.'</td>
												<td>'.$locDeduction->tuition_codes_domain_name.'</td>
												<td>'.$locDeduction->tuition_codes_domain_location.'</td>
												<td><a href="?action=edit&code='.$kas_framework->saltifyID($locDeduction->tuition_codes_domain_id).'" class="btn btn-default"><i class="fa fa-edit text-green"></i> Edit </a>
												<a href="?action=delete&item='.$kas_framework->saltifyID($locDeduction->tuition_codes_domain_id).'" class="btn btn-default"><i class="fa fa-trash-o text-red"></i> Delete </a></td>
											</tr>';
									}
									$db_loc_details = null;
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
	
	/* update item codez */
	$('#updateDomainForm').submit(function(e) {
		$('#updateDomainButton').attr('disabled', 'disabled');
        $('#message_for_updateDomain').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#updateDomainForm :input').serializeArray();		
		$.post('shop_processing?instruction=updateDomain', mydata, function(data) {
			$('#message_for_updateDomain').html(data);	
		});
		
		return false;
    });
	
	
	$('#confirm_yes').click(function(e){
		$('#deleteDiv').html('<?php $kas_framework->loading_h('center'); ?>');
		passingId = $(this).attr('value');
		byepass = 'nuyE3svb90Y8r75dcrDTGFfuyt';
			$.post('shop_processing?instruction=deleteDomain', {passingId:passingId, byepass:byepass}, function(data) {
			$('#deleteDiv').html(data);	
		});	
	})
	
	$('#confirm_no').click(function(e){
		$('#deleteDiv').hide();
	})
</script>
<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>