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
//Add or Remove Terms according to admin choice

switch ($action){
	case "remove":
		$term_id=get_param("id");
		// check if the term should not be deleted
		if($norem= $kas_framework->getValue('quarter', 'grade_history_primary', 'quarter', $term_id)){
			$msgFormErr=_ADMIN_TERMS_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM grade_terms WHERE grade_terms_id=$term_id";
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "add":
		//Check for duplicates
		$term_desc=get_param("termname");
		$tot=$kas_framework->countRestrict1('grade_terms', 'grade_terms_desc', $term_desc);
		if($tot>0){
			$msgFormErr=_ADMIN_TERMS_DUP;
		}else{
			$sSQL="INSERT INTO grade_terms (grade_terms_desc) VALUES (".tosql($term_desc, "Text").")"; 
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "edit":
		$term_id=get_param("id");
		$term_desc = $kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $term_id); 
		break;
	case "update":
		$term_id=get_param("id");
		$term_desc=get_param("termname");
		//adde by ultimate keliv
		$cterm = "SELECT * FROM grade_terms WHERE grade_terms_desc='$term_desc'";
		$dbh_Query = $dbh->prepare($cterm);
		$dbh_Query->execute();
		$rowCount = $dbh_Query->rowCount();
		$dbh_Query = null;
		if ($rowCount >= 1) { 
			$msgFormErr = 'Cannot Rename term to an Existing One'; 
		} else {		
			$sSQL = "UPDATE grade_terms SET grade_terms_desc='$term_desc' WHERE grade_terms_id = '".$term_id."'";
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		}
		break;
};


//Set paging appearence
$ezr->results_open = "<table width='65%' cellpadding=2 cellspacing=0 border=1 class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class='paging' width='70%'>COL2</td><td 
class='paging' align='center'><a href='admin_terms.php?action=edit&id=COL1' class='aform btn btn-default btn-sm'>&nbsp;" . _ADMIN_TERMS_EDIT . "</a>
<a name='href_remove' href='admin_terms.php?action=remove&id=COL1' class='aform btn btn-danger btn-sm'>&nbsp;" . _ADMIN_TERMS_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT grade_terms_id, grade_terms_desc FROM grade_terms ORDER BY grade_terms_desc");
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
    alert("<?php echo _ADMIN_TERMS_ENTER_VALUE?>");
}
/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
	var answer;	
	answer = window.confirm("<?php echo _ADMIN_TERMS_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_terms.php?action=remove&id=" + id;
		window.location = url; // other browsers
		href_remove.href = url; // explorer 
	}
	return false;
}

</SCRIPT>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="../sms.js"></script>
</head>

<body>


<div id="Content" class="mycontent" style="padding:10px; box-shadow:10px 10px 80px #CCC;">
	<h1><?php echo _ADMIN_TERMS_TITLE?></h1>
	<br>
	<?php
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addethnicity" method="post" action="admin_terms.php">						
		  <p class="pform"><?php echo _ADMIN_TERMS_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="termname" size="20">&nbsp;
		  <A class="aform" href="javascript: submitform('termname');"><button type="submit" class="btn btn-primary"><?php echo _ADMIN_TERMS_ADD ?></button></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	}else{
	?>
		<br>
		<form name="editethnicity" method="post" 
action="admin_terms.php">						
		  <p class="pform"><?php echo _ADMIN_TERMS_UPDATE_TERM?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="termname" size="20" value="<?php echo $term_desc; ?>">&nbsp;
		  <A class="aform" href="javascript: submitform('termname');"><button type="submit" class="btn btn-primary">Update</button></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo $term_id; 
?>">
	      </p>
	    </form>
	<?php
	};
	?>
	<h4><font color="red"><?php echo $msgFormErr; ?></font></h4>
</div>
</body>

</html>
