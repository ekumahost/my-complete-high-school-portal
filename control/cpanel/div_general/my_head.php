<body>
<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
<!-- topbar starts -->
<div style="position:fixed; width:100%;z-index:998">
  <div class="navbar">
    <div class="navbar-inner" style="border-radius:0 !important; box-shadow:3px 3px 10px #000 !important">
      <div class="container-fluid"><?php 
	  $image_src = $kas_framework->getValue('school_logo_path', 'tbl_config', 'id', '1');
	  if($image_src== ''){
		  $image_src = 'tera.png';
		 }
	?> 
	  
	  <a class="brands" href="index"> <img alt="SCHOOL LOGO" height="50px" style="margin-bottom:-20px; border:1px solid #000" src="../../files/images/<?php echo $image_src;?>" /></a>
	  
        <!-- user dropdown starts -->
        <div class="btn-group pull-right" > <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> 
		<i class="icon-user"></i><span class="hidden-phone"> Admin</span> <span class="caret"></span> </a>
          <ul class="dropdown-menu">
            <li><a href="main?page=profile">School Profile</a></li>
			<li><a href="main?page=password"> Change Password</a></li>
            <li><a href="../logout.php">Logout</a></li>
          </ul>
        </div>
        <!-- theme selector starts -->
        <div class="btn-group pull-right theme-container" > <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> <i class="icon-tint"></i> Theme <span class="hidden-phone"></span> <span class="caret"></span> </a>
          <ul class="dropdown-menu" id="themes">
            <li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
            <li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
            <li><a data-value="cyborg" href="#"><i class="icon-blank"></i> Cyborg</a></li>
            <li><a data-value="redy" href="#"><i class="icon-blank"></i> Redy</a></li>
            <li><a data-value="journal" href="#"><i class="icon-blank"></i> Journal</a></li>
            <li><a data-value="simplex" href="#"><i class="icon-blank"></i> Simplex</a></li>
            <li><a data-value="slate" href="#"><i class="icon-blank"></i> Slate</a></li>
            <li><a data-value="spacelab" href="#"><i class="icon-blank"></i> Spacelab</a></li>
            <li><a data-value="united" href="#"><i class="icon-blank"></i> United</a></li>
          </ul>
        </div>
        <!-- theme selector ends -->
        <div class="btn-group pull-right theme-container"> <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon icon-gear"></i> Settings <span class="hidden-phone"></span> <span class="caret"></span> </a>
          <ul class="dropdown-menu" role="menu">
			<li><a href="main?page=switchterm"><i class="icon icon-color icon-wrench"></i> Change Term</a></li>
			<li><a href="switch_session"><i class="icon icon-color icon-gear"></i> Change Session</a></li>
          <li><a href="year_simulator"><i class="icon icon-color icon-gear"></i> Simulate Year/Term Switch</a></li>
			<li class="divider"></li>
            <li><a href="main?page=schoolapp&tools=api#mainsetting"><i class="icon icon-color icon-add"></i> Portal API Settings</a></li>
            <li><a href="main?page=schoolapp&tools#mainsetting"><i class="icon icon-color icon-gear"></i> General Portal Settings</a></li>
           <li><a href="main?page=administrative"><i class="icon icon-color icon-gear"></i> Administrative Settings</a></li>
           <li><a href="admin_configuration.php?action=edit&operator=admin&position=adminArea&user=Administrator&page=configindex&do=yes"><i class="icon icon-gear"></i> General Configuration</a></li>
          </ul>
        </div>
        <div class="btn-group pull-right theme-container"> <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon icon-wrench"></i> Control <span class="hidden-phone"></span> <span class="caret"></span> </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="main?page=parent_child"><i class="icon icon-color icon-users"></i> Parents and Children</a></li>
			<li><a href="main?page=administrative&tool=gtd"><i class="icon icon-color icon-home"></i> Grade Term days</a></li>
            <li><a href="main?page=administrative&tool=calendar"><i class="icon icon-color icon-calendar"></i> School Calendar</a></li>
			<li><a href="fees?page=defaultfees#mainsetting"><i class="icon icon-color icon-book"></i> Default School Fee</a></li>
			<li><a href="main?page=schoolapp&tools=login#mainsetting"><i class="icon icon-color icon-calendar"></i> Login Controls</a></li>
		  <li class="divider"></li>
		  <li><a href="modules?controller=academicAdviser"><i class="icon icon-color icon-users"></i> Teachers &amp; Students</a></li>
            <li><a href="modules?controller=admission_sett"><i class="icon icon-color icon-users"></i> Call for Admission</a></li>
            <li><a href="main?page=demote"><i class="icon icon-color icon-user"></i> Change Student Class</a></li>
            <li><a href="main?page=demote"><i class="icon icon-color icon-user"></i> Change Admission Status</a></li>
		  </ul>
        </div>
        <div class="btn-group pull-right" >
        <?php
			//include_once "../includes/ez_sql.php";
			@$nyear=$_SESSION['CurrentYear'];
			@$cyear = $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $nyear);
			
			  @$cterm_id = $_SESSION['CurrentTerm'];
              @$cterm= $kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $cterm_id);

			if (empty($cyear) && $nyear != 0) // at this point the user is looged out automatically
						{// so take him to login page

			echo '<script type="text/javascript">
				<!--
				window.location = "../index.php?action=notauth&ref=header"
				//-->
				</script>';exit;
			}

			if ($nyear == 0){
				// we are in propagation period
				$cyear = 'propagation';
				$cterm = 'Pending';
				}
			?>
				<font style="font-size:15px; margin-top:10px">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?>: <?php echo @$cyear;  ?> <?php echo @$cterm;  ?></font> &nbsp;&nbsp;&nbsp; 
			</div>
		<!-- user dropdown ends -->
      </div>

	  </div>
  </div>
</div>
<!-- topbar ends -->
<?php } ?>
<br>
<br>
<br>
<br>