<?php

define('handletitle', true);
include('meta.php');

(file_exists('../../php.files/classes/pdoDB.php'))? include ('../../php.files/classes/pdoDB.php'): include ('../../../php.files/classes/pdoDB.php');
(file_exists('../../php.files/classes/kas-framework.php'))? include ('../../php.files/classes/kas-framework.php'): include ('../../../php.files/classes/kas-framework.php');
//Include global functions
include_once "../../includes/common.php";
// config
include_once "../../includes/configuration.php";

  session_start();
if(!isset($_SESSION['UserID']))
  {
    header ("Location: ../../../index.php?action=notauth");
	exit;
}
?>
<br /> 
 <br />

<?php 
include("../tools/public_functions.php");
//echo $_SESSION['UserID'].$_SESSION['UserType'];
$usid = $_SESSION['UserID'];

$upass= $kas_framework->getValue('web_users_password', 'web_users', 'web_users_id', $usid);
$utype= $kas_framework->getValue('web_users_type', 'web_users', 'web_users_id', $usid);
?>
<div align="center" style="font-size:16px; font-variant:small-caps; font-weight:800; margin:0 0 10px 0">Change My Password: </div>
<div align="center"><form action="" method="post">


Old Password: <input type="password" name="op" id="op" placeholder="Old Password" /><br />
New Password: <input type="password" name="np" id="np" placeholder="New Password" /><br />
new password: <input type="password" name="np2" id="np2" placeholder="Confirm New Password" />
<br /><br />


<button type="submit" class="btn btn-primary">Save Changes</button>
</form>


<?php
       
@$op = md5(trim($_POST['op']));		
@$np = trim($_POST['np']);		
@$np2 = trim($_POST['np2']);			
	                                    
if(!isset($_POST['op'])){
	$myp->AlertInfo('Not Good! ', 'Please use a hard combination of password with integer and letters');
	exit;
}

if(isset($_POST['op'])){// he submited the form

if (empty($np) || empty($np2)){
	$myp->AlertError('Oh snap! ', 'Not ready to change password yet?');
	exit;
}

if($op != $upass){
	$myp->AlertError('Error! ', 'Your Previous Password is not Correct');
	exit;
}

if($np != $np2){
	$myp->AlertError('Oh snap!' , 'New passwords did not match, try again.');
	exit;
}
// Validate the new password
//StrongPassword($np = $string,"password is Not Strong");
$np = md5($np);
	
@$sql ="UPDATE `web_users` SET web_users_password = '$np' WHERE web_users_id = '$usid' AND web_users_type = '$utype'";
$dbh_sSQL = $dbh->prepare($sql); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount(); $dbh_sSQL = null;
	//upgraded by Ultimate Kelvin C - Kastech
	if ($rowCount == 1) {
		$myp->AlertSuccess('Great Work! ', 'Password Change was succesfull.');
	} else {
		$myp->AlertError('Error!', 'Password Could not be Changed.');	
	}
}
?>
</div>