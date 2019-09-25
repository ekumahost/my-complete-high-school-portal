<?php
//include('security/fake.php');// we define DIRECT PASS, 
// Include configuration file
//include('tools/config.php');
//$page_title = "DASHBOARD";
//$title =$tintro.$page_title."--".$app_name_space;
//include_once "../includes/configuration.php";

//Check if admin is logged in
session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A") {
    header ("Location: ../index.php?action=notauth");
	exit;	
}

header("location: home"); exit;
 ?>