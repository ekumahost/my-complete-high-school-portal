<?php
	
	 define("MYSCHOOLAPPADMIN_CORE", true);// dont alow user acess her child pages without it being included in this page

	include_once "includes/configuration.php";
	include_once "../php.files/classes/kas-framework.php";

	session_start();
	//Include global functions
	include_once "includes/common.php";

	//Gather form posts
	$username= $_POST['username']; //get_param("username");
	$password= $_POST['password']; //get_param("password");

	//Check if uname/pwd match
	//$sSQL="SELECT * FROM web_users WHERE web_users_username =" . tosql($username, "Text") . " AND web_users_password=" . tosql($password, "Text")." and active = 1";
	$sSQL = "SELECT * FROM web_users WHERE web_users_username = '".$username."' AND web_users_password = '".md5($password)."' and web_users_active = 1";
	
	$dbh_sSQL = $dbh->prepare($sSQL);
	$dbh_sSQL->execute();

	if ($dbh_sSQL->rowCount() == 1) {
		$isuser = $dbh_sSQL->fetch(PDO::FETCH_OBJ);
		$current_y = $kas_framework->getValue('current_year', 'tbl_config', 'id', '1');
		$current_t = $kas_framework->getValue('grade_terms_id', 'grade_terms', 'current', '1'); 

	  $user_type = $isuser->web_users_type;
	  $user_id = $isuser->web_users_id;
	  //$year_name=$db->get_var("SELECT `school_years_desc` FROM `school_years` WHERE `school_years_id` = '$current_year'");
	  switch ($user_type) {
		  case "A" :
			  set_session("UserType", "A");
			  set_session("UserID", $user_id);
			  set_session("CurrentYear", $current_y);
			  set_session("CurrentTerm", $current_t);

			 // set_session("YearName", $year_name);// are we using this
              $_SESSION['LAST_ACTIVITY'] = time(); 


	$redirurl = "cpanel/home";// new admin folder
	if($current_y == 0){
		$redirurl = "cpanel/install";// the portal is not launched yet
	}
	break;
	 case "X" : // this is the principal
			if($current_y == 0){
		$redirurl="index?action=errlog&message= Sorry, the portal is not ready yet, let admin log in and set it";// the portal is not launched yet
	} else {
	
		set_session("UserType", "X");
		set_session("UserID", $user_id);
		set_session("CurrentYear", $current_y);
		set_session("CurrentTerm", $current_t);

		// set_session("YearName", $year_name);// are we using this
		$_SESSION['LAST_ACTIVITY'] = time(); 


	$redirurl="cpanel/home";// new admin folder
	}
			break;
	 case "Y" : // this is the Director
			if($current_y == 0){
	$redirurl="index?action=errlog&message= Sorry, the portal is not ready yet, let admin log in and set it";// the portal is not launched yet
	} else {
	
			  set_session("UserType", "Y");
			  set_session("UserID", $user_id);
			  set_session("CurrentYear", $current_y);
			  set_session("CurrentTerm", $current_t);

			 // set_session("YearName", $year_name);// are we using this
              $_SESSION['LAST_ACTIVITY'] = time(); 

		$redirurl="cpanel/home";// new admin folder
	}
		break;
		  case "T" :
			 $redirurl="../students";
			  break;
		case "N" :
			  $redirurl="../students";
			  break;
		  case "C" :
			  $redirurl="../students";
			  break;
		default: 
		 header("Location: index?action=errlog"); /// crreate new message for them			  
	  }	
	 header("Location: " . $redirurl);
      exit;
} else {
      //set_session("tryattempts", ($_SESSION['tryattempts']+1));
	  header("Location: index?action=errlog");
      exit;
};
/**/
?>
