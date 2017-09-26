<?php require_once('views/admin/header.php'); ?>
<?php require_once('views/admin/sidebar.php') ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "views/admin/breadcrumb.php"; ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="white-box">
							<form method="post" enctype="multipart/form-data">
								<input type="hidden" name="key_register" value="<?php echo $rand_key; ?>">
								<div class="form-body">
									<div class="col-md-12 col-lg-3" style="margin-bottom: 30px">
										<input type="file" name="ava" id="input-file-now-custom-1" class="form-control dropify dropify-vi"/>
										<input type="hidden" id="image_after_crop" name="image_cropped">
										<button type="button" class="btn btn-primary pull-right mt-sm-3 mb-sm-3" id="crop_image_button_modal" data-toggle="modal" data-target="#crop_image_modal" style="display: none;">Cắt lại</button>
									</div>
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
											<div id="alert-username_0" class="text-warning" style="display: none; margin-top: -20px"><i class="fa  fa-info-circle"></i> Chưa điền tên đăng nhập!</div>
											<div id="alert-user_n_exists" class="text-success" style="display: none; margin-top: -20px"><i class="fa fa-check-circle-o"></i> Tên đăng nhập khả dụng</div>
											<div id="alert-user_exists" class="text-danger" style="display: none; margin-top: -20px"><i class="fa fa-warning"></i> Tên đăng nhập đã tồn tại!</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-user"></i></div>
													<input type="text" id="nk_user" class="form-control" name="username" placeholder="Tên đăng nhập" required=""> 
												</div>  
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div id="alert-pass_6" class="text-warning" style="display: none; margin-top: -20px"><i class="fa fa-info-circle"></i> Mật khẩu dài ít nhất 6 ký tự</div>
											<div id="alert-pass_special" class="text-danger" style="display: none; margin-top: -20px"><i class="fa fa-warning"></i> Mật khẩu không được chứa ký tự đặc biệt</div>
											<div id="alert-pass_success" class="text-success" style="display: none; margin-top: -20px"><i class="fa fa-check-circle-o"></i> Mật khẩu khả dụng</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-lock"></i></div>
													<input type="password" class="form-control" name="password" placeholder="Mật khẩu" required=""> 
												</div>  
											</div>
										</div>
										<div class="col-md-6">
											<div id="pass_wrong" class="text-danger" style="display: none; margin-top: -20px"><i class="fa fa-warning"></i> Mật khẩu không khớp</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-lock"></i></div>
													<input type="password" class="form-control" name="r_password" placeholder="Nhập lại mật khẩu" required=""> 
												</div>  
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div id="alert-email_n_exists" class="text-success" style="display: none; margin-top: -20px"><i class="fa fa-check-circle-o"></i> Địa chỉ email khả dụng</div>
											<div id="alert-email_exists" class="text-danger" style="display: none; margin-top: -20px"><i class="fa fa-warning"></i> Địa chỉ email đã tồn tại!</div>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="ti-email"></i></div>
													<input type="email" id="nk_email" class="form-control" name="email" placeholder="Địa chỉ email" required=""> 
												</div>  
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-users"></i></div>
													<select name="role" style="width:100%;padding: 9px 12px">
														<option value="user">User</option>
														<option value="editor">Editor</option>
														<option value="admin">Admin</option>
													</select>
												</div>  
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<label class="control-label">Giới tính:</label><br>
													<div class="radio radio-inline radio-info">
														<input id="sex-nam" name="sex" type="radio" value="Nam" required="">
														<label for="sex-nam">Nam</label>
													</div>
													<div class="radio radio-inline radio-info">
														<input id="sex-nu" name="sex" type="radio" value="Nữ" required="">
														<label for="sex-nu">Nữ</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<div class="input-group">
												<span class="input-group-addon"><i class="icon-calender"></i></span><input type="text" name="birthdate" class="form-control datepicker" placeholder="Ngày sinh" required="">
												</div>  
											</div>
										</div>
									</div>

									<div class="form-group m-t-20">
										<div class="col-xs-12">
											<button class="btn btn-info" type="submit" name="add-new-user">Thêm tài khoản mới</button>
										</div>
									</div>
								</div>
							</form>

							<div class="modal fade" id="crop_image_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title text-info">Cắt ảnh</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="row">

												<div style="width: 100%; max-height: 500px">
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
						</div>
					</div>
				</div>
			</div>

<?php require_once('views/admin/footer.php'); ?>