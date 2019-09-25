<?php 
	require ('../../../php.files/classes/pdoDB.php');
	require ('../../../php.files/classes/kas-framework.php');
		$kas_framework->safesession();
		$kas_framework->checkAuthStudent();
	require (constant('tripple_return').'php.files/classes/generalVariables.php');
	require (constant('tripple_return').'php.files/student_details.php');
	require (constant('tripple_return').'php.files/classes/students.php');		
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Library | My Record</title>
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
                    <h1><i class="fa fa-desktop"></i> Library | My Record <?php $student->display_accessLevel(); ?> </h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="../"><i class="fa fa-dashboard"></i>Dashboard</a></li>
						<li class="click_ult"><a href="../library/"><i class="fa fa-desktop"></i>Library</a></li>
                        <li class="active"><i class="fa fa-desktop"></i>&nbsp;&nbsp;my Record</li>
                    </ol>
                </section>

				  <!-- Main content -->
				<section class="content">
		<center><p style="font-size:15px; margin:0 0 12px 8px; width:80%"> 
			<a href="../library/"><button class="btn btn-default btn-block">
				<i class="fa fa-arrow-left"></i> Back to the Library? </button></a></p></center>				
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All Books I have Borrowed</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Session</th>
                                                <th>Book Borrowed</th>
                                                <th>Date Out</th>
                                                <th>Date In</th>
                                                <th>Short Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
												 $library = "SELECT * FROM media_history WHERE media_history_borrower_type = 'std'
													AND media_history_borrower = '".$student_id_original."'
													AND media_history_school = '".$userschool."'										
													ORDER by media_history_id DESC";
													$db_library = $dbh->prepare($library);
													$db_library->execute();
													
													
													$sn = 0;
													while ($librarybooks = $db_library->fetch(PDO::FETCH_OBJ)) {
														$sn = $sn + 1;
														$datein = ($librarybooks->media_history_datedue == '')? 'Still in my Custody': $librarybooks->media_history_datedue;
														print '<tr>
																<td>'.$sn.'</td>
																<td>'.$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $librarybooks->media_history_year).'</td>
																<td>'.$kas_framework->getValue('media_codes_desc', 'media_codes', 'media_codes_id', $librarybooks->media_history_code).'</td>
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
        <!-- page script -->
        <script type="text/javascript">
            $(function() {  $("#example1").dataTable(); });
        </script>
		<?php include (constant('tripple_return').'/inc.files/fixedfooter.php') ?>
    </body>
</html>