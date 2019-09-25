<?php 
$title="Parents' child request";
// this page will use web_parents not web_users
// throw the idiot away when he access this page without permission/ directly
include('tools/secure.php');

include_once "../includes/common.php";

// config
include_once "../includes/configuration.php";

// count number students
$biototal = $kas_framework->countAll('parent_to_kids');
	// since we are displaying 1000 only
	if($biototal > 1000){
	//echo "its above 10000";
	$break_p = round($biototal/1000);
	// so we have $break_p number of page groups
	// collect the page group from url
	@$groupid = $_GET['break_p'];
	// then we loop the page grout in a page grouping link
	}// end if card is more than a thousand
		// start working again
		if(isset($_GET['break_p'])){// this is only set when quantity is greater than 1000
		// for $groupid = 0, 0-1000, 1, 1000-2000, 2 2000- 3000, 3 3000-4000s
		  	 $sort_srt = $groupid*1000;}else{
		 ///$groupid
		 // where should the sorting start
		 $sort_srt = 0; 
		 }// end for wallet

if(isset($_POST['takeaction'])){
	$student = $_POST['student'];
	$parent = $_POST['parent'];
	$row = $_POST['row'];
	$parentname = $_POST['parentname'];
	$studentname = $_POST['studentname'];

	$dowhat = $_POST['takeaction'];


switch($dowhat){
	case 'aprove':
	$query= "UPDATE parent_to_kids SET confirmation = '1' WHERE student_id='$student' AND parent_to_kids_id='$row' AND confirmation='0'";
	$dbh_query = $dbh->prepare($query); $checkExec = $dbh_query->execute(); $dbh_query = null;
	if($checkExec){
		$myp->AlertSuccess('Good Job!', 'You successfully set '.$parentname.' as '.$studentname.'\'s Parent/Guardian');
	} else {
		$myp->AlertError('Heads up!', 'There is trouble with the action, you cannot work on parent deleted child');
	}
break;

case 'cancel':
	$query= "UPDATE parent_to_kids SET confirmation = '0' WHERE student_id='$student' AND parent_to_kids_id='$row' AND confirmation='1'";
	$dbh_query = $dbh->prepare($query); $checkExec = $dbh_query->execute(); $dbh_query = null;
	if($checkExec){
		$myp->AlertInfo('Good Job!', 'You successfully denied '.$parentname.' claims that '.$studentname.' is his/her child/spause');
	} else {
		$myp->AlertError('Heads up!', 'There is trouble with this action, you cannot work on parent deleted child');						
	}
break;

case 'delete':
	$query= "DELETE FROM parent_to_kids WHERE student_id='$student' AND parent_to_kids_id='$row' ";
	$dbh_query = $dbh->prepare($query); $checkExec = $dbh_query->execute(); $dbh_query = null;
	if($checkExec){
		$myp->AlertInfo('Good Job!', ' You successfully deleted '.$parentname.'\'s request that he/she is '.$studentname.'\'s Parent. To set this action again, parent must login and choose/select his child.');						
	} else {
		$myp->AlertError('Heads up!', 'There is trouble with the database');						
	}
break;
default:
	$myp->AlertError('Legs up!', 'Oh snap! we got corn fussed?');						
}

}

?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i> Parents and their Kids
        <?php //echo $db_name;?>
      </h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> </div>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr>
            <th>S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th>Parent name</th>
            <th>Parent username</th>
            <th>Requested Child</th>
            <th>Status</th>
            <th>Child Image</th>
             <th>Username</th>
            <th>Action</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody>
          <?php
				 
			$pullassout = "SELECT * FROM parent_to_kids AS ptk, student_parents AS sp WHERE ptk.parent_id = sp.student_parents_id ORDER BY ptk.confirmation DESC LIMIT $sort_srt, 1000";
			$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
			$sn = 0;
				while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {

					$sn = $sn + 1;
					$rowid = $std['parent_to_kids_id'];
					$parentid = $std['parent_id'];
					$student_id = $std['student_id'];
					$confirmation = $std['confirmation'];

							//get the idiot username from web_students
					$std_user=$kas_framework->getValue('user_n', 'web_students', 'stdbio_id', $student_id);
					$parent_user= $kas_framework->getValue('web_parents_username', 'web_parents', 'web_parents_relid', $parentid);

					$parent_fname= $std['student_parents_firstname'];
					$parent_lname= $std['student_parents_lastname'];
					$std_fname=$kas_framework->getValue('studentbio_fname', 'studentbio', 'studentbio_id', $student_id); 
					$std_lname=$kas_framework->getValue('studentbio_lname', 'studentbio', 'studentbio_id', $student_id); 
					$picture= $kas_framework->getValue('studentbio_pictures', 'studentbio', 'studentbio_id', $student_id);
			
			if($picture == ''){
				$picture = 'avatar_default.png';
			}

			 if($confirmation =='1'){
				$mystatus = '<span class="label label-success" style="padding:8px 6px">Approved</span>';
			 //label-warning for pending
			 }else if($confirmation =='0'){	
				$mystatus = '<span class="label label-info" style="padding:8px 6px">Requested by Parent</span>';
			 }else if($confirmation =='2'){
				$mystatus = '<span class="label label-important" style="padding:8px 6px">Deleted by Parent</span>';
			 }else{
				$mystatus = '<span class="label label-important" style="padding:8px 6px">Unknown</span>';
			 }
			
		  ?>
          <tr>
            <td><?php echo $sn;?></td>
            <td><i class="icon icon-color icon-user"></i><?php echo $parent_fname.' '.$parent_lname;?> </td>
            <td class="center"><?php echo $parent_user;?></td>
            <td class="center"><?php echo $std_lname.' '.$std_fname;?> </td>
            <td class="center"><?php echo $mystatus;?> </td>
            <td class="center"><div id="image"><a href="../../pictures/<?php echo $picture;?>" title="Image of <?php echo $std_user;?>" class="fancybox fancybox.image" />&nbsp;&nbsp;<img id="community" title="Profile Photo" src="../../pictures/<?php echo $picture;?>" alt="none" align="" style=" width:60px" /></a></div></td>
            <td> <?php echo $std_user;?></td>
            <td class="center"><?php
			 if($confirmation !='1'){?>
              <form action="" method="post">
                <input type="hidden" name="takeaction" value="aprove" />
                <input type="hidden" name="parent" value="<?php echo $parentid;?>" />
                <input type="hidden" name="student" value="<?php echo $student_id;?>" />
                <input type="hidden" name="row" value="<?php echo $rowid;?>" />
                <input type="hidden" name="parentname" value="<?php echo $parent_fname.' '.$parent_lname;?>" />
                <input type="hidden" name="studentname" value="<?php echo $std_fname;?>" />
                <input class="btn btn-info" type="submit" value="Aprove">
                <i class="icon icon-green icon-replyall"></i>
                </input>
              </form>
              <?php }else{?>
              <form action="" method="post">
                <input type="hidden" name="takeaction" value="cancel" />
                <input type="hidden" name="parent" value="<?php echo $parentid;?>" />
                <input type="hidden" name="student" value="<?php echo $student_id;?>" />
                <input type="hidden" name="row" value="<?php echo $rowid;?>" />
                <input type="hidden" name="parentname" value="<?php echo $parent_fname.' '.$parent_lname;?>" />
                <input type="hidden" name="studentname" value="<?php echo $std_fname;?>" />
                <input class="btn btn-warning" type="submit" value="Cancel">
                </input>
              </form>
              <?php }?>
            </td>
            <td class="center"><form action="" method="post">
                <input type="hidden" name="takeaction" value="delete" />
                <input type="hidden" name="parent" value="<?php echo $parentid;?>" />
                <input type="hidden" name="student" value="<?php echo $student_id;?>" />
                <input type="hidden" name="row" value="<?php echo $rowid;?>" />
                <input type="hidden" name="parentname" value="<?php echo $parent_fname.' '.$parent_lname;?>" />
                <input type="hidden" name="studentname" value="<?php echo $std_fname;?>" />
                <input class="btn btn-danger" type="submit" value="Delete">
                </input>
              </form></td>
          </tr>
          <?php }
				$dbh_pullassout = null;
		  ?>
        </tbody>
      </table>
      <?php
// start working ends, this is the third place worked


echo 'Total Requests: <strong>'.number_format($biototal).'</strong><br><br>';
	if($biototal > 1000){
		if(!isset($_GET['break_p'])){$groupid=1;}
			echo '<br>You now have large number of students in your db; total: '.$biototal.' we have put them into page groups, the ones bellow are more of them <br><br><br> Viewing page group:'.'<strong>'.$groupid.'</strong>'.'<br>';
	// then we loop the page grout in a page grouping link
	for($bp = 1; $bp <= $break_p; $bp++){
		echo '<a href="main?page=parent_child&break_p='.$bp.'">PG'.$bp.' </a>&raquo;';	
	}// end for loop

}// end biototal is 1000
?>
    </div>
  </div>
  <!--/span-->
</div>
<p>&nbsp;</p>