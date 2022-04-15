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
//Add or Remove Titles according to admin choice
switch ($action){
	case "remove":
		$title_id=get_param("id");
		//$title_desc=get_param("titlename");
		//$desc="SELECT title_desc FROM tbl_titles WHERE title_id=$title_id";
		//$title_desc=$db->get_var($desc);
		if($norem= $kas_framework->getValue('studentcontact_title', 'studentcontact', 'studentcontact_title', $title_id)){
			$msgFormErr=_ADMIN_TITLES_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM tbl_titles WHERE title_id='$title_id'";
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "add":
		//Check for duplicates
		$title_desc=get_param("titlename");
		$tot=$kas_framework->countRestrict1('tbl_titles', 'title_desc', $title_desc);
		if($tot>0){
			$msgFormErr=_ADMIN_TITLES_DUP;
		}else{
			$sSQL="INSERT INTO tbl_titles (title_desc) VALUES (".tosql($title_desc, "Text").")"; 
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "edit":
		$title_id=get_param("id");
		$title_desc = $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $title_id); 
		break;
	case "update":
		$title_id=get_param("id");
		$title_desc=get_param("titlename");
		$sSQL="UPDATE tbl_titles SET title_desc=".tosql($title_desc, "Text")." WHERE title_id=$title_id";
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		break;

};


//Set paging appearence
$ezr->results_open = "<table width='65%' cellpadding='2' cellspacing='0' border='1' class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class=paging width='70%'>COL2</td><td 
class='paging' align='center'><a href=admin_titles.php?action=edit&id=COL1 class='aform btn btn-default btn-sm'>&nbsp;" . _ADMIN_TITLES_EDIT . "</a>
<a name=href_remove href=# onclick=cnfremove('COL1'); class='aform btn btn-danger btn-sm'>&nbsp;" . _ADMIN_TITLES_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT title_id, title_desc FROM tbl_titles ORDER BY title_desc");
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
	answer = window.confirm("<?php echo _ADMIN_TITLES_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_titles.php?action=remove&id=" + id;
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
	<h1><?php echo _ADMIN_TITLES_TITLE?></h1>
	<br>
	<?php
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addtitle" method="post" action="admin_titles.php">						
		  <p class="pform"><?php echo _ADMIN_TITLES_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="titlename" size="20">&nbsp;<A class="aform" href="javascript: submitform('titlename')"><?php echo _ADMIN_TITLES_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	}else{
	?>
		<br>
		<form name="edittitle" method="post" action="admin_titles.php">						
		  <p class="pform"><?php echo _ADMIN_TITLES_UPDATE_TITLE?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="titlename" size="20" value="<?php echo $title_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('titlename')"><button type="submit" class="btn btn-primary"> Update</button></a>
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
