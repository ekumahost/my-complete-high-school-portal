<?php
@session_start();
(file_exists('../../../php.files/classes/kas-framework.php'))? include ('../../../php.files/classes/kas-framework.php'): include ('../../../../php.files/classes/kas-framework.php');
include_once "../../../includes/common.php";
// config
include_once "../../../includes/configuration.php";
$current_year = $_SESSION['CurrentYear'];
$current_term = $_SESSION['CurrentTerm'];


if (isset($_GET['delete_Student'])) {
	extract($_POST);
	//print $studentID;
	$updateStudent = "UPDATE studentbio SET studentbio_form_master = '' WHERE studentbio_id = '".$studentID."'";
	$dbh_updateStudent = $dbh->prepare($updateStudent); $dbh_updateStudent->execute(); $fetchObj = $dbh_updateStudent->rowCount(); $dbh_updateStudent = null;
		if ($fetchObj == 1) {
			?><script type="text/javascript">
			$('.studentDIV'+<?php print $studentID ?>).hide();	
			</script><?php
		} else {
			?><script type="text/javascript">
			alert("Could not delete this Student from the teacher. Please try again");
			</script><?php	
		}
	exit;
}

if (isset($_GET['add_Student'])) {
	extract($_POST);
	$total_selected = count($studentID);
		
	foreach($studentID AS $stdz) {						
		//retrieving all the students details for clearification
		$getFullStdDetail = "SELECT * FROM studentbio AS sb, student_grade_year AS sgy WHERE sb.studentbio_id = '".$stdz."'
		AND sb.studentbio_id = sgy.student_grade_year_student AND sgy.student_grade_year_year = '".$current_year."'";
		$dbh_getFullStdDetail = $dbh->prepare($getFullStdDetail); $dbh_getFullStdDetail->execute(); $getFullStdDetailObj = $dbh_getFullStdDetail->fetch(PDO::FETCH_OBJ);
								
			$checkFormMaster_SQL ="SELECT * FROM studentbio WHERE studentbio_id = '".$stdz."' LIMIT 1";
			$dbh_checkFormMaster = $dbh->prepare($checkFormMaster_SQL); $dbh_checkFormMaster->execute(); $checkFormMaster = $dbh_checkFormMaster->fetch(PDO::FETCH_OBJ); $dbh_checkFormMaster = null;
			
				if ($checkFormMaster->studentbio_form_master == '' or $checkFormMaster->studentbio_form_master == '0') {
					$updateStudent = "UPDATE studentbio SET studentbio_form_master = '".$staffID."' WHERE studentbio_id = '".$stdz."'";
						$dbh_updateStudent = $dbh->prepare($updateStudent); $dbh_updateStudent->execute(); $rowCountD = $dbh_updateStudent->rowCount(); $dbh_updateStudent = null;
							if ($rowCountD == 1) {
								?><script type="text/javascript">
									$('#tableData<?php print $staffID ?>').append('<div id="designer" class="studentDIV"><a href="../../pictures/<?php print $getFullStdDetailObj->studentbio_pictures ?>" class="fancybox fancybox.image"><img src="../../pictures/<?php print $getFullStdDetailObj->studentbio_pictures ?>" height="40px" /></a>Name: <a href="main?page=view_users&id=<?php print $getFullStdDetailObj->studentbio_id ?>" target="_blank"><?php print $getFullStdDetailObj->studentbio_lname.' '.$getFullStdDetailObj->studentbio_fname ?></a> | Sex: <?php print $getFullStdDetailObj->studentbio_gender ?> | Class: <?php print $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $getFullStdDetailObj->student_grade_year_grade)?> <br/>Date Of Birth: <?php print $getFullStdDetailObj->studentbio_dob ?> <a href="">To Delete? Refresh</a></div>');	
								</script><?php
							} else {
								print 'Operation to add the student 
									'.$getFullStdDetailObj->studentbio_fname.' '.$getFullStdDetailObj->studentbio_lname.' failed';
							}
				} else {
						
					$getFullStaffDetail = "SELECT * FROM staff WHERE staff_id = '".$checkFormMaster->studentbio_form_master."'";
					$dbh_getFullStaffDetail = $dbh->prepare($getFullStaffDetail); $dbh_getFullStaffDetail->execute(); $getFullStaffDetailObj = $dbh_getFullStaffDetail->fetch(PDO::FETCH_OBJ); $dbh_getFullStaffDetail = null;
			
					?><script type="text/javascript">
						$('#tableData<?php print $staffID ?>').append('<?php print $getFullStdDetailObj->studentbio_lname.' '.$getFullStdDetailObj->studentbio_fname ?> is already assigned to " <?php print $getFullStaffDetailObj->staff_fname .' '.$getFullStaffDetailObj->staff_lname ?>"<br />');	
					</script><?php
				}				
		}
		$dbh_getFullStdDetail = null;
		exit;
}
?>