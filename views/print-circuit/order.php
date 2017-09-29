<?php require_once 'views/header.php'; ?>
	<div class="container">
		<div class="content-form">
			<h3 class="title">Đặt mạch in</h3>
			<form id="contactform" name="contact" method="post" action="#">
				<p class="note"><span class="req">*</span> Thông tin liên hệ</p>
				<div class="row">
					<label for="name">Họ Tên <span class="req">*</span></label>
					<input type="text" name="name" class="txt" tabindex="1" placeholder="" required>
				</div>
				<div class="row">
					<label for="phoneNumber">SĐT <span class="req">*</span></label>
					<input type="text" name="phoneNumber" class="txt" tabindex="2" placeholder="" required>
				</div>
				<div class="row">
					<label for="address">Địa chỉ <span class="req">*</span></label>
					<input type="text" name="address" class="txt" tabindex="3" placeholder="">
				</div>
				<div class="row">
					<label for="email">E-mail <span class="req">*</span></label>
					<input type="email" name="email" class="txt" tabindex="4" placeholder="address@domain.com" required>
				</div>
				<!-- end contact information -->
				<p class="note"><span class="req">*</span> Thông tin đặt mạch</p>
				<div class="row">
					<label for="numberOfProduct">Số lượng mạch <span class="req">*</span></label>
					<input type="text" name="address" class="txt" tabindex="5" placeholder="number">
				</div>
				<div class="row">
					<label for="productQuality">Chất liệu mạch <span class="req">*</span></label>
					<span class="change-radio">
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="productQuality" class="chose" tabindex="6">
						<span class="padding-radio">Phíp FR1</span></span>
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="productQuality" class="chose" tabindex="7">
						<span class="padding-radio">Phíp FR4</span></span>
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="productQuality" class="chose" tabindex="8">
						<span class="padding-radio">Phíp CEM</span></span>
					</span>
				</div>
				<div class="row">
					<label for="number-class">Số lớp <span class="req">*</span></label>
					<span class="change-radio">
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="number-class" class="chose" tabindex="9">
						<span class="padding-radio">1 Layer</span></span>
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="number-class" class="chose" tabindex="10">
						<span class="padding-radio">2 Layer</span></span>
					</span>
				</div>
				<div class="row">
					<label for="color-circuit">Phủ mạch <span class="req">*</span></label>
					<span class="change-radio">
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="color-circuit" class="chose" tabindex="10">
						<span class="padding-radio">Green</span></span>
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="color-circuit" class="chose" tabindex="11">
						<span class="padding-radio">Red</span></span>
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="color-circuit" class="chose" tabindex="12">
						<span class="padding-radio">Blue</span></span>
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="color-circuit" class="chose" tabindex="13">
						<span class="padding-radio">Black</span></span>
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="color-circuit" class="chose" tabindex="14">
						<span class="padding-radio">Không phủ</span></span>
					</span>
				</div>
				<div class="row">
					<label for="in-linh-kien">Phủ mạch <span class="req">*</span></label>
					<span class="change-radio">
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="in-linh-kien" class="chose" tabindex="15">
						<span class="padding-radio">In BOT và TOP</span></span>
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="in-linh-kien" class="chose" tabindex="16">
						<span class="padding-radio">In BOT</span></span>
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="in-linh-kien" class="chose" tabindex="17">
						<span class="padding-radio">In TOP</span></span>
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="in-linh-kien" class="chose" tabindex="18">
						<span class="padding-radio">Không In</span></span>
					</span>
				</div>
				<div class="row">
					<label for="time-takeaway">Thời gian lấy mạch <span class="req">*</span></label>
					<span class="change-radio">
						<span class="box-radio box-radio-special"><input type="radio" class="m-radio radio-info" name="time-takeaway" class="chose" tabindex="19">
						<span class="padding-radio">2 Ngày (Giá Cao)</span></span>
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="time-takeaway" class="chose" tabindex="20">
						<span class="padding-radio">4 Ngày</span></span>
					</span>
				</div>
				<div class="row">
					<label for="ship">Ship Hàng Tận Nhà <span class="req">*</span></label>
					<span class="change-radio">
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="ship" class="chose" tabindex="20">
						<span class="padding-radio">Có</span></span>
						<span class="box-radio"><input type="radio" class="m-radio radio-info" name="ship" class="chose" tabindex="21">
						<span class="padding-radio">Không</span></span>
					</span>
				</div>
				<!-- end order information -->
				<div class="center">
					<input class="btn btn-primary" type="submit" id="submitbtn" name="submitbtn" tabindex="5" value="ĐẶT MẠCH">
				</div>
			</form>
		</div>
	</div>
<?php require_once 'views/footer.php'; ?>