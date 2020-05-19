<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas" id="aside">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
			<?php $dynamicimage = $parent->imageDynamic($student_parents_image, $student_parents_sex, $kas_framework->url_root('pictures/'));
						print '<img src="'.$dynamicimage.'" class="img-circle" alt="User Image" />'; ?>
            </div>
            <div class="pull-left info">
                <p>Hello, <?php print $_SESSION['tapp_par_username'] ?></p>

                <a href="#status"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#search" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" required="required" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="click_ult">
                <a href="<?php print $kas_framework->url_root('parent/dashpanel/'); ?>">
                    <i class="fa fa-dashboard text-green"></i> <span>DashPanel</span>
                </a>
            </li>
			<?php if ($parent->BasicPlanParent() == false) { ?>
				 <li class="click_ult">
					<a href="<?php print $kas_framework->url_root('parent/dashpanel/childselector/'); ?>">
						<i class="fa fa-users text-maroon"></i> <span>Child Selection</span>
					</a>
				</li>
			<?php } ?>
            <li class="treeview">
                <a href="<?php print $kas_framework->url_root('parent/dashpanel/profile/'); ?>">
                    <i class="fa fa-user text-ult_custom5"></i>
                    <span>Profile</span>
					 <?php if ($completeness < 50) { $badge = '<small class="badge pull-right bg-red">'.$completeness.'%</small>';
                            } else if ($completeness < 80) { $badge = '<small class="badge pull-right bg-blue">'.$completeness.'%</small>';
                            } else { $badge = '<small class="badge pull-right bg-green">'.$completeness.'%</small>'; }
                    ?>
                     <i class="fa fa-angle-left pull-right"></i>
                   </a>
                <ul class="treeview-menu">
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('parent/dashpanel/profile/'); ?>"><i class="fa fa-cogs text-ult_custom5"></i>View Profile <?php print $badge ?></a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('parent/dashpanel/profile/editprofile'); ?>"><i class="fa fa-edit text-ult_custom6"></i>Edit Profile</a></li>
                </ul>
            </li>
            <li class="click_ult">
                <a href="<?php print $kas_framework->url_root('parent/dashpanel/library/'); ?>">
                    <i class="fa fa-desktop text-fuchsia"></i> <span>School Library</span><small class="badge pull-right bg-green"><?php print $kas_framework->countAll('media_codes') ?></small>
                </a>
            </li>
			<?php if ($parent->BasicPlanParent() == false) { ?>
				<li class="click_ult">
					<a href="<?php print $kas_framework->url_root('parent/dashpanel/mailbox/?folder=inbox'); ?>">
						<i class="fa fa-envelope text-ult_custom4"></i> <span>Mailbox</span>
						<?php  if ($internalMailEx->countUnread() != 0) {
							print '<small class="badge pull-right bg-red">'.$internalMailEx->countUnread().'</small>';
						}
						?>                                
					</a>
				</li>
			<?php  } ?>
			<li class="treeview">
                <a href="#helpdesk">
                    <i class="fa fa-anchor text-red"></i> <span>Help-Desk</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('parent/dashpanel/complaints/'); ?>"><i class="fa fa-bug text-blue"></i>Tapp the Admin</a></li>
                    <li><a href="<?php print $kas_framework->help_url(''); ?>" target="_blank"><i class="fa fa-question-circle text-red"></i>I Need Help</a></li>
                    
              </ul>
            </li>
			
             <li class="click_ult">
                <a href="<?php print $kas_framework->url_root('parent/dashpanel/weather/'); ?>">
                    <i class="fa fa-cloud text-green"></i> <span>Weather Update</span>
                    <small class="badge pull-right bg-green">Free</small>
                </a>
            </li>
            
			
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>