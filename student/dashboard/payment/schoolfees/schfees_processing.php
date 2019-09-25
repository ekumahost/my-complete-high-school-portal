<?php
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/student_details.php');

extract($_POST);
//making sure tat the file was not accessed by the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed');
}
/* paid_type is the tution_code_id */
	$check_if_exist = "SELECT * FROM payment_receipts 
						WHERE tution_paid_by_user_id = '".$student_id_original."' AND tution_amount_paid = '".$amount_paid."'
						AND tution_paid_sch_years = '".$school_years."' AND tution_paid_grade = '".$grade_class."'
						AND tution_paid_terms = '".$paid_terms."' AND tution_paid_type = '".$paid_type."'";
				$db_handle_check_if_exist = $dbh->prepare($check_if_exist);
				$db_handle_check_if_exist->execute();
				$get_rows = $db_handle_check_if_exist->rowCount();
				//$db_handle_check_if_exist = null;
						
			$checkbool = ($get_rows >= 1)? true: false;

	if ($student_wallet_status == '0') {
		$kas_framework->showDangerCallout('Your Wallet has been Locked Down. <a href="'.$kas_framework->help_url('?topic=wallet#walletlock').'" target="blank">Explanation?</a>');
		//$kas_framework->buttonController('#paybutton', 'enable');
	} else if ($checkbool === true) {
		$kas_framework->showDangerCallout('You have Already Paid for this Session. Check your Receipts and Confirm. If this persist, contact the Admin with the Error code "KAS-EXIST-ERROR".');
		//$kas_framework->buttonController('#paybutton', 'enable');
	} else if ($amount_paid > $student_balance) {
		$kas_framework->showDangerCallout('You do not Have enough credit in your Wallet. Please Recharge your Wallet. 
		<a href="'.$kas_framework->help_url('?topic=payment-options').'" target="blank">Explanation?</a>');
		//$kas_framework->buttonController('#paybutton', 'enable');
	} else {
		$dbh->beginTransaction();
		$new_student_balance = $student_balance - $amount_paid;
		/* transactions for the students receipt and deducing of balance*/
		$updateStudentWallet = "UPDATE student_wallet SET balance = '".$new_student_balance."', date_last_used = '".date('d/m/Y')."' WHERE student_id = '".$student_id_original."' LIMIT 1";
		$db_handle_updateStudentWallet = $dbh->prepare($updateStudentWallet);
		$db_handle_updateStudentWallet->execute();
		$get_rows1 = $db_handle_updateStudentWallet->rowCount();
		$db_handle_updateStudentWallet = null;
		
		if ($get_rows1 == 0) {
			exit($kas_framework->showDangerCallout('Fatal Error: Could not Deduce from your Balance. Please Try Again. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
			$kas_framework->buttonController('#paybutton', 'enable');
		}
		
		$insertintoreceipt ="INSERT INTO payment_receipts (tution_paid_by_user_id, tution_paid_by_std_par, tution_amount_paid, tution_paid_sch_years, tution_paid_grade, tution_paid_terms, tution_paid_type, tution_paid_date)
		VALUES ('".$student_id_original."', '".$paidby."', '".$amount_paid."', '".$school_years."', '".$grade_class."', '".$paid_terms."', '".$paid_type."', '".date('d/m/Y')."')";
		$db_handle_insertintoreceipt = $dbh->prepare($insertintoreceipt);
		$db_handle_insertintoreceipt->execute();
		$get_rows2 = $db_handle_insertintoreceipt->rowCount();
		$db_handle_insertintoreceipt = null;
		
		$insert_id = $dbh->lastInsertId(); /* picking the inserted id for immediate printing */
		$salted_id_fix = $kas_framework->saltifyID($insert_id);
		
		if ($get_rows2 == 0) {
			exit($kas_framework->showDangerCallout('Fatal Error: Could not create your Receipt. Please Try Again. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
			$kas_framework->buttonController('#paybutton', 'enable');
		}
		
		if ($get_rows1 > 0 and $get_rows2 > 0) {
			/*we commit the query and then shows you success*/
			$dbh->commit();
			$kas_framework->showInfoCallout('School Fees Paid Succesfully. You can Print your Receipt 
			<a class="click_ult" href="'.$kas_framework->server_root_dir('student/dashboard/payment/receipt/?print=').$salted_id_fix.'">Here</a> or at your Wallet History anytime');
			print '<script type="text/javascript">$(\'#user_classic_balance\').html(\''.number_format($new_student_balance).'\')</script>';
			print '<script type="text/javascript">$(\'#user_classic_balance_mod\').html(\''.number_format($new_student_balance).'\')</script>';
			$kas_framework->buttonController('#paybutton', 'disable');
		} else {
			$dbh->rollBack();
			$kas_framework->showDangerCallout('Fatal Error: Please Try Again.<a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>');
			$kas_framework->buttonController('#paybutton', 'enable');
		}
		
		
	}

?>