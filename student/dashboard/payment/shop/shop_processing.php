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

	$amount_paid =  $pass_item_price * $qty;
	$paidby = (isset($_SESSION['tapp_par_username']))? "Parent": "Student";
	$school_years = $kas_framework->getValue('current_year', 'tbl_config', 'id', '1');
	$grade_class = $user_student_grade_year_grade_id;
	$paid_terms = $kas_framework->getValue('grade_terms_id', 'grade_terms', 'current', '1');
	$paid_type = $pass_tution_code_rel_id; /* paid_type is the tution_code_id */

	
	
	    if ($student_wallet_status == '0') {
			$kas_framework->showDangerCallout('Your Wallet has been Locked Down. <a href="'.$kas_framework->help_url('?topic=wallet#walletlock').'" target="blank">Explanation?</a>');
			//$kas_framework->buttonController('#final_pay_button', 'enable');
		} else if ($amount_paid > $student_balance) {
			$kas_framework->showDangerCallout('You do not Have enough credit in your Wallet. Please Recharge your Wallet. 
			<a href="'.$kas_framework->help_url('?topic=payment-options').'" target="blank">Explanation?</a>');
			//$kas_framework->buttonController('#final_pay_button', 'enable');
		} else {
			$dbh->beginTransaction();
			$new_student_balance = $student_balance - $amount_paid;
				
				$studentSQL = "UPDATE student_wallet SET balance = '".$new_student_balance."',
									date_last_used = '".date('d/m/Y')."' WHERE student_id = '".$student_id_original."' LIMIT 1";
						$db_handle = $dbh->prepare($studentSQL);
						$db_handle->execute();
						$get_rows0 = $db_handle->rowCount();
						$db_handle = null;
						
				if ($get_rows == 0) {
					$kas_framework->buttonController('#final_pay_button', 'enable');
						exit($kas_framework->showDangerCallout('Fatal Error: Could not Deduce from your Balance. Please Try Again. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
					}
				
				$new_qty_remaining = $qty_left_for_item - $quantity_purchased;
				$update_Qty_remaining = "UPDATE school_item_price SET school_item_quantity_left = '".$new_qty_remaining."' WHERE id = '".$pass_item_id."' LIMIT 1";
				$db_handleD = $dbh->prepare($update_Qty_remaining);
					$db_handleD->execute();
					$get_rows1 = $db_handleD->rowCount();
					$db_handleD = null;
						
				if ($get_rows1 == 0) {
					$kas_framework->buttonController('#final_pay_button', 'enable');
					exit($kas_framework->showDangerCallout('Fatal Error: Could not Update Item Quantity. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
				}
				
				$insertintoreceipt = "INSERT INTO payment_receipts (tution_paid_by_user_id, tution_paid_by_std_par, tution_amount_paid, tution_paid_sch_years, tution_paid_grade, tution_paid_terms, tution_paid_type, school_item_price_relid, qty, tution_paid_date)
				VALUES ('".$student_id_original."', '".$paidby."', '".$amount_paid."', '".$school_years."', '".$grade_class."', '".$paid_terms."', '".$paid_type."', '".$pass_item_id."', '".$quantity_purchased."', '".date('d/m/Y')."')";
				$db_handleM = $dbh->prepare($insertintoreceipt);
					$db_handleM->execute();
					$get_rows2 = $db_handleM->rowCount();
					$db_handleM = null;
					
				$insert_id = $dbh->lastInsertId(); /* picking the inserted id for imediate printing */
				$salted_id_fix = $kas_framework->saltifyID($insert_id);
				
				if ($get_rows2 == 0) {
					$kas_framework->buttonController('#final_pay_button', 'enable');
					exit($kas_framework->showDangerCallout('Fatal Error: Could not create your Receipt. Please Try Again. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>'));
				}
				
				if ($get_rows0 > 0 and $get_rows1 > 0 and $get_rows2 > 0) {
						/*we commit the query and then shows you success*/
					$dbh->commit();
					$kas_framework->showInfoCallout('Item Bought and Recorded Succesfully. You can Print your Receipt 
					<a class="click_ult" href="'.$kas_framework->server_root_dir('student/dashboard/payment/receipt/?print=').$salted_id_fix.'">Here</a> or at your Wallet History anytime');
					print '<script type="text/javascript">$(\'#user_classic_balance\').html(\''.number_format($new_student_balance).'\')</script>';
					$kas_framework->buttonController('#final_pay_button', 'disable');
				} else {
					$dbh->rollBack();
					$kas_framework->showDangerCallout('Fatal Error: Please Try Again.<a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>');
					$kas_framework->buttonController('#final_pay_button', 'enable');
				}
		}

?>