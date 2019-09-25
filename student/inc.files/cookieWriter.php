<?php
$dynamicimage = $student->imageDynamic($userpicturepath, $usergender, $kas_framework->server_root_dir('pictures/'));
		 $kas_framework->setCookie('hold_username', $_SESSION['tapp_std_username']);
		$kas_framework->setCookie('hold_image', $dynamicimage);
?>