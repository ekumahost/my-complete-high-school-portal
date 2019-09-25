<?php
  $title ="Config";
// config
include_once "../../includes/configuration.php";
//Include paging class
include_once "../../../php.files/classes/kas-framework.php";
include('meta.php');
//Check if nurse is logged in
session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "N" && $_SESSION['UserType'] != "A" || (time() - $_SESSION['LAST_ACTIVITY'] > $timeout))
  {
echo'<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">*</button>
		<strong>Oh snap! Something is not right here</strong> It seems like your session is expired or you have logged out. <br /> Looking for solution? logout and login again. or click on the MySchoolApp logo above.
	</div>';	exit;
}

//Include global functions
include_once "../../includes/common.php";
include_once "../../includes/ez_sql.php";
include_once "../../includes/ez_results.php";
$msgFormErr="";

//Check what we have to do
$action=get_param("action");

if (!strlen($action))
	$action="none";
//Add or Remove Allergy Codes according to user choice
switch ($action){
	case "remove":
		$health_allergy_id=get_param("id");
		if($norem = $kas_framework->getValue('health_allergy_history_code', 'health_allergy_history', 'health_allergy_history_code', $health_allergy_id)){
			$msgFormErr=_HEALTH_ALLERGIES_NOT_REMOVED;
		}else{
			$sSQL="DELETE FROM health_allergy WHERE health_allergy_id='".$health_allergy_id."'";
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "add":
		$health_allergy_desc=get_param("healthname");
		//Check for duplicates
		$tot= $kas_framework->countRestrict1('health_allergy', 'health_allergy_desc', $health_allergy_desc);
		if($tot>0){
			$msgFormErr=_HEALTH_ALLERGIES_DUP;
		}else{
		$sSQL="INSERT INTO health_allergy (health_allergy_desc) VALUES (".tosql($health_allergy_desc, "Text").")"; 
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "edit":
		$health_allergy_id=get_param("id");
		$health_allergy_desc = $kas_framework->getValue('health_allergy_desc', 'health_allergy', 'health_allergy_id', $health_allergy_id); 
		break;
	case "update":
		$health_allergy_id=get_param("id");
		$health_allergy_desc=get_param("healthname");
		$sSQL="UPDATE health_allergy SET health_allergy_desc='".$health_allergy_desc."' WHERE health_allergy_id='".$health_allergy_id."'";
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		break;

};


//Set paging appearence
$ezr->results_open = "<table width='65%' cellpadding=2 cellspacing=0 border=1 class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class='paging' width='70%'>COL2</td><td class='paging'>
<a href=health_allergies.php?action=edit&id=COL1' class='aform btn btn-default btn-sm'>&nbsp;" . _HEALTH_ALLERGIES_EDIT . "</a>
<a name='href_remove href=# onclick=cnfremove(COL1);' class='aform btn btn-danger btn-sm'>&nbsp;" . _HEALTH_ALLERGIES_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT health_allergy_id, health_allergy_desc FROM health_allergy ORDER BY health_allergy_desc");
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
	answer = window.confirm("<?php echo _HEALTH_ALLERGIES_SURE?>");
	if (answer == 1) {
		var url;
		url = "health_allergies.php?action=remove&id=" + id;
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
<div id="Content" class="mycontent" style="padding:10px; box-shadow:10px 10px 80px #CCC;">
	<h1><?php echo _HEALTH_ALLERGIES_TITLE?></h1>
	<br>
	<?php
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addattendance" method="post" 
action="health_allergies.php">
		  <p class="pform"><?php echo _HEALTH_ALLERGIES_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="healthname" size="20">&nbsp;<A class="aform" href="javascript: submitform('healthname')"><?php echo _HEALTH_ALLERGIES_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	}else{
	?>
		<br>
		<form name="editattendance" method="post" 
action="health_allergies.php">						
		  <p class="pform"><?php echo _HEALTH_ALLERGIES_UPDATE_CODE?><br>
	      <input type="text" onChange="capitalizeMe(this)" 
name="healthname" size="20" value="<?php echo $health_allergy_desc; 
?>">&nbsp;<A class="aform" href="javascript: submitform('healthname')"><button type="submit" class="btn btn-primary">Update</button></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo 
$health_allergy_id; ?>">
	      </p>
	    </form>
	<?php
	};
	?>
	<h3><?php echo $msgFormErr; ?></h3>
</div>

</body>

</html>
