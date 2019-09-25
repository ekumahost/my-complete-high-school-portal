                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
						<?php $getClass = "SELECT * FROM teacher_grade_year WHERE teacher = '".$web_users_relid."' AND session = '".$current_year_id."'"; 
								$db_getClass = $dbh->prepare($getClass);
								$db_getClass->execute();
								$get_getClass_rows = $db_getClass->rowCount();
								$param_db_getClass_Obj = $db_getClass->fetch(PDO::FETCH_OBJ);
								$db_getClass = null;
								
								$class = $param_db_getClass_Obj->grade_class;
								$class_room = $param_db_getClass_Obj->grade_class_room;
									if ($class == '0') { $intro = '<font color="red">You are not the Form Master of Any Class!!!</font>'; } 
									else {
										$getClass = $kas_framework->userGradeClass($class_room, $class);
										//$getClass = $kas_framework->getValue('grades_desc', 'grades', 'grades_id', $class);
										$intro = 'You Have been Assigned to Manage '.$getClass.' Class';
							} ?>					
								
                                    <h3 class="box-title"><?php print $intro; ?></h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Admission No</th>
                                                <th>Fullname</th>
                                                <th>Other Details</th>
                                                <th>Action</th>
                                                <th>Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
					 <?php  
						$complxQ = "SELECT * FROM student_grade_year AS sgy, studentbio AS stdb, teacher_grade_year AS tgy, staff AS stf
										WHERE stdb.studentbio_id = sgy.student_grade_year_student AND stdb.admit = '1'
										AND tgy.grade_class = sgy.student_grade_year_grade AND tgy.grade_class_room = sgy.student_grade_year_class_room
										AND tgy.grade_class != '0' AND stf.staff_school = stdb.studentbio_school
										AND sgy.student_grade_year_grade = '".$teacher_grade_class."' AND sgy.student_grade_year_year = '".$current_year_id."'
										AND tgy.session = '".$current_year_id."' AND stf.staff_id = '".$web_users_relid."' AND tgy.teacher = '".$web_users_relid."'";
											$db_complxQ = $dbh->prepare($complxQ);
											$db_complxQ->execute();
											$get_complxQ_rows = $db_complxQ->rowCount();
											//$db_complxQ = null;									
												$tableFundamental->getWhilePost($db_complxQ);
						?>
                                        </tbody>
									</table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>