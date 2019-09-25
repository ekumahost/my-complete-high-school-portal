<?php 
	require ('../../../../php.files/classes/pdoDB.php');
	require ('../../../../php.files/classes/kas-framework.php');
		$kas_framework->safesession();
		$kas_framework->checkAuthStaff();
		require (constant('quad_return').'php.files/classes/generalVariables.php');
		
		require (constant('quad_return').'php.files/staff_details.php');
		require (constant('quad_return').'php.files/classes/staff.php');
		require (constant('quad_return').'php.files/classes/generalVariables.php');
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Class Note</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('quad_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('quad_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?php print constant('quad_return') ?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('quad_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.<?php print constant('quad_return') ?>js/1.3.0/respond.min.js"></script>
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
                    <h1>
                        <i class="fa fa-ticket text-maroon"></i> Class Note
                    </h1>
                    <ol class="breadcrumb">
                        <li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
						<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-th-large"></i>Academic Tools</a></li>
                        <li class="active"><i class="fa fa-ticket"></i>&nbsp;&nbsp;Classnote</li>
                    </ol>
                </section>
			<?php 	
				
				/* making sure that there is no get variable in the url for the deducing of parameters passed to the table */
				$dyn_grade_year = (isset($_POST['school_years']))? $_POST['school_years'] :  $current_year_id;
				$dyn_grade_history_term = (isset($_POST['grade_terms']))? $_POST['grade_terms'] :  $currentTerm_id;
				
				$sequencGradeClass = ($teacher_grade_class != 0)? $teacher_grade_class : '';
				$dyn_grade = (isset($_POST['grade']))? $_POST['grade'] :  $sequencGradeClass;
				
				/* making sure that there is no get variable in the url for the deducing of parameters passed to the table and beyond */ 
				
			?>				
				<!-- Main content -->
			<section class="content">
				<?php $staff->checkBasicPlan(); ?>
					<div class="row">
                       <div class="col-md-9">
							<div class="box">
							<div class="box-header">
                                    <h3 class="box-title">Upload Class Note</h3>                                    
                             </div>
							  <form action="add_classnote_processor" method="post" id="form_ID" enctype="multipart/form-data">
								<div class="modal-body">
								<div class="form-group">
									<label for="name"><font color="red">*</font> Class Note Name </label>
									<input type="text" required="required" class="form-control" name="name" value="<?php print @$_POST['name'] ?>" placeholder="Name of the Class Note. Eg. Year 10 Lesson 1">
								</div>
								<div class="form-group">
									<label for="subject"><font color="red">*</font> Subject</label> 
									<select name="subject" required="required" class="form-control"><option value="<?php print $kas_framework->getValue('grade_subject_id', 'grade_subjects', 'grade_subject_id', @$_POST['subject']) ?>"> 
									<?php print $kas_framework->getValue('grade_subject_desc', 'grade_subjects', 'grade_subject_id', @$_POST['subject']) ?></option>
									<?php $kas_framework->getallFieldinDropdownOption('grade_subjects', 'grade_subject_desc', 'grade_subject_id')  ?>
									</select>
								</div>
								<div class="form-group">
									<label for="grade"><font color="red">*</font> Grade</label>
									<select name="grade" required="required" class="form-control"><option value="<?php print $kas_framework->getValue('grades_id', 'grades', 'grades_id', @$_POST['grade']) ?>">
									<?php print $kas_framework->getValue('grades_desc', 'grades', 'grades_id', @$_POST['grade']) ?></option>
									<?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id')  ?>
									</select>
								</div>
								<div class="form-group">
									<label for="added_nfo"> Added Information </label>
									<input type="text" class="form-control" name="added_nfo" value="<?php print @$_POST['added_nfo'] ?>" placeholder="Any added information on the class note">
								</div>
								<div class="form-group">     
									<label for="InputFile">File input <font color="red">(Max: 10MB) </font></label>	<br />									
									<div class="btn btn-success btn-file">
										<i class="fa fa-paperclip"></i>  File
										<input type="file" name="file" class="ult_attach_file" id="InputFile" />
									</div> <span class="ult_attach_span"> </span>
								</div>
								
								<div class="box-footer" style="margin:0 0 20px 0">
								<input type="hidden" name="byepass" value="jJYR54wvfUIU9NU76g5V432ASe" />
										<button type="submit" name="add_cw" id="add_cw" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add Class Note</button>
								   </div>
								</div>
							</form>
							<div id="message_div" style="margin:0 0 12px 0"></div>
                          </div>
                        </div> 
						<?php include ('classnote_Sidebar.php') ?>	
				</div>
			</section><!-- /.content -->
			</aside><!-- /.right-side -->
		</div><!-- /.col -->


        <!-- jQuery 2.0.2 -->
         <script src="<?php print constant('quad_return') ?>myjs/jquery.min.js"></script>
		<!---- my javascript controller -->
        <script src="<?php print constant('quad_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
        <script src="<?php print constant('quad_return') ?>myjs/keliv_fourth_degree_uploader.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('quad_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?php print constant('quad_return') ?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php print constant('quad_return') ?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php print constant('quad_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>
<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>