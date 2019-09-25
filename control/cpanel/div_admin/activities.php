<?php
if(!defined('common')){include_once "../includes/common.php";}
// config
if(!defined('configuration')){include_once "../includes/configuration.php";}
?>	
	<div class="box span4"> 
				<div class="box-header well" data-original-title>
					<h2><i class="icon-user"></i>Newest Students</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<div class="box-content">
						<ul class="dashboard-list">
						 <?php
			 
					$pullassout = "SELECT * FROM studentbio ORDER BY studentbio_id DESC LIMIT 4";
					$dbh_Query = $dbh->prepare($pullassout);
					$dbh_Query->execute();					
					
					$sn = 0;
					while ($std = $dbh_Query->fetch(PDO::FETCH_ASSOC)) {
						$current_year=$_SESSION['CurrentYear'];

						$sn = $sn + 1;
						$regno = $std['studentbio_internalid'];
						$stdbio_id = $std['studentbio_id'];
						$lastn = $std['studentbio_lname'];
						$firstn = $std['studentbio_fname'];
						$picture = $std['studentbio_pictures'];

						//$picture=$db->get_var("SELECT picturepath FROM studentbio WHERE studentid='$stdbio_id'");//we can also use stdbio_id
							//get the idiot username from web_students
						$username=$kas_framework->getValue('user_n', 'web_students', 'identify', $regno);//we can also use stdbio_id
						  //get the idiot reg date from web_students
						$regdate=$kas_framework->getValue('reg_date', 'web_students', 'identify', $regno);//we can also use stdbio_id
						// get the student status
						$mystatus= $kas_framework->getValue('admit', 'studentbio', 'studentbio_internalid', $regno);//we can also use stdbio_id
						 
						 if($mystatus =='1'){
							$mystatus = '<span class="label label-success">Admitted</span>';
						 //label-warning for pending
						 } else {	$mystatus = '<span class="label label-warning">Pending</span>';}

						// catch his sex abi na gender
						$gender= $std['studentbio_gender'];
						// select the student picture
						if($picture==NULL){
							$picture = 'avatar_default.png';
						}
		?>
	<li>
		<a href="#">
			<img class="dashboard-avatar" alt="No Image" src="../../pictures/<?php echo $picture;?>"></a>
			<strong>Name:</strong> <a target="_blank" href="main?page=view_users&id=<?php EncodeToken($stdbio_id) ?>"><?php print ucfirst($firstn).' '.ucfirst($lastn);?> (<?php echo ucfirst($username);?>)
		</a><br>
		<strong>Since:</strong><?php echo $regdate;?><br>
		<strong>Reg:</strong><?php echo $regno;?> <?php echo $mystatus;?>                                
	</li>
		<?php } 
			$dbh_Query = null;
		?>
		</ul>
	</div>
</div>
</div><!--/span-->