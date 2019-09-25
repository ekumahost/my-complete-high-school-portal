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
	public function addbook() {
	extract($_POST);
	require ('../../../php.files/classes/pdoDB.php');
		if ($this->strIsEmpty($book_name) or $this->strIsEmpty($position1) or $this->strIsEmpty($position2)) {
			$this->showDangerCallout('Please Fill in all Fields');
			$this->buttonController('#addBook', 'enable');
		} else {
			$insertQuery = "INSERT INTO media_codes (media_codes_desc, id1, id2) VALUES (:book_name, :position1, :position2)";
				$db_insertQuery = $dbh->prepare($insertQuery);
				$db_insertQuery->bindParam(':book_name', $book_name); $db_insertQuery->bindParam(':position1', $position1);  $db_insertQuery->bindParam(':position2', $position2); 
				$db_insertQuery->execute();
				$get_insertQuery_rows = $db_insertQuery->rowCount();
				$db_insertQuery = null;
					if ($get_insertQuery_rows == 1) {
						$this->showInfoCallout('Books Inserted Succesfully. <a href="'.$this->server_root_dir('staff/dashpanel/handleLibrary/').'">Refresh</a> to See Changes..');
						$this->buttonController('#addBook', 'enable');
						$this->formReset('#addBooksForm');
					} else {
						$this->showWarningCallout('Could not Add Book. <a href="'.$this->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
						$this->buttonController('#addBook', 'enable');
					//print mysql_error();
					}
		}
	}
	
	public function updateBooks($id) {
	 extract($_POST);
	 require ('../../../php.files/classes/pdoDB.php');
		$rawUpdateQuery = "UPDATE media_codes SET media_codes_desc = :book_name, id1 = :position1, id2 = :position2 WHERE media_codes_id = '".$id."' LIMIT 1";
			$db_rawUpdateQuery = $dbh->prepare($rawUpdateQuery);
			$db_rawUpdateQuery->bindParam(':book_name', $book_name);  $db_rawUpdateQuery->bindParam(':position1', $position1); $db_rawUpdateQuery->bindParam(':position2', $position2);
			$db_rawUpdateQuery->execute();
			$get_rawUpdateQuery_rows = $db_rawUpdateQuery->rowCount();
			$db_rawUpdateQuery = null;
				if ($get_rawUpdateQuery_rows == 1) {
					$this->showInfoCallout('Book Updated Succesfully. <a href="'.$this->server_root_dir('staff/dashpanel/handleLibrary/#example1').'">Click Here</a> to See Changes...');
					$this->buttonController('#updateBooks', 'enable');
				} else {
					$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
					$this->buttonController('#updateBooks', 'enable');
					//print mysql_error();
				}
			
	}
	
	public function deleteBook($id) {
		require ('../../../php.files/classes/pdoDB.php');
		$delQ = "DELETE FROM media_codes WHERE media_codes_id = '".$id."' LIMIT 1";
		$db_delQ = $dbh->prepare($delQ);
			$db_delQ->execute();
			$get_delQ_rows = $db_delQ->rowCount();
			$db_delQ = null;
			if ($get_delQ_rows == 1) {
				$this->showInfoCallout('Book Deleted. <a href="'.$this->server_root_dir('staff/dashpanel/handleLibrary/#example1').'">Click Here</a> to See Changes...');
			} else {
				$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
				//print mysql_error();
			}
	}
}

	$librA = new library_processor;

	$instruction = $_GET['instruction'];
	if ($instruction == 'addbook') {
		$librA->addbook();
	} else if ($instruction == 'updateBooks') {
		$librA->updateBooks($bookID);
	} else if ($instruction == 'deleteBook') {
		$librA->deleteBook($passingId);
	}
?>