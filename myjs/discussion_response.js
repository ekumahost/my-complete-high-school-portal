/* coding the like and other features, we get */


$('.bg-olive').on('click', function(e){
	post_id = $(this).attr('id');
	byepass = "b4F6F6vbfvfgBYGVFY";
	$(this).attr('disabled', 'disabled');
		
		$.post('processLikePost', {post_id:post_id, byepass:byepass}, function(data) {
			$('#nothing').html(data);
			refreshPageSender(); // refresh the page 
		})
		
	})

$('.bg-red').click(function(e) {
	$(this).html('<i class="fa fa-thumbs-down"></i> Reported to Admin');
})

$('.delete_my_post').on('click', function(e){
	post_id = $(this).attr('id');
	byepass = 'jghbYFVTYXCYUvfu';
	answer = window.confirm('Do you want to delete this post?');
	if (answer == true) {
		$.post('delete_personal_post', {post_id:post_id, byepass:byepass}, function(data) {
			$('#nothing').html(data);
			refreshPageSender(); //refresh the page 
		})
	}
})

