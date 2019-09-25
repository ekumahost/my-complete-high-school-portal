<?php 
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/staff_details.php');

extract($_POST);
//sleep(3);
//making sure tat the file was not accessed by the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed');
}
$startLimit = $load * 6;

 $allEvents = "SELECT * FROM staff_calendar WHERE creator_id = '".$web_users_relid."' ORDER BY id DESC LIMIT ".$startLimit.", 6";
	 $db_allEvents = $dbh->prepare($allEvents);
	$allEvents->execute();

			$sn = $startLimit;
				while ($reveal = $allEvents->fetch(PDO::FETCH_OBJ)) {
					$enddateVal = substr($reveal->end_date, 0, 2); $startdateValT = substr($reveal->start_date, 0, 2);  
					$endmonth = substr($reveal->end_date, 3, 2); $startmonthT = substr($reveal->start_date, 3, 2);
					 $endyear = substr($reveal->end_date, 6, 4); $startyearT = substr($reveal->start_date, 6, 4); 
					 
					 //translating it to standard php timer
					$convertedTime = $endmonth.'/'.$enddateVal.'/'.$endyear;
					$convertedTimeT = $startmonthT.'/'.$startdateValT.'/'.$startyearT;
										
					$timeInSeconds = strtotime($convertedTimeT);
					$timeofNow = $timeInSeconds - time('now')+86400;
					$convertToDays = round($timeofNow/(60*60*24));
					
					if ($convertToDays >= 0) {
						$sn = $sn + 1;
			
					print '<tr>
						<td>'.$sn.'</td>
						<td>'.$reveal->start_date.'</td>
						<td>'.$reveal->end_date.'</td>
						<td><a href="?eventid='.$reveal->id.'">'.$reveal->event_name.'</a></td>';
							//playing politics with the remaining date
							if ($convertToDays <= 0) {
							print '<td><span class="label label-primary">Happening Live</span></td>';
							} else if ($convertToDays >= 1 and $convertToDays < 4) {
							print '<td><span class="label label-danger">Less than '.$convertToDays.' day</span></td>';
							} else if ($convertToDays >= 4 and $convertToDays < 8) {
							print '<td><span class="label label-warning">Less than '.$convertToDays.' days</span></td>';
							} else if ($convertToDays >= 8) {
							print '<td><span class="label label-success">In '.$convertToDays.' days time</span></td>';
							}
							print '</tr>';
					}
				}
		$allEvents = null;
?>