<?php 
require ('../../../php.files/classes/pdoDB.php');
require ('../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthParent();
require (constant('tripple_return').'php.files/classes/generalVariables.php');
require (constant('tripple_return').'php.files/parents_details.php');
require (constant('tripple_return').'php.files/classes/parents.php');
require (constant('tripple_return').'php.files/classes/students.php');
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Child Selector</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('tripple_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('tripple_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('tripple_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<!-- Bootsrap -->
		<link href="<?php print constant('tripple_return') ?>fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('tripple_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="myjs/html5shiv.js"></script>
          <script src="myjs/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
	<style type="text/css">
	h2, p { color: #000}
	</style>
	<?php require (constant('double_return').'inc.files/parentheader.php') ?>
	<p style="margin-top:18px">&nbsp;</p>
	<div class="wrapper row-offcanvas row-offcanvas-left">
	<?php require (constant('double_return').'inc.files/parentsidebar.php') ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       <i class="fa fa-users text-maroon"></i> Child Selection <?php $parent->display_accessLevel() ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
						<li class="active"><i class="fa fa-users"></i> Child Selection</li>
                    </ol>
                </section>

			 <!-- Main content -->
                <section class="content">
				<?php $parent->authConfirm($student_parents_status); $parent->checkBasicPlanParent();
					$kas_framework->getMessageforUser('parent'); ?>
			<div id="confirmationDiv"></div>			
			<!--- already selected children --><div class="row">
				<?php
			/*************************************Showing all the Children both Selected and Unapproved *******************/
				$par_to_kid_Q = "SELECT * FROM parent_to_kids WHERE parent_id = '".$web_parents_relid."' AND confirmation != '2'";
					$db_par_to_kid_Q = $dbh->prepare($par_to_kid_Q);
					$db_par_to_kid_Q->execute();
					$get_par_to_kid_Q_rows = $db_par_to_kid_Q->rowCount();
										
					while($display_child = $db_par_to_kid_Q->fetch(PDO::FETCH_OBJ)) {
			/*************************************looping all the child and selecting their details with their id************/
					$child_id = $display_child->student_id;
					  $combingTheDetails = "SELECT * FROM studentbio WHERE studentbio_id = '".$child_id."'";
					  $db_combingTheDetails = $dbh->prepare($combingTheDetails);
						$db_combingTheDetails->execute();
						$get_combingTheDetails_rows = $db_combingTheDetails->rowCount();
						$paramObj = $db_combingTheDetails->fetch(PDO::FETCH_OBJ);
						$db_combingTheDetails = null;
					  
			/************************************* small plugin for the color if the child is confirmed or not *************/
				if ($display_child->confirmation == '0') { $bgcol = 'red'; $message = 'Awaiting Confirmation'; } 
				else { $bgcol = 'light-ash'; $message = 'Child Confirmed';}		
						print '<div class="ultimrap" style="cursor:pointer" parID = "'.$web_parents_relid.'" stdID = "'.$paramObj->studentbio_id.'">
							<div class="small-box bg-'.$bgcol.'">
								<div class="inner">
									<h2>'.$paramObj->studentbio_fname. ' '. $paramObj->studentbio_lname .'</h2>
									<p>'.$message.'</p>
								</div>
								<div class="icon">';
								$myChildImg = $student->imageDynamic($paramObj->studentbio_pictures, $paramObj->studentbio_gender, $kas_framework->url_root('pictures/'));
									print '<img src="'.$myChildImg.'"  href="'.$myChildImg.'" class="fancybox fancybox.image img-circle" width="80" style="margin:-25px 0 0 0; cursor:pointer" />									
									</div>
								<a href="#" class="small-box-footer">
								   <font color="black"> Select this Child </font><i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>';	
						}
					$db_par_to_kid_Q = null;
				?>
				<!--- already selected children --></div>
				
		<!-- search box--><div style="max-width:300px; display:block; margin:0 auto 20px 0;"><h4>My Child Search</h4>
		<form class="search-form" method="post" id="search_form">
			<div class="input-group">
				<input type="text" required="required" name="search_item_name" class="form-control" placeholder="Type Your Childs Name Here..."/>
				<input type="hidden" name="byepass" class="form-control" value="hb4V5Y98BY897BY6534TDCDCGfgfg" />
				<div class="input-group-btn">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
				</div>
			</div></form></div><!-- search box-->
			
	<div id="message_for_childselect" align="center"></div>	
	
		<?php
/**********************the Search for child function included when the search is clicked*/
	?><div id="search_result_div" style="margin:0 0 20px 0"> </div><?php
/*******************bastard Query starts here for the selection of the phone number from the student contact table*/
			$selQuery = "SELECT * FROM student_contact WHERE ";
							if ($student_parents_mobile1 != '') {
								$selQuery .= "(studentcontact_phone1 = '".$student_parents_mobile1."' 
											OR studentcontact_phone2 = '".$student_parents_mobile1."' 
											OR studentcontact_phone3 = '".$student_parents_mobile1."') OR ";
							}
							if ($student_parents_mobile2 != '') {
								$selQuery .= "(studentcontact_phone1 = '".$student_parents_mobile2."' 
											OR studentcontact_phone2 = '".$student_parents_mobile2."' 
											OR studentcontact_phone3 = '".$student_parents_mobile2."') OR ";
							}
							if ($student_parents_firstname != '') {
								$selQuery .= "(studentcontact_fname = '".$student_parents_firstname."' 
											OR studentcontact_lname = '".$student_parents_firstname."') OR ";
							}
							if ($student_parents_lastname != '') {
								$selQuery .= "(studentcontact_fname = '".$student_parents_lastname."' 
											OR studentcontact_lname = '".$student_parents_lastname."') ";
							}
			$selQuery .= "AND (studentcontact_phone1 != '' OR studentcontact_phone2 != '' OR studentcontact_phone3 != '')";

			$db_selQuery = $dbh->prepare($selQuery);
			$db_selQuery->execute();
			$get_selQuery_rows = $db_selQuery->rowCount();
			
			//print $selQuery;
			
			if ($get_selQuery_rows == '0') {
				$kas_framework->showWarningCallout("Your Details did not Match with any Childs Record in our Knowledge based System.
				Please Use the Search to find your Child. If there is none, then Register your Child");
			} else {
				print '<table id="example1" class="table table-bordered table-striped">
				<h4>Child Suggestion. Select Yours. If the List is Empty, Use the Search</h4>
				<thead><tr><th>Child Details</th><th>Picture</th><th>Action</th></tr></thead><tbody>';
					while ($myProspectChild = $db_selQuery->fetch(PDO::FETCH_OBJ)) {
					/******************* Complex for getting the child details from studentbio and also student_pictures *******/
					$complx = "SELECT * FROM studentbio WHERE studentbio_id = '".$myProspectChild->studentcontact_studentid."'";
					$complx_prep = $dbh->prepare($complx);  $complx_prep->execute();
					$exeComplx = $complx_prep->fetch(PDO::FETCH_OBJ);
							
				/*Making sure that you have not already selected the child ... i.e from the parent_to_kids table*/
				$checkPar_Kid = "SELECT * FROM parent_to_kids WHERE parent_id = '".$web_parents_relid."' AND student_id = '".$myProspectChild->studentcontact_studentid."' LIMIT 1";
					$db_checkPar_Kid = $dbh->prepare($checkPar_Kid);
					$db_checkPar_Kid->execute();
					$get_checkPar_Kid_rows = $db_checkPar_Kid->rowCount();					
					$db_checkPar_Kid = null;
										
					if ($get_checkPar_Kid_rows >= 1) {
			/******************* exclude the child from the list.. apart from that, do the else *******************/
					} else {
	/******************* compute the child details and merge them *******************/
					$autoImage = $exeComplx->studentbio_pictures;
					$autoSex =$exeComplx->studentbio_gender;
					$autolname = $exeComplx->studentbio_lname;
					$autofname = $exeComplx->studentbio_fname;
					$autogender = $exeComplx->studentbio_gender;
					$autodob = $exeComplx->studentbio_dob;
					$autoStdId = $exeComplx->studentbio_internalid;
					$autoMobile = $exeComplx->std_bio_mobile;
					$autoTribe = $kas_framework->getValue('ethnicity_desc', 'ethnicity', 'ethnicity_id', $exeComplx->studentbio_ethnicity);
					/******************* $get_the_student_id = $myProspectChild->studentcontact_studentid ******************/ 
					$myChildImage = $student->imageDynamic($autoImage, $autoSex, $kas_framework->url_root('pictures/'));
					print '<tr>
							<td>Name: '. $autofname .' '. $autolname .'<br /> Gender: '.$autogender.', and Hails from '.$autoTribe.' Tribe 
							<br /> Date Of Birth: '.$autodob.'<br />School ID Number: '.$autoStdId.'<br />Mobile: '.$autoMobile.'</td>
						   <td><img src="'.$myChildImage.'" href="'.$myChildImage.'" style="cursor:pointer" class="fancybox fancybox.image img-circle" width="80" /></td>
							<td><br /><br /><span class="finishSelectChild" childID = "'.$myProspectChild->studentcontact_studentid.'" parentID = "'.$web_parents_relid.'">
							<button class="btn btn-success btn-block">This Is My Child</button></span>
							</td>
							</tr>';
					}
/******************* compute the child details and merge them *******************/
					}
					$db_selQuery = null;
				print ' </tbody></table>';
			}
		?>    
		</section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
		
		<!-- jQuery 2.0.2 -->
        <script src="<?php print constant('tripple_return') ?>myjs/jquery.min.js"></script>
        <!---- my javascript controller -->
        <script src="<?php print constant('tripple_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?php print constant('tripple_return') ?>js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('tripple_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
		<!-- AdminLTE App -->
        <script src="<?php print constant('tripple_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>
		<!-- FancyBox -->
		<script src="<?php print constant('tripple_return') ?>fancybox/jquery.fancybox.js" type="text/javascript"></script>
		<script src="<?php print constant('tripple_return') ?>fancybox/media_helper.js" type="text/javascript"></script>
        <!-- my javascript file -->
		<script type="text/javascript">
			$('.finishSelectChild').click(function() {
				$('#message_for_childselect').html('<?php $kas_framework->loading('center'); ?>');
				childID = $(this).attr('childID'); byepass = "jt3bi5lc2WCYREiVRC";
				parentID = $(this).attr('parentID');
				
				$.post('child_add+Script', {byepass:byepass, childID:childID, parentID:parentID}, function(data){
					$('#message_for_childselect').html(data);
				});			
			})
			
			$('.ultimrap').click(function() {
			$('#confirmationDiv').html('<?php $kas_framework->loading_h('center'); ?>').show();
				parID = $(this).attr('parID');
				stdID = $(this).attr('stdID'); byepass = "fhTRB3SD65f76g7VBDq";
				
				$.post('child_confirm+Script?type=childConfirmation', {parID:parID, stdID:stdID, byepass:byepass}, function(data) {
					$('#confirmationDiv').html(data).show();
				});
				return false;
			})
			
			/* search stuff */
			$('#search_form').submit(function(e) {
			$(this).attr('disabled', 'disabled');
				$('#search_result_div').html('<?php $kas_framework->loading_h(); ?>');
				
				var mydata = $('#search_form :input').serializeArray();
				$.post('child_search', mydata , function(data) {
					$('#search_result_div').html(data);	
				});
				return false;
			});
		</script>
		
		<?php include (constant('tripple_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>
