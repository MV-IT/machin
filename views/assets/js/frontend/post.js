jQuery(document).ready(function($) {
	$('[class^="pagi-item-"]').click(function(event) {
		var cate_id = $(this).data('cate-id');
		var cate_slug = $(this).data('cate-slug');
		var page = $(this).data('page');
		$('.loading-overlay').fadeIn();
		$.ajax({
			url: web_url + 'libs/ajax_functions.php',
			type: 'post',
			dataType: 'html',
			data: {
				action: 'ajax_get_post_by_category',
				page: page,
				cate_id: cate_id
			},
			success: function(data){
				$('.loading-overlay').fadeOut();
				$('#tab-'+cate_slug+'-content').html(data);
			}
		});
	});
});