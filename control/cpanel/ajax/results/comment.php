<?php
	//Include global functions
include_once "../../../includes/common.php";
// config
include_once "../../../includes/configuration.php";
	
	// check session
	session_start();
	if(!isset($_SESSION['UserID'])) {
	  echo '<font color = "red">Something is not right:'.' You are not logged in, please login'.'</font>';
	exit;
  }
	
// collect the comment id frm the action url
$id = $_GET['id'];
// since the comment input is commentid, append the id to id and know what we collect in the posted comment
$cmt = "comment".$id;
@$comment = $_POST[$cmt];
$principal_sign = $_POST['admin'];

//@$comment = $_POST['comment'];
$admintype = $_POST['admintype'];

if($admintype =="X"){
// run the update query
$updatecomment = "UPDATE std_report_cards SET c_principal = '$comment', dig_sign_principal = '$principal_sign' WHERE id = '$id'";
$dbh_sSQL = $dbh->prepare($updatecomment); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount(); $dbh_sSQL = null;

if($rowCount == 1){
	echo '<font color="green">Saved as: '.$comment.'</font><span class="icon icon-color icon-check"></span>';}
	else { echo '<font color="red">Error. Something Went Wrong </font><span class="icon icon-red icon-close"></span>';}
// 
} else{
	echo '<font color="red">Boo! We told you, You do not comment here.</font><span class="icon icon-red icon-close"></span>';
}


?>	

