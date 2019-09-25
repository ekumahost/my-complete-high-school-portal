<?php 
@$page=$_GET['page'];


if (!isset($page)){
echo'<font color="red">Something is not right</font></br>';
}

switch ($page) {
  case "home":
include ("pages/results/home.php"); 
break;
   
case "transcript":
include ("pages/results/transcript.php");    
break;

case "report_cards":
include ("pages/results/report_cards.php");    
break;

default:
include ("pages/fees/index.php");    
}

?>