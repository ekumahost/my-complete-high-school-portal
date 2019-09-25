<?php
	$deflim = 0;
	if (isset($_GET['page'])) {
		$deflim = $_GET['page'] - 1;
		$deflim = $deflim * 15;
	}

	$querySQL = "SELECT * FROM general_mailing WHERE `from` = '".$my_username."'
	 AND from_starred = '1' AND ((from_status = '1') OR (from_status = '0')) ORDER BY id DESC lIMIT ".$deflim.", 15";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();

		if ($get_rows == 0) {
			print '<br /><br /><br />';
			print '<tr><td class="small-col" colspan="4" style="padding:12px; text-align:center">You have Not sent any Message. Try Sending One</td></tr>';
		} else {
			while ($inbox = $db_handle->fetch(PDO::FETCH_OBJ)) {
			
			print '<tr>
			<td class="small-col"><input type="checkbox" value="'.$kas_framework->saltifyID($inbox->id).'" name="eachCheckbox[]" /></td>
			<td class="small-col"><i class="fa fa-star-o" cat="sent" mailid="'.$inbox->id.'"></i></td>
			<td class="name"><a href="?rf=sent&&rid='.$kas_framework->saltifyID($inbox->id).'">'.ucfirst($inbox->to).'</a></td>
			<td class="subject"><a href="?rf=sent&&rid='.$kas_framework->saltifyID($inbox->id).'">'.$internalMailEx->the_mail_head($inbox->head, $inbox->to).'</a></td>
			<td class="time">';
			print ($inbox->attachment == '')? '': '<i class="fa fa-tags"></i>';
			print '</td>
			<td class="time">'.$inbox->time.'</td>
			</tr>';	
			}

		include ('mail-search-action.php');
	}
  
  $querySQL = "SELECT COUNT(*) AS cnt FROM general_mailing WHERE `from` = '".$my_username."' AND from_starred = '1' AND ((from_status = '1') OR (from_status = '0')) ORDER BY id DESC";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->execute();
	$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;	
	$generalTotal = $paramGetFields->cnt;
  
?>