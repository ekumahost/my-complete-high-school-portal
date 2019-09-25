<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Maintenance</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="img/sch_logo.png" />
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
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Maintenance Mode
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">Maintenance</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 
                    <div class="error-page">
                        <h2 class="headline text-info"> 607</h2>
                        <div class="error-content">
                            <h3><i class="fa fa-warning text-yellow"></i> Oops! So Sorry.</h3>
                            <p> 
                                We are Sorry to Say but the Poral is Under Maintenance. 
								We wont like you to encounter some errors while Surfing the portal. <br />
								We will be back shortly... <br /><br /><br />
								<?php  $reference = str_ireplace('.php', '', @$_SERVER['HTTP_REFERER']); ?>
								  <a href="#mode=active?rdr" class="btn bg-custom text-white btn-block" id="button_release">
									 Maintenance Mode Active.
									</a>
                            </p><br /><br />
							<span>The Button Above will be Activated when the Maintenance mode is turned off. <b>Do not Refresh.</b> Stay with Us.</span>
							<span id="result_status" style="display:none"><br /><br />Checked 30 Seconds Ago... Checking Again....
															<img src="img/ajax-loader.gif" width="30"> </span>
							<span id="maintenance_result"></span>
					  </div><!-- /.error-content -->
                    </div><!-- /.error-page -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="myjs/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
		<!----- my script ----->
		<script type="text/javascript">
		
		function check_maintenance() {
		byepass = "iuNIRYTYcrwqdUYBO9";
		reference = "<?php print $reference ?>";
			$.post('php.files/maintenance_check', {reference:reference, byepass:byepass}, function(data){
				$('#maintenance_result').html(data);
			})	
		}
		
		setInterval(function(e) {
			check_maintenance();
			$('#result_status').fadeIn(1000).delay(10000).fadeOut(1000);
		}, 30000); /*sends request every 30 seconds*/
		
		check_maintenance();
		
		
		</script>
    </body>
</html>