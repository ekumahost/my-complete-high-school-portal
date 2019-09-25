<?php
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/staff_details.php');

extract($_POST);

if (!isset($byepass)) {
	exit('This File is Classified');
}
$action = $_GET['action'];
if ($action == 'update_comment') {
	if ($kas_framework->strIsEmpty($comment_text) == true or strlen($comment_text) < 10) {
		print '<font color="red">At least 10 Characters required!!!</font>';
	} else {
		$updateQ = "UPDATE std_report_cards SET c_form_teacher = :comment_text WHERE grade = '".$grade_taken."' AND session = '".$current_year_id."' AND term = '".$currentTerm_id."' AND student = '".$std_id."'";
			$db_updateQ = $dbh->prepare($updateQ);
			$db_updateQ->bindParam(':comment_text', $comment_text);
			$db_updateQ->execute();
			$get_updateQ_rows = $db_updateQ->rowCount();
			$db_updateQ = null;	
			
						if ($get_updateQ_rows == 1) { ?>
							<script type="text/javascript">
							std_id = '<?php print $std_id ?>';
							comment_text = '<?php print $comment_text ?>';
								$('#comment_div_holder_' + std_id).html('<textarea disabled="disabled" class="form-control edit_comment_text<?php print $std_id ?>"><?php print $comment_text ?></textarea><a href="#" class="btn btn-sm pull-left enable_edit" std_id="<?php print $std_id ?>"> &#10004 Refresh to Edit</a><button class="btn btn-sm pull-left std_edit_comment_button" std_id="<?php print $std_id ?>"> Update</button><span class="margin" style="font-size:12px" id="result_drop<?php print $std_id ?>"></span>');
							</script>
						<?php } else {
								print '<font color="red" style="font-size:12px">&#10007 No Changes Effected.</font>';
							}
	}
} else if ($action == 'update_cog_domain') {
	//Array ( [std_id] => 1 [cog_1] => 3 [cog_2] => 5 [cog_3] => -- [cog_4] => -- grade_taken)
	$updateQ = "UPDATE std_report_cards SET cog_1 = '".$cog_1."', cog_2 = '".$cog_2."', cog_3 = '".$cog_3."', cog_4 = '".$cog_4."'
			WHERE grade = '".$grade_taken."' AND session = '".$current_year_id."' AND term = '".$currentTerm_id."'	AND student = '".$std_id."'";
			$db_updateQ = $dbh->prepare($updateQ);
			$db_updateQ->execute();
			$get_updateQ_rows = $db_updateQ->rowCount();
			$db_updateQ = null;	
			
				if ($get_updateQ_rows == 1) { 
					print '<font color="green">&#10004 Updated.</font>';
				} else {
					print '<font color="red" style="font-size:12px">&#10007 No Changes Effected.</font>';
				}
}
	

?>