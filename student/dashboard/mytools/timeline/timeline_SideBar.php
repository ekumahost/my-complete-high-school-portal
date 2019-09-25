		<div class="col-md-3 no-print fling">
			<div class="box box-primary border_bttn">
				<div class="box-header">
					<h4 class="box-title">Side Panel</h4>
				</div>
			
		
		<?php $kas_framework->getMessageforUser('student');  ?>
		<!--- showing the current status of the pay -->
			<h4>TimeLine Review</h4>
			
				<form action="" method="post" style="padding:0 0 2px 20px"> Select Range: 
				<select name="selectedTimelineRange" style="padding:5px; margin:0 4px 0 0"><option></option>
				<?php 
					for ($i=1; $i<=12; $i++) {
					
						//$selected = ($preview->$priKeyField2 == $matchField) ? 'selected=selected': '';
						/* check for selected */
							if (isset($_POST['selectedTimelineRange'])) {
								$selected = ($_POST['selectedTimelineRange'] == $i)? 'selected=selected': '';
							} else { 
								$selected = ($i == '1')? 'selected=selected':  '';
							}
						
						print '<option value="'.$i.'" '.$selected.'>'.$i.' Month(s) </option>';
					}
				?>
				</select><br /><br />
				<button type="submit" class="btn bg-blue click_ult" name="proceed_button" style="margin:5px">PROCEED</button></form>
				
	 </div><!-- /. box -->
  </div><!-- /.col -->