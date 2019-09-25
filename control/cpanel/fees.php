<?php
define("feespage", true);
define("handletitle", true);// collects the tittle of this page and use it as site title when we are on this page
define("MYSCHOOLAPPADMIN_CORE", true);// dont alow user acess her child pages without it being included in this page


(file_exists('../php.files/classes/pdoDB.php'))? include ('../php.files/classes/pdoDB.php'): include ('../../php.files/classes/pdoDB.php');
(file_exists('../php.files/classes/kas-framework.php'))? include ('../php.files/classes/kas-framework.php'): include ('../../php.files/classes/kas-framework.php');

// Include configuration file
include('tools/config.php');// custom config to get variables
$page_title = "School Fees Manager";
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
<script>

$(document).ready(function(){
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
	 
	 <a id="console"></a>
		<div id='actiontitle' align='left' style="margin-left:10px"><h2>General School Fees Management</h2></div>
									
</div><!-- ending div for replace -->	
<!-- import external page -->
								
<?php include("tools/get_fees_url.php")?>
	<title><?php echo $title?></title>

  <div id='myhomepagecontent' align='center'></div>
			</div>
		</div>
	
	<div class="row-fluid sortable">
			
		<?php //include('div_admin/information.php')?>
		<?php //include('div_admin/activities.php')?>
		<?php //include('div_admin/traffic.php')?>

		</div><!--/row-->
		<div class="row-fluid sortable">
		
	</div><!--/row-->

<?php include('div_general/my_footer.php'); ?>

