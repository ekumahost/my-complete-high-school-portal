<?php
//Include general functions
include_once "../../../php.files/classes/kas-framework.php";
//Include global functions
include_once "../../includes/common.php";
// config
include_once "../../includes/configuration.php";

//Check if admin is logged in
session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
  {
    header ("Location: ../index.php?action=notauth");
	exit;
}

$current_year=$_SESSION['CurrentYear'];
$year=$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $current_year);
$nextyear=$current_year+1;
$next_year=$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $nextyear);
$myterm=$kas_framework->getValue('fieschool_years_descld', 'school_years', 'school_years_id', $nextyear); // we have not selected term from db
$cterm=$kas_framework->getValue('grade_terms_desc', 'grade_terms', 'current', '1');

?><br />
<div style="margin-left:20px">
<p style="font-variant:small-caps; font-size:16px">CURRENT TERM = <?php echo $cterm; ?>:<?php echo $year; ?></p>

<div align="center">
 <a href="fancyadmin/admin_terms.php" style="margin:10px 0" class="fancybox fancybox.iframe btn btn-default btn-sm">Reload School Term Using Fancy Box Frame</a><br />
   
   <div align="center"><iframe align="middle" style="border:thin; min-width:360px; max-width:800px; width:100%;" src="fancyadmin/admin_terms.php" height="550"> </iframe></div>
</div>