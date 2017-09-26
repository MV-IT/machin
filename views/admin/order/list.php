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
									<h3 class="box-title">Danh sách đơn hàng</h3>
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
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>ID</th>
										<th>Mã đơn hàng</th>
										<th>Tên khách khàng</th>
										<th>Mạch in</th>
										<th>Số lượng</th>
										<th>Thành tiền</th>
										<th>Hành động</th>
									</tr>
								</thead>
								<tbody>
								<?php if(!empty($list_order)){
									foreach ($list_order as $key => $order) {
										$print_curcuit = explode(';',$order['list_print_curcuit']);
										$row = count($print_curcuit);
								?>
									<tr>
										<td rowspan="<?php echo $row ?>"><?php echo $order['ID'] ?></td>
										<td rowspan="<?php echo $row ?>"><?php echo $order['code'] ?></td>
										<td rowspan="<?php echo $row ?>"><?php echo $order['customer_name'] ?></td>
										<?php if(!empty($print_curcuit[0])){
											$name = explode('|', $print_curcuit[0])[0];
											$num = explode('|', $print_curcuit[0])[1];
										?>
										<td><?php echo $name ?></td>
										<td><?php echo $num ?></td>	
										<?php } ?>
										<td rowspan="<?php echo $row ?>"><?php echo new Cost($order['total_cost']) ?></td>
										<td rowspan="<?php echo $row ?>">
											<a href="<?php echo get_admin_url() ?>/order/edit/<?php echo $order['ID'] ?>" class="btn btn-info">
												<i class="fa fa-pencil"></i>
											</a>
											<button type="button" data-id="<?php echo $order['ID'] ?>" data-toggle="modal" data-target="#ask-delete-modal" class="btn btn-danger delete-order">
												<i class="fa fa-trash"></i>
											</button>
										</td>
									</tr>
									<?php for($i = 1; $i < $row; $i++){ 
										if(!empty($print_curcuit[$i])){
											$name = explode('|', $print_curcuit[$i])[0];
											$num = explode('|', $print_curcuit[$i])[1];
									?>
									<tr>
										<td><?php echo $name ?></td>
										<td><?php echo $num ?></td>	
									</tr>
									<?php }} ?>
								<?php }}else{ ?>
									<tr>
										<td colspan="6">Không có đơn hàng nào!</td>
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
							<h4 class="modal-title">Xóa đơn hàng ?</h4>
						</div>
						<div class="modal-body">
							<p>Bạn muốn xóa đơn hàng này ?</p>
						</div>
						<div class="modal-footer">
							<form method="post">
								<button type="button" class="btn btn-info" data-dismiss="modal">Đóng</button>
								<button type="submit" name="delete-order" value="" class="btn btn-default">Xóa</button>
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<script>
				jQuery(document).ready(function($) {
					$('.delete-order').click(function() {
						var id = $(this).data('id');

						$('[name="delete-order"]').val(id);
					});
				});
			</script>

<?php require_once('views/admin/footer.php'); ?>