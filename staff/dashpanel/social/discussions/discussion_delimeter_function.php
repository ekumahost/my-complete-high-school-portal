<?php 

class discussionz extends kas_framework {
	
	public function controlTextShowMore($id, $text, $showToEnd) {
		$brappears = substr_count($text, '<br />');
				if ($brappears > 3) { $showToEnd = 200;	}
		
		if (strlen($text) > $showToEnd) {
			print substr($text, 0, $showToEnd) .'... 
			<a href="comment?click='.$this->generateRandomString(30).'&back='.$this->saltifyID($id).'&ref='.$this->generateRandomString(30).'" class="showMore click_ult" id="'.$id.'">&raquo; Show All... </a>';
		} else { print $text; }
	}
	
	function viewDescretedWhilePosts($show_post, $restrict_post_count, $web_users_relid) {
		require ('../../../../php.files/classes/pdoDB.php');
	  /* getting the users image */
		$picxPstrlc = $this->getValue('staff_image', 'staff', 'staff_id', $show_post->poster_id);
		$picxPstrSex = $this->getValue('staff_sex', 'staff', 'staff_id', $show_post->poster_id);
		$pstr_img_url = $this->imageDynamic($picxPstrlc, $picxPstrSex, $this->url_root('pictures/'));
		
		/* getting the users details */
		$pstr_details = "SELECT * FROM staff WHERE staff_id = '".$show_post->poster_id."' LIMIT 1";
		$db_pstr_details = $dbh->prepare($pstr_details);
		$db_pstr_details->execute();
		$get_pstr_details_rows = $db_pstr_details->rowCount();
		$paramObj = $db_pstr_details->fetch(PDO::FETCH_OBJ);
		$db_pstr_details = null;
		$pstr_name = $paramObj->staff_fname. ' '.$paramObj->staff_lname;
		
		/*getting the total comments and  total likes*/
		$ttl_comments_on_post = $this->countRestrict1('staff_post_reply', 'post_rel_id', $show_post->id);

		$like_all_commas = $this->getValue('liker_id', 'staff_post', 'id', $show_post->id);
		$ttl_liks_on_post = substr_count($like_all_commas , ';');
		
		/* Checking if you have liked this */
		if (substr_count($like_all_commas, $web_users_relid. ';') != 0) {
			$xtraAttr = 'disabled';
		} else {
			$xtraAttr = '';
		}
		
		print ' <li>
					<div class="discussion-item" id="myDiscussion'.$show_post->id.'">
						<span class="time"><i class="fa fa-clock-o"></i> '.$show_post->post_date.'</span>
						<h3 class="discussion-header"><b>'.$pstr_name.'</b>';
						print ($show_post->post_text == '')? ' Uploaded a new photo': ' Said';	
						print '</h3>';
							print '<img src="'.$pstr_img_url.'" alt="" id="usersImage" href="'.$pstr_img_url.'" style="cursor:pointer" class="fancybox fancybox.image" />
						<div class="discussion-body">';
					if ($show_post->post_image == '') {	
					/* Means it is a text field */
				($restrict_post_count == 'true')? $this->controlTextShowMore($show_post->id, $show_post->post_text, 300): $show_post->post_text;
					} else if ($show_post->post_text == '') {
					/* Means it is a photo field */
					print '<img src="'.$this->url_root('pictures/'). $show_post->post_image.'" href="'.$this->url_root('pictures/'). $show_post->post_image.'" style="cursor:pointer" data-fancybox-group="gallery" class="fancybox fancybox.image margin" alt="..." width="230" />';
					}
						print '</div>
						<div class="discussion-footer">   
							<span style="color:#999">
							Likes ('.$ttl_liks_on_post.').
							Comments ('.$ttl_comments_on_post.').
							Views ('.$show_post->views.')</span>
							<a class="btn btn-xs bg-olive" id="'.$show_post->id.'" '.$xtraAttr.'><i class="fa fa-thumbs-up"></i> Like</a>
							<a href="comment?click='.$this->generateRandomString(30).'&back='.$this->saltifyID($show_post->id).'&ref='.$this->generateRandomString(30).'"
							class="btn btn-xs bg-blue click_ult" id="'.$show_post->id.'"><i class="fa fa-comment"></i> Comment</a>
							<a class="btn btn-xs bg-red" id="'.$show_post->id.'"><i class="fa fa-thumbs-down"></i> Report</a>';
								if ($web_users_relid === $show_post->poster_id) {
									print '&nbsp;<a class="btn btn-xs bg-maroon delete_my_post" id="'.$show_post->id.'" ><i class="fa fa-trash-o" ></i > Delete</a >';
								}
						print '</div>
					</div>
				</li>';
			}
			
	public function updateViewdPost($post_id) {
		require ('../../../../php.files/classes/pdoDB.php');
		$initialView = $this->getValue('views', 'staff_post', 'id', $post_id);
		$newView = $initialView + 1;
		$querySQL = "UPDATE staff_post SET views = '".$newView."' WHERE id = '".$post_id."'";
		$db_querySQL = $dbh->prepare($querySQL);
		$db_querySQL->execute();
		$db_querySQL = null;
	}
	
}
$discussions = new discussionz;

 ?>
 <script src="<?php print constant('quad_return') ?>myjs/discussion_response.js" type="text/javascript"></script>