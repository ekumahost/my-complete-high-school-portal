<?php
$dynamicimage = $kas_framework->imageDynamic($staff_image, $staff_sex, $kas_framework->url_root('pictures/'));
		 $kas_framework->setCookie('hold_username_staff', $_SESSION['tapp_staff_username']);
		$kas_framework->setCookie('hold_image_staff', $dynamicimage);
?>