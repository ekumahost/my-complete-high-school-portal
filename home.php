<?php
require ('php.files/classes/pdoDB.php');
require ('php.files/classes/kas-framework.php');
require ('php.files/tbl_app_config_home.php')
?>
<!DOCTYPE HTML>
<html>
	<head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/56dffee21c8d37ab30354974/default';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
</script>
<!--End of Tawk.to Script-->
		<title><?php print $kas_framework->returnUserSchool('') ?> | Home</title>
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <!---- page description -->
        <meta content="<?php print $kas_framework->getValue('messageto_all', 'tbl_config', 'id', '1') ?>. Get access to Registration, Check in, Services and Applications. Powered by Hypertera" name="description">
        <meta content="School Portal, Login, Best School Portal" name="keywords">
        <meta content="HyperTera" name="author">
        <!---- page description ends --->
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
		<script type="application/x-javascript"> 
			addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
		</script>
	
		<!----//webfonts---->
		<!-- Global CSS for the page and tiles -->
  		<link rel="stylesheet" href="css/main.css">
  		<!-- //Global CSS for the page and tiles -->
		<!---start-click-drop-down-menu----->
		<script src="js/jquery.min.js"></script>
        <!----start-dropdown--->
         <script type="text/javascript">
			var $ = jQuery.noConflict();
				$(function() {
					$('#activator').click(function(){
						$('#box').animate({'top':'0px'},500);
					});
					$('#boxclose').click(function(){
					$('#box').animate({'top':'-700px'},1000);
					});
				});
				$(document).ready(function(){
				//Hide (Collapse) the toggle containers on load
				$(".toggle_container").hide(); 
				//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
				$(".trigger").click(function(){
					$(this).toggleClass("active").next().slideToggle("slow");
						return false; //Prevent the browser jump to the link anchor
				});
									
			});
		</script>
        <!----//End-dropdown--->
		<!---//End-click-drop-down-menu----->
	</head>
	<style type="text/css">
	  body {
	  background: url(img/user_bg.jpg) repeat center center fixed;
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;
	  }
	</style>
	<body>
		<div style="margin:0 auto; width:auto; position:relative">
		<!---start-wrap---->
		<?php include ('inc.files/header.php'); ?>
		<!---start-content---->
		<div class="content">
			<div class="wrap"><br>
			 <div id="main" role="main">
			 
			<div class="contact-info" style="margin:-13px auto 20px auto; padding:20px; width:90%; font-size:18px; font-variant:small-caps; font-weight:800">
				<center> <?php print $kas_framework->getValue('messageto_all', 'tbl_config', 'id', '1') ?> </center>		 
			
				<noscript>
					<?php $kas_framework->showDangerCallout('<center> <b>Javascript</b> is not enabled on this browser. Please enable Javascript. <a href="'.$kas_framework->help_url('?topic=jquery-not-detected').'" target="_blank">Explanation?</a></center>'); ?>
				</noscript>
		</div>
			
			<ul id="tiles" style="text-align:center">
			  
				   <!-- These are our grid blocks -->
				  <li>
			        	<img src="img/registration.jpg" width="282" height="118">
			        	<div class="post-info">
			        		<div class="post-basic-info">
				        		<h3>Registration</h3>
								<?php  print general_link_control('student_registration', 'Students', 'student/register/') ?><br>
								<?php  print general_link_control('parent_registration', 'Parents', 'parent/register/') ?><br>
								<?php  print general_link_control('staff_registration', 'Staff', 'staff/register/') ?><br>
							
							<p>General Registration. Select the Right Choice.</p>
			        		</div>
			        	</div>
			        </li>
			    
					
					<li>
			        	<img src="img/login.jpg" width="282" height="120">
			        	<div class="post-info">
			        		<div class="post-basic-info">
				        		<h3>Check In</h3>
								<?php  print general_link_control('student_login', 'Students', 'student/') ?><br>
								<?php  print general_link_control('parent_login', 'Parents', 'parent/') ?><br>
								<?php  print general_link_control('staff_login', 'Staff', 'staff/') ?><br>
								<p>Log In into your Various Portal Panel.  </p>
			        		</div>
			        	</div>
			        </li>
					
					
				<li onClick="location.href='#';">
			        	<img src="img/service.jpg" width="282" height="118">
			        	<div class="post-info">
			        		<div class="post-basic-info">
				        		<h3>Services</h3>
								<span><a href="http://library.hypertera.tk/" target="_blank"><label> </label><strong>e -Library</strong></a></span><br>
								<span><a href="http://exam.hypertera.tk/" target="_blank"><label> </label>Online CBT</a></span><br>
								<span><a href="http://chat.hypertera.tk/" target="_blank"><label> </label><strong>Open Chat</strong></a></span>

				        		<p>Welcome to Service Area. Please select your Service</p>
			        		</div>
			        	</div>
			        </li>
					
					
					<li>
			        	<img src="img/application.jpg" width="282" height="118">
			        	<div class="post-info">
			        		<div class="post-basic-info">
				        		<h3>Applications</h3><?php print admission_badge() ?><br>
							    <span><a href="#"><label> </label>Job Application</a></span><font color="red" style="font-size:12px"> (Closed)</font><br>
								<span><a href="#"><label> </label>Expertise Service</a></span><font color="red" style="font-size:12px"> (Closed)</font><br>

				        		<p>Application for the Current Session.</p>
			        		</div>
			        	
			        	</div>
			        </li>
					
			      
			      </ul>				
			    </div>
				<br /><br /><br /><br /><br />
			</div>
		</div>
		<!---//End-content---->
		<!----wookmark-scripts---->
		  <script src="js/jquery.imagesloaded.js"></script>
		  <script src="js/jquery.wookmark.js"></script>
		  <script type="text/javascript">
		    (function ($){
		      var $tiles = $('#tiles'),
		          $handler = $('li', $tiles),
		          $main = $('#main'),
		          $window = $(window),
		          $document = $(document),
		          options = {
		            autoResize: true, // This will auto-update the layout when the browser window is resized.
		            container: $main, // Optional, used for some extra CSS styling
		            offset: 20, // Optional, the distance between grid items
		            itemWidth: 276 // Optional, the width of a grid item
		          };
		      /**
		       * Reinitializes the wookmark handler after all images have loaded
		       */
		      function applyLayout() {
		        $tiles.imagesLoaded(function() {
		          // Destroy the old handler
		          if ($handler.wookmarkInstance) {
		            $handler.wookmarkInstance.clear();
		          }
		
		          // Create a new layout handler.
		          $handler = $('li', $tiles);
		          $handler.wookmark(options);
		        });
		      }
		      /**
		       * When scrolled all the way to the bottom, add more tiles
		       */
		 
		
		      // Call the layout function for the first time
		      applyLayout();
		
		      // Capture scroll event.
		      $window.bind('scroll.wookmark', onScroll);
		    })(jQuery);
		  </script>
		<!----//wookmark-scripts---->
		<br><br><br><br>
	<?php include ('inc.files/footer.php'); ?>
		<!---//End-wrap---->
	  </div>
	</body>
</html>
