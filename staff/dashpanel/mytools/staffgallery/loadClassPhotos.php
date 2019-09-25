<?php 
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('quad_return').'php.files/staff_details.php');

extract($_POST);
//making sure tat the file was not accessed by the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed');
}
$startLimit = $load * 20;

	$galleryPicx = "SELECT * FROM staff WHERE staff_school = '".$staff_school."' AND staff_image != '' LIMIT ".$startLimit.", 20";
		$db_galleryPicx = $dbh->prepare($galleryPicx);
		$db_galleryPicx->execute();
		$get_galleryPicx_rows = $db_galleryPicx->rowCount();
	
			while ($showPicx = $db_galleryPicx->fetch(PDO::FETCH_OBJ)) {
				print '<img src="'.$kas_framework->server_root_dir('pictures/').$showPicx->staff_image.'" 
				alt="'.$showPicx->staff_fname .' '. $showPicx->staff_lname.'" 
				title="'.$showPicx->staff_lname .' '. $showPicx->staff_fname.'"
				href="'.$kas_framework->server_root_dir('pictures/').$showPicx->staff_image.'" data-fancybox-group="gallery" style="cursor:pointer" class="fancybox fancybox.image margin" />';
			}
		$db_galleryPicx = null;
?>