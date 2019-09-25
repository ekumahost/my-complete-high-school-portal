<?php  

echo 'Not allowed'; exit;
 	//Include global functions
include_once "../../../includes/common.php";
//Initiate special database functions
include_once "../../../includes/true_mysql.php";
//Use common ez_sql stuff too
include_once "../../../includes/ez_sql.php";
// config
//include_once "../../../includes/configuration.php";

  session_start();
if(!isset($_SESSION['UserID']))
  {
    header ("Location: ../../../index.php?action=notauth");
	exit;
}



//include_once "../../../includes/configuration.php";

include('config.php');
//connect to the database 
$sql=mysql_connect($db_server,$db_user,$db_password);
$select=mysql_select_db($db_name,$sql);

function query($query){
	$que=mysql_query($query)or die(mysql_error());
	return $que;
}




if (@$_FILES['csv']['size'] > 0) { 

    //get the csv file 
    $file = $_FILES['csv']['tmp_name']; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
    do { 
        if (@$data[0]) { 
		// DO WHILE START
//@$cs = mysql_real_escape_string(trim(addslashes($data[0])));		
	//echo $cs.'<br>';	
	

   
@$cs = mysql_real_escape_string(trim(addslashes($data[0])));		
@$yr = mysql_real_escape_string(trim(addslashes($data[2])));		
@$sem = mysql_real_escape_string(trim(addslashes($data[3])));	
@$lev = mysql_real_escape_string(trim(addslashes($data[4])));	
//@$regyr = trim($_POST['regyr']);
@$exam = $mystd_ck = mysql_real_escape_string(trim(addslashes($data[6])));
@$ca = $mystd_ck = mysql_real_escape_string(trim(addslashes($data[7])));		
//@$unn = trim($_POST['unn']);
@$extype = mysql_real_escape_string(trim(addslashes($data[1])));
$mystd_ck = mysql_real_escape_string(trim(addslashes($data[5])));// reg no
$std_id = $db->get_var("SELECT studentbio_id FROM studentbio WHERE studentbio_internalid='$mystd_ck'");

$mytotal = $exam+$ca;
$date = new DateTime();
 $yea=$date->format('Y-m-d H:i:s');
$yea=date("y-m-d");
$stpre = '<div align="center" style="width: 692; height: 73; background-color:#CCCCCC; color:red; border-radius:15px; margin-left:10; margin-right:10;"><strong>';
$stpro = '</strong><br>Remember to fix this, upload later</div>';		
// check if the form is complete

		
if(empty($cs) || empty($yr) || empty($lev) || empty($mystd_ck) || empty($sem) || empty($extype)){
		echo $stpre."Something is not right: data provided is not enough to add student to any result sheet"." for reg: ".$mystd_ck." ".$stpro;
		}		
if(empty($std_id)){
echo 'student not exist';
}
		

$queryaddresult=query("insert into grade_history_primary (course_code,year,semester,level_taken,student,exam_score,ca_score,exam_type,std_name,date,age) values('$cs','$yr','$sem','$lev','$std_id','$exam','$ca','$extype','$std_id','$yea','$mytotal')");
// use update not insert?

if($queryaddresult){
echo '<div align="center" style="width: 692; height: 35; background-color:#F4F4F4; color:#00FF99; border-radius:15px; margin-left:10; margin-right:10;"><strong><font size="3">Success for '.$mystd_ck.' </font></strong><br> </div>';
}else{echo $stpre."There must be trouble with the Database --".mysql_error()." please consult the developer for ".$mystd_ck." ".$stpre.'<br>';}

	
	
			
		/// DO WHILE  ENDS
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // array fgetcsv ( resource $handle [, int $length = 0 [, string $delimiter = "," [, string $enclosure = '"' [, string $escape = "\\" ]]]] )
	
	echo 'Processing completed.';

	mysql_close();
	
    //redirect 
  //  header('Location: import.php?success=1'); die; 

} 

?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>Import a CSV File of the result</title>
</head> 

<body> 

<?php //if (!empty($_GET['success'])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> 

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  Choose your file: CSV(comma separated values)<br /> 
  <input name="csv" type="file" id="csv" />
  max1000 results  
  <input type="submit" name="Submit" value="Upload" /> 
</form> 

<p><em>Make sure this result sheet is created before uploading </em></p>
<p>Sample result for chem 101 of student with reg no 170555 who got 65 in exam, 24 in ca, for the year 2005/2006 in first semester</p>
<p>28,1,1,1,1,170555,65,24</p>
<p>so the last 24 you see is his ca score</p>
<p>28 is the chem 101 course code serial </p>
<p>170555 is the reg number</p>
<p>so before you import any result, you must know how to create csv files and also know the course code     serial for every course on this portal </p>
</body> 
</html> 