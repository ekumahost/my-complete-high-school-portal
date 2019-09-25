<?php 
$title="Portal Settings";
if (!defined('MYSCHOOLAPPADMIN_CORE'))
{// if the user access this page directly, take his ass back to home 

header('Location: ../../../index.php?action=notauth');
exit;
}
include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";

?>
<br />
<center><a href="main?page=schoolapp&tools=register#mainsetting"><button type="submit" class="btn btn-primary">Registration</button>  </a>  &nbsp;&nbsp; <a href="main?page=schoolapp&tools=login#mainsetting"><button type="submit" class="btn btn-primary">Login</button>  </a> &nbsp;&nbsp; <a href="main?page=schoolapp&tools=api#mainsetting"><button type="submit" class="btn btn-primary">Payment Gateway</button></a> &nbsp;&nbsp; <a href="main?page=schoolapp&tools=api#mainsetting"><button type="submit" class="btn btn-primary">APIs</button></a>   &nbsp;&nbsp; <a href="main?page=schoolapp&tools=mainsett#mainsetting"><button type="submit" class="btn btn-primary">Main</button> </a> &nbsp;&nbsp; <a href="main?page=administrative" target="_blank"><button type="submit" class="btn btn-primary">Administrative Config</button> </a>   </h4></b></center>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-gear"></i>Settings<?php //echo $db_name;?></h2>
      <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>  </div>
    </div>
    <div class="box-content">
  <p>
  
<?php

if(isset($_POST['takeaction'])){
$row = $_POST['row'];
@$apiuser = $_POST['user']; //html form is in the db
@$apipass = $_POST['pass'];// html form is in the db
@$api_def = $_POST['def'];
$dowhat = $_POST['takeaction'];

switch($dowhat){
case 'enable':
$query= "UPDATE tbl_app_config SET status = '1' WHERE id='$row'";
$dbh_query = $dbh->prepare($query); $dbh_query->execute(); $rowCount = $dbh_query->rowCount(); $dbh_query = null;
if ($rowCount > 0){
	echo '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Good Job!</strong> You successfully Enabled Module/Control </div>';

	} else {
	echo '<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Heads up!</strong> there is trouble with the database</div>';}
	break;

	case 'disable':
	$query= "UPDATE tbl_app_config SET status = '0' WHERE id='$row'";
	$dbh_query = $dbh->prepare($query); $dbh_query->execute(); $rowCount = $dbh_query->rowCount(); $dbh_query = null;

	if($rowCount > 0){
	echo '<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Good Job!</strong> You successfully disabled Module/Controls</div>';

	} else {
	echo '<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Heads up!</strong> there is trouble with the database</div>';}
	break;

	case 'api':

	$query= "UPDATE tbl_app_config SET status = '1', api_user = '$apiuser', api_pass ='$apipass', api_def='$api_def' WHERE id='$row'";
	$dbh_query = $dbh->prepare($query); $dbh_query->execute(); $rowCount = $dbh_query->rowCount(); $dbh_query = null;

	if($rowCount > 0){

	echo '<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Good Job!</strong> You successfully saved/enabled API </div>';

	} else {
	echo '<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">*</button>
			<strong>Heads up!</strong> there is trouble with the database</div>';}
	break;

	default:
	echo '<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">�</button>
		<strong>Oh snap! </strong> We got confused. Seems like your database configuration is wrong.
	</div>';
	}

}
?>
</p>
 <p>
      <?php 
	  @$setting_tool = $_GET['tools'];
	  switch($setting_tool){
	  
	   case 'api':
	   	  $theader = 'API Definitions';

	  $header = '<strong><font color="#003366">API Settings/Payment Gateway </font></strong>';
      $type = 'api';
	 break;
	   case 'register':
	   	  $theader = 'Who can register';

	$header = '<strong><font color="#003366">Registration Settings  </font></strong>';
      $type = 'registration';	 
	  
	  break;
	  
	  case 'login':
	  	  $theader = 'Who can login';

		$header = '<strong><font color="#003366">Login Settings  </font></strong>';
		  $type = 'login';	  
		 break;
		 
		  default:
		  $theader = 'Module/Action name';
		$header = '<strong><font color="#003366">Portal main Settings  </font></strong>';
		  $type = 'main';	
		  }
?>
	  
<p><?php echo $header;?> </p>
 <table class="table table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th width="5%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="25%"><?php echo $theader;?> </th>
            <th width="15%">Status</th>
            <th width="42%">Detail <i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="13%">Action</th>
          </tr>
        </thead>
        <tbody>
         
		         <?php
					$pullassout =  "SELECT * FROM tbl_app_config WHERE `type` = '$type' ORDER BY id";
						$dbh_pullassout = $dbh->prepare($pullassout); $dbh_pullassout->execute();
						$sn = 0;
						while ($std = $dbh_pullassout->fetch(PDO::FETCH_ASSOC)) {

						$sn = $sn + 1;
						$desc = $std['description'];
						$detail = $std['detail'];
						$confirmation = $std['status'];
						$id = $std['id'];
						$api_user = $std['api_user'];
						$api_pass = $std['api_pass'];
						$api_def = $std['api_def'];


				if($confirmation =='1'){
					 $mystatus = '<span class="label label-success" style="padding:8px 12px">Enabled</span>';
					 //label-warning for pending
					 } else if($confirmation =='0'){	
						$mystatus = '<span class="label label-important" style="padding:8px 12px">Disabled</span>';
					 } else { 
						$mystatus ='Unknown';}
			
		  ?>
		 
		  <tr>
			<td><?php echo $sn;?></td>
            <td><i class="icon icon-color icon-gear"></i><?php echo $desc;?> </td>
            <td class="center"><?php echo $mystatus;?> </td>
            <td class="center"><?php if($setting_tool !='api'){
			
			echo $detail;
			}else {
			echo $detail;
			
			?>
			<form action="" method="post">
			<input type="hidden" name="takeaction" value="api" />
			API USER/ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="user" width="100%" value="<?php echo $api_user;?>" placeholder="...." /><br />
			API PASS/Secret&nbsp;<input type="text" name="pass" value="<?php echo $api_pass;?>" width="100%" placeholder="...." /><br />
			API Definitions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="def" value="<?php echo $api_def;?>" width="100%" placeholder="...." />

		<input type="hidden" name="row" value="<?php echo $id;?>" />
		 <input class="btn btn-info" type="submit" value="Save"></input></form>
		<?php	
		}
		?> 
		</td>
		<td class="center">
			<?php
			 if($confirmation !='1'){?>
			<form action="" method="post">
			<input type="hidden" name="takeaction" value="enable" />
			<input type="hidden" name="row" value="<?php echo $id;?>" />
		<input class="btn btn-info" type="submit" value="Enable"> <i class="icon icon-green icon-replyall"></i></input>
			</form>
		<?php }else{?>
			
				<form action="" method="post">
			<input type="hidden" name="takeaction" value="disable" />
			<input type="hidden" name="row" value="<?php echo $id;?>" />

						  <input class="btn btn-warning" type="submit" value="Disable"> <i class="icon icon-red icon-redo"></i></input></form>
		<?php }?>			</td>
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
<p>&nbsp;</p>
