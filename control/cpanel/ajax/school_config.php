<!-- do permision --->
<?php

include ('../../php.files/classes/pdoDB.php');
//Include global functions
include_once "../includes/common.php";
// config
include_once "../includes/configuration.php";


//Get current year
$nyear=$_SESSION['CurrentYear'];

$cyear= getValue('school_years_desc', 'school_years', 'school_years_id', $nyear);

$action=get_param("action");

if ($action=="edit"){
	//Gather Stored Config
	$configSQL = "SELECT * FROM tbl_config WHERE id=1";
	$dbh_Query = $dbh->prepare($configSQL); $dbh_Query->execute();
	$config = $dbh_Query->fetch(PDO::FETCH_OBJ);
	$dbh_Query = null;
	
	$set_state=$config->default_state;
} else {
	$messageto_staff=get_param("messageto_staff");
	$messageto_parents=get_param("messageto_parents");
	$messageto_students=get_param("messageto_students");
	$messageto_all=get_param("messageto_all");
	$default_city=get_param("default_city");
	$default_state=get_param("default_state");
	$default_zip=get_param("default_zip");
	
	//mm/dd/yyyy to dd/mm/yyyy
	$defau=get_param("default_entry_date");	 //default entry date added by Ben based on Kelvin Date format
	
	$default_entry_date = substr($defau, -7, 2).'/'.substr($defau, 0, 2).'/'.substr($defau, -4);
	
	$sSQL="UPDATE tbl_config SET messageto_staff=".tosql($messageto_staff, "Text").", messageto_students=".tosql($messageto_students, "Text").", messageto_parents=".tosql($messageto_parents, "Text").",messageto_all=".tosql($messageto_all, "Text").", default_city=".tosql($default_city, "Text").", default_state='$default_state', default_zip=".tosql($default_zip, "Text").", default_entry_date=".tosql($default_entry_date, "Text")." WHERE id=1";
		$dbh_sSQL = $dbh->prepare($sSQL); $dbh_sSQL->execute(); $rowCount = $dbh_sSQL->rowCount(); $dbh_sSQL = null;
		
		//upgraded by Ultimate Kelvin C - Kastech
		if ($rowCount == 1) {
			$mysuccess = $myp->AlertSuccess('Good Job! ', 'General Welcome Messages Saved!');
		} else {
			$mysuccess = $myp->AlertError('Failed ', 'General Welcome Message Could not be Saved!');
		}
	
	
	$config = "SELECT * FROM tbl_config WHERE id = 1";
	$dbh_QueryC = $dbh->prepare($config); $dbh_QueryC->execute();
	$config = $dbh_QueryC->fetch(PDO::FETCH_OBJ);
	$dbh_QueryC = null;
	
	$set_state = $config->default_state;
}
?>

<script language="JavaScript" src="datepicker.js"></script>
<script type="text/javascript" language="JavaScript" src="sms.js"></script>

<!-- ADMIN IS EDITING HERE, RE,MEMBER TO CONFIGURE JAVACRIPT, PREVENT NAVIGATION IF FORM IS NOT SAVED. Ben have not done this on may 27 2014 when he built this page. bring back our girls month -->
<div id="Content" align="center">

<a id="general"> </a>
<div style="border:1px solid #999; box-shadow:10px 10px 20px #CCC; border-radius:10px 0 10px 0">	 <br />
<a href="#generals">
<button id="ethnicities" class="btn btn-success btn-sm">Ethnicities</button></a>
<button id="titles" class="btn btn-success btn-sm">Titles</button>
<button id="relationships" class="btn btn-success btn-sm">Relationships </button>
<button id="generations" class="btn btn-success btn-sm">Generations</button>


<button id="immunization" class="btn btn-info btn-sm">Immunization Codes</button> 
<button id="medication" class="btn btn-info btn-sm">Medication Codes</button> 
<button id="allergy" class="btn btn-info btn-sm">Allergy Codes</button> 

<hr> 
<button id="infraction" class="btn btn-warning btn-sm">Infraction Codes</button>
<button id="attendance" class="btn btn-warning btn-sm">Attendance Codes</button>
<button id="offices" class="btn btn-warning btn-sm">Health Codes</button>

	<!--<button id="classperiods" class="btn btn-danger btn-xs">Class Periods</button>-->
    <button id="gradelevel" class="btn btn-danger btn-xs">Grade/Class</button>
	<button id="subjects" class="btn btn-danger btn-xs">Subjects/Courses</button>
	<button id="banks" class="btn btn-danger btn-xs">Banks</button>
	<button id="examtype" class="btn btn-danger btn-xs">Exam types</button>
	<button id="school_period" class="btn btn-danger btn-xs">School Class Period</button>

<hr>
    <a href="?action=edit&operator=admin&position=adminArea&user=Administrator&page=configindex&do=yes"><button id="" class="btn btn-primary btn-xs">Welcome Messages</button></a>
	<button id="changeschoolname" class="btn btn-primary btn-xs">School Names</button>
	<button id="schoolyear" class="btn btn-primary btn-xs">School Year/Session</button>
	<button id="schoolterm" class="btn btn-primary btn-xs">School Terms/Semester</button>
	<button id="schoolbadge" class="btn btn-primary btn-xs">School Badge/Logo</button>
    <a href="main?page=administrative&tool=rooms" target="_blank"><button id="" class="btn btn-primary btn-xs">Class Room/Halls</button></a>
 	<button id="barnedwords" class="btn btn-primary btn-xs">Barned Discussion WORDS</button>

 
 <br /> <br />
 </div>
	
<div id="configchanger"> 
<br>
	
<div align="center" id="statusdone" style="font:'Courier New', Courier, monospace"> <?php echo @$mysuccess;?></div>


<table border="0" cellpadding="0" cellspacing="0" width="90%" align="center" bgcolor="#F7F2D7">
<form name="config" method="POST" action="">
  <tr class="trform">
    <td width="100%"><div align="left" style="font-variant:small-caps; font-weight:800">Current Session: <?php echo $cyear; ?> </div></td>
  </tr>
    <tr> <td>&nbsp;</td></tr>

  <tr> <td> <b>Please update general welcome messages here</b></td></tr>
  
  <tr>
    <td width="100%">
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr class="trform">
          <td width="100%">&nbsp;<?php echo _ADMIN_CONFIG_LOGIN?></td>
        </tr>
        <tr>
          <td width="100%" class=""><textarea name="messageto_all" cols="40" rows="4"><?php echo strip($config->messageto_all); ?></textarea></td>
        </tr>
      </table>
    </td>
  </tr>
  
  
    <tr>
    <td width="100%">
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr class="trform">
          <td width="100%">&nbsp;Message to Students</td>
        </tr>
        <tr>
          <td width="100%" class="tdinput"><textarea name="messageto_students" cols="40" rows="4"><?php echo strip($config->messageto_students); ?></textarea></td>
        </tr>
      </table>
    </td>
  </tr>
 
  <tr>
    <td width="100%">
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr class="trform">
          <td width="100%">&nbsp;<?php echo _ADMIN_CONFIG_TEACHERS?></td>
        </tr>
        <tr>
          <td width="100%" class="tdinput"><textarea name="messageto_staff" cols="40" rows="4"><?php echo strip($config->messageto_staff); ?></textarea></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="100%">
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr class="trform">
          <td width="100%">&nbsp;<?php echo _ADMIN_CONFIG_PARENTS?></td>
        </tr>
        <tr>
          <td width="100%" class="tdinput"><textarea name="messageto_parents" cols="40" rows="4"><?php echo strip($config->messageto_parents); ?> </textarea></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr class="trform">
    <td width="100%" class="tdinput">
    <table border= "0" cellspacing="3">
    <tr>
      <td>
      <?php echo _ADMIN_CONFIG_DEF_CITY?>:</td>
      <td><input type="text" onChange="capitalizeMe(this)" name="default_city" value="<?php echo strip($config->default_city); ?>"></td> 
      <td>
      <?php echo _ADMIN_CONFIG_DEF_STATE?>:</td>
      <td><select name="default_state">
	   <?php
	   //Display states from table
			$loopAll = "SELECT state_name FROM tbl_states";
			$dbh_loopAll = $dbh->prepare($loopAll); $dbh_loopAll->execute();
				while ($fetchObj = $dbh_loopAll->fetch(PDO::FETCH_OBJ)) {
					echo '<option>'.$fetchObj->state_name.'</option>';
				}
			$dbh_loopAll = null;
	   ?>
	  </select></td></tr>
    <tr>
      <td>
      <?php echo _ADMIN_CONFIG_DEF_ZIP?>:</td>
      <td><input type="text" onChange="capitalizeMe(this)" name="default_zip"  value="<?php echo strip($config->default_zip); ?>"></td>
      <td>
      <?php echo _ADMIN_CONFIG_DEF_DATE?>:</td>
      <td><input type="text" size=10 name="default_entry_date" value="<?php echo($config->default_entry_date); ?>"  READONLY onclick="javascript:show_calendar('config.default_entry_date');"><a href="javascript:show_calendar('config.default_entry_date');"><img src="cal.gif" border="0" class="imma"></a>
    </td></tr>
    </table>
 </td>
  </tr>
  <tr>
    <td width="100%" align="left"><br><br><input type="submit" name="submit" value="<?php echo _ADMIN_CONFIG_DEF_UPDATE?>" class="frmbut"></td>
	<input type="hidden" name="action" value="update">
	</form>
  </tr>
</table>

<br><br><br><br><br><br>
</div>
</div>