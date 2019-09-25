<?php

//include("../../../includes/configuration.php");


$do ='one';
if ($do != 'one'){echo'ha'; exit;}

$config = array(
	"db_name" => 'hisp',
	"db_user" => 'root',
	"db_password" => '',
	"db_host" => 'localhost'
);                

//error_reporting(E_ALL);
ini_set('display_errors', '1');

?>
