<?php

file_exists('controllers/cMenu.php') ? require_once('controllers/cMenu.php') : require_once('../controllers/cMenu.php');

$cMenu = new cMenu();

logout_user_after_timeout_session();
increase_timeout_session();
if(is_user_logged_in())
	$user = get_current_user_info();

if(is_user_facebook_logged_in()){
	file_exists('controllers/cUser.php') ? require_once('controllers/cUser.php') : require_once('../controllers/cUser.php');
	$cUser = new cUser();
	$cUser->loginWithFacebook();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $page_title ?> | <?php echo get_web_title() ?></title>
	<link rel="icon" href="<?php echo get_image_url(get_web_option('web-fav-image'), 'theme') ?>">
	<?php if($action == 'index_frontend'): ?>
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/assets/css/frontend/index.css">
	<?php endif; ?>

	<?php if($action == 'print-order'): ?>
	<link href="<?php echo get_web_url() ?>/views/plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/assets/css/frontend/print-order.css">
	<?php endif; ?>

	<?php if($action == 'list-post'): ?>
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/assets/css/frontend/list-post.css">
	<?php endif; ?>
	<?php if($action == 'show-post'): ?>
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/assets/css/frontend/show.css">
	<?php endif; ?>
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/assets/bootstrap/4.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/assets/css/frontend/header.css">
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/assets/css/frontend/footer.css">
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/assets/css/frontend/responsive.css">
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/assets/css/bootstrap.theme.css">
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/assets/owlcarousel/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo get_web_url() ?>/views/plugins/bower_components/dropify/dist/css/dropify.min.css">
	<link href="<?php echo get_web_url() ?>/views/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<script src="https://use.fontawesome.com/4748084f1a.js"></script>
	<script>
		var web_url = '<?php echo get_web_url().'/'; ?>';
	</script>
</head>
<body>
	<header>
		<div class="logo_and_contact">
			<div class="container">
				<div class="row">
					<div class="logo col-lg-2 col-md-5">
						<div class="text-center">
							<img src="<?php echo get_image_url(get_web_option('web-header-image'), 'theme') ?>" alt="">
						</div>
					</div>
					<div class="col-lg-10 banel col-md-7">
						<div class="row">
							<div class="bazon col-lg-8 col-md-12">
								<h4><?php echo !empty(get_web_option('web-header-title')) ? get_web_option('web-header-title') : get_web_title() ?></h4>
								<span class="text-center"><?php echo !empty(get_web_option('web-header-description')) ? get_web_option('web-header-description') : get_web_description() ?></span>
							</div>
							<div class="contact d-none d-lg-block col-lg-4">
								<p>Điện thoại: <?php echo !empty(get_web_option('web-header-phone')) ? get_web_option('web-header-phone') : get_web_option('web-phone') ?></p>
								<p>Email: <?php echo !empty(get_web_option('web-header-email')) ? get_web_option('web-header-email') : get_web_option('web-email') ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--logo_and_contact-->

		<div class="menu">
			<input id="check-menu" type="checkbox" style="display: none;">
			<nav class="navbar navbar-expand-md navbar-dark nav-menu">
				<div class="container">
					<a data-toggle="collapse" href="#mobile-search-toggle" class="btn btn-search-mobile d-md-none">
						<i class="fa fa-search"></i>
					</a>
					<label for="check-menu" class="navbar-toggler btn-menu">
						<span class="navbar-toggler-icon" id="first"></span>
						<span class="navbar-toggler-icon"></span>
						<span class="navbar-toggler-icon" id="second"></span>
					</label>

					<div class="navbar navbar-collapse" id="navbarNav">
						<?php if(is_user_logged_in()): ?>
						<div class="user-profile-content d-block d-md-none">
							<div class="user-profile-avatar text-center">
								<img src="<?php echo get_user_avatar_link($user->ID) ?>" alt="user-avatar" class="round" style="width: 100px; height: auto;">
							</div>
							<h3 class="text-center"><?php echo $user->display_name ?></h3>
							<div class="user-profile-action row text-center">
								<a href="<?php echo get_current_user_profile_link($user->ID) ?>" class="text-info col-6">Trang cá nhân</a>
								<a href="<?php echo get_logout_url(current_url()) ?>" class="col-6">Đăng xuất</a>
							</div>
						</div>
						<?php else: ?>
						<?php endif; ?>
						<?php $cMenu->showMenuInFrontEnd() ?>
						<form class="form-inline d-none d-md-block">
							<input class="form-control search" type="text" placeholder="Search" aria-label="Search">
							<button class="btn btn-outline-secondary my-2 my-sm-0 well-search" type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
				</div>
			</nav>
			<div class="collapse col-12" id="mobile-search-toggle">
			<form class="form-inline" style="padding-bottom: 5px">
					<input type="search" class="form-control" style="margin-right: 8px">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
				</form>
			</div>
		</div>
	</header>

	<?php if($action != 'index_frontend'): ?>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div id="breadcrumb-content" class="col-content">
					<nav class="bread-crumb">
						<a class="breadcrumb-item bread-item" href="#">Trang chủ</a>
						<?php if($action == 'list-post'): ?>
							<span class="breadcrumb-item active"><?php echo $post_type_title ?></span>
						<?php endif; ?>
						<?php if($action == 'show-post'): ?>
						<a class="breadcrumb-item bread-item" href="<?php echo get_web_url() ?>/post/<?php echo $post_type_slug ?>"><?php echo $post_type_title ?></a>
						<span class="breadcrumb-item active"><?php echo $page_title ?></span>
						<?php endif; ?>
					</nav><!--end breadcrumb-->
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>