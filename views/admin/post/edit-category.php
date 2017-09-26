<?php require_once('views/admin/header.php'); ?>
<?php require_once('views/admin/sidebar.php'); ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "views/admin/breadcrumb.php"; ?>
				<div class="row">
					<div class="col-md-4">
						<div class="white-box">
							<h3 class="box-title">Thêm danh mục mới</h3>
							<form method="post">
								<fieldset class="form-group">
									<label for="cate-title">Tiêu đề</label>
									<input type="text" class="form-control" name="cate_title" id="cate-title" placeholder="Tiêu đề">
								</fieldset>
								<fieldset class="form-group">
									<label for="cate-slug">Slug</label>
									<input type="text" class="form-control" name="cate_slug" id="cate-slug" placeholder="Slug(có thể để rỗng)">
								</fieldset>
								<fieldset class="form-group">
									<input type="submit" class="btn btn-info pull-right" name="add-category" id="category-add" value="Thêm">
								</fieldset>
							</form>
							<?php if(!empty($add_error)){ ?>
							<b class="text-danger"><?php echo $add_error ?></b>
							<?php } ?>
							<?php if(!empty($edit_error)){ ?>
							<b class="text-danger"><?php echo $edit_error ?></b>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-8">
						<div class="white-box">
							<h3 class="box-title mb-3">Danh sách các danh mục</h3>
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
									<?php if(!empty($listCategories) && count($listCategories) > 0){
										foreach ($listCategories as $key => $category) {
									?>
									<tr>
										<td><?php echo $category['ID'] ?></td>
										<td><?php echo $category['title'] ?></td>
										<td><?php echo $category['slug'] ?></td>
										<td>
											<button class="btn btn-info edit-category" data-id="<?php echo $category['ID'] ?>" data-toggle="modal" data-target="#edit-category-modal">
												<i class="fa fa-pencil"></i>
											</button>
											<button class="btn btn-danger delete-category" data-id="<?php echo $category['ID'] ?>" data-toggle="modal" data-target="#delete-category-modal">
												<i class="fa fa-trash"></i>
											</button>
										</td>
									</tr>
									<?php }}else{ ?>
									<tr>
										<td colspan="4">Không có danh mục nào nào!</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="delete-category-modal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Đóng</span>
							</button>
							<h4 class="modal-title">Xóa danh mục</h4>
						</div>
						<div class="modal-body">
							<p>Xóa danh mục này?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
							<form method="post">
								<button type="submit" class="btn btn-default" name="category-delete" value="">Xóa</button>
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<div class="modal fade" id="edit-category-modal">
				<div class="modal-dialog" role="document">
					<form method="post">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Đóng</span>
								</button>
								<h4 class="modal-title">Sửa danh mục</h4>
							</div>
							<div class="modal-body">
								<fieldset class="form-group">
									<label for="edit-category-title">Tiêu đề</label>
									<input type="text" class="form-control" name="edit-category-title" id="edit-category-title" placeholder="Tiêu đề">
								</fieldset>
								<fieldset class="form-group">
									<label for="edit-category-slug">Slug</label>
									<input type="text" class="form-control" name="edit-category-slug" id="edit-category-slug" placeholder="Slug">
								</fieldset>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
								<button type="submit" class="btn btn-info" name="edit-category-submit" value="">Lưu</button>
							</div>
						</div><!-- /.modal-content -->
					</form>
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

<?php require_once('views/admin/footer.php'); ?>