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
		$bank_id=get_param("id");
		if($norem=$db->get_results("SELECT staff_bank FROM staff WHERE staff_bank=$bank_id")){
			$msgFormErr=_ADMIN_SCHOOL_NAMES_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM bank WHERE id=$bank_id";
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "add":
		$name=get_param("bankname");
		//Check for duplicate school name
		$tot= $kas_framework->countRestrict1('bank', 'name', $name); 
		if($tot>0){
			$msgFormErr.=_ADMIN_SCHOOL_NAMES_DUP;
		}else{
			$sSQL="INSERT INTO bank (name) VALUES (".tosql($name, "Text").")"; 
			$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		};
		break;
	case "edit":
		$bank_id=get_param("id");
		$name = $kas_framework->getValue('name', 'bank', 'id', $bank_id);
		break;
	case "update":
		$bank_id=get_param("id");
		$name=get_param("bankname");
		$sSQL="UPDATE bank SET name='$name' WHERE id=$bank_id";
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $dbh_sSQL = null;
		break;

};


//Set paging appearence
$ezr->results_open = "<table width='65%' cellpadding=2 cellspacing=0 border=1 class='table table-striped table-bordered'>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class=paging width=70%>COL2</td>
<td class='paging'><a href=?action=edit&id=COL1 class='aform btn btn-default btn-sm'>&nbsp;" . _ADMIN_SCHOOL_NAMES_EDIT . "</a>
<a name='href_remove' href='#' onclick='cnfremove(COL1);' class='aform btn btn-danger btn-sm'>&nbsp;" . _ADMIN_SCHOOL_NAMES_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT id, name FROM bank ORDER BY id");
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
		url = "banks.php?action=remove&id=" + id;
		window.location = url; // other browsers
		href_remove.href = url; // explorer 
	}
	return false;
}

</SCRIPT>

</head>

<body >
<div id="Content" class="mycontent" style="padding:10px; box-shadow:10px 10px 80px #CCC;">
	<h1>Add Banks</h1>
	<br>
	<?php
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addschool" method="post" action="">						
		  <p class="pform">Add new bank Name<br>
	      <input type="text" onChange="capitalizeMe(this)" name="bankname" size="20">&nbsp;<A class="aform btn btn-primary btn-sm" href="javascript: submitform('bankname')"><?php echo _ADMIN_SCHOOL_NAMES_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	}else{
	?>
		<br>
		<form name="editschool" method="post" action="">						
		  <p class="pform">Rename Bank<br>
	      <input type="text" onChange="capitalizeMe(this)" name="bankname" size="20" value="<?php echo $name; ?>">&nbsp;<A class="aform" href="javascript: submitform('bankname')"><button type="submit" class="btn btn-primary">Update</button></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo $bank_id; ?>">
	      </p>
	    </form>
	<?php
	};
    ?>
	<h3><?php echo $msgFormErr; ?></h3>
	</div>
</body>

</html>
