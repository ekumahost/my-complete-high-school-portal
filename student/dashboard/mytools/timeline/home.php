<?php 
require ( '../../../../php.files/classes/pdoDB.php');
require ( '../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStudent();
require (constant('quad_return').'php.files/classes/students.php');
require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/student_details.php');		
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Timeline</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('quad_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('quad_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php print constant('quad_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.<?php print constant('quad_return') ?>js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
		<style type="text/css">
			select { padding:5px; } 
		</style>
        <!-- header logo: style can be found in header.less -->
		<?php require (constant('tripple_return').'inc.files/header.php') ?>
	<p style="margin-top:18px">&nbsp;</p>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
	<?php require (constant('tripple_return').'inc.files/sidebar.php') ?>
		<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><i class="fa fa-clock-o text-blue"></i> Timeline <?php $student->display_accessLevel(); ?></h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
						<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-th-large"></i>My Tools</a></li>
                        <li class="active"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Timeline</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
			<?php $student->checkBasicPlanStudent(); //$student->authConfirm($useradmitStatus); ?>
                    <!-- row -->
					
                    <div class="row">
					
						<div class="col-md-9">
                            <!-- The time line -->
                            <ul class="timeline">
								<?php /* this is where the php madness will begin */
									$currentdatetime = time('now');
									$initial = 0; /* initial count*/
									$final = 30; /* final counter*/
										
										if (isset($_POST['proceed_button'])) {
										extract($_POST);
											$final = $selectedTimelineRange * 30;
										}
										
										for ($i=$initial; $i<=$final; $i++) {
										/* the almighty for loop */
										$checktime = $currentdatetime - (86400 * $i);
											$the_date = date('d/m/Y', $checktime);
											$the_date_representative = date('jS M Y', $checktime);
											//print $the_date . '<br />';
												//query the database for any matching record on that date
												
												/* for the posting in the discussions */
												$post_query = "SELECT * FROM student_post WHERE post_date = '".$the_date."' 
																AND poster_id = '".$student_id_original."' ORDER BY id DESC";
															$db_post_query = $dbh->prepare($post_query);
															$db_post_query->execute();
															$post_query_counter = $db_post_query->rowCount();															
												
												/* for the commenting in the discussions */
												$post_comment_query = "SELECT * FROM student_post_reply WHERE post_comment_date = '".$the_date."'
																AND post_commenter_id  = '".$student_id_original."' ORDER BY id DESC";
															$db_post_comment_query = $dbh->prepare($post_comment_query);
															$db_post_comment_query->execute();
															$post_comment_query_counter = $db_post_comment_query->rowCount();
															
												/* for the both mails (sent and received)  */
												$mail_query = "SELECT * FROM general_mailing WHERE `time` = '".$the_date."'
																AND (`to`  = '".$username."' OR `from` = '".$username."') ORDER BY id DESC";
															$db_mail_query = $dbh->prepare($mail_query);
															$db_mail_query->execute();
															$mail_query_counter = $db_mail_query->rowCount();
																										
																								
												/* for the school fees mails  */
												$receipts_query = "SELECT * FROM payment_receipts WHERE tution_paid_date = '".$the_date."'
																AND tution_paid_by_user_id  = '".$student_id_original."' ORDER BY tuition_history_id DESC";
															$db_post_receipts_query = $dbh->prepare($receipts_query);
															$db_post_receipts_query->execute();
															$receipts_query_counter = $db_post_receipts_query->rowCount();
																
												
												/* for the notepad created  */
												$notepad_query = "SELECT * FROM student_notepad WHERE dateCreated = '".$the_date."'
																AND author  = '".$student_id_original."' ORDER BY id DESC";
															$db_post_notepad_query = $dbh->prepare($notepad_query);
															$db_post_notepad_query->execute();
															$notepad_query_counter = $db_post_notepad_query->rowCount();
																											
												$totalCount = $post_query_counter + $post_comment_query_counter + $mail_query_counter + $receipts_query_counter + $notepad_query_counter;
												
													if ($totalCount == 0) {
														/* do nothing here */
													} else {
														/* do many things... first of all, print out the date */
														print ' <li class="time-label">
																	<span class="bg-maroon">
																		'.$the_date_representative.'
																	</span>
																</li>';
														
														/* using different while loops, deduce all the fallins and their symbols */
														
														//deducing the post and its placement
														if ($post_query_counter != 0) {
														print '<li>
																<i class="fa fa-comment bg-green"></i><div class="timeline-item">';
															while ($rslt = $db_post_query->fetch(PDO::FETCH_OBJ)) {
																print '<div class="timeline-body"> You ';
																	$incaseText = substr($rslt->post_text, 0, 50) .'... ';
																	print ($rslt->post_image == '') ? ' Posted a Discussion saying <i>"'.$incaseText.'"</i> ' : 'Uploaded an Image to Discussions';
																	print '</div>';
															}
															print '</div></li>';
														}
														
														//deducing the post comments  and its placement
														if ($post_comment_query_counter != 0) {
														print '<li>
																<i class="fa fa-comment-o bg-blue"></i><div class="timeline-item">';
															while ($rslt = $db_post_comment_query->fetch(PDO::FETCH_OBJ)) {
																print '<div class="timeline-body">';
																	$incaseText = substr($rslt->post_comment, 0, 30);
																print ' You Commented on a Discussion post Saying <i>"'.$incaseText.'"</i> ';
																print '</div>';
															}
															print '</div></li>';
														}
														
														//deducing the mail(from and to) and its placement
														if ($mail_query_counter != 0) {
														print '<li>
																<i class="fa fa-envelope bg-green"></i><div class="timeline-item">';
															while ($rslt = $db_mail_query->fetch(PDO::FETCH_OBJ)) {
																print '<div class="timeline-body"> You ';
																//conditional statement here
																print ($rslt->from == $username)? ' sent a Message to '.$rslt->to.' with ': 'received a Message From '.$rslt->from.' with '; 
																	$incaseMessageBody = substr($rslt->message, 0, 30);
																	$incaseMessageHead = substr($rslt->head, 0, 30);
																print ($rslt->head == '') ? 'body saying <i>"'.$incaseMessageBody.'"</i> ': 'head saying <i>"'.$incaseMessageHead.'"</i> ';
																print '</div>';
															}
															print '</div></li>';
														}
														
														//deducing the payment history and its placement
														if ($receipts_query_counter != 0) {
														print '<li>
																<i class="fa fa-credit-card bg-purple"></i><div class="timeline-item">';
															while ($rslt = $db_post_receipts_query->fetch(PDO::FETCH_OBJ)) {
																$receipt_type = $kas_framework->getValue('tuition_codes_desc', 'tuition_codes', 'tuition_codes_id', $rslt->tution_paid_type);
																print '<div class="timeline-body"> You Paid the Amount of N'.$rslt->tution_amount_paid;
																print ' as '.$receipt_type. ' for '.$kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $rslt->tution_paid_terms). ' in '. $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $rslt->tution_paid_grade);
																print '</div>';
															}
															print '</div></li>';
														}
														
														//deducing the notepad history and its placement
														if ($notepad_query_counter != 0) {
														print '<li>
																<i class="fa fa-edit bg-green"></i><div class="timeline-item">';
															while ($rslt = $db_post_notepad_query->fetch(PDO::FETCH_OBJ)) {
																print '<div class="timeline-body"> You Created a Notepad Content with the Header <i>"'.$rslt->title .'"</i>';
																print '</div>';
															}
															print '</div></li>';
														}
											} //end else if
										} // ends the almighty for loop
									$db_post_comment_query = null; $db_post_query = null; $db_mail_query = null; $db_post_receipts_query = null;
								?>
								
                            </ul>
                        </div><!-- /.col -->
						
						<?php include ('timeline_SideBar.php'); ?>
                    </div><!-- /.row -->
				</section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- jQuery 2.0.2 -->
        <script src="<?php print constant('quad_return') ?>myjs/jquery.min.js"></script>
		<!---- my javascript controller -->
        <script src="<?php print constant('quad_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('quad_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php print constant('quad_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>
		<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>