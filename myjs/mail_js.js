		$(function() {

			"use strict";

			//Handle starring for glyphicon and font awesome
			$(".fa-star, .fa-star-o, .glyphicon-star, .glyphicon-star-empty").click(function(e) {
				e.preventDefault();
				//detect type
				var glyph = $(this).hasClass("glyphicon");
				var fa = $(this).hasClass("fa");

				//Switch states
				if (glyph) {
					$(this).toggleClass("glyphicon-star");
					$(this).toggleClass("glyphicon-star-empty");
				}

				if (fa) {
					$(this).toggleClass("fa-star");
					$(this).toggleClass("fa-star-o");
				}
			});		
		});
		
		
		$(function() {
			// Replace the <textarea id="editor1"> with a CKEditor
			// instance, using default configuration.
			CKEDITOR.replace('editor1');
			//bootstrap WYSIHTML5 - text editor
			$(".textarea").wysihtml5();
		});
	//processing the Unstarred to Starred
		$('.fa-star-o').click(function(e) {
			sentOrReceived = $(this).attr('cat');
			mailid = $(this).attr('mailid');
			$.post('../../../php.files/mailbox_handlers/star-handler', {sentOrReceived:sentOrReceived, mailid:mailid}, function(returned_data) {
				$('#messagDiv').html(returned_data);
			});
		});
		
	//processing the Starred to Unstarred
		$('.fa-star').click(function(e) {
			sentOrReceived = $(this).attr('cat');
			mailid = $(this).attr('mailid');
			$.post('../../../php.files/mailbox_handlers/star-handler', {sentOrReceived:sentOrReceived, mailid:mailid}, function(returned_data) {
				$('#messagDiv').html(returned_data);
			});
		});
		
	//processing the checked
	$('#inboxButton, #draftButton, #sentButton, #starredButton, #junkButton').click(function(e) { $('#loadCategory').show(); });

	$('#sendMailForm').submit(function(e){
		$('#show_sending_mail').show();
	})