<?php
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/classes/students.php');
require (constant('tripple_return').'php.files/student_details.php');

extract($_POST);
//making sure tat the file was not accessed by the url
if (!isset($_POST['byepass'])) {
    exit('Error 404: File Cannot be Accessed');
}

if ($student_wallet_status == '0') {
    $kas_framework->showDangerCallout('Your Wallet has been Locked Down. <a href="'.$kas_framework->help_url('?topic=wallet#walletlock').'" target="blank">Explanation?</a>');
    //$kas_framework->buttonController('#final_pay_button', 'enable');
} else if ($amountCharge > $student_balance) {
    $kas_framework->showDangerCallout('You do not Have enough credit in your Wallet. Please Recharge your Wallet.
			<a href="'.$kas_framework->help_url('?topic=payment-options').'" target="blank">Explanation?</a>');
        $kas_framework->buttonController('#result_wallet_button', 'enable');
} else {

    $dbh->beginTransaction();
    $paidby = (isset($_SESSION['tapp_par_username']))? "Parent": "Student";
    $school_years = $kas_framework->getValue('current_year', 'tbl_config', 'id', '1');
    $new_student_balance = $student_balance - $amountCharge;

    $updateStudentWallet = "UPDATE student_wallet SET balance = '".$new_student_balance."',
									date_last_used = '".date('d/m/Y')."' WHERE student_id = '".$std_id_passed."' LIMIT 1";
	$db_updateStudentWallet = $dbh->prepare($updateStudentWallet);
	$db_updateStudentWallet->execute();
	$get_rows1 = $db_updateStudentWallet->rowCount();
	$db_updateStudentWallet = null;
	
    if ($get_rows1 == 0) {
        $kas_framework->buttonController('#result_wallet_button', 'enable');
        exit($kas_framework->showDangerCallout('Fatal Error: Could not Deduce from your Balance. Please Try Again. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
        }

    $update_std_report = "UPDATE std_report_cards SET check_result = '1', check_counter = '1' WHERE student = '".$std_id_passed."' AND grade='".$grade_tkn."' AND term='".$term_tkn."' AND session='".$session_tkn."' LIMIT 1";
	$db_update_std_report = $dbh->prepare($update_std_report);
	$db_update_std_report->execute();
	$get_rows2 = $db_update_std_report->rowCount();
	$db_update_std_report = null;
	
    if ($get_rows2 == 0) {
        $kas_framework->buttonController('#result_wallet_button', 'enable');
        exit($kas_framework->showDangerCallout('Fatal Error: Result could not be Released from server. Try again Later. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
       }

    $insertintoreceipt = "INSERT INTO payment_receipts (tution_paid_by_user_id, tution_paid_by_std_par, tution_amount_paid, tution_paid_sch_years, tution_paid_grade, tution_paid_terms, tution_paid_type, school_item_price_relid, qty, tution_paid_date)
				VALUES ('".$std_id_passed."', '".$paidby."', '".$amountCharge."', '".$school_years."', '".$grade_tkn."', '".$term_tkn."', '10', '0', '0', '".date('d/m/Y')."')";
			$db_insertintoreceipt = $dbh->prepare($insertintoreceipt);
			$db_insertintoreceipt->execute();
			$get_rows3 = $db_insertintoreceipt->rowCount();
			$db_insertintoreceipt = null;	
				
    $insert_id = $dbh->lastInsertId(); /* picking the inserted id for immediate printing */
    $salted_id_fix = $kas_framework->saltifyID($insert_id);

    if ($get_rows3 == 0) {
        $kas_framework->buttonController('#result_wallet_button', 'enable');
        exit($kas_framework->showDangerCallout('Fatal Error: Could not create your Receipt. Please Try Again. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
        }

    if ($get_rows1 > 0 and $get_rows2 > 0 and $get_rows3 > 0) {
        /*we commit the query and then shows you success*/
		$dbh->commit();
        $kas_framework->showInfoCallout('You have paid for this Term. You will only check your result 5 times. Print your receipt
					<a class="click_ult" href="'.$kas_framework->url_root('student/dashboard/payment/receipt/?print=').$salted_id_fix.'">Here</a> or at your Wallet payment History. Click <b>View Result</b> again to see Result.');
        print '<script type="text/javascript">$(\'#user_classic_balance\').html(\''.number_format($new_student_balance).'\')</script>';
        $kas_framework->buttonController('#result_wallet_button', 'disable');
    } else {
        $dbh->rollBack();
        $kas_framework->showDangerCallout('Fatal Error: Please Try Again.<a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>');
        $kas_framework->buttonController('#result_wallet_button', 'enable');
    }


}

?>