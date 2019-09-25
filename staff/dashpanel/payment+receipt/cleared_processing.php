<?php
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
extract($_POST);

//making sure that the file was not accessed by the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed');
}
	//print $passing_id;
	
	$uncleared = '<a class="btn bg-red" disabled="disabled"><i class="fa fa-times"></i></a>';
	$cleared = '<a class="btn bg-green" disabled="disabled"><i class="fa fa-dot-circle-o"></i></a>';
	
	$checked_query = "UPDATE payment_receipts SET cleared = '1' WHERE tuition_history_id = '".$passing_id."' LIMIT 1";
	$db_checked_query = $dbh->prepare($checked_query);
	$db_checked_query->execute();
	$get_rows = $db_checked_query->rowCount();
	$db_checked_query = null;
	
			if ($get_rows == 1) {
				print '<script type="text/javascript"> $(\'#del'.$passing_id.'\').html(\''.$cleared.'\').attr(\'disabled\', \'disabled\'); </script>';
			} else {
				print '<script type="text/javascript"> $(\'#del'.$passing_id.'\').html(\''.$uncleared.'\').attr(\'disabled\', \'disabled\'); </script>';
			}
	
?>