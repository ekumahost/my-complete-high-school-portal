<div class="col-md-3 no-print fling">
				<div class="box box-primary border_bttn">
					<div class="box-header">
						<h4 class="box-title">Side Panel</h4>
					</div>
			<style type="text/css">
				select { padding:8px; } 
			</style>	
			
			<?php $kas_framework->showInfoCallout('<b>Note:</b> Please Use this Panel to View Your Class Note'); ?>
			
			<p style="font-size:15px; margin:0 0 12px 8px; width:80%"> 
			<a href="<?php print $kas_framework->url_root('staff/dashpanel/academicTools/classnote/') ?>" class="click_ult"><button class="btn btn-default btn-block">
				<i class="fa fa-plus"></i> Add Class Note </button></a></p>
				
					<form role="form" action="myClassnotes" method="post" id="addEventForm">
						<div class="box-body">
							<div class="form-group">
								<label for="color">Pick Session: </label>
									<select name="school_years"> <option value="%%">All</option>
									<?php $kas_framework->getDistinctField('classnote', 'session', 'teacher_id', $web_users_relid, 'school_years', 'school_years_desc', 'school_years_id', $dyn_grade_year) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
							<div class="form-group">
								<label for="color">Which Term? </label>
									<select name="grade_terms"> <option value="%%">All</option>
									<?php $kas_framework->getDistinctField('classnote', 'term', 'teacher_id', $web_users_relid, 'grade_terms', 'grade_terms_desc', 'grade_terms_id', $dyn_grade_history_term) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
							<div class="form-group">
								<label for="color">Which Class? </label>
									<select name="grade"> <option value="%%">All</option>
									<?php $kas_framework->getDistinctField('classnote', 'grade', 'teacher_id', $web_users_relid, 'grades', 'grades_desc', 'grades_id', $dyn_grade) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
						</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary click_ult">
						<i class="fa fa-search"></i> Filter Selection </button>
					</div>
					<?php $kas_framework->getMessageforUser('staff'); ?>
			</form>
		 </div><!-- /. box -->
	  </div><!-- /.col -->