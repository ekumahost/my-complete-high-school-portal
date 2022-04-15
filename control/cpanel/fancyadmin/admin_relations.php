<?php
   $title ="Config";
// config
include_once "../../includes/configuration.php";
//Include paging class
include_once "../../../php.files/classes/kas-framework.php";
include('meta.php');


//Check if admin is logged in
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
//Add or Remove Relations according to admin choice
switch ($action){
	case "remove":
		$title_id=get_param("id");
		$title_desc=get_param("titlename");
		if($norem= $getValue('contact_to_students_relation', 'contact_to_students', 'contact_to_students_relation', $title_id)){
			$msgFormErr=_ADMIN_RELATIONS_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM relations_codes WHERE relation_codes_id=$title_id";
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "add":
		//Check for duplicates
		$title_desc=get_param("titlename");
		$tot=$kas_framework->countRestrict1('relations_codes', 'relation_codes_desc', $title_desc);
		if($tot>0){
			$msgFormErr=_ADMIN_RELATIONS_DUP;
		}else{
		$sSQL="INSERT INTO relations_codes (relation_codes_desc) VALUES (".tosql($title_desc, "Text").")"; 
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "edit":
		$title_id=get_param("id");
		$title_desc = $kas_framework->getValue('relation_codes_desc', 'relations_codes', 'relation_codes_id', $title_id);
		break;
	case "update":
		$title_id=get_param("id");
		$title_desc=get_param("titlename");
		$sSQL="UPDATE relations_codes SET relation_codes_desc=".tosql($title_desc, "Text")." WHERE relation_codes_id=$title_id";
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		break;

};


//Set paging appearence
$ezr->results_open = "<table width='65%' cellpadding=2 cellspacing=0 border=1 class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class='paging' width='70%'>COL2</td><td 
class='paging' align=center><a 
href='admin_relations.php?action=edit&id=COL1' class='aform btn btn-default btn-sm'>&nbsp;" . _ADMIN_RELATIONS_EDIT . "</a>
<a name='href_remove' href='#' onclick='cnfremove('COL1');' class='aform btn btn-danger btn-sm'>&nbsp;" . _ADMIN_RELATIONS_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT relation_codes_id, relation_codes_desc FROM  relations_codes ORDER BY relation_codes_desc");

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
	answer = window.confirm("<?php echo _ADMIN_RELATIONS_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_relations.php?action=remove&id=" + id;
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
	<h1><?php echo _ADMIN_RELATIONS_TITLE?></h1>
	<br>
	<?php
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addtitle" method="post" 
action="admin_relations.php">
		  <p class="pform"><?php echo _ADMIN_RELATIONS_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="titlename" size="20">&nbsp;<A class="aform" href="javascript: submitform('titlename')"><?php echo _ADMIN_RELATIONS_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	}else{
	?>
		<br>
		<form name="edittitle" method="post" 
action="admin_relations.php">
		  <p class="pform"><?php echo _ADMIN_RELATIONS_UPDATE_REL?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="titlename" size="20" value="<?php echo $title_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('titlename')"><button type="submit" class="btn btn-primary">Add</button></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo $title_id; ?>">
	      </p>
	    </form>
	<?php
	};
	?>
	<h3><?php echo $msgFormErr; ?></h3>
</div>
</body>

</html>
