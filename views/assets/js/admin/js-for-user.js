var cropper;    
window.addEventListener('DOMContentLoaded', function(){
	var image = document.querySelector('#image');
	cropper = new Cropper(image, {
		viewMode: 1,
		autoCropArea: 0.65,
		aspectRatio: 1/1,
		movable: true,
		zoomable: true,
		rotatable: true,
		scalable: true
	});
});

jQuery(document).ready(function($){

	$('input[name="username"]').blur(function(){
		var username = $(this).val();
		if(username.length > 0){
			$.ajax({
				url : web_url + 'libs/ajax_functions.php',
				type: 'post',
				data: {
					'action' : 'ajax_user_exists',
					'username' : username
				},
				success: function(data){
					console.log(data);
					if(data == 1){
						$("#alert-user_exists").fadeIn();
						$("#alert-user_n_exists").fadeOut();
						$("#alert-username_0").fadeOut();
					}else{
						$("#alert-user_exists").fadeOut();
						$("#alert-user_n_exists").fadeIn();
						$("#alert-username_0").fadeOut();
					}
				}
			});
		}else{
			$("#alert-username_0").fadeIn();
			$("#alert-user_exists").fadeOut();
			$("#alert-user_n_exists").fadeOut();
		}
	});

	$("input[name='password']").blur(function(){
		var pass = $(this).val();
		if(pass.length < 6){
			$("#alert-pass_6").fadeIn();
			$("#alert-pass_special").fadeOut();
			$("#alert-pass_success").fadeOut();
		}else if(/^[a-zA-Z0-9- ]*$/.test(pass) == false) {
			$("#alert-pass_6").fadeOut();
			$("#alert-pass_special").fadeIn();
			$("#alert-pass_success").fadeOut();
		}else{
			$("#alert-pass_6").fadeOut();
			$("#alert-pass_special").fadeOut();
			$("#alert-pass_success").fadeIn();
		}
	});

	$("input[name='r_password']").blur(function(){
		var pass2 = $(this).val();
		if(pass2 != $("input[name='password']").val())
			$("#pass_wrong").fadeIn();
		else
			$("#pass_wrong").fadeOut();
	});

	$("input[name='email']").blur(function(){
		var email = $(this).val();
		if(email.length > 0){
			$.ajax({
				url : web_url + 'libs/ajax_functions.php',
				type: 'post',
				data: {
					'action' : 'ajax_email_exists',
					'email' : email,
					'type': 'users'
				},
				success: function(data){
					console.log(data);
					if(data == 1){
						$("#alert-email_exists").fadeIn();
						$("#alert-email_n_exists").fadeOut();
						$("#alert-n_email").fadeOut();
					}else if(data == 0){
						$("#alert-email_exists").fadeOut();
						$("#alert-email_n_exists").fadeIn();
						$("#alert-n_email").fadeOut();
					}else{
						$("#alert-email_exists").fadeOut();
						$("#alert-email_n_exists").fadeOut();
						$("#alert-n_email").fadeIn();
					}
				}
			});
		}
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