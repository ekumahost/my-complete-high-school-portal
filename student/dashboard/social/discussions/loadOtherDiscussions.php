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
	
	$_SESSION['loadDiscussionData'] = $load;
	
	$startLimit = $load * 20;

	$getAllPosts = "SELECT * FROM student_post WHERE status = '1' ORDER BY id DESC LIMIT ".$startLimit.", 20";
	$db_getAllPosts = $dbh->prepare($getAllPosts);
	$db_getAllPosts->execute();
	$get_rows = $db_getAllPosts->rowCount();

		while ($show_post = $db_getAllPosts->fetch(PDO::FETCH_OBJ)) {
			$discussions->viewDescretedWhilePosts($show_post, 'true', $student_id_original);
		}
		
	$db_getAllPosts = null;
	
?>