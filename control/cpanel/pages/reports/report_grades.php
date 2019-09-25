<?php
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
$start_db_date = get_param("start_date");
$end_db_date = get_param("end_date");

// if(!$sorted_1) $sorted_1 = $GET['sorted_1'];
// if(!$sorted_2) $sorted_2 = $GET['sorted_2'];

if($start_db_date) $start_db_date = fix_date($start_db_date);
if($end_db_date) $end_db_date = fix_date($end_db_date);

$previous_student = "";

$q = "SELECT * from grade_history, studentbio, ethnicity, school_names, school_years, grade_subjects, school_rooms 
	WHERE (grade_history.grade_history_student = studentbio.studentbio_id) 
	AND (grade_history.grade_history_year = school_years.school_years_id) 
	AND (studentbio.studentbio_ethnicity = ethnicity.ethnicity_id) 
	AND (grade_history.grade_history_school = school_names.school_names_id) 
	AND (grade_history.grade_history_year = school_years.school_years_id) 
	AND (studentbio.studentbio_homeroom = school_rooms.school_rooms_id) ";

$q .= " ORDER BY studentbio.studentbio_id";
if($sorted_2 == $sorted_1) $sorted_2 = 'none';
if($sorted_2 != 'none') $q .= ", $sorted_2";

if($sorted_1 == "grades_id") $sorted_1 = 'grade_history_grade';
else if($sorted_1 == "studentbio_ethnicity") $display_1 = 'ethnicity_desc';
else if($sorted_1 == "studentbio_homeroom") $display_1 = 'school_rooms_desc';
else $display_1 = $sorted_1;

if($sorted_2 == "grades_id") $display_2 = 'grade_history_grade';
else if($sorted_2 == "studentbio_ethnicity") $display_2 = 'ethnicity_desc';
else if($sorted_1 == "studentbio_homeroom") $display_1 = 'school_rooms_desc';
else $display_2 = $sorted_2;
// print ("$sorted_1" . _REPORT_GRADES_VALUE);
// print (_REPORT_GRADES_VALUE2 . "$q");
$r = $db->get_results($q);

//begin PDF output!
require('fpdf.php');

class RCPDF extends FPDF
{
	//Current column
	var $col=0;
	//Ordinate of column start
	var $y0;

	//Page header
	function Header()
	{
	    global $student, $school;
	
	    $this->SetFont('Arial','B',12);
	    $this->SetLineWidth(1);
	
	    $this->Cell(50,10,$student,0,0,'L');
	
	    $w = $this->GetStringWidth($school)+50;
	    $this->Cell($w,10,$school,0,0,'R');
	
	    $this->Ln(20);
	
	    //Save ordinate
	    $this->y0=$this->GetY();
	}
	
	//Page footer
	function Footer()
	{
	    //Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    //Arial italic 8
	    $this->SetFont('Arial','I',8);
	    //Page number
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	function SetCol($col)
	{
    //Set position at a given column
    $this->col=$col;
    $x=10+$col*65;
    $this->SetLeftMargin($x);
    $this->SetX($x);
	}

	function AcceptPageBreak()
	{
    //Method accepting or not automatic page break
    if($this->col<2)
    {
        //Go to next column
        $this->SetCol($this->col+1);
        //Set ordinate to top
        $this->SetY($this->y0);
        //Keep on page
        return false;
    }
    else
    {
        //Go back to first column
        $this->SetCol(0);
        //Page break
        return true;
    }
	}

	function PrintHeaders($data)
	{
    $this->SetFont('Arial', 'B', 12);
    foreach($data as $row)
    {
       $this->Cell(40,6,$row,1);
    }
 	  $this->Ln();

	}

	function PrintRow($data)
	{
    $this->SetFont('Arial', '', 10);
    foreach($data as $row)
    {
       $this->Cell(30,8,$row,1);
    }
 	  $this->Ln();

	}
	function PrintStudent($student)
	{
			$this->SetFont('Arial','R',10);
	    $this->Cell(0,6,"$student",0,1,'R');
	    $this->Ln();
  	  //Save ordinate
  	  $this->y0=$this->GetY();
	}

	function PrintGrades($grade)
	{
			
	    $this->Ln(4);
  	  //Save ordinate
  	  $this->y0=$this->GetY();
	}

}


if(is_array($r)) {
//Instanciation of inherited class
	$pdf=new RCPDF();
	$pdf->AliasNbPages();

	//echo"<table align='center' width='80%' cellpadding=5><th>Active Students Report</th>";
	foreach($r as $s) {

		$current_student = $s->studentbio_id;
		if($current_student != $previous_student) {
			//build the header with the info about the student
			$student = $s->studentbio_fname." ".$s->studentbio_mi." ".$s->studentbio_lname;
			$school = $s->school_names_desc;
		
 			$pdf->AddPage($student, $school);
			$pdf->SetFont('Times','',12);
		
			//$pdf->SetX(30);
			$head = array('Subject', 'Quarter', 'Grade', 'Effort', 'Conduct');
			$pdf->PrintRow($head);
		}
	
			
			$data = array($s->grade_subject_desc, 
				$s->grade_history_quarter,
				$s->grade_history_grade,
				$s->grade_history_effort,
				$s->grade_history_conduct);
			//print_r($head);
			//print_r($data);
			$pdf->PrintRow($data);
			$pdf->Cell(25, 10, 'Comment 1:', 1, 0, 0, 0);
			$pdf->Cell(125, 10, $db->get_var("SELECT grade_names_desc FROM grade_names WHERE grade_names_id = '$s->grade_history_comment1'"), 1, 1, 0, 0);
			$pdf->Cell(25, 10, 'Comment 2:', 1, 0, 0, 0);
			$pdf->Cell(125, 10, $db->get_var("SELECT grade_names_desc FROM grade_names WHERE grade_names_id = '$s->grade_history_comment2'"), 1, 1, 0, 0);
			$pdf->Cell(25, 10, 'Comment 3:', 1, 0, 0, 0);
			$pdf->Cell(125, 10, $db->get_var("SELECT grade_names_desc FROM grade_names WHERE grade_names_id = '$s->grade_history_comment3'"), 1, 1, 0, 0);

		$custom_fields_query = "SELECT * from custom_fields, custom_grade_history
			WHERE (custom_grade_history.custom_field_id = custom_fields.custom_field_id) 
			AND (custom_grade_history.grade_history_id = '$s->grade_history_id')";
			
		$custom_fields = $db->get_results($custom_fields_query);
		if(is_array($custom_fields)) {
			foreach($custom_fields as $cf) {
				$pdf->Cell(25, 10, $cf->name, 1, 0, 0, 0);
				$pdf->Cell(125, 10, $cf->data, 1, 1, 0, 0);
		
			}
		
		}
			
		if ($sorted_2 != "none") { $ps2 = $s->{$sorted_2}; }
		$ps1 = $s->{$sorted_1};
		$previous_student = $s->studentbio_id;
	}	
	
	//display the report	
	
//doug: maybe add this so the browser knows to open adobe
$pdf->Output();

header('Content-Type: application/pdf');
header('Content-Disposition: inline');
        
} else {
	echo"<center><h1>" . _REPORT_GRADES_NONE . "</h2></center>";
}

