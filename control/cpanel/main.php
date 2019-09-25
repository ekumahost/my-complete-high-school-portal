<?php

define("mainpage", true);
define("handletitle", true);// collects the tittle of this page and use it as site title when we are on this page
define("MYSCHOOLAPPADMIN_CORE", true);// dont alow user acess her child pages without it being included in this page
if($_GET['page'] == 'view_users' || $_GET['page'] == 'view_staff' || $_GET['page'] == 'view_parents'){

define('view_users', true);

}

include_once('../../php.files/classes/pdoDB.php');// custom config to get variables
include_once('../../php.files/classes/kas-framework.php');// custom config to get variables
// Include configuration file
include_once('tools/config.php');// custom config to get variables


$page_title = "User Manager";

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
<!-- include meta -->
<?php include('div_general/meta.php')?>
<!-- include my head, but check who is logded in in my head -->
<?php include('div_general/my_head.php')?>
<?php include('db_selector.php');?>
<script>

$(document).ready(function(){

 <?php //include("HTTPAJAXadminMAIN.js");?>

 <?php include("FANCYBOX.js");?>
});
</script>

<div class="container-fluid">
<div class="row-fluid">
<?php include("div_admin/left_bar.php")?>
<?php include("tools/no_script.php")?>
<div id="content" class="span10">
<!-- content starts -->
<?php include('div_admin/bread_crumb.php')?>
<?php //include('div_admin/summary.php')?>
<?php if(!defined('view_users')){ ?>
<div class="row-fluid">
  <div class="box span12">
    <div class="box-header well"> <a id="mainsetting"> </a>
      <h2><i class="icon-info-sign"></i><?php echo _SCHOOL_NAME;?></h2>
      </div>
    <?php } ?>

    <!-- ending div for replace -->
    <!-- import external page -->
    <?php include("tools/get_main_url.php")?>
    <title><?php echo $title?></title>
    <div id='myhomepagecontent' align='center'></div>
    <?php if(!defined('view_users')){ ?>
  </div>

</div>
<!--/row-->
<?php } ?>
<?php include('div_general/my_footer.php'); ?>
