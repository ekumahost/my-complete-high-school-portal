	<input type="hidden" name="student" value="<?php print $decodeStdID ?>">
	<input type="hidden" name="student_school" value="<?php print $studentObj->studentbio_school ?>">
	<input type="hidden" name="year" value="<?php print $kas_framework->getValue('current_year', 'tbl_config', 'id', '1'); ?>">
	<input type="hidden" name="date_submitted" value="<?php print date('d/m/Y') ?>">
	<input type="hidden" name="term" value="<?php print $kas_framework->getValue('grade_terms_id', 'grade_terms', 'current', '1'); ?>">
	<input type="hidden" name="grade" value="<?php print $kas_framework->getValue('student_grade_year_grade', 'student_grade_year', 'student_grade_year_student', $decodeStdID); ?>">
	<input type="hidden" name="who_submitted" value="<?php print $web_users_relid ?>">
	<input type="hidden" name="byepass" value="GYYH3v5erB89YU98YyurvSrgtftr534">