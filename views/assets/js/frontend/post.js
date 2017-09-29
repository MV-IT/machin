jQuery(document).ready(function($) {
	$('[class^="pagi-item-"]').click(function(event) {
		var cate_id = $(this).data('cate-id');
		var cate_slug = $(this).data('cate-slug');
		var page = $(this).data('page');
		var pageNext, pagePrev;
		if ($(this).attr('class').indexOf('prev') != -1){
			pagePrev = page - 1;
			pageNext = page + 1;
		}else{
			pagePrev = page - 1;
			pageNext = page + 1;
		}
		if($(this).attr('class').indexOf('cursor-not-allowed') != -1){
			$('.loading-overlay').fadeOut();
			return;
		}
		$('.loading-overlay').fadeIn();
		$.ajax({
			url: web_url + 'libs/ajax_functions.php',
			type: 'post',
			data: {
				action: 'ajax_get_post_by_category',
				page: page,
				cate_id: cate_id
			},
			dataType: 'json',
			success: function(data){
				console.log(data);
				$('.loading-overlay').fadeOut();
				$('#tab-'+cate_slug+'-content').html(data['html']);
				$('.pagi-item-prev').attr('data-page', pagePrev);
				if(data['prev'] == true){
					$('.pagi-item-prev').removeClass('cursor-not-allowed');
				}
				else{
					$('.pagi-item-prev').addClass('cursor-not-allowed');
				}
				if(data['next'] == true){
					$('.pagi-item-next').removeClass('cursor-not-allowed');
				}
				else{
					$('.pagi-item-next').addClass('cursor-not-allowed');
				}
				$('.pagi-item-next').attr('data-page', pageNext);
			}
		});
	});
});