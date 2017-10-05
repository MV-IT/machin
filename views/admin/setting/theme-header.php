<?php require_once('views/admin/header.php'); ?>
<?php require_once('views/admin/sidebar.php') ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "views/admin/breadcrumb.php"; ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="white-box">
							<form method="post" enctype="multipart/form-data">
								<input type="hidden" name="key_update" value="<?php echo $rand_key ?>">
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="form-control-label" for="fav-image">Favicon</label>
										<input type="file" id="fav-image" name="web-fav-image" class="dropify" data-default-file="<?php echo !empty(get_web_option('web-fav-image')) ? get_image_url(get_web_option('web-fav-image'), 'theme') : '' ?>" accept=".png,.jpg">
										<small><img src="" alt=""></small>
									</div>
									<div class="col-sm-6">
										<label class="form-control-label" for="header-image">Logo đầu trang</label>
										<input type="file" id="header-image" name="web-header-image" class="dropify" data-default-file="<?php echo !empty(get_web_option('web-header-image')) ? get_image_url(get_web_option('web-header-image'), 'theme') : '' ?>" accept=".png,.jpg">
									</div>
								</div>
								<div class="form-group row">
									<label for="header-title" class="col-sm-2">Tiêu đề:</label>
									<div class="col-sm-10"><input type="text" id="header-title" name="header-title" value="<?php echo get_web_option('web-header-title') ?>" class="form-control" placeholder="Mặc định trong cài đặt"></div>
								</div>
								<div class="form-group row">
									<label for="header-description" class="col-sm-2">Giới thiệu(Slogan):</label>
									<div class="col-sm-10"><input type="text" id="header-description" name="header-description" class="form-control" value="<?php echo get_web_option('web-header-description') ?>" placeholder="Mặc định trong cài đặt"></div>
								</div>
								<div class="form-group row">
									<label for="header-phone" class="col-sm-2">Điện thoại:</label>
									<div class="col-sm-10"><input type="text" id="header-phone" name="header-phone" class="form-control" value="<?php echo get_web_option('web-header-phone') ?>" placeholder="Mặc định trong cài đặt"></div>
								</div>
								<div class="form-group row">
									<label for="header-email" class="col-sm-2">Email:</label>
									<div class="col-sm-10"><input type="text" id="header-email" name="header-email" class="form-control" value="<?php echo get_web_option('web-header-email') ?>" placeholder="Mặc định trong cài đặt"></div>
								</div>
								<div class="form-group row">
									<button class="btn btn-info" type="submit" name="save-header-option">Cập nhật</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
<?php require_once('views/admin/footer.php'); ?>