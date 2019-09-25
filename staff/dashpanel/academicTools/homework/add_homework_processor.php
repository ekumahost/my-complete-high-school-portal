<?php 
extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed Via Link');
}
	
$myRandDigit = $kas_framework->generateRandomString();
	
class homework_file extends kas_framework {
	public function homework_attach_handler($name_of_file, $myRandDigit) {
		$size = $_FILES['file']['size'];
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$type = finfo_file($finfo, $_FILES["file"]["tmp_name"]);
		$file_url = constant('quad_return')."files/homework_files/" .'homework_'. $_SESSION['tapp_staff_username']. '_' .$myRandDigit. '_'. $name_of_file;
		if ($size > 9726696) {
			$this->showdangerwithRed('File Size too large. Max: 9MB. <a href="'.$this->help_url('?topic=file-error#size_large').'" target="_blank">Explanation?</a>');
			return false;
		} else if ($type != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' and $type != 'application/pdf') {
			$this->showdangerwithRed('File must be in PDF/MS Word Format');
			return false;
		} else if (@!move_uploaded_file($_FILES['file']['tmp_name'], $file_url)) {
			$this->showdangerwithRed('Could not Upload File. <a href="'.$this->help_url('?topic=file-error#couldnt_upload').'" target="_blank">Explanation?</a>');
			return false;
		} else {
			return true;
		}
	}
}
$homework_file_Handle = new homework_file;
		
		$file_name = $_FILES["file"]["name"];
		if ($kas_framework->strIsEmpty($name) or $kas_framework->strIsEmpty($subject) or $kas_framework->strIsEmpty($date_submitted)
			or $kas_framework->strIsEmpty($instruction) or $kas_framework->strIsEmpty($grade)) {
			$kas_framework->showDangerCallout('Please Fill in all the Compulsory Fields for the Homework');
		} else if ($kas_framework->strIsEmpty($notepad_text) and $kas_framework->strIsEmpty($file_name)) {
			$kas_framework->showDangerCallout('Please Select one of the Home work Setting type. Either File or Manual Typing');
		} else if (!$kas_framework->strIsEmpty($notepad_text) and !$kas_framework->strIsEmpty($file_name)) {
			$kas_framework->showDangerCallout('You cannot Use both method for Homework Submission. Select one');
		}  else if (!$kas_framework->strIsEmpty($file_name) and $homework_file_Handle->homework_attach_handler($file_name, $myRandDigit) === false) {
		//say nothing..the function should handle this
		} else {
				$realFileName = (!$kas_framework->strIsEmpty($file_name)) ?'homework_' .$_SESSION['tapp_staff_username']. '_' .$myRandDigit. '_'. $file_name: '';
				
				$insert_query = "INSERT INTO homework (teacher_id, session, term, name, subject, grade, date_assigned, date_due, homework_file, instruction, notepad_text) VALUES ('".$web_users_relid."', '".$current_year_id."', '".$currentTerm_id."', :name, 
				'".$subject."', '".$grade."', '".date('d/m/Y')."', :date_submitted, '".$realFileName."', :instruction, :notepad_text)";
					$db_insert_query = $dbh->prepare($insert_query);
					$db_insert_query->bindParam(':name', $name); $db_insert_query->bindParam(':instruction', $instruction); 
					$db_insert_query->bindParam(':notepad_text', $notepad_text); $db_insert_query->bindParam(':date_submitted', $date_submitted);
					$db_insert_query->execute();
					$get_insert_query_rows = $db_insert_query->rowCount();
					$db_insert_query = null;
								
						if ($get_insert_query_rows == 1) {
							$kas_framework->showInfoCallout('Homework Was Added Succesfully.');
						} else {
							$kas_framework->showDangerCallout('Could not set Homework. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
						}
			
		}
		
?>