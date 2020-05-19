<?php
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/staff_details.php');

extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed Via Link');
}

class library_processor extends kas_framework {
	public function addrecord() {
	extract($_POST);
	require ('../../../php.files/classes/pdoDB.php');
		if ($this->strIsEmpty($stdid) or $this->strIsEmpty($book_id) or $this->strIsEmpty($dateout) or $this->strIsEmpty($note)) {
			$this->showDangerCallout('Please Fill in all Fields');
		} else {
			$insertQuery = "INSERT INTO media_history (media_history_borrower, media_history_school, media_history_year, media_history_code, media_history_dateout, media_history_datedue, media_history_borrower_type, media_history_action, media_history_user)
			VALUES ('".$stdid."', '".$school."', '".$year."', '".$book_id."', '".$this->secureStr($dateout)."', '', 'std', '".$this->secureStr($note)."', '".$web_users_relid."')";
			$db_insertQuery = $dbh->prepare($insertQuery);
				$db_insertQuery->execute();
				$get_db_insertQuery_rows = $db_insertQuery->rowCount();
				$db_insertQuery = null;
			if ($get_db_insertQuery_rows == 1) {
				$this->showInfoCallout('Record Inserted Succesfully. <a href="'.$this->url_root('staff/dashpanel/handleLibrary/manageStudent').'">Refresh</a> to See Changes..');
				$this->formReset('#addStudentRecordForm');
			} else {
				$this->showWarningCallout('Could not Create Record. <a href="'.$this->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
				//print mysql_error();
			}
		}
	}
	
	public function addrecordZs() {
	extract($_POST);
	require ('../../../php.files/classes/pdoDB.php');
		if ($this->strIsEmpty($staffid) or $this->strIsEmpty($book_id) or $this->strIsEmpty($dateout) or $this->strIsEmpty($note)) {
			$this->showDangerCallout('Please Fill in all Fields');
		} else {
			$insertQuery = "INSERT INTO media_history (media_history_borrower, media_history_school, media_history_year, media_history_code, media_history_dateout, media_history_datedue, media_history_borrower_type, media_history_action, media_history_user) 
			VALUES ('".$staffid."', '".$school."', '".$year."', '".$book_id."', :dateout, '', 'stf', :note, '".$web_users_relid."')";
			$db_insertQuery = $dbh->prepare($insertQuery);
			$db_insertQuery->bindParam(':dateout', $dateout); $db_insertQuery->bindParam(':note', $note); 
			$db_insertQuery->execute();
			$get_insertQuery_rows = $db_insertQuery->rowCount();
			$db_insertQuery = null;
			if ($get_insertQuery_rows == 1) {
				$this->showInfoCallout('Record Inserted Succesfully. <a href="'.$this->url_root('staff/dashpanel/handleLibrary/manageStaff').'">Refresh</a> to See Changes..');
				$this->formReset('#addStaffRecordForm');
			} else {
				$this->showDangerCallout('Could not Create Record. <a href="'.$this->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
				//print mysql_error();
			}
		}
	}
	
	public function updateBooks($id) {
	 extract($_POST);
	 require ('../../../php.files/classes/pdoDB.php');
		$rawUpdateQuery = "UPDATE media_codes SET media_codes_desc = '".$book_name."', id1 = '".$position1."', id2 = '".$position2."' WHERE media_codes_id = '".$id."'";
		$db_rawUpdateQuery = $dbh->prepare($rawUpdateQuery);
			$db_rawUpdateQuery->execute();
			$get_rawUpdateQuery_rows = $db_rawUpdateQuery->rowCount();
			$db_rawUpdateQuery = null;
				if ($get_rawUpdateQuery_rows == 1) {
					$this->showInfoCallout('Book Updated Succesfully. Please Refresh to See Changes...');
				} else {
					$this->showDangerCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
					//print mysql_error();
				}
			
	}
	
	public function deleteBorrowerRecord($id) {
		global $dbh;
		$delQ = "DELETE FROM media_history WHERE media_history_id = '".$id."' LIMIT 1";
		$db_delQ = $dbh->prepare($delQ);
		$db_delQ->execute();
		$get_delQ_rows = $db_delQ->rowCount();
		$db_delQ = null;
			if ($get_delQ_rows == 1) {
				$this->showInfoCallout('Record Deleted Successfully. Please <a href="'.$this->url_root('staff/dashpanel/handleLibrary/manageStudent#example1').'">Click Here</a> to See Changes...');
			} else {
				$this->showDangerCallout('Delete Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
				//print mysql_error();
			}
	}
}

	$librA = new library_processor;

	$instruction = $_GET['instruction'];
	if ($instruction == 'addrecord') {
		$librA->addrecord();
	} else if ($instruction == 'addrecordZs') {
		$librA->addrecordZs();
	} else if ($instruction == 'updateBooks') {
		$librA->updateBooks($bookID);
	} else if ($instruction == 'deleteBook') {
		$librA->deleteBook($passingId);
	} else if ($instruction == 'deleteBorrowerRecord') {
		$librA->deleteBorrowerRecord($passingId);
	}
?>