<?php 
@$page=$_GET['page'];


if (!isset($page)){
echo'<font color="red">Something is not right</font></br>';
}

switch ($page) {
  case "book":
include ("pages/main/book.php");    

break;

 case "roles":
include ("pages/main/roles.php");    
    break;
	 case "profile":
include ("pages/main/profile.php");    
    break;

 case "administrative":
include ("pages/main/administrative.php");    
    break;
 case "addresults":
include ("pages/main/addresults.php");    
    break;
	 case "uploadcsv":
include ("pages/main/uploadcsv.php");    
    break;
	
  case "forum":
include ("pages/main/forum.php");    
    break;
	
 case "password":
include ("pages/main/password.php");    
    break;
	
	
	 case "users":
include ("pages/main/users.php");    
    break;
	 case "staff":
include ("pages/main/staff.php");    
    break;
	 case "parents":
include ("pages/main/parents.php");    
    break;
	
	
	 case "demote":
include ("pages/main/demote.php");    
    break;
	
 case "view_staff":
include ("pages/main/view_staff.php");    
    break;	
	
case "view_parents":
include ("pages/main/view_parents.php");    
    break;
	
	 case "view_users":
include ("pages/main/view_users.php");    
    break;
	 case "edit_users":
include ("pages/main/edit_users.php");    
    break;
	 case "delete_users":
include ("pages/main/delete_users.php");    
    break;
	

	 case "email":
include ("pages/main/email.php");    
    break;
	
	 case "sms":
include ("pages/main/sms.php");    
    break;


	case "schoolapp":
include ("pages/main/schoolapp.php");    
    break;

 case "cards":
include ("pages/main/cards.php");    
    break;
	 case "backups":
include ("pages/main/backups.php");    
    break;
case "reports":
include ("pages/main/reports.php");    
    break;
	case "library":
include ("pages/main/library.php");    
    break;
	case "switchterm":
include ("pages/main/switchterm.php");    
    break;
	case "parent_child":
include ("pages/main/parent_to_kid.php");    
    break;

  default:
include ("pages/main/index.php");    
}

?>
						
								