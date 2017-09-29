<?php require_once 'views/header.php'; ?>
	<div class="container col-content">
		<div class="content-form">
			<h3 class="title">Đặt mạch in</h3>
			<form method="post">
				<h3 class="box-title">Thông tin liên hệ và giao hàng</h3>
				<div class="row">
					<div class="col-sm-6">
						<fieldset class="form-group">
							<label for="customer-name">Họ và tên</label>
							<input type="text" id="customer-name" name="customer-name" class="form-control" placeholder="Họ và tên">
						</fieldset>
					</div>
					<div class="col-sm-6">
						<fieldset class="form-group">
							<label for="customer-email">Địa chỉ email</label>
							<input type="email" id="customer-email" name="customer-email" class="form-control" placeholder="Địa chỉ email">
						</fieldset>
					</div>
					<div class="col-sm-6">
						<fieldset class="form-group">
							<label for="customer-phone">Điện thoại</label>
							<input type="text" id="customer-phone" name="customer-phone" class="form-control" placeholder="Điện thoại">
						</fieldset>
					</div>
					<div class="col-sm-6">
						<fieldset class="form-group">
							<label for="city">Thành phố</label>
							<select name="city" id="city" class="form-control">
								<?php get_list_option_city() ?>
							</select>
						</fieldset>
					</div>
					<div class="col-sm-6">
						<fieldset class="form-group">
							<label for="country">Quận/Huyện</label>
							<select name="country" id="country" class="form-control">

							</select>
						</fieldset>
					</div>
					<div class="col-sm-6">
						<fieldset class="form-group">
							<label for="address">Địa chỉ</label>
							<input type="text" id="address" name="address" class="form-control" placeholder="Địa chỉ">
						</fieldset>
					</div>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6">
								<fieldset class="form-group">
									<label for="num_date">Lấy sau</label>
									<div class="input-group">
										<input type="number" class="form-control" id="num_date" name="receive-after">
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
											<input type="radio" name="ship-to-home" id="home" value="yes" required="">
											<label for="home">Có</label>
										</div>
										<div class="col-6 radio radio-info mt-2">
											<input type="radio" name="ship-to-home" id="not-home" value="no" required="">
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
					<div class="col-sm-12 order-item" data-sort="1">
						<div class="order-item-title">
							<span>Mạch in 1</span>
							<button type="button" class="btn btn-secondary pull-right" onclick="delete_printcurcuit(this)">Xóa</button>
						</div>
						<div class=" form-group row">
							<label class="col-sm-2 col-form-label" for="name-printcurcuit-0"><b>Tên mạch</b></label>
							<div class="col-sm-10"><input type="text" id="name-printcurcuit-0" name="printcurcuit_0[name]" class="form-control"></div>
						</div>
						<div class=" form-group row">
							<label class="col-sm-2 col-form-label" for="num-printcurcuit-0"><b>Số lượng</b></label>
							<div class="col-sm-10"><input type="number" id="num-printcurcuit-0" name="printcurcuit_0[num]" class="form-control" value="1" onchange="change_price(this)"></div>
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
												?>
												<div class="col-<?php echo $col ?> radio radio-info">
													<input type="radio" name="printcurcuit_0[property_<?php echo $property['ID'] ?>]" id="p_0_property_<?php echo $key.'_'.$property['ID'] ?>" class="property-value-0" value="<?php echo $chose_id ?>" onchange="change_price(this)" required>
													<label for="p_0_property_<?php echo $key.'_'.$property['ID'] ?>"><?php echo $chose_value ?></label>
												</div>
												<?php } ?>
											</div>
										</div>
									</div>
									<hr>
									<?php }} ?>
									<fieldset class="form-group" style="margin-bottom: 0">
										<b>Giá: </b>
										<span id="price-num-0">0<sup>đ</sup></span>
										<input type="hidden" name="printcurcuit_0[price-num]" class="price-num" value="0">
									</fieldset>
								</div>
							</div>
							<div class="clearfix"><button id="add-printcurcuit" type="button" class="btn btn-info mb-5 pull-right">Thêm mạch in</button></div>
							<input type="hidden" name="num-printcurcuit" value="1">
							<p><b>Tổng: </b><span id="total_cost">0<sup>đ</sup></span></p>
							<input type="submit" name="add-new-order" class="btn btn-info" value="Thêm đơn hàng">

						</form>
		</div>
	</div>
<?php require_once 'views/footer.php'; ?>