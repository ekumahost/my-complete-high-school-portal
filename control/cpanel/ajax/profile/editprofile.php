<!--<script src="ajax/profile/magic.js"></script>  load our javascript file -->
<?php  
// load contents we need
// this php script gets its data from pages/main/view_users.php
if (empty($_GET['id'])){echo "Error: Your have to refresh your browser, use current browser to handle this website"; exit;}
?>

<div class="col-sm-6 col-sm-offset-3">

<form name="ajaxform" id="ajaxform" action="ajax/profile/prcprofile.php" method="POST">
<input name="stdid" type="hidden" value="<?php echo trim($_GET['id']);?>"  />
<input type="hidden" name="mytype" value="profile" />
Entry year&nbsp;&nbsp;&nbsp;
  <select name="entryyear" id="label" style="width:150px">
	  <?php 
		$kas_framework->getallFieldinDropdownOption('school_years', 'school_years_desc', 'school_years_id', $std_entry);
   ?>
	</select><br />
Entry grade 

<input name="entrygrade" class="input-xlarge disabled" value="<?php echo $std_entry_grade;?>" id="entry" type="text" style="width:140px" placeholder="" disabled="" /><br />
Reg NO: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="entrygrade" class="input-xlarge disabled" value="<?php echo $std_reg;?>" id="entry" type="text" style="width:140px" placeholder="" disabled="" /><br />

Denomination&nbsp;&nbsp;&nbsp;
  <select name="deno" id="label" style="width:200px">
	  <?php 
		$kas_framework->getallFieldinDropdownOption('tbl_std_denomination', 'deno', 'id', $std_deno_id);
	?>
	</select><br />	
Check in Status &nbsp;&nbsp;&nbsp;
  <select name="logon" id="label" style="width:200px">
	<option value="" selected >--Select Action-- </option>
	<option value="1">Activate Student Email </option>
	<option value="<?php echo $code;?>">Force to verify Email </option>

	<option value="0">Block Student From Login </option>
</select><br />				
</form><!-- submit outside the form so that form will not process when there is no ajax -->
<input type="button"  id="simple-post" class="btn btn-info" value="Save Changes" />

<div id="simple-msg"></div>
</div>