
<?php
//Include global functions
include_once "../../../includes/common.php";
// config
include_once "../../../includes/configuration.php";
	include('../../db_selector.php');
	
	// check session
	session_start();
	if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A") {
	  echo '<font color = "red">Something is not right:'.' You are not logged in, please login'.'</font>';
	  exit;
  }

$current_year=$_SESSION['CurrentYear'];
$current_term  = $_SESSION['CurrentTerm'];


$action = $_GET['action'];

$bedspace = $_GET['id'];
$name = $_GET['n'];
$ser = $_GET['sr'];
$hostel = $_GET['h'];
$sptype = $_GET['t'];//
$reserve = $_GET['r'];//
$status = $_GET['s'];//
$grade = $_GET['g'];//
$ability = $_GET['a'];//
$age = $_GET['ag'];
$room = $_GET['rm'];

 ?>
<div class="col-sm-6 col-sm-offset-3">

	<h1>Bed Space Manager</h1><br />
	Managing space <?php echo $name; ?> Room <?php echo $room; ?> (Series  <?php echo $ser; ?>) of  <?php echo $hostel; ?><br />
	
<?php 
	
if($action=='delete') {
	echo "<font color='red'>Are You sure you want to delete this bed Space?</font><br>";
?>

<form action="" method="post">
<input type="hidden" name="del" />
<input type="submit" name="" value="Yes Delete Bed Space" />

</form>
<?php
// process the form here
	if(isset($_POST['del'])){
		// check if someone is in the room
		$check = "SELECT `bed_space` FROM `hostels_allocation` WHERE `session`='$current_year' AND bed_space = '$bedspace'";
		$dbh_Query = $dbh->prepare($check);
		$dbh_Query->execute();
		$rowCountYY = $dbh_Query->rowCount();
		$dbh_Query = null;

		if($rowCountYY == 0){
			echo '<font color="red">That is never right! someone is in the room, remove the person before bombing the room </font>';
		} else {
			 $doit = "DELETE FROM hostels_bed_space WHERE id = '$bedspace'";
			$dbh_doit = $dbh->prepare($doit); $dbh_doit->execute(); $rowCountX = $dbh_doit->rowCount();$dbh_doit = null;
			if($rowCountX == 1){
				echo "<font color='green'>Bed Space Deleted Succesfully</font>";
			} else {
				echo "<font color='red'>Something is not right</font>";
				}
			  }
			}

		exit;
	}

	if(isset($_POST['doset'])) {
		$a = $_POST['type'];
		$b = $_POST['status'];
		$c = $_POST['re'];
		$d = $_POST['ability'];
		$e = $_POST['fac'];
		$f = $_POST['age'];
			$updateit = "UPDATE hostels_bed_space SET override_open_status='$b', override_age='$f', override_reserve_status ='$c', override_grade ='$e', type='$a', override_ability='$d' WHERE id = '$bedspace' ";
			$dbh_sSQL = $dbh->prepare($updateit); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount();$dbh_sSQL = null;
				if($rowCount  == 1){
					echo '<b><font color = "green"> Bed Space updated Succesfully.</font></b>';
				} else {
					echo '<font color = "red">Sorry, Something is not right.</font>';
				}
		}
	?>

<form class="form-horizontal" action="" method="post" enctype="">
	<input type="hidden" name="doset" value="yes" />
		<fieldset>
		  
		  <div class="control-group">
			<label class="control-label" for="hostel">Bed Space Name</label>
			<div class="controls">	
		<?php echo $name; ?>

			</div>
		  </div>
		  
		   <div class="control-group">
			<label class="control-label" for="type">Bed Space Type</label>
			<div class="controls">
			  <select id="type" name="type">
		 <?php $kas_framework->getallFieldinDropdownOption('hostels_tbl_types', 'name', 'id')?>
				
			  </select> &raquo;<i><?php echo $sptype;?> </i>
			</div>
		  </div>
		  
		
			<div class="control-group">
			<label class="control-label" for="status">Allocation STATUS</label>
			<div class="controls">
			  <select id="status" name="status" data-rel="chosen">
				<option value="1" <?php if($status='Open'){echo 'selected="selected"';}?>>Open</option>
				<option value="0" <?php if($status='Closed'){echo 'selected="selected"';}?>>Closed</option>
			  </select>
			</div>
		  </div>
		   
		   <div class="control-group">
			<label class="control-label" for="reserve">RESERVATION STATUS</label>
			<div class="controls">
			  <select id="reserve" name="re" data-rel="chosen" >
				<option value="0" >Available</option>
				<option value="1">Reserved</option>
			  </select>&raquo;<i><?php echo $reserve;?> </i>
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="control-label" for="ability">Occupants  Ability</label>
			<div class="controls">
			  <select id="ability" name="ability" data-rel="chosen">
			  
			  <?php $kas_framework->getallFieldinDropdownOption('hostels_tbl_ability', 'description', 'id'); ?>
			  </select>&raquo;<i><?php echo $ability;?> </i>
			</div>
		  </div>
		  
		   <div class="control-group">
			<label class="control-label" for="faculty">Occupants  Faculty</label>
			<div class="controls">
			  <select id="fac" name="fac" data-rel="chosen" >
				<option value="0">ALL Grades</option>
		 <?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id'); ?>

			  </select>&raquo;<i><?php echo $grade;?>  </i>
			</div>
		  </div>
		  
		  
			<div class="control-group">
			<label class="control-label" for="reserve">AGE RANGE</label>
			<div class="controls">
			  <select id="reserve" name="age" data-rel="chosen" >
				<option value="0" >All Ages</option>

				<option value="5" >1-5</option>
				<option value="10" >5-10</option>
				<option value="15" >10-15</option>
				<option value="20" >15-20</option>
				<option value="25" >20-25</option>
				<option value="30" >25-30</option>
				<option value="35" >Older</option>
				  </select>&raquo;<i><?php echo $age;?> </i>
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
		  
		 <div class="form-actions">
			<button type="submit" class="btn btn-primary">Update Bed Space</button>
			<a href=""><button type="button" class="btn">Cancel</button></a>
		</div>
		</fieldset>
 </form> 
