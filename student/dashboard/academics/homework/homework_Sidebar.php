			<div class="col-md-3 no-print fling">
				<div class="box box-primary border_bttn">
					<div class="box-header">
						<h4 class="box-title">Side Panel</h4>
					</div>
			<style type="text/css">
				select { padding:8px; } 
			</style>	
			
			<?php $kas_framework->showInfoCallout('<b>Note:</b> Select other Sessions and Term Homework'); ?>				
					<form role="form" action="../homework/" method="post" id="addEventForm">
						<div class="box-body">
							<div class="form-group">
								<label for="color">Pick Session: </label>
									<select name="school_years"> <option value="%%">All</option>
									<?php $kas_framework->getDistinctField('homework', 'session', 'grade', '%%', 'school_years', 'school_years_desc', 'school_years_id', $dyn_grade_year) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
							<div class="form-group">
								<label for="color">Grade Year: </label>
									<select name="grade"> <option value="%%">All</option>
									<?php $kas_framework->getDistinctField('homework', 'grade', 'grade', '%%', 'grades', 'grades_desc', 'grades_id', $dyn_grade) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
							<div class="form-group">
								<label for="color">Which Term? </label>
									<select name="grade_terms"><option value="%%">All</option>
									<?php $kas_framework->getDistinctField('homework', 'term', 'grade', '%%', 'grade_terms', 'grade_terms_desc', 'grade_terms_id', $dyn_grade_history_term) ?>
									</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
						</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary click_ult">
						<i class="fa fa-check"></i> Change to the Selected</button>
					</div>
					<?php (isset($_SESSION['tapp_par_username']))? $kas_framework->getMessageforUser('parent'): $kas_framework->getMessageforUser('student'); ?>
			</form>
		 </div><!-- /. box -->
	  </div><!-- /.col -->