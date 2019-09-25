                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">You Have been Assigned to Manage these Students</h3>                                    
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
												$myStdQuery = "SELECT * FROM studentbio WHERE studentbio_school = '".$staff_school."' AND studentbio_form_master = '".$web_users_relid."'";
												$db_myStdQuery = $dbh->prepare($myStdQuery);
												$db_myStdQuery->execute();
												$get_myStdQuery_rows = $db_myStdQuery->rowCount();
												
											
												$tableFundamental->getWhilePost($db_myStdQuery);
												$db_myStdQuery = null;	
											?>
                                        </tfoot>
									</table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>