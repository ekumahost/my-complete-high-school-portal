<?php 

//view users was defined in page = main

if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}

include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";

// catch the student id from url
$studentid = DecodeToken(get_param('id'));
// gather evething out of the database in web students

$webstd_SQL = "SELECT * FROM web_students WHERE stdbio_id = '".$studentid."'";
$dbh_web_Std_SQL = $dbh->prepare($webstd_SQL); $dbh_web_Std_SQL->execute(); $fetchObj_std = $dbh_web_Std_SQL->fetch(PDO::FETCH_OBJ); $dbh_web_Std_SQL = null;

$std_username = $fetchObj_std->user_n;
$std_email= $fetchObj_std->email;
$status= $fetchObj_std->status;
$std_lastlog= $fetchObj_std->last_log;
$form_no= $fetchObj_std->form_no;
$std_entry_yr_yr= $fetchObj_std->reg_date;

 if($status =='1'){
 $std_status = '<span class="label label-success">Active</span>';
 //label-warning for pending
 } else {	$std_status = '<span class="label label-important">Inactive</span>';}
					 			 
$std_deno_id = $fetchObj_std->denomination;

$std_deno_titl = $kas_framework->getValue('deno', 'tbl_std_denomination', 'id', $std_deno_id);

if ($std_deno_id == 0){
	$std_deno_titl = "Not Set";
}

$std_reg_date= $kas_framework->getValue('reg_date', 'web_students', 'stdbio_id', $studentid);

//Reduce the server load from loading about 31 times to just 1. All student bio loaded once instead of 31 times with gerVar()
$stdbio_SQL = "SELECT * FROM studentbio WHERE studentbio_id = '".$studentid."'";
$dbh_stdbio_SQL = $dbh->prepare($stdbio_SQL); $dbh_stdbio_SQL->execute(); $fetchObj_stdbio = $dbh_stdbio_SQL->fetch(PDO::FETCH_OBJ); $dbh_stdbio_SQL = null;

$std_sex =$fetchObj_stdbio->studentbio_gender;
$std_et =$fetchObj_stdbio->studentbio_ethnicity;
$std_reg=$fetchObj_stdbio->studentbio_internalid;
$std_fname =$fetchObj_stdbio->studentbio_fname;
$std_mname =$fetchObj_stdbio->studentbio_mname;
$std_lname =$fetchObj_stdbio->studentbio_lname;
$std_gen =$fetchObj_stdbio->studentbio_generation;
$std_entry =$fetchObj_stdbio->studentbio_entry_year;
$std_pic = $fetchObj_stdbio->studentbio_pictures;
$mystatus=$fetchObj_stdbio->admit;
$std_dbirth=$fetchObj_stdbio->studentbio_dob;
$std_bcity =$fetchObj_stdbio->studentbio_birthcity;
$std_bstate =$fetchObj_stdbio->studentbio_birthstate;
$std_bcont =$fetchObj_stdbio->studentbio_birthcountry;
$std_pschname =$fetchObj_stdbio->studentbio_prevschoolname;
$std_pschad =$fetchObj_stdbio->studentbio_prevschooladdress;
$std_pschcity =$fetchObj_stdbio->studentbio_prevschoolcity;
$std_pschstate =$fetchObj_stdbio->studentbio_prevschoolstate;
$std_pschzip =$fetchObj_stdbio->studentbio_prevschoolzip;
$std_pschcont =$fetchObj_stdbio->studentbio_prevschoolcountry;
$std_hmd =$fetchObj_stdbio->studentbio_homed;
$std_pcontact =$fetchObj_stdbio->studentbio_primarycontact;
$std_bus =$fetchObj_stdbio->studentbio_bus;
$std_admit =$fetchObj_stdbio->admit;
$std_adres =$fetchObj_stdbio->std_bio_address;
$std_restown =$fetchObj_stdbio->std_bio_resident_town;
$std_restate =$fetchObj_stdbio->std_bio_resident_state;
$std_phone =$fetchObj_stdbio->std_bio_phone;
$std_mobile =$fetchObj_stdbio->std_bio_mobile;
$std_lparent =$fetchObj_stdbio->std_bio_living_with_parent;
$std_yob=$fetchObj_stdbio->studentbio_dob;
$std_teacher_id =$fetchObj_stdbio->studentbio_form_master;

$std_ethnicity = $kas_framework->getValue('ethnicity_desc', 'ethnicity', 'ethnicity_id', $std_et);

 if($mystatus =='1'){
 $mystatus = '<span class="label label-success">Current Student</span>';
 //label-warning for pending
	// 0=not admited, 1=admited, 2= Graduate, 3= suspended, 4= expelled, 5= transferd
 } else if($mystatus =='2'){	
	$mystatus = '<span class="label label-info">Graduate</span>';
 }else if($mystatus =='3'){
	$mystatus = '<span class="label label-warning">Suspended</span>';
 } else if($mystatus =='4'){
	$mystatus = '<span class="label label-important">Expelled</span>';
 } else if($mystatus =='5'){
	$mystatus = '<span class="label label-info">Transferred</span>';
 } else if($mystatus =='6'){
	$mystatus = '<span class="label label-info">Withdrawn</span>';
 } else if($mystatus =='7'){
	$mystatus = '<span class="label label-important">Deceased</span>';
 } else{
	$mystatus = '<span class="label label-important">Unknown</span>';
 }
 
$sch_current_yr = $kas_framework->getValue('current_year', 'tbl_config', 'id', '1');
$std_entry_session = $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $std_entry); 
$std_current_yr = $kas_framework->getValueRestrict2('student_grade_year_grade', 'student_grade_year', 'student_grade_year_student', $studentid, 'student_grade_year_year', $sch_current_yr);
$std_entry_class_id = $kas_framework->getValueRestrict2('student_grade_year_grade', 'student_grade_year', 'student_grade_year_student', $studentid, 'student_grade_year_year', $std_entry);

$std_current_domain= $kas_framework->getValue('grades_domain', 'grades', 'grades_id', $std_current_yr);
$std_current_year_desc = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $std_current_yr);

$std_entry_grade = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $std_entry_class_id);

if ($std_current_domain =='0'){
	$std_sch_name = $kas_framework->getValue('school_name', 'school_name', 'id', '1'); 
} else {
	$std_sch_name = $kas_framework->getValue('school_names', 'tbl_grade_domains', 'id', $std_current_domain);
}
// the school id
$std_sch = "AA".$std_current_domain;


if($std_current_year_desc==NULL && $std_admit =='2'){$std_current_year_desc='<u>Graduated</u>';
	$std_current_yr='0';
} else if($std_current_year_desc==NULL && $std_admit >2){$std_current_year_desc='<u>None</u>';
	$std_current_yr='0';
}


if ($std_entry_class_id == NULL){
	$std_entry_grade = "None";
}

$lastgrade = $kas_framework->countAll('grades');

$std_graduation_class = $lastgrade-$std_entry_class_id;
$std_graduation_session_id = $std_entry+$std_graduation_class+1;
// make sure that the school years are created large

$std_graduation_session = $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $std_graduation_session_id);

if ($std_graduation_session == NULL){
$std_graduation_session = "soonest";// Error 20: School years are not created, or student profile incomplete
}

	// image
	if($std_pic==NULL){
		$std_pic = 'avatar_default.png';
	}
	// the age calculate
	$std_yob=substr($std_yob, -4);
	// version 2
	@$checkdt = checkdate(12, 31, $std_yob);
	if($checkdt != true){
		$std_dob = "1++ ";
	}else{
		$std_dob = date('Y')-$std_yob+1;
	}

$std_bcont = $kas_framework->getValue('name', 'country', 'id', $std_bcont);

// parent 
$std_parent_id = $kas_framework->getValueRestrict2('parent_id', 'parent_to_kids', 'student_id', $studentid, 'confirmation', '1');
	if ($std_parent_id != '') {
		//Reduce the server load from loading about 16 times to just 1. All student parents info loaded once instead of 16 times with gerVar()
		$studentParents_SQL = "SELECT * FROM student_parents WHERE student_parents_id='".$std_parent_id."'";
		$dbh_studentParents_SQL = $dbh->prepare($studentParents_SQL); $dbh_studentParents_SQL->execute(); $fetchObj_stdpar = $dbh_studentParents_SQL->fetch(PDO::FETCH_OBJ); $dbh_studentParents_SQL = null;
		$std_parent_fname =$fetchObj_stdpar->student_parents_firstname;
		$std_parent_lname =$fetchObj_stdpar->student_parents_lastname;
		$std_parent_email =$fetchObj_stdpar->student_parents_email;
		$std_parent_sex =$fetchObj_stdpar->student_parents_sex;
		$std_parent_tit =$fetchObj_stdpar->student_parents_title;
		$std_parent_ad1 =$fetchObj_stdpar->student_parents_contactaddress1;
		$std_parent_ad2 =$fetchObj_stdpar->student_parents_contactaddress2;
		$std_parent_mobile =$fetchObj_stdpar->student_parents_mobile1;
		$std_parent_mobil2 =$fetchObj_stdpar->student_parents_mobile2;
		$std_parent_city =$fetchObj_stdpar->student_parents_city;
		$std_parent_state =$fetchObj_stdpar->student_parents_state;
		$std_parent_count =$fetchObj_stdpar->student_parents_country;
		$std_parent_sch =$fetchObj_stdpar->student_parents_school;
		$std_parent_ocu =$fetchObj_stdpar->student_parents_occupation;
	} else {
		$std_parent_fname = ''; $std_parent_lname = ''; $std_parent_email = ''; $std_parent_sex = '';$std_parent_tit = '';$std_parent_ad1 = '';$std_parent_ad2 = '';
		$std_parent_mobile = '';$std_parent_mobil2 = '';$std_parent_city = '';$std_parent_state = '';$std_parent_count = '';$std_parent_sch = '';$std_parent_ocu = '';
	}


if(empty($std_parent_fname)){$std_parent_fname="None";}

$std_parent_title = $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $std_parent_tit);
$code = "45re56jg87";

// student teacher // ER 10, selcet teacher from teacher grade year
$std_class_teacher_id = $kas_framework->getValueRestrict2('teacher', 'teacher_grade_year', 'session', $sch_current_yr, 'grade_class', $std_current_yr);

$staff_SQL = "SELECT * FROM staff WHERE staff_id='".$std_class_teacher_id."'";
$dbh_staff_SQL = $dbh->prepare($staff_SQL); $dbh_staff_SQL->execute(); $rowCount = $dbh_staff_SQL->rowCount(); $fetchObj_staff = $dbh_staff_SQL->fetch(PDO::FETCH_OBJ); $dbh_staff_SQL = null;

if ($rowCount > 0) {
	$std_class_teacher_ti = $fetchObj_staff->staff_title;
	$std_class_teacher_fname = $fetchObj_staff->staff_fname;
	$std_class_teacher_lname =$fetchObj_staff->staff_lname;
	$std_class_teacher_mi =$fetchObj_staff->staff_mi;
	$std_teacher_ti =$fetchObj_staff->staff_title;
	$std_teacher_fname =$fetchObj_staff->staff_fname;
	$std_teacher_lname =$fetchObj_staff->staff_lname;
	$std_teacher_mi =$fetchObj_staff->staff_mi;

	$std_class_teacher_title = $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $std_class_teacher_ti);
	$std_teacher_title = $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $std_teacher_ti);
	
} else {
	$std_teacher_title = $std_class_teacher_title = $std_class_teacher_ti = $std_class_teacher_fname = $std_class_teacher_lname = $std_class_teacher_mi = $std_teacher_ti = $std_teacher_fname = $std_teacher_lname = $std_teacher_mi = '-';
}

if ($std_class_teacher_id == NULL){
	$std_class_teacher_fname = "Not Set";
}
if ($std_teacher_id == NULL){
	$std_teacher_fname = "Not Set";
}

$title= $std_lname."'s Profile (".$std_username.")";
?>
<style type="text/css">
.label { padding: 6px 8px }
</style>
<div id="content" class="span11">
    <div class="box span9">
      <div class="box-header well" data-original-title="data-original-title">
        <h2><i class="icon-user"></i> &nbsp;<?php echo $std_username;?> </h2>
             <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>

      </div>
      <div class="box-content">
        <div class="page-header">
		<?php if($std_username ==NULL){
			$mutilateurl= 'Something is not right. Seems like you are manipulating the url like a hacker. Click on Manage users at the left';
					$myp->AlertError('Error! ', $mutilateurl);
					exit;
				}
		?>
 <h1><font color="#999999"><?php echo $std_lname;?>, <?php echo $std_fname; ?> <?php echo $std_mname; ?> &nbsp;&raquo;</font><small><?php echo $std_sex; ?> <?php echo $std_dob;?>yrs, <?php echo $std_current_year_desc;?> </small></h1><br />
		  
	      <em><font color="#993300">Admission No</font></em><strong>: <?php echo $std_reg;?></strong> &nbsp;&nbsp;&nbsp;&nbsp;<em><font color="#993300">Portal S/N</font></em>: <strong><?php echo $studentid;?></strong> &nbsp;&nbsp;&nbsp;&nbsp;<em><font color="#993300">Form No</font></em>: <strong><?php echo $form_no;?> </strong> &nbsp;&nbsp;&nbsp;&nbsp;<em><font color="#993300">Username</font></em>: <strong><?php echo $std_username;?></strong> &nbsp;&nbsp;&nbsp;<?php echo $std_status;?>&nbsp;&nbsp;<?php echo $mystatus;?></div>
      <a id="Detail"> </a>
	  
	   <div class="row-fluid">
	   <div class="span8">
          <div class="span6">
            <h3>School Profile <a href="#" class="btn-edit-profile btn btn-sm btn-default"><i class="icon-pencil"></i> Edit</a></h3>
            <p> <em>Entry Year</em>: <strong><?php echo $std_entry_yr_yr;?> (<?php echo $std_entry_session; ?>)</strong></p>
			<p> <em>Entry Grade</em>: <strong> <?php echo $std_entry_grade;?></strong></p>

			 <p> <em>Current Level</em>: <strong><?php echo $std_current_year_desc;?></strong> (level <?php echo $std_current_yr;?>) </p>
             <p> <em>Graduation Year</em>: <strong><?php echo $std_graduation_session;?></strong> </p>
            <p> <em>Class Teacher</em>: <strong><?php echo $std_class_teacher_title.' '.$std_class_teacher_fname.' '.$std_class_teacher_mi;?></strong> </p>
            <p> <em>Form  Teacher </em>: <strong><?php echo $std_teacher_title.''.$std_teacher_fname;?></strong>  </p>
            <!--<p><em>Class Room</em>: <strong>SS3 A</strong></p>-->
            <p> Parent: <strong><?php echo $std_parent_title.' '.$std_parent_fname.' '.$std_parent_lname;?></strong> </p>
			</div>
          
		  <div class="span6">
            <h3>School Reports </h3>
            <p>Results: <span title="" class="icon icon-green icon-redo"></span>Open</p>
            <p><em>Course </em>: <strong><?php echo $std_deno_titl;?></strong></p>

            <p>Health:<span title="" class="icon icon-red icon-redo"></span>  Green</p>
            <p>School Posts:None</p>
			 <p>Admission : <?php echo $mystatus;?> <span title="" class="icon icon-green icon-redo"></span>.</p>
			
			</div>
		
		  <div class="span11"><hr />
		  <?php include ('div_admin/ultimate_student_profile_completion_plugin.php') ?>
			<p> Profile Completion: (<?php print $ProfileComplete ?>%)
			<div class="progress progress-striped progress-<?php print $bootstrapIdentifier ?> active">
				<div class="bar" style="width: <?php print $ProfileComplete ?>%;"></div>
			</div></p>
						<p><?php //echo ($status == 1)? $myp->AlertInfo('', 'This Student Can log in. Email Verified'): $myp->AlertError('', 'Cannot Log In. Email Not Verified. Code: '.$status);  ?> </p>

			<p><?php echo ($status == $code)? $myp->AlertInfo('', 'Currently Forced to Verify Email'): ($status == 1)? $myp->AlertInfo('', 'This Student Can log in. Email Verified'):$myp->AlertError('', 'Cannot Log In. Email Not Verified. Code: '.$status);  ?> </p>
		  </div>			
		</div>   

          <div class="span4 ">
            <div class="well">
            <center> <font color="#999999">Official photo</font></center><br />
              <h2><a href="../../pictures/<?php echo $std_pic;?>" title="<?php echo $std_fname;?>'s profile photo" class="fancybox fancybox.image"><img src="../../pictures/<?php echo $std_pic;?>" alt="<?php echo $std_fname; ?>'s picture will display here when uploaded" height="200px" /></a></h2>
			        <center> <a href="#" class="btn-edit-photo btn btn-sm btn-default" title="Edit this photo"><i class="icon-pencil"></i> Edit Photo</a></center>
				</div>
          </div>
        </div>
		 <!--/row -->
       
	   <p><a href="?page=view_users&id=<?php EncodeToken($studentid);?>&view=School_Fee#Detail" class=""><button class="btn btn-primary">School Fees</button></a> 
	   <a href="?page=view_users&id=<?php EncodeToken($studentid);?>&view=Hostel_Fee#Detail" class=""><button class="btn btn-primary">Hostel Fees</button></a> 
	   <a href="?page=view_users&id=<?php EncodeToken($studentid);?>&view=Recharges#Detail" class=""><button class="btn btn-primary">Portal recharges</button></a> </p>
	   <a href="?page=view_users&id=<?php EncodeToken($studentid);?>&view=GradeHistory#Detail" class=""><button class="btn btn-primary">Grade History</button></a> </p>

	
	<hr />

	<?php if(isset($_GET['view'])){
	print '	<div class="row-fluid">
	<div class="span12">';
	$myview = $_GET['view'];
	switch($myview){
	case 'School_Fee':
	
	echo "&nbsp;&nbsp;School Fee payments";
	include('inc_users_fee.php');
	break;
	
	case 'Hostel_Fee':
	echo "&nbsp;&nbsp;Hostel Fee payments";
    include('inc_users_hostel.php');
	break;
	case 'Recharges':
	echo "&nbsp;&nbsp;Student Portal recharges";
    include('inc_users_recharge.php');
	break;
	case 'GradeHistory':
	echo "&nbsp;&nbsp;Student Grade History";
    include('inc_users_grade_history.php');
	break;
	default:
	echo "Trouble";
	echo '<font color="red"> We got Confused with your URL;';
	} 
	print '	</div>	
</div>';
}?>

		
        <p>&nbsp;</p>
       <p> <strong>Profile Detail <a href="#" class="btn-edit-name btn btn-sm btn-default"><i class="icon-pencil"></i> Edit Students Profile</a></strong></p>
        
        <div class="row-fluid">
          <div class="span12">

            <table width="100%" border="0" class="table table-striped table-bordered bootstrap-datatable">
              <tr>
                <td width="20%">Surname:</td>
                <td width="60%"><strong><?php echo $std_lname;?> </strong></td>
                <td width="20%">&nbsp;</td>
              </tr>
              <tr>
                <td>First name </td>
                <td><strong><?php echo $std_fname;?> </strong></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Middle name </td>
                <td><strong><?php echo $std_mname;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Ethnicity</td>
                <td><strong><?php echo $std_ethnicity;?></strong></td>
                <td><a class="btn btn-sm btn-default">Details <font color="red">!</font></a></td>
              </tr>
              <tr>
                <td>Birth</td>
                <td><strong><?php echo $std_dbirth;?> </strong> </td>
                <td><a class="btn btn-sm btn-default">Calendar <font color="red">!</font></a></td>
              </tr>
              <tr>
                <td>Birthcity</td>
                <td><strong><?php echo $std_bcity;?></strong></td>
                <td>map</td>
              </tr>
              <tr>
                <td>State</td>
                <td><strong><?php echo $std_bstate;?></strong></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Nationality</td>
                <td><strong><?php echo $std_bcont;?></strong></td>
                <td>&nbsp;</td>
              </tr>
             
            </table>
            <h2>&nbsp;</h2>
            <p><strong>Contact Detail <a href="#" class="btn-edit-contact btn btn-sm btn-default"><i class="icon-pencil"></i> Edit Student Contact Details</a></strong></p>
            
            <table width="100%" border="0" class= "table table-striped table-bordered bootstrap-datatable">
              <tr>
                <td width="20%"></td>
                <td width="60%"></td>
                <td width="20%">Tools</td>
              </tr> 
			  <tr>
                <td width="20%">Mobile</td>
                <td width="60%"><?php echo $std_mobile;?></td>
                <td width="20%"><a class="btn btn-sm btn-default"> Place Call <font color="red">!</font></a></td>
              </tr>
              <tr>
                <td>Email</td>
                <td><?php echo $std_email;?></td>
                <td><a class="btn btn-sm btn-default"><i class="icon icon-inbox"></i> Email <font color="red">!</font></a></td>
              </tr>
              <tr>
                <td>Address</td>
                <td><?php echo $std_adres;?></td>
                <td><a class="btn btn-sm btn-default">Google Map <font color="red">!</font></a></td>
              </tr>
              <tr>
                <td>Resident Town </td>
                <td><?php echo $std_restown;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Resident State </td>
                <td><?php echo $std_restate;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><b>Parent name </b></td>
                <td><?php echo $std_parent_title.' '.$std_parent_fname.' '.$std_parent_lname;?> (<?php echo $std_parent_sex;?>)</td>
                <td>&nbsp;</td>
              </tr>
             
			 <?php if(!empty($std_parent_id)){?>
			 <tr>
                <td>Occupation</td>
                <td><?php echo $std_parent_ocu;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Phone</td>
                <td><?php echo $std_parent_mobile.'  '.$std_parent_mobil2;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Address</td>
                <td><?php echo $std_parent_ad1.' '.$std_parent_ad2.' '.$std_parent_city.' '.$std_parent_state.' '.$std_parent_count;?></td>
                <td><a class="btn btn-sm btn-default">Call <font color="red">!</font></a></td>
              </tr>
              <tr>
                <td>Email</td>
                <td><?php echo $std_parent_email;?></td>
                <td><a class="btn btn-sm btn-default"><i class="icon icon-inbox"></i> Message <font color="red">!</font></a></td>
              </tr>
			 <?php }?>
			  
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
            <p>
			
		<strong>School Profile</strong>
            <table width="100%" border="0" class= "table table-striped table-bordered bootstrap-datatable">
              <tr>
                <td width="20%">School ID </td>
                <td width="60%"><strong><?php echo $std_sch;?></strong></td>
                <td width="20%">Tools</td>
              </tr>
              <tr>
                <td>School Name </td>
                <td><strong><?php echo $std_sch_name;?> </strong></td>
                <td>&nbsp;</td>
              </tr>
             
              <tr>
                <td>Entry year/Session </td>
                <td><strong><?php echo $std_entry_yr_yr;?> (<?php echo $std_entry_session; ?>)</strong></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Hostel</td>
                <td><strong> <?php if($std_hmd ==1){echo "Available";}else{echo "None";}?></strong></td>
                <td></td>
              </tr>
              <tr>
                <td>Hostel Room </td>
                <td><strong> </strong></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Bus Route</td>
                <td><strong><?php echo $std_bus;?></strong></td>
                <td><a class="btn btn-sm btn-default">Map <font color="red">!</font></a></td>
              </tr>
              <tr>
                <td>Resident Type </td>
                <td><strong><?php if($std_hmd == '1') { echo "Boarding"; } else { echo "Day Student"; }?></strong></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Form Master </td>
                <td><?php print $std_teacher_title. ' '.$std_teacher_fname. ' '.$std_teacher_lname ?></td>
                <td><a href="main?page=view_staff&id=<?php EncodeToken($std_teacher_id) ?>" target="_blank" class="btn btn-sm btn-default"><i class="icon icon-user"></i> Profile </a></td>
              </tr>
             
             
            </table>
			
			</p>
			
			
            <p><strong>Previous School  Profile</strong>: </p>
			<?php if($std_pschname !=NULL){?>
            <table width="100%" border="0" class= "table table-striped table-bordered bootstrap-datatable">
              <tr>
                <td width="20%">&nbsp;</td>
                <td width="60%">&nbsp;</td>
                <td width="20%">Tools</td>
              </tr>
              <tr>
                <td>School Name </td>
                <td><?php if($std_pschname ==NULL){echo "No Previous School";}else{echo $std_pschname;}?></td>
                <td>&nbsp;</td>
              </tr>
             
             <tr>
                <td>School Contacts </td>
                <td><?php echo $std_pschad;?></td>
                <td><a class="btn btn-sm btn-default">Call <font color="red">!</font></a></td>
              </tr>
              <tr>
                <td>School Address </td>
                <td><?php echo $std_pschad.', '.$std_pschcity.' '.$std_pschstate.' '.$std_pschzip.' '.$std_pschcont;?></td>
                <td><a class="btn btn-sm btn-default">Google Map <font color="red">!</font></a></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table><?php }else{
				echo "No Previous School";
				
			}?>
	
			<div class="tooltip-demo well">
              <p class="muted" style="margin-bottom: 0;">About <?php echo $std_fname;?></p>
              <p class="muted"><?php echo $std_fname;?> </p>
             <!-- <p class="muted"><button class="btn-pro-print">Print profile</button>&nbsp;&nbsp;<button class="btn-pro-export">Export Profile</button>&nbsp;&nbsp;<button class="btn-pro-send">Send Profile</button>
              </p>-->
			  <hr>
			  <h2>Uploaded Files/Documents </h2>
			  none
			  <br>
			  
			  <a href="#">Add new files</a>
		</div>
          </div>
        </div>
      </div>
</div>  <!-- content ends -->	
	 <div class="span3">
		
	

			 <div class="box span12">
      <div class="box-header well" data-original-title="data-original-title">
        <h3>Academic  </h3>
      </div>
      <div class="box-content">
        <ol>
          
		  <li><a href="?page=view_users&id=<?php EncodeToken($studentid);?>&view=School_Fee#Detail"><span class="icon icon-orange icon-cart"></span>School fees</a></li>
          <li><a href="?page=view_users&id=<?php EncodeToken($studentid);?>&view=Hostel_Fee#Detail"><span class="icon icon-orange icon-cart"></span>Hostel fees</a></li>
          <li><a href="?page=view_users&id=<?php EncodeToken($studentid);?>&view=Recharges#Detail"><span class="icon icon-orange icon-cart"></span>Portal Recharge</a></li>
           
		   <li><span class="icon icon-orange icon-cart"></span>Item Order <font color="red">!</font></li>
          <li><span class="icon icon-orange icon-book"></span>Book Orders <font color="red">!</font></li>
          <li><span class="icon icon-orange icon-flag"></span>Sports <font color="red">!</font></li>

        </ol>
      </div>
    </div>
	
			
    <div class="box span12">
      <div class="box-header well" data-original-title="data-original-title">
        <h3>Reports</h3>
      </div>
      <div class="box-content">
        <ol>
		 <li><a href="?page=view_users&id=<?php EncodeToken($studentid);?>&view=GradeHistory#Detail"><span class="icon icon-orange icon-book"></span>Grade History</a></li>

		 <li><a href="?page=view_users&id=<?php EncodeToken($studentid);?>&view=Recharges#Detail"><span class="icon icon-orange icon-briefcase"></span>Wallet</a></li>

          <li><span class="icon icon-orange icon-book"></span>Term Results <font color="red">!</font></li>
		  <li><span class="icon icon-orange icon-folder-open"></span>Current Results <font color="red">!</font></li>
          <li><span class="icon icon-orange icon-compose"></span>External Exams <font color="red">!</font></li>
          <li><span class="icon icon-orange icon-compose"></span>WAEC/JAMB <font color="red">!</font></li>
          <li><span class="icon icon-orange icon-document"></span>Transcript <font color="red">!</font></li>
          <li><span class="icon icon-orange icon-envelope-closed"></span>Send Reports <font color="red">!</font></li>
for any item not click-able, locate the link in menu at the left
        </ol>
      </div>
    </div>
	
		

		
	



		<div class="box span12">
      <div class="box-header well" data-original-title="data-original-title">
        <h3>Demographics </h3>
      </div>
      <div class="box-content">
        <ol>
          <li><span class="icon icon-orange icon-clock"></span><a href="../../staff/dashpanel/handleAttendance/updateStudent?click=<?php print substr(md5(rand()), 0, 10) ?>&stdid=<?php print $studentid ?>&ref=<?php print substr(md5(rand()), 0, 10) ?>" class="fancybox fancybox.iframe">Attendance Report</a></li>
		   <li><span class="icon icon-orange icon-heart"></span><a href="../../staff/dashpanel/handleHealth/updateStudent?click=<?php print substr(md5(rand()), 0, 10) ?>&stdid=<?php print $studentid ?>&ref=<?php print substr(md5(rand()), 0, 10) ?>" class="fancybox fancybox.iframe">Health Report</a></li>
          <li><span class="icon icon-orange icon-pin"></span><a href="../../staff/dashpanel/handleDiscipline/updateStudent?click=<?php print substr(md5(rand()), 0, 10) ?>&stdid=<?php print $studentid ?>&ref=<?php print substr(md5(rand()), 0, 10) ?>" class="fancybox fancybox.iframe">Discipline Report</a></li>
          
        </ol>
      </div>
    </div>
	
	
    <!--/span-->
    <div class="box span12">
      <div class="box-header well" data-original-title="data-original-title">
        <h3>Activities Spy </h3>
      </div>
      <div class="box-content">
        <dl>
          <dt>School fee</dt>
          <dd>Paid 0n Unknown</dd>
	      <dt>Registration</dt>
          <dd>Registered 0n <?php echo $std_reg_date;?></dd>
		   <dt>Last login</dt>
          <dd> <?php print ($std_lastlog == '')? 'Unknown': $std_lastlog; ?></dd>
		  </dl>
      </div>
      <p></p>
    </div>

	
	<div class="box span12">
		  <div class="box-header well" data-original-title="data-original-title">
			<h2><i class="icon-list-alt"></i>Grade Performance</h2>
		   
		  </div>
		  <div class="box-content">
			<div id="donutchart" style="height: 300px;"> </div>
		  </div>
		</div>
	
</div>
  <!--/span-->
 	</div> <!--/row-->
<?php include('userpop.php');?>