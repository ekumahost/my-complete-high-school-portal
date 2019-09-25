<?php
class formsQ extends kas_framework {
	public function addForm($attribute) {
		print '<div class="col-md-6">
							<form role="form" action="" method="post" id="addBooksForm">
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Add Library Books</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Book Name:</label>                                         
                                        <input type="text" required="required" class="form-control" name="book_name" placeholder="Enter Book Name" '.$attribute.' />
                                    </div>

                                    <div class="form-group">
                                        <label>Position 1 (Shelf):</label>                                         
                                        <input type="text" required="required" class="form-control" name="position1"  placeholder="Enter Shelf 1" '.$attribute.' />
                                    </div>

                                    <div class="form-group">
                                        <label>Position 2 (ID):</label>                                         
                                        <input type="text" required="required" class="form-control" name="position2"  placeholder="Enter Position 2" '.$attribute.' />
										<input type="hidden" class="form-control" name="byepass" value="hnutN4NS2dvBNU09uuGVTF" />
                                    </div>
                                </div>
							
							<div class="box-footer">
								<button type="submit" id="addBook" class="btn btn-primary" '.$attribute.'>Add book To Library</button>
							</div>
							<center><span id="message_for_addbook"></span></center>
                         </div></form>
						</div>';
	}
	
	public function updateForm($attribute, $dbQuery=false) {
		print '<div class="col-md-6">
							<form role="form" action="" method="post" id="updateBooksForm">
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Update Library Books</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Book Name:</label>                                         
                                        <input type="text" required="required" class="form-control" name="book_name" placeholder="Enter Book Name" '.$attribute.' value="'.@$dbQuery->media_codes_desc.'" />
                                    </div>

                                    <div class="form-group">
                                        <label>Position 1 (Shelf):</label>                                         
                                        <input type="text" required="required" class="form-control" name="position1"  placeholder="Enter Shelf 1" '.$attribute.' value="'.@$dbQuery->id1.'" />
                                        <input type="hidden" name="bookID" value="'.@$dbQuery->media_codes_id.'" />
                                    </div>

                                    <div class="form-group">
                                        <label>Position 2 (ID):</label>                                         
                                        <input type="text" required="required" class="form-control" name="position2"  placeholder="Enter Position 2" '.$attribute.' value="'.@$dbQuery->id2.'" />
										<input type="hidden" class="form-control" name="byepass" value="hnutN4NS2dvBNU09uuGVTF" />
                                    </div>
                                </div>
							
							<div class="box-footer">
								<button type="submit" id="updateBooks" class="btn btn-primary" '.$attribute.'>Update Book</button>
							</div>
							<center><span id="message_for_updatebook"></span></center>
                         </div></form>
						</div>';
	}
	
	public function deleteConfirmation($value) {
	$real_book_id = $this->unsaltifyID($_GET['bookid']);
		print '<div style="border:1px solid #CCC; padding:10px; margin:5px 10px" id="deleteAsk"> Do You Really Want to Delete? &nbsp;&nbsp;&nbsp;
			<button class="btn btn-warning btn-flat" id="confirm_no">
			<i class="fa fa-thumbs-o-down"></i> No</button> &nbsp;&nbsp;
			<button class="btn btn-success btn-flat" id="confirm_yes" book_jq_id="'.$real_book_id.'">
			<i class="fa fa-thumbs-o-up"></i> Yes</button></div>
			<br />';
	}
	
	public function returnBook($rowID) {
		require ('../../../php.files/classes/pdoDB.php');
		$querySQL = "UPDATE media_history SET media_history_datedue = '".date('d/m/Y')."' WHERE media_history_id = '".$rowID."' LIMIT 1";
		$db_querySQL = $dbh->prepare($querySQL);
		$db_querySQL->execute();
		$get_querySQL_rows = $db_querySQL->rowCount();
		$db_querySQL = null;
			if ($get_querySQL_rows == 1) {
				$this->showInfoCallout('Book was Returned Successfully.');
			} else {
				$this->showWarningCallout('Update Failed. <a href="'.$this->help_url('?topic=query-failed').'" target="new">Explanation?</a>');
				//print mysql_error();
			}
	}
}

$libraryForm = new formsQ;

?>