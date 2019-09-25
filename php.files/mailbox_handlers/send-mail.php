<?php
extract($_POST);

class attchmentH extends kas_framework {
	public function attachment_handler(string $attachment): bool {
		$size = $_FILES["attachment"]["size"];
		$imgurl_new = constant('tripple_return'). 'files/mailattach/' .$attachment;
		if ($size > 9726696 ) {
			$this->showdangerwithRed('File Size too large. Max: 9MB. <a href="'.$this->help_url('?topic=file-error#size_large').'" target="_blank">Explanation?</a>');
				return false;
			} else if (@!move_uploaded_file($_FILES['attachment']['tmp_name'], $imgurl_new)) {
				$this->showdangerwithRed('Could not Upload Attachment. <a href="'.$this->help_url('?topic=file-error#couldnt_upload').'" target="_blank">Explanation?</a>');
				return false;
			} else {
				return true;
			}
	}
	
	public function receiver_category(string $email_to): string {
		/* get the category of the receiver */
		if ($this->valueExist('web_users_username', 'web_users', $email_to) === true) {
			$receiver_category = 'staff';
		} else if ($this->valueExist('web_parents_username', 'web_parents', $email_to) === true) {
			$receiver_category = 'parent';
		} else if ($this->valueExist('user_n', 'web_students', $email_to) === true) {
			$receiver_category = 'student';
		}
		return $receiver_category;
	}
}
$attachmentHandle = new attchmentH;
//print $email_to .'/'. $email_heading .'/'.$email_message;

$attachment = $_FILES["attachment"]["name"];

	if (($email_to == 'admin') or ($email_to == 'Admin') or ($email_to == 'ADMIN')) {
		$kas_framework->showdangerwithRed('You can not send messages to the admin from here. Please Use the Link "Tapp the Admin" Under the "Help-Desk" Menu');
	} else {
		if ($kas_framework->strIsEmpty($email_to) || $kas_framework->strIsEmpty($email_message)) {
			$kas_framework->showdangerwithRed('Please Supply a Recipient and Message');
		} else if (strlen($email_message) < 10) {
			$kas_framework->showdangerwithRed('Email message is too Short');
		} else if ($attachment == 'index' or $attachment == 'home') {
			$kas_framework->showdangerwithRed('Invalid File Name');
		} else if ($email_to == $my_username) {
			$kas_framework->showdangerwithRed('Fatal Error: Cannot send Mail to Self. Please Check destination Mail');
		} else if ($kas_framework->check_username_from_all($email_to) === false) {
			$kas_framework->showdangerwithRed('The Username "'.$email_to.'" does not Exist in this Portal. Please Check');
		} else if (!$kas_framework->strIsEmpty($email_heading) and strlen($email_heading) > 40) {
			$kas_framework->showdangerwithRed('Heading too long. Max: 20 Characters');
		} else if (!$kas_framework->strIsEmpty($attachment) and $attachmentHandle->attachment_handler($attachment) === false) {
			//say nothing..the function should  handle this
		} else {
			$email_to = strtolower($email_to);
			$mysql_raw_query = "INSERT INTO general_mailing VALUES (NULL, '".$my_username."', '".$from_category."', :email, '".$attachmentHandle->receiver_category($email_to)."', :email_heading, '".nl2br($email_message)."', '1', '1', '".date('d/m/Y')."', '".$attachment."', '1', '1')";
			$db_handle = $dbh->prepare($mysql_raw_query);
			$db_handle->bindParam(':email', $email_to);	$db_handle->bindParam(':email_heading', $email_heading);
			$db_handle->execute();
			$get_rows = $db_handle->rowCount();
			$db_handle = null;
			
				if ($get_rows == 1) {
					$kas_framework->showsuccesswithGreen('Mail Sent Succesfully');
				} else {
					$kas_framework->showalertwarningwithPaleYellow('Could not Send Mail. Try Sometime. <a href="'.$kas_framework->help_url('?topic=query-failed').'">Explanation?</a>');
				}
		}
	} //end of admin detector
?>