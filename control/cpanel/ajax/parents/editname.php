<!--<script src="ajax/profile/magic.js"></script>  load our javascript file -->
<?php  

// load contents we need
// this php script gets its data from pages/main/view_users.php
if (empty($_GET['id'])){echo "Error: Your have to refresh your browser, use current browser to handle this website"; exit;}

?>

<div class="col-sm-6 col-sm-offset-3">

<form name="nameform" id="nameform" action="ajax/staff/prcprofile.php" method="POST">
<input name="stdid" type="hidden" value="<?php echo $_GET['id'];?>"  />
<input type="hidden" name="mytype" value="staffname" />


<table width="100%" border="0">
  <tr>
    <td>Surname:(Family)</td>
    <td><input type="text" name="surname" value="<?php echo $lname;?>" class="input disabled" disabled="" /></td>
  </tr>
  <tr>
    <td>First name (Given at Birth) </td>
    <td><input type="text" name="fname" value="<?php echo $fname;?>" /></td>
  </tr>
  <tr>
    <td>Middle name (English Name) </td>
    <td><input type="text" name="mname" value="<?php echo $mi;?>" /></td>
  </tr>
  <tr>
    <td>Other names </td>
    <td><input type="text" name="oname" class="input disabled" disabled="" value="NIL" /></td>
  </tr>
  <tr>
    <td>Ethnicity</td>
    <td><select name="ethnicity" id="label" style="width:250px">
	  <?php 
		$kas_framework->getallFieldinDropdownOption('ethnicity_desc', 'ethnicity', 'ethnicity_id', $ethnicity)
	?>
    </select></td>
  </tr>
  <tr>
    <td>Birth City </td>
    <td><input type="text" name="city" value="<?php echo $birth_city;?>" /></td>
  </tr>
  <tr>
    <td>State of Orign </td>
    <td><select name="state" id="label" style="width:150px">
		 <?php 
			 $kas_framework->getallFieldinDropdownOption('tbl_states', 'state_css', 'state_css', $state);
		  ?>
    </select></td>
  </tr>
   <tr>
    <td>Nationality</td>
    <td><select name="country" id="label" style="width:150px">
		<?php 
			$kas_framework->getallFieldinDropdownOption('country', 'name', 'id', $country);
		?>
    </select></td>
  </tr>
  <tr>
    <td>Date of Birth (dd/mm/yyyy) <?php echo $birth;
	
	// reformat this date for input value
	$dateht5 = substr($birth, -4).'-'.substr($birth, -7, 2).'-'.substr($birth, 0, 2);
	?> 
	
	</td>
    <td><input type="date" name="dob" value="<?php echo $dateht5;?>" /></td>
  </tr>
</table>

</form><!-- submit outside the form so that form will not process when there is no ajax -->

<div id="name-msg">do not type the date, select it from the down arrow, if you cannot see it, use a good browser, recent google chrome </div>

<center><input type="button"  id="name-post" class="btn btn-info" value="Save Changes" /></center>
</div>