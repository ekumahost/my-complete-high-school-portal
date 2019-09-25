<?php 
$title="Student Interview Photo Cards";
if (!defined('MYSCHOOLAPPADMIN_CORE')) { // if the user access this page directly, take his ass back to home 
	header('Location: ../../../index.php?action=notauth');
	exit;
}

include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";
?>
<div style="margin-left:40px; margin-right:40px;"> <a href="modules?controller=admission"><button class="btn btn-sm">Admission </button></a></div>

<div style="margin-left:40px" class="row">
<br><h4>Choose Batch and Grade </h4>
<form action="" method="post" >
<input type="hidden" name="choose"/>
Batch: <select name="adbatch"> 
<?php 
// if he try to select batch
if(isset($_POST['choose'])){
$_SESSION['adbatch']=$_POST['adbatch'];	
$_SESSION['adgrade']=$_POST['adgrade'];	
}		


// loop the batch out
	   $loopadmision = "SELECT * FROM tbl_admission ORDER BY id";
	   $dbh_loopadmision = $dbh->prepare($loopadmision); $dbh_loopadmision->execute();
	   while ($adlist = $dbh_loopadmision->fetch(PDO::FETCH_OBJ)) { ?>
			<option value="<?php echo $adlist['id'];?>"><?php echo $adlist['badge_name'];?> </option>
		<?php
		   }
		   $dbh_loopadmision = null;
	   ?>

</select>
Grade: <select name="adgrade"> 
 <?php 
   $loopgradeb = "SELECT * FROM grades ORDER BY grades_id";
    $dbh_loopgradeb = $dbh->prepare($loopgradeb); $dbh_loopgradeb->execute();
	   while ($gradelistb = $dbh_loopgradeb->fetch(PDO::FETCH_OBJ)) { ?>
			<option value="<?php echo $gradelistb['grades_id'];?>"> <?php echo $gradelistb['grades_desc'];?> </option>
	<?php
	   }
   ?>
</select>
<input class="btn btn-sm" type="submit" value="Select Batch"/>

</form>


<?php 
if(isset($_SESSION['adbatch'])){// we have a class to pull data from?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button> Download PDF</button>
  <div class="box span11">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>Interview List/Photo Card on :<?php 
	  $batchid = $_SESSION['adbatch'];
	  $gradeid = $_SESSION['adgrade'];
		 echo $batchname = $kas_framework->getValue('badge_name', 'tbl_admission', 'id', $batchid).'&raquo;&raquo;';
		 echo $gradename = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $gradeid);
  ?> </h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="90%">
        <thead>
          <tr style="color:blue;">
            <th width="3%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="10%">Exam No </th>
            <th width="25%">Name</th>
            <th width="29%">Admission Details </th>
            <th width="17%">Grade</th>
            <th width="16%">Candidate Photo <i class="icon icon-color icon-arrow-n-s"></i></th>
          </tr>
        </thead>
        <tbody>
         
 <?php

// please consider batch
 $pullassout = "SELECT * FROM studentbio AS s, web_students AS w WHERE s.studentbio_id = w.stdbio_id s.admit = '0' AND s.admission_badge ='$batchid' AND s.studentbio_entry_grade='$gradeid' ORDER BY s.studentbio_id DESC";
		$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
		//studentbio_entry_grade  
		$sn = 0;
		while ($std = $dbh_pullassout->fetch(PDO::FETCH_OBJ)) {

		$sn = $sn + 1;
		$rowid = $std['studentbio_id'];
		$student_fname = $std['studentbio_fname'];
		$student_mname = $std['studentbio_mname'];
		$student_lname = $std['studentbio_lname'];
		$student_image = $std['studentbio_pictures'];
		$picture = $std['studentbio_pictures'];
		$student_entry_id = $std['studentbio_entry_grade'];
		$student_reg = $std['studentbio_internalid'];

		$std_user= $std['user_n'];
		$std_from_no= $std['form_no'];
		$std_regdate= $std['reg_date'];//we can also use stdbio_id
		$std_ad_badge_id = $std['admission_badge'];
		
		// admission badge name
		$std_ad_badge_title = $kas_framework->getValue('badge_name', 'tbl_admission', 'id', $std_ad_badge_id);
		// entry class name
		$std_entry_class_title = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $student_entry_id);
		$std_exam_score = $kas_framework->getValue('exam_score', 'grade_history_primary', 'student', $rowid); 

		if($picture == ''){
				$picture = 'avatar_default.png';
			}
  ?>
		 
		  <tr>
			<td><?php echo $sn;?></td>
            <td><?php echo "00".$rowid;?></td>
            <td><?php echo $student_lname.', '.$student_fname.' '.$student_mname;?></td>
            <td class="center"><p>Registered On: <b><?php echo $std_regdate;?></b><br />
            Batch Name: <b><?php echo $std_ad_badge_title;?></b></p>
              <p><br />
              </p>
            <p>&nbsp;</p></td>
            <td class="center"><b><?php echo $std_entry_class_title;?></b></td>
            <td class="center"><p><a href="../../pictures/<?php echo $picture;?>" title="Image of <?php echo $std_user;?>" class="fancybox fancybox.image" ><img id="community" title="Community/Profile" src="../../pictures/<?php echo $picture;?>" alt="none" align="" style=" width:100px; height:150px" /></a></p></td>
			
          </tr>
	<?php }
		$dbh_pullassout = null;
 // end of the  loop ?>
        </tbody>
      </table>
    </div>
  </div>
  
<?php }// end admission class sent ?>
  
</div>