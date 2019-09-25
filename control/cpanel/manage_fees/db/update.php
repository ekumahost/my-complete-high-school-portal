<?php
	(file_exists('../../../php.files/classes/pdoDB.php'))? include ('../../../php.files/classes/pdoDB.php'): include ('../../../../php.files/classes/pdoDB.php');
	(file_exists('../../../php.files/classes/kas-framework.php'))? include ('../../../php.files/classes/kas-framework.php'): include ('../../../../php.files/classes/kas-framework.php');
		//Include global functions
	include_once "../../../includes/common.php";
	//Initiate special database functions
	include_once "../../../includes/true_mysql.php";
	// config
	//include_once "../../../includes/configuration.php";

	  session_start();
	if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
	  {
		header ("Location: ../../../index.php?action=notauth");
		exit;
	}


	// Get all parameters provided by the javascript
	$colname = htmlentities(strip_tags($_GET['colname']));// firstname
	$id = htmlentities(strip_tags($_GET['id'])); // id
	$coltype = htmlentities(strip_tags($_GET['coltype']));
	$value = htmlentities(strip_tags($_GET['newvalue'])); // new chnge
	$tablename = htmlentities(strip_tags($_GET['tablename'])); //studentbio
													
	// Here, this is a little tips to manage date format before update the table
	if ($coltype == 'date') {
	   if ($value === "") 
		 $value = NULL;
	   else {
		  $date_info = date_parse_from_format('d/m/Y', $value);
		  $value = "{$date_info['year']}-{$date_info['month']}-{$date_info['day']}";
	   }
	}                      

	// This very generic. So this script can be used to update several tables.
	$return=false;  // update studentbio set firstname = $value where id = $id  

	$editVal = "UPDATE ".$tablename."  SET ".$colname." = :value WHERE id = :id";
	$dbh_editVal = $dbh->prepare($editVal); 
	$dbh_editVal->bindParam(':value', $value); $dbh_editVal->bindParam(':id', $id);
	$chkExec = $dbh_editVal->execute(); $dbh_editVal = null;
		  

	echo ($chkExec)? "ok": "error";

?>