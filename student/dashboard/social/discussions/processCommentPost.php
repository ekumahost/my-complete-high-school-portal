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

	
	if ($kas_framework->strIsEmpty($commentText) == true) {
		$kas_framework->jsalert('Please type in Something in the TextBox');
		$kas_framework->buttonController('#commentTextButton', 'enable');
	} else {
			$stdReplyPost = "INSERT INTO student_post_reply (post_rel_id, post_commenter_id, post_comment, post_comment_date) VALUES 
			('".$passing_idz."', '".$student_id_original."', '".nl2br($commentText)."', '".date('d/m/Y')."')";
			$db_stdReplyPost = $dbh->prepare($stdReplyPost);
			$db_stdReplyPost->execute();
			$get_rows = $db_stdReplyPost->rowCount();
			$db_stdReplyPost = null;
			
			$inserted_comment_id = $dbh->lastInsertId(); /* picking the inserted mysql id*/
			
				if ($get_rows == 1) {
					/*show the post of the person posting*/	
					$query = "SELECT * FROM student_post_reply AS spr, studentbio AS s
								WHERE spr.id = '".$inserted_comment_id."' AND s.studentbio_id = spr.post_commenter_id LIMIT 1";
								$db_query = $dbh->prepare($query);
								$db_query->execute();
								$get_rows = $db_query->rowCount();
								
							$view_comment = $db_query->fetch(PDO::FETCH_OBJ);
							$db_query = null;
							$cmtrPicx = $view_comment->studentbio_pictures;
							$cmtrSex = $view_comment->studentbio_gender;
							$cmtrPixLoc = $kas_framework->imageDynamic($cmtrPicx, $cmtrSex, $kas_framework->server_root_dir('pictures/'));
							
						/* printing the text to the screen as it was just posted*/
								print ' <li>
								<div class="discussion2-item">
									<img src="'.$cmtrPixLoc.'" alt="" style="float:left; width:40px; margin:8px 5px 5px 3px" />
									<div class="discussion2-body" id="body_discuss2">On '.$view_comment->post_comment_date.',  <b>'.$view_comment->studentbio_fname.' '.$view_comment->studentbio_lname. '</b> Said: <br />'.$view_comment->post_comment.'</div>
								</div>
							</li>';	
					/*show the post of the person posting*/	
						$kas_framework->buttonController('#commentTextButton', 'enable');
						$totalCommentsNow = $kas_framework->countRestrict1('student_post_reply', 'post_rel_id', $passing_idz);
							?>
						<script type="text/javascript">
							$('.spanCounterUpdater').html("<?php print $totalCommentsNow ?>");
						</script>
			<?php	} else {
					$kas_framework->jsalert('Something Went Wrong');
				}
		} 
				
?>