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
    $querySQLPost = "UPDATE student_post SET status = '0' WHERE poster_id = '".$student_id_original."' AND `id` ='".$post_id."'";
	$db_querySQLPost = $dbh->prepare($querySQLPost);
	$db_querySQLPost->execute();
	$get_rows_querySQLPost = $db_querySQLPost->rowCount();
	$db_querySQLPost = null;
    //print mysql_error();
        if ($get_rows_querySQLPost == 1) {
            print '<script type="text/javascript">
                    alert("Post Deleted");
                </script>';
        } else {
            print '<script type="text/javascript">
                    alert("Post could not be Deleted");
                </script>';
        }

?>