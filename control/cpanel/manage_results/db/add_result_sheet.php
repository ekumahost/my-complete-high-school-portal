<?php

exit;
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


?>

<p><br /> 
  <strong><br />
Result Sheets Creation</strong>: <em>if students register course online or school type is not university you will not need to run this process</em></p>
<p><em><font color="red">Make sure all students are in their current year and the portal also in current year before you proceed. Go to home and click total students, go to manage student type in filter to see student in any class </font></em></p>
<form action="process_result_sheet.php"  method="post">
<input name="submited" type="hidden" /> 
&nbsp;Course: 
<select name="cs">
  <option></option>
  <?php $kas_framework->getallFieldinDropdownOption('grade_subjects', 'code', 'grade_subject_id') ?>
</select>

&nbsp;Year(of exam): <select name="yr"> <option></option>
				<?php $kas_framework->getallFieldinDropdownOption('school_years', 'school_years_desc', 'school_years_id') ?>
				</select>
				Exam type 
				<select name="extype"><option></option>
				<?php $kas_framework->getallFieldinDropdownOption('exams_types', 'exams_types_desc', 'exams_types_id') ?>
				</select>
				Sem: 
				<select name="sem"><option></option>
				<?php $kas_framework->getallFieldinDropdownOption('grade_terms', 'grade_terms_desc', 'grade_terms_id') ?>
				</select><br /><br />
Level:(add all students from this level) 
				<select name="lev"><option></option>
				<?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id') ?>
				</select>
				<br />
				<br />
				<br />
<input type="submit" value="Create Result Sheet" /> 
</form>
