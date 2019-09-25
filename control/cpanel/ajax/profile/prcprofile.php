
<?php
include_once('../../tools/public_functions.php');// SOME FUNCTIONS NEEDED
//Include global functions
include_once "../../../includes/common.php";
// config
include_once "../../../includes/configuration.php";

	// check session
	session_start();
	if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
  {
  echo '<font color = "red">Something is not right:'.' You are not logged in, please login'.'</font>';
exit;
  }
	
$postid = DecodeToken(trim($_POST['stdid']));
// switch case type for different forms
$formtype = $_POST['mytype'];
switch ($formtype){
case "name":

// process the student profile data edit from ajax call
// collect the form variables
extract($_POST);
$postnamedob = substr($dob, -2).'/'.substr($dob, -5, 2).'/'.substr($dob, 0, 4);
// update database
$postqueryname = "UPDATE studentbio SET studentbio_fname = '$fname', studentbio_mname = '$mname', studentbio_ethnicity = '$ethnicity', studentbio_birthcity = '$city', studentbio_birthstate = '$state', studentbio_dob = '$postnamedob' WHERE studentbio_id = '$postid'";
$dbh_sSQL = $dbh->prepare($postqueryname); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount(); $dbh_sSQL = null;

if($rowCount !=0){
	echo '<font color = "green">Changes Saved successfully</font>'."<br>";
}else{
	echo '<font color = "red">Something went wrong</font>';
	//echo $postid;
}
break;

case "profile":


// process the student profile data edit from ajax call
// collect the form variables
extract($_POST);

// update database
$postqueryyr= "UPDATE `studentbio` SET `studentbio_entry_year` = '$entryyear' WHERE `studentbio_id` = '$postid'";
$dbh_sSQL = $dbh->prepare($postqueryyr); $dbh_sSQL->execute(); $yrafect = $dbh_sSQL->rowCount(); $dbh_sSQL = null;

$postquerydeno= "UPDATE `web_students` SET `denomination` = '$deno' WHERE `stdbio_id` = '$postid'";
$dbh_sSQL = $dbh->prepare($postquerydeno); $dbh_sSQL->execute(); $denoafect = $dbh_sSQL->rowCount(); $dbh_sSQL = null;


if($logon!=""){
	// he wants to block the student from login or activate the email
	$postquerylogon = "UPDATE `web_students` SET `status` = '$logon' WHERE `stdbio_id` = '$postid'";
	$dbh_sSQL = $dbh->prepare($postquerylogon); $dbh_sSQL->execute(); $rowCount_Exclusive = $dbh_sSQL->rowCount(); $dbh_sSQL = null;
	
	if($rowCount_Exclusive > 0 && $logon==0){
		echo '<font color = "green">Student check in is blocked </font>'."<br>";

	}else if ($rowCount_Exclusive > 0 && $logon==1){
			echo '<font color = "green">Student Email activated </font>'."<br>";

	}else if ($rowCount_Exclusive > 0 && !is_numeric($logon)){
			echo '<font color = "green">Student Forced to verify email again </font>'."<br>";

	} else {
	if($rowCount_Exclusive == 0){
		//it seems like no changes made, the message down will catch it
	} else {
		echo '<font color = "blue">Something is wrong: cannot change Check in status--'.mysql_error().'</font>';
	}
	
	}
	}
	if($yrafect==1){
	echo '<font color = "green">Entry year changed</font>'."<br>";
	}

	if($denoafect==1){
	echo '<font color = "green">Denomination Changed </font>'."<br>";
	}else{
	echo '<font color = "black">No changes made elsewhere:</font>';
	}

	break;


	case "contact":

	// process the student profile data edit from ajax call
	// collect the form variables
	extract($_POST);
	
	// update database
	$postquerycont= "UPDATE studentbio SET std_bio_address = '$adr', std_bio_resident_town = '$town', std_bio_resident_state = '$rstate', std_bio_phone = '$phone', std_bio_mobile = '$mobile' WHERE studentbio_id = '$postid'";
	$dbh_sSQL = $dbh->prepare($postquerycont); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount(); $dbh_sSQL = null;
	if($rowCount != 0){
		echo '<font color = "green">Changes Saved successfully</font>'."<br>";
	}else{
		echo '<font color = "red">Something went wrong </font>';
	}

	break;
	
	case 'photo':
	// replace the user photo and keep the name of the old one. do not delete
	include ('upload_picture.php');
		echo "<hr />Process is complete, you can update the image by choosing another one above. Click Continue if you are done";
	break;

	default:
	echo "We got Confused";
		
}// switch ends

?>	
