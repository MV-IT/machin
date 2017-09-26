<?php require_once('views/admin/header.php'); ?>
<?php require_once('views/admin/sidebar.php') ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "views/admin/breadcrumb.php"; ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="white-box">
							<div class="row mb-3">
								<div class="col-sm-6 col-md-7 col-lg-8">
									<h3 class="box-title">Danh sách tài khoản</h3>
								</div>
								<div class="col-sm-6 col-md-5 col-lg-4">
									<form method="get" class="form-inline">
										<div class="form-group" style="width: calc(100% - 5rem - 84px)">
											<input type="search" class="form-control" name="s" placeholder="Tìm kiếm..." value="<?php echo !empty($_GET['s']) ? $_GET['s'] : '';  ?>">
										</div>
										<button type="submit" class="btn btn-info ml-2">Tìm kiếm</button>
									</form>
								</div>
							</div>
							<div class="table table-responsive table-striped table-bordered">
								<table id="list_user" class="display nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>ID</th>
											<th>Tài khoản</th>
											<th>Họ và tên</th>
											<th>Ngày sinh</th>
											<th>Giới tính</th>
											<th>Email</th>
											<th>Quyền</th>
											<th>Hành động</th>
										</tr>
									</thead>
									<tbody>
									<?php 
										foreach ($list_user as $user){
									 ?>
										<tr>
											<td><?php echo $user['ID'] ?></td>
											<td><?php echo $user['username'] ?></td>
											<td><?php echo $user['display_name'] ?></td>
											<td><?php echo $user['birth_date'] ?></td>
											<td><?php echo $user['sex'] ?></td>
											<td><?php echo $user['email'] ?></td>
											<td><?php echo $user['role'] ?></td>
											<td>
												<a class="btn btn-info edit_user_info" href="<?php echo get_admin_url() ?>/user/edit/<?php echo $user['ID'] ?>" data-toggle="tooltip" data-placement="left" title="Sửa"><span class="ti-pencil-alt"></span></a>
												
												<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Xóa" class="delete-user" data-target="ajax_delete_user" data-id="<?php echo $user['ID'] ?>">
													<button class="btn btn-danger" data-toggle="modal" data-target="#ask-delete-modal"><i class="fa fa-trash-o"></i></button>
												</a>
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
								<div class="text-center">
								<?php echo $pagi->showPagination(); ?>
							</div>
							</div>
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
<?php require_once('views/admin/footer.php') ?>