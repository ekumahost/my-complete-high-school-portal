<?php
//*
// admin_speak.php
// Admin Section
// Display and Manage Speaking Hours Table
//*
//Version 1 2007-04-26 Helmut
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
//Include paging class
include_once "../../../includes/ez_results.php";
// config
include_once "../../../includes/configuration.php";
$msgFormErr = "";

//Get current year
$cyear=$_SESSION['CurrentYear'];
$year=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$cyear");

//Get list of school names
$sSQL="SELECT * FROM school_names ORDER BY school_names_id";
$schoolnames=$db->get_results($sSQL);
//get list of days
$sSQL="SELECT * FROM tbl_days ORDER BY days_id";
$days=$db->get_results($sSQL);
//get list of teachers
$sSQL="SELECT * FROM teachers ORDER BY teachers_id";
$teachers=$db->get_results($sSQL);

//Check what we have to do
$action=get_param("action");
$sort=get_param("sort");
$id=get_param("id");
$teacherid=get_param("teacherid");
$day=get_param("day");
$period=get_param("period");

if (!strlen($action))
	$action="none";
//Add or Remove speaking hours according to admin choice
switch ($action){
	case "remove":
		$sSQL="DELETE FROM speak WHERE speak_id='$id'";
		$db->query($sSQL);
		break;
	case "add":
		//Check for duplicates
		$sSQL="SELECT COUNT(*) FROM speak WHERE speak_teacherid='$teacherid'";
		$tot=$db->get_var($sSQL);
		if($tot>0){
			$msgFormErr=_ADMIN_SPEAK_DUP;
			}else{
		$sSQL="INSERT INTO speak (speak_teacherid, speak_day, speak_period) 
		VALUES ('$teacherid', '$day', '$period')"; 
		$db->query($sSQL);
		};
		break;
	case "edit":
		$sSQL="SELECT COUNT(*) FROM speak WHERE speak_teacherid='$teacherid'";
		$tot=$db->get_var($sSQL);
		if($tot>0){
			$msgFormErr=_ADMIN_SPEAK_DUP;
			}else{
		$sSQL="SELECT * FROM speak WHERE speak_id='$id'";
		$editspeak = $db->get_row($sSQL);
		};
		break;
	case "update":
		$sSQL="UPDATE speak SET speak_teacherid='$teacherid', speak_day='$day', speak_period='$period' 
		       WHERE speak_id='$id'";
		$db->query($sSQL);
		break;

};


//Set paging appearence
$pSQL = "SELECT speak_id, days_desc, speak_period, teachers_fname, teachers_lname, speak_teacherid 
FROM ((speak 
INNER JOIN teachers ON teachers_id = speak_teacherid) 
INNER JOIN tbl_days ON days_id = speak_day) ";
switch ($sort) {
case "teacher":
	$order = "teachers_lname, speak_day, speak_period";
	break;
case "day":
	$order = "speak_day, speak_period, teachers_lname";
	break;
case "period":
	$order = "speak_period, speak_day, teachers_lname";
	break;
default:
	$order = "teachers_lname, speak_day, speak_period";
}
$pSQL .= "ORDER BY " . $order;
$ezr->query_mysql($pSQL);
$ezr->results_open = "<table width=80% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_heading = "<tr class=tblhead>
<td width=20%><a href=\"admin_speak.php?sort=name\">" . _ADMIN_SPEAK_TEACHER . "</a></td>
<td width=20%><a href=\"admin_speak.php?sort=day\">" . _ADMIN_SPEAK_DAY . "</a></td>
<td width=20%><a href=\"admin_speak.php?sort=period\">" . _ADMIN_SPEAK_PERIOD . "</a></td>
<td width=20%>&nbsp;</td>
<td width=20%>&nbsp;</td>
</tr>";
$ezr->results_row = "<tr>
<td class=paging width=20%>COL5 COL4</td>
<td class=paging width=20% align=center>COL2</td>
<td class=paging width=20% align=center>COL3</td>
<td class=paging width=20% align=center>
  <a href=admin_speak.php?action=edit&id=COL1 class=aform>&nbsp;" . _ADMIN_SPEAK_EDIT . "</a></td>
<td class=paging width=20% align=center>
  <a name=href_remove href=# onclick=cnfremove(COL1); class=aform>&nbsp;" . _ADMIN_SPEAK_REMOVE . "</a></td>
</tr>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>

<SCRIPT language="JavaScript">
/* Javascript function to submit form and check if field is empty */
function submitform(fldName)
{
  var f = document.forms[1];
  var t = f.elements[fldName]; 
  if (t.value!="") 
    f.submit();
  else
    alert("<?php echo _ENTER_VALUE?>");
}
/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
	var answer;	
	answer = window.confirm("<?php echo _ADMIN_SPEAK_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_speak.php?action=remove&id=" + id;
		window.location = url; // other browsers
		href_remove.href = url; // explorer 
	}
	return false;
}

</SCRIPT>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/logo.png" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%" align="right"><?php echo _ADMIN_SPEAK_ADMIN_AREA?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_SPEAK_TITLE?></h1>
	<br>
	<?php
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addspeak" method="post" action="admin_speak.php">
		<p class="pform"><?php echo _ADMIN_SUBJECTS_ADD_NEW?><br>
		<table border="0" cellpadding="0" cellspacing="5"><tr>
		<td><?php echo _ADMIN_SPEAK_DAY?>:</td>
		<td class="tdinput">
        	  <select name="day">
        	  <?php //Display teachers from table
        	  foreach($days as $day){
        	  ?>
        	    <option value="<?php echo $day->days_id; ?>">
		    <?php echo $day->days_desc ?></option>
		  <?php }; ?>
        	  </select>
		</td>
		<td>&nbsp;<?php echo _ADMIN_SPEAK_PERIOD?>:</td>
		<td class="tdinput">
		  <select name="period">
		  <?php for ($i=1; $i<=10; $i++) { ?>
		    <option value="<?php echo $i; ?>">
		    <?php echo $i; ?>
		  <?php }; ?>
		  </select>
		</td>
		<td>&nbsp;<?php echo _ADMIN_SPEAK_TEACHER?>:</td>
		<td class="tdinput">
        	  <select name="teacherid">
        	  <?php //Display teachers from table
        	  foreach($teachers as $teach){
        	  ?>
        	    <option value="<?php echo $teach->teachers_id; ?>" <?php
		    if ($teach->teachers_id==@$teachers->teacherid){echo
		    "selected=selected";};?>><?php echo $teach->teachers_fname . " " . $teach->teachers_lname; ?></option>
		  <?php }; ?>
        	  </select>
		</td>
		<td>
		  &nbsp;<input type=submit value="<?php echo _ADMIN_SPEAK_ADD?>">
		</td>
		</tr></table>
		<input type="hidden" name="action" value="add">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		</p>
		</form>
	<?php
	}else{
	?>
	<br>

        <form name="editspeak" method="post" action="admin_speak.php">
	<p class="pform"><?php echo _ADMIN_SPEAK_UPDATE_SUBJECT?><br>
	<table border="0" cellpadding="0" cellspacing="5"><tr>
	<td><?php echo _ADMIN_SPEAK_DAY?>:</td>
	<td class="tdinput">
	  <select name="day">
	  <?php //Display teachers from table
	  foreach($days as $day){
	  ?>
	    <option value="<?php echo $day->days_id; ?>"
	    <?php if ($day->days_id==$editspeak->speak_day){echo
	    "selected=selected";};?>><?php echo $day->days_desc ?></option>
	  <?php }; ?>
	  </select>
        </td>
        <td>&nbsp;<?php echo _ADMIN_SPEAK_PERIOD?>:</td>
        <td class="tdinput">
	  <select name="period">
	  <?php for ($i=1; $i<=10; $i++) { ?>
            <option value="<?php echo $i; ?>" <?php
	    if ($i==$editspeak->speak_period) {echo
	    "selected=selected";};?>>
            <?php echo $i; ?>
          <?php }; ?>
          </select>
        </td>
        <td>&nbsp;<?php echo _ADMIN_SPEAK_TEACHER?>:</td>
        <td class="tdinput">
          <select name="teacherid">
          <?php //Display teachers from table
          foreach($teachers as $teach){
          ?>
            <option value="<?php echo $teach->teachers_id; ?>" <?php
            if ($teach->teachers_id==$editspeak->speak_teacherid){echo
            "selected=selected";};?>><?php echo $teach->teachers_fname . " " . $teach->teachers_lname; 
?></option>
          <?php }; ?>
          </select>
        </td>
        <td>
	  &nbsp;<input type=submit value="<?php echo _ADMIN_SPEAK_UPDATE?>">
        </td>
        </tr></table>
        <input type="hidden" name="action" value="update">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
        </p>
        </form>
	<?php
	};
	?>
	<h3><?php echo $msgFormErr; ?></h3>
</div>
<?php //include "admin_menu.inc.php"; ?>
</body>

</html>
