<?php

if (!isset($_POST['eachCheckbox'])) {
	$kas_framework->showWarningCallout('Please Select one item for action');
} else {
	$nc = $_POST['eachCheckbox'];
	$count = count($nc);


/*checking for the button clicked and taking the appropriate action*/

	if (isset($_POST['mass_move_to_junk'])) {
		//mysql_query('BEGIN');
		for ($i = 0; $i < $count; $i++) {
			$query[$i] = $internalMailEx->xtraMsgHandler($nc[$i], $my_username, 'junk');
		 }
		$kas_framework->showInfoCallout("Action Succesfully. ".$count." Message(s) Junked");
	}
	
	if (isset($_POST['mass_restore_junk'])) {
		for ($i = 0; $i < $count; $i++) {
			$query[$i] = $internalMailEx-> junkRestore($nc[$i], $my_username);
		 }
		$kas_framework->showInfoCallout("Action Succesfully. ".$count." Message(s) Restored");
	}
		
	if (isset($_POST['mass_delete'])) {
		for ($i = 0; $i < $count; $i++) {
			$query[$i] = $internalMailEx->xtraMsgHandler($nc[$i], $my_username, 'delete');
		 }
		$kas_framework->showInfoCallout("Action Succesfully. ".$count." Message(s) Permanently Deleted");
	}
	
	if (isset($_POST['mass_mark_as_read'])) {
		for ($i = 0; $i < $count; $i++) {
			$query[$i] = $internalMailEx->markAsReadandUnread($nc[$i], $my_username, 'read');
		 }
		 $kas_framework->showInfoCallout("Action Succesfully. ".$count." Message(s) Marked as Read");
	}
	
	if (isset($_POST['mass_mark_as_unread'])) {
		for ($i = 0; $i < $count; $i++) {
			$query[$i] = $internalMailEx->markAsReadandUnread($nc[$i], $my_username, 'unread');
		 }
		 $kas_framework->showInfoCallout("Action Succesfully. ".$count." Message(s) Marked as Unead");
	}
/*checking for the folder you are currently in and working by it
	 for ($i=0;$i<$count; $i++) {
			print $nc[$i] .",";
		 }	
	*/
}
?>