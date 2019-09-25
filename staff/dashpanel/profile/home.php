<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/staff_details.php');
require (constant('tripple_return').'php.files/classes/staff.php');
		
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Profile</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
	<!-- bootstrap 3.0.2 -->
	<link href="<?php print constant('tripple_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- font Awesome -->
	<link href="<?php print constant('tripple_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link href="<?php print constant('tripple_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme style-->
	<link href="<?php print constant('tripple_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
	<!-----The knob ----------------->
	<link href="<?php print constant('tripple_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />		
	<!-- Bootsrap -->
	<link href="<?php print constant('tripple_return') ?>fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body class="skin-blue">
	<!-- header logo: style can be found in header.less -->
	<?php require (constant('double_return').'inc.files/header.php') ?>
	<p style="margin-top:18px">&nbsp;</p>
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
	   <?php require (constant('double_return').'inc.files/sidebar.php') ?>
		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
				   <i class="fa fa-cogs"></i> My Profile
					<small>Preview</small>
				</h1>
				<ol class="breadcrumb">
					<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
					<li class="active"><i class="glyphicon fa fa-cogs"></i>&nbsp;&nbsp;Profile</li>
				</ol>
			</section>
					<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- left column -->
					<div class="col-md-6">
						<!-- general form elements -->
						
						
					<!-- small box -->
					<div class="small-box" style="color:#000; border:2px solid #000; box-shadow:6px 6px 40px #CCC">
						<div class="inner">
						<input type="text" class="knob" value="<?php print $completeness ?>" data-width="90" data-height="90" data-fgColor="#003366" data-readonly="true"/>
					
						</div>
						<div class="icon">
						   <?php $dynamicimage = $kas_framework->imageDynamic($staff_image, $staff_sex, $kas_framework->server_root_dir('pictures/'));
								print '<img href="'.$dynamicimage.'" src="'.$dynamicimage.'" class="fancybox fancybox.image" alt="User Image" style="border:1px solid #000; height:100px; margin:-40px 0 0 0; cursor:pointer" />';
							?>
						</div>
						<a href="editprofile" class="small-box-footer" style="background-color:#3C8DBC">
						 <i class="fa fa-arrow-circle-right"></i>   Profile Completeness and your Display picture  <i class="fa fa-arrow-circle-left"></i>
						</a>
					</div><!-- /.box -->
				<!-- general form elements -->
				<div class="box box-success">
					<div class="box-footer">
						<a href="editprofile" class="btn btn-primary click_ult">Edit my Profile</a>&nbsp;&nbsp;&nbsp;
						<a href="#" class="btn btn-warning">Delete My Account</a>
					</div>
				</div>
				<!-- Input addon -->
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">My Personal Information</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form role="form">
							<div class="box-body">
								<table width="100%" border="0" cellpadding="4">
									<tr><td><b>Title</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $staff_title); ?></td></tr>
									<tr><td><b>Firstname</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_firstname; ?></td></tr>
									<tr><td><b>Lastname </b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_lastname; ?></td></tr>
									<tr><td><b>Middle Initial</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_mi; ?></td></tr>
									<tr><td><b>Sex</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_sex; ?></td></tr>
									<tr><td><b>Date Of Birth</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_dob; ?></td></tr>
									<tr><td><b>Birth State</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('state_name', 'tbl_states', 'state_css', $staff_state); ?></td></tr>
									<tr><td><b>Birth City</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_birth_city; ?></td></tr>
									<tr><td><b>Ethnicity</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('ethnicity_desc', 'ethnicity', 'ethnicity_id', $staff_ethnicity); ?></td></tr>
										
								</table>
							</div><!-- /.box-body  getallFieldinDropdownOption($table, $field) -->
						</form>
					</div><!-- /.box -->
						
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">My Biography</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form role="form">
							<div class="box-body">
								<?php print $staff_biography ?>
							</div><!-- /.box-body  getallFieldinDropdownOption($table, $field) -->
						</form>
					</div><!-- /.box -->
					
				</div><!--/.col (left) -->
					<!-- right column -->
					<div class="col-md-6">

						<div class="box box-success">
							<div class="box-header">
								<h3 class="box-title">Contact Information</h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form">
								<div class="box-body">
									<table width="100%" border="0" cellpadding="4">
										<tr><td><b>Email:</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_email; ?></td></tr>
										<tr><td><b>Contact Address</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_address; ?></td></tr>
										<tr><td><b>Resident State</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('state_name', 'tbl_states', 'state_css', $staff_res_state); ?></td></tr>
										<tr><td><b>Resident Town</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_res_town; ?></td></tr>
										<tr><td><b>Mobile </b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_mobile ?></td></tr>
										<tr><td><b>Country</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('name', 'country', 'id', $staff_country); ?></td></tr>
									</table>
								</div>
							</form>
						</div><!-- /.box -->
						
						<div class="box box-success">
							<div class="box-header">
								<h3 class="box-title">Bank Information</h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form">
								<div class="box-body">
									<table width="100%" border="0" cellpadding="4">
										<tr><td><b>Bank:</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('name', 'bank', 'id', $staff_bank); ?></td></tr>
										<tr><td><b>Account Type</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_account_type; ?></td></tr>
										<tr><td><b>Account Number </b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_account ?></td></tr>
										<tr><td><b>Sort Code</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_bank_sort ?></td></tr>
										</table>
								</div>
							</form>
						</div><!-- /.box -->
						
						<div class="box box-success">
							<div class="box-header">
								<h3 class="box-title">Next of Kin Information</h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form">
								<div class="box-body">
									<table width="100%" border="0" cellpadding="4">
										<tr><td><b>Kin Name:</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_kin_name; ?></td></tr>
										<tr><td><b>Kin Phone</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_kin_phone; ?></td></tr>
										<tr><td><b>Kin Email </b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_kin_email ?></td></tr>
										<tr><td><b>Kin Address</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $staff_kin_adress ?></td></tr>
										</table>
								</div>
							</form>
						</div><!-- /.box -->
					</div><!--/.col (right) -->
				</div>   <!-- /.row -->
			</section><!-- /.content -->
		</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->
	 <!-- jQuery 2.0.2 -->
	<script src="<?php print constant('tripple_return') ?>myjs/jquery.min.js"></script>
	<!-- jQuery Knob -->
    <script src="<?php print constant('tripple_return') ?>js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
	<!-- page script -->
	<script type="text/javascript">
		$(function() {
			/* jQueryKnob */

			$(".knob").knob({
			
				draw: function() {

					// "tron" case
					if (this.$.data('skin') == 'tron') {

						var a = this.angle(this.cv)  // Angle
								, sa = this.startAngle          // Previous start angle
								, sat = this.startAngle         // Start angle
								, ea                            // Previous end angle
								, eat = sat + a                 // End angle
								, r = true;

						this.g.lineWidth = this.lineWidth;

						this.o.cursor
								&& (sat = eat - 0.3)
								&& (eat = eat + 0.3);

					   

						this.g.beginPath();
						this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
						this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
						this.g.stroke();

						this.g.lineWidth = 3;
						this.g.beginPath();
						this.g.strokeStyle = this.o.fgColor;
						this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
						this.g.stroke();

						return false;
					}
				}
			});
			/* END JQUERY KNOB */

		});

	</script>
	 <!---- my javascript controller -->
	<script src="<?php print constant('tripple_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
	<!-- Bootstrap -->
	<script src="<?php print constant('tripple_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
	<!-- AdminLTE App -->
	<script src="<?php print constant('tripple_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>
	<!-- FancyBox -->
	<script src="<?php print constant('tripple_return') ?>fancybox/jquery.fancybox.js" type="text/javascript"></script>
	<script src="<?php print constant('tripple_return') ?>fancybox/media_helper.js" type="text/javascript"></script>
<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>	
</body>
</html>