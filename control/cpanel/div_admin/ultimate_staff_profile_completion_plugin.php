<?php

	//Starts The Plugin ::::::: Kelvin the Programmer
	
		$ProfileComplete = 5; // at least for registrering at all, you deserve a 5%
		if ($lname != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($fname != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($mi != '') {	$ProfileComplete = $ProfileComplete + 2; } 
		if ($image != '') {	$ProfileComplete = $ProfileComplete + 20; } 
		if ($titles != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($staff_dob != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($country != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($state != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($address != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($town != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($res_state != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($kin_adress != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($kin_email != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($kin_phone != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($kin_relationship != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($acc_name != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($bank != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($bank_sort != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($birth != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($act_type != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($account != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($ethnicity != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($biography != '') {	$ProfileComplete = $ProfileComplete + 6; } 
		if ($birth_city != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		if ($mobile != '') {	$ProfileComplete = $ProfileComplete + 3; } 
		
		//catching in case of any error
		if ($ProfileComplete > 100) { $ProfileComplete == '99.9'; }

		
		//Getting the Color of the Progress Bar. Changing the Color
		if ($ProfileComplete >= 70) {
			$bootstrapIdentifier = 'success';
		} else if ($ProfileComplete <= 69 and $ProfileComplete >= 40) {
			$bootstrapIdentifier = 'info';
		} else if ($ProfileComplete >= 0 and $ProfileComplete <= 39) {
			$bootstrapIdentifier = 'danger';
		}
?>