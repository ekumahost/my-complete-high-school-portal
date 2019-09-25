<div class="col-md-3 no-print fling">
				<div class="box box-primary border_bttn">
					<div class="box-header">
						<h4 class="box-title">Side Panel</h4>
					</div>
			<style type="text/css">
				select { padding:5px; } 
			</style>	
			
			<?php $kas_framework->showInfoCallout('<b>Note:</b> Change to View Other Months'); 
				function sel($value) {
					if (!isset($_POST['month'])) {
						print (date('m') == $value)? 'selected=selected': '';
					} else {
						print ($_POST['month'] == $value)? 'selected=selected': '';
					}
				}
			?>
				<div class="box-footer">
				<font style="font-variant:small-caps; font-weight:600">Birthday Statistics in View</font><br />
					Student: <?php print $pass_total_student_to_sidebar ?><br />
					Staff: <?php print $pass_total_staff_to_sidebar ?>
				</div>
					
					<form role="form" action="fullmonth" method="post" id="addEventForm">
						<div class="box-body">
							<div class="form-group">
								<label for="color">Month: </label>
									<select name="month">
									<option value=""></option>
									<option value="1" <?php sel(1) ?>><?php print $kas_framework->int_to_month(1) ?></option>
									<option value="2" <?php sel(2) ?>><?php print $kas_framework->int_to_month(2) ?></option>
									<option value="3" <?php sel(3) ?>><?php print $kas_framework->int_to_month(3) ?></option>
									<option value="4" <?php sel(4) ?>><?php print $kas_framework->int_to_month(4) ?></option>
									<option value="5" <?php sel(5) ?>><?php print $kas_framework->int_to_month(5) ?></option>
									<option value="6" <?php sel(6) ?>><?php print $kas_framework->int_to_month(6) ?></option>
									<option value="7" <?php sel(7) ?>><?php print $kas_framework->int_to_month(7) ?></option>
									<option value="8" <?php sel(8) ?>><?php print $kas_framework->int_to_month(8) ?></option>
									<option value="9" <?php sel(9) ?>><?php print $kas_framework->int_to_month(9) ?></option>
									<option value="10" <?php sel(10) ?>><?php print $kas_framework->int_to_month(10) ?></option>
									<option value="11" <?php sel(11) ?>><?php print $kas_framework->int_to_month(11) ?></option>
									<option value="12" <?php sel(12) ?>><?php print $kas_framework->int_to_month(12) ?></option>
								</select>
								<input type="hidden" name="byepass" value="gyj4Cynolg3Vvrc4JTYtd" />
							</div>
						</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" class="btn btn-primary click_ult">
						<i class="fa fa-check"></i> Change </button>
					</div>
					<?php $kas_framework->showWarningCallout('<b>Disclaimer:</b> This Birthdays were generated out of the date of birth supplied by all the users of this Portal. <br />Teranig will not be held responsible for any misplacement of birthdays.');  ?>
			</form>
		 </div><!-- /. box -->
	  </div><!-- /.col -->