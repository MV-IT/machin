<?php

/**
 * author Niku
 */
class cSetting
{
	public function postType()
	{
		$page_title = 'Các loại bài đăng';
		$action = "post-type-setting";

		if(isset($_POST['post-type-add'])){
			$post_type_title = !empty($_POST['post-type-title']) ? $_POST['post-type-title'] : '';
			$post_type_slug = !empty($_POST['post-type-slug']) ? $_POST['post-type-slug'] : make_slug($_POST['post-type-title']);

			if(empty($post_type_title))
				$add_error = 'Chưa điền tiêu đề!';
			else{
				require_once('models/mSetting.php');
				$model = new mSetting();
				$add_status = $model->add_post_type($post_type_title, $post_type_slug);
				if($add_status === true)
					header('location: '.current_url());
				else{
					$add_error = 'Không thể thêm loại bài đăng mới, hãy thử lại!';
				}
			}
		}

		if(isset($_POST['post-type-delete'])){
			$id = $_POST['post-type-delete'];

			require_once('models/mSetting.php');
			$model = new mSetting();
			$delete_status = $model->delete_post_type($id);
			if($delete_status !== false)
				header('location: '.current_url());
			else
				$delete_error = 'Xóa không thành công!';
		}

		if(isset($_POST['edit-post-type-submit'])){
			$post_type_id = $_POST['edit-post-type-submit'];
			$post_type_title = $_POST['edit-post-type-title'];
			$post_type_slug = $_POST['edit-post-type-slug'];

			require_once('models/mSetting.php');
			$model = new mSetting();

			$edit_status = $model->edit_post_type($post_type_id, $post_type_title, $post_type_slug);
			if($edit_status === false){
				$edit_error = 'Sửa không thành công!';
			}
		}

		$list_post_type = get_web_option('post_type');
		require_once('views/admin/setting/post-type.php');
	}

	public function indexOption(){
		$action = 'index-option';
		$page_title = 'Chỉnh sửa trang chủ';

		require_once('models/mSetting.php');

		$model = new mSetting();

		if(isset($_POST['update']) && $_SESSION['key_update'] == $_POST['key_update']){
			$listOption = array();
			//Slider
			foreach ($_POST as $key => $value) {
				if(strpos($key, "slider-item-link-") !== false){
					$id = preg_replace('/[^0-9]/', '', $key);
					$link = $_POST['slider-item-link-'.$id];
					$src = $_POST['slider-item-file-url-'.$id];
					$file = $_FILES['slider-item-file-'.$id];
					if(!empty($file['name'])){
						$src = save_file_upload($file, 'slider');
						$src = get_image_url($src, 'slider');
					}
					if(!empty($link) && !empty($src))
						$slider_items[] = array(
							'link' => $link,
							'src' => $src
							);
				}
			}
			$listOption['index_slider'] = $slider_items;
			$listOption['index_video'] = $_POST['videoLink'];
			$model->updateIndexOption($listOption);
		}

		$rand_key = rand_key();
		$_SESSION['key_update'] = $rand_key;

		require_once('views/admin/index_option.php');
	}
}

?>