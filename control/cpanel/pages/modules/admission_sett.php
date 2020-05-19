<?php 
$title="Admission module";
if (!defined('MYSCHOOLAPPADMIN_CORE')) {// if the user access this page directly, take his ass back to home 
	header('Location: ../../../index.php?action=notauth');
	exit;
}

include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";

?>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>Admission/Interview configuration</h2>
      <div class="box-icon" id="message"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
	<?php $myp->AlertInfo('Hey Admin! ', 'Please Take note that the Date format here is yyyy-mm-dd if the date control format dosent appear because of your browser. eg. 2015-09-30') ?>
    <div class="box-content">
	  <form action="#message" method="post">
      <table width="50%" border="0" align="center" class="table">
        <tr>
          <td><label for="batch"><strong>Batch name</strong></label>
		  <input id="batch" type="text" name="batch" placeholder="eg: October Batch" /><br />
		  <input id="" type="hidden" name="create" />

		  <label for="start"><strong>Registration start date</strong></label>
		  <input id="start" type="date" name="start" placeholder="YYYY-MM-DD" />
		
		  <label for="stop"><strong>Registration stop date</strong></label>
		  <input id="stop" type="date" name="stop" placeholder="YYYY-MM-DD" />
		  
		  
		  </td>
		  <td>
		  
		   <label for="intdate"><strong>Interview Date</strong></label>
		  <input id="intdate" type="date" name="intdate" placeholder="YYYY-MM-DD" />
		  <label for="inttime"><strong>Interview time</strong></label>
		  <input id="inttime" type="time" name="inttime" placeholder="Specify Time eg. 9:30am" />
		  <label for="instruction"><strong>Instructions</strong></label>

		  <textarea name="instruction" id="instruction" rows="2" cols="44">Instruction to students coming for the admission eg. Bring your Photo Card when coming</textarea><br />
		  <input type="submit" class="btn btn-success" value="Configure" />
		</td>
		  
        </tr>
      </table>
	</form>
	
	<?php

if(isset($_POST['create'])){
	// collect the form data and inser tinto the db
	@$badge = $_POST['batch'];
	@$start = $_POST['start'];
	@$end = $_POST['stop'];

	@$instr = $_POST['instruction'];
	@$date = $_POST['intdate'];
	@$time = $_POST['inttime'];


	$start = substr($start, -2).'/'.substr($start, -5, 2).'/'.substr($start, 0, 4);
	$end = substr($end, -2).'/'.substr($end, -5, 2).'/'.substr($end, 0, 4);
	$date = substr($date, -2).'/'.substr($date, -5, 2).'/'.substr($date, 0, 4);

	//edited by the ultimate keliv
	if ($kas_framework->strIsEmpty($badge) or $kas_framework->strIsEmpty($start) or $kas_framework->strIsEmpty($end) or $kas_framework->strIsEmpty($instr) or $kas_framework->strIsEmpty($date) or $kas_framework->strIsEmpty($time)) {
			$myp->AlertError('Not Again! ', 'How can you call for an Admission without Specifying all the needed fields?');
		} else {
			$putin = "INSERT INTO tbl_admission(badge_name,application_starts,application_ends,interview_date,interview_time,instruction) VALUES('$badge','$start','$end','$date','$time','$instr')";
			$dbh_putin = $dbh->prepare($putin); $dbh_putin->execute(); $rowCount = $dbh_putin->rowCount(); $dbh_putin = null;
			if ($rowCount == 1) {
				$myp->AlertSuccess('Good Job! ', 'Admission has been called Sucesfully');
			} else {
				$myp->AlertError('Fatal Error! ', 'Something is not right. Please try again');
			}
		}
	}// end create

if(isset($_POST['takeaction'])){
	@$id = $_POST['id'];

	$dowhat = $_POST['takeaction'];
	switch($dowhat){

	case 'pause':
	$Query = "UPDATE tbl_admission SET active = '0' WHERE id='$id'";
	$dbh_Query = $dbh->prepare($Query); $dbh_Query->execute(); $dbh_Query = null;
	break;
	
	case 'activate':
	$Query = "UPDATE tbl_admission SET active = '1' WHERE id='$id'";
	$dbh_Query = $dbh->prepare($Query); $dbh_Query->execute(); $rowCount = $dbh_Query->rowCount(); $dbh_Query = null;
	// add the student 
			if($rowCount == 1) {
				$myp->AlertInfo('Good! ', 'Action Successful. ');
			} else {
				$myp->AlertError('Error! ', 'Something is not right');
			}
		}
	}// switching
	?>
	
      <p><strong>Past Admission batches </strong></p>
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr style="color:blue;">
            <th width="3%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="14%">Admission batch name </th>
            <th width="18%">Reg Start </th>
            <th width="14%">Reg Ends </th>
            <th width="20%">Status</th>
            <th width="20%">Detail <i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="9%">Action<i class="icon-trash icon-red"></i></th>
          </tr>
        </thead>
        <tbody>
         
	 <?php 
		$pullassout = "SELECT * FROM tbl_admission ORDER BY id DESC";
		$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute(); 
		//studentbio_entry_grade  
		$sn = 0;
		while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {
			$sn = $sn + 1;
			$rowid = $std['id'];
			$badge = $std['badge_name'];
			$start = $std['application_starts'];
			$stop = $std['application_ends'];
			$interview_dt = $std['interview_date'];
			$interview_time = $std['interview_time'];
			$active = $std['active'];
			$instr = $std['instruction'];
			$txactive = $active;
			 if($active =='1'){
				 $active = '<span class="label label-success" style="padding:7px 5px">Open</span>';
				 //label-warning for pending
				 } else {	$active = '<span class="label label-important" style="padding:7px 5px">Closed</span>';}
	 //$start=$db->get_var("SELECT date_format(reg_date, '%D %M %Y') as date FROM web_students WHERE stdbio_id='$rowid'");//we can also use stdbio_id
	?>
		 
  <tr>
	<td><?php echo $sn;?></td>
	<td><?php echo $badge;?></td>
	<td class="center"><?php echo $start;?> </td>
	<td class="center"><?php echo $stop;?> </td>
	<td class="center"><?php echo $active;?> </td>
	<td class="center">Interview Time: <?php echo $interview_time.' '.$interview_time;?><br />Instructions:<?php echo $instr;?></td>
	
	<td class="center">
	<form action="" method="post">
	<input type="hidden" name="takeaction" value="<?php if($txactive ==1){echo 'pause';}else{echo'activate';}?>" />
	<input type="hidden" name="id" value="<?php echo $rowid;?>" />
	
   <input class="btn btn-<?php if($txactive ==1){echo 'danger';}else{echo'success';}?>" type="submit" value="<?php if($txactive ==1){echo 'Close Application';}else{echo'Reactivate Application';}?>"> </input></form>			</td>
  </tr>
	<?php }
		$dbh_pullassout = null;
	// end of the  loop ?>
        </tbody>
      </table>
    </div>
  </div>
  <!--/span-->
</div>
<p>&nbsp;</p>