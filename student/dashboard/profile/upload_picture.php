<?php

	if (!isset($_POST['byepass'])) {
		print '<script>  self.location = "home?hacking_attempt_detected" </script>';
		exit;
	}

require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('tripple_return').'php.files/classes/students.php');
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/student_details.php');
	

$check_if_exist = "SELECT * FROM studentbio WHERE studentbio_id = '".$student_id_original."' LIMIT 1";
$db_check_if_exist = $dbh->prepare($check_if_exist);
$db_check_if_exist->execute();
$paramObj = $db_check_if_exist->fetch(PDO::FETCH_OBJ);
$db_check_if_exist = null;	

if ($paramObj->studentbio_pictures != '') {
	$kas_framework->showWarningCallout('You have Updated your Picture before. <a href="'.$kas_framework->help_url('?topic=request-new-picture').'" target="_blank">Request a New One</a>');
} else {
/*the rest of the update code follows*/
	$imagename = $_FILES["imagename"]["name"];
	$size = $_FILES["imagename"]["size"];
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	$type = finfo_file($finfo, $_FILES["imagename"]['tmp_name']);
	$source = $_FILES['imagename']['tmp_name'];
	$target = constant('tripple_return').'pictures/' .$imagename;
	
		if ($kas_framework->strIsEmpty($imagename)) {
			$kas_framework->showWarningCallout('Please Select a File');
		} 	else if ($type != 'image/jpeg' and $type != 'image/png') {
			$kas_framework->showWarningCallout('The File must be in "JPEG" or "JPG" Format.  Type Detected: "'.$kas_framework->fileTypeDetect($type).'". <a href="'.$kas_framework->help_url('?topic=incorrect-file-extension').'">Explanation?</a>');
		}	elseif ($size > 1048576 ) {
		$kas_framework->showWarningCallout('File Size too large. Max: 1MB. <a href="'.$kas_framework->help_url('?topic=file-error#size_large').'" target="_blank">Explanation?</a>');	
		}	else if (@!move_uploaded_file($source, $target)) {
		$kas_framework->showWarningCallout('Could not Upload File. <a href="'.$kas_framework->help_url('?topic=file-error#couldnt_upload').'" target="_blank">Explanation?</a>');
		}   else {
				
			$imagepath = $imagename;
			 $save = constant('tripple_return').'pictures/' . $imagepath; //This is the new file you saving
			 $file = constant('tripple_return').'pictures/' . $imagepath; //This is the original file

			 @list($width, $height) = getimagesize($file) ; 


			 $tn = @imagecreatetruecolor($width, $height) ; 
			 $image = @imagecreatefromjpeg($file) ; 
			 
			 if (!$image) {
				$kas_framework->showWarningCallout('File Corrupt. Cannot read Image Source. Please Upload Another different Image');
				unlink($file);
				} else {
					 imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height) ; 

					 imagejpeg($tn, $save, 100) ; 
					
					 $save = constant('tripple_return').'pictures/student_'. $_SESSION['tapp_std_username'] .'_'. $imagepath; //This is the new file you saving
					 $file = constant('tripple_return').'pictures/' . $imagepath; //This is the original file

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
				$Q = "UPDATE studentbio SET studentbio_pictures = 'student_". $_SESSION['tapp_std_username'] .'_'. $imagename. "' WHERE studentbio_id = '".$student_id_original."' LIMIT 1";
				$db_Q = $dbh->prepare($Q);
				$db_Q->execute();
				$get_db_Q_rows = $db_Q->rowCount();
				$db_Q = null;	
					if ($get_db_Q_rows == 0) {
					$kas_framework->showWarningCallout('Could not Update Your Picture. <a href="'.$kas_framework->help_url('?topic=query-failed').'" target="_blank">Explanation?</a>');
						unlink ($target);
						} else {	
							$image_source = '../../../pictures/student_'. $_SESSION['tapp_std_username'] .'_'. $imagename. '';
							$kas_framework->showInfoCallout("Image Updated Succesfully. <a href='".$image_source."' class='fancybox fancybox.image'>View Uploaded Image</a>");
							print '<script> self.location = "editprofile" </script>';
						}
				// end the cannot read source else if statementy
				}
		// end the first else border
		}
	  }

?>