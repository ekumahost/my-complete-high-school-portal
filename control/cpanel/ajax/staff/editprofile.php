
	<!--<script src="ajax/profile/magic.js"></script>  load our javascript file -->
<?php  
// load contents we need
// this php script gets its data from pages/main/view_users.php
if (empty($_GET['id'])){echo "Error: Your have to refresh your browser, use current browser to handle this website"; exit;}

?>

<div class="col-sm-6 col-sm-offset-3">

<form name="ajaxform" id="ajaxform" action="ajax/staff/prcprofile.php" method="POST">
<input name="stdid" type="hidden" value="<?php echo trim($_GET['id']);?>"  />
<input type="hidden" name="mytype" value="staffprofile" />
<input type="hidden" name="post_session" value="<?php echo $current_year;?>" />

Entry year&nbsp;&nbsp;&nbsp;
  <select name="entryyear" id="label" style="width:250px">
	  <?php  $kas_framework->getallFieldinDropdownOption('school_years', 'school_years_desc', 'school_years_id');  ?>
	</select><br />

ACCESS School&nbsp;&nbsp;&nbsp;
  <select name="staffschool" id="label" disabled style="width:250px">
  <option id="0"> ALL School</option>
	  <?php  $kas_framework->getallFieldinDropdownOption('tbl_grade_domains', 'school_names', 'id', $school);    ?>
	</select><br />
					
	Class&nbsp;&nbsp;&nbsp;
	<select name="staffgrade" id="label" style="width:250px">
	  <?php  $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id', $staff_class); ?>
	</select><br />
				
		Room&nbsp;&nbsp;&nbsp;
		<select name="staffroom" id="label" style="width:250px">
		<option value="0"><?php echo $staff_class;?> Generic Room </option>
		  <?php   $kas_framework->getallFieldinDropdownOption('school_rooms', 'school_rooms_desc', 'school_rooms_id', $staff_class); ?>
		</select><br />		

			Staff Type
		  <select name="staff_gradetype" id="label" style="width:250px">
<option value="1"  <?php if($edit_staff_main==1){echo'selected="selected"';}?>>Main Teacher </option>
<option value="0" <?php if($edit_staff_main==0){echo'selected="selected"';}?>>Assistant Teacher </option>

	</select><br />		

ID No: <input type="text" name="idno" value="<?php echo $staff_id_no;?>" />

<br />
Check in Status &nbsp;&nbsp;&nbsp;
  <select name="logon" id="label" style="width:200px">

           <option value="" selected >--Select Action-- </option>
           <option value="1">Activate Staff Email </option>
		    <option value="<?php echo $code;?>">Force to verify Email </option>

           <option value="0">Block Staff From Login </option>
	</select><br />	

</form><!-- submit outside the form so that form will not process when there is no ajax -->
<input type="button"  id="simple-post" class="btn btn-info" value="Save Changes" />

<div id="simple-msg"></div>

</div>