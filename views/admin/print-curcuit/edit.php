<?php require_once('views/admin/header.php'); ?>
<?php require_once('views/admin/sidebar.php') ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "views/admin/breadcrumb.php"; ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="white-box">
							<form method="post">
								<input type="hidden" name="pr_type" value="<?php echo $print_curcuit->type ?>">
								<fieldset class="form-group">
									<div class="row">
										<div class="col-12 col-sm-4">
											<input type="file" class="dropify" name="feature_image" data-default-file="<?php echo get_print_curcuit_feature_image($print_curcuit->ID) ?>">
											<input type="hidden" id="image_after_crop" name="image_cropped">
											<button type="button" class="btn btn-primary pull-right mt-sm-3 mb-sm-3" id="crop_image_button_modal" data-toggle="modal" data-target="#crop_image_modal" style="display: none;">Cắt lại</button>
										</div>
										<div class="col-12 col-sm-8">
											<input type="text" class="form-control" name="printcurcuit-name" placeholder="Tên mạch in" value="<?php echo $print_curcuit->name ?>">

											<div class="col-<?php echo $col ?> checkbox checkbox-info mt-3">
												<input type="checkbox" name="featured" id="pr_featured" value="1" required <?php if($print_curcuit->featured == 1) echo 'checked' ?>>
												<label for="pr_featured">Danh sách tiêu biểu</label>
											</div>
										</div>
									</div>
								</fieldset>
								<fieldset class="form-group">
									<?php
									$price = 0;
									foreach ($list_properties as $property) {
										$list_chose = explode(',', $property['list_chose']);
										$col = floor(12/count($list_chose));
										$col = $col == 0 ? 1 : $col;
									?>
									<div class="row">
										<div class="col-2"><b><?php echo $property['name'] ?>:</b> </div>
										<div class="col-10">
											<div class="row mb-3">
												<?php
												
												foreach ($list_chose as $key => $chose){
													$chose_id = explode('|', $chose)[0];
													$chose_value = explode('|', $chose)[1];
													$checked = in_array($chose_id, $list_print_curcuit_properties_value) ? 'checked' : '';
													if(!empty($checked))
														$price += explode('|', $chose)[2];
												?>

												<div class="col-<?php echo $col ?> radio radio-info">
														<input type="radio" name="property_<?php echo $property['ID'] ?>" id="property_value_<?php echo $key.'_'.$property['ID'] ?>" class="property-value" value="<?php echo $chose_id ?>" required <?php echo $checked ?>>
														<label for="property_value_<?php echo $key.'_'.$property['ID'] ?>"><?php echo $chose_value ?></label>
												</div>

												<?php } ?>
											</div>
										</div>
									</div>
									<?php } ?>
								</fieldset>
								<fieldset class="form-group pl-3">
									<b>Giá thành: </b>
									<span id="price-num"><?php echo new Cost($price) ?></span>
								</fieldset>
								<fieldset class="form-group">
									<input type="submit" class="btn btn-info" name="edit" value="Lưu">
									<button type="button" data-id="<?php echo $print_curcuit->ID ?>" data-toggle="modal" data-target="#ask-delete-modal" class="btn btn-secondary delete-printcurcuit">
										Xóa
									</button>
								</fieldset>
							</form>
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

			<div class="modal fade" id="crop_image_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title text-info">Cắt ảnh</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">

								<div style="width: 100%; max-height: 500px">
									<img src="" id="image" alt="">
								</div>

							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-info crop_image" data-ans="1" data-dismiss="modal" aria-label="Close">Cắt</button>
							<button class="btn btn-danger delete_answer" data-ans="0" data-dismiss="modal" aria-label="Close">Đóng</button>
						</div>
					</div>
				</div>
			</div>

			<script>
				jQuery(document).ready(function($) {
					$('.delete-printcurcuit').click(function() {
						var id = $(this).data('id');

						$('[name="delete-print_curcuit"]').val(id);
					});
				});
			</script>

<?php require_once('views/admin/footer.php'); ?>