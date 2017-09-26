<?php require_once('views/admin/header.php'); ?>
<?php require_once('views/admin/sidebar.php') ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "breadcrumb.php"; ?>
				<div class="row">
					<div class="col-sm-4">
						<div class="white-box">
							<div class="box-custom-item-menu text-bold" data-toggle="collapse" data-target="#custom_link_menu">Liên kết tùy chỉnh <span class="pull-right"><i class="fa fa-angle-down"></i></span></div>
							<div id="custom_link_menu" class="collapse">
								<div id="custom_link">
									<div class="row">
										<div id="custom_link_title" class="col-sm-3">
											Tiêu đề:
										</div>
										<div class="input-group col-sm-9">
											<input id="input_custom_link_menu_title" type="text" class="form-control">
										</div>
									</div>
									<div class="row" style="margin-top: 7.5px">
										<div id="custom_link_title" class="col-sm-3">
											Liên kết:
										</div>
										<div class="input-group col-sm-9">
											<input id="input_custom_link_menu_link" type="link" class="form-control" value="http://">
										</div>
									</div>
								</div>
								<div id="add_custom_link_box">
									<button id="add_custom_link" class="btn btn-info">Thêm</button>
									<span id="custom_link_null" class="label label-danger text-right" style="display: none; float: right;">Điền đủ thông tin!</span>
								</div>
							</div>
							<?php foreach ($list_post_type as $key => $post_type) {
							?>
							<div class="box-custom-item-menu text-bold" data-toggle="collapse" data-target="#page_item_menu_<?php echo $key ?>" style="margin-top: 7.5px;"><?php echo $post_type[0] ?> <span class="pull-right"><i class="fa fa-angle-down"></i></span></div>
							<div id="page_item_menu_<?php echo $key ?>" class="collapse list-post-item-menu">
								<div id="list-post">
									<?php get_list_post_checkbox($post_type[1], $post_type[0]) ?>
								</div>
								<div id="add_custom_link_box">
									<button class="btn btn-info add_post_item" data-target="<?php echo $post_type[1] ?>">Thêm</button>
									<span id="<?php echo $post_type[1] ?>_checked_null" class="label label-danger text-right" style="display: none; float: right;">Chưa chọn <?php echo strtolower($post_type[0]) ?> nào!</span>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
						<div class="white-box" style="overflow: auto;">
							<div class="myadmin-dd-empty dd" id="nestable2">
								<?php display_menu_html_in_admin() ?>
							</div>
							<hr>
							<button id="save_menu_position" class="btn btn-info " style="float: right;">Lưu sắp xếp</button>
						</div>
					</div>
				</div>
			</div>
<?php require_once('views/admin/footer.php'); ?>