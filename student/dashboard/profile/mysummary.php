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
        <title>My Summary</title>
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
				<h1><i class="fa fa-cogs text-green"></i> My Summary <?php $student->display_accessLevel(); ?></h1>
				<ol class="breadcrumb">
					<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
					<li class="click_ult"><a href="<?php print constant('single_return') ?>profile/"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Profile</a></li>
					<li class="active"><i class="fa fa-star-half-o"></i>&nbsp;&nbsp;My Summary</li>
				</ol>
			</section>
	<div class="pad margin no-print">
		<?php $student->checkBasicPlanStudent(); //$student->authConfirm($useradmitStatus); ?>
		<div class="alert alert-info" style="margin-bottom: 0!important;">
			<i class="fa fa-info"></i>
			<?php if ($completeness >=85 and $completeness <=94) { ?>
			<b>Note:</b> This Summary will be better if your Profile is greater than 94%. Click Print for Printing
			<?php } else { ?>
			<b>Nice:</b> May not be as good as you expected but your profile looks good at <?php print $completeness ?>%. Click Print for Printing
			<?php } ?>
	 </div>
                </div>
              <!-- Main content -->
                <section class="content invoice">                    
                    <!-- Table row -->
                    <div class="row">
					<style type="text/css">
					.row { font-size: 16px; }
					</style>
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
						<?php  
							if ($completeness < 85) {
							$remaining = 85 - $completeness;
								$kas_framework->showalertwarningwithPaleYellow('You Cannot See a Summary about Yourself.
								<br />Reason: &raquo; Your Profile is not Up to 85% Complete and we need these details for your Summary. Your Profile is
								just about '.$completeness.'% Complete and remaining about '.$remaining.'%
								<br />Hint: <a href="editprofile">Complete your Profile</a>
								<br />Caution: If you dont have a previous school, fill in the Current School');
							} else {
							//the todo logic and application goes here
							$dynamicimage = $student->imageDynamic($userpicturepath, $usergender, $kas_framework->url_root('pictures/'));
								print '<img src="'.$dynamicimage.'" class="img-circle" alt="User Image" style="width:110px; margin:10px; float:left" />';
								$summary = '';
								$summary .= '<blockquote>My Summary</blockquote>';
								if ($userlastname != '' and $userfirstname != '') {
									$summary .= 'My Name Is '. ucfirst($userfirstname). ' '. ucfirst($userlastname) .'. ';
								} 
								$summary .= ' I am a '. $usergender .'. ';
								if ($userdob != '') {
									$yrDeduced = date('Y') - substr($userdob, 6, 4);
									$summary .= ' I was born '. $userdob .' which implies that I am '. $yrDeduced .' year(s) old.';
								}
								if ($userethnicity != '0'){
									$summary .= ' I Hail from '.$kas_framework->getValue('ethnicity_desc', 'ethnicity', 'ethnicity_id', $userethnicity).' tribe, ';
								}
								if ($userbirthcity != '') {
									$summary .= $userbirthcity;
								}
								if ($userbirthstate != '' or $userbirthcountry != '') {
									$summary .= ', '. $kas_framework->getValue('state_name', 'tbl_states', 'state_css', $userbirthstate);
								}
								if ($userbirthcountry != '') {
									$summary .= ', '.$kas_framework->getValue('name', 'country', 'id', $userbirthcountry);
								}
								$summary .= '. I am in currently in '. $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $user_student_grade_year_grade_id). '. ';
								if ($user_bio_address != '') {
								$summary .= 'Also, I Currently Reside at '.$user_bio_address .', '. $user_bio_resident_town . '. ';
								}
								if ($user_bio_mobile != '') {
								$summary .= 'You can Contact me on Mobile through '. $user_bio_mobile .'. ';
								}
								$summary .=  ($user_bio_living_with_parent == '0')? 'I\'m not living with my Parents. ': 'I Living happily with my Parents. ';
								$summary .= '<br /><br /><blockquote>My Parents Guardian</blockquote>';
								if ($userparguardfirstname != '' or $userparguardlastname != '') {
									$summary .= 'The name of my Parents/Guardian is '.$kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $userparguardtitle) .' '.$userparguardfirstname .' '.$userparguardlastname;
								}
								$summary .= '. You can Contact them through either of the following: <br />';
								$summary .= '<div style="margin-left: 30px">';
								if ($userparguardaddress1 != '') {
								$summary .= 'Address 1: '.$userparguardaddress1 .'<br />';
								}
								if ($userparguardaddress2 != '') {
								$summary .= 'Address 2: '.$userparguardaddress2 .'<br />';
								}
								if ($userparguardphone1 != '') {
								$summary .= 'Mobile 1: '.$userparguardphone1 .'<br />';
								}
								if ($userparguardphone2 != '') {
								$summary .= 'Mobile 2: '.$userparguardphone2 .'<br />';
								}
								if ($userparguardphone3 != '') {
								$summary .= 'Mobile 3: '.$userparguardphone3 .'<br />';
								}
								if ($userparguardemail != '') {
								$summary .= 'Email: '.$userparguardemail .'<br />';
								}
								$summary .= '</div>';
								if ($userparguardcity != '' or $userparguardstate != '0') {
								$summary .= 'My Parents/Guardian Hails from '.$userparguardcity .' '. $kas_framework->getValue('state_name', 'tbl_states', 'state_code', $userparguardstate);
								}
								$summary .= '. I Love my parents so much because of their Care and Support. They are very Nice';
								$summary .= '<br /><br /><blockquote>My Previous School</blockquote>';
								if ($userprevschoolname != '') {
									$summary .= 'The name of My previous School is shown below '. $userprevschoolname .'. ';
								}
								$summary .= 'The location of my previous School is Shown Below: <br />'; 
								$summary .= '<div style="margin-left: 30px">';
								if ($userpreviousSchooladdress != ''){
								$summary .= '<br />Address: '.$userpreviousSchooladdress;
								}
								if ($userpreviousSchoolcity != '' and $userpreviousSchoolstate != '0') {
								$summary .= '<br />City and State: '. $userpreviousSchoolcity. ', '.$kas_framework->getValue('state_name', 'tbl_states', 'state_code', $userpreviousSchoolstate);
								}
								if ($userpreviousSchoolcountry != '') {
								$summary .= '<br />Country: '. $kas_framework->getValue('name', 'country', 'id', $userpreviousSchoolcountry);
								}
								$summary .= '</div>';
								
								print $summary; //display all the summary
							}

							 ?>
                            </table>                            
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!-- this row will not appear when printing -->
                    <?php if ($completeness >= 85) {
					print '<div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                        </div>
                    </div>';
					}					?>
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
		<script type="text/javascript">
			completeness = '<?php print $completeness ?>';
			if (completeness < 85) {
				$('.no-print').hide();
			} else {
				$('.no-print').show();
			}
		</script>
    </body>
</html>