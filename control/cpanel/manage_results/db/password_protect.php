<?php

// THIS PAGE IS ONLY USED TO CONTROL AUTO LOGOUT AT INACTIVITIES

$LOGIN_INFORMATION = array(
  'admin_timeout' => 'time_outer'
);

// request login? true - show login and password boxes, false - password box only
define('USE_USERNAME', true);

// User will be redirected to this page after logout
define('LOGOUT_URL', '../index.php?action=notauth');

// time out after NN minutes of inactivity. Set to 0 to not timeout
define('TIMEOUT_MINUTES', 1);

// This parameter is only useful when TIMEOUT_MINUTES is not zero
// true - timeout time from last activity, false - timeout time from login
define('TIMEOUT_CHECK_ACTIVITY', true);




// timeout in seconds
$timeout = (TIMEOUT_MINUTES == 0 ? 0 : time() + TIMEOUT_MINUTES * 60);

// logout?
if(isset($_GET['logout'])) {
  setcookie("verify", '', $timeout, '/'); // clear password;
  header('Location: ' . LOGOUT_URL);
  exit();
}

if(!function_exists('showLoginPasswordProtect')) {

// show login form
function showLoginPasswordProtect($error_msg) {
?>
<html>
<head>
  <title>NFCS ADMIN</title>
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
  <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-image: url(bg_login_top.jpg);
	background-repeat: repeat;
	background-color: #003333;
}
.style1 {color: #FFFFFF}
.style2 {color: #990000}
.style3 {color: #FF0000; }
-->
</style></head>
<body>
  <style>
    input { border: 1px solid black; }
  </style>
  <table align="center" border="0" width="50%"> <tr> <td>
  <div align="center" style="width:500px; margin-left:auto; margin-right:auto; text-align:center">
  <form method="post">
    <h3 class="">Hey, for security and record purpose, what is your name? </h3>

    <font color="red"><?php echo $error_msg; ?></font><br />
<?php if (USE_USERNAME) echo ':<br /><input type="hidden" name="access_login" value="admin_timeout" style="font-size:20px; padding: 4px; padding-left: 3px; border:2px; solid: #857561; width:270px; border-color:red" placeholder="Username" /><br />:<br />'; ?>
    <input type="hidden" name="access_password" value="time_outer" style="font-size:20px; padding: 4px; padding-left: 3px; border:2px; solid: #857561; width:270px; border-color:red" placeholder="" />
	
	<input type="text" name="nothing" value="" style="font-size:20px; padding: 4px; padding-left: 3px; border:2px; solid: #857561; width:270px; border-color:red" placeholder="surmname" />
	
	<p></p><input type="submit" name="Submit" value="Continue to DashBoard" />
  </form>
  </div>
  <p class="style2">
  </p>
  </td></tr></table>
  
</body>
</html>

<?php header ("Location: ../../../index.php?action=notauth");
	exit;
  
  // stop at this point
  die();
  
  
}


}

// user provided password
if (isset($_POST['access_password'])) {

  $login = isset($_POST['access_login']) ? $_POST['access_login'] : '';
  $pass = $_POST['access_password'];
  if (!USE_USERNAME && !in_array($pass, $LOGIN_INFORMATION)
  || (USE_USERNAME && ( !array_key_exists($login, $LOGIN_INFORMATION) || $LOGIN_INFORMATION[$login] != $pass ) ) 
  ) {
    showLoginPasswordProtect("Haha! Wrong Username and Password!");
  }
  else {
    // set cookie if password was validated
    setcookie("verify", md5($login.'%'.$pass), $timeout, '/');
    
    // Some programs (like Form1 Bilder) check $_POST array to see if parameters passed
    // So need to clear password protector variables
    unset($_POST['access_login']);
    unset($_POST['access_password']);
    unset($_POST['Submit']);
	
	
  }
  
  

}

else {

  // check if password cookie is set
  if (!isset($_COOKIE['verify'])) {
    showLoginPasswordProtect("");
  }

  // check if cookie is good
  $found = false;
  foreach($LOGIN_INFORMATION as $key=>$val) {
    $lp = (USE_USERNAME ? $key : '') .'%'.$val;
    if ($_COOKIE['verify'] == md5($lp)) {
      $found = true;
	  

	  
	  
	  
	  
	  
	  
      // prolong timeout
      if (TIMEOUT_CHECK_ACTIVITY) {
        setcookie("verify", md5($lp), $timeout, '/');
      }
      break;
    }
  }
  if (!$found) {
    showLoginPasswordProtect("");
  }

}



?>


