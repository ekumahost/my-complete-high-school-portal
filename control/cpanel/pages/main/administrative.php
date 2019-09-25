<?php 
$title="Administrative Config";


if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}

include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";

$current_year = $_SESSION['CurrentYear'];


if(isset($_GET['tool'])){
// use switch for several tools

if($_GET['tool'] =="gtd"){
	define("GTD", true);
	} else if($_GET['tool'] =="calendar"){
		define("CALENDAR", true);
	} else if($_GET['tool'] =="rooms"){
		define("ROOMS", true);
	} else if($_GET['tool'] =="class"){
		define("CLASS", true);
	} else{
		define("GTD", true);
	}
}

?>
<center><p style="font-weight:800px; margin:10px 0 6px 0; font-size:15px; font-variant:small-caps">Select Settings (Adminstrative Configurations):</p><b><h4> 
&nbsp;&nbsp; <a href="main?page=administrative&tool=gtd"> <button type="submit" class="btn btn-primary btn-large">Grade Term Days </button> </a>  
&nbsp;&nbsp; <a href="main?page=administrative&tool=calendar"><button type="submit" class="btn btn-primary btn-large">School Calendar</button>  </a> 
&nbsp;&nbsp; <a href="main?page=administrative&tool=rooms"> <button type="submit" class="btn btn-primary btn-large">Class Rooms</button> </a></h4></b>
</center>
<br />
<?php if(defined("GTD")){// grade term days is defined?>
<?php include('admin_tools_gtd.php');?>

<?php }// grade term days ends?>


<?php if(defined("CALENDAR")){// calender?>
<?php include('admin_tools_calendar.php');?>

<?php }// calender?>

<?php if(defined("ROOMS")){// calender?>
<?php include('admin_tools_rooms.php');?>

<?php }// calender?>
<?php if(defined("CLASS")){// calender?>
<?php include('admin_tools_class.php');?>

<?php }// calender?>
<p>&nbsp;</p>
