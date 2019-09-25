<?php
//Include global functions
include_once "../../includes/common.php";
// config
include_once "../../includes/configuration.php";
include_once "../../../php.files/classes/kas-framework.php";

//Check if admin is logged in
session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
  {
    header ("Location: ../index.php?action=notauth");
	exit;
}

$current_year=$_SESSION['CurrentYear'];

$year= $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $current_year); 
$nextyear = $current_year+1;
$next_year= $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $nextyear);
$myterm= $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $nextyear); // we have not selected term from db

?>
<div style="margin-left:20px"><br />

<p style="font-variant:small-caps; font-size:16px">CURRENT YEAR = <?php echo $year; ?></p>

<div align="center">
<a href="fancyadmin/admin_school_years.php" style="margin:10px 0" class="fancybox fancybox.iframe btn btn-default btn-sm">Reload School Years Using Fancy Box Frame</a><br />
 <div align="center"><iframe align="middle" style="border:thin;" src="fancyadmin/admin_school_years.php" width="90%" height="950"> </iframe></div>
<br>
<br>
<div align="center">
<br></div>
</div>