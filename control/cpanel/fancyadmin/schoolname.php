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
//Add or Remove School Name according to admin choice
switch ($action){
	case "remove":
		$school_names_id=get_param("id");
		if($norem= $kas_framework->getValue('studentbio_school', 'studentbio', 'studentbio_school', $school_names_id)){
			$msgFormErr=_ADMIN_SCHOOL_NAMES_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM tbl_school_domains WHERE id = $school_names_id";
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
			
		};
		break;
	case "add":
		$school_names_desc=get_param("schoolname");
		//Check for duplicate school name
		$tot = $kas_framework->countRestrict1('tbl_school_domains', 'school_names', $school_names_desc);
		if($tot>0){
			$msgFormErr.=_ADMIN_SCHOOL_NAMES_DUP;
		} else {
			$sSQL="INSERT INTO tbl_school_domains (school_names) VALUES (".$school_names_desc.")"; 
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "edit":
		$school_names_id=get_param("id");
		$school_names_desc=$kas_framework->getValue('school_names', 'tbl_school_domains', 'id', $school_names_id);
		break;
		
	case "update":
		$school_names_id=get_param("id");
		$school_names_desc=get_param("schoolname");
		$sSQL="UPDATE tbl_school_domains SET school_names='$school_names_desc' WHERE id=$school_names_id";
		$db->query($sSQL);
		break;

};


//Set paging appearence
$ezr->results_open = "<table width=65% cellpadding=2 cellspacing=0 border=1 class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class='paging' width=70%>COL2</td>
<td class='paging' width=15% align=center><a href=?action=edit&id=COL1 class='aform btn btn-default btn-sm'>&nbsp;". _ADMIN_SCHOOL_NAMES_EDIT . "</a>
 <a name=href_remove href=# onclick=cnfremove(COL1); class='aform btn btn-danger btn-sm'>&nbsp;" . _ADMIN_SCHOOL_NAMES_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT id, school_names FROM tbl_school_domains ORDER BY id");
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
	answer = window.confirm("<?php echo _ADMIN_SCHOOL_NAMES_SURE?>");
	if (answer == 1) {
		var url;
		url = "schoolname.php?action=remove&id=" + id;
		window.location = url; // other browsers
		href_remove.href = url; // explorer 
	}
	return false;
}

</SCRIPT>

</head>

<body>  
<div id="Content" class="mycontent" style="padding:10px; box-shadow:10px 10px 80px #CCC;">
	<h1><?php echo _ADMIN_SCHOOL_NAMES_TITLE?></h1>
	
	<br>
	<i>This feature only works for multiple school, you are not using multiple schools, no need to add <i>
	<?php
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addschool" method="post" action="">						
		  <p class="pform"><?php echo _ADMIN_SCHOOL_NAMES_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="schoolname" size="20">&nbsp;<A class="aform btn btn-primary btn-sm" href="javascript: submitform('schoolname')"><?php echo _ADMIN_SCHOOL_NAMES_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	</form>
	<?php
	}else{
	?>
		<br>
		<form name="editschool" method="post" action="">						
		  <p class="pform"><?php echo _ADMIN_SCHOOL_NAMES_UPDATE_NAME?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="schoolname" size="20" value="<?php echo $school_names_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('schoolname')"><button type="submit" class="btn btn-primary">Add</button></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo $school_names_id; ?>">
	      </p>
	    </form>
	<?php
	};
    ?>
	<h3><?php echo $msgFormErr; ?></h3>
	</div>
</body>

</html>
