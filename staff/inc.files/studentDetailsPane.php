<div class="col-md-5">						
						<div class="box box-success">
							<div class="box-header">
								<h3 class="box-title">Student Details</h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="" method="post" id="update_contactForm">
								<div class="box-body">
								<table width="100%" border="0" cellpadding="4">
									<?php $userImg = $kas_framework->imageDynamic($studentObj->studentbio_pictures, $studentObj->studentbio_gender, $kas_framework->server_root_dir('pictures/')); 
											print '<center><img src="'.$userImg.'" width="150" style="margin:10px; border:4px double #000" /></center>';
									?>
									<tr><td><b>Current Grade</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $studentObj->student_grade_year_grade) ?></td></tr>
									<tr><td><b>Surname</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $studentObj->studentbio_fname; ?></td></tr>
									<tr><td><b>Lastname</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $studentObj->studentbio_lname; ?></td></tr>
									<tr><td><b>Ethnicity</b> <i class="fa fa-hand-o-right"></i></td><td>
									<?php print $kas_framework->getValue('ethnicity_desc', 'ethnicity', 'ethnicity_id', $studentObj->studentbio_ethnicity); ?></td></tr>
									<tr><td><b>State</b> <i class="fa fa-hand-o-right"></i></td><td>
									<?php print $kas_framework->getValue('state_name', 'tbl_states', 'state_css', $studentObj->studentbio_birthstate); ?></td></tr>
									
									<tr><td><b>Sex</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $studentObj->studentbio_gender; ?></td></tr>
									<tr><td><b>Date Of Birth</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $studentObj->studentbio_dob; ?></td></tr>
									<tr><td><b>Address</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $studentObj->std_bio_address; ?></td></tr>
									<tr><td><b>Previous Sch.</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $studentObj->studentbio_prevschoolname; ?></td></tr>
									<tr><td><b>previous Sch. Adr.</b> <i class="fa fa-hand-o-right"></i></td><td><?php print $studentObj->studentbio_prevschooladdress; ?></td></tr>
									
									</table>
								</div><!-- /.box-body -->
							</form>
						</div><!-- /.box -->
					</div><!--/.col (right) -->