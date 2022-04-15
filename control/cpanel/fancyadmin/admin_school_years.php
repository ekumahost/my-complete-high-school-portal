<?php
   $title ="Config";
// config
include_once "../../includes/configuration.php";
//Include paging class
include_once "../../../php.files/classes/kas-framework.php";
include('meta.php');

session_start();
require ('check_admin_session.php');

//Include global functions
include_once "../../includes/common.php";
include_once "../../includes/ez_sql.php";
include_once "../../includes/ez_results.php";
$msgFormErr="";

//Check what we have to do
$action=get_param("action");

//What year are we dealing with
$yearid=get_param("id");
//$sSQL="SELECT school_years_desc FROM school_years WHERE hool_years_id=$yearid";
//$school_years_desc2=$db->query($sSQL);

if (!strlen($action))
	$action="none";
//Add or Remove School Year according to admin choice

switch ($action){
	case "remove":
		$school_years_id=get_param("id");
        if($norem= $kas_framework->getValue('studentcontact_year', 'studentcontact', 'studentcontact_year', $yearid)) {
			$msgFormErr=_ADMIN_SCHOOL_YEARS_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM school_years WHERE school_years_id=$school_years_id";
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "add":
		$school_years_desc=get_param("schoolyear");
		$tot= $kas_framework->countRestrict1('school_years', 'school_years_desc', $school_years_desc);
		if($tot>0){
			$msgFormErr=_ADMIN_SCHOOL_YEARS_FORM_ERROR2;
		}else{
		$sSQL = "INSERT INTO school_years (school_years_desc) VALUES (".tosql($school_years_desc, "Text").")"; 
		$dbh_Query = $dbh->prepare($sSQL);
		$dbh_Query->execute();
		
		$catchsession = $dbh->lastInsertId();
		$dbh_Query = null;
		// loop thrice and add grade term days
			for($t=1;$t<=3;$t++){
			// gariki, Akwute junction beach keke
				$SQLi = "INSERT INTO grade_terms_days (grade_terms_days_session, grade_terms_days_term, grade_terms_days_no_of_days) VALUES ($catchsession, $t, '60')";
				$dbh_sSQL = $dbh->prepare($SQLi); $dbh_sSQL->execute(); $dbh_sSQL = null;
			}
		
		};
		break;
	case "edit":
		$school_years_id=get_param("id");
		$sSQL="SELECT school_years_desc FROM school_years WHERE school_years_id=$school_years_id";
		$school_years_desc = $db->get_var($sSQL);
		break;
	case "update":
		$school_years_id=get_param("id");
		$school_years_desc=get_param("schoolyear");
		//echo _ADMIN_SCHOOL_YEARS_SCHOOLYEAR . "$school_years_desc";
		$sSQL="UPDATE school_years SET school_years_desc='$school_years_desc' WHERE school_years_id=$school_years_id";
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		break;

};


//Set paging appearence
$ezr->results_open = "<table width='65%' cellpadding=2 cellspacing=0 border=1 class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class='paging' width='70%'>COL2</td><td class='paging' align=center>
<a href=admin_school_years.php?action=edit&id=COL1 class='aform btn btn-default btn-sm'>&nbsp;" . _ADMIN_SCHOOL_YEARS_EDIT . "</a>
<a name=href_remove href=# onclick=cnfremove(COL1); class='aform btn btn-danger btn-sm'>&nbsp;" . _ADMIN_SCHOOL_YEARS_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT school_years_id, school_years_desc FROM school_years ORDER BY school_years_desc");
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
	answer = window.confirm("<?php echo _ADMIN_SCHOOL_YEARS_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_school_years.php?action=remove&id=" + id;
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
	<h1><?php echo _ADMIN_SCHOOL_YEARS_TITLE?></h1>
	School Year reprensent Session. Eg, the Current Session may be <?php echo date('Y') .'/'. (date('Y') + 1) ?>
	<br>	<br>
	<?php
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addyear" method="post" action="admin_school_years.php">						
		  <p class="pform"><?php echo _ADMIN_SCHOOL_YEARS_ADD_NEW?> <br>
	      <input type="text" onChange="capitalizeMe(this)" name="schoolyear" size="20">&nbsp;<A class="aform btn btn-primary btn-sm" href="javascript: submitform('schoolyear');"><?php echo _ADMIN_SCHOOL_YEARS_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	}else{
	?>
		<br>
		<form name="edityear" method="post" action="admin_school_years.php">						
		  <p class="pform"><?php echo _ADMIN_SCHOOL_YEARS_UPDATE_YEAR?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="schoolyear" size="20" value="<?php echo $school_years_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('schoolyear');"><button type="submit" class="btn btn-primary">Update</button>
</a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo $school_years_id; ?>">
	      </p>
	    </form>
	<?php
	};
	?>
	<h3><?php echo $msgFormErr; ?></h3>
</div>
</body>

</html>
