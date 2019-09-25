<?php
require ('php.files/classes/kas-framework.php');
require ('php.files/tbl_app_config_home.php')
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?php print $kas_framework->returnUserSchool('') ?> | Contact</title>
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <!---- page description -->
        <meta content="<?php print $kas_framework->getValue('adress', 'tbl_school_profile', 'id', '1'); ?>
        <?php $state_code = $kas_framework->getValue('state', 'tbl_school_profile', 'id', '1');
        print $kas_framework->getValue('state_name', 'tbl_states', 'state_css', $state_code);
        ?>, <?php print $kas_framework->getValue('country', 'tbl_school_profile', 'id', '1'); ?>.
        Contact Number: <?php print $kas_framework->getValue('phone', 'tbl_school_profile', 'id', '1'); ?>" name="description">
        <meta content="School Portal, Login, Best School Portal" name="keywords">
        <meta content="HyperTera" name="author">
        <!---- page description ends --->
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
		<script type="application/x-javascript">
			addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
		</script>
		<!-- Global CSS for the page and tiles -->
  		<link rel="stylesheet" href="css/main.css">
  		<link rel="stylesheet" href="css/custom_callout.css">
  		
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
					$('#box').animate({'top':'-700px'},500);
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
body {background: url(img/user_bg.jpg) repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;}
</style>
	<body>
		<!---start-wrap---->
		<?php include ('inc.files/header.php'); ?>
		<!---start-content---->
		<div class="content">
			<div class="wrap"><br>
			 <div id="main" role="main" >
			 
			 <!--- from http://www.map-embed.com/
			 <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div style="overflow:hidden;height:500px;width:900px;"><div id="gmap_canvas" style="height:500px;width:900px;"></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style><a class="google-map-code" href="https://www.google.com/maps/dir/University+of+Nigeria+Nsukka,+Nsukka,+Nigeria/6.9020543,7.3438179/@6.867714,7.374202,13z/data=!4m8!4m7!1m5!1m1!1s0x1044e7defeff9725:0xffb8a28c30660e7d!2m2!1d7.408535!2d6.86763!1m0?hl=en-US" id="get-map-data"></a></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:14,center:new google.maps.LatLng(6.868281899999999,7.4095674000000145),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(6.868281899999999, 7.4095674000000145)});infowindow = new google.maps.InfoWindow({content:"<b>University of Nigeria</b><br/>University of Nigera<br/> nsukka" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
			  -->
			 <div class="contact-info">
					
					 <div class="contact-grids">
							 <div class="col_1_of_bottom span_1_of_first1">
								    <h5>Address</h5>
								    <ul class="list3">
										<li>
											<img src="img/home.png" alt="">
											<div class="extra-wrap">
											 <p><?php print $kas_framework->getValue('adress', 'tbl_school_profile', 'id', '1'); ?><br />
											 <?php $state_code = $kas_framework->getValue('state', 'tbl_school_profile', 'id', '1'); 
													print $kas_framework->getValue('state_name', 'tbl_states', 'state_css', $state_code);
											 ?>,
											 <?php print $kas_framework->getValue('country', 'tbl_school_profile', 'id', '1'); ?></p>
											</div>
										</li>
									</ul>
							    </div>
								<div class="col_1_of_bottom span_1_of_first1">
								    <h5>Phones</h5>
									<ul class="list3">
										<li>
											   <img src="img/phone.png" alt="">
											<div class="extra-wrap">
												<p><span>Telephone: </span><?php print $kas_framework->getValue('phone', 'tbl_school_profile', 'id', '1'); ?></p>
											</div>
												<img src="img/fax.png" alt="">
											<div class="extra-wrap">
												<p><span>Fax: </span><?php print $kas_framework->getValue('fax', 'tbl_school_profile', 'id', '1'); ?></p>
											</div>
											   <img src="img/phone.png" alt="">
											<div class="extra-wrap">
												<p><span>Telephone: </span><?php print $kas_framework->getValue('mobile', 'tbl_school_profile', 'id', '1'); ?></p>
											</div>
										</li>
									</ul>
								</div>
								<div class="col_1_of_bottom span_1_of_first1">
									 <h5>Email</h5>
								    <ul class="list3">
										<li>
											<img src="img/email.png" alt="">
											<div class="extra-wrap">
											  <p><span class="mail"><a href="mailto:yoursite.com"><?php print $kas_framework->getValue('email', 'tbl_school_profile', 'id', '1'); ?></a></span></p>
											</div>
										</li>
									</ul>
							    </div>
								<div class="clear"></div>
							 </div>
							 	<form method="post" action="#" id="portal_mail_form">
							          <div class="contact-form">
										<div class="contact-to">
										 	<input type="email" required="required" name="email" class="text" placeholder="Email...">
					                     	<input type="text" required="required" name="name" class="text" placeholder="Name...">
										 	<input type="text" required="required" name="subject" class="text" placeholder="Subject...">
										 	<input type="hidden" name="byepass" class="text" value="uvbfty23s656768798778">
										</div>
										<div class="text2">
						                   <textarea name="message" required="required" value="Message:" placeholder="Message.."></textarea>
						                </div>
						             
										  <div id="submit_button_span">
											<input type="submit" class="" id="submit_button" value="Submit">
											<span id="mail_message" style="margin:-30px 0 0 120px; position:absolute"></span>
										     
										  </div>
										  
										
						                <div class="clear"></div>
						               </div>
						           </form>
								</div>
					<br /><br /><br /><br /><br />
				</div>
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
		            itemWidth:280 // Optional, the width of a grid item
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
		      function onScroll() {
		        // Check if we're within 100 pixels of the bottom edge of the broser window.
		        var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
		            closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 100);
		
		        if (closeToBottom) {
		          // Get the first then items from the grid, clone them, and add them to the bottom of the grid
		          var $items = $('li', $tiles),
		              $firstTen = $items.slice(0, 10);
		          $tiles.append($firstTen.clone());
		
		          applyLayout();
		        }
		      };
		
		      // Call the layout function for the first time
		      applyLayout();
		
		      // Capture scroll event.
		      $window.bind('scroll.wookmark', onScroll);
		    })(jQuery);
			
			$('#portal_mail_form').submit(function(e){
				$('#submit_button').attr('disabled', 'disabled');
				$('#mail_message').html('Sending... Please Wait... ');
				
				mail_values = $('#portal_mail_form :input').serializeArray();
					$.post('php.files/send_portalmail', mail_values, function(data) {
						$('#mail_message').html(data);
				});
				
				return false;
			})
			
		  </script>
		<!----//wookmark-scripts---->
		<!----start-footer--->
		<?php include ('inc.files/footer.php'); ?>
		<!----//End-footer--->
		<!---//End-wrap---->
	</body>
</html>

