
	<!--<script src="ajax/profile/magic.js"></script>  load our javascript file -->
<?php  
// load contents we need
// this php script gets its data from pages/main/view_users.php
if (empty($_GET['id'])){echo "Error: Your have to refresh your browser, use current browser to handle this website"; exit;}

?>

<div class="col-sm-6 col-sm-offset-3">

<form name="ajaxform" id="ajaxform" action="ajax/staff/prcprofile.php" method="POST">
<input name="stdid" type="hidden" value="<?php echo $_GET['id'];?>"  />
<input type="hidden" name="mytype" value="staffprofile" />
Entry year&nbsp;&nbsp;&nbsp;
	<select name="entryyear" id="label" style="width:250px">
		<?php 
			$kas_framework->getallFieldinDropdownOption('school_years', 'school_years_desc', 'school_years_id', $entry);
		?>			  
	</select><br />

	School&nbsp;&nbsp;&nbsp;
	<select name="staffschool" id="label" style="width:250px">
		 <?php 
			$kas_framework->getallFieldinDropdownOption('tbl_school_domains', 'school_names', 'id', $school);
		  ?>
		</select><br />

	ID No: <input type="text" name="idno" value="<?php echo $staff_id_no;?>" />
	<br />

</form><!-- submit outside the form so that form will not process when there is no ajax -->
<input type="button"  id="simple-post" class="btn btn-info" value="Save Changes" />

<div id="simple-msg"></div>
</div>