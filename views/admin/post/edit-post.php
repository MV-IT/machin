<?php require_once('views/admin/header.php'); ?>
<?php require_once('views/admin/sidebar.php') ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "views/admin/breadcrumb.php"; ?>
				<div class="row">
					<div class="col-sm-12 col-md-8">
						<div class="white-box">
							<input type="text" class="form-control" name="post-title" value="<?php echo $post->post_title ?>" placeholder="Tiêu đề">
							<div class="mb-3"></div>
							<textarea class="summernote" name="post-content" cols="30" rows="10"><?php echo $post->post_content ?></textarea>
						</div>
					</div>
					<div class="col-md-4">
						<div class="white-box">
							<p>
								<b>Người đăng:</b> <?php echo $author->display_name; ?>
							</p>
							<p>
								<b>Ngày đăng:</b> <?php echo date("d/m/Y H:i:s",strtotime($post->date_edited)); ?>
							</p>
							<p>
								<b>Ngày cập nhật:</b> <?php echo date("d/m/Y H:i:s",strtotime($post->date_edited)); ?>
							</p>
							<hr>
							<button class="btn btn-default delete-post" type="submit" data-id="<?php echo $post->ID ?>" data-toggle="modal" data-target="#ask-delete-modal">Xóa</button>
							<button type="button" id="add-new-post" class="btn btn-info pull-right" data-post_type="<?php echo $post_type_slug ?>" data-id=<?php echo $post->ID ?>"">Cập nhật</button>
							<div class="clearfix"></div>
						</div>
						<div class="mt-3 white-box">
							<input type="file" id="image" class="dropify" data-default-file="<?php echo get_post_image($post->ID) ?>">
						</div>

						<div class="mt-3 white-box">
							<h3 class="box-title">Danh mục</h3>
							<div id="list-categories-in-post">
								<?php foreach ($listCategories as $key => $category){ ?>
								<div class="m-l-2 checkbox checkbox-info">
									<input type="checkbox" name="list-category[]" id="category-<?php echo $category['ID'] ?>" value="<?php echo $category['ID'] ?>" required="" <?php 
										foreach ($listPostCategories as $key => $cate) {
											if (in_array($category['ID'], $cate)) {
												echo 'checked';
												break;
											}
										}
										 ?>>
									<label for="category-<?php echo $category['ID'] ?>"><?php echo $category['title'] ?></label>
								</div>
								<?php } ?>
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