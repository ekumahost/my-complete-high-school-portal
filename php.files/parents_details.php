<?php
	$username = $_SESSION['tapp_par_username'];
	//details from web_parents
	$querySQL = "SELECT * FROM web_parents WHERE web_parents_username = '".$username."' AND web_parents_type = 'C'";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();
	$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;	
	
	$web_parents_relid = $paramGetFields->web_parents_relid;
	$web_parents_flname = $paramGetFields->web_parents_flname;
	$web_parents_active = $paramGetFields->web_parents_active;
	
	//details from student_parents
	$querySQL2 = "SELECT * FROM student_parents WHERE student_parents_id = '".$web_parents_relid."' LIMIT 1";
	$db_handle = $dbh->prepare($querySQL2);
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();
	$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;	
	

	$student_parents_title = $paramGetFields->student_parents_title;
	$student_parents_firstname = $paramGetFields->student_parents_firstname;
	$student_parents_lastname = $paramGetFields->student_parents_lastname;
	$student_parents_mi = $paramGetFields->student_parents_mi;
	$student_parents_email = $paramGetFields->student_parents_email;
	$student_parents_sex = $paramGetFields->student_parents_sex;
	$student_parents_contactaddress1 = $paramGetFields->student_parents_contactaddress1;
	$student_parents_contactaddress2 = $paramGetFields->student_parents_contactaddress2;
	$student_parents_mobile1 = $paramGetFields->student_parents_mobile1;
	$student_parents_mobile2 = $paramGetFields->student_parents_mobile2;
	$student_parents_city = $paramGetFields->student_parents_city;
	$student_parents_state = $paramGetFields->student_parents_state;
	$student_parents_country = $paramGetFields->student_parents_country;
	$student_parents_school = $paramGetFields->student_parents_school;
	$student_parents_occupation = $paramGetFields->student_parents_occupation;
	$student_parents_image = $paramGetFields->student_parents_image;
	$student_parents_status = $paramGetFields->student_parents_status;
	
	$completeness = 19;
	if ($student_parents_title != 0) { $completeness = $completeness + 5; }
	if ($student_parents_firstname != '') { $completeness = $completeness + 5; }
	if ($student_parents_lastname != '') { $completeness = $completeness + 5; } 
	if ($student_parents_mi != '') { $completeness = $completeness + 5; } 
	if ($student_parents_email != '') { $completeness = $completeness + 5; }
	if ($student_parents_contactaddress1 != '') { $completeness = $completeness + 5; }
	if ($student_parents_contactaddress2 != '') { $completeness = $completeness + 5; }
	if ($student_parents_mobile1 != '') { $completeness = $completeness + 5; }
	if ($student_parents_mobile2 != '') { $completeness = $completeness + 5; }
	if ($student_parents_city != '') { $completeness = $completeness + 5; }
	if ($student_parents_state != '') { $completeness = $completeness + 5; }
	if ($student_parents_country != '') { $completeness = $completeness + 5; }
	if ($student_parents_occupation != '') { $completeness = $completeness + 5; }
	if ($student_parents_image != '') { $completeness = $completeness + 23; }
	
	if ($completeness > 100) { $completeness = 99; }
?>