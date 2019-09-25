<?php 
// dont come here directly
if (!defined ('DIRECT_PASS')){echo 'who are you? HAHAHA, WHAT ARE YOU DOING, ARE YOU A HACKERS TOO?';
//header ("Location: ../../index.php?action=notauth");
	exit;} // IF THE HACKER TRY COMING TO THIS PAGE, THROW HIM TO LOGIN PAGE, DESTROY ALL SESSION AND EXIT
?>

<div style="margin-left:20px">
<h1><strong>General School Fee</strong></h1> 
<?php if(isset($_GET['myaction'])){
	$to_id = DecodeToken($_GET['id']);

	$updateme = "UPDATE payment_receipts SET cleared = '1' WHERE tuition_history_id = '$to_id'";
	$dbh_updateme = $dbh->prepare($updateme); $dbh_updateme->execute(); $rowCount = $dbh_updateme->rowCount(); $dbh_updateme = null;

	if ($rowCount > 0){
		echo '<font color="green">School Fee Verified </font>';
	}else{
		echo '<font color="red">Verification failed </font>';
		}
	} 
?>
<br />
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>School Fee for the current Session's Term- <strong><?php echo $cterm.'('.$cyear.')';?></strong></h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
    
	
 <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr>
            <th width="4%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="9%">Student</th>
            <th width="4%">Payee</th>
            <th width="3%">Grade paid </th>
            <th width="6%">payment date </th>
            <th width="6%"> <a href="#" title="fee are paid in Naira">Amount </a></th>
            <th width="4%"><a href="#" title="">Status</a></th>
            <th width="5%">Action</th>
            <th width="4%">Clearance</th>
          </tr>
        </thead>
        <tbody>
         
	<?php
				 
	$pullfees = "SELECT * FROM payment_receipts WHERE tution_paid_sch_years ='$current_year' AND tution_paid_terms ='$current_term' AND tution_paid_type ='1' ORDER BY tuition_history_id DESC";
	$dbh_pullfees = $dbh->prepare($pullfees); $dbh_pullfees->execute();
	
	$sn = 0;
	while ($listh = $dbh_pullfees->fetch(PDO::FETCH_ASSOC)) {
	$sn = $sn + 1;
	$id = $listh['tuition_history_id'];
	$student = $listh['tution_paid_by_user_id'];
   $payee = $listh['tution_paid_by_std_par'];
   $amount = $listh['tution_amount_paid'];
   $paid_grade = $listh['tution_paid_grade'];
   $paid_date = $listh['tution_paid_date'];
   $cleared = $listh['cleared'];
		
	// pic the student details
	$student_id = $kas_framework->getValue('studentbio_id', 'studentbio', 'studentbio_id', $student); 
	$student_fname = $kas_framework->getValue('studentbio_fname', 'studentbio', 'studentbio_id', $student); 
	$student_lname =$kas_framework->getValue('studentbio_lname', 'studentbio', 'studentbio_id', $student); 
	// the grade
	$student_grade = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $paid_grade); 

	if($cleared==1){
		$status = "Cleared";
		$css = 'success';
	}else{
		$status = "Not cleared";
		$css = 'important';

	}
$fee = 'N'.number_format($amount).'.00';

  ?>
		 
		  <tr>
			<td><?php echo $sn;?></td>
            <td class="center"> <a href="main?page=view_users&id=<?php EncodeToken($student_id);?>" target="_blank" title="click to see profile"><?php echo $student_fname.' '.$student_lname;?> </a></td>
            <td class="center"><?php echo $payee;?> </td>
            <td class="center"><span style="margin-right:10px"><?php echo $student_grade;?></span></td>
            <td class="center"><?php echo $paid_date;?></td>
            <td class="center"><?php echo $fee;?></td>
            <td class="center"><span title="" class="label label-<?php echo $css;?>" href="">  <?php echo $status;?></span></td>
            <td class="center"><a  title=""class="btn btn-info" href="#"> <i class="icon-zoom-in icon-white"></i> Manage </a> </td>
            <td class="center"><?php if($cleared==1){?>
			<em>Verified</em>
			
			<?php }else{?>
			
			<a title="mark as cleared(not reversible)" class="btn btn-success" href="modules?controller=payments&tool=fees&myaction=clear&id=<?php EncodeToken($id);?>">  Clear</a>
			
			<?php }?>
			</td>
          </tr>
		  
		  
		  
	  <?php }
	   $dbh_pullfees = null;
	  ?>
        </tbody>
      </table>	
	
  </div>
  </div>
  <!--/span-->
</div>