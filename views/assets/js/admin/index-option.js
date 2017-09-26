var item_num = item_num;
function delete_slider_item(id){
	$('#slider-item-' + id).remove();
}
jQuery(document).ready(function($){


	$('#add-slider-item').click(function(){
		$('#slider-items-content').append('<div id="slider-item-'+item_num+'" name="slider-item[]" value="'+item_num+'" class="col-xs-12 col-sm-6 col-md-4"><div class="slider-item"><button type="button" class="btn btn-default btn-delete-slider-item" onclick="delete_slider_item('+item_num+')">Xóa</button><hr><div class="row"><div class="col-3"><label>Link: </label></div><div class="col-9"><input type="url" name="slider-item-link-'+item_num+'" class="form-control"></div><div class="mb-xs-2"></div><div class="col-3"><label>File url:<br><small>(1 trong 2)</small></label></div><div class="col-9"><input type="url" name="slider-item-file-url-'+item_num+'" class="form-control"></div><div class="col-3"><label>Upload file:</label></div><div class="col-9"><input type="file" name="slider-item-file-'+item_num+'" class="form-control"></div></div></div></div>');
		item_num += 1;
	});
});