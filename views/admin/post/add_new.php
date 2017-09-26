<?php require_once('views/admin/header.php'); ?>
<?php require_once('views/admin/sidebar.php') ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "views/admin/breadcrumb.php"; ?>
				<div class="row">
					<div class="col-sm-12 col-md-8">
						<div class="white-box">
							<input type="text" class="form-control" name="post-title" placeholder="Tiêu đề">
							<div class="mb-3"></div>
							<textarea class="summernote" name="post-content" id="tinymce" cols="30" rows="10"></textarea>
						</div>
					</div>
					<div class="col-md-4">
						<div class="white-box">
							<p>
								<b>Người đăng:</b> <?php echo $user->display_name; ?>
							</p>
							<p>
								<b>Ngày đăng:</b> <?php echo current_time(); ?>
							</p>
							<p>
								<b>Ngày cập nhật:</b> <?php echo current_time(); ?>
							</p>
							<hr>
							<button id="add-new-post" class="btn btn-info pull-right" data-post_type="<?php echo $post_type_slug ?>">Đăng <?php echo strtolower($post_type_title) ?></button>
							<div class="clearfix"></div>
						</div>
						<div class="mt-3 white-box">
							<input type="file" id="image" class="dropify">
						</div>

						<div class="mt-3 white-box">
							<h3 class="box-title">Danh mục</h3>
							<div id="list-categories-in-post">
								<?php foreach ($listCategories as $key => $category){ ?>
								<div class="m-l-2 checkbox checkbox-info">
									<input type="checkbox" name="list-category[]" id="category-<?php echo $category['ID'] ?>" value="<?php echo $category['ID'] ?>" required="">
									<label for="category-<?php echo $category['ID'] ?>"><?php echo $category['title'] ?></label>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php require_once('views/admin/footer.php'); ?>