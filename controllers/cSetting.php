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
			$listOption['index_post_type'] = $_POST['index_post_type'];
			$listOption['index_video'] = $_POST['videoLink'];
			$model->updateIndexOption($listOption);
		}

		$rand_key = rand_key();
		$_SESSION['key_update'] = $rand_key;

		require_once('views/admin/index_option.php');
	}

	public function generalOption()
	{
		if(isset($_POST['update_setting'])){

			$listOption['web-phone'] = !empty($_POST['web-phone']) ? $_POST['web-phone'] : '';
			
			$listOption['web-email'] = !empty($_POST['web-email']) ? $_POST['web-email'] : '';
			
			$listOption['web-youtube_social'] = $_POST['web-youtube_social'];
			$listOption['web-facebook_social'] = !empty($_POST['web-facebook_social']) ? $_POST['web-facebook_social'] : '';
			$listOption['web-twitter_social'] = !empty($_POST['web-twitter_social']) ? $_POST['web-twitter_social'] : '';
			$listOption['web-title'] = !empty($_POST['web-title']) ? $_POST['web-title'] : '';
			
			$listOption['web-domain'] = !empty($_POST['web-domain']) ? $_POST['web-domain'] : '';
			
			$listOption['web-description'] = !empty($_POST['web-description']) ? $_POST['web-description'] : '';
			$listOption['web-gmap'] = !empty($_POST['web-gmap']) ? $_POST['web-gmap'] : '';

			$listOption['web-address'] = !empty($_POST['address_1']) ? $_POST['address_1'].'/'.get_country_by_ID($_POST['address_3']).'/'.get_city_by_ID($_POST['address_2']) : '';

			require 'models/mSetting.php';
			$model = new mSetting();
			if($model->updateGeneralOption($listOption))
				header('location: '.current_url());
		}

		$address = array_address_from_string(get_web_option('web-address'));
		$action = 'general-setting';
		$page_title = 'Thông tin chung';
		require 'views/admin/setting/general.php';
	}

	public function themeHeaderOption()
	{
		if(isset($_POST['save-header-option']) && $_POST['key_update'] == $_SESSION['key_update']){
			require 'models/mSetting.php';
			$model = new mSetting();

			$listOption['web-header-title'] = $_POST['header-title'];
			$listOption['web-header-description'] = $_POST['header-description'];
			$listOption['web-header-phone'] = $_POST['header-phone'];
			$listOption['web-header-email'] = $_POST['header-email'];

			if($model->updateHeaderOption($listOption, $_FILES))
				header('location: '.current_url());
		}
		$rand_key = rand_key();
		$_SESSION['key_update'] = $rand_key;
		$action = 'theme-header-option';
		$page_title = 'Chỉnh sửa đầu trang giao diện';
		require 'views/admin/setting/theme-header.php';
	}
}

?>