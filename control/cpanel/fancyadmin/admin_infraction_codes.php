<?php
   $title ="Config";
// config
include_once "../../includes/configuration.php";
//Include paging class
include_once "../../../php.files/classes/kas-framework.php";
include('meta.php');

//Check if admin is logged in
session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A" || (time() - $_SESSION['LAST_ACTIVITY'] > $timeout))
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
//Add or Remove Infraction Codes according to admin choice
switch ($action){
	case "remove":
		$infraction_codes_id=get_param("id");
		if($norem= $kas_framework->getValue('discipline_history_code', 'discipline_history', 'discipline_history_code', $infraction_codes_id)){
			$msgFormErr=_ADMIN_INFRACTION_CODES_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM infraction_codes WHERE infraction_codes_id=$infraction_codes_id";
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
case "add":
		$infraction_codes_desc=get_param("infractionname");
		//Check for duplicates
		$tot = $kas_framework->countRestrict1('infraction_codes', 'infraction_codes.infraction_codes_desc', $infraction_codes_desc);
		if ($tot>0){
			$msgFormErr=_ADMIN_INFRACTION_CODES_DUP;
		}else{
			$sSQL="INSERT INTO infraction_codes (infraction_codes_desc) VALUES (".tosql($infraction_codes_desc, "Text").")"; 
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "edit":
		$infraction_codes_id=get_param("id");
		$infraction_codes_desc = $kas_framework->getValue('infraction_codes_desc', 'infraction_codes', 'infraction_codes_id', $infraction_codes_id);
		break;
	case "update":
		$infraction_codes_id=get_param("id");
		$infraction_codes_desc=get_param("infractionname");
		$sSQL="UPDATE infraction_codes SET infraction_codes_desc='$infraction_codes_desc' WHERE infraction_codes_id=$infraction_codes_id";
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		break;

};


//Set paging appearence
$ezr->results_open = "<table width='65%' class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class='paging' width='70%'>COL2</td><td class='paging'>
<a href='admin_infraction_codes.php?action=edit&id=COL1' class='aform btn btn-default btn-sm'>&nbsp;" . _ADMIN_INFRACTION_CODES_EDIT . "</a>
<a name='href_remove' href='#' onclick=cnfremove(COL1);' class='aform btn btn-danger btn-sm'>&nbsp;" . _ADMIN_INFRACTION_CODES_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT infraction_codes_id, infraction_codes_desc FROM infraction_codes ORDER BY infraction_codes_desc");
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
	answer = window.confirm("<?php echo _ADMIN_INFRACTION_CODES_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_infraction_codes.php?action=remove&id=" + id;
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
	<h1><?php echo _ADMIN_INFRACTION_CODES_TITLE?></h1>
	<br>
	<?php
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addinfraction" method="post" action="admin_infraction_codes.php">						
		  <p class="pform"><?php echo _ADMIN_INFRACTION_CODES_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="infractionname" size="20">&nbsp;<A class="aform" href="javascript: submitform('infractionname')"><?php echo _ADMIN_INFRACTION_CODES_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	}else{
	?>
		<br>
		<form name="editinfraction" method="post" action="admin_infraction_codes.php">						
		  <p class="pform"><?php echo _ADMIN_INFRACTION_CODES_UPDATE_INFR?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="infractionname" size="20" value="<?php echo $infraction_codes_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('infractionname')"><button type="submit" class="btn btn-primary">Update</button></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo $infraction_codes_id; ?>">
	      </p>
	    </form>
	<?php
	};
	?>
	<h3><?php echo $msgFormErr; ?></h3>
</div>
</body>

</html>
