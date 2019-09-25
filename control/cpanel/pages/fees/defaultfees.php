<?php 
$title="Default School Fee";

if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}

include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";

//get the class id from url
@$id = $_GET['id'];
$classname = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $id);

?>
<a id="mainsetting"> </a>

<div style="margin-left:20px">
<?php $myp->AlertImportant('Default Fees: ', 'Set Default Fees that will be Copied when you move Session Forward');
		 $myp->AlertInfo('Information! ', 'To Change/Edit Current School Fee, <a class="btn btn-sm btn-default" href="fees?page=home">Go to Manage School Fee</a>
				<a class="btn btn-sm btn-default fancybox fancybox.iframe" href="manage_fees/db/adddefault.php">Add School Fee Components</a> 
				<a class="btn btn-sm btn-default fancybox fancybox.iframe" href="manage_fees/db/setResultFee.php">Set Result Checking Fee</a> ');
 ?>
 </div>

 <div style="margin-left:30px">
	  <?php
		if(!isset($_GET['gid'])){
				$cardgrade = '1';
				} else {
				$cardgrade = $_GET['gid'];
				}
		$gradename= $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $cardgrade);//		
	  	  
	  $queryj = "SELECT * FROM grades";
	  $dbh_queryj = $dbh->prepare($queryj); $dbh_queryj->execute();  $mygrade = $rowCount = $dbh_queryj->rowCount();
	  
		//upgraded by Ultimate Kelvin C - Kastech
		while ($get_grades = $dbh_queryj->fetch(PDO::FETCH_OBJ)) {
			print '<a class="btn btn-sm btn-default" style="margin:4px" href="fees?page=defaultfees&id='.$get_grades->grades_id.'#mainsetting">'.$get_grades->grades_desc.'</a>';
		}	  
		$dbh_queryj = null;
	  ?>
</div>
 

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-pdf"></i> Fees Table preview </h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
      <p><?php
			if(isset($_POST['takeaction'])){

				$class_id = $_POST['classid'];// class id value from from
				// collect the grade id

				// collect all the first term components
				$myprice = $_POST['price'];
				$mycomp = $_POST['comp'];
				$tblid = $_POST['tblid'];

				// collect second term forms
				$myprice2 = $_POST['price2'];
				$mycomp2 = $_POST['comp2'];
				$tblid2 = $_POST['tblid2'];


				// collect all the third term components
				$myprice3 = $_POST['price3'];
				$mycomp3 = $_POST['comp3'];
				$tblid3 = $_POST['tblid3'];

				// collect all the total

				$total = $_POST['total'];
				$total2 = $_POST['total2'];
				$total3 = $_POST['total3'];

				//the id of the total
				$ftid = $_POST['ftid'];
				$stid = $_POST['stid'];
				$ttid = $_POST['ttid'];



			// do transaction from here: Updated bu the Ultimate kelvin
				$dbh->beginTransaction();
			$settotal = "UPDATE school_fees_default SET price = '$total' WHERE id='$ftid'";
			$dbh_settotal = $dbh->prepare($settotal); $dbh_settotal->execute(); $rowCountx = $dbh_settotal->rowCount(); $dbh_settotal = null;

			$settotal2 = "UPDATE school_fees_default SET price = '$total2' WHERE id='$stid'";
			$dbh_settotal2 = $dbh->prepare($settotal2); $dbh_settotal2->execute(); $rowCounty = $dbh_settotal2->rowCount();$dbh_settotal2 = null;

			$settotal3 = "UPDATE school_fees_default SET price = '$total3' WHERE id='$ttid'";
			$dbh_settotal3 = $dbh->prepare($settotal3); $dbh_settotal3->execute(); $rowCountz = $dbh_settotal3->rowCount();$dbh_settotal3 = null;

				// loop the first term in
				foreach( $myprice as $key => $p ) {
					$queryft= "UPDATE school_fees_default SET price = '$p', component ='$mycomp[$key]' WHERE id='$tblid[$key]'";
					$dbh_queryft = $dbh->prepare($queryft); $dbh_queryft->execute();  $rowCount1 = $dbh_queryft->rowCount(); $dbh_queryft = null;
				}
				// loop in for second term
				foreach( $myprice2 as $key2 => $p2 ) {
					$queryst= "UPDATE school_fees_default SET price = '$p2', component ='$mycomp2[$key2]' WHERE id='$tblid2[$key2]'";
					$dbh_queryst = $dbh->prepare($queryst); $dbh_queryst->execute(); $rowCount2 = $dbh_queryst->rowCount(); $dbh_queryst = null;
				}

				//loop for third term
				foreach( $myprice3 as $key3 => $p3 ) {
					$querytt= "UPDATE school_fees_default SET price = '$p3', component ='$mycomp3[$key3]' WHERE id='$tblid3[$key3]'";
					$dbh_querytt = $dbh->prepare($querytt); $dbh_querytt->execute(); $rowCount3 = $dbh_querytt->rowCount(); $dbh_querytt = null;
				}

				if ($rowCountx == 1 or $rowCounty == 1 or $rowCountz == 1 or $rowCount1 == 1 or $rowCount2 == 1 or $rowCount3 == 1){
					$myp->AlertSuccess('Good Job! ', 'Your changes were saved. Please cross-check');
					$dbh->commit();
				} else {
					$myp->AlertError('Fatal Error! ', 'We got Confused. Please Contact kAsTech Network Limited');
					$dbh->rollBack();
				}
			}

?>
 </p>
   
   <?php 
   // display the table only when admin select class above
   if(isset($_GET['id'])){?>
   <form action="" method="post">
    <table class="table table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th width="3%">Id<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="7%">Term</th>
            <th width="71%">Term Components For <?php echo $classname;?>( Level: <?php echo $id;?> )</font></th>
            <th width="19%">Total</th>
          </tr>
        </thead>
        <tbody>
     <tr>
	<td>1</td>
	<td><strong>First Term </strong></td>
	<td>

	
	<p><strong>FIRST TERM TABLE</strong></p>
	<table width="100%" border="1" class="" style="">
<tr>
    <td>SN</td>
    <td>Comp</td>
    <td>Amount(N)</td>
    <td>Change price </td>
    <td>Rename</td>
  </tr>
  
  
  <?php
  // loop the first term out 
  
  $pullassout = "SELECT * FROM school_fees_default WHERE component != 'total' AND grades = '$id' AND grades_term = '1' ORDER BY id DESC";
	$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
	
	$pullRecords = "SELECT id, price FROM school_fees_default WHERE component='total' AND grades = '$id' AND grades_term = '1'";
	$dbh_pullRecords = $dbh->prepare($pullRecords); $dbh_pullRecords->execute(); $fetchObj = $dbh_pullRecords->fetch(PDO::FETCH_OBJ); $dbh_pullRecords = null;
	$ftermtotal = $fetchObj->price;
	$ftid = $fetchObj->id;
	
	 $ftsum = "SELECT SUM(price) as mytotal FROM school_fees_default WHERE component !='total' AND grades = '$id' AND grades_term = '1'";
	 $dbh_ftsum = $dbh->prepare($ftsum); $dbh_ftsum->execute(); $row = $dbh_ftsum->fetch(PDO::FETCH_ASSOC); $dbh_ftsum = null;
	 $sum = $row['mytotal'];

	$sn = 0;
	while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {
	//$current_year=$_SESSION['CurrentYear'];
		$sn = $sn + 1;
		$component = $std['component'];
		$price = $std['price'];
		$compid = $std['id'];
	?>
  <tr>
   <td><?php echo $sn;?> __<?php echo $compid;?><input type="hidden" name="tblid[]" value="<?php echo $compid;?>" /></td>
 <td><?php echo $component;?> </td>
      <td><?php echo number_format($price);?></td>
	  
      <td><input name="price[]" type="number" id="" style="width:80px" value="<?php echo $price;?>" placeholder="#" /></td>
      <td><input name="comp[]" type="text" id="" style="width:220px" value="<?php echo $component;?>" placeholder="" /></td>
  </tr>
  
  <?php }
	$dbh_pullassout = null;
  ?>
  <tr>
    <td>last</td>
    <td><p>Miscellaneous</p></td>
    <td><em>Auto</em></td>
    <td>{<em>dont list</em>}</td>
    <td>Edit total:<input name="total" type="text" id="" style="width:120px" value="<?php echo $ftermtotal;?>" placeholder="" />
	<input type="hidden" name="ftid" value="<?php echo $ftid;?>" />
</td>
  </tr>
</table>			</td>
            <td class="center"><p>
			
              <p><font color="#990000">Warning</font>: Make sure the sum of components is not greater than total. <em>Some of component can be less than total, in that case, the portal sets the remainder as Miscellaneous</em></p>
              <p>&nbsp;</p>
			  Components  = NGN <strong><?php echo number_format($sum);?></strong><br />
			  Miscellaneous = NGN <?php print $ftermtotal - $sum?><br />
              Total:<strong>N<?php echo number_format($ftermtotal);?></strong></p>
              <p>
                </p>
			  <p><strong>Status :<?php 
			  if ($sum > $ftermtotal){
				  $myp->AlertError('Invalid Data! ', 'We have detected that the total is lower than sum. Please Resolve this.');
			  } else { 
				$myp->AlertSuccess('Nice! ', 'Ok');
			}
			   ?>  </strong></p>
      
            <p>&nbsp;</p></td>
          </tr>
		   <tr>
			<td>2</td>
            <td><strong>Second Term </strong></td>
            <td>
		
			<p><strong>SECOND TERM TABLE</strong></p>
			<table width="100%" border="1" class="" style="">
		  <tr>
			<td>SN</td>
			<td>Comp</td>
			<td>Ammount(N)</td>
			<td>Change price </td>
			<td>Rename</td>
		  </tr>
		  
  
  <?php
  // loop the first term out 
  
  $pullassout2 = "SELECT * FROM school_fees_default WHERE component != 'total' AND grades = '$id' AND grades_term = '2' ORDER BY id DESC";
  $dbh_pullassout2 = $dbh->prepare($pullassout2); $dbh_pullassout2->execute();
		
		$pullRecords2 = "SELECT id, price FROM school_fees_default WHERE component='total' AND grades = '$id' AND grades_term = '2'";
		$dbh_pullRecords2 = $dbh->prepare($pullRecords2); $dbh_pullRecords2->execute(); $fetchObj2 = $dbh_pullRecords2->fetch(PDO::FETCH_OBJ); $dbh_pullRecords2 = null;
		$stermtotal = $fetchObj2->price;
		$stidform = $fetchObj2->id;

	 $stsum = "select SUM(price) as mytotal2 from school_fees_default WHERE component !='total' AND grades = '$id' AND grades_term = '2'";
	  $dbh_stsum = $dbh->prepare($stsum); $dbh_stsum->execute(); $row2 = $dbh_stsum->fetch(PDO::FETCH_ASSOC); $dbh_stsum = null;
		 $sum2 = $row2['mytotal2'];
	 
	 

		$sn2 = 0;
		while ($std2 = $dbh_pullassout2->fetch(PDO::FETCH_ASSOC)) {
		//$current_year=$_SESSION['CurrentYear'];

		$sn2 = $sn2 + 1;
		$component2 = $std2['component'];
		$price2 = $std2['price'];
		$compid2 = $std2['id'];

?>
  
  <tr>
   <td><?php echo $sn2;?> __<?php echo $compid2;?>
     <input type="hidden" name="tblid2[]" value="<?php echo $compid2;?>" /></td>
 <td><?php echo $component2;?> </td>
      <td><?php echo number_format($price2);?></td>
	  
      <td><input name="price2[]" type="number" id="" style="width:80px" value="<?php echo $price2;?>" placeholder="#" /></td>
      <td><input name="comp2[]" type="text" id="" style="width:220px" value="<?php echo $component2;?>" placeholder="" /></td>
  </tr>
  
  <?php }
	$dbh_pullassout2 = null;
  ?>
  <tr>
    <td>last</td>
    <td><p>Miscellaneous</p></td>
    <td><em>Auto</em></td>
    <td>{<em>dont list</em>}</td>
    <td>     edit total:  <input name="total2" type="text" id="" style="width:120px" value="<?php echo $stermtotal;?>" placeholder="" />
	<input type="hidden" name="stid" value="<?php echo $stidform;?>" />
</td>
  </tr>
</table>	
		</td>
            <td class="center">
              
              <p><font color="#990000">Warning</font>: Make sure the sum of components is not greater than total. <em>Some of component can be less than total, in that case, the portal sets the remainder as Miscellaneous</em></p>
              <p>&nbsp;</p>
              <p>Components  = NGN <strong><?php echo number_format($sum2);?></strong><br />
                Miscellaneous = NGN <?php print $stermtotal- $sum2  ?><br />
                Total:<strong>N<?php echo number_format($stermtotal);?></strong>
                <br />
                 </p>
              <p><strong>Status :<?php 
			  if ($sum2 > $stermtotal){
				$myp->AlertError('Fatal Error! ', 'Invalid Total is lower than sum, Please Resolve.');
			  } else { 
				$myp->AlertSuccess('Nice! ', 'Ok');
			  }
		?> 

<p>&nbsp;</p></td>
	</tr>
 <tr>
	<td>3</td>
	<td><strong>Third Term </strong></td>
	<td>

	<p><strong>Third TERM TABLE</strong></p>
	<table width="100%" border="1" class="" style="">
  <tr>
    <td>SN</td>
    <td>Comp</td>
    <td>Ammount(N)</td>
    <td>Change price </td>
    <td>Rename</td>
  </tr>
  
  
  <?php
  // loop the first term out 
  
		$pullassout3 = "SELECT * FROM school_fees_default WHERE component != 'total' AND grades = '$id' AND grades_term = '3' ORDER BY id DESC";
		 $dbh_pullassout3 = $dbh->prepare($pullassout3); $dbh_pullassout3->execute();
		
		$pullRecords3 = "SELECT id, price FROM school_fees_default WHERE component='total' AND grades = '$id' AND grades_term = '3'";
		$dbh_pullRecords3 = $dbh->prepare($pullRecords3); $dbh_pullRecords3->execute(); $fetchObj3 = $dbh_pullRecords3->fetch(PDO::FETCH_OBJ); $dbh_pullRecords3 = null;
		$ttermtotal = $fetchObj3->price;
		$tidform = $fetchObj3->id;
	

		$ttsum = "select SUM(price) as mytotal3 from school_fees_default WHERE component !='total' AND grades = '$id' AND grades_term = '3'";
		$dbh_ttsum = $dbh->prepare($ttsum); $dbh_ttsum->execute(); $row3 = $dbh_ttsum->fetch(PDO::FETCH_ASSOC); $dbh_ttsum = null;
		 $sum3 = $row3['mytotal3'];
		
		$sn3 = 0;
			while ($std3 = $dbh_pullassout3->fetch(PDO::FETCH_ASSOC)) {
			//$current_year=$_SESSION['CurrentYear'];

			$sn3 = $sn3 + 1;
			$component3 = $std3['component'];
			$price3 = $std3['price'];
			$compid3 = $std3['id'];
	?>
			 <tr>
			   <td><?php echo $sn3;?> __<?php echo $compid3;?>
				 <input type="hidden" name="tblid3[]" value="<?php echo $compid3;?>" /></td>
			 <td><?php echo $component3;?> </td>
				  <td><?php echo number_format($price3);?></td>
				  
				  <td><input name="price3[]" type="number" id="" style="width:80px" value="<?php echo $price3;?>" placeholder="#" /></td>
				  <td><input name="comp3[]" type="text" id="" style="width:220px" value="<?php echo $component3;?>" placeholder="" /></td>
			  </tr>
			  
			  <?php }
				$dbh_pullassout3 = null;
			  ?>
			  <tr>
				<td>last</td>
				<td><p>Miscellaneous</p></td>
				<td><em>Auto</em></td>
				<td>{<em>dont list</em>}</td>
				<td>    Edit total<input name="total3" type="text" id="" style="width:120px" value="<?php echo $ttermtotal;?>" placeholder="" />
				<input type="hidden" name="ttid" value="<?php echo $tidform;?>" />
			</td>
			  </tr>
			</table>	
		</td>
				<td class="center">
				  <p><font color="#990000">Warning</font>: Make sure the sum of components is not greater than total. <em>Some of component can be less than total, in that case, the portal sets the remainder as Miscellaneous</em></p>
				  <p>&nbsp;</p>

			<p>
                </p>
		Components  = NGN <strong><?php echo number_format($sum3);?></strong><br />
			  Miscellaneous = NGN <?php print $ttermtotal - $sum3 ?><br />
              Total:<strong>N<?php echo number_format($ttermtotal);?></strong>
			<br /><br />
		<p><strong>Status :<?php 
			  if ($sum3 > $ttermtotal){
				  $myp->AlertError('Fatal Error! ', 'Invalid Total is lower than sum, Please Resolve.');
				  } else { 
					$myp->AlertSuccess('Nice! ', 'Ok');
				  }
			   ?> 

      
            <p>&nbsp;</p></td>
          </tr>
	  
        </tbody>
      </table>
	  	  <input type="hidden" name="classid" value="<?php echo $id;?>" />

	  <input type="hidden" name="takeaction" value="takeaction" />
	  <center>   <input class="btn btn-info" type="submit" value="Save Changes"> <i class="icon icon-green icon-replyall"></i></input></center>
	</form>

	  <?php } else{
	  
	  echo '<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert">*</button><br> </br>
			<strong>Hello Admin, </strong> Please select a grade above to set default school fee.<br> </br>
		</div>';
	  
	  }?>
 </div>
  </div>
  <!--/span-->
</div>
<p>&nbsp;</p>
