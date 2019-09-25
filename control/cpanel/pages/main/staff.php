<?php 
$title="Staff manager";
if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 
	header('Location: ../../../index.php?action=notauth');
	exit;
}
include_once "../includes/common.php";

// config
include_once "../includes/configuration.php";

$current_year = $_SESSION['CurrentYear'];

// count number of staff
$biototal = $kas_framework->countAll('staff');
	// since we are displaying 1000 only
	if($biototal > 1000){
	//echo "its above 10000";
	$break_p = round($biototal/1000);
	// so we have $break_p number of page groups
	// collect the page group from url
	@$groupid = $_GET['break_p'];
	// then we loop the page grout in a page grouping link
	}// end if card is more than a thousand
 // start working again
	if(isset($_GET['break_p'])){// this is only set when quantity is greater than 1000
// for $groupid = 0, 0-1000, 1, 1000-2000, 2 2000- 3000, 3 3000-4000s
	 $sort_srt = $groupid*1000;}else{
		 ///$groupid
		 // where should the sorting start
		 $sort_srt = 0; 
	 }// end for wallet
	?>
	<div style="margin-left:40px">
			<div align="right" style="padding:10px 10px 0 0"> 	<?php echo 'Total Staff in School:'.number_format($biototal); ?> &nbsp; &nbsp; &nbsp;
			<a href="?page=staff&making=hero#Admin">
				 <button id="schoolbadge" class="btn btn-primary btn-xs" title="">Change Profile Types</button>
			</a></div>
	<?php 
	if(isset($_GET['ids'])){

	$doit = DecodeToken($_GET['ids']);
	 $Query = "UPDATE staff SET staff_status ='1' WHERE staff_id='$doit'";
	 $dbh_Query = $dbh->prepare($Query); $dbh_Query->execute(); $rowCount = $dbh_Query->rowCount(); $dbh_Query = null;
	 //upgraded by Ultimate Kelvin C - Kastech
		if ($rowCount == 1) {
			$myp->AlertSuccess('Success! ', 'Staff profile Verified!');
		} else {
			$myp->AlertError('Verification Error! ', 'Staff Profile Could not be Verified');
		}
	}
	?>


</div>

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i> Staff Database<?php //echo $db_name;?></h2>
	
	  
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr>
            <th>S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th>Username</th>
            <th>Name</th>
            <th>Age</th>
            <th>Class</th>
            <th>Type</th>
            <th><a href="#" title="Current Staff Means they have been Activated">Status</a></th>
            <th>Sex </th>
            <th>Photo<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th>Login </th>
            <th>Available Action</th>
          </tr>
        </thead>
        <tbody>
         
	 <?php
	 
			$pullassout = "SELECT * FROM staff ORDER BY staff_id DESC LIMIT $sort_srt, 1000";
			$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
			
			$sn = 0;
			while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {

				$sn = $sn + 1;
				$staff_id = $std['staff_id'];
				$myfirstn = $std['staff_fname'];
				$mylastn = $std['staff_lname'];
				$mymiddlen = $std['staff_mi'];
				$staff_status = $std['staff_status'];
				$gender = $std['staff_sex'];
				$picture = $std['staff_image'];
				$staff_title = $std['staff_title'];
				$staff_dob = $std['staff_dob'];
				$verifystaff_status = $std['staff_status'];
				$staff_mobile = $std['staff_mobile'];

				
			//get the idiot username from web_users
			$username= $kas_framework->getValue('web_users_username', 'web_users', 'web_users_relid', $staff_id); 
			$web_status = $kas_framework->getValue('web_users_active', 'web_users', 'web_users_relid', $staff_id);

			$std_grade_yr = $kas_framework->getValueRestrict2('grade_class', 'teacher_grade_year', 'teacher', $staff_id, 'session', $current_year);
			// so what is his grade now
			$std_grade = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $std_grade_yr);
			
			$email_status = ($web_status == 1)? '<span class="label label-success" style="padding:5px 3px">Email Verified</span>': '<span class="label label-warning" style="padding:5px 3px">Email Not Verified</span>';

			// what if the staff is not assigned
			if($std_grade==NULL){$std_grade='<u>None</u>';}

			$stf_type = $kas_framework->getValue('web_users_type', 'web_users', 'web_users_relid', $staff_id); 
			
			if($stf_type =='A'){ 	$stf_type = "Master Admin"; }  else if($stf_type =='B'){ $stf_type = "Admin"; } elseif ($stf_type =='T') { $stf_type = "Teacher";
			} elseif($stf_type =='C'){ $stf_type = "Parent";} else if($stf_type =='S') { $stf_type = "Non teaching"; } elseif ($stf_type =='Ty') { $stf_type = "NYSC"; 
			} elseif($stf_type =='Tp'){ $stf_type = "Practising";} else if ($stf_type =='Tl'){ $stf_type = "Lesson"; } elseif ($stf_type =='X'){ $stf_type = "Principal";
			}elseif($stf_type =='Xp'){ $stf_type = "Vice principal"; }elseif($stf_type =='Y'){ $stf_type = "Director"; }elseif($stf_type =='Yp'){ $stf_type = "Propritor";
			}elseif($stf_type =='Z'){ $stf_type = "Developer"; }else{$stf_type = "Unknown"; }

	if($staff_status == 1){
	 $mystatus = '<span class="label label-success" style="padding:5px 3px">Current Staff</span>';
	} else if($staff_status ==0){
		$mystatus = '<span class="label label-important" style="padding:5px 3px">Pending</span>';
	 }elseif($staff_status == 2){
		$mystatus = '<span class="label label-info" style="padding:5px 3px">Retired</span>';
	 }else{
		$mystatus = '<span class="label label-important" style="padding:5px 3px">Unknown</span>';
	 }
	if($picture==NULL){if($gender =="Male"){$picture = 'av_male.png';}else{$picture = 'av_female.png';}}

	// the year of birht
	$staff_dob = trim(substr($staff_dob, - 4));
	// check if it a number and looks like a year

	@$checkdt = checkdate(1, 1, $staff_dob);
	if($checkdt != true){
		$dob = '18++';
		} else {
		$dob =  date('Y')-$staff_dob + 1;
	}
		
	$lastdate= $kas_framework->getValue('last_log', 'web_users', 'web_users_relid', $staff_id);//we can also use stdbio_id

 ?>
		 
		  <tr>
			<td><?php echo $sn;?></td>
            <td><i class="icon icon-color icon-user"></i><?php echo $username;?></td>
            <td class="center"><?php echo $mylastn.', '.$mymiddlen.' '.$myfirstn .'<br /> No:'. $staff_mobile; ?></td>
            <td class="center"><?php echo $dob.' Years';?> </td>
            <td class="center"><?php echo $std_grade;?> </td>
            <td class="center"><?php echo $stf_type;?> </td>
            <td class="center"> <?php echo $mystatus .'<br /><br /> '. $email_status; ?>
			
			<?php if($verifystaff_status==0){?>
			<br /><br />
			<a href="main?page=staff&verify=true&ids=<?php EncodeToken($staff_id);?>">
			<button id="schoolbadge" class="btn btn-primary btn-xs" title="Click to aprove the profile(Make the user a staff)-Not reversible">Verify</button>
			</a>
			
			<?php } ?>
			</td>
            <td class="center"><?php echo $gender;?></td>
            <td class="center"><div id="image"><a href="../../pictures/<?php echo $picture;?>" title="Image of <?php echo $username;?>" class="fancybox fancybox.image" >
			<img id="admission" title="" src="../../pictures/<?php echo $picture;?>" alt ="No Image" style="width:60px;" align=""> 
			</div></td>
            <td class="center"><?php echo $lastdate;?></td>
            <td class="center"><a target="_blank" title="View <?php echo $myfirstn;?>'s Profile" class="btn btn-success" href="main?page=view_staff&id=<?php EncodeToken($staff_id);?>"> <i class="icon-zoom-in icon-white"></i>  </a>
			<a target="_blank"title="Cannot be deleted " class="btn btn-danger"> <i class="icon-trash icon-white"></i>  </a> </td>
          </tr> 
		  
	  <?php }
			$dbh_pullassout = null;
	  ?>
        </tbody>
      </table>
	  
	  <a href="" id="Admin"></a>

	  
	 <?php
// start working ends, this is the third place worked

if($biototal > 1000){
  if(!isset($_GET['break_p'])){$groupid=1;}
	echo '<br>You now have large number of Staff in your db; total: '.$biototal.' we have put them into page groups, the ones bellow are more of them <br><br><br> Viewing page group:'.'<strong>'.$groupid.'</strong>'.'<br>';
	
	// then we loop the page grout in a page grouping link
	for($bp = 1; $bp <= $break_p; $bp++){
	echo '<a href="main?page=staff&break_p='.$bp.'">PG'.$bp.' </a>&raquo;';
  }// end for loop

}// end biototal is 1000

?>
 </div>
  </div>
  <!--/span-->
</div>
<div style="margin-left:40px">
<br />
  <?php if(isset($_GET['making'])){?>

<br /><br /><br />

  <p>Among the staff profiles, you can define Administrative profiles here, select Administrative office and choose staff profile to define. Note Principal and proprietor have the same permission as you. Select only one at a time to define, if you select two, the last one only will be affected. </p>
  <p>
  
<div class="control-group">
 <form action="" method="post">
 <input type="hidden" name="making" value="true" />		  
 <input type="hidden" name="makerole" value="true" />		  

	<input type="hidden" name="page" value="staff" />	
 <label class="control-label" for="selectError1"><font color="red">Select only a single staff to add at a time</font></label>
		<div class="controls" >
	<select id="selectError1" name="staffid" multiple data-rel="chosen" style="width:700px">
<?php 
// pull all the staff out for selection

  $pullstaff = "SELECT * FROM staff_role AS sr, staff AS s WHERE sr.staff_id = s.staff_id ORDER BY sr.id DESC";
	$dbh_pullstaff = $dbh->prepare($pullstaff); $dbh_pullstaff->execute(); 
	$sn = 0;
		while ($rowst = $dbh_pullstaff->fetch(PDO::FETCH_ASSOC)) {
		//$current_year=$_SESSION['CurrentYear'];

		$sn = $sn + 1;
		$staff_id = $rowst['staff_id'];
		$staff_usern = $kas_framework->getValue('web_users_username', 'web_users', 'web_users_relid', $staff_id);
		$staff_fname = $rowst['staff_fname'];
		$staff_lname = $rowst['staff_lname'];
	?>
	<option value="<?php echo $staff_id;?>"><?php echo $staff_lname.' '.$staff_fname.'('.$staff_usern.')';?></option>
	<?php }
		$dbh_pullstaff = null;
	?>                                   
				  </select>
			<br />      
				Set Staff As: <select name="role"> 
				<option value="0">Select Profile Type</option>
                <option value="X">Principal</option>
				<option value="Xp">Vice Principal</option>
                 <option value="Y">Director</option>
                <option value="Yp">Proprietor</option>
                 <option value="S">Non Teaching Staff</option>
				<option value="Ty">NYSC</option>
                <option value="Tp">Practising Teacher</option>
				<option value="T">Teacher</option>
				<option value="B">Admin</option>
				<option readonly value="0">Master Admin</option>
				<!-- <option readonly value="A">Master Admin</option> // Ben disallow making a master admin-->

</select>			  
			  <button type="submit" class="btn btn-primary">Change Profile Type</button>
  </form>
  
  <?php
  if(isset($_POST['makerole'])){
  // set the staff role here
  @$staff__id = $_POST['staffid'];
    @$role__id = $_POST['role'];

  if($role__id =='0' || $staff__id==''){
	   $myp->AlertInfo('Attention! ', 'Please Select a single Staff. You can not make more Master Admins like yourself');
  }else if($staff__id=='1'){
	   $myp->AlertInfo('Attention! ', 'Master Admin must always be master admin, no change!');
  }
  else {
	$post_update = "UPDATE `web_users` SET `web_users_type` = '$role__id' WHERE `web_users_relid` = '$staff__id'";
	$dbh_post_update = $dbh->prepare($post_update); $dbh_post_update->execute(); $rowCount = $dbh_post_update->rowCount(); $dbh_post_update = null;
		if ($rowCount == 1) {
			$myp->AlertSuccess('Correct! ', 'Profile Was Updated Successfully.');
		} else {
			$myp->AlertError('Update Error! ', 'Profile Update Failed. Please Contact HyperTera');
		}
}
 }// end set role form submit
?>
  </div>
  </div>
</p>
  </div>
 <?php }// set making ends?> 
