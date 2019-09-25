<?php 
$title="Upload Result From CSV";


if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}

include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";
include("formkas-framework.php");


if(!isset($_SESSION['UserID']))
  {
    header ("Location: ../../../index.php?action=notauth");
	exit;
}


?>



<?php
// if the admin want to open sheet to publish
if(isset($_POST['setsheet'])){
          // incase session were set ealie for the param
  if(isset($_SESSION['MyCourse'])){		  
	  unset($_SESSION['MyCourse']);
	  unset($_SESSION['MyType']);
	  unset($_SESSION['MyYr']);
	  unset($_SESSION['MyGrade']);
 }
 
$mycourse = $_POST['cs'];
$mytype = $_POST['extype'];
$myyr = $_POST['yr'];
$mygrade = $_POST['grade'];

//$mysem = $_POST['sem'];

 // check if alll the form is filled else, bounce the user action
 if(empty($mycourse) || empty($mytype) || empty($myyr) || empty($mygrade)){
 $form_error = "<font class='alert alert-error'>Out of Idea!: You did not select course, session and/or exam type. try again.</font><br><br>";

 }else{


// set the variables to session
 set_session("MyCourse", $mycourse);
 set_session("MyType", $mytype);
 set_session("MyYr", $myyr);
 set_session("MyGrade", $mygrade);

 
// set_session("MySem", $mysem);
 }
//echo $mycourse.$mytype.$myyr.$mysem;
//echo $_SESSION['MyCourse'];

}

?>

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>Results</h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
	
<strong>Choose result sheet to publish</strong>	


<div align="right"> <a href="main?page=addresults"><button class="btn btn-small"><i class="icon-star"></i>Type Result Online</button>
</a><br /><br />
<a href="results?page=report_cards"><button class="btn btn-small"><i class="icon-star"></i>Report Cards</button>
</a>

</div>

<form action=""  method="post">
<input name="setsheet" type="hidden" /> 


Course
<select name="cs">
  <option></option>
  <?php $kas_framework->getallFieldinDropdownOption('grade_subjects', 'grade_subject_desc', 'grade_subject_id') ?>
</select>
Exam
<span class="center">
<select name="extype" style="width:140px">
  <option></option>
  <?php $kas_framework->getallFieldinDropdownOption('exams_types', 'exams_types_desc', 'exams_types_id') ?>
</select>
</span>
<span class="center">
Year
<select name="yr" style="width:120px">
  <option></option>
  <?php $kas_framework->getallFieldinDropdownOption('school_years', 'school_years_desc', 'school_years_id') ?>
</select>
</span>

<span class="center">

 Grade<select name="grade" style="width:140px">
  <option></option>
  <?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id') ?>
</select></span>


<input type="submit" value="Get Ready" class="btn btn-primary" /><br />
</form>

	
	
 <center>
	 <?php  if(isset($_SESSION['MyCourse'])){
// gather the deccriptions from db
	  $getcoursename = $kas_framework->getValue('code', 'grade_subjects', 'grade_subject_id', $_SESSION['MyCourse']);
 
       $getmytype = $kas_framework->getValue('exams_types_desc', 'exams_types', 'exams_types_id', $_SESSION['MyType']); 
       $getmyyr = $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $_SESSION['MyYr']);
  //$getmysem =$_SESSION['MySem'];
  
  echo '<font color="#009966">Upload CSV for: <b>'.$getcoursename.'</b> ('.$getmytype.') Session: '.$getmyyr.' @ '.$myowngrade = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $_SESSION['MyGrade']).'</font> <br>';
  ?> 
  

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  Choose your file: excel CSV<br /> 
  <input name="csv" type="file" id="csv" />
    <input name="upload" type="hidden" id="" />

  <input type="submit" name="Submit" value="Upload" /> 
</form>   <center><font color="#990000">Warning: Do not upload twice.</font></center>

  <?php
} else {
	echo '<font color="#990000"> <i>Please Select Result Sheet to upload above and click Get Ready to upload all at a time</i> </font>';
}
?>
 </center> <br /><br />	
 
<?php
	if(isset($_POST['upload'])){
	//process the form here
	if (@$_FILES['csv']['size'] > 0) { 

		//get the csv file 
		$file = $_FILES['csv']['tmp_name']; 
		$handle = fopen($file,"r"); 
		 
		//loop through the csv file and insert into database 
		do {
		
			if (@$data[0]) { 
			// DO WHILE START
		 
			@$cs = $_SESSION['MyCourse'];		
			@$yr = $_SESSION['MyYr'];	
			//@$sem = $_SESSION['MySem'];
			@$extype = $_SESSION['MyType'];	
			@$lev = $_SESSION['MyGrade'];	

			//@$lev = mysql_real_escape_string(trim(addslashes($data[0])));
			// $mystd_ck_yr = mysql_real_escape_string(trim(addslashes($data[1])));// reg no
				$mystd_ck_reg = trim(addslashes($data[0]));// reg no

			//@$regyr = trim($_POST['regyr']);
			@$exam = trim(addslashes($data[2]));
			@$ca1 = trim(addslashes($data[3]));
			@$ca2 = trim(addslashes($data[4]));
			@$notes = (trim(addslashes($data[5]));		


			//$mystd_ck = $mystd_ck_yr.'/'.$mystd_ck_unn;// reg no // not using this right?
			$std_id = $kas_framework->getValue('studentbio_id', 'studentbio', 'studentbio_internalid', $mystd_ck_reg);

			$mytotal = $exam + $ca1 + $ca2;
			$yea=date("d/m/Y");

			if ($std_id != NULL) {
				// check if some result is uploaded
				$mynul = NULL;
				$SQLyog = "SELECT student FROM grade_history_primary WHERE student='$std_id' AND year = '$yr' AND course_code='$cs' AND exam_score != '$mynul' AND exam_type = '1'";
				$dbh_SQLyog = $dbh->prepare($SQLyog); $dbh_SQLyog->execute(); $fetchObj_SQLyog = $dbh_SQLyog->fetch(PDO::FETCH_OBJ); $dbh_SQLyog = null;
				$resultdeydb = $fetchObj_SQLyog->student;

				if($resultdeydb != '' ){
					//do nothing
				} else {
					$queryaddresult= "INSERT INTO grade_history_primary (course_code,year,quarter,level_taken,student,exam_score,ca_score1,ca_score2,exam_type,date,age,notes) values('$cs','$yr','$sem','$lev','$std_id','$exam','$ca1','$ca2', '$extype','$yea','$mytotal', '$notes')";
					$dbh_queryaddresult = $dbh->prepare($queryaddresult); $dbh_queryaddresult->execute(); $dbh_queryaddresult = null;
					// use update not insert?
				}
			}
        } 
    } while ($data = fgetcsv($handle, 1000, ",", "'")); 
    // array fgetcsv ( resource $handle [, int $length = 0 [, string $delimiter = "," [, string $enclosure = '"' [, string $escape = "\\" ]]]] )
	echo' <div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">*</button>
		<strong>Well done!</strong> You successfully uploaded CSV for <b>'.$getcoursename.'</b>. Invalid results, duplicate and results of non registered students  were ignored. To see uploaded results and go to manage results and type the course code in filter.
	</div>';
	//mysql_close();

	} 
}// end form is submitted

?>

 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <p><strong>Tutorial on how to upload CSV
   </strong><br />
   <span style="font-weight: bold">What is CSV?</span> </p>
 <p>CSV is known as <i>commer separated values</i> it is generated by Microsoft Excel with the extension .csv</p>
 the folowing are csv 
 <p><img src="notepadcsv.PNG" alt="notepad" /></p>
 <p style="font-weight: bold">How to Create  CSV manually </p>
 <p>type the values in notepad as seen above, then save as .csv extention, select save as, type the name of the file ending with .csv extentioneg. myresult.csv, select ALL FILES in the <span style="font-weight: bold">save as type</span> field. at the stage, you can open the document with exel and it will look like this</p>
 <p><img src="csv.PNG" /> </p>
 <p>The file above is an example of result four students inserted into exel csv. </p>
 <p>You can also learn how to create excel CSV files <a href="https://www.google.com.ng/search?q=how+to+create+csv+file+with+excel&oq=how+to+create+csv+file+with+excel" target="_blank">here</a> </p>
 <p style="font-weight: bold">How to Put Your Result In CSV ready for web upload in excel: </p>
 <p>if you know how to use the excel in CSV follow the format of the excel above, it is thus you are a hero!:</p>
 <p style="font-style: italic">Reg_number,exam_score,ca1_score,ca2_score,comment</p>
 <p style="font-style: italic"><a href="result.csv" target="_blank">download sample excel csv sheet </a>rightclick on the link and select &quot;save link as&quot;</p>
 <p>so a student whose reg number is 170555BBA and scored 70 in exam, 12 in Test1, 13 in Test2 and the comment is as above, his result in CSV is thus: <span style="font-style: italic">170555BBA,70,12,13,good result today</span></p>
 <p style="font-weight: bold">It follows for the excell:</p>
 <p>A =The actual reg no: (eg. 170555BBA) </p>
 <p>B= Term = 1,2 or 3</p>
 <p>C = Exam Score</p>
 <p>D = CA1 Score (Zero for others like JAMB etc) </p>
 <p>E = CA1 Score (Zero for others like JAMB etc) </p>
 <p>F = Comments</p>
 <p style="font-weight: bold">Conclussion:</p>
 <p>You see there was no provision for Subject, gradecode, term, or exam year, this is thus because you will set them above before uploading. You might want to use these parameter as the name of the csv file you upload    </p>
 <p> 
	  
 </p>
    </div>
  </div>
  <!--/span-->
</div>
<p>&nbsp;</p>