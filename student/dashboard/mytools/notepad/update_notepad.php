<?php
	//making sure yat the file was not accessed via the url
	if (isset($_POST['updateNOte'])) {

	extract($_POST);

	if ($kas_framework->strIsEmpty($notepad_title) or strlen($notepad_title) < 10) {
			$kas_framework->showWarningCallout('Notepad Title Value is too Short. Please make it more than 10 Characters');
		} else if ($kas_framework->strIsEmpty($notepad_text) or strlen($notepad_text) < 10) {
			$kas_framework->showWarningCallout('Notepad Value is too Short. Please make it more than 10 Characters');
		} else {
				$tilaQuery = "UPDATE student_notepad SET title = :notepad_title, note = :notepad_text WHERE id = '".$id."' LIMIT 1";
				$db_handle = $dbh->prepare($tilaQuery);
				$db_handle->bindParam(':notepad_title', $notepad_title); $db_handle->bindParam(':notepad_text', $notepad_text);  
				$db_handle->execute();
				$get_rows = $db_handle->rowCount();
				$db_handle = null;	
				
				if ($get_rows == 1) {
						$kas_framework->showsuccesswithGreen('Success. Note Updated');
					} else {
						$kas_framework->showWarningCallout('Failed. No Changes Made to the Note. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>');
					}
			}
	} else {
		exit('Error 404: File is Classified');
	}
?>