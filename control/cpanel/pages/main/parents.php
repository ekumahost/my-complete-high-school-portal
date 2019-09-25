<?php 
$title="Parents manager";

if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}
include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";

$current_year = $_SESSION['CurrentYear'];
$biototal = $kas_framework->countAll('student_parents');
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

	
if(isset($_GET['ids'])){

$doit = $_GET['ids'];
	$sSQL = "UPDATE student_parents SET student_parents_status ='1' WHERE student_parents_id='$doit'";
	$dbh_sSQL = $dbh->prepare($sSQL); $checkExec = $dbh_sSQL->execute(); $dbh_sSQL = null;
	//upgraded by Ultimate Kelvin C - Kastech
		if ($checkExec == 1) {
			$myp->AlertSuccess('Success Admin! ', 'Parent Profile Verified');
		} else {
			$myp->AlertError('Error! ', 'Parent Profile Verification Failed');
		}
}
?>

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>Parents<?php //echo $db_name;?></h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr bgcolor="">
            <th>S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th>Username</th>
            <th>Name</th>
            <th>Photo</th>
            <th>Type</th>
            <th><a href="#" title="Active means student can log in">Status</a></th>
            <th>Sex </th>
            <th>Kids </th>
            <th>Last Login </th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
	<?php
	 $pullassout = "SELECT * FROM student_parents AS sp, web_parents AS wp WHERE sp.student_parents_id = wp.web_parents_relid ORDER BY sp.student_parents_id DESC LIMIT $sort_srt, 1000";
	 $dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();			
			$sn = 0;
			while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {

			$sn = $sn + 1;
			$parents_id = $std['student_parents_id'];
			$myfirstn = $std['student_parents_firstname'];
			$mylastn = $std['student_parents_lastname'];
			$mymiddlen = $std['student_parents_mi'];
			$gender = $std['student_parents_sex'];
			$picture = $std['student_parents_image'];
			$parents_title = $std['student_parents_title'];
			$parents_status = $std['student_parents_status'];
			$verifystaff_status = $std['student_parents_status'];
			//get the idiot username from web_parents
			$username= $std['web_parents_username']; 
			$stf_type= $std['web_parents_type'];
			$web_parent_active=$std['web_parents_active']; 

			if($stf_type =='A'){ $stf_type = "Master Admin";
			} else if($stf_type =='B'){ $stf_type = "Admin";
			}else if($stf_type =='T'){ $stf_type = "Teacher";
			}else if($stf_type =='C'){ $stf_type = "Parent";
			}else if($stf_type =='S'){ $stf_type = "Non teaching";
			}else if($stf_type =='Ty'){ $stf_type = "NYSC";
			}else if($stf_type =='Tp'){ $stf_type = "Practising";
			}else if($stf_type =='Tl'){ $stf_type = "Lesson";
			}else if($stf_type =='X'){ $stf_type = "principal";
			}else if($stf_type =='Y'){ $stf_type = "Director";
			}else if($stf_type =='Z'){ $stf_type = "Developer";
			}else{$stf_type = "Unknown";
	}


		if($parents_status ==1){
			$mystatus = '<span class="label label-success">Current Parents</span>';
		} else if($parents_status ==0){
				$mystatus = '<span class="label label-important">Pending</span>';
		 } else if($parents_status ==2){
			  $mystatus = '<span class="label label-info">No Kid in School</span>';
		 } else {
			  $mystatus = '<span class="label label-important">Unknown</span>';
		 }
		 
		 //added by the ultimate
		 if ($web_parent_active == '1') {
			$web_status = '<span class="label label-info">Email Verified. Can Log In</span>';
		 } else if ($web_parent_active == '0') {
			$web_status = '<span class="label label-danger">Account Blocked. Cant Log In</span>';
		 } else {
			$web_status = '<span class="label label-danger">Email Not Verified. <br />Code &raquo; '.$web_parent_active.'</span>';
		 }

			if($picture==NULL){if($gender =="Male"){$picture = 'av_male.png';}else{$picture = 'av_female.png';}}

			$lastdate= $kas_framework->getValue('last_log', 'web_parents', 'web_parents_relid', $parents_id);

  ?>
		 
		  <tr bgcolor="">
			<td><?php echo $sn;?></td>
            <td><i class="icon icon-color icon-user"></i><?php echo $username;?></td>
            <td class="center"><?php echo $mylastn.', '.$mymiddlen.' '.$myfirstn;?></td>
            <td class="center"><div><a href="../../pictures/<?php echo $picture;?>" title="Image of <?php echo $username;?>" class="fancybox fancybox.image" ><img src="../../pictures/<?php echo $picture;?>" alt ="No Image" width="80px" align="" id="image" title="Parent Photo"> </img></a></div></td>
            <td class="center"><?php echo $stf_type;?> </td>
            <td class="center"> <?php echo $mystatus;?><br />
			<?php print $web_status;  ?> 
                <?php if($verifystaff_status==0){ ?>
              <br />
			<a href="main?page=parents&verify=true&ids=<?php echo $parents_id;?>">
			<button id="schoolbadge" class="btn btn-default btn-sm" title="Click to Make a Parent - Not reversible">Verify parent</button>
			</a>
			
			<?php } ?>			</td>
            <td class="center"><?php echo $gender;?></td>
            <td class="center">
			
			
			<?php				
				
		// pull all the kids out
		$pullkids = "SELECT * FROM parent_to_kids AS ptk, studentbio AS s WHERE s.studentbio_id = ptk.student_id AND ptk.parent_id = '$parents_id' AND ptk.confirmation='1' ORDER BY ptk.parent_to_kids_id DESC";
		$dbh_pullkids = $dbh->prepare($pullkids); $dbh_pullkids->execute();
			
			while ($mykid = $dbh_pullkids->fetch(PDO::FETCH_ASSOC)) {

				$mykidid = $mykid['student_id'];
				$didstatus = $mykid['confirmation'];
				$kid_lname= $mykid['studentbio_lname'];
				$kid_fname= $mykid['studentbio_fname']; 
				$kid_pic= $mykid['studentbio_pictures']; 

			?>
		<div id="">&nbsp;&nbsp;<a href="../../pictures/<?php echo $kid_pic;?>" class="fancybox fancybox.image"><img id="" title="child" src="../../pictures/<?php echo $kid_pic;?>" alt="none" align="" style=" width:70px" /> </a>
		<br /><a href="main?page=view_users&id=<?php EncodeToken($mykidid);?>" target="_blank" title="View this Kid Profile"><?php echo $kid_lname.' '.$kid_fname;?></a></div>
			
		<?php }
			$dbh_pullkids = null;
		// stop looping kids ?>	</td>
            <td class="center"><?php echo $lastdate;?></td>
            <td class="center"><a title="You cannot view more of this profile" class="btn btn-success" href="#"> <i class="icon-zoom-in icon-white"></i>  </a>
			<a title="Delete <?php echo $myfirstn;?>'s profile" class="btn btn-danger" href="#"> <i class="icon-trash icon-white"></i>  </a></td>
          </tr>
		
		<?php } 
			 $dbh_pullassout = null;
		?>
        </tbody>
      </table>
	<?php
		// start working ends, this is the third place worked
		echo 'Total parents: <strong>'.number_format($biototal).'</strong><br><br>';
			if($biototal > 1000){
				if(!isset($_GET['break_p'])){$groupid=1;}
			echo '<br>You now have large number of parents in your db; total: '.$biototal.' we have put them into page groups, the ones bellow are more of them <br><br><br> Viewing page group:'.'<strong>'.$groupid.'</strong>'.'<br>';
			
			// then we loop the page grout in a page grouping link
			for($bp = 1; $bp <= $break_p; $bp++){
			echo '<a href="main?page=parents&break_p='.$bp.'">PG'.$bp.' </a>&raquo;';
			}// end for loop

		}// end biototal is 1000

	?>
   
    </div>
  </div>
  <!--/span-->
</div>
<p>&nbsp;</p>