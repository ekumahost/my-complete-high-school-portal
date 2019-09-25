<?php
$dynamicimage = $kas_framework->imageDynamic($staff_image, $staff_sex, $kas_framework->server_root_dir('pictures/'));
		 $kas_framework->setCookie('hold_username_staff', $_SESSION['tapp_staff_username']);
		$kas_framework->setCookie('hold_image_staff', $dynamicimage);
?>