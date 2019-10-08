<?php
// config
include_once "../includes/configuration.php";
include ('../../php.files/classes/kas-framework.php');

// Include configuration file
include('tools/config.php');

$page_title = "Session switcher";

$title =$tintro.$page_title."--".$app_name_space;
//Include global functions
include_once "../includes/common.php";


//Check if admin is logged in
session_start();
if(!isset($_SESSION['UserID']) || (time() - $_SESSION['LAST_ACTIVITY'] > $timeouting)) // 700 seconds we log him out 
  {
    header ("Location: ../index.php?action=notauth");
	exit;
}?>


<?php
$current_year = $_SESSION['CurrentYear'];
$yea = date('d/m/Y');

@$year=$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $current_year);
$nextyear=$current_year + 1;
@$next_year=$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $nextyear);
$msgFormErr="";

// used to restore admin session when all sessions are destroyed
$user_id = $_SESSION['UserID'];
$year_name=$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $current_year);
// generate random passcode
$numbers = '0123456789';
$pnpairs= 9;
@$catchc = str_shuffle(substr($numbers, mt_rand(0, (strlen($numbers) - $pnpairs)), $pnpairs));
?>

<!-- include meta -->
<?php include('div_general/meta.php')?>
<!-- include my head, but check who is logded in in my head -->
<?php include('div_general/my_head.php')?>

<div class="container-fluid">
	<div class="row-fluid">		
	<?php include("div_admin/left_bar.php")?>

	<?php include("tools/no_script.php")?>


	<div id="content" class="span10">
	<!-- content starts -->

	<?php include('div_admin/bread_crumb.php')?>
	<?php //include('div_admin/summary.php')?>

	<div class="row-fluid">
	<div class="box span12">
		<div class="box-header well">
			<h2><i class="icon-info-sign"></i><?php echo _SCHOOL_NAME;?></h2>
			<div class="box-icon">
				<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
				<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
			</div>
		</div>
	 <div id='myhomepage'> <!-- DIV TO BE REPLACED --->
	 <br />
		<div id='actiontitle' align='left'><h3>&nbsp;School Year/Session Switch Forward </h3></div>

	<?php if(!isset($_POST['myaction'])){?>
		<p>&nbsp;<font color="#FF0000">Warning</font>: Users dont like reading instructions, this is users culture; but this one here is very important </p>
			<?php } 
			
			if(isset($_POST['myaction']) && $_POST['myaction']=="doit"){	
				//switch the year
				//Is the new year already created??  then don't create it, it will be a mess if we do!
				$tot = $kas_framework->countRestrict1('student_grade_year', 'student_grade_year_year', $next_year);
			//if the new year already exists, error out of script.

		if ($tot > 0) {
			echo'<div class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert">*</button>
					<strong>You are looking for big trouble!</strong> the year you want to switch to has already been switched to before. get help from troubleshooter. This could be caused if you switched year backwards before, which was not advices
				</div>	';	
			exit();
		};

	// check the passcode provided

	if ($_POST['passcode'] != $_POST['catchcode']) {
		
		echo'
		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Out of idea!</strong> You cannot Switch forward without doing what is required.
		</div>';	
		echo '&nbsp;&nbsp;&nbsp;<br><a href="switch_session">Let Me Try Again Now</a>';
	  exit();
	}
	
	// check if the next year is not there
	
	if($next_year== NULL){
		echo '<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Out of idea!</strong> You cannot Switch forward without doing what is required. Next year is not created yet!
		</div>	';	
		
		echo '&nbsp;&nbsp;&nbsp;<br><a href="switch_session">Ok, let me do it now</a>';
	  exit();
	}
	
// logout all users online
	//session_destroy(); // this is the only damn thing we have not implemented here
	
			
	$dbh->beginTransaction();// start our transaction

$gradesall = "SELECT * FROM grades";//
$dbh_sSQL = $dbh->prepare($gradesall); $dbh_sSQL->execute(); $gradecount = $dbh_sSQL->rowCount(); $dbh_sSQL = null;
$gradecountgraduate = $gradecount - 1;
			
// promote all the students
$create_student_grade_year = "INSERT INTO student_grade_year (student_grade_year_student, student_grade_year_year, student_grade_year_grade) SELECT 
student_grade_year_student, $nextyear AS student_grade_year_year, student_grade_year_grade+1 AS student_grade_year_grade 
FROM student_grade_year WHERE student_grade_year_year = $current_year AND student_grade_year_grade <= $gradecountgraduate";// graduates will not be promoted
$dbh_sSQL_csgy = $dbh->prepare($create_student_grade_year); $dbh_sSQL_csgy->execute(); $create_student_grade_year_mar = $dbh_sSQL_csgy->rowCount(); $dbh_sSQL_csgy = null;


//TAKE SOME GOOD MEASURES
// kill all the students logged on, just kidding, log online students off
$kill_std_sessions = "UPDATE tbl_app_config SET status='0' WHERE module= 'student_login'";
//$dbh_sSQL_kss = $dbh->prepare($sSQL); $dbh_sSQL_kss->execute(); $kill_std_sessions_mar = $dbh_sSQL_kss->rowCount(); $dbh_sSQL_kss = null;
$dbh_sSQL_kss = $dbh->prepare($kill_std_sessions); $dbh_sSQL_kss->execute(); $kill_std_sessions_mar = $dbh_sSQL_kss->rowCount(); $dbh_sSQL_kss = null;

// switch the session forward
$db_set_current_yr = "UPDATE tbl_config SET current_year='".$nextyear."' WHERE id=1";
$dbh_sSQL_fdbcur = $dbh->prepare($db_set_current_yr); $dbh_sSQL_fdbcur->execute(); $db_set_current_yr_mar = $dbh_sSQL_fdbcur->rowCount(); $dbh_sSQL_fdbcur = null;


$remove_current_term = "UPDATE grade_terms SET current='0' WHERE current='1'";
$dbh_sSQL_rct = $dbh->prepare($remove_current_term); $dbh_sSQL_rct->execute(); $remove_current_term_mar = $dbh_sSQL_rct->rowCount(); $dbh_sSQL_rct = null;

$switch_to_first_term = "UPDATE grade_terms SET current='1' WHERE grade_terms_id='1'";
$dbh_sSQL_stft = $dbh->prepare($switch_to_first_term); $dbh_sSQL_stft->execute(); $switch_to_first_term_mar = $dbh_sSQL_stft->rowCount(); $dbh_sSQL_stft = null;


// copy school fee from school fee default
$set_fees = "INSERT INTO school_fees (component,grades,grades_term,school_year,price,date,creator,active) SELECT component, grades, grades_term, $nextyear AS school_year, price, $yea AS date, creator, active FROM school_fees_default";		
$dbh_sSQL_sfees = $dbh->prepare($set_fees); $dbh_sSQL_sfees->execute(); $set_fees_mar = $dbh_sSQL_sfees->rowCount(); $dbh_sSQL_sfees = null;

	// copy teacher schedule from the old scedule to new year
$set_teacher_schedule = "INSERT INTO teacher_schedule (teacher_schedule_teacherid, teacher_schedule_year, teacher_schedule_schoolid, teacher_schedule_subjectid, teacher_schedule_termid, teacher_schedule_classperiod, teacher_schedule_days, teacher_schedule_room, teacher_schedule_type, teacher_schedule_subject_grade) SELECT teacher_schedule_teacherid, $nextyear AS teacher_schedule_year, teacher_schedule_schoolid, teacher_schedule_subjectid, teacher_schedule_termid, teacher_schedule_classperiod, teacher_schedule_days, teacher_schedule_room, teacher_schedule_type, teacher_schedule_subject_grade FROM teacher_schedule WHERE teacher_schedule_year = $current_year";
$dbh_sSQL_t = $dbh->prepare($set_teacher_schedule); $dbh_sSQL_t->execute(); $dbh_sSQL_t = null;	

// copy teacher grade year
$set_teacher_class = "INSERT INTO teacher_grade_year (teacher, session, grade_class, grade_class_room, main_teacher) SELECT teacher, $nextyear AS session, grade_class, grade_class_room, main_teacher FROM teacher_grade_year WHERE session = $current_year";
$dbh_sSQL_tc = $dbh->prepare($set_teacher_class); $dbh_sSQL_tc->execute(); $dbh_sSQL_tc = null;	

	// Left JOb
	// 1. set students in finale year to graduates(studentbio.admit SET =2)
	// look at previous year to find graduates that where not promoted $current_year
	$oldyearlist_SQL = "SELECT * FROM student_grade_year WHERE student_grade_year_year = '$current_year' AND student_grade_year_grade = '$gradecount'";
	$dbh_sSQL_olS = $dbh->prepare($oldyearlist_SQL); $dbh_sSQL_olS->execute(); $rowCount_OL = $dbh_sSQL_olS->rowCount();
	// WE HAVE THE LLIST OF THOSE IN FINALE YEAR HERE



	if($rowCount_OL != 0){
	// LOOP THEM ON AND SET STUDENTBIO.ADMIT=2
		while ($myact = $dbh_sSQL_olS->fetch(PDO::FETCH_ASSOC)) {
			$oldstudentid = $myact['student_grade_year_student'];
			$SQLite = "UPDATE studentbio SET admit = '2' WHERE studentbio_id = '$oldstudentid'";
			$dbh_sSQL = $dbh->prepare($SQLite); $dbh_sSQL->execute(); $dbh_sSQL = null;
	}
}
    $dbh_sSQL_olS = null;

// if all are transactions above are permitable without error, then we pay, else roll back our fucking money
//if($create_student_grade_year and $kill_std_sessions and $db_set_current_yr and $remove_current_term and $switch_to_first_term  and $set_fees)

if(($create_student_grade_year_mar >0) and ($kill_std_sessions_mar >0) and ($db_set_current_yr_mar >0) and ($remove_current_term_mar >0) and ($switch_to_first_term_mar >0)  and ($set_fees_mar >0))

// this permits launching the portal
//if(($db_set_current_yr_mar >0) and $kill_std_sessions and ($remove_current_term_mar >0) and ($switch_to_first_term_mar >0)  and ($set_fees_mar >0))
{
	$dbh->commit(); /// all transaction are done
	$current_t= $kas_framework->getValue('grade_terms_id', 'grade_terms', 'current', '1');// 
	set_session("CurrentYear", $nextyear);
	set_session("CurrentTerm", $current_t);
	
echo '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">*</button>
		<strong>Well done!</strong> You successfully switched the school to year '.$next_year.'
	</div>';
?>
<div style="margin-left:30px"><strong><h3>Your Success List:</h3></strong><br />
<li>1. Students Were Promoted</li>
<li>2. Default School Fee were copied from default fees  </li>
<li>3. School was moved one year ahead</li>
<li>4. All students in final year were marked as graduates</li>
<li>5. School term was set to first term</li>
<li>6. Teachers were assigned same class as their previous class in the new year</li>
<li>7. Old School Time table were copied and set as new time table</li>
<li>8. Staff above 60years were not retired</li>
<li>9. Students logged on where logged off from student portal</li>
<li>10. The Portal Cache was Cleared</li>

<br />
<div style="margin-left:10px"><strong><h3>This is a list of what you should Do next </h3></strong><br />

<li> Demote students that should not be promoted--<a href="main?page=users">Take me to students demotion </a></li>
<li>You may want to edit time table </li>
<li> You may want to edit teacher class</li>
<li> You may want to create more school years</li>
<li>Finally enable Students log on(Students can check in) <a target='_blank' href='main?page=schoolapp&tools=login#mainsetting'>Here </a> </li>
</div>
<?php

} else {
	$dbh->rollBack();
	//echo mysql_error($);
	echo '<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">*</button>
		<strong>Heads up!</strong>There was an error performing the action. Contact developer </div>';
	
	}
// bring back the admin session here
}  ?> 
							
	<div id="Header" style="margin-left:10px">
	  <p>
		<?php if(!isset($_POST['myaction'])){?>
		<br />
		<b>What you must do before switching</b><br />
		1. <a href="fees?page=default" target="_blank">Set School Fee </a> for the New Session you are switching to<br />. If the fee are the same, no need to edit.<br />
		2. Make Sure the Next Year or Session name you are Switching to is created. <br />
		Your Switching passcode is <b>"<?php echo $catchc;?>"</b> Copy it.<br /><br />
		<b>What you Must do after switching</b><br />
		1. Demote Students that need not be promoted<br />
		2. Check that Everything is Fine<br />
		3. Complete your MySchoolApp Subscription to avoid service termination.<br />
		4. Edit <a href="main?page=administrative&tool=gtd" target="_blank">Grade Term Days/Resumption dates </a>, for number of days school open for the session terms<br />
		5. Lastly the portal was set to Maintenance Mode, Please <a href="main?page=schoolapp&tools#mainsetting" target="_blank">Deactivate</a>
				    
  <?php }?>
  <br />
		<br />
	  </p>
	</div>

	<?php if(!isset($_POST['myaction'])){?>
	<div id="Content">

	<h3>&nbsp;&nbsp;<?php echo _ADMIN_CHANGE_YEAR_TITLE?></h3>
	<br>
	<b><?php if($next_year== NULL){
	echo '&nbsp;&nbsp;&nbsp;<font color="red">Warning:</font> next year is not created yet, you must create before switching over'.'Go to configuration and click school Year, add new';
	}
	?></b>
	<p class="ltext">
	<div style="margin-left:15px"><?php echo _ADMIN_CHANGE_YEAR_TEXT1?><strong><?php echo $year; ?></strong><?php echo _ADMIN_CHANGE_YEAR_TO?><strong><?php echo $next_year;?></strong> ?<br>
	<?php echo _ADMIN_CHANGE_YEAR_TEXT2?><strong><?php echo $next_year;?></strong><?php echo _ADMIN_CHANGE_YEAR_TEXT3?>
	<br>
	<?php echo _ADMIN_CHANGE_YEAR_TEXT4?></div>
	<br><br>
	<form action="" method="post"> 
	  <p>
	    <input type="hidden" name="myaction" value="doit" />
	    <input type="hidden" name="posted" value="letsgo" />
	    <input type="hidden" name="catchcode" value="<?php echo $catchc;?>" />
  &nbsp;&nbsp;&nbsp;Enter Year Switching passcode:
  <input type="text" name="passcode" value="" /> 
  <a href="#" id="whatsthis">What is this?</a> &nbsp;&nbsp;
  <input id="" type="submit" class="btn btn-primary btn-xs" value="Switch Session forward">
  </input>
	    </p>
	</form>
	
	<p>&nbsp; </p>								
	<p style="margin-left:200px;">Simulate Previous Years: <a href="year_simulator" class="btn btn-large">Take year Backward</a> </p>								
	<p>&nbsp; </p>	

</div>	<?php }?>						
																	
</div><!-- ending div for replace -->	
<!-- import external page -->
		</div>
	</div>		
<div class="row-fluid sortable">

	<?php include('div_admin/information.php')?>
	<?php include('div_admin/activities.php')?>
	<?php include('div_admin/traffic.php')?>

</div><!--/row-->
<div class="row-fluid sortable">
																	
</div><!--/row-->
<?php include('div_general/my_footer.php'); ?>

<script type="text/javascript">
	$('#whatsthis').click(function(e){
		alert('If you dont know the passcode, then you have not read the instructions on this page');
	})
</script>