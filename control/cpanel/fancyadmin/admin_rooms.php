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
$action = get_param("action");

if (!strlen($action))
	$action="none";

//Add or Remove School Rooms according to admin choice
switch ($action){
	case "remove":
		$id_to_delete = get_param("id");
		$used_studentbio = $kas_framework->getValue('studentbio_id', 'studentbio', 'studentbio_homeroom', $id);
		$used_schedule = $kas_framework->getValue('teacher_schedule_id', 'teacher_schedule', 'teacher_schedule_room', $id);
		// $used_attendance = $db->get_results("SELECT custom_attendance_history_id 
		// 	FROM custom_attendance_history 
		// 	WHERE custom_field_id = '$id'");
		if ($used_studentbio || $used_attendance) {
			$msgFormErr=_ADMIN_ROOMS_FORM_ERROR;
		} else {
			$sSQL="DELETE FROM school_rooms WHERE school_rooms_id=$id_to_delete";
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "add":
		$name=get_param("name");
		//Check for duplicates
		$tot=$kas_framework->countRestrict1('school_rooms', 'school_rooms_desc', $name);
		if($tot>0){
			$msgFormErr=_ADMIN_ROOMS_DUP;
		}else{
		$cSQL="INSERT INTO school_rooms (school_rooms_desc) VALUES (".tosql($name, "Text").")"; 
		$dbh_sSQL = $dbh->prepare($cSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "edit":
		$id =get_param("id");
		$name = $kas_framework->getValue('school_rooms_desc', 'school_rooms', 'school_rooms_id', $id); 
		break;
	case "update":
		$id = get_param("id");
		$name = get_param("name");
		$cSQL="UPDATE school_rooms SET school_rooms_desc = '$name' WHERE school_rooms_id = '$id'";
		$dbh_sSQL = $dbh->prepare($cSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		break;

};


//Set paging appearence
$ezr->results_open = "<table width='65%' cellpadding=2 cellspacing=0 border=1 class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr>
	<td class='paging' width='70%'>COL2</td>
	<td class='paging' align=center>
	  <a href=" . $_SERVER['PHP_SELF'] . "?action=edit&id=COL1 class='aformbtn btn-default btn-sm'>&nbsp;" . _ADMIN_ROOMS_EDIT . "</a></td>
	<td class='paging' align=center>
	  <a name=href_remove href=#  onclick=cnfremove(COL1); class='aformbtn btn-danger btn-sm'>&nbsp;" . _ADMIN_ROOMS_REMOVE . "</a></td>
	</tr>";
$ezr->query_mysql("SELECT * FROM school_rooms ORDER BY school_rooms_id");
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
	answer = window.confirm("<?php echo _ADMIN_ROOMS_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_rooms.php?action=remove&id=" + id;
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
	<h1><?php echo _ADMIN_ROOMS_TITLE?></h1>
	<br>
	<?php
	if ($action != "edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="manage_rooms" method="post" action="<?php echo($PHP_SELF);?>">
		  <p class="pform"><?php echo _ADMIN_ROOMS_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="name" size="20">&nbsp;<A class="aform" href="javascript: submitform('name')"><?php echo _ADMIN_ROOMS_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	} else {
	?>
		<br>
		<form name="edit_rooms" method="post" action="<?php echo($PHP_SELF);?>">
		  <p class="pform"><?php echo _ADMIN_ROOMS_UPDATE_CUSTOM?><br>
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
</body>

</html>
