<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/staff_details.php');
require (constant('tripple_return').'php.files/classes/staff.php');	
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Receipts</title>
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
		<!-- Bootsrap -->
        <link href="<?php print constant('tripple_return') ?>fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />

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
                        <i class="fa fa-money text-ult_custom5"></i> View Receipts
                    </h1>
                    <ol class="breadcrumb">
						<li><a href="<?php print constant('single_return') ?>" class="click_ult"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="active"><i class="fa fa-money"></i>&nbsp;&nbsp;Receipts</li>
                    </ol>
                </section>
				
			<!-- Main content -->
             <section class="content">
				 <style type="text/css">
				 <?php $staff->checkBasicPlan(); ?>
					select { padding:5px; } 
				</style>
			<?php
				if ($staff_receipt == '0') {
					print ($kas_framework->showDangerCallout('You dont Have the Priviledge to manage the School Shop. Tell the Admin to grant you the Priviledge. 
					<br />	<a href="'.$kas_framework->server_root_dir('staff/dashpanel/').'">Visit the DashPanel?</a>'));
					print '<center><img src="'.$kas_framework->server_root_dir('img/restricted.png').'" width="60%"/>
					<img src="'.$kas_framework->server_root_dir('img/sorry.png').'" width="50%"/></center>';
				} else {
			?>
				
			<div class="row">
			
			<div class="col-md-3 no-print">
				<div class="box">
					<a class="btn bg-blue text-white click_ult" style="margin:8px 12px" href="manageShop"> <i class="fa fa-shopping-cart"></i> Manage Shop</a>
					</div>	
			</div>	

			<div class="col-md-9 no-print"">
				<div class="box">
					<?php  $kas_framework->showWarningCallout('Please do not refresh this page after loading for the First time for efficiency.'); ?>
                </div>	
			</div>
			
					<div class="col-xs-12 no-print">
						<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">View all Receipts and Payments made.</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body">
								<form role="form" action="" method="post" id="search_receipt_form">
                                  <label for="school_years">Session: </label>
									<select name="school_years"> <option value="%%">All</option>
									<?php $kas_framework->getDistinctField('payment_receipts', 'tution_paid_sch_years', 'tuition_history_id', '%%', 'school_years', 'school_years_desc', 'school_years_id', $current_year_id) ?>
								</select>
								
								<label for="school_years">Grade: </label>
									<select name="school_grade"> <option value="%%">All</option>
									<?php $kas_framework->getDistinctField('payment_receipts', 'tution_paid_grade', 'tuition_history_id', '%%', 'grades', 'grades_desc', 'grades_id') ?>
								</select>
								
								<label for="school_years">Term: </label>
									<select name="school_term"> <option value="%%">All</option>
									<?php $kas_framework->getDistinctField('payment_receipts', 'tution_paid_terms', 'tuition_history_id', '%%', 'grade_terms', 'grade_terms_desc', 'grade_terms_id', $currentTerm_id) ?>
								</select>
								
								<label for="school_years">Type: </label>
									<select name="receipt_type"  title="Select the Receipt type"> <option value="%%">All</option>
									<?php $kas_framework->getDistinctField('payment_receipts', 'tution_paid_type', 'tuition_history_id', '%%', 'tuition_codes', 'tuition_codes_desc', 'tuition_codes_id') ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
								
								<button type="submit" class="btn btn-primary" title="Search"><i class="fa fa-search"></i></button>
								</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
						
						<div id="search_Result_div"></div>
						
                    </div>
					<?php } ?>
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
		<!-- FancyBox -->
		<script src="<?php print constant('tripple_return') ?>fancybox/jquery.fancybox.js" type="text/javascript"></script>
		<script src="<?php print constant('tripple_return') ?>fancybox/media_helper.js" type="text/javascript"></script>
        <!-- page script -->
        <script type="text/javascript">
           $('#search_receipt_form').submit(function(e){
				$('#search_Result_div').html('<?php $kas_framework->loading_h('center'); ?>');
				var mydata = $('#search_receipt_form :input').serializeArray();
				$.post('receipt_search', mydata , function(data) {
					$('#search_Result_div').html(data);	
				});
				return false;
			})
        </script>
    </body>
</html>