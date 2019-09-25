<?php
   $title ="Config";
// config
include_once "../../includes/configuration.php";
//Include paging class
include_once "../../../php.files/classes/kas-framework.php";
include('meta.php');

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
//Add or Remove Ethnicity according to admin choice
switch ($action){
	case "remove":
		$ethnicity_id=get_param("id");
		if($norem= $kas_framework->getValue('studentbio_ethnicity', 'studentbio', 'studentbio_ethnicity', $ethnicity_id)){
			$msgFormErr=_ADMIN_ETHNICITY_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM ethnicity WHERE ethnicity_id='".$ethnicity_id."'";
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "add":
		//Check for duplicates
		$ethnicity_desc=get_param("ethnicityname");
		$tot=$kas_framework->countRestrict1('ethnicity', 'ethnicity_desc', $ethnicity_desc);
		if($tot>0){
			$msgFormErr=_ADMIN_ETHNICITY_DUP;
		}else{
			$sSQL="INSERT INTO ethnicity (ethnicity_desc) VALUES (".tosql($ethnicity_desc, "Text").")"; 
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "edit":
		$ethnicity_id=get_param("id");
		$ethnicity_desc = $kas_framework->getValue('ethnicity_desc', 'ethnicity', 'ethnicity_id', $ethnicity_id);
		break;
	case "update":
		$ethnicity_id=get_param("id");
		$ethnicity_desc=get_param("ethnicityname");
		$sSQL="UPDATE ethnicity SET ethnicity_desc='$ethnicity_desc' WHERE ethnicity_id='".$ethnicity_id."'";
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		break;

};


//Set paging appearence
$ezr->results_open = "<table width='65%' cellpadding='1' cellspacing='0' border='1' class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class='paging' width='70%'>COL2</td><td class='paging' align='center'>
<a href=admin_ethnicity.php?action=edit&id=COL1 class='aform btn btn-default btn-sm'>&nbsp;" . _ADMIN_ETHNICITY_EDIT . "</a>
<a name='href_remove' href='#' onclick='cnfremove(COL1)'; class='aform btn btn-danger btn-sm'>&nbsp;" 
. _ADMIN_ETHNICITY_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT ethnicity_id, ethnicity_desc FROM ethnicity ORDER BY ethnicity_desc");
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
	answer = window.confirm("<?php echo _ADMIN_ETHNICITY_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_ethnicity.php?action=remove&id=" + id;
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
	<h1><?php echo _ADMIN_ETHNICITY_TITLE?></h1>
	<br>
	<?php
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addethnicity" method="post" action="admin_ethnicity.php">						
		  <p class="pform"><?php echo _ADMIN_ETHNICITY_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="ethnicityname" size="20">&nbsp;<A class="aform" href="javascript: submitform('ethnicityname')"><?php echo _ADMIN_ETHNICITY_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	}else{
	?>
		<br>
		<form name="editethnicity" method="post" action="admin_ethnicity.php">						
		  <p class="pform"><?php echo _ADMIN_ETHNICITY_UPDATE_ETH?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="ethnicityname" size="20" value="<?php echo $ethnicity_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('ethnicityname')"><button type="submit" class="btn btn-primary">Update</button></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo $ethnicity_id; ?>">
	      </p>
	    </form>
	<?php
	};
	?>
	<h3><?php echo $msgFormErr; ?></h3>
</div>
</body>

</html>
