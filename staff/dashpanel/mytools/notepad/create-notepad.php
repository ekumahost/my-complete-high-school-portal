<?php
//making sure that the file was not accessed via url
if (isset($_POST['createbutton'])) {

extract($_POST);
	if ($kas_framework->strIsEmpty($notepad_title) or strlen($notepad_title) < 10) {
		$kas_framework->showWarningCallout('Notepad Title Value is too Short. Please make it more than 10 Characters');
	} else if ($kas_framework->strIsEmpty($notepad_text) or strlen($notepad_text) < 10) {
		$kas_framework->showWarningCallout('Notepad Value is too Short. Please make it more than 10 Characters');
	}  else {
	$query = "INSERT INTO staff_notepad (author, title, note, dateCreated) VALUES ('".$web_users_relid."', :notepad_title, :notepad_text, '".date('d/m/Y')."')";
	$db_query = $dbh->prepare($query);
	$db_query->bindParam(':notepad_title', $notepad_title); $db_query->bindParam(':notepad_text', $notepad_text); 
	$db_query->execute();
	$get_query_rows = $db_query->rowCount();
	$db_query = null;

	if ($get_query_rows == 1) {
		$kas_framework->showsuccesswithGreen('Success. Note Created');
	} else {
		$kas_framework->showWarningCallout('Failed. Could not process request.<a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>');	
	}
}
//print $notepad_text;
} else {
	exit('Error 404: File is Classified');
}
?>