<?php require_once('views/admin/header.php'); ?>
<?php require_once('views/admin/sidebar.php') ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "views/admin/breadcrumb.php"; ?>
				<div class="row">
					<div class="col-md-4">
						<div class="white-box">
							<h3 class="box-title">Thêm loại bài đăng mới</h3>
							<form method="post">
								<fieldset class="form-group">
									<label for="post-type-title">Tiêu đề</label>
									<input type="text" class="form-control" name="post-type-title" id="post-type-title" placeholder="Tiêu đề">
								</fieldset>
								<fieldset class="form-group">
									<label for="post-type-slug">Slug</label>
									<input type="text" class="form-control" name="post-type-slug" id="post-type-slug" placeholder="Slug">
								</fieldset>
								<fieldset class="form-group">
									<input type="submit" class="btn btn-info pull-right" name="post-type-add" id="post-type-add" value="Thêm">
								</fieldset>
							</form>
							<?php if(!empty($add_error)){ ?>
							<b class="text-danger"><?php echo $add_error ?></b>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-8">
						<div class="white-box">
							<h3 class="box-title mb-3">Danh sách các loại bài đăng</h3>
							<?php if(isset($delete_error)){ ?>
							<b class="text-danger"><?php echo $delete_error ?></b>
							<?php } ?>
							<table class="table">
								<thead>
									<tr>
										<th>ID</th>
										<th>Tiêu đề</th>
										<th>Slug</th>
										<th>Hành động</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($list_post_type) && count($list_post_type) > 0){
										foreach ($list_post_type as $key => $post_type) {
									?>
									<tr>
										<td><?php echo $key ?></td>
										<td><?php echo $post_type[0] ?></td>
										<td><?php echo $post_type[1] ?></td>
										<td>
											<button class="btn btn-info edit-post-type" data-id="<?php echo $key ?>" data-toggle="modal" data-target="#edit-post-type-modal">
												<i class="fa fa-pencil"></i>
											</button>
											<button class="btn btn-danger delete-post-type" data-id="<?php echo $key ?>" data-toggle="modal" data-target="#delete-post-type-modal">
												<i class="fa fa-trash"></i>
											</button>
										</td>
									</tr>
									<?php }}else{ ?>
									<tr>
										<td colspan="4">Không có loại bài đăng nào!</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="delete-post-type-modal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Đóng</span>
							</button>
							<h4 class="modal-title">Xóa loại bài đăng</h4>
						</div>
						<div class="modal-body">
							<p>Xóa loại bài đăng này?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
							<form method="post">
								<button type="submit" class="btn btn-default" name="post-type-delete" value="">Xóa</button>
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<div class="modal fade" id="edit-post-type-modal">
				<div class="modal-dialog" role="document">
					<form method="post">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Đóng</span>
								</button>
								<h4 class="modal-title">Sửa loại bài đăng</h4>
							</div>
							<div class="modal-body">
								<fieldset class="form-group">
									<label for="edit-post-type-title">Tiêu đề</label>
									<input type="text" class="form-control" name="edit-post-type-title" id="edit-post-type-title" placeholder="Tiêu đề">
								</fieldset>
								<fieldset class="form-group">
									<label for="edit-post-type-slug">Slug</label>
									<input type="text" class="form-control" name="edit-post-type-slug" id="edit-post-type-slug" placeholder="Slug">
								</fieldset>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
								<button type="submit" class="btn btn-info" name="edit-post-type-submit" value="">Lưu</button>
							</div>
						</div><!-- /.modal-content -->
					</form>
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
<?php require_once('views/admin/footer.php'); ?>