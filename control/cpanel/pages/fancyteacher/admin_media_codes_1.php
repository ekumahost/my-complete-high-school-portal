<?php
/*
THIS SCRIPT IS USED BY HYPERSCHOOL
*/

//Check if admin is logged in
session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

exit('Function is Deprecated. Please contact Developer');

//Include global functions
include_once "../../../includes/common.php";
//Initiate database functions
include_once "../../../includes/ez_sql.php";
//Include paging class
include_once "../../../includes/ez_results.php";
// config
include_once "../../../includes/configuration.php";
$msgFormErr="";

//Check what we have to do
$action=get_param("action");
$sort=get_param("sort");

if (!strlen($action))
	$action="none";
//Add or Media entries according to admin choice
switch ($action){
	case "remove":
		$media_codes_id=get_param("id");
		if($norem=$db->get_results("SELECT media_history_code FROM media_history WHERE media_history_code='".$media_codes_id."'")){
			$msgFormErr=_ADMIN_MEDIA_CODES_1_DELETE;
		}else{
			$sSQL="DELETE FROM media_codes WHERE media_codes_id='".$media_codes_id."'";
			$db->query($sSQL);
		};
		break;
case "add":
		$media_codes_desc=get_param("medianame");
		$media_codes_id1=get_param("id1");
		$media_codes_id2=get_param("id2");
		/*Duplicates are fine (i.e. textbooks) so don't check for them
		$tot = $db->get_var("SELECT count(*) FROM media_codes WHERE media_codes.media_codes_desc='".$media_codes_desc."'");
		if ($tot>0){
			$msgFormErr=_ADMIN_MEDIA_CODES_1_DUP;
		}else{
		*/	
		$sSQL="INSERT INTO media_codes (media_codes_desc, id1, id2) 
		VALUES (".tosql($media_codes_desc, "Text")." ,'".$media_codes_id1."', '".$media_codes_id2."')"; 
		$db->query($sSQL);
		//};
		break;
	case "edit":
		$media_codes_id=get_param("id");
		$sSQL="SELECT media_codes_desc, id1, id2 FROM media_codes WHERE 
media_codes_id=$media_codes_id";
		$media_all= $db->get_row($sSQL);
		$media_codes_desc = $media_all->media_codes_desc;
		$id1=$media_all->id1;
		$id2=$media_all->id2;
		// echo $media_codes_desc, $id1, $id2;
		break;
	case "update":
		$media_codes_id=get_param("id");
		$media_codes_desc=get_param("medianame");
		$sSQL="UPDATE media_codes SET media_codes_desc='$media_codes_desc' WHERE media_codes_id='".$media_codes_id."'";
		$db->query($sSQL);
		break;

};


//Set paging appearence
$ezr->results_open = "<table width=90% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_heading = "<tr class=tblhead>
<td width=30% align=left><a href=\"admin_media_codes_1.php?sort=line1\">" . _ADMIN_MEDIA_CODES_1_LINE_1 . "</a></td>
<td width=20% align=left><a href=\"admin_media_codes_1.php?sort=line2\">" . _ADMIN_MEDIA_CODES_1_LINE_2 . "</a></td>
<td width=20% align=left><a href=\"admin_media_codes_1.php?sort=line3\">" . _ADMIN_MEDIA_CODES_1_LINE_3 . "</a></td>
	<td width=15% align=left>&nbsp;</td>
	<td width=15% align=left>&nbsp;</td></tr>";
$ezr->results_row = "<tr>
	<td class=paging width=30%>COL2</td>
	<td class=paging width=20%>COL3</td>
	<td class=paging width=20%>COL4</td>
	<td class=paging width=15% align=center>
	  <a href=admin_media_codes_1.php?action=edit&id=COL1 class=aform>&nbsp;" . _ADMIN_MEDIA_CODES_1_EDIT . "</a></td>
	<td class=paging width=15% align=center>
	  <a name=href_remove href=# onclick=cnfremove(COL1); class=aform>&nbsp;" . _ADMIN_MEDIA_CODES_1_REMOVE . "</a></td>
	  </tr>";
$sSQL = "SELECT media_codes_id, media_codes_desc, id1, id2 FROM media_codes ";
switch ($sort) {
case "line1":
        $order = "media_codes_desc, id1, id2";
	break;
case "line2":
	$order = "id1, id2";
	break;
case "line3":
	$order = "id2";
	break;
default:
	$order = "media_codes_id, media_codes_desc, id1, id2";
	break;
}
$sSQL .= "ORDER BY " . $order;
$ezr->query_mysql($sSQL);
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
	answer = window.confirm("<?php echo _ADMIN_MEDIA_CODES_1_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_media_codes_1.php?action=remove&id=" + id;
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

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_MEDIA_CODES_1_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_MEDIA_CODES_1_TITLE?></h1>
	<br>
	<?php
	if ($action!="edit"){ 

		//Display results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addmedia" method="post" action="admin_media_codes_1.php">
		<table border="0">
		<tr>
		  <td colspan="3"><p class="pform"><h2><?php echo _ADMIN_MEDIA_CODES_1_ADD_NEW?></h2></td>
		</tr>
		<tr>
		  <td colspan="3">&nbsp;</td>
		</tr>
		<tr>
		  <td><?php echo _ADMIN_MEDIA_CODES_1_LINE_1;?></td>
		  <td><input type="text" onChange="capitalizeMe(this)" name="medianame" size="30">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		<tr>
		  <td><?php echo _ADMIN_MEDIA_CODES_1_LINE_2;?></td>
		  <td><input type="text" onChange="capitalizeMe(this)" name="id1" size="30">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		<tr>
		  <td><?php echo _ADMIN_MEDIA_CODES_1_LINE_3;?></td>
		  <td><input type="text" onChange="capitalizeMe(this)" name="id2" size="30"></td>
		  <td><a class="aform" href="javascript: submitform('medianame')">
		  <?php echo _ADMIN_MEDIA_CODES_1_ADD?></a></td>
		</tr>
		</table>
		<input type="hidden" name="action" value="add">
		</form>
	<?php
	}else{
	?>
		<br>
		<form name="editmedia" method="post" action="admin_media_codes_1.php">
		<table border="0">
                <tr>
		  <td colspan="3"><p class="pform"><h2><?php echo _ADMIN_MEDIA_CODES_1_UPDATE?></h2></td>
		</tr>
		<tr>
		  <td colspan="3">&nbsp;</td>
		</tr>
                <tr>
		  <td><?php echo _ADMIN_MEDIA_CODES_1_LINE_1;?></td>
		  <td><input type="text" onChange="capitalizeMe(this)" name="medianame" size="30" value="<?php echo $media_codes_desc; ?>">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
                <tr>
		  <td><?php echo _ADMIN_MEDIA_CODES_1_LINE_2;?></td>
		  <td><input type="text" onChange="capitalizeMe(this)" name="id1" size="30" value="<?php echo $id1; ?>">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
                <tr>
		  <td><?php echo _ADMIN_MEDIA_CODES_1_LINE_3;?></td>
		  <td><input type="text" onChange="capitalizeMe(this)" name="id2" size="30" value="<?php echo $id2; ?>">&nbsp;</td>
		  <td><a class="aform" href="javascript: submitform('medianame')">
		  <?php echo _ADMIN_MEDIA_CODES_1_ADD?></a></td>
		</tr>
		</table>
		<input type="hidden" name="action" value="update">
		<input type="hidden" name="id" value="<?php echo $media_codes_id; ?>">
		</form>
	<?php
	};
	?>
	<br>
	<form name="userdays" action="" method="post">
	<table>
	<tr>
	  <!-- ask user how many days (0-7) -->
	  <td width="100%" align="left">
	  <select name="days">
	    <option value="0">0</option>
	    <option value="1">1</option>
	    <option value="2">2</option>
	    <option value="3">3</option>
	    <option value="4">4</option>
	    <option value="5">5</option>
	    <option value="6">6</option>
	    <option value="7" selected="selected">7</option>
	  </select>
	  <?php echo _ADMIN_MEDIA_CODES_1_DAYS; ?>
	  &nbsp; &nbsp;<a class="aform" href="javascript: document.userdays.submit()"><?php echo _ADMIN_MEDIA_CODES_1_CHECK; ?></a>
	</tr>
	</table>
	</form>
	<h3><?php echo $msgFormErr; ?></h3>
</div>
<?php //include "admin_maint_tables_menu.inc.php"; ?>
</body>

</html>
