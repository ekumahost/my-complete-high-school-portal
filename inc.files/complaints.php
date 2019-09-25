			<!-- row -->
			<div class="row"> 

				<div class="col-md-12">
					<!-- The time line -->
					<ul class="discussion">
					<!-- discussion item -->
						<li>
							<div class="discussion-item">
								<span class="time">Date: <i class="fa fa-clock-o"></i> <?php print date('d/m/Y'); ?></span><br />
								<div class="discussion-body">
					
									<form action="" method="post" id="transcript_form">
										<div class="form-group">
											<label> Fullname </label>
											<input name="new_school_address" class="form-control" placeholder="New School Address">
										</div>
										
										<div class="form-group">
											<label>My Email</label>
											<input name="myemail" class="form-control" placeholder="Your Email Address">
										</div>
										
										<div class="form-group">
											<label>Subject</label>
											<input name="subject" class="form-control" placeholder="Subject of Discussion">
										</div>
										
										<div class="form-group">
											<label>Message</label>
											<textarea name="message" class="form-control" placeholder="Message to School Admin"></textarea>
										</div>
										<button type="submit" name="send_msg" id="submit_request" class="btn btn-primary"><i class="fa fa-send"></i> Send Message</button>
									</form>
								</div>
							</div>
						</li>
							<!-- END timeline item -->
                            </ul>
                        </div><!-- /.col -->
                    </div><!-- /.row -->