<?php 
require ('php.files/classes/pdoDB.php'); 
require ('php.files/classes/kas-framework.php'); 

require ('php.files/classes/generalVariables.php');
require ('php.files/classes/PHPMailer/PHPMailerAutoload.php');
require ('php.files/classes/mailing_list.php');
require ('php.files/classes/confirmationz.php');
$school_mail = $kas_framework->getValue('email', 'tbl_school_profile', 'id', '1');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Resend Confirmation Mail</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
		<header class="header">
            <a href="" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                HTNApp - Resend
            </a>
		</header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Resend Confirmation Mail
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"><i class="fa fa-asterisk"></i>&nbsp;&nbsp;Resend Confirmation</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 
                    <div class="error-page">
					<!-- form start -->
					<?php 						
				/* putting the form in a variable  */
				$confirmation_form = '<form role="form" action="" method="post">
							<div class="box-body">
								<div class="form-group">
									<label for="exampleInputEmail1">You are a</label>
									<select name="type" name="type" class="form-control" required>
										<option value="">-- Select One --</option>
										<option value="staff">Staff</option> 
										<option value="parent">Parent</option> 
										<option value="student">Student</option> <option value="student">Prospect Student</option>
									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Email Address/Username</label>
									<input type="text" required="required" class="form-control" name="resendPar" placeholder="Enter Email Address">
								</div>

							</div><!-- /.box-body -->

							<div class="box-footer">
								<button type="submit" name="resendMail_button" class="btn btn-primary">Resend Confirmation Code</button>
							</div>
						</form>';
					
					if (isset($_POST['resendMail_button'])) {
						extract($_POST);
					//here is thesame function that will send the user the initial confirmation mail from the resigtration panel
						if ($kas_framework->strIsEmpty($type) and $kas_framework->strIsEmpty($resendPar)) {
							$kas_framework->showWarningCallout('Please select the email type and/or enter your email address');
						} else {
							//here, we have to check if the user type is student, parent, or staff and then work with the shit
							if ($type == "staff") { //comes in when the selected is a parent
                                $deduce_details = "SELECT * FROM staff AS s, web_users AS wu WHERE (s.staff_email = '".$resendPar."' OR wu.web_users_username = '".$resendPar."') AND s.staff_id = wu.web_users_relid";
								$db_deduce_details = $dbh->prepare($deduce_details);
								$db_deduce_details->execute();
								$get_deduce_details_rows = $db_deduce_details->rowCount();
								$paramObj = $db_deduce_details->fetch(PDO::FETCH_OBJ);
								$db_deduce_details = null;
                                    
									if ($get_deduce_details_rows == 0) {
                                        $kas_framework->showDangerCallout("No Email or Username found with the details supplied. Please try again");
                                    } else if ($paramObj->web_users_active == '0') {
                                        $kas_framework->showDangerCallout("This account was blocked by the school administration. Please consult the school administrator");
                                    } else if ($paramObj->web_users_active == '1') {
                                        $kas_framework->showDangerCallout("This account is active. Please check the username supplied");
                                    } else {
										$send_mail = $mailing_list->SendUserConfirmationEmail($paramObj->staff_email, $paramObj->web_users_username, $school_mail, /*$school_mail,*/ $paramObj->web_users_active, $kas_framework->returnUserSchool(''), 'staff');
                                            $kas_framework->showInfoCallout("A mail has been sent to your email address. Please go and click on the confirmation link.  Emails may take up to 5 Minutes. Please be Patient.");
                                         
                                    }
                            //here, the staff resend email ends...
                            } else if ($type == "parent") { //comes in when the selected is a parent
                                $deduce_details = "SELECT * FROM student_parents AS sp, web_parents AS wp WHERE (sp.student_parents_email = '".$resendPar."' OR wp.web_parents_username = '".$resendPar."') AND wp.web_parents_relid = sp.student_parents_id";
								$db_deduce_details = $dbh->prepare($deduce_details);
								$db_deduce_details->execute();
								$get_deduce_details_rows = $db_deduce_details->rowCount();
								$paramObj = $db_deduce_details->fetch(PDO::FETCH_OBJ);
								$db_deduce_details = null;
								
                                if ($get_deduce_details_rows == 0) {
                                    $kas_framework->showDangerCallout("No Email or Username found with the details supplied. Please try again");
                                } else if ($paramObj->web_parents_active == '0') {
                                    $kas_framework->showDangerCallout("This account was blocked by the school administration. Please consult the school administrator");
                                } else if ($paramObj->web_parents_active == '1') {
                                        $kas_framework->showDangerCallout("This account is active. Please check the username supplied");
                                } else {
                                    $send_mail = $mailing_list->SendUserConfirmationEmail($paramObj->student_parents_email, $paramObj->web_parents_username, $school_mail, /*$school_mail,*/ $paramObj->web_parents_active, $kas_framework->returnUserSchool(''), 'parent');
										$kas_framework->showInfoCallout("A mail has been sent to your email address. Please go and click on the confirmation link.  Emails may take up to 5 Minutes. Please be Patient.");
                                   
                                }
                            } else if ($type == "student") { //comes in when the selected is a student
                                    $deduce_details = "SELECT * FROM web_students WHERE (user_n = '".$resendPar."' OR email = '".$resendPar."')";
									$db_deduce_details = $dbh->prepare($deduce_details);
									$db_deduce_details->execute();
									$get_deduce_details_rows = $db_deduce_details->rowCount();
									$paramObj = $db_deduce_details->fetch(PDO::FETCH_OBJ);
									$db_deduce_details = null;
                                        if ($get_deduce_details_rows == 0) {
                                            $kas_framework->showDangerCallout("No Email or Username found with the details supplied. Please try again");
                                        } else if ($paramObj->status == '0') {
                                            $kas_framework->showDangerCallout("This account was blocked by the school administration. Please consult the school administrator");
                                        } else if ($paramObj>status == '1') {
											$kas_framework->showDangerCallout("This account is active. Please check the username supplied");
										} else {
                                            $send_mail = $mailing_list->SendUserConfirmationEmail($paramObj->email, $user_n, $school_mail, $paramObj->status, $kas_framework->returnUserSchool(''), 'student');
												$kas_framework->showInfoCallout("A mail has been sent to your email address. Please go and click on the confirmation link.  Emails may take up to 5 Minutes. Please be Patient.");
                                           
                                        }
                            }
						}
						//print $confirmation_form;
					}
				print $confirmation_form;
				print '<br /><br />';
		    		$kas_framework->showInfoCallout('If you used a wrong email address, please contact your school administrator to help you fix this.');
				?>
					
                    </div><!-- /.error-page -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="myjs/jquery.min.js"></script>
		 <!-- feccukcontroller -->
        <script src="myjs/feccukcontroller.js" type="text/javascript" ></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
    </body>
</html>