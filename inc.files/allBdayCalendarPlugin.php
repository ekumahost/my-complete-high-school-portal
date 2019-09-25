<script type="text/javascript">
		$(function() {
		
		//Date for the calendar events (dummy data)
		var date = new Date();
		var d = date.getDate(),
				m = date.getMonth(),
				y = date.getFullYear();
				//alert(m);

		//Calendar
		$('#calendar').fullCalendar({
			editable: true, //Enable drag and drop
			events: [
			<?php 
			$bdayCalStd = "SELECT * FROM studentbio WHERE admit = '1' AND studentbio_dob != ''";			
			$db_handle = $dbh->prepare($bdayCalStd);
				$db_handle->execute();
				
				while ($bdayCalStdObj = $db_handle->fetch(PDO::FETCH_OBJ)) {
				$startdateVal = substr($bdayCalStdObj->studentbio_dob, 0, 2);  $enddateVal = substr($bdayCalStdObj->studentbio_dob, 0, 2);
				$startmonth = substr($bdayCalStdObj->studentbio_dob, 3, 2)-1;   $endmonth = substr($bdayCalStdObj->studentbio_dob, 3, 2)-1;
				$startyear = date('Y');  $endyear = date('Y');
			?>
				{
					title: '<?php print $bdayCalStdObj->studentbio_fname.' '.$bdayCalStdObj->studentbio_lname; ?>',
					start: new Date(<?php print $startyear ?>, <?php print $startmonth ?>, <?php print $startdateVal ?>),
					end: new Date(<?php print $endyear ?>, <?php print $endmonth ?>, <?php print $enddateVal ?>),
					allDay: true,
					backgroundColor: "maroon", //Success (green)
					borderColor: "#CCC" //Success (green)
				},
		   <?php } ?>
		   <?php
				$bdayCalStd = "SELECT * FROM staff WHERE staff_status = '1' AND staff_dob != ''";
				$db_handle = $dbh->prepare($bdayCalStd);
				$db_handle->execute();

			
				while ($bdayCalStfObj = $db_handle->fetch(PDO::FETCH_OBJ)) {
				$startdateVal2 = substr($bdayCalStfObj->staff_dob, 0, 2);  $enddateVal2 = substr($bdayCalStfObj->staff_dob, 0, 2);
				$startmonth2 = substr($bdayCalStfObj->staff_dob, 3, 2)-1;   $endmonth2 = substr($bdayCalStfObj->staff_dob, 3, 2)-1;
				$startyear2 = date('Y');  $endyear2 = date('Y');
			?>
				{
					title: '<?php print $bdayCalStfObj->staff_fname.' '.$bdayCalStfObj->staff_lname; ?>',
					start: new Date(<?php print $startyear2 ?>, <?php print $startmonth2 ?>, <?php print $startdateVal2 ?>),
					end: new Date(<?php print $endyear2 ?>, <?php print $endmonth2 ?>, <?php print $enddateVal2 ?>),
					allDay: true,
					backgroundColor: "maroon", //Success (green)
					borderColor: "#CCC" //Success (green)
				},
		   <?php } ?>
			],
			buttonText: {//This is to add icons to the visible buttons
				prev: "<span class='fa fa-caret-left'></span>",
				next: "<span class='fa fa-caret-right'></span>",
				today: 'today',
				month: 'month',
				week: 'week',
				day: 'day'
			},
			header: {
				left: 'title',
				center: '',
				right: 'prev,next'
			}
		});
	});
</script>