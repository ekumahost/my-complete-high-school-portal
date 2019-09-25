<?php
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/student_details.php');

extract($_POST);
//making sure tat the file was not accessed by the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed');
}

//$student_id_original, $post_id

	$allLikesID = $kas_framework->getValue('liker_id', 'student_post', 'id', $post_id);
	
	if (substr_count($allLikesID, $student_id_original. ';') == 0) {
		$newallLikesID = $allLikesID .$student_id_original .';';
		$rawQ = "UPDATE student_post SET liker_id = '".$newallLikesID."' WHERE id = '".$post_id."' LIMIT 1";
			$db_handle = $dbh->prepare($rawQ);
			$db_handle->execute();
			$db_handle = null;
	}
	
?>