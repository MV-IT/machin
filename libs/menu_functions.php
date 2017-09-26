<?php
/********
ADMIN
********/

function is_menu_item_has_child($ID){
	$nkdb = new Database();
	$child_query = $nkdb->query("SELECT * FROM menu WHERE parent_id = '$ID'");
	if(mysqli_num_rows($child_query) > 0)
		return true;
	return false;
}

function get_menu_items($parent_id = 0){
	$nkdb = new Database();
	$list_item_query = $nkdb->query("SELECT * FROM menu WHERE parent_id = '$parent_id'");
	while($item = mysqli_fetch_array($list_item_query)){
		$list_item[] = $item;
	}
	if(empty($list_item))
		return array();
	$num_items = count($list_item);
	for($i = 0; $i < $num_items; $i++) {
		if(is_menu_item_has_child($list_item[$i]['ID']))
			$list_item[$i]['children'] = get_menu_items($list_item[$i]['ID']);
	}

	return $list_item;
}

function display_menu_html_in_admin($parent_id = 0){ 
	$nkdb = new Database();

	$list_item_query = $nkdb->query("SELECT * FROM menu WHERE parent_id = '$parent_id' ORDER BY sort_order"); ?>
<ol <?php if($parent_id == 0) echo 'id="menu_list_item"'; ?> class="dd-list">
	<?php while($item = mysqli_fetch_array($list_item_query)){
		$list_item[] = $item;
	}
	if(empty($list_item))
		return ''; ?>
	<?php 
	$num_items = count($list_item);
	for($i = 0; $i < $num_items; $i++) { ?>
		<li id="item_in_menu_<?php echo $list_item[$i]['ID'] ?>" class="dd-item dd3-item" data-id="<?php echo $list_item[$i]['ID'] ?>">
            <div class="dd-handle dd3-handle"></div>
            <div data-toggle="collapse" data-target="#menu_item_<?php echo $list_item[$i]['ID'] ?>" class="dd3-content menu_item_content"><span class="menu_item_title_<?php echo $list_item[$i]['ID'] ?>"><?php echo $list_item[$i]['title'] ?></span><span class="pull-right"><i class="fa fa-angle-down"></i></span></div>
            				<div id="menu_item_<?php echo $list_item[$i]['ID'] ?>" class="collapse menu_item_box">
                                <div id="custom_link">
                                	<?php if(strpos($list_item[$i]['link'], 'http') !== false || strpos($list_item[$i]['link'], '#') !== false){ ?>
                                    <div class="row">
                                        <div class="col-sm-2 menu_item_title">
                                            Tiêu đề:
                                        </div>
                                        <div class="input-group col-sm-10">
                                            <input id="input_menu_item_title_<?php echo $list_item[$i]['ID'] ?>" type="text" class="form-control" value="<?php echo $list_item[$i]['title'] ?>">
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 7.5px">
                                        <div class="col-sm-2 menu_item_title">
                                            Liên kết:
                                        </div>
                                        <div class="input-group col-sm-10">
                                            <input id="input_menu_item_link_<?php echo $list_item[$i]['ID'] ?>" type="link" class="form-control" value="<?php echo $list_item[$i]['link'] ?>">
                                        </div>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="row">
                                        <div class="menu_item_title">
                                            <?php echo get_post_type_title($list_item[$i]['type']) ?>: <?php 
                                             $post = get_post_by_ID($list_item[$i]['link']);
                                             if(!empty($post->post_title))
	                                             echo $post->post_title;
	                                         else echo '<span class="text-danger">'.get_post_type_title($list_item[$i]['type']).' không tồn tại!</span>'
                                             ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="edit_menu_item_box">
                                	<button data-id="<?php echo $list_item[$i]['ID'] ?>" class="btn btn-default delete_menu_item" onclick="delete_menu_item(this)">Xóa</button>
                                	<?php if(strpos($list_item[$i]['link'], 'http') !== false || strpos($list_item[$i]['link'], '#') !== false){ ?>
                                    <button data-id="<?php echo $list_item[$i]['ID'] ?>" class="btn btn-info edit_menu_item" onclick="edit_menu_item(this)">Cập nhật</button>
                                    <?php } ?>
                                </div>
                            </div>
		<?php if(is_menu_item_has_child($list_item[$i]['ID']))
			display_menu_html_in_admin($list_item[$i]['ID']); ?>
		</li>
	<?php } ?>
</ol>

<?php }

function get_last_menu_item_info($type = 'ID'){
	$nkdb = new Database();

	$query = $nkdb->query("SELECT * FROM menu ORDER BY $type DESC LIMIT 0, 1");
	$item = mysqli_fetch_array($query);
	return $item[$type];
}

function get_list_post_checkbox($post_type, $post_type_title){
	$nkdb = new Database();

	$query = $nkdb->query("SELECT * FROM posts WHERE post_type = '$post_type' ORDER BY ID");
	if(mysqli_num_rows($query) > 0){
		while($post = mysqli_fetch_array($query)){ ?>
			<div class="checkbox checkbox-info page_item_line">
				<input type="checkbox" id="page_item_<?php echo $post['ID'] ?>" name="<?php echo $post_type ?>_item" value="<?php echo $post['ID'] ?>"><label for="page_item_<?php echo $post['ID'] ?>"> <?php echo $post['post_title'] ?></label>
			</div>
		<?php }
	}else {
		echo '<b>Không có '.strtolower($post_type_title).' nào!</b>';
	}
		
}

/********
FRONT END
********/

function display_menu_item_in_front_end($parent_id = 0, $item_type = 0){
	$nkdb = new Database();
	if($item_type == 0)
		$class_ul = 'text-center';
	else
		$class_ul = 'sub_menu_type'.$item_type;

	$query_item = $nkdb->query("SELECT * FROM menu WHERE parent_id = '$parent_id' ORDER BY sort_order ASC"); ?>
	<ul class="<?php echo $class_ul; ?>">
	<?php if($item_type == 0){ ?>
	<li> <a href="<?php echo get_web_url(); ?>">Trang chủ</a></li>
	<?php } ?>
	<?php while($item = mysqli_fetch_array($query_item)){
		if(is_numeric($item['link']))
			$link_item = get_page_permalink($item['link']);
		else
			$link_item = $item['link'];
	?>
							<li>
								<a href="<?php echo $link_item ?>"><?php echo $item['title'] ?>
									<?php if(is_menu_item_has_child($item['ID'])){ 
										if(is_first_level_item($item['ID'])){ ?>
									<span class="fa fa-angle-down hidden-xs"></span>
									<?php }else{ ?>
									<span class="fa fa-angle-right hidden-xs"></span>
								<?php }} ?>
								</a>
								<?php if(is_menu_item_has_child($item['ID'])){
									if(is_first_level_item($item['ID'])){
										display_menu_item_in_front_end($item['ID'], 1); ?>
										<span class="fa fa-angle-right pull-right visible-xs menu_item_toggle"></span>
									<?php }else{
										display_menu_item_in_front_end($item['ID'], ++$item_type); ?>
										<span class="fa fa-angle-right pull-right visible-xs menu_item_toggle"></span>
									<?php }
								} ?>
							</li>
<?php } ?>
	<?php if($item_type == 0){ ?>
	<li class="search-item text-center hidden-xs"><button class="btn" data-toggle="collapse" data-target="#search-box-desktop" aria-expanded="false" aria-controls="search-box-desktop"><i class="fa fa-search"></i></button></li>
	<?php } ?>
	</ul>
	<?php if($item_type == 0){ ?>
	<div class="collapse hidden-xs search-box" id="search-box-desktop">
		<div class="card card-block">
			<form action="<?php echo get_web_url() ?>/tim-kiem" method="get">
				<input type="search" name="search" class="form-control form-control-success">
				<button class="btn btn-success btn-search"><i class="fa fa-search"></i></button>
				<p style="margin: 10px 0 0px 0;"><b>Tìm:</b></p>
				<label class="text-normal-weight"><input type="radio" name="search-type" value="all" class="m-radio radio-success" checked> Tất cả</label>
				<label class="text-normal-weight"><input type="radio" name="search-type" value="product" class="m-radio radio-success"> Sản phẩm</label>
				<label class="text-normal-weight"><input type="radio" name="search-type" value="service" class="m-radio radio-success"> Dịch vụ</label>
				<label class="text-normal-weight"><input type="radio" name="search-type" value="news" class="m-radio radio-success"> Tin tức</label>
			</form>
		</div>
	</div>
	<?php } ?>
<?php }

function is_first_level_item($id){
	$nkdb = new Database();
	$query = $nkdb->query("SELECT * FROM menu WHERE parent_id = '0' AND ID='$id'");
	if(mysqli_num_rows($query) > 0)
		return true;
	return false;
}

?>