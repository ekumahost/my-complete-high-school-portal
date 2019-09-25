<?php
// Include configuration file
(file_exists('../php.files/classes/pdoDB.php'))? include ('../php.files/classes/pdoDB.php'): include ('../../php.files/classes/pdoDB.php');
(file_exists('../php.files/classes/kas-framework.php'))? include ('../php.files/classes/kas-framework.php'): include ('../../php.files/classes/kas-framework.php');
include('tools/config.php');

$page_title = "Portal Year/Term Simulator ";

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
$current_year=$_SESSION['CurrentYear'];
$end_year= $kas_framework->getValue('current_year', 'tbl_config', 'id', '1');
?>
<SCRIPT language="JavaScript">
/* Javascript function to ask confirmation before changing year */
function confirmchange(id) {
	var answer;	
	answer = window.confirm("Current year will be changed here on this session but not in student portal");
	if (answer == 1) {
		var url;
		url = "year_simulator?yearid="+ id;
		window.location = url; // other browsers
		href_remove.href = url; // explorer 
	}
	return false;
}

function confirmterm(id) {
	var answer;	
	answer = window.confirm("Current term will be changed here on this session but not in student portal or when you log out");
	if (answer == 1) {
		var url;
		url = "year_simulator?term="+ id;
		window.location = url; // other browsers
		href_remove.href = url; // explorer 
	}
	return false;
}



</SCRIPT>
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
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
    </div>
    <div id='myhomepage' style="padding:0 0 0 20px">
      <!-- DIV TO BE REPLACED --->
      <div id='actiontitle' align='left'>
        <h2>Simulate a past year or Term in the portal reporting</h2>
        <br />
      </div>
      <?php 
		// if admin want to simulate year, destroy session of current year, set a new session and alert done
		if(isset($_GET['yearid'])){
		$simuyear = $_GET['yearid'];
		unset($_SESSION['CurrentYear']);
		unset($_SESSION['CurrentTerm']);
		// set session for the new year he wish to simulate
		 set_session("CurrentYear", $simuyear);
		set_session("CurrentTerm", '1');
		$currentsimu = $_SESSION['CurrentYear'];
		$yearsimu= $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $currentsimu);
		
		echo '<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">*</button>
					<strong>You have successfully simulated '.$yearsimu.'. </strong> All activities appears as if you were in '.$yearsimu.'. 
				</div>';
		}
		
		// to simulate term
		if(isset($_GET['term'])){
		$simuterm = $_GET['term'];
		unset($_SESSION['CurrentTerm']);
		// set session for the new term he wish to simulate
		set_session("CurrentTerm", $simuterm);
		$currenttermu = $_SESSION['CurrentTerm'];
		$termsimu= $kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $currenttermu);
		echo '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">*</button>
				<strong>You have successfully simulated '.$termsimu.'!</strong> All activities appears as if you were in '.$termsimu.'. 
			</div>';
		}
?>
      <br />
      <font color="red">Notice: </font> Simulating a Year or Term does not mean you have gone back in time. </br>
      <strong> What does this Mean? </strong> This simply means that you have temporarily imitated the appearance of the year/term selected as if you were in that year/term. Logging out of the portal destroys the simulation.
      <div id="Content"> <br>
        <strong> Term Simulator</strong>:<br />
        <?php
	for ($t=1; $t<=3; $t++){
		$tterm= $kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $t);
	?>
        <a href="#" class="btn btn-large btn-primary" onclick="javascript:confirmterm(<?php echo $t;?>);"><i class="icon-chevron-left icon-white"></i><?php echo $tterm; ?></a>
        <?php
	};
	?>
        <br />
        <br />
        <br />
        <strong>Year Simulator</strong>:<br />
        <br />
        <p class="ltext"><?php echo _ADMIN_CHANGE_STUDENT_YEAR_SELECT?>:</p>
        <br>
        <div style="margin-left:70px">
          <?php
	for ($i=1; $i<=$end_year; $i++){
		$tyear=$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $i);
	?>
          <a href="#" class="btn btn-large btn-primary" onclick="javascript:confirmchange(<?php echo $i;?>);"><i class="icon-chevron-left icon-white"></i><?php echo $tyear; ?></a>
          <?php
	};
	?>
        </div>
      </div>
      <div id="Content"> </div>
    </div>
    <!-- ending div for replace -->
    <!-- import external page -->
    <?php //include("tools/get_url.php")?>
  </div>
</div>
<div class="row-fluid sortable">
  <?php include('div_admin/information.php')?>
  <?php include('div_admin/activities.php')?>
  <?php include('div_admin/traffic.php')?>
</div>
<!--/row-->
<div class="row-fluid sortable"> </div>
<!--/row-->
<?php include('div_general/my_footer.php'); ?>
