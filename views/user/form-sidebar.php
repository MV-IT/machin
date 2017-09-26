						<div class="col-md-12 col-content profile d-none d-md-block">
							<div class="header-title">
								<span><?php echo is_user_logged_in() ? 'Thông tin cá nhân' : 'Đăng nhập' ?></span>
							</div>
							<?php if(!is_user_logged_in()): ?>
							<div class="form">
								<form action="<?php echo get_login_url(current_url()) ?>" method="POST">
									<fieldset>
										<input type="text" name="username" class="form-control" placeholder="Tài khoản">
										<input type="password" name="password" class="form-control" placeholder="Mật khẩu">
										<p class="text-center"><input type="submit" name="user-login" id="submit" value="Đăng nhập" class="btn btn-outline-primary text-center"></p>
									</fieldset>
									<hr>
									<div class="text-center row" style="margin-bottom: 15px">
										<div class="col-12">
											<a href="<?php echo get_web_url() ?>/login-with-facebook/?header=<?php echo current_url() ?>" class="btn btn-fb"><i class="fa fa-facebook-official" aria-hidden="true"></i> Đăng nhập với Facebook</a>
										</div>
									</div>
									<p class="text-right">Chưa có tài khoản? <a href="<?php echo get_register_url(current_url()) ?>" class="text-info" style="display: inline;">Đăng ký</a></p>
								</form>
							</div>
						<?php endif; ?>
						<?php if(is_user_logged_in()): ?>
							<div class="loged">
								<div class="img-loged">
									<img class="round" src="<?php echo get_user_avatar_link($user->ID) ?>" alt="">
								</div>
								<div class="info-loged">
									<h4><?php echo $user->display_name ?></h4>
									<div class="row">
										<div class="col-md-6 profile-loged">
											<a href=""><i class="fa fa-user-circle-o"></i> Trang cá nhân</a>
										</div>
										<div class="col-md-6 out-loged">
											<a href="<?php echo get_logout_url(current_url()) ?>"><i class="fa fa-sign-out"></i>
												Đăng xuất</a>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
						</div><!--profile-->