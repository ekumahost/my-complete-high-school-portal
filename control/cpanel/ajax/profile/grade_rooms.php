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

// collect student id from the post url
$id = $_GET['id'];
// the room id selected
$cmt = "roomie".$id;
@$roomid = $_POST[$cmt];
//current year
$ccyear = $_POST['ccyear'];
//grade year colum 
$grade_yr_id = $_POST['grade_yr_id'];

// run the update query
$updateroom = "UPDATE student_grade_year SET student_grade_year_class_room = '$roomid' WHERE student_grade_year_year = '$ccyear' AND student_grade_year_id='$grade_yr_id' AND student_grade_year_student ='$id'";
$dbh_sSQL = $dbh->prepare($updateroom); $rowCount = $dbh_sSQL->rowCount(); $dbh_sSQL->execute(); $dbh_sSQL = null;
if($rowCount > 0){
	echo '<font color="green">Assigned to room id: '.$roomid.'</font><span class="icon icon-color icon-check"></span>';
 } else {
	 echo '<font color="red">Error Occurred</font><span class="icon icon-red icon-close"></span>';
}
?>