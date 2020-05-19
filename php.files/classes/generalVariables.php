<?php
	$current_year_id = $kas_framework->getValue('current_year', 'tbl_config', 'id', '1');
	$current_year_full = $kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $current_year_id);
	
	$currentTerm_id = $kas_framework->getValue('grade_terms_id', 'grade_terms', 'current', '1');
	$currentTerm = $kas_framework->getValue('grade_terms_desc', 'grade_terms', 'current', '1');
	
	$default_state = $kas_framework->getValue('default_state', 'tbl_config', 'id', '1');
	$default_city = $kas_framework->getValue('default_city', 'tbl_config', 'id', '1');
	
	$querySQL = "SELECT * FROM tbl_admission WHERE active = '1' LIMIT 1";
	$db_handle = $dbh->prepare($querySQL);
	$db_handle->execute();
	$get_rows = $db_handle->rowCount();
	$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;

		if ($get_rows == 1) {
			$admission_batch_id = $kas_framework->getValue('id', 'tbl_admission', 'active', '1');
		}
	
	/* maintenance mode redirect security*/
	if ($kas_framework->app_config_setting('maintenance_mode') == true) {
		print '<script type="text/javascript"> self.location = "'. $kas_framework->url_root('maintenance') .'"</script>';
	}
	
	/* making sure that there is no get variable in the url for the deducing of parameters passed to the table */
	$dyn_grade_year = (isset($_POST['school_years']))? $_POST['school_years'] :  $current_year_id;
	$dyn_grade_history_term = (isset($_POST['grade_terms']))? $_POST['grade_terms'] :  $currentTerm_id;
	/* making sure that there is no get variable in the url for the deducing of parameters passed to the table and beyond */ 
		
		
	/* sweet mailbox cruzer */
		if (isset($_SESSION['tapp_par_username'])) {
			$my_username = $_SESSION['tapp_par_username'];
			$from_category = 'parent';	
		} else if (isset($_SESSION['tapp_std_username'])) {
			$my_username = $_SESSION['tapp_std_username'];
			$from_category = 'student';	
		} else if (isset($_SESSION['tapp_prostd_username'])) {
			$my_username = $_SESSION['tapp_prostd_username'];
			$from_category = 'student';	
		} else if (isset($_SESSION['tapp_staff_username'])) {
			$my_username = $_SESSION['tapp_staff_username'];
			$from_category = 'staff';	
		}
	/* sweet mailbox cruzer */
	

?>