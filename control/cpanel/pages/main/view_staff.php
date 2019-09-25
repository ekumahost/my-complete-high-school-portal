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
$current_year = $_SESSION['CurrentYear'];
$userid = get_param('id');
$staff_id = DecodeToken($userid);
// gather evething out of the database in staff table

	//instead of pulling 34 records with getvar, we use a single query to pull out the 34 records.
	$pullStaff_profile = "SELECT * FROM staff WHERE staff_id = '".$staff_id."'";
	$dbh_pullStaff_profile = $dbh->prepare($pullStaff_profile); $dbh_pullStaff_profile->execute(); $fetch_Staff_Obj = $dbh_pullStaff_profile->fetch(PDO::FETCH_OBJ); $dbh_pullStaff_profile = null;
	
	$fname=$fetch_Staff_Obj->staff_fname;

	$lname=$fetch_Staff_Obj->staff_lname;
	$mi=$fetch_Staff_Obj->staff_mi;
	$sal_type=$fetch_Staff_Obj->staff_salary_type;
	$sex=$fetch_Staff_Obj->staff_sex;
	$image=$fetch_Staff_Obj->staff_image;
	$titles=$fetch_Staff_Obj->staff_title;
	$staff_dob=$fetch_Staff_Obj->staff_dob;
	$school=$fetch_Staff_Obj->staff_school; //usefull for multiple school
	$email=$fetch_Staff_Obj->staff_email;
	$country=$fetch_Staff_Obj->staff_country;
	$state=$fetch_Staff_Obj->staff_state;
	$address=$fetch_Staff_Obj->staff_adress;
	$town=$fetch_Staff_Obj->staff_res_town;
	$res_state=$fetch_Staff_Obj->staff_res_state;

	$kin=$fetch_Staff_Obj->staff_kin_name;
	$kin_phone=$fetch_Staff_Obj->staff_kin_phone;
	$kin_email=$fetch_Staff_Obj->staff_kin_email;
	$kin_adress=$fetch_Staff_Obj->staff_kin_adress;
	$kin_relationship=$fetch_Staff_Obj->staff_kin_relationship;
	$acc_name=$fetch_Staff_Obj->staff_acc_name;

	$bank=$fetch_Staff_Obj->staff_bank;
	$account=$fetch_Staff_Obj->staff_account;
	$act_type=$fetch_Staff_Obj->staff_act_type;
	$teach_type=$fetch_Staff_Obj->teaching_type;
	$bank_sort=$fetch_Staff_Obj->staff_bank_sort;
	$birth=$fetch_Staff_Obj->staff_dob;
	$ethnicity=$fetch_Staff_Obj->staff_ethnicity;
	$birth_city=$fetch_Staff_Obj->staff_birth_city;
	$biography= $fetch_Staff_Obj->staff_biography;
	$mystatus= $fetch_Staff_Obj->staff_status;

	$entry=$fetch_Staff_Obj->staff_entry_year;
	$mobile=$fetch_Staff_Obj->staff_mobile;
	$staff_id_no=$fetch_Staff_Obj->staff_id_no;
	
	$webUsersDetail = "SELECT * FROM web_users WHERE web_users_relid = '".$staff_id."'";
	$dbh_webUsersDetail = $dbh->prepare($webUsersDetail); $dbh_webUsersDetail->execute(); $fetchObj_WU = $dbh_webUsersDetail->fetch(PDO::FETCH_OBJ); $dbh_webUsersDetail = null;
	
	$stf_type= $fetchObj_WU->web_users_type;
	$username=$fetchObj_WU->web_users_username;
	$status=$fetchObj_WU->web_users_active;
	$online=$fetchObj_WU->online;
	$last_log=$fetchObj_WU->last_log;

// the teacher class
	$staff_class= $kas_framework->getValueRestrict2('grade_class', 'teacher_grade_year', 'teacher', $staff_id, 'session', $current_year);
	
	$edit_staff_grade = $staff_class;// important
	$staff_class_room= $kas_framework->getValueRestrict2('grade_class_room', 'teacher_grade_year', 'teacher', $staff_id, 'session', $current_year); 
	$staff_class_main= $kas_framework->getValueRestrict2('main_teacher', 'teacher_grade_year', 'teacher', $staff_id, 'session', $current_year);
	$edit_staff_main = $staff_class_main;
    $code = "45re56jg87";


if($staff_class =='0'){
	$staff_class = "None Teacher";
	$staff_class_main = '';// set to null
} else {
	// staff has a class
	// we check if class room exist, else count all student in that grade
	if($staff_class_room == 0){
	// count all students in that grade
		$total_students = $kas_framework->countRestrict2('student_grade_year', 'student_grade_year_year', $current_year, 'student_grade_year_grade', $staff_class);
	} else {
	// count only student in class room
		$total_students = $kas_framework->countRestrict3('student_grade_year', 'student_grade_year_year', $current_year, 'student_grade_year_grade', $staff_class, 'student_grade_year_class_room', $staff_class_room);
	}

	// other things based on this condition
	$staff_class= $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $staff_class);
	if($staff_class_main=='1'){
		$staff_class_main = '(Main Teacher)';
	}else{
		$staff_class_main = '(Assistant)';
	}
}


if($staff_class_room == 0){
	// use class name
	$staff_class_room = $staff_class.' class room';
} else {
	$staff_class_room= $kas_framework->getValue('school_rooms_desc', 'school_rooms', 'school_rooms_id', $staff_class_room);
}
// reasign names
	$entry= $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $entry);
	$school= $kas_framework->getValue('grades_domain', 'grades', 'grades_id', $edit_staff_grade); 
	$school= $kas_framework->getValue('school_names', 'tbl_grade_domains', 'id', $school);
	$state= $kas_framework->getValue('state_name', 'tbl_states', 'state_css', $state); 
	$country= $kas_framework->getValue('name', 'country', 'id', $country);
	$titles=$kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $titles);
	$ethnicity=$kas_framework->getValue('ethnicity_desc', 'ethnicity', 'ethnicity_id', $ethnicity);
	$res_state=$kas_framework->getValue('state_name', 'tbl_states', 'state_css', $res_state);
	$kin_relationship=$kas_framework->getValue('relation_codes_desc', 'relations_codes', 'relation_codes_id', $kin_relationship);
	$bank=$kas_framework->getValue('name', 'bank', 'id', $bank);
	$sal_type_e=$kas_framework->getValue('staff_type', 'tbl_salaries', 'id', $sal_type);
	$sal_amount_e=$kas_framework->getValue('amount', 'tbl_salaries', 'id', $sal_type);
	$sal_code_e=$kas_framework->getValue('code', 'tbl_salaries', 'id', $sal_type);
	$sal_scale = $sal_type_e."(".$sal_code_e.")--@".$sal_amount_e;


if($entry ==NULL){
	$entry=$kas_framework->getValue('default_entry_date', 'tbl_config', 'id', '1');
	$entry = trim(substr($entry, -4));
}

if($school ==NULL){
	$school=$kas_framework->getValue('school_name', 'tbl_config', 'id', '1');
}

if($stf_type =='A'){
	$stf_type = "Master Admin";
	}else if($stf_type =='B'){
		$stf_type = "Admin";
	}else if($stf_type =='T'){
		$stf_type = "Teacher";
	}else if($stf_type =='C'){
		$stf_type = "Parent";
	}else if($stf_type =='S'){
		$stf_type = "Non teaching";
	}else if($stf_type =='Ty'){
		$stf_type = "NYSC";
	}else if($stf_type =='Tp'){
		$stf_type = "Practising";
	}else if($stf_type =='Tl'){
		$stf_type = "Lesson";
	}else if($stf_type =='X'){
		$stf_type = "Principal";
	}else if($stf_type =='Xp'){
		$stf_type = "Vice principal";
	}else if($stf_type =='Y'){
		$stf_type = "Director";
	}else if($stf_type =='Yp'){
		$stf_type = "Proprietor";
	}else if($stf_type =='Z'){
		$stf_type = "HyperTera";
	}else{$stf_type = "Unknown";
}


if($status =='1'){
// for email verification
 $statusBlock = '<span class="label label-success" style="padding:6px 8px">Active</span>';
} else {
 $statusBlock = '<span class="label label-important" style="padding:6px 8px">Inactive</span>';
 }

if($mystatus ==1){
// if staff is retired or somewhat
		$mystatus = '<span class="label label-success" style="padding:6px 8px">Current Staff</span>';
	} else if($mystatus == 0){
		$mystatus = '<span class="label label-important" style="padding:6px 8px">Pending</span>';
	 } else if($mystatus ==2){
		$mystatus = '<span class="label label-info" style="padding:6px 8px">Retired</span>';
	 } else{
		 $mystatus = '<span class="label label-important" style="padding:6px 8px">Unknown</span>';
	 }
					 
if($staff_id_no==NULL){$staff_id_no = "Not Assigned";}

$picture = $image;

if($picture==NULL){if($sex =="Male"){$picture = 'av_male.png';}else{$picture = 'av_female.png';}}

// the year of birht
$staff_dob = trim(substr($staff_dob, -4));// pick the year only
// check if it a number and looks like a year

@$checkdt = checkdate(1, 1, $staff_dob);
if($checkdt != true){
	$dob = '18++';
	}else{
	$dob =  date('Y')-$staff_dob+1;
}
	

$lastdate=$fetchObj_WU->last_log; //we can also use stdbio_id

$title= $lname."'s Profile (".$username.")";
?>

<div id="content" class="span11">
 
  <div class="row-fluid sortable">
    <div class="box span9">
      <div class="box-header well" data-original-title="data-original-title">
        <h2><i class="icon-user"></i> &nbsp;<?php echo ucfirst($username);?> &raquo; <?php echo $stf_type;?> </h2>
             <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>

      </div>
      <div class="box-content">
        <div class="page-header">
		<?php if(empty($fname)){
			$myp->AlertError('Hacking Attempt!  ', 'Something is not right. Seems like you are manipulating the url like a hacker. Click on Staff at the left');
			exit;
			}
		?>

          <h1><font color="#999999"><?php echo $titles.' '.$lname .', '.$fname. ' '. substr($mi, 0, 1). '.'; ?> &nbsp;&raquo;</font><small><?php echo $sex .': '. $dob;?> Years. </small></h1><br />
          &nbsp;<em><font color="#993300">Portal S/N</font></em>: <strong><?php echo 'ST00'.$staff_id;?></strong> &nbsp;&nbsp;&nbsp;&nbsp;<em><font color="#993300">ID No</font></em>: <strong><?php echo $staff_id_no;?> </strong> &nbsp;&nbsp;&nbsp;&nbsp;<em><font color="#993300">Username</font></em>: <strong><?php echo $username;?></strong> &nbsp;&nbsp;&nbsp;
		  <?php echo ($status == 1)? '<span class="label label-success" style="padding:6px 8px">Email Verified</span>': '<span class="label label-warning" style="padding:6px 8px">Email Not Verified</span>';  ?> &nbsp;&nbsp;<?php echo $mystatus;?></div>
        <div class="row-fluid " style="background-color:">
        <div class="span8">  
		  <div class="span6">
            <h3>School Profile <a href="#" class="btn-edit-staff-profile btn btn-default btn-small" title="Edit Profile detail"> Edit this <i class="icon-pencil"></i></a></h3>
            <hr /><p> <em>Entry Year</em>: <strong>(<?php echo $entry; ?>)</strong></p>
			<p> <em>School</em>: <strong><?php echo $school;?></strong> </p>
            <!--<p><em>Class Room</em>: <strong>SS3 A</strong></p>-->
            <p>&nbsp;</p>

          </div>
          <div class="span6">
            <h3>Teaching Profile </h3>
            <hr /><p>Class: <?php echo $staff_class.' '.$staff_class_main;?></p>
			<p>Class Room: <?php echo $staff_class_room;?></p>

            <p>Students:<?php echo $total_students;?></p>
          </div>
		  
		  <hr />
		  <div class="span11">
		  <?php include ('div_admin/ultimate_staff_profile_completion_plugin.php') ?>
			<p> Profile Completion: (<?php print $ProfileComplete ?>%)
			<div class="progress progress-striped progress-<?php print $bootstrapIdentifier ?> active">
				<div class="bar" style="width: <?php print $ProfileComplete ?>%;"></div>
			</div></p>
			<p>
			
			<?php echo ($status == $code)? $myp->AlertInfo('', 'Staff Forced to verify Email'): ($status == 1)? $myp->AlertInfo('', 'This Staff Can log in. Email Verified'): $myp->AlertError('', 'Cannot Log In. Email Not Verified. Code: '.$status);  ?> 
			</p>
				<dl><dd>Registered 0n: <?php echo $entry;?></dd>
					<dd>Last login Date: <?php echo $last_log;?></dd>
			  </dl>
		  </div>
		  
		</div>  
		
          <div class="span4">
            <div class="well">
            <center> <font color="#999999">Official Photo</font></center><br />
              <h2><a href="../../pictures/<?php echo $picture;?>" title="<?php echo $fname;?>'s profile photo" class="fancybox fancybox.image">
			  <img src="../../pictures/<?php echo $picture;?>" alt="<?php echo $fname; ?>'s picture will display here when uploaded" width="180px" /></a></h2>
			              <center><p style="margin:5px 0"><a href="#" class="btn-edit-photo btn btn-default btn-small" title="Edit this photo"> Edit Photo<i class="icon-pencil"></i> </a></p></center>
				</div>
          </div>
		  
        </div>
		
		<div style="margin-left:2px;" align="right"><a href="#" class="btn-edit-staffallname btn btn-default btn-small">Edit Basic Profile <i class="icon-pencil"></i></a></div>
        <div class="row-fluid">
          <div class="span12">

            <table width="100%" border="0" class="table table-striped table-bordered bootstrap-datatable">
              <tr>
                <td width="20%">Surname:</td>
                <td width="60%"><strong><?php echo $lname;?> </strong></td>
                <td width="20%">&nbsp;</td>
              </tr>
              <tr>
                <td>First name </td>
                <td><strong><?php echo $fname;?> </strong></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Middle name </td>
                <td><strong><?php echo $mi;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Ethnicity</td>
                <td><strong><?php echo $ethnicity;?></strong></td>
                <td><p class="btn btn-default btn-small"><font color="red">!</font> Details </p></td>
              </tr>
              <tr>
                <td>Birth <i>d/m/y</i> </td>
                <td><strong><?php echo $birth;?> </strong> </td>
                <td><p class="btn btn-default btn-small"><font color="red">!</font> View Calendar </p></td>
              </tr>
              <tr>
                <td>Birthcity</td>
                <td><strong><?php echo $birth_city;?></strong></td>
                <td><p class="btn btn-default btn-small"><font color="red">!</font> View Map </p></td>
              </tr>
              <tr>
                <td>State</td>
                <td><strong><?php echo $state;?></strong></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Nationality</td>
                <td><strong><?php echo $country;?></strong></td>
                <td>&nbsp;</td>
              </tr>
             
            </table>
            <div style="margin-left:2px;" align="right"><a href="#" class="btn-edit-staff-contact btn btn-default btn-small">Edit Contact Information <i class="icon-pencil"></i></a></div>
            <table width="100%" border="0" class= "table table-striped table-bordered bootstrap-datatable">
              <tr>
                <td width="20%">Phone</td>
                <td width="60%"><?php echo $mobile;?></td>
                <td width="20%"><p class="btn btn-default btn-small"><font color="red">!</font> Place Call </p></td>
              </tr>
              <tr>
                <td>Email</td>
                <td><?php echo $email;?></td>
                <td><p class="btn btn-default btn-small"><font color="red">!</font> Send Message </p> </td>
              </tr>
              <tr>
                <td>Address</td>
                <td><?php echo $address;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Resident Town </td>
                <td><?php echo $town;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Resident State </td>
                <td><?php echo $res_state;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
            <div style="margin:0 2px 2px 0;" align="right"><a href="#" class="btn-edit-staff-kin btn btn-default btn-small">Edit Next of Kin Information <i class="icon-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
            <table width="100%" border="0" class= "table table-striped table-bordered bootstrap-datatable">
              <tr>
                <td width="20%">Name</td>
                <td width="60%"><strong><?php echo $kin;?></strong></td>
                <td width="20%"><p class="btn btn-default btn-small"><font color="red">!</font> Tools </p></td>
              </tr>
              <tr>
                <td>Phone</td>
                <td><?php echo $kin_phone;?></td>
                <td><p class="btn btn-default btn-small"><font color="red">!</font> Place Call </p></td>
              </tr>
              <tr>
                <td>Address</td>
                <td><?php echo $kin_adress;?></td>
                <td><p class="btn btn-default btn-small"><font color="red">!</font> View Map </p></td>
              </tr>
              <tr>
                <td>Email</td>
                <td><?php echo $kin_email;?></td>
                <td><p class="btn btn-default btn-small"><font color="red">!</font> Send Mail </p></td>
              </tr>
              <tr>
                <td>Relationship</td>
                <td><?php echo $kin_relationship;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
            
            <div style="margin-left:2px;" align="right"><a href="#" class="btn-edit-staff-bank btn btn-default btn-small">Edit Bank Details <i class="icon-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
            </p>
            <table width="100%" border="0" class= "table table-striped table-bordered bootstrap-datatable">
              <tr>
                <td width="20%">Salary Scale </td>
                <td width="60%"><strong><?php echo $sal_scale;?></strong></td>
                <td width="20%"><p class="btn btn-default btn-small"><font color="red">!</font> Tools </p></td>
              </tr>
              <tr>
                <td>Bank</td>
                <td><?php echo $bank;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Account Number </td>
                <td><?php echo $account;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Account Name </td>
                <td><?php echo $acc_name;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Account Type </td>
                <td><?php echo $act_type;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Bank Sort Code </td>
                <td><?php echo $bank_sort;?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Total Salary Received </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>

			<div class="tooltip-demo well">
              <p class="muted" style="margin-bottom: 0;">About <?php echo $fname;?></p>
              <p class="muted"><?php echo $biography;?> </p>
              <p class="muted"><button class="btn-pro-print">Print profile</button>&nbsp;&nbsp;<button class="btn-pro-export"><?php echo $fname;?>'s Documents</button>&nbsp;&nbsp;<button class="btn-pro-send"><?php echo $fname;?>'s Biography</button>
              </p>
		</div>
          </div>
        </div>
      </div>
    </div>
    <!--/span-->
	
	
	
      
    <p>
      <!--/span-->
    </p>
    <div class="box span3" align="right">
      <div class="box-header well" data-original-title="data-original-title">
        <h2><i class="icon-list-alt"></i>Class Perfomance <font color="red">!</font></h2>
       
      </div>
      <div class="box-content">
        <div id="donutchart" style="height: 300px;"> </div>
      </div>
    </div>
    <p>&nbsp; </p>
    <div class="box span3">
      <div class="box-header well" data-original-title="data-original-title">
        <h3>Teacher Reports <font color="red">!</font></h3>
      </div>
      <div class="box-content">
        <ol>
          <li>Published Results <font color="red">!</font></li>
			<li>Class Profile <font color="red">!</font></li>
			<li>Exam Marking Schemes <font color="red">!</font></li>
			<li>Detail Salaries <font color="red">!</font></li>
			<li>Biography <font color="red">!</font></li>
			<li>Resume <font color="red">!</font></li>
        </ol>
      </div>
    </div>
	
	
	  <div class="box span3">
      <div class="box-header well" data-original-title="data-original-title">
        <h3>Demographics <font color="red">!</font></h3>
      </div>
      <div class="box-content">
        <ol>
          <li>Attendance <font color="red">!</font></li>
		   <li>Health <font color="red">!</font></li>
          <li>Item Order <font color="red">!</font></li>
          <li>Book Orders <font color="red">!</font></li>
        </ol>
      </div>
    </div>
	
	
	
    <!--/span-->
    <div class="box span3">
      <div class="box-header well" data-original-title="data-original-title">
        <h3>Activities Spy <font color="red">!</font></h3>
      </div>
      <div class="box-content">
        <dl>
          <dd>Results Edit: Unknown <font color="red">!</font></dd>
		  <dd>Public Messaging: Inbox/Outbox </dd>
			<dt>&nbsp;</dt>
			<dt>Registration</dt>
          <dd>Registered 0n: <?php echo $entry;?></dd>
		   <dd>Last login 0n: <?php echo $last_log;?></dd>
        </dl>
      </div>
      <p></p>
    </div>
    <!--/span-->
  </div>
  <!--/row-->
  <!-- content ends -->
  <p>&nbsp;</p>

  <p>&nbsp;</p>
</div>




<div>

	
	<?php include('staffpop.php');?>
	
