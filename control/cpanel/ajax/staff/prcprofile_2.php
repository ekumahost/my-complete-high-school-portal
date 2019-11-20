<?php
include_once('../../tools/public_functions.php');// SOME FUNCTIONS NEEDED
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

	//echo $_POST['stdid'].'id';
	$postid = DecodeToken(trim($_POST['stdid']));

	// switch case type for different forms

	$formtype = $_POST['mytype'];

	switch ($formtype){

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

	$postsgrade= "UPDATE teacher_grade_year SET grade_class = '$staffgrade', grade_class_room = '$staffroom', main_teacher = '$staff_gradetype' WHERE teacher = '$postid' AND session = '$post_session'";
	$dbh_sSQL_p = $dbh->prepare($postsgrade); $dbh_sSQL_p->execute(); $dbh_sSQL_p = null;

	if($rowCount == 1){
		echo '<font color = "green">Changes Saved successfully</font>'."<br>"; } else { echo '<font color = "red">Something Went wrong</font>';
	}
	break;

		
	case "staffname":

	// process the student profile data edit from ajax call
	// collect the form variables
	extract($_POST);
	// reformat the dob from html form from yyyy-mm-dd to dd/mm/yyyy
	$postnamedob = substr($dob, -2).'/'.substr($dob, -5, 2).'/'.substr($dob, 0, 4);
	// update database
	$postqueryname= "UPDATE staff SET staff_fname = '$fname', staff_mi = '$mname', staff_ethnicity = '$ethnicity', staff_birth_city = '$city', staff_state = '$state', staff_country = '$country', staff_dob = '$postnamedob' WHERE staff_id = '$postid'";
		$dbh_sSQL = $dbh->prepare($postqueryname); $dbh_sSQL->execute();  $rowCount = $dbh_sSQL->rowCount(); $dbh_sSQL = null;
		
		if($rowCount == 1){
			echo '<font color = "green">Changes Saved successfully</font>'."<br>";
		}else{
			echo '<font color = "red">Something went wrong</font>';
		}
	break;
		
	case "staff_contact":
		
	// process the student profile data edit from ajax call
	// collect the form variables
	extract($_POST);
	// update database
	$postquerycont= "UPDATE staff SET staff_adress = '$adr', staff_res_town = '$town', staff_res_state = '$rstate', staff_mobile = '$mobile' WHERE staff_id = '$postid'";
	$dbh_sSQL = $dbh->prepare($postquerycont); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount(); $dbh_sSQL = null;

		if($rowCount == 1){
			echo '<font color = "green">Changes Saved successfully</font>'."<br>";
		}else{
			echo '<font color = "red">Something went wrong</font>';
		}
	break;	
		
	case "staff_kin":
		
	// process the student profile data edit from ajax call
	// collect the form variables
	extract($_POST); 
	// update database
	$postquerycont= "UPDATE staff SET staff_kin_adress = '$adr', staff_kin_name = '$name', staff_kin_email = '$email', staff_kin_phone = '$mobile', staff_kin_relationship = '$relation' WHERE staff_id = '$postid'";
	$dbh_sSQL = $dbh->prepare($postquerycont); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount(); $dbh_sSQL = null;

		if ($rowCount == 1){
			echo '<font color = "green">Changes Saved successfully</font>'."<br>";
		}else{
			echo '<font color = "red">Something went wrong</font>';
		}	
	break;	
		

	case "bank_form":
		
	// process the student profile data edit from ajax call
	// collect the form variables
	extract($_POST);
	// update database
	$postquerycont= "UPDATE staff SET staff_salary_type = '$scale', staff_bank = '$bank', staff_account = '$acc', staff_acc_name = '$acc_name', staff_act_type = '$type', staff_bank_sort = '$sort' WHERE staff_id = '$postid'";
	$dbh_sSQL = $dbh->prepare($postquerycont); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount(); $dbh_sSQL = null;
		if ($rowCount == 1){
			echo '<font color = "green">Changes Saved successfully</font>'."<br>";
		} else {
			echo '<font color = "red">Something went wrong</font>';
		}	
	break;	
		

	default:
	echo "We got Confused";
	
}// switch ends
	
?>	
