<?php

 $title ="Config";
 // config
include_once "../../includes/configuration.php";
//Include paging class
include_once "../../../php.files/classes/kas-framework.php";
include('meta.php');

//Check if Admin
session_start();
require ('check_admin_session.php');

//Include global functions
include_once "../../includes/common.php";
include_once "../../includes/ez_sql.php";
include_once "../../includes/ez_results.php";
$msgFormErr="";

//Check what we have to do
$action=get_param("action");

if (!strlen($action))
	$action="none";
//Add or Remove Health Codes according to user choice
switch ($action){
	case "remove":
		$health_codes_id=get_param("id");
		if($norem = $kas_framework->getValue('health_history_code', 'health_history', 'health_history_code', $health_codes_id)){
			$msgFormErr=_HEALTH_CODES_NOT_REMOVED;
		}else{
			$sSQL="DELETE FROM health_codes WHERE health_codes_id='". $health_codes_id ."'";
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "add":
		$health_codes_desc=get_param("healthname");
		//Check for duplicates
		$tot = $kas_framework->countRestrict1('health_codes', 'health_codes_desc', $health_codes_desc);
		if($tot>0){
			$msgFormErr=_HEALTH_CODES_DUP;
		}else{
			$sSQL="INSERT INTO health_codes (health_codes_desc) VALUES (".tosql($health_codes_desc, "Text").")"; 
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "edit":
		$health_codes_id=get_param("id");
		$health_codes_desc = $kas_framework->getValue('health_codes_desc', 'health_codes', 'health_codes_id', $health_codes_id);
		break;
	case "update":
		$health_codes_id=get_param("id");
		$health_codes_desc=get_param("healthname");
		$sSQL="UPDATE health_codes SET health_codes_desc='$health_codes_desc' WHERE health_codes_id='". $health_codes_id ."'";
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		break;

};


//Set paging appearence
$ezr->results_open = "<table width='65%' cellpadding=2 cellspacing=0 border=1 class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class='paging'>COL2</td>
<td class='paging'><a href=health_codes.php?action=edit&id=COL1 class='aform btn btn-default btn-sm'>&nbsp;" . _HEALTH_CODES_EDIT . "</a>
<a name=href_remove href=# onclick=cnfremove(COL1); class='aform btn btn-danger btn-sm'>&nbsp;" . _HEALTH_CODES_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT health_codes_id, health_codes_desc FROM health_codes ORDER BY health_codes_desc");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<SCRIPT language="JavaScript">
/* Javascript function to submit form and check if field is empty */
function submitform(fldName)
{
  var f = document.forms[0];
  var t = f.elements[fldName]; 
  if (t.value!="") 
    f.submit();
  else
    alert("<?php echo _ENTER_VALUE?>");
}
/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
	var answer;	
	answer = window.confirm("<?php echo _HEALTH_CODES_SURE?>");
	if (answer == 1) {
		var url;
		url = "health_codes.php?action=remove&id=" + id;
		window.location = url; // other browsers
		href_remove.href = url; // explorer 
	}
	return false;
}

</SCRIPT>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body>
<div id="Content" class="mycontent">
	<h1><?php echo _HEALTH_CODES_TITLE?></h1>
	<br>
	<?php
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addattendance" method="post" action="health_codes.php">						
		  <p class="pform"><?php echo _HEALTH_CODES_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="healthname" size="20">&nbsp;<A class="aform" href="javascript: submitform('healthname')"><?php echo _HEALTH_CODES_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	}else{
	?>
		<br>
		<form name="editattendance" method="post" action="health_codes.php">						
		  <p class="pform"><?php echo _HEALTH_CODES_UPDATE_CODE?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="healthname" size="20" value="<?php echo $health_codes_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('healthname')"><button type="submit" class="btn btn-primary">Add</button></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo $health_codes_id; ?>">
	      </p>
	    </form>
	<?php
	};
	?>
	<h3><?php echo $msgFormErr; ?></h3>
</div>

</body>

</html>
