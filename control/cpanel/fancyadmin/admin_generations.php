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
//Add or Remove Generations according to admin choice
switch ($action){
	case "remove":
		$generations_id=get_param("id");
		if($norem= $kas_framework->getValue('studentbio_generation', 'studentbio', 'studentbio_generation', $generations_id)){
			$msgFormErr=_ADMIN_GENERATIONS_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM generations WHERE generations_id=$generations_id";
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
case "add":
		$generations_desc=get_param("generationname");
		//Check for duplicates
		$tot=$db->get_var("SELECT count(*) FROM generations WHERE generations_desc='$generations_desc'");
		if($tot>0){
			$msgFormErr=_ADMIN_GENERATIONS_DUP;
		}else{
			$sSQL="INSERT INTO generations (generations_desc) VALUES (".tosql($generations_desc, "Text").")"; 
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "edit":
		$generations_id=get_param("id");
		$generations_desc = $kas_framework->getValue('generations_desc', 'generations', 'generations_id', $generations_id);
		break;
	case "update":
		$generations_id=get_param("id");
		$generations_desc=get_param("generationname");
		$sSQL="UPDATE generations SET generations_desc='$generations_desc' WHERE generations_id=$generations_id";
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		break;

};


//Set paging appearence
$ezr->results_open = "<table width='65%' cellpadding=2 cellspacing=0 border=1 class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class='paging' width='70%'>COL2</td><td class='paging' align=center><a href=admin_generations.php?action=edit&id=COL1 class='aform btn btn-default btn-sm'>
" . _ADMIN_GENERATIONS_EDIT . "</a>&nbsp;<a name=href_remove href=# onclick=cnfremove(COL1); class='aform btn btn-danger btn-sm'>&nbsp;" . _ADMIN_GENERATIONS_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT generations_id, generations_desc FROM generations WHERE generations_desc NOT IN ('--') ORDER BY generations_desc"); ?>

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
	answer = window.confirm("<?php echo _ADMIN_GENERATIONS_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_generations.php?action=remove&id=" + id;
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
	<h1><?php echo _ADMIN_GENERATIONS_TITLE?></h1>
	<br>
	<?php
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addgeneration" method="post" action="admin_generations.php">						
		  <p class="pform"><?php echo _ADMIN_GENERATIONS_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="generationname" size="20">&nbsp;<A class="aform" href="javascript: submitform('generationname')"><?php echo _ADMIN_GENERATIONS_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	}else{
	?>
		<br>
		<form name="editgeneration" method="post" action="admin_generations.php">						
		  <p class="pform"><?php echo _ADMIN_GENERATIONS_UPDATE_GEN?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="generationname" size="20" value="<?php echo $generations_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('generationname')"><button type="submit" class="btn btn-primary">Update</button></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo $generations_id; ?>">
	      </p>
	    </form>
	<?php
	};
	?>
	<h3><?php echo $msgFormErr; ?></h3>
</div>
<?php //include "admin_maint_tables_menu.inc.php"; ?>
</body>

</html>
