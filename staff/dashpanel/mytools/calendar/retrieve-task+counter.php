<?php 
	$emptyMessage = "<br /><center>No New Task in One Week Time<br /><br /></center>";
		
	$allEvents = "SELECT * FROM staff_calendar WHERE creator_id = '".$web_users_relid."'";
	$db_allEvents = $dbh->prepare($allEvents);
	$db_allEvents->execute();
	$get_db_allEvents_rows = $db_allEvents->rowCount();
	
	$initCount = 0;
	while ($reveal = $db_allEvents->fetch(PDO::FETCH_OBJ)) {
		$startdateValT = substr($reveal->start_date, 0, 2); 
		$startmonthT = substr($reveal->start_date, 3, 2);
		 $startyearT = substr($reveal->start_date, 6, 4);
		 
		  /*translating it to standard php timer*/
		$convertedTime = $startmonthT.'/'.$startdateValT.'/'.$startyearT;
		
		/*translating each individual start time for the selected tasks */
		$timeInSeconds = strtotime($convertedTime);
		$timeofNow = $timeInSeconds - time('now')+86400;
		$convertToDays = round($timeofNow/(60*60*24));
			if ($convertToDays == -0) { $convertToDays = '0'; }
		
			if ($convertToDays <= 7 and $convertToDays >= 0) {
				$initCount = $initCount + 1;
				
			/*Playing realPolitics with the colors*/
			if ($convertToDays <= 0) {
				$decider = '<span class="label label-primary">This is Event is Already Happening Live</span>';
				} else if ($convertToDays <= 2) {
				$decider = '<span class="label label-danger">
				This is Event will Happen in Less than '.$convertToDays.' day</span>';
				} else if ($convertToDays >= 3) {
				$decider = '<span class="label label-warning">
				This is Event will Happen in Less than '.$convertToDays.' days</span>';
				}
			/*Playing realPolitics with the colors*/
				
				$weekEvent[$initCount] =  '
					<li>
						<a href="'.$kas_framework->url_root('staff/dashpanel/mytools/calendar#eventTable').'">
							<h3>
							   '.$reveal->event_name.'
								<small class="pull-right">'.$reveal->start_date.'</small>
							</h3>
							<div class="" style="text-align:center">
								'.$decider.'
							</div>
						</a>
					</li>';	
			} 
	}
	$db_allEvents = null;
?>