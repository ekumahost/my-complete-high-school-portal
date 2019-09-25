<?php
   $title ="Exam Type";
// config
include_once "../../includes/configuration.php";
//Include paging class
include_once "../../../php.files/classes/kas-framework.php";
include('meta.php');


//Check if Admin is logged in, and his session has not time out
session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A" || (time() - $_SESSION['LAST_ACTIVITY'] > $timeout))
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Include global functions
include_once "../../includes/common.php";
include_once "../../includes/ez_sql.php";
include_once "../../includes/ez_results.php";
$msgFormErr="";

//Check what we have to do
$action = get_param("action");


if (!strlen($action))
	$action="none";

//Add or Remove School Exams according to admin choice
switch ($action){
	case "remove":
		$id_to_delete = get_param("id");
		$sSQL="DELETE FROM exams_types WHERE exams_types_id = $id_to_delete";
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		break;
	case "add":
		$name=get_param("name");
		//Check for duplicates
		$tot= $kas_framework->countRestrict1('exams_types', 'exams_types_desc', $name);
		if($tot>0){
			$msgFormErr=_ADMIN_EXAMS_TYPES_DUP;
		}else{
		$cSQL="INSERT INTO exams_types (exams_types_desc) VALUES (".tosql($name, "Text").")"; 
		$dbh_sSQL = $dbh->prepare($cSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "edit":
		$id =get_param("id");
		$name = $kas_framework->getValue('exams_types_desc', 'exams_types', 'exams_types_id', $id);
		break;
	case "update":
		$id = get_param("id");
		$name = get_param("name");
		$cSQL="UPDATE exams_types SET exams_types_desc = '$name' WHERE exams_types_id = '$id'";
		$dbh_sSQL = $dbh->prepare($cSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		break;

};


//Set paging appearence
$mypage ="admin_exams_types.php";
$ezr->results_open = "<table width='65%' cellpadding=2 cellspacing=0 border=1 class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";// . $_SERVER['PHP_SELF'] . 
$ezr->results_row = "<tr>
	<td class='paging' width='70%'>COL2</td>
	<td class='paging' align=center><a href=".$mypage."?action=edit&id=COL1 class='aform btn btn-default btn-sm'>&nbsp;" . _ADMIN_EXAMS_TYPES_EDIT . "</a>
	<a name=href_remove href=#  onclick='cnfremove(COL1);' class='aform btn btn-danger btn-sm'>&nbsp;" . _ADMIN_EXAMS_TYPES_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT * FROM exams_types ORDER BY exams_types_id");
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
  if (t.value != "") 
    f.submit();
  else
    alert("<?php echo _ENTER_VALUE?>");
}
/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
	var answer;	
	answer = window.confirm("<?php echo _ADMIN_EXAMS_TYPES_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_exams_types.php?action=remove&id=" + id;
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
	<h1><?php echo _ADMIN_EXAMS_TYPES_TITLE?></h1>
	<br><font color="red"> Do not edit order of Examination, test and Qualification Exam. The Best is "Do Not Edit or Delete".</font>
	<?php
	if ($action != "edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="manage_exams_types" method="post" action="admin_exams_types.php">						
		  <p class="pform"><?php echo _ADMIN_EXAMS_TYPES_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="name" size="20">&nbsp;<A class="aform btn btn-primary btn-sm" href="javascript: submitform('name')"><?php echo _ADMIN_EXAMS_TYPES_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	} else {
	?>
		<br>
		<form name="edit_exams_types" method="post" action="admin_exams_types.php">
		  <p class="pform"><?php echo _ADMIN_EXAMS_TYPES_UPDATE_CUSTOM?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="name" size="20" value="<?php echo ($name);?>">&nbsp;<A class="aform" href="javascript: submitform('name')"><button type="submit" class="btn btn-primary">Update</button></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo($id);?>">
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
