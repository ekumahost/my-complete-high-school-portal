<?php
(file_exists('../../../php.files/classes/pdoDB.php'))? include ('../../../php.files/classes/pdoDB.php'): include ('../../../../php.files/classes/pdoDB.php');
(file_exists('../../../php.files/classes/kas-framework.php'))? include ('../../../php.files/classes/kas-framework.php'): include ('../../../../php.files/classes/kas-framework.php');
//Include global functions
include_once "../../../includes/common.php";
//Initiate special database functions
include_once "../../../includes/true_mysql.php";

  session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
  {
    header ("Location: ../../../index.php?action=notauth");
	exit;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>School fees manager</title>
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
		
		
<?php if (isset($_GET['setfee'])) { 
// we can better still use switch to chech for session,term,grade before applying below
// SWITCH CASE FOR ALL THE TERMS HERE start by saying if isset selectme
if (isset($_GET['feetype']) && $_GET['feetype'] == "Total") { 
	$mygr = $_GET['grade_class'];
	$myyr = $_GET['school_years'];
	 ?>
	<script type="text/javascript">window.onload = function() { editableGrid.onloadXML("data/<?php echo "loadtotal.php?mygrade=".$mygr."&mysession=".$myyr ?>"); } </script> 
	<?php 
}// end for feetype
else if (isset($_GET['feetype']) && $_GET['feetype'] == "Components"){
	// gather our filter varialbe
	$mytm = $_GET['grade_terms'];
	$mygr = $_GET['grade_class'];
	$myyr = $_GET['school_years'];
	// after here we load the filtered ones. if the idiot choose a term that does not exit we just wink at him
?> 
<script type="text/javascript">window.onload = function() { editableGrid.onloadXML("data/<?php echo "loadcomponent.php?mygrade=".$mygr."&mysession=".$myyr."&myterm=".$mytm ?>"); } </script> 

<?php
}else {// end feetype else
	// lets load all the components/totlas
	?> 
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
		<h1><?php 
		// before switching, lets check if he submited the form
		if (isset($_GET['selectme'])){
		// tell the admin which school fee term, grade and year he is setting
		echo "Setting fee for>> "."SESSION :".$_GET['school_years']." Grade: ".$_GET['grade_class']." Term: ".$_GET['grade_terms']." for ".$_GET['feetype'];
		echo '<br />';
		// if the idiot want to set school fee for holiday or strike period, warn him but dont stop him
		if($_GET['grade_terms'] > 3){ echo' <font color="red">School fee can not be set for holiday/strike</font>'; }
		if(empty($_GET['grade_terms']) && $_GET['feetype'] != "Total"){ echo' <font color="red">Please select a term to set</font>'; }
		if(empty($_GET['grade_class']) or empty($_GET['school_years']) ){ echo' <font color="red">Please select all fields </font>'; }

		} else{ echo 'This is total/all component of school fees '."please select session/grade/term to edit/set components."; }
		
		?>
	<a href="../index.html">Back to menu</a>&nbsp;&nbsp;&nbsp;&nbsp;</h1>
		<p>
		
		
		<div id="edz">
				<form action="" method="get">
				<input type="hidden" name="setfee"> </input>
				<input type="hidden" name="selectme"> </input>

				Session: <select name="school_years"> <option value=""> --select session--</option>
				<?php $kas_framework->getallFieldinDropdownOption('school_years', 'school_years_desc', 'school_years_id', @$_GET['school_years']) ?>
				</select>
				Term: <select name="grade_terms"><option> --select term-- </option>
				<?php $kas_framework->getallFieldinDropdownOption('grade_terms', 'grade_terms_desc', 'grade_terms_id', @$_GET['grade_terms']) ?>
				</select>
				Grade Year: <select name="grade_class"><option> --select class-- </option>
				<?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id', @$_GET['grade_class']) ?>
				</select>
				Type: <select name="feetype"> <option> --select type-- </option>
					<option id="Total" value="Total" <?php echo (@$_GET['feetype'] == 'Total') ? 'selected="selected"': ''; ?> >Total School Fee</option>
					<option id="Components" value="Components" <?php echo (@$_GET['feetype'] == 'Components') ? 'selected="selected"': ''; ?>>School Fee Components</option>
				</select>
				
				<button type="submit" style="background-color:green; color:#FFF; padding:2px 5px"> Edit Select Filtered >> </button>				
			</form>
	</div>
	</p>
	<div id="message"></div>

			<!--  Number of rows per page and bars in chart -->
			<div id="pagecontrol">
				<label for="pagecontrol"><font color="#FFFFFF">Number of Rows to display:</font> </label>
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
				<label for="barcount">Grade in bar chart: </label>
				<select id="barcount" name="barcount">
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
			</div>		
			<!-- Grid filter -->
			<label for="filter">Filter :</label>
			<input type="text" id="filter" placeholder ="&nbsp;type item name or year"/> 	
	</div>
	<br><br><br><br><br><br><br><br><br><br><br> <br><br><br><br><br><br><br>
		<div id="wrap">
		<!-- Paginator control -->
			<div id="paginator"></div>
		<br>
			<!-- Grid contents -->
			<div id="tablecontent"><img src="balls.gif"></img></div>
		<br>
			<a href="add.php"> Add a single Component</a>
			<!-- Edition zone (to demonstrate the "fixed" editor mode) -->
			<div id="edition"></div>
			
			<!-- Charts zone -->
			<div id="barchartcontent"></div>
			<div id="piechartcontent"></div>
			
		</div>
	</body>

</html>