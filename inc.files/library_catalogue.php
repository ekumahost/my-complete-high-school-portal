  <!-- Main content -->
	<section class="content">
	<center>
	<?php if (isset($_SESSION['tapp_std_username']) or isset($_SESSION['tapp_staff_username'])) { ?>
	<p style="font-size:15px; margin:0 0 12px 8px; width:80%"> 
			<a href="viewrecord" class="click_ult"><button class="btn btn-default btn-block">
				<i class="fa fa-desktop"></i>  See my Library Record</button></a></p>
	<?php } ?>			
		<p style="font-size:15px; margin:0 0 12px 8px; width:80%"> 
			<a href="#"><button class="btn btn-default btn-block">
				<i class="fa fa-book"></i> Visit the Online Library? </button></a></p></center>
				
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All Books in the Library and their Catalogue</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Book Name</th>
                                                <th>Position 1</th>
                                                <th>Position 2</th>
                                                <th>Book Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php  
											$library = "SELECT * FROM media_codes ORDER by media_codes_id DESC";
											$db_handle = $dbh->prepare($library);
											$db_handle->execute();

											$sn = 0;
											while ($librarybooks = $db_handle->fetch(PDO::FETCH_OBJ)) {
												$sn = $sn + 1;
												print '<tr>
														<td>'.$sn.'</td>
														<td>'.$librarybooks->media_codes_desc.'</td>
														<td>'.$librarybooks->id1.'</td>
														<td>'.$librarybooks->id2.'</td>
														<td>A</td>
													</tr>';
											}
										?>
                                        </tfoot>
									</table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->