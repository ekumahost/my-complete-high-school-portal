<?php
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
	$kas_framework->safesession();
	$kas_framework->checkAuthStaff();
	require (constant('quad_return').'php.files/classes/generalVariables.php');	
	require (constant('quad_return').'php.files/staff_details.php');
	require (constant('quad_return').'php.files/classes/staff.php');		

extract($_POST);

/* making sure tat the file was not accessed by the url */
if (!isset($_POST['byepass'])) {
	exit('Error 404: File Cannot be Accessed');
}

	$imagename = $_FILES['imageToBeUploaded']['name'];
	$source = $_FILES['imageToBeUploaded']['tmp_name'];
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	$type = finfo_file($finfo, $_FILES['imageToBeUploaded']['tmp_name']);
	$target_file = constant('quad_return').'pictures/';
	$target = $target_file. $imagename;
	
		if (strlen(trim($imagename)) == 0) {
			print '<pre><code>Image can not be empty. Please Select a file</code></pre>';
		} else if ($type != 'image/jpeg' and $type != 'image/png') {
			print '<pre><code>Incorrect File Extension. File should be in JPEG Format Only. Detected type: '.$kas_framework->fileTypeDetect($type).'. <a href="'.$kas_framework->help_url('?topic=incorrect-file-extension').'" target="_blank">Explanation?</a></code></pre>';
		} else if (!@move_uploaded_file($source, $target)) {
			print '<pre><code>Could not Upload File. <a href="'.$kas_framework->help_url('?topic=file-error#couldnt_upload').'" target="_blank">Explanation?</a></code></pre>';
		} else {
			//reducing the size of the image
			$imagepath = $imagename;
			 $save = $target_file . $imagepath; //This is the new file you saving
			 $file = $target_file . $imagepath; //This is the original file

			 list($width, $height) = getimagesize($file); 


			 $tn = @imagecreatetruecolor($width, $height); 
			 $image = @imagecreatefromjpeg($file); 
			 
			 if (!$image) {
				print '<pre><code>File Corrupt. Cannot read Image Source. Please Upload Another different Image</code></pre>';
				exit();
			 }
			 
			 imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height) ; 

			 imagejpeg($tn, $save, 100); 
			 $randno = mt_rand(10000, 99999);

			 $save = $target_file. "Discussion_".$randno.'_'.$_SESSION['tapp_staff_username'].'_'.$imagepath; //This is the new file you saving
			 $file = $target_file . $imagepath; //This is the original file

			 list($width, $height) = getimagesize($file) ; 


			$modwidth = (70/100) * $width; 
			 $diff = $width / $modwidth;
			 $modheight = (70/100) * $height;

			 $tn = imagecreatetruecolor($modwidth, $modheight) ; 
			 $image = imagecreatefromjpeg($file) ; 
			 imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

			 imagejpeg($tn, $save, 40) ; 
			unlink($file);
		//reducing the size of the image 
		
		$insert_link_to_db = "Discussion_".$randno.'_'.$_SESSION['tapp_staff_username'].'_'.$imagename;
			 
			$insertImage = "INSERT INTO staff_post (poster_id, post_image, post_date) VALUES ('".$web_users_relid."', '".$insert_link_to_db."', '".date('d/m/Y')."')";
			$db_insertImage = $dbh->prepare($insertImage);
				$db_insertImage->execute();
				$get_insertImage_rows = $db_insertImage->rowCount();
				$db_insertImage = null;
			if ($get_insertImage_rows == 0) {
				print '<pre><code>Could not Update File Upload Process. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="_blank">Explanation?</a></code></pre>';
			} else {
				print '<center>Crushing and Resizing Image. Please Wait...<img src="'.$kas_framework->url_root('/img/ajax-loader.gif').'" width="35" /></center>';
				//print '<pre><code>Image Uploaded. Please Wait for 30s. If the Image dosent appear, hit the button below</code></pre>';
			}
				
				
	}
?>