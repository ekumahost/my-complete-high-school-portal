<?php 
require ('php.files/classes/pdoDB.php'); 
require ('php.files/classes/kas-framework.php'); 
	$kas_framework->safesession();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Redirecting...</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
     </head>  
	<body>
	<center><br />Preparing Portal. Please wait. This will not take long... <br /><br />
	</center>
	<?php 
		/* for parents */
		if (isset($_SESSION['tapp_par_username']) and @$_GET['press'] == 'pt') {
			$redirect = '<script type="text/javascript"> self.location = "'.$kas_framework->url_root('parent/dashpanel/').'"</script>';
		/* for students */
		} else if (isset($_SESSION['tapp_std_username']) and @$_GET['press'] == 'st') {
			
			$redirect = '<script type="text/javascript"> self.location = "'.$kas_framework->url_root('student/dashboard/').'"</script>';
		/* for staff */
		} else if (isset($_SESSION['tapp_staff_username']) and @$_GET['press'] == 'sf') {
			$redirect = '<script type="text/javascript"> self.location = "'.$kas_framework->url_root('staff/dashpanel/').'"</script>';
		/* for prospective Students*/
		} else if (isset($_SESSION['tapp_prostd_username']) and @$_GET['press'] == 'pst'){
			$redirect = '<script type="text/javascript"> self.location = "'.$kas_framework->url_root('prospectStudent/dashboard/').'"</script>';
		/* for all of them */
		} else {
			$redirect = '<script type="text/javascript"> self.location = "'.$kas_framework->url_root('').'"</script>';
		}
		
		print $redirect;

	?>
	
	
	</body>
      
</html>
