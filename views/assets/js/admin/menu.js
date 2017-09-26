$(document).ready(function(){
	// Nestable
	$('#save_menu_position').click(function(){
		var list_menu_item = window.JSON.stringify($('#nestable2').nestable('serialize'));
		$.ajax({
			url: web_url + 'libs/ajax_functions.php',
			type: 'POST',
			data: {
				'action': 'ajax_save_menu_position',
				'list_menu_item': list_menu_item
			},
			success: function(data){
				$.toast({
					heading: '<b>Đã lưu sắp xếp mới của menu!</b>',
					position: 'top-right',
					loaderBg:'#ff6849',
					icon: 'success',
					hideAfter: 2000, 
					stack: 6
				});
			}
		});
	});
	$('#nestable2').nestable({
		group: 1,
		maxDepth: 3
	});

	$('[type="link"]').blur(function(){
		var link = $(this).val();
		if(link.indexOf('http://') == -1 && link.indexOf('#') == -1 && link.length > 0){
			$('#link_error').fadeIn(1000);
			$('#link_error').fadeOut(1000);
		}
	});

	$('#add_custom_link').click(function(){
		var title = $('#input_custom_link_menu_title').val();
		var link = $('#input_custom_link_menu_link').val();
		if(title.length > 0 && link.length > 0){
			$.ajax({
				url: web_url + 'libs/ajax_functions.php',
				type: 'POST',
				data: {
					'action': 'ajax_add_menu_item',
					'title': title,
					'link': link
				},
				success: function(data){
					$('#menu_list_item').append('<li id="item_in_menu_'+ data +'" class="dd-item dd3-item" data-id="'+ data +'"><div class="dd-handle dd3-handle"></div><div data-toggle="collapse" data-target="#menu_item_'+ data +'" class="dd3-content menu_item_content"><span class="menu_item_title_'+ data +'">'+ title +'</span><span class="pull-right"><i class="fa fa-angle-down"></i></span></div><div id="menu_item_'+ data +'" class="collapse menu_item_box"><div id="custom_link"><div class="row"><div class="col-sm-2 menu_item_title">Tiêu đề:</div><div class="input-group col-sm-10"><input id="input_menu_item_title_'+ data +'" type="text" class="form-control" value="'+ title +'"></div></div><div class="row" style="margin-top: 7.5px"><div class="col-sm-2 menu_item_title">Liên kết:</div><div class="input-group col-sm-10"><input id="input_menu_item_link_'+ data +'" type="link" class="form-control" value="'+ link +'"></div></div></div><div class="edit_menu_item_box"><button data-id="'+ data +'" class="btn btn-default delete_menu_item" onclick="delete_menu_item(this)">Xóa</button><button data-id="'+ data +'" class="btn btn-info edit_menu_item" onclick="edit_menu_item(this)">Cập nhật</button></div></li>');
					$('#input_custom_link_menu_title').val('');
					$('#input_custom_link_menu_link').val('http://');
				}
			});
		}else{
			$('#custom_link_null').fadeIn(2000);
			$('#custom_link_null').fadeOut(2000);
		}
	});

	$('.add_post_item').click(function(){
		var list_post = [];
		var post_type = $(this).data('target');
		$('[name="'+post_type+'_item"]:checked').each(function() {
			list_post.push($(this).val());
		});
		if(list_post.length > 0){
			$.ajax({
				url: web_url + 'libs/ajax_functions.php',
				type: 'POST',
				data: {
					'action': 'ajax_add_post_item_to_menu',
					'list_post' : list_post
				},
				success: function(data){
					$('#menu_list_item').append(data);        			
					$('[name="'+post_type+'_item"]:checked').each(function() {
						$(this).prop('checked',false);
					});
				}
			});
		}else{
			$('#'+post_type+'_checked_null').fadeIn(2000);
			$('#'+post_type+'_checked_null').fadeOut(2000);
		}

	});
})