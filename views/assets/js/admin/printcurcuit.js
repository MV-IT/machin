var cropper;    
window.addEventListener('DOMContentLoaded', function(){
	var image = document.querySelector('#image');
	cropper = new Cropper(image, {
		viewMode: 1,
		autoCropArea: 0.65,
		aspectRatio: 3/2,
		movable: true,
		zoomable: true,
		rotatable: true,
		scalable: true
	});
});

jQuery(document).ready(function($) {
	$('input[type="radio"].property-value').click(function() {
		var list_chose = [];

		$('input[type="radio"].property-value:checked').each(function(){
			list_chose.push($(this).val());
		});

		$.ajax({
			url: web_url + 'libs/ajax_functions.php',
			type: 'post',
			dataType: 'json',
			data: {
				action : 'ajax_caculator_price_from_chose',
				list_chose: list_chose
			},
			success: function(data){
				console.log(data);
				$('#price-num').html(data['html']);
			}
		});
	});

	$('.dropify').on('click drop', function(){
		$('#crop_image_button_modal').click();
	});

	$('.crop_image').click(function(){
		$('#image_after_crop').val(cropper.getCroppedCanvas().toDataURL());
		var img = $('.dropify-render').children('img');
		img.attr('src', cropper.getCroppedCanvas().toDataURL());
		$('#crop_image_button_modal').fadeIn();
	});

	$('.dropify').on('change', function(e){
		var file = $(this)[0].files[0];
		var reader = new FileReader();
		reader.onload = function () {
			var image = new Image();
			image.onload = function(){
				if(image.width > 1000 || image.height > 1000){
					alert('Kích thước ảnh quá lớn! Chọn lại ảnh khác!(max là 1000px)');
					return;
				}
			}
			image.src = reader.result;
			cropper.replace(reader.result);
		};

		reader.readAsDataURL(file);
	});
});	