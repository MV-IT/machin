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
									<a href="<?php echo get_print_curcuit_permalink($printCurcuit['ID']) ?>">
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
					<?php
					$list_post_type = get_web_option('post_type');
					foreach($list_post_type as $post_type){
						if($post_type[1] === get_web_option('index_post_type')){
							$post_type_title = $post_type[0];
							break;
						}
					}
					?>
					<div class="col-12 call-of-action order-4">
						<div class="row">
							<div class="col-md-7 col-sm-7 order-sm-1 col-12 introduction">
								<div class="header-title">
									<span><?php echo $post_type_title ?></span>
									<a href="<?php echo get_web_url() ?>/post/<?php echo get_web_option('index_post_type') ?>" class="pull-right d-block text-info" style="font-size: 15px">Xem tất cả</a href="<?php echo get_web_url() ?>/post/<?php echo get_web_option('index_post_type') ?>">
								</div>
								<?php 
								foreach ($listNewsIndex as $key => $news) {
								?>
								<div class="intro">
									<img src="<?php echo get_post_image($news['ID']) ?>" alt="">
									<h4><?php echo $news['post_title'] ?></h4>
									<p><?php echo max_word($news['post_content'], 20) ?></p>
									<a href="<?php echo get_post_permalink($news['ID']) ?>"><p>Xem thêm...</p></a>
								</div>
								<?php } ?>
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
						</div>
					</div>
					</div><!--linh tinh-->
				</div>
			</div>
		</div><!--contant-->
	</main>

<?php require_once('views/footer.php');

?>