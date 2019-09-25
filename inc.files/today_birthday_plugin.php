	<?php 							
		$today = date('d/m');
		$stdCount = "SELECT * FROM studentbio WHERE studentbio_dob LIKE '".$today."%'";
		$stfCount = "SELECT * FROM staff WHERE staff_dob LIKE '".$today."%'"; 
		
		$db_handle = $dbh->prepare($stdCount); $db_handle2 = $dbh->prepare($stfCount);
		$db_handle->execute(); $db_handle2->execute();
		$pass_total_student_to_sidebar = $db_handle->rowCount(); $pass_total_staff_to_sidebar = $db_handle2->rowCount();

	?>
		<div class="col-md-9">
		<?php $kas_framework->showalertwarningwithPaleYellow('Showing Birthdays For today being <b>'.date('dS F').'</b>'); ?>
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Birthday List.</h3>                                    
				</div><!-- /.box-header -->
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>S/N</th>
								<th>Fullnames</th>
								<th>Sex</th>
								<th>Image</th>
								<th>Category</th>
								<th>Mobile</th>
							</tr>
						</thead>
						<tbody>
						<?php
						
						$sn = 0;
						while ($stdObj = $db_handle->fetch(PDO::FETCH_OBJ)) {
						$sn = $sn + 1;
						$fullname = $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $stdObj->studentbio_title). ' '.$stdObj->studentbio_lname. ' '.$stdObj->studentbio_fname;
						$fancyRetrieve = $kas_framework->imageDynamic($stdObj->studentbio_pictures, $stdObj->studentbio_gender);							
						print '<tr>
									<td>'.$sn.'</td>
									<td>'.$fullname.'</td>
									<td>'.$stdObj->studentbio_gender.'</td>
									<td><img src="'.$fancyRetrieve.'" href="'.$fancyRetrieve.'" data-fancybox-group="gallery" class="fancybox fancybox.image" width="50" style="cursor:pointer" /></td>
									<td>Student</td>
									<td>'.$stdObj->std_bio_mobile.'</td>
								</tr>';
						}	
						
						
						while ($stfObj = $db_handle2->fetch(PDO::FETCH_OBJ)) {
						$sn = $sn + 1;
							$fullname = $kas_framework->getValue('title_desc', 'tbl_titles', 'title_id', $stfObj->staff_title). ' '.$stfObj->staff_lname. ' '.$stfObj->staff_fname;
							$fancyRetrieve = $kas_framework->imageDynamic($stfObj->staff_image, $stfObj->staff_sex);	
							print '<tr>
									<td>'.$sn.'</td>
									<td>'.$fullname.'</td>
									<td>'.$stfObj->staff_sex.'</td>
									<td><img src="'.$fancyRetrieve.'" href="'.$fancyRetrieve.'" data-fancybox-group="gallery" class="fancybox fancybox.image" width="50" style="cursor:pointer" /></td>
									<td>Staff</td>
									<td>'.$stfObj->staff_mobile.'</td>
								</tr>';
					}
											
					?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>