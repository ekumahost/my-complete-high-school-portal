<?php

	//Starts The Plugin ::::::: Kelvin the Programmer
	
		$ProfileComplete = 10; // at least for registrering at all, you deserve a 5%
		if ($std_lname != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_fname != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_mname != '') {	$ProfileComplete = $ProfileComplete + 2; } 
		if ($std_pic != '') {	$ProfileComplete = $ProfileComplete + 20; } 
		if ($std_et != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_yob != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_bcity != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_bcont != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_bstate != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_pschname != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_pschcity != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_pschcont != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_pschname != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_pschstate != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_pschzip != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_pcontact != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_adres != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_restate != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_restown != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_mobile != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_parent_ad1 != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_parent_ad2 != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_parent_city) {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_parent_count != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_parent_email != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_parent_fname != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_parent_lname != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_parent_mobile != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_parent_mobil2 != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_parent_state != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($std_parent_title != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		
		//catching in case of any error
		if ($ProfileComplete > 100) { $ProfileComplete = '99.9'; }

		
		//Getting the Color of the Progress Bar. Changing the Color
		if ($ProfileComplete >= 70) {
			$bootstrapIdentifier = 'success';
		} else if ($ProfileComplete <= 69 and $ProfileComplete >= 40) {
			$bootstrapIdentifier = 'info';
		} else if ($ProfileComplete >= 0 and $ProfileComplete <= 39) {
			$bootstrapIdentifier = 'danger';
		}
?>