<?php     
//Include global functions
include_once "../../../../includes/common.php";
//Initiate special database functions
include_once "../../../../includes/true_mysql.php";
// config
include_once "../../../../includes/configuration.php";

  session_start();
if(!isset($_SESSION['UserID'])) {
    header ("Location: ../../../../index.php?action=notauth");
	exit;
}

$pmt = $_SESSION['UserType'];// A =admin, Q = office

$tooosh = "toosh";// just using this to check if a hacker is trying to enter Editablegrid.php   
require_once('EditableGrid.php');
$grid = new EditableGrid();

$grid->addColumn('id', 'ID', 'integer', NULL, false); 
$grid->addColumn('course_code', 'Course Code', 'string', fetch_pairs($mysqli, 'SELECT grade_subject_id, code FROM grade_subjects'),false );
$grid->addColumn('exam_type', 'Exam Type', 'string', fetch_pairs($mysqli, 'SELECT exams_types_id, exams_types_desc FROM exams_types'),true );
$grid->addColumn('quarter', 'Term', 'string', fetch_pairs($mysqli, 'SELECT grade_terms_id, grade_terms_desc FROM grade_terms'),true ); 
$grid->addColumn('year', 'Session', 'string', fetch_pairs($mysqli, 'SELECT school_years_id, school_years_desc FROM school_years'),true );
$grid->addColumn('student', 'Student Reg', 'string', fetch_pairs($mysqli, 'SELECT studentbio_id, studentbio_internalid FROM studentbio'),false );
$grid->addColumn('std_name', 'Last name', 'string', fetch_pairs($mysqli, 'SELECT studentbio_id, studentbio_lname FROM studentbio'),false );
$grid->addColumn('exam_score', 'Exam Score', 'integer', NULL, true);  
$grid->addColumn('ca_score', 'CA Score', 'integer', NULL, true);



 // switching permision
switch ($pmt) {
  case "A":
  $grid->addColumn('aprove', 'Aproved', 'boolean', NULL, true);

break;

case "Q":
$grid->addColumn('aprove', 'Aproved', 'boolean', NULL, false);

break;
default:
$grid->addColumn('aprove', 'Aproved', 'boolean', NULL, false);

}
// permision switch ends here	

$grid->addColumn('level_taken', 'Std yr', 'string', fetch_pairs($mysqli, 'SELECT grades_id, grades_desc FROM grades'),true ); 
$grid->addColumn('notes', 'Comment', 'string',  NULL, true);
$grid->addColumn('date', 'Date', 'date', NULL, true);  
 $grid->addColumn('age', 'Total', 'integer',  NULL, false);

$grid->addColumn('action', 'Action', 'html', NULL, false); 
$mylev = $_GET['mylevel'];
$mysession = $_GET['mysession'];
$mysem = $_GET['mysem'];
$mycourse = $_GET['mycourse'];
					 	
// this is when the course registration is not available
$result = $mysqli->query("SELECT *, date_format(date, '%d/%m/%Y') as date FROM grade_history_primary WHERE year ='$mysession' AND level_taken ='$mylev' AND quarter ='$mysem' AND course_code ='$mycourse' AND aprove !='1'");			
						 
$mysqli->close();

// send data to the browser
$grid->renderXML($result);

?>