
<?php  
// load contents we need
// this php script gets its data from pages/main/view_users.php
if (empty($_GET['id'])){echo "Error: Your have to refresh your browser, use current browser to handle this website"; exit;}

?>
<div class="col-sm-6 col-sm-offset-3">

<img src="../../pictures/<?php echo $std_pic;?>" width="200px" />
						
<form name="multiform" id="multiform" action="ajax/profile/prcprofile.php" method="post" enctype="multipart/form-data">
<input name="stdid" type="hidden" value="<?php echo trim($_GET['id']);?>"  />
<input type="hidden" name="mytype" value="photo" />
<input type="hidden" name="changePicture" value="yes" />
<input type="hidden" name="oldimage" value="<?php echo $std_pic;?>" />
<input type="hidden" name="username" value="<?php echo $std_username;?>" />
<br /> Select new photo(JPEG format)
	<input type="file" name="myphoto"  />

	</form>
					
<center><input type="button"  id="multi-post" class="btn btn-info" value="Upload & Replace" /></center>

<div id="multi-msg">



</div>

