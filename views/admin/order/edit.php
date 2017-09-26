<?php require_once('views/admin/header.php'); ?>
<?php require_once('views/admin/sidebar.php') ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<?php require "views/admin/breadcrumb.php"; ?>
				<div class="row">
					<div class="col-12">
						<div class="white-box">
							<div class="row">
								<div class="col-sm-6">
									<h2>Mã đơn hàng: <?php echo $order['code'] ?></h2>
								</div>
								<div class="col-sm-6">
									<h2>Mã xem đơn hàng: <?php echo $order['view_code'] ?></h2>
								</div>
							</div>
							<div class="mt-3"></div>
							<form method="post">
								<h3 class="box-title">Tình trạng đơn hạng</h3>
								<div class="row">
									<div class="col-sm-6">
										<fieldset class="form-group">
											<label for="accept-time">Ngày xác nhận</label>
											<input type="text" id="accept-time" name="accept-time" class="form-control datepicker" placeholder="Ngày xác nhận" value="<?php echo $order['accept_time'] ?>">
										</fieldset>
									</div>
									<div class="col-sm-6">
										<fieldset class="form-group">
											<label for="will-receive-time">Ngày giao dự kiến</label>
											<input type="text" id="will-receive-time" name="will-receive-time" class="form-control datepicker" placeholder="Ngày giao dự kiến" value="<?php echo $order['will_receive_time'] ?>">
										</fieldset>
									</div>
									<div class="col-sm-6">
										<fieldset class="form-group">
											<label for="receive-time">Ngày giao trả hàng</label>
											<input type="text" id="receive-time" name="receive-time" class="form-control datepicker" placeholder="Ngày giao trả hàng" value="<?php echo $order['receive_time'] ?>">
										</fieldset>
									</div>
									<div class="col-sm-6">
										<fieldset class="form-group">
											<label for="status">Tiến độ</label>
											<div class="input-group">
											<input type="number" min="0" max="100" class="form-control" id="status" name="status" placeholder="Tiến độ" value="<?php echo $order['status'] ?>">
												<div class="input-group-addon">
													%
												</div>
											</div>
										</fieldset>
									</div>
								</div>
								<hr>
								<h3 class="box-title">Thông tin liên hệ và giao hàng</h3>
								<div class="row">
									<div class="col-sm-6">
										<fieldset class="form-group">
											<label for="customer-name">Họ và tên</label>
											<input type="text" id="customer-name" name="customer-name" class="form-control" placeholder="Họ và tên" value="<?php echo $order['customer_name'] ?>">
										</fieldset>
									</div>
									<div class="col-sm-6">
										<fieldset class="form-group">
											<label for="customer-email">Địa chỉ email</label>
											<input type="email" id="customer-email" name="customer-email" class="form-control" placeholder="Địa chỉ email" value="<?php echo $order['customer_email'] ?>">
										</fieldset>
									</div>
									<div class="col-sm-6">
										<fieldset class="form-group">
											<label for="customer-phone">Điện thoại</label>
											<input type="text" id="customer-phone" name="customer-phone" class="form-control" placeholder="Điện thoại" value="<?php echo $order['customer_phone'] ?>">
										</fieldset>
									</div>
									<div class="col-sm-6">
										<fieldset class="form-group">
											<label for="city">Thành phố</label>
											<select name="city" id="city" class="form-control">
												<?php get_list_option_city($address['city']) ?>
											</select>
										</fieldset>
									</div>
									<div class="col-sm-6">
										<fieldset class="form-group">
											<label for="country">Quận/Huyện</label>
											<select name="country" id="country" class="form-control">
												<?php get_list_option_country($address['country']) ?>
											</select>
										</fieldset>
									</div>
									<div class="col-sm-6">
										<fieldset class="form-group">
											<label for="address">Địa chỉ</label>
											<input type="text" id="address" name="address" class="form-control" placeholder="Địa chỉ" value="<?php echo $address['street'] ?>">
										</fieldset>
									</div>
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-6">
												<fieldset class="form-group">
													<label for="num_date">Lấy sau</label>
													<div class="input-group">
														<input type="number" class="form-control" id="num_date" name="receive-after" value="<?php echo $order['receive_after'] ?>">
														<div class="input-group-addon">
															Ngày
														</div>
													</div>
												</fieldset>
											</div>
											<div class="col-sm-6">
												<fieldset class="form-group">
													<label>Ship tận nhà</label>
													<div class="row pl-2">
														<div class="col-6 radio radio-info mt-2">
															<input type="radio" name="ship-to-home" id="home" value="yes" required="" <?php if($order['ship_to_home'] == 'yes') echo 'checked' ?>>
															<label for="home">Có</label>
														</div>
														<div class="col-6 radio radio-info mt-2">
															<input type="radio" name="ship-to-home" id="not-home" value="no" required="" <?php if($order['ship_to_home'] == 'no') echo 'checked' ?>>
															<label for="not-home">Không</label>
														</div>
													</div>
												</fieldset>
											</div>
										</div>
									</div>
								</div>
								<hr>
								<h3 class="box-title mt-3">Danh sách mạch in</h3>
								<div id="list-printcurcuit">
								<?php foreach ($list_printcurcuit as $k => $printcurcuit){
									$id = explode('|', $printcurcuit)[0];
									$number = explode('|', $printcurcuit)[1];
									$cost = explode('|', $printcurcuit)[2];
									$printcurcuit = $mPrintCurcuit->getPrintCurcuit($id);
									$list_print_curcuit_properties_value = explode(',', $printcurcuit->property_value);
								?>
									<div class="col-sm-12 order-item" data-sort="<?php echo $k + 1 ?>">
										<div class="order-item-title">
											<span>Mạch in <?php echo $k + 1 ?></span>
											<button type="button" class="btn btn-secondary pull-right" onclick="delete_printcurcuit(this)">Xóa</button>
										</div>
										<div class=" form-group row">
											<label class="col-xs-2 col-form-label" for="name-printcurcuit-<?php echo $k ?>"><b>Tên mạch</b></label>
											<div class="col-xs-10"><input type="text" id="name-printcurcuit-<?php echo $k ?>" name="printcurcuit_<?php echo $k ?>[name]" class="form-control" value="<?php echo $printcurcuit->name ?>"></div>
										</div>
										<div class=" form-group row">
											<label class="col-xs-2 col-form-label" for="num-printcurcuit-<?php echo $k ?>"><b>Số lượng</b></label>
											<div class="col-xs-10"><input type="number" id="num-printcurcuit-<?php echo $k ?>" name="printcurcuit_<?php echo $k ?>[num]" class="form-control" value="<?php echo $number ?>" onchange="change_price(this)"></div>
										</div>
										<div class="mb-5 mt-5 .row"></div>
										<?php if(!empty($list_property)){
											foreach ($list_property as $key => $property){
												$list_chose = explode(',', $property['list_chose']);
												$col = floor(12/count($list_chose));
												$col = $col == 0 ? 1 : $col;

										?>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label" for="num-printcurcuit">
												<b><?php echo $property['name'] ?></b>
											</label>
											<div class="col-sm-10">
												<div class="row">
													<?php foreach ($list_chose as $key => $chose){
														$chose_id = explode('|', $chose)[0];
														$chose_value = explode('|', $chose)[1];
														$checked = in_array($chose_id, $list_print_curcuit_properties_value) ? 'checked' : '';
													?>
													<div class="col-<?php echo $col ?> radio radio-info">
														<input type="radio" name="printcurcuit_<?php echo $k ?>[property_<?php echo $property['ID'] ?>]" id="p_<?php echo $k ?>_property_<?php echo $key.'_'.$property['ID'] ?>" class="property-value-<?php echo $k ?>" value="<?php echo $chose_id ?>" onchange="change_price(this)" required <?php echo $checked ?>>
														<label for="p_<?php echo $k ?>_property_<?php echo $key.'_'.$property['ID'] ?>"><?php echo $chose_value ?></label>
													</div>
													<?php } ?>
												</div>
											</div>
										</div>
										<hr>
										<?php }} ?>
										<fieldset class="form-group" style="margin-bottom: 0">
											<b>Giá: </b>
											<span id="price-num-<?php echo $k ?>"><?php echo new Cost($cost) ?></span>
											<input type="hidden" name="printcurcuit_<?php echo $k ?>[price-num]" class="price-num" value="<?php echo $cost ?>">
											<input type="hidden" name="printcurcuit_<?php echo $k ?>[id]" value="<?php echo $id ?>">
										</fieldset>
									</div>
								<?php } ?>
								</div>
								<div class="clearfix"><button id="add-printcurcuit" type="button" class="btn btn-info mb-5 pull-right">Thêm mạch in</button></div>
								<input type="hidden" name="num-printcurcuit" value="<?php echo count($list_printcurcuit) ?>">
								<p><b>Tổng: </b><span id="total_cost"><?php echo new Cost($order['total_cost']) ?></p>
								<input type="submit" name="edit-order" class="btn btn-info" value="Cập nhật đơn hàng">
								<button type="button" class="btn btn-secondary delete-order" data-id="<?php echo $order['ID'] ?>" data-toggle="modal" data-target="#ask-delete-modal">Xóa</button>
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