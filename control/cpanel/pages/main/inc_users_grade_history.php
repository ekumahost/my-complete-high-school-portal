<?php 
// dont come here directly
if (!defined ('DIRECT_PASS')){echo 'who are you? HAHAHA, WHAT ARE YOU DOING, ARE YOU A HACKERS TOO?';
//header ("Location: ../../index.php?action=notauth");
	exit;} // IF THE HACKER TRY COMING TO THIS PAGE, THROW HIM TO LOGIN PAGE, DESTROY ALL SESSION AND EXIT

?>

<b>Student Class History</b><br /><br />
<table class="table table-striped bootstrap-datatable datatable" width="100%">
  <thead>
    <tr bgcolor="">
      <th width="4%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
      <th width="12%">Session</th>
      <th width="24%">Grade</th>
      <th width="14%">Class Room </th>
    </tr>
  </thead>
  <tbody>
    <?php
				 
	$pullassout = "SELECT * FROM student_grade_year WHERE student_grade_year_student = '".$studentid."' ORDER BY student_grade_year_grade DESC";
	$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
		$sn = 0;
		while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {
		$sn = $sn + 1;		
		//$gradestudent = $std['student_grade_year_student'];
		$gradesession = $std['student_grade_year_year'];
		$gradeclass = $std['student_grade_year_grade'];
		$graderoom = $std['student_grade_year_class_room'];
		
			$gradesession = $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $gradesession);
			$gradeclass= $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $gradeclass);
			$graderoom= $kas_framework->getValue('school_rooms_desc', 'school_rooms', 'school_rooms_id', $graderoom);
                 if(empty($graderoom)){$graderoom=$gradeclass.' class';}
		
?>
    <tr bgcolor="">
      <td><?php echo $sn;?></td>
      <td class="center"><?php echo $gradesession;?></td>
      <td class="center"><?php echo $gradeclass;?></td>
      <td class="center"><?php echo $graderoom;?></td>
    </tr>
    <?php } 
		$dbh_pullassout = null;
	?>
  </tbody>
</table>
