<?php
require ( '../../../../php.files/classes/kas-framework.php');	
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
extract($_POST);

//making sure that the file is not accesed via the url
if (!isset($_POST['byepass'])) {
		exit('Error 404: File is Classified');
	}

class notepadx extends kas_framework {
	
		public function deleteNotepad($id) : bool {
			require ( '../../../../php.files/classes/pdoDB.php');	
			$querySQL = "DELETE FROM student_notepad WHERE id = '".$id."' LIMIT 1";
			$db_handle = $dbh->prepare($querySQL);
			$db_handle->execute();
			$get_rows = $db_handle->rowCount();
			$db_handle = null;	
			if ($get_rows == 1) {
				return true;
			} else {
				return false;
			}
		}
		
		public function confirmDeletion($value) {
			print '<div style="border:1px solid #CCC; padding:10px; margin:5px 10px">Do You Really Want to Delete? &nbsp;&nbsp;&nbsp;
			<button class="btn btn-warning btn-flat" id="confirm_no">
			<i class="fa fa-thumbs-o-down"></i> No</button> &nbsp;&nbsp;
			<button class="btn btn-success btn-flat" id="confirm_yes" value="'.$value.'">
			<i class="fa fa-thumbs-o-up"></i> Yes</button></div>
			<br />';	
		}
}
$notepadx = new notepadx;

if ($rsn == 'confirmDelete') {
	$notepadx->confirmDeletion($value);
} else if ($rsn == 'delete_confirmed') {
	if ($notepadx->deleteNotepad($value) == true) {
		$kas_framework->showInfoCallout('Deleted Succesfully');
		print '<script type="text/javascript">
		$(\'#messageBox2\').hide();
		$(\'#todoListDiv\').show();
		</script>';
	} else {
		$kas_framework->showWarningCallout('Could not Delete. Please Try Again');
	}
}
?>
<script type="text/javascript">
$('#confirm_no').click(function(e) {
	$('#messageBox').hide();
	$('#messageBoxForReading').hide();
})

$('#confirm_yes').click(function(e) {
	value = $(this).attr('value'); rsn = 'delete_confirmed'; byepass = 'h6Y56gyTGYre44TUY5t6t';
	$.post('notepad-handler', {value:value, rsn:rsn, byepass:byepass}, function(data){
		$('#messageBox').hide().show().html(data);
		$('.idzez'+value).hide();
	});
})

</script>