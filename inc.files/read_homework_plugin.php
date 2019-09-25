<?php
	print '<div class="box">';
	$id__generated = $kas_framework->unsaltifyID($_GET['hmid']);

		$getAssignment_details = "SELECT * FROM homework WHERE homework_id = '".$id__generated."' LIMIT 1";
		
		$db_handle = $dbh->prepare($getAssignment_details);
		$db_handle->execute();
		$get_rows = $db_handle->rowCount();
		$get_Homework = $db_handle->fetch(PDO::FETCH_OBJ);
			
			/* getting staff details... */
			$staffDetails = "SELECT * FROM staff WHERE staff_id = '".$get_Homework->teacher_id."' LIMIT 1";
			$db_handleSP = $dbh->prepare($staffDetails);
			$db_handleSP->execute();
			$get_rows = $db_handleSP->rowCount();
			$get_StaffObj = $db_handleSP->fetch(PDO::FETCH_OBJ);
			
			$staffFname =$get_StaffObj->staff_fname;
			$staffLname =$get_StaffObj->staff_lname;
			$staffImg =$get_StaffObj->staff_image;
			$staffSex =$get_StaffObj->staff_sex;
			$staff_title_id =$get_StaffObj->staff_title;
			$staffTitle = $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $staff_title_id); 
			
			$fancyRetrieve = $kas_framework->imageDynamic($staffImg, $staffSex);
			
			print '<table width="100%" border="0" cellpadding="4" style="margin:4px 20px">
				<tr><td><b>Homework Name: </b> </td><td>'.$get_Homework->name.'</td></tr>
				<tr><td><b>Teacher: </b> </td><td>'.$staffTitle.' '.$staffFname.' '.$staffLname.' 
				<a href="'.$fancyRetrieve.'" style="cursor:pointer" class="fancybox fancybox.image">{View Image}</a></td></tr>
				<tr><td><b>Exam was Set: </b> </td><td>'.$kas_framework->getValue('school_years_desc', 'school_years', 'school_years_id', $get_Homework->session).'</td></tr>
				<tr><td><b>Term: </b> </td><td>'.$kas_framework->getValue('grade_terms_desc', 'grade_terms', 'grade_terms_id', $get_Homework->term).'</td></tr>
				<tr><td><b>Subject: </b> </td><td>'.$kas_framework->getValue('grade_subject_desc', 'grade_subjects', 'grade_subject_id', $get_Homework->subject).'</td></tr>
				<tr><td><b>Date Assigned: </b> </td><td>'.$get_Homework->date_assigned.'</td></tr>
				<tr><td><b>To be Submitted: </b> </td><td>'.$get_Homework->date_due.'</td></tr>
				<tr><td><b>Instruction: </b> </td><td>'.$get_Homework->instruction.'</td></tr>
				<tr><td colspan="2"><hr /></td></tr>
				<tr><td colspan="2">';
				/* detect wether its a file or a text written. first of all, we check if its a file */
				if ($get_Homework->notepad_text == '') {
					print 'This Homework was Uploaded as a File. <a href="'.$kas_framework->server_root_dir('files/homework_files/'). $get_Homework->homework_file.'"><div class="btn btn-success btn-file">
                                    <i class="fa fa-cloud-download"></i> Download
                      </div></a>';
				} else {
					print '<fieldset><legend>Homework Body</legend>'.$get_Homework->notepad_text.'</fieldset>';
				}
				
				
				print '<hr /> </td></tr>
			</table>';

print '</div>';
?>