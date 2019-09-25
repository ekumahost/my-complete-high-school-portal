<?php
require ('classes/pdoDB.php');
require ('classes/kas-framework.php');
$kas_framework->formReset('#portal_mail_form');
extract($_POST);

//make sure that the file is not directly accessed from the url
if (!isset($byepass)) {
	exit('This File is Classified');
}

	if ($kas_framework->strIsEmpty($email) or $kas_framework->strIsEmpty($name) or $kas_framework->strIsEmpty($subject) or $kas_framework->strIsEmpty($message)) {
		print '<font color="maroon">Please Fill in all the Fields!</font>';
		$kas_framework->buttonController('#submit_button', 'enable');
	}  else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		print '<font color="maroon">Email Adress "'.$email.'" is Wrong. Try Again!</font>';
		$kas_framework->buttonController('#submit_button', 'enable');	
	} else {
		if ($kas_framework->tapp_admin_mail($email, $name, $subject, $message) == true) {
			print '<font color="green">Message Received!. We will get back to you Soon.</font>';
				$kas_framework->buttonController('#submit_button', 'disable');
		} else {
			print '<font color="maroon">Error Sending your Message. Connection Error. Please Try Again!</font>';
				$kas_framework->buttonController('#submit_button', 'enable');
				//print mysql_error();
		}
	}

?>