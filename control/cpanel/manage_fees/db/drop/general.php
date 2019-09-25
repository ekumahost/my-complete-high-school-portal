<?php 
class general {
	
	public function databaseconn($server, $username, $password, $databasename) {

		if (!mysql_connect($server, $username, $password)) {
			$this->showdangerwithRed('Fatal Error: Conenction Failed');
			exit;
		}
		if (!mysql_select_db($databasename)) {
			$this->showdangerwithRed('Fatal Error: Database Failure');	
			exit;
		} 
	}
	
	public function server_root_dir($flink) {
		//return "http://localhost/myschoolapp/std/". $flink;
	}
	
	public function help_url($flink) {
		//return "http://localhost/myschoolapp/topic/help". $flink;
	}
	
	public function displaySchoolLogo($width, $shape, $margin) {
		if ($shape == 'circle') { $plug = 'class="img-circle"';	} else if ($shape == 'square') { $plug = ''; }
		$img_location = $this->server_root_dir('img/sch_logo.png');
		print '<img src="'.$img_location.'" width="'.$width.'" '.$plug.' style="margin:'.$margin.'" />';
	}
	
	public function getCurrentYear() {
		return $this->getValue('current_year', 'tbl_config', 'id', '1');
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
	print ' <div class="callout callout-warning"> <p>'.$string.'</p> </div>';
	}
	
	public function showInfoCallout($string) {
		print '<div class="callout callout-info"> <p>'.$string.'</p> </div>';
	}
	public function secureStr($string) {
		$string = htmlentities(stripslashes($string));
		$string = mysql_real_escape_string($string);
		return $string;
	}
	
	public function safesession() {
		ob_start();
		session_start();
		//session_regenerate_id(true);
	}
	
	public function strIsEmpty($str){
		return strlen(trim($str))==0?true: false;
	} 
	
	public function getValue($field, $table, $priKeyField, $priKeyValue) {
	$rawQ = "SELECT $field FROM `$table` WHERE $priKeyField = '$priKeyValue'";
	  $Qwery = mysql_query($rawQ);
		if (!$Qwery) { $data = ''; } else if (mysql_num_rows($Qwery) == '0') { $data = ''; }
		else { $data = mysql_result($Qwery, 0, $field); }
			return $data;
	}
	
	public function getallFieldinDropdownOption($table, $field, $stor_val, $matchField=false) {
		$qr = "SELECT * FROM $table ORDER BY $field";
			$qrun = mysql_query($qr);
				while ($rw = mysql_fetch_assoc($qrun)) {
					$selectedCheck = ($rw[$stor_val] == $matchField) ? 'selected=selected': '';
					print '<option value="'.$rw[$stor_val].'" '.$selectedCheck.'>' .$rw[$field]. '</option>';
		}
	}
	
	public function valueExist($field, $table, $check_parameter) {
		$exist =  mysql_query("SELECT `$field` FROM $table WHERE $field = '$check_parameter'");
			if (mysql_num_rows($exist) == 1) { return true;	} else { return false;	}
		}
	
	public function fileExist($file_dir_location) {
			return file_exists($file_dir_location)?true: false;	
		}
	
	public function generateIdentify() {
		//this place will be the function for generating the random student_identify
		$retrieve_last_id = mysql_query("SELECT * FROM web_students ORDER BY id DESC");
		if (mysql_num_rows($retrieve_last_id) == 0) {
			$value = '1000000';
		} else {
			$value = mysql_result($retrieve_last_id, 0, 'identify');
			$value = $value + 1;
		}
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
	
	public function form_border_color($formid, $color) {
		print '<script type="text/javascript">
			$(\''.$formid.'\').css("border", "2px solid '.$color.'");
		</script>';	
	}
	
	public function setCookie($cname, $cvalue) {
		setcookie($cname, $cvalue, time()*24*60*60*100, '/');
	}
	
	public function getCookie($cname) {
		if (@$_COOKIE[$cname] != '') {
			$storedCookie = $_COOKIE[$cname];
		} else {
			$storedCookie = '';
		}
		return $storedCookie;
	}
	
	public function phpRedirect() {
		if (substr($_SERVER['REQUEST_URI'], -4) == '.php') {
			print '<script type="text/javascript">self.location = "'.$this->server_root_dir('404').'" </script>';
		}
	}
	
	public function getMessageforUser($usersType) {
		$query = mysql_query("SELECT * FROM tbl_config WHERE id = '1'");
			if ($usersType == 'parent') { $field = 'messageto_parents'; }
			else if ($usersType == 'all') { $field = 'messageto_all'; }
			$reflectMsg = mysql_result($query, 0, $field);
				($reflectMsg != '')?$this->showalertwarningwithPaleYellow($reflectMsg): '';
	}
	
	public function saltifyID($id) {
		$batch1 = rand(1000000000, 9999999999);
		$batch2 = rand(1000000000, 9999999999);
		$batch3 = rand(1000000000, 9999999999);
		return $batch1 .'hYts8' .$batch2 .'gtsbN'. $batch3. $id;
	}
	
	public function unsaltifyID($id) {
		return (strlen($id) > 40)?substr($id, 40): $id;
	}
	
	public function excludeField($encounter, $encounter_val, $default) {
		return ($encounter == $encounter_val)? $default: $encounter;
	}
	
	public function jsalert($text) {
		print '<script type="text/javascript">  alert("'.$text.'");  </script>';
	}
	
	public function countRestrict1($table, $datefieldname, $value) {
		$cc = mysql_query("SELECT * FROM `$table` WHERE `$datefieldname` = '".$value."'");
		return mysql_num_rows($cc);
	}
	
	public function countRestrict2($table, $datafield1, $val1, $datafield2, $val2) {
		$cc = mysql_query("SELECT * FROM `$table` WHERE `$datafield1` = '".$val1."' AND `$datafield2` = '".$val2."'");
		return mysql_num_rows($cc);
	
	}
	
	public function controlTextShowMore($id, $text, $showToEnd) {
		$brappears = substr_count($text, '<br />');
				if ($brappears > 4) { $showToEnd = 78;	}
		
		if (strlen($text) > $showToEnd) {
			print substr($text, 0, $showToEnd) .'... 
			<a href="#comment" class="showMore" id="'.$id.'">&raquo; Show All... </a>';
		} else { print $text; }
	}
	
	public function checkAuthParent() {
		if (!isset($_SESSION['tapp_par_username'])) {
			print '<script type="text/javascript"> self.location = "'.$this->server_root_dir('parent?ref=bounce').'"</script>';
		}
	}
	
	public function checkAuthStudent() {
		if (!isset($_SESSION['tapp_std_username'])) {
			print '<script type="text/javascript"> self.location = "'.$this->server_root_dir('student?ref=bounce').'"</script>';
		}
	}
	
	public function displayUserSchool($userschool) {
	$default_city = $this->getValue('default_city', 'tbl_config', 'id', '1');
		if ($userschool == '0') {
			print $this->getValue('school_name', 'tbl_config', 'id', '1') .', '. $default_city;
		} else {
			print $this->getValue('school_names_desc', 'school_names', 'school_names_id', $userschool) .', '. $default_city;
		}
	}
	
}	
$general = new general;

$kas_framework->databaseconn($db_server, $db_user, $db_password, $db_name);
$kas_framework->phpRedirect();
?>