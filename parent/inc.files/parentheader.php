<?php 
/* dynamic retriever for the mailing dropdown */
if (file_exists(constant('single_return').'php.files/mailbox_handlers/retrieve-mail+counter.php')) {
	include (constant('single_return').'php.files/mailbox_handlers/retrieve-mail+counter.php');
} else if (file_exists(constant('double_return').'php.files/mailbox_handlers/retrieve-mail+counter.php')) {
	include (constant('double_return').'php.files/mailbox_handlers/retrieve-mail+counter.php');
} else if (file_exists(constant('tripple_return').'php.files/mailbox_handlers/retrieve-mail+counter.php')) {
	include (constant('tripple_return').'php.files/mailbox_handlers/retrieve-mail+counter.php');
} 
?>
 <!-- header logo: style can be found in header.less -->
        <header class="header" style="position:fixed;">
            <a href="<?php print $kas_framework->url_root('parent/dashpanel/'); ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                KaSP -> Parent
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
					<?php if ($parent->BasicPlanParent() == false) { ?>
                        <li class="dropdown messages-menu">
                            <a href="#messages" class="dropdown-toggle" data-toggle="dropdown">
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
                         <li class="footer click_ult"><a href="<?php print $kas_framework->url_root('parent/dashpanel/mailbox/?folder=inbox') ?>">
                         See All Messages</a></li>
                            </ul>
                        </li>
						<?php  } ?>
					   <!-- Notifications: style removed -->
						<!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#usermenu" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php print $_SESSION['tapp_par_username']; ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-custom">
								   <?php $dynamicimage = $parent->imageDynamic($student_parents_image, $student_parents_sex, $kas_framework->url_root('pictures/'));
								print '<img src="'.$dynamicimage.'" class="img-circle" alt="User Image" />'; ?><p>
                            <?php print ucfirst($web_parents_flname) ?> - Parents/Guardian
							<small>	<?php print date('l\, jS F Y'); ?><br />
							<?php print $current_year_full; ?> Session</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                         <a href="<?php print $kas_framework->url_root('parent/dashpanel/profile/'); ?>" class="btn btn-default btn-flat click_ult">Profile</a>
										<a href="<?php print $kas_framework->url_root('parent/dashpanel/childselector/'); ?>" class="btn btn-default btn-flat click_ult">Child</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#signout" class="btn btn-default btn-flat" id="signout_par">Sign out</a>
                                    </div>
									<div id="signoutspan" class="pull-right"></div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>