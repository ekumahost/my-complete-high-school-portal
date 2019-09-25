
<?php
 	//Include global functions
include_once "../../../includes/common.php";
//Initiate special database functions
include_once "../../../includes/true_mysql.php";
//Use common ez_sql stuff too
include_once "../../../includes/ez_sql.php";
// config
include_once "../../../includes/configuration.php";

  session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
  {
    header ("Location: ../../../index.php?action=notauth");
	exit;
}

   
require_once('config.php'); 
//echo "no way";        
//exit;
// Database connection                                   
//$mysqli = mysqli_init();
//$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
//$mysqli->real_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']); 


@$con=mysqli_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);
                      //echo $_GET['colname'];
// Get all parameters provided by the javascript
//$colname = $mysqli->real_escape_string(strip_tags($_GET['colname']));// firstname
//$id = $mysqli->real_escape_string(strip_tags($_GET['id'])); // id
//$coltype = $mysqli->real_escape_string(strip_tags($_GET['coltype']));
///@$value = mysqli_real_escape_string(strip_tags($con, $_POST['value'])); // new chnge
//$tablename = $mysqli->real_escape_string(strip_tags($_GET['tablename'])); //studentbio

?> 

<p><br /> 
  <br />
</p>
<p>&nbsp;</p>
<p style="font-weight: bold">Add a new component  </p>
<p style="font-style: italic">If you add new component where some student had already paid school fee, you knw what that mean, you catch them at clearance.</p>
<a href="index.php?setfee"><button> Go back</button>
</a>
<form action="add.php"  method="post">

Component: eg PTA<br />
<input type="text" name="value" id="" placeholder="eg: PTA" width="200" style="font-size:18px; width:60%"  />
<br /><br />
 <select name="ses" id="label">
                  <?php 
			   // loop grades out of db and use $student_entry_id as selected
			   $loopyear = mysql_query("SELECT * FROM school_years ORDER BY school_years_id");
			   while ($yearlist = mysql_fetch_array($loopyear, MYSQL_ASSOC)) {?>
                  <option value="<?php echo $yearlist['school_years_id'];?>"><?php echo $yearlist['school_years_desc'];?> </option>
                  <?php
			   
			   }
			   ?>
  </select>
<br />
<br />

<input type="number" name="term" id="" placeholder="enter 1,2 or 3" width="80" style="font-size:18px; width:10%"  />
<br /><br />
 <select name="grade" id="label">
                  <?php 
			   // loop grades out of db and use $student_entry_id as selected
			   $loopgrade = mysql_query("SELECT * FROM grades ORDER BY grades_id");
			   while ($gradelist = mysql_fetch_array($loopgrade, MYSQL_ASSOC)) {?>
                  <option value="<?php echo $gradelist['grades_id'];?>"><?php echo $gradelist['grades_desc'];?> </option>
                  <?php
			   
			   }
			   ?>
  </select>

<br /><br />
<input type="submit" value="Add new Component" />
</form>
<?php
            
@$value = trim($_POST['value']);		
@$ses = trim($_POST['ses']);		
@$term = trim($_POST['term']);		
@$gr = trim($_POST['grade']);		
	
	                                    
if (empty($value) || empty($ses) || empty($term) || empty($gr)){
echo"Enter the value like PTA above and hit add new"; 
exit;}
//$value = mysqli_real_escape_string(strip_tags($con, $_POST['value'])); // new chnge
if ($value == 'total'){
echo  '<font color="red">You cannot add total here</font>'; 
exit;
}

if ($term >3){
echo '<font color="red">Invalid term Entered</font>'; 
exit;
}


@$sql ="INSERT INTO `school_fees_default` (`id`, `component`, `grades`, `grades_term`, `school_year`, `price`, `date`, `creator`, `comment`, `active`) VALUES (NULL, '$value', '$gr', '$term', '$ses', '', '', '', '', '');";

 if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo '<font color="green">Well done, <strong>'.$value.'</strong> was added in the database, you can now add the price by editing fee for the class you added</font>';

mysqli_close($con);
?>
     