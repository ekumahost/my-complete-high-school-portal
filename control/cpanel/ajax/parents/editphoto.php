
<?php  
// load contents we need
// this php script gets its data from pages/main/view_staff.php that is posted from Ajax anyway
if (empty($_GET['id'])){echo "Error: Your have to refresh your browser, use current browser to handle this website"; exit;}
//  this get is is caught from view staff id in url
?>
<div class="col-sm-6 col-sm-offset-3">

current image<br />	
<img src="../../files/staff_photo/<?php echo $picture;?>" width="180" height="220" />
						
<form name="multiform" id="multiform" action="ajax/staff/prcprofile.php" method="post" enctype="multipart/form-data">
<input name="stdid" type="hidden" value="<?php echo $_GET['id'];?>"  />
<input type="hidden" name="mytype" value="photo" />
<input type="hidden" name="changePicture" value="yes" />
<input type="hidden" name="oldimage" value="<?php echo $picture;?>" />
<input type="hidden" name="username" value="<?php echo $username;?>" />
<br /> Select new photo(JPEG format)
	<input type="file" name="myphoto"  />

	</form>
					
<center><input type="button"  id="multi-post" class="btn btn-info" value="Upload & Replace" /></center>

<div id="multi-msg">



</div>

