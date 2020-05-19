
<?php 

// dont come here directly
if (!defined ('DIRECT_PASS')){echo 'who are you? HAHAHA, WHAT ARE YOU DOING, ARE YOU A HACKERS TOO?';
//header ("Location: ../../index.php?action=notauth");
	exit;} 

$current_sess = $_SESSION['CurrentYear'];
$current_sessname= $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $current_sess);

?>


  <?php if(isset($_GET['edit'])){?>
  <div align="center" style="box-shadow:5px 5px 40px #CCC; width:320px; margin:0 auto; padding:12px">

<?php 
//collect room to edit
$roomeditid = $_GET['id'];
$edit_roomname = $kas_framework->getValue('school_rooms_desc', 'school_rooms', 'school_rooms_id', $roomeditid);
//$edit_roomname =$db->get_var("SELECT school_rooms_desc FROM school_rooms WHERE school_rooms_id='$roomeditid'");//


?>
<i> To assign Room teacher, Edit Staff Profiles</i>

  <form method="post" action=""> 
  Room name:  <input type="text" name="editroomname" value="<?php echo $edit_roomname;?>" placeholder="" />
  <br />
  Grade/Class: 
	<select name="editroomgrade" disabled="disabled" id="label" style="width:250px">
		  <?php    $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id', $edit_roomname);  ?>
	</select><br />
  <input type="submit" class="btn btn-sm btn-default" value="Save Changes" />
  </form>

<?php if(isset($_POST['editroomname'])){
// update the room name

$editroomname = $_POST['editroomname'];
//$editroomgrade = $_POST['editroomgrade'];


	$jokee =  "UPDATE school_rooms SET school_rooms_desc = '$editroomname' WHERE school_rooms_id = '$roomeditid'";
	$dbh_jokee = $dbh->prepare($jokee); $checkExec = $dbh_jokee->execute(); $dbh_jokee = null;
	//ultimate keliv worked here
	if ($checkExec) {
		$myp->AlertSuccess('Nice! ', 'Room has been Updated');
	} else {
		$myp->AlertError('Error! ', 'Room could not be Updated. No changes made.');
	}
}

?>

</div>

<?php } ?>


  <?php if(isset($_GET['action'])){?>
 <div align="center" style="background-color:#D2F9F0">
 
 <?php 
 // collect the room id
 $myrmmid = $_GET['id'];
 // check if the room is assigned to anybody
 $check_occupant = $kas_framework->countRestrict1('student_grade_year', 'student_grade_year_class_room', $myrmmid); 
  $check_occupants = $kas_framework->countRestrict1('teacher_grade_year', 'grade_class_room', $myrmmid);

 if($myrmmid ==0){ //ultimate keliv worked here
	echo '<font color="red">You cannot Delete Generic room, LOL </font>';
 } else if($check_occupant > 0 || $check_occupants > 0){
	$myp->AlertError('Error! ', 'Thats not going to work. Students/Teachers are in this room, you remove students before delete room');
} else {
	$sSQL = "DELETE FROM school_rooms WHERE school_rooms_id = '$myrmmid'";
	$dbh_sSQL = $dbh->prepare($sSQL); $checkExec = $dbh_sSQL->execute(); $dbh_sSQL = null;
		if ($checkExec == 1) {
			$myp->AlertSuccess('Good! ', 'Room has been Deleted');
		  } else {
			$myp->AlertError('Problem! ', 'The Room could not be Deleted');
		  }
 }

 ?> 
</div>
<?php }

 if(isset($_GET['addnew'])){?>
   
<div align="center" style="box-shadow:5px 5px 40px #CCC; width:320px; margin:0 auto; padding:12px">
   <strong>   Add New Rooms</strong> 
  <form method="post" action=""> 
  Room name:  <input type="text" name="roomname" value="" placeholder="eg: SS2A" />
  <br />
  Grade:   <select name="roomgrade" id="label" style="width:250px">
	  <?php 
	  $loopmygd = $dbh->prepare("SELECT * FROM grades ORDER BY grades_id");
	  $loopmygd->execute();
	   while ($gdlist = $loopmygd->fetch(PDO::FETCH_ASSOC)) {?>
		  <option value="<?php echo $gdlist['grades_id'];?>"><?php echo $gdlist['grades_desc'];?> </option>
		  <?php
   
   }
   ?>
                </select><br />
  
  <input type="submit" class="btn btn-sm btn-default" value="Create Room" />
  </form>
  
  <?php if(isset($_POST['roomname'])){
		// validate the form
		if(strIsEmpty($_POST['roomname'])){
			$myp->AlertError('Strange! ', 'What is the Room Name?');
		} else {
			$roomname = $_POST['roomname'];
			$roomgrade = $_POST['roomgrade'];

			// insert the rooms names
			$postinside = "INSERT INTO school_rooms(school_rooms_desc,room_grade) VALUES('$roomname','$roomgrade')";
			$dbh_postinside = $dbh->prepare($postinside); $checkExec = $dbh_postinside->execute(); $dbh_postinside = null;
				//upgraded by Ultimate Kelvin C - Kastech
				if ($checkExec) {
					$myp->AlertSuccess('Nice Job! ', 'Room Created Succesfully');
				} else {
					$myp->AlertError('Error! ', 'Room creation failed');
				}
			}
		}
	?>
  <br />
   </div>
   
<?php }?>

<div style="margin-left:30px">
       
  <a href="?page=administrative&tool=class&addnew=true" class="btn btn-default btn-large"><strong>Add New Sub Class/Room </strong></a>
  <a href="main?page=administrative&tool=class" class="btn btn-default btn-large"><strong>View Sub Class Rooms  </strong></a><br />
	  
	  <?php
		if(!isset($_GET['gid'])){
			$cardgrade = '1';
			} else {
			$cardgrade = $_GET['gid'];
			}
			
			$gradename = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $cardgrade);		
	  	  	//upgraded by Ultimate Kelvin C - Kastech
			
		  $queryj = "select * from grades";
		  $dbh_queryj = $dbh->prepare($queryj); $dbh_queryj->execute();  $mygrade = $dbh_queryj->rowCount();
			while ($get_grades = $dbh_queryj->fetch(PDO::FETCH_OBJ)) {
				print '<a class="btn btn-sm btn-default" style="margin:4px" href="main?page=administrative&tool=rooms&gid='.$get_grades->grades_id.'">'.$get_grades->grades_desc.'</a>';
			}
			$dbh_queryj = null;
		  ?>
</div>


<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>School Class Rooms <?php //echo $db_name;?></h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div> </div>
	  	  &nbsp;&nbsp;<i>All grades already have a class room by default. only add room if you have classes A,B,C like SS1A, SS1B. if you have only one class, no need to add rooms </i> 
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr bgcolor="">
            <th width="4%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="13%">Session</th>
            <th width="12%">Room Name</th>
            <th width="12%">Class Room Teacher </th>
            <th width="12%">Room Grade </th>
            <th width="12%">Total Students </th>
            <th width="12%">Action</th>
          </tr>
        </thead>
        <tbody>
         
 <?php
	$pulldays = "SELECT * FROM school_rooms ORDER BY school_rooms_id";
		$dbh_pulldays = $dbh->prepare($pulldays); $dbh_pulldays->execute(); 
		
		$sn = 0;
		while ($qty = $dbh_pulldays->fetch(PDO::FETCH_ASSOC)) {

		$sn = $sn + 1;
		$myroom_id = $qty['school_rooms_id'];
		$myroom_name = $qty['school_rooms_desc'];
		$myroom_grade = $qty['room_grade'];
		
		// count students in that room
		$total_kids = $kas_framework->countRestrict3('student_grade_year', 'student_grade_year_year', $current_sess, 'student_grade_year_grade', $myroom_grade, 'student_grade_year_class_room', $myroom_id);
		$myroom_grade= $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $myroom_grade); 
		
		$teacherSQL = "SELECT teacher FROM teacher_grade_year WHERE session='$current_sess' AND main_teacher='1' AND grade_class_room ='$myroom_id'";//
		$dbh_teacher = $dbh->prepare($teacherSQL); $dbh_teacher->execute(); $fetchObj = $dbh_teacher->fetch(PDO::FETCH_OBJ); $dbh_teacher = null;
		$teacher = $fetchObj->teacher;
		
		$teacher_id= $kas_framework->getValue('staff_id', 'staff', 'staff_id', $teacher);
		$teacher_name= '<a href="main?page=view_staff&id='.$teacher_id.'" target="_blank">'.$kas_framework->getValue('staff_lname', 'staff', 'staff_id', $teacher).'
		 '.$kas_framework->getValue('staff_fname', 'staff', 'staff_id', $teacher).'</a>';//
?>
		 
		  <tr bgcolor="">
			<td><?php echo $sn;?></td>
            <td><?php echo $current_sessname;?> </td>
            <td class="center"><?php echo $myroom_name;?></td>
            <td class="center"><?php echo $teacher_name;?></td>
            <td class="center"><?php echo $myroom_grade;?></td>
            <td class="center"><?php print $total_kids  ?></td>
            <td class="center"><a title="You cannot view more of this profile" class="btn btn-success" href="main?page=administrative&tool=class&edit=true&id=<?php echo $myroom_id;?>"> <i class="icon-zoom-in icon-white"></i>Edit  </a> 
			
			<a title="You cannot view more of this profile" class="btn btn-danger" href="main?page=administrative&tool=class&action=delete&id=<?php echo $myroom_id;?>"> <i class="icon-zoom-in icon-white"></i>Delete  </a>
			</td>
          </tr>
		  
		  <?php }
			$dbh_pulldays = null;
		  ?>
        </tbody>
      </table>

    </div>
  </div>
<br /><br />
</div>