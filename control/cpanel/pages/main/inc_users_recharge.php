<?php 
// dont come here directly
if (!defined ('DIRECT_PASS')){echo 'who are you? HAHAHA, WHAT ARE YOU DOING, ARE YOU A HACKERS TOO?';
//header ("Location: ../../index.php?action=notauth");
	exit;} // IF THE HACKER TRY COMING TO THIS PAGE, THROW HIM TO LOGIN PAGE, DESTROY ALL SESSION AND EXIT
	
	// the student paid hostel fee
//$studentid

$total_recharge= "SELECT SUM(tution_amount_recharged) as retotal from payment_recharge_receipts WHERE tution_recharge_by_user_id='$studentid'";
$dbh_total_recharge = $dbh->prepare($total_recharge); $dbh_total_recharge->execute(); $fetchObj = $dbh_total_recharge->fetch(PDO::FETCH_OBJ); $dbh_total_recharge = null;
$total_recharges = $fetchObj->retotal;
 
 $student_walletb = $kas_framework->getValue('balance', 'student_wallet', 'student_id', $studentid)
?>

Total Recharged: <strong>N<?php echo number_format($total_recharges);?>.00</strong>; Student Balance 
<strong>N<?php echo number_format($student_walletb.'.00') ;?></strong>
<br /><br />
<table class="table table-striped bootstrap-datatable datatable" width="100%">
  <thead>
    <tr bgcolor="">
      <th width="4%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
      <th width="12%">Session</th>
      <th width="5%">Term</th>
      <th width="24%">Grade</th>
      <th width="24%">Amount Recharged </th>
      <th width="9%">Payee</th>
      <th width="9%">date</th>
      <th width="14%">Means</th>
    </tr>
  </thead>
  <tbody>
    <?php
				 
$pullassout = "SELECT * FROM payment_recharge_receipts WHERE tution_recharge_by_user_id = '$studentid' ORDER BY tuition_history_id DESC";
		$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
		$sn = 0;
		while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {

		$sn = $sn + 1;
		
		$tution_amount_paid = $std['tution_amount_recharged'];
		$tution_paid_grade = $std['tution_recharge_grade'];//
		$tution_paid_terms = $std['tution_recharge_terms'];
		$tution_paid_date = $std['tution_recharge_date'];
		$means = $std['recharge_means'];
		$tution_paid_sch_years = $std['tution_recharge_sch_years'];//
		$tution_recharge_by_std_par = $std['tution_recharge_by_std_par'];//

		// what hostel did he pay for 
		/* $tution_amount_S = "SELECT fee FROM hostels_fees WHERE hostel='$paid_bed_space_hostel' AND term='$tution_paid_terms' AND session='$tution_paid_sch_years'";//
		$dbh_tution_amount_actual = $dbh->prepare($tution_amount_S); $dbh_tution_amount_actual->execute(); $fetchObj = $dbh_tution_amount_actual->fetch(PDO::FETCH_OBJ); $dbh_tution_amount_actual = null;
		$tution_amount_actual = $fetchObj->fee;
		
		$paid_bed_space = "SELECT bed_space FROM hostels_allocation WHERE student='$studentid' AND term='$tution_paid_terms' AND session='$tution_paid_sch_years'";//
		$dbh_paid_bed_space = $dbh->prepare($paid_bed_space); $dbh_paid_bed_space->execute(); $fetchObjX = $dbh_paid_bed_space->fetch(PDO::FETCH_OBJ); $dbh_paid_bed_space = null;
		$paid_bed_space = $fetchObjX->bed_space;
		
		$paid_bed_space_hostel= $kas_framework->getValue('hostel', 'hostels_bed_space', 'id', $paid_bed_space);
			
			// the hostel name 
		$hostel_name= $kas_framework->getValue('name', 'hostels', 'id', $paid_bed_space_hostel);*/
		$tution_paid_grade= $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $tution_paid_grade);
		$tution_paid_sch_years=$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $tution_paid_sch_years);
?>
    <tr bgcolor="">
      <td><?php echo $sn;?></td>
      <td class="center"><?php echo $tution_paid_sch_years;?></td>
      <td class="center"><?php echo $tution_paid_terms;?></td>
      <td class="center"><?php echo $tution_paid_grade;?></td>
      <td class="center"><?php echo number_format($tution_amount_paid).'.00';?></td>
      <td class="center"><?php echo $tution_recharge_by_std_par;?></td>
      <td class="center"><?php echo $tution_paid_date;?></td>
      <td class="center"><?php echo $means;?></td>
    </tr>
    <?php }
		$dbh_pullassout = null;
	?>
  </tbody>
</table>