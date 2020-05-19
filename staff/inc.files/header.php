<?php 
/* dynamic retriever for the mailing dropdown */
if (file_exists(constant('single_return').'php.files/mailbox_handlers/retrieve-mail+counter.php')) {
	include (constant('single_return').'php.files/mailbox_handlers/retrieve-mail+counter.php');
} else if (file_exists(constant('double_return').'php.files/mailbox_handlers/retrieve-mail+counter.php')) {
	include (constant('double_return').'php.files/mailbox_handlers/retrieve-mail+counter.php');
} else if (file_exists(constant('tripple_return').'php.files/mailbox_handlers/retrieve-mail+counter.php')) {
	include (constant('tripple_return').'php.files/mailbox_handlers/retrieve-mail+counter.php');
} else if (file_exists(constant('quad_return').'php.files/mailbox_handlers/retrieve-mail+counter.php')) {
	include (constant('quad_return').'php.files/mailbox_handlers/retrieve-mail+counter.php');
}
/*dynamic retriever for the task dropdown */
if (file_exists('mytools/calendar/retrieve-task+counter.php')) {
	include ('mytools/calendar/retrieve-task+counter.php');
} else if (file_exists(constant('single_return').'mytools/calendar/retrieve-task+counter.php')) {
	include (constant('single_return').'mytools/calendar/retrieve-task+counter.php');
} else if (file_exists(constant('double_return').'mytools/calendar/retrieve-task+counter.php')) {
	include (constant('double_return').'mytools/calendar/retrieve-task+counter.php');
} else if (file_exists(constant('tripple_return').'calendar/retrieve-task+counter.php')) {
	include (constant('tripple_return').'calendar/retrieve-task+counter.php');
}
?>
 <!-- header logo: style can be found in header.less -->
        <header class="header" style="position:fixed;">
            <a href="<?php print $kas_framework->url_root('staff/dashpanel/'); ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                KaSP -> Staff
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#toggle" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
					<!-- Messages: style can be found in dropdown.less-->
				<?php if ($staff->basicPlan() == false) {			
		/*Process all the Calculations for the Drop down*/ 
				
				
			$totalPost = $kas_framework->countRestrict1('staff_post', 'post_date', date('d/m/Y'));
			$mailFromCountToday = $kas_framework->countRestrict2('general_mailing', 'time', date('d/m/Y'), 'from', $_SESSION['tapp_staff_username']);
			$mailToCountToday = $kas_framework->countRestrict2('general_mailing', 'time', date('d/m/Y'), 'to', $_SESSION['tapp_staff_username']);
			$schoolEvents = $kas_framework->countRestrict1('school_calendar', 'start_date', date('d/m/Y'));
			$totalMailTrans = $mailFromCountToday + $mailToCountToday;
				
				$totalClockEventCount = 0;
				if ($totalPost > 0) { $totalClockEventCount = $totalClockEventCount + 1; }
				if ($totalMailTrans > 0) { $totalClockEventCount = $totalClockEventCount + 1; }
				if ($schoolEvents > 0) { $totalClockEventCount = $totalClockEventCount + 1; }
				if ($kas_framework->birthdayCountHeader() > 0) { $totalClockEventCount = $totalClockEventCount + 1; }
				
				?>
						<!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu">
                            <a href="#notification_menu" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-info-circle"></i>
             <?php print ($totalClockEventCount == 0)? '': '<span class="label label-default">'.$totalClockEventCount.'</span>'; ?>                   
                            </a>
				<ul class="dropdown-menu">
					<li class="header">What Happened Today?</li>
					  <li>
					   <ul class="menu">
							<li class="click_ult"><a href="<?php print $kas_framework->url_root('staff/dashpanel/social/birthdays/') ?>">
									<i class="fa fa-gift bg-red"></i> Total Birthday Today (<?php print $kas_framework->birthdayCountHeader() ?>)
							</a></li>
					<!-------------------------------------------------->
							<li class="click_ult"><a href="<?php print $kas_framework->url_root('staff/dashpanel/social/discussions/') ?>">
									<i class="fa fa-comments bg-blue"></i> Total Post Today (<?php print $totalPost ?>)
							</a></li>
					<!-------------------------------------------------->
							<li class="click_ult"><a href="<?php print $kas_framework->url_root('staff/dashpanel/#schoolCalendar') ?>">
									<i class="fa fa-calendar-o bg-fuchsia"></i> School Events Today (<?php print $schoolEvents ?>)
							</a></li>
					<!-------------------------------------------------->
					<li class="click_ult"><a href="<?php print $kas_framework->url_root('staff/dashpanel/mailbox?folder=inbox') ?>">
							<i class="fa fa-envelope bg-olive"></i> Mail Transactions Total (<?php print $totalMailTrans ?>)
					</a></li>
						</ul>
					</li>
					<li class="footer"><a href="#view_all">View all</a></li>
				</ul>
              </li>
			  
			 <li class="dropdown tasks-menu">
				<a href="#task_menu" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-tasks"></i>
			<?php print ($initCount != 0)?'<span class="label label-default">'.$initCount.'</span>': ''; ?>
				</a>
				<ul class="dropdown-menu">
					<li class="header">This Weeks Event (<?php print $initCount; ?> in total)</li>
					<li>
						<!-- inner menu: contains the actual data -->
						<ul class="menu">
							<!-- Task item -->
							<?php 
								for($i=1;$i<=$initCount;$i++) {
									print $weekEvent[$i];
								}
							print ($initCount == 0)? $emptyMessage: '';
							?>
							<!-- end task item -->
						</ul>
					</li>
					<li class="footer click_ult">
						<a href="<?php print $kas_framework->url_root('staff/dashpanel/mytools/calendar#eventTable') ?>">View all tasks</a>
					</li>
				</ul>
			</li>	
			  
			<li class="dropdown messages-menu">
				<a href="#messages_dropdown" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-envelope"></i>
			<?php print ($internalMailEx->countUnread() != 0)?'<span class="label label-danger">'. $internalMailEx->countUnread() .'</span>': ''; ?>
				</a>
				<ul class="dropdown-menu">
						<?php print $internalMailEx->showTotalMessageNewForHeader(); ?>
					<li>
						<!-- inner menu: contains the actual data -->
						<ul class="menu">
						<?php print $internalMailEx->getMessageForHeader(); ?>
						</ul>
					</li>
			 <li class="footer click_ult"><a href="<?php print $kas_framework->url_root('staff/dashpanel/mailbox/?folder=inbox') ?>">
			 See All Messages</a></li>
				</ul>
			</li>

				<?php  } ?>
						<!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#user_menu" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php print $_SESSION['tapp_staff_username']; ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-custom">
						   <img src="<?php print $kas_framework->imageDynamic($staff_image, $staff_sex, $kas_framework->url_root('pictures/')) ?>" class="img-circle" alt="User Image" />
							<p>
                            <?php print ucfirst($web_users_flname) ?> - Staff
							<small>	<?php print date('l\, jS F Y'); ?><br />
							<?php print $current_year_full; ?> Session</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                         <a href="<?php print $kas_framework->url_root('staff/dashpanel/profile/'); ?>" class="btn btn-default btn-flat click_ult">Profile</a>
                                    </div>
									<?php if ($staff->checkTeacher($web_users_type) == true){ ?>
									<div class="pull-left" style="margin-left:5px">
                                         <a href="<?php print $kas_framework->url_root('staff/dashpanel/mytools/'); ?>" class="btn btn-default btn-flat click_ult">My Tools</a>
                                    </div>
									<?php } ?>
                                    <div class="pull-right">
                                        <a href="#signout" class="btn btn-default btn-flat" id="signout_tea">Sign out</a>
									</div>
									<div id="signoutspan" class="pull-right"></div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
<style type="text/css">
.right-side {
	min-height: 1200px !important; /* This is so that the main right page will not be flickering in case of short page contents */
}
</style>