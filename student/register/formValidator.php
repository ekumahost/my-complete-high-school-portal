<?php
require ('../../php.files/classes/kas-framework.php');
$kas_framework->freeDBConnect();
extract($_POST);

if (!isset($byepass)) {
	exit('This File is Classified');
}

$type = @$_GET['type'];
if ($type == 'email') {
	if (!$kas_framework->strIsEmpty($email)) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		print '<center><font color=red>wrong email address</font></center>';
			$kas_framework->form_border_color('#email', 'red');	
		} else {
			print '<center><font color=green>email looks good. will be used for confirmation</font></center>';
			$kas_framework->form_border_color('#email', 'green');
		}
	}

} else if ($type == 'user_username') {
		if ($kas_framework->check_username_from_all($user_username) == true) {
			print '<center><font color=red>this username is already taken</font></center>';
			$kas_framework->form_border_color('#user_username', 'red');	
		} else {
			print '<center><font color=green>username is free</font></center>';
			$kas_framework->form_border_color('#user_username', 'green');	
		}
} 

?>