<?php	
		/*all the processing includes*/
		if (isset($_POST['send_mail'])) {
			include (constant('tripple_return').'php.files/mailbox_handlers/send-mail.php');
		} 
		
		if (isset($_POST['mass_move_to_junk']) or isset($_POST['mass_restore_junk']) or isset($_POST['mass_delete']) or isset($_POST['mass_mark_as_read']) or isset($_POST['mass_mark_as_unread'])) {
			include ('checkbox-handler.php');
		}
		
		if (isset($_POST['junkIndiv'])) {
			if ($internalMailEx->xtraMsgHandler($_GET['rid'], $my_username, 'junk') == true) {
				$kas_framework->showInfoCallout('Message Moved to Junk');
				print '<script type="text/javascript">self.location = "?folder='.$_GET['rf'].'"</script>';
			} else {
				$kas_framework->showWarningCallout('Technical Error. Could not be Moved to Junk');
			}
		}
		
		if (isset($_POST['delIndiv'])) {
			if ($internalMailEx->xtraMsgHandler($_GET['rid'], $my_username, 'delete') == true) {
				$kas_framework->showInfoCallout('Message Permanently Deleted');
				print '<script type="text/javascript">self.location = "?folder='.$_GET['rf'].'"</script>';
			} else {
				$kas_framework->showWarningCallout('Technical Error. Could not Delete');
			}
		}
		
		if (isset($_POST['junk_restore'])) {
			if ($internalMailEx->junkRestore($_GET['rid'], $my_username) == true) {
				$kas_framework->showInfoCallout('Message Restored to its Original Folder');
				print '<script type="text/javascript">self.location = "?folder='.$_GET['rf'].'"</script>';
			} else {
				$kas_framework->showWarningCallout('Technical Error. Could not Restore');
			}
		}
		?><span id="messagDiv"></span>
	<!--all the processing includes -->
			<!-- MAILBOX BEGIN -->
			<div class="mailbox row">
				<div class="col-xs-12">
					<div class="box box-solid">
						<div class="box-body">
							<div class="row">
								<div class="col-md-3 col-sm-4" id="conrolSidebar">
									<!-- BOXES are complex enough to move the .box-header around.
										 This is an example of having the box header within the box body -->
									<div class="box-header">
										<i class="fa fa-inbox"></i>
										<h3 class="box-title">Messaging</h3>
									</div>
									<!-- compose message btn -->
									<a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i> Compose Message</a>
									<!-- Navigation - folders-->
									<div style="margin-top: 15px;">
										<ul class="nav nav-pills nav-stacked">
											<li class="header">Folders</li>
											
											<li id="inboxButton" <?php if (@$_GET['folder'] == 'inbox' or @$_GET['rf'] == 'inbox') { print 'class="active"'; } ?> >
											<a href="?folder=inbox"><i class="fa fa-inbox"></i> Inbox (<?php print $internalMailEx->countTotalRecieved() ?>) <font color="red">(<?php print $internalMailEx->countUnread() ?>)</font> </a></li>
											
											<li id="draftButton" <?php if (@$_GET['folder'] == 'draft' or @$_GET['rf'] == 'draft') { print 'class="active"'; } ?> >
											<a href="?folder=draft"><i class="fa fa-pencil-square-o"></i> Drafts</a></li>
											
											<li id="sentButton" <?php if (@$_GET['folder'] == 'sent' or @$_GET['rf'] == 'sent') { print 'class="active"'; } ?> >
											<a href="?folder=sent"><i class="fa fa-mail-forward"></i> Sent (<?php print $internalMailEx->countTotalSent() ?>)</a></li>
											
											<li id="starredButton" <?php if (@$_GET['folder'] == 'starred' or @$_GET['rf'] == 'starred') { print 'class="active"'; } ?> >
											<a href="?folder=starred"><i class="fa fa-star"></i> Starred (<?php print $internalMailEx->countTotalStarred() ?>)</a></li>
											
											<li id="junkButton" <?php if (@$_GET['folder'] == 'junk' or @$_GET['rf'] == 'junk') { print 'class="active"'; } ?> >
											<a href="?folder=junk"><i class="fa fa-folder"></i> Junk (<?php print $internalMailEx->countTotalJunk() ?>) </a></li>
										</ul>
									</div>
								</div><!-- /.col (LEFT) -->
								<div class="col-md-9 col-sm-8" id="messagebox">
									<div class="table-responsive">
										<!-- THE MESSAGES -->
										<table class="table table-mailbox"><form action="" method="post">
											<div id="loadCategory" style="display:none; position:absolute; top:50%; left:40%; padding:10px; background-color:#FFF; border:1px solid #000"><?php $kas_framework->loading('center'); ?></div>
										 <?php 
											if (@$_GET['folder'] == 'inbox') {
												include (constant('tripple_return').'php.files/mailbox_handlers/mail-inbox.php');
											} else if (@$_GET['folder'] == 'sent') {
												include (constant('tripple_return').'php.files/mailbox_handlers/mail-sent.php');
											} else if (@$_GET['folder'] == 'starred') {
												include (constant('tripple_return').'php.files/mailbox_handlers/mail-starred.php');
											} else if (@$_GET['folder'] == 'junk') {
												include (constant('tripple_return').'php.files/mailbox_handlers/mail-junk.php');
											} else if (isset($_GET['rid'])) {
												include (constant('tripple_return').'php.files/mailbox_handlers/mail-view.php');
											}
										//if none of the else is set
											else {
												include (constant('tripple_return').'php.files/mailbox_handlers/mail-inbox.php');
											}
										?> 
										</form></table>
									
										</div><!-- /.table-responsive -->
									</div><!-- /.col (RIGHT) -->
							</div><!-- /.row -->
						</div><!-- /.box-body -->
	<?php if (!isset($_GET['rid'])) { /*so that the next and previous will not show when reading*/ ?>
				<div class="box-footer clearfix">
							<div class="pull-right">
			<?php 
							
				if (!isset($_GET['page'])) {
					if ($generalTotal > 15) { $end = '15'; } else { $end = $generalTotal; }
						print 'Page 1 &raquo; Showing 1 - '.$end.'';
						$page = 1; $start = 1; $finish = 0;
				} else {
						$page = $_GET['page'];
						$start = $page * 10 - 9; $finish = $page * 10 + 5;
						if ($finish > $generalTotal) { $finish = $generalTotal; }
						$start_showing = ($deflim == 0)? '1': $deflim;
						print 'Page '.$page.' &raquo; Showing '.$start_showing.' - '. $finish;
				} ?> <small> of <?php print $generalTotal; ?></small>
														
						<?php 
				if ($generalTotal > 15) { /* introduces the next and previous button */
							if ($start > 1) { $gotoPrev = $page - 1;
			print '<a class="btn btn-xs btn-primary" href="?folder='.$_GET['folder'].'&&page='.$gotoPrev.'">
									<i class="fa fa-caret-left"></i></a>';
								} print '&nbsp;';
							if ($finish != $generalTotal) {   $gotoNxt = $page + 1;
			print '<a class="btn btn-xs btn-primary" href="?folder='.$_GET['folder'].'&&page='.$gotoNxt.'">
								<i class="fa fa-caret-right"></i></a>';
							  }
							/* introduces the next and previous button */ }						
						?>
							</div>
	</div><!-- box-footer -->
	<?php } /*the next and previous will not show */ ?>
					</div><!-- /.box -->
				</div><!-- /.col (MAIN) -->
			</div>
			<!-- MAILBOX END -->