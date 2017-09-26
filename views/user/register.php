<?php

$action = basename(__FILE__, '.php');
require_once('views/header.php');
?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<?php if(!is_user_logged_in()){ ?>
				<h1 class="text-center" style="margin-top: 45px;">Đăng ký</h1>
				<?php if(!empty($error)){ ?>
				<p class="text-center text-bold text-danger"><?php echo $error ?></p>
				<?php } ?>
				<form id="registerform" class="col-xs-12" method="post" enctype="multipart/form-data">
					<input type="hidden" name="key_register" value="<?php echo $rand_key; ?>">
					<div class="form-body">
						<?php if(isset($error_register)){ ?>
						<div class="form-group">
							<div class="col-md-12 alert alert-warning" role="alert">
								<?php echo $error_register ?>
							</div>
						</div>
						<?php } ?>
							
						<div class="row">
							<div class="col-md-3" style="margin-bottom: 30px">
								<input type="file" name="ava" id="input-file-now-custom-1" class="form-control dropify dropify-vi"/>
								<input type="hidden" id="image_after_crop" name="image_cropped">
								<button type="button" class="btn btn-primary pull-right mt-sm-3 mb-sm-3" id="crop_image_button_modal" data-toggle="modal" data-target="#crop_image_modal" style="display: none; margin-top: 10px">Cắt lại</button>
							</div>
							<div class="col-md-9">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-user"></i></div>
													<input type="text" class="form-control" name="dpname" placeholder="Tên hiển thị" required=""> 
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div id="alert-username_0" class="text-warning" style="display: none; margin-top: -25px; position: absolute;"><i class="fa  fa-info-circle"></i> Chưa điền tên đăng nhập!</div>
										<div id="alert-user_n_exists" class="text-success" style="display: none; margin-top: -25px; position: absolute;"><i class="fa fa-check-circle-o"></i> Tên đăng nhập khả dụng</div>
										<div id="alert-user_exists" class="text-danger" style="display: none; margin-top: -25px; position: absolute;"><i class="fa fa-warning"></i> Tên đăng nhập đã tồn tại!</div>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-user"></i></div>
													<input type="text" id="nk_user" class="form-control" name="username" placeholder="Tên đăng nhập" required=""> 
											</div>  
										</div>
									</div>

									<div class="col-md-6">
										<div id="alert-pass_6" class="text-warning" style="display: none; margin-top: -25px; position: absolute;"><i class="fa fa-info-circle"></i> Mật khẩu dài ít nhất 6 ký tự</div>
										<div id="alert-pass_special" class="text-danger" style="display: none; margin-top: -25px; position: absolute;"><i class="fa fa-warning"></i> Mật khẩu không được chứa ký tự đặc biệt</div>
										<div id="alert-pass_success" class="text-success" style="display: none; margin-top: -25px; position: absolute;"><i class="fa fa-check-circle-o"></i> Mật khẩu khả dụng</div>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-lock"></i></div>
													<input type="password" class="form-control" name="password" placeholder="Mật khẩu" required=""> 
											</div>  
										</div>
									</div>

									<div class="col-md-6">
									<div id="pass_wrong" class="text-danger" style="display: none; margin-top: -25px; position: absolute;"><i class="fa fa-warning"></i> Mật khẩu không khớp</div>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-lock"></i></div>
													<input type="password" class="form-control" name="r_password" placeholder="Nhập lại mật khẩu" required=""> 
											</div>  
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<div id="alert-email_n_exists" class="text-success" style="display: none; margin-top: -25px; position: absolute;"><i class="fa fa-check-circle-o"></i> Địa chỉ email khả dụng</div>
					                    	<div id="alert-email_exists" class="text-danger" style="display: none; margin-top: -25px; position: absolute;"><i class="fa fa-warning"></i> Địa chỉ email đã tồn tại!</div>
					                    	<div id="alert-n_email" class="text-warning" style="display: none; margin-top: -25px; position: absolute;"><i class="fa fa-info-circle"></i> Không phải địa chỉ email!</div>
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
													<input type="email" id="nk_email" class="form-control" name="email" placeholder="Địa chỉ email" required=""> 
											</div>  
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="birthdate" class="form-control datepicker" placeholder="Ngày sinh" required="">
											</div>  
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-12">
												<span class="control-label">Giới tính: </span>
													<label for="sex-nam"><input id="sex-nam" name="sex" type="radio" value="Nam" class="m-radio radio-info" required=""> Nam</label>
													<label for="sex-nu"><input id="sex-nu" name="sex" type="radio" value="Nữ" class="m-radio radio-info" required=""> Nữ</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="form-group col-sm-12 text-center m-t-20">
								<div>
									<button class="btn btn-info" type="submit" name="user-register">Đăng ký</button>
								</div>
							</div>
							<div class="form-group col-sm-12 m-b-0">
								<div class="text-center mb-md-5">
									<p>Đã có tài khoản? <a href="<?php echo get_login_url($header) ?>" class="text-info m-l-5"><b>Đăng nhập</b></a></p>
								</div>
							</div>
						</div>
					</div>
				</form>
			<?php }else{ ?>
				<p class="text-bold text-center text-danger">Đăng xuất để đăng ký!</p>
				<p class="text-center ">
					<a href="<?php echo get_web_url() ?>" class="btn btn-info">Về trang chủ</a>
					<a href="<?php echo get_logout_url($header) ?>" class="btn btn-danger">Đăng xuất</a>
				</p>
			<?php } ?>
			</div>
		</div>
	</div>

	<div class="modal fade" id="crop_image_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-info">Cắt ảnh</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">			
						<div class="col-sm-12">
							<img src="" id="image" alt="">
						</div>			
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-info crop_image" data-ans="1" data-dismiss="modal" aria-label="Close">Cắt</button>
					<button class="btn btn-danger delete_answer" data-ans="0" data-dismiss="modal" aria-label="Close">Đóng</button>
				</div>
			</div>
		</div>
	</div>
<?php require_once('views/footer.php') ?>