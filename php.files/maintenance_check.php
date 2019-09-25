<?php
require ('classes/pdoDB.php');
require ('classes/kas-framework.php');
	extract($_POST);
	if (!isset($_POST['byepass'])) {
		exit('This file is Classified');
	}
	
	$result = "SELECT * FROM tbl_app_config WHERE module = 'maintenance_mode' LIMIT 1";
	$db_handle = $dbh->prepare($result);
	$db_handle->execute();
	$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
	$db_handle = null;	
		if (mysql_result($paramGetFields->status == 1) {
			print '<script type="text/javascript">
						$("#button_release").attr("disabled", "disabled");
					</script>';
		} else {
			print '<script type="text/javascript">self.location = "'.$reference.'"</script>';
		}
?>

	
	