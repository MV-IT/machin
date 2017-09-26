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
									<h3 class="box-title">Danh sách <?php echo strtolower($post_type_title) ?></h3>
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
										<th>Tiêu đề</th>
										<th>Người đăng</th>
										<th>Ngày đăng</th>
										<th>Hành động</th>
									</tr>
								</thead>
								<tbody>
								<?php if(!empty($list_post)){
									foreach ($list_post as $key => $post) {
										$author = get_user_by_ID($post['post_author']);
								?>
									<tr>
										<td><?php echo $post['ID'] ?></td>
										<td><a href="<?php echo get_post_permalink($post['ID']) ?>"><?php echo $post['post_title'] ?></a></td>
										<td><?php echo $author->display_name ?></td>
										<td><?php echo $post['post_date'] ?></td>
										<td>
											<a href="<?php echo get_admin_url() ?>/post/<?php echo $post['post_type'] ?>/edit/<?php echo $post['ID'] ?>" class="btn btn-info">
												<i class="fa fa-pencil"></i>
											</a>
											<button type="submit" data-id="<?php echo $post['ID'] ?>" class="btn btn-danger delete-post" data-toggle="modal" data-target="#ask-delete-modal">
												<i class="fa fa-trash"></i>
											</button>
										</td>
									</tr>
								<?php }}else{ ?>
									<tr>
										<td colspan="5">Không có <?php echo strtolower($post_type_title) ?> nào!</td>
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
							<h4 class="modal-title">Xóa <?php echo strtolower($post_type_title) ?> ?</h4>
						</div>
						<div class="modal-body">
							<p>Bạn muốn xóa <?php echo strtolower($post_type_title) ?> này ?</p>
						</div>
						<div class="modal-footer">
							<form method="post">
								<button type="button" class="btn btn-info" data-dismiss="modal">Đóng</button>
								<button type="submit" name="delete-post" value="" class="btn btn-default">Xóa</button>
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<script>
				jQuery(document).ready(function($) {
					$('.delete-post').click(function() {
						var id = $(this).data('id');

						$('[name="delete-post"]').val(id);
					});
				});
			</script>

<?php require_once('views/admin/footer.php'); ?>