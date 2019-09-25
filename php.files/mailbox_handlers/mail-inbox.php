<?php

$deflim = 0;
if (isset($_GET['page'])) {
	$deflim = $_GET['page'] - 1;
	$deflim = $deflim * 15;
}
	$inboxQ = "SELECT * FROM general_mailing WHERE `to` = '".$my_username."' AND to_starred = '1' AND ((to_status = '1') OR (to_status = '0')) ORDER BY id DESC lIMIT ".$deflim.", 15";
	 $db_handle = $dbh->prepare($inboxQ);
		$db_handle->execute();
		$generalTotal = $db_handle->rowCount();
		 
		if ($generalTotal == 0) {
			print '<br /><br /><br />';
			print '<tr><td class="small-col" colspan="4" style="padding:12px; text-align:center">No Messages in your Inbox</td></tr>';	
		} else {
			while ($inbox = $db_handle->fetch(PDO::FETCH_OBJ)) {
				/*checking if the message is been read or not but this shows when its unread*/
				if ($inbox->to_status == '1') {
					print '<tr class="unread">
				<td class="small-col"><input type="checkbox" value="'.$inbox->id.'" name="eachCheckbox[]" /></td>
				<td class="small-col"><i class="fa fa-star-o" cat="inbox" mailid="'.$inbox->id.'"></i></td>
				<td class="name"><a href="?rf=inbox&&rid='.$kas_framework->saltifyID($inbox->id).'">'.$inbox->from.'</a></td>
				<td class="subject"><a href="?rf=inbox&&rid='.$kas_framework->saltifyID($inbox->id).'">'.$internalMailEx->the_mail_head($inbox->head, $inbox->from).'</a></td>
				<td class="time">';
				print ($inbox->attachment == '')? '': '<i class="fa fa-tags"></i>';
				print '</td>
				<td class="time">'.$inbox->time.'</td>
			</tr>';
				} else {
				/*checking if the message is been read or not but this shows when its resd*/
				print '<tr>
			<td class="small-col"><input type="checkbox" value="'.$inbox->id.'" name="eachCheckbox[]" /></td>
			<td class="small-col"><i class="fa fa-star-o" cat="inbox" mailid="'.$inbox->id.'"></i></td>
			<td class="name"><a href="?rf=inbox&&rid='.$kas_framework->saltifyID($inbox->id).'">'.ucfirst($inbox->from).'</a></td>
			<td class="subject"><a href="?rf=inbox&&rid='.$kas_framework->saltifyID($inbox->id).'">'.$internalMailEx->the_mail_head($inbox->head, $inbox->from).'</a></td>
			<td class="time">';
			print ($inbox->attachment == '')? '': '<i class="fa fa-tags"></i>';
			print '</td>
			<td class="time">'.$inbox->time.'</td>
			</tr>';	
				}
			}	
			include ('mail-search-action.php');
		}
		
	$inboxQTt = "SELECT COUNT(*) AS cnt FROM general_mailing WHERE `to` = '".$my_username."' AND to_starred = '1' AND ((to_status = '1') OR (to_status = '0'))";
	$db_handle = $dbh->prepare($inboxQTt);
	$db_handle->execute();
	$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;	
	$generalTotal = $paramGetFields->cnt;
?>