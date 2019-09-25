	<style type="text/css">
		select { padding:5px; } 
	</style>
	<table width="100%" border="0" cellpadding="4">
		<tr colspan="2">Attendance Summary</tr>
			<tr><td>
				<div class="inner">
					<input type="text" class="knob" value="<?php print $dtto->getAttendanceDigit($std_id, $dyn_grade_history_term, $dyn_grade_year, $no_of_dys) ?>" data-width="90" data-height="90" data-fgColor="#535353" data-readonly="true" />
				</div>
			</td><td>
				<?php $dtto->getAttendancePercentage($std_id, $dyn_grade_history_term, $dyn_grade_year, $no_of_dys);  ?>
			</td></tr>
	</table>
			
		
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"> View Other Sessions </h3>                                    
				</div><!-- /.box-header -->
				<div class="box-body table-responsive">
				<form action="#example1" method="post">
					Session: <select name="school_years"> <option value="%%">All</option>
					<?php $kas_framework->getDistinctField('attendance_history', 'attendance_history_year', 'attendance_history_student', $std_id, 'school_years', 'school_years_desc', 'school_years_id', $dyn_grade_year) ?>
					</select>
					Term: <select name="grade_terms"><option value="%%">All</option>
					<?php $kas_framework->getDistinctField('attendance_history', 'attendance_history_term', 'attendance_history_student', $std_id, 'grade_terms', 'grade_terms_desc', 'grade_terms_id', $dyn_grade_history_term) ?>
					</select>
					<button type="submit" class="btn btn-default btn-flat click_ult" name="proceed_button">Proceed</button>
				</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
