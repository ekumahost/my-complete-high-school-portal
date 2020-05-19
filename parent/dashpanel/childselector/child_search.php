<div><?php
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthParent();
require (constant('tripple_return').'php.files/parents_details.php');

extract($_POST);

if (!isset($byepass)) {
	exit('This File is Classified');
}
	
	if (strlen($search_item_name) < 3) {
		$kas_framework->showWarningCallout('Please Type a Search Item greater than 3 characters');
	} else {
		$search = $search_item_name; /*purify the string for the search*/
		/*jazing up the bloody query, we say*/
		$searchQuery = "SELECT * FROM studentbio WHERE studentbio_lname LIKE '%".$search."%' OR studentbio_fname LIKE '%".$search."%'
			OR std_bio_mobile LIKE '%".$search."%'	OR studentbio_internalid LIKE '%".$search."%'";
			$db_searchQuery = $dbh->prepare($searchQuery);
			$db_searchQuery->execute();
			$get_searchQuery_rows = $db_searchQuery->rowCount();
			
				if ($get_searchQuery_rows == 0) {
					$kas_framework->showWarningCallout('No Result found For the Search "'.$search.'"');
				} else {
				print '<table id="example1" class="table table-bordered table-striped">';
				$kas_framework->showWarningCallout($get_searchQuery_rows.' result(s) Found for "'.$search.'"');
				print '<thead><tr><th>Child Details</th><th>Picture</th><th>Action</th></tr></thead><tbody>';
					while ($rslt = $db_searchQuery->fetch(PDO::FETCH_OBJ)) {
					/*trying to get the image of the users*/
					$picx = $rslt->studentbio_pictures;
					/*trying to get the image of the users, we get the sub query as*/
					$childImgz = $kas_framework->imageDynamic($picx, $rslt->studentbio_gender, $kas_framework->url_root('pictures/'));
						print '<tr>
							<td>Name: '. $rslt->studentbio_fname .' '. $rslt->studentbio_lname .'<br /> Gender: '.$rslt->studentbio_gender.', and Hails from '.$kas_framework->getValue('ethnicity_desc', 'ethnicity', 'ethnicity_id', $rslt->studentbio_ethnicity).' Tribe 
							<br /> Date Of Birth: '.$rslt->studentbio_dob.'<br />School ID Number: '.$rslt->studentbio_internalid.'<br />Mobile: '.$rslt->std_bio_mobile.'</td>
						   <td><img src="'.$childImgz.'" width="80" href="'.$childImgz.'" style="cursor:pointer" class="fancybox fancybox.image img-circle" /></td>
							<td><br /><br /><span class="finishSelectChild" childID = "'.$rslt->studentbio_id.'" parentID = "'.$web_parents_relid.'">
							<button class="btn btn-success btn-block">This Is My Child</button></span>
							</td>
							</tr>';
					}
					$db_searchQuery = null;
				print ' </tbody></table>';
				}
		
	}
?></div>
<script type="text/javascript">
	$('.finishSelectChild').click(function() {
			$('#message_for_childselect').html('<?php $kas_framework->loading('center'); ?>');
			childID = $(this).attr('childID'); byepass = "jt3bi5lc2WCYREiVRC";
			parentID = $(this).attr('parentID');
			
			$.post('child_add+Script', {byepass:byepass, childID:childID, parentID:parentID}, function(data){
				$('#message_for_childselect').html(data);
			});			
		})
</script>