<?php 
$title="Hostel manager module";
// admin add, hostel types
// hostel fees

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



?>
 <?php if(!isset($_GET['action'])){?>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="modules?controller=hostels&action=add"><button type="button" class="btn btn-primary">Add New Hostel</button></a>
<?php }else{?>
<br />

<div style="margin-left:20px">
<h1> <strong>Create A new Hostel</strong></h1><br />
<div class="box-content">
<?php
 if(isset($_POST['subr'])){ /// the form is submitted
 // coect the form datas
 $hostel = $_POST['hostel'];
  $loc = $_POST['location'];
 $t = $_POST['type'];
 $x = $_POST['sex'];
 $st = $_POST['status'];
 $re = $_POST['re'];
 $ab = $_POST['ability'];
 $fac = $_POST['fac'];
 $img = $_FILES['image']['name'];




	// validate the form for competion
	$check_unigue = $kas_framework->getValue('name', 'hostels', 'name', $hostel);
	$checkIT = ($check_unigue == '')? false: true;


if(empty($hostel) || empty($loc)|| empty($x)){
echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">*</button>
							<strong>Oh snap!</strong> You must complete the form ok.
						</div>'; 
}
/*elseif(is_nan($_POST['fee'])){
echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">*</button>
							<strong>Haba!</strong> Price must be a figure na!.
						</div>';
} */elseif($checkIT === true){
echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">*</button>
							<strong>Haba!</strong> Hostel with the same name already exist, please use another name.
						</div>';

}else{
// process the form here

// upload the image

// process the form
$insert_into_hostel = "INSERT INTO hostels(name,location,open_status,reserve_status,occupant_sex,hostel_type,hostel_image_url,hostel_grade,ability_type) VALUES('$hostel','$loc','$st','$re','$x','$t','','$fac','$ab')";
$dbh_insert_into_hostel = $dbh->prepare($insert_into_hostel); $dbh_insert_into_hostel->execute(); $rowCount_Insert = $dbh_insert_into_hostel->rowCount(); $dbh_insert_into_hostel = null;
	if ($rowCount_Insert == 1) {

	echo '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Great Job!</strong> Hostel was added succesfully, please select to manage and add rooms/bed spaces to this hostel.
		</div>';

	} else {
			echo '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">*</button>
				<strong>Something is wrong!</strong> Hostel cannot be added at this time.
			</div>';
		}

	}

}
?>

	<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="subr" value="yes" />
		<fieldset>
		  
		  <div class="control-group">
			<label class="control-label" for="hostel">Hostel Name</label>
			<div class="controls">
			  <input class="input-xlarge focused" name="hostel" id="hostel" type="text" placeholder="Hostel name">
			</div>
		  </div>
		  
		   <div class="control-group">
			<label class="control-label" for="location">Hostel Location</label>
			<div class="controls">
			  <input class="input-xlarge focused" name="location" id="location" type="text" placeholder="Hostel address">
			</div>
		  </div>
		  
		   <div class="control-group">
			<label class="control-label" for="type">Hostel Type</label>
			<div class="controls">
			  <select id="type" name="type">
				<?php $kas_framework->getallFieldinDropdownOption('hostels_tbl_types', 'name', 'id'); ?>
				
			  </select>
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="control-label" for="sex">Occupant Sex</label>
			<div class="controls">
			  <select id="sex" name="sex" data-rel="chosen">
			  <option> </option>
				<option value="m">Boys</option>
				<option value="f">Girls</option>
				<option value="b">Both</option>
			  </select>
			</div>
		  </div>
		  
			<div class="control-group">
			<label class="control-label" for="status">Allocation STATUS</label>
			<div class="controls">
			  <select id="status" name="status" data-rel="chosen">
				<option value="1">Open</option>
				<option value="0">Closed</option>
			  </select>
			</div>
		  </div>
		   
		   <div class="control-group">
			<label class="control-label" for="reserve">RESERVATION STATUS</label>
			<div class="controls">
			  <select id="reserve" name="re" data-rel="chosen" >
				<option value="0">Available</option>
				<option value="1">Reserved</option>
			  </select>
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="control-label" for="ability">Occupants  Ability</label>
			<div class="controls">
			  <select id="ability" name="ability" data-rel="chosen">
			  
			  <?php $kas_framework->getallFieldinDropdownOption('hostels_tbl_ability', 'description', 'id'); ?>
			  </select>
			</div>
		  </div>
		  
		   <div class="control-group">
			<label class="control-label" for="faculty">Occupants  Faculty</label>
			<div class="controls">
			  <select id="fac" name="fac" data-rel="chosen" >
				<option value="0">ALL Faculty</option>
					<?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id'); ?>
				</select>
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
			  <input type="file" name="image">
			</div>
		  </div>
		
		
		 <div class="form-actions">
			<button type="submit" class="btn btn-primary">Create Hostel</button>
			<a href="modules?controller=hostels"><button type="button" class="btn">Cancel</button></a>
		  </div>
		</fieldset>
	  </form>
	</div>
<?php }// end add hostel form  ?>


<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>Hostels</h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
    
 <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr>
            <th width="4%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="9%">Name</th>
            <th width="4%">Type</th>
            <th width="9%"><a href="#" title="Number of series defined">Series</a></th>
            <th width="3%">Grade</th>
            <th width="3%"> Sex </th>
            <th width="46%">Hostel Detail <i class="icon icon-color icon-arrow-n-s"></i><i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="6%">Fee</th>
            <th width="6%"> <a href="#" title="If hostel is reserved for a perticular group">Reserve </a></th>
            <th width="4%"><a href="#" title="When closed, no one will be allocated to this hostel">Status</a></th>
            <th width="5%">Action</th>
            <th width="4%">Delete</th>
          </tr>
        </thead>
        <tbody>
         
		         <?php
				 
						$pullhostels = "SELECT * FROM hostels ORDER BY name DESC";
						$dbh_pullhostels = $dbh->prepare($pullhostels); $dbh_pullhostels->execute();
						
						$sn = 0;
						// gather all the hostel db details
						while ($listh = $dbh_pullhostels->fetch(PDO::FETCH_ASSOC)) {
							$sn = $sn + 1;
							$hostel = $listh['id'];
							$name = $listh['name'];
							 $location = $listh['location'];
							 $o_status = $listh['open_status'];
							 $r_status = $listh['reserve_status'];
							 $sex = $listh['occupant_sex'];
							 $type = $listh['hostel_type'];
							 $picture = $listh['hostel_image_url'];
							 $grade = $listh['hostel_grade'];
							$ability = $listh['ability_type'];


						if($grade == 0){
							$grade = 'All';
						}
						//get the idiot username from web_students
				
					//	the status for closed or open
                     if ($o_status ==1){
						$o_status = '<span class="label label-success">Open</span>';
					 } else if ($o_status == 0){
						$o_status = '<span class="label label-important">Closed</span>';
					} else {
						$o_status = '<span class="label label-info">Unknown</span>';}
				
				//	the status for reserved or not
                     if($r_status ==1){
						$r_status = '<span class="label label-info">Reserved</span>';
					 } else if ($r_status == 0){
						$r_status = '<span class="label label-success">Available</span>';
					} else {
					 $r_status = '<span class="label label-important">Unknown</span>';}
				
					 
//	the occupant sex
                     if($sex =='m'){
						$sex = '<span class="label label-info">Male</span>';
					 } else if($sex == 'f'){
						$sex = '<span class="label label-success">Female</span>';
					} else {
					 $sex = '<span class="label label-important">Both</span>';}
				// the hostel image
	if($picture == NULL){
		$picture = 'hostels.png';
	}
	
	// the hostel type
	$type = $kas_framework->getValue('name', 'hostels_tbl_types', 'id', $type);
	// count number of series: select the highest series defined in bed space tables
	$seriesSQL = "SELECT MAX(series) AS maxi FROM `hostels_bed_space` WHERE `hostel` = '$hostel'";
	$dbh_seriesSQL = $dbh->prepare($seriesSQL); $dbh_seriesSQL->execute(); $fetchObj_Series = $dbh_seriesSQL->fetch(PDO::FETCH_OBJ); $dbh_seriesSQL = null;
	$series = $fetchObj_Series->maxi;
	//$series = "count"; //mysql_num_rows($nseries);
		if($series == 0){
			$series = '1`';
		}

	// Count the hostel capacity
	$capacity = $kas_framework->countRestrict1('hostels_bed_space', 'hostel', $hostel);

	// count the current Occupants
	 $jount_count = "SELECT bed_space FROM hostels_allocation a JOIN hostels_bed_space b ON (a.bed_space = b.id) WHERE b.hostel = '$hostel' AND a.session ='$current_year' AND a.term = '$current_term'";
	$dbh_jount_count = $dbh->prepare($jount_count); $dbh_jount_count->execute(); $occupants = $dbh_jount_count->rowCount(); $dbh_jount_count = null;

	// count avalabe space: just capacity - ocupant
	$av_space = $capacity-$occupants;

	// pull out the hostel fee
	$fee = "SELECT fee FROM `hostels_fees` WHERE `hostel` = '$hostel' AND session = '$current_year' AND term = '$current_term'";
	$dbh_fee = $dbh->prepare($fee); $dbh_fee->execute(); $row_fee = $dbh_fee->rowCount(); $dbh_fee = null;

	if($row_fee == 0){
		$fee = "<a href='#'>set</a>";
	} else {
		$fee = 'N'.number_format($fee).'.00';
	}

  ?>
		 
		  <tr>
			<td><?php echo $sn;?></td>
            <td class="center"><?php echo $name;?> </td>
            <td class="center"><?php echo $type;?> </td>
            <td class="center"> <?php echo $series;?></td>
            <td class="center"><span style="margin-right:10px"><?php echo $grade;?></span></td>
            <td class="center"><?php echo $sex;?></td>
            <td class="center"><div id="" align="left"> <a href="../../files/images/<?php echo $picture;?>" title="Image of <?php echo $name;?>" class="fancybox fancybox.image" ></img></a>
                <span style="margin-right:10px">Capacity:&raquo;<strong><?php echo $capacity;?></strong>&nbsp;&nbsp; Current Occupants:&raquo; <strong><?php echo $occupants;?></strong> &nbsp;&nbsp;Available space:<strong>&raquo;<?php echo $av_space;?></strong> </span>
                <div align="" style="margin-right:10px"><a href="../../files/images/<?php echo $picture;?>" title="Image of <?php echo $name;?>" class="fancybox fancybox.image" ><img id="admission" title="" src="../../files/images/<?php echo $picture;?>" alt ="No Image" style=" width:30%; height:30%;" align="" /></a><br />
			Location: <?php echo $location;?> </div>
			</div> </td>
            <td class="center"><?php echo $fee;?></td>
            <td class="center"><?php echo $r_status;?></td>
            <td class="center"><?php echo $o_status;?></td>
            <td class="center"><a  title=""class="btn btn-info" href="modules?controller=myhostel&myhome=<?php echo $hostel;?>"> <i class="icon-zoom-in icon-white"></i> Manage </a> </td>
            <td class="center"> <a title="" class="btn btn-danger" href="modules?controller=myhostel&myhome=<?php echo $hostel;?>&function=delete"> <i class="icon-trash icon-white"></i>  </a> </td>
          </tr>
		  
		  
		  
	  <?php } 
		 $dbh_pullhostels = null;
	  ?>
        </tbody>
      </table>
    </div>
  </div>
  <!--/span-->
</div>
<p>&nbsp;</p>
