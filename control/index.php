<?php
	define("MYSCHOOLAPPADMIN_CORE", true);// dont alow user acess her child pages without it being included in this page


	//Include global functions
	include_once "../php.files/classes/kas-framework.php";
	include_once "includes/common.php";
	// Include configuration
	include_once "includes/configuration.php";
	// get version
	include_once "includes/version.php";

	$action=get_param("action");
	//Set errors if any
	if ($action=="errlog")
		$msgLogin=_INDEX_ERRLOG;
	else if ($action=="notauth")
		$msgLogin= _INDEX_NOTAUTH;
	else if ($action=="notfound")
		$msgLogin=_INDEX_NOTFOUND;
	else if ($action=="gotpass")
		$msgLogin=_INDEX_GOTPASS;
	else if ($action=="attempt")
		$msgLogin=_INDEX_ATTEMPT;
	else $msgLogin="";
	//$myappname=$db->get_var("SELECT school_name FROM tbl_config WHERE id=1");
	$myappname = $kas_framework->getValue('school_name', 'tbl_config', 'id', '1');

?>
<!doctype html>
<html class="bg-black">
<style type="text/css">
.bg-black {background: url(../img/user_bg.jpg) repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;}
</style>
<head>
<meta charset="iso-8859-1">
<title> <?php echo $myappname;?>;Admin Portal: TSA</title>

<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="javascript" src="js/sms.js"></script>

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<!-- font Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css">
</head>
<body onload="document.forms.login.username.focus()" class="bg-black">
<!-- WE HAVE INCLUDED --->

<div align="center" style="margin:60px 0 0 0">
 <div class="form-box" id="login-box" align="center" style="position:">
   <div class="header">Admin Check In</div>
   <form action="login" method="post" id="login">
     <div class="body bg-gray" align="">
       <div align ="center"><i>Admin, Principal, and Director check in </i> </div>
       <div align="center" style="color:red; font:Arial, Helvetica, sans-serif; font-weight:300;"><?php echo $msgLogin.""; ?></div>
       <div class="form-group">
         <input type="text" name="username" class="form-control" size="40" placeholder="Username" >
       </div>
       <div class="form-group">
         <input type="password" name="password" class="form-control" placeholder="Password">
       </div>
       <div class="form-group">
         <input type="checkbox" name="remember_me">
         Remember me </div>
     </div>
     <div class="footer">
       <button type="submit" class="btn bg-olive btn-block">Sign me in</button>
       <p><a href="#" onClick="alert('Sorry, you are not allowed to forget your password at this time.')">I forgot my password</a></p>
       <a href="../" class="text-center">Go to Home Page</a> </div>
   </form>
 </div></div>

 <div style="position:fixed; bottom:0px; color:#000; text-align:center; background-color:#FFF; width:100%; border-radius:30px 30px 0 0; z-index:950;">
 <p> 
  <a href="http://hisp.kastechnet.com/help+faq"> Help Page</a> | <a href="http://hisp.kastechnet.com/privacy">Privacy Policy</a>  | <a href="http://hisp.kastechnet.com/terms">Terms Of Use</a>. &nbsp;&nbsp;&nbsp;&nbsp;
  <font color="">Powered by  <?php echo "<a href='http://hisp.kastechnet.com/'> kasTech School Portal.</a> <a href='http://hisp.kastechnet.com/'> Version V" . $release." </a> Released On ".$reldate; ?> </font>
 </p></div>
  
</body>

</html>

