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
$action = get_param("action");

if (!strlen($action))
	$action="none";
//Add or Remove Grades according to admin choice
switch ($action){
	case "remove":
		$grades_id = get_param("id");
		if($norem= $kas_framework->getValue('student_grade_year_grade', 'student_grade_year', 'student_grade_year_grade', $grades_id)){
                        $msgFormErr=_ADMIN_GRADES_FORM_ERROR;
                }else{
                        	//pq - 2007-02-22 - fixed typo so grades delete
					$sSQL="DELETE FROM grades WHERE grades_id= ?";
                    $dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute([ $grades_id ]); $dbh_sSQL = null;
                };
                break;
	case "add":
		//Check for duplicates
		$grades_desc = get_param("gradename");
		$grades_domain = get_param("grades_domain");
		 @$tot= $kas_framework->countRestrict1('grades', 'grades_desc', $gradename);
                if($tot > 0){
                        $msgFormErr=_ADMIN_GRADES_DUP;
                } else {

			$sSQL="INSERT INTO grades (grades_desc, grades_domain) VALUES (?, ?)"; 
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute([ $grades_desc, $grades_domain ]); $dbh_sSQL = null;
		};
		break;
	case "edit":
		$grades_id = get_param("id");
		$grades_desc = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $grades_id);
		$grades_domain = $kas_framework->getValue('grades_domain', 'grades', 'grades_id', $grades_id);
		break;
	case "update":
		$grades_id = get_param("id");
		$grades_desc = get_param("gradename");
		$grades_domain = get_param("grades_domain");
		$sSQL="UPDATE grades SET grades_desc= ?, grades_domain = ? WHERE grades_id = ?";
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute([ $grades_desc, $grades_domain, $grades_id ]); $dbh_sSQL = null;
		break;

};


//Set paging appearence
$ezr->results_open = "<table width='65%' cellpadding=2 cellspacing=0 border=1 class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class='paging' >COL2</td><td class='paging'>COL3</td><td class='paging' align=center>
<a href='admin_grades.php?action=edit&id=COL1' class='aform btn btn-default btn-sm'>&nbsp;" . _ADMIN_GRADES_EDIT . "</a>
<a name='href_remove' href='#' onclick='cnfremove(COL1);' class='aform btn btn-danger btn-sm'>&nbsp;" . _ADMIN_GRADES_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT G.grades_id AS grades_id, G.grades_desc, GD.grades_domain_desc AS grades_domain_desc FROM grades G, grades_domain GD WHERE GD.grades_domain_id = G.grades_domain ORDER BY G.grades_id");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
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
	answer = window.confirm("<?php echo _ADMIN_GRADES_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_grades.php?action=remove&id=" + id;
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
	<h1><?php echo _ADMIN_GRADES_TITLE?></h1>
	<br> Edit the Grades to Match your School (In Ascending Order). 
	<br /><font color="red"> <b>Warning!!</b> Do not Delete a Grade/Class. </font> <br />
	<i> You can <b>delete</b> if there is an overflow, or <b>add</b> if the need arises. 
	<br />Help? Email: <a href="mailto:info@kastechnet.com"> info@kastechnet.com </a> </i>
	<br> <h3><?php echo $msgFormErr; ?></h3> 

	<?php
	if ($action != "edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addgrade" method="post" action="admin_grades.php">						
		  <p class="pform"><?php echo _ADMIN_GRADES_ADD_NEW ?><br>
	      <input type="text" onChange="capitalizeMe(this)" placeholder="Grade Name" name="gradename" size="20">&nbsp;
		  <select name="grades_domain">
			  <?php $kas_framework->getallFieldinDropdownOption('grades_domain', 'grades_domain_desc', 'grades_domain_id') ?>
		  </select>
		  <A class="aform" href="javascript: submitform('gradename')"> Add Grade! </a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	} else {
	?>
		<br>
		<form name="editgrade" method="post" action="admin_grades.php">	
		  <p class="pform"><?php echo _ADMIN_GRADES_UPDATE_GRADE?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="gradename" size="20" value="<?php echo $grades_desc; ?>">&nbsp;
		  <select name="grades_domain">
			  <?php $kas_framework->getallFieldinDropdownOption('grades_domain', 'grades_domain_desc', 'grades_domain_id', $grades_domain) ?>
		  </select> 
		  <A class="aform" href="javascript: submitform('gradename')"><button type="submit" class="btn btn-primary">Update</button></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo $grades_id; ?>">
	      </p>
	    </form>
	<?php
	};
	?>
<h3><?php echo $msgFormErr; ?></h3>
</div>
</body>

</html>
