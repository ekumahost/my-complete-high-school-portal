<?php

function CountAllActiveStudents() {
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('web_students', 'status', '1');
}

function CountRegPin(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countAll('reg_pins');
}
function CountWalletPin(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countAll('student_wallet_pins');
}

function CountAllStudents(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('studentbio', 'admit', '1');
}

// version 2 
function CountAllStudentsProspective(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('studentbio', 'admit', '0');
}


function CountAlltransferedOutStudents(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('studentbio', 'admit', '5');
}

function CountAllTeachers(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countAll('staff');
}

function CountAllActiveTeachers(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict2('web_users', 'web_users_type', 'T', 'web_users_active', '1');
}

function CountAllParents(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('web_users', 'web_users_type', 'C');
}

function CountNonTeachingStaff(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('web_users', 'web_users_type', 'S');
}
function CountNYSC(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('web_users', 'web_users_type', 'Ty');
}

function CountPractiseteacher(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('web_users', 'web_users_type', 'Tp');
}

function Countadmins(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('web_users', 'web_users_type', 'B');
}

function Countlessonteacher(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('web_users', 'web_users_type', 'Tl');
}

function CountStaff(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countAll('staff');
}

function SumUpFeecount(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countAll('payment_receipts');
}

function CountActiveNonTeachingStaff(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict2('web_users', 'web_users_type', 'S', 'web_users_active', '1');
}

function CountAlMessagesD(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('tbl_portal_emails', 'sender_type', 'D');
}
function CountAllMessages(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countAll('tbl_portal_emails');
}

function CountAllUnreadMessages(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('tbl_portal_emails', 'status', '0');
}
function CountAlMessagesA(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('tbl_portal_emails', 'sender_type', 'A');
}

function CountAlMessagesB(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('tbl_portal_emails', 'sender_type', 'B');
}

function CountAlMessagesC(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('tbl_portal_emails', 'sender_type', 'C');
}

function CountExpelled(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('studentbio', 'admit', '4');
}
function Countsuspend(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('studentbio', 'admit', '3');
}

function Countwithdraw(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('studentbio', 'admit', '6');
}

function CountDeceased(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('studentbio', 'admit', '7');
}

function CountAllGraduateStudents(){
	$kas_framework = new kas_framework;
	echo $kas_framework->countRestrict1('studentbio', 'admit', '2');
}

//file checker
$inc_pdo = (file_exists("../../../php.files/classes/pdoDB.php"))? "../../../php.files/classes/pdoDB.php" : "../../php.files/classes/pdoDB.php";

function SumUpFee(){
	global $inc_pdo;
	require ($inc_pdo);
$feesum= "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts ";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	echo number_format($vars->mytotal);
	$dbh_feesum = null;
}

function CountAllInActiveStudents(){
	global $inc_pdo;
	require ($inc_pdo);
	$query= "SELECT COUNT(*) AS cnt from web_students where status !='1' ";
	$dbh_query = $dbh->prepare($query); $dbh_query->execute();
	$cntVar = $dbh_query->fetch(PDO::FETCH_OBJ);
	echo $cntVar->cnt;
} 


function CountAllInActiveTeachers(){
	global $inc_pdo;
	require ($inc_pdo);
	$query= "SELECT COUNT(*) AS cnt from web_users where web_users_type='T' and web_users_active != '1'";
	$dbh_query = $dbh->prepare($query); $dbh_query->execute();
	$cntVar = $dbh_query->fetch(PDO::FETCH_OBJ);
	echo $cntVar->cnt;
}


function CountInactiveNonTeachingStaff(){
	global $inc_pdo;
	require ($inc_pdo);
	$query= "SELECT COUNT(*) AS cnt from web_users where web_users_type='S' and web_users_active !='1' ";
	$dbh_query = $dbh->prepare($query); $dbh_query->execute();
	$cntVar = $dbh_query->fetch(PDO::FETCH_OBJ);
	echo $cntVar->cnt;
}

function GetStudentTermAverage($current_year,$cardterm,$tbl_student){
	$kas_framework = new kas_framework;
	global $inc_pdo;
	require ($inc_pdo);
	$examsum= "SELECT SUM(exam_score) as exam_total from grade_history_primary WHERE year = '$current_year' AND quarter ='$cardterm' AND student = '$tbl_student'";
	$ca1sum= "SELECT SUM(ca_score1) as ca1_total from grade_history_primary WHERE year = '$current_year' AND quarter ='$cardterm' AND student = '$tbl_student'";
	$ca2sum= "SELECT SUM(ca_score2) as ca2_total from grade_history_primary WHERE year = '$current_year' AND quarter ='$cardterm' AND student = '$tbl_student'";
		
	$dbh_examsum = $dbh->prepare($examsum);$dbh_ca1sum = $dbh->prepare($ca1sum);$dbh_ca2sum = $dbh->prepare($ca2sum);
	$dbh_examsum->execute(); $dbh_ca1sum->execute(); $dbh_ca2sum->execute(); 
	$row_exam = $dbh_examsum->fetch(PDO::FETCH_OBJ);$row_ca1 = $dbh_ca1sum->fetch(PDO::FETCH_OBJ);$row_ca2 = $dbh_ca2sum->fetch(PDO::FETCH_OBJ);

	$sum_exam = $row_exam->exam_total;
	$sum_ca1 = $row_ca1->ca1_total;
	$sum_ca2 = $row_ca2->ca2_total;

	$total_exp= $kas_framework->countRestrict3('grade_history_primary', 'year', $current_year, 'quarter', $cardterm, 'student', $tbl_student);
	@$total_average = $total_exp.'00'; // atach zeros to the number to make it 100

	@$exam_ca_total = $sum_exam + $sum_ca1 + $sum_ca2;	
	// the average is total score/total_exp x 100%		
	 @$answer = (@$exam_ca_total / @$total_average)*100;
	 if($total_exp == 0){
		@$answer = '<i><font color="red">No Results Published this term</font><i> _0';
	 }
	 // please to two decimal places
	 echo @round($answer, 2).'%';
	// echo $total_exp;
		$dbh_examsum = null; $row_ca1 = null; $row_ca2 = null; $dbh_count_exp_score = null;
}

function SumUpSchoolFee(){
	global $inc_pdo;
	require ($inc_pdo);
$feesum= "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type = '1'";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	echo number_format($vars->mytotal);
	$dbh_feesum = null;
}

function SumUpunifromFee(){
	global $inc_pdo;
	require ($inc_pdo);
$feesum= "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type = '5'";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	echo number_format($vars->mytotal);
	$dbh_feesum = null;
}

function SumUpshoesFee(){
	global $inc_pdo;
	require ($inc_pdo);
$feesum= "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type = '6'";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	echo number_format($vars->mytotal);
	$dbh_feesum = null;
}

function SumUpbookFee(){
	global $inc_pdo;
	require ($inc_pdo);
$feesum= "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type='3'";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	echo number_format($vars->mytotal);
	$dbh_feesum = null;
}

function SumUpmealFee(){
	global $inc_pdo;
	require ($inc_pdo);
$feesum= "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type = '4'";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	echo number_format($vars->mytotal);
	$dbh_feesum = null;
}

function SumUpmedicationFee(){
	global $inc_pdo;
	require ($inc_pdo);
$feesum= "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type = '7'";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	echo number_format($vars->mytotal);
	$dbh_feesum = null;
}

function SumUpotherFee(){
	global $inc_pdo;
	require ($inc_pdo);
$feesum=  "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type > '7'";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	echo number_format($vars->mytotal);
	$dbh_feesum = null;
}

function SumUpHostelFee(){
	global $inc_pdo;
	require ($inc_pdo);
	$feesum = "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type='2'";
	$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	echo number_format($vars->mytotal);
	$dbh_feesum = null;
}


// 0=not admited, 1=admited, 2= Graduate, 3= suspended, 4= expelled, 5= transferd, 6 = withdrwn, 7 = deceased



function GeneratePin(){
	global $inc_pdo;
	require ($inc_pdo);
$teach = "SELECT * from staff ";
$nonteach = "SELECT * from web_users where web_users_type='S' ";
$dbh_teach = $dbh->prepare($teach); $dbh_teach->execute();
$dbh_nonteach = $dbh->prepare($nonteach); $dbh_nonteach->execute(); 
$dbh_nonteach = null; $dbh_teach = null;
//$amt= '5';
}

function FormatDateKelvin($dbdate){
	// not used yet
	// create the kelvin date format 
	// pick his in db and convert to html5 fomat
	echo $datefht5 = substr($dbdate, -4).'-'.substr($dbdate, -7, 2).'-'.substr($dbdate, 0, 2);
	// refomat back before adding to db
	$postnamedob = substr($postnamedob, -2).'/'.substr($postnamedob, -5, 2).'/'.substr($postnamedob, 0, 4);
}

function AsignHostelSpace(){
	// asign hostel space to the student
	// req variables
	// current session/yterm, student, student balance, sex, grade
	// check if hostel bed space exists // from hostels_bed_space
}

?>