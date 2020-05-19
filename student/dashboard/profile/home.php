<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('tripple_return').'php.files/classes/students.php');
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/student_details.php');
		
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
	<!-- Theme style -->
	<link href="<?php print constant('tripple_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
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
				<h1><i class="fa fa-cogs"></i> My Profile <?php $student->display_accessLevel(); ?></h1>
				<ol class="breadcrumb">
					 <li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
					<li class="active"><i class="glyphicon fa fa-cogs"></i>&nbsp;&nbsp;Profile</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
			<?php  //if (isset($_SESSSION['tapp_par_username'])) {
					//$student->authConfirm($useradmitStatus); 
					//$student->checkBasicPlan(); 
				//	} ?>
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
                       <?php $dynamicimage = $student->imageDynamic($userpicturepath, $usergender, $kas_framework->url_root('pictures/'));
					print '<img src="'.$dynamicimage.'" href="'.$dynamicimage.'" class="fancybox fancybox.image" alt="User Image" style="border:1px solid #000; height:100px; margin:-40px 0 0 0; cursor:pointer" />';
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
						<a href="mysummary" class="btn btn-info click_ult">Write a Summary about me</a>
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
							  <tr><td><b>Title</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $usertitle); ?></td></tr>
							  <tr><td><b>Surname</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userlastname; ?></td></tr>
							  <tr><td><b>Firstname</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userfirstname; ?></td></tr>
							  <tr><td><b>Middle Name</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $usermname; ?></td></tr>
							  <tr><td><b>Generation</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('generations_desc', 'generations', 'generations_id', $usergeneration); ?></td></tr>
							  <tr><td><b>Sex</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $usergender; ?></td></tr>
							  <tr><td><b>Ethnicity</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('ethnicity_desc', 'ethnicity', 'ethnicity_id', $userethnicity); ?></td></tr>
							  <tr><td><b>Date of Birth</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userdob; ?></td></tr>
							  <tr><td><b>Birth City</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userbirthcity; ?></td></tr>
							  <tr><td><b>Birth State</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('state_name', 'tbl_states', 'state_css', $userbirthstate); ?></td></tr>
							  <tr><td><b>Birth Country</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('name', 'country', 'id', $userbirthcountry); ?></td></tr>
							  <tr><td><b>Mobile</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $user_bio_mobile; ?></td></tr>
							  <tr><td><b>Home Address</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $user_bio_address; ?></td></tr>
							  <tr><td><b>Residence Town</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $user_bio_resident_town; ?></td></tr>
							  <tr><td><b>Residence State</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('state_name', 'tbl_states', 'state_css', $user_bio_resident_state); ?></td></tr>
								<tr><td colspan="2"><hr /></td></tr>
							  <tr><td><b>Form Number</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $form_no; ?></td></tr>
							  <tr><td><b>Admission Badge </b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('badge_name', 'tbl_admission', 'id', $admission_badge); ?></td></tr>
								
							 </table>
							</div><!-- /.box-body  getallFieldinDropdownOption($table, $field) -->
						</form>
					</div><!-- /.box -->
			
			</div><!--/.col (left) -->
					<!-- right column -->
					<div class="col-md-6">

					<div class="box box-success">
				<div class="box-footer">
				<div class="box-header">
					<h3 class="box-title">Advanced Management</h3>
				</div>
					<a href="#" class="btn btn-danger">Delete My Account</a>&nbsp;&nbsp;
					<a href="#" class="btn btn-warning">Reset Profile and Info.</a>
				</div>
			</div>
			
						<div class="box box-success">
							<div class="box-header">
								<h3 class="box-title">Parent/Guardian Information</h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form">
								<div class="box-body">
								<table width="100%" border="0" cellpadding="4">
									<tr><td><b>Title</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $userparguardtitle); ?></td></tr>
									<tr><td><b>First Name</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userparguardfirstname; ?></td></tr>
									<tr><td><b>Last Name</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userparguardlastname; ?></td></tr>
									<tr><td><b>Address 1</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userparguardaddress1; ?></td></tr>
									<tr><td><b>Address 2</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userparguardaddress2; ?></td></tr>
									<tr><td><b>City</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userparguardcity; ?></td></tr>
									<tr><td><b>State</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('state_name', 'tbl_states', 'state_css', $userparguardstate); ?></td></tr>
									<tr><td><b>Zip</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userparguardzip; ?></td></tr>
									<tr><td><b>Phone 1</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userparguardphone1 ?></td></tr>
									<tr><td><b>Phone 2</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userparguardphone2 ?></td></tr>
									<tr><td><b>Phone 3</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userparguardphone3; ?></td></tr>
									<tr><td><b>Relationship</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('relation_codes_desc', 'relations_codes', 'relation_codes_id', $userparguardrel); ?></td></tr>
									<tr><td><b>Email</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userparguardemail; ?></td></tr>
								</table>
								</div>
							</form>
						</div><!-- /.box -->
										<!-- Form Element sizes -->
				<div class="box box-success">
							<div class="box-header">
								<h3 class="box-title">Previous School Informaion </h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form">
								<div class="box-body">
								<table width="100%" border="0" cellpadding="4">
									<tr><td><b>Previous School Name</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userprevschoolname; ?></td></tr>
									<tr><td><b>Previous School Address</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userpreviousSchooladdress; ?></td></tr>
									<tr><td><b>Previous School City</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userpreviousSchoolcity; ?></td></tr>
									<tr><td><b>Previous School State</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('state_name', 'tbl_states', 'state_css', $userpreviousSchoolstate); ?></td></tr>
									<tr><td><b>Previous School Zip</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $userpreviousSchoolzip; ?></td></tr>
									<tr><td><b>Previous School Country</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('name', 'country', 'id', $userpreviousSchoolcountry); ?></td></tr>
								</table>
					
								</div><!-- /.box-body -->
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
	<!-- FancyBox -->
	<script src="<?php print constant('tripple_return') ?>fancybox/jquery.fancybox.js" type="text/javascript"></script>
	<script src="<?php print constant('tripple_return') ?>fancybox/media_helper.js" type="text/javascript"></script>
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
<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>	
</body>
</html>