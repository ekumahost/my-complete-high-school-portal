<?php

//Include global functions
include_once "../../../includes/common.php";
// config
include_once "../../../includes/configuration.php";
	
	// check session
	session_start();
	if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A") {
		echo '<font color = "red">Something is not right:'.' You are not logged in, please login'.'</font>';
		exit;
	  }
	
	@$postid = $_POST['stdid'];
	// switch case type for different forms
	$formtype = $_POST['mytype'];

	switch ($formtype){
	case "name":
	// process the student profile data edit from ajax call
	// collect the form variables
	extract($_POST);
	// update database
	$postqueryname="UPDATE studentbio SET studentbio_fname = '$fname', studentbio_mname = '$mname', studentbio_oname = '$oname', studentbio_ethnicity = '$ethnicity', studentbio_birthcity = '$city', studentbio_birthstate = '$state', studentbio_dob = '$dob' WHERE studentbio_id = '$postid'";
	$dbh_sSQL = $dbh->prepare($postqueryname); $dbh_sSQL->execute(); $dbh_sSQL = null;

	if ($postqueryname){
		echo '<font color = "green">Changes Saved succesfully</font>'."<br>";
	} else {
		echo '<font color = "red">Something went wrong</font>';
	}
	break;

	case "profile":
	// process the student profile data edit from ajax call
	// collect the form variables
	@$postentryyr = $_POST['entryyear'];
	@$postdeno = $_POST['deno'];

	$dbh->beginTransaction();
	// update database
	$postqueryyr = "UPDATE studentbio SET studentbio_entry_year = '$postentryyr' WHERE studentbio_id = '$postid'";
	$dbh_sSQL = $dbh->prepare($postqueryyr); $dbh_sSQL->execute(); $rowCount1 = $dbh_sSQL->rowCount(); $dbh_sSQL = null;
	$postquerydeno = "UPDATE web_students SET denomination = '$postdeno' WHERE stdbio_id = '$postid'";
	$dbh_sSQL1 = $dbh->prepare($postquerydeno); $dbh_sSQL1->execute(); $rowCount2 = $dbh_sSQL1->rowCount(); $dbh_sSQL1 = null;

	if($rowCount1 > 0 and $rowCount2 > 0){
		$dbh->commit();
		echo '<font color = "green">Changes Saved succesfully</font>'."<br>";
	} else {
		$dbh->rollBack();
		echo '<font color = "red">Something went wrong</font>';
	}

	//echo "From Server".json_encode($_POST)."<br>";
	
	break;
	case "contact":
	// process the student profile data edit from ajax call
	// collect the form variables
	extract($_POST);
	// update database
	$postquerycont= "UPDATE studentbio SET std_bio_address = '$adr', std_bio_resident_town = '$town', std_bio_resident_state = '$rstate', std_bio_phone = '$phone', std_bio_mobile = '$mobile' WHERE studentbio_id = '$postid'";
	$dbh_sSQL = $dbh->prepare($postquerycont); $dbh_sSQL->execute(); $dbh_sSQL = null;


	if($postquerycont){
		echo '<font color = "green">Changes Saved succesfully</font>'."<br>";
	}else{
		echo '<font color = "red">Something went wrong</font>';
	}
	break;

	case 'photo': // used for staff
	// replace the user photo and keep the name of the old one. do not delete
		include ('upload_picture.php');
			echo "<br>Processing is complete, you can update the image by choosing another one above. click continue if you are done";

	break;
	
	case "staffprofile":
	// process the staff profile data edit from ajax call
	// collect the form variables
	extract($_POST);
	// update database
	$postqueryyr= "UPDATE staff SET staff_entry_year = '$entryyear', staff_id_no = '$idno', staff_school = '$staffschool' WHERE staff_id = '$postid'";
	$dbh_sSQL = $dbh->prepare($postqueryyr); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount(); $dbh_sSQL = null;

	if($rowCount > 0){
		echo '<font color = "green">Changes Saved succesfully</font>'."<br>";
	} else {
		echo '<font color = "red">Something went wrong! </font>';
	}
	//echo "From Server".json_encode($_POST)."<br>";
	break;
	
	case "staffname":
	// process the student profile data edit from ajax call
	// collect the form variables
	extract($_POST);
	// reformat the dob from html form from yyyy-mm-dd to dd/mm/yyyy
	$postnamedob = substr($dob, -2).'/'.substr($dob, -5, 2).'/'.substr($dob, 0, 4);
	// update database
	$postqueryname= "UPDATE staff SET staff_fname = '$fname', staff_mi = '$mname', staff_ethnicity = '$ethnicity', staff_birth_city = '$city', staff_state = '$state', staff_country = '$country', staff_dob = '$postnamedob' WHERE staff_id = '$postid'";
	$dbh_sSQL = $dbh->prepare($postqueryname); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount();$dbh_sSQL = null;

	if($rowCount == 1){
		echo '<font color = "green">Changes Saved succesfully</font>'."<br>";
	} else {
		echo '<font color = "red">Something went wrong</font>';
	}

	break;
		
	case "staff_contact":
	// process the student profile data edit from ajax call
	// collect the form variables
	extract($_POST);

	// update database
	$postquerycont= "UPDATE staff SET staff_adress = '$adr', staff_res_town = '$town', staff_res_state = '$postrstate', staff_mobile = '$mobile' WHERE staff_id = '$postid'";
	$dbh_sSQL = $dbh->prepare($postquerycont); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount();$dbh_sSQL = null;

		if($rowCount == 1){
			echo '<font color = "green">Changes Saved succesfully</font>'."<br>";
		} else {
			echo '<font color = "red">Something went wrong </font>';
		}
		break;	
		
	case "staff_kin":
	// process the student profile data edit from ajax call
	// collect the form variables
	extract($_POST);
	// update database
	$postquerycont= "UPDATE staff SET staff_kin_adress = '$adr', staff_kin_name = '$name', staff_kin_email = '$email', staff_kin_phone = '$mobile', staff_kin_relationship = '$relation' WHERE staff_id = '$postid'";
	$dbh_sSQL = $dbh->prepare($postquerycont); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount();$dbh_sSQL = null;

	if($rowCount == 1){
		echo '<font color = "green">Changes Saved succesfully</font>'."<br>";
	} else {
		echo '<font color = "red">Something went wrong</font>';
	}
	break;	
		

	case "bank_form":
	// process the student profile data edit from ajax call
	// collect the form variables
	extract($_POST);
	// update database
	$postquerycont= "UPDATE staff SET staff_salary_type = '$scale', staff_bank = '$bank', staff_account = '$acc', staff_acc_name = '$acc_name', staff_act_type = '$type', staff_bank_sort = '$sort' WHERE staff_id = '$postid'";
	$dbh_sSQL = $dbh->prepare($postquerycont); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount();$dbh_sSQL = null;

	if($rowCount == 1){
		echo '<font color = "green">Changes Saved succesfully</font>'."<br>";
	} else {
		echo '<font color = "red">Something went wrong</font>';
	}

break;	
	
default:
echo "We got Confused";

}// switch ends
	
?>	
