<?php 
$title="Academic Adviser";

if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}

include_once "../includes/common.php";

// config
include_once "../includes/configuration.php";
$current_year = $_SESSION['CurrentYear'];
$current_term = $_SESSION['CurrentTerm'];

// count number of parents
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
<style type="text/css">
#designer { padding:5px; margin:3px 1px; border:1px solid #000; }
#designer img {float:right; margin:0 0 0 4px; }
</style>
<div id="unanimousDIV"></div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i> Students and their Academic Adviser</h2>
	  <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
	</div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr bgcolor="">
            <th>S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th>Staff Details</th>
            <th>Staff Image</th>
            <th width="40%">Staff Students </th>
            <th>Add Action</th>
          </tr>
        </thead>
        <tbody>
        <?php $getStaff = "SELECT * FROM staff WHERE staff_status = '1' LIMIT $sort_srt, 1000";
			$dbh_getStaff = $dbh->prepare($getStaff); $dbh_getStaff->execute();
			$serial = 0;
				while ($staffObj = $dbh_getStaff->fetch(PDO::FETCH_OBJ)) {
					$serial = $serial + 1;
					print '	<tr>
								<td>'.$serial.'</td>
								<td>Name: <a href="main?page=view_staff&id='.EncoderToken($staffObj->staff_id).'" target="_blank">'.$staffObj->staff_fname. ' '.$staffObj->staff_lname.' '.$staffObj->staff_mi.'</a><br />Sex: '.$staffObj->staff_sex.' <br />Email: '.$staffObj->staff_email.' <br />
								Mobile: '.$staffObj->staff_mobile.'</td>
								<td><a href="../../pictures/'.$staffObj->staff_image.'" class="fancybox fancybox.image"><img src="../../pictures/'.$staffObj->staff_image.'" height="60px" /></a></td><td id="tableData'.$staffObj->staff_id.'">';
					// getting the students under him, we run this crazy query and mess around with it a little.
					
							$getStdQuery = "SELECT * FROM studentbio AS sb, student_grade_year AS sgy, teacher_grade_year AS tgy 
									WHERE sb.studentbio_form_master = '".$staffObj->staff_id."' AND sgy.student_grade_year_student = sb.studentbio_id 
									AND tgy.teacher = '".$staffObj->staff_id."' AND sgy.student_grade_year_year = '".$current_year."'
									AND tgy.session = '".$current_year."' AND sgy.student_grade_year_year = tgy.session ";
								$dbh_getStdQuery = $dbh->prepare($getStdQuery); $dbh_getStdQuery->execute(); 
									while ($d = $dbh_getStdQuery->fetch(PDO::FETCH_OBJ)) {
										print '<div id="designer" class="studentDIV'.$d->studentbio_id.'">
										<a href="../../pictures/'.$d->studentbio_pictures.'" class="fancybox fancybox.image">
										<img src="../../pictures/'.$d->studentbio_pictures.'" height="40px" /></a>
										Name: <a href="main?page=view_users&id='.EncoderToken($d->studentbio_id).'" target="_blank">
										'.$d->studentbio_lname.' '.$d->studentbio_fname.'</a> | Sex: '.$d->studentbio_gender.'
										 | Class: '.getValue('grades_desc', 'grades', 'grades_id', $d->student_grade_year_grade).' <br/>
						Date Of Birth: '.$d->studentbio_dob.' <a href="#" class="deleteComm" studentID="'.$d->studentbio_id.'">Delete this Student?</a>
										</div>';
									}
									$dbh_getStdQuery = null;
								print '</td><td><form action="" method="post">
								<select class="studentID'.$staffObj->staff_id.'" multiple data-rel="chosen" style="width:160px"><option></option>';
						//selecting all the students from the database, we have the following script
						$getStdsFrmDB = "SELECT * FROM studentbio WHERE admit = '1'";
							$dbh_getStdsFrmDB = $dbh->prepare($getStdsFrmDB); $dbh_getStdsFrmDB->execute(); 
								while ($getStdFrmDBobj = $dbh_getStdsFrmDB->fetch(PDO::FETCH_OBJ)) {
									print '<option value="'.$getStdFrmDBobj->studentbio_id.'">
									'.$getStdFrmDBobj->studentbio_lname.' '.$getStdFrmDBobj->studentbio_fname.' </option>';
								}
						$dbh_getStdsFrmDB = null;
					print '</select><br />
					<input type="submit" class="btn btn-sm btn-primary addStdFormButton" staffDis = "'.$staffObj->staff_id.'" value="Assign to Staff"></form></td></tr>';
				}
				$dbh_getStaff = null;
				?>
        </tbody>
      </table>
  
<?php
// start working ends, this is the third place worked
echo 'Total Teachers: <strong>'.number_format($biototal).'</strong><br><br>';
	if($biototal > 1000){
		if(!isset($_GET['break_p'])){$groupid=1;}
	echo '<br>You now have large number of wallets in your db; total: '.$biototal.' we have put them into page groups, the ones bellow are more of them <br><br><br> Viewing page group:'.'<strong>'.$groupid.'</strong>'.'<br>';
	// then we loop the page grout in a page grouping link
	for($bp = 1; $bp <= $break_p; $bp++){
		echo '<a href="modules?controller=wallet&break_p='.$bp.'">PG'.$bp.' </a>&raquo;';
	}// end for loop
  }// end biototal is 1000
?>
</div>
  </div>
  <!--/span-->
</div>
<script type="text/javascript">
	$('.deleteComm').on('click', function(e){
		question = window.confirm('Do you want to remove this student from this staff?');	
			if (question == true) {
				studentID = $(this).attr('studentID');
					$.post('pages/modules/academicAdviser_functions.php?delete_Student', {studentID:studentID}, function(dataRet){
						$('#unanimousDIV').html(dataRet);	
					})
			}
		return false;
	})
	
	$('.addStdFormButton').on('click', function(data){
		staffDistinguisher = $(this).attr('staffDis');
		studentID = $('.studentID'+staffDistinguisher).val();
		if (studentID == null) {
			alert('Please Select a Student to add. You can select multiple students');
		} else {
			$.post('pages/modules/academicAdviser_functions.php?add_Student', {studentID:studentID, staffID:staffDistinguisher}, function(dataRet){
				$('#unanimousDIV').html(dataRet);	
			})
		}
		
		return false;	
	})
</script>