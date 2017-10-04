<?php 
	require 'views/header.php';
?>
	<main>
		<div class="contant">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-12 order-1 main-content">
						<div class="content-new">
							<h1 class="title-new"><?php echo $post['post_title'] ?></h1>
							<div class="img-new">
								<img src="<?php echo get_post_image($post['ID']) ?>" alt="">
							</div>
							<?php echo $post['post_content'] ?>
						</div>
					</div>
					<?php require'views/sidebar.php'; ?>
				</div>
			</div>
		</div>		

<?php
 	 require 'views/footer.php' 
?>