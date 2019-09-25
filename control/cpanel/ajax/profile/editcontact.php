<?php  
// load contents we need
// this php script gets its data from pages/main/view_users.php
if (empty($_GET['id'])){echo "Error: Your have to refresh your browser, use current browser to handle this website"; exit;}

?>
<div class="col-sm-6 col-sm-offset-3">

<form name="contactform" id="contactform" action="ajax/profile/prcprofile.php" method="POST">
<input name="stdid" type="hidden" value="<?php echo trim($_GET['id']);?>"  />
<input type="hidden" name="mytype" value="contact" />


<table width="100%" border="0">
  <tr>
    <td>Address</td>
    <td><input type="text" name="adr" value="<?php echo $std_adres;?>" /></td>
  </tr>
 
  <tr>
    <td>Resident Town </td>
    <td><input type="text" name="town" value="<?php echo $std_restown;?>" /></td>
  </tr>
  <tr>
    <td>Resident State </td>
    <td><select name="rstate" id="label" style="width:150px">
		  <?php 
			$kas_framework->getallFieldinDropdownOption('tbl_states', 'state_css', 'state_css', $std_restate);
	   ?>
    </select></td>
  </tr>
  <tr>
    <td>Phone</td>
    <td><input type="number" name="phone" value="<?php echo $std_phone;?>" /></td>
  </tr>
  <tr>
    <td>Mobile</td>
    <td><input type="number" name="mobile" value="<?php echo $std_mobile;?>" /></td>
  </tr>
  <tr>
    <td>Parent Detail </td>
    <td><a href="main?page=parent_child" target="_blank">Mange parent profile</a></td>
  </tr>
</table>

</form><!-- submit outside the form so that form will not process when there is no ajax -->

<div id="contact-msg"></div>

<center><input type="button"  id="contact-post" class="btn btn-info" value="Save Changes" /></center>					

</div>