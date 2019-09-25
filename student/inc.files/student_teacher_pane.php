			<div class="row" id="teacher_student_pane" style="display:none">
                        <div class="col-md-6">
                            <!-- Danger box -->
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Form Teacher</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
								<?php 
								$stdTeacherQ = "SELECT * FROM studentbio AS sb, staff AS sf  WHERE sb.studentbio_form_master = sf.staff_id
													AND sb.studentbio_school = sf.staff_school AND sb.studentbio_id = '".$userid."' LIMIT 1";
													
											$db_handle = $dbh->prepare($stdTeacherQ);
											$db_handle->execute();
											$get_rows = $db_handle->rowCount();
											$stdTeacher = $db_handle->fetch(PDO::FETCH_OBJ);
											$db_handle = null;	
										
											
											if ($get_rows == 0) {
												$kas_framework->showInfoCallout('No Teacher has been Assigned to you yet. Please be patient. Check back later');
											} else {
												print '<div style="float:left;">
												<img src="'.$kas_framework->imageDynamic($stdTeacher->staff_image, $stdTeacher->staff_sex).'" 
												href="'.$kas_framework->imageDynamic($stdTeacher->staff_image, $stdTeacher->staff_sex).'" style="height:100px; cursor:pointer; margin:0 10px 0 0" class="fancybox fancybox.image" />
												</div>';
												print ' Name: <b>'.$stdTeacher->staff_fname.' '.$stdTeacher->staff_lname.'</b><br />';
												print ' Email: <b>'.$stdTeacher->staff_email.'</b><br />';
												print ' State Of Origin: <b>'.$stdTeacher->staff_state.'</b><br />';
												print ' Mobile Number: <b>'.$stdTeacher->staff_mobile.'</b><br />';
												print ' Contact Address: <b>'.$stdTeacher->staff_adress.'</b><br />';
												
											}
								
								?>                                  
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->

                        
						<div class="col-md-6">
                            <!-- Danger box -->
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Class Teacher</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <?php 
								$stdTeacherQ = "SELECT * FROM student_grade_year AS sgy, staff AS sf, teacher_grade_year AS tgy 
													WHERE tgy.teacher = sf.staff_id
													AND sgy.student_grade_year_grade = tgy.grade_class
													AND sgy.student_grade_year_grade = '".$user_student_grade_year_grade_id."'
													AND sgy.student_grade_year_student = '".$userid."' LIMIT 1";
													
										$db_handle = $dbh->prepare($stdTeacherQ);
										$db_handle->execute();
										$get_rows = $db_handle->rowCount();
										$stdTeacher = $db_handle->fetch(PDO::FETCH_OBJ);
										$db_handle = null;
											
											if ($get_rows == 0) {
												$kas_framework->showInfoCallout('No Teacher has been Assigned to your Class. Please be patient. Check back later');
											} else {
												print '<div style="float:left;">
												<img src="'.$kas_framework->imageDynamic($stdTeacher->staff_image, $stdTeacher->staff_sex).'" 
												href="'.$kas_framework->imageDynamic($stdTeacher->staff_image, $stdTeacher->staff_sex).'" style="height:100px; cursor:pointer; margin:0 10px 0 0" class="fancybox fancybox.image" />
												</div>';
												print ' Name: <b>'.$stdTeacher->staff_fname.' '.$stdTeacher->staff_lname.'</b><br />';
												print ' Email: <b>'.$stdTeacher->staff_email.'</b><br />';
												print ' State Of Origin: <b>'.$stdTeacher->staff_state.'</b><br />';
												print ' Mobile Number: <b>'.$stdTeacher->staff_mobile.'</b><br />';
												print ' Contact Address: <b>'.$stdTeacher->staff_adress.'</b><br />';
												
											}
								
								?>                                     
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
						
			</div>