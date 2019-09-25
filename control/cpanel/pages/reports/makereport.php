<?php
/**********************************************/
/*				Coded by Chinello
/**********************************************/

session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
{
	header ("Location: index.php?action=notauth");
	exit;
}
include 'pdfclass.php';

include '../../../includes/ez_sql.php';
include '../../../includes/common.php';

// Include configuration
include_once "../../../includes/configuration.php";

// global $sort1;
// global $sort2;
$report_type = get_param("report_type");
$sort1 = get_param("sort1");
$sort2 = get_param("sort2");
// echo "report_type=$report_type";
// echo "sort1=$sort1";
// echo "sort2=$sort2";
$start_db_date = get_param("start_db_date");
$end_db_date = get_param("end_db_date");

function getGrades() {
	$grades = array();
	for ($i=1;$i<=10;$i++) {
		$grades[$i] = 'Grade '.$i;
	}
	return $grades;
}


function getSchoolNames() {
	$q = mysql_query("select * from tbl_config");
	while ($r = mysql_fetch_array($q)) {
		$y = $r['id'];
		$x[$y] = $r['school_name'];
	}
	return $x;
}

function getEthnicityDesc() {
	$q = mysql_query("select * from ethnicity");
	while ($r = mysql_fetch_array($q)) {
		$t = $r['ethnicity_id'];
		$e[$t] = $r['ethnicity_desc'];
	}
	return $e;
}

//We start creating the PDF here. We wait as long as possible to do this.
global $pdf;
switch ($report_type) {
	case "students":
		$grades=getGrades();
		$eth = getEthnicityDesc();
		$sch = getSchoolNames();
		$pdf=new PDF('L');
		$w=array(20,40,20,30,20,25,30,20,25);
		$pdf->Open();
		$pdf->SetWidths($w);
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);

		$pdf->SetFont('Arial','B',10);
		$pdf->PrintHeader();
		$pdf->SetFont('Arial','',8);
		$pdf->SetFillColor(255,255,255);
		if ($sort2 == 'none') {
			$q = mysql_query("SELECT * FROM studentbio, 
student_grade_year, tbl_config, ethnicity, grades WHERE 
studentbio.studentbio_id = student_grade_year.student_grade_year_student 
AND studentbio.studentbio_school = tbl_config.id AND 
studentbio.studentbio_ethnicity = ethnicity.ethnicity_id AND 
grades.grades_id = student_grade_year.student_grade_year_grade AND 
studentbio.admit = '1' order by " . $sort1 . ", studentbio_lname 
ASC");
		} else {
			$q = mysql_query("SELECT * FROM studentbio, 
student_grade_year, tbl_config, ethnicity, grades WHERE 
studentbio.studentbio_id = student_grade_year.student_grade_year_student 
AND studentbio.studentbio_school = tbl_config.id AND 
studentbio.studentbio_ethnicity = ethnicity.ethnicity_id AND 
grades.grades_id = student_grade_year.student_grade_year_grade AND 
studentbio.admit = '1' order by " . $sort1 . ", " . $sort2 . ", 
studentbio_lname ASC");
		}
		if (mysql_errno()) {
			die(mysql_errno() ."-".mysql_error());
		}
		while ($r = mysql_fetch_array($q)) {
			$info = compileInfoStudents($r);
			$pdf->Row($info);
		}
		$pdf->Output();
		exit;
		break;
	case "discipline":
		if ($start_db_date) { $start_db_date = fix_date($start_db_date); }
		if ($end_db_date)   { $end_db_date = fix_date($end_db_date); }
		$thing = _MAKE_REPORT_THING;
		if ($start_db_date) { $thing .= _MAKE_REPORT_FROM . $start_db_date; }
		if ($end_db_date)   { $thing .= _MAKE_REPORT_FROM . $end_db_date; }
		$pdf=new PDF();
		$w=array(25,30,25,25,30,55);
		$pdf->Open();
		$pdf->SetTitle($thing);
		$pdf->SetSubject($thing);
		$pdf->SetWidths($w);
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		$pdf->Write(1, $thing);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','B',10);
		$pdf->header1=array(_MAKE_REPORT_NAME,_MAKE_REPORT_INFRACTION,_MAKE_REPORT_DATE,_MAKE_REPORT_REPORTER,_MAKE_REPORT_ACTION,_MAKE_REPORT_NOTES);
		$pdf->PrintHeader();
		$pdf->SetFont('Arial','',8);
		$pdf->SetFillColor(255,255,255);
		if ($sort2 == 'none') {
			$q = "SELECT * FROM discipline_history, 
infraction_codes, studentbio, tbl_config, ethnicity, school_years, 
grades, student_grade_year WHERE 
(discipline_history.discipline_history_student = studentbio.studentbio_id) 
AND (discipline_history.discipline_history_code = 
infraction_codes.infraction_codes_id) AND 
(discipline_history.discipline_history_school = 
tbl_config.id) AND (studentbio.studentbio_ethnicity = 
ethnicity.ethnicity_id) AND (school_years.school_years_id = 
discipline_history.discipline_history_year) AND (studentbio.studentbio_id 
= student_grade_year.student_grade_year_student) AND (grades.grades_id = 
student_grade_year.student_grade_year_grade)	AND 
(discipline_history.discipline_history_date BETWEEN '$start_db_date' AND 
'$end_db_date') ORDER BY discipline_history_date, $sort1, 
studentbio_lname ASC";
		} else {
			$q = "SELECT * FROM discipline_history, 
infraction_codes, studentbio, tbl_config, ethnicity, school_years, 
grades, student_grade_year WHERE 
(discipline_history.discipline_history_student = studentbio.studentbio_id) 
AND (discipline_history.discipline_history_code = 
infraction_codes.infraction_codes_id) AND 
(discipline_history.discipline_history_school = 
tbl_config.id) AND (studentbio.studentbio_ethnicity = 
ethnicity.ethnicity_id) AND (school_years.school_years_id = 
discipline_history.discipline_history_year) AND (studentbio.studentbio_id 
= student_grade_year.student_grade_year_student) AND (grades.grades_id = 
student_grade_year.student_grade_year_grade)	AND 
(discipline_history.discipline_history_date BETWEEN '$start_db_date' AND 
'$end_db_date') ORDER BY discipline_history_date, $sort1, $sort2, 
studentbio_lname ASC";
		}
//		echo $q;
		$q1 = mysql_query($q);
		if (mysql_errno()) {
			die(mysql_errno() ."-".mysql_error());
		}
		while ($r = mysql_fetch_array($q1)) {
			$info = compileInfoDiscipline($r);
			$pdf->Row($info);
		}
		$pdf->Output();
		exit;
		break;
	case "attendance":
		if ($start_db_date) { $start_db_date = fix_date($start_db_date); }
		if ($sort2 == 'none') {
			$q1 = "SELECT * FROM attendance_history, 
attendance_codes, studentbio, student_grade_year, tbl_config, ethnicity, 
grades WHERE (attendance_history.attendance_history_student = 
studentbio.studentbio_id) AND (attendance_history.attendance_history_code 
= attendance_codes.attendance_codes_id) AND (studentbio.studentbio_id = 
student_grade_year.student_grade_year_student) AND 
(studentbio.studentbio_school = tbl_config.id) AND 
(studentbio.studentbio_ethnicity = ethnicity.ethnicity_id) AND 
(grades.grades_id = student_grade_year.student_grade_year_grade) AND 
(attendance_history.attendance_history_date = '$start_db_date') ORDER BY 
$sort1, studentbio_lname ASC";
		} else {
			$q1 = "SELECT * FROM attendance_history, 
attendance_codes, studentbio, student_grade_year, tbl_config, ethnicity, 
grades WHERE (attendance_history.attendance_history_student = 
studentbio.studentbio_id) AND (attendance_history.attendance_history_code 
= attendance_codes.attendance_codes_id) AND (studentbio.studentbio_id = 
student_grade_year.student_grade_year_student) AND 
(studentbio.studentbio_school = tbl_config.id) AND 
(studentbio.studentbio_ethnicity = ethnicity.ethnicity_id) AND 
(grades.grades_id = student_grade_year.student_grade_year_grade) AND 
(attendance_history.attendance_history_date = '$start_db_date') ORDER BY 
$sort1, $sort2, studentbio_lname ASC";
		}
		$q = mysql_query($q1);
		$pdf=new PDF();
		$w=array(35,30,35,35,35);
		$pdf->Open();
		$pdf->SetWidths($w);
		$pdf->AddPage();
		$pdf->SetLeftMargin(20);
		$pdf->SetFont('Arial','B',12);
		$pdf->header1=array(_MAKE_REPORT_NAME,_MAKE_REPORT_SEX,_MAKE_REPORT_SCHOOL,_MAKE_REPORT_REASON,_MAKE_REPORT_NOTES);
		$pdf->PrintHeader();
		$pdf->SetFont('Arial','',8);
		$pdf->SetFillColor(255,255,255);
//		echo $q1;
		if (mysql_errno()) {
			die(mysql_errno() ."-".mysql_error());
		}
		while ($r = @mysql_fetch_array($q)) {
			$info = compileInfoAttendance($r);
			$pdf->Row($info);
		}
		$pdf->Output();
		exit;
		break;
}

function compileInfoAttendance($in) {
	$info = array();
	$info[0] = $in['studentbio_fname'] . " " . $in['studentbio_lname'];
	$info[1] = $in['studentbio_gender'];
	$info[2] = $in['school_name'];
	$info[3] = $in['attendance_codes_desc'];
	$info[4] = $in['attendance_history_notes'];
	for ($i=0;$i<=4;$i++) {
		if (!$info[$i]) {
			$info[$i] = '';
		}
	}
	return $info;
}


function compileInfoStudents($in1) {
	$info = array();
	$id = $in1['studentbio_id'];
	$q = mysql_query("select * from student_grade_year where student_grade_year_student = $id order by student_grade_year_year LIMIT 1");
	$r = mysql_fetch_array($q);

	$info[0] = $in1['studentbio_internalid'];
	$info[1] = $in1['studentbio_fname']." ".$in1['studentbio_lname'];
	$info[2] = $in1['studentbio_dob'];
//	$k = $in1['studentbio_school'];
//	$info[3] = $sch[$k];
	$info[3] = $in1['school_name'];
//	echo $in1['student_grade_year_year'];
	$info[4] = "Grade ".$r['student_grade_year_grade'];
	$info[5] = $in1['studentbio_homeroom'];
//	$k = $in1['studentbio_ethnicity'];
//	$info[6] = $eth[$k];
	$info[6] = $in1['ethnicity_desc'];
	$info[7] = $in1['studentbio_gender'];
	$info[8] = $in1['studentbio_bus'];
	for ($i=0;$i<=8;$i++) {
		if (!$info[$i]) {
			$info[$i] = '';
		}
	}
	return $info;
}

function compileInfoDiscipline($in) {
	$info = array();
	$info[0] = $in['studentbio_fname'] . " " . $in['studentbio_lname'];
	$info[1] = $in['infraction_codes_desc'];
	$info[2] = $in['discipline_history_date'];
	$info[3] = $in['discipline_history_reporter'];
	$info[4] = $in['discipline_history_action'];
	$info[5] = $in['discipline_history_notes'];
	for ($i=0;$i<=5;$i++) {
		if (!$info[$i]) 
			$info[$i] = '';
	}
	return $info;
}
?>
