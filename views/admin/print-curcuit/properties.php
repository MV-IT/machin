<?php require_once('views/admin/header.php') ?>
<?php require_once('views/admin/sidebar.php') ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "views/admin/breadcrumb.php"; ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="white-box">
							<div class="row">
								<div class="col-sm-6">
									<h3 class="box-title">Sắp xếp thứ tự</h3>
								</div>
								<div class="col-sm-6">
									<button class="btn btn-info pull-right" data-toggle="modal" data-target="#add-property-modal">Thêm</button>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="myadmin-dd-empty nestable dd">
								<ol class="dd-list">
								<?php if(!empty($list_properties)){ 
									foreach ($list_properties as $property) {
								?>
									<li class="dd-item dd3-item" data-id="<?php echo $property['ID'] ?>">
										<div class="dd-handle dd3-handle"></div>
										<div class="dd3-content"> <?php echo $property['name'] ?> 
											<span class="pull-right edit-property-text" data-toggle="modal" data-target="#edit-property-modal" data-id="<?php echo $property['ID'] ?>" style="display: inline-block;"> Chỉnh sửa</span>
											<span class="pull-right text-danger delete-property" data-toggle="modal" data-target="#delete-ask-modal" data-id="<?php echo $property['ID'] ?>" style="display: inline-block;margin-right: 10px">Xóa </span>
										</div>
									</li>
								<?php }} ?>
								</ol>
							</div>
							<hr>
							<button id="save-position" class="btn btn-info pull-right">Lưu sắp xếp</button>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="add-property-modal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form method="post">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Đóng</span>
								</button>
								<h4 class="modal-title">Thêm thuộc tính</h4>
							</div>
							<div class="modal-body">
								<input type="text" class="form-control mb-4" name="add-title" placeholder="Tên thuộc tính">
								<h4>Danh sách lựa chọn
									<button id="new-property-add-chose" class="btn btn-info pull-right" type="button">Thêm lựa chọn</button>
								</h4>
								<hr>
								<div id="list-chose-in-add" style="max-height: 250px; overflow-y: auto;">
									
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
								<button type="submit" name="add-property" value="1" class="btn btn-info">Thêm</button>
							</div>
						</form>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<div class="modal fade" id="edit-property-modal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form method="post">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Đóng</span>
								</button>
								<h4 class="modal-title">Chỉnh sửa thuộc tính</h4>
							</div>
							<div class="modal-body">
								<input type="text" class="form-control mb-4" name="edit-title" placeholder="Tên thuộc tính">
									<h4>Danh sách lựa chọn
										<button id="edit-property-add-chose" class="btn btn-info pull-right" type="button">Thêm lựa chọn</button>
									</h4>
									<hr>
									<div id="list-chose-in-edit" style="max-height: 250px; overflow-y: auto;">
										
									</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
								<button type="submit" name="edit-property" value="" class="btn btn-primary">Lưu</button>
							</div>
						</form>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<div class="modal fade" id="delete-ask-modal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Đóng</span>
							</button>
							<h4 class="modal-title">Xóa thuộc tính</h4>
						</div>
						<div class="modal-body">
							<p>Xóa thuộc tính này?</p>
						</div>
						<div class="modal-footer">
							<form method="post">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
								<button type="submit" name="delete-property" value="" class="btn btn-default">Xóa</button>
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
<?php require_once('views/admin/footer.php') ?>