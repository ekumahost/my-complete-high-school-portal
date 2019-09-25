<?php 
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/staff_details.php');
require ('discussion_delimeter_function.php');

	extract($_POST);
	//sleep(3);
	//making sure that the file was not accessed by the url
	if (!isset($_POST['byepass'])) {
		exit('Error 404: File Cannot be Accessed');
	}
	$load = $load + 1; /*incrementing the load so that it can be loaded*/
	$endLimit = $load * 20;

	$getAllPosts = "SELECT * FROM staff_post WHERE status = '1' ORDER BY id DESC LIMIT 0, ".$endLimit."";
		$db_getAllPosts= $dbh->prepare($getAllPosts);
		$db_getAllPosts->execute(); 
		while ($show_post = $db_getAllPosts->fetch(PDO::FETCH_OBJ)) {
			$discussions->viewDescretedWhilePosts($show_post, 'true', $web_users_relid);
		}
		$db_getAllPosts = null;
?>