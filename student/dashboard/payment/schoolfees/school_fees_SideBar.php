			<div class="col-md-3 no-print fling">
				<div class="box box-primary border_bttn">
					<div class="box-header">
						<h4 class="box-title">Side Panel</h4>
					</div>
				
			
			<?php $kas_framework->showInfoCallout('<b>Note:</b> This Invoice was generated on the Current Term and Year. If you are not paying for this Session, change it below.'); ?>
				<!--- showing the current status of the pay -->
				<h4>School Fees View Status</h4>
				
					<form role="form" action="" method="post" id="addEventForm">
						<div class="box-body">
							<div class="form-group">
								<label for="color">Pick Session: </label>
								<select name="school_years"> <option></option>
									<?php $kas_framework->getDistinctField('school_fees', 'school_year', 'id', '%%', 'school_years', 'school_years_desc', 'school_years_id', $school_years) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
							<div class="form-group">
								<label for="color">Grade Year: </label>
									<select name="grade_class"> <option></option>
									<?php $kas_framework->getDistinctField('school_fees_default', 'grades', 'id', '%%', 'grades', 'grades_desc', 'grades_id', $grade_class) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
							<div class="form-group">
								<label for="color">Which Term? </label>
									<select name="grade_terms"> <option></option>
									<?php $kas_framework->getDistinctField('school_fees_default', 'grades_term', 'id', '%%', 'grade_terms', 'grade_terms_desc', 'grade_terms_id', $grade_terms) ?>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
						</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary click_ult">
						<i class="fa fa-check"></i> Change to the Selected </button>
					</div>
					<?php (isset($_SESSION['tapp_par_username']))? $kas_framework->getMessageforUser('parent'): $kas_framework->getMessageforUser('student'); ?>
			</form>
		 </div><!-- /. box -->
	  </div><!-- /.col -->