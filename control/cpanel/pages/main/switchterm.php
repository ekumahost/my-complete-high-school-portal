<?php 
$title="Term Switcher";
if (!defined('MYSCHOOLAPPADMIN_CORE')) {// if the user access this page directly, take his ass back to home 
	header('Location: ../../../index.php?action=notauth');
	exit;
}

//Include global functions
include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";


if (isset($_GET['id'])){
	$newterm = $_GET['id'];
	$mycurrent = 1;
	$myoff = 0;

	// anywhere we have current term to be one, lets set it to be zero -- edited by the ultimate keliv
	$dbh->beginTransaction(); //introducing mysql transactions
	$offSQL = "UPDATE grade_terms SET current=".tosql($myoff, "Text")." WHERE current=$mycurrent";
	$dbh_offSQL = $dbh->prepare($offSQL); $sql1 = $dbh_offSQL->execute(); $dbh_offSQL = null;
	// then, we set the new term selected by admin to become 1
	$sSQL = "UPDATE grade_terms SET current=".tosql($mycurrent, "Text")." WHERE grade_terms_id=$newterm";
	$dbh_sSQL = $dbh->prepare($sSQL); $sql2 = $dbh_sSQL->execute(); $dbh_sSQL = null;

		if ($sql1 and $sql2) {
			$dbh->commit() ;// take the user back or refresh the page to display new term
			$_SESSION['CurrentTerm'] = $newterm;
			echo '<script type="text/javascript">window.location.replace("main?page=switchterm&success");</script>';
		} else {
			$dbh->rollBack();
			$myp->AlertError('Error Occured! ', 'Could not Switch session. Please try again some other time or contact HyperTera if the problem persist');
		}

}

?>

<div style="margin-left:40px"><h3>Current Term: <?php echo $cterm;?></h3> <?php if (isset($_GET['success'])) { $myp->AlertSuccess('Nice! ', 'Your Term Switch was Succesful. Your Current Term is displayed Above.');  } ?></div>

<div style="text-align:center; margin:2px 0 6px 0">
<div>
       
  <a href="fancyadmin/admin_terms.php" class="btn btn-default btn-sm fancybox fancybox.iframe"><strong> Add/Edit a New Term/Holiday </strong></a>
  <a href="year_simulator" class="btn btn-default btn-sm"><strong>Simulate/Switch Term backward</strong></a><br />
	  
	  <?php
	  //upgraded by Ultimate Kelvin C - Kastech
	  $queryj = "SELECT grade_terms_id, grade_terms_desc FROM grade_terms ORDER BY grade_terms_id";
		$dbh_queryj = $dbh->prepare($queryj); $dbh_queryj->execute();
	  
		while ($get_terms = $dbh_queryj->fetch(PDO::FETCH_OBJ)) {
			print '<a class="btn btn-large btn-primary" style="margin:4px" href="?page=switchterm&termaction=switch&id='.$get_terms->grade_terms_id.'">Switch to: '.$get_terms->grade_terms_desc.'</a>';
		}
		$dbh_queryj = null;
	  
	  ?>
	</div>
</div>