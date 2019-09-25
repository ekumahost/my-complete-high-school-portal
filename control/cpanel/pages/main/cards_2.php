<?php 
		//header('Content-Type: text/xml');
$title="Fees Scratch card Generator";
if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}
?>

<?php
if (isset($_POST['type'])){
$errorh = '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">*</button>
				<strong>Oh Snap! </strong>';
$errort = ' <a href="">Click Here Now</a></div>';

	if (empty($_POST['q'])){
		echo $errorh.' Quantity is required to generate'.$errort; exit;}
	if(!is_numeric($_POST['q'])){
			echo $errorh.' Quantity is required to generate and must be a figure! '.$errort; exit;}

	if($_POST['q'] > 10000){
		echo $errorh.' Large Quantity at a time will Crash your Browser. '.$errort; exit;}

	if (empty($_POST['d'])){
		echo $errorh.' The description is needed and must be short '.$errort; exit;}

	if(!is_numeric($_POST['a'])){
		echo $errorh.' Price is a figure like 5000'.$errort; exit;}
		

	// lets get the type of pin to generate
	if($_POST['type']=="registration"){

	// but registration could be for old or new student
	if($_POST['form']=="2"){
			$tablename = "reg_pins_old";
		}else{
			$tablename = "reg_pins";
		}
	} else{
		$tablename = "student_wallet_pins";
	}
	$desc = $_POST['d'];
		$a = $_POST['a'];
		$q = $_POST['q'];

	$pnpairs= 12;
	$snpairs= 10;

	$letters = 'LVMGWABFCRSHIJKDEXZNOPYQTU';
	$numbers = '8937012456';
	$letters2 = 'LMNOPQRSTUVWXYZABCDEFGHIJK';
	$numbers2 = '5678901234';
	$letters3 = 'STUVWXLMNOPQRYZGHIJKABCDEF';
	$numbers3 = '7856239014';
	$letters4 = 'SHJKABCDTUVWXLMNOPQRYZGEFI';
	$numbers4 = '7239108564';

	$date = new DateTime();
	 $yea=$date->format('Y-m-d H:i:s');
	$yea=date("y-m-d");

	$key="";
	$serial="";
	//upgraded by the ultimate Kelvin - Kastech
	$countInserted = 0;

		for($i = 1; $i <= $q; $i++) {
			//do a kind of reshuffle;
			@$sn = str_shuffle(substr($numbers, mt_rand(0, (strlen($numbers) - $pnpairs)), $pnpairs));
			@$pn = strtoupper(md5(str_shuffle(substr($letters, mt_rand(0, (strlen($letters) - $snpairs)), $snpairs))));

		$check= "SELECT COUNT(*) AS cnt FROM $tablename WHERE codec='$pn' OR sn='$sn'";
		$dbh_check = $dbh->prepare($check); $dbh_check->execute(); $fetchObjX = $dbh_check->fetch(PDO::FETCH_OBJ); $dbh_check = null;
		$countCheck1 = $fetchObjX->cnt;

		if($countCheck1 >= 1) {
			//do a kind of reshuffle again;
			@$pn = str_shuffle(substr($numbers2, mt_rand(0, (strlen($numbers2) - $pnpairs)), $pnpairs));
			@$sn = str_shuffle(substr($letters2, mt_rand(0, (strlen($letters2) - $snpairs)), $snpairs));

			$check2= "SELECT codec,sn FROM $tablename WHERE codec='$pn' OR sn='$sn'";
			$dbh_check2 = $dbh->prepare($check2); $dbh_check2->execute(); $fetchObjY = $dbh_check2->fetch(PDO::FETCH_OBJ); $dbh_check2 = null;
			$countCheck2 = $fetchObjY->cnt;

				if($countCheck2 >= 1){
					//do a kind of reshuffle again and again;
					@$pn = str_shuffle(substr($numbers3, mt_rand(0, (strlen($numbers3) - $pnpairs)), $pnpairs));
					@$sn = str_shuffle(substr($letters3, mt_rand(0, (strlen($letters3) - $snpairs)), $snpairs));

					$check3= "SELECT codec,sn FROM $tablename WHERE codec='$pn' OR sn='$sn'";
					$dbh_check3 = $dbh->prepare($check3); $dbh_check3->execute(); $fetchObjZ = $dbh_check3->fetch(PDO::FETCH_OBJ); $dbh_check3 = null;
					$countCheck3 = $fetchObjZ->cnt;
						if($countCheck3 >= 1){
							//do a kind of reshuffle again and again and again
							@$pn = str_shuffle(substr($numbers4, mt_rand(0, (strlen($numbers4) - $pnpairs)), $pnpairs));
							@$sn = str_shuffle(substr($letters4, mt_rand(0, (strlen($letters4) - $snpairs)), $snpairs));
					}
				}
			}

		$query= "INSERT INTO $tablename (codec,sn,description,amount,creation) VALUES ('$pn','$sn','$desc','$a','$yea')";
			$dbh_query = $dbh->prepare($query);  $dbh_query->execute(); $rowCount = $dbh_query->rowCount();
			$countInserted = $countInserted + $rowCount;
	}
	$dbh_sSQL = null;
		if($countInserted >= 1) {
			$myp->AlertSuccess('Well done! ', 'You successfully generated pins.');
		} else {
			echo $errorh.' Something is not right. '.$errort;
		}
	}
	?>
	<div align="center">
	<?php 
	if($_GET['myaction'] =="wallet" || $_GET['myaction'] =="registration") {
		include('ajax/pins/pingenerator.php');
	}
?>
</div>

<table width="70%" align="center"> <tr><td>
<div class="" style="width:90%;" align="center">
		<p><a id="console"> </a></p><br />
        <div class="">
          
          <p><a href="main?page=cards&myaction=wallet" class="">
			<button type="submit" class="btn btn-success btn-large">Generate Wallet Fee Pins <span class="fa fa-arrow-right"></span></button>
			</a>
			
			<a href="main?page=cards&myaction=registration" class="">
			<button type="submit" class="btn btn-success btn-large">Generate Portal Registration Pins<span class="fa fa-arrow-right"></span></button>
			</a>
		</p>
		<br />
		<div align="center"><a href="main?page=cards&myaction=view"><button class="btn btn-default btn-sm"> View Web Wallet Pins </button></a> &nbsp;&nbsp;
							<a href="main?page=cards&myaction=view&pickreg=true"><button class="btn btn-default btn-sm"> View Admission Registration Pins</button></a>
		&nbsp;&nbsp;<a href="main?page=cards&myaction=view&pickreg_old=true"><button  class="btn btn-default btn-sm">View Old student Registration Pins</button></a>
		
		</div>
	</div>

	  </div></td>
			</tr></table>
<p>&nbsp;</p>

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2>
	  
	  <?php 
	 if(isset($_GET['pickreg'])){
		echo 'Admission Registration Scratch Cards';} 
	else if(isset($_GET['pickreg_old'])){
		echo 'Old Students Registration Scratch Cards';}
	else{
		echo 'Web Wallet Scratch Cards';}

?>
      </h2>
    </div>
	
	<!-- start working -->
	<?php
	if(isset($_GET['pickreg'])){
		// count number of fee scratch cards
	$cardtotal = $kas_framework->countAll('reg_pins');
	// since we are displaying 1000 only
	if($cardtotal > 1000){
	//echo "its above 10000";
	$break_p = round($cardtotal/1000);
	// so we have $break_p number of page groups
	// collect the page group from url
	$groupid = 1;
	// then we loop the page grout in a page grouping link
	}// end if card is more than a thousand
 // start working again
		if(isset($_GET['break_p'])){// this is only set when quantity is greater than 1000
// for $groupid = 0, 0-1000, 1, 1000-2000, 2 2000- 3000, 3 3000-4000s
			$groupid = $_GET['break_p'];
		 $sort_srt = $groupid*1000;}else{
			 ///$groupid
			 // where should the sorting start
			 $sort_srt = 0; 
		 }// end for wallet
	
	
	
	}else if(isset($_GET['pickreg_old'])){
		// count number of fee scratch cards
$cardtotal =  $kas_framework->countAll('reg_pins_old');;
	// since we are displaying 1000 only
	if($cardtotal > 1000){
	//echo "its above 10000";
	$break_p = round($cardtotal/1000);
	// so we have $break_p number of page groups
	// collect the page group from url
	$groupid = 1;
	// then we loop the page grout in a page grouping link
	}// end if card is more than a thousand
 // start working again
	if(isset($_GET['break_p'])){// this is only set when quantity is greater than 1000
// for $groupid = 0, 0-1000, 1, 1000-2000, 2 2000- 3000, 3 3000-4000s
		$groupid = $_GET['break_p'];
	 $sort_srt = $groupid*1000;}else{
		 ///$groupid
		 // where should the sorting start
		 $sort_srt = 0; 
	 }// end for wallet

	} else{ 
	
	// count number of fee scratch cards	
	$cardtotal = $kas_framework->countAll('student_wallet_pins');
	// since we are displaying 1000 only
	if($cardtotal > 1000){
	//echo "its above 10000";
	$break_p = round($cardtotal/1000);
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
	}// end else pick reg is not set 
	
	?>
	
	
    <div class="box-content">
	<?php
	if($_GET['myaction'] =="view"){ ?>

	
      <table class="table table-striped table-bordered bootstrap-datatable datatable">
        <thead>
          <tr>
            <th width="4%">S/N</th>
            <th width="10%">Serial</th>
            <th width="10%">Pin <a href="main?<?php echo $_SERVER['QUERY_STRING'] ?>&OPEN=true"> Reveal</a></th>
            <th width="8%">Amount</th>
            <th width="7%">Status</th>
            <th width="18%">Description</th>
            <th width="8%"> Generated </th>
            <th width="19%">Used By<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="5%">Action</th>
            <th width="8%">Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
		 
			 if(isset($_GET['pickreg'])){
				$pullpinout = "SELECT * FROM reg_pins ORDER BY id DESC LIMIT $sort_srt, 1000";
			} else if (isset($_GET['pickreg_old'])){
				$pullpinout = "SELECT * FROM reg_pins_old ORDER BY id DESC LIMIT $sort_srt, 1000";
			} else {
				$pullpinout = "SELECT * FROM student_wallet_pins ORDER BY id DESC LIMIT $sort_srt, 1000";
			}
			
			$dbh_pullpinout = $dbh->prepare($pullpinout); $dbh_pullpinout->execute(); 
			$sn = 0;
			while ($wallet = $dbh_pullpinout->fetch(PDO::FETCH_ASSOC)) {

				$sn = $sn + 1;
				$pinid = $wallet['id'];
				$serial = $wallet['sn'];
				$mypin = $wallet['codec'];
				$desc = $wallet['description'];
				$mycredit = $wallet['amount'];
				$date = $wallet['creation'];
				$status = $wallet['status'];
				$user = $wallet['used_by'];
				
				//added by the ultimate
				$tableStatus = ($status == 0)? '<span class="label label-success" style="padding:8px 6px">Unused Pin</span>': '<span class="label label-danger" style="padding:8px 6px">Used</span>';
				$linkToProfile = 'main?page=view_users&id='.EncoderToken($user);
				$bustingIntoRef = '<a href="'.$linkToProfile.'" class="btn btn-default btn-sm" target="_blank"><i class="icon-user"></i> View Users profile</a>';
				$usedByStatus = ($user == 0)? '<span class="label label-success" style="padding:8px 6px">Used by Nobody</span>': $bustingIntoRef;
		 ?>
          <tr>
            <td><?php echo $sn;?></td>
            <td><?php echo $serial;?></td>
            <td class="center"><?php 
			
			if(isset($_GET['OPEN'])){
			echo $mypin;// as in ee, if we allow him see all pins only 

			//echo substr($mypin, 0, 4).'****'.substr($mypin, -4);
			}else{
			echo substr($mypin, 0, 4).'****'.substr($mypin, -4);
			}
			
			?>
			</td>
            <td class="center"><?php echo $mycredit;?> </td>
            <td class="center"><?php echo $tableStatus;?> </td>
            <td class="center"><?php echo $desc;?></td>
            <td class="center"><?php echo $date;?></td>
            <td class="center"><?php echo $usedByStatus;?></td>
            <td class="center"><a title="Set as used" class="btn btn-success" href="#id=<?php echo $pinid;?>"> <i class="icon icon-white icon-archive"></i>  </a></td>
            <td class="center"><a title="<?php echo $pinid;?>" class="btn btn-danger" href="#id=<?php echo json_encode($pinid);?>"> <i class="icon-trash icon-white"></i> </a> </td>
          </tr>
          <?php }
			$dbh_pullpinout = null;
		  ?>
        </tbody>
      </table>
	<?php } 
	
// start working ends, this is the third place worked


echo 'Total Content: <strong>'.number_format($cardtotal).'</strong><br><br>';
	if($cardtotal > 1000){
		if(!isset($_GET['break_p'])){$groupid=1;}

	echo '<br>You now have large data in your db; total: '.$cardtotal.' we have put them into page groups, the ones bellow are more of them <br><br><br> Viewing page group:'.'<strong>'.$groupid.'</strong>'.'<br>';
	
	if(isset($_GET['pickreg_old'])){
	$makeup = 'pickreg_old=true';
	}elseif(isset($_GET['pickreg'])){
		$makeup = 'pickreg=true';
     }else{
	$makeup = 'default=true';
 }
 // then we loop the page grout in a page grouping link
	for($bp = 1; $bp <= $break_p; $bp++){
		echo '<a href="main?page=cards&myaction=view&'.$makeup.'&break_p='.$bp.'">PG'.$bp.' </a>&raquo;';
	}// end for loop

}

?>
</div></div>
 
  <!--/span-->
</div>
<p>&nbsp;</p>