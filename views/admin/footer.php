			<!-- /.container-fluid -->
			<footer class="footer text-center"> 2017 &copy; <?php echo get_web_title() ?> | Author: Niku </footer>
		</div>
		<!-- /#page-wrapper -->
	</div>
	<!-- /#wrapper -->
	<!-- jQuery -->
	
	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo get_web_url() ?>/views/assets/bootstrap/dist/js/tether.min.js"></script>
	<script src="<?php echo get_web_url() ?>/views/assets/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo get_web_url() ?>/views/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
	<!-- Menu Plugin JavaScript -->
	<script src="<?php echo get_web_url() ?>/views/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
	<!--slimscroll JavaScript -->
	<script src="<?php echo get_web_url() ?>/views/assets/js/jquery.slimscroll.js"></script>
	<!--Wave Effects -->
	<script src="<?php echo get_web_url() ?>/views/assets/js/waves.js"></script>
	<!-- Custom Theme JavaScript -->
	<script src="<?php echo get_web_url() ?>/views/assets/js/custom.min.js"></script>
	<script src="<?php echo get_web_url() ?>/views/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
	<script src="<?php echo get_web_url() ?>/views/plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
	<script src="<?php echo get_web_url() ?>/views/plugins/bower_components/summernote/dist/summernote.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function($) {
			<?php if($action == 'admin-index'){ ?>
				$.toast({
					heading: 'Xin chào, <?php echo $user->display_name ?>',
					text: 'Chúc bạn vui vẻ!',
					position: 'top-right',
					loaderBg: '#ff6849',
					hideAfter: 3500,
					stack: 6
				});
				<?php } ?>

			$('.dropify').dropify({
				messages: {
					default: 'Kéo thả tệp hoặc click vào đây',
					replace: 'Kéo thả tệp mới hoặc click để thay đổi tệp tin',
					remove: 'Gỡ bỏ',
					error: 'Tệp tin quá lớn!'
				}
			});

			if($('.summernote').length > 0){
				$('.summernote').summernote({
					height: 350, // set editor height
					minHeight: null, // set minimum height of editor
					maxHeight: null, // set maximum height of editor
					focus: false, // set focus to editable area after initializing summernote
					placeholder: 'Nội dung'
				});
			}
		});
	</script>
	<?php if($action == 'theme-edit-menu'){ ?>
	<script src="<?php echo get_web_url() ?>/views/plugins/bower_components/nestable/jquery.nestable.js"></script>
	<script type="text/javascript" src="<?php echo get_web_url() ?>/views/assets/js/admin/menu.js"></script>
	<?php } ?>

	<?php if($action == 'post-type-setting'){ ?>
	<script src="<?php echo get_web_url() ?>/views/assets/js/admin/post-type.js"></script>
	<?php } ?>

	<?php if(strpos($action, 'add-new') !== false && !empty($post_type_slug)){ ?>
	<script src="<?php echo get_web_url() ?>/views/assets/js/admin/add-new-post.js"></script>
	<?php } ?>

	<?php if(strpos($action, 'edit-') !== false && !empty($post_type_slug)){ ?>
	<script src="<?php echo get_web_url() ?>/views/assets/js/admin/edit-post.js"></script>
	<?php } ?>

	<?php if($action == 'printcurcuit-properties'): ?>
	<script src="<?php echo get_web_url() ?>/views/plugins/bower_components/nestable/jquery.nestable.js"></script>
	<script type="text/javascript" src="<?php echo get_web_url() ?>/views/assets/js/admin/printcurcuit-properties.js"></script>
    <?php endif; ?>

    <?php if(strpos($action, 'print-curcuit')): ?>
    <script src="<?php echo get_web_url() ?>/views/assets/js/cropper.min.js"></script>
	<script src="<?php echo get_web_url() ?>/views/assets/js/admin/printcurcuit.js"></script>
	<?php endif; ?>

	<?php if($action == 'add-new-order' || $action == 'edit-order'): ?>
	<script src="<?php echo get_web_url() ?>/views/plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
	<script src="<?php echo get_web_url() ?>/views/assets/js/admin/js-for-order.js"></script>
	<?php endif; ?>

	<?php if($action == 'add-new-user' || $action == 'edit-user'): ?>
	<script src="<?php echo get_web_url() ?>/views/assets/js/cropper.min.js"></script>
	<script src="<?php echo get_web_url() ?>/views/assets/js/admin/js-for-user.js"></script>
	<?php endif; ?>

	<?php if($action == 'index-option'): ?>
	<script src="<?php echo get_web_url() ?>/views/assets/js/admin/index-option.js"></script>
	<?php endif; ?>

	<script src="<?php echo get_web_url() ?>/views/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>
	<script>
		if($('.datepicker').length > 0){
			$('.datepicker').datepicker();
		}
		$.ajax({
			url: web_url + 'libs/ajax_functions.php',
			type: 'POST',
			data: {
				'action': 'ajax_order_notification',
			},
			success: function(data){
				if(data > 0){
					$('#order_to_check').text(data);
					var noti = 'Có <b>' + data + '</b> đơn hàng cần xử lý.';
					var link_order = '<a href="'+web_url+'admin/order/list">Xem danh sách đơn hàng</a>'
					$.toast({
						heading: '<b>Có đơn hàng mới!</b>',
						text: [
						noti,
						link_order
						],
						position: 'top-right',
						loaderBg:'#ff6849',
						icon: 'info',
						hideAfter: 30000, 
						stack: 6
					});
				}
			}
		});

		setInterval(function(){
			$.ajax({
				url: web_url + 'libs/ajax_functions.php',
				type: 'POST',
				data: {
					'action': 'ajax_order_notification',
				},
				success: function(data){
					if(data > 0){
						$('#order_to_check').text(data);
						var noti = 'Có <b>' + data + '</b> đơn hàng cần xử lý.';
						var link_order = '<a href="'+web_url+'admin/order/list">Xem danh sách đơn hàng</a>'
						$.toast({
							heading: '<b>Có đơn hàng mới!</b>',
							text: [
							noti,
							link_order
							],
							position: 'top-right',
							loaderBg:'#ff6849',
							icon: 'info',
							hideAfter: 30000, 
							stack: 6
						});
					}
				}

			});
		}, 60000);
	</script>
</body>
</html>