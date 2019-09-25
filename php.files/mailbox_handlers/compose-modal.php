	<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><i class="fa fa-envelope-o"></i> Compose New Message</h4>
				</div>
				<?php if (isset($_GET['rid'])) {
					$querySQL = "SELECT * FROM general_mailing WHERE id = '".$kas_framework->unsaltifyID($_GET['rid'])."'";
					$db_handle = $dbh->prepare($querySQL);
					$db_handle->execute();
					$paramGetFields = $db_handle->fetch(PDO::FETCH_OBJ);
					$db_handle = null;	
					
					$email_to = $paramGetFields->from;
					} else {
					$email_to = @$_POST['email_to'];
					}
				?>
				<form action="?folder=sent" method="post" enctype="multipart/form-data" id="sendMailForm">
					<div class="modal-body">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">Email To:</span>
								<input required="required" name="email_to" type="text" class="form-control" placeholder="Email To" value="<?php print $email_to ?>">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">Heading</span>
								<input name="email_heading" type="text" class="form-control" maxlength="40" placeholder="Heading" value="<?php print @$_POST['email_heading'] ?>">
							</div>
						</div>
						<div class="form-group">
                                <textarea name="email_message" required="required" id="email_message" class="form-control" placeholder="Message" style="height: 120px;"><?php print @$_POST['email_message'] ?></textarea>
                         </div>
						<div class="form-group">                                
							<div class="btn btn-success btn-file">
								<i class="fa fa-paperclip"></i> Attachment
								<input type="file" name="attachment" class="ult_attach_file" />
							</div> <span class="ult_attach_span"> </span>
							<p class="help-block">Max. 10MB </p>
						</div>

					</div>
					<div class="modal-footer clearfix">

						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

						<button id="send_mail" type="submit" name="send_mail" class="btn btn-primary pull-left"><i class="fa fa-envelope"></i> Send Message</button>
						<span id="show_sending_mail" style="display:none" class="pull-left margin"><?php $kas_framework->loading_h() ?></span>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->