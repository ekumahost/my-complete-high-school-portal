<?php 
@$page=$_GET['page'];


if (!isset($page)){
echo'<font color="red">Something is not right</font></br>';
}

switch ($page) {
  case "home":
include ("pages/teachers/home.php");    

break;
  
  case "salaries":
include ("pages/teachers/salaries.php");    

break;
  case "online_exam":
include ("pages/teachers/online_exam.php");    

break;

  default:
include ("pages/students/index.php");    
}

?>