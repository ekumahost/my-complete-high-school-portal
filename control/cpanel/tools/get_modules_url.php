<?php 
@$page=$_GET['controller'];

if (!isset($page)){
	$myp->AlertError('Oops! ', 'Something is Just not right');
}

switch ($page) {
 case "home":
include ("pages/modules/home.php");    
break;

case "admission":
include ("pages/modules/admission.php");    
break;
case "prospectus":
include ("pages/modules/prospectus.php");    
break;
case "admission_sett":
include ("pages/modules/admission_sett.php");    
break;
	
case "mails":
include ("pages/modules/mails.php");    
 break;
	case "spy":
include ("pages/modules/spy.php");    
 break;
case "install":
include ("pages/modules/install.php");    
break;

case "hostels":
include ("pages/modules/hostels.php");    
break;

case "myhostel":
include ("pages/modules/myhostel.php");    
break;

case "payments":
include ("pages/modules/payments.php");    
break;

case "wallet":
include ("pages/modules/wallet.php");    
break;

case "module":
include ("div_admin/ultimate_all_modules.php");
break;

case "academicAdviser":
include ("pages/modules/academicAdviser.php");
break;

case "duty":
include ("pages/modules/duty.php");
break;

 default:
include ("pages/modules/index.php");    
}

?>							