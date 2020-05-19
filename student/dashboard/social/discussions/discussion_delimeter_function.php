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
	
	function viewDescretedWhilePosts($show_post, $restrict_post_count, $student_id_original) {
	  /* getting the users image */
	  require ('../../../../php.files/classes/pdoDB.php');
		$picxPstrlc = $this->getValue('studentbio_pictures', 'studentbio', 'studentbio_id', $show_post->poster_id);
		$picxPstrSex = $this->getValue('studentbio_gender', 'studentbio', 'studentbio_id', $show_post->poster_id);
		$pstr_img_url = $this->imageDynamic($picxPstrlc, $picxPstrSex, $this->url_root('pictures/'));
		
		/* getting the users details */
		$pstr_details = "SELECT * FROM studentbio WHERE studentbio_id = '".$show_post->poster_id."' LIMIT 1";
		$db_handle = $dbh->prepare($pstr_details);
			$db_handle->execute();
			$get_rows = $db_handle->rowCount();
			$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
			$db_handle = null;

		$pstr_name = $paramGetFields->studentbio_fname. ' '.$paramGetFields->studentbio_lname;
		
		/*getting the total comments and  total likes*/
		$ttl_comments_on_post = $this->countRestrict1('student_post_reply', 'post_rel_id', $show_post->id);
		$like_all_commas = $this->getValue('liker_id', 'student_post', 'id', $show_post->id);
		$ttl_liks_on_post = substr_count($like_all_commas , ';');
		
		/* Checking if you have liked this */
		if (substr_count($like_all_commas, $student_id_original. ';') != 0) {
			$xtraAttr = 'disabled';
		} else {
			$xtraAttr = '';
		}

       // print $student_id_original .' and appending the posters id '.$show_post->poster_id;
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

                        if ($student_id_original === $show_post->poster_id) {
                            print '&nbsp;<a class="btn btn-xs bg-maroon delete_my_post" id="'.$show_post->id.'" ><i class="fa fa-trash-o" ></i > Delete</a >';
                        }
						print '</div>
					</div>
				</li>';
			}
			
	public function updateViewdPost($post_id) {
		$initialView = $this->getValue('views', 'student_post', 'id', $post_id);
		$newView = $initialView + 1;
		 require ('../../../../php.files/classes/pdoDB.php');
		$querySQL = "UPDATE student_post SET views = '".$newView."' WHERE id = '".$post_id."' LIMIT 1";
			$db_querySQL = $dbh->prepare($querySQL);
			$db_querySQL->execute();
			$db_querySQL = null;
	}
	
}
$discussions = new discussionz;

 ?>
 <script src="<?php print constant('quad_return') ?>myjs/discussion_response.js" type="text/javascript"></script>