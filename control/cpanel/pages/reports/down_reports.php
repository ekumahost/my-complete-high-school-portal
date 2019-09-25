<?php

/**********************************************/
/*				Coded by Chinello
/**********************************************/
// Last edit 11-24-2014, removed Report Cards.  they are now a separate 
// link on the main menu.

//Include global functions
include_once "../../../includes/common.php";
//Initiate database functions
include_once "../../../includes/ez_sql.php";
//Include paging class
include_once "../../../includes/ez_results.php";
// config
include_once "../../../includes/configuration.php";

$report = get_param("report");
$sort1 = get_param("sort1");
$sort2 = get_param("sort2");
// echo "sort1=$sort1";
// echo "sort2=$sort2";

session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
{
	header ("Location: index.php?action=notauth");
	exit;
}

if ($sort1) {
	if ($_POST['report'] == 'discipline' || $_POST['report'] == 'attendance') {
		header("Location: makereport.php?report_type=".$_POST['report']."&sort1=".$_POST['sort1']."&sort2=".$_POST['sort2']."&start_db_date=".$_POST['start_date']."&end_db_date=".$_POST['end_date']);
	} else {
		header("Location: makereport.php?report_type=".$_POST['report']."&sort1=".$_POST['sort1']."&sort2=".$_POST['sort2']);
	}
	exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<script language="JavaScript" src="datepicker.js"></script>
</head>
<body>

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2"><b>&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></b></font></td>
    <td width="50%" align="right"><b><?php echo _DOWN_REPORTS_ADMIN_AREA?></b></td>
  </tr>
</table>
</div>

<div id="Content">
<h1><?php echo _DOWN_REPORTS_TITLE?></h1>
<br>
<form name="report_selection" method="POST" action="<?php echo($_SERVER['PHP_SELF']);?>">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr class="trform">
<td width="100%">
<select name="report" onChange="javascript: changeReport()">
<option value="students" selected="selected"><?php echo _DOWN_REPORTS_STUDENTS?></option>
<option value="attendance"><?php echo _DOWN_REPORTS_ATTENDANCE?></option>
<option value="discipline"><?php echo _DOWN_REPORTS_DISCIPLINE?></option>
<!-- <option value="grades"><?php echo _DOWN_REPORTS_GRADES?></option> -->
</select>
<?php echo _DOWN_REPORTS_SORTED?>
<select name="sort1">
<option value="school_names_desc"><?php echo _DOWN_REPORTS_SCHOOL?></option>
<option value="grades_id"><?php echo _DOWN_REPORTS_GRADES?></option>
<option value="studentbio_ethnicity"><?php echo _DOWN_REPORTS_ETH?></option>
<option value="studentbio_gender"><?php echo _DOWN_REPORTS_GENDER?></option>
<option value="studentbio_bus"><?php echo _DOWN_REPORTS_ROUTE?></option>
<option value="studentbio_homeroom"><?php echo _DOWN_REPORTS_HOME?></option>
</select>
<?php echo _DOWN_REPORTS_BY?>
<select name="sort2">
<option value="none"><?php echo _ADMIN_REPORTS_NONE?></option>
<option value="school_names_desc"><?php echo _DOWN_REPORTS_SCHOOL?></option>
<option value="grades_id"><?php echo _DOWN_REPORTS_GRADES?></option>
<option value="studentbio_ethnicity"><?php echo _DOWN_REPORTS_ETH?></option>
<option value="studentbio_gender"><?php echo _DOWN_REPORTS_GENDER?></option>
<option value="studentbio_bus"><?php echo _DOWN_REPORTS_ROUTE?></option>
<option value="studentbio_homeroom"><?php echo _DOWN_REPORTS_HOME?></option>
</select>
</td>
</tr>
<tr class="trform"><td><?php echo _DOWN_REPORTS_FROM?><input type="text" size=10 name="start_date" READONLY onclick="javascript:show_calendar('report_selection.start_date');"><a href="javascript:show_calendar('report_selection.start_date');"><img src="cal.gif" border="0" class="imma"></a> 

<?php echo _DOWN_REPORTS_TO?><input type="text" size=10 name="end_date" READONLY onclick="javascript:show_calendar('report_selection.end_date');"><a href="javascript:show_calendar('report_selection.end_date');"><img src="cal.gif" border="0" class="imma"></a>

</td></tr><tr>
<td width="100%" align="left"><input type="submit" name="submit" value="<?php echo _DOWN_REPORTS_DOWNLOAD?>" class="frmbut">
</td></tr>
</table>
</form>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
</div>
<?php //include "admin_menu.inc.php"; ?>
</body>

</html>
