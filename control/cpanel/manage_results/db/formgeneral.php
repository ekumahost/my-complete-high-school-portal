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
	
	
}	
$general = new general;

$kas_framework->databaseconn($db_server, $db_user, $db_password, $db_name);
//$kas_framework->phpRedirect();
?>