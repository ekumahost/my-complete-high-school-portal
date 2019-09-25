<?php
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/staff_details.php');

extract($_POST);
//making sure tat the file was not accessed by the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed');
}

//$web_users_relid, $post_id

	$allLikesID = $kas_framework->getValue('liker_id', 'staff_post', 'id', $post_id);
	
	if (substr_count($allLikesID, $web_users_relid. ';') == 0) {
		$newallLikesID = $allLikesID .$web_users_relid .';';
		
		$rawQ = "UPDATE staff_post SET liker_id = '".$newallLikesID."' WHERE id = '".$post_id."' LIMIT 1";
		$db_rawQ = $dbh->prepare($rawQ);
		$db_rawQ->execute();
		$db_rawQ = null;
	}
	
?>