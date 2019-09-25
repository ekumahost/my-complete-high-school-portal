<div class="col-md-3 no-print fling">
				<div class="box box-primary border_bttn">
					<div class="box-header">
						<h4 class="box-title">Side Panel</h4>
					</div>
			<style type="text/css">
				select { padding:8px; } 
			</style>	
			
			<?php $kas_framework->showInfoCallout('<b>Note:</b> Any Clash Should be Reported to the School.'); ?>
			
			<p style="font-size:15px; margin:7px 0 5px 8px; width:80%"> 
				<a href="<?php print constant('single_return') ?>schooltimetable/" class="click_ult"><button class="btn btn-default btn-block">
				<i class="fa fa-reply"></i> Class Time Table? </button></a></p>
				
					<form role="form" action="" method="post" id="addEventForm">
						<div class="box-body">
							<div class="form-group">
								<label for="color">Pick Session: </label>
									<select name="school_years"> 
									<?php $kas_framework->getDistinctField('teacher_schedule', 'teacher_schedule_year', 'teacher_schedule_teacherid', $web_users_relid, 'school_years', 'school_years_desc', 'school_years_id', $dyn_grade_year) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
							<div class="form-group">
								<label for="color">Which Term? </label>
									<select name="grade_terms"> 
									<?php $kas_framework->getDistinctField('teacher_schedule', 'teacher_schedule_termid', 'teacher_schedule_teacherid', $web_users_relid, 'grade_terms', 'grade_terms_desc', 'grade_terms_id', $dyn_grade_history_term) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
						</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary click_ult">
						<i class="fa fa-check"></i> Change to Selected</button>
					</div>
					<?php $kas_framework->getMessageforUser('staff'); ?>
			</form>
		 </div><!-- /. box -->
	  </div><!-- /.col -->