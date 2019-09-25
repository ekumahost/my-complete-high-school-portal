<?php
//*
// admin_mass_email.php
// Admin Section
// Send email message to selected recipients or all
//*

//Check if admin is logged in
session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

// take up
include_once "../../includes/configuration.php";
// config
include_once "../../includes/common.php";
//Include paging class

//Get list of rooms
$sSQL="SELECT * FROM school_rooms ORDER BY school_rooms_id";
$dbh_Query = $dbh->prepare($sSQL);
$dbh_Query->execute();
$rooms = $dbh_Query->fetch(PDO::FETCH_OBJ);
$dbh_Query = null;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>MASS MAIL</title>
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
</SCRIPT>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body>
<div style="background-color:#CCC; color:#000; text-align:right; padding:5px; font-variant:small-caps">
<a href="../main?page=schoolapp&tools=api#mainsetting" target="_blank"><?php echo "Configure SMTP Here" ?></a>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_MASS_EMAIL_TITLE?></h1>
	<table width="85%">
	    <tr> 
	      <td>
			  <p class="ltext"><?php echo _ADMIN_MASS_EMAIL_SUBTITLE?></p>
		  </td>
		</tr>
		  <form name="massmail" method="post" action="admin_process_mass_mail.php">
		<tr>
		  <td class="tdinput"><?php echo _ADMIN_MASS_EMAIL_SEND?> : <br>
		    <input type="radio" value="studentcontact" checked name="mailto"> <?php echo _ADMIN_MASS_EMAIL_CONTACTS?>
		    <?php echo _ADMIN_MASS_EMAIL_ROOM?>
		    <select name="room">
		    <?php
		    echo "<option value=all selected='selected'>"._ADMIN_MASS_EMAIL_ALL."</option>";
		    foreach(@$rooms as $room){
		      echo "<option value=".$room->school_rooms_id.">".$room->school_rooms_desc."</option>";
		    }
		    ?>
		    </select><br>

		    <input type="radio" value="teachers" name="mailto"> <?php echo _ADMIN_MASS_EMAIL_TEACHERS?><br>
		    <input type="radio" value="both" name="mailto"> <?php echo _ADMIN_MASS_EMAIL_BOTH?><br>
		    <?php echo _ADMIN_MASS_EMAIL_SUBJECT?> :<br>
		    <input type="text" name="subject" size="50" placeholder="Enter the Heading"><br>
		 </td>
	  </tr>
	  <tr> 
	      <td class="tdinput">
		  <?php echo _ADMIN_MASS_EMAIL_MESSAGE?> : <br>
	        <textarea name="message" cols="65" rows="6" placeholder="Enter Message Here"></textarea>
	      </td>
     </tr>
	 <tr> 
		<td><b><a href="javascript: submitform('message')" class="aform"> <i class="icon-inbox"></i> 
        <button class="btn btn-default btn-sm"><?php echo _ADMIN_MASS_EMAIL_NOW?></button></a></b></td>
  </tr>					  
  </form>
 </table>
</div>
<?php //include "admin_menu.inc.php"; ?>
</body>

</html>
