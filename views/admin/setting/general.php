<?php require 'views/admin/header.php'; ?>
<?php require 'views/admin/sidebar.php'; ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "views/admin/breadcrumb.php"; ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="white-box">
							<h3 class="box-title">Thông tin cơ bản của website</h3>
							<form class="form" method="post" enctype="multipart/form-data">
								<div class="form-group row">
									<label for="domain" class="col-2 col-form-label">Tên miền<br/><small>(Địa chỉ trang chủ)</small></label>
									<div class="col-10">
										<input class="form-control" type="url" name="web-domain" value="<?php echo get_web_url() ?>" id="domain">
									</div>
								</div>
								<div class="form-group row">
									<label for="title" class="col-2 col-form-label">Tiều đề trang</label>
									<div class="col-10">
										<input class="form-control" type="text" name="web-title" value="<?php echo get_web_title() ?>" id="title">
									</div>
								</div>
								<div class="form-group row">
									<label for="description" class="col-2 col-form-label">Mô tả trang<br/><small>(Giới thiệu ngắn | slogan)</small></label>
									<div class="col-10">
										<input class="form-control" type="text" value="<?php echo get_web_description() ?>" name="web-description" id="description">
									</div>
								</div>
								<h3 class="box-title">Thông tin liên hệ</h3>
								<div class="form-group row">
									<label for="gmap" class="col-2 col-form-label">Bản đồ</label>
									<div class="col-10">
										<input class="form-control" type="url" value="<?php echo get_web_option('gmap') ?>" name="web-gmap" id="gmap">
									</div>
								</div>
								<div class="form-group row">
									<label for="address" class="col-2 col-form-label">Địa chỉ</label>
										<div class="col-10">
											<div class="row">
												<div class="col-4">
													<input class="form-control" type="text" value="<?php echo $address['street'] ?>" name="address_1" id="address">
												</div>
												<div class="col-4">
													<select id="city" name="address_2" class="form-control">
														<?php get_list_option_city($address['city']) ?>
													</select>
												</div>
												<div class="col-4">
													<select id="country" name="address_3" class="form-control"><?php get_list_option_country($address['country']) ?></select>
												</div>
											</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="phone" class="col-2 col-form-label">Điện thoại</label>
									<div class="col-10">
										<input class="form-control" type="tel" value="<?php echo get_web_option('web-phone') ?>" name="web-phone" id="phone">
									</div>
								</div>
								<div class="form-group row">
									<label for="email" class="col-2 col-form-label">Email</label>
									<div class="col-10">
										<input class="form-control" type="email" value="<?php echo get_web_option('web-email') ?>" name="web-email" id="email">
									</div>
								</div>
								<h3 class="box-title">Mạng xã hội</h3>
								<div class="form-group row">
									<label for="youtube_social" class="col-2 col-form-label">Youtube</label>
									<div class="col-10">
										<input class="form-control" type="url" value="<?php echo get_web_option('web-youtube_social') ?>" name="web-youtube_social" id="youtube_social">
									</div>
								</div>
								<div class="form-group row">
									<label for="facebook_social" class="col-2 col-form-label">Facebook</label>
									<div class="col-10">
										<input class="form-control" type="url" value="<?php echo get_web_option('web-facebook_social') ?>" name="web-facebook_social" id="facebook_social">
									</div>
								</div>
								<div class="form-group row">
									<label for="twitter_social" class="col-2 col-form-label">Twitter</label>
									<div class="col-10">
										<input class="form-control" type="url" value="<?php echo get_web_option('web-twitter_social') ?>" name="web-twitter_social" id="twitter_social">
									</div>
								</div>
								<div class="form-group row">
									<button type="submit" name="update_setting" class="btn btn-info">Cập nhật</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
<?php require 'views/admin/footer.php'; ?>