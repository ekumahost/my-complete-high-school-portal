<script>
function goBack() {
    window.history.back()
}
</script>


<?php
exit;
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
@$sem = trim($_POST['sem']);		
@$lev = trim($_POST['lev']);		
@$exam = trim($_POST['extype']);		

$date = new DateTime();
 $yea=$date->format('Y-m-d H:i:s');
$yea=date("y-m-d");
$stpre = '<div align="center" style="width: 692; height: 73; background-color:#CCCCCC; color:red; border-radius:15px; margin-left:10; margin-right:10;"><strong>';
$stpro = '</strong><br><button onclick="goBack()">Go Back</button></div>';		

//validate entry
// check if the level can take the course: is the course level > student level selected
// check if the sheet was created before at least 50* wih year,course,type and selexted level then it was created
// insert all retrieved student here: we can bring them out, count them and put them i a form then click submit


// check if the form is complete		
if(empty($cs) || empty($yr) || empty($sem) || empty($lev) || empty($exam)){
		echo $stpre."Something is not right: data provided is not enough to create a result sheet".$stpro; exit;
		}		
		
// LETS CHECK THE COURSE TYPE, RESULT SHEET SHOULD NOT BE CREATED FOR CARRY OVER COURSES

if($exam > 2){
	echo $stpre."Something is not right: result Sheet cannot be created for carry Over and resit, such results are added singly. this is because the whole class do not have carry over/resit ".$stpro; exit;


}
		
// check if the selected semester is right		
$checksem = query("SELECT semester,code FROM grade_subjects WHERE grade_subject_id='$cs'");
// check if the semester is set for the course
if(mysql_num_rows($checksem)==0){
 echo $stpre."Something is not right: the database configuration for this selected course is invalid, you must correct this configuration first".$stpro; exit;
}	
// check if the semester is correct for that course
	while ($row = mysql_fetch_array($checksem, MYSQL_ASSOC)) {
	if($row["semester"] != $sem){
	
	echo $stpre.$row["code"]." is not a semester ".$sem." course. if it is, you have to change the course configuration first".$stpro; exit;
	}
		
}// end while

// lets see if the level can take the course
$checkyr_study = query("SELECT level FROM grade_subjects WHERE grade_subject_id='$cs'");

while ($rows = mysql_fetch_array($checkyr_study, MYSQL_ASSOC)) {
	if($rows["level"] > $lev){
	
	echo $stpre."This course is for  ".$rows["level"]."00 level. ".$lev."00 level student cannot have results here when they are not promoted yet. If you think this is in error, then admin has not promoted this student, ask admin to promote student before you publish such. regards".$stpro; exit;
	}
}

// LETS SEE IF THE RSULT SHEET WAS CREATED BEFORE

$check_sh_sheet_avail = query("SELECT course_code,exam_type,year,level_taken,student,semester FROM grade_history_primary WHERE course_code='$cs' AND exam_type = '$exam'");
// we have selected the table, how do we check if all is set
// if all this variable coming out are all === form variables, echo error, else submit form

// using while inside while loop, Ben idiot
while ($lastjob = mysql_fetch_array($check_sh_sheet_avail, MYSQL_ASSOC)) {
$std_id_id = $lastjob["student"];
$std_id_lv = $lastjob["level_taken"];
$std_id_yr = $lastjob["year"];
$std_id_ex = $lastjob["exam_type"];
$std_id_cs = $lastjob["course_code"];
$std_id_sem = $lastjob["semester"];

// check if there are the same
if($std_id_lv==$lev && $std_id_yr==$yr && $std_id_cs==$cs && $std_id_ex==$exam){

//echo "number row: ".mysql_num_rows($check_sh_sheet_avail);
echo $stpre."Something is not right: it seems like this result sheet was created before, try load it and publish result".$stpro; exit;
}

//NEW JOB ENDS


}



// select student that result sheet will be created for
$checky_std_in = query("SELECT studentbio_id FROM studentbio WHERE std_yr_of_study='$lev'");

while ($al = mysql_fetch_array($checky_std_in, MYSQL_ASSOC)) {


/// lets insert into result table for the course detail and student
$my_stdbio_id = $al["studentbio_id"];
//echo $al["studentbio_id"].'<br>';
$queryaddresult=query("insert into grade_history_primary (course_code,year,semester,level_taken,student,exam_type,std_name) values('$cs','$yr','$sem','$lev','$my_stdbio_id','$exam','$my_stdbio_id')");
// use update not insert?


}

echo "Job completed for ".mysql_num_rows($checky_std_in)." Student(s)";
if($queryaddresult){
echo '<div align="center" style="width: 692; height: 73; background-color:#F4F4F4; color:#00FF99; border-radius:15px; margin-left:10; margin-right:10;"><strong><font size="+3">Good Job; Result Succesfully added</font></strong><br> click on Ad Single above to add more</div>';
}else{echo $stpre."There must be trouble with the Database --".mysql_error()." please consult the developer".$stpre;}
// end of awaiting trial



mysql_close();


?>
     