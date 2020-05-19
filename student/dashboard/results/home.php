<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('tripple_return').'php.files/classes/students.php');
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/student_details.php');		
 
if (isset($_GET['getYearForSession'])) {
	extract($_POST);
	print 'Session of Result: <select name="session">';
		//getDistinctField($table1, $field1, $priKeyField1, $priKeyValue1, $table2, $field2, $priKeyField2, $matchField=false)
		$kas_framework->getDistinctField('grade_history_primary', 'year', 'level_taken', $gradeVal, 'school_years', 'school_years_desc', 'school_years_id', $current_year_id);
	print '</select>'; 
exit;
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Result</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('tripple_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('tripple_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('tripple_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
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
	<style type="text/css">
		select { padding:6px; } 
	</style>
        <!-- header logo: style can be found in header.less -->
		<?php require (constant('double_return').'inc.files/header.php') ?>
	<p style="margin-top:18px" class="no-print">&nbsp;</p>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
	<?php require (constant('double_return').'inc.files/sidebar.php') ?>
		<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><i class="fa fa-list-alt text-ult_custom4"></i> Results <?php $student->display_accessLevel(); ?></h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="active"><i class="fa fa-book"></i>&nbsp;&nbsp;View Results</li>
                    </ol>
                </section>

                <!-- Main content -->
               <section class="content">
				<?php //$student->authConfirm($useradmitStatus); 
					if ($kas_framework->app_config_setting('student_result_checking') == false) {
						$kas_framework->showDangerCallout('<center> Sorry! You cannot check your result at the moment. There are some operations going on here that are harmful to your data. Please check later!. </center>'); 
						print '<center><img src="'.$kas_framework->url_root('img/restricted.png').'" width="60%"/>
						<img src="'.$kas_framework->url_root('img/sorry.png').'" width="50%"/></center>';
					} else { ?>
				 
					<div class="row no-print">
                        <div class="col-md-12">
                            <div class="box box-primary">
							<div class="box-header">
                                    <h3 class="box-title">Select a Result to View: </h3>
                                </div>
                                <div class="box-body pad table-responsive">
                                <form action="#load_result_div" method="post" id="view_result_form"> 
									<span id="generateSession"></span>
								   Class of Result: <select name="grade_taken" id="grade_taken">
								   <option></option>
								   <?php $kas_framework->getDistinctField('grade_history_primary', 'level_taken', 'student', $userid, 'grades', 'grades_desc', 'grades_id', $user_student_grade_year_grade_id) ?>
										</select>  &nbsp;&nbsp;
								   Term: <select name="grade_terms" id="grade_terms">
								   <option></option>
									<?php $kas_framework->getDistinctField('grade_history_primary', 'quarter', 'student', $userid, 'grade_terms', 'grade_terms_desc', 'grade_terms_id', $dyn_grade_history_term) ?>
                                        <option value="cumulative">Cumulative Result</option>
                                    </select>
								<input type="hidden" name="byepass" value="u644x2w465545trviUB89UYt" />
								<input type="hidden" name="__doncareStudentID" value="<?php print $userid; ?>" />
							<button type="submit" class="btn btn-default btn-flat" name="proceed_button">View Result</button>
								</form>
								</div>
							</div>
                        </div><!-- /.col -->
                    </div><!-- ./row -->
					
					
					<?php  } /* end checking if the student result if available */?>
				</section><!-- /.content -->
				<div id="load_result_div"> </div>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- jQuery 2.0.2 -->
        <script src="../../../myjs/jquery.min.js"></script>
		<!---- my javascript controller -->
        <script src="../../../myjs/feccukcontroller.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../js/AdminLTE/app.js" type="text/javascript"></script>
		<script type="text/javascript">
			$('#view_result_form').on('submit', function(e){
				$('#load_result_div').html('<?php $kas_framework->loading_h('center'); ?>').show();
				var mydata = $('#view_result_form :input').serializeArray();
                //grade_terms
                term_selector = $('#grade_terms').val();
                if (term_selector == "cumulative") {
                    //get the cumulative for the session.. this is sensitive
                    $.post('cumulative_view_result', mydata, function (fdata) {
                        $('#load_result_div').html(fdata)
                    })
                } else {
                    //produce the terms result for the student
                    $.post('view_result', mydata, function (fdata) {
                        $('#load_result_div').html(fdata)
                    })
                }
				return false;
			})
			
			gradeVal = $('#grade_taken').val();
			
			$('#grade_taken').change(function() {
				gradeVal = $(this).val();
				deduceYearsFromGrade(gradeVal);
			})
			
			deduceYearsFromGrade(gradeVal); // run the deduce year function
			
			function deduceYearsFromGrade(gradeVal) {
				if (gradeVal == '') {
				//hero = gradeVal;
					$('#generateSession').html('<font color="red">Please Select a Class &nbsp; &nbsp;</font>');
				} else {
					$.post('?getYearForSession', {gradeVal:gradeVal}, function(data){
						$('#generateSession').html(data);
					})
				}
			}
		</script>
    </body>
</html>