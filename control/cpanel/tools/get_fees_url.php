<?php 
@$page=$_GET['page'];


if (!isset($page)){
echo'<font color="red">Something is not right</font></br>';
}

switch ($page) {
  case "home":
include ("pages/fees/home.php");    

break;
  case "default":
include ("pages/fees/defaultfees.php");    

break;
   case "defaultfees":
include ("pages/fees/defaultfees.php");    
    break;
	
  
  case "salaries":
include ("pages/fees/salary.php");    

break;
  case "online_exam":
include ("pages/fees/exam.php");    

break;

  default:
include ("pages/fees/index.php");    
}

?>
						
								