					<div class="col-md-4 col-sm-12  order-2 silde-bar">
						<?php require_once('views/user/form-sidebar.php') ?>
						<?php if(strpos($action, 'post')): ?>
						<div class="col-12 col-content sidebar-item">
							<div class="header-title">
								<span><?php echo $post_type_title; ?> nổi bật</span>
							</div>
							<div class="like-news-no-main">
								<?php if(!empty($listRandomPosts) && is_array($listRandomPosts)):
									foreach ($listRandomPosts as $key => $post){
								 ?>
								<div class="col-md-12 main-news">
									<div class="row">
										<div class="col-md-4 col-5" style="padding-right: 0">
											<a href="<?php echo get_post_permalink($post['ID']) ?>" onclick="return false"><img src="<?php echo get_post_image($post['ID']) ?>" alt=""></a>
										</div>
										<div class="col-md-8 col-6 info-no-main">
											<a href="<?php echo get_post_permalink($post['ID']) ?>">
												<h6 class="header-name">Tên lửa cháy </h6>
												<span>Đăng ngày: <?php echo date('d/m/Y', strtotime($post['post_date'])) ?></span><br>
												<span>By: <?php echo get_user_by_ID($post['post_author'])->display_name ?></span><br>
											</a>
											<a href="<?php echo get_post_permalink($post['ID']) ?>" class="seemore"><span>Xem thêm...</span></a>
										</div>
									</div>
								</div>
								<?php } 
								endif; ?>
							</div>
						</div>
					<?php endif; ?>
					</div><!--silde0bar-->