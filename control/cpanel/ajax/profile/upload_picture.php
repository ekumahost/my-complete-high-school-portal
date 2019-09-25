<?php
// check refferer and throw hackers away.
(file_exists('../../../php.files/classes/pdoDB.php'))? include ('../../../php.files/classes/pdoDB.php'): include ('../../../../php.files/classes/pdoDB.php');
(file_exists('../../../php.files/classes/kas-framework.php'))? include ('../../../php.files/classes/kas-framework.php'): include ('../../../../php.files/classes/kas-framework.php');

if (empty($_FILES['myphoto'])){echo "Error: Your must be manipulating something. Please select a file"; exit;}

//making sure the button was clicked
 if (isset($_POST['changePicture'])) {
 
//added by the ultimate keliv [we should delete the old pictures from the picture folder ]
   // $getold_pics = mysql_query("SELECT * FROM studentbio WHERE studentbio_id = '".$postid."' LIMIT 1");
	//$old_pics_name = mysql_result($getold_pics, 0, 'studentbio_pictures');	
  
  // rebranded Kelvin by Ben again
  $old_pics_name= $kas_framework->getValue('studentbio_pictures', 'studentbio', 'studentbio_id', $postid);
/*the rest of the update code follows*/
	$myphoto = $_FILES["myphoto"]["name"];
	$size = $_FILES["myphoto"]["size"];
	$type = $_FILES["myphoto"]["type"];
	$source = $_FILES['myphoto']['tmp_name'];
	$std_user = $_POST['username'];// catch the student username

	$folderin = "../../../../pictures/"; // the folder where it is put


// validate for image format only
	if ($type != 'image/jpeg') {
		echo "Invalid Image extension. Use the one from Joint Photographic expert group only. ";
	}	elseif ($size > 2048576 ) {
		echo "File Size too large. Max: 1MB";
	} else {
		
	// make a unique filename for the uploaded file and check it is not already
	// taken... if it is already taken keep trying until we find a vacant one
	// sample filename: 1140732936_filename.jpg
	$now = time();
	while(file_exists($target = $folderin.$now."_temp_".$myphoto))
	{
		$now++;
	}				
		
	$uniqe_name = $std_user .'_'. $now."_stn_";
				// upload it here
	$pushin = move_uploaded_file($source, $target);

	if ($pushin != true) {
	echo 'Could not upload file. try again, or rename and resize file <a href="../../../../topic?topic=could-not-upload-file" target="_blank"> Why?</a>';
			exit;
			} 
			
			// the raw image is uploaded
			$imagepath = $target;
			 $save = $target; //This is the new file you saving
			 $file = $target; //This is the original file
			 list($width, $height) = getimagesize($file) ; 


			 $tn = imagecreatetruecolor($width, $height) ; 
			 $image = imagecreatefromjpeg($file) ; 
			 
			 if (!$image) {
				echo 'File Corrupt. Cannot read Image Source. Please Upload Another different Image';
				exit();
			 }
			 
			 imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height) ; 

			 imagejpeg($tn, $save, 100) ; 
			
			 $save = $folderin. $uniqe_name.$myphoto; //This is the new file you saving
			 $file = $target; //This is the original file

			// $save = "../../../../users/pictures/". $std_user .'_'. $imagepath; //This is the new file you saving
			// $file = "../../../../users/pictures/". $imagepath; //This is the original file

			 list($width, $height) = getimagesize($file); 

			 $modwidth = (70/100) * $width; 
			 $diff = $width / $modwidth;
			 $modheight = (70/100) * $height;
			 
			 $tn = imagecreatetruecolor($modwidth, $modheight) ; 
			 $image = imagecreatefromjpeg($file) ; 
			 imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

			 imagejpeg($tn, $save, 70) ; 
				unlink($file);
				//added by the ultimate keliv [lets delete the old picture shit]
			   @unlink('../../../../pictures/'.$old_pics_name);
				
		/* inserting the image into the database */
		$Q = "UPDATE `studentbio` SET `studentbio_pictures` = '". $uniqe_name.$myphoto. "' WHERE studentbio_id = '".$postid."'";
		$dbh_sSQL = $dbh->prepare($Q); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount(); $dbh_sSQL = null;
		
		//upgraded by Ultimate Kelvin C - Kastech
			if ($rowCount == 0) {
				print ('Error! Something is not right. Could not Update the Picture. This picture is exaclty the same as the one in database. Think am wrong? Rename the photo before upload');
			//echo $randomid;
				@unlink (@$target);// if the image name is the same, this will trow error
			} else {
				print  '<hr /><img src="../../pictures/'.$uniqe_name.$myphoto.'" height="170px" />';	
			}
		}
	  
	} else {
		exit('Error 404: File Cannot be Accessed Via Link');
	}

?>