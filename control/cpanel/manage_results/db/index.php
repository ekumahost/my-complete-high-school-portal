<?php
// Include configuration file
 include ('../../../../php.files/classes/pdoDB.php');
include ('../../../../php.files/classes/kas-framework.php');
	//Include global functions
include_once "../../../includes/common.php";
//Initiate special database functions
include_once "../../../includes/true_mysql.php";
//Use common ez_sql stuff too
include_once "../../../includes/ez_sql.php";
//include_once "../../../includes/ez_results.php";

  session_start();
//if(!isset($_SESSION['UserID']) || (time() - $_SESSION['LAST_ACTIVITY'] > 700)) // 700 seconds we log him out
if(!isset($_SESSION['UserID'])) // 700 seconds we log him out 

 
  {
    header ("Location: ../../../index.php?action=notauth");
	exit;
}


?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Result App</title>



		<!-- include javascript and css files for the EditableGrid library -->
		<script src="render/editablegrid.js"></script>
		<!-- [DO NOT DEPLOY] --> <script src="render/editablegrid_renderers.js" ></script>
		<!-- [DO NOT DEPLOY] --> <script src="render/editablegrid_editors.js" ></script>
		<!-- [DO NOT DEPLOY] --> <script src="render/editablegrid_validators.js" ></script>
		<!-- [DO NOT DEPLOY] --> <script src="render/editablegrid_utils.js" ></script>
		<!-- [DO NOT DEPLOY] --> <script src="render/editablegrid_charts.js" ></script>

		<!-- include javascript and css files for jQuery, needed for the datepicker and autocomplete extensions -->
		<script src="ext/jquery/jquery-1.6.4.min.js" ></script>
		<script src="ext/jquery/jquery-ui-1.8.16.custom.min.js" ></script>
		<link rel="stylesheet" href="ext/jquery/jquery-ui-1.8.16.custom.css" type="text/css" media="screen">
		
	
		
		<!-- include javascript files for the OpenFlashChart library -->
		<script src="ext/openflashchart/js/swfobject.js"></script>
		<script src="ext/openflashchart/js/json/json2.js"></script>
		<script src="ext/openflashchart/js-ofc-library/ofc.js"></script>
		<script src="ext/openflashchart/js-ofc-library/open_flash_chart.min.js"></script>



		<!-- include javascript and css files for this demo -->
		<script src="js/app.js" ></script>
		<link rel="stylesheet" type="text/css" href="css/app.css" media="screen"/>
		<script type="text/javascript">
			window.onload = function() { 
				 // do nothing?
			}; 
		</script>
				
			
<?php if (isset($_GET['setresult'])) { 

if(isset($_GET['course'])){

// gather our filter varialbe
$mysem = $_GET['quarter'];
$myclass = $_GET['grade_class'];
$myyr = $_GET['school_years'];
$mycs = $_GET['course'];


// after here we load the filtered ones. if the idiot choose a term that does not exit we just wink at him
?> 
<script type="text/javascript">window.onload = function() { editableGrid.onloadXML("data/<?php echo "load_sorted_result.php?mylevel=".$myclass."&mysession=".$myyr."&mysem=".$mysem."&mycourse=".$mycs ?>"); } </script> 

<?php
}else { // end feetype else ?> 
	<font color="red">Warning</font>: Critical Module -> read manual before using this module
	<script type="text/javascript">window.onload = function() { editableGrid.onloadXML("data/<?php echo "loaddata.php" ?>"); } </script> 

<?php

}
}//end for setfee

// checking if setfee is set ends here ?>
<style type="text/css">
<!--
body {
	background-color: #F7F2D7;
}
-->
    </style></head>
	
	<body>	
<div align="left" style="position:fixed; width:92%; background-color:#FFF; box-shadow:10px 10px 20px #CCC; margin:20px; padding:10px">
		<h1>
		&nbsp;&nbsp;&nbsp; General Result System <?php //echo $cyear;?>
		<a href="index?setresult=yes">Refresh table</a>&nbsp;&nbsp;&nbsp;&nbsp;</h1>
		<p>
		
		<div id="edz">
				<form action="" method="get">
				<input type="hidden" name="setresult" value="yes"> </input>
				<input type="hidden" name="selectme" value="yes"> </input>

				&nbsp;Ses: <select name="school_years"> <option></option>
				<?php $kas_framework->getallFieldinDropdownOption('school_years', 'school_years_desc', 'school_years_id', @$_GET['school_years']) ?>
				</select>
				Term: 
				<select name="quarter"><option></option>
				<?php $kas_framework->getallFieldinDropdownOption('grade_terms', 'grade_terms_desc', 'grade_terms_id', @$_GET['quarter']) ?>
				</select>
				Level: 
				<select name="grade_class"><option></option>
				<?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id', @$_GET['grade_class']) ?>
				</select>
				Course: 
				<select name="course"><option></option>
				<?php $kas_framework->getallFieldinDropdownOption('grade_subjects', 'code', 'grade_subject_id', @$_GET['course']) ?>
				</select>
				Exam type 
				<select name="extype"><option></option>
				<?php $kas_framework->getallFieldinDropdownOption('exams_types', 'exams_types_desc', 'exams_types_id', @$_GET['extype']) ?>
				</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Load/Edit Result Sheet"> 
<em>
</input>
<font size="1">Approved results will not load</font>				</em>
				</form> </div>
</p>
	
	
		<div id="message"></div>

			<!--  Number of rows per page and bars in chart -->
			<div id="pagecontrol"> <div id="loading" style="width:10px; position:static"> </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="pagecontrol"><font color="#FFFFFF">display:</font> </label>
				<select id="pagesize" name="pagesize">
					<option selected="selected" value="5">5</option>
					<option value="10">10</option>

					<option value="15">15</option>
					<option value="20">20</option>
					<option value="25">25</option>
					<option value="30">30</option>
					<option value="40">40</option>
					<option value="50">50</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="150">150</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">ALL</option>

					

				</select>
				&nbsp;&nbsp;
				<label for="barcount">chart: </label>
				<select id="barcount" name="barcount">
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
					<option value="25">25</option>
					<option value="30">30</option>
					<option value="40">40</option>
					<option value="50">50</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">ALL</option>	
			</select>	
		</div>
		
			<script type="text/javascript">
	
$(document).ready(function(){

 <?php include("pageajax.js");?>

});
	

	</script>
		<!-- Grid filter -->
			<label for="filter">&nbsp;&nbsp;&nbsp;&nbsp;Filter :</label>
			<input type="text" id="filter" placeholder ="sort by any variable"/>
			<!--
			<button id="add_result_sheet"> Create Result Sheets</button>
			   <button id="addsingle"> Add Single Result</button> &nbsp;&nbsp; <button id="uploadcsv"> Upload From CSV file</button>-->
</div>
<br><br><br><br><br><br><br><br><br><br><br> <br><br> <br><br>
	<div id="alerts" style="width:70%;" align="center">

	
	<?php 
		// before switching, lets check if he submited the form
		if (isset($_GET['selectme'])){
		// tell the admin which school fee term, grade and year he is setting
		
		if(!empty($_GET['quarter']) || $_GET['grade_class'] || $_GET['school_years'] || $_GET['course']){
		echo "Setting ResultS for>> "."SESSION :".$_GET['school_years']." Level: ".$_GET['grade_class']."00"." Term: ".$_GET['quarter']." for ".$_GET['course'];
		}
		
		// if the idiot want to set school fee for holiday or strike period, warn him but dont stop him
		if(empty($_GET['quarter'])){echo' <font color="red"> You must select Semester to load result Sheet</font><br>';}
		if(empty($_GET['grade_class'])){echo' <font color="red"> You must select Class to load result Sheet</font><br>';}
		if(empty($_GET['school_years'])){echo' <font color="red"> You must select Session to load result Sheet</font>';}
		if(empty($_GET['course'])){echo' <font color="red"> You must select Course to load result Sheet</font>';}

		}else{ echo ' All Results Found:: '."please select session/course/ to edit/publish results.";}
		
		?>
	</div>
	
	

	<div id="loadxt" style="width:98%;" align="center">... </div>
		<div id="wrap">
		<!-- Paginator control -->
			<div id="paginator"></div>
			<!-- Grid contents -->
			<div id="tablecontent"><img src="balls.gif"></img></div>
		
			<!-- Edition zone (to demonstrate the "fixed" editor mode) -->
			<div id="edition"></div>
			
			<!-- Charts zone -->
			<div id="barchartcontent"></div>
			<div id="piechartcontent"></div>
			
		</div>
</body>

</html>