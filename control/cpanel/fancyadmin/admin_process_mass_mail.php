<?php
session_start();
//Inizialize database functions
// config
include_once "../../includes/common.php";
//Include paging class
// take up
include_once "../../includes/configuration.php";

echo 'SMTP configuration invalid; <a href="../main?page=schoolapp&tools=api#mainsetting" target="new"> Go to Settings to Correct them.</a>'; 
exit;

$mailto=get_param("mailto");
$message=stripslashes(get_param("message"));
$subject=get_param("subject");
$room=get_param("room");

switch ($mailto) {
case 'teachers':
	$sSQL="SELECT teachers_email AS email FROM teachers";
	break;
case "studentcontact":
	if ($room == "all") { $sSQL="SELECT studentcontact_email AS email FROM studentcontact"; }
	else { // get all contacts from students in same homeroom ($room)
	$sSQL = "SELECT studentcontact_email AS email FROM studentcontact  INNER JOIN studentbio ON studentbio_primarycontact=studentcontact_id WHERE studentbio_homeroom='".$room."' AND studentcontact_email!=''"; }
	break;
case "both":
	$sSQL1="SELECT teachers_email AS email FROM teachers";
	$sSQL2="SELECT studentcontact_email AS email FROM studentcontact";
	$dbh_Query1 = $dbh->prepare($sSQL1); $dbh_Query2 = $dbh->prepare($sSQL2);
	$dbh_Query1->execute(); $dbh_Query2->execute();
	$emails_teach = $dbh_Query1->fetch(PDO::FETCH_OBJ);	$emails_conta = $dbh_Query2->fetch(PDO::FETCH_OBJ);
	$emails_teach=$db->get_results($sSQL1);
	$emails_conta=$db->get_results($sSQL2);
	$dbh_Query1 = null; $dbh_Query2 = null;
	break;
};

require_once "class.phpmailer.php";
$mail = new PHPMailer();

$mail->IsSMTP();  // send via SMTP
$mail->Host     = $SMTP_SERVER; // SMTP servers
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = $SMTP_USER;  // SMTP username
$mail->Password = $SMTP_PASSWORD; // SMTP password
$mail->From     = $SMTP_FROM_EMAIL;
$mail->FromName = $SMTP_FROM_NAME;
$mail->AddAddress($SMTP_FROM_EMAIL,_ADMIN_PROCESS_MASS_MAIL_GENERAL);
if (@$mailto!="both"){
   foreach (@$emails as $emails){
     if (@$emails->email != "") { @$mail->AddBCC(@$emails->email); }
   };
}else{
   foreach ($emails_teach as $emails){
     if ($emails->email != "") { $mail->AddBCC($emails->email); }
   };
   foreach ($emails_conta as $emails){
     if ($emails->email != "") { $mail->AddBCC($emails->email); }
   };
};
$mail->AddReplyTo($SMTP_REPLY_TO,$SMTP_FROM_NAME);
$mail->WordWrap = 70;     // set word wrap
$mail->Subject  =  $subject;
$mail->Body = $message;
if($mail->Send()){
	//header("Location: admin_main_menu.php");
	
	echo " Sent";
	exit();
};
echo $mail->ErrorInfo;
?>
