<?php  
// load contents we need
// this php script gets its data from pages/main/view_users.php
if (empty($_GET['id'])){echo "Error: Your have to refresh your browser, use current browser to handle this website"; exit;}

?>
<div class="col-sm-6 col-sm-offset-3">

<form name="staffcontact" id="staffcontact" action="ajax/staff/prcprofile.php" method="POST">
<input name="stdid" type="hidden" value="<?php echo $_GET['id'];?>"  />
<input type="hidden" name="mytype" value="staff_contact" />


<table width="100%" border="0">
  <tr>
    <td>Address</td>
    <td>
	<textarea cols="20" rows="4" name="adr"><?php echo $address;?> </textarea>
	</td>
  </tr>
  <tr>
    <td>Resident Town </td>
    <td><input type="text" name="town" value="<?php echo $town;?>" /></td>
  </tr>
  <tr>
    <td>Resident State </td>
    <td><select name="rstate" id="label" style="width:150px">
		  <?php 
			$kas_framework->getallFieldinDropdownOption('tbl_states', 'state_css', 'state_code', $res_state);
			?>
    </select></td>
  </tr>
  <tr>
    <td>Phone</td>
    <td><input type="number" name="phone" value="" class="input disabled" disabled="" /></td>
  </tr>
   <tr>
    <td>Email</td>
    <td><input type="email" name="email" value="<?php echo $email;?>" class="input disabled" disabled="" /></td>
  </tr>
  <tr>
    <td>Mobile</td>
    <td><input type="number" name="mobile" value="<?php echo $mobile;?>" /></td>
  </tr>
</table>
</form><!-- submit outside the form so that form will not process when there is no ajax -->

<div id="staff-msg"></div>

<center><input type="button"  id="staff-contact" class="btn btn-info" value="Save Changes" /></center>

</div>

