</script>

			<div class="sortable row-fluid">
				<a id="summary_student" data-rel="tooltip" title="<?php CountAllActiveStudents();?> Active Students." class="well span3 top-block" href="#">
					<span class="icon32 icon-user"></span>
					<div>Total Students</div>
					<div> <?php CountAllStudents();?></div>
					<span class="notification"><?php CountAllActiveStudents();?></span>
				</a>

				<a id="summary_staff" data-rel="tooltip" title="<?php CountAllActiveTeachers(); ?> Active Teachers and <?php CountNonTeachingStaff(); ?> Non Teaching Staff" class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-users"></span>
					<div>Total Staff</div>
					<div><?php CountStaff(); ?></div>
					<span class="notification green"><?php CountAllActiveTeachers(); ?></span>
				</a>

				<a id="summary_fees" data-rel="tooltip" title="<?php SumUpFeecount(); ?> total transactions" class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-cart"></span>
					<div>Collected Fees</div>
					<div>&#8358;<?php SumUpFee(); ?></div>
					<span class="notification yellow"><?php SumUpFeecount(); ?></span>
				</a>
				
				<a id="summary_message" data-rel="tooltip" title="<?php CountAllUnreadMessages(); ?> unread messages." class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-envelope-closed"></span>
					<div>Messages</div>
					<div><?php CountAllMessages(); ?></div>
					<span class="notification red"><?php CountAllUnreadMessages(); ?></span>
				</a>
			</div>