	<footer>
		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-3 logo-footer">
						<img src="http://minhhagroup.com/wp-content/uploads/2016/10/cropped-logo-mhg-e1475654836859-300x236.png" alt="">
					</div>
					<div class="col-md-6 contact-footer">
						<h4 class="title">Xưởng thiết bị Minh Hà</h4>
						<p>Công Ty TNHH Thiết Bị Và Công Nghệ Minh Hà </p>
						<p> Trụ sở: Đại Vĩ - Liên Hà - Đông Anh - Hà Nội </p>
						<p>GPĐKKD Số: 01.05.165.062</p>
						<p>Sở Kế Hoạch Và Đầu Tư TP. Hà Nội cấp ngày 28.02.2011</p>
						<p>Liên hệ chúng tôi: <a href="">tuyendung.minhha@gmail.com</a></p>
					</div>
					<div class="col-md-3 follow">
						<h4 class="title">Liên kết nhanh</h4>
						<p><a href="http://minhhagroup.com" target="_blank">
							<img src="http://minhhagroup.com/wp-content/uploads/2016/10/logo-mhg-e1475654836859-300x218.png" width="32px" height="32px" align="top">&nbsp;&nbsp;&nbsp;MinhHaGroup.Com
						</a></p>
						<p><a href="http://linhkienhang.vn" target="_blank">
							<img src="http://banlinhkien.vn/themes/orange/images/lkh.png" align="top">&nbsp;&nbsp;&nbsp;LinhKienHang.Vn
						</a></p>
						<p><a href="http://choimohinh.vn" target="_blank">
							<img src="http://banlinhkien.vn/themes/orange/images/cmh.png" align="top">&nbsp;&nbsp;&nbsp;ChoiMoHinh.Vn
						</a></p>
						<p><a href="http://mca.vn/" target="_blank">
							<img src="http://banlinhkien.vn/themes/orange5/images/mca.png" align="top">&nbsp;&nbsp;&nbsp;MCA.Vn
						</a></p>
						<p><a href="http://hocdientu.vn" target="_blank">
							<img src="http://banlinhkien.vn/themes/orange/images/mcu.png" align="top">&nbsp;&nbsp;&nbsp;Diễn Đàn Vi Điều Khiển
						</a></p>
						<p><a href="http://ledminhha.vn" target="_blank">
							<img src="http://banlinhkien.vn/themes/orange/images/led.png" align="top">&nbsp;&nbsp;&nbsp;Led MinhHa
						</a></p>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!-- jQuery -->
	<script src="<?php echo get_web_url() ?>/views/assets/js/jquery.min.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="<?php echo get_web_url() ?>/views/assets/bootstrap/4.0/dist/js/bootstrap.min.js"></script>

	<script src="<?php echo get_web_url() ?>/views/plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
	<script src="<?php echo get_web_url() ?>/views/assets/owlcarousel/owl.carousel.min.js"></script>
	<script src="<?php echo get_web_url() ?>/views/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>
	<?php if(strpos($action , 'post')): ?>
	<script src="<?php echo get_web_url() ?>/views/assets/js/frontend/post.js"></script>
	<?php endif; ?>
	<?php if($action == 'print-order'): ?>
		<script src="<?php echo get_web_url() ?>/views/plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
		<script src="<?php echo get_web_url() ?>/views/assets/js/admin/js-for-order.js"></script>
	<?php endif; ?>
	<script>
		jQuery(document).ready(function($){
			if($('.dropify').length > 0)
				$('.dropify').dropify({
					messages: {
						default: 'Kéo thả tệp hoặc click vào đây',
						replace: 'Kéo thả tệp mới hoặc click để thay đổi tệp tin',
						remove: 'Gỡ bỏ',
						error: 'Tệp tin quá lớn!'
					}
				});
			
			if($('.datepicker').length > 0){
				$('.datepicker').datepicker();
			}

			var nav = $('.menu');
			var baner = $('.logo_and_contact');
			$(window).scroll(function() {
				var windowpos =$(window).scrollTop();
				if(windowpos >= baner.outerHeight()){
					nav.addClass('fixedMenu');
					baner.addClass('margin-when-fixed');
				}
				else{
					nav.removeClass('fixedMenu');
					baner.removeClass('margin-when-fixed');
				}
			});

			$('.owl-carousel').owlCarousel({
				nav: true,
				items: 1,
				loop: true,
				navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']
			})
		});
	</script>

	<?php if($action == 'register'): ?>
		<script>
			jQuery(document).ready(function($){

				$('input[name="username"]').blur(function(){
					var username = $(this).val();
					if(username.length > 0){
						$.ajax({
							url : '<?php echo get_web_url() ?>/libs/ajax_functions.php',
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
							url : '<?php echo get_web_url() ?>/libs/ajax_functions.php',
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
			});
		</script>

		<script src="<?php echo get_web_url() ?>/views/assets/js/cropper.min.js"></script>
		<script>
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
					cropper.replace(reader.result);
				};

				reader.readAsDataURL(file);
			});
		</script>
	<?php endif; ?>
</body>
</html>