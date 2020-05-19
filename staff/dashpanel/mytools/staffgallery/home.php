<?php 
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();

require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/staff_details.php');
require (constant('quad_return').'php.files/classes/staff.php');
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <title>Staff Gallery</title>
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
		<style type="text/css">
			.margin { opacity: 0.6; border:4px double #000; width:20%; margin:9px;}
			.margin:hover { opacity: 1; }
			@media only screen and (max-width: 787px) and (min-width: 657px) { 	.margin { margin:7px; } }
			@media only screen and (max-width: 656px) and (min-width: 588px) { 	.margin { margin:6px; } }
			@media only screen and (max-width: 587px) and (min-width: 530px) { 	.margin { margin:6px; width:30%; } }
			@media only screen and (max-width: 529px) and (min-width: 488px) { 	.margin { margin:5px; width:30%; } }
			@media only screen and (max-width: 487px) and (min-width: 367px) { .margin { margin:6px; width:45%; } }
			@media only screen and (max-width: 366px) { .margin { margin:6px; width:95%; } }
		</style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -- and (min-width: 554px) -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.<?php print constant('quad_return') ?>js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
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
                    <h1><i class="fa fa-picture-o text-navy"></i> Staff Gallery <?php $staff->display_accessLevel(); ?></h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
						<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-th-large"></i>My Tools</a></li>
						<li class="active"><i class="fa fa-picture-o"></i>&nbsp;&nbsp;Gallery</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<?php $staff->checkBasicPlan(); //$student->authConfirm($useradmitStatus); ?>
						<!-- row -->
						<div class="row"> 

							<div class="col-md-12">
								<!-- The time line -->
								<ul class="discussion">
								<!-- discussion item -->
							<li>
							<div class="discussion-item">
								<span class="time"><i class="fa fa-clock-o"></i> Updated <?php print rand(1, 20) ?> hours ago</span>
								<h3 class="discussion-header">Staff Pictures &raquo;
								<?php print $staff->countStaffwithPics($staff_school). ' in Total' ?></h3>

				<!--------------------this is just a demancation ----->
				<div class="discussion-body">
					<?php
					/*checkin and makiny sure that the users full name is already completed in the profile*/
					if ($staff_firstname == '' or $staff_lastname == '') {
					print '<br />';
						$kas_framework->showalertwarningwithPaleYellow('Please Complete your profile before you can view this Gallery.
						Your Fistname and lastname which is Important to this Gallery is Missing. Your Picture will not appear in the Gallery
						<br />
						 <a href="'.$kas_framework->url_root('secure/profile/editprofile').'">Complete your Profile</a> OR
						 <a href="'.$kas_framework->help_url('?topic=incomplete-profile').'" target="blank">Explanation?</a>');
					} else {
						/*Proceed ang get the images of everybody*/
						
						$allgalleryPicx = "SELECT * FROM staff WHERE staff_school = '".$staff_school."' AND staff_image != ''";
						$db_allgalleryPicx = $dbh->prepare($allgalleryPicx);
						$db_allgalleryPicx->execute();
						$total_gallery_shit = $db_allgalleryPicx->rowCount();
						$db_allgalleryPicx = null;
					
						$runGalleryPicx = $allgalleryPicx;
						$runGalleryPicx .= " LIMIT 0, 20";
						$db_runGalleryPicx = $dbh->prepare($runGalleryPicx);
						$db_runGalleryPicx->execute();

							for ($i=0; $i<=30; $i++) {
								while ($showPicx = $db_runGalleryPicx->fetch(PDO::FETCH_OBJ)) {
									print '<img src="'.$kas_framework->url_root('pictures/').$showPicx->staff_image.'" 
									alt="'.$showPicx->staff_fname .' '. $showPicx->staff_lname.'" 
									title="'.$showPicx->staff_lname .' '. $showPicx->staff_fname.'"
									href="'.$kas_framework->url_root('pictures/').$showPicx->staff_image.'" data-fancybox-group="gallery" style="cursor:pointer" class="fancybox fancybox.image margin" />';
								}
							}
							$db_runGalleryPicx = null;
						}
					?>
					</div>
				<div id="loading" style="display:none"><?php $kas_framework->loading_h('center'); ?></div>
			</div>
		</li>
		<div style="width:60%; margin:0 auto; display:none" id="loadMoreButtonDiv">
			<button class="btn btn-default btn-block btn-flat" id="loadMoreButton"><i class="fa fa-spinner"></i>Load More Pictutes</button></div>
							<!-- END timeline item -->
                            </ul>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
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
		<!--- The Infinite Scroll -->
		<script type="text/javascript">				
			$(document).ready(function() {
				var load = 0;
				var Alltotal = "<?php print $total_gallery_shit ?>";
				
				if (Alltotal > 20) {
					$('#loadMoreButtonDiv').show();
				}
				
					$('#loadMoreButton').click(function(e) {
						//if the end of the scroll is reached
						$('#loading').show();
						load++;
						
						if (load * 20 > Alltotal) {
							$('#loading').hide();
							$('#loadMoreButtonDiv').hide();
						} else {
							//proceed to run the query and retrieve more
							byepass = 'hghjT5Ytrb7u66tv9oTXE';
							$.post('loadClassPhotos', {load:load, byepass:byepass}, function(data) {
								$('.discussion-body').append(data);
								$('#loading').hide();
							});	
						}
					});
			});
	</script>
		<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>