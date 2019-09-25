<!--<script src="ajax/profile/magic.js"></script>  load our javascript file -->
<?php  
// load contents we need
// this php script gets its data from pages/main/view_users.php
if (empty($_GET['id'])){echo "Error: Your have to refresh your browser, use current browser to handle this website"; exit;}
?>
<div class="col-sm-6 col-sm-offset-3">
<form name="nameform" id="nameform" action="ajax/profile/prcprofile.php" method="POST">
<input name="stdid" type="hidden" value="<?php echo trim($_GET['id']);?>"  />
<input type="hidden" name="mytype" value="name" />

<table width="100%" border="0">
  <tr>
    <td>Surname:(Family)</td>
    <td><input type="text" name="surname" value="<?php echo $std_lname;?>" class="input disabled" disabled="" /></td>
  </tr>
  <tr>
    <td>First name (Given at Birth) </td>
    <td><input type="text" name="fname" value="<?php echo $std_fname;?>" /></td>
  </tr>
  <tr>
    <td>Middle name (English Name) </td>
    <td><input type="text" name="mname" value="<?php echo $std_mname;?>" /></td>
  </tr>
  <tr>
    <td>Other names </td>
    <td><input type="text" name="oname" value="NIL" class="input-xlarge disabled" disabled="" /></td>
  </tr>
  <tr>
    <td>Ethnicity</td>
    <td><select name="ethnicity" id="label" style="width:150px">
	<?php
		$kas_framework->getallFieldinDropdownOption('ethnicity', 'ethnicity_desc', 'ethnicity_id', $std_et);
	?>
    </select></td>
  </tr>
  <tr>
    <td>Birth City </td>
    <td><input type="text" name="city" value="<?php echo $std_bcity;?>" /></td>
  </tr>
  <tr>
    <td>State of Orign </td>
    <td><select name="state" id="label" style="width:150px">
		  <?php 
			$kas_framework->getallFieldinDropdownOption('tbl_states', 'state_css', 'state_css', $std_bstate);
	   ?>
    </select></td>
  </tr>
  <tr>
    <td>Date of Birth (yyyy-mm-dd) <?php echo $std_dbirth;
		$dateht5 = substr($std_dbirth, -4).'-'.substr($std_dbirth, -7, 2).'-'.substr($std_dbirth, 0, 2);
	?></td>
    <td><input type="date" name="dob" value="<?php echo $dateht5;?>" /></td>
  </tr>
</table>
</form><!-- submit outside the form so that form will not process when there is no ajax -->
<div id="name-msg">do not type the date, select it from the down arrow, if you cannot see it, use a good browser, recent google chrome </div>
<center><input type="button"  id="name-post" class="btn btn-info" value="Save Changes" /></center>
</div>