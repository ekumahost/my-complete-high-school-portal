<?php


	//Include global functions
include_once "../../../includes/common.php";
//Initiate special database functions
include_once "../../../includes/true_mysql.php";
//Use common ez_sql stuff too
include_once "../../../includes/ez_sql.php";
//include_once "../../../includes/ez_results.php";

// config
include("formkas-framework.php");


  session_start();
if(!isset($_SESSION['UserID']))
  {
    header ("Location: ../../../index.php?action=notauth");
	exit;
}

exit;
echo 'result is added in results';
?>

<br /> <br />


Warning: do not type wrong reg number
<form action="processform.php"  method="post">
<input name="submited" type="hidden" /> 
&nbsp;Course: 
<select name="cs">
  <option></option>
  <?php $kas_framework->getallFieldinDropdownOption('grade_subjects', 'code', 'grade_subject_id') ?>
</select>
Exam type 
				<select name="extype"><option></option>
				<?php $kas_framework->getallFieldinDropdownOption('exams_types', 'exams_types_desc', 'exams_types_id') ?>
				</select>
				


&nbsp;Year(of exam): <select name="yr"> <option></option>
				<?php $kas_framework->getallFieldinDropdownOption('school_years', 'school_years_desc', 'school_years_id') ?>
				</select>
				Term: 
				<select name="sem"><option></option>
				<?php $kas_framework->getallFieldinDropdownOption('grade_terms', 'grade_terms_desc', 'grade_terms_id') ?>
				</select><br /><br />
Level:(std yr of study) 
				<select name="lev"><option></option>
				<?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id') ?>
				</select>
				
				
Reg: no
<input type="number" name="regyr" id="regyr" placeholder="2010" width="30" style="font-size:18px; width:60px"  />/<input type="number" name="unn" id="unn" placeholder="170555" width="40" style="font-size:18px; width:80px"  />



<input type="number" name="exam" id="exam" placeholder="Exam score" width="80" style="font-size:18px"  />
<input type="number" name="ca" id="ca" placeholder="CA score" width="80" style="font-size:18px"  />
<br /><br /><br />
<input type="submit" value="Add to Result Sheet" />
</form>
