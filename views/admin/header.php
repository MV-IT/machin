<?php 

logout_user_after_timeout_session();
increase_timeout_session();
if(!is_user_logged_in())
	header('location: '.get_login_url(current_url()));
else
	$user = get_current_user_info();

$list_post_type = get_web_option('post_type');

?>
<!DOCTYPE html>
<html lang="vn">
<head>
	<base href="<?php echo get_web_url() ?>/views">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_web_url() ?>/../views/plugins/images/favicon.png">
	<title><?php 
		if(!is_admin() && !is_editor()){
				echo 'Bạn không có quyền truy cập vào trang này!';
		}else if(is_editor() && strpos($action, 'user') !== false)
			echo 'Bạn không có quyền truy cập vào trang này!';
		else 
			echo $page_title ?> | Trang quản lý <?php echo get_web_title() ?> - <?php echo get_web_description() ?></title>
	<!-- Bootstrap Core CSS -->
	<link href="<?php echo get_web_url() ?>/views/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo get_web_url() ?>/views/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
	<!-- Menu CSS -->
	<link href="<?php echo get_web_url() ?>/views/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
	<!-- toast CSS -->
	<link href="<?php echo get_web_url() ?>/views/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/plugins/bower_components/dropify/dist/css/dropify.min.css">
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/plugins/bower_components/summernote/dist/summernote.css">
	<link href="<?php echo get_web_url() ?>/views/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <?php if($action == 'theme-edit-menu'){ ?>
	<link href="<?php echo get_web_url() ?>/views/plugins/bower_components/nestable/nestable.css" rel="stylesheet" type="text/css" />

	<script>
		var edit_menu_item = function(e){
			var id = $(e).data('id');
			var title = $('#input_menu_item_title_' + id).val();
			var link = $('#input_menu_item_link_' + id).val();
			$.ajax({
				url: web_url + 'libs/ajax_functions.php',
				type: 'POST',
				data: {
					'action': 'ajax_edit_menu_item',
					'id': id,
					'title': title,
					'link': link
				},
				success: function(data){
					if(data == 1){
						$.toast({
							heading: '<b>Cập nhật thành công!</b>',
							position: 'top-right',
							loaderBg:'#ff6849',
							icon: 'success',
							hideAfter: 2000, 
							stack: 6
						});
						$('.menu_item_title_' + id).text(title);
					}

				}
			});
		};

		var delete_menu_item = function(e){
			var id = $(e).data('id');
			$.ajax({
				url: 'libs/ajax_functions.php',
				type: 'POST',
				data: {
					'action': 'ajax_delete_menu_item',
					'id': id
				},
				success: function(data){
					if(data == 1){
						if($('#item_in_menu_' + id).find('.dd-list').length > 0){
							$('#menu_list_item').append($('#item_in_menu_' + id).find('.dd-list').html());
						}
						$('#item_in_menu_' + id).remove();
						$.toast({
							heading: '<b>Xóa thành công!</b>',
							position: 'top-right',
							loaderBg:'#ff6849',
							icon: 'success',
							hideAfter: 2000, 
							stack: 6
						});
					}
				}
			});
		};
	</script>
    <?php } ?>

    <?php if($action == 'printcurcuit-properties'): ?>
	<link href="<?php echo get_web_url() ?>/views/plugins/bower_components/nestable/nestable.css" rel="stylesheet" type="text/css" />
    <?php endif; ?>

    <?php if(strpos($action, 'print-curcuit') !== false): ?>
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/assets/css/cropper.min.css">
	<?php endif; ?>
    <?php if($action == 'add-new-order' || $action == 'edit-order'): ?>
	<link href="<?php echo get_web_url() ?>/views/plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
    <?php endif; ?>

    <?php if($action == 'add-new-user' || $action == 'edit-user'): ?>
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/assets/css/cropper.min.css">
    <?php endif; ?>
	
	<!-- animation CSS -->
	<link href="<?php echo get_web_url() ?>/views/assets/css/animate.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?php echo get_web_url() ?>/views/assets/css/style.css" rel="stylesheet">
	<!-- color CSS -->
	<link href="<?php echo get_web_url() ?>/views/assets/css/colors/blue.css" id="theme" rel="stylesheet">
	<link href="<?php echo get_web_url() ?>/views/assets/css/admin/nk-style.css" rel="stylesheet">
	<script src="<?php echo get_web_url() ?>/views/plugins/bower_components/jquery/dist/jquery.min.js"></script>
	<script>
		var web_url = '<?php echo get_web_url() ?>/';
	</script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<?php

if(!is_admin() && !is_editor()){ ?>
<body>
	<section id="wrapper" class="loggedin">
        <div class="loggedin-box">
            Bạn không có quyền truy cập vào trang này!<br>
        <a href="<?php echo get_web_url() ?>"><button type="button" class="btn btn-info m-t-15"><i class="fa fa-home"></i> Về trang chủ</button></a>
        <a href="<?php echo get_web_url() ?>/dang-xuat"><button type="button" class="btn btn-danger m-t-15 m-l-15"><i class="fa fa-sign-out"></i> Đăng xuất</button></a>
        </div>
    </section>
</body>
</html>
<?php 
	die();
}
?>
<body class="fix-sidebar fix-header">
	<!-- Preloader -->
	<div class="preloader">
		<div class="cssload-speeding-wheel"></div>
	</div>
	<div id="wrapper">
		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top m-b-0">
			<div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="<?php echo get_web_url() ?>/javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
				<div class="top-left-part"><a class="logo" href="<?php echo get_web_url() ?>"><b><!--This is dark logo icon--><img src="<?php echo get_web_url() ?>/views/plugins/images/eliteadmin-logo.png" alt="home" class="dark-logo" /></b><span class="hidden-xs"><!--This is dark logo text--><img src="<?php echo get_web_url() ?>/views/plugins/images/eliteadmin-text.png" alt="home" class="dark-logo" /></span></a></div>
				<ul class="nav navbar-top-links navbar-left hidden-xs">
					<li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
					<li class="p-3"></li>
					<li class="dropdown">
						<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-plus"></i> Thêm</a>
						<ul class="dropdown-menu animated flipInY">
							<?php

							if(is_array($list_post_type)){
								foreach ($list_post_type as $post_type) {
							?>
							<li> <a href="<?php echo get_web_url() ?>/admin/post/<?php echo $post_type[1] ?>/add-new"><?php echo $post_type[0] ?> mới</a> </li>
							<?php }} ?>
							<li> <a href="<?php echo get_web_url() ?>/admin/print-curcuit/add-new">Mạch in mới</a> </li>
							<li> <a href="<?php echo get_web_url() ?>/admin/order/add-new">Đơn hàng mới</a> </li>
							<li> <a href="<?php echo get_web_url() ?>/admin/user/add-new">Tài khoản mới</a> </li>
						</ul>
					</li>
					
				</ul>

				<ul class="nav navbar-top-links navbar-right hidden-xs">
					<li class="dropdown">
						<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="javascript:void(0)" aria-expanded="false"> <img src="<?php echo get_user_avatar_link($user->ID) ?>" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $user->display_name ?></b> </a>
						<ul class="dropdown-menu dropdown-user animated flipInY">
							<li><a href="<?php echo get_logout_url(current_url()) ?>"><i class="fa fa-power-off"></i> Đăng xuất</a></li>
						</ul>
						<!-- /.dropdown-user -->
					</li>
					<li class="p-3"></li>
				</ul>
			</div>
		</nav>