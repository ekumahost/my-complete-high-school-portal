<?php
require ( '../../../../php.files/classes/pdoDB.php');
require ( '../../../../php.files/classes/kas-framework.php');
require ( '../../../../php.files/classes/generalVariables.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('quad_return').'php.files/student_details.php');

extract($_POST);
//making sure tat the file was not accessed by the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed');
}

//new_event, color, startdate, enddate,
//print print_r($_POST);
	
	if ($kas_framework->strIsEmpty($new_event) or $kas_framework->strIsEmpty($color) or $kas_framework->strIsEmpty($datemask) or $kas_framework->strIsEmpty($datemask2)) {
		$kas_framework->showWarningCallout('Please Make sure that all the fields are not empty');
		$kas_framework->buttonController('#addEventToCalendar', 'enable');
	} else if (strlen(trim($new_event)) > 20) {
		$kas_framework->showWarningCallout('The Maximum length for the Event is 14 Character');
		$kas_framework->buttonController('#addEventToCalendar', 'enable');
	} else {
		$startdateVal = substr($datemask, 0, 2);  $enddateVal = substr($datemask2, 0, 2);
		$startmonth = substr($datemask, 3, 2);   $endmonth = substr($datemask2, 3, 2);
		$startyear = substr($datemask, 6, 4);  $endyear = substr($datemask2, 6, 4);
		
		//fill date into the standard php format
		$fullStartDate = $startmonth.'/'.$startdateVal.'/'.$startyear;
		$fullEndDate = $endmonth.'/'.$enddateVal.'/'.$endyear;
		
		//converting them into seconds using strtotime functions
		$fullStartDateSeconds = strtotime($fullStartDate);
		$fullEndDateSeconds = strtotime($fullEndDate);
					
		//mad and crazy validation
						
		if (!is_numeric($startmonth) or !is_numeric($endmonth) or !is_numeric($startdateVal)
		 or !is_numeric($enddateVal) or !is_numeric($startyear) or !is_numeric($endyear)) {
		$kas_framework->showdangerwithRed('Check Your Data Input. It should conform with the "dd/mm/yyyy eg 24/04/2012" format');
		$kas_framework->buttonController('#addEventToCalendar', 'enable');
			
		} else if ($startmonth > 12 or $startmonth < 1 or $endmonth > 12 or $endmonth < 1 or $startdateVal > 31 
		or $startdateVal < 1 or $enddateVal > 31 or $enddateVal < 1) {
		$kas_framework->showdangerwithRed('Invalid Date Ranges. Check all Date Inputs to conform to "dd/mm/yyyy eg eg 24/04/2012"');
		$kas_framework->buttonController('#addEventToCalendar', 'enable');
			
		} else if ($fullEndDateSeconds < $fullStartDateSeconds) {
		$kas_framework->showWarningCallout('The End date Should be Less than the Start Date');
		$kas_framework->buttonController('#addEventToCalendar', 'enable');
		
		} else if ($fullStartDateSeconds < time('now')-86400 or $fullEndDateSeconds < time('now')-86400) {
		$kas_framework->showWarningCallout('Cant Set a Past Event. Days Should be at least 1 Day Ahead');
		$kas_framework->buttonController('#addEventToCalendar', 'enable');
		
		} else if ($fullEndDateSeconds - $fullStartDateSeconds >= 2592000) {
		$kas_framework->showWarningCallout('Event Cannot Span more than 30 Days');
		$kas_framework->buttonController('#addEventToCalendar', 'enable');
		
		} else {
			$createRecord = "INSERT INTO student_calendar (creator_id, event_name, start_date, end_date, event_color) 
			VALUES ('".$student_id_original."', :new_events, '".$datemask."', '".$datemask2."', '".$color."')";
			
			$db_handle = $dbh->prepare($createRecord);
			$db_handle->bindParam(':new_events', $new_event);
			$db_handle->execute();
			$get_rows = $db_handle->rowCount();
			$db_handle = null;	

				if ($get_rows == 1) {
					$kas_framework->showInfoCallout('Event added to Calendar');
					print '<script type="text/javascript"> self.location = "../calendar/" </script>';
				} else {
					$kas_framework->showWarningCallout('Connection Error. Please Again. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="_blank">Explanation?</a>');
					$kas_framework->buttonController('#addEventToCalendar', 'enable');
				} /* */
		}
	}


?>