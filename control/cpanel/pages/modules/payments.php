<?php 
	if (!defined('MYSCHOOLAPPADMIN_CORE')) {// if the user access this page directly, take his ass back to home 

	header('Location: ../../../index.php?action=notauth');
	exit;
	}

	include_once "../includes/common.php";
	// config
	include_once "../includes/configuration.php";

	$current_year=$_SESSION['CurrentYear'];
	$current_term  = $_SESSION['CurrentTerm'];

// define pages components to use
?>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="modules?controller=payments&tool=fees"><button type="button" class="btn btn-primary">School Fee</button></a>
<?php	
	  $queryj = "SELECT * FROM tuition_codes WHERE tuition_codes_id > 1";
	  $dbh_queryj = $dbh->prepare($queryj); $dbh_queryj->execute();
		while ($get_tuition = $dbh_queryj->fetch(PDO::FETCH_OBJ)) {
			print '&nbsp;&nbsp;<a class="btn btn-sm btn-primary" style="margin:4px" href="modules?controller=payments&tool='.trim($get_tuition->tuition_codes_desc).'&grid='.EncoderToken($get_tuition->tuition_codes_id).'">'.$get_tuition->tuition_codes_desc.'</a>';
		} 
		$dbh_queryj = null;
?>
<br /><br />
<?php $myp->AlertInfo('Notice! ', 'Showing School Fee payments for the Current Year ('. $cyear .') and Term ('.$cterm.'). To view school fee for other term or session please simulate the term and/or session, please <a href="year_simulator" target="_blank">Open Simulator</a>') ?>
</div>

<?php  
	if(isset($_GET['tool'])){
	$urlTool = $_GET['tool'];

	if ($urlTool == 'fees') { 
			$title="School Fee payments";
			include('payment_fees_inc.php');
		} else {
			//this will deduce the payment for other fees and their respective functions. this is how to do things ben.
			include ('payment_others_in_diaspora_inc.php');
		}
	}
?>
<p>&nbsp;</p>