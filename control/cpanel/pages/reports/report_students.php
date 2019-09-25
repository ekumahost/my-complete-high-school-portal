<?php
//v1.52 01-05-05 sort by last name on all reports
session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
{
	header ("Location: index.php?action=notauth");
	exit;
}

//set up database connection
include_once"../../../includes/ez_sql.php";
include_once"../../../includes/common.php";
// Include configuration
include_once "../../../includes/configuration.php";

$sorted_1 = get_param("sorted_1");
$sorted_2 = get_param("sorted_2");

// if(!$sorted_1) $sorted_1 = $GET['sorted_1'];
// if(!$sorted_2) $sorted_2 = $GET['sorted_2'];

$q = "SELECT * FROM studentbio, student_grade_year, ethnicity, grades, school_rooms 
WHERE (studentbio.studentbio_id = student_grade_year.student_grade_year_student) 
AND (studentbio.studentbio_ethnicity = ethnicity.ethnicity_id) 
AND school_rooms.school_rooms_id = student_grade_year.student_grade_year_class_room
AND (grades.grades_id = student_grade_year.student_grade_year_grade) 
AND (studentbio.admit = '1') AND (student_grade_year.student_grade_year_year = '".$_SESSION['CurrentYear']."')";

$q .= " ORDER BY $sorted_1";
if($sorted_2 == $sorted_1) $sorted_2 = 'none';
if($sorted_2 != 'none') $q .= ", $sorted_2";

if($sorted_1 == "grades_id") $display_1 = 'grades_desc';
else if($sorted_1 == "studentbio_ethnicity") $display_1 = 'ethnicity_desc';
else if($sorted_1 == "student_grade_year_class_room") $display_1 = 'school_rooms_desc';
else $display_1 = $sorted_1;

if($sorted_2 == "grades_id") $display_2 = 'grades_desc';
else if($sorted_2 == "studentbio_ethnicity") $display_2 = 'ethnicity_desc';
else if($sorted_2 == "student_grade_year_class_room") $display_2 = 'school_rooms_desc';
else $display_2 = $sorted_2;

$q .= ", studentbio_lname ASC";
$r = $db->get_results($q);

?>
<html><title><?php echo _REPORT_STUDENT_BROWSER_TITLE?></title>
<head>
<style type="text/css" media="all">@import "student-admin.css";</style>
</head>
<body>
<?php
if(is_array($r)) {
	echo"<table align='center' width='80%' cellpadding=5>
	     <th><h1>" . _REPORT_STUDENT_HEADER . "</h1></th>";
	$ps1 = "";
	$ps2 = "";
	foreach($r as $s) {
	
		$cs1 = $s->{$sorted_1};
		if($cs1 != $ps1) {
			$cd1 = $s->{$display_1};
			$heading_text_1 = "";
			if($display_1 == 'studentbio_bus') $heading_text_1 = _REPORT_STUDENT_ROUTE;
			else if($display_1 == 'student_grade_year_class_room') $heading_text_1 = _REPORT_STUDENT_HOME;

			echo"<tr><td align='left'><h1>$heading_text_1 $cd1</h1></td></tr>";
		}
	
		if($sorted_2 != 'none') {
			$cs2 = $s->{$sorted_2};
			if($cs2 != $ps2) {
				$cd2 = $s->{$display_2};
				$heading_text_2 = "";
				if($display_2 == 'studentbio_bus') $heading_text_2 = _REPORT_STUDENT_ROUTE;
				else if($display_2 == 'student_grade_year_class_room') $heading_text_2 = _REPORT_STUDENT_HOME;
				echo"<tr><td align='right'><h2>$heading_text_2 $cd2</h2></td></tr>";	
			}
		}
	
		//display the students name
		echo"<tr><td align='center'><table width='100%' border=1>
			<tr><td><table width='100%'><tr><td><table width='100%'><tr><td class='record_heading'>
			$s->studentbio_fname $s->studentbio_lname</td>";

		//display the students gender
		if($sorted_1 != 'studentbio_gender' && $sorted_2 != 'studentbio_gender') 
			echo"<td class='gender' align='right'>($s->studentbio_gender)</td>";
		echo"</tr></table></td></tr>";
		//the static column headers
		echo"<tr><td><table border=1 width='100%'><tr class='tblhead'>
			<td>" . _REPORT_STUDENT_INTERNAL . "</td><td>" . _REPORT_STUDENT_DOB . "</td><td>" . _REPORT_STUDENT_SCHOOL . "</td>";
		//the dynamic column headers
		if($sorted_1 != 'grades_id' && $sorted_2 != 'grades_id') 
			echo"<td>" . _REPORT_STUDENT_GRADE . "</td>";
		if($sorted_1 != 'studentbio_ethnicity' && $sorted_2 != 'studentbio_ethnicity')
			echo"<td>" . _REPORT_STUDENT_ETHNICITY . "</td>";
		if($sorted_1 != 'student_grade_year_class_room' && $sorted_2 != 'student_grade_year_class_room')
			echo"<td>" . _REPORT_STUDENT_HOME . "</td>";
		if($sorted_1 != 'studentbio_bus' && $sorted_2 != 'studentbio_bus')
			echo"<td>" . _REPORT_STUDENT_ROUTE . "</td>";

		echo"</tr><tr class='tblcont'><td>$s->studentbio_internalid</td><td>$s->studentbio_dob</td>
			<td></td>";
		if($sorted_1 != 'grades_id' && $sorted_2 != 'grades_id') 
			echo"<td>$s->grades_desc</td>";
		if($sorted_1 != 'studentbio_ethnicity' && $sorted_2 != 'studentbio_ethnicity')
			echo"<td>$s->ethnicity_desc</td>";
		if($sorted_1 != 'student_grade_year_class_room' && $sorted_2 != 'student_grade_year_class_room')
			echo"<td>$s->school_rooms_desc</td>";
		if($sorted_1 != 'studentbio_bus' && $sorted_2 != 'studentbio_bus')
			echo"<td>$s->studentbio_bus</td>";

		echo"</tr></table></td></tr></table></td></tr></table></td></tr>";
		if ($sorted_2 != "none") { $ps2 = $s->{$sorted_2}; }
		if ($sorted_1 != "none") { $ps1 = $s->{$sorted_1}; }
	}	

	?></table></body></html><?php

} else {
	echo"<center><h1>" . _REPORT_STUDENT_NONE . "</h2></center>";
}
