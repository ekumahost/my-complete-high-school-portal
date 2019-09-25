<!-- include config -->
<!-- include settings -->
<!-- include security, check if user is acessing this page directly -->
 <?php
 define ('DIRECT_PASS', true);
 $timeout = 7000; // in seconds
//LETS CATCH THE HACKER HERE
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!--SchoolApp v1.0.0 DEVELOPED BY OKOKOH BENJAMIN EKUMA & Kelvin -->
	<meta charset="utf-8">

	<?php if (!defined('handletitle')) {
	// this little thing here does a magic by importing title from included pages in homepage.php, these pages are included by IMPORT.php switch
		echo'<title>'.$title.'</title>';
	}// do not define title tag again
?>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="kAsTech School Management System.">
	<meta name="author" content="kAsTech Network Limited">

	<!-- The styles -->
	<link id="bs-css" href="../css/bootstrap-classic.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	
	  }
	  .mybody {
	  background-color:#C0DBDC;
	  }
	   .mycontent {
	  margin-left:50px; margin-top:20px;
	  }
	</style>
	<link href="../css/bootstrap-responsive.css" rel="stylesheet">
	<link href="../css/charisma-app.css" rel="stylesheet">
	<link href="../css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='../css/fullcalendar.css' rel='stylesheet'>
	<link href='../css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='../css/chosen.css' rel='stylesheet'>
	<link href='../css/uniform.default.css' rel='stylesheet'>
	<link href='../css/colorbox.css' rel='stylesheet'>
	<link href='../css/jquery.cleditor.css' rel='stylesheet'>
	<link href='../css/jquery.noty.css' rel='stylesheet'>
	<link href='../css/noty_theme_default.css' rel='stylesheet'>
	<link href='../css/elfinder.min.css' rel='stylesheet'>
	<link href='../css/elfinder.theme.css' rel='stylesheet'>
	<link href='../css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='../css/opa-icons.css' rel='stylesheet'>
	<link href='../css/uploadify.css' rel='stylesheet'>
	
	
	
		<!-- ThIS IS THE ONE DOING AJAX CALL ON PAGES -->
<script src="js/jquery-1.7.2.min.js"></script>


	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="../lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="../source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="../source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="../source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="../source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="../source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="../source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="../source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('logo') ?>" />
		</head>