<?php
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/staff_details.php');
require (constant('quad_return').'php.files/classes/staff.php');	
require ('discussion_delimeter_function.php');
	
	//unsaltifying the ID
	$passingID = $kas_framework->unsaltifyID(@$_GET['back']); 
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <title>Comment</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('quad_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('quad_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('quad_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- Bootsrap -->
        <link href="<?php print constant('quad_return') ?>fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.<?php print constant('quad_return') ?>js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue" style="min-height:auto">
	<!-- go top scroller --><div id="comment"></div>
        <!-- header logo: style can be found in header.less -->
		<?php require (constant('tripple_return').'inc.files/header.php') ?>
	<p style="margin-top:18px">&nbsp;</p>
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
<?php require (constant('tripple_return').'inc.files/sidebar.php') ?>
	<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1> <i class="fa fa-comments-o"></i> Comment<?php $staff->display_accessLevel(); ?> </h1>
				<ol class="breadcrumb">
					<li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
					<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-windows"></i>Social</a></li>
					<li class="click_ult"><a href="../discussions/#goBack<?php print $passingID; ?>"><i class="fa fa-comments"></i>Discussions</a></li>
					<li class="active"><i class="fa fa-comments-o"></i>&nbsp;&nbsp;Comment</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
			<?php $staff->checkBasicPlan(); ?>
				<!-- row -->
	<div class="row"> 
		<?php	if ($kas_framework->app_config_setting('staff_discussion') == false) {
			$kas_framework->showDangerCallout('<center> Sorry! Discussion has been Closed has been closed due to some reasons the Admin dim fit.');
			print '<center><img src="'.$kas_framework->url_root('img/restricted.png').'" width="60%"/>
					<img src="'.$kas_framework->url_root('img/sorry.png').'" width="50%"/></center>';
				} else { ?>
		<style type="text/css">
			#commentText { max-width: 500px; width: 75%; height: 50px; padding:5px; }
			#body_discuss { min-height: 100px; }
			.discussion2 { list-style:none; margin-left:-30px}
			#body_discuss2 { min-height: 60px; }
			@media only screen and (max-width:775px) and (min-width:671px) { #commentText { max-width: 400px; width: 85%; height: 60px; } }
			@media only screen and (max-width:670px) and (min-width:577px) { #commentText { max-width: 300px; width: 85%; height: 60px; } }
			@media only screen and (max-width:576px) and (min-width:300px) {
				#commentText { width: 90%; height: 60px;}
				#commentTextButton { margin-top:10px; } }
				@media only screen and (max-width:299px) {
				#commentText { width: 80%; height: 60px;}
				#commentTextButton { margin-top:10px; } }
				@media only screen and (max-width:308px) {
					.margin {float:none; width:98%;  margin:0 auto; display:block}
				}
	</style>
		<div class="col-md-9">	
			<?php //retrieveing the details of the post,
				$getAllPosts = "SELECT * FROM staff_post WHERE status = '1' AND id = '".$passingID."' LIMIT 1";
				$db_getAllPosts = $dbh->prepare($getAllPosts);
				$db_getAllPosts->execute();
				$get_getAllPosts_rows = $db_getAllPosts->rowCount();
				$show_post = $db_getAllPosts->fetch(PDO::FETCH_OBJ);
				$db_getAllPosts = null;
				
				$discussions->updateViewdPost($passingID); 
					if ($get_getAllPosts_rows == 0) {
							$kas_framework->showDangerCallout('You Just Committed an Offense that is Punishable. You Just tried Hijacking a URL. A report has been Sent for Scrutiny. This Page have been Freezed. <a href="'.$kas_framework->url_root('staff/dashpanel/').'">Visit the DashPanel</a> or <a href="'.$kas_framework->help_url('?topic=invalid-url-parameter').'" target="new">Explanation? <a>');
								print '<center><img src="'.$kas_framework->url_root('img/restricted.png').'" width="60%"/>
								<img src="'.$kas_framework->url_root('img/sorry.png').'" width="50%"/></center>';
																		
						require (constant('quad_return').'php.files/classes/PHPMailer/PHPMailerAutoload.php');
							require (constant('quad_return').'php.files/classes/mailing_list.php');
								$mailing_list->mailHackingReport($kas_framework->returnUserSchool(''), 'A hacking attempt was just made on the portal of the schools name which appear above.
								<br />Destination: Staff Portal. <br />Location: Discussion Comment. <br />User IP: '.$kas_framework->getUserIP().'<br />
								Staff Details: Username: '.$username.' &raquo; Fullname: '.$staff_firstname.' '.$staff_lastname.'<br />Please Respond.');
									exit();
						}
				?>
		<!---- here it all commets -->
	<ul class="discussion2">
		<?php
		/* getting the users image and the first name */
		$pstr_details = "SELECT * FROM staff WHERE staff_id = '".$show_post->poster_id."' LIMIT 1";
		$db_pstr_details = $dbh->prepare($pstr_details);
		$db_pstr_details->execute();
		$param_db_pstr_details_Obj = $db_pstr_details->fetch(PDO::FETCH_OBJ);
		$db_pstr_details = null;
		
		$pstr_name = $param_db_pstr_details_Obj->staff_fname. ' '.$param_db_pstr_details_Obj->staff_lname;
		
		$picxPstrlc = $param_db_pstr_details_Obj->staff_image;
		$picxPstrSex = $param_db_pstr_details_Obj->staff_sex;
		$pstr_img_url = $kas_framework->imageDynamic($picxPstrlc, $picxPstrSex, $kas_framework->url_root('pictures/'));
		
		/*getting the total comments and  total likes*/
		$ttl_comments_on_post = $kas_framework->countRestrict1('staff_post_reply', 'id', $show_post->id);

		$like_all_commas = $kas_framework->getValue('liker_id', 'staff_post', 'id', $show_post->id);
		$ttl_liks_on_post = substr_count($like_all_commas , ';');
		
		/* Checking if you have liked this */
		if (substr_count($like_all_commas, $web_users_relid. ';') != 0) {
			$xtraAttr = 'disabled';
		} else {
			$xtraAttr = '';
		}
		
		print ' <li>
				<div class="discussion2-item">
					<span class="time"><i class="fa fa-clock-o"></i> '.$show_post->post_date.'</span>
					<h3 class="discussion2-header"><b>'.$pstr_name.'</b>';
					print ($show_post->post_text == '')? ' Uploaded a new photo': ' Said';	
					print '</h3>
					<img src="'.$pstr_img_url.'" alt="..." id="usersImage" href="'.$pstr_img_url.'" style="cursor:pointer" class="fancybox fancybox.image" />
					<div class="discussion2-body" id="body_discuss">';
				if ($show_post->post_image == '') {	
				/* Means it is a text field */
					print $show_post->post_text;
				} else if ($show_post->post_text == '') {
				/* Means it is a photo field */
				print '<img src="'.$kas_framework->url_root('pictures/').$show_post->post_image.'" href="'.$kas_framework->url_root('pictures/').$show_post->post_image.'" style="cursor:pointer" class="fancybox fancybox.image margin" alt="..." width="230" />';
				}
					print '</div>
					<div class="discussion2-footer">
						<span style="color:#999">
						<i class="fa fa-thumbs-up"></i> ('.$ttl_liks_on_post.').
						<i class="fa fa-comment"></i>  (<span class="spanCounterUpdater">'.$ttl_comments_on_post.'</span>).
						<i class="fa fa-vimeo-square"></i> ('.$show_post->views.')</span>
						<a class="btn btn-xs bg-red" id="'.$show_post->id.'"><i class="fa fa-thumbs-down"></i> Report</a>
					</div>
				</div>
			</li>';
		
		?>
</ul>
			
<div style="border-bottom:1px solid #000; margin:20px 0 10px 8px; border-color:#ccc; width:70%;"> 
		Total Comments on this Post (<span class="spanCounterUpdater"><?php print $ttl_comments_on_post ?></span>)</div>
		
 <ul class="discussion2" id="commentDiv">
 <?php  
		$query = "SELECT * FROM staff_post_reply AS spr, staff AS s WHERE spr.post_rel_id = '".$passingID."' AND s.staff_id = spr.post_commenter_id ORDER BY spr.id";
		$db_query = $dbh->prepare($query);
		$db_query->execute();
		$get_query_rows = $db_query->rowCount();
		
			while ($view_comment = $db_query->fetch(PDO::FETCH_OBJ)) {
				$cmtrPicx = $view_comment->staff_image;
				$cmtrSex = $view_comment->staff_sex;
				$cmtrPixLoc = $kas_framework->imageDynamic($cmtrPicx, $cmtrSex, $kas_framework->url_root('pictures/'));
				
					print ' <li>
					<div class="discussion2-item">
						<img src="'.$cmtrPixLoc.'" href="'.$cmtrPixLoc.'" class="fancybox fancybox.image" alt="" style="float:left; width:40px; margin:8px 5px 5px 3px; cursor:pointer" />
						<div class="discussion2-body" id="body_discuss2">On '.$view_comment->post_comment_date.',  <b>'.$view_comment->staff_fname.' '.$view_comment->staff_lname. '</b> Said: <br />'.$view_comment->post_comment.'</div>
					</div>
				</li>';
			}
		$db_query = null;
		 ?>
		</ul>
		<span id="writeText">
			<div id="comment_loading" style="display:none"><?php $kas_framework->loading_h(); ?></div>
		
		<form action="" method="post" id="comment_form">
			<input type="text" placeholder="Please Comment on this" id="commentText" />
					<button class="btn btn-default btn-flat">Comment</button>
		</form>
		
			<p style="font-size:15px; margin:4px 0 5px 8px; width:190px"> 
			<a href="../discussions/#myDiscussion<?php print $passingID+1; ?>"><button class="btn btn-default btn-block click_ult" id="goback">
			<i class="fa fa-reply"></i> Go Back to Discussion </button></a></p>
		</span>	
	
	   </div>
	   <?php include ('discussion_SideBar.php') ?>
	   <?php } ?>
	</div><!-- ./wrapper -->
	
 </section><!-- /.content -->

		</aside><!-- /.right-side -->		
	<!-- jQuery 2.0.2 -->
	<script src="<?php print constant('quad_return') ?>myjs/jquery.min.js"></script>
	<!---- my javascript controller -->
	<script src="<?php print constant('quad_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
	<!-- Bootstrap -->
	<script src="<?php print constant('quad_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
	<!-- AdminLTE App -->
	<script src="<?php print constant('quad_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>
	<!-- FancyBox -->
	<script src="<?php print constant('quad_return') ?>fancybox/jquery.fancybox.js" type="text/javascript"></script>
	<script src="<?php print constant('quad_return') ?>fancybox/media_helper.js" type="text/javascript"></script>
	<!--------- my Script or Loaderz ------------>
	<script type="text/javascript">
		$('#loading').hide();
		
		/* processing the comment */
		$('#comment_form').submit(function(e){
			$(this).attr('disabled', 'disabled');
			$('#comment_loading').show();
			passing_idz = "<?php print $passingID ?>";
			totalCommentInitially = "<?php print $ttl_comments_on_post ?>";
			commentText = $('#commentText').val();
			byepass = "yFGU4F3dvVYFTVDFrvdSDFD";
			
			$.post('processCommentPost', {passing_idz:passing_idz, commentText:commentText, totalCommentInitially:totalCommentInitially, byepass:byepass}, function(data){
				$('#commentDiv').append(data);
				$('#comment_loading').hide();
				$('#commentText').val('');
				
			});
			
			return false;
		})	
	</script>
	<script src="<?php print constant('quad_return') ?>discussion_response.js" type="text/javascript"></script>	
	<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>