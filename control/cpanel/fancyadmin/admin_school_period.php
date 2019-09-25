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
include ('../tools/public_functions.php');

//Check what we have to do
$action = get_param("action");


if (!strlen($action))
	$action="none";

//Add or Remove School Exams according to admin choice
switch ($action){
	case "remove":
		$id_to_delete = get_param("id");
		$sSQL="DELETE FROM school_class_periods WHERE id=$id_to_delete";
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		break;
	case "add":
		$period=get_param("period");
		$desc=get_param("desc");
		if (strlen(trim($period)) == 0 or strlen(trim($desc)) == 0) {
				$msgFormErr = 'One or More fields Empty';
		} else {
			//Check for duplicates
			$tot=$kas_framework->countRestrict1('school_class_periods', 'periods', $period);
			if($tot>0){
				$msgFormErr='Duplicate School Periods';
			}else{
			$cSQL="INSERT INTO school_class_periods (`periods`, `desc`) VALUES (".tosql($period, "Text").", ".tosql($desc, "Text").")"; 
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
			}
		 };
		break;
	case "edit":
		$id = get_param("id");
		$Query = "SELECT * FROM school_class_periods WHERE id = '".$id."'";
		$dbh_Query = $dbh->prepare($Query);
		$dbh_Query->execute();
		$editObj = $dbh_Query->fetch(PDO::FETCH_OBJ);
		$dbh_Query = null;
		
		$edit_period = $editObj->periods;
		$edit_desc = $editObj->desc;
		break;
		
	case "update":
		$id = get_param("id");
		$desc = get_param("desc");
		$period = get_param("period");
		if (strlen(trim($period)) == 0 or strlen(trim($desc)) == 0) {
				$msgFormErr = 'One or More fields Empty';
		} else {
			$cSQL="UPDATE school_class_periods SET periods = '".$period."', `desc` = '".$desc."' WHERE id = '".$id."'";
			$dbh_sSQL = $dbh->prepare($cSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		}
		break;
};


//Set paging appearence
$mypage ="admin_school_period.php";
$ezr->results_open = "<table width='65%' cellpadding=2 cellspacing=0 border=1 class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";// . $_SERVER['PHP_SELF'] . 
$ezr->results_row = "<tr>
	<td class='paging'>COL3</td>
	<td class='paging'>COL2</td>
	<td class='paging' align=center><a href=".$mypage."?action=edit&id=COL1 class='aform btn btn-default btn-sm'>&nbsp;Edit</a>
	<a name=href_remove href=#  onclick='cnfremove(COL1);' class='aform btn btn-danger btn-sm'>&nbsp;Delete</a></td></tr>";
$ezr->query_mysql("SELECT * FROM school_class_periods ORDER BY id");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>School Class Period</title>
<SCRIPT language="JavaScript">

/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
	var answer;	
	answer = window.confirm('Remove School Period?');
	if (answer == 1) {
		var url;
		url = "admin_school_period.php?action=remove&id=" + id;
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
	<h1>Manage School Periods</h1>
	<?php
	if ($action != "edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="add_school_period" method="post" action="admin_school_period.php">						
		  <p class="pform">Add New School Period<br>
	     School Period: <input type="text" placeholder="8:00am - 8:45am" onChange="capitalizeMe(this)" name="period" size="20"> <br />
	      Description: <input type="text" placeholder="First Period" onChange="capitalizeMe(this)" name="desc" size="20">&nbsp;<button type="submit" class="btn btn-primary">Add New</button>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	} else {
	?>
		<br>
		<form name="edit_school_periods" method="post" action="admin_school_period.php">
		  <p class="pform">Edit School Period<br>
	     Period: <input type="text" onChange="capitalizeMe(this)" name="period" size="20" value="<?php echo ($edit_period);?>"><br />
	     Description: <input type="text" onChange="capitalizeMe(this)" name="desc" size="20" value="<?php echo ($edit_desc);?>">&nbsp;<button type="submit" class="btn btn-primary">Update</button>
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