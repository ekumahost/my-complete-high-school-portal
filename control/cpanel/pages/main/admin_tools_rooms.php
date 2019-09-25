<?php $title="Class Rooms";
$current_year=$_SESSION['CurrentYear'];
$cardterm = $_SESSION['CurrentTerm'];
?>
<div style="margin-left:30px">
       
  <a href="?page=administrative&tool=class&addnew=true" class="btn btn-default btn-large"><strong>Add New Sub Class/Room </strong></a>
  <a href="main?page=administrative&tool=class" class="btn btn-default btn-large"><strong>View Sub Class Rooms </strong></a><br />
	  
	  <?php
		if(!isset($_GET['gid'])){
				$cardgrade = '1';
				} else {
				$cardgrade = $_GET['gid'];
				}
		
	$gradename= $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $cardgrade);	
	  	  
	  $queryj = "select * from grades";
	  $dbh_queryj = $dbh->prepare($queryj); $dbh_queryj->execute(); $mygrade = $dbh_queryj->rowCount();
	  
		//upgraded by Ultimate Kelvin C - Kastech
		while ($get_grades = $dbh_queryj->fetch(PDO::FETCH_OBJ)) {
			print '<a class="btn btn-sm btn-default" style="margin:4px" href="main?page=administrative&tool=rooms&gid='.$get_grades->grades_id.'">'.$get_grades->grades_desc.'</a>';
		}
	  $dbh_queryj = null;
	  ?>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>Add students to a class room grade<strong><?php echo $cardgrade.' &raquo; '.$gradename;?></strong> </h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr>
            <th width="2%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="21%">Student</th>
            <th width="9%">Denomination</th>
            <th width="16%">Old Class room </th>
            <th width="44%">Asign new room </th>
            <th width="8%">Report card </th>
          </tr>
        </thead>
        <tbody>
         
		         <?php
				
				
	// count number students in the selected grade
$biototal = $kas_framework->countRestrict2('student_grade_year', 'student_grade_year_year', $current_year, 'student_grade_year_grade', $cardgrade);
	// since we are displaying 100 only
	if($biototal > 100){
	//echo "its above 10000";
	$break_p = round($biototal/100);
	// so we have $break_p number of page groups
	// collect the page group from url
	@$groupid = $_GET['break_p'];
	// then we loop the page grout in a page grouping link
	}// end if card is more than a thousand
 // start working again
		  	if(isset($_GET['break_p'])){// this is only set when quantity is greater than 1000
// for $groupid = 0, 0-1000, 1, 1000-2000, 2 2000- 3000, 3 3000-4000s
		  	 $sort_srt = $groupid*100;}else{
		 ///$groupid
		 // where should the sorting start
		 $sort_srt = 0; 
		 }// end for wallet		
				
	$pullassout = "SELECT * FROM student_grade_year AS sgy, studentbio AS s WHERE sgy.student_grade_year_student = s.studentbio_id AND sgy.student_grade_year_year = '$current_year' AND sgy.student_grade_year_grade = '$cardgrade' ORDER BY sgy.student_grade_year_id DESC LIMIT $sort_srt, 100";
		$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
			$num = 0;
			while ($std =$dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {
					$num = $num + 1;
					$sn = $std['student_grade_year_student'];				
					$grade_year_id = $std['student_grade_year_id'];// culon

					$sn_room = $std['student_grade_year_class_room'];
					$regno= $std['studentbio_internalid'];
					$myfirstn= $std['studentbio_fname'];
					$mylastn= $std['studentbio_lname'];
					$gender=$std['studentbio_gender']; 
					$denomination= $kas_framework->getValue('denomination', 'web_students', 'stdbio_id', $sn);
					$prev_yr = $current_year-1;
					$sn_oldroom = $kas_framework->getValueRestrict2('student_grade_year_class_room', 'student_grade_year', 'student_grade_year_student', $sn, 'student_grade_year_year', $prev_yr);
					//added by the ultimate keliv
					$stdclassroom = $kas_framework->getValue('student_grade_year_class_room', 'student_grade_year', 'student_grade_year_student', $sn);
					$std_current_room=$kas_framework->getValue('school_rooms_desc', 'school_rooms', 'school_rooms_id', $stdclassroom);
					$std_old_room= $kas_framework->getValue('school_rooms_desc', 'school_rooms', 'school_rooms_id', $sn_oldroom); 
					$std_room= $kas_framework->getValue('school_rooms_desc', 'school_rooms', 'school_rooms_id', $sn_room);
					$denomination=$kas_framework->getValue('deno', 'tbl_std_denomination', 'id', $denomination);

		  ?>
		 	
	<script>
// this ajax script is going to process looped form in table, for comments
// we are looping this script, this must be a bad pratise
$(document).ready(function()
{
	
	$("#simple<?php echo $sn;?>").click(function()
{
	$("#ajaxform<?php echo $sn;?>").submit(function(e)
	{
	//$('#simple').val().submit(function()
	//$("#ajaxform1").submit(function(e)
	//{
	//$('#simple-msg').show();
		$("#simple-msg<?php echo $sn;?>").html("<img src='ajax/profile/ajax-loader.gif'/>");
		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");
		$.ajax(
		{
			url : "ajax/profile/grade_rooms.php?id=<?php echo $sn;?>",
			type: "POST",
			data : postData,
			success:function(data, textStatus, jqXHR) 
			{
				$("#simple-msg<?php echo $sn;?>").html(''+data+'');

			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
				$("#simple-msg<?php echo $sn;?>").html('<font color="red">Failed to asign<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</font><span class="icon icon-color icon-close"></span>');
			}
		});
	    e.preventDefault();	//STOP default action
	    e.unbind();
	});
		
	$("#ajaxform<?php echo $sn;?>").submit(); //SUBMIT FORM
});


});
</script>
		  <tr>
			<td><?php echo $num;?></td>
            <td><i class="icon icon-color icon-user"></i><a href="main?page=view_users&id=<?php echo $sn;?>" target="_blank">
			<?php print $std_current_room .': <br />' ?>
			<?php echo $mylastn.' '.$myfirstn.'--'.$regno;?></a> <br /><br />
			Current Room: <?php print $std_current_room ?></td>
            <td class="center"><?php echo $std_old_room;?> <?php echo $denomination;?></td>
            <td class="center"><?php echo $std_old_room;?></td>
            <td class="center">
		
			<!-- $sn is the report card id in db -->
			<form name="ajaxform" id="ajaxform<?php echo $sn;?>" action="" method="POST">

			<input type="hidden" value="<?php echo $current_year;?>" name="ccyear" />
			<input type="hidden" value="<?php echo $grade_year_id;?>" name="grade_yr_id" />

			<p>Choose Room:<br />
			<select name="roomie<?php echo $sn;?>" id="label" style="width:250px">
			<option value="0">Generic Hall</option>
                  <?php  $kas_framework->getallFieldinDropdownOptionWithRestriction('school_rooms', 'school_rooms_desc', 'room_grade', $cardgrade, 'school_rooms_id', $sn_room); ?>
				</select> <a href="main?page=administrative&tool=class&addnew=true">Create More Room</a>
			<br />
			<input type="button"  id="simple<?php echo $sn;?>" class="submit" value="Asign to class room" />

			<div id="simple-msg<?php echo $sn;?>"></div></p>
			</form>			</td> 
            <td class="center"><a title="View <?php echo $myfirstn;?>'s class mates" class="btn btn-success" href="main?page=administrative&tool=class" target="_blank"> <i class="icon-zoom-in icon-white"></i> Class mates </a><br /><br />
			</td>
          </tr>
		  	  
	  <?php } 
		$dbh_pullassout = null;	
	  ?>
        </tbody>
      </table>
	  
	    <?php
// start working ends, this is the third place worked
	echo 'Total Student in Class: <strong>'.$biototal.'</strong><br><br>';
	if($biototal > 100){
		if(!isset($_GET['break_p'])){$groupid=1;}

	echo '<br>You may still have work to do down here. You now have large number of students in your db; total: '.$biototal.' we have put them into page groups, the ones bellow are more of them <br><br><br> Viewing page group:'.'<strong>'.$groupid.'</strong>'.'<br>';
	// then we loop the page grout in a page grouping link
	for ($bp = 1; $bp <= $break_p; $bp++){
		echo '<a href="main?page=administrative&tool=rooms&break_p='.$bp.'$gid='.$cardgrade.'">PG'.$bp.' </a>&raquo;';
	}// end for loop

}// end biototal is 1000

?>
    </div>
  </div>
  <!--/span-->
</div>