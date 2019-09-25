<?php 
$title="Result Publisher";


if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}

include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";
//include("formkas-framework.php");


if(!isset($_SESSION['UserID']))
  {
    header ("Location: ../../../index.php?action=notauth");
	exit;
}


// if the admin want to open sheet to publish
if(isset($_POST['setsheet'])){
          // incase session were set ealie for the param
	 if(isset($_SESSION['MyCourse'])){  
	  unset($_SESSION['MyCourse']);
	  unset($_SESSION['MyType']);
	  unset($_SESSION['MyYr']);
	  unset($_SESSION['MySem']);
	  unset($_SESSION['MyGrade']);
	}
 
$mycourse = $_POST['cs'];
$mytype = $_POST['extype'];
$myyr = $_POST['yr'];
$mysem = $_POST['sem'];
$mygrade = $_POST['grade'];

 // check if alll the form is filled else, bounce the user action
 if(empty($mycourse) || empty($mytype) || empty($myyr) || empty($mygrade)){
	$form_error = "<font class='alert alert-error'>Out of Idea!: You did not select course, session and/or exam type. try again.</font><br><br>";

 } else {
// set the variables to session
 set_session("MyCourse", $mycourse);
 set_session("MyType", $mytype);
 set_session("MyYr", $myyr);
 set_session("MySem", $mysem);
 set_session("MyGrade", $mygrade);

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

<div align="right" style="margin:0 20px 20px 0">
<a href="results?page=home"><button class="btn btn-small"><i class="icon-star"></i>Edit Results</button>
</a> &nbsp;
 <a href="main?page=uploadcsv"><button class="btn btn-small"><i class="icon-star"></i>Upload from CSV</button>
</a> &nbsp;
<a href="results?page=report_cards"><button class="btn btn-small"><i class="icon-star"></i>Report Cards</button>
</a>
<br />
</div>

	<form action=""  method="post">
		<input name="setsheet" type="hidden" /> 
		Subject
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
		Term
		<select name="sem" style="width:120px">
		  <option value="0">None</option>
		  <?php $kas_framework->getallFieldinDropdownOption('grade_terms', 'grade_terms_desc', 'grade_terms_id') ?>
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

		 <input type="submit" value="Set Sheet" class="btn btn-primary" />
	</form>

	
	
 <center>
	 <?php  if(isset($_SESSION['MyCourse'])){
// gather the deccriptions from db
	  $getcoursename =$kas_framework->getValue('code', 'grade_subjects', 'grade_subject_id', $_SESSION['MyCourse']);
	$getmytype = $kas_framework->getValue('exams_types_desc', 'exams_types', 'exams_types_id', $_SESSION['MyType']);
      $getmyyr = $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $_SESSION['MyYr']);
	$getmysem =$_SESSION['MySem'];
	  echo '<font color="#009966">Publish for: <b>'.$getcoursename.'</b> ('.$getmytype.') Session: '.$getmyyr.', Term: '.$getmysem.'</font> '; 
} else {
	echo '<font color="#990000"> <i>Please Select Result Sheet to publish above and click Set Sheet to upload 10 at a time</i> </font>';
}
?>
 </center>

<?php
if(isset($_POST['publish'])){

 echo '<br>';

for ($i=1; $i<=10; $i++) {
	// were i is the form id

	// get the couse detail from session variables
	$inscs = $_SESSION['MyCourse'];
	$inyr = $_SESSION['MyYr'];
	$instype = $_SESSION['MyType'];
	$inssem = $_SESSION['MySem'];
	$level = $_SESSION['MyGrade'];

	$date = date('d/m/Y');

	// gather from form
	//$regyr = mysql_real_escape_string($_POST['regyr'.$i]);
	$regn = trim($_POST['regn'.$i]);
	$ex = trim($_POST['exam'.$i]);
	$ca1 = trim($_POST['ca1'.$i]);
	$ca2 = trim($_POST['ca2'.$i]);
	$com = trim($_POST['comment'.$i]);

	$std_id = $kas_framework->getValue('studentbio_id', 'studentbio', 'studentbio_internalid', $regn);
	if ($std_id != NULL) { // if the student is in the db
		// check if the result is in the db already

		//$resultdeydb = mysql_query("SELECT student FROM grade_history_primary WHERE student = '$std_id'");
		$mynul = NULL;
		$resultdeydb_SQL = "SELECT student FROM grade_history_primary WHERE student='$std_id' AND year = '$inyr' AND course_code='$inscs' AND exam_score != '$mynul' AND exam_type = '1'";
			$dbh_resultdeydb = $dbh->prepare($resultdeydb_SQL); $dbh_resultdeydb->execute(); $fetchObj = $dbh_resultdeydb->fetch(PDO::FETCH_OBJ); 
			$resultdeydb = $fetchObj->student;
		//$resultdeydb = mysql_query("SELECT student FROM grade_history_primary WHERE student = '$std_id' AND year = '$inyr' AND course_code='$inscs' AND exam_score != NULL AND exam_type <= 2");

		if($resultdeydb != NULL ){
				echo "<font class='alert alert-error'>[$i]Error: Result with the same parameter already exist in database</font><br><br>";
		} else {
			$insert_into_result = "INSERT INTO grade_history_primary (id,year,quarter,exam_type,course_code,aprove,date,exam_score,ca_score1,ca_score2,level_taken,notes,student) VALUES(NULL,'$inyr','$inssem','$instype','$inscs', '0', '$date', '$ex', '$ca1', '$ca2', '$level', '$com', '$std_id')";
				$dbh_insert_into_result = $dbh->prepare($insert_into_result); $checkExec = $dbh_insert_into_result->execute();  
				
				if($checkExec){
					echo "<font class='alert alert-success'>[$i]Success: published for $regn</font><br><br>";
				}else{
					echo "<font class='alert alert-error'>[$i]Error: there was trouble publishing for $regn</font><br><br>";
				}
		// end result exist here
		}// end result exist
	} else { // the student is not registerd
	echo "<font class='alert alert-warning'>[$i]Error: Student with reg number: $regn was not found in database, student did not register</font><br><br>";

	}// end the student is not registerd

	}// looping ends
	$dbh_resultdeydb = null;
	$dbh_insert_into_result = null;
}

?>
  <form action=""  method="post">
<input name="publish" type="hidden" /> 
 <?php  if(isset($_SESSION['MyCourse'])){
	 // only when admin have selectecd course to publish that we display the table
?>
 <table class="table table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th width="2%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="12%"><a href="#" title="Active means student can log in">(Class) <font color="#990000"> *</font></a></th>
            <th width="24%">Reg: No<font color="#990000"> *</font><a href="main?page=users" title="Open student in new window to see there reg no" target="_blank"> what is this?</a> </th>
            <th width="19%">Exam<font color="#990000"> *</font></th>
            <th width="19%">CA<font color="#990000"> *</font></th>
            <th width="24%">Comment</th>
          </tr>
        </thead>
        <tbody>
         
		<?php for ($ii=1; $ii<=10; $ii++) { ?>
		  <tr>
			<td><?php echo $ii?></td>
            <td class="center">   
		<?php echo $myowngrade =$kas_framework->getValue('grades_desc', 'grades', 'grades_id', $_SESSION['MyGrade']); ?>

       </td>
            <td class="center"><input type="text" name="regn<?php echo $ii?>" id="unn" placeholder="" width="40" style="font-size:18px; width:140px"  /></td>
            <td class="center"><input type="number" name="exam<?php echo $ii?>" id="exam" placeholder="Ex" width="80" style="font-size:18px; width:40px"  /></td>
            <td class="center">1st<input type="number" name="ca1<?php echo $ii?>" id="ca1" placeholder="CA" width="80" style="font-size:18px; width:40px"  />
			2nd<input type="number" name="ca2<?php echo $ii?>" id="ca2" placeholder="CA" width="80" style="font-size:18px; width:40px"  />
			</td>
            <td class="center"><input type="text" name="comment<?php echo $ii?>" id="comm" placeholder="comment" width="80" style="font-size:18px"  /></td>
          </tr>
		  
		  <?php }// stop looping the table row ?>
		   <tr>
		   
		     <td>&nbsp;</td>
		     <td class="center">&nbsp;</td>
		     <td class="center"><?php echo @$getcoursename;?> </td>
		     <td class="center"><?php echo @$getmyyr;?></td>
		     <td class="center">correct errors before publish </td>
		     <td class="center"><input type="submit" value="Publish Valid Ones" class="btn btn-primary" /></td>
	        </tr>
        </tbody>
      </table> <i> To Edit published results click on Edit Result above</i><?php }?>
	  </form>
	  
	  
	  
    </div>
  </div>
  <!--/span-->
</div>
<p>&nbsp;</p>
 