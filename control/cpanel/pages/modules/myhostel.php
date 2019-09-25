<?php 
//total modification by Ultimated Kelvin - Kastech

if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}

include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";
$current_year=$_SESSION['CurrentYear'];
$current_term  = $_SESSION['CurrentTerm'];

$id = $_GET['myhome'];
$title = $kas_framework->getValue('name', 'hostels', 'id', $id);

?>
 <?php if(!isset($_GET['action'])){?>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="modules?controller=hostels"><button type="button" class="btn btn-primary">All Hostels</button></a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="modules?controller=hostels&action=add"><button type="button" class="btn btn-primary">Add New</button></a>

<?php }?>
<br /><br />
<br />

<?php $ckid = $kas_framework->getValue('id', 'hostels', 'id', $id);
if(!$ckid){
		echo '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">*</button>
				<strong>Heads up!</strong> You are looking for trouble huh?.</div>';
		exit;
	}?>
<div style="margin-left:20px">
<h1> Welcome to <strong><?php echo $title;?></strong></h1><br />
<div class="box-content">

<?php if(isset($_POST['creation'])){// we are about to create bedspace?>

<a href="modules?controller=myhostel&myhome=<?php echo $id;?>&tools=bed_space"> Go back</a><br />

<strong>Bed Space/Room creator</strong><br />


<?php
// Validate the form input
	$series = $_POST['series'];
	$room = $_POST['room'];
	$bed = $_POST['bed'];
	$insert_hostel = $id;

	if (empty($series) || empty($room) || empty($bed)){
	echo '<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Hello</strong>You must define Series, Number of rooms and number of bed spaces/room</div>'; 
	exit; 
}

	if (is_nan($series) || is_nan($room) || is_nan($bed)){
	echo '<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Hello</strong> Invalid Field Input</div>'; exit;

	}

	if(($room*5) < 1 || ($bed*5) < 1){
	echo '<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">*</button>
		<strong>Hello</strong>Negative Values detected. Please check and confirm input. </div>'; exit;

}

// CHECK IF BED SPACE IS ALREADY CREATED
// IF THE SERIES HE SELECT IS ONE, WE COUNT AND SEE IF HOSTEL SERIES IS CREATED
$report = $kas_framework->countRestrict2('hostels_bed_space', 'series', $series, 'hostel', $id);

if($report >= 1){
echo '<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">*</button>
		<strong>Out of idea!</strong> This series has already been created. You can only add rooms to it. click on Add bedspace when you go back</div>';
		exit;
}

// how many bed space are we creating
// bed*room 

// fro room = 1-30 
// add room 1-30 number of bed space times
$counter = 0;
for ($bedn = 1; $bedn<= $bed; $bedn++){
// bed space 1 = A, bed space2 = B = $bedn
	for ($roomn = 1; $roomn<= $room; $roomn++){
		$go = "INSERT INTO hostels_bed_space(name,hostel,series,room) VALUES('$bedn', '$insert_hostel', '$series', '$roomn' )";
		$dbh_go = $dbh->prepare($go); $checkExec = $dbh_go->execute(); 
		if ($checkExec) { $counter = $counter + 1; }
	}
	$dbh_go = null;

} // end number of bed space
	if($counter >= 1){
		echo '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Good Job!</strong> Bed Space/Rooms created in the defined series. Click on View bed spaces to manage each bed spaces</div>';
	}
 }// end creation of bed space form?>

<?php 
// process the fee here

if(isset($_POST['setfee'])){
	$f = $_POST['f'];
	$s = $_POST['s'];
	$t = $_POST['t'];

if(($f*5) < 1 || ($s*5) < 1 || ($t*5) < 1){
	echo '<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Hello</strong>You are looking for big trouble, creating nagative price </div>'; exit;

}
//

/// process first term
	$ck1 = "SELECT term FROM hostels_fees WHERE session='$current_year' AND term = '1' AND hostel = '$id'";
	$dbh_ck1 = $dbh->prepare($ck1); $dbh_ck1->execute(); $rowCount = $dbh_ck1->rowCount(); $dbh_ck1 = null;
		if($rowCount > 0) {
			$process1 = "UPDATE hostels_fees SET fee ='$f' WHERE session='$current_year' AND term = '1' AND hostel = '$id'";
			$dbh_process1 = $dbh->prepare($process1); $dbh_process1->execute(); $dbh_process1 = null;
		} else {
		// insert
			$process1 = "INSERT INTO hostels_fees(session,term,hostel,fee) VALUES('$current_year','1','$id','$f')";
			$dbh_process1 = $dbh->prepare($process1); $dbh_process1->execute(); $dbh_process1 = null;
		}

/// process second term
	$ck2 =$db->get_var("SELECT term FROM hostels_fees WHERE session='$current_year' AND term = '2' AND hostel = '$id'");
	$dbh_ck2 = $dbh->prepare($ck2); $dbh_ck2->execute(); $rowCount2 = $dbh_ck2->rowCount(); $dbh_ck2 = null;
		if($rowCount2 > 0){
			$process2 = "UPDATE hostels_fees SET fee ='$s' WHERE session='$current_year' AND term = '2' AND hostel = '$id'";
			$dbh_process2 = $dbh->prepare($process2); $dbh_process2->execute(); $dbh_process2 = null;
		} else {
		// insert
			$process2 = "INSERT INTO hostels_fees(session,term,hostel,fee) VALUES('$current_year','2','$id','$s')";
			$dbh_process2 = $dbh->prepare($process2); $dbh_process2->execute(); $dbh_process2 = null;
		}

	/// process third term
	$ck3 = "SELECT term FROM hostels_fees WHERE session='$current_year' AND term = '3' AND hostel = '$id'";
	$dbh_ck3 = $dbh->prepare($ck3); $dbh_ck3->execute(); $rowCount3 = $dbh_ck3->rowCount(); $dbh_ck3 = null;
		if($rowCount3 > 0){
			$process3 = "UPDATE hostels_fees SET fee ='$t' WHERE session='$current_year' AND term = '3' AND hostel = '$id'";
			$dbh_process3 = $dbh->prepare($process3); $dbh_process3->execute(); $dbh_process3 = null;
		}else{
		// insert
			$process3 = "INSERT INTO hostels_fees(session,term,hostel,fee) VALUES('$current_year','3','$id','$t')";
			$dbh_process3 = $dbh->prepare($process3); $dbh_process3->execute(); $dbh_process3 = null;
		}


echo '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Good Job!</strong>Changes Saved </div>';
}// end if setfee
// retrieve old

@$fee1_SQL = "SELECT fee FROM hostels_fees WHERE session='$current_year' AND term = '1' AND hostel = '$id'";
$dbh_fee1 = $dbh->prepare($fee1_SQL); $dbh_fee1->execute(); $fetchObj1 = $dbh_fee1->fetch(PDO::FETCH_OBJ); $dbh_fee1 = null;
@$fee1 = $fetchObj1->fee;
@$fee2_SQL = "SELECT fee FROM hostels_fees WHERE session='$current_year' AND term = '2' AND hostel = '$id'";
$dbh_fee2 = $dbh->prepare($fee2_SQL); $dbh_fee2->execute(); $fetchObj2 = $dbh_fee2->fetch(PDO::FETCH_OBJ); $dbh_fee2 = null;
@$fee2 = $fetchObj2->fee;
@$fee3_SQL = "SELECT fee FROM hostels_fees WHERE session='$current_year' AND term = '3' AND hostel = '$id'";
$dbh_fee3 = $dbh->prepare($fee3_SQL); $dbh_fee3->execute(); $fetchObj3 = $dbh_fee3->fetch(PDO::FETCH_OBJ); $dbh_fee3 = null;
@$fee3 = $fetchObj3->fee;


if(isset($_GET['settings'])){

if(isset($_POST['doset'])){
// process the setting form
  $loc = $_POST['location'];
 $t = $_POST['type'];
 $x = $_POST['sex'];
 $st = $_POST['status'];
 $re = $_POST['re'];
 $ab = $_POST['ability'];
 $fac = $_POST['fac'];
// $img = $_FILES['image']['name'];


$insert_into_hostel = "UPDATE hostels SET location = '$loc', open_status='$st', reserve_status='$re', occupant_sex='$x', hostel_type= '$t', hostel_grade = '$fac', ability_type ='$ab' WHERE id = '$id'";
$dbh_insert_into_hostel = $dbh->prepare($insert_into_hostel); $checkExecuted = $dbh_insert_into_hostel->execute(); $dbh_insert_into_hostel = null;
	if($checkExecuted){
		echo '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">*</button>
				<strong>Great Job!</strong> Hostel was updated succesfully, please select to manage and add rooms/bed spaces to this hostel.
			</div>';
	} else {
		echo '<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Something is wrong!</strong> Hostel cannot be updated at this time.
		</div>';
	}

}
// retrieve the settingf data
//instead of executing 10 get Vars function and overload the database, we run them once and be safe

$gethostelDetails = "SELECT * FROM hostels WHERE id = '".$id."'";
$dbh_gethostelDetails = $dbh->prepare($gethostelDetails); $dbh_gethostelDetails->execute(); $fetchObj_hostel = $dbh_gethostelDetails->fetch(PDO::FETCH_OBJ); $dbh_gethostelDetails = null;

@$hname = $fetchObj_hostel->name;
@$hlocation = $fetchObj_hostel->location;
@$hopen = $fetchObj_hostel->open_status;
@$hreserve = $fetchObj_hostel->reserve_status;
@$hsex = $fetchObj_hostel->occupant_sex;
@$htype = $fetchObj_hostel->hostel_type;
@$himage = $fetchObj_hostel->hostel_image_url;
@$hgrade = $fetchObj_hostel->hostel_grade;
@$hability = $fetchObj_hostel->ability_type;

	if($himage==NULL){
		$himage = 'hostels.png';
	}
}

 if(!isset($_POST['creation'])){?>

<?php if(isset($_GET['tools'])){?>
<hr />
<strong>Create Series in this Hostel along with rooms and bed spaces
</strong><br />
	<form class="form-horizontal" action="" method="post">
		<input type="hidden" name="creation" value="yes" />
			<fieldset>
			  
				<div class="control-group">
				<label class="control-label" for="sex">Rooms/Space Series</label>
				<div class="controls">
				  <select id="series" name="series" data-rel="chosen">
				  <option> </option>
					<option value="1">100 Series</option>
					<option value="2">200 Series</option>
					<option value="3">300 Series</option>
					<option value="4">400 Series</option>
				  </select>
				</div>
			  </div>
			  
				 
			  <div class="control-group">
				<label class="control-label" for="hostel">Number of Rooms</label>
				<div class="controls">
				  <input class="input-large focused" name="room" id="room" type="number" placeholder="eg 30"> how many rooms are in this series
				</div>
			  </div>
			  
			   <div class="control-group">
				<label class="control-label" for="hostel">Number of Bed Spaces</label>
				<div class="controls">
				  <input class="input-large focused" name="bed" id="room" type="number" placeholder="eg 4 or 6"> how many bed spaces are in each room? <i>Dont worry if a particular room has more or less bed spaces, you can delete it or add.</i>
				</div>
			  </div>
			  
				
			 <div class="form-actions">
				<button type="submit" class="btn btn-primary">Create my Hostel Series</button>
				<a href="modules?controller=myhostel&myhome=<?php echo $id;?>"><button type="button" class="btn">Cancel</button></a>
			</div>
			</fieldset>
 </form>


	<?php } // tools is set 
	} // post creation is set is set 
	
// lets set the fees
if(isset($_GET['setfee'])){ ?>

SET HOSTEL FEE FOR THIS TERM/SESSION <a href="year_simulator" target="_blank">Change? </a>
<br />

	<form class="form-horizontal" action="" method="post">
	<input type="hidden" name="setfee" value="yes" />
	<fieldset>
	  
	<div class="input-prepend input-append">
	First Term&nbsp;&nbsp;<span class="add-on">N</span><input name="f" value="<?php echo @$fee1;?>" id="first" size="5" type="number"><span class="add-on">.00</span>
	</div>							  
	<br />

	<div class="input-prepend input-append">
	Second Term&nbsp;&nbsp;<span class="add-on">N</span><input name="s" value="<?php echo @$fee2;?>" id="second" size="5" type="number"><span class="add-on">.00</span>
	</div><br />

	<div class="input-prepend input-append">
	Third Term&nbsp;&nbsp;<span class="add-on">N</span><input name="t" id="third" value="<?php echo @$fee3;?>" size="5" type="number"><span class="add-on">.00</span>
	</div>
		 
	 <div class="form-actions">
		<button type="submit" class="btn btn-primary">Save Changes</button>
		<a href="modules?controller=myhostel&myhome=<?php echo $id;?>"><button type="button" class="btn">Cancel</button></a>
	</div>
	</fieldset>
 </form>

<?php }?>

<!-- include anotother form here-->
<?php 

if(isset($_GET['settings'])){?>

Update The Hostel Settings<br />
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="doset" value="yes" />
		<fieldset>
		  
		  <div class="control-group">
			<label class="control-label" for="hostel">Hostel Name</label>
			<div class="controls">
			  <input class="input-xlarge focused" name="hostel" id="hostel" value="<?php echo $hname;?>" type="text" disabled="disabled" placeholder="cannot change">
			</div>
		  </div>
		  
		   <div class="control-group">
			<label class="control-label" for="location">Hostel Location</label>
			<div class="controls">
			  <input class="input-xlarge focused" name="location" id="location" value="<?php echo $hlocation;?>" type="text" placeholder="Hostel address">
			</div>
		  </div>
		  
		   <div class="control-group">
			<label class="control-label" for="type">Hostel Type</label>
			<div class="controls">
			  <select id="type" name="type">
		 <?php $kas_framework->getallFieldinDropdownOption('hostels_tbl_types', 'name', 'id') ?>
				
			  </select> &raquo;<i><?php echo $types = $db->get_var("SELECT name FROM `hostels_tbl_types` WHERE `id` = '$htype'");?> </i>
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="control-label" for="sex">Occupant Sex</label>
			<div class="controls">
			  <select id="sex" name="sex" data-rel="chosen">
			  <option> </option>
				<option value="m" <?php if($hsex=='m'){echo 'selected="selected"';}?>>Boys</option>
				<option value="f" <?php if($hsex=='f'){echo 'selected="selected"';}?>>Girls</option>
				<option value="b" <?php if($hsex=='b'){echo 'selected="selected"';}?>>Both</option>
			  </select>
			</div>
		  </div>
		  
			<div class="control-group">
			<label class="control-label" for="status">Allocation STATUS</label>
			<div class="controls">
			  <select id="status" name="status" data-rel="chosen">
				<option value="1" <?php if($hopen==1){echo 'selected="selected"';}?>>Open</option>
				<option value="0" <?php if($hopen==0){echo 'selected="selected"';}?>>Closed</option>
			  </select>
			</div>
		  </div>
		   
		   <div class="control-group">
			<label class="control-label" for="reserve">RESERVATION STATUS</label>
			<div class="controls">
			  <select id="reserve" name="re" data-rel="chosen" >
				<option value="0" <?php if($hreserve==0){echo 'selected="selected"';}?>>Available</option>
				<option value="1" <?php if($hreserve==1){echo 'selected="selected"';}?>>Reserved</option>
			  </select>
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="control-label" for="ability">Occupants  Ability</label>
			<div class="controls">
			  <select id="ability" name="ability" data-rel="chosen">
			  
			  <?php $kas_framework->getallFieldinDropdownOption('hostels_tbl_ability', 'description', 'id') ?>
			  </select>&raquo;<i><?php echo $abiii = $kas_framework->getValue('description', 'hostels_tbl_ability', 'id', $hability);?> </i>
			</div>
		  </div>
		  
		   <div class="control-group">
			<label class="control-label" for="faculty">Occupants  Faculty</label>
			<div class="controls">
			  <select id="fac" name="fac" data-rel="chosen" >
				<option value="0">ALL Faculty</option>
		 <?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id') ?>

			  </select>&raquo;<i><?php echo $gradee = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $hgrade); ?>  </i>
			</div>
		  </div>
		  
			<div class="control-group">
			<label class="control-label" for="fee">Hostel Fee</label>
			<div class="controls">
			  <div class="input-prepend input-append">
				<span class="add-on">N</span><input id="" disabled="disabled" name="fee" size="" type="number"><span class="add-on">.00</span>
			  </div>
			</div>
		  </div>
		  
		<div class="control-group">
			<label class="control-label">Hall image</label>
			<div class="controls">
			  <input type="file" name="image"> <img src="../../files/images/<?php echo $himage;?>" />
			</div>
		</div>
		
		
		 <div class="form-actions">
			<button type="submit" class="btn btn-primary">Update Hostel</button>
			<a href="modules?controller=myhostel&myhome=<?php echo $id;?>"><button type="button" class="btn">Cancel</button></a>
		</div>
		</fieldset>
 </form> 


<?php }// end settings ?>

<div align="right">
<a href="modules?controller=myhostel&myhome=<?php echo $id;?>&tools=bed_space" class="btn btn-success" >Create Series</a> 

<a href="modules?controller=myhostel&myhome=<?php echo $id;?>&setfee=true" class="btn btn-success" >Set Fees</a> 
<a href="modules?controller=myhostel&myhome=<?php echo $id;?>&settings=true" class="btn btn-success" >Settings</a> 
</div>

<br /><br />
		
 <table class="table table-striped table-bordered bootstrap-datatable " width="100%">
	<thead>
	  <tr>
		<th width="3%">Type</th>
		<th width="4%"><a href="#" title="Number of series defined">Series</a></th>
		<th width="4%">Grade</th>
		<th width="3%"> Sex </th>
		<th width="5%">Capacity</th>
		<th width="6%">Occupants</th>
		<th width="5%">Available space </th>
		<th width="47%">Hostel Detail <i class="icon icon-color icon-arrow-n-s"></i><i class="icon icon-color icon-arrow-n-s"></i></th>
		<th width="14%">Term 1 </th>
		<th width="14%">Term 2 </th>
		<th width="14%">Term 3</th>
		<th width="5%"> <a href="#" title="If hostel is reserved for a perticular group">Reserve </a></th>
		<th width="4%"><a href="#" title="When closed, no one will be allocated to this hostel">Status</a></th>
	  </tr>
	</thead>
	<tbody>
       
	   <?php	
			   $gethostelSQL = "SELECT * FROM hostels WHERE id = '".$id."'";
				$dbh_gethostelSQL = $dbh->prepare($gethostelSQL); $dbh_gethostelSQL->execute(); $fetchObj_h = $dbh_gethostelSQL->fetch(PDO::FETCH_OBJ); $dbh_gethostelSQL = null;

						$name = $fetchObj_h->name;
						$location = $fetchObj_h->location;
                         $o_status = $fetchObj_h->open_status;
						 $r_status = $fetchObj_h->reserve_status;
						 $sex = $fetchObj_h->occupant_sex;
						 $typeid = $fetchObj_h->hostel_type;
						 $picture = $fetchObj_h->hostel_image_url;
						 $gradeid = $fetchObj_h->hostel_grade;
						$ability = $fetchObj_h->ability_type;
			if($gradeid == 0){
				$gradeid = 'All';
			}
						//get the idiot username from web_students
				
					//	the status for closed or open
                     if($o_status == 1){
						$o_status = '<span class="label label-success">Open</span>';
					 } else if ($o_status == 0){
						$o_status = '<span class="label label-important">Closed</span>';
					} else {
					 $o_status = '<span class="label label-info">Unknown</span>';}
				
				//	the status for reserved or not
                     if($r_status ==1){
						$r_status = '<span class="label label-info">Reserved</span>';
					 } else if($r_status == 0){
						$r_status = '<span class="label label-success">Available</span>';
					} else {
						$r_status = '<span class="label label-important">Unknown</span>';}
				
                    if($sex =='m'){
					 $sex = '<span class="label label-info">Male</span>';
					} else if ($sex == 'f'){
					 $sex = '<span class="label label-success">Female</span>';
					} else {
					 $sex = '<span class="label label-important">Both</span>';}
				// the hostel image
			if($picture==NULL){
				$picture = 'hostels.png';
			}
// the hostel type
$type= $kas_framework->getValue('name', 'hostels_tbl_types', 'id', $typeid);//we can also use stdbio_id
// count number of series: select the highest series defined in bed space tables
$series_SQL = "SELECT MAX(series) AS series FROM `hostels_bed_space` WHERE `hostel` = '$id'";
$dbh_series = $dbh->prepare($series_SQL); $dbh_series->execute(); $fetchObj_S = $dbh_series->fetch(PDO::FETCH_OBJ); $dbh_series = null;
$series = $fetchObj_S->series;

	if($series == 0){
		$series = '1`';
	}

// Count the hostel capacity
$capacity = $kas_framework->countRestrict1('hostels_bed_space', 'hostel', $id);

 $jount_countin = "SELECT COUNT(*) AS cntr FROM hostels_allocation a JOIN hostels_bed_space b ON (a.bed_space = b.id) WHERE b.hostel = '$id' AND a.session ='$current_year' AND a.term = '$current_term'";
$dbh_jount_countin = $dbh->prepare($jount_countin); $dbh_jount_countin->execute(); $fetchObj_ht = $dbh_jount_countin->fetch(PDO::FETCH_OBJ); $dbh_jount_countin = null;
$occupants = $fetchObj_ht->cntr;
// count avalabe space: just capacity - ocupant
$av_space = $capacity-$occupants;

@$fee1_SQL1 = "SELECT fee FROM hostels_fees WHERE session='$current_year' AND term = '1' AND hostel = '$id'";
$dbh_fee11 = $dbh->prepare($fee1_SQL1); $dbh_fee11->execute(); $fetchObj11 = $dbh_fee11->fetch(PDO::FETCH_OBJ); $dbh_fee11 = null;
@$fee1 = $fetchObj11->fee;
@$fee2_SQL1 = "SELECT fee FROM hostels_fees WHERE session='$current_year' AND term = '2' AND hostel = '$id'";
$dbh_fee22 = $dbh->prepare($fee2_SQL1); $dbh_fee22->execute(); $fetchObj22 = $dbh_fee22->fetch(PDO::FETCH_OBJ); $dbh_fee22 = null;
@$fee2 = $fetchObj22->fee;
@$fee3_SQL1 = "SELECT fee FROM hostels_fees WHERE session='$current_year' AND term = '3' AND hostel = '$id'";
$dbh_fee33 = $dbh->prepare($fee3_SQL1); $dbh_fee33->execute(); $fetchObj33 = $dbh_fee33->fetch(PDO::FETCH_OBJ); $dbh_fee33 = null;
@$fee3 = $fetchObj33->fee;

if(!$fee1){$fee1 = "<a href='#'>set</a>";}else{$fee1 = 'N'.number_format($fee1).'.00';}
if(!$fee2){$fee2 = "<a href='#'>set</a>";}else{$fee2 = 'N'.number_format($fee2).'.00';}
if(!$fee3){$fee3 = "<a href='#'>set</a>";}else{$fee3 = 'N'.number_format($fee3).'.00';}

  ?>
		 
		  <tr>
			<td class="center"><?php echo $type;?> </td>
            <td class="center"> <?php echo $series;?></td>
            <td class="center"><span style="margin-right:10px"><?php echo $gradeid;?></span></td>
            <td class="center"><?php echo $sex;?></td>
            <td class="center"><strong><?php echo $capacity;?></strong></td>
            <td class="center"><strong><?php echo $occupants;?></strong></td>
            <td class="center"><span style="margin-right:10px"><strong><?php echo $av_space;?></strong></span></td>
            <td class="center"><div id="" align="left"> <a href="../../files/images/<?php echo $picture;?>" title="Image of <?php echo $name;?>" class="fancybox fancybox.image" ></img></a>
                <span style="margin-right:10px">Location:&raquo;<?php echo $location;?>&nbsp;&nbsp; </span>
              <div align="" style="margin-right:10px"><a href="../../files/images/<?php echo $picture;?>" title="Image of <?php echo $name;?>" class="fancybox fancybox.image" ><img id="admission" title="" src="../../files/images/<?php echo $picture;?>" alt ="No Image" style=" width:30%; height:30%;" align="" /></a><br />
              </div>
			</div> </td>
            <td class="center"><?php echo $fee1;?></td>
            <td class="center"><?php echo $fee2;?></td>
            <td class="center"><?php echo $fee3;?></td>
            <td class="center"><?php echo $r_status;?></td>
            <td class="center"><a title="" class="btn btn-success" href="">  <?php echo $o_status;?></a></td>
          </tr>
        </tbody>
 </table>	
	  <a id="all"> </a>
	<br />
	
	<div align="right">
<a href="modules?controller=myhostel&myhome=<?php echo $id;?>&config=bed_space_view#all" class="btn btn-info" >View Bed Spaces</a> 
<a href="modules?controller=myhostel&myhome=<?php echo $id;?>&add=bed_space#space" class="btn btn-info" >Add Bed Spaces</a> 
<a href="modules?controller=myhostel&myhome=<?php echo $id;?>&add_room=new#space" class="btn btn-info" >Add a room</a> 

<a href="modules?controller=myhostel&myhome=<?php echo $id;?>&occupants=view#all" class="btn btn-info" >Occupants</a> 
<a href="modules?controller=myhostel&myhome=<?php echo $id;?>&config=bed_space_view#all" class="btn btn-info" >Configuration</a> 
</div>
<?php if(isset($_GET['occupants'])){?>

<p>Bed Spaces And Occupants&raquo;<strong><?php echo $title;?></strong></p>


<table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr>
            <th width="4%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="9%">Series</th>
            <th width="4%">Room</th>
            <th width="9%"><a href="#" title="Number of series defined">Bed spaces </a></th>
            <th width="46%">Occupant's Details <i class="icon icon-color icon-arrow-n-s"></i><i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="6%">Roommates</th>
            <th width="5%">Action</th>
            <th width="4%">Delete</th>
          </tr>
        </thead>
        <tbody>
         
		      <?php 
// loop the occupants out
 $jount_count = "SELECT * FROM hostels_allocation a JOIN hostels_bed_space b ON (a.bed_space = b.id) WHERE b.hostel = '$id' AND a.session ='$current_year' AND a.term = '$current_term'";
$dbh_jount_count= $dbh->prepare(jount_count); $dbh_jount_count->execute();

//echo mysql_num_rows($jount_count);
$sn=0;
	while ($loopthem = $dbh_jount_count->fetch(PDO::FETCH_ASSOC)) {
			$sn = $sn + 1;
			$series = $loopthem['series'];

		$student_id = $loopthem['student'];
		$room = $loopthem['room'];
		$our_room = $loopthem['room'];
			if(strlen($room) == 1){
				$room = $series."0".$room;
			} else {
				$room =$series.$room;
			}
									
			$bed_space = $loopthem['name'];
			
			if($bed_space == 1){
			$bed_space = "A(".$bed_space.")";
			}elseif($bed_space == 2){
			$bed_space = "B(".$bed_space.")";
			}elseif($bed_space == 3){
			$bed_space = "C(".$bed_space.")";

			}elseif($bed_space == 4){
			$bed_space = "D(".$bed_space.")";

			}elseif($bed_space == 5){
			$bed_space = "E(".$bed_space.")";

			}elseif($bed_space == 6){
			$bed_space = "F(".$bed_space.")";

			}else{
			$bed_space = "--(".$bed_space.")";

			}
			 $date_pd = $loopthem['date_pd'];
			
			
			 $status = $loopthem['status'];
			 $paid = $loopthem['paid'];
					 
	if ($paid == 1){
		$paid = '<font color="green">Payment Collected </font>';
	}else{
		$paid = '<font color="red">Pending Payment </font>';
	}

	if ($status == 1){
		$lstatus = '<font color="green">Living in room</font>';
	} else {
		$lstatus = '<font color="red">Vacated (by admin) </font>';
	}

$catch_user_name = $kas_framework->getValue('user_n', 'web_students', 'stdbio_id', $student_id);

//limit the databse hit counter: reduce the getVar functions
$geStudentDetails = "SELECT * FROM studentbio WHERE studentbio_id='".$student_id."'";
$dbh_geStudentDetails = $dbh->prepare($geStudentDetails); $dbh_geStudentDetails->execute(); $fetchObj__std = $dbh_geStudentDetails->fetch(PDO::FETCH_OBJ); $dbh_geStudentDetails = null;

$catch_user_fname = $fetchObj__std->studentbio_fname;
$catch_user_mname =$fetchObj__std->studentbio_mname;
$catch_user_lname =$fetchObj__std->studentbio_lname;
$mypicture=$fetchObj__std->studentbio_pictures; //we can also use stdbio_id
	
	if($mypicture==NULL){
		$mypicture = 'avatar_default.png';
	}

	$std_grade_yr_SQL = "SELECT student_grade_year_grade FROM student_grade_year WHERE student_grade_year_student='$student_id' AND student_grade_year_year = '$current_year'";//
		$dbh_std_grade_yr = $dbh->prepare($std_grade_yr_SQL); $dbh_std_grade_yr->execute(); $fetchObj_sgy = $dbh_std_grade_yr->fetch(PDO::FETCH_OBJ); $dbh_std_grade_yr = null;
		$std_grade_yr = $fetchObj_sgy->student_grade_year_grade;
	// so what is his grade now
		$std_grade = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $std_grade_yr);
	// what if the guy is graduate
		if($std_grade==NULL){$std_grade='<u>Graduate</u>';}
?> 

	  <tr>
		<td><?php echo $sn;?></td>
		<td class="center"><?php echo $series.'00';?></td>
		<td class="center"><?php echo $room;?></td>
		<td class="center"><?php echo $bed_space;?></td>
		<td class="center"><div id="" align="left"> 
			<span style="margin-right:10px">Name:&raquo;&nbsp;<strong><?php echo $catch_user_lname.', '.$catch_user_fname.' '.$catch_user_mname;?></strong> &nbsp; Grade:&raquo;&nbsp;<strong><?php echo $std_grade;?></strong> &nbsp;Since:<strong>&raquo;</strong> </span>
			<?php echo $date_pd;?>
			<div align="" style="margin-right:10px"><a href="../../pictures/<?php echo $mypicture;?>" title="Image of <?php echo $catch_user_mname;?>" class="fancybox fancybox.image" ><img id="admission" title="" width="70" height="95" src="../../pictures/<?php echo $mypicture;?>" alt ="No Image" align="" /></a><br />
		username: <i> <?php echo $catch_user_name;?></i>  <strong>Status:</strong>fee:<?php echo $paid;?>. ____<strong><?php echo $lstatus;?></strong></div>
		</div> </td>
		<td class="center">
			<?php 
			
			$loopmates = "SELECT student,bed_space FROM `hostels_allocation` a JOIN hostels_bed_space b ON (a.bed_space = b.id) WHERE b.hostel = '$id' AND a.session ='$current_year' AND a.term = '$current_term' AND b.room = '$our_room'";
			$dbh_loopmates = $dbh->prepare($loopmates); $dbh_loopmates->execute();
			while($roomates =$dbh_loopmates->fetch(PDO::FETCH_ASSOC)) {
					$mate_id = $roomates['student'];
					$mate_bed_id = $roomates['bed_space'];
					
					$mate_pace = $kas_framework->getValue('name', 'hostels_bed_space', 'id', $mate_bed_id);
					// make the mates space alphabet
					if($mate_pace == 1){
						$mate_pace = "A(".$mate_pace.")";
					} elseif($mate_pace == 2){
						$mate_pace = "B(".$mate_pace.")";
                    } elseif($mate_pace == 3){
						$mate_pace = "C(".$mate_pace.")";
					} elseif($mate_pace == 4){
						$mate_pace = "D(".$mate_pace.")";
					} elseif($mate_pace == 5){
						$mate_pace = "E(".$mate_pace.")";
					} elseif($mate_pace == 6){
						$mate_pace = "F(".$mate_pace.")";
					}else{
						$mate_pace = "--(".$mate_pace.")";
					}

				$mate_user_n =$kas_framework->getValue('user_n', 'web_students', 'stdbio_id', $mate_id);
				
				$getStd_SQL = "SELECT  FROM studentbio WHERE studentbio_id='".$mate_id."'";
				$dbh_getStd_SQL = $dbh->prepare($getStd_SQL); $dbh_getStd_SQL->execute(); $fetchObj_stdbio = $dbh_getStd_SQL->fetch(PDO::FETCH_OBJ); $dbh_getStd_SQL = null;
				
				$mate_user_fname = $fetchObj_stdbio->studentbio_fname;
				$mate_user_mname = $fetchObj_stdbio->studentbio_mname;
				$mate_user_lname = $fetchObj_stdbio->studentbio_lname;
				$matepicture= $fetchObj_stdbio->studentbio_pictures;//we can also use stdbio_id
					if($matepicture==NULL){
						$matepicture = 'avatar_default.png';
					}
			?>
			
			<p><a href="main?page=view_users&id=<?php echo $mate_id;?>" target="_blank" title="<?php echo $mate_user_lname.', '.$mate_user_fname.' '.$mate_user_mname.'(space:'.$mate_pace.')';?>"><img src="../../pictures/<?php echo $matepicture;?>" width="40" height="60" /><?php echo $mate_user_n;?> </a> </p>
           
			  <?php }
				$dbh_loopmates = null;
			 ?>

			</td>
            <td class="center"><a onclick="alert('Na, to vacate the student before time, please use a cane!');"  title="Log the student out of this room"class="btn btn-info" href=""> Vacate</a><br /> </td>
            <td class="center"> <a title="" onclick="alert('Na, student seem to be saying no!');" class="btn btn-danger" href="#"> <i class="icon-trash icon-white"></i>  </a> </td>
          </tr>
		  
		  <?php }
			$dbh_jount_count = null;
		  ?>
        </tbody>
 </table>	

<?php }// end view bed spacws?>

<a id="space"> </a>
<?php if(isset($_GET['add_room'])){?>
	<br /><br /><br /><strong>Add a new room to this hostel</strong><BR />
	<form action="" method="post">
	<input type="hidden" name="addroom" value="yes" /><fieldset>
	<?php 
		$series_SQL = "SELECT MAX(series) AS series FROM `hostels_bed_space` WHERE `hostel` = '$id'";
		$dbh_series_h = $dbh->prepare($series_SQL); $dbh_series_h->execute(); $fetchObj_sh = $dbh_series_h->fetch(PDO::FETCH_OBJ); $dbh_series_h = null;
		$series_h = $fetchObj_sh->series;
			echo 'Series:<fieldset><select name="seriesh">';
			
			for($is = 1; $is<= $series_h; $is++){
				echo '<option value="'.$is.'">'.$is.'00 Series</option>';
			}
		echo '</select>';
	?>
	<br />
	Number of Roooms to add:<input type="number" name="rooms" value="1" disabled="disabled" /><br />
	Number of Bed spaces<input type="number" name="spaces" value="" /><i>Kindly note that you should create series before adding room if needed </i>

		<div class="form-actions">
				<button type="submit" class="btn btn-primary">Add Room</button>
				<a href="modules?controller=myhostel&myhome=<?php echo $id;?>"><button type="button" class="btn">Cancel</button></a>
		</div>
	</fieldset>
 </form> 
	<?php
	// process the form 
	if(isset($_POST['addroom'])) {
		$post_ser = $_POST['seriesh'];
		//$post_room = $_POST['rooms'];
		$post_space = $_POST['spaces'];
		if($post_space <=0){
			echo '<font color="red">Bad Job! looking for my trouble, trying to create -ve rooms </font>';exit;
			}
		// validate and create the rooms here
		$last_room_SQL = "SELECT MAX(room) AS room FROM `hostels_bed_space` WHERE `hostel` = '$id' AND series = '$post_ser'";
		$dbh_last_room = $dbh->prepare($last_room_SQL); $dbh_last_room->execute(); $fetchObj_room = $dbh_last_room->fetch(PDO::FETCH_OBJ); $dbh_last_room = null;
		$last_room = $fetchObj_room->room;
		$next_room  =($last_room + 1);
		
		for ($ins = 1; $ins<=$post_space; $ins++){
			$process_ = "INSERT INTO hostels_bed_space(name,hostel,series,room) VALUES ('$ins', '$id', '$post_ser', '$next_room')";
			$dbh_process_ = $dbh->prepare($process_); $chkEx = $dbh_process_->execute(); $dbh_process_ = null;
		}
		if($chkEx){
			echo '<font color="green">Great! Room created succesfully</font>';
		} else {
			echo '<font color="red">Too bad! Something is wrong </font>';
		}

	}
 }// end addroom is set ?>

<?php if(isset($_GET['add'])){?>
<br /><br /><br /><strong>Add a bed space to a particular room</strong><BR />
<form action="" method="post">
<input type="hidden" name="addbed" value="yes" />

<?php 
$series_h_SQL = "SELECT MAX(series) FROM `hostels_bed_space` WHERE `hostel` = '$id'";
$dbh_series_h = $dbh->prepare($series_h_SQL); $dbh_series_h->execute(); $fetchObj_hl = $dbh_series_h->fetch(PDO::FETCH_OBJ); $dbh_series_h = null;
		$series_h = $fetchObj_hl->room;
echo 'Series:<fieldset><select name="seriesh">';

	for ($is = 1; $is<= $series_h; $is++){
		echo '<option value="'.$is.'">'.$is.'00 Series</option>';
	}
	echo '</select>';
	
$rooms_h_sq = $db->get_var("SELECT MAX(room) FROM `hostels_bed_space` WHERE `hostel` = '$id'");
$dbh_rooms_h_sq = $dbh->prepare($rooms_h_sq); $dbh_rooms_h_sq->execute(); $fetchObj_r = $dbh_rooms_h_sq->fetch(PDO::FETCH_OBJ); $dbh_rooms_h_sq = null;
		$rooms_h = $fetchObj_r->room;
		
echo 'Room:<select name="roomh">';

for($isi = 1; $isi<= $rooms_h; $isi++){
	echo '<option value="'.$isi.'">x'.$isi.'</option>';
}
echo '</select><br><i>Note: x means series, so if you choose 100 series and choose x1, it means 100 series room x1= room 101, x9 = 109, x11 = 111 and so on</i><br>';



if(isset($_POST['addbed'])){
	$post_ser = $_POST['seriesh'];
	$post_room = $_POST['roomh'];
	// check if the room choosen exist in that series
	$test_room = $kas_framework->getValue('room', 'hostels_bed_space', 'series', $post_ser);
	
	if($test_room > 0){
	// check for the available name
	$max_bed_SQL = "SELECT MAX(name) AS nameM FROM `hostels_bed_space` WHERE `hostel` = '$id' AND series = '$post_ser' AND room = '$post_room'";
	$dbh_max_bed = $dbh->prepare($max_bed_SQL); $dbh_max_bed->execute(); $fetchObj_bdMax = $dbh_max_bed->fetch(PDO::FETCH_OBJ); $dbh_max_bed = null;
	$max_bed = $fetchObj_bdMax->nameM;
	
	$av_space = ($max_bed + 1);

	$insert_space = "INSERT INTO hostels_bed_space(hostel,series,name,room) VALUES('$id', '$post_ser', '$av_space', '$post_room')";
	$dbh_insert_space = $dbh->prepare($insert_space); $chIns = $dbh_insert_space->execute(); $dbh_insert_space = null;

	if ($chIns) {
		echo '<font color="green">Great! Bed Space created </font>';
	} else {
		echo '<font color = "red"> Too bad, something is not right</font>';
	}

	} else {
		echo '<font color = "red"> Out of idea, the room selected does not exist in that series</font>';
	}
}
?>
			
	 <div class="form-actions">
		<button type="submit" class="btn btn-primary">Add Bed Space</button>
		<a href="modules?controller=myhostel&myhome=<?php echo $id;?>"><button type="button" class="btn">Cancel</button></a>
	</div>
	</fieldset>
 </form> 

<?php }?>


<?php if(isset($_GET['config'])){?>
<strong>HOSTEL BED SPACE CONFIGURATION</strong><BR /><i> To see only room 101, type 101 in the search box</i><BR />


<table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr>
            <th width="3%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="7%">Bed  </th>
            <th width="6%"><a href="#" title="Number of series defined">Room</a></th>
            <th width="6%"><a href="#" title="Number of series defined">Series</a></th>
            <th width="7%">Type</th>
            <th width="7%">Age  </th>
            <th width="8%"> <a href="#" title="If hostel is reserved for a perticular group">Reserve </a></th>
            <th width="8%"><a href="#" title="When closed, no one will be allocated to this hostel">Status</a></th>
            <th width="6%">Grade</th>
            <th width="7%">vacancy</th>
            <th width="5%">Sex</th>
            <th width="10%">Ability</th>
            <th width="14%">Action</th>
            <th width="6%">Delete</th>
          </tr>
        </thead>
        <tbody>
         <?php 
		 
		 	$pull_bed = "SELECT * FROM hostels_bed_space WHERE hostel = '$id'";
					$dbh_pull_bed = $dbh->prepare($pull_bed); $dbh_pull_bed->execute();
						$sn = 0;
						// gather all the hostel db details
						while ($listbd = $dbh_pull_bed->fetch(PDO::FETCH_ASSOC)) {
                        $sn = $sn + 1;
						$space_id = $listbd['id'];
						$spname = $listbd['name'];
		 			     $spseries = $listbd['series'];
						$sproom = $listbd['room'];
						
						$spage = $listbd['override_age'];//
						$spopen = $listbd['override_open_status'];
						$spreserve = $listbd['override_reserve_status'];
						$spsex = $listbd['overide_sex'];
						$spgrade = $listbd['override_grade'];
						$sptype = $listbd['type'];
						$spability = $listbd['override_ability'];
						
						$spgrade= $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $spgrade);
						$amIvacant = $kas_framework->getValue('student', 'hostels_allocation', 'bed_space', $space_id);
						$sptype = $kas_framework->getValue('name', 'hostels_tbl_types', 'id', $sptype);
						$spability = $kas_framework->getValue('description', 'hostels_tbl_ability', 'id', $spability);

				if($spability == NULL){$spability = "Hostel's";}
				
				if($amIvacant == NULL){$amIvacant = "<font color='green'>Vacant</font>";}else{$amIvacant = "<font color='brown'>Occupied</font>";}

				if($spgrade == NULL){$spgrade = "ALL";}
					if($spsex =='m'){
						$spsex = '<span class="label label-info">Male</span>';
					 }elseif($sex == 'f'){
						$spsex = '<span class="label label-success">Female</span>';
					}elseif($spsex=='b'){
						$spsex= '<span class="label label-success">Both</span>';
					 }else{
						$spsex = '<span class="label label-important">Hostel\'s</span>';
					 }
					 
				if($spage ==0){$spage="ALL";}
				if($spopen ==0){$spopen="<font color='red'>Closed</font>";}else{$spopen="<font color='green'>Open</font>";}
				if($spreserve ==0){$spreserve="<font color='green'>Available</font>";}else{$spreserve="<font color='orange'>Reserved</font>";}

				if(strlen($sproom) == 1){$sproom = $spseries."0".$sproom;}else{
					$sproom =$spseries.$sproom;
				}
				
				if($spname == 1){
					$spname = "A(".$spname.")";
					}elseif($spname == 2){
					$spname = "B(".$spname.")";
                    }elseif($spname == 3){
					$spname = "C(".$spname.")";

					}elseif($spname == 4){
					$spname = "D(".$spname.")";

					}elseif($spname == 5){
					$spname = "E(".$spname.")";

					}elseif($spname == 6){
					$spname = "F(".$spname.")";

					}else{
					$spname = "--(".$spname.")";

					}
						
		 ?>
		 
		  <tr>
			<td><?php echo $sn;?></td>
            <td class="center"><?php echo $spname;?></td>
            <td class="center"><?php echo $sproom;?></td>
            <td class="center"><?php echo $spseries."00";?></td>
            <td class="center"><?php echo $sptype;?></td>
            <td class="center"><?php echo $spage;?></td>
            <td class="center"><?php echo $spreserve;?></td>
            <td class="center"><?php echo $spopen;?></td>
            <td class="center"><?php echo $spgrade;?></td>
            <td class="center"><?php echo $amIvacant;?></td>
            <td class="center"><?php echo $spsex;?></td>
            <td class="center"><?php echo $spability;?></td>
            <td class="center"><a  title="Change the configuration of space <?php echo $spname;?> room <?php echo $sproom;?>"class="btn btn-info fancybox fancybox.iframe" href="ajax/profile/bed_space_manager.php?id=<?php echo $space_id;?>&action=config&n=<?php echo $spname;?>&sr=<?php echo $spseries."00";?>&h=<?php echo $title;?>&t=<?php echo $sptype;?>&r=<?php echo $spreserve;?>&s=<?php echo $spopen;?>&g=<?php echo $spgrade;?>&a=<?php echo $spability;?>&ag=<?php echo $spage;?>&rm=<?php echo $sproom;?>"> <i class="icon-zoom-in icon-white"></i> Manage </a> </td>
            <td class="center"> <a title="Delete space <?php echo $spname;?> of room <?php echo $sproom;?>" class="btn btn-danger fancybox fancybox.iframe" href="ajax/profile/bed_space_manager.php?id=<?php echo $space_id;?>&action=delete&n=<?php echo $spname;?>&sr=<?php echo $spseries."00";?>&h=<?php echo $title;?>&t=<?php echo $sptype;?>&r=<?php echo $spreserve;?>&s=<?php echo $spopen;?>&g=<?php echo $spgrade;?>&a=<?php echo $spability;?>&ag=<?php echo $spage;?>&rm=<?php echo $sproom;?>"> <i class="icon-trash icon-white"></i>  </a> </td>
          </tr>
		  
		  
	<?php }
		$dbh_pull_bed = null;
	?>
        </tbody>
      </table>

<?php }?>