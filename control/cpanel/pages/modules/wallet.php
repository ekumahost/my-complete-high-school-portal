<?php 
$title="Wallets";

if (!defined('MYSCHOOLAPPADMIN_CORE')) {// if the user access this page directly, take his ass back to home 
header('Location: ../../../index.php?action=notauth');
exit;
}


include_once "../includes/common.php";
//Initiate database functions
include_once "../includes/ez_sql.php";
// config
include_once "../includes/configuration.php";

$current_year = $_SESSION['CurrentYear'];

$biototal = $kas_framework->countAll('student_wallet')
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

<div align="center">

<?php if(isset($_GET['freeze'])){
// freeze the wallet
$freezing = $_GET['wallet'];

$doit = "UPDATE student_wallet SET status ='0' WHERE id = '$freezing'";
$dbh_doit = $dbh->prepare($doit); $dbh_doit->execute(); $rowCount = $dbh_doit->rowCount(); $dbh_doit = null;
//edited by the ultimate keliv
if($rowCount == 1){
	$myp->AlertSuccess('Success! ', 'Student Wallet Freezed');
	} else {
	$myp->AlertError('Error Occured! ', 'Could not freeze Students wallet.');
	}
}

 if(isset($_GET['unfreeze'])){
// freeze the wallet
$freezing = $_GET['wallet'];
//edited by the ultimate keliv
$doit = "UPDATE student_wallet SET status ='1' WHERE id = '$freezing'";
$dbh_doit = $dbh->prepare($doit); $dbh_doit->execute(); $rowCount = $dbh_doit->rowCount(); $dbh_doit = null;
if($rowCount == 1){
	$myp->AlertSuccess('Success! ', 'Student Wallet Unfreezed');
	} else {
	$myp->AlertError('Error Occured! ', 'Could not Unfreeze Students wallet.');
	}
}
?>
</div>

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i><a href="modules?controller=wallet">Wallets</a></h2>
	  
	
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
	  
	    <div style="text-align:center; font-size:12px">Total Fund In Students Wallet:
	  <?php  
		  $walletsum = "select SUM(balance) as mytotal from student_wallet";
		  $dbh_walletsum = $dbh->prepare($walletsum);
		  $dbh_walletsum->execute();
		  $rowwal = $dbh_walletsum->fetch(PDO::FETCH_ASSOC);
			//$d = mysql_num_rows($feesum);
			$sumwal = $rowwal['mytotal'];
			echo 'N'.number_format($sumwal);
		 ?>&nbsp;&nbsp;&nbsp; Total freezed Amount:  
		 <?php  $walletsumf= "select SUM(balance) as mytotalf from student_wallet WHERE status = '0'";
		  $dbh_walletsumf = $dbh->prepare($walletsumf);
			  $dbh_walletsumf->execute();
			  $rowwalf = $dbh_walletsumf->fetch(PDO::FETCH_ASSOC);
				//$d = mysql_num_rows($feesum);
				$sumwalf = $rowwalf['mytotalf'];
				echo 'N'.number_format($sumwalf);
		 ?> <br /><br /><br />
	 </div>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr bgcolor="">
            <th width="6%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="18%">Account name </th>
            <th width="23%"> Balance </th>
            <th width="12%">used last </th>
            <th width="15%">Action</th>
            <th width="26%">Status</th>
          </tr>
        </thead>
        <tbody>
         
		         <?php
				 
						$pullassout = "SELECT * FROM student_wallet ORDER BY balance DESC LIMIT $sort_srt, 1000";
						$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute(); 
						$sn = 0;
						while ($std =  $fetchObj = $dbh_pullassout->fetch(PDO::FETCH_OBJ)) {

									$sn = $sn + 1;
									$wallet_id = $std['id'];
									$wallet_std_id = $std['student_id'];
									$balance = $std['balance'];
									$date_last_used = $std['date_last_used'];
									$status = $std['status'];


							$student_fname= $kas_framework->getValue('studentbio_fname', 'studentbio', 'studentbio_id', $wallet_std_id);
							$student_lname= $kas_framework->getValue('studentbio_lname', 'studentbio', 'studentbio_id', $wallet_std_id);

				
					if($status ==1){
							 $mystatus = '<span class="label label-success">Current</span>';
					}else if ($status ==0) {					 
						$mystatus = '<span class="label label-important">Freezed</span>';
					 } else {
						$mystatus = '<span class="label label-important">Unknown</span>';
					 }
					 
		  ?>
		 
		  <tr bgcolor="">
			<td><?php echo $sn;?></td>
  <td><i class="icon icon-color icon-user"></i><a href="main?page=view_users&id=<?php echo $wallet_std_id;?>" target="_blank"><?php echo $student_fname.' '.$student_lname;?></a></td>
            <td class="center">NGN <?php echo number_format($balance);?>.00</td>
            <td class="center"><?php echo $date_last_used;?></td>
            <td class="center"><a href="#" class="btn btn-info" data-rel="popover" data-content="Add fund to this wallet using scratch card or credit cards" data-original-title="Fund Wallet">Fund</a>||
			
			
			<?php if($status ==1){?>
			
			<a href="modules?controller=wallet&freeze=true&wallet=<?php echo $wallet_id;?>" class="btn btn-danger" data-rel="popover" data-content="Click here to freeze the wallet, user will not be able to use wallet again" data-original-title="Freeze Wallet">Freeze</a>
			<?php }else{?>
			
			<a href="modules?controller=wallet&unfreeze=true&wallet=<?php echo $wallet_id;?>" class="btn btn-important" data-rel="popover" data-content="Click here to unfreeze the wallet, user will be able to use wallet again" data-original-title="Unfreeze Wallet">Unfreeze</a>

			<?php }?>
			
			
			</td>
            <td class="center"><?php echo $mystatus;?>		    </td>
          </tr>
		  
	  <?php }
		 $dbh_pullassout = null;
		?>
        </tbody>
      </table>
	 <?php
// start working ends, this is the third place worked


echo 'Total wallets: <strong>'.number_format($biototal).'</strong><br><br>';
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
<p>&nbsp;</p>