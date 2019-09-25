<?php
 	//Include global functions
include_once "../../../includes/common.php";
//Initiate special database functions
include_once "../../../includes/true_mysql.php";
//Use common ez_sql stuff too
include_once "../../../includes/ez_sql.php";
// config
//include_once "../../../includes/configuration.php";

  session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
  {
    header ("Location: ../../../index.php?action=notauth");
	exit;
}

   
require_once('config.php'); 
//echo "no way";        
//exit;
// Database connection                                   
$mysqli = mysqli_init();
$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
$mysqli->real_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']); 
                      //echo $_GET['colname'];
// Get all parameters provided by the javascript
$colname = $mysqli->real_escape_string(strip_tags($_GET['colname']));// firstname
$id = $mysqli->real_escape_string(strip_tags($_GET['id'])); // id
$coltype = $mysqli->real_escape_string(strip_tags($_GET['coltype']));
$value = $mysqli->real_escape_string(strip_tags($_GET['newvalue'])); // new chnge
$tablename = $mysqli->real_escape_string(strip_tags($_GET['tablename'])); //studentbio
                                                
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
$return=false;                // update studentbio set firstname = $value where id = $id  

if ( $stmt = $mysqli->prepare("UPDATE ".$tablename." SET ".$colname." = ? WHERE id = ?")) {
	$stmt->bind_param("si",$value, $id);
	$return = $stmt->execute();
	$stmt->close();
	
}         

  
$mysqli->close();        

echo $return ? "ok" : "error";

      ?>