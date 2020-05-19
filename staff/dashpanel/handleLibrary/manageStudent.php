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
        <title>Library | Student</title>
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
                        <i class="fa fa-desktop"></i> Library | Student
                    </h1>
                    <ol class="breadcrumb">
                        <li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
						<li class="click_ult"><a href="<?php print constant('single_return') ?>handleLibrary/"><i class="fa fa-desktop"></i>Library</a></li>
                        <li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp;Student</li>
                    </ol>
                </section>
				
			<!-- Main content -->
                <section class="content">
				<?php $staff->checkBasicPlan();
				
					if ($staff_liberian == '0') {
						exit($kas_framework->showDangerCallout('You dont Have the Priviledge to Manage the Library. Tell the Admin to grant you the Priviledge'));
					}
				
					if (isset($_GET['create'])) {
						echo '<a href="manageStudent" class="click_hide"><button class="btn bg-ash btn-flat margin">
						<i class="fa fa-chevron-up"></i> Hide the Add Record Panel</button> </a>';
					} else {
						echo '<a href="manageStudent?create" class="click_ult"><button class="btn bg-ash btn-flat margin">
						<i class="fa fa-chevron-down"></i> Activate the Add Record Panel</button> </a>';
					}
				?>
				
				 <div class="row click_hide_div">
				  <?php 
							
					if (isset($_GET['action'])) {
						/* checking if the action is to delete or edit */
							if ($_GET['action'] == 'delete') {
								$libraryForm->deleteConfirmation('');
								
							} else if ($_GET['action'] == 'returned') {
								$bookid_row = $kas_framework->unsaltifyID($_GET['bookid']);
								$libraryForm->returnBook($bookid_row);
							}
						/* end of discussions */
					} else if (isset($_GET['create'])) {
							print '<div class="col-md-6">
									<form role="form" action="" method="post" id="addStudentRecordForm">
									<div class="box box-info">
										<div class="box-header">
											<h3 class="box-title">Add Borrower Record</h3>
										</div>
										<div class="box-body">
											<div class="form-group">
												<label>Name of Student:</label>                                         
												<select name="stdid" class="form-control"><option></option>';
												$qrun = "SELECT * FROM studentbio WHERE admit = '1'";
												$db_qrun = $dbh->prepare($qrun);
												$db_qrun->execute();
													while ($rw = $db_qrun->fetch(PDO::FETCH_OBJ)) {
														print '<option value="'.$rw->studentbio_id.'">' .$rw->studentbio_lname. ' ' .$rw->studentbio_fname. '</option>';
													}
												$db_qrun = null;
												echo '</select>
											</div>
								
											<div class="form-group">
												<label>Book Borrowed:</label> 
													<select name="book_id" required="required" class="form-control"><option></option>'; 
											$kas_framework->getallFieldinDropdownOption('media_codes', 'media_codes_desc', 'media_codes_id');
												print '</select>
											</div>

											<div class="form-group">
												<label>Date Borrowed Out:</label>                                         
												<input type="text" id="datemask" required="required" class="form-control" name="dateout" />
											</div>
											
											<div class="form-group">
												<label>Short Note</label>                                         
												<textarea class="form-control" required="required" name="note" rows="2" cols="10" placeholder="Enter a Short Note" ></textarea>
												<input type="hidden" class="form-control" name="byepass" value="hnutN4NS2dvBNU09uuGVTF" />
											</div>
										</div>
											<input type="hidden" name="school" value="'.$staff_school.'">
											<input type="hidden" name="year" value="'.$current_year_id.'">
											<input type="hidden" name="web_users_relid" value="'.$web_users_relid.'">
											<div class="box-footer">
												<button type="submit" id="addBook" class="btn btn-primary">Add Record</button>
											</div>
											<center><span id="message_for_addbook"></span></center>
										 </div></form>
										</div>';

						
						print '<div class="col-md-6">
									<form role="form" action="" method="post" id="updateBooksForm">
									<div class="box box-info">
										<div class="box-header">
											<h3 class="box-title">My Library</h3>
										</div>
										 <div class="box-body">
										 <center><img src="'.$kas_framework->url_root('img/school_library.jpg').'" width="60%" style="border:1px solid #999" </center>
										</div>
								 </div></form>
								</div>';
					}
					?>
				</div><!-- /.row -->   
				
				<div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All Borrowed Books Details</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Session</th>
                                                <th>Book Borrowed</th>
												<th>Borrowed By</th>
                                                <th>Date Out</th>
                                                <th>Date In</th>
                                                <th>Short Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
										$library = "SELECT * FROM media_history WHERE media_history_borrower_type = 'std' ORDER by media_history_id DESC";
										$db_library = $dbh->prepare($library);
										$db_library->execute();
										$sn = 0;
											while ($librarybooks = $db_library->fetch(PDO::FETCH_OBJ)) {
											$sn = $sn + 1;
											/* date in Decider for button or Date*/
											$action_butt = '<div class="btn-group">
															<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"">Action <i class="fa fa-chevron-down"></i></button>
															<ul class="dropdown-menu" role="menu">
																<li class="click_ult"><a href="?action=returned&bookid='.$kas_framework->saltifyID($librarybooks->media_history_id).'">Returned</a></li>
																<li class="click_ult"><a href="?action=delete&bookid='.$kas_framework->saltifyID($librarybooks->media_history_id).'">Delete Record</a></li>
															</ul>
														</div>';
											$datein = ($librarybooks->media_history_datedue == '')? $action_butt: $librarybooks->media_history_datedue;
											$studentfullname = $kas_framework->getValue('studentbio_lname', 'studentbio', 'studentbio_id', $librarybooks->media_history_borrower). '
															'.$kas_framework->getValue('studentbio_fname', 'studentbio', 'studentbio_id', $librarybooks->media_history_borrower);
												print '<tr>
													<td>'.$sn.'</td>
													<td>'.$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $librarybooks->media_history_year).'</td>
													<td>'.$kas_framework->getValue('media_codes_desc', 'media_codes', 'media_codes_id', $librarybooks->media_history_code).'</td>
													<td>'.$studentfullname.'</td>
													<td>'.$librarybooks->media_history_dateout.'</td>
													<td>'.$datein.'</td>	
													<td>'.$librarybooks->media_history_action.'</td>													
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
		<!-- InputMask -->
		<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
		<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
		<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>	
        <!-- page script -->
        <script type="text/javascript">
			$(function() {  $("#example1").dataTable(); });
			$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
			
					
			/* add books form */
			$('#addStudentRecordForm').submit(function(e) {
				$('#message_for_addbook').html('<?php $kas_framework->loading_h(); ?>');
				
				var mydata = $('#addStudentRecordForm :input').serializeArray();		
				$.post('borrower_processor?instruction=addrecord', mydata, function(data) {
					$('#message_for_addbook').html(data);	
				});
				
				return false;
			});	
			
			$('#confirm_no').click(function(e){
				$('#deleteAsk').hide();
			})
			
			$('#confirm_yes').click(function(e){
				$('#deleteAsk').html('<?php $kas_framework->loading('center'); ?>');
				passingId = $(this).attr('book_jq_id');
				byepass = 'nuyE3svb90Y8r75dcrDTGFfuyt';
					$.post('borrower_processor?instruction=deleteBorrowerRecord', {passingId:passingId, byepass:byepass}, function(data) {
					$('#deleteAsk').html(data);	
				});
			})
			
			$('.click_hide').on('click', function(e){
				$('.click_hide_div').slideUp();
				return false;
			})
        </script>
<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>