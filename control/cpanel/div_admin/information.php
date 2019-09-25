<?php
	if(!defined('common')){ include_once "../includes/common.php"; }
	// config
	if(!defined('configuration')){ include_once "../includes/configuration.php"; }

	$app_licence = $kas_framework->getValue('app_licence', 'tbl_config', 'id', '1'); // licence code
	$member_status = $kas_framework->getValue('app_membership', 'tbl_config', 'id', '1'); //we can also use stdbio_id
		 if($member_status =='1'){
			$member_status = '<span class="label label-success">YES!</span>';
		 } else { 	
			$member_status = '<span class="label label-important">No!</span>';
		}


	$portal_framework= $kas_framework->getValue('school_app_framework', 'tbl_config', 'id', '1');
	$school_app_version= $kas_framework->getValue('school_app_version', 'tbl_config', 'id', '1');
	$school_logo=$kas_framework->getValue('school_logo_path', 'tbl_config', 'id', '1');
	$school_bar_code= $kas_framework->getValue('school_bar_code_app', 'tbl_config', 'id', '1');
	
	if($school_bar_code == ""){
		$school_bar_code = 'qr.jpg';
	}

	$app_launch= $kas_framework->getValue('portal_launch_date', 'tbl_config', 'id', '1');
	$mylogo=$kas_framework->getValue('school_logo_path', 'tbl_config', 'id', '1');//
	$badge= $kas_framework->getValue('school_badge_path', 'tbl_config', 'id', '1');
	
	if($badge == NULL){
		$badge = 'logo.png';
	}
	if($mylogo == NULL){
		$mylogo = 'logo.png';
	}

?>


<div class="box span4"> 
	<div class="box-header well">
		<h2><i class="icon-th"></i>Information</h2>
		<div class="box-icon">
			<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
			<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
			<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
		</div>
	</div>
	<div class="box-content">
		<ul class="nav nav-tabs" id="myTab">
			<li class="active"><a href="#info">About</a></li>
			<li><a href="#custom">Certificate</a></li>
			<li><a href="#messages">Identity</a></li>
		</ul>
		 
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active" id="info">
				<h3><?php echo _SCHOOL_NAME;?>.&nbsp;<small>Member MSA <?php echo $member_status;?>&nbsp;<a href="https://kastechnet.com/" title="What is this" target="_blank">? </a></small></h3>
				<p>Portal launch date: <strong><?php echo $app_launch;?></strong></p>
				<img alt="School Badge" width="120px" class="charisma_qr center" src="../../files/images/<?php echo $badge;?>" />
			</div>
			<div class="tab-pane" id="custom">
				<h3>Certification <small>Not Binding</small></h3>
				<p>Paid Version: <b><?php echo $portal_framework.' '.$school_app_version;?></b></p>
				<p><img alt="logo" width="120px" class="charisma_qr center" src="../../files/images/<?php echo $mylogo;?>" />
			</p>
				<p><em>Terms/Conditions apply </em></p>
				<p>Certified to use by: <strong>Benjamin & Kelvin</strong><br />
				Kastech<sup> TM</sup> - Kastech Network Limited</p>

			</div>
			<div class="tab-pane" id="messages">
				<h4>Qrcode <small>Identifier</small>:HyperSchool<sup> TM</sup> <br> <br>License No: <font color="blue"><?php echo $app_licence;?></font></h4><br />
				 <br>
				<img alt="School Identify" width="" height="" class="charisma_qr center" src="../../files/images/<?php echo $school_bar_code;?>" />
				<p>&nbsp; </p>
			</div>
		</div>
	</div>
</div><!--/span-->