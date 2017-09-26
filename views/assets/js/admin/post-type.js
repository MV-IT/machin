jQuery(document).ready(function($){
	$('.delete-post-type').on('click', function(){
		var post_type_id = $(this).data('id');
		$('[name="post-type-delete"]').val(post_type_id);
	});

	$('.edit-post-type').on('click', function(){
		var post_type_id = $(this).data('id');
		$('[name="edit-post-type-submit"]').val(post_type_id);
		$.ajax({
			url: web_url + 'libs/ajax_functions.php',
			type: 'post',
			dataType: 'json',
			data: {
				action: 'ajax_get_post_type_info',
				post_type_id: post_type_id
			},
			success: function(data){
				$('#edit-post-type-title').val(data[0]);
				$('#edit-post-type-slug').val(data[1]);
			}
		});
		
	});
});