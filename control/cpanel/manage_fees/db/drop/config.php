<?php

//include("../../../includes/configuration.php");


$do ='one';

if ($do != 'one'){echo'ha'; exit;}

$config = array(
	"db_name" => $db_name,
	"db_user" => $db_user,
	"db_password" => $db_password,
	"db_host" => $db_server
);                

error_reporting(E_ALL);
ini_set('display_errors', '1');

?>
