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
			$schoolCal = "SELECT * FROM school_calendar";
			$db_handle = $dbh->prepare($schoolCal);
			$db_handle->execute();
			
				while ($schoolCalendar = $db_handle->fetch(PDO::FETCH_OBJ)) {
					$startdateVal = substr($schoolCalendar->start_date, 0, 2);  $enddateVal = substr($schoolCalendar->end_date, 0, 2);
					$startmonth = substr($schoolCalendar->start_date, 3, 2)-1;   $endmonth = substr($schoolCalendar->end_date, 3, 2)-1;
					$startyear = substr($schoolCalendar->start_date, 6, 4);  $endyear = substr($schoolCalendar->end_date, 6, 4);
			?>
				{
					title: '<?php print $schoolCalendar->event_name; ?>',
					start: new Date(<?php print $startyear ?>, <?php print $startmonth ?>, <?php print $startdateVal ?>),
					end: new Date(<?php print $endyear ?>, <?php print $endmonth ?>, <?php print $enddateVal ?>),
					allDay: true,
					backgroundColor: "<?php print $schoolCalendar->event_color ?>", //Success (green)
					borderColor: "<?php print $schoolCalendar->event_color ?>" //Success (green)
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