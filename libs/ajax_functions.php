<?php 
require 'database.php';
require 'functions.php';

/************************
AJAX CALL FUNCTION
************************/
if(isset($_REQUEST['action'])){
	$action = $_REQUEST['action'];
	$action();
}

function ajax_user_exists(){
	if(isset($_POST['username']))
		$username = $_POST['username'];
	$nkdb = new Database();
	$user = $nkdb->query("SELECT * FROM users WHERE username = '$username'");
	if(mysqli_num_rows($user) > 0)
		echo 1;
	else
		echo 0;
	die();
}

function ajax_email_exists(){
	$type = $_POST['type'];
	if(isset($_POST['email']))
		$email = $_POST['email'];
	if(!is_email($email)){
		echo 2;
		die();
	}
	$nkdb = new Database();
	$user = $nkdb->query("SELECT * FROM $type WHERE email = '$email'");
	if(mysqli_num_rows($user) > 0)
		echo 1;
	else
		echo 0;
	die();
}

function ajax_delete_user(){
	$nkdb = new Database();
	$ID = $_POST['ID'];

	$user_avatar = get_user_avatar_name($ID);
	delete_file($user_avatar, 'avatar');

	$nkdb->query("DELETE FROM users WHERE ID = '$ID'");

	$query = $nkdb->query("SELECT * FROM users WHERE ID = '$ID'");

	if(mysqli_num_rows($query) < 1)
		echo 1;
	else
		echo 0;
	die();
}

/*************
POST
*************/

function ajax_add_new_post(){
	$title = $_POST['post_title'];
	$content = $_POST['post_content'];
	$post_type = $_POST['post_type'];

	if(empty($title) || empty($content) || empty($post_type)){
		die(0);
	}
	$nkdb = new Database();

	$list_categories = explode(',', $_POST['list_categories']);

	if(!empty($_FILES['image']['name'])){
		if(empty($_POST['image_cropped']))
			$image_name = save_file_upload($_FILES['image'], 'post');
		else{
			$image_name = save_file_from_data_url($_POST['image_cropped'], 'post');
		}
	}else{
		$image_name = 'default_image_post.png';
	}

	$image_url = '/images/post/'.$image_name;
	$user = get_current_user_info();

	$url = make_slug($title);
	$nkdb->query("INSERT INTO posts (post_title, post_content, post_date, date_edited, post_author, post_type, post_thumbnail, url) VALUES ('$title', '$content', NOW(), NOW(), '$user->ID', '$post_type', '$image_url', '$url')");
	$query = $nkdb->query("SELECT ID FROM posts WHERE post_title = '$title'");
	if(mysqli_num_rows($query) > 0){
		$post = mysqli_fetch_array($query);
		
		foreach ($list_categories as $key => $cate_id) {
			if(!$nkdb->insert('post_terms', array('post_id' => $post['ID'], 'term_id' => $cate_id))){
				echo 0;
				die();
			}
		}
		echo $post['ID'];
	}
	else
		echo '0';
	die();

}

function ajax_edit_post(){
	$title = $_POST['post_title'];
	$content = $_POST['post_content'];
	$post_type = $_POST['post_type'];
	$ID = $_POST['post_id'];

	if(empty($title) || empty($content) || empty($post_type)){
		die(0);
	}

	$list_categories = explode(',', $_POST['list_categories']);
	
	if(isset($_FILES['image']))
		$image = $_FILES['image'];

	$nkdb = new Database();

	$cur_image = basename(get_post_image($ID));

	if(!empty($image['name']) || !empty($_POST['image_cropped'])){
		if(empty($_POST['image_cropped']))
			$image_name = save_file_upload($image, 'post');
		else{
			$image_name = save_file_from_data_url($_POST['image_cropped'], 'post');
		}
		delete_file( $cur_image, 'post');
		$image_url = '/images/post/'.$image_name;
	}else{
		$image_url = '/images/post/'.$cur_image;
	}
	
	$url = make_slug($title);
	$nkdb->query("UPDATE posts  SET post_title = '$title', post_content = '$content', post_thumbnail = '$image_url', date_edited = NOW(), url='$url' WHERE ID = '$ID'");
	$query = $nkdb->query("SELECT * FROM posts WHERE ID = '$ID'");
	
	$post = mysqli_fetch_array($query);
	if($post['post_title'] == $title || $post['post_content'] = $content || $post['post_thumbnail'] = $image_url){
		$nkdb->deleteRow('post_terms', 'post_id = '.$post['ID']);
		foreach ($list_categories as $key => $cate_id) {
			if(!$nkdb->insert('post_terms', array('post_id' => $post['ID'], 'term_id' => $cate_id))){
				echo 0;
				die();
			}
		}
		echo $post['ID'];
	}
	else
		echo '0';

}

function ajax_get_post_by_category(){
	$cate_id = $_POST['cate_id'];
	$page = $_POST['page'];

	require_once('../models/mPost.php');
	$postModel = new mPost();

	$listPosts = $postModel->getPostByCategory($cate_id, ($page - 1) * 4, 4);
	foreach ($listPosts as $key => $post){ ?>
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
	<?php }
}

/*************
END POST
*************/

/*************
MENU
*************/

function ajax_save_menu_position($list_menu_item = array(), $parent_id = 0, $sort_order = 0){
	$nkdb = new Database();
	if(empty($list_menu_item)){
		$list_menu_item = $_POST['list_menu_item'];
		$list_menu_item = json_decode($list_menu_item);
	}
	foreach ($list_menu_item as $key => $item) {
		$nkdb->query("UPDATE menu  SET parent_id= '$parent_id', sort_order = '$sort_order' WHERE ID = '$item->id'");
		$sort_order++;
		if(!empty($item->children))
			ajax_save_menu_position($item->children, $item->id);
	}
}

function ajax_add_menu_item(){
	$nkdb = new Database();
	$title = $_POST['title'];
	$link = $_POST['link'];

	$sort_order = get_last_menu_item_info('sort_order') + 1;

	$nkdb->query("INSERT INTO menu (title, link, parent_id, sort_order, type) VALUES ('$title', '$link', '0', '$sort_order', 'link')");
	echo get_last_menu_item_info('ID');
}

function ajax_add_post_item_to_menu(){
	$nkdb = new Database();
	$list_post = $_POST['list_post'];
	foreach ($list_post as $key => $post_id) {
		$post = get_post_by_ID($post_id);
		$title = $post->post_title;
		$link = $post->ID;
		$type = $post->post_type;
		$sort_order = get_last_menu_item_info('sort_order') + 1;

		$nkdb->query("INSERT INTO menu (title, link, parent_id, sort_order, type) VALUES ('$title', '$link', '0', '$sort_order', '$type')");
		$id = get_last_menu_item_info('ID');
		?>
		<li id="item_in_menu_<?php echo $id ?>" class="dd-item dd3-item" data-id="<?php echo $id ?>">
			<div class="dd-handle dd3-handle"></div>
			<div data-toggle="collapse" data-target="#menu_item_<?php echo $id ?>" class="dd3-content menu_item_content"><span class="menu_item_title_<?php echo $id ?>"><?php echo $post->post_title ?></span><span class="pull-right"><i class="fa fa-angle-down"></i></span></div>
			<div id="menu_item_<?php echo $id ?>" class="collapse menu_item_box">
				<div id="custom_link">
					<div class="row">
						<div class="menu_item_title">
							<?php echo get_post_type_title($post->post_type) ?>: <?php echo $post->post_title; ?>
						</div>
					</div>
				</div>
				<div class="edit_menu_item_box">
					<button data-id="<?php echo $id ?>" class="btn btn-default delete_menu_item" onclick="delete_menu_item(this)">Xóa</button>
				</div>
			</div>
		</li>
		<?php }
	}

	function ajax_edit_menu_item(){
		$nkdb = new Database();
		$title = $_POST['title'];
		$link = $_POST['link'];
		$id = $_POST['id'];

		$nkdb->query("UPDATE menu  SET title= '$title', link = '$link' WHERE ID = '$id'");
		echo 1;
	}

	function ajax_delete_menu_item(){
		$nkdb = new Database();
		$id = $_POST['id'];

		$nkdb->query("DELETE FROM menu WHERE ID = '$id'");
		$query = $nkdb->query("SELECT * FROM menu WHERE parent_id = '$id'");
		while ($item = mysqli_fetch_array($query)) {
			$item_id = $item['ID'];
			$nkdb->query("UPDATE menu  SET parent_id= '0' WHERE ID = '$item_id'");
		}
		$query = $nkdb->query("SELECT * FROM menu WHERE ID = '$id'");
		if(mysqli_num_rows($query) < 1)
			echo 1;
		else echo 0;
		die();
	}

/*************
END MENU
*************/

/***********
CITY
***********/

function ajax_get_contries_city(){
	$city_name = $_POST['city_name'];
	echo json_encode(get_list_country_in_city($city_name));
	die();
}

/***********
END CITY
***********/

/**********
ORDER
**********/

function ajax_order_notification(){
	$nkdb = new Database();
	$num_order = $nkdb->query("SELECT * FROM orders WHERE accept_time = ''");
	echo mysqli_num_rows($num_order);
	die();
}

/**********
END ORDER
**********/

function ajax_get_post_type_info(){
	$id = $_POST['post_type_id'];
	$list_post_type = get_web_option('post_type');

	die(json_encode($list_post_type[$id]));
}

function ajax_get_category_info(){
	$id = $_POST['category_id'];
	$nkdb = new Database();
	$categoryInfo = $nkdb->getRow("SELECT title, slug FROM terms WHERE ID = '$id'");

	die(json_encode($categoryInfo));
}

function ajax_get_list_property_chose(){
	$id = $_POST['id'];
	$nkdb = new Database();
	$result = array();
	$result['html'] = '';
	$list_chose = $nkdb->getList("SELECT * FROM property_chose_value WHERE property = '$id'");
	foreach ($list_chose as $key => $chose){
	$result['html'] .= '<div id="chose-'.$key.'" class="chose-value" style="border: 1px solid rgba(120,130,140,.13); padding: 7.5px; margin-bottom: 15px">
		<div class="row">
			<div class="col-sm-5">
				<input type="text" class="form-control" name="chose-title-'.$key.'" placeholder="Tên lựa chọn" value="'.$chose['value'].'">
			</div>
			<div class="col-sm-5">
				<div class="input-group">
					<input type="number" class="form-control" name="chose-price-'.$key.'" placeholder="Giá" value="'.$chose['price'].'">
					<div class="input-group-addon">VNĐ</div>
				</div>
			</div>
			<div class="col-sm-2 text-center">
				<a href="javascript:void(0)" class="text-danger" style="line-height: 38px;" onclick="deleteChose(this)">Xóa</a>
			</div>
		</div>
	</div>';
	$result['chose_id'] = $key + 1;
	}
	$result['title'] = $nkdb->getRow("SELECT * FROM property WHERE ID='$id'")['name'];
	die(json_encode($result));
}

function ajax_save_list_property_chose(){
	$item_position = json_decode($_POST['item_position']);
	$nkdb = new Database();

	foreach ($item_position as $key => $value) {
		$nkdb->update('property', array('sort_order' => $key), "ID = '$value->id'");
	}

	echo 1;
}

function ajax_caculator_price_from_chose(){
	$list_chose = $_POST['list_chose'];
	$number = !empty($_POST['num-printcurcuit']) ? $_POST['num-printcurcuit'] : 1;

	$result = array();
	$nkdb = new Database();

	$price = 0;

	foreach ($list_chose as $key => $chose_id) {
		$price += $nkdb->getRow("SELECT * FROM property_chose_value WHERE ID = '$chose_id'")['price'];
	}

	$result['html'] = new Cost($price * $number);

	$result['html'] = $result['html']->__toString();

	$result['num'] = $price * $number;
	echo json_encode($result);
	die();
}

function ajax_add_printcurt_to_order(){ 
	$cur_num = $_POST['cur_num'];
	require_once('../models/mPrintCurcuit.php');
	$mPrintCurcuit = new mPrintCurcuit();
	$list_property = $mPrintCurcuit->listPropertiesWithChose();
?>
									<div class="col-sm-12 order-item" data-sort="<?php echo $cur_num + 1; ?>">
										<div class="order-item-title">
											<span>Mạch in <?php echo $cur_num + 1; ?></span>
											<button type="button" class="btn btn-secondary pull-right" onclick="delete_printcurcuit(this)">Xóa</button>
										</div>
										<div class=" form-group row">
											<label class="col-xs-2 col-form-label" for="name-printcurcuit-<?php echo $cur_num ?>"><b>Tên mạch</b></label>
											<div class="col-xs-10"><input type="text" id="name-printcurcuit-<?php echo $cur_num ?>" name="printcurcuit_<?php echo $cur_num ?>[name]" class="form-control"></div>
										</div>
										<div class=" form-group row">
											<label class="col-xs-2 col-form-label" for="num-printcurcuit-<?php echo $cur_num ?>"><b>Số lượng</b></label>
											<div class="col-xs-10"><input type="number" id="num-printcurcuit-<?php echo $cur_num ?>" name="printcurcuit_<?php echo $cur_num ?>[num]" class="form-control num-printcurcuit" value="1" onchange="change_price(this)"></div>
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
														<input type="radio" name="printcurcuit_<?php echo $cur_num ?>[property_<?php echo $property['ID'] ?>]" id="p_<?php echo $cur_num ?>_property_<?php echo $key.'_'.$property['ID'] ?>" class="property-value-<?php echo $cur_num ?>" value="<?php echo $chose_id ?>" onchange="change_price(this)" required>
														<label for="p_<?php echo $cur_num ?>_property_<?php echo $key.'_'.$property['ID'] ?>"><?php echo $chose_value ?></label>
													</div>
													<?php } ?>
												</div>
											</div>
										</div>
										<hr>
										<?php }} ?>
										<fieldset class="form-group" style="margin-bottom: 0">
											<b>Giá: </b>
											<span id="price-num-<?php echo $cur_num ?>">0<sup>đ</sup></span>
											<input type="hidden" name="printcurcuit_<?php echo $cur_num ?>[price-num]" class="price-num" value="0">
										</fieldset>
									</div>
<?php }

function ajax_delete_target(){
	$target = $_POST['target'];
	$target();
}

?>
