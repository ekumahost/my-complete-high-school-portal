<?php
define("MYSCHOOLAPPADMIN_CORE", true);// dont alow user acess her child pages without it being included in this page
// cretae a public funcion page to handle alot of things
//include('security/fake.php');// we define DIRECT PASS, 

// remember to do crone jobs

// Include configuration file
include ('../../php.files/classes/pdoDB.php');
include ('../../php.files/classes/kas-framework.php');
include('tools/config.php');


$page_title = "Dashboard";

$title = $page_title.": "._SCHOOL_NAME;
include_once "../includes/configuration.php";

//Check if admin is logged in
session_start();

if(!isset($_SESSION['UserID']) || (time() - $_SESSION['LAST_ACTIVITY'] > $timeouting)) // 700 seconds we log him out 

  {
    header ("Location: ../index.php?action=notauth");
	exit;		
}
?>
<!-- include meta -->
<?php include('div_general/meta.php'); ?>
<!-- include my head, but check who is logded in in my head -->
<?php include('div_general/my_head.php'); ?>
<!-- gather some variables from db-->
<?php include('db_selector.php');?>
<!-- LETS PLAY ALL THE HTTP REQUEST FOR LOADING PAGES HERE -->
<script>

$(document).ready(function(){

 <?php include("HTTPAJAXindex.js");?>

 <?php include("FANCYBOX.js");?>
});
</script>
<!-- THIS THING DOWN HERE IS VERY IMPORTANT, HELPS TO BRING CURSOR TO AJAXIFIED PAGE PLACEMENT --->

<a name="admin-left-bar-click-ajax?do=click&autho=yes" id="aadmin-left-bar-click-ajax?do=click&autho=yes"></a>
<div class="container-fluid">
<div class="row-fluid">
<?php include("div_admin/left_bar.php")?>
<?php include("tools/no_script.php")?>
<div id="content" class="span10">
<!-- content starts -->
<?php include('div_admin/bread_crumb.php')?>
<?php include('div_admin/summary.php')?> 
<div id="changer">
  <div id ="changerbody">
    <div class="row-fluid">
      <div class="box span12">
        <div class="box-header well">
          <h2><i class="icon-info-sign"></i><?php echo _SCHOOL_NAME;?></h2>
          <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <?php include('div_admin/welcome.php')?>
        <div id='myhomepage'>
          <!-- DIV TO BE REPLACED --->
          <div id='myhomepagecontent' align='center'></div>
        </div>
      </div>
    </div>
    <!-- ending div for replace -->
  </div>
  <!-- changer body ends --->
  <!-- import external page when we pass link in url -->
</div>
<!-- changer ends --->
<div class="row-fluid sortable">
  <?php include('div_admin/information.php')?>
  <?php include('div_admin/activities.php')?>
  <?php include('div_admin/traffic.php')?>
</div>

<?php include ('div_admin/ultimate_all_modules.php') ?>

<?php include('div_general/my_footer.php'); ?>
