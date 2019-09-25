
<?php 
// dont come here directly
if (!defined ('DIRECT_PASS')){echo 'who are you? HAHAHA, WHAT ARE YOU DOING, ARE YOU A HACKERS TOO?';
//header ("Location: ../../index.php?action=notauth");
	exit;} // IF THE HACKER TRY COMING TO THIS PAGE, THROW HIM TO LOGIN PAGE, DESTROY ALL SESSION AND EXIT
?>
<hr />

<?php $myp->AlertInfo('Hey Admin! ', 'Please Take note that the Date format here is yyyy-mm-dd if the date control format dosent appear because of your browser. eg. 2015-09-30');


//upgraded by Ultimate Kelvin C - Kastech
if (isset($_GET['delete'])) {
	$delID = $_GET['delete'];
		 $sSQL = "DELETE FROM school_calendar WHERE id = '".$delID."'";
		 $dbh_sSQL = $dbh->prepare($sSQL); $checkExec = $dbh_sSQL->execute(); $dbh_sSQL = null;
			if ($checkExec) {
				$myp->AlertSuccess("Nice Move! ", "Event Was successfully Deleted From the Calendar");
			} else {
				$myp->AlertError("Sorry! ", "Could not Delete this Event. Please Try again or Contact HyperTera");
			}
}

 if(isset($_GET['editcall'])){

$edit_call_id = $_GET['c_id'];

$sch_calender = "SELECT * FROM school_calendar WHERE id='".$edit_call_id."'";
$dbh_sch_calender = $dbh->prepare($sch_calender); $dbh_sch_calender->execute(); $fetchObj_scal = $dbh_sch_calender->fetch(PDO::FETCH_OBJ); $dbh_sch_calender = null;

$eventname= $fetchObj_scal->event_name;
 $eventstart= $fetchObj_scal->start_date;//
 $eventend=$fetchObj_scal->end_date;
 $eventcolor=$fetchObj_scal->event_color;//

// make db dates html5 format
$eventstart = substr($eventstart, -4).'-'.substr($eventstart, -7, 2).'-'.substr($eventstart, 0, 2);
$eventend = substr($eventend, -4).'-'.substr($eventend, -7, 2).'-'.substr($eventend, 0, 2);


?>
<div style="padding:20px;">
<h2>School Calendar Editor</h2>
</strong>

<form action="" method="post">
<p>
  <input type="hidden" name="editmyassc" value="<?php echo $edit_call_id;?>" />
  <strong>Event Name</strong>  
  <input name="event" type="text" style="width:500px" maxlength="50" value="<?php echo $eventname;?>" /><br />
  . <strong>Start date </strong>: 
  <input name="start" style="width:120px" type="date" value="<?php echo $eventstart;?>" /> 
  <strong>End Date</strong>: 
  <input name="end" style="width:120px" type="date" value="<?php echo $eventend;?>" /> Color   
  
  
  <select name="mycolor" style="width:100px" >
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
</select> Previous Color: <span style="padding:5px; color:#fff; background-color:<?php echo $eventcolor;?>">Event</span>
<input type="submit" class="btn btn-defalt btn-sm" value="Save Calendar Changes" /></p>
</form>


<?php if(isset($_POST['editmyassc'])){
// he wants to edit the term days
// collect the edit varables
$call_edit_id = $_POST['editmyassc'];// row to edit
$edit_start = $_POST['start'];
$mmyevent = htmlentities($_POST['event']);

$edit_end = $_POST['end'];
$edit_color = $_POST['mycolor'];

// collect the resumtion dates from html5 form and format to kelvin date style
$edit_start = substr($edit_start, -2).'/'.substr($edit_start, -5, 2).'/'.substr($edit_start, 0, 4);
$edit_end = substr($edit_end, -2).'/'.substr($edit_end, -5, 2).'/'.substr($edit_end, 0, 4);
// insert the changes
$process_fm_ed_vac_date1 = "UPDATE school_calendar SET event_name ='$mmyevent', start_date='$edit_start', end_date ='$edit_end', event_color='$edit_color' WHERE id='$call_edit_id'";// first 
	//upgraded by Ultimate Kelvin C - Kastech
	$dbh_process_fm_ed_vac_date1 = $dbh->prepare($process_fm_ed_vac_date1); $dbh_process_fm_ed_vac_date1->execute(); $rowCount = $dbh_process_fm_ed_vac_date1->rowCount(); $dbh_process_fm_ed_vac_date1 = null;
	if ($rowCount == 1) {
		$myp->AlertSuccess('Nice Job! ', 'School Event Succesfully Edited. Look at the table below fot the changes');
	} else {
		$myp->AlertError('Error! ', 'No Changes was made to the Calendar');
	}

}

?>

<?php }// edit days ends?>
</div>


<div style="padding:20px;">
<?php if(isset($_GET['add'])){?>
<h2>Create New Event</h2>
<form action="" method="post">
<p>
  <input type="hidden" name="addnew" value="" />
  <strong>Event Name</strong>  
  <input name="addevent" type="text" placeholder="Enter Event Name" maxlength="50" style="width:500px" value="" /><br />
  <strong>Start date </strong>: 
  <input name="addstart" style="width:120px" placeholder="YYYY-MM-DD" type="date" value="" /> 
  <strong>End Date</strong>: 
  <input name="addend" style="width:120px" placeholder="YYYY-MM-DD" type="date" value="" /> Color   
<select name="addmycolor" style="width:100px">
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
&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-default btn-sm" value="Create Event" /></p>
</form>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php if(isset($_POST['addnew'])){
// collect the form variables
$addevent = htmlentities($_POST['addevent']);
$addstart = trim($_POST['addstart']);
$addend = $_POST['addend'];
$addmycolor = htmlentities(trim($_POST['addmycolor']));

// reformat dates
$addstart = substr($addstart, -2).'/'.substr($addstart, -5, 2).'/'.substr($addstart, 0, 4);
$addend = substr($addend, -2).'/'.substr($addend, -5, 2).'/'.substr($addend, 0, 4);

	// as this was done on christmass day na
	//added by the ultimate keliv
		if (strIsEmpty($addevent) or strIsEmpty($addstart) or strIsEmpty($addend) or strIsEmpty($addmycolor)) {
			$myp->AlertError('Error! ', 'One or More Empty Fields Detected. Please Cross Check.');
		} else {
			$Query = "INSERT INTO school_calendar(event_name,start_date,end_date,event_color) VALUES('".secureStr($addevent)."', '".secureStr($addstart)."', '".secureStr($addend)."', '".secureStr($addmycolor)."')";
				$dbh_Query = $dbh->prepare($Query); $dbh_Query->execute(); $rowCount = $dbh_Query->rowCount(); $dbh_Query = null;
				if ($rowCount == 1) {
					$myp->AlertSuccess('Kudos Admin! ', 'Event "'.$addevent.'" has been Added to the Calendar');
				} else {
					$myp->AlertError('Error! ', 'Could not create Event. Please try again');
				}
		}

		
	}
 } // end adding form?>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title="data-original-title">
      <h2><i class="icon-user"></i>School Calendar <?php //echo $db_name;?></h2>
	  <div align="right"> <a href="main?page=administrative&tool=calendar&add=new"><button class="btn btn-success btn-xs">Create Calendar Events</button></a><br /></div>
	  
     </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable" width="100%">
        <thead>
          <tr bgcolor="">
            <th width="7%">S/N<i class="icon icon-color icon-arrow-n-s"></i></th>
            <th width="41%">Event</th>
            <th width="15%">Start date </th>
            <th width="13%">End Date </th>
            <th width="9%">Status</th>
            <th width="15%">Action</th>
          </tr>
        </thead>
        <tbody>
         
		 <?php
				$pullcals = "SELECT * FROM school_calendar ORDER BY id DESC";
				$dbh_pullcals = $dbh->prepare($pullcals); $dbh_pullcals->execute(); 
				
				$sn = 0;
				while ($qty = $dbh_pullcals->fetch(PDO::FETCH_ASSOC)) {

				$sn = $sn + 1;
				$cal_id = $qty['id'];
				$event = $qty['event_name'];
				$start_date = $qty['start_date'];
				$end_date = $qty['end_date'];
				$event_color = $qty['event_color'];
		?>
		 
		  <tr bgcolor="">
			<td><?php echo $sn;?></td>
            <td><span style="background-color:<?php echo $event_color;?>; padding:4px; color: #FFF"><?php echo $event;?></span></td>
            <td class="center"><?php echo $start_date;?></td>
            <td class="center"><?php echo $end_date;?></td>
            <td class="center"><?php echo @$event_status;?></td>
            <td class="center"><a title="You cannot view more of this profile" class="btn btn-success" href="main?page=administrative&tool=calendar&editcall=true&c_id=<?php echo $cal_id;?>"> <i class="icon-zoom-in icon-white"></i>Edit  </a> <a href="?page=administrative&tool=calendar&delete=<?php print $cal_id ?>" class="btn btn-danger"><i class="icon-trash icon-white"></i></a></td>
          </tr>
		  
		  <?php } 
			$dbh_pullcals = null;
		  ?>
        </tbody>
      </table>

    </div>
  </div>
<br /><br />
</div>

	<!--The calendar -->
<div style="width:90%; margin:0 auto">
	<div class="ultimate_keliv_calendar"></div>
</div>

<script type="text/javascript">
		$(function() {
			//Calendar
			$('.ultimate_keliv_calendar').fullCalendar({
				editable: false, //Enable drag and drop
				events: [
				<?php 
				$schoolCal = "SELECT * FROM school_calendar";
				$dbh_schoolCal = $dbh->prepare($schoolCal); $dbh_schoolCal->execute();
					while ($schoolCalendar = $dbh_schoolCal->fetch(PDO::FETCH_OBJ)) {
					$startdateVal = substr($schoolCalendar->start_date, 0, 2);  $enddateVal = substr($schoolCalendar->end_date, 0, 2);
					$startmonth = substr($schoolCalendar->start_date, 3, 2)-1;   $endmonth = substr($schoolCalendar->end_date, 3, 2)-1;
					$startyear = substr($schoolCalendar->start_date, 6, 4);  $endyear = substr($schoolCalendar->end_date, 6, 4);
				?>
					{
						title: '<?php print htmlentities($schoolCalendar->event_name); ?>',
						start: new Date(<?php print $startyear ?>, <?php print $startmonth ?>, <?php print $startdateVal ?>),
						end: new Date(<?php print $endyear ?>, <?php print $endmonth ?>, <?php print $enddateVal ?>),
						allDay: true,
						backgroundColor: "<?php print $schoolCalendar->event_color ?>", //Success (green)
						borderColor: "<?php print $schoolCalendar->event_color ?>" //Success (green)
					},
			   <?php } 
				 $dbh_schoolCal = null;
			   ?>
				]
			});
	});
</script>
