<?php

if (file_exists('../../php.files/classes/pdoDB.php')) {
	$fileURL = '../../php.files/classes/pdoDB.php';
} else if (file_exists('../../../php.files/classes/pdoDB.php')) {
	$fileURL = '../../../php.files/classes/pdoDB.php';
} else if (file_exists('../../../../php.files/classes/pdoDB.php')) {
	$fileURL = '../../../../php.files/classes/pdoDB.php';
}

class internalMail extends kas_framework {
	public function updateMessageToRead($id) {
		global $fileURL;
		require ($fileURL);
		$querySQL = "UPDATE general_mailing SET to_status = '0' WHERE id = '".$this->unsaltifyID($id)."' AND to_status = '1' LIMIT 1";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$db_handle = null;
	}
	//$kas_framework->unsaltifyID($inbox->id)
	
	public 	function the_mail_head($mail_head, $mail_from) {
		if ($mail_head == '') {
			$new_head = 'Mail Message &raquo;&raquo; '.ucfirst($mail_from);
			return $new_head;
		} else {
			return $mail_head;	
		}
	}
	
	public function getImageForHeader($mailFrom, $category) {
		if ($category == 'parent') {
			//print 'parent';
			global $fileURL;
			require ($fileURL);
			$querySQL = "SELECT * FROM web_parents AS wS, student_parents AS sB WHERE web_parents_username = '".$mailFrom."' AND wS.web_parents_relid = sB.student_parents_id LIMIT 1";
			$db_handle = $dbh->prepare($querySQL);
			$db_handle->execute();
			$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
			$db_handle = null;			
				$sender_id = $paramGetFields->student_parents_id;
				$sender_sex = $paramGetFields->student_parents_sex;
				// get the image from the staff table
				$getStoredImage = $paramGetFields->student_parents_image;
				$respective_image = $this->imageDynamic($getStoredImage, $sender_sex, $this->server_root_dir('pictures/'));
				
		} else if ($category == 'staff') {
			//print 'staff';
			global $fileURL;
			require ($fileURL);
			$querySQL = "SELECT * FROM web_users AS wS, staff AS sB WHERE web_users_username = '".$mailFrom."' AND wS.web_users_relid = sB.staff_id";
			$db_handle = $dbh->prepare($querySQL);
			$db_handle->execute();
			$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
			$db_handle = null;			
			$sender_id = $paramGetFields->staff_id;
			$sender_sex = $paramGetFields->staff_sex;
			// get the image from the staff table
			$getStoredImage = $paramGetFields->staff_image;				
			$respective_image = $this->imageDynamic($getStoredImage, $sender_sex, $this->server_root_dir('pictures/'));
		
		} else if ($category = 'student') {
			global $fileURL;
			require ($fileURL);
			$querySQL = "SELECT * FROM web_students AS wS, studentbio AS sB WHERE user_n = '".$mailFrom."' AND wS.identify = sB.studentbio_internalid LIMIT 1";
			$db_handle = $dbh->prepare($querySQL);
			$db_handle->execute();
			$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
			$db_handle = null;			
			$sender_id = $paramGetFields->studentbio_id;
			$sender_sex = $paramGetFields->studentbio_gender;
			/*get the image from the studentbio table*/
			$getStoredImage = $paramGetFields->studentbio_pictures;
			$respective_image = $this->imageDynamic($getStoredImage, $sender_sex, $this->server_root_dir('pictures/'));
		}
	return $respective_image;
	}
	
	public function countTotalRecieved() {
		global $my_username;
		global $fileURL;
		require ($fileURL);
		$querySQL = "SELECT COUNT(*) AS cnt FROM general_mailing WHERE `to` = '".$my_username."' and to_starred = '1' AND ((to_status = '1') OR (to_status = '0'))";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;
		$total = $paramGetFields->cnt;			
		return $total;
	}
	
	public function countUnread() {
	global $my_username;	
	global $fileURL;
		require ($fileURL);
		$querySQL = "SELECT COUNT(*) AS cnt FROM general_mailing WHERE `to` = '".$my_username."' AND to_status = '1' AND to_starred = '1'";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;
		$total = $paramGetFields->cnt;			
		return $total;
		}
	
	public function countTotalSent() {
	global $my_username;
	global $fileURL;
		require ($fileURL);
		$querySQL = "SELECT COUNT(*) AS cnt FROM general_mailing WHERE `from` = '".$my_username."' AND from_starred = '1' AND ((from_status = '1') OR (from_status = '0'))";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;
		$total = $paramGetFields->cnt;			
		return $total;
	}
	
	public function countTotalStarred() {
	global $my_username;	
	global $fileURL;
		require ($fileURL);
		$querySQL1 = "SELECT COUNT(*) AS cnt FROM general_mailing WHERE from_starred = '0' AND `from` = '".$my_username."' AND ((from_status = '1') OR (from_status = '0'))";
		$querySQL2 = "SELECT COUNT(*) AS cnt FROM general_mailing WHERE to_starred = '0' AND `to` = '".$my_username."' AND ((to_status = '1') OR (to_status = '0'))";
		$db_handle1 = $dbh->prepare($querySQL1); $db_handle2 = $dbh->prepare($querySQL2);
		$db_handle1->execute(); $db_handle2->execute();		
		$paramGetFields1 = $db_handle1->fetch(PDO::FETCH_OBJ); $paramGetFields2 = $db_handle2->fetch(PDO::FETCH_OBJ);
		$db_handle1 = null;	$db_handle2 = null;
		$total1 = $paramGetFields1->cnt;	$total2 = $paramGetFields2->cnt;		
		$all_starred = $total1 + $total2;
		return $all_starred;
	}				
	
	public function countTotalJunk() {
	global $my_username;	
	global $fileURL;
		require ($fileURL);
		$querySQL1 = "SELECT COUNT(*) AS cnt FROM general_mailing WHERE  `from` = '".$my_username."' AND from_status = '2'";
		$querySQL2 = "SELECT COUNT(*) AS cnt FROM general_mailing WHERE `to` = '".$my_username."' AND to_status = '2'";
		$db_handle1 = $dbh->prepare($querySQL1); $db_handle2 = $dbh->prepare($querySQL2);
		$db_handle1->execute(); $db_handle2->execute();		
		$paramGetFields1 = $db_handle1->fetch(PDO::FETCH_OBJ); $paramGetFields2 = $db_handle2->fetch(PDO::FETCH_OBJ);
		$db_handle1 = null;	$db_handle2 = null;
		$total1 = $paramGetFields1->cnt;	$total2 = $paramGetFields2->cnt;		
		$all_junked = $total1 + $total2;
		return $all_junked;
	}
	
	public function showTotalMessageNewForHeader() {
		if ($this->countUnread() == '0') {
		print ' <li class="header">You have No Messages</li>';	
		} else {
		print ' <li class="header">You have '.$this->countUnread().' Message(s)</li>';	
		}
	}
	
	public function getClickFolderForHeader($category) {
		if ($category == 'parent') {
			$dir = 'parent/dashpanel';
		} else if ($category == 'student' or $category == 'pros-student') {
			$dir = 'student/dashboard';
		} else if ($category == 'staff') {
			$dir = 'staff/dashpanel';
		}
		return $dir;
	}
	
	public function getMessageForHeader() {
	global $my_username;
	global $fileURL;
		require ($fileURL);
		if ($this->countUnread() == '0') {
		/*retrieve the messages in the header for read old messages*/		
		$querySQL = "SELECT * FROM general_mailing WHERE `to` = '".$my_username."' AND to_starred = '1' AND to_status = '0' ORDER BY id DESC LIMIT 0, 10";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$oldMessageCount = $db_handle->rowCount();

			/* cheking if you have received any messages before /* */
			if ($oldMessageCount == 0) {
				print '<p style="margin:18px 8px; text-align:center">You have not Reveived any Message. Try Sending one.</p>';
			}
				while ($new_Msg = $db_handle->fetch(PDO::FETCH_OBJ)) {
					print '<li class="click_ult">';
						print '<a href="'.$this->server_root_dir($this->getClickFolderForHeader($new_Msg->to_cat). '/mailbox/?rf=inbox&&rid=').$this->saltifyID($new_Msg->id).'">';
						print '<div class="pull-left">
				<img src="'.$this->getImageForHeader($new_Msg->from, $new_Msg->from_cat).'" class="img-circle" alt="User Image"/>
								</div>
								<h4>'.$new_Msg->from.' &raquo; '.$new_Msg->from_cat.'</h4>
								<p>'.$this->the_mail_head($new_Msg->head, $new_Msg->from).'</p>
							</a>
						</li>';
				}
			
		} else {
		/*retrieve the messages in the header for new messages */
		$querySQL = "SELECT * FROM general_mailing WHERE `to` = '".$my_username."' AND to_starred = '1' AND to_status = '1' ORDER BY id DESC LIMIT 0, 10";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$newMessageCount = $db_handle->rowCount();		
			while ($new_Msg = $db_handle->fetch(PDO::FETCH_OBJ)) {
				print '<li>
						<a href="'.$this->server_root_dir($this->getClickFolderForHeader($new_Msg->to_cat). '/mailbox/?rf=inbox&&rid=').$this->saltifyID($new_Msg->id).'">
							<div class="pull-left">
			<img src="'.$this->getImageForHeader($new_Msg->from, $new_Msg->from_cat).'" class="img-circle" alt="User Image"/>
							</div>
							<h4>'.$new_Msg->from.' &raquo; '.$new_Msg->from_cat.'</h4>
							<p>'.$this->the_mail_head($new_Msg->head, $new_Msg->from).'</p>
						</a>
					</li>';
			}
		}
		$db_handle = null;
	}
	
	public function xtraMsgHandler($id, string $my_username, string $junk_delete): bool {
		global $my_username;
		global $fileURL;
		require ($fileURL);
		//technically setting the id of the status to 3 for delete and 2 for junk
		$querySQL = "SELECT * FROM general_mailing WHERE `id` = '".$this->unsaltifyID($id)."' LIMIT 1";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;	
		
		if ($junk_delete == 'junk') { $jdVal = '2'; } else { $jdVal = '3'; }
			if ($my_username == $paramGetFields->to) { /*updating the to status*/
					$jd_query = "UPDATE general_mailing SET `to_status` = '".$jdVal."' WHERE id = '".$this->unsaltifyID($id)."' AND `to` = '".$my_username."' LIMIT 1";
				} else if ($my_username == $paramGetFields->from) { /*updating the from status*/
					$jd_query = "UPDATE general_mailing SET `from_status` = '".$jdVal."' WHERE id = '".$this->unsaltifyID($id)."' AND `from` = '".$my_username."' LIMIT 1";
				}
				
				$db_handle = $dbh->prepare($jd_query);
				$db_handle->execute();
				$get_rows = $db_handle->rowCount();
				$db_handle = null;
				if ($get_rows == 1) { return true; } else { return false; }
	}
	
	public function junkRestore($id, $my_username) {
		global $my_username;
		//technically setting the id of the status to 0
		global $fileURL;
		require ($fileURL);
		$querySQL = "SELECT * FROM general_mailing WHERE id = '".$this->unsaltifyID($id)."'";
		$db_handle = $dbh->prepare($querySQL);
		$db_handle->execute();
		$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
		$db_handle = null;		

			if ($my_username == $paramGetFields->to and $paramGetFields->to_status == '2') {
				 /*updating the to status to 0 to restore */
				$jd_query = "UPDATE general_mailing SET to_status = '0' WHERE id = '".$this->unsaltifyID($id)."' AND `to` = '".$my_username."' LIMIT 1";
			} else if ($my_username == $paramGetFields->to->from and $paramGetFields->to->from_status == '2') {
				/*updating the from status to 0 to restore */
				$jd_query = "UPDATE general_mailing SET from_status = '0' WHERE id = '".$this->unsaltifyID($id)."' AND `from` = '".$my_username."' LIMIT 1";
			}
				$db_handle = $dbh->prepare($jd_query);
				$db_handle->execute();
				$get_rows = $db_handle->rowCount();
				$db_handle = null;
				if ($get_rows == 1) { return true; } else { return false; }
	}
	
	public function markAsReadandUnread($id, $my_username, $read_unread): bool {
		if (file_exists('../../php.files/classes/pdoDB.php')) {
			$fileURL = '../../php.files/classes/pdoDB.php';
		} else if (file_exists('../../../php.files/classes/pdoDB.php')) {
			$fileURL = '../../../php.files/classes/pdoDB.php';
		} else if (file_exists('../../../../php.files/classes/pdoDB.php')) {
			$fileURL = '../../../../php.files/classes/pdoDB.php';
		}
		include ($fileURL);
		global $my_username;
			// if ($read_unread == 'read') { $status = '1'; } else { $status = '0'; }
			if ($read_unread == 'read') {
				$rawQ = "UPDATE general_mailing SET to_status = '0' WHERE `to` = '".$my_username."' AND id = '".$this->unsaltifyID($id)."' LIMIT 1";
			} else if ($read_unread == 'unread') {
				$rawQ = "UPDATE general_mailing SET to_status = '1' WHERE `to` = '".$my_username."' AND id = '".$this->unsaltifyID($id)."' LIMIT 1";	
			}
				$db_handle = $dbh->prepare($rawQ);
				$db_handle->execute();
				$get_rows = $db_handle->rowCount();
				$db_handle = null;
				if ($get_rows == 1) { return true; } else { return false; }
	}
	
}
$internalMailEx = new internalMail;
?>