<?php 
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/student_details.php');
require ('discussion_delimeter_function.php');

	extract($_POST);
	//sleep(3);
	//making sure that the file was not accessed by the url
	if (!isset($_POST['byepass'])) {
		exit('Error 404: File Cannot be Accessed');
	}
	$load = $load + 1; /*incrementing the load so that it can be loaded*/
	$endLimit = $load * 20;

	$getAllPosts = "SELECT * FROM student_post WHERE status = '1' ORDER BY id DESC LIMIT 0, ".$endLimit."";
		$db_handleDY = $dbh->prepare($getAllPosts);
			$db_handleDY->execute();
	
		while ($show_post = $db_handleDY->fetch(PDO::FETCH_OBJ)) {
			$discussions->viewDescretedWhilePosts($show_post, 'true', $student_id_original);
		}
			$db_handleDY = null;
?>