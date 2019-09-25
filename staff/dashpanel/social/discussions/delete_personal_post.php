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

//$web_users_relid, $post_id
    $querySQL = "UPDATE staff_post SET status = '0' WHERE poster_id = '".$web_users_relid."' AND `id` ='".$post_id."'";
	$db_querySQL = $dbh->prepare($querySQL);
	$db_querySQL->execute();
	$get_rows = $db_querySQL->rowCount();
	$db_querySQL = null;
    //print mysql_error();
        if ($get_rows == 1) {
            print '<script type="text/javascript"> alert("Post Deleted"); </script>';
        } else {
            print '<script type="text/javascript">  alert("Post could not be Deleted");  </script>';
        }

?>