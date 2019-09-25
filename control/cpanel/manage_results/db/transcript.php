<?php

	//Include global functions
include_once "../../../includes/common.php";
//Initiate special database functions
include_once "../../../includes/true_mysql.php";
//Use common ez_sql stuff too
include_once "../../../includes/ez_sql.php";
//include_once "../../../includes/ez_results.php";

// config
include("kas-framework.php");


  session_start();
if(!isset($_SESSION['UserID']) || (time() - $_SESSION['LAST_ACTIVITY'] > 700)) // 700 seconds we log him out 
  {
    header ("Location: ../../../index.php?action=notauth");
	exit;
}


?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Transcript App</title>

		<!-- include javascript and css files for the EditableGrid library -->
		
		<link rel="stylesheet" href="ext/jquery/jquery-ui-1.8.16.custom.css" type="text/css" media="screen">
		
		<link rel="stylesheet" type="text/css" href="css/app.css" media="screen"/>
		<script type="text/javascript">
			window.onload = function() { 
				 // do nothing?
			}; 
		</script>
				
			

		
		
		
	
	<style type="text/css">
<!--
body {
	background-color: #F7F2D7;
}
-->
    </style></head>
	
	<body>
	
	
<div align="left" style="position:fixed; border-radius:10px; width:98%;background:rgba(55,250,10,0.7); margin-right:20px">
		<h1>
		
		&nbsp;&nbsp;&nbsp;FACULTY OF PHARMACUETICAL SCIENCES--UNN (Transcript Result System) 
		
		
		
		<a href="transcript?setresult=yes">Refresh page & Back to menu</a>&nbsp;&nbsp;&nbsp;&nbsp;</h1>
		<p>
		<hr> </hr>	
		
		<div id="edz">
				<form action="" method="get">
				<input type="hidden" name="setresult" value="yes"> </input>
				<input type="hidden" name="selectme" value="yes"> 
				</input>
				<strong>Student: All Results</strong>	Reg:<input name="reg" placeholder="170555"> </input>			&nbsp;Ses: 
				<select name="school_years"> 
								<option id="0"> ALL</option>

				<?php $kas_framework->getallFieldinDropdownOption('school_years', 'school_years_desc', 'school_years_id') ?>
				</select>
				Sem: 
				<select name="pharm_semesters"><option id="0">ALL</option>
				<?php $kas_framework->getallFieldinDropdownOption('pharm_semesters', 'sem_desc', 'id') ?>
				</select>
				&nbsp;&nbsp;
<input type="submit" value="Load Results"> 

</input>
				</form> </div> <br>
			<hr> </hr>	
				
				
				
				
				
				<div id="edz">
				<form action="" method="get">
				<input type="hidden" name="setresult" value="yes"> </input>
				<input type="hidden" name="selectme" value="yes">
				<strong>Result Sheet</strong>: 
				</input>

				&nbsp;Ses: 
				<select name="school_years"> <option></option>
				<?php $kas_framework->getallFieldinDropdownOption('school_years', 'school_years_desc', 'school_years_id') ?>
				</select>
				 
				
				Course: 
				<select name="course"><option></option>
				<?php $kas_framework->getallFieldinDropdownOption('grade_subjects', 'code', 'grade_subject_id') ?>
				</select>
				&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Load Result Sheet">
				</form> </div>
				
				
				
				
				<br> 
				
				<hr> </hr>
				
				<div id="edz">
				<form action="" method="get">
				<input type="hidden" name="setresult" value="yes"> </input>
				<input type="hidden" name="selectme" value="yes"> 
				</input>

				<strong>CGPA</strong>:
				Level: 
				<select name="grade_class"><option></option>
				<?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id') ?>
				</select>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" value="Load CGPA"> 
<em>
</input></em>
				</form> <hr> </hr>	</div>
		
		
		
		
		
	</p>
	
	
		<div id="message"></div>

			<!--  Number of rows per page and bars in chart -->
			<div id="pagecontrol"> <div id="loading" style="width:10px; position:static"> </div>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Download&nbsp;&nbsp;&nbsp;
				<label for="pagecontrol"><font color="#FFFFFF"></font></label>	
			</div>
		
			<script type="text/javascript">
	
$(document).ready(function(){

 <?php include("pageajax.js");?>

});
	

	</script>
		
		
			<!-- Grid filter -->
			<label for="filter">&nbsp;&nbsp;&nbsp;&nbsp;</label> <!--<button id="uploadcsv"> Upload From CSV file</button>-->
</div>
	
	
	
	
	<p><br>
      </p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p><br>
      <br>
	  <br>
	  <br>
	  <br>
	  <br>
	  <br>
	  <br> 
	  <br>
	  <br> 
	  <br>
	  
	  
	  
	  
    </p>
	<div id="alerts" style="width:70%;" align="center">

	
	
	</div>
	
	

		
	
		
		
	</body>

</html>