<?php

$action = basename(__FILE__, '.php');
require_once('views/header.php');

?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<?php if(!is_user_logged_in()){ ?>
				<h1 class="text-center">Đăng nhập</h1>
				<?php if(!empty($error)){ ?>
				<p class="text-center text-bold text-danger"><?php echo $error ?></p>
				<?php } ?>
				<form method="post" action="<?php echo current_url() ?>">
					<fieldset class="form-group">
						<label for="username">Tên đăng nhập</label>
						<input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập">
					</fieldset>
					<fieldset class="form-group">
						<label for="password">Mật khẩu</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
					</fieldset>
					<fieldset class="form-group">
						<input type="submit" name="user-login" value="Đăng nhập" class="btn btn-info">
					</fieldset>
					<fieldset class="form-group">
						Chưa có tài khoản? <a href="<?php echo get_register_url($header) ?>">Đăng ký</a>
					</fieldset>
				</form>
			<?php }else{ ?>
				<p class="text-bold text-center text-danger">Bạn đã đăng nhập rồi!</p>
				<p class="text-center ">
					<?php if(is_admin()){ ?><a href="<?php echo get_admin_url() ?>" class="btn btn-primary">Trang quản trị</a><?php } ?>
					<a href="<?php echo get_web_url() ?>" class="btn btn-info">Về trang chủ</a>
					<a href="<?php echo get_logout_url($header) ?>" class="btn btn-danger">Đăng xuất</a>
				</p>
			<?php } ?>
			</div>
		</div>
	</div>
<?php require_once('views/footer.php'); ?>