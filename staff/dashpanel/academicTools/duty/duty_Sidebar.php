<div class="col-md-3 no-print fling">
				<div class="box box-primary border_bttn">
					<div class="box-header">
						<h4 class="box-title">Side Panel</h4>
					</div>
			<style type="text/css">
				select { padding:8px; } 
			</style>	
			
			<?php $kas_framework->showInfoCallout('<b>Note:</b> If you do not Understand what this means, Please meet the Admin for Explanation.'); ?>
			
					<form role="form" action="" method="post" id="addEventForm">
						<div class="box-body">
							<div class="form-group">
								<label for="color">Pick Session: </label>
									<select name="school_years"> <option value="%%">All</option>
									<?php $kas_framework->getDistinctField('speak', 'speak_session', 'speak_teacherid', $web_users_relid, 'school_years', 'school_years_desc', 'school_years_id', $dyn_grade_year) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
							<div class="form-group">
								<label for="color">Which Term? </label>
									<select name="grade_terms"> <option value="%%">All</option>
									<?php $kas_framework->getDistinctField('speak', 'speak_term', 'speak_teacherid', $web_users_relid, 'grade_terms', 'grade_terms_desc', 'grade_terms_id', $dyn_grade_history_term) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
						</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary click_ult">
						<i class="fa fa-check"></i> Change </button>
					</div>
					<?php $kas_framework->getMessageforUser('staff'); ?>
			</form>
		 </div><!-- /. box -->
	  </div><!-- /.col -->