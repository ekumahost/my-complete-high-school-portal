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
            <a href="<?php print $kas_framework->server_root_dir('prospectStudent/dashboard'); ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
              KaSP -> Prospect 
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
	
			<!---- if the plan of the logged in user is the basic plan, then somethings should no be made visible-->
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#user_menu" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php print $_SESSION['tapp_prostd_username']; ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-custom">
							<?php $dynamicimage = $kas_framework->imageDynamic($userpicturepath, $usergender, $kas_framework->server_root_dir('pictures/'));
								print '<img src="'.$dynamicimage.'" class="img-circle" alt="User Image" />'; ?>
								 <p>
                            <?php print ucfirst($userfirstname) ?> - Pros-Student
							<small>	<?php print date('l\, jS F Y'); ?><br />
							<?php print $current_year_full; ?> Session</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                         <a href="<?php print $kas_framework->server_root_dir('prospectStudent/dashboard/profile/'); ?>" class="btn btn-default btn-flat click_ult">Profile</a>
                                         <a href="<?php print $kas_framework->server_root_dir('prospectStudent/dashboard/photocard/'); ?>" class="btn btn-default btn-flat click_ult">PhotoCard</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#sign_out" class="btn btn-default btn-flat" id="signout_prosStd">Check Out</a>
                                    </div>
									<div id="signoutspan" class="pull-right"></div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>