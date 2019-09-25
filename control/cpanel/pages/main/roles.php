<?php
if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}
?>
	
<h3><strong>&nbsp;&nbsp;&nbsp;&nbsp;Staff Roles</strong> <?php if(isset($_GET['case'])){echo  '<a href="main?page=roles" class="btn btn-default btn-sm"> &laquo;Back to roles</a>';} ?></h3>		

<div class="row-fluid">
<?php

// should the admin want to delete 
if(isset($_POST['takeaction'])){
	$row_r_id = $_POST['row_r_id'];
	$stfname = $_POST['stfname'];
	$dowhat = $_POST['takeaction'];
	
	$query=  "UPDATE staff_role SET `$dowhat` = '0' WHERE `id` = '$row_r_id'";
	$dbh_query = $dbh->prepare($query); $dbh_query->execute(); $rowCount = $dbh_query->rowCount(); $dbh_query = null;
	//upgraded by Ultimate Kelvin C - Kastech
	if ($rowCount == 1){
	$answer = '<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Good Job!</strong> You successfully deleted '.$stfname.' from  '.$dowhat.'</div>';
	} else {
		$answer = '<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">*</button>
		<strong>Heads up!</strong>  Your Last action Failed. </div>'; 
	}							
}


	if(isset($_GET['case'])){
		$mycase = $_GET['case'];

		switch($mycase){
			
		case 'liberian': 
			$swcase = "liberian";// main switching variable
			$title="Library Roles";// page title
		break;		
		case 'attendance':
			$swcase = "attendance";// main switching variable
			$title="Attendance Roles";// page title
		break;
		case 'discipline':
			$swcase = "discipline";// main switching variable
			$title="Discipline Roles";// page title
		break;
		case 'health':
			$swcase = "health";// main switching variable
			$title="Health Roles";// page title
		break;
		case 'receipt':
			$swcase = "receipt";// main switching variable
			$title="Bursar Roles";// page title 
		break;
		case 'hostels':
			$swcase = "hostels";// main switching variable
			$title="Hostel Roles";// page title
		break;
		case 'timetable':
			$swcase = "timetable";// main switching variable
			$title="Timetable Roles";// page title
		break;
		case 'security':
			$swcase = "security";// main switching variable
			$title="Security Roles";// page title
		break;
		default:
		echo "We got confused!!!!";
			$swcase = "default";// main switching variable
			$title="We got corn fussed!!! lol";// page title
		}// swithck
	}// if
?>

<?php if(isset($_GET['case'])){?>

<!-- start role cordination in swithc using $swcase -->

<table width="100%" border="0">
  <tr>
    <td width="28%">
 <div class="box span">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i><?php echo $swcase;?></h2>
			<div class="box-icon">
				<i class="icon-book"></i>
			</div>
		</div>
		<div class="box-content">
		<div class="row-fluid">
	   <img src="img/icons/<?php echo $swcase;?>.png" />
		</div>                   
	  
	</div><!--/span--></td>
    <td width="72%">
    
  <?php 
  if(isset($_POST['takeaction'])){
	  
	  echo $answer;
	  }
  
  ?>
    <br />
   <p style="font-size:19px; font-variant: small-caps; font-weight:900; text-align:center"><?php echo ucfirst($swcase);?> Admins:  Add new Staff to this Group</p>

<?php 
if(isset($_POST['staffid'])){
	// add the new staff
	@$myname = $_POST['staffid'];//
	@$myrole = $_POST['roletype'];
	// update table, set $myrole = 1 where id = returned lecturer id from form input
	
	$rowCount_Counter = 0;
	foreach( $myname as $staffi) {
		$querye=  "UPDATE staff_role SET $myrole = '1' WHERE staff_id='$staffi'";
		$dbh_querye = $dbh->prepare($querye); $rowCount = $dbh_querye->rowCount(); $dbh_querye->execute(); $dbh_querye = null;
		$rowCount_Counter = $rowCount + 1;
	}
	
	if($rowCount_Counter >= 1){
	echo '<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Good Job!</strong> You successfully added the staff, view detail below</div>';
	} else {
	echo '<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">*</button>
		<strong>Heads up!</strong> Your Last action Failed.</div>'; 
		}
}
?>
 <div class="control-group" style="margin:0 50px 0 20px">
 <form action="main?page=roles&case=<?php echo $swcase;?>" method="post">
 <label class="control-label" for="selectError1"></label>
								<div class="controls">
								  <select id="selectError1" name="staffid[]" multiple data-rel="chosen" style="width:100%">
<?php 
// pull all the staff out for selection

  $pullstaff = "SELECT * FROM staff_role ORDER BY id DESC";
	$dbh_pullstaff = $dbh->prepare($pullstaff); $dbh_pullstaff->execute();
	$sn = 0;
	while ($rowst = $dbh_pullstaff->fetch(PDO::FETCH_ASSOC)) {
	//$current_year=$_SESSION['CurrentYear'];

	$sn = $sn + 1;
	$staff_id = $rowst['staff_id'];
	$staff_usern = $kas_framework->getValue('web_users_username', 'web_users', 'web_users_relid', $staff_id); 
	$staff_fname = $kas_framework->getValue('staff_fname', 'staff', 'staff_id', $staff_id);
	$staff_lname = $kas_framework->getValue('staff_lname', 'staff', 'staff_id', $staff_id);
?>
<option value="<?php echo $staff_id;?>"><?php echo $staff_lname.' '.$staff_fname.'('.ucfirst($staff_usern).')';?></option>
									                            
 <?php }
	$dbh_pullstaff = null;
 ?>                                   
		  </select>
		  
		  <input type="hidden" name="roletype" value="<?php echo $swcase;?>" /><br />
		 <button type="submit" class="btn btn-primary">Add Staff</button>

		  
		  </form>
		</div>
	  </div>
</td>
  </tr>
</table>

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>Active Admins for <?php echo $swcase;?>
      </h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr>
            <th width="10%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="30%">Staff Name</th>
            <th width="15%">Username</th>
            <th width="15%">Status</th>
            <th width="30%">Image <i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="15%">Remove</th>
          </tr>
        </thead>
        <tbody>
         
		         <?php
				$pullassout = "SELECT * FROM `staff_role` AS sr, staff AS st WHERE st.staff_id = sr.staff_id AND sr.".$swcase." = '1' ORDER BY sr.id DESC";
					$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute(); 
						$sn = 0;
						while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {

						$sn = $sn + 1;
						$rowid = $std['id'];
						$staff = $std['staff_id'];
						//switch case here na
						 $case = $std[$swcase];
							$stf_lname = $std['staff_lname'];
							$stf_fname = $std['staff_fname']; 
							$stf_image = $std['staff_image']; 
					
					$stf_user= $kas_framework->getValue('web_users_username', 'web_users', 'web_users_relid', $staff);
	   				$confirmation= $kas_framework->getValue('web_users_active', 'web_users', 'web_users_relid', $staff);//we can also use stdbio_id

	   
	if($stf_image == NULL){
		$stf_image = 'avatar_default.png';
	}

	 if($confirmation =='1'){
		$mystatus = '<span class="label label-success" style="padding:8px 12px">Active</span>';
	 //label-warning for pending
	 }else if($confirmation ==NULL){	
		$mystatus = '<span class="label label-important" style="padding:8px 12px">Unknown</span>';
	 }else{
		$mystatus ='<span class="label label-important" style="padding:8px 12px">Inactive</span>';}
	?>
		 
		  <tr>
			<td><?php echo $sn;?></td>
            <td class="center"><?php echo $stf_lname.' '.$stf_fname;?> </td>
            <td class="center"> <?php echo $stf_user;?></td>
            <td class="center"><?php echo $mystatus;?> </td>
            <td class="center"><div id="image"><a href="../../pictures/<?php echo $stf_image;?>" title="Image of <?php echo $stf_user;?>" class="fancybox fancybox.image" />
			</a>&nbsp;&nbsp;<img id="community" title="Community/Profile" src="../../pictures/<?php echo $stf_image;?>" alt="none" align="" style="width:60px;" /></div></td>
			
            <td class="center">
				<form action="" method="post">
			<input type="hidden" name="takeaction" value="<?php echo $swcase;?>" />
			<input type="hidden" name="row_r_id" value="<?php echo $rowid;?>" />
			<input type="hidden" name="stfname" value="<?php echo $stf_fname.' '.$stf_lname;?>" />
		   <input class="btn btn-danger" type="submit" value="Delete"></form>

			</td>
          </tr>
	<?php } 
		$dbh_pullassout = null;
	?>
        </tbody>
      </table>
    </div>
  </div>
  <!--/span-->
</div>


<?php }// if case was set?>

<?php if(!isset($_GET['case'])){ 
$title="Roles and staff functions";


//added by kelvin - Kastech for the count of the roles aleady assigned
function countAdminsForRole($role) {
	//since we dont know the asolute URL and we dont care about it, lets connect our PDO file
	(file_exists('../../php.files/classes/pdoDB.php'))? include ('../../php.files/classes/pdoDB.php'): include ('../../../php.files/classes/pdoDB.php');
	$Query = "SELECT * FROM staff_role WHERE `$role` = '1'";
	$dbh_Query = $dbh->prepare($Query); $dbh_Query->execute(); $rowCount = $dbh_Query->rowCount(); $dbh_Query = null;
	return $rowCount;
}  
?>
			<div class="row-fluid sortable">
			 <div class="box span3">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-th"></i>Library (<?php print countAdminsForRole('liberian') ?>)</h2>
						<div class="box-icon">
							<a href="main?page=roles&case=liberian" class=""><i class="icon-book"></i></a>
						</div>
					</div>
					<div class="box-content">
                  	<div class="row-fluid">
                   <a href="main?page=roles&case=liberian" class="">   <img src="img/icons/library.png" /></a>
                    </div>                   
                  </div>
				</div><!--/span-->
		<div class="box span3">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-th"></i>Attendance (<?php print countAdminsForRole('attendance') ?>)</h2>
						<div class="box-icon">
							<a href="#" class=""><i class="icon-book"></i></a>
						</div>
					</div>
					<div class="box-content">
                  	<div class="row-fluid">
                      <a href="main?page=roles&case=attendance"><img src="img/icons/attendance.png" /></a>
                    </div>                   
                  </div>
				</div><!--/span-->
                
		<div class="box span3">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-th"></i>Bursary (<?php print countAdminsForRole('receipt') ?>)</h2>
						<div class="box-icon">
							<a href="#" class=""><i class="icon-book"></i></a>
						</div>
					</div>
					<div class="box-content">
                  	<div class="row-fluid">
                    <a href="main?page=roles&case=receipt">  <img src="img/icons/receipt.png" /></a>
                    </div>                   
                  </div>
				</div><!--/span-->
                <div class="box span3">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-th"></i>Discipline (<?php print countAdminsForRole('discipline') ?>)</h2>
						<div class="box-icon">
							<a href="#" class=""><i class="icon-book"></i></a>
						</div>
					</div>
					<div class="box-content">
                  	<div class="row-fluid">
                      <a href="main?page=roles&case=discipline"> <img src="img/icons/discipline.png" /></a>
                    </div>                   
                  </div>
				</div><!--/span-->
             </div>            
		<div class="row-fluid sortable">
				
   				<div class="box span3">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-th"></i>Health (<?php print countAdminsForRole('health') ?>)</h2>
						<div class="box-icon">
							<a href="#" class=""><i class="icon-book"></i></a>
						</div>
					</div>
					<div class="box-content">
                  	<div class="row-fluid">
                     <a href="main?page=roles&case=health">  <img src="img/icons/health.png" /></a>
                    </div>                   
                  </div>
				</div><!--/span-->
                
				<div class="box span3">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-th"></i>TimeTable (<?php print countAdminsForRole('timetable') ?>)</h2>
						<div class="box-icon">
							<a href="#exam" class=""><i class="icon-book"></i></a>
						</div>
					</div>
					<div class="box-content">
                  	<div class="row-fluid">
                    <a href="main?page=roles&case=timetable">  <img src="img/icons/timetable.png" /></a>
                    </div>                   
                  </div>
				</div><!--/span-->
                
                 <div class="box span3">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-th"></i>Hostel (by admin)</h2>
						<div class="box-icon">
							<a href="modules?controller=hostels" target="_blank" class=""><i class="icon-book"></i></a>
						</div>
					</div>
					<div class="box-content">
                  	<div class="row-fluid">
                    <a href="modules?controller=hostels" target="_blank" >  <img src="img/icons/hostel.png" /></a>
                    </div>                   
                  </div>
				</div><!--/span-->
                
                  <div class="box span3">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-th"></i>Security (not active)</h2>
						<div class="box-icon">
							<a href="#security" class=""><i class="icon-book"></i></a>
						</div>
					</div>
					<div class="box-content">
                  	<div class="row-fluid">
                   <a href="#security">   <img src="img/icons/security.png" /></a>
                    </div>                   
                  </div>
				</div><!--/span-->
              
                </div>
                
            	
</div><!--/row-->
<?php }// end when a case is not selected ?>
</div>