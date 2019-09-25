
<?php 
@$page=$_GET['page'];


if (!isset($page)){
echo'<font color="red">Something is not right</font></br>';
}

switch ($page) {
  case "home":
include ("pages/students/home.php");    

break;
  case "health":
include ("pages/students/health.php");    

break;
  case "discipline":
include ("pages/students/discipline.php");    

break;
  case "report":
include ("pages/students/report.php");    

break;
  case "class":
include ("pages/students/class.php");    

break;
  case "fee":
include ("pages/students/fee.php");    

break;

 case "demography":
include ("pages/students/demography.php");    

break;

  default:
include ("pages/students/index.php");    
}

?>
						
								