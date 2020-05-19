<?php 
$sender_mail = ' ';
class confirmationz extends kas_framework {

	/* confirm user for the new registration (students) */
	public function ConfirmUser($cid) {
        if(empty($cid) or strlen($cid) < 6) {
            $this->showinfowithBlue("Please provide a valid confirmation code");
        } else {
			$this->UpdateDBRecForConfirmation($cid);
		}	
    }
	
	/*confirm user for the new registration (staff) */
	public function ConfirmUserStaff($cidp) {
        if(empty($cidp) or strlen($cidp) < 6) {
            $this->showinfowithBlue("Please provide a valid confirmation code");
        } else {
			$this->UpdateDBRecForConfirmationStaff($cidp);
		}
    } 
	
	/*confirm user for the new registration (parents) */
	public function ConfirmUserParent($cidp) {
        if(empty($cidp) or strlen($cidp) < 6) {
            $this->showinfowithBlue("Please provide a valid confirmation code");
        } else {
			$this->UpdateDBRecForConfirmationParent($cidp);
		}
    } 

	/*updating the users record to 1 if the logins are correct for students */
    public function UpdateDBRecForConfirmation($cid) {
		global $dbh;
        $result = "SELECT * FROM web_students WHERE status='".$cid."' LIMIT 1";  
		$db_handle = $dbh->prepare($result);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		
        if ($get_rows == 0) {
            $this->showinfowithBlue("Wrong confirm code.");
        } else {
			$row = $db_handle->fetch(PDO::FETCH_OBJ);
			$user_email = $row->email;
			$user_user_n = $row->user_n;
			
			$updateStds = "UPDATE web_students SET status = '1' WHERE status = '".$cid."' LIMIT 1";
			$dbh_updateStds = $dbh->prepare($updateStds);
			$dbh_updateStds->execute();			
			$get_rows = $dbh_updateStds->rowCount();

			if($get_rows == 0) {
				$this->showalertwarningwithPaleYellow('Could not verify this account.<a href="'.$this->help_url('?topic=cant-verify-account').'">Why did this happen?</a>');
			} else {
				$this->showsuccesswithGreen('Your Account has been Activated '.$user_user_n.'. You can now <a href="'.$this->url_root('student/').'">Log In</a>');
				/*$this->SendUserWelcomeEmail($user_email); */
			}
		}
		$db_handle = null;
    }
	
	/* updating the users record to 1 if the logins are correct for the staff */
    public function UpdateDBRecForConfirmationStaff($cidp) {
        global $dbh;
        $result = "SELECT * FROM web_users WHERE web_users_active = '".$cidp."' LIMIT 1";  
		$db_handle = $dbh->prepare($result);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		
		
        if($get_rows == 0) {
            $this->showinfowithBlue("Wrong confirm code.");
        } else {
			$row = $db_handle->fetch(PDO::FETCH_OBJ);
			$web_users_username = $row->web_users_username;
			
			$updateUsr = "UPDATE web_users SET web_users_active = '1' WHERE web_users_active = '".$cidp."' LIMIT 1";
			$db_updateUsr = $dbh->prepare($updateUsr);
			$db_updateUsr->execute();
			$get_rowsUs = $db_updateUsr->rowCount();
			$db_updateUsr = null;
			
			if($get_rowsUs == 0) {
					$this->showalertwarningwithPaleYellow('Could not verify this account.<a href="'.$this->help_url('?topic=cant-verify-account').'">Why did this happen?</a>');
			} else {
				$this->showsuccesswithGreen('Your Account has been Activated '.$web_users_username.'. You can now <a href="'.$this->url_root('staff/').'">Log In</a>');
				/*$this->SendUserWelcomeEmail($user_email); */
			}
		}
		$db_handle = null;
    }
	
	/* updating the users record to 1 if the logins are correct for the parents */
    public function UpdateDBRecForConfirmationParent($cidp) {
        global $dbh;
		$result = "SELECT * FROM web_parents WHERE web_parents_active = '".$cidp."' LIMIT 1";  
		$db_handle = $dbh->prepare($result);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		
        if($get_rows == 0) {
            $this->showinfowithBlue("Wrong confirm code.");
        } else {
			$row = $db_handle->fetch(PDO::FETCH_OBJ); 
			$web_parents_username = $row->web_parents_username;
			
			$updateWParent = "UPDATE web_parents SET web_parents_active = '1' WHERE web_parents_active = '".$cidp."' LIMIT 1";
			$db_handle = $dbh->prepare($updateWParent);
			$db_handle->execute();
			$get_rowsWP = $db_handle->rowCount();
			$db_handleX = null;	
			
			if($get_rowsWP == 0) {
				$this->showalertwarningwithPaleYellow('Could not verify this account.<a href="'.$this->help_url('?topic=cant-verify-account').'">Why did this happen?</a>');
			} else {
				$this->showsuccesswithGreen('Your Account has been Activated '.$web_parents_username.'. You can now <a href="'.$this->url_root('parent/').'">Log In</a>');
				/*$this->SendUserWelcomeEmail($user_email); */
			}
		}
		$db_handle = null;
    }
	
	/* the reset password of a stuff and all **********************************************************************/
	public function confirm_email_send_link_student($username_supplied) {
		$mailing_list = new mailing_list();
        global $sender_mail;
		global $dbh;
		$getDetails = "SELECT * FROM web_students WHERE user_n = :username_supplied LIMIT 1";
		$db_handleX = $dbh->prepare($getDetails);
		$db_handleX->bindParam(':username_supplied', $username_supplied);
		$db_handleX->execute();
		$get_rows = $db_handleX->rowCount();
		$dataObj = $db_handleX->fetch(PDO::FETCH_OBJ);
		$db_handleX = null;	

			if ($get_rows == 0) {
				$this->showalertwarningwithPaleYellow('This Username was not Found. If you have forgotten your Username, meet the School Admin</a>');
			} else {
				$user_email = $dataObj->email;
				$password_gotten = $dataObj->pass;				
				$send_user_mail = $mailing_list->SendResetPasswordLink_viaEmail($user_email, $username_supplied, $password_gotten, $this->returnUserSchool(''), $sender_mail, 'student');
				if ($send_user_mail == true) {
					$this->showInfoCallout('A reset Link has been Sent to your Email Account. Please Click on that link Provided');
				} else {
					$this->showDangerCallout('Verfication Mail Sending Failed');
				}
			}
	}
	
	public function confirm_email_send_link_staff($username_supplied) {
	$mailing_list = new mailing_list();
        global $sender_mail;
		global $dbh;
		$getDetails = "SELECT * FROM web_users WHERE web_users_username = :username_supplied LIMIT 1";
		$db_handleX = $dbh->prepare($getDetails);
			$db_handleX->bindParam(':username_supplied', $username_supplied);
			$db_handleX->execute();
			$get_rows = $db_handleX->rowCount();
			$db_handleX = null;
	
		if ($get_rows == 0) {
			$this->showalertwarningwithPaleYellow('This Username was not Found. If you have forgotten your Username, meet the School Admin</a>');
		} else {
			$cmplx_query = "SELECT * FROM web_users AS wu, staff AS s WHERE wu.web_users_relid = s.staff_id AND wu.web_users_username = '".$username_supplied."'";
			$db_handleY = $dbh->prepare($cmplx_query);
			$db_handleY->execute();
			$detailsSetObg = $db_handleY->fetch(PDO::FETCH_OBJ);
				$password_gotten = $detailsSetObg->web_users_password;
				$users_username = $detailsSetObg->web_users_username;
				$email_gotten = $detailsSetObg->staff_email;
				
			$send_user_mail = $mailing_list->SendResetPasswordLink_viaEmail($email_gotten, $users_username, $password_gotten, $this->returnUserSchool(''), $sender_mail, 'staff');
			if ($send_user_mail == true) {
				$this->showInfoCallout('A reset Link has been Sent to your Email Account. Please Click on that link Provided');
			} else {
				$this->showDangerCallout('Verfication Mail Sending Failed');
			}
		}
	}
	
	public function confirm_email_send_link_parent($username_supplied) {
	$mailing_list = new mailing_list();
        global $sender_mail;
		global $dbh;
		$getDetails = "SELECT * FROM web_parents WHERE web_parents_username = :username_supplied LIMIT 1";
		$db_handleX = $dbh->prepare($getDetails);
			$db_handleX->bindParam(':username_supplied', $username_supplied);
			$db_handleX->execute();
			$get_rows = $db_handleX->rowCount();
			$db_handleX = null;
			
		if ($db_handleX->rowCount() == 0) {
			$this->showalertwarningwithPaleYellow('This Username was not Found. If you have forgotten your Username, meet the School Admin</a>');
		} else {
			$cmplx_query = "SELECT * FROM web_parents AS wu, student_parents AS sp WHERE wu.web_parents_relid = sp.student_parents_id AND wu.web_parents_username = '".$username_supplied."' LIMIT 1";
			$db_handleXT = $dbh->prepare($cmplx_query);
			$db_handleXT->execute();
			$detailsSetObg = $db_handleXT->fetch(PDO::FETCH_OBJ);
			
				$password_gotten = $detailsSetObg->web_parents_password;
				$users_username = $detailsSetObg->web_parents_username;
				$email_gotten = $detailsSetObg->student_parents_email;
				
			$send_user_mail = $mailing_list->SendResetPasswordLink_viaEmail($email_gotten, $users_username, $password_gotten, $this->returnUserSchool(''), $sender_mail, 'parent');
			if ($send_user_mail == true) {
				$this->showInfoCallout('A reset Link has been Sent to your Email Account. Please Click on that link Provided');
			} else {
				$this->showDangerCallout('Verfication Mail Sending Failed');
			}
		}
	}
	
	public function confirm_reset_student($email, $password) {
		global $dbh;
		$lnk_query = "SELECT * FROM web_students WHERE email = '".$email."' AND pass = '".$password."' LIMIT 1";
		$db_handleX = $dbh->prepare($lnk_query);
		$db_handleX->execute();
		$get_rows = $db_handleX->rowCount();
		$db_handleX = null;
			return ($get_rows == 1)? true: false;
	}
	
	public function confirm_reset_staff($email, $password) {
		global $dbh;
		$cmplx_query_lnk = "SELECT * FROM web_users AS wu, staff AS s WHERE wu.web_users_relid = s.staff_id 
									AND s.staff_email = '".$email."' AND wu.web_users_password = '".$password."' LIMIT 1";
		$db_handleX = $dbh->prepare($cmplx_query_lnk);
		$db_handleX->execute();
		$get_rows = $db_handleX->rowCount();
		$db_handleX = null;
		return ($get_rows == 1)? true: false;
	}
	
	public function confirm_reset_parent($email, $password) {
		global $dbh;
		$cmplx_query_lnk_oz = "SELECT * FROM web_parents AS wu, student_parents AS sp WHERE wu.web_parents_relid = sp.student_parents_id 
									AND sp.student_parents_email = '".$email."' AND wu.web_parents_password = '".$password."' LIMIT 1";
		$db_handleX = $dbh->prepare($cmplx_query_lnk_oz);
		$db_handleX->execute();
		$get_rows = $db_handleX->rowCount();
		$db_handleX = null;
		return ($get_rows == 1)? true: false;
	}
	
	public function change_password_student($decode_email, $pwd_code) {
		extract($_POST);
		global $dbh;
			if ($this->strIsEmpty($password1) or $this->strIsEmpty($password2)) {
				$this->showDangerCallout('Please Fill in a New Password. Something you can remember');
			} else {
				if (strcmp($password1, $password2) == 0) {
					$q = "UPDATE web_students SET pass = '".md5($password1)."' WHERE email = '".$decode_email."' AND `pass` = '".$pwd_code."' LIMIT 1";
					$db_handleX = $dbh->prepare($q);
					$db_handleX->execute();
					$get_rows = $db_handleX->rowCount();
					$db_handleX = null;
					
					if ($get_rows == 0) {
						$this->showDangerCallout('Fatal Error Occurred. <a href="'.$this->help_url('?topic=query-failed').'" target="blank">&raquo;Explanation?</a>');
					} else if ($get_rows == 1) {
						$this->showInfoCallout('Password Changed Successfully. <a href="'.$this->url_root('student/').'">Log in Now to Confirm</a>');	
					}
				} else {
						$this->showDangerCallout('Passwords do not Match. Please Retype Again');
				}
			}
	}
	
	public function change_password_staff($decode_email, $pwd_code) {
		  extract($_POST);
		  global $dbh;
			if ($this->strIsEmpty($password1) or $this->strIsEmpty($password2)) {
				$this->showDangerCallout('Please Fill in a New Password. Something you can remember');
			} else {
				if (strcmp($password1, $password2) == 0) {
				
				$cmplx = "SELECT * FROM web_users AS wu, staff AS s WHERE wu.web_users_relid = s.staff_id AND s.staff_email = '".$decode_email."' LIMIT 1";
					$db_handleX = $dbh->prepare($cmplx);
					$db_handleX->execute();
					$get_rows = $db_handleX->rowCount();
					$detailsSetObg = $db_handle->fetch(PDO::FETCH_OBJ);
					$db_handleX = null;
					
					$staff_id = $detailsSetObg->staff_id;
					$staff_username = $detailsSetObg->web_users_username;
					
				$qNet = "UPDATE web_users SET web_users_password = '".md5($password1)."' WHERE web_users_relid = '".$staff_id."' AND `web_users_username` = :staff_username LIMIT 1";
					$db_handleX = $dbh->prepare($qNet);
					$db_handleX->bindParam(':staff_username', $staff_username);
					$db_handleX->execute();
					$get_rows = $db_handleX->rowCount();
					$detailsSetObg = $db_handle->fetch(PDO::FETCH_OBJ);
					$db_handleX = null;
				
				if ($get_rows == 0) {
						$this->showWarningCallout('Could not Change Password. Your Previous password is not Correct');
					} elseif ($get_rows == 1) {
						$this->showInfoCallout('Password Changed Successfully. <a href="'.$this->url_root('staff/').'">Log in Now to Confirm</a>');
					}
				} else {
					$this->showWarningCallout('Passwords do not Match');
				}
			}
			
	}
	
	public function change_password_parent($decode_email, $pwd_code) {
		  extract($_POST);
		  global $dbh;
		  if ($this->strIsEmpty($password1) or $this->strIsEmpty($password2)) {
				$this->showDangerCallout('Please Fill in a New Password. Something you can remember');
			} else {
				if (strcmp($password1, $password2) == 0) {
				
				$cmplx = "SELECT * FROM web_parents AS wu, student_parents AS sp WHERE wu.web_parents_relid = sp.student_parents_id AND sp.student_parents_email = '".$decode_email."' LIMIT 1";
					$db_handleX = $dbh->prepare($cmplx);
					$db_handleX->execute();
					$get_rows = $db_handleX->rowCount();
					$detailsSetObg = $db_handle->fetch(PDO::FETCH_OBJ);
					$db_handleX = null;
					
					$student_parents_id = $detailsSetObg->student_parents_id;
					$student_parent_uname = $detailsSetObg->web_parents_username;
					
				$lastUpd = "UPDATE web_parents SET web_parents_password = '".md5($password1)."' WHERE web_parents_relid = '".$student_parents_id."' AND `web_parents_username` = :student_parent_uname LIMIT 1";
					$db_handleY = $dbh->prepare($lastUpd);
					$db_handleY->bindParam(':staff_username', $student_parent_uname);
					$db_handleY->execute();
					$get_rows = $db_handleY->rowCount();
					$detailsSetObg = $db_handle->fetch(PDO::FETCH_OBJ);
					$db_handleY = null;

					if ($get_rows == 0) {
							$this->showWarningCallout('Could Not Change Password. Your Previous password is not Correct');
						} else if ($get_rows == 1) {
							$this->showInfoCallout('Password Changed Successfully. <a href="'.$this->url_root('parent/').'">Log in Now to Confirm</a>');
						}
					} else {
						$this->showWarningCallout('Passwords do not Match');
					}
				}
			
	}
	
	
}//end of class
$confirmation = new confirmationz();
?>