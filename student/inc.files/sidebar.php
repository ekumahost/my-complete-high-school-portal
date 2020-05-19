<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas" id="aside">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
		<?php $dynamicimage = $kas_framework->imageDynamic($userpicturepath, $usergender, $kas_framework->url_root('pictures/'));
		print '<img src="'.$dynamicimage.'" class="img-circle" alt="User Image" />';
		?>
                
            </div>
            <div class="pull-left info">
                <p>Hello, <?php print $_SESSION['tapp_std_username'] ?></p>

                <a href="#online_status"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#searchform" method="get" class="sidebar-form">
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
                <a href="<?php print $kas_framework->url_root('student/dashboard/'); ?>">
                    <i class="fa fa-dashboard text-green"></i> <span>Dashboard</span>
                </a>
            </li>
			 <li class="treeview">
                <a href="<?php print $kas_framework->url_root('student/dashboard/wallet/'); ?>">
                    <i class="fa fa-briefcase text-blue"></i>
                    <span>Wallet</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/wallet/'); ?>"><i class="fa fa-briefcase text-ult_custom4"></i>My Wallet</a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/wallet/payment+history'); ?>"><i class="fa fa-list-alt text-fuchsia"></i>Payment History</a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/wallet/recharge+history'); ?>"><i class="fa fa-list text-green"></i>Recharge History</a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/payment/receipt/print+receipt_collection'); ?>"><i class="fa fa-print text-yellow"></i>Print Receipts</a></li>
                 </ul>
            </li>
            <li class="treeview">
                <a href="<?php print $kas_framework->url_root('student/dashboard/payment/'); ?>">
                    <i class="fa fa-tags text-maroon"></i>
                    <span>General Payment</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/payment/schoolfees/#feesBreakdown'); ?>"><i class="fa fa-credit-card text-maroon"></i>School Fees</a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/integration'); ?>"><i class="fa fa-credit-card text-blue"></i>Hostel Fees</a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/payment/shop/'); ?>"><i class="fa fa-shopping-cart text-red"></i>Purchase School Item</a></li>
                    </ul>
            </li>
			<li class="treeview">
                <a href="<?php print $kas_framework->url_root('student/dashboard/academics/'); ?>">
                    <i class="fa fa-dot-circle-o text-fuchsia"></i>
                    <span>Academics</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/academics/schooltimetable/'); ?>"><i class="fa fa-table text-maroon"></i>School Timetable</a></li>
                     <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/academics/homework/'); ?>"><i class="fa fa-suitcase text-ult_custom"></i>Homework</a></li>
                     <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/academics/classnote/'); ?>"><i class="fa fa-ticket text-blue"></i>Class Note</a></li>
                     <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/academics/library/'); ?>"><i class="fa fa-desktop text-fuchsia"></i>School Library <small class="badge pull-right bg-green"><?php echo $kas_framework->countAll('media_codes'); ?></small></a></li>
				 </ul>
            </li>
			
			<li class="click_ult">
                <a href="<?php print $kas_framework->url_root('student/dashboard/results/'); ?>">
                    <i class="fa fa-list-alt text-ult_custom"></i> <span>Results</span>
                    <?php $kas_framework->app_config_indicator('student_result_checking'); ?>
                </a>
            </li>
			
			
			<li class="treeview">
                <a href="<?php print $kas_framework->url_root('student/dashboard/demography/'); ?>">
                    <i class="fa fa-sitemap text-ult_custom"></i>
                    <span>Demography</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/demography/attendance/'); ?>"><i class="fa fa-ellipsis-h text-yellow"></i>Attendance</a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/demography/discipline/'); ?>"><i class="fa fa-meh-o text-green"></i>Discipline </a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/demography/health/'); ?>"><i class="fa fa-plus-square text-maroon"></i>Health Report</a></li>
                    </ul>
            </li>
			
            <li class="treeview">
                <a href="#registration">
                    <i class="fa fa-bookmark"></i> <span>Registration</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/integration'); ?>"><i class="fa fa-spotify"></i>WAEC registration</a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/integration'); ?>"><i class="fa fa-spotify"></i>NECO Registration</a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/integration'); ?>"><i class="fa fa-spotify"></i>JAMB Registration</a></li>
              </ul>
            </li>
			<?php if ($student->BasicPlanStudent() == false) { /* checking for the type of plan the user is */?>
            <li class="treeview">
                <a href="<?php print $kas_framework->url_root('student/dashboard/mytools/'); ?>">
                    <i class="fa fa-th-large text-ult_brown"></i>
                    <span>My Tools</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/mytools/notepad/'); ?>"><i class="fa fa-tablet text-paleyellow"></i>My Notepad
                    <?php if ($student->getAllUniquesValsWithUsername('student_notepad', 'author', $student_id_original) != '0') {
                    print '<small class="badge pull-right bg-blue">'. $student->getAllUniquesValsWithUsername('student_notepad', 'author', $student_id_original) .'</small>'; } ?></a></li>
                   <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/mytools/calendar/'); ?>"><i class="fa fa-calendar-o text-maroon"></i>My Calendar 
                    <?php if ($initCount != 0) { print '<small class="badge pull-right bg-red">'.$initCount.'</small>'; } ?></a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/mytools/timeline/'); ?>"><i class="fa fa-clock-o text-blue"></i>My Timeline</a></li> 
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/mytools/classgallery/'); ?>"><i class="fa fa-picture-o text-navy"></i>My Class Gallery
                    <?php if ($student->countallStudentsinMyGallery($user_student_grade_year_grade_id, $current_year_id) != 0) { print '<small class="badge pull-right bg-green">'. $student->countallStudentsinMyGallery($user_student_grade_year_grade_id, $current_year_id). '</small>'; } ?></a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/mytools/transcript/'); ?>"><i class="fa fa-send text-red"></i>Request Transcript</a></li>
                 </ul>
            </li>
			
			<?php } ?>
            <li class="treeview">
                <a href="<?php print $kas_framework->url_root('student/dashboard/profile/'); ?>">
                    <i class="fa fa-user text-ult_custom5"></i>
                    <span>Profile</span>
                    <?php if ($completeness < 50) { $badge = '<small class="badge pull-right bg-red">'.$completeness.'%</small>';
                            } else if ($completeness < 80) { $badge = '<small class="badge pull-right bg-blue">'.$completeness.'%</small>';
                            } else { $badge = '<small class="badge pull-right bg-green">'.$completeness.'%</small>'; }
                    ?>
                    <i class="fa fa-angle-left pull-right"></i>
                   </a>
                <ul class="treeview-menu">
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/profile/'); ?>"><i class="fa fa-cogs text-ult_custom5"></i>View Profile  <?php print $badge ?></a></li>
                    <?php if ($student->BasicPlanStudent() == false) { /* checking for the type of plan the user is */?>
					<li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/profile/editprofile'); ?>"><i class="fa fa-edit text-ult_custom6"></i>Edit Profile</a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/profile/mysummary'); ?>"><i class="fa fa-star-half-o text-ult_ash"></i>My Summary</a></li>
					<?php  } ?>
				</ul>
            </li>
			
			 <li class="treeview">
                <a href="<?php print $kas_framework->url_root('student/dashboard/social/'); ?>">
                    <i class="fa fa-windows text-purple"></i> <span>Social</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				  <?php if ($student->BasicPlanStudent() == false) { /* checking for the type of plan the user is */?>
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/social/discussions/'); ?>">
					<i class="fa fa-comments text-ult_green"></i>Discussions
					<small class="badge pull-right bg-blue"> <?php print $kas_framework->countAll('student_post'); ?></small>
					 <?php $kas_framework->app_config_indicator('student_discussion'); ?></a></li>
				<?php } ?>
				
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/social/birthdays/'); ?>"><i class="fa fa-gift text-ult_custom"></i>Birthdays
					<small class="badge pull-right bg-navy"><?php print $kas_framework->birthdayCountHeader() ?></small></a></li>
              </ul>
            </li>

			 <?php if ($student->BasicPlanStudent() == false) { /* checking for the type of plan the user is */?>
            <li class="click_ult">
                <a href="<?php print $kas_framework->url_root('student/dashboard/mailbox/?folder=inbox'); ?>">
                    <i class="fa fa-envelope text-ult_custom4"></i> <span>Mailbox</span>
                    <?php //if ($internalMailEx->countUnread() != 0) {
                        //print '<small class="badge pull-right bg-red">'.$internalMailEx->countUnread().'</small>';
                    //}
                    ?>                                
                </a>
            </li>
			<?php  } ?>
			
			<li class="treeview">
                <a href="#help_desk">
                    <i class="fa fa-anchor text-red"></i> <span>Help-Desk</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="click_ult"><a href="<?php print $kas_framework->url_root('student/dashboard/complaints/'); ?>"><i class="fa fa-bug text-blue"></i>Tapp the Admin</a></li>
                    <li><a href="<?php print $kas_framework->help_url(''); ?>" target="_blank"><i class="fa fa-question-circle text-red"></i>I Need Help</a></li>
                    
              </ul>
            </li>
			
             <li>
                <a href="<?php print $kas_framework->url_root('student/dashboard/weather/'); ?>">
                    <i class="fa fa-cloud text-green"></i> <span>Weather Update</span>
                    <small class="badge pull-right bg-green">Free</small>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>