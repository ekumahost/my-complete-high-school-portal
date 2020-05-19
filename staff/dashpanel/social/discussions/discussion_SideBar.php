	<?php 
	
		$post_count = $kas_framework->countRestrict1('staff_post', 'poster_id', $web_users_relid);
		$comment_count = $kas_framework->countRestrict1('staff_post_reply', 'post_commenter_id', $web_users_relid);
		
		$likes_count = "SELECT liker_id FROM staff_post";
			$db_handle_like = $dbh->prepare($querySQL);
			$db_handle_like->execute();
			$likes_count_count = 0;
				while ($stream_like = $db_handle_like->fetch(PDO::FETCH_OBJ)) {
					//$likes_count_count = $likes_count_count + substr_count($stream_like->liker_id, $web_users_relid. ';');
				}
			$db_handle_like = null;
		
	//(substr_count($like_all_commas, $web_users_relid. ';')
	 ?>
	<div class="col-md-3 no-print fling">
				<div class="box box-primary border_bttn">
					<div class="box-header">
						<h4 class="box-title">Side Panel</h4>
					</div>
					<?php  
					$kas_framework->getMessageforUser('staff'); ?>
			<p style="font-size:15px; margin:7px 0 5px 8px; width:80%"> 
				<a href="#"><button class="btn btn-default btn-block">
				<i class="fa fa-comment"></i> School Forum? </button></a></p>
				
				<?php if (isset($_GET['back'])) { ?>
					<p style="font-size:15px; margin:4px 0 5px 8px; width:80%"> 
				<a href="../discussions/#myDiscussion<?php print $passingID+1; ?>"><button class="btn btn-default btn-block click_ult" id="goback">
				<i class="fa fa-reply"></i> To Discussion </button></a></p>
				<?php }
				?>
					<br /><p style="padding:8px"> Your Total Contribution to the Discussion at Large: <br />
					<i class="fa fa-thumbs-up"></i> Likes: <?php print $likes_count_count; ?> <br />
					<i class="fa fa-comment"></i> Comments: <?php print $comment_count; ?> <br />
					<i class="fa fa-comments"></i> Posts: <?php print $post_count; ?> <br />
					</p>
					
				<br /><p style="padding:8px"> Add On: Proudly Designed by kAsTech. </p>
				<?php 
					   $getImgQuery = "SELECT * FROM staff WHERE staff_image != '' ORDER BY RAND()";
					   $db_getImgQuery = $dbh->prepare($getImgQuery);
						$db_getImgQuery->execute();
						$get_getImgQuery_rows = $db_getImgQuery->rowCount();
						$paramObj = $db_getImgQuery->fetch(PDO::FETCH_OBJ);
						$db_getImgQuery = null;
			
							if ($get_getImgQuery_rows == 0) {
								$randImgLoc = $kas_framework->url_root('img/user_bg.jpg');
							} else {
								$usrImg = $paramObj->staff_image;
								$usrSex = $paramObj->staff_sex;
								$randImgLoc = $kas_framework->imageDynamic($usrImg, $usrSex, $kas_framework->url_root('pictures/'));
							}
							print '<center><img src="'.$randImgLoc.'" href="'.$randImgLoc.'" class="fancybox fancybox.image" style="width:150px; margin:0 auto; border:1px solid #333;cursor:pointer" /></center>';
							
				?>
			<br />	
					
		 </div><!-- /. box -->
	  </div><!-- /.col -->
	</div><!-- /.col -->