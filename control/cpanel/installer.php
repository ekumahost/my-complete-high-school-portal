<?php

// Include configuration file
include('tools/config.php');


$page_title = "Portal Installer";

$title =$tintro.$page_title."--".$app_name_space;

//Include global functions
include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";

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
		<div id='actiontitle' align='left'><h3>&nbsp;HyperSchool Installer </h3></div>
<?php 

if($current_year>0){
echo '<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">*</button>
		<strong>Heads up! Out of Idea!</strong> This install process is already effected
	</div>';
echo '<li>You may want to edit time table </li>
<li> You may want to edit teacher class</li>
<li> You may want to create more school years</li>
<li> Write welcome messages for students/staff/parent, click on configuration</li>

<li>Finally enable Students log on(Students can check in) <a target="_blank" href="main?page=schoolapp&tools=login#mainsetting">here</a> </li>
<li>Lastly if the portal was set to Maintenance Mode, Please <a href="main?page=schoolapp&tools#mainsetting" target="_blank">Deactivate</a></li>';
	exit;
}
?>
		
		
<?php if(!isset($_POST['myaction'])){?>
		<p>&nbsp;<font color="#FF0000">Warning</font>: Users dont like reading instructions, this is users culture; but this one here is very important </p>
			<?php } ?>
				
				
			<?php if(isset($_POST['myaction']) && $_POST['myaction']=="doit"){	
				//switch the year
				//Is the new year already created??  then don't create it, it will be a mess if we do!
			$tot = $dbh->countRestrict1('student_grade_year', 'student_grade_year_year', $next_year);
			//if the new year already exists, error out of script.

	if ($tot > 0) {
		echo'<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">*</button>
				<strong>there is a big trouble!</strong> The installation process seems to have been run before</div>	';	
		exit();
	};

	// check the passcode provided

	if ($_POST['passcode'] != $_POST['catchcode']) {
		
		echo'
<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Out of idea!</strong> You cannot install without doing what is required.
		</div>';	
		echo '&nbsp;&nbsp;&nbsp;<br><a href="installer">Let Me Try Again Now</a>';
	  exit();
	}
	
	// check if the next year is not there
	
	if($next_year== NULL){
		echo '<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Out of idea!</strong> You cannot install without doing what is required. Next year is not created yet!
		</div>	';	
		
		echo '&nbsp;&nbsp;&nbsp;<br><a href="installer">Ok, let me do it now</a>';
	  exit();
	}
	
// logout all users online
	//session_destroy(); // this is the only damn thing we have not implemented here
	
			
$dbh->beginTransaction();
$gradesall = "SELECT * FROM grades";//
$dbh_Query1 = $dbh->prepare($gradesall);
$dbh_Query1->execute();
$gradecount = $dbh_Query1->rowCount();// this is also the final year student grade
$dbh_Query1 = null;
$gradecountgraduate = $gradecount - 1;
			
			
//TAKE SOME GOOD MEASURES

// switch the session forward
$db_set_current_yr = "UPDATE `tbl_config` SET `current_year`='".$nextyear."' WHERE `id`='1' AND `current_year`='0'";
$dbh_Query2 = $dbh->prepare($db_set_current_yr);
$dbh_Query2->execute();
$db_set_current_yr_mar = $dbh_Query2->rowCount();
$dbh_Query2 = null;


$remove_current_term = "UPDATE grade_terms SET current='0' WHERE current='1'";
$dbh_Query3 = $dbh->prepare($remove_current_term);
$dbh_Query3->execute();
$remove_current_term_mar = $dbh_Query3->rowCount();
$dbh_Query3 = null;


$switch_to_first_term = "UPDATE grade_terms SET current='1' WHERE grade_terms_id='1'";
$dbh_Query4 = $dbh->prepare($Query);
$dbh_Query4->execute();
$switch_to_first_term_mar = $dbh_Query4->rowCount();
$dbh_Query4 = null;

// copy school fee from school fee default
$set_fees = "INSERT INTO school_fees (component,grades,grades_term,school_year,price,date,creator,active) SELECT component, grades, grades_term, $nextyear AS school_year, price, $yea AS date, creator, active FROM school_fees_default";		
$dbh_Query5 = $dbh->prepare($set_fees);
$dbh_Query5->execute();
$set_fees_mar = $dbh_Query5->rowCount();
$dbh_Query5 = null;

//if(($create_student_grade_year_mar >0) and ($kill_std_sessions_mar >0) and ($db_set_current_yr_mar >0) and ($remove_current_term_mar >0) and ($switch_to_first_term_mar >0)  and ($set_fees_mar >0))
// this permits launching the portal
if(($db_set_current_yr_mar >0) and ($remove_current_term_mar >0) and ($switch_to_first_term_mar >0) and ($set_fees_mar >0))
{
	$dbh->commit(); /// all transaction are done
	$current_t= $kas_framework->getValue('grade_terms_id', 'grade_terms', 'current', '1');// 
	set_session("CurrentYear", $nextyear);
	set_session("CurrentTerm", $current_t);


echo '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">*</button>
		<strong>Well done!</strong> You successfully installed the school to year '.$next_year.'
	</div>';
?>
<div style="margin-left:30px"><strong><h3>Your Success List:</h3></strong><br />
<li>2. Default School Fee were copied from default fees  </li>
<li>3. Portal was launched </li>
<li>5. School term was set to first term</li>
<li>10. The Portal Cache was Cleared</li>

<br />
<div style="margin-left:10px"><strong><h3>This is a list of what you should Do next </h3></strong><br />

<li>You may want to edit time table </li>
<li> You may want to edit teacher class</li>
<li> You may want to create more school years</li>
<li>Finally enable Students log on(Students can check in) <a target='_blank' href='main?page=schoolapp&tools=login#mainsetting'>here</a> </li>
<li>Lastly if the portal was set to Maintenance Mode, Please <a href="main?page=schoolapp&tools#mainsetting" target="_blank">Deactivate</a></li>

</div>
<?php

} else {
	$dbh->rollBack(); 
	//echo mysql_error($);
	echo '<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">*</button>
		<strong>Heads up!</strong>There was an error performing the action. Contact Hypertera asap on 08066424512: DEBUG-- switch term to third term before installing.
	</div>';
	
	}
// bring back the admin session here
}  ?> 
				
				
				
	<div id="Header" style="margin-left:10px">
	  <p>
		<?php if(!isset($_POST['myaction'])){?>
		<br />
		<b>What you must do before Installing</b><br />
		1. <a href="fees?page=default" target="_blank">Set School Fee </a> for the New Session you are installing to<br />. If the fee are the same, no need to edit.<br />
		2. Make Sure the Next Year or Session name you are Switching to is created. <br />
		Your Installation code is <b>"<?php echo $catchc;?>"</b> Copy it, without the "quotes"<br /><br />
		<b>What you Must do after switching</b><br />
		2. Check that Everything is Fine<br />
		4. Edit <a href="main?page=administrative&tool=gtd" target="_blank">Grade Term Days/Resumption dates </a>, for number of days school open for the session terms<br />
		5. Lastly the portal was set to Maintenance Mode, Please <a href="main?page=schoolapp&tools#mainsetting" target="_blank">Deactivate</a>
				    
  <?php }?>
  <br />
				    <br />
			      </p>
	  </div>

<?php if(!isset($_POST['myaction'])){?>
<div id="Content">

	<h3>&nbsp;&nbsp;HyperSchool installer</h3>
	<br>
	<b><?php if($next_year== NULL){
	echo '&nbsp;&nbsp;&nbsp;<font color="red">Warning:</font> next year is not created yet, you must create before switching over'.'Go to configuration and click school Year, add new';
	}
	?></b>
	<p class="ltext">
	<div style="margin-left:15px">Are you sure you are ready to install HyperSchool at <?php echo $next_year;?></strong> ?<br>
	<?php echo _ADMIN_CHANGE_YEAR_TEXT2?><strong><?php echo $next_year;?></strong> 
	<br>
	<?php echo _ADMIN_CHANGE_YEAR_TEXT4?></div>
	<br><br>
	<form action="" method="post"> 
	  <p>
	    <input type="hidden" name="myaction" value="doit" />
	    <input type="hidden" name="posted" value="letsgo" />
	    <input type="hidden" name="catchcode" value="<?php echo $catchc;?>" />
  &nbsp;&nbsp;&nbsp;Enter Your Installation code:
  <input type="text" name="passcode" value="" /> 
  <a href="#" id="whatsthis">What is this?</a> &nbsp;&nbsp;
  <input id="" type="submit" class="btn btn-primary btn-xs" value="Install Asap!">
  </input>
	    </p>
	</form>
	
	
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