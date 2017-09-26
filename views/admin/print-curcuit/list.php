<?php require_once('views/admin/header.php'); ?>
<?php require_once('views/admin/sidebar.php') ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "views/admin/breadcrumb.php"; ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="white-box">
							<div class="row mb-3">
								<div class="col-sm-6 col-md-8">
									<h3 class="box-title">Danh sách mạch in</h3>
								</div>
								<div class="col-sm-6 col-md-4">
									<form method="get" class="form-inline">
										<div class="form-group" style="width: calc(100% - 5rem - 84px)">
											<input type="search" class="form-control" name="s" placeholder="Tìm kiếm..." value="<?php echo !empty($_GET['s']) ? $_GET['s'] : '';  ?>">
										</div>
										<button type="submit" class="btn btn-info ml-2">Tìm kiếm</button>
									</form>
								</div>
							</div>
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>ID</th>
										<th>Tên</th>
										<th>Loại</th>
										<th>Hành động</th>
									</tr>
								</thead>
								<tbody>
								<?php if(!empty($list_print_curcuit)){
									foreach ($list_print_curcuit as $key => $print_curcuit) {
								?>
									<tr>
										<td><?php echo $print_curcuit['ID'] ?></td>
										<td><a href="<?php echo get_print_curcuit_permalink($print_curcuit['ID']) ?>"><?php echo $print_curcuit['name'] ?></a></td>
										<td><?php echo $print_curcuit['type'] ?></td>
										<td>
											<a href="<?php echo get_admin_url() ?>/print-curcuit/edit/<?php echo $print_curcuit['ID'] ?>" class="btn btn-info">
												<i class="fa fa-pencil"></i>
											</a>
											<button type="button" data-id="<?php echo $print_curcuit['ID'] ?>" data-toggle="modal" data-target="#ask-delete-modal" class="btn btn-danger delete-printcurcuit">
												<i class="fa fa-trash"></i>
											</button>
										</td>
									</tr>
								<?php }}else{ ?>
									<tr>
										<td colspan="3">Không có mạch in nào!</td>
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

			<div class="modal fade" id="ask-delete-modal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Đóng</span>
							</button>
							<h4 class="modal-title">Xóa mạch in ?</h4>
						</div>
						<div class="modal-body">
							<p>Bạn muốn xóa mạch in này ?</p>
						</div>
						<div class="modal-footer">
							<form method="post">
								<button type="button" class="btn btn-info" data-dismiss="modal">Đóng</button>
								<button type="submit" name="delete-print_curcuit" value="" class="btn btn-default">Xóa</button>
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<script>
				jQuery(document).ready(function($) {
					$('.delete-printcurcuit').click(function() {
						var id = $(this).data('id');

						$('[name="delete-print_curcuit"]').val(id);
					});
				});
			</script>

<?php require_once('views/admin/footer.php'); ?>