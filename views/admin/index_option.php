<?php require_once('views/admin/header.php'); ?>
<?php require_once('views/admin/sidebar.php') ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "views/admin/breadcrumb.php"; ?>
				<div class="row">
				<form method="post" enctype="multipart/form-data" style="width: 100%">
				<input type="hidden" name="key_update" value="<?php echo $rand_key ?>">
					<div class="col-xs-12">
						<div class="white-box">
							<button type="submit" name="update" class="btn btn-success pull-right">Cập nhật</button>
							<div class="clearfix"></div>
							<hr>
							<div class="index-content">
								<div class="index-sliderbar">
									<div class="row">
										<h4 class="box-title">Slider</h4>
										<div id="add-slider-item" class="col-sm-12 add-slider-item text-center">
											<i class="fa fa-plus-circle"></i> Thêm ảnh
										</div>
										<div class="col-sm-12 custom-slide-item">
											<div id="slider-items-content" class="row">
											<?php

											$slider_items = get_web_option('index_slider');
											$num_slider_item = 0;
											if(is_array($slider_items))
												foreach ($slider_items as $key => $slider_item) {

											?>
												<div id="slider-item-<?php echo $key ?>" class="col-xs-12 col-sm-6 col-md-4">
													<div class="slider-item">
														<button type="button" class="btn btn-default btn-delete-slider-item" onclick="delete_slider_item(<?php echo $key ?>)">Xóa</button>
														<hr>
														<div class="row">
															<div class="col-3"><label>Link: </label></div>
															<div class="col-9"><input type="url" name="slider-item-link-<?php echo $key ?>" class="form-control" value="<?php echo $slider_item['link'] ?>"></div>
															<div class="mb-xs-2"></div>
															<div class="col-3"><label>File url:<br><small>(1 trong 2)</small></label></div>
															<div class="col-9"><input type="url" name="slider-item-file-url-<?php echo $key ?>" value="<?php echo $slider_item['src'] ?>" class="form-control"></div>
															<div class="col-3"><label>Upload file:</label></div>
															<div class="col-9"><input type="file" name="slider-item-file-<?php echo $key ?>" class="form-control"></div>
														</div>
													</div>
												</div>
											<?php $num_slider_item = $key + 1; } ?>
											</div>
										</div>
									</div>
								</div>

								<hr>
								<?php 
									$listVideo = get_web_option('index_video');
								?>
								<div class="index-video">
									<h3 class="box-title">Video Youtbe</h3>
									<div class="row">
										<div class="col-sm-6">
											<div class="video-box">
												<h4>Video 1:</h4>
												<label for="video_link_1">Linnk video:</label><input type="url" class="form-control" id="video_link_1" name="videoLink[]" value="<?php echo !empty($listVideo[0]) ? $listVideo[0] : '' ?>">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="video-box">
												<h4>Video 2:</h4>
												<label for="video_link_2">Linnk video:</label><input type="url" class="form-control" id="video_link_2" name="videoLink[]" value="<?php echo !empty($listVideo[1]) ? $listVideo[1] : '' ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				</div>

				<!-- /.row -->
			</div>
			<script>
				var item_num = <?php echo $num_slider_item ?>;
			</script>
<?php require "footer.php" ?>