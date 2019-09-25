<?php


/*
function queryme($queryme){
	$que=mysql_query($queryme)or die(mysql_error());
	return $que;
} */

// FIRST
// lets warn if students cant log in
@$std_can = $kas_framework->getValue('status', 'tbl_app_config', 'module', 'student_login');
if($std_can != 1){
	$myp->AlertInfo('Notice! ', 'Students portal is locked, Please Enable to let students check into their portal <a class="btn btn-sm btn-default" href="main?page=schoolapp&tools=login#mainsetting">Click Here</a>');
}

// lets warn if students cant log in
@$staff_can = $kas_framework->getValue('status', 'tbl_app_config', 'module', 'staff_login');
if($staff_can != 1){
	$myp->AlertInfo('Notice! ', 'Staff portal is locked, Please Enable to let students check into their portal <a class="btn btn-sm btn-default" href="main?page=schoolapp&tools=login#mainsetting">Click Here</a>');
}

// lets warn if students cant log in
@$parent_can = $kas_framework->getValue('status', 'tbl_app_config', 'module', 'parent_login');
if($parent_can != 1){
	$myp->AlertInfo('Notice! ', 'Parent portal is locked, Please Enable to let students check into their portal <a class="btn btn-sm btn-default" href="main?page=schoolapp&tools=login#mainsetting">Click Here</a>');
}

// SECOND
// count grade year and warn admin if grade years should be created
$gradecount = $kas_framework->countAll('grades');//16
$yyercount = $kas_framework->countAll('school_years');//20
// (20+3)-3 = 20
$numberleft = ($yyercount+3) - $nyear;// we added 3 for unforeseen error
// make sure that number of available grade is = numberleft so that the someone in year1 will have graduation year defined
// numberleft should not be less than grade number
if ($gradecount > $numberleft){?>

<?php 
	if ($kas_framework->countAll('school_years') < 5) {
		$myp->AlertInfo('Notice! ', 'You need to create about ten school years/session. Dont be a victim is database crash, go to 
					<a href="admin_configuration.php?action=edit&operator=admin&position=adminArea&user=Administrator&page=configindex&do=yes#general">Configuration</a>
					and click on <b>School Years</b> now and create about 5 Years Ahead.');
		}
	 }
 
// THREE
// CHECK IF MAINTENANCE MODE IS ON
@$maintenace_mode = $kas_framework->getValue('status', 'tbl_app_config', 'module', 'maintenance_mode');

if($maintenace_mode==1){
	$myp->AlertError('Please Note This! ', 'Maintenance mode is enabled, please disable <a href="main?page=schoolapp&tools=mainsett#mainsetting">here</a>');
}

// FOUR
// CHECK If registrations admits students
@$student_registration = $kas_framework->getValue('status', 'tbl_app_config', 'module', 'student_registration');
if($student_registration==1){
	$myp->AlertInfo('Check This! ' ,'Old Students Registration, <a href="main?page=schoolapp&tools=register#mainsetting">This</a> 
	should be disabled when all old students have Registered <a class="btn btn-sm btn-default" href="main?page=schoolapp&tools=register#mainsetting">Click Here</a>');
}

// for this current session
$sch_fee_ses = $nyear;
// for the current term
$sch_fee_term = $cterm_id;
// how many grades do we have
$total_grades = $gradecount;

// now loop warning for each grade
for($my_g=1; $my_g<=$total_grades; $my_g++){
// sixteen times if grade is sixteen

// the total school fee
$sqlZ = "SELECT price FROM school_fees WHERE component='total' AND grades = '$my_g' AND school_year='$sch_fee_ses' AND grades_term = '$sch_fee_term'";
$dbh_sqlZ = $dbh->prepare($sqlZ);
$dbh_sqlZ->execute();
$sqlObject = $dbh_sqlZ->fetch(PDO::FETCH_OBJ);
$dbh_sqlZ = null;
$total_comp = @$sqlObject->price;

// the sum of component
$getSQL = "SELECT SUM(price) as my_total_comp_sum FROM school_fees WHERE component != 'total' AND grades = '$my_g' AND school_year='$sch_fee_ses' AND grades_term = '$sch_fee_term'";
$dbh_getSQL = $dbh->prepare($getSQL);
$dbh_getSQL->execute();
$row_sum = $dbh_getSQL->fetch(PDO::FETCH_ASSOC);
$dbh_getSQL = null;
// here we have sum of components 
$sum_total_comp = $row_sum['my_total_comp_sum'];
if($sum_total_comp>$total_comp){
// the school fee configuration for that grade is wrong
// collect the grade name 
$school_fee_grade = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $my_g);
// display warning for admin then


// just a css thing first
echo '<div style="background:#66CC99; margin-left:10px; margin-right:10px; margin-top:5px; margin-bottom:3px; border-radius:10px">
<div style="margin-left:5px"> 
<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">*</button>
		<h4 class="alert-heading">Critical Error!</h4>';								
	// fire the warning												
	echo 'School Fee Configuration for <b>'.$school_fee_grade.'</b> for this term/session is very wrong. Correct such <a href="fees?page=home" target="_blank">here</a><hr>';

	// just ending the css things
	echo '</div></div></div>';
	}
}

?>