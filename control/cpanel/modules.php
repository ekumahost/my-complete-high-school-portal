<?php

define("modulepage", true);
define("handletitle", true);// collects the tittle of this page and use it as site title when we are on this page
define("MYSCHOOLAPPADMIN_CORE", true);// dont alow user acess her child pages without it being included in this page

include_once('../../php.files/classes/pdoDB.php');// custom config to get variables
include_once('../../php.files/classes/kas-framework.php');// custom config to get variables
// Include configuration file
include('tools/config.php');// custom config to get variables


$page_title = "Modules";

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

			
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-info-sign"></i><?php echo _SCHOOL_NAME;?></h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						</div>
					</div>
	 <div id='myhomepage'> <!-- DIV TO BE REPLACED --->
		<div id='actiontitle' align='left' style="margin-left:10px"><h2>
		<?php 
		$headertitle = @$_GET['controller'];
		
switch ($headertitle) {
	case "admission":
	echo 'Admission Module';
	break;

	case "prospectus":
	echo 'Prospective Students';
	break;
	case "admission_sett":
	echo 'Admission Module: Settings/Call for Admission Application';
	break;

	case "hostels":
	echo 'Hostels manager';
	break;
	
	case "spy":
	echo 'See what students do online';
	break;
	
	 case "install":
	echo 'Installations';
	break;
	
	 case "wallet":
	echo 'Student Wallet';
	break;
	
	case "payments":
	echo 'General Payments Collected on-line.';
	break;
	
	case "duty":
	print 'Staff Duty Roaster  <a href="?controller=duty&action=add_new" style="margin:5px 20px 0 0" class="btn btn-sm pull-right">Add New Duty</a>';
	  
	break;
	
	case "academicAdviser":
	print 'Academic Adviser Assigner';
	break;
	
	default:
	echo "Modules/Extensions";
		}
		?>
		
</h2></div>

	
<div id="Content">
</div>
									
</div><!-- ending div for replace -->	
<!-- import external page -->
								
<?php include("tools/get_modules_url.php")?>
	<title><?php echo $title?></title>
	<div id='myhomepagecontent' align='center'></div>
			</div>
			</div>
	<div class="row-fluid sortable">
	</div><!--/row-->
			<div class="row-fluid sortable">
			
			</div><!--/row-->

<?php include('div_general/my_footer.php'); ?>