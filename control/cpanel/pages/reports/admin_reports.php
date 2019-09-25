<?php
//*
// CHECK BUTTON SELECTION AND KEEP ATTENDACE SALECTED IF ATTENDANCE LINK IS THE REF
// admin_reports.php
// Admin Section
// The start of the report section.
// Last edit 11-24-2005, removed Report Cards as an option.  They are now 
// a separate link on the main menu.
//*

//Check if admin is logged in
session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Include global functions
include_once "../../../includes/common.php";
//Initiate database functions
include_once "../../../includes/ez_sql.php";
// config
include_once "../../../includes/configuration.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>

<script language="JavaScript" src="datepicker.js"></script>
<script language="JavaScript">
//<!--
function changeReport() {
	if(document.forms.report_selection.report.value == "students") {
		document.forms.report_selection.sorted_1.disabled  = 0;
		document.forms.report_selection.sorted_1.selectedIndex = 0;
		document.forms.report_selection.sorted_2.disabled  = 0;		
		document.forms.report_selection.sorted_2.selectedIndex = 1;
		document.forms.report_selection.start_date.value = '';
		document.forms.report_selection.start_date.disabled = 1;
		document.forms.report_selection.end_date.value = '';
		document.forms.report_selection.end_date.disabled = 1;
	} else if(document.forms.report_selection.report.value == "attendance") {
		document.forms.report_selection.sorted_1.selectedIndex = 0;
		document.forms.report_selection.sorted_1.disabled  = 0;
		document.forms.report_selection.sorted_2.selectedIndex = 0;
		document.forms.report_selection.sorted_2.disabled = 0;
		document.forms.report_selection.start_date.disabled = 0;
		document.forms.report_selection.end_date.value = '';
		document.forms.report_selection.end_date.disabled = 1;
	} else if(document.forms.report_selection.report.value == "discipline") {
		document.forms.report_selection.sorted_1.selectedIndex = 0;
		document.forms.report_selection.sorted_1.disabled  = 0;
		document.forms.report_selection.sorted_2.selectedIndex = 0;
		document.forms.report_selection.sorted_2.disabled = 0;
		document.forms.report_selection.start_date.disabled = 0;
		document.forms.report_selection.end_date.disabled = 0;
	} else if(document.forms.report_selection.report.value == "grades") {
	        document.forms.report_selection.sorted_1.selectedIndex = 0;
		document.forms.report_selection.sorted_2.selectedIndex = 0;
		
	}
		
}

function displayReport() {
	var report_type = document.forms.report_selection.report.value;
	var url = "report_" + report_type + ".php?sorted_1=" + 
		document.forms.report_selection.sorted_1.value + 
		"&sorted_2=" + document.forms.report_selection.sorted_2.value + 
		"&start_date=" + document.forms.report_selection.start_date.value + 
		"&end_date=" + document.forms.report_selection.end_date.value;
	window.open(url, "report","scrollbars=yes,menubar=yes,status=no,toolbar=yes,resizable=yes");

	return false;
}
//-->
</script>

</head>
<body>
<div id="Content">
<h1><?php echo _ADMIN_REPORTS_TITLE?></h1>
<br>
<form name="report_selection" method="POST" action="<?echo($_SERVER['PHP_SELF']);?>">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr class="trform">
<td>
<select name="report" onChange="javascript: changeReport()">
<option value="students"><?php echo _ADMIN_REPORTS_STUDENTS?></option>
<option value="attendance"><?php echo _ADMIN_REPORTS_ATTENDANCE?></option>
<option value="discipline"><?php echo _ADMIN_REPORTS_DISCIPLINE?></option>
<!-- <option value="grades"><?php echo _ADMIN_REPORTS_GRADES?></option> -->
</select>
<?php echo _ADMIN_REPORTS_SORTED ?>
<select name="sorted_1" onChange="javascript: changeSorted_1()">
<option value="grades_id">Grades/Class</option>
<option value="studentbio_ethnicity"><?php echo _ADMIN_REPORTS_ETH?></option>
<option value="studentbio_gender"><?php echo _ADMIN_REPORTS_GENDER?></option>
</select>
<?php echo _ADMIN_REPORTS_BY?>
<select name="sorted_2" onChange="javascript: changeSorted_2()">
<option value="none"><?php echo _ADMIN_REPORTS_NONE?></option>
<option value="grades_id">Grades/Class</option>
<option value="studentbio_ethnicity"><?php echo _ADMIN_REPORTS_ETH?></option>
<option value="studentbio_gender"><?php echo _ADMIN_REPORTS_GENDER?></option>
</select>
</td>
</tr>
<tr class="trform"><td><?php echo _ADMIN_REPORTS_FROM?> <input type="text" size=10 name="start_date" READONLY onclick="javascript:show_calendar('report_selection.start_date');"><a href="javascript:show_calendar('report_selection.start_date');"><img src="cal.gif" border="0" class="imma"></a> 
<?php echo _ADMIN_REPORTS_TO?> <input type="text" size=10 name="end_date" READONLY onclick="javascript:show_calendar('report_selection.end_date');"><a href="javascript:show_calendar('report_selection.end_date');"><img src="cal.gif" border="0" class="imma"></a>
</td></tr>

<tr class="trform">
<td align="left"><input type="submit" name="submit" onClick="return displayReport()" style="padding:3px" value="<?php echo _ADMIN_REPORTS_DOWNLOAD?>" class="frmbut">
</td></tr>
</table>
<br /><br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />

</form>

</div>
<?php //include "admin_menu.inc.php"; ?>
</body>

</html>
