<?php
(file_exists('../../../php.files/classes/pdoDB.php'))? include ('../../../php.files/classes/pdoDB.php'): include ('../../../../php.files/classes/pdoDB.php');
(file_exists('../../../php.files/classes/kas-framework.php'))? include ('../../../php.files/classes/kas-framework.php'): include ('../../../../php.files/classes/kas-framework.php');
 	//Include global functions
include_once "../../../includes/common.php";
//Initiate special database functions
include_once "../../../includes/true_mysql.php";
// config
include_once "../../../includes/configuration.php";
session_start();
//ultimate keliv worked like mad here
function pageError($title, $message) {
	print '<div style="background-color:#F2DEDE; color: #D76548; padding:5px 6px"><b>'.$title.'</b> '.$message.'</div>';
}

function pageSuccess($title, $message) {
	print '<div style="background-color:#DFF0D8; color: #468847; padding:5px 6px"><b>'.$title.'</b> '.$message.'</div>';
}

if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
  {
    header ("Location: ../../../index.php?action=notauth");
	exit;
}

?> 
<style type="text/css">input[type="text"], input[type="number"], select { padding: 5px; }</style>
<div style="margin:0 auto; width:90%; max-width:900px; min-width:430px">
<p style="font-variant:small-caps; font-weight:900; font-size:18px; text-align:center">SET RESULTS CHECKING FEE </p>




<form action="" method="post">
<table width="100%" border="" cellpadding="0" cellspacing="0" class="table" style="">
<tr>
    <td>SN</td>
    <td>School Domain </td>
    <td>Amount(N)</td>
    <td>Change price </td>
    </tr>
  
  
  <?php
  
  $pullassout = "SELECT * FROM `tbl_grade_domains` ORDER BY `id` DESC";
	$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute(); 
			
	$sn = 0;
	while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {
		$sn = $sn + 1;
		$name = $std['school_names'];
		$price = $std['term_result_fee'];
		$id = $std['id'];
	?>
  <tr>
   <td><?php echo $sn;?> __<?php echo $id;?><input type="hidden" name="tblid[]" value="<?php echo $id;?>" /></td>
 <td><?php echo $name;?> </td>
      <td><?php echo number_format($price);?></td>	  
      <td><input name="price[]" type="number" id="" style="width:50%" value="<?php echo $price;?>" placeholder="#" /></td>
    </tr>
  <?php }
	$dbh_pullassout = null;
  ?>
</table>	<br>	  <center>   <input class="btn btn-info" type="submit" value="Save Changes"> <i class="icon icon-green icon-replyall"></i></input></center>
		
  </form>

<?php
 if(isset($_POST['tblid'])){
$myprice = $_POST['price'];
$tblid = $_POST['tblid'];

// loop the 
	$countExec = 0;
	foreach( $myprice as $key => $p ) {
		$queryft = "UPDATE tbl_grade_domains SET term_result_fee = '$p' WHERE id='$tblid[$key]'";
		$dbh_queryft = $dbh->prepare($queryft); $ex = $dbh_queryft->execute();
		if ($ex) { $countExec = $countExec + 1; }
	}
	$dbh_queryft = null;
	
if ($countExec > 0){
		pageSuccess('Good Job!', 'Your changes successfully saved.'.' <a href="">Accept it</a>');
	} else {
		pageError('Fatal Error!', 'We got Confused. Please Contact kAsTech Network');
	}
 }
?>
</div>