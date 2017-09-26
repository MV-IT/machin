<?php require_once('views/admin/header.php'); ?>
<?php require_once('views/admin/sidebar.php') ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "views/admin/breadcrumb.php"; ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="white-box">
							<form method="post" enctype="multipart/form-data">
								<div class="form-body">
									<div class="col-md-12 col-lg-3" style="margin-bottom: 30px">
										<input type="file" name="ava" id="input-file-now-custom-1" class="form-control dropify dropify-vi" data-default-file="<?php echo $user_edit['avatar'] ?>"/>
										<input type="hidden" id="image_after_crop" name="image_cropped">
										<button type="button" class="btn btn-primary pull-right mt-sm-3 mb-sm-3" id="crop_image_button_modal" data-toggle="modal" data-target="#crop_image_modal" style="display: none;">Cắt lại</button>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-user"></i></div>
													<input type="text" class="form-control" name="dpname" placeholder="Tên hiển thị" required="" value="<?php echo $user_edit['display_name'] ?>"> 
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-user"></i></div>
													<input type="text" id="nk_user" class="form-control" placeholder="Tên đăng nhập" required="" disabled value="<?php echo $user_edit['username'] ?>"> 
												</div>  
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-lock"></i></div>
													<input type="password" class="form-control" placeholder="Mật khẩu" required disabled value="<?php echo rand_key() ?>"> 
												</div>  
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="ti-email"></i></div>
													<input type="email" id="nk_email" class="form-control" name="email" placeholder="Địa chỉ email" required="" value="<?php echo $user_edit['email'] ?>"> 
												</div>  
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-users"></i></div>
													<select name="role" style="width:100%;padding: 9px 12px">
														<option value="user" <?php if($user_edit['role'] == 'user') echo 'checked'; ?>>User</option>
														<option value="editor" <?php if($user_edit['role'] == 'editor') echo 'checked'; ?>>Editor</option>
														<option value="admin" <?php if($user_edit['role'] == 'admin') echo 'checked'; ?>>Admin</option>
													</select>
												</div>  
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<label class="control-label">Giới tính:</label><br>
													<div class="radio radio-inline radio-info">
														<input id="sex-nam" name="sex" type="radio" value="Nam" required="" <?php if($user_edit['sex'] == 'Nam') echo 'checked'; ?>>
														<label for="sex-nam">Nam</label>
													</div>
													<div class="radio radio-inline radio-info">
														<input id="sex-nu" name="sex" type="radio" value="Nữ" required="" <?php if($user_edit['sex'] == 'Nữ') echo 'checked'; ?>>
														<label for="sex-nu">Nữ</label>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<div class="input-group">
												<span class="input-group-addon"><i class="icon-calender"></i></span><input type="text" name="birthdate" class="form-control datepicker" placeholder="Ngày sinh" required="" value="<?php echo $user_edit['birth_date'] ?>">
												</div>  
											</div>
										</div>
									</div>

									<div class="form-group m-t-45">
										<div class="col-xs-12">
											<button class="btn btn-info" type="submit" name="edit-user">Cập nhật</button>
											<button type="button" class="btn btn-secondary delete-user" data-id="<?php echo $user_edit['ID'] ?>" data-target="#ask-delete-modal" data-toggle="modal">Xóa</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

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

			<div class="modal fade" id="ask-delete-modal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Đóng</span>
							</button>
							<h4 class="modal-title">Xóa tài khoản ?</h4>
						</div>
						<div class="modal-body">
							<p>Bạn muốn xóa tài khoản này ?</p>
						</div>
						<div class="modal-footer">
							<form method="post">
								<button type="button" class="btn btn-info" data-dismiss="modal">Đóng</button>
								<button type="submit" name="delete-user" value="" class="btn btn-default">Xóa</button>
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<script>
				jQuery(document).ready(function($) {
					$('.delete-user').click(function() {
						var id = $(this).data('id');

						$('[name="delete-user"]').val(id);
					});
				});
			</script>

<?php require_once('views/admin/footer.php'); ?>