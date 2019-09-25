<?php
include('public_functions.php');
			
$schoolname= $kas_framework->getValue('school_name', 'tbl_config', 'id', '1');

 define ('_SCHOOL_NAME', " ".$schoolname);
$tintro ="::";// this appears before any page title
$app_name_space = "&raquo;TSA";// this is included at the end of each page title

?>