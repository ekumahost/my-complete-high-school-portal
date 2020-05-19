<?php 
	require ('../../../php.files/classes/pdoDB.php');
	require ('../../../php.files/classes/kas-framework.php');
	$kas_framework->safesession();
	$kas_framework->checkAuthParent();
	require (constant('tripple_return').'php.files/classes/generalVariables.php');
	require (constant('tripple_return').'php.files/parents_details.php');
	require (constant('tripple_return').'php.files/classes/parents.php');
			
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Profile</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
	<!-- bootstrap 3.0.2 -->
	<link href="<?php print constant('tripple_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- font Awesome -->
	<link href="<?php print constant('tripple_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link href="<?php print constant('tripple_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="<?php print constant('tripple_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />`	
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
	<?php require (constant('double_return').'inc.files/parentheader.php') ?>
	<p style="margin-top:5px">&nbsp;</p>
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
	   <?php require (constant('double_return').'inc.files/parentsidebar.php') ?>
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
						<!-- small box -->
                            <div class="small-box" style="color:#000; border:2px solid #000; box-shadow:6px 6px 40px #CCC">
						<div class="inner">
						<input type="text" class="knob" value="<?php print $completeness ?>" data-width="90" data-height="90" data-fgColor="#003366" data-readonly="true"/>
					
						</div>
                                <div class="icon">
									<?php $dynamicimage = $parent->imageDynamic($student_parents_image, $student_parents_sex, $kas_framework->url_root('pictures/'));
										print '<img src="'.$dynamicimage.'" href="'.$dynamicimage.'" class="fancybox fancybox.image" alt="User Image" style="border:1px solid #000; cursor:pointer; height:100px; margin:-40px 0 0 0;" />'; ?>
								
                                </div>
								<a href="editprofile" class="small-box-footer" style="background-color:#3C8DBC">
									 <i class="fa fa-arrow-circle-right"></i>   Profile Completeness and your Display picture  <i class="fa fa-arrow-circle-left"></i>
									</a>
                            </div><!-- /.box -->
				<!-- Input addon -->
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">My Personal Information</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form role="form">
							<div class="box-body">
								<table width="100%" border="0" cellpadding="4">
									<tr><td><b>Title</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $student_parents_title); ?></td></tr>
									<tr><td><b>Surname</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $student_parents_lastname; ?></td></tr>
									<tr><td><b>Firstname</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $student_parents_firstname; ?></td></tr>
									<tr><td><b>Middlename</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $student_parents_mi; ?></td></tr>
									<tr><td><b>Sex</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $student_parents_sex; ?></td></tr>
									<tr><td><b>Username</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $_SESSION['tapp_par_username']; ?></td></tr>
									<tr><td><b>Occupation</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $student_parents_occupation ?></td></tr>
								</table>
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
										<tr><td><b>Email:</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $student_parents_email; ?></td></tr>
										<tr><td><b>Contact Addr. 1</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $student_parents_contactaddress1; ?></td></tr>
										<tr><td><b>Contact Addr. 1</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $student_parents_contactaddress2; ?></td></tr>
										<tr><td><b>Mobile 1</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $student_parents_mobile1 ?></td></tr>
										<tr><td><b>Mobile 2</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $student_parents_mobile2 ?></td></tr>
										<tr><td><b>City</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $student_parents_city; ?></td></tr>
										<tr><td><b>State</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('state_name', 'tbl_states', 'state_code', $student_parents_state); ?></td></tr>
										<tr><td><b>Country</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('name', 'country', 'id', $student_parents_country); ?></td></tr>
									</table>
								</div>
							</form>
						</div><!-- /.box -->
						
			<!-- general form elements -->
				<div class="box box-success">
					<div class="box-footer">
						<a href="editprofile" class="btn btn-primary click_ult">Edit my Profile</a>&nbsp;&nbsp;&nbsp;
						<a href="mysummary" class="btn btn-warning">Delete My Account</a>
					</div>
				</div>
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
</html>