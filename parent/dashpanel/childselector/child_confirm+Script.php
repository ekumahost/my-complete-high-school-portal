<?php
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthParent();

extract($_POST);
//make sure that the file is not directly accessed from the url
if (!isset($byepass)) {
	exit('This File is Classified');
}

class cx extends kas_framework {	
  
  public function confirmz($parID, $stdID) {
	require ('../../../php.files/classes/pdoDB.php');
	$confirmation = "SELECT * FROM parent_to_kids WHERE parent_id = '".$parID."' AND student_id = '".$stdID."' LIMIT 1";
	$db_handle = $dbh->prepare($confirmation);
	$db_handle->execute();
	$paramObj = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;
	
		$confirmationData = $paramObj->confirmation;
			if ($confirmationData == 0) {
				$this->deleteQuestion($parID, $stdID, 'Child has not been Confirmed by the School. 
				The Only action available is to Delete<br />');
			} else {
				$this->showWarningCallout('Select your Action:
				<button class="btn btn-warning btn-flat" id="ask">
			<i class="fa fa-thumbs-o-down"></i> Delete this Child?</button>
			<button class="btn btn-success btn-flat" id="visitPortal" stdID = "'.$stdID.'">
			<i class="fa fa-magic"></i> Access '.ucfirst($this->getValue('user_n', 'web_students', 'stdbio_id', $stdID)).'\'s Portal? </button>');
			}
	}
	
	public function deleteChild($parID, $stdID) {
		require ('../../../php.files/classes/pdoDB.php');
		$del = "UPDATE parent_to_kids SET confirmation= '2' WHERE parent_id = '".$parID."' AND student_id = '".$stdID."' LIMIT 1";
		$db_del = $dbh->prepare($del);
		$db_del->execute();
		$get_db_del_rows = $db_del->rowCount();
		$db_del = null;
			if ($get_db_del_rows == 1) {
				$this->showinfoCallout('Child Succesfully Deleted.');
				print '<script type="text/javascript"> self.location = "'.$this->server_root_dir('parent/dashpanel/childselector').'" </script>';
				exit();
			} else {
				$this->showWarningCallout('Action was not Successfull. Please Try later');
			}
	}
	
	public function deleteQuestion($parID, $stdID, $premessage) {
		$this->showWarningCallout($premessage .'Do You Really Want to Delete? &nbsp;&nbsp;&nbsp;
			<button class="btn btn-warning btn-flat" id="confirm_no">
			<i class="fa fa-thumbs-o-down"></i> No</button> &nbsp;&nbsp;
			<button class="btn btn-success btn-flat" id="confirm_yes" parID="'.$parID.'" stdID = "'.$stdID.'">
			<i class="fa fa-thumbs-o-up"></i> Yes</button>');
	}
	
	public function visitPortal($stdID) {
		require ('../../../php.files/classes/pdoDB.php');
		$getUsername = "SELECT * FROM studentbio AS sb, web_students AS ws WHERE sb.studentbio_id = '".$stdID."' AND sb.studentbio_internalid = ws.identify LIMIT 1";
			$db_getUsername = $dbh->prepare($getUsername);
			$db_getUsername->execute();
			$get_getUsername_rows = $db_getUsername->rowCount();
			$paramObj = $db_getUsername->fetch(PDO::FETCH_OBJ);
			$db_handle = null;
				
				if ($get_getUsername_rows == 0) {
					$this->showWarningCallout('Fatal Error Occured');
				} else {
					$username = $paramObj->user_n;
					$admit_status = $paramObj->admit;
				
				if ($admit_status == '0' or $admit_status == '1' or $admit_status == '2') {
					/* Which means its a prospect student, or an admitted student or a graduate student */
					print '<p style="padding:10px; font-size:16px"> Loading Portal For <b>'.ucfirst($username).'.</b> Please Wait ... </p>';
				}
				
				
				if ($admit_status == '0') {
					$_SESSION['tapp_prostd_username'] = $username;
					print '<script type="text/javascript"> self.location = "'.$this->server_root_dir('prospectStudent/dashboard/').'" </script>';
				
				} else if ($admit_status == '1' or $admit_status == '2') {
					$_SESSION['tapp_std_username'] = $username;
					$_SESSION['BasicPlanStudent'] = 'Classic';
					print '<script type="text/javascript"> self.location = "'.$this->server_root_dir('student/dashboard/').'" </script>';
				
				} else if ($admit_status == '3') { /* meaning that student is suspended */
					$this->showDangerCallout('Student have been Suspended From School. Please Wait until the Ban is Lifted.');
				
				} else if ($admit_status == '4') { /* meaning that student is expelled */
					$this->showDangerCallout('Student have been Expelled From School. Please meet the Admin for any Information on this account.');
				
				} else if ($admit_status == '5') { /* meaning that student is transfered */
					$this->showDangerCallout('Transfered Student Not yet Configured. Please meet the Admin for any Information on this account.');
				
				} else if ($admit_status == '6') { /* meaning that student is withdrawn */
					$this->showDangerCallout('Withdrawn Student Not yet Configured. Please meet the Admin for any Information on this account.');
				
				} else if ($admit_status == '7') { /* meaning that student is deceased */
					$this->showDangerCallout('This account belongs to a Deceased Student. Are you a ghost Parent? Please meet the Admin for any !nformation on this account');
				}					
				exit();
			}
			
	}
}
$cxConfirm = new cx;

	$typeOfAction = $_GET['type'];
	 if ($typeOfAction == 'childConfirmation') {
		extract($_POST);
		$cxConfirm->confirmz($parID, $stdID);
	} else if ($typeOfAction == 'childDeletion') {
		extract($_POST);
		$cxConfirm->deleteChild($parID, $stdID);
	} else if ($typeOfAction == 'deleteQuestion') {
		extract($_POST);
		$cxConfirm->deleteQuestion($parID, $stdID, '');
	} else if ($typeOfAction == 'visitPortal') {
		extract($_POST);
		$cxConfirm->visitPortal($stdID);
	}

?>
<script type="text/javascript">
	$('#confirm_no').click(function() {
		$('#confirmationDiv').hide();
	});
	
	$('#ask').click(function() {
		$('#confirmationDiv').html('<?php $kas_framework->loading_h('center'); ?>');
		byepass = "UTR4VSWb6n7t8my09u5B4VWS";
		$.post('child_confirm+Script?type=deleteQuestion', {parID:parID, stdID:stdID, byepass:byepass}, function(data) {
			$('#confirmationDiv').html(data).show();
		});
	});
	
	$('#visitPortal').click(function() {
		$('#confirmationDiv').html('<?php $kas_framework->loading_h('center'); ?>');
		byepass = "UTR4VSWb6n7t8my09u5B4VWS";
		$.post('child_confirm+Script?type=visitPortal', {parID:parID, stdID:stdID, byepass:byepass}, function(data) {
			$('#confirmationDiv').html(data).show();
		});
	});
	
	$('#confirm_yes').click(function() {
		$('#confirmationDiv').html('<?php $kas_framework->loading_h('center'); ?>');
		parID = $(this).attr('parID'); stdID = $(this).attr('stdID'); byepass="bk2CIV34Bnptwcx2";
		
		$.post('child_confirm+Script?type=childDeletion', {parID:parID, stdID:stdID, byepass:byepass}, function(data) {
			$('#confirmationDiv').html(data).show();
		});
	});
</script>