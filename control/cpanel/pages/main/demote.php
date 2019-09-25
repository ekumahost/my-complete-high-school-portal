<?php 
$title="Change Student year/ Admission Status";
if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}
include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";
?>

<div style="margin:10px; font-variant:small-caps; text-align:center; font-weight:500; font-size:15px"> <i class="icon-user"></i> Admission/Class handle: Type the child's name or reg no. in the search box to get him out </div>

<?php
	if(isset($_POST['takeaction'])){
		@$student = $_POST['student'];// student id
		@$studentname = $_POST['studentname'];
		@$dowhat = $_POST['takeaction'];
		@$class_action =$_POST['entryaction'];
		@$std_regis_no =$_POST['regno'];
		@$stdroom = $_POST['stdroom'];

		$codename = $kas_framework->getValue('title', 'tbl_admit_code', 'id', $class_action);
		$classname = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $class_action);

	switch($dowhat){
	case 'admission':

		// mark the student as admited
		$query= "UPDATE studentbio SET admit = '$class_action' WHERE studentbio_id='$student'";
		$dbh_query = $dbh->prepare($query); $checkExec = $dbh_query->execute(); $dbh_query = null;

		if ($checkExec == 1){
		echo '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">*</button>
				<strong>Good Job!</strong> You successfully changed '.$studentname.' status to :('.$codename.') in the '.$cyear.' Academic session </div>';
		} else {
		echo '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">*</button>
				<strong>Heads up!</strong> There is trouble with the database configuration, make sure you did not switch year backward before admission protocols. Run database maintenance.</div>';
		}
		break;

		case 'demote':
		// check if the student is not a graduate or admitted student, an expelled student class cannot be changes
		$std_admit_status = $kas_framework->getValue('admit', 'studentbio', 'studentbio_id', $student);

		if ($std_admit_status >= 2){
		// here the student have issue with admission
		echo '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Oh snap! legs up--</strong> This student have issue with admissions, seems like he a graduate or was expelled. Change his status to admited first.
			</div>';
			
		}else{
		// check if the student is a graduate already // nyear is current year
		$std_curret_grade_id = $kas_framework->getValueRestrict2('student_grade_year_grade', 'student_grade_year', 'student_grade_year_year', $nyear, 'student_grade_year_student', $student);

		   if($std_curret_grade_id == NULL){
		   // he is a graduate, we insert his data again: bring him bach to school
			$query = "INSERT INTO student_grade_year(student_grade_year_grade,student_grade_year_student,student_grade_year_year) VALUES('$class_action', '$student', '$nyear')";
				$dbh_query = $dbh->prepare($query); $dbh_query->execute(); $rowCount = $dbh_query->rowCount(); $dbh_query = null;

		if($rowCount == 1){
			echo '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">*</button>
				<strong>Good Job!</strong> You successfully Restored '.$studentname.' who was a graduate to :('.$classname.') in the '.$cyear.' Academic session </div>';
		} else { // not inserted
		echo '<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Heads up!</strong> There is trouble with the database configuration, or no! We got corn fussed!!!!.</div>';
		}
	 } else { // not a graduatw

	$query = "UPDATE student_grade_year SET student_grade_year_grade = '$class_action', student_grade_year_class_room = '$stdroom' WHERE student_grade_year_student='$student' AND student_grade_year_year = '$nyear'";
	$dbh_query= $dbh->prepare($query); $dbh_query->execute(); $rowCountx = $dbh_query->rowCount(); $dbh_query = null;

	if($rowCountx == 1){

	echo ' <div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">*</button>
		<strong>Good Job!</strong> You successfully changed '.$studentname.' class to :('.$classname.') in the '.$cyear.' Academic session </div>';
	} else {
		echo '<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Heads up!</strong> There was no changes made to the students profile</div>';}
		}// end he is graduate
	}// end he has admission issue						
	break;
	default:

	echo '<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>Oh snap! legs up--</strong> We got corn fussed!!!!!!!!!!.
		</div>';
		}
	}
?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>Admission Statuses and class changer </h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr style="color:blue;">
            <th width="3%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="14%">Candidate</th>
            <th width="14%">Demote/Promote </th>
            <th width="20%">Candidate Detail <i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="12%">Admission</th>
            <th width="9%">Reg No</th>
          </tr>
        </thead>
        <tbody>
         
	 <?php
		$pullassout = "SELECT * FROM studentbio WHERE admit != '0' ORDER BY studentbio_id DESC";
		$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
			//studentbio_entry_grade  
			$sn = 0;
			while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {

			$sn = $sn + 1;
			$rowid = $std['studentbio_id'];
			$student_fname = $std['studentbio_fname'];
			$student_mname = $std['studentbio_mname'];
			$student_lname = $std['studentbio_lname'];
			$student_image = $std['studentbio_pictures'];
			$student_reg = $std['studentbio_internalid'];
			$gender= $std['studentbio_gender'];
			$admitcode= $std['admit'];


		$std_admit_code_title = $kas_framework->getValue('title', 'tbl_admit_code', 'id', $admitcode);
		if ($admitcode == 0){
			$std_admit_code_title = "Pending Admission";
		}

		$std_user= $kas_framework->getValue('user_n', 'web_students', 'stdbio_id', $rowid);
		$std_exam_score = $kas_framework->getValue('exam_score', 'grade_history_primary', 'student', $rowid);

			$std_curret_grade= $kas_framework->getValueRestrict2('student_grade_year_grade', 'student_grade_year', 'student_grade_year_year', $nyear, 'student_grade_year_student', $rowid);
			//added by the ultimate keliv
			$std_current_room=$kas_framework->getValueRestrict2('student_grade_year_class_room', 'student_grade_year', 'student_grade_year_year', $nyear, 'student_grade_year_student', $rowid);
			// the class name
		$std_current_class_title =$kas_framework->getValue('grades_desc', 'grades', 'grades_id', $std_curret_grade);
		 
		 if($std_curret_grade == NULL){
			$std_current_class_title = "Graduate";
		 }
		
		$picture= $kas_framework->getValue('studentbio_pictures', 'studentbio', 'studentbio_id', $rowid);
		if($picture==NULL){
			if ($gender =="Male"){
			  $picture= 'm_avatar.png';
			} else if ($gender =="Female"){
			  $picture= 'f_avatar.png';
			} else {
			$picture = 'avatar_default.png';}
	}
 ?>
		 
		  <tr>
			<td><?php echo $sn;?></td>
            <td>FullName: <?php echo $student_lname.', '.$student_fname.' '.$student_mname;?>
			<hr />Username: <i class="icon icon-color icon-user"></i><?php echo $std_user;?>
			<p>Last Exam Scores: <?php echo $std_exam_score;?></p>
			</td>
            <td class="center">
			<form action="" method="post">
              <p>
				<i> Select new class to switch</i>
				<select name="entryaction" id="label">
                  <?php   $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id', $std_curret_grade);  ?>
                </select>
				
				Sub Room&nbsp;&nbsp;&nbsp;
				  <select name="stdroom" id="label" style="width:250px">
				  <option value="0"> Generic Room </option>
					<?php  $kas_framework->getallFieldinDropdownOption('school_rooms', 'school_rooms_desc', 'school_rooms_id', $std_current_room); ?>
                </select>
				<input name="regno" class="input-xlarge disabled" value="Reg No: <?php echo $student_reg;?>" id="disabledInput" type="text" placeholder="" disabled="">
				
                <br />
                <input type="hidden" name="takeaction" value="demote" />
                <input type="hidden" name="student" value="<?php echo $rowid;?>" />
                <input type="hidden" name="studentname" value="<?php echo $student_fname;?>" />
                <input name="submit" type="submit" class="btn btn-info" value="Change Class" />
                <i class="icon icon-green icon-replyall"></i> </p>
            </form>
		</td>
            <td class="center">
		      <p><a href="../../pictures/<?php echo $picture;?>" title="Image of <?php echo $std_user;?>" class="fancybox fancybox.image" ><img id="community" title="Community/Profile" src="../../pictures/<?php echo $picture;?>" alt="No Image Yet" align="" style=" width:100px" /></a></p></td>
			
            <td class="center">
			
			<form action="" method="post">
			  <p>			   
			   <i> Select Admission Status</i>			   
			   <select name="entryaction" id="admitcode">
			   <?php   $kas_framework->getallFieldinDropdownOption('tbl_admit_code', 'title', 'id', $admitcode);  ?>
			   </select>
			  
				<input name="regno" class="input-xlarge disabled" value="Reg No: <?php echo $student_reg;?>" id="disabledInput" type="text" placeholder="Disabled input here…" disabled="">
				<br />
				<input type="hidden" name="takeaction" value="admission" />
			    <input type="hidden" name="student" value="<?php echo $rowid;?>" />
			    <input type="hidden" name="studentname" value="<?php echo $student_fname;?>" />
			   
			 <input name="submit" type="submit" class="btn btn-info" value="Take Action" /> <i class="icon icon-green icon-replyall"></i> </p>
			</form>			</td>
            <td class="center"><?php echo $student_reg;?></td>
          </tr>
	  <?php }
		$dbh_pullassout = null;
	  // end of the  loop ?>
        </tbody>
      </table>
    </div>
  </div>
  <!--/span-->
</div>
<p>&nbsp;</p>