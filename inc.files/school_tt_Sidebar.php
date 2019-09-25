<div class="col-md-3 no-print fling">
				<div class="box box-primary border_bttn">
					<div class="box-header">
						<h4 class="box-title">Side Panel</h4>
					</div>
			<style type="text/css">
				select { padding:8px; } 
			</style>	
			
			<?php $kas_framework->showInfoCallout('<b>Note:</b> Please Use the Options below for Navigation.'); ?>
				
					<form role="form" action="?classtimetable" method="post" id="addEventForm">
						<div class="box-body">
							<div class="form-group">
								<label for="color">Pick Session: </label>
									<select name="school_years">
									<?php $kas_framework->getDistinctField('teacher_schedule', 'teacher_schedule_year', 'teacher_schedule_id', '%%', 'school_years', 'school_years_desc', 'school_years_id', $dyn_grade_year) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
							<div class="form-group">
								<label for="color">Which Grade? </label>
									<select name="grade">
									<?php $kas_framework->getDistinctField('teacher_schedule', 'teacher_schedule_grade', 'teacher_schedule_id', '%%', 'grades', 'grades_desc', 'grades_id', $dyn_grade) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
							<div class="form-group">
								<label for="color">Which Term? </label>
									<select name="grade_terms">
									<?php $kas_framework->getDistinctField('teacher_schedule', 'teacher_schedule_termid', 'teacher_schedule_id', '%%', 'grade_terms', 'grade_terms_desc', 'grade_terms_id', $dyn_grade_history_term) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
						</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary click_ult">
						<i class="fa fa-check"></i> Change </button>
					</div>
					<?php // $kas_framework->getMessageforUser('staff'); ?>
			</form>
		 </div><!-- /. box -->
	  </div><!-- /.col -->