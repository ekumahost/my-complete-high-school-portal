<?php
//error_reporting(0);
define('configuration', true);
DEFINE ('_VALID', 1);
include "lang_en.php";
//include "inc_secure.php";
DEFINE ('_LANG', 'en');

$portalurl ="http://localhost/hisp/control/";
$timeouting = 600000;// seconds

/*
	if (!defined('MC')) {
		define('MC', 1);
		function mc_connect() {
			try {
				$m = new Memcache();
				$m->addServer('unix:///home/sys/memcached.sock', 0);
				return $m;
			} catch (Exception $e) {
				return false;
			}
		}

		function mc_get($key) {
			if (!($mc = mc_connect()))
				return false;

			return $mc->get($key);
		}

		function mc_set($key, $value, $ttl = 60) {
			if (!($mc = mc_connect()))
				return false;

			return $mc->set($key, $value, 0, $ttl);
		}
	}
*/

// PDO Database connection
$dbh = false;
$database_host = 'localhost';
$database_user = 'root';
$database_pass = '';
$database_db = 'school_portal';
$database_type = 'mysql';

 $dsn = $database_type.":dbname=".$database_db.";host=".$database_host;
	try {
		$dbh = new PDO($dsn, $database_user, $database_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $kas) {
		exit($kas->getMessage());
	}

// MYSQLi Database connection
$mysqli = mysqli_init();
$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
$mysqli->real_connect($database_host, $database_user, $database_pass, $database_db); 

$SMTP_SERVER = ' ';
$SMTP_USER = ' ';
$SMTP_PASSWORD = ' ';
$SMTP_FROM_NAME = ' ';
$SMTP_FROM_EMAIL = ' ';
$SMTP_REPLY_TO = ' ';


//added by the ultimate keliv
function secureStr($string) {
	$string = htmlentities(stripslashes($string));
	//$string = mysql_real_escape_string($string);
	return $string;
}

function strIsEmpty($str){
	return strlen(trim($str))==0? true: false;
} 

function getValue(string $field, string $table, string $priKeyField, $priKeyValue) {
		global $dbh;
		try {
			$sql = "SELECT * FROM {$table} WHERE {$priKeyField} = :priKeyValue LIMIT 1";
			$db_handle = $dbh->prepare($sql);
			$check_exec = $db_handle->execute(array(':priKeyValue' => $priKeyValue));
			$rows_affected = $db_handle->rowCount();		//count the number of returned rows
				if ($check_exec == false) { 
					$data = ''; 
				} else if ($rows_affected === 0) { 
					$data = '';  
				} else {
					$fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ);
					$data = $fetch_obj->$field; 
				} 
			$db_handle = null;
			return $data;	
		} catch (PDOException $kastech) {
			echo $kastech->getMessage();
		}
	}

function curl_download($url) {
    global $portalurl;
    if (!function_exists('curl_init')) {
        die ("Sorry. Curl Library not found yet");
    } else {
        $ch = curl_init(); //initializer the curl library
        curl_setopt($ch, CURLOPT_URL, $url); //set url to download
        curl_setopt($ch, CURLOPT_REFERER, $portalurl.'cpanel/main?page'); //set the referer url
        curl_setopt($ch, CURLOPT_HEADER, 0); //include header in result, 1 = yes, 0 = no
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //true = return data, false = print
        curl_setopt($ch, CURLOPT_TIMEOUT, 20); // in seconds
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}

/**
 * fetch_pairs is a simple method that transforms a mysqli_result object in an array.
 * It will be used to generate possible values for some columns.
*/
function fetch_pairs($mysqli, $query) {
	if (!($res = $mysqli->query($query)))return FALSE;
	$rows = array();
	while ($row = $res->fetch_assoc()) {
		$first = true;
		$key = $value = null;
		foreach ($row as $val) {
			if ($first) { $key = $val; $first = false; }
			else { $value = $val; break; } 
		}
		$rows[$key] = $value;
	}
	return $rows;
}
?>