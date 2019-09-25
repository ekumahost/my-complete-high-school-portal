<?php
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/staff_details.php');
require ('discussion_delimeter_function.php');
extract($_POST);
//making sure tat the file was not accessed by the url
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed');
}

//print nl2br($text_field);
		if ($kas_framework->strIsEmpty($text_field) == true) {
		print '<pre><code>Please type in Something in the TextBox</code></pre>';
	} else {
		$text_field = htmlentities($text_field);
		$insertPost = "INSERT INTO staff_post (poster_id, post_text, post_date) VALUES ('".$web_users_relid."', '".nl2br($text_field)."', '".date('d/m/Y')."')");
			$db_insertPost = $dbh->prepare($insertPost);
			$db_insertPost->execute();
			$get_insertPost_rows = $db_insertPost->rowCount();
			$db_insertPost = null;
			
			$inserted_post_id = $dbh->lastInsertId(); //getting back the id of the post
			if ($get_insertPost_rows == 0) {
				print '<pre><code>An Error Occured. Please try Again.</code></pre>';
			} else {
				/* it was successful... then get the post and prepend it to the existing one */
				$rawUnderstoodQ = "SELECT * FROM staff_post WHERE id = '".$inserted_post_id."' LIMIT 1";
				$db_rawUnderstoodQ = $dbh->prepare($rawUnderstoodQ);
				$db_rawUnderstoodQ->execute();
				$get_rawUnderstoodQ_rows = $db_rawUnderstoodQ->rowCount();
				$show_post = $db_rawUnderstoodQ->fetch(PDO::FETCH_OBJ);				
				$discussions->viewDescretedWhilePosts($show_post, 'true', $web_users_relid);
				$db_rawUnderstoodQ = null;
			}
	} 

?>