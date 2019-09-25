<?php
(file_exists('../../../php.files/classes/pdoDB.php'))? include ('../../../php.files/classes/pdoDB.php'): include ('../../../../php.files/classes/pdoDB.php');
(file_exists('../../../php.files/classes/kas-framework.php'))? include ('../../../php.files/classes/kas-framework.php'): include ('../../../../php.files/classes/kas-framework.php');
//Include global functions
include_once "../../../includes/common.php";
// config
include_once "../../../includes/configuration.php";

  session_start();
if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
  {
    header ("Location: ../../../index.php?action=notauth");
	exit;
}

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
       <?php  $kas_framework->getallFieldinDropdownOption('school_years', 'school_years_desc', 'school_years_id');  ?>
  </select>
<br />
<br />

<input type="number" name="term" id="" placeholder="enter 1,2 or 3" width="80" style="font-size:18px; width:10%"  />
<br /><br />
 <select name="grade" id="label">
     <?php  $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id', $matchField); ?>
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
		echo "Enter the value like PTA, Tuition, Hostel above and hit add new"; 
		exit;
	}
	//$value = mysqli_real_escape_string(strip_tags($con, $_POST['value'])); // new chnge
	if (strtolower($value) == 'total'){
		echo  '<font color="red">You cannot add total here</font>'; 
		exit;
	}

	if ($term > 3){
		echo '<font color="red">Invalid term Entered</font>'; 
		exit;
	}


	@$sql ="INSERT INTO `school_fees` (`id`, `component`, `grades`, `grades_term`, `school_year`, `price`, `date`, `creator`, `comment`, `active`) VALUES (NULL, '$value', '$gr', '$term', '$ses', '', '', '', '', '');";
	$dbh_sql = $dbh->prepare($sql); $checkEx = $dbh_sql->execute(); $dbh_sql = null;
	 if (!$checkEx) {
	  die('Error: Contact Kastech Network');
	}
	echo '<font color="green">Well done, <strong>'.$value.'</strong> was added in the database, you can now add the price, click back and find it by typing '.$value.' in filter form</font>';
?>