<?php 
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();

require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/staff_details.php');
require (constant('quad_return').'php.files/classes/staff.php');	
require ('discussion_delimeter_function.php');
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <title>Discussions</title>
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
				<h1> <i class="fa fa-comments"></i> Discussion <?php $staff->display_accessLevel(); ?> </h1>
				<ol class="breadcrumb">
					<li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
					<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-windows"></i>Social</a></li>
					<li class="active"><i class="fa fa-comments"></i>&nbsp;&nbsp;Discussions</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
			<?php $staff->checkBasicPlan(); ?> 
				<!-- row -->
				<div class="row"> 
				<?php	if ($kas_framework->app_config_setting('staff_discussion') == false) {
			$kas_framework->showDangerCallout('<center> Sorry! Discussion has been Closed has been closed due to some reasons the Admin dim fit. </center>'); 
					print '<center><img src="'.$kas_framework->url_root('img/restricted.png').'" width="60%"/>
					<img src="'.$kas_framework->url_root('img/sorry.png').'" width="50%"/></center>';
				} else { ?>
					<style type="text/css">
					#postText { max-width: 500px; width: 75%; height: auto; padding:5px; }
					.discussion-body { min-height: 100px; }
					@media only screen and (max-width:775px) and (min-width:671px) { #postText { max-width: 400px; width: 75%; height: 60px; } }
					@media only screen and (max-width:670px) and (min-width:577px) { #postText { max-width: 300px; width: 75%; height: 60px; } }
					@media only screen and (max-width:576px) and (min-width:300px) {
						#postText { width: 80%; height: 60px;}
						#postTextButton { margin-top:10px; } }
						@media only screen and (max-width:299px) {
						#postText { width: 70%; height: 60px;}
						#postTextButton { margin-top:10px; } }
						@media only screen and (max-width:308px) {
							.margin {float:none; width:98%;  margin:0 auto; display:block}
						}
					</style>

		<div class="col-md-9">
				<!-- posting -->
				<div id="nothing"></div>
<!------- all the posts both image and text ---><span id="allPostHolder">
	
		<?php $dynamicimage = $kas_framework->imageDynamic($staff_image, $staff_sex, $kas_framework->url_root('pictures/'));
					print '<img src="'.$dynamicimage.'" href="'.$dynamicimage.'" style="cursor:pointer" class="fancybox fancybox.image" height="50px" alt="..." />';  ?>
				
				<span id="writeText">
				<textarea placeholder="Whats On Your Mind?" id="postText"></textarea>
						<button class="btn btn-default btn-flat" id="postTextButton">Post</button>
						<button class="btn btn-default btn-sm" id="swapToPicx">Upload Picture</button> </span>
				
				<div id="writePhoto" style="display:none">
						<form action="uploadDiscussionImage" id="form_ID" method="post" style="margin:-60px 0 0 70px" enctype="multipart/form-data">
								<div class="btn btn-success btn-file">
                                    <i class="fa fa-camera"></i> Picture
                                   <input type="file" name="imageToBeUploaded" class="ult_attach_file" id="imageToBeUploaded" />
                                </div> <span class="ult_attach_span"> </span>
                          <input type="hidden" name="byepass" value="bg5s7v23dYTDV35dbt">
							<button class="btn btn-default btn-flat" type="submit" name="uploadimg" id="upload_button">Upload</button>
							<button class="btn btn-default btn-sm" id="swapToText">Write a Text</button>
						</form></div>
					
				<div id="loading_div" style="display:none"><?php $kas_framework->loading_h('center'); ?></div>	
				<div id="message_div" style="margin:6px 20px 0 80px"></div>	
				
				<center><div><a href="../discussions/" class="btn btn-default btn-sm" id="reloadPage" style="margin-top:6px"><i class="fa fa-spinner"></i> reload this page and get newer posts?</a></div></center>
				
				<ul class="discussion">
					<!-- discussion item all retrieved-->	
		<?php 
				$total_shit = $kas_framework->countAll('staff_post');
				//gotten from the previous clicks of the load more......
				$queryLoader = (@$_SESSION['loadDiscussionData'] + 1) * 20;
				
				$loadRawQuery = "SELECT * FROM staff_post WHERE status = '1' ORDER BY id DESC LIMIT 0, ".$queryLoader."";
				$db_loadRawQuery = $dbh->prepare($loadRawQuery);
				$db_loadRawQuery->execute();
				$get_loadRawQuery_rows = $db_loadRawQuery->rowCount();
								
				if ($get_loadRawQuery_rows == 0) { print '<br /><br />'; $kas_framework->showDangerCallout('Nobody Has Said Anything Here. Be the First'); }
					while ($show_post = $db_loadRawQuery->fetch(PDO::FETCH_OBJ)) {
							$discussions->viewDescretedWhilePosts($show_post, 'true', $web_users_relid);
					}
				$db_loadRawQuery = null;
				?>	
				</ul>
			 <!-- END timeline item -->
			 		<div id="loading" style="display:none"><?php $kas_framework->loading('center'); ?></div>
	<div style="width:60%; margin:0 auto; display:none" id="loadMoreButtonDiv">
			<button class="btn btn-default btn-block btn-flat" id="loadMoreButton">
			<i class="fa fa-spinner"></i> Load More Discussions</button></div>
			</div><!-- /.col -->
		<?php include ('discussion_SideBar.php') ?>
		<?php } ?>
			</div><!-- /.row -->

<!------- the Load more and the buttons controlling them ---->
	</span> <!------- all the posts both image and text --->
	</section><!-- /.content -->
		</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->

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
	
	function refreshPageSender() {
		$.post('refreshDiscussion', {load:load, byepass:byepass}, function(data) {
			$('.discussion').html(data);
			$('#message_div').hide();
			$('#form_ID').get(0).reset();
		});
	}
	
	load = <?php print $_SESSION['loadDiscussionData']; ?>;
	Alltotal = "<?php print $total_shit; ?>";
	//alert(Alltotal);
	if (Alltotal > 20) { $('#loadMoreButtonDiv').show(); }
	
	$('#loadMoreButton').click(function(e) {
		/* if the end of the scroll is reached */
		$('#loading').show();
		load++;
		
		if (load * 20 > Alltotal) {
			$('#loading').hide();
			$('#loadMoreButtonDiv').html('<center>No More Discussions To Load!!!</center>').show();
		} else {
			/* proceed to run the query and retrieve more */
			byepass = 'hghjT5Ytrb7u66tv9oTXE';
			$.post('loadOtherDiscussions', {load:load, byepass:byepass}, function(data) {
				$('.discussion').append(data);
				$('#loading').hide();
			});	
		}
	})/* the click function */
			
	/* Swapping the test field and the passport field */	
	$('#swapToPicx').click(function(e){
		$('#writeText').hide();
		$('#writePhoto').show();
		return false;
	})
	
	$('#swapToText').click(function(e) {
		$('#writePhoto').hide();
		$('#writeText').show();
		return false;
	})
	/* Swapping the test field and the passport field */
	
	setInterval(function(e) {
		byepass = 'ungUYRB54e65NFNU6Y7EG2se';
			refreshPageSender(); /* refresh the page */
		}, 60000); /* setting the refresh rate to 60 seconds */

	
	$('#postTextButton').click(function(){
		$('#loading_div').show();
		text_field = $('#postText').val(); byepass = "gbyTERTVD76543TYGFVTV";
		$.post('processTextPost', {text_field:text_field, byepass:byepass}, function(data) {
			$('.discussion').prepend(data);
			$('#loading_div').hide();
			$('#postText').val('');
			refreshPageSender(); /* refresh the page */
			/* incrementing the all total so that the ones posted will not be retrieved again */
			Alltotal++;
		});
	})
	
</script>	
	<script src="<?php print constant('quad_return') ?>myjs/discussion_response.js" type="text/javascript"></script>
	<script src="<?php print constant('quad_return') ?>myjs/keliv_discussion_picture_upload.js"></script>
	<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>