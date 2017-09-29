<?php require_once('views/header.php') ?>
	<main>
		<div class="contant">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-12 order-1 main-content">
						<?php if(count($listLastestPost) > 0): ?>
						<div class="big-news">
							<div class="row col-content">
								<div class="<?php if(count($listLastestPost) > 1): ?>col-lg-7 col-md-12 <?php endif; ?>col-12">
									<div class="news-main" style="border: 1px solid #eee; padding: 15px">
										<div class="big-img">
											<a href="<?php echo get_post_permalink($listLastestPost[0]['ID']) ?>"><img src="<?php echo get_post_image($listLastestPost[0]['ID']) ?>" alt=""></a>
										</div>
										<div class="contain">
											<a href="<?php echo get_post_permalink($listLastestPost[0]['ID']) ?>"><h4 class="title"><?php echo $listLastestPost[0]['post_title'] ?></h4></a>
											<p><?php echo max_word($listLastestPost[0]['post_content']) ?></p>
											<a href="<?php echo get_post_permalink($listLastestPost[0]['ID']) ?>" class="seemore"><span>Xem thêm...</span></a>
										</div>
									</div>
								</div>
								<?php if(count($listLastestPost) > 1): ?>
									<div class=" col-lg-5 col-md-12 col-12 news-no-main">
										<?php foreach ($listLastestPost as $key => $post) {
											if($key > 0):
										?>
											<div class="col-md-12 main-news">
												<div class="row">
													<div class="col-md-5 col-5">
														<a href="<?php echo get_post_permalink($post['ID']) ?>"><img src="<?php echo get_post_image($post['ID']) ?>" alt=""></a>
													</div>
													<div class="col-md-7 col-7" style="padding-left: 0">
														<a href="<?php echo get_post_permalink($post['ID']) ?>">
															<h6 class="header-name"><?php echo $post['post_title'] ?></h6>
															<span>Đăng ngày: <?php echo date('d/m/Y', strtotime($post['post_date'])) ?></span><br>
															<span>By: <?php echo get_user_by_ID($post['post_author'])->display_name ?></span><br>
														</a>
														<a href="<?php echo get_post_permalink($post['ID']) ?>" class="seemore"><span>Xem thêm...</span></a>
													</div>
												</div>
											</div>
										<?php endif; 
									} ?>
								</div>
							<?php endif; ?>
							</div>
						</div><!--end big news-->
						<?php else: ?>
							<div class="col-content">
								Không có <?php echo strtolower($post_type_title) ?>
							</div>
						<?php endif; ?>
						<?php if(count($listLastestPost) > 0): ?>
						<div class="dif-news col-content">
							<ul class="nav nav-tabs nav-news-dif" id="myTab" role="tablist">
								<?php foreach ($listCategories as $key => $category) {
									if($key == 0):
										?>
										<li class="nav-item ">
											<a class="nav-link active-brand-news active" id="post-tab" data-toggle="tab" href="#tab-<?php echo $category['slug'] ?>" role="tab" aria-controls="home" aria-expanded="true"><?php echo $category['title'] ?></a>
										</li>
									<?php else: ?>
										<li class="nav-item">
											<a class="nav-link active-brand-news" id="hot-news-tab" data-toggle="tab" href="#tab-<?php echo $category['slug'] ?>" role="tab" aria-controls="home" aria-expanded="true"><?php echo $category['title'] ?></a>
										</li>
									<?php endif; 
								} ?>
							</ul>
							<div class="tab-content tab-news-df" id="myTabContent">
								<?php foreach ($listCategories as $key => $category) {
									$listPostByCategory = $model->getPostByCategory($category['ID']);
									
									if ($key == 0):
								?>
								<div class="tab-pane fade show active tab-show-posts" id="tab-<?php echo $category['slug'] ?>" role="tabpanel">
								<?php else: ?>
								<div class="tab-pane fade show tab-show-posts" id="tab-<?php echo $category['slug'] ?>" role="tabpanel">
								<?php endif; ?>
									<div id="tab-<?php echo $category['slug'] ?>-content">
									<?php if(count($listPostByCategory) > 0): foreach ($listPostByCategory as $key => $post) {
									?>
									<a href="<?php echo get_post_permalink($post['ID']) ?>">
										<div class="item-news-df">
											<div class="row">
												<div class="col-md-5 col-5 img-news-df">
													<img src="<?php echo get_post_image($post['ID']) ?>" alt="">
												</div>
												<div class="col-md-7 col-7 content-news-df" style="padding-left: 0">
													<h5><?php echo $post['post_title'] ?></h5>
													<p>
														<?php echo max_word($post['post_content']) ?>
													</p>
												</div>
											</div>
										</div>
									</a>
									<?php } ?>
								<?php else: ?>
									Không có <?php echo strtolower($post_type_title) ?>
								<?php endif; ?>
								</div>
								<?php if(count($listPostByCategory) > 0): ?>
									<div class="loading-overlay">
										<div class="loading-spinner"></div>
									</div>
									<div class="ajax-pagi-content">
										<ul class="pagination">
											<li class="pagi-item-prev cursor-not-allowed" data-page="0" data-cate-slug="<?php echo $category['slug'] ?>" data-cate-id="<?php echo $category['ID'] ?>"><i class="fa fa-angle-left"></i></li>
											<li class="pagi-item-next" data-page="2" data-cate-slug="<?php echo $category['slug'] ?>" data-cate-id="<?php echo $category['ID'] ?>"><i class="fa fa-angle-right"></i></li>
										</ul>
									</div>
								<?php  endif; ?>
								</div>
								<?php } ?>
							</div>
						</div><!--end tin tức khác-->
						<?php endif; ?>
					</div><!--news-paper-->
					<?php require 'views/sidebar.php'; ?>
				</div>
			</div>
		</div><!--contant-->
	</main>

<?php require_once('views/footer.php'); ?>