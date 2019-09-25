<?php  
// load contents we need
// this php script gets its data from pages/main/view_users.php
if (empty($_GET['id'])){echo "Error: Your have to refresh your browser, use current browser to handle this website"; exit;}

?>
<div class="col-sm-6 col-sm-offset-3">

<form name="staffkin" id="staffkin" action="ajax/staff/prcprofile.php" method="POST">
<input name="stdid" type="hidden" value="<?php echo $_GET['id'];?>"  />
<input type="hidden" name="mytype" value="staff_kin" />
<table width="100%" border="0">
  <tr>
    <td>Name</td>
    <td><input type="text" name="name" value="<?php echo $kin;?>" /></td>
  </tr>
  
  <tr>
    <td>Address</td>
    <td><input type="text" name="adr" value="<?php echo $kin_adress;?>" /></td>
  </tr>
  <tr>
    <td>Relationship </td>
    <td><select name="relation" id="label" style="width:150px">
	  <?php 
		$kas_framework->getallFieldinDropdownOption('relations_codes', 'relation_codes_desc', 'relation_codes_id', $kin_relationship);
   ?>
    </select></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="email" name="email" value="<?php echo $kin_email;?>" /></td>
  </tr>
  <tr>
    <td>Mobile</td>
    <td><input type="number" name="mobile" value="<?php echo $kin_phone;?>" /></td>
  </tr>
</table>
</form><!-- submit outside the form so that form will not process when there is no ajax -->

<div id="staff-kin-msg"></div>

<center><input type="button"  id="staff-kin-post" class="btn btn-info" value="Save Changes" /></center>
		
</div>