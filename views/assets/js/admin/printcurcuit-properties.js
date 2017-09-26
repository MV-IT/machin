jQuery(document).ready(function($) {
	$('.nestable').nestable({
		group: 1,
		maxDepth: 1
	})

	$('#save-position').click(function(event) {
		var item_position = window.JSON.stringify($('.nestable').nestable('serialize'));
		$.ajax({
			url: web_url + 'libs/ajax_functions.php',
			type: 'post',
			data: {
				action: 'ajax_save_list_property_chose',
				item_position: item_position
			},
			success: function(data){
				if(data == 1){
					$.toast({
						heading: '<b>Đã lưu sắp xếp mới!</b>',
						position: 'top-right',
						loaderBg:'#ff6849',
						icon: 'success',
						hideAfter: 2000, 
						stack: 6
					});
				}
			}
		});
	});

	var chose_id = 0;

	var add_chose = function(list){
		list.append('<div id="chose-'+chose_id+'" class="chose-value" style="border: 1px solid rgba(120,130,140,.13); padding: 7.5px; margin-bottom: 15px"><div class="row"><div class="col-sm-5"><input type="text" class="form-control" name="chose-title-'+chose_id+'" placeholder="Tên lựa chọn"></div><div class="col-sm-5"><div class="input-group"><input type="number" class="form-control" name="chose-price-'+chose_id+'" placeholder="Giá"><div class="input-group-addon">VNĐ</div></div></div><div class="col-sm-2 text-center"><a href="javascript:void(0)" class="text-danger" style="line-height: 38px;" onclick="deleteChose(this)">Xóa</a></div></div></div>');
		chose_id++;
	};

	$('#new-property-add-chose').click(function() {
		add_chose($('#list-chose-in-add'));
	});

	$('.edit-property-text').click(function(){
		var id = $(this).data('id');
		$('[name="edit-property"]').val(id);
		$.ajax({
			url: web_url + 'libs/ajax_functions.php',
			type: 'post',
			data: {
				action: 'ajax_get_list_property_chose',
				id: id
			},
			dataType: 'json',
			success: function(data){
				$('#list-chose-in-edit').html(data['html']);
				$('[name="edit-title"]').val(data['title']);
				if(chose_id < data['chose_id'])
					chose_id = data['chose_id'];
			}
		});
		
	});

	$('#edit-property-add-chose').click(function(){
		add_chose($('#list-chose-in-edit'));
	});

	$('.delete-property').click(function() {
		$('[name="delete-property"]').val($(this).data('id'));
	});
});

var deleteChose = function(e){
	e.parentNode.parentNode.parentNode.remove();
}