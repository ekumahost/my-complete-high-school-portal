<?php 
/*  kAsTech FrameWork v1.4
	Designed by: kAsTechnology Network
	Developer: Kelvin Ugbana
	Lagos, Nigeria
*/
class kas_framework {
	function __construct() {
		if (substr($_SERVER['REQUEST_URI'], -4) == '.php' or stripos($_SERVER['REQUEST_URI'], '.php') == true) {
			/* also will check for it in strings   remind */
			//print '<script type="text/javascript">self.location = "'.$this->server_root_dir('404').'" </script>';
			//echo 'PHP Detected in File URL';
		}
	}
	
	public function server_root_dir($flink) {
		return "http://localhost/hisp/". $flink;
	}
	
	public function help_url($flink) {
		return "http://localhost/hisp/help+faq". $flink;
	}
	
	public function pageReferer($referPage) {
		/* this will house the raw link without the http and www for clarity purpose*/
		return (substr_count(@$_SERVER['HTTP_REFERER'], 'http://localhost/hisp/'.$referPage) == 0)? false: true;
	}
	
	public function getAbsoluteURL(): string {
		$myUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && !in_array(strtolower($_SERVER['HTTPS']),array('off','no'))) ? 'https' : 'http';
		$myUrl .= '://'.$_SERVER['HTTP_HOST'];
		$myUrl .= $_SERVER['REQUEST_URI'];
		if (!empty($_SERVER['PATH_INFO'])) $myUrl .= $_SERVER['PATH_INFO'];
		if (!empty($_SERVER['QUERY_STRING'])) $myUrl .= '?'.ltrim($_SERVER['REQUEST_URI'],'?');
		return $myUrl;
	}

	public function checkAuthStudent() {
		if (!isset($_SESSION['tapp_std_username'])) {
			print '<script type="text/javascript"> self.location = "'.$this->server_root_dir('student/?ref=bounce').'"</script>';
		}
	}
	
	public function checkAuthPros_Std() {
		if (!isset($_SESSION['tapp_prostd_username'])) {
			print '<script type="text/javascript"> self.location = "'.$this->server_root_dir('student/?ref=bounce').'"</script>';
		}
	}
	
	public function checkAuthStaff() {
		if (!isset($_SESSION['tapp_staff_username'])) {
			print '<script type="text/javascript"> self.location = "'.$this->server_root_dir('staff/?ref=bounce').'"</script>';
		}
	}
	public function checkAuthParent() {
		if (!isset($_SESSION['tapp_par_username'])) {
			print '<script type="text/javascript"> self.location = "'.$this->server_root_dir('parent/?ref=bounce').'"</script>';
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
		return $this->server_root_dir('files/images/').$image_file;
	}
	
	public function displaySchoolLogo($width='60px', $shape='circle', $margin='10px') {
		if ($shape == 'circle') { $plug = 'class="img-circle"';	} else if ($shape == 'square') { $plug = ''; }
		$img_location = $this->school_utility_image('logo');
		print '<img src="'.$img_location.'" width="'.$width.'" '.$plug.' style="margin:'.$margin.'" />';
	}
	
	
	public function loading($centered=false) {
		$init1 = ($centered == true)? '<center>': '';
		$init2 = ($centered == true)? '</center>': '';
		$loadingImageUrl =  'Preparing... Please Wait ... <img src="'.$this->server_root_dir('/img/ajax-loader.gif').'" width="35" style="margin:8px 0" />';
		print $init1 .$loadingImageUrl. $init2;
	}
	
	public function loading_h($centered=false) {
		$init1 = ($centered == true)? '<center>': '';
		$init2 = ($centered == true)? '</center>': '';
		$loadingImageUrl =  'Processing... Wait... <img src="'.$this->server_root_dir('/img/ajax-loader_h.gif').'" style="margin:8px 0" />';
		print $init1 .$loadingImageUrl. $init2;
	}
	
	public function showdangerwithRed($string) {
		print '<div class="alert alert-danger alert-dismissable">
                  <i class="fa fa-ban"></i>
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              '.$string.'</div>';
	}
	
	public function showinfowithBlue($string) {
		print '<div class="alert alert-info alert-dismissable">
                 <i class="fa fa-info"></i>
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                '.$string.'</div>';
	}
	public function showalertwarningwithPaleYellow($string) {
		print '<div class="alert alert-warning alert-dismissable">
				<i class="fa fa-warning"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               '.$string.'</div>';
	}
	public function showsuccesswithGreen($string) {
			print '<div class="alert alert-success alert-dismissable">
				<i class="fa fa-check"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               '.$string.'</div>';
	}
	
	public function showWarningCallout($string) {
	print ' <div class="callout callout-warning"> <p style="color:#333">'.$string.'</p> </div>';
	}
	
	public function showDangerCallout($string) {
	print ' <div class="callout callout-danger"> <p style="color:#666">'.$string.'</p> </div>';
	}
	
	public function showInfoCallout($string) {
		print '<div class="callout callout-info"> <p style="color:#333">'.$string.'</p> </div>';
	}
	
	 public function secureStr($string) {
		$string = htmlentities(stripslashes($string));
		//$string = mysql_real_escape_string($string);
		return $string;
	}
	
	public function safesession() {
		//session_save_path('/home/users/web/b2855/ipg.teranig/cgi-bin/tmp');
		session_start();
		//session_regenerate_id(true);
	}
	
	public function urlBuildQuery(string $defaultUrl, string $getVariable, string $newValue) : string {
		// sortBy; page; 
		if (strpos($_SERVER['QUERY_STRING'], $getVariable)) {
			parse_str($_SERVER['QUERY_STRING'], $urlVars);
			$urlVars[$getVariable] = $newValue;
			return self::server_root_dir($defaultUrl.'?'.http_build_query($urlVars));
		} else {
			return self::server_root_dir($defaultUrl.'?'.$_SERVER['QUERY_STRING'].'&'.$getVariable.'='.$newValue);
		}
	}
	
	public function getSelected($getVar, $value, $statement) {
		if (isset($_GET[$getVar])){
			return ($_GET[$getVar] == $value)? $statement: '';
		} else {
			return ($value == '0')? $statement: '';
		}
	}
	
	public function strIsEmpty($str){
		return strlen(trim($str))==0? true: false;
	} 
	
	public function getValue(string $field, string $table, string $priKeyField, $priKeyValue) {
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
	
	public function getValueRestrict2(string $field, string $table, string $priKeyField, $priKeyValue, string $priKeyField2, $priKeyValue2) {
		global $dbh;	
		try {
			$sql = "SELECT * FROM {$table} WHERE {$priKeyField} = :priKeyValue AND {$priKeyField2} = :priKeyValue2 LIMIT 1";
			$db_handle = $dbh->prepare($sql);
			$check_exec = $db_handle->execute(array(':priKeyValue' => $priKeyValue, ':priKeyValue2' => $priKeyValue2));
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
	
	public function getallFieldinDropdownOption(string $table, string $field, $stor_val, $matchField=false) {
		global $dbh;	
		try {
			$sql_query = "SELECT * FROM {$table} ORDER BY {$field} ";
			$db_handle = $dbh->prepare($sql_query);
			$db_handle->execute();
				while ($rw = $db_handle->fetch(PDO::FETCH_ASSOC)) {
					$selectedCheck = ($rw[$stor_val] == $matchField) ? 'selected=selected': '';
					echo '<option value="'.$rw[$stor_val].'" '.$selectedCheck.'>' .$rw[$field]. '</option>';
				}
			$db_handle = null;
		} catch (PDOException $kastech) {
			$kastech->getMessage();
		}
	}
	
	public function getallFieldinDropdownOptionWithRestriction($table, $field, $priKeyField, $priKeyValue, $stor_val, $currentValue=false) {
		global $dbh;	
		try {
			$sql_query = "SELECT * FROM {$table} WHERE {$priKeyField} = :priKeyValue ORDER BY {$stor_val}";
			$db_handle = $dbh->prepare($sql_query);
			$db_handle->execute(array(':priKeyValue' => $priKeyValue));
				while ($rw = $db_handle->fetch(PDO::FETCH_ASSOC)) {
					$selectedCheck = ($rw[$stor_val] == $currentValue) ? 'selected=selected': '';
					echo '<option value="'.$rw[$stor_val].'" '.$selectedCheck.'>' .$rw[$field]. '</option>';
				}
			 $db_handle = null;
		} catch (PDOException $kastech) {
			$kastech->getMessage();
		}
	}
	
	public function getDistinctField($table1, $field1, $priKeyField1, $priKeyValue1, $table2, $field2, $priKeyField2, $matchField=false) {
		global $dbh;	
		try {
			$sql_query = "SELECT DISTINCT {$field1} FROM {$table1} WHERE {$priKeyField1} LIKE '".$priKeyValue1."' ORDER BY {$field1}";
			$db_handle = $dbh->prepare($sql_query);
			$db_handle->execute(array(':priKeyValue1' => $priKeyValue1));
				while ($rQ1 = $db_handle->fetch(PDO::FETCH_OBJ)) {
					$gottnID = $rQ1->$field1;					
					$sql_query_in = "SELECT * FROM {$table2} WHERE {$priKeyField2} = :gottnID";
					$db_handle_2 = $dbh->prepare($sql_query_in);
					$db_handle_2->execute(array(':gottnID' => $gottnID));
					$preview = $db_handle_2->fetch(PDO::FETCH_OBJ);
						$selectedCheck = ($preview->$priKeyField2 === $matchField) ? 'selected=selected': '';
						echo '<option value="'.$preview->$priKeyField2.'" '.$selectedCheck.'>' .$preview->$field2. '</option>';	
					}
			$db_handle_2 = null; $db_handle = null;
		} catch (PDOException $kastech) {
			$kastech->getMessage();
		}
	}
	
	public function valueExist(string $field, string $table, $check_parameter) : bool {
		global $dbh;
		$sql = "SELECT {$field} FROM {$table} WHERE {$field} = :check_parameter LIMIT 1";
		$db_handle = $dbh->prepare($sql);
		$db_handle->execute(array(':check_parameter' => $check_parameter));
		$get_rows = $db_handle->rowCount();
		$db_handle = null;
		return ($get_rows == 1)? true: false;
	}
	
	public function fileExist($file_dir_location) {
			return file_exists($file_dir_location)?true: false;	
		}
	
	public function generateIdentify() {
		global $dbh;
		//this place will be the function for generating the random student_identify
		$retrieve_last_id = "SELECT * FROM web_students ORDER BY id DESC LIMIT 1";
		$db_handle = $dbh->prepare($retrieve_last_id);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;		
			if ($get_rows == 0) { $value = '1000000'; } else {
				$value = $paramGetFields->identify; $value = $value + 1; }
			return $value;
	}
	
	public function buttonController($buttonname, $status) {
		if ($status == 'disable') {
			print '<script type="text/javascript"> $(\''.$buttonname.'\').attr(\'disabled\', \'disabled\');
			</script>';
		} else if ($status == 'enable') {
			print '<script type="text/javascript"> $(\''.$buttonname.'\').removeAttr(\'disabled\');
				</script>';
		}
	}
	
	public function formReset($formname) {
		print '<script type="text/javascript"> $(\''.$formname.'\').get(0).reset();
			</script>';
	}
	
	public function form_border_color($formid, $color) {
		print '<script type="text/javascript">
			$(\''.$formid.'\').css("border", "2px solid '.$color.'");
		</script>';	
	}
	
	public function setCookie($cname, $cvalue) {
		setcookie($cname, $cvalue, time()+24*60*60*100, '/');
	}
	
	public function getCookie($cname) {
		return (@$_COOKIE[$cname] != '')? $_COOKIE[$cname]: '';
	}
	
	public function countAll(string $table) : string {
		global $dbh;
		//if (($mc = mc_get('count-' . $table)) !== false)
		//	return $mc;
		$sql_query = "SELECT COUNT(*) AS cnt FROM {$table}";
		$db_handle = $dbh->prepare($sql_query);
		$db_handle->execute();
		$fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ);
		$cnt = $fetch_obj->cnt;
		$db_handle = null;
		//mc_set('count-' . $table, $cnt);
		return $cnt;
	}

	public function getMessageforUser($usersType) {
		global $dbh;
		$query = "SELECT * FROM tbl_config WHERE id = '1' LIMIT 1";
		$db_handle = $dbh->prepare($query);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;		
			if ($usersType == 'parent') { $field = 'messageto_parents'; }
				else if ($usersType == 'staff') { $field = 'messageto_staff'; }
				else if ($usersType == 'student') { $field = 'messageto_students'; }
				else if ($usersType == 'all') { $field = 'messageto_all'; }

			$reflectMsg = $paramGetFields->$field;
				($reflectMsg != '')? $this->showInfoCallout($reflectMsg): '';
	}
	
	public function saltifyID($string) {
		$output = false;
		$encrypt_method = "AES-256-CBC";
		//pls set your unique hashing key
		$secret_key = 'kas';
		$secret_iv = 'kas2017';
		$key = hash('sha256', $secret_key);// hash
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		//do the encyption given text/string/number
			$output = @openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = @base64_encode($output);
			return $output;
	}
	
	public function unsaltifyID($string) {
		/* making sure that no bitch was removed from the url */
		if (strlen($string) != 32) { self::server_root_dir(''); }
		$output = false;
		$encrypt_method = "AES-256-CBC";
		//pls set your unique hashing key
		$secret_key = 'kas';
		$secret_iv = 'kas2017';
		$key = hash('sha256', $secret_key);// hash
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		//do the encyption given text/string/number
			$output = @openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
			return $output;
	}
	
	public function generateRandomString($length=10) {
		$random = substr(md5(rand()), 0, $length);
		return $random;
	}
	
	public function excludeField($encounter, $encounter_val, $default) {
		return ($encounter == $encounter_val)? $default: $encounter;
	}
	
	public function jsalert($text) {
		print '<script type="text/javascript">  alert("'.$text.'");  </script>';
	}
	
	public function countRestrict1(string $table, string $datafieldname, $value) : string {
		global $dbh;
		$sql_query = "SELECT COUNT(*) AS cnt FROM {$table} WHERE {$datafieldname} = '{$value}'";
		$db_handle = $dbh->prepare($sql_query);
		$db_handle->execute();
		$fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ);
		$cnt = $fetch_obj->cnt;
		$db_handle = null; 
		return $cnt;
	}
	
	public function countRestrict2(string $table, string $datafield1, $val1, string $datafield2, $val2) : string {
		global $dbh;
		$sql_query = "SELECT COUNT(*) AS cnt FROM {$table} WHERE {$datafield1} = '{$val1}' AND `{$datafield2}` = '{$val2}'";
		$db_handle = $dbh->prepare($sql_query);
		$db_handle->execute();
		$fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ);
		$cnt = $fetch_obj->cnt;
		$db_handle = null; 
		return $cnt;
	}
	
	public function countRestrict3(string $table, string $datafield1, $val1, string $datafield2, $val2, string $datafield3, $val3) : string {
		global $dbh;
		$sql_query = "SELECT COUNT(*) AS cnt FROM {$table} WHERE {$datafield1} = '{$val1}' AND {$datafield2} = '{$val2}' AND {$datafield3} = '{$val3}'";
		$db_handle = $dbh->prepare($sql_query);
		$db_handle->execute();
		//return $db_handle->rowCount();
		$fetch_obj = $db_handle->fetch(PDO::FETCH_OBJ);
		$cnt = $fetch_obj->cnt;
		$db_handle = null; 
		return $cnt;
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
	
	public function imageDynamic($userimage, $sexofuser, $imageLoc=false) {
		$siteimgloc = ($imageLoc == false)? $this->server_root_dir('pictures/'): $imageLoc;
		//checking if the image file exist
		if ($userimage === '' OR $userimage === 'NULL') {
				//checking for the sex of the user
				if ($sexofuser == 'Male') {
					$avatar = $siteimgloc .'avatar_m.png';
				} else if ($sexofuser == 'Female') {
					$avatar = $siteimgloc .'avatar_f.png';
				}
			// otherwize, get the real image
			} else {
				$avatar = $siteimgloc. $userimage;
			}
		return $avatar;
	}
	
	public function userGradeClass($user_student_grade_year_class_room_id, $user_student_grade_year_grade_id) {
		if ($user_student_grade_year_class_room_id == '0') {
			$userClz = $this->getValue('grades_desc', 'grades', 'grades_id', $user_student_grade_year_grade_id);
		} else {
			$userClz = $this->getValue('school_rooms_desc', 'school_rooms', 'school_rooms_id', $user_student_grade_year_class_room_id);
		}
		return $userClz;
	}
	
	public function fileTypeDetect($type) {
		if ($type == 'image/png') { $filetype = 'PNG Image'; }
		else if ($type == 'image/jpeg') { $filetype = 'JPG Image'; } 
		else if ($type == 'image/gif') { $filetype = 'GIF Image'; } 
		else if ($type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') { $filetype = 'Ms Word Document'; }
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
		else { return $type; }
		return $filetype;
	}

	public function birthdayCountHeader() : int {
		//if (($mcx = mc_get('count-bday')) !== false)
		//	return $mcx;	
		$today = date('d/m');
		global $dbh;
		$sql_query1 = "SELECT COUNT(*) AS cnt FROM studentbio WHERE studentbio_dob LIKE '".$today."%'";
		$sql_query2 = "SELECT COUNT(*) AS cnt FROM staff WHERE staff_dob LIKE '".$today."%'";
		$db_handle1 = $dbh->prepare($sql_query1); $db_handle2 = $dbh->prepare($sql_query2);
		$db_handle1->execute(); $db_handle2->execute();
		$fetch_obj1 = $db_handle1->fetch(PDO::FETCH_OBJ); $fetch_obj2 = $db_handle2->fetch(PDO::FETCH_OBJ);
		$stdCount = $fetch_obj1->cnt; $stfCount = $fetch_obj2->cnt;
		$db_handle1 = null; $db_handle2 = null; 
		$total = $stfCount + $stdCount;	
		//mc_set('count-bday', $total);
		return $total;
	}
	
	public function int_to_month(int $month) :string {
		switch($month) {
			case 1: return 'January';  break;
			case 2: return 'February'; break;
			case 3: return 'March'; break;
			case 4: return 'April'; break;
			case 5: return 'May'; break;
			case 6: return 'June'; break;
			case 7: return 'July'; break;
			case 8: return 'August'; break;
			case 9: return 'September'; break;
			case 10: return 'October'; break;
			case 11: return 'November'; break;
			case 12: return 'December'; break;
			default: return 'Error!!!';
		}
	}
	
	public function app_config_setting(string $module) : bool {
		global $dbh;
		$result = "SELECT * FROM tbl_app_config WHERE module = '".$module."' LIMIT 1";
		$db_handle = $dbh->prepare($result);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;
		return ($paramGetFields->status == 1)? true: false;
	}
	
	public function app_config_indicator($module) {
		global $dbh;
		
		$sqlServe = "SELECT * FROM tbl_app_config WHERE module = '".$module."' LIMIT 1";
		$db_handle = $dbh->prepare($sqlServe);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;	
			if ($paramGetFields->status == 1) {
				print '<small><i class="text-green fa fa-check"></i></small>';
			} else {
				print '<small><i class="text-red fa fa-times"></i></small>';
			}
	}
	
	public function tapp_admin_mail($email, $name, $subject, $message) {
		if (isset($_SESSION['tapp_std_username']) or isset($_SESSION['tapp_prostd_username'])) { $type = 'A'; }
		else if (isset($_SESSION['tapp_staff_username'])) { $type = 'B'; }
		else if (isset($_SESSION['tapp_par_username'])) { $type = 'C'; }
		else { $type = 'D'; }
		
		//require the PDO Data Object
		global $dbh;
		$queryS = "INSERT INTO tbl_portal_emails (sender_type, from_email, from_name, subject, message, date, status) VALUES (:type, :email, :name, :subject, :message, '".date('d/m/Y')."', '0')";
		$db_handle = $dbh->prepare($queryS);
		$db_handle->bindParam(':message', $message); $db_handle->bindParam(':type', $type); $db_handle->bindParam(':email', $email);
		$db_handle->bindParam(':name', $name); $db_handle->bindParam(':subject', $subject);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$db_handle = null;		
			return ($get_rows == 1)? true: false;
	}
	
	public function check_username_from_all($username) {
		if (!$this->strIsEmpty($username)) {
			if ($this->valueExist('user_n', 'web_students', $username) == true or $this->valueExist('web_users_username', 'web_users', $username) == true or $this->valueExist('web_parents_username', 'web_parents', $username) == true) {
				return true;	
			} else {
				return false;
			}
		}
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
	
	/*
	public function CleanForSQL($value, $type="Text") {
	  if(!strlen($value))
		return NULL;
	  else
		if ($type == "Number") {
		  return str_replace (",", ".", doubleval($value));
		} else if ($type == "Text") {
		  if(get_magic_quotes_gpc() == 0) {
			$value = str_replace("'","''",$value);
			$value = str_replace("\\","\\\\",$value);
		  } else  {
			$value = str_replace("\\'","''",$value);
			$value = str_replace("\\\"","\"",$value);
		  }
		  
			$value = trim(htmlentities(stripslashes($value)));			
		  return $value;
		}
	 */
	
}	

$kas_framework = new kas_framework;

	/*Defining my links back */
	define ('single_return', 	'../', TRUE);
	define ('double_return', 	'../../', TRUE);
	define ('tripple_return', '../../../', TRUE);
	define ('quad_return', 	'../../../../', TRUE);
	define ('primary_result_check_fees', 	'700', TRUE);
	define ('junior_sec_result_check_fees', 	'700', TRUE);
	define ('senior_sec_result_check_fees', 	'1000', TRUE);
	define ('classnote_download_fee', 	'100', TRUE);

?>