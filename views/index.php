<?php 

require_once('views/header.php'); ?>

	<main>
		<div class="slide">
			<div class="owl-carousel">
			<?php foreach ($listSliderItem as $sliderItem){
			?>
			<div>
				<a href="<?php echo $sliderItem['link'] ?>">
					<img src="<?php echo $sliderItem['src'] ?>" alt="">
				</a>
			</div>
			<?php } ?>
			</div>
		</div>
		<div class="contant">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-12 order-2 order-md-1 main-content">
						<div class="header-title">
							<span>Mạch in mẫu tiêu biểu</span>
						</div>
						<div class="product-highlights">
							<div class="row">
							<?php foreach ($listPrintCurcuitFeature as $printCurcuit) {
								$price = get_print_curcuit_price($printCurcuit['ID']);
							?>
								<div class="product-item col-6 col-sm-4 col-md-4 col-lg-3">
									<a href="">
										<div class="product-item-content">
											<div class="pr-img">
												<img src="<?php echo get_print_curcuit_feature_image($printCurcuit['ID']) ?>" alt="">
											</div>
											<div class="pr-info">
												<div class="pr-title"><?php echo $printCurcuit['name'] ?></div>
												<div class="pr-price">
													<?php echo new Cost($price) ?>
												</div>
											</div>
										</div>
									</a>
								</div>
							<?php } ?>
							</div>
						</div>
					</div><!--product-->
					<div class="col-md-4 col-sm-12  order-1 order-md-2 silde-bar">
						<?php require_once('views/user/form-sidebar.php'); ?>
					</div><!--login-->
					<div class="col-12 order-3 product-main">
						<div class="header-title">
							<span>Một số mạch in mẫu khác</span>
						</div>
						<div class="product-main product-highlights">
							<div class="row">
								<?php foreach ($listRandPrintCurcuit as $printCurcuit) {
									$price = get_print_curcuit_price($printCurcuit['ID']);
									?>
									<div class="product-item col-6 col-sm-4 col-md-3 col-lg-2">
										<a href="">
											<div class="product-item-content">
												<div class="pr-img">
													<img src="<?php echo get_print_curcuit_feature_image($printCurcuit['ID']) ?>" alt="">
												</div>
												<div class="pr-info">
													<div class="pr-title"><?php echo $printCurcuit['name'] ?></div>
													<div class="pr-price">
														<?php echo new Cost($price) ?>
													</div>
												</div>
											</div>
										</a>
									</div>
									<?php } ?>
							</div>
						</div>
					</div><!--product-->
					<div class="call-of-action order-4">
						<div class="row">
							<div class="col-md-7 col-sm-7 order-sm-1 col-12 introduction">
								<div class="header-title">
									<a href=""><span>Tin tức</span></a>
								</div>
								<div class="intro">
									<img src="http://sohanews.sohacdn.com/zoom/700_438/2017/photo-1-1494840504310-0-47-281-499-crop-1494840545857.jpg" alt="">
									<h4>Tên lửa cháy</h4>
									<p>Chúng tôi sản xuất tên lửa phi hạt nhân để phục vụ lợi ích của các bạn. Chúng tôi chuyên cung cấp mặt hàng tốt nhất để phục vụ cho chiến thắng của bạn. </p>
									<a href=""><p>Xem thêm...</p></a>
								</div>
								<div class="intro">
									<img src="http://sohanews.sohacdn.com/zoom/260_162/2016/2-fbsw-1481202212465-0-48-350-612-crop-1481202229902.jpg" alt="">
									<h4>Tàu ngầm cháy</h4>
									<p>Chúng tôi sản xuất tên lửa phi hạt nhân để phục vụ lợi ích của các bạn. Chúng tôi chuyên cung cấp mặt hàng tốt nhất để phục vụ cho chiến thắng của bạn. </p>
									<a href=""><p>Xem thêm...</p></a>
								</div>
							</div>
							<div class="col-md-5 col-sm-5 col-12 order-sm-2 watched">
								<div class="header-title red">
									<span>Video</span>
								</div>
								<div class="video">
									<?php
										$listVideo = get_web_option('index_video');
										foreach ($listVideo as $video) {
									?>
									<iframe width="100%" src="<?php echo $video ?>" frameborder="0" allowfullscreen></iframe>
									<?php } ?>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-12 order-sm-3 news">
								<div class="header-title">
									<a href=""><span>Diễn đàn</span></a>
								</div>
								<div>
									<ul>
										<li><a href="">Mạch động học là sự kêt hợp hoàn hảo  sdsadsadsa</a></li>
										<li><a href="">Quạt tỏa nhiệt được cấu tạo như thế nào</a></li>
										<li><a href="">Thuốc tạo năng lượng từ nhiệt</a></li>
										<li><a href="">Máy bay VIệt Nam 007 bọc thép</a></li>
										<li><a href="">Các trường đại học Colorful hàng đầu Vn</a></li>
										<li><a href=""> Đội tuyển VN</a></li>
										<a href=""><p>Xem thêm...</p></a>
									</ul>
								</div>
							</div>
						</div>
					</div>
					</div><!--linh tinh-->
				</div>
			</div>
		</div><!--contant-->
	</main>

<?php require_once('views/footer.php');

?>