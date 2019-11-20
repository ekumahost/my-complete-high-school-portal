<?php 
$title="Portal SPY";
  $atcfolder = "../../pictures/";
if (!defined('MYSCHOOLAPPADMIN_CORE')) {// if the user access this page directly, take his ass back to home 
	header('Location: ../../../index.php?action=notauth');
	exit;
}

include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";

$current_year = $_SESSION['CurrentYear'];


// count number of parents
$querybio= $kas_framework->countAll('student_post');

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
				 }// end for spy
				 


 if(isset($_GET['read'])){
$read_id = DecodeToken($_GET['read']);

$stuBio_Query = "SELECT studentbio_lname FROM studentbio WHERE studentbio_id='$poster__id'";
$dbh_stuBio_Query = $dbh->prepare($stuBio_Query); $dbh_stuBio_Query->execute(); $fetchObj_studBio = $dbh_stuBio_Query->fetch(PDO::FETCH_OBJ); $dbh_stuBio_Query = null;
 $from_lname = $fetchObj_studBio->studentbio_lname;
 $from_fname =  $fetchObj_studBio->studentbio_fname;
 $from_pix = $fetchObj_studBio->studentbio_pictures;

 //messager
 $stuPost_Query = "SELECT studentbio_lname FROM studentbio WHERE studentbio_id='$poster__id'";
$dbh_stuPost_Query = $dbh->prepare($stuPost_Query); $dbh_stuPost_Query->execute(); $fetchObj_studPost = $dbh_stuPost_Query->fetch(PDO::FETCH_OBJ); $dbh_stuPost_Query = null;
$poster__id = $fetchObj_studPost->poster_id;
 $posti =$fetchObj_studPost->post_text;
 $post_image = $fetchObj_studPost->post_image;
 $post_date = $fetchObj_studPost->post_date;
 
?>
<div style="margin:0 auto; width:80%; padding:10px; box-shadow:20px 20px 50px #CCC ">

<div style="margin:15px;">
  <p class=""><a href="../../pictures/<?php echo $from_pix;?>" class="fancybox fancybox.image">
 <img id="" title="" src="../../pictures/<?php echo $from_pix;?>" alt="none" align="" style="width:100px;" />
  </a></p>
  <p>Name: <?php echo $from_lname.' '.$from_fname;?>: <a href="main?page=view_users&id=<?php EncodeToken($poster__id);?>" target="_blank">Profile</a></p>
<p>Message: <?php echo $posti;?></p>
     <p>Date: <span class="center"><?php echo $post_date;?></span> </p><br />
 <p class=""> image:<a href="../../pictures/<?php echo $post_image;?>" class="fancybox fancybox.image">
 <img id="" title="" src="<?php echo $atcfolder.$post_image;?>" alt="no attachment" align="" style="width:100px;" />
 </a> </p>

 Comments
   <table class="table table-striped table-bordered bootstrap-datatable datatable" width="90%">
        <thead>
          <tr bgcolor="">
            <th>S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th>Student</th>
            <th>Comment</th>
            <th>Date </th>
          </tr>
        </thead>
        <tbody>
         
	 <?php
	 
			$pullassoutr = "SELECT * FROM `student_post_reply` WHERE `post_rel_id` = '$read_id' ORDER BY `id` DESC";
			$dbh_pullassoutr = $dbh->prepare($pullassoutr); $dbh_pullassoutr->execute(); ;
			$sn = 0;
				while ($str = $dbh_pullassoutr->fetch(PDO::FETCH_ASSOC)) {
					$sn = $sn + 1;					
					$post_commenter_id = $str['post_commenter_id'];
					$post_comment = $str['post_comment'];
					$post_comment_date = $str['post_comment_date'];					

					 $rep_name = $kas_framework->getValue('studentbio_lname', 'studentbio', 'studentbio_id', $post_commenter_id);
					 $rep_name .= " "; 
					 $rep_name .= $kas_framework->getValue('studentbio_fname', 'studentbio', 'studentbio_id', $post_commenter_id);
		?>
		 
		  <tr bgcolor="">
			<td><?php echo $sn;?></td>
            <td><i class="icon icon-color icon-user"></i><a href="main?page=view_users&id=<?php EncodeToken($post_commenter_id);?>" target="_blank"><?php echo $rep_name;?></a></td>
            <td class="center"> <?php echo $post_comment;?><br>
			</td>
           
		   <td class="center"><?php echo $post_comment_date;?></td>
          </tr>
		  
		  
		  
	  <?php }
		 $dbh_pullassoutr = null;
	  ?>
        </tbody>
      </table>
 
 
</div>
</div>


<?php

}// stop reading

?>

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>Posts <a href="modules?controller=spy">reload</a></h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr bgcolor="">
            <th>S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th>From</th>
            <th>POST</th>
            <th>COMMENTS/LIKES</th>
            <th>Date </th>
          </tr>
        </thead>
        <tbody>
         
	 <?php
	 
			$pullassoutX = "SELECT * FROM student_post ORDER BY id DESC LIMIT $sort_srt, 1000";
			$dbh_pullassoutX = $dbh->prepare($pullassoutX); $dbh_pullassoutX->execute();
			$sn = 0;
				while ($std = $dbh_pullassoutX->fetch(PDO::FETCH_ASSOC)) {

					$sn = $sn + 1;
					
					$post_id = $std['id'];
					$poster_id = $std['poster_id'];
					$post_text = $std['post_text'];
					$post_image = $std['post_image'];
					$post_date = $std['post_date'];
					$views = $std['views'];
					$date = $std['date'];
					$liker_id = $std['liker_id'];

				$comments = $kas_framework->countRestrict1('student_post_reply', 'post_rel_id', $post_id);
				 $from_name = $kas_framework->getValue('studentbio_lname', 'studentbio', 'studentbio_id', $poster_id);
		?>
		 
		  <tr bgcolor="">
			<td><?php echo $sn;?></td>
            <td><i class="icon icon-color icon-user"></i><a href="main?page=view_users&id=<?php EncodeToken($poster_id);?>" target="_blank"><?php echo $from_name;?></a></td>
            <td class="center"> <?php echo $post_text;?><br>
			<a class="btn btn-default btn-sm" href="?controller=spy&read=<?php EncodeToken($post_id);?>"><i class="icon icon-color icon-inbox"></i> View Post detail</a>
			<br><i><?php if($post_image==""){echo "No attachment(s)";}else{echo "has attachment(s)";}?></i>
			</td>
           

		   <td class="center"><?php echo $comments;?> Comments <br>
		   <?php echo $views;?> Views <br>
		   		   <?php echo substr_count($liker_id, ';');?> Likes 

		   </td>
            <td class="center"><?php echo $post_date;?></td>
          </tr>
		  
		  
		  
	  <?php } 
		 $dbh_pullassoutX = null;
	  ?>
        </tbody>
      </table>

	  
	  </div>		  
	  
	  
	 <?php
// start working ends, this is the third place worked
	if($biototal > 1000){
		if(!isset($_GET['break_p'])){$groupid=1;}

	echo '<br>You now have large number of student posts in your db; total: '.$biototal.' we have put them into page groups, the ones bellow are more of them <br><br><br> Viewing page group:'.'<strong>'.$groupid.'</strong>'.'<br>';
	
	
	// then we loop the page grout in a page grouping link
	for($bp = 1; $bp <= $break_p; $bp++){
		echo '<a href="modules?contoller=spy&break_p='.$bp.'">PG'.$bp.' </a>&raquo;';
	}// end for loop

}// end biototal is 1000
?>
	</div>
  </div>
  <!--/span-->
</div>
<p>&nbsp;</p>
