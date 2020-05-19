<?php
/*
include 'pdfclass.php';

session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
{// ho ho ho, if the person coming here is not admin, throw him outside
	header ("Location: index.php?action=notauth");
	exit;
}
include '../../../includes/ez_sql.php';
include '../../../includes/common.php';
// config
include_once "../../../includes/configuration.php";

if (!$act) {
?>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<script language="JavaScript" src="datepicker.js"></script>
</head>
<body>

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _GENERATE_REPORT_CARD_ADMIN_AREA?></td>
  </tr>
</table>
</div>
<?php
}
?>
<?php
if ($_POST['genrep']) {
//	echo "select grade_history_quarter from grade_history where grade_history_student = ".$_POST['studentid'];
	$q = mysql_query("select DISTINCT * from grade_history where grade_history_student = ".$_POST['studentid'] ." group by grade_history_quarter");
	//echo mysql_num_rows($q);
	if (mysql_num_rows($q)) {
		echo "<div id=\"Content\"><h1>Report Card</h1><br />Choose a report card to view:<br /><br />";
		while ($r=mysql_fetch_array($q)) {
		//grab and display the term names, so much prettier
		$shemp=$r['grade_history_quarter'];
		$term_n = "SELECT grade_terms_desc FROM grade_terms WHERE grade_terms_id=$shemp";
		$term_names=$db->get_var($term_n);
		echo "<a href='generatereportcard.php?act=1&studentid=".$_POST['studentid']."&reportid=".$r['grade_history_quarter']."'>$term_names</a><br 
/><br />";
		}
	} else {
		echo "<div id=\"Content\"><h1>" . _GENERATE_REPORT_CARD_TITLE . "</h1><br />" . _GENERATE_REPORT_CARD_SUBTITLE . "<br /><br />";
	}
}

if ($act && $studentid) {
	$q = mysql_query("select * from grade_history where grade_history_quarter = '$reportid'");
	$r = mysql_fetch_array($q);
	$q1 = mysql_query("select * from studentbio where studentbio_id = $r[grade_history_student]");
	$r1 = mysql_fetch_array($q1);
	$q2 = mysql_query("select * from school_names where school_names_id = $r[grade_history_school]");
	$r2 = mysql_fetch_array($q2);

	//print_r($r);
	//echo "<br><br>";
	//print_r($r1);
	//echo "<br><br>";
	//print_r($r2);
	//echo "<br><br>";

	$name = $r1['studentbio_fname'] . " " . $r1['studentbio_lname'];
	$school = $r2['school_names_desc'];
	$q5 = mysql_query("select * from studentcontact where studentcontact_id = $r1[studentbio_id]");
	$r5 = mysql_fetch_array($q5);
	$address1 = $r5['studentcontact_address1'];
	$address2 = $r5['studentcontact_address2'];
	$city = $r5['studentcontact_city'];
	$zip = $r5['studentcontact_zip'];

	$pdf=new PDF('L');
	$w=array(35,35,35,35,35,35);
	$pdf->Open();
	$pdf->SetWidths($w);
	$pdf->SetMargins(50,30);
	$pdf->AddPage();
	$pdf->SetFillColor(255,255,255);
	$pdf->SetXY(195,35);
	$pdf->SetFont('Times','IB',16);
	$pdf->Write(1,$school);
	$pdf->SetFont('Times','',14);
	$pdf->Ln();
	$pdf->SetXY(30,50);
	$pdf->Write(1,$name);
	$pdf->Ln();
	$pdf->SetXY(30,55);
	$pdf->Write(1,$address1);
	$pdf->Ln();
	if (!empty($address2)) {
		$pdf->SetXY(30,60);
		$pdf->Write(1,$address2);
	}
	$pdf->Ln();
	$pdf->SetXY(30,65);
	$pdf->Write(1,$city . ' - '.$zip);
	$pdf->Ln();
	$pdf->header1=array(_GENERATE_REPORT_CARD_NAME,_GENERATE_REPORT_CARD_TEACHER,_GENERATE_REPORT_CARD_OVERALL,_GENERATE_REPORT_CARD_EFFORT,_GENERATE_REPORT_CARD_CONDUCT,_GENERATE_REPORT_CARD_COMMENTS);
//	$pdf->SetXY(30,70);
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Times','B',12);
	$pdf->PrintHeader();
	$pdf->SetFillColor(255,255,255);
	$pdf->SetFont('Times','',11);
	$q3 = mysql_query("select * from grade_history where grade_history_quarter = '$reportid' and grade_history_student=$studentid");
	while ($r3 = mysql_fetch_array($q3)) {
		$tab[0] = $r3['grade_history_subject'];
		//get the subject names so it's more human
		$shemp1=$tab[0];
		$sSQL="SELECT grade_subject_desc FROM grade_subjects WHERE 
grade_subject_id=$shemp1";
		$info[0]=$db->get_var($sSQL);
		$q4 = mysql_query("select * from web_users where web_users_id = $r3[grade_history_user]");
		$r4 = mysql_fetch_array($q4);
		$info[1] = $r4['web_users_flname'];
		$info[2] = $r3['grade_history_grade'];
		$info[3] = $r3['grade_history_effort'];
		$info[4] = $r3['grade_history_conduct'];
		$info[5] = $r3['grade_history_notes'];
		$pdf->Row($info);
	}

	$pdf->SetLineWidth(2);
	$pdf->Rect(25,25,245,130,'');
	$pdf->Output();
	exit;
}
?>


<?php
if (!$_POST['genrep']) {
?>
<div id="Content">
<h1><?php echo _GENERATE_REPORT_CARD_TITLE?></h1>
<br>
<form name="stuid" action="generatereportcard.php" method="POST">Choose a Student <select name="studentid">
<?php
	$q = mysql_query("select studentbio_id, studentbio_lname, studentbio_fname from studentbio order by studentbio_fname");
	while ($r = mysql_fetch_array($q)) {
		echo "<option value=\"".$r['studentbio_id']."\">$r[studentbio_fname] $r[studentbio_lname]</option>";
	}
?>
</select>
<input type="submit" value="<?php echo _GENERATE_REPORT_CARD_GENERATE?>" name="genrep" /></form>
<?php
}
//include "admin_menu.inc.php";

*/
echo 'If you are seeing this page, please call +2348166555624. You have wandered farther than I imagined.';

?>

