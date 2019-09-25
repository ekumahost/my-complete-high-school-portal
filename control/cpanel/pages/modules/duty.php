<?php 
$title="Duty Allocator";

if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}

include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";
$current_year = $_SESSION['CurrentYear'];
$current_term = $_SESSION['CurrentTerm'];


// count number of parents
$biototal = $kas_framework->countRestrict2('speak', 'speak_term', $current_term, 'speak_session', $current_year);
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
	
	
	if (isset($_POST['add_duty_button'])) {
		extract($_POST);
		if ($kas_framework->strIsEmpty($teacher) or $kas_framework->strIsEmpty($days) or $kas_framework->strIsEmpty($period) or $kas_framework->strIsEmpty($instruction)) {
			$myp->AlertError("Form Error! ", "Please Fill In all the Fields");
		} else {
			$insert = "INSERT INTO speak (speak_teacherid, speak_day, speak_period, speak_date, speak_note, speak_term, speak_session)
			VALUES ('".$kas_framework->secureStr($teacher)."', '".$kas_framework->secureStr($days)."', '".$kas_framework->secureStr($period)."', '".date('d-m-Y')."', 
			'".$kas_framework->secureStr($instruction)."', '".$current_term."', '".$current_year."')";
				$dbh_insert = $dbh->prepare($insert); $dbh_insert->execute(); $rowCount = $dbh_insert->rowCount(); $dbh_insert = null;
				if ($rowCount == 1) {
					$myp->AlertSuccess('Great Work! ', 'Duty has been assigned to Staff');
				} else {
					$myp->AlertError('Error! ', 'Could not assign Staff Duty');	
					print mysql_error();
				}
		}
	}
	
	if (isset($_POST['edit_duty_button'])) {
		extract($_POST);
		$speakID = DecodeToken($_GET['edit']);
		if ($kas_framework->strIsEmpty($teacher) or $kas_framework->strIsEmpty($days) or $kas_framework->strIsEmpty($period) or $kas_framework->strIsEmpty($instruction)) {
			$myp->AlertError("Form Error! ", "Please Fill In all the Fields");
		} else {
			$querilize = "UPDATE speak SET speak_teacherid = '".$teacher."', speak_day = '".$days."', speak_period = '".$period."', speak_note = '".$instruction."'
			WHERE speak_id = '".$speakID."'";
			$dbh_querilize = $dbh->prepare($querilize); $dbh_querilize->execute(); $rowCount = $dbh_querilize->rowCount(); $dbh_querilize = null;
				if ($rowCount == 1) {
					$myp->AlertSuccess('Nice Job! ', 'Duty Timetable was updated Successfully');
				} else {
					$myp->AlertError('Oh Oh! ', "Looks like you didn't make any change to the duty roaster. ");
				}
		}
	}
	
	if (isset($_GET['delete'])) {
		$deleteSQL = "DELETE FROM speak WHERE speak_id = '".DecodeToken($_GET['delete'])."'";
		$dbh_deleteSQL = $dbh->prepare($deleteSQL); $dbh_deleteSQL->execute(); $rowCount = $dbh_deleteSQL->rowCount(); $dbh_deleteSQL = null;
			echo ($rowCount == 1)? $myp->AlertSuccess('Good! ', 'Duty Roaster was deleted Successfully'): $myp->AlertError('Error !', 'Could not Delete this Duty Roaster');
	}

?>
<style type="text/css">
#designer { padding:5px; margin:3px 1px; border:1px solid #000; }
#designer img {float:right; margin:0 0 0 4px; }
</style> 
<?php if (isset($_GET['action']) == 'add_new') { ?>
	  <form action="#message" method="post">
      <table width="50%" border="0" align="center" class="table">
        <tr>
          <td><label for="batch"><strong>Teacher</strong></label>
		  <select name="teacher"> <option></option>
		  <?php $getTeachers = "SELECT * FROM staff WHERE staff_status = '1'";
				$dbh_getTeachers = $dbh->prepare($getTeachers); $dbh_getTeachers->execute(); 
					while ($tD = $dbh_getTeachers->fetch(PDO::FETCH_OBJ)) {
						echo '<option value="'.$tD->staff_id.'">'.$tD->staff_lname.' '.$tD->staff_fname.'</option>';
					}
				 $dbh_getTeachers = null;
				?></select>

		  <label for="start"><strong>Days</strong></label>
			<select name="days"> <option></option>
			  <?php $getDays = "SELECT * FROM tbl_days";
				$dbh_getDays = $dbh->prepare($getDays); $dbh_getDays->execute(); 
					while ($tDays = $dbh_getDays->fetch(PDO::FETCH_OBJ)) {
						print '<option value="'.$tDays->days_id.'">'.$tDays->days_desc.'</option>';
					}
					?></select>
		
		  <label for="stop"><strong>Period</strong></label>
		 <select name="period"> <option></option>
			  <?php $getPeriods = "SELECT * FROM school_class_periods";
			  $dbh_getPeriods = $dbh->prepare($getPeriods); $dbh_getPeriods->execute(); 
					while ($tPeriod = $dbh_getPeriods->fetch(PDO::FETCH_OBJ)) {
						print '<option value="'.$tPeriod->id.'">'.$tPeriod->desc.' ('.$tPeriod->periods.')</option>';
					}
					?></select>
		  </td>
		  
		  <td>
		  <label for="intdate"><strong>Date Added</strong></label>
		  <input id="intdate" type="date" name="duty_date" disabled="disabled" value="<?php print date('Y-m-d') ?>" />
		  <label for="instruction"><strong>Note of Duty</strong></label>
	<textarea name="instruction" id="instruction" rows="2" cols="44">Duty Note eg. You are hereby assigned to teach the students on Obedience at the School Hall</textarea><br />
		  <input type="submit" class="btn btn-success" name="add_duty_button" value="Add Duty" /> <a href="?controller=duty" class="btn btn-sm">Finished! Close Form</a>
		</td>
		  
        </tr>
      </table>
	</form>
<?php } else if (isset($_GET['edit'])) { 
	$editID = $_GET['edit'];
		$Query = "SELECT * FROM speak WHERE speak_id = '".$editID."'";
		$dbh_Query = $dbh->prepare($Query); $dbh_Query->execute(); $editObj = $dbh_Query->fetch(PDO::FETCH_OBJ); $dbh_Query = null;
?>
	<form action="#message" method="post">
      <table width="50%" border="0" align="center" class="table">
        <tr>
          <td><label for="batch"><strong>Teacher</strong></label>
		  <select name="teacher"> <option></option>
	  <?php 
	  	$getStaff = "SELECT * FROM staff";
			$dbh_getStaff = $dbh->prepare($getStaff); $dbh_getStaff->execute(); 
        while ($staff_return = $dbh_getStaff->fetch(PDO::FETCH_OBJ)) {
            $selected = ($staff_return->staff_id == $kas_framework->getValue('speak_teacherid', 'speak', 'speak_id', $editID))? 'selected=selected': '';
            print '<option value="'.$staff_return->staff_id.'" '.$selected.'>'.$staff_return->staff_lname.' '.$staff_return->staff_fname.'</option>';	
        }
		$dbh_getStaff = null;
	 ?>
          </select>
		  <label for="start"><strong>Days</strong></label>
			<select name="days"> <option></option>
			  <?php $kas_framework->getallFieldinDropdownOption('tbl_days', 'days_desc', 'days_id', $kas_framework->getValue('speak_day', 'speak', 'speak_id', $editID))  ?></select>
		
		  <label for="stop"><strong>Period</strong></label>
		 <select name="period"> <option></option>
			  <?php $getPeriod = "SELECT * FROM school_class_periods";
					  $dbh_getPeriod = $dbh->prepare($getPeriod); $dbh_getPeriod->execute(); 
					while ($period_return = $dbh_getPeriod->fetch(PDO::FETCH_OBJ)) {
						$selected = ($period_return->id == $kas_framework->getValue('speak_period', 'speak', 'speak_id', $editID))? 'selected=selected': '';
						print '<option value="'.$period_return->id.'" '.$selected.'>'.$period_return->desc.' ('.$period_return->periods.')</option>';	
					} 
				?>
			</select>
		  </td>
		  
		  <td>
		  <label for="intdate"><strong>Duty Date Added</strong></label>
		  <input id="intdate" type="date" name="duty_date" disabled="disabled" value="<?php print $kas_framework->getValue('speak_date', 'speak', 'speak_id', $editID) ?>" />
		  <label for="instruction"><strong>Note of Duty</strong></label>
		  <textarea name="instruction" id="instruction" rows="2" cols="44"><?php print $kas_framework->getValue('speak_note', 'speak', 'speak_id', $editID) ?></textarea><br />
		  <input type="submit" class="btn btn-success" name="edit_duty_button" value="Update Duty" /> <a href="?controller=duty" class="btn btn-sm">Finished! Close Form</a>
		</td>
		  
        </tr>
      </table>
	</form>
<?php } ?>
<div id="unanimousDIV"></div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i> Staff Duty Roaster Allocator</h2> 
	  <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
	</div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr bgcolor="">
            <th>S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th>Teacher</th>
            <th>Day</th>
            <th>Period </th>
            <th>Date Uploaded</th>
            <th>Note</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
      <?php
	  $dutyTable = "select * from speak WHERE speak_term = '".$current_term."' AND speak_session = '".$current_year."'";
	  $dbh_dutyTable = $dbh->prepare($dutyTable); $dbh_dutyTable->execute(); 
	 	 $serial = 0;
			while ($deduceDuty = $dbh_dutyTable->fetch(PDO::FETCH_OBJ)) {
				$serial++;
				$teacherDetails = $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $kas_framework->getValue('staff_title', 'staff', 'staff_id', $deduceDuty->speak_teacherid)). ' ' .$kas_framework->getValue('staff_lname', 'staff', 'staff_id', $deduceDuty->speak_teacherid) .' 
				'.$kas_framework->getValue('staff_fname', 'staff', 'staff_id', $deduceDuty->speak_teacherid);
				$teacherImage = $kas_framework->getValue('staff_image', 'staff', 'staff_id', $deduceDuty->speak_teacherid);
				$teacherID = $kas_framework->getValue('staff_id', 'staff', 'staff_id', $deduceDuty->speak_teacherid);
				print '	<tr>
						<td>'.$serial.'</td>
						<td><a target="_blank" href="main?page=view_staff&id='.EncoderToken($teacherID).'">'.$teacherDetails.'</a> | 
						<a href="../../pictures/'.$teacherImage.'" class="fancybox fancybox.image">View Image</a></td>
						<td>'.$kas_framework->getValue('days_desc', 'tbl_days', 'days_id', $deduceDuty->speak_day).'</td>
						<td>'.$kas_framework->getValue('desc', 'school_class_periods', 'id', $deduceDuty->speak_period).' 
													('.$kas_framework->getValue('periods', 'school_class_periods', 'id', $deduceDuty->speak_period).')</td>
						<td>'.$deduceDuty->speak_date.'</td>
						<td>'.$deduceDuty->speak_note.'</td>
						<td><a href="?controller=duty&edit='.EncoderToken($deduceDuty->speak_id).'" class="btn btn-sm">Edit</a>
						 <a href="?controller=duty&delete='.EncoderToken($deduceDuty->speak_id).'" class="btn btn-sm btn-danger">Delete</a></td>
					</tr>';
			}
			$dbh_dutyTable = null;
		 ?>
        </tbody>
      </table>
  
<?php
// start working ends, this is the third place worked
echo 'Total Duty: <strong>'.number_format($biototal).'</strong><br><br>';
	if($biototal > 1000){
		if(!isset($_GET['break_p'])){$groupid=1;}
	echo '<br>You now have large number of wallets in your db; total: '.$biototal.' we have put them into page groups, the ones bellow are more of them <br><br><br> Viewing page group:'.'<strong>'.$groupid.'</strong>'.'<br>';
	// then we loop the page grout in a page grouping link
	for($bp = 1; $bp <= $break_p; $bp++){
		echo '<a href="modules?controller=wallet&break_p='.$bp.'">PG'.$bp.' </a>&raquo;';
	}// end for loop
  }// end biototal is 1000
?>
</div>
  </div>
  <!--/span-->
</div>
