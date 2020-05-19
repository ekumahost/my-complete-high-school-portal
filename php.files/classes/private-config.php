<?php

class configurations {

	public function url_root($flink) {
		return "http://127.0.0.1/hisp.portal.com/". $flink;
	}
	
	public function pageReferer($referPage) {
		/* this will house the raw link without the http://, https:// and www. for clarity purpose */
		return (substr_count(@$_SERVER['HTTP_REFERER'], '127.0.0.1/hisp.portal.com/'.$referPage) == 0)? false: true;
	}
	
	public function help_url($flink) {
		//You can leave this URL. Its our Live Help URL
		return "https://hisp.kastechnet.com/help+faq". $flink;
	}

	public function checkAuthStudent() {
		if (!isset($_SESSION['tapp_std_username'])) {
			print '<script type="text/javascript"> self.location = "'.$this->url_root('student/?ref=bounce').'"</script>';
		}
	}
	
	public function checkAuthPros_Std() {
		if (!isset($_SESSION['tapp_prostd_username'])) {
			print '<script type="text/javascript"> self.location = "'.$this->url_root('student/?ref=bounce').'"</script>';
		}
	}
	
	public function checkAuthStaff() {
		if (!isset($_SESSION['tapp_staff_username'])) {
			print '<script type="text/javascript"> self.location = "'.$this->url_root('staff/?ref=bounce').'"</script>';
		}
	}
	public function checkAuthParent() {
		if (!isset($_SESSION['tapp_par_username'])) {
			print '<script type="text/javascript"> self.location = "'.$this->url_root('parent/?ref=bounce').'"</script>';
		}
	}
	
	public function setCookie($cname, $cvalue) {
		setcookie($cname, $cvalue, time()+24*60*60*100, '/');
	}
	
	public function addCookie($cname, $cvalue) {
		setcookie($cname, $cvalue, time()+24*60*60*100, '/');
	}
	
	public function getCookie($cname) {
		return (@$_COOKIE[$cname] != '')? $_COOKIE[$cname]: '';
	}	
	
	public function loading($centered=false) {
		$init1 = ($centered == true)? '<center>': '';
		$init2 = ($centered == true)? '</center>': '';
		$loadingImageUrl =  'Preparing... Please Wait ... <img src="'.$this->url_root('/img/ajax-loader.gif').'" width="35" style="margin:8px 0" />';
		print $init1 .$loadingImageUrl. $init2;
	}
	
	public function loading_h($centered=false) {
		$init1 = ($centered == true)? '<center>': '';
		$init2 = ($centered == true)? '</center>': '';
		$loadingImageUrl =  'Processing... Wait... <img src="'.$this->url_root('/img/ajax-loader_h.gif').'" style="margin:8px 0" />';
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
	
	 public function secureStr($string) {
		$string = htmlentities(stripslashes($string));
		//$string = mysql_real_escape_string($string);
		return $string;
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

	public function imageDynamic($userimage, $sexofuser, $imageLoc=false) {
		$siteimgloc = ($imageLoc == false)? $this->url_root('pictures/'): $imageLoc;
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

}