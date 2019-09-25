<?php 
$title="Student manager";
	if (!defined('MYSCHOOLAPPADMIN_CORE')) {// if the user access this page directly, take his ass back to home 
		header('Location: ../../../index.php?action=notauth');
		exit;
	}
	include_once "../includes/common.php";

	// config
	include_once "../includes/configuration.php";
	// 0=not admited, 1=admited, 2= Graduate, 3= suspended, 4= expelled, 5= transferd, 6 withdrawn, 7 deceased

	//////////--> url control for 1000 sorting to condition grade selects: version 2
	if(isset($_GET['smoosh'])){
		$urlsmoosh = '&smoosh=1';	
		} else { $urlsmoosh = '';	}// for grades
	$urlo = ''; // for others: ref: inc_user_sort_grade.php
	$urlgd = '';// for graduates
	//////////--> url control for 1000 sorting to condition grade selects: version 2: ends

	if(isset($_GET['graduates'])){
		$gstatus = 2;// select graduates
	} else {
			$gstatus = 1;// select current
	}

///////////////////////////////////////////////////////////--> counting the number of students
 if(isset($_GET['gid'])){
	$gid = DecodeToken($_GET['gid']);
	$gradename= $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $gid);	
	
	if(isset($_GET['Others'])){
		$querybio = "select * from studentbio a JOIN student_grade_year b ON(a.studentbio_id = b.student_grade_year_student) WHERE a.admit > '2' AND b.student_grade_year_year='$nyear' AND b.student_grade_year_grade='$gid'";
		$dbh_querybioSQL = $dbh->prepare($querybio); $dbh_querybioSQL->execute(); 
	 } else {
		$querybio = "select * from studentbio a JOIN student_grade_year b ON(a.studentbio_id = b.student_grade_year_student) WHERE a.admit = '$gstatus' AND b.student_grade_year_year='$nyear' AND b.student_grade_year_grade='$gid'";
		$dbh_querybioSQL = $dbh->prepare($querybio); $dbh_querybioSQL->execute(); 
	 }

   } else {
	$gid=0;		
	$gradename= 'All Student';
   
   if (isset($_GET['Others'])){
		$querybio= "select * from studentbio WHERE admit > '2' ";
		$dbh_querybioSQL = $dbh->prepare($querybio); $dbh_querybioSQL->execute(); 
   } else {
		 $querybio= "select * from studentbio WHERE admit = '$gstatus' ";
		 $dbh_querybioSQL = $dbh->prepare($querybio); $dbh_querybioSQL->execute();

   } 
}
/////////////////////////////////////////////////////////////-->Counting Ends 

require_once('inc_user_sort_magic.php');

////////////////////////////////////////////---> selecting sorted number of students
 if(isset($_GET['gid'])){
	 
  if(isset($_GET['Others'])){
		$pullassout = "SELECT * from studentbio a JOIN student_grade_year b ON(a.studentbio_id = b.student_grade_year_student) WHERE a.admit > '2' AND b.student_grade_year_grade='$gid' AND b.student_grade_year_year !='$nyear' ORDER BY a.studentbio_id DESC LIMIT $sort_srt, 1000";
		$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
	  } else {
		$pullassout = "SELECT * from studentbio a JOIN student_grade_year b ON(a.studentbio_id = b.student_grade_year_student) WHERE a.admit = '$gstatus' AND b.student_grade_year_year='$nyear' AND b.student_grade_year_grade='$gid' ORDER BY a.studentbio_id DESC LIMIT $sort_srt, 1000";
		$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
	}
	 
 } else {
	 if(isset($_GET['Others'])){
		$pullassout="select * from studentbio WHERE admit > '2' ";
		$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
	 }else{
		$pullassout="select * from studentbio WHERE admit = '$gstatus' ";
		$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
	}
 }
////////////////////////////////////////////---> selecting sorted number of students ends

?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i> Students Database </h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
	
	 <div class=" well" data-original-title="data-original-title">
	 Filter Students
	 <a href="main?page=users&smoosh=1<?php if(isset($_GET['graduates'])){echo '&graduates=true';}?><?php if(isset($_GET['Others'])){echo '&Others=set';}?>" class="btn btn-<?php if(isset($_GET['smoosh'])){echo'primary';}else{echo 'default';}?> btn-sm"> By Grade </a>
	 <a href="main?page=users&graduates=true<?php if(isset($_GET['smoosh'])){echo '&smoosh=1';}?><?php if(isset($_GET['Others'])){echo '&Others=set';}?>" class="btn btn-<?php if(isset($_GET['graduates'])){echo'primary';}else{echo 'default';}?> btn-sm"> Graduates </a>
	 <a href="main?page=users<?php if(isset($_GET['graduates'])){echo '&graduates=true';}?><?php if(isset($_GET['smoosh'])){echo '&smoosh=1';}?>&Others=set" class="btn btn-<?php if(isset($_GET['Others'])){echo'primary';}else{echo 'default';}?> btn-sm"> Others </a>
	 <a href="main?page=users" class="btn btn-default btn-sm"> All Current </a>

	
<?php 
if(isset($_GET['smoosh'])){
	// we list class for students to choose
require_once('inc_user_sort_grade.php');
}
?>
 <br><br>
Showing: <font color="green"><?php echo $gradename;?></font> : <font color="green"><?php echo '<strong>'.number_format($biototal).' student(s) </strong>';?></font>
<?php 
if(isset($_GET['graduates'])){
	echo "Graduates";
	} else if(isset($_GET['Others'])){
	echo '<font color="red">Problem Candidates</font>';

	} else {
}
?>
    </div>
	
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr>
            <th>S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th>Username</th>
            <th>Name</th>
            <th>Class</th>
            <th>Parent</th>
            <th><a href="#" title="Active means student can log in">Status</a></th>
            <th> Sex </th>
            <th>Photo<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th>Reg Date </th>
            <th>Login </th>
            <th>Available Action</th>
          </tr>
        </thead>
        <tbody>
         
		<?php
		
		$sn = 0;
		while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {
			$current_year=$_SESSION['CurrentYear'];

			$sn = $sn + 1;
			$regno = $std['studentbio_internalid'];
			$stdbio_id = $std['studentbio_id'];
			$myfirstn = $std['studentbio_fname'];
			$mylastn = $std['studentbio_lname'];
			$mymiddlen = $std['studentbio_mname'];

			$username = $kas_framework->getValue('user_n', 'web_students', 'identify', $regno);
			$regdate = $kas_framework->getValue('reg_date', 'web_students', 'identify', $regno);
			$std_grade_yr = $kas_framework->getValue('student_grade_year_grade', 'student_grade_year', 'student_grade_year_student', $stdbio_id);
			$std_grade = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $std_grade_yr);
		
		if($std_grade==NULL){ $std_grade='<u>Graduate</u>'; }

		// get the idiots parent name
		$parent_to_kid = $kas_framework->getValueRestrict2('parent_id', 'parent_to_kids', 'student_id', $stdbio_id, 'confirmation', '1');
		@$firstn = $kas_framework->getValue('student_parents_firstname', 'student_parents', 'student_parents_id', $parent_to_kid);
		@$lastn = $kas_framework->getValue('student_parents_lastname', 'student_parents', 'student_parents_id', $parent_to_kid);

		@$parent = ucfirst($lastn).', '.ucfirst($firstn).' <br> <a href="main?page=parents" class="btn btn-default btn-sm"> View </a>';
		// what if the guy have no parent or parent not aproved
		if($lastn == NULL) { $parent = 'None <br> <a href="main?page=parent_child" class="btn btn-default btn-sm"> Assign </a>'; }

		$mystatus = $kas_framework->getValue('admit', 'studentbio', 'studentbio_id', $stdbio_id);
			
			if($mystatus =='1'){
			 $mystatus = '<span class="label label-success">Current</span>';
			 //label-warning for pending
				// 0=not admited, 1=admited, 2= Graduate, 3= suspended, 4= expelled, 5= transferd, 6 = withdrwn, 7 = deceased

			 }else if($mystatus =='2'){	
				$mystatus = '<span class="label label-info">Graduate</span>';
			}else if($mystatus =='3'){
				$mystatus = '<span class="label label-warning">Suspended</span>';
			}else if($mystatus =='4'){
				$mystatus = '<span class="label label-important">Expelled</span>';
			 }else if($mystatus =='5'){
				$mystatus = '<span class="label label-info">Transfered</span>';
			 }else if($mystatus =='6'){
				$mystatus = '<span class="label label-info">Withdrawn</span>';
			 }else if($mystatus =='7'){
				$mystatus = '<span class="label label-important">Deceased</span>';
			 }else{
				$mystatus = '<span class="label label-important">Unknown</span>';
			 }

		$std_status= $kas_framework->getValue('status', 'web_students', 'stdbio_id', $stdbio_id);
		 if($std_status =='1'){
			 $std_status = '<span class="label label-success" style="padding:6px 8px;">Active</span>';
			 //label-warning for pending
			 } else {	$std_status = '<span class="label label-important" style="padding:6px 8px">Inactive</span>';}
			 
		// catch his sex abi na gender
		$gender= $std['studentbio_gender'];
		// select the student picture

		$picture= $kas_framework->getValue('studentbio_pictures', 'studentbio', 'studentbio_id', $stdbio_id);
		if($picture==NULL){
			if($gender == "Male"){
				$picture = 'avatar_default.png';
			}else{
				$picture = 'f_avatar.png';}
			}
		//$std_yob=$db->get_var("SELECT date_format(studentbio_dob, '%Y') as date FROM studentbio WHERE studentbio_id='$stdbio_id'");//we can also use stdbio_id

		// the date of birth
		$std_yob= $kas_framework->getValue('studentbio_dob', 'studentbio', 'studentbio_id', $stdbio_id);
		//pick only the year
		$std_yob = trim(substr($std_yob, -4));
		// check if it a number and looks like a year

		@$checkdt = checkdate(12, 31, $std_yob);
		if($checkdt != true){
			$dob = "1++ ";
		}else{
			$dob = date('Y')-$std_yob+1;
		}
		
		$lastdate= $kas_framework->getValue('last_log', 'web_students', 'identify', $regno);
		$email= $kas_framework->getValue('email', 'web_students', 'identify', $regno);
	?>
	
		  <tr>
			<td><?php echo $sn;?></td>
            <td><i class="icon icon-color icon-user"></i><?php echo $username;?></td>
            <td class="center"><?php echo $mylastn.', '.$mymiddlen.' '.$myfirstn.'<br />('.$regno.')';?></td>
            <td class="center"><?php echo $std_grade;?> </td>
            <td class="center"><?php echo $parent;?> </td>
            <td class="center"> <?php echo $mystatus .'<br /><br /> '. $std_status;?></td>
            <td class="center"><?php echo $gender;?> <?php echo $dob.'yrs';?></td>
            <td class="center">
			<div id="image"><a href="../../pictures/<?php echo $picture;?>" title="Image of <?php echo $username;?>" class="fancybox fancybox.image" >
			<img id="admission" title="<?php echo $email;?>" src="../../pictures/<?php echo $picture;?>" alt ="No Image" style="width:60px;" align="" /></a></div></td>
            <td class="center"><?php echo $regdate;?></td>
            <td class="center"><?php echo $lastdate;?></td>
            <td class="center">
			<a target="_blank" title="View <?php echo $myfirstn;?>'s profile" class="btn btn-success" href="main?page=view_users&id=<?php EncodeToken($stdbio_id);?>"> <i class="icon-zoom-in icon-white"></i> </a> 
			<!--<a target="_blank" title="Delete not allowed here" class="btn btn-danger" href="#"> <i class="icon-trash icon-white"></i></a>--></td>
          </tr>
	 <?php } ?>
        </tbody>
      </table>
	<?php
// start working ends, this is the third place worked


echo 'Total Students: <strong>'.number_format($biototal).'</strong><br><br>';
	if($biototal > 1000){
		if(!isset($_GET['break_p'])){$groupid=1;}

	echo '<br>You now have large number of students in your db; total: '.$biototal.' we have put them into page groups, the ones bellow are more of them <br><br><br> Viewing page group:'.'<strong>'.$groupid.'</strong>'.'<br>';
	// then we loop the page grout in a page grouping link
	for($bp = 1; $bp <= $break_p; $bp++){
		echo '<a href="main?page=users&break_p='.$bp.$urlo.$urlsmoosh.$urlgd.'">PG'.$bp.' </a>&raquo;';

	}// end for loop

}// end biototal is 1000
?>
  </div>
  </div>
  <!--/span-->
</div>
<p>&nbsp;</p>