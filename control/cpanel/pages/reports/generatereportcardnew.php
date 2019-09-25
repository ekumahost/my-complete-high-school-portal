<?php
/**********************************************/
/*				Coded by NubKnacker
/**********************************************/
//v1.5 by Doug, get term names to display, spelling errors cleaned up
//doug 043007 fix stupid terms again lol

include 'pdfclass.php';

session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
{
	header ("Location: index.php?action=notauth");
	exit;
}
include '../../../includes/ez_sql.php';
include '../../../includes/common.php';
// config
include_once "../../../includes/configuration.php";

$act=get_param("act");
$studentid=get_param("studentid");
$reportid=get_param("reportid");
$genrep=get_param("genrep");
$genbatch=get_param("genbatch");

if (!$act) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<script language="JavaScript" src="datepicker.js"></script>
</head>
<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><b><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></b></td>
    <td width="50%" align="right"><b><?php echo _GENERATE_REPORT_CARD_NEW_ADMIN_AREA?></b></td>
  </tr>
</table>
</div>
<?php
}
?>
<?php
// if ($_POST['genrep']) {
if ($genrep) {
//	echo "select quarter from grade_history_primary where grade_history_primary_student = ".$_POST['studentid'];
$studentid=get_param("studentid");
// echo "studentid is $studentid";
$q = mysql_query("select DISTINCT * from grade_history_primary where student = ".$_POST['studentid'] ." group by quarter");
	if (mysql_num_rows($q)) {
                echo "<div id=\"Content\"><h1>" . _GENERATE_REPORT_CARD_NEW_TITLE . "</h1><br />" . _GENERATE_REPORT_CARD_NEW_TITLE2 . ":<br /><br />";
		while ($r=mysql_fetch_array($q)) {
			//get actual term names, much prettier
                $term_name=$db->get_var("SELECT grade_terms_desc FROM grade_terms WHERE grade_terms_id=$r[quarter]");
                         echo "<a href='generatereportcardnew.php?act=1&studentid=".$_POST['studentid']."&reportid=".$r['quarter']."'>$term_name</a><br /><br />";
		}
	} else {
		echo "<div id=\"Content\"><h1>" . _GENERATE_REPORT_CARD_NEW_TITLE . "</h1><br />" . _GENERATE_REPORT_CARD_NEW_SUBTITLE . "<br /><br />";
	}
}

// if ($_POST['genbatch']) {
if ($genbatch) {
	$q = mysql_query("select DISTINCT * from grade_history_primary 
	JOIN student_grade_year ON student_grade_year_student = grade_history_primary_student 
	INNER JOIN studentbio ON studentbio_id = grade_history_primary_student 
	WHERE grade_history_primary_school = ".$_POST['sid'] ." 
	AND quarter = ".$_POST['qid']." 
	AND student_grade_year_year = ".$_SESSION['CurrentYear']." 
	AND student_grade_year_grade= ". $_POST['gid'] ." 
	AND studentbio_homeroom = ". $_POST['rid'] ." 
	GROUP BY grade_history_primary_student");
	// echo "select DISTINCT * from grade_history_primary 
	// JOIN student_grade_year ON student_grade_year_student = grade_history_primary_student 
	// INNER JOIN studentbio ON studentbio_id = grade_history_primary_student 
	// WHERE grade_history_primary_school = ".$_POST['sid'] ." 
	// AND quarter = ".$_POST['qid']." 
	// AND student_grade_year_year = ".$_SESSION['CurrentYear']." 
	// AND student_grade_year_grade= ". $_POST['gid'] ." 
	// AND studentbio_homeroom = ". $_POST['rid'] ." 
	// GROUP BY grade_history_primary_student";
	if (mysql_errno())
		echo (mysql_errno() . "-".mysql_error());
	$q12 = mysql_query("select * from school_names where school_names_id = ".$_POST['sid']);
	$r12 = mysql_fetch_array($q12);
	$sname = $r12['school_names_desc'];
	$grade = $_POST['gid'];
	$room = $db->get_var("SELECT school_rooms_desc FROM school_rooms WHERE school_rooms_id = $_POST[rid]");
	$xc = strlen($sname);
//	echo $xc;
	if ($xc == 18) {
		$xc = 75;
	} else {
		if ($xc > 18) {
			$xc = ceil(($xc - 18)/2);
			$xc = 75 - 8 * $xc;
		}
		if ($xc < 18) {
			$xc = ceil((18 - $xc)/2);
			$xc = 75 + 8 * $xc;
		}
	}
//	echo $xc;
	$pdf=new PDF('L');
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetFillColor(255,255,255);
	$pdf->SetXY($xc,55);
	$pdf->SetFont('Times','IB',46);
	$pdf->Write(1,$sname);
	$pdf->SetXY(60,105);
	$pdf->Write(1, _GENERATE_REPORT_CARD_NEW_WRITE);
	// $pdf->Write(1, $grade);
	$pdf->Write(1, $room);
	// $tmp = _GENERATE_REPORT_CARD_NEW_WRITE;
	// $pdf->Write(1, $tmp);
	$w=array(35,35,35,35,35,35);	
	$pdf->SetWidths($w);
	$pdf->SetMargins(50,30);
	$pdf->SetLineWidth(0);
	//Start adding student data
	while ($r = mysql_fetch_array($q)) {
		$q1 = mysql_query("select * from studentbio where studentbio_id = " . $r['grade_history_primary_student']);
		// had it changed to this below, now commented out again, Helmut
		// $q1 = mysql_query("select * from studentbio where studentbio_id = '$studentid'");
		$r1 = mysql_fetch_array($q1);
		$name = $r1['studentbio_fname'] . " " . $r1['studentbio_lname'];
		$id = $r1['studentbio_id'];
//		echo $id . $name;
//		echo "<br>select * from studentcontact where studentcontact_id = $id<br>";
		$q5 = mysql_query("select * from studentcontact where studentcontact_id = '$id'");
		$r5 = mysql_fetch_array($q5);
		$address1 = $r5['studentcontact_address1'];
		$address2 = $r5['studentcontact_address2'];
		$city = $r5['studentcontact_city'];
		$zip = $r5['studentcontact_zip'];
	
		$pdf->AddPage();
		$pdf->SetFillColor(255,255,255);
		$pdf->SetXY(195,35);
		$pdf->SetFont('Times','IB',16);
		$pdf->Write(1,$sname);
		$pdf->SetXY(195,43);
		$pdf->Write(1,"Grade $grade");
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
		$pdf->SetLineWidth(0);
		$pdf->header1=array(_GENERATE_REPORT_CARD_NAME,_GENERATE_REPORT_CARD_TEACHER,_GENERATE_REPORT_CARD_OVERALL,_GENERATE_REPORT_CARD_EFFORT,_GENERATE_REPORT_CARD_CONDUCT,_GENERATE_REPORT_CARD_COMMENTS);
//		$pdf->SetXY(30,70);
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
		$q3 = mysql_query("select * from grade_history_primary where grade_history_primary_student=$id and quarter = " . $_POST['qid'] ." and grade_history_primary_year =  ".$_SESSION['CurrentYear']);
		if (mysql_errno()) {
			echo "select * from grade_history_primary where grade_history_primary_student=" . $r1['studentbio_id'];
			echo mysql_errno() . "-".mysql_error();
		}
		while ($r3 = mysql_fetch_array($q3)) {
			$q29 = mysql_query("select * from grade_subjects where grade_subject_id = " . $r3['grade_history_primary_subject']);
			$r29 = mysql_fetch_array($q29);
			$info[0] = $r29['grade_subject_desc'];
			$q4 = mysql_query("SELECT * FROM web_users WHERE web_users_id = " . $r3['grade_history_primary_user'] . " AND web_users_type='T'");
			$r4 = mysql_fetch_array($q4);
			$info[1] = $r4['web_users_flname'];
			$info[2] = $r3['level_taken'];
			$info[3] = $r3['grade_history_primary_effort'];
			$info[4] = $r3['grade_history_primary_conduct'];
			$info[5] = $r3['grade_history_primary_notes'];
			$pdf->Row($info);
		}

		$pdf->SetLineWidth(2);
		$pdf->Rect(25,25,245,130,'');
	}
	
	$pdf->Output();
	exit(); //Errors out without this statement
}
if ($act && $studentid) {
	$q = mysql_query("select * from grade_history_primary where quarter = '$reportid'");
	$r = mysql_fetch_array($q);
	$q1 = mysql_query("select * from studentbio where studentbio_id = '$studentid'");
	$r1 = mysql_fetch_array($q1);
/*
	print_r($r);
	echo "<br><br>";
	print_r($r1);
	echo "<br><br>";
	print_r($r2);
	echo "<br><br>";
*/
	$name = $r1['studentbio_fname'] . " " . $r1['studentbio_lname'];
	// echo "name=$name";
	$q5 = @mysql_query("select * from studentcontact where studentcontact_id = $r1[studentbio_id]");
	$r5 = @mysql_fetch_array($q5);
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
	$q3 = mysql_query("select * from grade_history_primary where quarter = '$reportid' and grade_history_primary_student='$studentid'");
	while ($r3 = mysql_fetch_array($q3)) {
		$q25 = mysql_query("select * from grade_subjects where grade_subject_id = $r3[grade_history_primary_subject]");
		$r25 = mysql_fetch_array($q25);
		$info[0] = $r25['grade_subject_desc'];
		$q4 = mysql_query("select * from web_users where web_users_id = $r3[grade_history_primary_user]");
		$r4 = mysql_fetch_array($q4);
		$info[1] = $r4['web_users_flname'];
		$info[2] = $r3['level_taken'];
		$info[3] = $r3['grade_history_primary_effort'];
		$info[4] = $r3['grade_history_primary_conduct'];
		$info[5] = $r3['grade_history_primary_notes'];
		$pdf->Row($info);
	}

	$pdf->SetLineWidth(2);
	$pdf->Rect(25,25,245,130,'');
	if ($reportid > 1) {
		$pdf->AddPage();
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
		$pdf->SetLineWidth(0);
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
		$pdf->Ln();
		$pdf->Ln();
		$pdf->header1 = array(_GENERATE_REPORT_CARD_NEW_COURSE,_GENERATE_REPORT_CARD_NEW_QUARTER1,_GENERATE_REPORT_CARD_NEW_QUARTER2,_GENERATE_REPORT_CARD_NEW_QUARTER3,_GENERATE_REPORT_CARD_NEW_QUARTER4);
		$pdf->PrintHeader();
		$pdf->SetFillColor(255,255,255);
		$q24 = mysql_query("select DISTINCT * from grade_history_primary where grade_history_primary_student='$studentid' and grade_history_primary_year = ".$_SESSION['CurrentYear']."  group by grade_history_primary_subject");
//		echo "select DISTINCT * from grade_history_primary where grade_history_primary_student='$studentid' and grade_history_primary_year = ".$_SESSION['CurrentYear']."  group by grade_history_primary_subject";
		while ($r24 = mysql_fetch_array($q24)) {
			$info = array();
//			print_r($r24);
			$q25 = mysql_query("select * from grade_subjects where grade_subject_id = $r24[grade_history_primary_subject]");
			$r25 = mysql_fetch_array($q25);
			$info[0] = $r25['grade_subject_desc'];
			$q4 = mysql_query("select * from grade_history_primary where grade_history_primary_subject = $r24[grade_history_primary_subject] and grade_history_primary_student = '$studentid' and grade_history_primary_year = ".$_SESSION['CurrentYear']. " order by quarter");
//			echo "select * from grade_history_primary where grade_history_primary_subject = $r3[grade_history_primary_subject] and grade_history_primary_student = $studentid and grade_history_primary_year = ".$_SESSION['CurrentYear']. " order by quarter";
			while ($r4 = @mysql_fetch_array($q4)) {
//				print_r($r4);
				$k = $r4['quarter'];

				$info[$k] = $r4['level_taken']."\n".$r4['grade_history_primary_notes'];
			}
			for ($i = 0; $i<5;$i++) {
				if (empty($info[$i]))
					$info[$i] = '-';
			}
//			print_r($info);
			$pdf->Row($info);
		}		
		$pdf->SetLineWidth(2);
		$pdf->Rect(25,25,245,130,'');
	}
	
	$pdf->Output();
	exit;
}
?>


<?php
// if (!$_POST['genrep'] && !$_POST['genbatch']) {
if (!$genrep && !$genbatch) {
?>
<div id="Content">
<h1><?php echo _GENERATE_REPORT_CARD_NEW_TITLE?></h1>
<br>
<form name="stuid" action="generatereportcardnew.php" method="POST"><?php echo _GENERATE_REPORT_CARD_NEW_CHOOSE?> <select name="studentid">
<?php
	$q = mysql_query("select studentbio_id, studentbio_lname, studentbio_fname from studentbio order by studentbio_fname");
	while ($r = mysql_fetch_array($q)) {
		echo "<option value=\"".$r['studentbio_id']."\">$r[studentbio_fname] $r[studentbio_lname]</option>";
	}
?>
</select>
<input type="submit" value="<?php echo _GENERATE_REPORT_CARD_NEW_GENERATE?>" name="genrep" class="frmbut" /></form>
<br /><br /><br />
<?php
}
// if (!$_POST['genrep'] && !$_POST['genbatch']) {
if (!$genrep && !$genbatch) {
	echo "<form name='something' action = 'generatereportcardnew.php?act=1' method='POST'>
	" . _GENERATE_REPORT_CARD_NEW_CHOOSE2 . " : <br /><select name='sid'>";
	$q2 = mysql_query("select * from school_names");
	while ($r2 = mysql_fetch_array($q2)) {
		echo "<option value=$r2[school_names_id]>$r2[school_names_desc]</option>";
	}
	echo "</select><select name='gid'>";
	$q1 = mysql_query("select * from grades");
	while ($r1 = mysql_fetch_array($q1)) {
		echo "<option value=$r1[grades_id]>$r1[grades_desc]</option>";
	}
	echo "</select>";
	echo "<select name='rid'>";
	$q1 = mysql_query("select * from school_rooms");
	echo "<option value=none>" . _GENERATE_REPORT_CARD_NEW_NONE . "</option>";
	while ($r1 = mysql_fetch_array($q1)) {
		echo "<option value=$r1[school_rooms_id]>$r1[school_rooms_desc]</option>";
	}
	echo "</select>";
	echo "<select name='qid'>";
	$q1 = mysql_query("select * from grade_terms");
	while ($r1 = mysql_fetch_array($q1)) {
		echo "<option value=$r1[grade_terms_id]>$r1[grade_terms_desc]</option>";
	}
	echo "<input type='submit' class='frmbut' name='genbatch' value='" . _GENERATE_REPORT_CARD_NEW_GENERATE2 . "'></form>";
}
?>

<?php
//include "admin_menu.inc.php";
?>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />