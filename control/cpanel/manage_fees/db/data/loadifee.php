<?php     

	//Include global functions
include_once "../../../../includes/common.php";
//Initiate special database functions
include_once "../../../../includes/true_mysql.php";
// config
include_once "../../../../includes/configuration.php";

  session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
  {
    header ("Location: ../../../../index.php?action=notauth");
	exit;
}


/**
 * This script loads data from the database and returns it to the js
 *
 */
 $tooosh = "toosh";// just using this to check if a hacker is trying to enter Editablegrid.php
require_once('../config.php');  // JUST TO LOAD THE DATA, YOU NEED CONFIG FILE TO CONNET DB    
require_once('EditableGrid.php');
$grid = new EditableGrid();


$grid->addColumn('id', 'ID', 'integer', NULL, false); 
$grid->addColumn('component', 'All Components/totals', 'string',  NULL, false);// null = no edit false = what?  
$grid->addColumn('school_name', 'School', 'string', fetch_pairs($mysqli,'SELECT school_names_id, school_names_desc FROM school_names'),false ); 
$grid->addColumn('school_year', 'Session', 'string', fetch_pairs($mysqli,'SELECT school_years_id, school_years_desc FROM school_years'),false ); 
$grid->addColumn('grades', 'Grade', 'string', fetch_pairs($mysqli,'SELECT grades_id, grades_desc FROM grades'),false ); 
$grid->addColumn('grades_term', 'Term', 'string', fetch_pairs($mysqli,'SELECT grade_terms_id, grade_terms_desc FROM grade_terms'),false ); 
$grid->addColumn('price', 'Price', 'integer',  NULL, false); 
$grid->addColumn('action', 'Action', 'html');  
				 
						 
$result = $mysqli->query('SELECT *, date_format(date, "%d/%m/%Y") as date FROM school_fees ');
$mysqli->close();

// send data to the browser
$grid->renderXML($result);

?>