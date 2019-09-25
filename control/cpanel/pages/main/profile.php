<?php 
$title="School Profile";

if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}

$tbl_config_SQL = "SELECT * FROM tbl_config WHERE id = '1'";
$dbh_tbl_config_SQL = $dbh->prepare($tbl_config_SQL); 
$dbh_tbl_config_SQL->execute(); 
$getVars = $dbh_tbl_config_SQL->fetch(PDO::FETCH_OBJ); 
$dbh_tbl_config_SQL = NULL; 


$schoolProfileSQL = "SELECT * FROM tbl_school_profile WHERE id = '1'";
$dbh_schoolProfileSQL = $dbh->prepare($schoolProfileSQL);
$dbh_schoolProfileSQL->execute();
$getVarsObj = $dbh_schoolProfileSQL->fetch(PDO::FETCH_OBJ);
$dbh_schoolProfileSQL = NULL;

$portal_logo = $getVars->school_logo_path; 
$portal_badge =$getVars->school_badge_path;
$portal_bcode = $getVars->school_bar_code_app
?>

  <div class="box span7" style="padding:10px">
		<p style="margin:10px 0 0 0; font-variant:small-caps; font-weight:900">School Profile:  <a href="main?page=profile&action=edit#Domains" class="btn btn-default btn-sm"><i class="icon-edit"></i> Edit School Profile</a></p><br />
		School Name: <?php echo $pschool_name = $getVars->school_name;// ?><hr />
		Address: <?php echo $pschool_address = $getVarsObj->adress;// ?><hr />
		Phone:  <?php echo $pschool_phone =  $getVarsObj->phone;// ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile:  <?php echo $pschool_mobile =  $getVarsObj->mobile; ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fax: <?php echo $pschool_fax =  $getVarsObj->fax; ?>
		<hr />
		Email:  <?php echo $pschool_email =  $getVarsObj->email;// ?>
		<hr />
		latitude: <?php echo $pschool_lat =  $getVarsObj->latitude;// ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Longitude: <?php echo $pschool_long =  $getVarsObj->longitude;// ?>
		<hr />
		State: <?php echo $pschool_state =  $getVarsObj->state;// ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Country: <?php echo $pschool_count =  $getVarsObj->country;// ?>
		<hr />
  </div>
  
  
  
  <div class="box span4" style="padding:10px; text-align:center">
  <p style="margin:10px 0 0 0; font-variant:small-caps; font-weight:900">Main Logo and Badge <a href="fancyadmin/school_badge" class="fancybox fancybox.iframe btn btn-default btn-sm"> <i class="icon-edit"></i> Change Logo and Badge</a></p>
	<hr /> Logo: <img src="../../files/images/<?php echo $portal_logo;?>" width="110px"/> <p id="Domains"></p><hr />
	Badge: <img src="../../files/images/<?php echo $portal_badge;?>" width="110px" /><hr />
	<!---- so that the edit profile can fit into the screen -->
  </div>
  
 <div  class="box span11"> 
 
<?php if(isset($_GET['action'])){ ?>


<hr />

<form action="" method="post">
	<style type="text/css">
    input[type="text"], input[type="email"], input[type="number"] { width:260px; }
	td{ padding-left:16px }
    </style>
	<table>
    <tr><td></td><td></td></tr>
	<input type="hidden" name="posted" />
	<tr><td>School Name: </td><td><input type="text" value="<?php echo $pschool_name;?>" name="names" disabled="disabled" /></td>
    <td>Latitude: </td><td><input type="text" name="lat" placeholder="Lattitude" value="<?php echo $pschool_lat;?>" /></td>
    </tr>
    
	<tr><td>Phone: </td><td> <input type="text" name="phone" value="<?php echo $pschool_phone;?>" placeholder="phone" /></td>
    <td>Longitude: </td><td> <input type="text" name="long" placeholder="Longitude" value="<?php echo $pschool_long;?>" /></td>
    </tr>
    
   <tr><td>Mobile: </td><td><input type="text" value="<?php echo $pschool_mobile;?>" name="mobile" placeholder="mobile" /></td>
   <td>Address: </td><td> <textarea rows="3" cols="40" name="address"><?php echo $pschool_address;?> </textarea></td>
   </tr>
   
	<tr><td>Fax: </td><td><input type="text" value="<?php echo $pschool_fax;?>" name="fax" placeholder="fax" /></td>
    <td>State: </td><td><input type="text" name="state" placeholder="eg Enugu" value="<?php echo $pschool_state;?>" /></td>
    </tr>
    
	 <tr><td>Email: </td><td><input type="email" value="<?php echo $pschool_email;?>" name="email" placeholder="Enter School Email Address" /></td>
     <td>Country: </td><td><input type="text" name="count" placeholder="eg Nigeria" value="<?php echo $pschool_count;?>" /></td>
     </tr>
	
    <tr><td colspan="4" align="right"><input class="btn btn-primary btn-sm" type="submit" value="Update School Profile" /> </td></tr>
    </table>
</form>
<?php 
		if (isset($_POST['posted'])){
	// collect the form variables


	$phone= $_POST['phone'];
	$fax= $_POST['fax'];
	$mobile= $_POST['mobile'];
	$email= $_POST['email'];
	$addr= $_POST['address'];
	$long= $_POST['long'];
	$lat= $_POST['lat'];
	$count= $_POST['count'];
	$state= $_POST['state'];

	$mainUpdate = "UPDATE tbl_school_profile SET phone='$phone', mobile='$mobile', fax='$fax', email='$email', adress='$addr', latitude='$lat', longitude='$long', country ='$count', state='$state' WHERE id = '1'";
	$dbh_mainUpdate = $dbh->prepare($mainUpdate);
	$dbh_mainUpdate->execute();
	$rowsCount = $dbh_mainUpdate->rowCount();
		//upgraded by Ultimate Kelvin C - Kastech
	if ($rowsCount == 1){
		$myp->AlertSuccess('Success! ', 'School Profile Updated!</font> <a href="main?page=profile">Proceed to View</a>');
	} else {
			$checkif_if_exist_in_db = "SELECT * FROM tbl_school_profile WHERE id = '1'";
				$dbh_checkif_if_exist_in_db = $dbh->prepare($checkif_if_exist_in_db);
					$dbh_checkif_if_exist_in_db->execute();
					$rowsCountX = $dbh_checkif_if_exist_in_db->rowCount();
					
				if ($rowsCountX == 1) {
					//then it exist, it should be an error from the form
					$myp->AlertError('Database Update! ', 'Error Updating School Profile. Check if you made any changes');
				} else {
					// we add it into the database
					$insertRawQuery = "INSERT INTO tbl_school_profile (phone, fax, email, mobile, adress, state, latitude, longitude, country)
						VALUES ('".secureStr($phone)."', '".secureStr($fax)."', '".secureStr($email)."', '".secureStr($mobile)."', 
						'".secureStr($addr)."', '".secureStr($state)."', '".secureStr($lat)."', '".secureStr($long)."', '".secureStr($count)."') ";
						$dbh_insertQuery = $dbh->prepare($insertRawQuery);
						$dbh_insertQuery->execute();
						$countX = $dbh_insertQuery->rowCount();
						 	if ($countX == 1) {
								$myp->AlertSuccess('Well Done! ', 'School Profile Added Succesfully.');
							} else {
								$myp->AlertError('Fatal Error!', 'All methods Failed. Please Contact kAsTech NetworkNig Now!');
							}
				}
	
	}

}

 }?>

<table class="table table-striped table-bordered bootstrap-datatable" width="80%">
  <thead>
    <tr bgcolor="">
      <th>S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
      <th>Name</th>
      <th>Badge</th>
      <th>Logo</th>
      <th> Location </th>
      <th>Grades<i class="icon icon-color icon-arrow-n-s"></i></th>
      <th> Students </th>
      <th>Staff</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
 
		$pullassout = "SELECT * FROM tbl_grade_domains ORDER BY id";
		$dbh_pullassout = $dbh->prepare($pullassout);
		$dbh_pullassout->execute();
		
		$sn = 0;
		while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {

			$sn = $sn + 1;
			$school_names = $std['school_names'];
			$domain_id = $std['id'];// 
			$school_logo_path = $std['school_logo_path'];
			$school_badge_path = $std['school_badge_path'];
			$address = $std['address'];
				// count nunber of student in each Domain
				//$count_student = mysql_query("SELECT * FROM student_grade_year_year = '$nyear' AND student_grade_year_grade =");		
		  ?>
    <tr bgcolor="">
      <td><?php echo $sn;?></td>
      <td class="center"><?php echo $school_names;?></td>
      <td class="center"><div><a href="../../files/images/<?php echo $school_badge_path;?>" title="" class="fancybox fancybox.image" ><img src="../../files/images/<?php echo $school_badge_path;?>" alt ="No Image" width="110px" id="image" title="" /> </img></a></div></td>
	  
      <td class="center"><a href="../../files/images/<?php echo $school_logo_path;?>" title="" class="fancybox fancybox.image" ><img src="../../files/images/<?php echo $school_logo_path;?>" alt ="No Image" width="110px" id="image" title="logo" /> </img></a></td>
      <td class="center"><?php echo $address;?></td>
      <td class="center">&nbsp;</td>
      <td class="center">&nbsp;</td>
      <td class="center"></td>
      <td class="center"><a title="" class="btn btn-info" href="#">  <i class="icon-zoom-in icon-white"></i> </a> </td>
    </tr>
    <?php } 
		$dbh_pullassout = NULL;
	?>
  </tbody>
</table>
<p>&nbsp;</p>

</div>