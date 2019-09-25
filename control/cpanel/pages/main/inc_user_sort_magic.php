<?php 
//dbh_querybioSQL
$biototal = $dbh_querybioSQL->rowCount();
$dbh_querybioSQL = null;
	// since we are displaying 1000 only
	if($biototal > 1000){
	//echo "its above 10000";
	$break_p = round($biototal/1000);
	// so we have $break_p number of page groups
	// collect the page group from url
	@$groupid = $_GET['break_p'];
	// then we loop the page grout in a page grouping link
	}// end if card is more than a thousand
 // start working again
		  	if(isset($_GET['break_p'])){// this is only set when quantity is greater than 1000
// for $groupid = 0, 0-1000, 1, 1000-2000, 2 2000- 3000, 3 3000-4000s
		  	 $sort_srt = $groupid * 1000;
			 } else {
			 ///$groupid
			 // where should the sorting start
			 $sort_srt = 0; 
			 }// end for wallet
				 
?>
