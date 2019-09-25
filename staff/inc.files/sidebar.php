	<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas" id="aside">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
			<?php $dynamicimage = $kas_framework->imageDynamic($staff_image, $staff_sex, $kas_framework->server_root_dir('pictures/'));
				print '<img src="'.$dynamicimage.'" class="img-circle" alt="User Image" />';
			?>
            </div>
            <div class="pull-left info">
                <p> Hello, <?php print $_SESSION['tapp_staff_username'] ?> </p>

                <a href="#online_status"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#searchform" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" required="required" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="click_ult">
                <a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/'); ?>">
                    <i class="fa fa-dashboard text-green"></i> <span>Dashpanel</span>
                </a>
            </li>
			
	<?php 
	/* making sure that you ae a teacher first before this can be seen */
	if ($staff->checkTeacher($web_users_type) == true and $staff->basicPlan() == false) { ?>
	
			<li class="treeview">
                <a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/manageResult/'); ?>">
                    <i class="fa fa-list-alt text-ult_custom4"></i> <span>Manage Result</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/manageResult/'); ?>"><i class="fa fa-tag text-green"></i>View Uploaded | Edit</a></li>
					<li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/manageResult/upload'); ?>"><i class="fa fa-cloud-upload text-ult_custom4"></i>Upload Result <?php $kas_framework->app_config_indicator('student_result_uploading'); ?></a></li>
					<li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/manageResult/formMaster'); ?>"><i class="fa fa-comment-o text-ult_custom1"></i>Form Masters Mod.</a></li>
                    </ul>
            </li>
			<li class="treeview">
                <a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/myStudents/'); ?>">
                    <i class="fa fa-users text-ult_custom2"></i> <span>Manage Students</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/myStudents/?myStudents'); ?>"><i class="fa fa-male text-ult_custom"></i>My Students</a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/myStudents/?myClass'); ?>"><i class="fa fa-user text-green"></i>My Class</a></li>
                </ul>
            </li>
			<li class="treeview">
                <a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/academicTools/'); ?>">
                    <i class="fa fa-th-large text-fuchsia"></i> <span>Academic Tools</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/academicTools/duty'); ?>"><i class="fa fa-volume-up "></i>Duty Roaster</a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/academicTools/teachingtimetable'); ?>"><i class="fa fa-table text-green"></i>Teaching Timetable</a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/academicTools/schooltimetable/'); ?>"><i class="fa fa-table text-red"></i>School Timetable</a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/academicTools/homework/myHomework'); ?>"><i class="fa fa-suitcase text-blue"></i>Home Work</a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/academicTools/classnote/myClassnotes'); ?>"><i class="fa fa-ticket text-maroon"></i>Class Note</a></li>
              </ul>
            </li>
			
			<?php } ?>
			
	<?php 
		/* checking the staff role and opening the menu for the staff, we handle... */
			/* making sure that the staff has been activated */
				if ($staff->basicPlan() == false) {
				?>
					<li class="treeview">
						<a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/mytools/'); ?>">
							<i class="fa fa-wrench text-ult_custom2"></i> <span>My Tools</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/mytools/notepad/'); ?>"><i class="fa fa-tablet text-paleyellow"></i>Notepad
							<?php if ($staff->getAllUniquesValsWithUsername('staff_notepad', 'author', $web_users_relid) != '0') {
							print '<small class="badge pull-right bg-blue">'. $staff->getAllUniquesValsWithUsername('staff_notepad', 'author', $web_users_relid) .'</small>'; } ?></a></li>
							<li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/mytools/calendar/'); ?>"><i class="fa fa-calendar-o text-maroon"></i>My Calendar
							<?php if ($initCount != 0) { print '<small class="badge pull-right bg-red">'.$initCount.'</small>'; } ?></a></li>
							<li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/mytools/staffgallery/'); ?>"><i class="fa fa-picture-o text-navy"></i>Staff Gallery
							<?php  if ($staff->countStaffwithPics($staff_school) != 0) { print '<small class="badge pull-right bg-green">'. $staff->countStaffwithPics($staff_school). '</small>'; } ?></a></li>
							</ul>
					</li>
				<?php
					if ($staff_liberian == '1') {
						print '<li class="treeview">
						<a href="'.$kas_framework->server_root_dir('staff/dashpanel/handleLibrary/').'">
							<i class="fa fa-book text-ult_custom1"></i> <span>Manage Library</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="click_ult"><a href="'.$kas_framework->server_root_dir('staff/dashpanel/handleLibrary/').'"><i class="fa fa-book text-ult_custom1"></i>Manage Books</a></li>
							<li class="click_ult"><a href="'.$kas_framework->server_root_dir('staff/dashpanel/handleLibrary/manageStudent').'"><i class="fa fa-user text-green"></i>Student Record</a></li>
							<li class="click_ult"><a href="'.$kas_framework->server_root_dir('staff/dashpanel/handleLibrary/manageStaff').'"><i class="fa fa-user text-green"></i>Staff Record</a></li>
						</ul>
					</li>';
					} 
					if ($staff_health == '1') {
						print '	<li class="click_ult"><a href="'.$kas_framework->server_root_dir('staff/dashpanel/handleHealth').'">
									<i class="fa fa-plus-square text-red"></i> <span>Manage Health</span>
								</a></li>';
					} 
					if ($staff_timetable == '1') {								
						print '<li class="treeview">
								<a href="'.$kas_framework->server_root_dir('staff/dashpanel/handleTimetable').'">
									<i class="fa fa-table text-red"></i> <span>Manage Timetable</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li class="click_ult"><a href="'.$kas_framework->server_root_dir('staff/dashpanel/handleTimetable').'"><i class="fa fa-plus text-red"></i>Create TimeTable</a></li>
									<li class="click_ult"><a href="'.$kas_framework->server_root_dir('staff/dashpanel/handleTimetable/hyperCopy').'"><i class="fa fa-copy text-ult_custom"></i>Copy Timetable</a></li>
								</ul>
							</li>';
					} 
					if ($staff_discipline == '1') {
						print '	<li class="click_ult"><a href="'.$kas_framework->server_root_dir('staff/dashpanel/handleDiscipline').'">
									<i class="fa fa-smile-o text-ult_custom2"></i> <span>Manage Discipline</span>
								</a></li>';
					} 
					if ($staff_attendance == '1') {
						print '	<li class="click_ult"><a href="'.$kas_framework->server_root_dir('staff/dashpanel/handleAttendance').'">
									<i class="fa fa-list-alt text-ult_custom4"></i> <span>Manage Attendance</span>
								</a></li>';
					} 
					if ($staff_receipt == '1') {
						print '<li class="treeview">
								<a href="'.$kas_framework->server_root_dir('staff/dashpanel/payment+receipt').'">
									<i class="fa fa-money text-fuchsia"></i> <span>Sales and Receipts</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li class="click_ult"><a href="'.$kas_framework->server_root_dir('staff/dashpanel/payment+receipt').'"><i class="fa fa-money text-ult_custom5"></i>Payment Reciepts</a></li>
									<li class="click_ult"><a href="'.$kas_framework->server_root_dir('staff/dashpanel/payment+receipt/manageShop').'"><i class="fa fa-shopping-cart text-ult_custom"></i>Manage Shop</a></li>
								</ul>
							</li>';
					}
					
				}
		
	?>
			<li class="treeview">
                <a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/profile/'); ?>">
                    <i class="fa fa-user text-ult_custom5"></i>
                    <span>Profile</span>
					 <?php if ($completeness < 50) { $badge = '<small class="badge pull-right bg-red">'.$completeness.'%</small>';
                            } else if ($completeness < 80) { $badge = '<small class="badge pull-right bg-blue">'.$completeness.'%</small>';
                            } else { $badge = '<small class="badge bg-green">'.$completeness.'%</small>'; }
                    ?>
                     <i class="fa fa-angle-left pull-right"></i>
                   </a>
                <ul class="treeview-menu">
                    <li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/profile/'); ?>"><i class="fa fa-cogs text-ult_custom5"></i>View Profile <?php print $badge ?></a></li>
                    <li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/profile/editprofile'); ?>"><i class="fa fa-edit text-ult_custom6"></i>Edit Profile</a></li>
                </ul>
            </li>
	<?php 
	/* making sure that you ae a teacher first before this can be seen */
	if ($staff->basicPlan() == false) { ?>
	
			<li class="treeview">
                <a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/social/'); ?>">
                    <i class="fa fa-windows text-purple"></i> <span>Social</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/social/discussions/'); ?>">
					<i class="fa fa-comments text-ult_green"></i>Discussions<small class="badge pull-right bg-navy">
					<?php echo $kas_framework->countAll('staff_post'); ?></small>
					<?php $kas_framework->app_config_indicator('staff_discussion'); ?></a></li>
					
                    <li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/social/birthdays/'); ?>"><i class="fa fa-gift text-ult_custom"></i>Birthdays
					<small class="badge pull-right bg-navy"><?php print $kas_framework->birthdayCountHeader() ?></small></a></li>
              </ul>
            </li>
	<?php  } ?>
            <li class="click_ult">
                <a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/library/'); ?>">
                    <i class="fa fa-desktop text-fuchsia"></i> <span>School Library</span><small class="badge pull-right bg-green"><?php echo $kas_framework->countAll('media_codes'); ?></small>
                </a>
            </li>
			
	<?php 
	/* making sure that you ae a teacher first before this can be seen */
	if ($staff->basicPlan() == false) { ?>
			 <li class="click_ult">
                <a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/mailbox/?folder=inbox'); ?>">
                    <i class="fa fa-envelope text-ult_custom4"></i> <span>Mailbox</span>
                    <?php  if ($internalMailEx->countUnread() != 0) {
                        print '<small class="badge pull-right bg-red">'.$internalMailEx->countUnread().'</small>';
                    }
                    ?>                                
                </a>
            </li>
	<?php } ?>
			
			<li class="treeview">
                <a href="#help_desk">
                    <i class="fa fa-anchor text-red"></i> <span>Help-Desk</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="click_ult"><a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/complaints/'); ?>"><i class="fa fa-bug text-blue"></i>Tapp the Admin</a></li>
                    <li><a href="<?php print $kas_framework->help_url(''); ?>" target="_blank"><i class="fa fa-question-circle text-red"></i>I Need Help</a></li>
                    
              </ul>
            </li>
			
             <li class="click_ult">
                <a href="<?php print $kas_framework->server_root_dir('staff/dashpanel/weather/'); ?>">
                    <i class="fa fa-cloud text-green"></i> <span>Weather Update</span>
                    <small class="badge pull-right bg-green">Free</small>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>