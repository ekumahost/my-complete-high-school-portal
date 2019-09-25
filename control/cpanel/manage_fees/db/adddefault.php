<?php
(file_exists('../../../php.files/classes/pdoDB.php'))? include ('../../../php.files/classes/pdoDB.php'): include ('../../../../php.files/classes/pdoDB.php');
(file_exists('../../../php.files/classes/kas-framework.php'))? include ('../../../php.files/classes/kas-framework.php'): include ('../../../../php.files/classes/kas-framework.php');

 	//Include global functions
include_once "../../../includes/common.php";
//Initiate special database functions
include_once "../../../includes/true_mysql.php";
// config
include_once "../../../includes/configuration.php";
session_start();
//ultimate keliv worked like mad here
function pageError($title, $message) {
	print '<div style="background-color:#F2DEDE; color: #D76548; padding:5px 6px"><b>'.$title.'</b> '.$message.'</div>';
}

function pageSuccess($title, $message) {
	print '<div style="background-color:#DFF0D8; color: #468847; padding:5px 6px"><b>'.$title.'</b> '.$message.'</div>';
}

if(!isset($_SESSION['UserID']) || $_SESSION['UserType'] != "A")
  {
    header ("Location: ../../../index.php?action=notauth");
	exit;
}

?> 
<style type="text/css">
	input[type="text"], input[type="number"], select { padding: 5px; }
</style>
<div style="margin:0 auto; width:90%; max-width:900px; min-width:430px">
<p style="font-variant:small-caps; font-weight:900; font-size:18px; text-align:center">Add a New Fees Component </p>
<p style="font-style: italic">If you add new component where some student had already paid school fee, you knw what that mean, you catch them at clearance.</p>
<!--- <a href="index.php?setfee"><button> Go back</button>   -->
</a>
<table>
<form action="adddefault.php"  method="post">
<tr><td>Component:</td><td><input type="text" name="value" id="" placeholder="eg. Development fees" style="width:200px"  /></td></tr>

<tr><td> Session: </td><td><select name="ses" id="label">
  <?php    $kas_framework->getallFieldinDropdownOption('school_years', 'school_years_desc', 'school_years_id'); ?>
  </select></td></tr>
  
<tr><td>Term:</td><td><select name="term">
<?php $kas_framework->getallFieldinDropdownOption('grade_terms', 'grade_terms_desc', 'grade_terms_id');  ?>
</select></td></tr>

<tr><td>Grade/Class: </td><td> <select name="grade" id="label">
	  <?php $kas_framework->getallFieldinDropdownOption('grades', 'grades_desc', 'grades_id');  ?>
  </select></td></tr>
  <tr><td>Price: </td><td><input type="number" name="price" placeholder="Price eg. 1200" /></td></tr>
  
<tr><td colspan="2" align="right"><input style="padding:4px" type="submit" name="add_button" value="Add new Component" /></td></tr>


</form>
</table>
<?php
	// added by the ultimate keliv
  if (isset($_POST['add_button'])) {
	@$price = trim($_POST['price']);		
	@$value = trim($_POST['value']);		
	@$ses = trim($_POST['ses']);		
	@$term = trim($_POST['term']);		
	@$gr = trim($_POST['grade']);
	
	if ($kas_framework->strIsEmpty($price) or $kas_framework->strIsEmpty($value) or $kas_framework->strIsEmpty($ses) or $kas_framework->strIsEmpty($term) or $kas_framework->strIsEmpty($gr)) {
		pageError('Empty Field! ', 'One or More Fields are Empty');
	} else if ($value == 'total') {
		pageError('Clash Error! ', 'Value Name Cannot be Named as "Total"');
	} else if (!is_numeric($price)) {
		pageError('Type Mismatch! ', 'Price Should be in Numeric Format only');
	} else {
		$sql ="INSERT INTO `school_fees_default` (`id`, `component`, `grades`, `grades_term`, `school_year`, `price`, `date`, `creator`, `comment`, `active`) 
					VALUES (NULL, '".htmlentities($value)."', '$gr', '$term', '$ses', '".htmlentities($price)."', '', '', '', '')";
					$dbh_sql = $dbh->prepare($sql); $dbh_sql->execute(); $rowCount = $dbh_sql->rowCount(); $dbh_sql = null;

				if ($rowCount == 1) {
					pageSuccess('Good Job Admin! ', 'School Fees Component Added. Please Check if there is a Clash by selecting the class.');
				} else {
					pageError('Handshake Error! ', 'Could not Insert this Component. Please Try again');
				}		
			}
}  		

?>
 </div>