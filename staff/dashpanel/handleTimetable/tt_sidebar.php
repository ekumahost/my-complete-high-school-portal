<div class="col-md-3 no-print fling">
						<div class="box box-primary border_bttn">
							<div class="box-header">
								<h4 class="box-title">Side Panel</h4>
							</div>
					<?php $kas_framework->showInfoCallout('<b>Note:</b> This Page is mainly for Time Table Creation. If you want to View Timetable, Please use the Menu <b>Academic Tools</b> &raquo; <b>School Timetable</b>.
					Timetable Clash will be communicated to you here also'); ?>
						
							<form role="form" action="hyperCopy" method="post" id="addEventForm">
							<div class="box-footer">
								<div style="margin:0 0 10px 0; text-align:center"><a href="hyperCopy" class="btn btn-default click_ult">
								<i class="fa fa-copy"></i> Copy Previous Term<br /> Timetable to this Term </a>
								</div><div style="margin:0 0 10px 0; text-align:center">
								<a href="home" class="btn btn-default click_ult">
								<i class="fa fa-plus"></i> Add Timetable </a>
								</div></center>
							</div>
							<?php // $kas_framework->getMessageforUser('staff'); ?>
						</form>
					 </div><!-- /. box -->
				  </div><!-- /.col -->