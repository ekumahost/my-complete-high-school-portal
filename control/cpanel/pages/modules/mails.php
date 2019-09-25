<?php 
$title="Portal Mails";
if (!defined('MYSCHOOLAPPADMIN_CORE')) {// if the user access this page directly, take his ass back to home 
	header('Location: ../../../index.php?action=notauth');
	exit;
}

include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";

$current_year = $_SESSION['CurrentYear'];


// count number of parents
$querybio= "select * from tbl_portal_emails";
$dbh_querybio = $dbh->prepare($querybio); $dbh_querybio->execute(); $biototal = $dbh_querybio->rowCount(); $dbh_querybio = null;

	// since we are displaying 1000 only
	if($biototal > 1000){
	//echo "its above 10000";
	$break_p = round($biototal/1000);
	// so we have $break_p number of page groups
	// collect the page group from url
		@$groupid = $_GET['break_p'];
		// then we loop the page grout in a page grouping link
		}// end if card is more than a thousand
	 // start working again
				if(isset($_GET['break_p'])){// this is only set when quantity is greater than 1000
	// for $groupid = 0, 0-1000, 1, 1000-2000, 2 2000- 3000, 3 3000-4000s
		  	 $sort_srt = $groupid*1000;}else{
				 ///$groupid
				 // where should the sorting start
				 $sort_srt = 0; 
				 }// end for wallet
				 
if(isset($_GET['del'])){
$delete = DecodeToken($_GET['del']);

$doit = "DELETE FROM tbl_portal_emails WHERE id ='$delete'";
$dbh_doit = $dbh->prepare($doit); $dbh_doit->execute(); $rowCount_dbh_doit = $dbh_doit->rowCount(); $dbh_doit = null;
//edited by ultimate keliv
	if($rowCount_dbh_doit == 1){
		$myp->AlertSuccess('Congrats! ', ' Message was successfully deleted from the database');
	} else {
		$myp->AlertError('Error! ', 'Could not delete this message. Please try again later');
	}
}

 if(isset($_GET['read'])){
$read_id = DecodeToken($_GET['read']);

$markasread = "UPDATE tbl_portal_emails SET status = '1' WHERE id ='$read_id'";
$dbh_markasread = $dbh->prepare($markasread); $dbh_markasread->execute(); $dbh_markasread = null;

$pull_record = "SELECT * FROM tbl_portal_emails WHERE id ='$read_id'";
$dbh_pull_record = $dbh->prepare($pull_record); $dbh_pull_record->execute(); $fetchObj_pullRecod = $dbh_pull_record->fetch(PDO::FETCH_OBJ); $dbh_pull_record = null;

 $from_emailr = $fetchObj_pullRecod->from_email;
 $sender_typer = $fetchObj_pullRecod->sender_type;
 $from_namer = $fetchObj_pullRecod->from_name;
 $subjectr = $fetchObj_pullRecod->subject;
 $messager = $fetchObj_pullRecod->message;
 $dater = $fetchObj_pullRecod->date;
 $statusr = $fetchObj_pullRecod->status;


if($sender_typer =='A'){
	$sender_typer = "Student";
	$sender_idr = $kas_framework->getValue('stdbio_id', 'web_students', 'email', $from_emailr);
	$sender_imager = $kas_framework->getValue('studentbio_pictures', 'studentbio', 'studentbio_id', $sender_idr);
	$viewr ="main?page=view_users&id=".EncoderToken($sender_idr);

}elseif($sender_typer =='B'){
	$sender_typer = "Staff";
	$sender_idr = $kas_framework->getValue('staff_id', 'staff', 'staff_email', $from_emailr);
	$sender_imager = $kas_framework->getValue('staff_image', 'staff', 'staff_email', $from_emailr);
	$viewr ="main?page=view_staff&id=".EncoderToken($sender_idr);


}elseif($sender_typer =='C'){
	$sender_typer = "Parent";
	$sender_idr = $kas_framework->getValue('student_parents_id', 'student_parents', 'student_parents_email', $from_emailr);
	$sender_imager = $kas_framework->getValue('student_parents_image', 'student_parents', 'student_parents_email', $from_emailr);
	$viewr ="main?page=parents";

}elseif($sender_typer =='D'){
	$sender_typer = "Public";
	$sender_idr = 0;
	$sender_imager = "av_female.png";
	$viewr ="#";

}else{
	$sender_typer = "Unknown";
	$sender_idr = 0;
	$sender_imager = "av_female.png";
	$viewr ="#";

}
	if($statusr ==0){
		$mystatusr = '<span class="label label-success" style="padding:7px 5px">Unread</span>';
	} else if($statusr ==1){
		$mystatusr = '<span class="label label-info" style="padding:7px 5px">Read</span>';
	}else{
	   $mystatusr = '<span class="label label-important" style="padding:7px 5px">Unknown</span>';
	}
?>
<div style="margin:0 auto; width:80%; padding:10px; box-shadow:20px 20px 50px #CCC ">

<div style="margin:15px;">
  <p class="pull-right"><a href="../../pictures/<?php echo $sender_imager;?>" class="fancybox fancybox.image">
  <img id="" title="child" src="../../pictures/<?php echo $sender_imager;?>" alt="none" align="" style="width:100px;" /> </a> </p>
  <p style="font-weight:900; font-variant:small-caps; text-align"> Read Messages <a class="btn btn-danger btn-sm" href="?controller=mails&del=<?php EncodeToken($read_id);?>&delete=yes"><i class="icon icon-color icon-trash"></i> Delete </a> </p>
  <p>From: <strong><?php echo htmlentities($from_namer);?></strong> (<strong><?php echo $from_emailr;?></strong>)</p>
  <p>Subject: <strong><?php echo htmlentities($subjectr);?></strong></p>
  <p>Status: <span class="center"><?php echo $mystatusr;?></span> ( <a href="<?php echo $viewr;?>" target="_blank">View Senders Profile </a></em>)</p>
  <p>Date: <span class="center"><?php echo $dater;?></span> </p><br />
  <p> <span style="font-variant:small-caps; font-weight:600"> Message:  </span><br /> "<?php echo $messager;?> " </p>
  <br /><br />
 <i> Quick Reply 
	 <?php if(isset($_POST['reply'])){
		 $replyto = $_POST['replyto'];
		 $headers = 'From: HyperSchool <'.$replyto .">\r\n" .
		'Reply-To: '.$replyto . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
			$pushmail= mail($from_emailr,"RE: ".htmlentities($subjectr), $_POST['reply'], $headers);
			if($pushmail==1){
				echo '<font color="green">Reply Sent!</font>';
			} else {
				echo '<font color="red">Unable to send reply! </font>';
			}
			
	}?>
</i>
 
 
 <form name="" action="" method="post">
 <textarea name="reply" cols="80" rows="6" placeholder="If it is a Student, Parent or Staff no need replying, talk to the user from User Profile"></textarea><br />
 Where will be user response go?<br /><input name="replyto" type="email" value="" placeholder="Your Email" value="<?php echo $SMTP_REPLY_TO; ?>" />
 <input type="submit" value="Send Email" />
  </form>
</div>
</div>


<?php

}// stop reading

?>

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>Mails<?php //echo $db_name;?></h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr bgcolor="">
            <th>S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th>From</th>
            <th>Subject</th>
            <th>Profile</th>
            <th>Status</th>
            <th>Image</th>
            <th>Details<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th>Date </th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
         
	 <?php
	 
			$pullassout = "SELECT * FROM tbl_portal_emails ORDER BY id DESC LIMIT $sort_srt, 1000";
			$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute(); 
			$sn = 0;
			while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {

			$sn = $sn + 1;
			$mail_id = $std['id'];
			$from = $std['from_email'];
			$sender_type = $std['sender_type'];
			$from_name = $std['from_name'];
			$subject = $std['subject'];
			$message = $std['message'];
			$date = $std['date'];
			$status = $std['status'];



	if($sender_type =='A'){
		$sender_type = "Student";
		$sender_id = $kas_framework->getValue('stdbio_id', 'web_students', 'email', $from);
		$sender_image = $kas_framework->getValue('studentbio_pictures', 'studentbio', 'studentbio_id', $sender_id);
		$view ="main?page=view_users&id=".EncoderToken($sender_id);

	} else if($sender_type =='B'){
		$sender_type = "Staff";
		$sender_id = $kas_framework->getValue('staff_id', 'staff', 'staff_email', $from);
		$sender_image = $kas_framework->getValue('staff_image', 'staff', 'staff_email', $from);
		$view ="main?page=view_staff&id=".EncoderToken($sender_id);
		
	} else if($sender_type =='C'){
		$sender_type = "Parent";
		$sender_id = $kas_framework->getValue('student_parents_id', 'student_parents', 'student_parents_email', $from);
		$sender_image = $kas_framework->getValue('student_parents_image', 'student_parents', 'student_parents_email', $from);
		$view ="main?page=parents";

	} else if($sender_type =='D'){
		$sender_type = "Public";
		$sender_id = 0;
		$sender_image = "av_female.png";
		$view ="#";

	} else {
		$sender_type = "Unknown";
		$sender_id = 0;
		$sender_image = "av_female.png";
		$view ="#";
	}




	if($status ==0){
		$mystatus = '<span class="label label-success" style="padding:7px 4px">Unread</span>';
	 } else if($status ==1){
		$mystatus = '<span class="label label-info" style="padding:7px 4px">Read</span>';
	 } else {
		$mystatus = '<span class="label label-important" style="padding:7px 4px">Unknown</span>';
	 }
	?>
		 
		  <tr bgcolor="">
			<td><?php echo $sn;?></td>
            <td><i class="icon icon-color icon-user"></i><?php echo htmlentities($from_name);?></td>
            <td class="center"><a href="?controller=mails&read=<?php echo $mail_id;?>"> "<?php echo htmlentities($subject);?>"</a> <br />
			<a class="btn btn-default btn-sm" href="?controller=mails&read=<?php EncodeToken($mail_id);?>"><i class="icon icon-color icon-inbox"></i> Read This Message</a></td>
            <td class="center"><?php echo $sender_type;?></td>
            <td class="center"> <?php echo $mystatus;?> <p style="margin-top:7px">Priority: Urgent </p></td>
            <td class="center"> <a href="<?php echo $view;?>" target="_blank" class="btn btn-sm btn-default">View Profile</a> <br /> <?php echo $from;?>  </td>
            <td class="center">
				<a href="../../pictures/<?php echo $sender_image;?>" class="fancybox fancybox.image">
					<img id="" title="child" src="../../pictures/<?php echo $sender_image;?>" alt="none" align="" style="height:60px" /> </a></td>
            <td class="center"><?php echo $date;?></td>
            <td class="center"> <a title="Delete message" class="btn btn-danger" href="?controller=mails&del=<?php EncodeToken($mail_id);?>&delete=yes"> <i class="icon-trash icon-white"></i>  </a> </td>
          </tr>
		  
	  <?php } 
			$dbh_pullassout = null;
		?>
        </tbody>
      </table>
</div>		  
	  
	  
	 <?php
// start working ends, this is the third place worked
	if($biototal > 1000){
		if(!isset($_GET['break_p'])){$groupid=1;}
			echo '<br>You now have large number of mails in your db; total: '.$biototal.' we have put them into page groups, the ones bellow are more of them <br><br><br> Viewing page group:'.'<strong>'.$groupid.'</strong>'.'<br>';
	// then we loop the page grout in a page grouping link
	for($bp = 1; $bp <= $break_p; $bp++){
		echo '<a href="modules?contoller=mails&break_p='.$bp.'">PG'.$bp.' </a>&raquo;';
	}// end for loop

}// end biototal is 1000
?>
	</div>
  </div>
  <!--/span-->
</div>
<p>&nbsp;</p>