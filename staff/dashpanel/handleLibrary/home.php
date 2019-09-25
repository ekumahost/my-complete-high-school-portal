<?php 
	require ('../../../php.files/classes/pdoDB.php');
	require ('../../../php.files/classes/kas-framework.php');
		$kas_framework->safesession();
		$kas_framework->checkAuthStaff();
		require (constant('tripple_return').'php.files/classes/generalVariables.php');		
		require (constant('tripple_return').'php.files/staff_details.php');
		require (constant('tripple_return').'php.files/classes/staff.php');
		require ('library_formsQ.php');
		
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>School Library</title>
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
                        <i class="fa fa-desktop"></i> School Virtual Library
                    </h1>
                    <ol class="breadcrumb">
                       <li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="active"><i class="fa fa-desktop"></i>&nbsp;&nbsp;Library</li>
                    </ol>
                </section>
				
			<!-- Main content -->
                <section class="content">
				<?php $staff->checkBasicPlan(); ?>
				<?php
				if ($staff_liberian == '0') {
					print ($kas_framework->showDangerCallout('You dont Have the Priviledge to Manage the Library. Tell the Admin to grant you the Priviledge.
				<a href="'.$kas_framework->server_root_dir('staff/dashpanel/').'">Visit the DashPanel?</a>'));
				print '<center><img src="'.$kas_framework->server_root_dir('img/restricted.png').'" width="60%"/>
					<img src="'.$kas_framework->server_root_dir('img/sorry.png').'" width="50%"/></center>';
				} else {
				?>
				
				<a href="../handleLibrary/"><button class="btn bg-ash btn-flat margin">
						<i class="fa fa-chevron-down"></i> Activate the Add Book Panel</button> </a>

				<a class="btn bg-ult_green text-white click_ult" href="manageStudent"> <i class="fa fa-user"></i> Borrowing History | Student</a>
				<a class="btn bg-green text-white click_ult" href="manageStaff"> <i class="fa fa-user"></i> Borrowing History | Staff</a>
				 
				 <div class="row">
          <?php 
		  
			if (isset($_GET['action'])) {
				/* checking if the action is to delete or edit */
					if ($_GET['action'] == 'delete') {
						$libraryForm->deleteConfirmation('');
						
					} else if ($_GET['action'] == 'edit') {
						$libraryForm->addForm('disabled=disabled');
						
						$real_book_id = $kas_framework->unsaltifyID($_GET['bookid']);
						$getValue = "SELECT * FROM media_codes WHERE media_codes_id = '".$real_book_id."'";
						$db_getValue = $dbh->prepare($getValue);
						$db_getValue->execute();
						$queryObject = $db_getValue->fetch(PDO::FETCH_OBJ);
						$db_getValue = null;
						
						$libraryForm->updateForm('', $queryObject);
					}
				/* end of discussions */
			} else {
				$libraryForm->addForm('');						
				$libraryForm->updateForm('disabled=disabled');
			}
			?>
				</div><!-- /.row -->   
				
				<div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All Books in the Library and their Catagogue</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Book Name</th>
                                                <th>Position 1</th>
                                                <th>Position 2</th>
                                                <th>Action</th>
                                                <th>Book Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
												$library = "SELECT * FROM media_codes ORDER by media_codes_id DESC";
												$db_library = $dbh->prepare($library);
												$db_library->execute();
												$sn = 0;
												while ($librarybooks = $db_library->fetch(PDO::FETCH_OBJ)) {
												$sn = $sn + 1;
													print '<tr>
															<td>'.$sn.'</td>
															<td>'.$librarybooks->media_codes_desc.'</td>
															<td>'.$librarybooks->id1.'</td>
															<td>'.$librarybooks->id2.'</td>
															<td>
																<div class="btn-group">
																	<button type="button" class="btn btn-default">Manage</button>
																	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
																		<span class="caret"></span>
																		<span class="sr-only">Toggle Dropdown</span>
																	</button>
																	<ul class="dropdown-menu" role="menu">
																		<li><a href="?action=edit&click='.$kas_framework->generateRandomString(20).'&bookid='.$kas_framework->saltifyID($librarybooks->media_codes_id).'&ref='.$kas_framework->generateRandomString(20).'"><i class="fa fa-edit text-green"></i> Edit</a></li>
																		<li><a href="?action=delete&click='.$kas_framework->generateRandomString(20).'&bookid='.$kas_framework->saltifyID($librarybooks->media_codes_id).'&ref='.$kas_framework->generateRandomString(20).'"><i class="fa fa-trash-o text-red"></i> Delete</a></li>
																	</ul>
																</div>
															</td>
															<td>A</td>
															
														</tr>';
												}
												$db_library = null;
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
			
	/* add books form */
	$('#addBooksForm').submit(function(e) {
		$('#addBook').attr('disabled', 'disabled');
        $('#message_for_addbook').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#addBooksForm :input').serializeArray();		
		$.post('library_processor?instruction=addbook', mydata, function(data) {
			$('#message_for_addbook').html(data);	
		});
		
		return false;
    });	
	
	/* update books codez */
	$('#updateBooksForm').submit(function(e) {
		$('#updateBooks').attr('disabled', 'disabled');
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