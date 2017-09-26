<?php

/**
 * author Niku
 */

class cMenu
{

	public $firstLevelClassName = 'list-menu';
	public $firstLevelItem = 'item-menu';
	public $secondLevelClassName = 'sub-list-menu_1';
	public $secondLevelItem = 'sub-item-menu_1';
	public $thirdLevelClassName = 'sub-list-menu_n';
	public $thirdLevelItem = 'sub-item-menu_n';
	public $itemHasChild = 'has-child-menu';

    public function edit()
    {
    	$page_title = 'Chỉnh sửa menu';
    	$action = 'theme-edit-menu';
    	$list_post_type = get_web_option('post_type');
        require_once('views/admin/menu.php');
    }

    public function showMenuInFrontEnd($parent_id = 0, $item_level = 0, $rand = ''){

    	file_exists('../models/mMenu.php') ? require_once('../models/mMenu.php') : require_once('models/mMenu.php');

		$mMenu = new mMenu();

    	$listMenuItem = $mMenu->getListItem($parent_id);
    	if($item_level == 0){
    		$class_ul = $this->firstLevelClassName;
    		$class_li = $this->firstLevelItem;
    		$class_ul_next = $this->secondLevelClassName;
    		$class_collapse = '';
    	}
    	else if($item_level == 1){
    		$class_ul = $this->secondLevelClassName;
    		$class_li = $this->secondLevelItem;
    		$class_ul_next = $this->thirdLevelClassName;
    		$class_collapse = ' collapse';
    	}
    	else if($item_level == 2){
    		$class_ul = $this->thirdLevelClassName;
    		$class_li = $this->thirdLevelItem;
    		$class_collapse = ' collapse';
    	} ?>
		<ul id="<?php echo $class_ul.'-'.$item_level.'-'.$rand; ?>" class="<?php echo $class_ul.$class_collapse ?>">
    	<?php foreach ($listMenuItem as $k => $item){ 
    		if($mMenu->itemHasChild($item['ID']))
    			$class_li .= ' '.$this->itemHasChild;
    	?>
    		<li class="<?php echo $class_li ?>">
    			<?php if($item['type'] == 'link'){ ?>
				<a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a>
    			<?php }else{ 

    				file_exists('../models/mPost.php') ? require_once('../models/mPost.php') : require_once('models/mPost.php');
    				$mPost = new mPost();

    				$post = $mPost->getPost($item['link']);
				?>

    			<a href="<?php echo get_post_permalink($post->ID) ?>"><?php echo $post->post_title ?></a>
    			
    			<?php }
    			if($mMenu->itemHasChild($item['ID'])){ $rand = rand_key(); ?>
				<a data-toggle="collapse" href="#<?php echo $class_ul_next.'-'.++$item_level.'-'.$rand ?>" class="icon-sub">»</a>
    				<?php $this->showMenuInFrontEnd($item['ID'], $item_level, $rand);
    			}
    			?>
    		</li>
    	<?php } ?>
    	</ul>
    <?php }
}

?>