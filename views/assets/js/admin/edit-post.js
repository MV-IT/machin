jQuery(document).ready(function(){
	$('#add-new-post').click(function(){
		var post_title = $('[name="post-title"]').val();
		var post_content = $('[name="post-content"]').summernote('code');
		var post_type = $(this).data('post_type');
		var post_id = $(this).data('id');
		var image = $('#image')[0].files[0];

		var list_categories = [];
		$('[name="list-category[]"]:checked').each(function(index, el) {
			list_categories.push($(this).val());
		});

		var formdata = new FormData();
		formdata.append('action', 'ajax_edit_post');
		formdata.append('post_content', post_content);
		formdata.append('post_title', post_title);
		formdata.append('post_type', post_type);
		formdata.append('post_id', post_id);
		formdata.append('image', image);
		formdata.append('list_categories', list_categories);

		$.ajax({
			url: web_url + 'libs/ajax_functions.php',
			type: 'POST',
			contentType: false,
			processData: false,
			data: formdata,
			success: function(data){
				if(data != 0){
					window.location.assign(web_url + 'admin/post/' + post_type + '/edit/' + data);
				}else{
					$.toast({
						heading: 'Lỗi!',
						text: 'Kiểm tra lại thông tin!',
						position: 'top-right',
						icon: 'danger',
						loaderBg: '#ff6849',
						hideAfter: 2000,
						stack: 6
					});
				}
			}
		});
	});

	$('.delete-category').on('click', function(){
		var category_id = $(this).data('id');
		$('[name="category-delete"]').val(category_id);
	});

	$('.edit-category').on('click', function(){
		var category_id = $(this).data('id');
		$('[name="edit-category-submit"]').val(category_id);
		$.ajax({
			url: web_url + 'libs/ajax_functions.php',
			type: 'post',
			dataType: 'json',
			data: {
				action: 'ajax_get_category_info',
				category_id: category_id
			},
			success: function(data){
				$('#edit-category-title').val(data['title']);
				$('#edit-category-slug').val(data['slug']);
			}
		});
		
	});
});