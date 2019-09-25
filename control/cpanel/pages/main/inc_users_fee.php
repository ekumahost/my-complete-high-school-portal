<?php 
// dont come here directly
if (!defined ('DIRECT_PASS')){echo 'who are you? HAHAHA, WHAT ARE YOU DOING, ARE YOU A HACKERS TOO?';
//header ("Location: ../../index.php?action=notauth");
	exit;} // IF THE HACKER TRY COMING TO THIS PAGE, THROW HIM TO LOGIN PAGE, DESTROY ALL SESSION AND EXIT	
//$studentid
?>

<table class="table table-striped bootstrap-datatable datatable" >
  <thead>
    <tr bgcolor="">
      <th>S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
      <th >Actual  </th>
      <th>Session</th>
      <th>Term</th>
      <th>Class</th>
      <th>Amount paid </th>
      <th>date</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
				 
		$pullassout = "SELECT * FROM payment_receipts WHERE tution_paid_by_user_id = '$studentid' AND tution_paid_type = '1' ORDER BY tuition_history_id DESC";
			$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
						
						$sn = 0;
						while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {

						$sn = $sn + 1;
						$paid_student_id = $std['tution_paid_by_user_id'];
						
						$tution_amount_paid = $std['tution_amount_paid'];
						$tution_paid_grade = $std['tution_paid_grade'];//
						$tution_paid_terms = $std['tution_paid_terms'];
						$tution_paid_date = $std['tution_paid_date'];
						$tution_amount_paid = $std['tution_amount_paid'];
						$tution_paid_sch_years = $std['tution_paid_sch_years'];//

						$cleared = $std['cleared'];
						$tution_amount_actual_SQL= "SELECT price FROM school_fees WHERE grades='$tution_paid_grade' AND grades_term='$tution_paid_terms' AND school_year='$tution_paid_sch_years' AND component='total'";//
						$dbh_tution_amount_actual = $dbh->prepare($tution_amount_actual_SQL); $dbh_tution_amount_actual->execute(); $fetchObj = $dbh_tution_amount_actual->fetch(PDO::FETCH_OBJ); $dbh_tution_amount_actual = null;
						$tution_amount_actual = $fetchObj->price;
						
						$tution_paid_grade= $kas_framework->getVaue('grades_desc', 'grades', 'grades_id', $tution_paid_grade);
						$tution_paid_sch_years= $kas_framework->getVaue('school_years_desc', 'school_years', 'school_years_id', $tution_paid_sch_years);
					
				if($cleared ==1){
					 $cleared = '<span class="label label-success">Verified</span>';
				} else if ($cleared ==0){
					$cleared = '<span class="label label-important">Unverified</span>';
				 } else {
					$cleared = '<span class="label label-important">Unknown</span>';
				 }
						
		  ?>
    <tr bgcolor="">
      <td><?php echo $sn;?></td>
      <td><span class="center"><?php echo number_format($tution_amount_actual).'.00';?></span></i></td>
      <td class="center"><?php echo $tution_paid_sch_years;?></td>
      <td class="center"><?php echo $tution_paid_terms;?></td>
      <td class="center"><?php echo $tution_paid_grade;?></td>
      <td class="center"><?php echo number_format($tution_amount_paid).'.00';?></td>
      <td class="center"><?php echo $tution_paid_date;?></td>
      <td class="center"><?php echo $cleared;?></td>
    </tr>
    <?php }
		$dbh_pullassout = null;
	?>
  </tbody>
</table>