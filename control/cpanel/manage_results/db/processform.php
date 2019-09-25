<script>
function goBack() {
    window.history.back()
}
</script>

<?php
 	//Include global functions
include_once "../../../includes/common.php";
//Initiate special database functions
include_once "../../../includes/true_mysql.php";
//Use common ez_sql stuff too
include_once "../../../includes/ez_sql.php";
// config
include_once "../../../includes/configuration.php";

  session_start();
if(!isset($_SESSION['UserID']))
  {
    header ("Location: ../../../index.php?action=notauth");
	exit;
}

   
//require_once('config.php'); 

$sql=mysql_connect($db_server,$db_user,$db_password);
$select=mysql_select_db($db_name,$sql);

function query($query){
	$que=mysql_query($query)or die(mysql_error());
	return $que;
}


//@$con=mysqli_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);
          
@$cs = trim($_POST['cs']);		
@$yr = trim($_POST['yr']);		
@$sem = trim($_POST['sem']);// term/quarter		
@$lev = trim($_POST['lev']);		
//@$regyr = trim($_POST['regyr']);
@$exam = trim($_POST['exam']);
@$ca = trim($_POST['ca']);		
@$regno = trim($_POST['regno']);
@$extype = trim($_POST['extype']);

$date = new DateTime();
 $yea=$date->format('Y-m-d H:i:s');
$yea=date("y-m-d");
$mystd_ck = $regno;
$stpre = '<div align="center" style="width: 692; height: 73; background-color:#CCCCCC; color:red; border-radius:15px; margin-left:10; margin-right:10;"><strong>';
$stpro = '</strong><br><button onclick="goBack()">Go Back</button></div>';		
// check if the form is complet		
if(empty($cs) || empty($yr) || empty($lev) || empty($extype)){
		echo $stpre."Something is not right: data provided is not enough to add student to any result sheet"." for reg: ".$mystd_ck." ".$stpro; exit;
		}		
// check if the student is valid
$check=query("SELECT studentbio_internalid FROM studentbio WHERE admin='1' AND studentbio_internalid='$mystd_ck'");

if(!mysql_num_rows($check)>=1){
 echo $stpre."Something is not right: this student is not registered or admitted yet"." for reg: ".$mystd_ck." ".$stpro; exit;
}	
		

$cryear=$_SESSION['CurrentYear'];
$myid=$db->get_var("SELECT studentbio_id FROM studentbio WHERE studentbio_internalid=$mystd_ck");
		
		
// check that the student year of study selected is right
// bring the student year of study from student grade year and make sure its not
$checkyr_study = query("SELECT student_grade_year_grade FROM student_grade_year WHERE student_grade_year_student='$myid' AND student_grade_year_year='$cryear'");

while ($rows = mysql_fetch_array($checkyr_study, MYSQL_ASSOC)) {
	if($rows["student_grade_year_grade"] < $lev){
	
	echo $stpre."This student is in a lower class than you want to publish his result. That will not be possible. If you think this is in error, then admin has not promoted this student, ask admin to promote student before you publish such result. hope this info will be helpful. regards" ." for reg: ".$mystd_ck." ".$stpro; exit;
	}
}

// we need to check if the student is already in this result sheet?
// if these exist, course,type,yr,level,student where student = student id

// bring out
// while 
//select

// now, bring the student id from db
$check_sheet_added=query("SELECT studentbio_id,studentbio_lname FROM studentbio WHERE studentbio_internalid='$mystd_ck'");
// check is the student result is already created

while ($existing = mysql_fetch_array($check_sheet_added, MYSQL_ASSOC)) {
$std_id = $existing["studentbio_id"];
$std_name = $existing["studentbio_lname"];// useless
//put all our form variable in an array: this may not

//$a = array($std_id, $cs, $lev, $yr, $extype);// this may not be useful: asume all as form variables

$check_sh_sheet_avail = query("SELECT course_code,exam_type,year,level_taken,student,quarter,exam_score,ca_score FROM grade_history_primary WHERE student='$std_id'");
// we have selected the table, how do we check if all is set
// if all this variable coming out are all === form variables, echo error, else submit form

// using while inside while loop, Ben idiot
while ($lastjob = mysql_fetch_array($check_sh_sheet_avail, MYSQL_ASSOC)) {
$std_id_id = $lastjob["student"];
$std_id_lv = $lastjob["level_taken"];
$std_id_yr = $lastjob["year"];
$std_id_ex = $lastjob["exam_type"];
$std_id_cs = $lastjob["course_code"];
$std_id_sem = $lastjob["quarter"];
$std_id_ex_sc = $lastjob["exam_score"];
$std_id_ca_sc = $lastjob["ca_score"];

// here we check if the course is registered

if($std_id_lv==$lev && $std_id_yr==$yr && $std_id_cs==$cs && $std_id_ex==$extype && $std_id_ex_sc==NULL && $std_id_ca_sc==NULL){

//if($std_id_id==$std_id && $std_id_lv==0 && $std_id_yr==NULL && $std_id_cs==$cs && $std_id_ex==0 && $std_id_sem == 0){

echo $stpre."Something is not right: this type of result cannot be added from here, read the manual. This one should be added by loading result sheets"." for reg: ".$mystd_ck." ".$stpro; exit;

}

// check if there are the same
if($std_id_id==$std_id && $std_id_lv==$lev && $std_id_yr==$yr && $std_id_cs==$cs && $std_id_ex==$extype && $std_id_ex_sc==$exam){

//echo "number row: ".mysql_num_rows($check_sh_sheet_avail);
echo $stpre."Something is not right: it seems like the result with exact detail was inserted before; you cant insert again, you either have to change the exam type or session."." for reg: ".$mystd_ck." ".$stpro; exit;
// so we can also use this detail to check if the student have registered the course;
// let them use grid, not this form if the student have registerd it
//year=NULL, semester = 0, course_code = $cs, exam_score = ca_score = null, level_taken=null, aprove = 0,exam_type=0; 
}


// NEW JOB START
//we want to check if they are not publishing the same result twice changing the year, if year change it should be carry over
if($std_id_id==$std_id && $std_id_lv==$lev && $std_id_yr!=$yr && $std_id_cs==$cs && $extype == 1){// this is normal Examination

echo $stpre."Something is not right: this result was published in other grade, why publish in this grade again  if the student is not repeating or retaking exam. if student is repeating, choose exam type repeat for reg: ".$mystd_ck." ".$stpro; exit;

} 


}


// before we process the form
//echo"year:".$std_id_yr." name:".$std_name;

/*

// Check level that can take the course
$check_coure_levels = query("SELECT level FROM grade_subjects WHERE grade_subject_id='$cs'");
// we dont want to allow final year cause to be published for first year student
while ($rows_lev = mysql_fetch_array($check_coure_levels, MYSQL_ASSOC)) {
	if($rows_lev["level"] > $lev){
	
	echo $stpre."This course is meant for ".$rows_lev["level"]."00 level, and thus can not be published for a ".$lev."00 level student. If you think this is in error, I think you choose wrong student year of study or the student is not promoted by admin yet. hope this info will be helpful. regards"." for reg: ".$unn." ".$stpro; exit;
	}
}
/// end checking level here
// WE NEED TO SEE IF THE COURSE IS ALREADY REGISTEERD, THEN WE UPDATE ELSE INSERT
*/

//Process the form
// this is awaiting trial

$queryaddresult=query("insert into grade_history_primary (course_code,year,quarter,level_taken,student,exam_score,ca_score,exam_type,std_name,date) values('$cs','$yr','$sem','$lev','$std_id','$exam','$ca','$extype','$std_id','$yea')");
// use update not insert?





if($queryaddresult){
echo '<div align="center" style="width: 692; height: 73; background-color:#F4F4F4; color:#00FF99; border-radius:15px; margin-left:10; margin-right:10;"><strong><font size="+3">Good Job; Result Succesfully added</font></strong><br> click on Ad Single above to add more</div>';
}else{echo $stpre."There must be trouble with the Database --".mysql_error()." please consult the developer".$stpre;}
// end of awaiting trial



}// std_id disappears here


	

mysql_close();



?>
     