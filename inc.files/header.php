
	<!---start-header---->
			<div class="header">
				<div class="wrap">
				<div class="logo">
					<a href="<?php print $kas_framework->url_root('') ?>"><?php $kas_framework->displaySchoolLogo('60', 'square', '-10px 0'); ?> </a>
				</div>
				<div class="nav-icon">
					 <a href="#" class="right_bt" id="activator"><span> </span> </a>
				</div>
				 <div class="box" id="box">
					 <div class="box_content">        					                         
						<div class="box_content_center">
						 	<div class="form_content">
								<div class="menu_box_list">
									<ul>
									
										<li><a href="home"><span>Home</span></a></li>
										<li><a href="contact"><span>Contact</span></a></li>
										<li><a href="student/"><span>Students</span></a></li>
										<li><a href="parent/"><span>Parents</span></a></li>
										<li><a href="staff/"><span>Staff</span></a></li>
										<div class="clear"> </div>
									</ul>
								</div>
								<a class="boxclose" id="boxclose"> <span> </span></a>
							</div>                                  
						</div> 	
					</div> 
				</div>				
				 <div class="top-searchbar">
					<center><div id="header" style="color:#FFF"><?php $kas_framework->displayUserSchool($userschool=0) ?></div></center>
				 </div>
				<div class="userinfo">
					<div class="user">
						<ul>
							<li><a href="#"><img src="img/tn_logo.png" style="margin:-10px 0" width="60px" title="HyperTera" />
							<span style="color:#fff"><?php print $kas_framework->getValue('school_app_framework', 'tbl_config', 'id', '1'); ?></span></a></li>
						</ul> 
					</div>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
		<!---//End-header---->
		<style type="text/css">
		
		@media only screen and (max-width:474px) {
			#header { font-variant:small-caps; font-size:16px; color:#FFF; text-align:center; }
		}
		
		@media only screen and (min-width:475px) and (max-width:799px) {
			#header { font-variant:small-caps; font-size:23px; color:#FFF; text-align:center }
		}
		
		@media only screen and (min-width:800px) and (max-width:922px) {
			#header { font-variant:small-caps; font-size:26px; color:#FFF; text-align:center }
		}
		
		@media only screen and (min-width:923px) {
			#header { font-variant:small-caps; font-size:30px; color:#FFF; text-align:center }
		}
		</style>