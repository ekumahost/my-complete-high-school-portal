<?php
	$deflim = 0;
	if (isset($_GET['page'])) {
			$deflim = $_GET['page'] - 1;
			$deflim = $deflim * 15;
	}	
	$querySQL = "SELECT * FROM general_mailing WHERE from_starred = '0' AND `from` = '".$my_username."' AND ((from_status = '1') OR (from_status = '0')) 
		UNION SELECT * FROM general_mailing WHERE to_starred = '0' AND `to` = '".$my_username."' AND ((to_status = '1') OR (to_status = '0')) lIMIT ".$deflim.", 15";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->execute();
	$all_starred = $db_handle->rowCount();
	
				
		if ($all_starred == 0) {
			echo '<br /><br /><br />';
			echo '<tr><td class="small-col" colspan="4" style="padding:12px; text-align:center">You have Not Starred any Message. Try Starring One</td></tr>';
		} else {
			while ($inbox = $db_handle->fetch(PDO::FETCH_OBJ)) {
			
			echo '<tr>
			<td class="small-col"><input type="checkbox" value="'.$kas_framework->saltifyID($inbox->id).'" name="eachCheckbox[]" /></td>
			<td class="small-col"><i class="fa fa-star" cat="unstarred" mailid="'.$inbox->id.'"></i></td>
			<td class="name"><a href="?rf=starred&&rid='.$kas_framework->saltifyID($inbox->id).'">'.ucfirst($inbox->to).'</a></td>
			<td class="subject"><a href="?rf=starred&&rid='.$kas_framework->saltifyID($inbox->id).'">'.$internalMailEx->the_mail_head($inbox->head, $inbox->to).'</a></td>
			<td class="time">';
			echo ($inbox->attachment == '')? '': '<i class="fa fa-tags"></i>';
			echo '</td>
			<td class="time">'.$inbox->time.'</td>
			</tr>';	
			}
			$db_handle = null;
		include ('mail-search-action.php');
		}	
	
	$total_starred_query_total = "SELECT * FROM general_mailing 
		WHERE from_starred = '0' AND `from` = '".$my_username."' AND ((from_status = '1') OR (from_status = '0')) UNION SELECT * FROM general_mailing 
		WHERE to_starred = '0' AND `to` = '".$my_username."' AND ((to_status = '1') OR (to_status = '0'))";
	$db_handle = $dbh->prepare($total_starred_query_total);
	$db_handle->execute();
	$generalTotal = $db_handle->rowCount();
	$db_handle = null;
?>