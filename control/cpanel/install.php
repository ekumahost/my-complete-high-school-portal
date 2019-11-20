<?php


include_once('../../php.files/classes/pdoDB.php');// custom config to get variables
include_once('../../php.files/classes/kas-framework.php');// custom config to get variables
// Include configuration file
// Include configuration file
include('tools/config.php');


$page_title = "Launch the portal";

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
$current_year = 0;
$yea = date('d/m/Y');





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
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well">
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
	 <div id='myhomepage' style="padding:20px"> <!-- DIV TO BE REPLACED --->
	 <br />
		<div id='actiontitle' align='left'>
		  <h3>&nbsp;HyperSchool Launcher (<em><font color="#FF0000">Please handle with care</font></em>) </h3>
		</div><br />
		
		Welcome, your first time using HyperSchool. At this point, student portal is shut down. You have to set up your portal configurations before you launch the portal.
		Do not worry, this might take about two hours if you have all information ready. Else you might log out and go gather them. Thou most of the work have been done by Hypertera. you need click on School fee default and see if the school fee is correct.
		<p>Optional fees are not included as school fee, school fee is constant for all students, optional fees like Transportation and Hostel are handled on their own as item that student can apply for online and pay with their wallet.
		</p>
		
	<div style="margin-left:10px"><strong>
	<h3>This is a list of what you must do serially before launching the portal </h3>
	</strong><br />

		
		
		
		<table width="100%" border="1">
  <tr>
    <td><strong>SN</strong></td>
    <td><strong>Action</strong></td>
    <td>Decision</td>
    <td><strong>Status</strong></td>
  </tr>
  <tr>
    <td>1</td>
    <td>Set the School Profile details </td>
    <td><a href="main?page=profile" target="_blank">Go now </a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>2</td>
    <td>Set School Level</td>
    <td>Under <a href="admin_configuration.php?action=edit&operator=admin&position=adminArea&user=Administrator&page=configindex&do=yes" target="_blank">Config.</a> select <span style="font-weight: bold">Grade/Class</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>3</td>
    <td>Set default School Fee(this is set every every session before switching forward)</td>
    <td><a href="fees?page=defaultfees#mainsetting" target="_blank">open</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>4</td>
    <td>Upload badge/logo </td>
    <td>Under <a href="admin_configuration.php?action=edit&operator=admin&position=adminArea&user=Administrator&page=configindex&do=yes" target="_blank">Config.</a> select <span style="font-weight: bold">School Badge </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>5</td>
    <td>Create about ten school years </td>
    <td>Under <a href="admin_configuration.php?action=edit&operator=admin&position=adminArea&user=Administrator&page=configindex&do=yes" target="_blank">Config.</a> select <span style="font-weight: bold">School Year/Session </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>6</td>
    <td>Set School Term Days /Calender/Class rooms </td>
    <td><a href="main?page=administrative&tool=gtd" target="_blank">Open</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>7</td>
    <td>Set Discussion Banned Words </td>
    <td>Under <a href="admin_configuration.php?action=edit&operator=admin&position=adminArea&user=Administrator&page=configindex&do=yes" target="_blank">Config.</a> select <span style="font-weight: bold">Banned Words </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>8</td>
    <td>Set some API </td>
    <td><a href="main?page=schoolapp&tools=api#mainsetting" target="_blank">open</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>9</td>
    <td>Complete other configurations for Hostel, </td>
    <td>open</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>10</td>
    <td>Tour the portal to learn how it works </td>
    <td><a href="main?page=schoolapp&tools=api#mainsetting" target="_blank">Start here </a></td>
    <td>&nbsp;</td>
  </tr>
</table>

<li>All these setting can be done in Configuration, Portal Control (links at the left) AND Settings Above </li>
</div>
<br />
Operation manual for admin is not published yet, admin can always tour the portal to learn how it works, and always talk to us via live chat! Meanwhile other portals like Students, staff, parent, sub admins etc do not require any operation manual.
	 </div>


				
				
			
	 <form action="installer" method="post"> 

	&nbsp;&nbsp;<input id="" type="submit" class="btn btn-primary btn-xs" value="Launch my portal">
	</input>
	
	(auto sets launch date)
	</form>
	
	
									
	
							
							
											
</div><!-- ending div for replace -->	
<!-- import external page -->
			  </div>
</div>
	
					
			
			
				  
				  
				  

<?php include('div_general/my_footer.php'); ?>

