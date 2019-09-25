<?php 
$title="Reports Cards Comments";


if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}

include_once "../includes/common.php";
//Initiate database functions
include_once "../includes/ez_sql.php";
// config
include_once "../includes/configuration.php";

?>
<div style="margin:0 20px 0 20px">
  <p align="right"><a class="btn btn-small" href="year_simulator" target="_blank"><strong>Simulate/Change Term</strong> </a>&nbsp;&nbsp;&nbsp;&nbsp;
  <a class="btn btn-small" href="year_simulator" target="_blank"><strong>Simulate/Change Session</strong> </a>&nbsp;&nbsp;&nbsp;&nbsp;</p>

             <?php   
$current_year=$_SESSION['CurrentYear'];
$cardterm = $_SESSION['CurrentTerm'];
			 if(isset($_GET['report_init'])){
			 // check if the report card is created
			 $querylr =query("select * from std_report_cards WHERE session = '$current_year' AND term = '$cardterm'");
							$ckeckerr = mysql_num_rows($querylr);
							if($ckeckerr > 0){echo '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong>Something is wrong!</strong> What are you doing, click on logo above.
						</div>';}else{
			 
// the admin wants to initilalize the report card

// get the id of all student in current year from student grade year table

$set_report = mysql_query("INSERT INTO std_report_cards (student,session,grade,term) SELECT student_grade_year_student,student_grade_year_year,student_grade_year_grade,$cardterm AS student_grade_year_id FROM student_grade_year WHERE student_grade_year_year = '$current_year'");

if($set_report){
	$myp->AlertSuccess('Well Done! ', 'You have successfully Initialized the report cards.');
} else {
	$myp->AlertError('Something is wrong! ', 'Please call admin.');
		}
 }
}

// check if the report card is initializec
$queryl =query("select * from std_report_cards WHERE session = '$current_year' AND term = '$cardterm'");
				$ckecker = mysql_num_rows($queryl);
				if($ckecker > 0){
				echo "<i>Report Card is Created for this term, if a particular student is not found, tell admin to add the student to report card</i>";
				} else {?>
		You are in Term. <?php echo $cardterm;?> Please Initialize report card for this term before commenting. <a class="btn btn-small" href="results?page=report_cards&report_init=yes"><i class="icon-star"></i>Initialize Now</a>		
			<?php }				

?>
<br />
<br />

  <p>You are commenting in the current Term/Session. To Comment in other Terms, you must simulate the term or session so that the portal will asume you are currently in that session or term. Select Simulate from the right to start. Note: You after simulating, you must refresh this page for the changes to take effect. </p>

  <?php if($_SESSION['UserType'] != 'X') { // if not principal 
	 $myp->AlertError('Sorry! ', 'You are not commenting here, Only Principal thanks');
  }
  
	 $queryj = query("select * from grades");	  
		//upgraded by Ultimate Kelvin C - Kastech
		while ($get_grades = mysql_fetch_object($queryj)) {
			print '<a class="btn btn-sm btn-default" style="margin:4px" href="results?page=report_cards&gid='.$get_grades->grades_id.'">'.$get_grades->grades_desc.'</a>';
		}
	    
	     // collect some important variables
				$current_year=$_SESSION['CurrentYear'];
				$cardterm = $_SESSION['CurrentTerm'];
                if(!isset($_GET['gid'])){
					$cardgrade = '1';
				}else{
					$cardgrade = $_GET['gid'];
				}
				
		$gradename= $db->get_var("SELECT grades_desc FROM grades WHERE grades_id='$cardgrade'");//		
?>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>Students Report Cards/Comments for grade <strong><?php echo $cardgrade.' &raquo;'.$gradename.' ('.$cyear.' &nbsp;&nbsp;Term'.$cardterm.' )';?></strong> </h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr>
            <th>S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th>Surname</th>
            <th>Class</th>
            <th><a href="#" title="Active means student can log in">Status</a></th>
            <th>Student Detail <i class="icon icon-color icon-arrow-n-s"></i></th>
            <th><a title="Click here twice to arrange in possitions, first will come up.">Position Average</a> </th>
            <th> Term <?php echo $cardterm;?> Result</th>
            <th>Report card </th>
          </tr>
        </thead>
        <tbody>
         
		         <?php
				
				
	// count number students
	$querybio=query("SELECT * FROM std_report_cards WHERE session = '$current_year' AND term = '$cardterm' AND grade = '$cardgrade'");
	$nothing = NULL;
	// how many have been signed
$querybiosigned=query("SELECT * FROM std_report_cards WHERE session = '$current_year' AND term = '$cardterm' AND grade = '$cardgrade' AND c_principal != '$nothing'");
$biototalsigned =  mysql_num_rows($querybiosigned);

$biototal =  mysql_num_rows($querybio);
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
			
$pullassout = mysql_query("SELECT * FROM std_report_cards WHERE session = '$current_year' AND term = '$cardterm' AND grade = '$cardgrade' ORDER BY id DESC LIMIT $sort_srt, 100");
							
		$num = 0;

	//$sn = 0;
	while ($std = mysql_fetch_array($pullassout)) {
	$num = $num + 1;

// the main id
		$sn = $std['id'];
		$tbl_student = $std['student'];
		$tbl_session = $std['session'];
		$tbl_term = $std['term'];
		$tbl_grade = $std['grade'];
		$tbl_cteacher = $std['c_form_teacher'];
		$tbl_cprincipal = $std['c_principal'];
		
		
		$stdbio_id = $tbl_student; //reasigned to handle the ones bellow
		$regno=$db->get_var("SELECT studentbio_internalid FROM studentbio WHERE studentbio_id = '$stdbio_id'");//
		$myfirstn=$db->get_var("SELECT studentbio_fname FROM studentbio WHERE studentbio_id = '$stdbio_id'");//
		$mylastn=$db->get_var("SELECT studentbio_lname FROM studentbio WHERE studentbio_id = '$stdbio_id'");//
		 $mymiddlen=$db->get_var("SELECT studentbio_mname FROM studentbio WHERE studentbio_id = '$stdbio_id'");//
		 $gender=$db->get_var("SELECT studentbio_gender FROM studentbio WHERE studentbio_id = '$stdbio_id'");//


			//get the idiot username from web_students
	$username=$db->get_var("SELECT user_n FROM web_students WHERE identify='$regno'");//we can also use stdbio_id
	// select the idiots class at the current year // We should be able to echo 
	$std_grade_yr =$db->get_var("SELECT student_grade_year_grade FROM student_grade_year WHERE student_grade_year_student='$stdbio_id' AND student_grade_year_year = '$current_year'");//
			// so what is his grade now
				$std_grade =$db->get_var("SELECT grades_desc FROM grades WHERE grades_id='$std_grade_yr'");//
// what if the guy is graduate
				if($std_grade==NULL){$std_grade='<u>Graduate</u>';}


			
// get the student status
 				//$mystatus=$db->get_var("SELECT admin FROM web_students WHERE identify='$regno'");//we can also use stdbio_id

$mystatus=$db->get_var("SELECT admit FROM studentbio WHERE studentbio_id='$stdbio_id'");//we can also use stdbio_id
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


// select the student picture


$picture=$db->get_var("SELECT studentbio_pictures FROM studentbio WHERE studentbio_id='$stdbio_id'");//we can also use stdbio_id
if($picture==NULL){
$picture = 'avatar_default.png';
}
// the date of birth
$std_yob=$db->get_var("SELECT studentbio_dob FROM studentbio WHERE studentbio_id='$stdbio_id'");//we can also use stdbio_id

$age = date('Y') - (substr($std_yob, -4)+1);
//added by the ultimate keliv
$age = ($age > 100)? 'X': $age;

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
			url : "ajax/results/comment.php?id=<?php echo $sn;?>",
			type: "POST",
			data : postData,
			success:function(data, textStatus, jqXHR) 
			{
				$("#simple-msg<?php echo $sn;?>").html(''+data+'');

			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
				$("#simple-msg<?php echo $sn;?>").html('<font color="red">Failed to save<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</font><span class="icon icon-color icon-close"></span>');
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
            <td><i class="icon icon-color icon-user"></i><a target="_blank" title="View <?php echo $myfirstn;?>'s profile" class="" href="main?page=view_users&id=<?php echo $stdbio_id;?>"><?php echo $mylastn.', '.$mymiddlen.' '.$myfirstn;?></a>
			<br /><?php echo $age.' Years Old';?> (<?php echo $gender;?>) <br /> Reg:<?php echo $regno;?>
			</td>
            <td class="center"><?php echo $std_grade;?> </td>
            <td class="center"> <?php echo $mystatus;?></td>
            <td class="center"><div id="image"><a href="../../pictures/<?php echo $picture;?>" title="Image of <?php echo $username;?>" class="fancybox fancybox.image" ><img id="admission" title="<?php echo $mylastn.', '.$mymiddlen.' '.$myfirstn.'('.$regno.')';?> " src="../../pictures/<?php echo $picture;?>" alt ="No Image" style="height:80px;" align=""> </img></a></div>
            </td>
            <td class="center"><?php 
		
			//calculate the average
			// student is $tbl_student
			// session/term = $current_year/$cardterm
	// call the function that does the job and give him the student data
			GetStudentTermAverage($current_year,$cardterm,$tbl_student);
			?>
		
			</td>
            <td class="center">		
			<!-- $sn is the report card id in db -->
<form name="ajaxform" id="ajaxform<?php echo $sn;?>" action="" method="POST">
<p>
Form master Comment: <font color="green">
<?php 
// display the form master comment
$form_m_comment =$db->get_var("SELECT c_form_teacher FROM std_report_cards WHERE student = '$tbl_student' AND session = '$current_year' AND term='cardterm' AND grade='$cardgrade'");//
echo $form_m_comment;
?>
</font>
<br />
Comment:<br /> <input type="text" value="<?php echo $tbl_cprincipal;?>" placeholder="<?php echo $tbl_cprincipal;?>" style="width:200px" name="comment<?php echo $sn;?>" /> 	
<input type="button"  id="simple<?php echo $sn;?>" class="submit" value="Save" />
			<!-- collect the admin id to knw if he has right to comment -->
<input type="hidden" name="admin" value="<?php echo $_SESSION['UserID'];?>" />
			<!-- collect the admin usertype to knw if he has right to comment -->
<input type="hidden" name="admintype" value="<?php echo $_SESSION['UserType'];?>" />
<div id="simple-msg<?php echo $sn;?>"></div></p>
</form>			</td> 
            <td class="center"><a title="View <?php echo $myfirstn;?>'s profile" class="btn btn-success" href="main?page=view_users&id=<?php echo $stdbio_id;?>"> View_All </a><br /><br />
			<a title="View <?php echo $myfirstn;?>'s profile" class="btn btn-success" href="main?page=view_users&id=<?php echo $stdbio_id;?>"> Download </a>			</td>
          </tr>
	<?php } ?>
        </tbody>
      </table>
	  
	  
	    <?php
// start working ends, this is the third place worked
	echo '<font color="blue"><b>You have signed <b>'.$biototalsigned.'</b> out of <b>'.$biototal.'</b></b></font><br>';


echo 'Total Student to comment in this Grade: <strong>'.number_format($biototal-$biototalsigned).'</strong><br><br>';
	if($biototal > 100){
		if(!isset($_GET['break_p'])){$groupid=1;}

	echo '<br>You may still have work to do down here. You now have large number of students in your db; total: '.$biototal.' we have put them into page groups, the ones bellow are more of them <br><br><br> Viewing page group:'.'<strong>'.$groupid.'</strong>'.'<br>';
	
	
	// then we loop the page grout in a page grouping link
	for($bp = 1; $bp <= $break_p; $bp++){
		echo '<a href="results?page=report_cards&break_p='.$bp.'$gid='.$cardgrade.'">PG'.$bp.' </a>&raquo;';
	}// end for loop

}// end biototal is 1000


?>
  
    </div>
  </div>
  <!--/span-->
</div>
<p><strong><font color="#993300">How to see first position</font></strong>: The last in this least is the first position, Double click on Position Average to arrange as first position first</p>