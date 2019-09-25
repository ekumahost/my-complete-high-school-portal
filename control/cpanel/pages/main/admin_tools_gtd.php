<?php
// dont come here directly
if (!defined ('DIRECT_PASS')){
	header ("Location: http://hisp.kastechnet.com/help+faq");
	exit;
}             			  
$show_edit_Table = true; //to show the edit table
?>

<div style="padding:20px;">
<?php if(isset($_GET['editdays'])){

	// dont come here directly
	if (!defined ('DIRECT_PASS')){echo 'who are you? HAHAHA, WHAT ARE YOU DOING, ARE YOU A HACKERS TOO?';
	//header ("Location: ../../index.php?action=notauth");
		exit;
	} // IF THE HACKER TRY COMING TO THIS PAGE, THROW HIM TO LOGIN PAGE, DESTROY ALL SESSION AND EXIT


	$edit_session = $_GET['s_id'];
	$edit_s_name = $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $edit_session);

	$term1_SQL = "SELECT * FROM grade_terms_days WHERE grade_terms_days_session='$edit_session' AND grade_terms_days_term='1'";
	$dbh_term1_SQL = $dbh->prepare($term1_SQL); $dbh_term1_SQL->execute(); $fetchObj1 = $dbh_term1_SQL->fetch(PDO::FETCH_OBJ); $dbh_term1_SQL = null;

	$term2_SQL = "SELECT * FROM grade_terms_days WHERE grade_terms_days_session='$edit_session' AND grade_terms_days_term='2'";
	$dbh_term2_SQL = $dbh->prepare($term2_SQL); $dbh_term2_SQL->execute(); $fetchObj2 = $dbh_term2_SQL->fetch(PDO::FETCH_OBJ); $dbh_term2_SQL = null;

	$term3_SQL = "SELECT * FROM grade_terms_days WHERE grade_terms_days_session='$edit_session' AND grade_terms_days_term='3'";
	$dbh_term3_SQL = $dbh->prepare($term3_SQL); $dbh_term3_SQL->execute(); $fetchObj3 = $dbh_term3_SQL->fetch(PDO::FETCH_OBJ); $dbh_term3_SQL = null;


	$edit_f = $fetchObj1->grade_terms_days_no_of_days;
	$fterm_res=$fetchObj1->resumption;
	$fterm_vac=$fetchObj1->vacation;
	$edit_s = $fetchObj2->grade_terms_days_no_of_days;
	$sterm_res=$fetchObj2->resumption;
	$sterm_vac=$fetchObj2->vacation;
	$edit_t = $fetchObj3->grade_terms_days_no_of_days;
	$tterm_res=$fetchObj3->resumption;
	$tterm_vac=$fetchObj3->vacation;

	//$fterm_res = FormatDateKelvin($dbdate);
	// make it the Kelvin date format in db
	$fterm_res = substr($fterm_res, -4).'-'.substr($fterm_res, -7, 2).'-'.substr($fterm_res, 0, 2);
	$sterm_res = substr($sterm_res, -4).'-'.substr($sterm_res, -7, 2).'-'.substr($sterm_res, 0, 2);
	$tterm_res = substr($tterm_res, -4).'-'.substr($tterm_res, -7, 2).'-'.substr($tterm_res, 0, 2);

	$fterm_vac = substr($fterm_vac, -4).'-'.substr($fterm_vac, -7, 2).'-'.substr($fterm_vac, 0, 2);
	$sterm_vac = substr($sterm_vac, -4).'-'.substr($sterm_vac, -7, 2).'-'.substr($sterm_vac, 0, 2);
	$tterm_vac = substr($tterm_vac, -4).'-'.substr($tterm_vac, -7, 2).'-'.substr($tterm_vac, 0, 2);


?>
<hr />
<h2>Grade Term Days Editor For <?php echo $edit_s_name;?> Session</h2><br />
<?php 
$myp->AlertImportant('Hey Admin! ', 'Please Take note that the Date format here is yyyy-mm-dd if the date control format dosent appear because of your browser. eg. 2015-09-30');
if($edit_f == ''){
	$myp->AlertError('Error Occured! ', 'A fatal Error Occured with this Session Configuration, Contact Teranig or <a href="?page=administrative&tool=gtd&editdays=true&s_id='.$_GET['s_id'].'&fix=session#EDITZONE" class="btn btn-default btn-sm">Fix this Issue?</a>');
		//added by the ultimate keliv
		if (isset($_GET['fix']) == 'session') {
			$countQuery = 0;
			$dbh->beginTransaction();
			for ($term=1; $term<=3; $term++) {
				$Query = "INSERT INTO grade_terms_days (grade_terms_days_session, grade_terms_days_term, grade_terms_days_no_of_days) VALUES ('".$_GET['s_id']."', '".$term."', '60')";
				$dbh_Query = $dbh->prepare($Query); $dbh_Query->execute(); $rowCount = $dbh_Query->rowCount(); 
				if ($rowCount == 1) { $countQuery = $countQuery + 1; }
			}
			$dbh_Query = null;
			if ($countQuery == 3) {
				$dbh->commit();
				$myp->AlertSuccess("Great Work Admin! ", "Issues Fixed with the Session. You can now Set the days with this Session");
			} else {
				$dbh->rollBack();
				$myp->AlertError('Fatal Error! ', 'Please Contact Kastech. <a class="btn btn-sm btn-default" href="http://hisp.kastechnet.com/report"> Click Here</a>');
			}
		}
}

if(isset($_POST['editmyass'])){
	// he wants to edit the term days
	// collect the edit varables
	$myedit_s_id = $_POST['editmyass'];// session to edit
	$myedit_s_f = $_POST['Firstterm'];
	$myedit_s_s = $_POST['secondterm'];
	$myedit_s_t = $_POST['thirdterm'];

	// collect the resumtion dates from html5 form and format to kelvin date style
	$ed_res_date1 = $_POST['ed_res_date1'];
	$ed_res_date1 = substr($ed_res_date1, -2).'/'.substr($ed_res_date1, -5, 2).'/'.substr($ed_res_date1, 0, 4);
	$ed_res_date2 = $_POST['ed_res_date2'];
	$ed_res_date2 = substr($ed_res_date2, -2).'/'.substr($ed_res_date2, -5, 2).'/'.substr($ed_res_date2, 0, 4);
	$ed_res_date3 = $_POST['ed_res_date3'];
	$ed_res_date3 = substr($ed_res_date3, -2).'/'.substr($ed_res_date3, -5, 2).'/'.substr($ed_res_date3, 0, 4);
	// the vacation dates
	$ed_vac_date1 = $_POST['ed_vac_date1'];
	$ed_vac_date1 = substr($ed_vac_date1, -2).'/'.substr($ed_vac_date1, -5, 2).'/'.substr($ed_vac_date1, 0, 4);
	$ed_vac_date2 = $_POST['ed_vac_date2'];
	$ed_vac_date2 = substr($ed_vac_date2, -2).'/'.substr($ed_vac_date2, -5, 2).'/'.substr($ed_vac_date2, 0, 4);
	$ed_vac_date3 = $_POST['ed_vac_date3'];
	$ed_vac_date3 = substr($ed_vac_date3, -2).'/'.substr($ed_vac_date3, -5, 2).'/'.substr($ed_vac_date3, 0, 4);

	$dbh->beginTransaction();
	$process_a  = "UPDATE grade_terms_days SET grade_terms_days_no_of_days ='$myedit_s_f', resumption ='$ed_res_date1', vacation ='$ed_vac_date1' WHERE grade_terms_days_session='$myedit_s_id' AND grade_terms_days_term ='1'";
	$dbh_process_a = $dbh->prepare($process_a); $dbh_process_a->execute(); $rowCount1 = $dbh_process_a->rowCount(); $dbh_process_a = null;
	
	$process_b  = "UPDATE grade_terms_days SET grade_terms_days_no_of_days ='$myedit_s_s', resumption ='$ed_res_date2', vacation ='$ed_vac_date2' WHERE grade_terms_days_session='$myedit_s_id' AND grade_terms_days_term ='2'";
	$dbh_process_b = $dbh->prepare($process_b); $dbh_process_b->execute(); $rowCount2 = $dbh_process_b->rowCount(); $dbh_process_b = null;
	
	$process_c  = "UPDATE grade_terms_days SET grade_terms_days_no_of_days ='$myedit_s_t', resumption ='$ed_res_date3', vacation ='$ed_vac_date3' WHERE grade_terms_days_session='$myedit_s_id' AND grade_terms_days_term ='3'";
	$dbh_process_c = $dbh->prepare($process_c); $dbh_process_c->execute(); $rowCount3 = $dbh_process_c->rowCount(); $dbh_process_c = null;
	
		if ($rowCount1 == 1 or $rowCount2 == 1 or $rowCount3 == 1) {
			$dbh->commit();
			$myp->AlertSuccess('Great! ', 'Term days are Defined as: '.$myedit_s_f.', '.$myedit_s_s.' and '.$myedit_s_t.'. Before You Proceed, Please Check the Table Below');
			$show_edit_Table = false;
		} else {
			$myp->AlertError('Fatal Error! ', 'Please Contact Kastech. <a class="btn btn-sm btn-default" href="http://hisp.kastechnet.com/contact"> Click Here</a>');
			$dbh->rollBack();
			$show_edit_Table = false;
		}
	print '<br />';
	

}
	if ($show_edit_Table == true) {
		?>
		<form action="" method="post">
		<input type="hidden" name="editmyass" value="<?php echo $edit_session;?>" />
		<strong>Number of days in first term</strong>  <input name="Firstterm" type="number" style="width:80px" value="<?php echo $edit_f;?>" />days. <strong>Resumption</strong>: <input name="ed_res_date1" type="date" value="<?php echo $fterm_res;?>" /> Vacation: <input name="ed_vac_date1" type="date" value="<?php echo $fterm_vac;?>" /><hr />
		Number of days in Second term <input name="secondterm" type="number" style="width:80px" value="<?php echo $edit_s;?>" />days <strong>Resumption</strong>: <input name="ed_res_date2" type="date" value="<?php echo $sterm_res;?>" /> Vacation: <input name="ed_vac_date2" type="date" value="<?php echo $sterm_vac;?>" /><br /><hr />
		Number of days in Third term  <input name="thirdterm" style="width:80px" type="number" value="<?php echo $edit_t;?>" />days <strong>Resumption</strong>: <input name="ed_res_date3" type="date" value="<?php echo $tterm_res;?>" /> Vacation: <input name="ed_vac_date3" type="date" value="<?php echo $tterm_vac;?>" /><br />
		<center><input type="submit" class="btn btn-default btn-large" value="Update Session" /></center><br />

		<?php 
	}
}// edit days ends
?>

</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>School Term days <?php //echo $db_name;?></h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr bgcolor="">
            <th width="4%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="13%">Session</th>
            <th width="20%">First Term </th>
            <th width="20%">Second Term </th>
            <th width="19%">Third term </th>
            <th width="12%">Total Days </th>
            <th width="12%">Action</th>
          </tr>
        </thead>
        <tbody>
         
		 <?php
		 
				$pulldays = "SELECT * FROM school_years ORDER BY school_years_id DESC";
				$dbh_pulldays = $dbh->prepare($pulldays); $dbh_pulldays->execute();
				$sn = 0;
				while ($qty = $dbh_pulldays->fetch(PDO::FETCH_ASSOC)) {

				$sn = $sn + 1;
				$mysession_id = $qty['school_years_id'];
				$mysession_name = $qty['school_years_desc'];
					
					$term1_SQL1 = "SELECT * FROM grade_terms_days WHERE grade_terms_days_session='$mysession_id' AND grade_terms_days_term='1'";
					$dbh_term1_SQL1 = $dbh->prepare($term1_SQL1); $dbh_term1_SQL1->execute(); $fetchObj1x = $dbh_term1_SQL1->fetch(PDO::FETCH_OBJ); $dbh_term1_SQL = null;

					$term2_SQL2 = "SELECT * FROM grade_terms_days WHERE grade_terms_days_session='$mysession_id' AND grade_terms_days_term='2'";
					$dbh_term2_SQL2 = $dbh->prepare($term2_SQL2); $dbh_term2_SQL2->execute(); $fetchObj2x = $dbh_term2_SQL2->fetch(PDO::FETCH_OBJ); $dbh_term2_SQL2 = null;

					$term3_SQL3 = "SELECT * FROM grade_terms_days WHERE grade_terms_days_session='$mysession_id' AND grade_terms_days_term='3'";
					$dbh_term3_SQL3 = $dbh->prepare($term3_SQL3); $dbh_term3_SQL3->execute(); $fetchObj3x = $dbh_term3_SQL3->fetch(PDO::FETCH_OBJ); $dbh_term3_SQL3 = null;


					$fterm 	= $fetchObj1x->grade_terms_days_no_of_days;
					$fterm_res 	=$fetchObj1x->resumption;
					$fterm_vac	=$fetchObj1x->vacation;
					$sterm 	= $fetchObj2x->grade_terms_days_no_of_days;
					$sterm_res	=$fetchObj2x->resumption;
					$sterm_vac	=$fetchObj2x->vacation;
					$tterm 	= $fetchObj3x->grade_terms_days_no_of_days;
					$tterm_res	=$fetchObj3x->resumption;
					$tterm_vac	=$fetchObj3x->vacation;						
		  ?>
		 
		  <tr bgcolor="">
			<td><?php echo $sn;?></td>
            <td><?php echo $mysession_name.'('.$mysession_id.')';?> </td>
            <td class="center"><strong><?php echo $fterm;?> days</strong><br />
			Resumption:<strong><?php echo $fterm_res;?></strong><br />
			Vacation: <strong><?php echo $fterm_vac;?></strong> </td>
            <td class="center"><strong><?php echo $sterm;?></strong> days</strong><br />
			Resumption:<strong><?php echo $sterm_res;?></strong><br />
			Vacation: <strong><?php echo $sterm_vac;?></strong></td>
            <td class="center"><strong><?php echo $tterm;?></strong> days
			</strong><br />
			Resumption:<strong><?php echo $tterm_res;?></strong><br />
			Vacation: <strong><?php echo $tterm_vac;?></strong> </td>
            <td class="center"><?php print $fterm + $sterm + $tterm ?> Days in All</td>
            <td class="center"><a title="Edit Selection" class="btn btn-success" href="main?page=administrative&tool=gtd&editdays=true&s_id=<?php echo $mysession_id;?>"> <i class="icon-zoom-in icon-white"></i>Edit  </a></td>
          </tr>
		  
		  <?php }
			$dbh_pulldays = null;
		  ?>
        </tbody>
      </table>

    </div>
  </div>
<br /><br />
</div>