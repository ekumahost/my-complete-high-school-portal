<?php 
	require ('../../../php.files/classes/pdoDB.php');
	require ('../../../php.files/classes/kas-framework.php');
		$kas_framework->safesession();
		$kas_framework->checkAuthStaff();
		require (constant('tripple_return').'php.files/classes/generalVariables.php');
		require (constant('tripple_return').'php.files/staff_details.php');
		require (constant('tripple_return').'php.files/classes/staff.php');
		
		require (constant('double_return').'inc.files/handleFixedFormat.php');
		
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage Health</title>
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
                        <i class="fa fa-plus-square text-red"></i> Manage Students Health
                    </h1>
                    <ol class="breadcrumb">
                        <li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="active"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Health</li>
                    </ol>
                </section>
				
			<!-- Main content -->
                <section class="content">
				<?php $staff->checkBasicPlan(); ?>
				<?php
				if ($staff_health == '0') {
					print ($kas_framework->showDangerCallout('You dont Have the Priviledge to Manage the The Health of all the Students. Tell the Admin to grant you the Priviledge.
					<a href="'.$kas_framework->url_root('staff/dashpanel/').'">Visit the DashPanel?</a>'));
					print '<center><img src="'.$kas_framework->url_root('img/restricted.png').'" width="60%"/>
					<img src="'.$kas_framework->url_root('img/sorry.png').'" width="50%"/></center>';
				} else {
				?>
				 
					<div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All Students (Health Issues <i class="fa fa-plus-square text-red"></i>)</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                       <thead>
                                            <tr>
                                                <th>Admission No</th>
                                                <th>Fullname</th>
                                                <th>Other Details</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
												/*
													$no_of_display = 50;
													$page = @$_GET['stream']; $page = ($page == '')? '0' : $page;												
													if ($page < 0) { exit; } 
												*/
												
												$parameter = "SELECT * FROM studentbio WHERE studentbio_school = '".$staff_school."' AND admit = '1'";
												$db_parameter = $dbh->prepare($parameter);
												$db_parameter->execute();
												//$countAll_Returned = $db_parameter->rowCount();
												/*
													$total_page = ceil($countAll_Returned / $no_of_display);
													$total_page = ($total_page === 0)? '1': $total_page; $current_page = $page + 1; 
													$next_determiner = ($page + 1) * $no_of_display; $startLimit = $page * $no_of_display;
													
													$parameter .= " LIMIT ".$startLimit.", ".$no_of_display."";
													$db_parameterX = $dbh->prepare($parameter);
													$db_parameterX->execute();
													
													// pass "db_parameterX" to the $viewStdList->viewStdList
												
												*/
													$viewStdList->viewStdList($db_parameter);	
													$db_parameter = null;										
											?>
										</tbody>
									</table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
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
            $(function() {  $("#example1").dataTable(); });
			
	/* add books form */
	$('#addBook').click(function(e) {
        $('#message_for_addbook').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#addBooksForm :input').serializeArray();		
		$.post('library_processor?instruction=addbook', mydata, function(data) {
			$('#message_for_addbook').html(data);	
		});
		
		return false;
    });	
	
	/* update books codez */
	$('#updateBooks').click(function(e) {
        $('#message_for_updatebook').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#updateBooksForm :input').serializeArray();		
		$.post('library_processor?instruction=updateBooks', mydata, function(data) {
			$('#message_for_updatebook').html(data);	
		});
		
		return false;
    });
	
	$('#confirm_no').click(function(e){
		$('#deleteAsk').hide();
	})
	
	$('#confirm_yes').click(function(e){
		$('#deleteAsk').html('<?php $kas_framework->loading_h('center'); ?>');
		passingId = $(this).attr('book_jq_id');
		byepass = 'nuyE3svb90Y8r75dcrDTGFfuyt';
			$.post('library_processor?instruction=deleteBook', {passingId:passingId, byepass:byepass}, function(data) {
			$('#deleteAsk').html(data);	
		});
			
	})
        </script>
<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>