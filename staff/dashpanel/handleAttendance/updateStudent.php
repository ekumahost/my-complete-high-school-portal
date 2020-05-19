<?php 
	require ('../../../php.files/classes/pdoDB.php');
	require ('../../../php.files/classes/kas-framework.php');
	$kas_framework->safesession();
	$kas_framework->checkAuthStaff();
	require (constant('tripple_return').'php.files/classes/generalVariables.php');
	require (constant('tripple_return').'php.files/staff_details.php');
	require (constant('tripple_return').'php.files/classes/staff.php');
	
	require (constant('tripple_return').'php.files/classes/attendance.php');	
		/* making sure that a student is selected */
		if (!isset($_GET['click']) or !isset($_GET['stdid']) or !isset($_GET['ref'])) {
			$redirect = ($web_users_type == 'T')? $kas_framework->url_root('staff/dashpanel/myStudents/?myStudents'): $kas_framework->url_root('staff/dashpanel/handleAttendance/');
			print '<script type="text/javascript">self.location = "'.$redirect.'" </script>';
		}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Manage Attendance</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
	<!-- iCheck for checkboxes and radio inputs -->
	<link href="<?php print constant('tripple_return') ?>css/iCheck/all.css" rel="stylesheet" type="text/css" />
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
				   <i class="fa fa-list-alt text-yellow"></i> Manage Attendance 
				</h1>
				<ol class="breadcrumb">
                       <li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                        <li class="click_ult"><a href="../handleAttendance"><i class="fa fa-ellipsis-h"></i>Attendance</a></li>
						<li class="active"><i class="fa fa-user"></i>&nbsp;&nbsp;Student</li>
                    </ol>
			</section>
			
			<!-- Main content -->
			<section class="content">
			<?php $staff->checkBasicPlan(); ?>
			<?php
				if ($staff_discipline == '0' and $web_users_type != 'T') {
					exit($kas_framework->showDangerCallout('You dont Have the Priviledge to Manage the The Discipline of the Students. Tell the Admin to grant you the Priviledge'));
				} else {
					$decodeStdID = $kas_framework->unsaltifyID($_GET['stdid']);
					$getStdDetails = "SELECT * FROM studentbio, student_grade_year WHERE studentbio.studentbio_id = '".$decodeStdID."' AND studentbio.studentbio_id = student_grade_year.student_grade_year_student";
					$db_getStdDetails = $dbh->prepare($getStdDetails);
					$db_getStdDetails->execute();
					$get_getStdDetails_rows = $db_getStdDetails->rowCount();				
					$studentObj = $db_getStdDetails->fetch(PDO::FETCH_OBJ);
					$db_getStdDetails = null;
					if ($get_getStdDetails_rows == 0) {
							$kas_framework->showDangerCallout('You Just Committed an Offense that is Punishable. You Just tried Hijacking a URL. A report has been Sent for Scrutiny. This Page have been Freezed. <a href="'.$kas_framework->url_root('staff/dashpanel/').'">Visit the DashPanel</a> or <a href="'.$kas_framework->help_url('?topic=invalid-url-parameter').'" target="new">Explanation? <a>');
								print '<center><img src="'.$kas_framework->url_root('img/restricted.png').'" width="60%"/>
								<img src="'.$kas_framework->url_root('img/sorry.png').'" width="50%"/></center>';
							
						require (constant('tripple_return').'php.files/classes/PHPMailer/PHPMailerAutoload.php');
							require (constant('tripple_return').'php.files/classes/mailing_list.php');
								$mailing_list->mailHackingReport($kas_framework->returnUserSchool(''), 'A hacking attempt was just made on the portal of the schools name which appear above.
								<br />Destination: Staff Portal. <br />Location: Update Students Attendance. <br />User IP: '.$kas_framework->getUserIP().'<br />
								Staff Details: Username: '.$username.' &raquo; Fullname: '.$staff_firstname.' '.$staff_lastname.'<br />Severity: High. <br />Please Respond.');
									exit();
						}
				}
				
			if ($staff_discipline == '1') {
			print '<a href="../handleAttendance/"><button class="btn bg-ash btn-flat margin">
						<i class="fa fa-chevron-left"></i> Back to Discipline Students List</button> </a>';
			}  else {
			print '<a href="../myStudents/?myStudents"><button class="btn bg-ash btn-flat margin">
						<i class="fa fa-chevron-left"></i> Back to My Students List</button> </a>';
			}
			
			print '<a class="btn bg-red text-white click_ult margin" href="../handleHealth/updateStudent?click='.$_GET['click'].'&stdid='.$_GET['stdid'].'&ref='.$_GET['ref'].'"> <i class="fa fa-plus-square"></i> Manage Health</a>';
			print '<a class="btn bg-maroon text-white click_ult margin" href="../handleDiscipline/updateStudent?click='.$_GET['click'].'&stdid='.$_GET['stdid'].'&ref='.$_GET['ref'].'"> <i class="fa fa-smile-o"></i> Manage Discipline</a>';
			
			?>
			
				<div class="row">
					<!-- left column -->
					<div class="col-md-7">
					<!-- Input addon -->
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Add an Attendance History</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form role="form" action="#studentDisciplineTable" method="post" id="update_attendance">
							<div class="box-body">
							<div class="form-group">
										<label for="att_code"><font color="red">*</font> Why did Child Miss School?</label>
										<select name="att_code" required="required" class="form-control">
										<option></option>
										<?php $kas_framework->getallFieldinDropdownOption('attendance_codes', 'attendance_codes_desc', 'attendance_codes_id') ?>
										</select>
								</div> 
								<div class="form-group"> 
									<label><font color="red">*</font> Short Note</label> 
									<textarea class="form-control" required="required" rows="3" name="note" placeholder="Give a Short Note on this"></textarea> 
									<input type="hidden" name="student" value="<?php print $decodeStdID ?>">
									<input type="hidden" name="student_school" value="<?php print $studentObj->studentbio_school ?>">
									<input type="hidden" name="year" value="<?php print $kas_framework->getValue('current_year', 'tbl_config', 'id', '1'); ?>">
									<input type="hidden" name="date_submitted" value="<?php print date('d/m/Y') ?>">
									<input type="hidden" name="who_submitted" value="<?php print $web_users_relid ?>">
									<input type="hidden" name="term" value="<?php print $kas_framework->getValue('grade_terms_id', 'grade_terms', 'current', '1'); ?>">
									<input type="hidden" name="grade" value="<?php print $kas_framework->getValue('student_grade_year_grade', 'student_grade_year', 'student_grade_year_student', $decodeStdID); ?>">
									<input type="hidden" name="byepass" value="GYYH3v5erB89YU98YyurvSrgtftr534">
								 </div> 
							</div><!-- /.box-body  getallFieldinDropdownOption($table, $field) -->

							<div class="box-footer">
								<button type="submit" class="btn btn-primary">Update Attendance Record</button>
							</div>
							<center><span id="message_for_updateAttendance"></span></center>
						</form>
					</div><!-- /.box -->
						<?php $std_id = $decodeStdID;
						include (constant('tripple_return').'inc.files/student_attendance_report.php') ?>
                   </div><!--/.col (left) -->
					<!-- right column -->
					<?php $__dontcareStudentID = $decodeStdID;
						include (constant('double_return').'inc.files/studentDetailsPane.php'); ?>
				</div>   <!-- /.row -->
			<?php include (constant('tripple_return').'inc.files/student_attendance_catalogue.php') ?>
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
	<!-- jQuery Knob -->
    <script src="<?php print constant('tripple_return') ?>js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
	<!-- jQuery Knob -->
	<script src="<?php print constant('tripple_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>	
	<!-- InputMask -->
	<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
	<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
	<script src="<?php print constant('tripple_return') ?>js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script type="text/javascript">

	/*update bank information info*/
	$('#update_attendance').submit(function(e) {
	$('.btn-primary').attr('disabled', 'disabled');
        $('#message_for_updateAttendance').html('<?php $kas_framework->loading_h(); ?>');
		
		var mydata = $('#update_attendance :input').serializeArray();
		$.post('process_attendance', mydata , function(data) {
			$('#message_for_updateAttendance').html(data);	
		});
		return false;
    });
	
	 $(function() {  $("#example1").dataTable(); });
	
		$(function() {
		//Datemask dd/mm/yyyy
		$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
		//Datemask2 mm/dd/yyyy
		$("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
		//Money Euro
		$("[data-mask]").inputmask();
	});
	
		$(function() {
		/* jQueryKnob */

		$(".knob").knob({
		
			draw: function() {

				// "tron" case
				if (this.$.data('skin') == 'tron') {

					var a = this.angle(this.cv)  // Angle
							, sa = this.startAngle          // Previous start angle
							, sat = this.startAngle         // Start angle
							, ea                            // Previous end angle
							, eat = sat + a                 // End angle
							, r = true;

					this.g.lineWidth = this.lineWidth;

					this.o.cursor
							&& (sat = eat - 0.3)
							&& (eat = eat + 0.3);

				   

					this.g.beginPath();
					this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
					this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
					this.g.stroke();

					this.g.lineWidth = 3;
					this.g.beginPath();
					this.g.strokeStyle = this.o.fgColor;
					this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
					this.g.stroke();

					return false;
				}
			}
		});
		/* END JQUERY KNOB */

	});
	</script>	
</body>
</html>