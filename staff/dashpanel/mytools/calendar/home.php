<?php 
require ('../../../../php.files/classes/pdoDB.php');
require ('../../../../php.files/classes/kas-framework.php');
$kas_framework->safesession();
$kas_framework->checkAuthStaff();

require (constant('quad_return').'php.files/classes/generalVariables.php');
require (constant('quad_return').'php.files/staff_details.php');
require (constant('quad_return').'php.files/classes/staff.php');
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Calendar</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $kas_framework->school_utility_image('badge') ?>" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php print constant('quad_return') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php print constant('quad_return') ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php print constant('quad_return') ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="<?php print constant('quad_return') ?>css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <link href="<?php print constant('quad_return') ?>css/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
        <!-- Theme style -->
        <link href="<?php print constant('quad_return') ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.<?php print constant('quad_return') ?>js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
	<?php require (constant('tripple_return').'inc.files/header.php') ?>
	<p style="margin-top:18px">&nbsp;</p>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
		<?php require (constant('tripple_return').'inc.files/sidebar.php') ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><i class="fa fa-calendar-o text-maroon"></i> Calendar <?php $staff->display_accessLevel(); ?> </h1>
                    <ol class="breadcrumb">
						<li class="click_ult"><a href="<?php print constant('double_return') ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
						<li class="click_ult"><a href="<?php print constant('single_return') ?>"><i class="fa fa-th-large"></i>My Tools</a></li>
						<li class="active"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;Calendar</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				<?php $staff->checkBasicPlan(); //$student->authConfirm($useradmitStatus); ?>
				<center><div id="calendarMsg">
				<?php if (isset($_GET['eventid'])) {
						$kas_framework->showWarningCallout('The Only action Available is to Delete. Do you want to delete?
						<button class="btn btn-warning btn-flat" id="confirm_no">
			<i class="fa fa-thumbs-o-down"></i> No</button> &nbsp;&nbsp;
			<button class="btn btn-success btn-flat" id="confirm_yes" d_id="'.$kas_framework->unsaltifyID($_GET['eventid']).'"><i class="fa fa-thumbs-o-up"></i> Yes</button>');
					} ?>
				</div></center>
				
					<div class="row">
                        <div class="col-md-3">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h4 class="box-title">Add a New Event</h4>
                                </div>
				<form role="form" action="" method="post" id="addEventForm">
                                <div class="box-body">
									<div class="input-group">
										<label>Event Title	</label>								
											<input name="new_event" required="required" type="text" class="form-control" placeholder="Event Title" maxlength="20">
									  </div><!-- /input-group -->
                                    <!-- Date dd/mm/yyyy -->
                                    <div class="form-group" style="margin-top:6px">
                                      <label>Starting Date:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input id="datemask" required="required" name="datemask" placeholder="dd/mm/yyyy" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
									<div class="form-group">
                                      <label>Ending Date:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input id="datemask2" required="required" name="datemask2" placeholder="dd/mm/yyyy" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
									<div class="form-group">
										<label for="color">Event Color:</label>
										<select required="required" name="color" class="form-control">
										<option></option>
											<option value="#f56954">Red</option>
											<option value="#f39c12">Yellow</option>
											<option value="#0073b7">Blue</option>
											<option value="#00c0ef">Aqua</option>
											<option value="#00a65a">Green</option>
											<option value="#3c8dbc">Light-Blue</option>
											<option value="#FF00FF">Pink</option>
											<option value="#990000">Ox-Blood</option>
											<option value="#663300">Brown</option>
											<option value="#333333">Black</option>
										</select>
									<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
								</div>
								</div><!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" id="addEventToCalendar" class="btn btn-primary">
								<i class="fa fa-plus"></i> Add to Calendar</button>
							</div>
							<div id="addDiv"></div>
							</form>
					  </div><!-- /. box -->
				</div><!-- /.col -->
				
                        <div class="col-md-9">
                            <div class="box box-primary">                                
                                <div class="box-body no-padding">
                                    <!-- THE CALENDAR -->
                                    <div id="calendar"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /. box -->
							
                        </div><!-- /.col -->			
                    </div><!-- /.row -->  

				<!---the task studffs-->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All My Task Listing Coming Up</h3>
                                    <div class="box-tools">
                                        <div class="input-group">
                                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
        <table class="table table-hover" id="eventTable">
			<tr>
				<th>ID</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Event Name</th>
				<th>Status</th>
			</tr>
		<?php 
			$allEvents = "SELECT * FROM staff_calendar WHERE creator_id = '".$web_users_relid."'";
			$db_allEvents = $dbh->prepare($allEvents);
			$db_allEvents->execute();
			$total_shit = $db_allEvents->rowCount();
			$db_allEvents = null;
			
			$allEventsAll = $allEvents;
			$allEventsAll .= " ORDER BY id DESC LIMIT 0, 6";
			$db_allEventsAll = $dbh->prepare($allEventsAll);
			$db_allEventsAll->execute();				
									
				$sn = 0;
				while ($reveal = $db_allEventsAll->fetch(PDO::FETCH_OBJ)) {
					$enddateVal = substr($reveal->end_date, 0, 2); $startdateValT = substr($reveal->start_date, 0, 2);  
					$endmonth = substr($reveal->end_date, 3, 2); $startmonthT = substr($reveal->start_date, 3, 2);
					 $endyear = substr($reveal->end_date, 6, 4); $startyearT = substr($reveal->start_date, 6, 4); 
					 
					 //translating it to standard php timer
					$convertedTime = $endmonth.'/'.$enddateVal.'/'.$endyear;
					$convertedTimeT = $startmonthT.'/'.$startdateValT.'/'.$startyearT;
										
					$timeInSeconds = strtotime($convertedTimeT);
					$timeofNow = $timeInSeconds - time('now')+86400;
					$convertToDays = round($timeofNow/(60*60*24));
					
					if ($convertToDays >= 0) {
						$sn = $sn + 1;
			
					print '<tr>
						<td>'.$sn.'</td>
						<td>'.$reveal->start_date.'</td>
						<td>'.$reveal->end_date.'</td>
						<td><a href="?eventid='.$kas_framework->saltifyID($reveal->id).'">'.$reveal->event_name.'</a></td>';
							//playing politics with the remaining date
							if ($convertToDays <= 0) {
							print '<td><span class="label label-primary">Happening Live</span></td>';
							} else if ($convertToDays >= 1 and $convertToDays < 4) {
							print '<td><span class="label label-danger">Less than '.$convertToDays.' day</span></td>';
							} else if ($convertToDays >= 4 and $convertToDays < 8) {
							print '<td><span class="label label-warning">Less than '.$convertToDays.' days</span></td>';
							} else if ($convertToDays >= 8) {
							print '<td><span class="label label-success">In '.$convertToDays.' days time</span></td>';
							}
							print '</tr>';
					}
				}
			$db_allEventsAll = null;
		?>
		
        </table>
		
			<center><div id="loading" style="display:none"><?php $kas_framework->loading_h(); ?></div></center>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
				<div style="width:60%; margin:0 auto; display:none" id="loadMoreButtonDiv">
				<button class="btn btn-default btn-block btn-flat" id="loadMoreButton"><i class="fa fa-spinner"></i>
				Load More Info</button></div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="<?php print constant('quad_return') ?>myjs/jquery.min.js"></script>
		 <!---- my javascript controller -->
        <script src="<?php print constant('quad_return') ?>myjs/feccukcontroller.js" type="text/javascript"></script>
		        <!-- InputMask -->
        <script src="<?php print constant('quad_return') ?>js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="<?php print constant('quad_return') ?>js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="<?php print constant('quad_return') ?>js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?php print constant('quad_return') ?>js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php print constant('quad_return') ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php print constant('quad_return') ?>js/AdminLTE/app.js" type="text/javascript"></script>        
        <!-- fullCalendar -->
        <script src="<?php print constant('quad_return') ?>js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- Page specific script -->
        <script type="text/javascript">
		//Datemask dd/mm/yyyy
           $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
           $("#datemask2").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"}); 
			$(function() {
				/* initialize the external events
                 -----------------------------------------------------------------*/
                function ini_events(ele) {
                    ele.each(function() {

                        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                        // it doesn't need to have a start or end
                        var eventObject = {
                            title: $.trim($(this).text()) // use the element's text as the event title
                        };

                        // store the Event Object in the DOM element so we can get to it later
                        $(this).data('eventObject', eventObject);
					});
                }
                ini_events($('#external-events div.external-event'));

                /* initialize the calendar
                 -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)
                var date = new Date();
                var d = date.getDate(),
                        m = date.getMonth(),
                        y = date.getFullYear();
												
					$('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    buttonText: {//This is to add icons to the visible buttons
                        prev: "<span class='fa fa-caret-left'></span>",
                        next: "<span class='fa fa-caret-right'></span>",
                        today: 'today',
                        month: 'month',
                        week: 'week',
                        day: 'day'
                    },
                    //Random default events
                    events: [
					<?php 
					$getAllEvents = "SELECT * FROM staff_calendar WHERE creator_id = '".$web_users_relid."'";
					$db_getAllEvents = $dbh->prepare($getAllEvents);
					$db_getAllEvents->execute();
						
						while ($reveal = $db_getAllEvents->fetch(PDO::FETCH_OBJ)) {
							$startdateVal = substr($reveal->start_date, 0, 2);  $enddateVal = substr($reveal->end_date, 0, 2);
							$startmonth = substr($reveal->start_date, 3, 2)-1;   $endmonth = substr($reveal->end_date, 3, 2)-1;
							$startyear = substr($reveal->start_date, 6, 4);  $endyear = substr($reveal->end_date, 6, 4);
					?>
                        {
                            title: " <?php print htmlentities($reveal->event_name) ?> ",
                            start: new Date(<?php print $startyear ?>, <?php print $startmonth ?>, <?php print $startdateVal ?>),
                            end: new Date(<?php print $endyear ?>, <?php print $endmonth ?>, <?php print $enddateVal ?>),
                            allDay: true,
							url: '?click=<?php print $kas_framework->generateRandomString(20) ?>&eventid=<?php print $kas_framework->saltifyID($reveal->id) ?>&ref=<?php print $kas_framework->generateRandomString(20) ?>',
                            backgroundColor: "<?php print $reveal->event_color ?>", //color
                            borderColor: "#000" //color
                        },
              <?php } 
					$db_getAllEvents = null;
				?>
				],
				editable: false,
				droppable: false, // this allows things to be dropped onto the calendar !!!
                });
            });
	
			//calendar processor jquery optimized
			$('#addEventToCalendar').click(function() {
				$(this).attr('disabled', 'disabled');
				$('#addDiv').html('<?php $kas_framework->loading_h('center'); ?>');
				
				calendarVars = $('#addEventForm :input').serializeArray();
				$.post('calendar_processing', calendarVars, function(data) {
					$('#addDiv').html(data);
				}); return false; })
			
			$('#confirm_no').click(function(data) {
				$('#calendarMsg').html(''); })
			
			$('#confirm_yes').click(function(data) {
				$('#calendarMsg').html('<?php $kas_framework->loading_h(); ?>');
				d_id = $(this).attr('d_id'); byepass = 'hUJH65gybt66tyt7h';
				$.post('delete_event_calendar', {d_id:d_id, byepass:byepass}, function(data) {
					$('#calendarMsg').html(data); }); });
			
			$(document).ready(function() {
				var load = 0;
				var Alltotal = "<?php print $total_shit ?>";
				if (Alltotal > 6) {
					$('#loadMoreButtonDiv').show();
				}
				
				$('#loadMoreButton').click(function(e) {
					//if the end of the scroll is reached
					$('#loading').show();
					load++;
					
					if (load * 6 > Alltotal) {
						$('#loading').hide();
						$('#loadMoreButtonDiv').html('<center>No More Events To Load!!!</center>').show();
					} else {
						//proceed to run the query and retrieve more
						byepass = 'hghjT5Ytrb7u66tv9oTXE';
						$.post('loadOtherEvents', {load:load, byepass:byepass}, function(data) {
							$('#eventTable').append(data);
							$('#loading').hide();
						});	
					}
				})// the click function
			})
        </script>
<?php include (constant('quad_return').'inc.files/fixedfooter.php') ?>
    </body>
</html>