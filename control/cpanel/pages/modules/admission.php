<?php 
$title="Admission Module";
if (!defined('MYSCHOOLAPPADMIN_CORE')) { // if the user access this page directly, take his ass back to home 
	header('Location: ../../../index.php?action=notauth');
	exit;
}

include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";
?>
 &nbsp;&nbsp;&nbsp;<i class="icon-user"></i> Admission: <strong>Can not be reverted.</strong>
<div align="right" style="margin-left:40px; margin-right:40px;"> <br>
<a href="modules?controller=admission_sett"><button class="btn btn-sm">Interview /Call for admission </button></a>
<a href="modules?controller=prospectus"><button class="btn btn-sm">Photo Card/Prospective Students</button></a>

</div>

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
	
	$kas_framework->getallFieldinDropdownOption('tbl_admission', 'id', 'id');
?>

</select>
Grade: <select name="adgrade"> 
 <?php  $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id');   ?>

</select>
<input class="btn btn-sm" type="submit" value="Select Batch"/>

</form>

</div>


<?php
if(isset($_POST['takeaction'])) {
	@$student = $_POST['student'];
	@$studentname = $_POST['studentname'];
	@$dowhat = $_POST['takeaction'];
	@$class_id =$_POST['entrygrade'];
	@$std_regis_no =$_POST['regno'];
	@$std_regis_from_no =$_POST['formno'];

	$classname = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $class_id);

switch($dowhat){
	case 'admit':
		$dbh->beginTransaction();

	// mark the student as admited
	$query1= "UPDATE studentbio SET admit = '1', studentbio_entry_grade ='$class_id', studentbio_internalid ='$std_regis_no' WHERE studentbio_id='$student'";
	// add the student 
	$query2= "INSERT INTO student_grade_year (student_grade_year_student,student_grade_year_year,student_grade_year_grade) VALUES('$student','$nyear','$class_id')";
	$query3= "UPDATE web_students SET form_no = '$std_regis_from_no' WHERE stdbio_id = '$student'";
	
	$dbh_query1 = $dbh->prepare($query1); $dbh_query1->execute(); $rowCount1 = $dbh_query1->rowCount(); $dbh_query1 = null;
	$dbh_query2 = $dbh->prepare($query2); $dbh_query2->execute(); $rowCount2 = $dbh_query2->rowCount(); $dbh_query2 = null;
	$dbh_query3 = $dbh->prepare($query3); $dbh_query3->execute(); $rowCount3 = $dbh_query3->rowCount(); $dbh_query3 = null;
	
	if($rowCount1 == 1 and $rowCount2 == 1 and $rowCount3 == 1){
		$dbh->commit();
		$myp->AlertSuccess('Good Job! ', 'You successfully admitted '.$studentname.' into '.$classname.' in the '.$cyear.' Academic session');
	} else {
		$dbh->rollBack();
		$myp->AlertError('Fatal Error! ', 'There is trouble with the database configuration, make sure you did not switch year backward before admission protocols.');
	}
	break;

	case 'delete':
		$myp->AlertError("Error! ", "Student cannot be Deleted at this Point");
	break;

	default:
		$myp->AlertError('Oops! ', 'Something is not right');
	}
}
?>

<div class="row-fluid sortable">

<?php 
if(isset($_SESSION['adbatch'])){// we have a class to pull data from?>

  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>Admission on :<?php 
	  $batchid = $_SESSION['adbatch'];
	  $gradeid = $_SESSION['adgrade'];
	 echo $batchname= $kas_framework->getValue('badge_name', 'tbl_admission', 'id', $batchid).'&raquo;&raquo;'.$kas_framework->getValue('grades_desc', 'grades', 'grades_id', $gradeid);
  ?></h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr style="color:blue;">
            <th width="3%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="14%">Candidate</th>
            <th width="18%">Admission Details </th>
            <th width="20%">Candidate Detail <i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="12%">Reg. Info</th>
            <th width="12%">Admission</th>
            <th width="9%">Remove</th>
          </tr>
        </thead>
        <tbody>
         
 <?php

// please consider batch
 $pullassout = "SELECT * FROM studentbio AS s, web_students AS w WHERE w.stdbio_id = s.studentbio_id AND s.admit = '0' AND s.admission_badge ='$batchid' AND s.studentbio_entry_grade='$gradeid' ORDER BY s.studentbio_id DESC";
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
		$student_entry_id = $std['studentbio_entry_grade'];
		$student_reg = $std['studentbio_internalid'];

		$std_user= $std['user_n'];
		$std_from_no= $std['form_no'];
		$std_regdate= $std['reg_date'];
		$std_ad_badge_id = $std['admission_badge'];
		// admission badge name
		$std_ad_badge_title = $kas_framework->getValue('badge_name', 'tbl_admission', 'id', $std_ad_badge_id);
		// entry class name
		$std_entry_class_title = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $student_entry_id);
		$std_exam_score = $kas_framework->getValue('exam_score', 'grade_history_primary', 'student', $rowid);
		$picture = $kas_framework->getValue('studentbio_pictures', 'studentbio', 'studentbio_id', $rowid);//we can also use stdbio_id
		
		if($picture == ''){
			$picture = 'avatar_default.png';
		}
  ?>
		 
		  <tr>
			<td><?php echo $sn;?></td>
            <td><?php echo $student_lname.', '.$student_fname.' '.$student_mname;?></td>
            <td class="center">Registered On: <b><?php echo $std_regdate;?></b>, <br />
			with the Admission Badge Name: <b><?php echo $std_ad_badge_title;?></b> </td>
            <td class="center"><div id="image">Username: <?php echo $std_user;?></div>
			
			  <p>Exam Scores: <?php echo $std_exam_score;?></p>
		    <p><a href="../../pictures/<?php echo $picture;?>" title="Image of <?php echo $std_user;?>" class="fancybox fancybox.image" ><img id="community" title="Community/Profile" src="../../pictures/<?php echo $picture;?>" alt="none" align="" style=" width:60%; height:60%;" /></a></p></td>
			<form action="" method="post">
			<td>
			   <label for="fromno"><strong>Form Number</strong></label>
			    <input name="formno" type="text" id="formno" value="<?php echo $std_from_no;?>" placeholder="Form Number"><br />
				<label for="regno"><strong>Reg No</strong></label>
			    <input name="regno" type="text" id="regno" value="<?php echo $student_reg;?>"></td>
            <td class="center"> 
			<p>
			   <label for="entrygrade"><strong>Entry Class for(<?php echo $cyear;?>)</strong></label>
			   <select name="entrygrade" id="entrygrade">
					<?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_id', 'grades_id'); ?>
				  </select>
				<input type="hidden" name="takeaction" value="admit" />
			    <input type="hidden" name="student" value="<?php echo $rowid;?>" />
			    <input type="hidden" name="studentname" value="<?php echo $student_fname;?>" />
			   
			 <input name="submit" type="submit" class="btn btn-info" value="Admit Candidate" /> <i class="icon icon-green icon-replyall"></i> </p>
			 </form>
			</td>
            <td class="center">
			
				<form action="" method="post">
			<input type="hidden" name="takeaction" value="delete" />
			<input type="hidden" name="student" value="<?php echo $rowid;?>" />
			    <input type="hidden" name="studentname" value="<?php echo $student_fname;?>" />
		   <input class="btn btn-danger" type="submit" value="Delete" /></form>			</td>
          </tr>
	<?php }
	$dbh_pullassout = null;
	// end of the  loop ?>
        </tbody>
	  </table>
	
	
	<?php 
	  if(isset($_POST['take_past_action'])){
	@$id = $_POST['id'];

	$dowhat = $_POST['take_past_action'];
	switch($dowhat){

	case 'pause':
	$Query = "UPDATE tbl_admission SET active = '0' WHERE id='$id'";
	$dbh_Query = $dbh->prepare($Query); $dbh_Query->execute(); $dbh_Query = null;
	break;
	
	case 'activate':
	$Query = "UPDATE tbl_admission SET active = '1' WHERE id='$id'";
	$dbh_Query = $dbh->prepare($Query); $dbh_Query->execute(); $rowCount = $dbh_Query->rowCount(); $dbh_Query = null;
	// add the student 
			if($rowCount == 1) {
				$myp->AlertInfo('Good! ', 'Action Successful. ');
			} else {
				$myp->AlertError('Error! ', 'Something is not right');
			}
		}
	}// switching
	?>
		<hr />
      <p><strong>Past Admission batches </strong></p>
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr style="color:blue;">
            <th width="3%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="14%">Admission batch name </th>
            <th width="18%">Reg Start </th>
            <th width="14%">Reg Ends </th>
            <th width="20%">Status</th>
            <th width="20%">Detail <i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="9%">Action<i class="icon-trash icon-red"></i></th>
          </tr>
        </thead>
        <tbody>
         
	 <?php 
		$pullassout = "SELECT * FROM tbl_admission ORDER BY id DESC";
		$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute(); 
		//studentbio_entry_grade  
		$sn = 0;
		while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {
			$sn = $sn + 1;
			$rowid = $std['id'];
			$badge = $std['badge_name'];
			$start = $std['application_starts'];
			$stop = $std['application_ends'];
			$interview_dt = $std['interview_date'];
			$interview_time = $std['interview_time'];
			$active = $std['active'];
			$instr = $std['instruction'];
			$txactive = $active;
			 if($active =='1'){
				 $active = '<span class="label label-success" style="padding:7px 5px">Open</span>';
				 //label-warning for pending
				 } else {	$active = '<span class="label label-important" style="padding:7px 5px">Closed</span>';}
	 //$start=$db->get_var("SELECT date_format(reg_date, '%D %M %Y') as date FROM web_students WHERE stdbio_id='$rowid'");//we can also use stdbio_id
	?>
		 
  <tr>
	<td><?php echo $sn;?></td>
	<td><?php echo $badge;?></td>
	<td class="center"><?php echo $start;?> </td>
	<td class="center"><?php echo $stop;?> </td>
	<td class="center"><?php echo $active;?> </td>
	<td class="center">Interview Time: <?php echo $interview_time.' '.$interview_time;?><br />Instructions:<?php echo $instr;?></td>
	
	<td class="center">
	<form action="" method="post">
	<input type="hidden" name="take_past_action" value="<?php if($txactive ==1){echo 'pause';}else{echo'activate';}?>" />
	<input type="hidden" name="id" value="<?php echo $rowid;?>" />
	
   <input class="btn btn-<?php if($txactive ==1){echo 'danger';}else{echo'success';}?>" type="submit" value="<?php if($txactive ==1){echo 'Close Application';}else{echo'Reactivate Application';}?>"> </input></form>			</td>
  </tr>
	<?php }
		$dbh_pullassout = null;
	// end of the  loop ?>
        </tbody>
      </table>

    </div>
  </div>
  
<?php }// end admission class sent ?>
  
  
  <!--/span-->
</div>