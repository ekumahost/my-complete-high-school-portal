<?php
//*
$title = "Manage sunjects";
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
		</div>';
	exit;
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
//Add or Remove subjects according to admin choice
switch ($action){
	case "remove":
		$subject_id=get_param("id");
		if($norem= $kas_framework->getValue('course_code', 'grade_history_primary', 'course_code', $subject_id)){
			$msgFormErr=_ADMIN_SUBJECTS_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM grade_subjects WHERE grade_subject_id=$subject_id";
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "add":
		//Check for duplicates
		$subject_desc=tosql(get_param("subjectname"), "Text");
		$tot = $kas_framework->countRestrict1('grade_subjects', 'grade_subject_desc', $subject_desc);
		if($tot>0){
			$msgFormErr=_ADMIN_SUBJECTS_DUP;
			}else{
		$sSQL="INSERT INTO grade_subjects (grade_subject_desc) VALUES (".$subject_desc.")"; 
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "edit":
		$subject_id=get_param("id");
		$subject_desc = $kas_framework->getValue('grade_subject_desc', 'grade_subjects', 'grade_subject_id', $subject_id); 
		break;
	case "update":
		$subject_id=get_param("id");
		$subject_desc=get_param("subjectname");
		$sSQL="UPDATE grade_subjects SET grade_subject_desc='$subject_desc' WHERE grade_subject_id=$subject_id";
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		break;

};


//Set paging appearence
$ezr->results_open = "<table width='80%' cellpadding=2 cellspacing=0 border=1 class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class='paging' width='70%'>COL2</td><td 
class='paging' align=center><a href=admin_subjects.php?action=edit&id=COL1 class='aform btn btn-default btn-sm'>&nbsp;" . _ADMIN_SUBJECTS_EDIT . "</a>
<a name=href_remove href=# onclick=cnfremove(COL1); class='aform btn btn-danger btn-sm'>&nbsp;" . _ADMIN_SUBJECTS_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT grade_subject_id, grade_subject_desc FROM grade_subjects ORDER BY grade_subject_desc");
?>

<!DOCTYPE html>

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
	answer = window.confirm("<?php echo _ADMIN_SUBJECTS_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_subjects.php?action=remove&id=" + id;
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
	<h1><?php echo _ADMIN_SUBJECTS_TITLE?></h1>
	<br>
	
		<h3><?php echo $msgFormErr; ?></h3>

	
	<?php
	if ($action!="edit"){
	
	?>
	
	<form name="addgrade" method="post" 
action="admin_subjects.php">						
		  <p class="pform"><?php echo _ADMIN_SUBJECTS_ADD_NEW?><br>
	      <input type="text" name="subjectname" size="50" 
maxlength="80">&nbsp;<A class="aform" href="javascript: 
submitform('subjectname')"><button type="submit" class="btn btn-primary">Add</button></a>


	      <input type="hidden" name="action" value="add">
	      </p>
	    </form> <?php
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		
	<?php
	}else{
	?>
		<br>
		<form name="editethnicity" method="post" 
action="admin_subjects.php">						
		  <p class="pform"><?php echo _ADMIN_SUBJECTS_UPDATE_SUBJECT?><br>
	      <input type="text" name="subjectname" size="50" 
maxlength="80" value="<?php echo $subject_desc; ?>">&nbsp;<A class="aform btn btn-primary btn-sm" href="javascript: submitform('subjectname')"><?php echo _ADMIN_SUBJECTS_UPDATE?></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo $subject_id; ?>">
	      </p>
	    </form>
	<?php
	};
	?>
</div>
<?php // include "admin_maint_tables_menu.inc.php"; ?>
</body>

</html>
