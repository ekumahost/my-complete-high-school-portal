<style type="text/css"> p { margin:0}  </style>
<?php
$target_id = $_GET['rid'];
$internalMailEx->saltifyID($target_id);

$querySQL = "SELECT * FROM general_mailing WHERE id = '".$kas_framework->unsaltifyID($target_id)."' LIMIT 1";
$db_handle = $dbh->prepare($querySQL);
$db_handle->execute();
$get_rows = $db_handle->rowCount();
$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
$db_handle = null;	

//if the id of the mesage is not existing in the database,
if ($get_rows == 0) {
	print '<br />';
	$kas_framework->showdangerwithRed('Error Locating this Message. Please Click on the right Message to View. <a href="'.$kas_framework->help_url('?topic=invalid-url-parameter').'" target="new">Explanation? <a>');
		require (constant('tripple_return').'php.files/classes/class.phpmailer.php');
		require (constant('tripple_return').'php.files/classes/mailing_list.php');
			$mailing_list->mailHackingReport($kas_framework->returnUserSchool(''), 'A hacking attempt was just made on the portal of the schools name which appear above.
			<br />Destination: Unknown. <br />Location: Reading of Internal Mails. <br />User IP: '.$kas_framework->getUserIP().'<br />
			Details: Username: '.$username.' &raquo; <br />Severity: High. <br />Please Respond.');
	
	} else {
	//message id is existing in the database
		
	$msg_to = $paramGetFields->to;
	$msg_to_cat = $paramGetFields->to_cat;
	$msg_frm =  $paramGetFields->from;
	$msg_frm_cat =  $paramGetFields->from_cat;
	$msg_head =  $paramGetFields->head;
	$msg_message = $paramGetFields->message;
	$msg_time =  $paramGetFields->time;
	$msg_attachment = $paramGetFields->attachment;
	$msg_status_to =  $paramGetFields->to_status;
	$msg_status_from =  $paramGetFields->from_status;
	
	//making sure that the message is itended for the particular person logged in with the username
	if (strtolower($msg_to) != strtolower($my_username) && strtolower($msg_frm) != strtolower($my_username)) {
		print '<br />';
		$kas_framework->showdangerwithRed('This is a Classified Message. The Message was not meant to be seen by you. You have just tried hijacking someone else message. Your account has been sent for monitoring <a href="'.$kas_framework->help_url('?topic=invalid-url-parameter').'" target="new">Explanation? <a>');
		require (constant('tripple_return').'php.files/classes/class.phpmailer.php');
		require (constant('tripple_return').'php.files/classes/mailing_list.php');
			$mailing_list->mailHackingReport($kas_framework->returnUserSchool(''), 'A hacking attempt was just made on the portal of the schools name which appear above.
			<br />Destination: Unknown. <br />Location: Reading of Internal Mails. User tried reading a message not intended for him/her. <br />User IP: '.$kas_framework->getUserIP().'<br />
			Details: Username: '.$username.' &raquo; <br />Severity: High. <br />Please Respond.');
		
	} else {
		print '<div style="border:1px solid #ccc; padding:15px; margin-top:20px; border-radius:3px">';
		if ($my_username == $msg_frm) {
			/*meaning that you sent the message and this is what will appear*/
			print '<i class="fa fa-th-large"></i> This Message was Sent to: <b>'. ucfirst($msg_to) .'</b> On <b>' .$msg_time .'</b>';
			if ($msg_head != '') { print '<br /><br />
			<i class="fa fa-chevron-right"></i> Message Heading: <br /><b>'.$msg_head . '</b>'; }
			
			print '<img class="pull-right img-circle" width="100" src="'.$internalMailEx->getImageForHeader($msg_to, $msg_to_cat).'" />';
			
			print '<br /><br /><i class="fa fa-envelope"></i> Message Body<hr style="margin:0 0 4px 0" /> '. $msg_message;
			print '<hr style="margin:0" /><br />';
			
			if ($msg_attachment == '') {
				print 'No Attachment';
			} else {
				print 'Click on Attachment to Start Download: <a href="'.$kas_framework->url_root('files/mailattach/').''.$msg_attachment.'"><div class="btn btn-success btn-file">
                                    <i class="fa fa-cloud-download"></i> Attachment
                      </div></a>';
			}
		
		} else {
			/*meaning that the message was sent to you*/
			$internalMailEx->updateMessageToRead($target_id);
			/*update here and set the message url to read*/
			print '<i class="fa fa-th-large"></i> This Message was Sent From: <b>'. ucfirst($msg_frm) .'</b> On <b>' .$msg_time .'</b>';
			if ($msg_head != '') { print '<br /><br />
			<i class="fa fa-chevron-right"></i> Message Heading: <br /><b>'.$msg_head . '</b>'; }
			
			print '<img class="pull-right img-circle" width="100" src="'.$internalMailEx->getImageForHeader($msg_frm, $msg_frm_cat).'" />';
			
			print '<br /><br /><i class="fa fa-envelope"></i> Message Body<hr style="margin:0 0 4px 0" /> '. $msg_message;
			print '<hr style="margin:0" /><br />';
			if ($msg_attachment == '') {
				print 'No Attachment';
			} else {
				print 'Click on Attachment Download: <a href="'.$kas_framework->url_root('files/mailattach/').''.$msg_attachment.'">
				<div class="btn btn-success btn-file"><i class="fa fa-cloud-download"></i> Attachment
                      </div></a>';
			}
			print '&nbsp;&nbsp;<button class="btn btn-warning btn-flat" data-toggle="modal" data-target="#compose-modal">
			<i class="fa fa-mail-reply"></i> Reply </button>';
		}
		
		print '<br /><br />Other Actions: &nbsp;&nbsp;';
		
		if (@$_GET['rf'] == 'junk') {
			print '<button class="btn btn-default btn-flat" type="submit" name="junk_restore">
           <i class="fa fa-level-up"></i> Restore To Folder</button>';
		} else {
			print '<button class="btn btn-default btn-flat" type="submit" name="junkIndiv"> 
			<i class="fa fa-archive"></i> Move to junk</button>';
		}
		print '&nbsp;&nbsp;<button class="btn btn-default btn-flat" type="submit" name="delIndiv">
		<i class="fa fa-trash-o"></i> Delete Permanently</button>';
		
		print '</div>';
	}
}
?>