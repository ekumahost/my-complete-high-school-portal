<?php  
// load contents we need
// this php script gets its data from pages/main/view_users.php
if (empty($_GET['id'])){echo "Error: Your have to refresh your browser, use current browser to handle this website"; exit;}

?>
<div class="col-sm-6 col-sm-offset-3">
<form name="bankform" id="bankform" action="ajax/staff/prcprofile.php" method="POST">
<input name="stdid" type="hidden" value="<?php echo $_GET['id'];?>"  />
<input type="hidden" name="mytype" value="bank_form" />

<table width="100%" border="0">
  <tr>
    <td>Salary Scale</td>
    <td><select name="scale" id="select" style="width:150px">
      <?php 
		$kas_framework->getallFieldinDropdownOption('tbl_salaries', 'staff_type', 'id', $sal_type);
		?>
    </select><?php echo $sal_scale;?></td>
  </tr>
  <tr>
    <td>Bank</td>
    <td><select name="bank" id="bank" style="width:150px">
      <?php 
		$kas_framework->getallFieldinDropdownOption('bank', 'name', 'id', $bank);
	 ?>
    </select></td>
  </tr>
  <tr>
    <td>Account Number</td>
    <td><input type="number" name="acc" value="<?php echo $account;?>" /></td>
  </tr>
  <tr>
    <td>Account Name</td>
    <td><input type="text" name="acc_name" value="<?php echo $acc_name;?>" /></td>
  </tr>
  <tr>
    <td>Account Type</td>
    <td><input type="text" name="type" value="<?php echo $act_type;?>" /></td>
  </tr>
  <tr>
    <td>Branch Sort Code</td>
    <td><input type="text" name="sort" value="<?php echo $bank_sort;?>" /></td>
  </tr>
</table>
</form><!-- submit outside the form so that form will not process when there is no ajax -->

<div id="bank-msg"></div>

<center><input type="button"  id="bank-post" class="btn btn-info" value="Save Changes" /></center>
</div>