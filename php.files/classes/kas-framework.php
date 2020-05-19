<?php 

/*  kAsTech FrameWork v2.6
	Designed by: kAsTechnology Network
	Developer: Kelvin Ugbana
	Lagos, Nigeria
	Date: 13th July 2019
	
	Changelog: 
		v2.3 	Added XXS attack security ::: v2.4 	Safe Logout Function ::: v2.41 	Added the String2Stars algorithm ::: v2.42	Added the roundDown() function
		v2.5	Added the Execute Arrays
		v2.6	Upgraded the curl function
				
*/

declare(strict_types=1);
require 'private-config.php';
require 'AntiXSS.php';
require 'csrf.class.php';
require 'constants.php';

// Tell PHP that we're using UTF-8 strings until the end of the script
mb_internal_encoding('UTF-8');
 
// Tell PHP that we'll be outputting UTF-8 to the browser
mb_http_output('UTF-8');

//error_reporting(0);
// add define ('USE_MEMCACHE', '1');  to constant file before updating this framework

class kas_framework extends configurations {
	
	public function __construct() {
		 if (substr($_SERVER['REQUEST_URI'], -4) == '.php' or stripos($_SERVER['REQUEST_URI'], '.php') == true) {
			//self::_redirect('404');
			header("HTTP/1.0 404 Not Found");
		}
    }
	
	 public function __destruct() {
        //Close any open connection nicely
        //global $dbh;
		//$dbh = null;
    }
	
	public function _redirect($flink=false) { 
		echo '<script type="text/javascript"> self.location = "'.self::url_root($flink).'" </script>';	
		//header('Location: '.self::url_root($flink));
		exit;
	}
	
	public function _raw_redirect($flink=false) { 	
		echo '<script type="text/javascript"> self.location = "'.$flink.'" </script>'; 
		//header('Location: '.self::url_root($flink));
		exit;
	}
	
	//For my Private Functions, we need to use this..
	public function safesession() {
		@session_start();
	}
	
	public function getAbsoluteURL(): string {
		$myUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && !in_array(strtolower($_SERVER['HTTPS']),array('off','no'))) ? 'https' : 'http';
		$myUrl .= '://'.$_SERVER['HTTP_HOST'];
		$myUrl .= $_SERVER['REQUEST_URI'];
		if (!empty($_SERVER['PATH_INFO'])) $myUrl .= $_SERVER['PATH_INFO'];
		//if (!empty($_SERVER['QUERY_STRING'])) $myUrl .= '?'.ltrim($_SERVER['REQUEST_URI'],'?');
		return $myUrl;
	}
	
	public function getCookie($cname) {
		return (@$_COOKIE[$cname] != '')? $_COOKIE[$cname]: '';
	}
	
	public function loading($centered=false) {
		$init1 = ($centered == true)? '<center>': ''; $init2 = ($centered == true)? '</center>': '';
		$loadingImageUrl =  ' <img src="'.self::url_root('images/loader.gif').'" width="35" style="margin:8px 0" />';
		echo $init1 .$loadingImageUrl. $init2;
	}
	
	public function loading_h($centered=false) {
		$init1 = ($centered == true)? '<center>': ''; $init2 = ($centered == true)? '</center>': '';
		$loadingImageUrl =  ' <img src="'.self::url_root('images/loader_h.gif').'" style="margin:8px 0" />';
		echo $init1 .$loadingImageUrl. $init2;
	}
	
	//render a path safely
	public function render_file($path, $type='include') {
        ob_start();
		if ($type == 'include') include($path);
		if ($type == 'require') require($path);       
        return ob_get_clean();
    }

	public function strIsEmpty(string $str) : bool {
		return (strlen(trim($str)) <=> 0) === 0 ? true: false;
	} 
	
	public function getValue(string $field, string $table, string $priKeyField, $priKeyValue) {
		global $dbh;	
		try {
			$db_handle = $dbh->prepare("SELECT * FROM {$table} WHERE {$priKeyField} = ? LIMIT 1");
			$check_exec = $db_handle->execute([$priKeyValue]);
			$rows_affected = $db_handle->rowCount();		//count the number of returned rows
				if ($check_exec == false or $rows_affected === 0) { 
					$data = ''; 
				} else {
					$fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ);
					$data = $fetch_obj->$field; 
				} 
			$db_handle = null;
			return $data;	
		} catch (PDOException $error_log) {
			echo $error_log->getMessage();
		}
	}
	
	
	public function getallFieldinDropdownOption(string $table, string $field, $stor_val, $matchField=false) {
		global $dbh;	
		try {
			$db_handle = $dbh->prepare("SELECT * FROM {$table} ORDER BY {$field} ");
			$db_handle->execute();
				while ($rw = $db_handle->fetch(PDO::FETCH_ASSOC)) {
					$selectedCheck = ($rw[$stor_val] == $matchField) ? 'selected=selected': '';
					echo '<option value="'.$rw[$stor_val].'" '.$selectedCheck.'>' .$rw[$field]. '</option>';
				}
			$db_handle = null;
		} catch (PDOException $error_log) {
			$error_log->getMessage();
		}
	}
	
	public function getallFieldinDropdownOptionWithRestriction($table, $field, $priKeyField, $priKeyValue, $stor_val, $currentValue=false) {
		global $dbh;	
		try {
			$db_handle = $dbh->prepare("SELECT * FROM {$table} WHERE {$priKeyField} = ? ORDER BY {$stor_val}");
			$db_handle->execute([$priKeyValue]);
				while ($rw = $db_handle->fetch(PDO::FETCH_ASSOC)) {
					$selectedCheck = ($rw[$stor_val] == $currentValue) ? 'selected=selected': '';
					echo '<option value="'.$rw[$stor_val].'" '.$selectedCheck.'>' .$rw[$field]. '</option>';
				}
			 $db_handle = null;
		} catch (PDOException $error_log) {
			$error_log->getMessage();
		}
	}
	
	
	public function getDistinctField($table1, $field1, $priKeyField1, $priKeyValue1, $table2, $field2, $priKeyField2, $matchField=false) {
		global $dbh;	
		try {
		$db_handle = $dbh->prepare("SELECT DISTINCT {$field1} FROM {$table1} WHERE {$priKeyField1} LIKE ? ORDER BY {$field1}");
			$db_handle->execute([$priKeyValue1]);
				while ($rQ1 = $db_handle->fetch(PDO::FETCH_OBJ)) {
					$gottnID = $rQ1->$field1;					
					$sql_query_in = "SELECT * FROM {$table2} WHERE {$priKeyField2} = ?";
					$db_handle_2 = $dbh->prepare($sql_query_in);
					$db_handle_2->execute([$gottnID]);
					$preview = $db_handle_2->fetch(PDO::FETCH_OBJ);
						$selectedCheck = ($preview->$priKeyField2 === $matchField) ? 'selected=selected': '';
						echo '<option value="'.$preview->$priKeyField2.'" '.$selectedCheck.'>' .$preview->$field2. '</option>';	
					}
			$db_handle_2 = null; $db_handle = null;
		} catch (PDOException $error_log) {
			$error_log->getMessage();
		}
	}
	
	public function valueExist(string $field, string $table, $check_parameter) : bool {
		global $dbh;
		$db_handle = $dbh->prepare("SELECT {$field} FROM {$table} WHERE {$field} = ? LIMIT 1");
		$db_handle->execute([$check_parameter]);
		$get_rows = $db_handle->rowCount();
		$db_handle = null;
		return ($get_rows == 1)? true: false;
	}
		
	public function deleteRow(string $table, int $id): bool {
		global $dbh;
		$db_handle = $dbh->prepare("DELETE FROM {$table} WHERE id = ?");
		$db_handle->execute([$id]);
		$get_rows = $db_handle->rowCount();
		 $db_handle = null; 
			return ($get_rows == 1)? true: false;
	}
	
	public function recycleID(string $table, int $id, $stat_val) : bool {
		global $dbh;	
		$db_handle = $dbh->prepare("UPDATE {$table} SET status = ? WHERE id = ?");
		$db_handle->execute([$stat_val, $id]);
		$get_rows = $db_handle->rowCount();
		 $db_handle = null; 
			return ($get_rows == 1)? true: false;
	}

	
	public function countAll(string $table) : string {
		global $dbh;
		if (USE_MEMCACHE) {
			if (($mc = mc_get('count-' . $table)) !== false)
			return $mc;
		}	
		$db_handle = $dbh->prepare("SELECT COUNT(*) AS cnt FROM {$table}");
		$db_handle->execute();
		$fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ);
		$cnt = $fetch_obj->cnt;
		$db_handle = null;
		if (USE_MEMCACHE) { mc_set('count-' . $table, $cnt); }
		return $cnt;
	}
	
	public function countRestrict1(string $table, string $datafieldname, $value) : string {
		global $dbh;
		$db_handle = $dbh->prepare("SELECT COUNT(*) AS cnt FROM {$table} WHERE {$datafieldname} = ?");
		$db_handle->execute([$value]);
		$fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ);
		$cnt = $fetch_obj->cnt;
		
		return $cnt;
	}
	
	public function countRestrict2(string $table, string $datafield1, $val1, string $datafield2, $val2) : string {
		global $dbh;
		$db_handle = $dbh->prepare("SELECT COUNT(*) AS cnt FROM {$table} WHERE {$datafield1} = ? AND {$datafield2} = ?");
		$db_handle->execute([$val1, $val2]);
		$fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ);
		$cnt = $fetch_obj->cnt;
		$db_handle = null; 
		return $cnt;
	}
	
	public function countRestrict3(string $table, string $datafield1, $val1, string $datafield2, $val2, string $datafield3, $val3) : string {
		global $dbh;
		$db_handle = $dbh->prepare("SELECT COUNT(*) AS cnt FROM {$table} WHERE {$datafield1} = ? AND {$datafield2} = ? AND {$datafield3} = ?");
		$db_handle->execute([$val1, $val2, $val3]);
		//return $db_handle->rowCount();
		$fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ);
		$cnt = $fetch_obj->cnt;
		$db_handle = null; 
		return $cnt;
	}
	
	public function fileExist(string $file_dir_location) : bool {
			return file_exists($file_dir_location)? true: false;	
		}
	
	public function buttonController(string $buttonname, $status) {
		if ($status == 'disable') {
			echo '<script type="text/javascript"> $(\''.$buttonname.'\').attr(\'disabled\', \'disabled\');
			</script>';
		} else if ($status == 'enable') {
			echo '<script type="text/javascript"> $(\''.$buttonname.'\').removeAttr(\'disabled\');
				</script>';
		}
	}
	
	public function formReset(string $formname) {
		echo '<script type="text/javascript"> $(\''.$formname.'\').get(0).reset();
			</script>';
	}
	
	public function form_border_color(string $formid, string $color) {
		echo '<script type="text/javascript">
			$(\''.$formid.'\').css("border", "2px solid '.$color.'");
		</script>';	
	}
	
	public function saltifyID($string): string {
		return urlencode(base64_encode($string));
	}
	
	public function unsaltifyID($string): string {
		return base64_decode(urldecode($string));
	}
	
	public function generateRandomString($length=16) {
		$random = bin2hex(random_bytes($length));
		return $random;
	}
	
	public function excludeField($encounter, $encounter_val, $default) {
		return ($encounter === $encounter_val)? $default: $encounter;
	}
	
	public function jsalert($text) {
		echo '<script type="text/javascript">  alert("'.$text.'");  </script>';
	}
		
	public function fileTypeDetect(string $type) : string {
		if ($type == 'image/png') { $filetype = 'PNG Image'; }
		else if ($type == 'image/jpeg') { $filetype = 'JPG Image'; } 
		else if ($type == 'image/gif') { $filetype = 'GIF Image'; } 
		else if ($type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') { $filetype = 'Ms Word Document'; }
		else if ($type == 'application/msword') { $filetype = 'Ms Word Document (2003)'; }
		else if ($type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') { $filetype = 'Ms Excel Document'; }
		else if ($type == 'application/vnd.openxmlformats-officedocument.presentationml.presentation') { $filetype = 'Ms Power Point Document'; }
		else if ($type == 'application/x-msdownload') { $filetype = 'Executable Application'; }
		else if ($type == 'application/pdf') { $filetype = 'PDF Document'; }
		else if ($type == 'application/x-zip-compressed') { $filetype = 'Zipped Package'; }
		else if ($type == 'text/html') { $filetype = 'HTML Document'; }
		else if ($type == 'text/css') { $filetype = 'CSS Document'; }
		else if ($type == 'application/javascript') { $filetype = 'Javascript Document'; }
		else if ($type == 'application/octet-stream') { $filetype = 'Executable Script'; }
		else if ($type == 'audio/mp3') { $filetype = 'MP3 File'; }
		else if ($type == 'audio/mp4') { $filetype = 'MP4 File'; }
		else if ($type == '') { $filetype = 'Unknown'; }
		else { $filetype = $type; }
		return $filetype;
	}
	
	public function getUserIP() {
		$http_client_ip = @$_SERVER['HTTP_CLIENT_IP'];
		$http_x_forwarded_for = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote_addr = @$_SERVER['REMOTE_ADDR'];
			if (!empty($http_client_ip)) {
				$user_IP = $http_client_ip;
			} else if (!empty($http_x_forwarded_for)) {
				$user_IP = $http_x_forwarded_for;
			} else {
				$user_IP = $remote_addr;
			}
		return $user_IP;
	}

	public function curl_request(string $url, $authorization=''): string {
		if (!function_exists('curl_init')) {
			die ("Please Install Curl");
		} else {
			$ch = curl_init(); //initializer the curl library			
			$header = array(
				'Accept: application/json',
				'Content-Type: application/x-www-form-urlencoded',
				'Authorization: Bearer '. $authorization
			); 

			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_URL, $url); //set url to download
			curl_setopt($ch, CURLOPT_REFERER, ' '); //set the referer url
			curl_setopt($ch, CURLOPT_HEADER, 0); //include header in result, 1 = yes, 0 = no
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //true = return data, false = echo
			curl_setopt($ch, CURLOPT_TIMEOUT, 20); // in seconds
			$output = curl_exec($ch);
			curl_close($ch);
			return $output;
		}
	}
	
	public function urlBuildQuery(string $defaultUrl, string $getVariable, string $newValue) : string {
		// sortBy; page; 
		if (strpos($_SERVER['QUERY_STRING'], $getVariable)) {
			parse_str($_SERVER['QUERY_STRING'], $urlVars);
			$urlVars[$getVariable] = $newValue;
			return self::url_root($defaultUrl.'?'.http_build_query($urlVars));
		} else {
			return self::url_root($defaultUrl.'?'.$_SERVER['QUERY_STRING'].'&'.$getVariable.'='.$newValue);
		}
	}
	
	public function subCategoryUrlVarierOnAnd(string $defaultUrl, string $unsaltedID, string $getVariable, string $newValue) : string {
		// sortBy; page; 
		if (strpos($_SERVER['QUERY_STRING'], $getVariable)) {
			parse_str($_SERVER['QUERY_STRING'], $urlVars);
			$urlVars[$getVariable] = $newValue;
			return self::url_root($defaultUrl.$unsaltedID.'&'.http_build_query($urlVars));
		} else {
			return self::url_root($defaultUrl.$unsaltedID.'&'.$_SERVER['QUERY_STRING'].'&'.$getVariable.'='.$newValue);
		}
	}
	
	        	
	public function getSelected(string $getVar, string $value, string $statement) : string {
		if (isset($_GET[$getVar])){
			return ($_GET[$getVar] == $value)? $statement: '';
		} else {
			return ($value == '0')? $statement: '';
		}
	}
	
	public function ingnix_messenger (int $from_id, string $from_category, int $to_id, string $to_category, string $heading, string $message) : bool {
		global $dbh;
		$dbh_createMsgSQL = $dbh->prepare("INSERT INTO ingnix_messenger VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, 0, 0)");
		$dbh_createMsgSQL->execute([$from_id, $from_category, $to_id, $to_category, $heading, $message, $_SERVER['REQUEST_TIME']]);
		$colCounter = $dbh_createMsgSQL->rowCount();
		$dbh_createMsgSQL = null; 		
		return ($colCounter == '1')? true: false;		
	}
	
	public function prefixZero($digit, $digitLen='4') {
		$zero = '';
			$noOfZeros = $digitLen - strlen($digit);
			for ($i = 1; $i <= $noOfZeros; $i++) {
				$zero .= '0';
			}
		return $zero;
	}
	
	
	public function time_ago(int $timestamp): string {
		$newTime = $_SERVER['REQUEST_TIME'] - $timestamp; /* returned in seconds */
			if ($newTime < 60) {
				return $newTime .' sec(s) ago';
			} else if (($newTime/60) < 60) {
				return round($newTime/60) .' min(s) ago';
			} else if (($newTime/(3600)) < 24) {
				return round($newTime/(3600)) .' hour(s) ago';
			} else if ($newTime/(86400) < 30) {
				return round($newTime/(86400)) .' day(s) ago';
			} else if ($newTime/(2592000) < 12) {
				return round($newTime/(2592000)) .' month(s) ago';
			} else {
				return date('jS M Y @ H:i', $timestamp);
			}	
	}
	
	public function sumColumn(string $column_name, string $table) {
		global $dbh;
		$countRenewals = "SELECT SUM($column_name) AS sum_col FROM $table WHERE id != 0";
		$db_prepare = $dbh->prepare($countRenewals);
		$db_prepare->execute();
		$sumObj = $db_prepare->fetch(PDO::FETCH_OBJ);
		$smCnt = $sumObj->sum_col;
		$db_prepare = null;
		return $smCnt;
	}
	
	
	//upgraded functions list - 
	public function deleteRowXclusive(string $table, string $field, $value): bool {
		global $dbh;
		$sql = "DELETE FROM {$table} WHERE $field = ?";
		$db_handle = $dbh->prepare($sql);
		$db_handle->execute([$value]);
		$get_rows = $db_handle->rowCount();
		 $db_handle = null; 
			return ($get_rows == 1)? true: false;
	}
	
	public function sexHisHer(string $sex): string {
	    $sayP = ($sex == 'Male')? 'His': 'Her';
	    return $sayP;
    }

    public function sexHimHer(string $sex): string {
	    $sayP = ($sex == 'Male')? 'Him': 'Her';
        return $sayP;
    }
	
	public function safelogout($url='') {
		@session_start();
		@setcookie($_COOKIE['SECURITY_VAR'], '', time()-24*60*60*100);
		session_destroy();
		self::_redirect($url);
		exit();
	}

	public function start_security_session() {
		session_regenerate_id(true);
		// generate random code for the _auth cookie and store it in the session
		$authCode = self::generateRandomString();
		$_SESSION['SECURITY_VAR'] = $authCode;
		// create _auth cookie, and restrict it to HTTPS pages
		$this->setCookie('SECURITY_VAR', $authCode);
	}	

	public function secure_arena($session_name, $url_redr) {
		if (!defined('SECURITY_VAR')) self::_redirect($url_redr.'?SEC_VAR_MISSING');
		if ( empty($_SESSION['SECURITY_VAR'])) self::_redirect($url_redr.'?NO_SVAR');
		if ( empty($_COOKIE['SECURITY_VAR'])) self::_redirect($url_redr.'?NO_CVAR');
		$pageIsSecure = (!empty($_COOKIE['SECURITY_VAR'])) && ($_COOKIE['SECURITY_VAR'] === $_SESSION['SECURITY_VAR']);
		if (!$pageIsSecure or !isset($_SESSION[$session_name])) {
			self::_redirect($url_redr);
		}
	}
	
	public function CSRF_Check() {
		global $token;
		$calculateFunction = @hash_hmac('sha256', 'CSRF_Protection', $_SESSION['CSRF']);
		//echo 'Token: '.$token. '<br />Cal Func: '.$calculateFunction; exit;
		return ( !hash_equals($calculateFunction, $token) ) ? false: true;
	}
	
	public function force_number($input) {
	  $input = preg_replace("/[^0-9]/","", $input);
	  if($input == '') $input = 0;
	  return $input;
	}
	
	public function _sanitize_string($str) { 
		if ($str == '') return $str; 
		else 
			return strip_tags($str); //justr strip the tags.. Others will be allowed to go in smoothly
	}
	
	public function _safe_display($string) {
		if ($string == '' or $string == NULL) {
			return $string;
		} else {
			$str = mb_convert_encoding($string, 'UTF-8', 'UTF-8');
			$str = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
			return $str;
		}
	}
	
	public function generatePrivateVars($length=10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	public function slugify($text){		
		$text = preg_replace('~[^\pL\d]+~u', '-', $text); // replace non letter or digits by -
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text); // transliterate
		$text = preg_replace('~[^-\w]+~', '', $text); // remove unwanted characters
		$text = trim($text, '-'); // trim
		$text = preg_replace('~-+~', '-', $text); // remove duplicated - symbols
		$text = strtolower($text); // lowercase
		if (empty($text)) { return 'n-a'; }
		return $text;
	}
	
	public function String2Stars($string='',$first=0,$last=0,$rep='*'): string {
	//Usage String2Stars(string, 3, -5) will show the first 3 string and the last 5 string and hash the rest of them
	  $begin  = mb_substr($string,0,$first);
	  $middle = str_repeat($rep,strlen(mb_substr($string,$first,$last)));
	  $end    = mb_substr($string,$last);
	  $stars  = $begin.$middle.$end;
	  return $stars;
	}
	
	public function roundDown($decimal, $precision) {
        //$fraction = mb_substr($decimal - floor($decimal), 2, $precision); //calculates the decimal places to $precision length
        //$newDecimal = floor($decimal). '.' .$fraction; // reconstructs decimal with new # of decimal places
		$newDecimal = number_format($decimal, $precision);
		return floatval($newDecimal);
	}
	

	//************************************ DO NOT UPDATE FUNCTIONS ************************************** */
	public function check_username_from_all($username) {
		if (!$this->strIsEmpty($username)) {
			if ($this->valueExist('user_n', 'web_students', $username) == true or $this->valueExist('web_users_username', 'web_users', $username) == true or $this->valueExist('web_parents_username', 'web_parents', $username) == true) {
				return true;	
			} else {
				return false;
			}
		}
	}
	public function userGradeClass($user_student_grade_year_class_room_id, $user_student_grade_year_grade_id) {
		if ($user_student_grade_year_class_room_id == '0') {
			$userClz = $this->getValue('grades_desc', 'grades', 'grades_id', $user_student_grade_year_grade_id);
		} else {
			$userClz = $this->getValue('school_rooms_desc', 'school_rooms', 'school_rooms_id', $user_student_grade_year_class_room_id);
		}
		return $userClz;
	}
	
	public function displayUserSchool($schoolID) {
	$default_city = $this->getValue('default_city', 'tbl_config', 'id', '1');
		if ($schoolID == '0' or $schoolID == '') {
			print $this->getValue('school_name', 'tbl_config', 'id', '1') .', '. $default_city;
		} else {
			print $this->getValue('school_names', 'tbl_school_domains', 'id', $schoolID) .', '. $default_city;
		}
	}
	
	public function returnUserSchool($schoolID) {
		if ($schoolID == '0' or $schoolID == '') {
			return $this->getValue('school_name', 'tbl_config', 'id', '1');
		} else {
			return $this->getValue('school_names', 'tbl_school_domains', 'id', $schoolID);
		}
	}

	public function school_utility_image($type) {
		if ($type == 'badge') { 
			$image_file = $this->getValue('school_badge_path', 'tbl_config', 'id', '1');
		} else if ($type == 'logo') {
			$image_file = $this->getValue('school_logo_path', 'tbl_config', 'id', '1');
		} else if ($type == 'barcode') {
			$image_file = $this->getValue('school_bar_code_app', 'tbl_config', 'id', '1');
		}
		return $this->url_root('files/images/').$image_file;
	}

	public function displaySchoolLogo($width='60px', $shape='circle', $margin='10px') {
		if ($shape == 'circle') { $plug = 'class="img-circle"';	} else if ($shape == 'square') { $plug = ''; }
		$img_location = $this->school_utility_image('logo');
		print '<img src="'.$img_location.'" width="'.$width.'" '.$plug.' style="margin:'.$margin.'" />';
	}

	//************************************ DO NOT UPDATE FUNCTIONS ************************************** */
	
}	

$kas_framework = new kas_framework;