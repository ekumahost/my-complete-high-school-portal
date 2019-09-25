<?php 
// dont come here directly
if (!defined ('DIRECT_PASS')){echo 'who are you? HAHAHA, WHAT ARE YOU DOING, ARE YOU A HACKERS TOO?';
//header ("Location: ../../index.php?action=notauth");
	exit;} // IF THE HACKER TRY COMING TO THIS PAGE, THROW HIM TO LOGIN PAGE, DESTROY ALL SESSION AND EXIT
?>


<table class="table table-striped bootstrap-datatable datatable" width="100%">
  <thead>
    <tr bgcolor="">
      <th width="4%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
      <th width="8%">Actual  </th>
      <th width="12%">Session</th>
      <th width="5%">Term</th>
      <th width="24%">Class</th>
      <th width="24%">Amount paid </th>
      <th width="9%">Hostel</th>
      <th width="9%">date</th>
      <th width="14%">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
				 
		$pullassout = "SELECT * FROM payment_receipts WHERE tution_paid_by_user_id = '$studentid' AND tution_paid_type = '2' ORDER BY tuition_history_id DESC";
			$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
			$sn = 0;
			while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {

			$sn = $sn + 1;
			
			$tution_amount_paid = $std['tution_amount_paid'];
			$tution_paid_grade = $std['tution_paid_grade'];//
			$tution_paid_terms = $std['tution_paid_terms'];
			$tution_paid_date = $std['tution_paid_date'];
			$tution_amount_paid = $std['tution_amount_paid'];
			$tution_paid_sch_years = $std['tution_paid_sch_years'];//

			$cleared = $std['cleared'];
			
			// what hostel did he pay for 
			$SQLYog = "SELECT bed_space FROM hostels_allocation WHERE student='$studentid' AND term='$tution_paid_terms' AND session='$tution_paid_sch_years'";//
			$dbh_paid_bed_space = $dbh->prepare($SQLYog); $dbh_paid_bed_space->execute(); $fetchObjX = $dbh_paid_bed_space->fetch(PDO::FETCH_OBJ); $dbh_paid_bed_space = null;
			$paid_bed_space = $fetchObjX->bed_space;
			
			$paid_bed_space_hostel= $kas_framework->getValue('hostel', 'hostels_bed_space', 'id', $paid_bed_space); 
			
			$SQLYog2= "SELECT fee FROM hostels_fees WHERE hostel='$paid_bed_space_hostel' AND term='$tution_paid_terms' AND session='$tution_paid_sch_years'";//
			$dbh_hostel_fees = $dbh->prepare($SQLYog2); $dbh_hostel_fees->execute(); $fetchObjY = $dbh_hostel_fees->fetch(PDO::FETCH_OBJ); $dbh_hostel_fees = null;
			$tution_amount_actual = $fetchObjY->hostels_fees;
			// the hostel name 
			$hostel_name= $kas_framework->getValue('name', 'hostels', 'id', $paid_bed_space_hostel); 
	
			$tution_paid_grade= $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $tution_paid_grade);
			$tution_paid_sch_years= $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $tution_paid_sch_years);//
	
				if($cleared ==1){
					 $cleared = '<span class="label label-success">Verified</span>';
				} else if ($cleared ==0) {
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
      <td class="center"><?php echo $hostel_name;?></td>
      <td class="center"><?php echo $tution_paid_date;?></td>
      <td class="center"><?php echo $cleared;?></td>
    </tr>
    <?php } 
		$dbh_pullassout = null;
	?>
  </tbody>
</table>