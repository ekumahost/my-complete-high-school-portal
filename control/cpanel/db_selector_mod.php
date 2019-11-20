<?php

define ('CountAllActiveStudents', $kas_framework->countRestrict1('web_students', 'status', '1'));
define ('CountRegPin', $kas_framework->countAll('reg_pins'));
define ('CountWalletPin', $kas_framework->countAll('student_wallet_pins'));
define ('CountAllStudents', $kas_framework->countRestrict1('studentbio', 'admit', '1'));
define ('CountAllStudentsProspective', $kas_framework->countRestrict1('studentbio', 'admit', '0'));
define ('CountAlltransferedOutStudents', $kas_framework->countRestrict1('studentbio', 'admit', '5'));
define ('CountAllTeachers', $kas_framework->countAll('staff'));
define ('CountAllActiveTeachers', $kas_framework->countRestrict2('web_users', 'web_users_type', 'T', 'web_users_active', '1'));
define ('SumUpFeecount', $kas_framework->countAll('payment_receipts'));
define ('CountExpelled', $kas_framework->countRestrict1('studentbio', 'admit', '4'));
define ('Countsuspend', $kas_framework->countRestrict1('studentbio', 'admit', '3'));
define ('Countwithdraw', $kas_framework->countRestrict1('studentbio', 'admit', '6'));
define ('CountDeceased', $kas_framework->countRestrict1('studentbio', 'admit', '7'));
define ('CountAllParents', $kas_framework->countRestrict1('web_users', 'web_users_type', 'C'));
define ('CountNonTeachingStaff', $kas_framework->countRestrict1('web_users', 'web_users_type', 'S'));
define ('CountActiveNonTeachingStaff', $kas_framework->countRestrict2('web_users', 'web_users_type', 'S', 'web_users_active', '1'));
define ('CountNYSC', $kas_framework->countRestrict1('web_users', 'web_users_type', 'Ty'));
define ('CountPractiseteacher', $kas_framework->countRestrict1('web_users', 'web_users_type', 'Tp'));
define ('Countadmins', $kas_framework->countRestrict1('web_users', 'web_users_type', 'B'));
define ('Countlessonteacher', $kas_framework->countRestrict1('web_users', 'web_users_type', 'Tl'));
define ('CountStaff', $kas_framework->countAll('staff'));
define ('CountAllMessages', $kas_framework->countAll('tbl_portal_emails'));
define ('CountAllUnreadMessages', $kas_framework->countRestrict1('tbl_portal_emails', 'status', '0'));
define ('CountAlMessagesA', $kas_framework->countRestrict1('tbl_portal_emails', 'sender_type', 'A'));
define ('CountAlMessagesB', $kas_framework->countRestrict1('tbl_portal_emails', 'sender_type', 'B'));
define ('CountAlMessagesC', $kas_framework->countRestrict1('tbl_portal_emails', 'sender_type', 'C'));
define ('CountAlMessagesD', $kas_framework->countRestrict1('tbl_portal_emails', 'sender_type', 'D'));
define ('CountAllGraduateStudents', $kas_framework->countRestrict1('studentbio', 'admit', '2'));

$query= "SELECT COUNT(*) AS cnt from web_students where status !='1' ";
	$dbh_query = $dbh->prepare($query); $dbh_query->execute();
	$cntVar = $dbh_query->fetch(PDO::FETCH_OBJ);
	$CountAllInActiveStudents =  $cntVar->cnt;
define ('CountAllInActiveStudents', $CountAllInActiveStudents);

$query= "SELECT COUNT(*) AS cnt from web_users where web_users_type='T' and web_users_active !='1'";
	$dbh_query = $dbh->prepare($query); $dbh_query->execute();
	$cntVar = $dbh_query->fetch(PDO::FETCH_OBJ);
	$CountAllInActiveTeachers = $cntVar->cnt;
define ('CountAllInActiveTeachers', $CountAllInActiveTeachers);

$query= "SELECT COUNT(*) AS cnt from web_users where web_users_type='S' and web_users_active !='1' ";
	$dbh_query = $dbh->prepare($query); $dbh_query->execute();
	$cntVar = $dbh_query->fetch(PDO::FETCH_OBJ);
	$CountInactiveNonTeachingStaff = $cntVar->cnt;
define ('CountInactiveNonTeachingStaff', $CountInactiveNonTeachingStaff);

$feesum= "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts ";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	$SumUpFee =  number_format($vars->mytotal);
	$dbh_feesum = null;
define ('SumUpFee', $SumUpFee);


$feesum= "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type = '1'";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	$SumUpSchoolFee = number_format($vars->mytotal);
	$dbh_feesum = null;
define ('SumUpSchoolFee', $SumUpSchoolFee);

$feesum= "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type = '5'";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	$SumUpunifromFee = number_format($vars->mytotal);
	$dbh_feesum = null;
define ('SumUpunifromFee', $SumUpunifromFee);

$feesum= "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type = '6'";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	$SumUpshoesFee = number_format($vars->mytotal);
	$dbh_feesum = null;
define ('SumUpshoesFee', $SumUpshoesFee);

$feesum= "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type='3'";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	$SumUpbookFee = number_format($vars->mytotal);
	$dbh_feesum = null;
define ('SumUpbookFee', $SumUpbookFee);

$feesum= "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type = '4'";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	$SumUpmealFee = number_format($vars->mytotal);
	$dbh_feesum = null;
define ('SumUpmealFee', $SumUpmealFee);


$feesum= "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type = '7'";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	$SumUpmedicationFee = number_format($vars->mytotal);
	$dbh_feesum = null;
define ('SumUpmedicationFee', $SumUpmedicationFee);

$feesum=  "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type > '7'";
$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	$SumUpotherFee = number_format($vars->mytotal);
	$dbh_feesum = null;
define ('SumUpotherFee', $SumUpotherFee);

$feesum = "SELECT SUM(tution_amount_paid) as mytotal from payment_receipts WHERE tution_paid_type='2'";
	$dbh_feesum = $dbh->prepare($feesum);
	$dbh_feesum->execute();
	$vars = $dbh_feesum->fetch(PDO::FETCH_OBJ);
	$SumUpHostelFee = number_format($vars->mytotal);
	$dbh_feesum = null;
define ('SumUpHostelFee', $SumUpHostelFee);


function GeneratePin(){
global $dbh;
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
	global $postnamedob;
	// pick his in db and convert to html5 fomat
	echo $datefht5 = substr($dbdate, -4).'-'.substr($dbdate, -7, 2).'-'.substr($dbdate, 0, 2);
	// refomat back before adding to db
	$postnamedob = substr($postnamedob, -2).'/'.substr($postnamedob, -5, 2).'/'.substr($postnamedob, 0, 4);
}

// 0=not admited, 1=admited, 2= Graduate, 3= suspended, 4= expelled, 5= transferd, 6 = withdrwn, 7 = deceased

	/* if your student grade year year is greater than all gades number, then you are a graduate
	$grades=query("SELECT * from grades ");
	$countit = mysql_num_rows($grades);
	$grade_year=query("SELECT * from student_grade_year where student_grade_year_grade >'$countit' ");
	echo mysql_num_rows($grade_year);
	*/

function GetStudentTermAverage($current_year,$cardterm,$tbl_student){
	global $dbh, $kas_framework;
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

function AsignHostelSpace(){
	// asign hostel space to the student
	// req variables
	// current session/yterm, student, student balance, sex, grade
	// check if hostel bed space exists // from hostels_bed_space
}

?>