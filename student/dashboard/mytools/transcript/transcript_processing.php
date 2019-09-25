<?php
require ( '../../../../php.files/classes/pdoDB.php');
require ( '../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/student_details.php');
extract($_POST);

//making sure that the file is not accesed via the url
if (!isset($_POST['byepass'])) {
		exit('Error 404: File is Classified');
	}

if ($kas_framework->strIsEmpty($delivery_option) or $kas_framework->strIsEmpty($new_school_address) or $kas_framework->strIsEmpty($new_school_email_address) or $kas_framework->strIsEmpty($delivery_option) or $kas_framework->strIsEmpty($format_option)) {
	$kas_framework->showDangerCallout('Please Fill in all the Fields').
	$kas_framework->buttonController('#submit_request', 'enable');
}	else {
	//compose mail for the administrator 
	$message = 'Hello Sir/Ma, <br />
					I write to you to inform you that i will be needing a transcript from your school to my new school using the following Paremeters: <br />
						School Address: <b>'.$new_school_address.'</b><br />
						School Email Address: <b>"'.$new_school_email_address.'"</b><br /><br />
						My Prefered Delivery type include: <br />
						Format: <b>"'.$format_option.'"</b><br />
						Delivery Gradient: <b>"'.$delivery_option.'"</b><br />
						<br />
						I will be grateful if this request is honoured.<br />
						Thanks.';
	
	$email_address = $useremail;
	$fullname = $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $usertitle).' '.$userlastname.' '.$userfirstname.' '.$usermname;
	$subject = 'Transcript Request';
	
	/* forward mail to the real sender */
		if ($kas_framework->tapp_admin_mail($email_address, $fullname, $subject, $message) == true) {
			$kas_framework->showInfoCallout('Request Received. Will be processed shortly. Please do not send this reqest again.');
		} else {
			$kas_framework->showDangerCallout('Transcript Request Failed. Please see the admin in person. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="blank">Explanation?</a>');
			$kas_framework->buttonController('#submit_request', 'enable');
		}
}
//delivery_option,new_school_address, new_school_email_address, format_option 
?>