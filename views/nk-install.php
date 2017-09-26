<?php
error_reporting(0);
$step = isset($noti['step']) ? $noti['step'] : 1;

if(!empty($_POST['step']))
	$step = $_POST['step'];

?>

<!DOCTYPE html>
<html lang="vn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cài đặt website</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="views/assets/bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="views/assets/css/bootstrap.theme.css">
	<link rel="stylesheet" href="views/assets/css/nk-install.css">
</head>
<body>

	<div class="body-wrap">
		<?php if($step == 1){ ?>
		<h1 class="text-center">Kết nối cơ sở dữ liệu</h1>
		<?php if(!empty($error)){ ?>
		<p class="text-center text-danger"><?php echo $error ?></p>
		<?php } ?>
		<form method="post" action="?controller=Install&action=step1">
			<fieldset class="form-group">
				<label for="db_name">Tên cơ sở dữ liệu</label>
				<input type="text" name="db_name" class="form-control" id="db_name" placeholder="Tên cơ sở dữ liệu" required>
			</fieldset>
			<fieldset class="form-group">
				<label for="db_user">Tên truy cập</label>
				<input type="text" name="db_user" class="form-control" id="db_user" placeholder="Tên truy cập" required>
			</fieldset>
			<fieldset class="form-group">
				<label for="db_pass">Mật khẩu</label>
				<input type="text" name="db_pass" class="form-control" id="db_pass" placeholder="Mật khẩu">
			</fieldset>
			<fieldset class="form-group">
				<label for="db_host">Máy chủ (Database host)</label>
				<input type="text" name="db_host" class="form-control" id="db_host" placeholder="Máy chủ (Database host)" required>
			</fieldset>
			<fieldset class="form-group">
				<input type="submit" name="db_submit" class="btn btn-info text-capitalize" value="Kết nối" required>
			</fieldset>
		</form>
		<?php } ?>
		<?php 
		if($step == 2): 
			if($noti['dbhastable'] != false){
		?>
			<form method="post" action="?controller=Install&action=step2">
				<p class="text-bold text-success">Kết nối cơ sở dữ liệu thành công!</p>
				<p>Nếu bạn sẵn sàng, bạn có thể chuyển sang bước...</p>

				<button class="btn btn-success" type="submit" name="step" value="3">Cài đặt Website</button>
			</form>
		<?php }else{ ?>
		<p class="text-bold text-danger">Cơ sở dữ liệu đã có dữ liệu!</p>
		<p>Hãy xóa dữ liệu cũ và cài đặt lại</p>
		<a href="<?php echo get_admin_url() ?>" class="btn btn-primary">Vào trang quản trị</a>
		<?php }endif; ?>
		<?php 
		if($step == 3){ 

			?>
			<h1 class="text-center">Cài đặt Website</h1>
			<form method="post" action="?controller=Install&action=step2">
				<fieldset class="form-group">
					<label for="web-title">Tiêu đề</label>
					<input type="text" name="web-title" class="form-control" id="web-title" placeholder="Tiêu đề">
				</fieldset>
				<fieldset class="form-group">
					<label for="web-description">Giới thiệu(Slogan)</label>
					<input type="text" name="web-description" class="form-control" id="web-description" placeholder="Giới thiệu(Slogan)">
				</fieldset>
				<fieldset class="form-group">
					<label for="web-email">Email</label>
					<input type="email" name="web-email" class="form-control" id="web-email" placeholder="Email">
				</fieldset>
				<h3>Quản trị viên</h3>
				<fieldset class="form-group">
					<label for="admin-name">Tên truy cập</label>
					<input type="text" name="admin-name" class="form-control" id="admin-name" placeholder="Tên truy cập">
				</fieldset>
				<fieldset class="form-group">
					<label for="admin-pass">Mật khẩu</label>
					<input type="password" name="admin-pass" class="form-control" id="admin-pass" placeholder="Mật khẩu">
				</fieldset>
				<fieldset class="form-group">
					<label for="admin-displayname">Tên hiển thị</label>
					<input type="text" name="admin-displayname" class="form-control" id="admin-displayname" placeholder="Tên hiển thị">
				</fieldset>
				<fieldset class="form-group">
					<input type="submit" name="web-install" class="btn btn-info" id="web-install" value="Cài đặt website">
				</fieldset>
			</form>
			<?php } ?>
		<?php if($step == 4){ ?>
			<p class="text-bold text-success">Cài đặt thành công!</p>
			<p>Quá trình cài đặt đã xong, bạn có thể vào</p>
			<a href="<?php echo get_admin_url() ?>" class="btn btn-primary">Trang quản trị</a>
		<?php } ?>
		</div>

		<!-- jQuery -->
		<script src="views/assets/bootstrap-3.3.7-dist/jquery.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="views/assets/bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	</body>
	</html>