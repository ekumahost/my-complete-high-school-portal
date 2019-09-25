<?php
//Include global functions
include_once "../../includes/common.php";
//Include paging class
include_once "../../includes/ez_results.php";
// config
include_once "../../includes/configuration.php";

if (empty($_FILES['myphoto'])){echo "Error: Your must be manipulating something. Please select a file"; exit;}

//making sure the button was clicked
 if (isset($_POST['changePicture'])) {
 // $postid = student id
	 $update_colum = $_POST['kind'];
	if($update_colum == "Badge"){
		$update_colum = 'school_badge_path';
	}elseif($update_colum == "Logo"){
		$update_colum = 'school_logo_path';
	}else{
		echo '<font color="red">We are sorry to say you did not select type to update.</font>';
		exit;
	}

/*the rest of the update code follows*/
	$myphoto = $_FILES["myphoto"]["name"];
	$size = $_FILES["myphoto"]["size"];
	$type = $_FILES["myphoto"]["type"];
	$source = $_FILES['myphoto']['tmp_name'];
	$std_user = "logobadge";//$_POST['username'];// catch the student username

	$folderin = "../../../files/images/"; // the folder where it is put


// validate for image format only
if (getimagesize($source)==false) {
		echo "Invalid Image extension. it is probably not a logo or badge. ";
		}	elseif ($size > 2048576 ) {
	echo "File Size too large. Max: 1MB";
} else {
// make a unique filename for the uploaded file and check it is not already
// taken... if it is already taken keep trying until we find a vacant one
// sample filename: 1140732936_filename.jpg
$now = time();
while(file_exists($target = $folderin.$now."_lb_".$myphoto))
{
    $now++;
}				
	
$uniqe_name = $now."_lb_".$myphoto;
			// upload it here
$pushin = move_uploaded_file($source, $target);

	if ($pushin != true) {
	echo 'Could not upload file. try again, or rename and resize file <a href="../../../topic?topic=could-not-upload-file" target="_blank"> Why?</a>';
			exit;
		} 
		
	/* inserting the image into the database */
	 $Query = "UPDATE tbl_config SET $update_colum = '". $uniqe_name. "' WHERE id = '1'";
	 $dbh_Query = $dbh->prepare($Query);
	$dbh_Query->execute();
	$rowCount = $dbh_Query->rowCount();
	 
	 //upgraded by Ultimate Kelvin C - Kastech
			if ($rowCount == 0) {
				print ('Something is not right. Could not Update the logo/badge. This picture is exaclty the same as the one in database. Think am wrong? Rename the photo before upload');
				//echo $randomid;
			} else {	
				print ('Good Job Admin! File Uploaded');
				//echo $_FILES['myphoto']['name'].'<br>';

	echo '<img src="'.$folderin.$uniqe_name.'" height="120px" />';	
	}
}
	  
	} else {
		exit('Error 404: File Cannot be Accessed Via Link');
	}
?>