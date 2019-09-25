<?php 
extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed Via Link');
}

		require ('../../../../php.files/classes/pdoDB.php');
		require ('../../../../php.files/classes/kas-framework.php');
		$kas_framework->safesession();
		$kas_framework->checkAuthStaff();
		require (constant('quad_return').'php.files/classes/generalVariables.php');		
		require (constant('quad_return').'php.files/staff_details.php');
		require (constant('quad_return').'php.files/classes/staff.php');

		
$myRandDigit = $kas_framework->generateRandomString();
	
class homework_file extends kas_framework {
	public function homework_attach_handler($name_of_file, $myRandDigit) {
		$size = $_FILES['file']['size'];
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$type = finfo_file($finfo, $_FILES['file']['tmp_name']);
		$file_url = constant('quad_return')."files/classnote_files/" .'cw_'. $_SESSION['tapp_staff_username']. '_' .$myRandDigit. '_'. $name_of_file;
		 if ($name_of_file == '') {
			$this->showdangerwithRed('Please Select a file For Upload');
			return false;
		} else if ($type != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' and $type != 'application/pdf') {
			$this->showdangerwithRed('File must be in PDF/MS Word Format');
				return false;
		} else if ($size > 9726696) {
			$this->showdangerwithRed('File Size too large. Max: 9MB. <a href="'.$this->help_url('?topic=file-error#size_large').'" target="_blank">Explanation?</a>');
				return false;
		} else if (@!move_uploaded_file($_FILES['file']['tmp_name'], $file_url)) {
			$this->showdangerwithRed('Could not Upload File. <a href="'.$this->help_url('?topic=file-error#couldnt_upload').'" target="_blank">Explanation?</a>');
			return false;
		}  else {
			return true;
		}
	}
}
$homework_file_Handle = new homework_file;
		
		$file_name = $_FILES["file"]["name"];
		
		if ($kas_framework->strIsEmpty($name) or $kas_framework->strIsEmpty($subject) or $kas_framework->strIsEmpty($grade)) {
			$kas_framework->showDangerCallout('Please Fill in all the Compulsory Fields for the Homework');
		}  else if ($homework_file_Handle->homework_attach_handler($file_name, $myRandDigit) === false) {
		//say nothing..the function should handle this
		} else {
				$realFileName = (!$kas_framework->strIsEmpty($file_name)) ?'cw_'. $_SESSION['tapp_staff_username']. '_' .$myRandDigit. '_'. $file_name: '';
				
				$insert_query = "INSERT INTO classnote (teacher_id, session, term, name, subject, grade, date_uploaded, classnote_file, added_info) VALUES ('".$web_users_relid."', '".$current_year_id."', '".$currentTerm_id."', :name, 
								'".$subject."', '".$grade."', '".date('d/m/Y')."', '".$realFileName."', :added_nfo)";
						$db_insert_query = $dbh->prepare($insert_query);
						$db_insert_query->bindParam(':name', $name); $db_insert_query->bindParam(':added_nfo', $added_nfo);
						$db_insert_query->execute();
						$get_db_insert_query_rows = $db_insert_query->rowCount();
						$db_insert_query = null;
				
						if ($get_db_insert_query_rows == 1) {
							$kas_framework->showInfoCallout('Class Note Was Uploaded Succesfully.');
						} else {
							$kas_framework->showDangerCallout('Could not Upload Class Note. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
							@$file_url_to_del = "files/classnote_files/" .'cw_'. $_SESSION['tapp_staff_username']. '_' .$myRandDigit. '_'. $name_of_file;
							@unlink($file_url_to_del);
							//print mysql_error();
						}
			
		}
		
?>