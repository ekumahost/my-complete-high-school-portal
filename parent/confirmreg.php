<?php 
	require ('../php.files/classes/pdoDB.php'); 
	require ('../php.files/classes/kas-framework.php'); 
		$kas_framework->freeDBConnect();
		require ('../php.files/classes/confirmationz.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Confirm Registration</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
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
            <a href="../" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                HTNApp - Confirm
            </a>
		</header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Confirm Registration
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"><i class="fa fa-asterisk"></i>&nbsp;&nbsp;Confirm Registration</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 
                    <div class="error-page">
					<!-- form start -->
					<?php 
						
				/* putting the form in a variable  */
						$confirmation_form_par = '<form role="form" action="" method="get">
							<div class="box-body">
								<div class="form-group">
									<label for="exampleInputEmail1">Confirmation Code</label>
									<input type="text" required="required" class="form-control" name="cidp" placeholder="Enter confirmation code">
								</div>

							</div>

							<div class="box-footer">
								<button type="submit" class="btn btn-primary">Activate acount</button>
								<a href="../mailResender" class="btn btn-default">Didnt see any Confirmation Email</a>
							</div>
						</form>';
					
					if (isset($_GET['cidp'])) {
						$confirmation->ConfirmUserParent($_GET['cidp']);
						print '<h2>Parents Confirmation Code</h2>';
						print $confirmation_form_par;
						
					} else {
		
						print '<h2>Parents Confirmation Code</h2>';
						print $confirmation_form_par;
				
						print '<br /><br />';
						$kas_framework->showInfoCallout('You can find your Confirmation code in your Email Address. Please Check your Email Address to get this Code');
				
					}
					?>
					
                    </div><!-- /.error-page -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="../myjs/jquery.min.js"></script>
		 <!-- feccukcontroller -->
        <script src="../myjs/feccukcontroller.js" type="text/javascript" ></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../js/AdminLTE/app.js" type="text/javascript"></script>
    </body>
</html>