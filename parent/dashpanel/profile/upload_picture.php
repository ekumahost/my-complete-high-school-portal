<?php
	
	if (!isset($_POST['byepass'])) {
		print '<script>  self.location = "home?hacking_attempt_detected" </script>';
		exit;
	}

	require ('../../../php.files/classes/pdoDB.php');
	require ('../../../php.files/classes/kas-framework.php');
	$kas_framework->safesession();
	$kas_framework->checkAuthParent();
	require (constant('tripple_return').'php.files/classes/generalVariables.php');
	require (constant('tripple_return').'php.files/parents_details.php');
	require (constant('tripple_return').'php.files/classes/parents.php');
	
//making sure the button was clicked
/*the rest of the update code follows*/
	$imagename = $_FILES["imagename"]["name"];
	$size = $_FILES["imagename"]["size"];
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	$type = finfo_file($finfo, $_FILES["imagename"]['tmp_name']);
	$source = $_FILES["imagename"]["tmp_name"];
	$target = constant('tripple_return').'pictures/' .$imagename;
	
		if ($kas_framework->strIsEmpty($imagename)) {
			$kas_framework->showWarningCallout('Please Select a File');
		} 	else if ($type != 'image/jpeg' and $type != 'image/png') {
			$kas_framework->showWarningCallout('The File must be in "JPEG" or "JPG" Format. Type Detected: "'.$kas_framework->fileTypeDetect($type).'". <a href="'.$kas_framework->help_url('?topic=incorrect-file-extension').'" target="new">Explanation?</a>');
		}	elseif ($size > 3145728 ) {
		$kas_framework->showWarningCallout('File Size too large. Max: 3MB. <a href="'.$kas_framework->help_url('?topic=file-error#size_large').'" target="_blank">Explanation?</a>');	
		}	 else if (@!move_uploaded_file($source, $target)) {
		$kas_framework->showWarningCallout('Could not Upload File. <a href="'.$kas_framework->help_url('?topic=file-error#couldnt_upload').'" target="_blank">Explanation?</a>');
		} else {
				
			$imagepath = $imagename;
			 $save = constant('tripple_return').'pictures/' . $imagepath; //This is the new file you saving
			 $file = constant('tripple_return').'pictures/' . $imagepath; //This is the original file

			 list($width, $height) = getimagesize($file);
			 $tn = imagecreatetruecolor($width, $height) ; 
			 $image = imagecreatefromjpeg($file) ; 
			 
			 if (!$image) {
				$kas_framework->showWarningCallout('File Corrupt. Cannot read Image Source. Please Upload Another different Image');
				unlink($file);
				exit();
			 }
			 
			 imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height) ; 

			 imagejpeg($tn, $save, 100) ; 
			
			 $save = constant('tripple_return')."pictures/". 'parent_'.$_SESSION['tapp_par_username'] .'_'. $imagepath; //This is the new file you saving
			 $file = constant('tripple_return')."pictures/" . $imagepath; //This is the original file

			 list($width, $height) = getimagesize($file); 


			$modwidth = (70/100) * $width; 
			 $diff = $width / $modwidth;
			 $modheight = (70/100) * $height;
 
			 $tn = imagecreatetruecolor($modwidth, $modheight) ; 
			 $image = imagecreatefromjpeg($file) ; 
			 imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

			 imagejpeg($tn, $save, 40) ; 
				unlink($file);
				
				/* inserting the image into the database */
		$updateQ = "UPDATE student_parents SET student_parents_image = 'parent_". $_SESSION['tapp_par_username'] .'_'. $imagename. "' WHERE student_parents_id = '".$web_parents_relid."' LIMIT 1";
		$db_updateQ = $dbh->prepare($updateQ);
		$db_updateQ->execute();
		$get_updateQ_rows = $db_updateQ->rowCount();
		$db_updateQ = null;
			if ($get_updateQ_rows == 0) {
				$kas_framework->showWarningCallout('Could not Update Your Picture. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="_blank">Explanation?</a>');
				unlink ($target);
			} else {	
				$image_source = '../../../pictures/parent_'. $_SESSION['tapp_par_username'] .'_'. $imagename. '';
				$kas_framework->showInfoCallout("Image Updated Succesfully. <a href='".$image_source."' class='fancybox fancybox.image'>View Uploaded Image</a>");
				print '<script> self.location = "editprofile" </script>';
			}
		}

?>