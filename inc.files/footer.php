<?php include ('inc.files/fixedfooter.php') ?>	
	<!----start-footer--->
		<div class="footer" style="border:1px solid #000; padding:5px; background-color:#FFF">
		<div style="font-size:14px; text-align:center">
	 &nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php print $kas_framework->help_url('') ?>" target="new"> &nbsp;Help</a>&nbsp; | <a href="#">Notice Board</a> |&nbsp;&nbsp;&nbsp;
		Powered by <?php print "kAsTech School Portal. Version V" .$kas_framework->getValue('school_app_version', 'tbl_config', 'id', '1')." 
				.Released On ".$kas_framework->getValue('portal_launch_date', 'tbl_config', 'id', '1'); ?>   </p>
			</div>
		</div>
		<!----//End-footer--->