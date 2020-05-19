<?php 
	require ('../../../php.files/classes/pdoDB.php');
	require ('../../../php.files/classes/kas-framework.php');
		$kas_framework->safesession();	
		$kas_framework->checkAuthPros_Std();
		require (constant('tripple_return').'php.files/classes/generalVariables.php');
		require (constant('tripple_return').'php.files/prospectStudent_details.php');
		require (constant('tripple_return').'php.files/classes/prospectStudent.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Photo Card</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('tripple_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('tripple_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('tripple_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('tripple_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<style type="text/css"> </style>
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
				 <?php $prospectStudent->check_profile_completeness($completeness); ?>
                    <h1><i class="fa fa-picture-o"></i> Photo Card </h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="../"><i class="fa fa-dashboard"></i>Dashboard</a></li>
						<li class="active"><i class="fa fa-picture-o"></i> Photo Card</li>
                    </ol>
                </section>

                 <div class="pad margin no-print">
                    <div class="alert alert-info" style="margin-bottom: 0!important;">
                        <i class="fa fa-info"></i>
                        <b>Note:</b> Please Print this Photo Card For your Examinations. All you need is Here.
                    </div>
                </div>
                <!-- Main content -->
                <section class="content invoice">                    
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <?php  $kas_framework->displaySchoolLogo('40', 'circle', '0 5px 0 0'); ?> Examination Photo Card
                                <small class="pull-right">Date: <?php print date('d/m/Y'); ?></small>
                            </h2>                            
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                           <strong> School Details </strong>
                            <address>
                                <?php print $kas_framework->displayUserSchool($userschool); ?><br>
								State: <?php print $user_bio_resident_state ?><br>
                                Current Year: <?php print $current_year_full ?><br><br>
                                Print Type: Photo Card
                              
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-5 invoice-col">
                           <strong> User Details </strong>
                            <address>
                                Registration Number: <?php print $useridentify; ?><br><br>
                                Email: <?php print $useremail ?><br>
                               Mobile: <?php print ($user_bio_mobile != '')? $user_bio_mobile: $user_bio_phone; ?><br/><br/>
                                Status: Eligible For Exam
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-3 invoice-col">
					<?php $dynamicimage = $kas_framework->imageDynamic($userpicturepath, $usergender, $kas_framework->url_root('pictures/'));
					print '<img src="'.$dynamicimage.'" width="120" alt="User Image" />';
					?>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
				<?php 
				/*Meaning that its a school fees receipt that is to be printed*/
				print '<div class="row">
						<div class="col-xs-12 table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Field</th>
										<th>Details</th>
										<th>Field</th>
										<th>Details</th>
									</tr>                                    
								</thead>
								<tbody>';
					print '<tr><td>Full Name</td><td>'.$kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $usertitle).' '.ucfirst($userfirstname).' '.ucfirst($userlastname).' '.$usermname.'</td>
					<td>Parent/Guardian</td><td>'.$kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $userparguardtitle).' '.$userparguardfirstname.' '.$userparguardlastname.'</td></tr>'; 
					print '<tr><td>Sex</td><td>'.$usergender.'</td>
					<td>Parent/Guardian Phone</td><td>'.$userparguardphone1.'</td></tr>'; 
					print '<tr><td>Ethinicity</td><td>'.$kas_framework->getValue('ethnicity_desc', 'ethnicity', 'ethnicity_id', $userethnicity).'</td>
					<td>Relationship</td><td>'.$kas_framework->getValue('relation_codes_desc', 'relations_codes', 'relation_codes_id', $userparguardrel).'</td></tr>'; 
					print '<tr><td>Date Of Birth</td><td>'.$userdob.'</td>
					<td>Registation Number</td><td>00'.$userid.'</td></tr>'; 
					print '<tr><td>Address</td><td>'.$user_bio_address.'</td>
					<td>Admission Badge</td><td>'.$kas_framework->getValue('badge_name', 'tbl_admission', 'id', $admission_badge).'</td></tr>'; 
					print '<tr><td>Town/State</td><td>'.$user_bio_resident_town.'/'.$kas_framework->getValue('state_name', 'tbl_states', 'state_css', $user_bio_resident_state).'</td>
					<td>Date@Time</td><td>'.$kas_framework->getValue('interview_date', 'tbl_admission', 'id', $admission_badge).' @ '.$kas_framework->getValue('interview_time', 'tbl_admission', 'id', $admission_badge).'</td></tr>'; 
					print '</tbody>
							</table><br />
						<b>Additional Instruction:</b> '.$kas_framework->getValue('instruction', 'tbl_admission', 'id', $admission_badge).'
						<br /><br /><br /><br /><br /><br /><br /><br /><br />
						This Photo Card was generated based on the fact that the Students details and Passport which appeared above has 
						has applied for Admission under the School whose Details Appears Above.
						<br />Note:  Any Attempt to Forge this Reciept will be taken as a Criminal Offence which is Punishable.	<br /><br />					
						</div>
					</div>';
				?>

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


                <!-- jQuery 2.0.2 -->
        <script src="<?php print constant('tripple_return') ?>myjs/jquery.min.js"></script>
		<!---- my javascript controller -->
        <script src="<?php print constant('tripple_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('tripple_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php print constant('tripple_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>
    </body>
</html>