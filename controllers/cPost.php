<?php

/**
* author Niku
*/
class cPost
{

	/********
	ADMIN
	********/

	public function listInAdmin(){
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$num_per_page = 24;

		$post_type_slug = $_GET['post_type'];
		$list_post_type = get_web_option('post_type');
		foreach($list_post_type as $post_type){
			if($post_type[1] === $post_type_slug){
				$post_type_title = $post_type[0];
				break;
			}
		}
		$page_title = 'Danh sách '.strtolower($post_type_title);
		$action = 'list-'.$post_type_slug;
		require_once('models/mPost.php');
		$model = new mPost();

		if (isset($_POST['delete-post'])) {
			$post_id = $_POST['delete-post'];
			if($model->deletePost($post_id))
				header('location: '.current_url());
		}

		$limit = ($page - 1) * $num_per_page;

		$search = !empty($_GET['s']) ? $_GET['s'] : '';

		$list_post = $model->listPost($post_type_slug, $limit, $num_per_page, $search);

		$total = $model->numAllPost($post_type_slug, $search);

		$pagi = new pagination($total, $page, $num_per_page, 5);
		require_once('views/admin/post/list.php');
	}

	public function addNew(){
		$post_type_slug = $_GET['post_type'];
		$list_post_type = get_web_option('post_type');
		foreach($list_post_type as $post_type){
			if($post_type[1] === $post_type_slug){
				$post_type_title = $post_type[0];
				break;
			}
		}
		$page_title = 'Thêm '.strtolower($post_type_title).' mới';
		$action = 'add-new-'.$post_type_slug;
		require_once('models/mPost.php');
		$model = new mPost();
		$listCategories = $model->getListCategories($post_type_slug);
		require_once('views/admin/post/add_new.php');
	}

	public function editPost(){
		$post_type_slug = $_GET['post_type'];
		$list_post_type = get_web_option('post_type');
		foreach($list_post_type as $post_type){
			if($post_type[1] === $post_type_slug){
				$post_type_title = $post_type[0];
				break;
			}
		}

		$post_id = $_GET['post_id'];
		$page_title = 'Chỉnh sửa '.$post_type_title;
		$action = 'edit-'.$post_type_slug;
		require_once('models/mPost.php');
		$model = new mPost();
		if (isset($_POST['delete-post'])) {
			$post_id = $_POST['delete-post'];
			if($model->deletePost($post_id))
				header('location: '.get_web_url().'/admin/post/'.$post_type_slug.'/	list');
		}
		$post = $model->getPost($post_id);
		if($post === false){
			header('location: '.get_web_url().'/admin/post/'.$post_type_slug.'/	list');
		}
		$listCategories = $model->getListCategories($post_type_slug);
		$listPostCategories = $model->getListPostCategories($post->ID);
		$author = get_user_by_ID($post->post_author);
		require_once('views/admin/post/edit-post.php');
	}

	public function editCategory(){
		$post_type_slug = $_GET['post_type'];
		$list_post_type = get_web_option('post_type');
		foreach($list_post_type as $post_type){
			if($post_type[1] === $post_type_slug){
				$post_type_title = $post_type[0];
				break;
			}
		}

		require_once('models/mPost.php');
		$model = new mPost();

		if(isset($_POST['add-category'])){
			$cate_title = $_POST['cate_title'];
			$cate_slug = !empty($_POST['cate_slug']) ? $_POST['cate_slug'] : make_slug($cate_title);
			if(!$model->addNewCategory($cate_title, $cate_slug, $post_type_slug))
				$add_error = 'Lỗi! Không thêm được!';
		}

		if(isset($_POST['edit-category-submit'])){
			$cate = array();
			$cate_id = $_POST['edit-category-submit'];
			$cate['slug'] = $_POST['edit-category-slug'];
			$cate['title'] = $_POST['edit-category-title'];
			if(!$model->editCategory($cate, $cate_id))
				$edit_error = 'Lỗi! Không cập nhật được danh mục!';
		}

		if(isset($_POST['category-delete'])){
			$cate_id = $_POST['category-delete'];

			if(!$model->deleteCategory($cate_id))
				$delete_error = 'Lỗi! Không thể xóa danh mục!';
		}

		$listCategories = $model->getListCategories($post_type_slug);

		$page_title = 'Danh mục '.strtolower($post_type_title);
		$action = 'edit-post-category';
		require_once('views/admin/post/edit-category.php');
	}

	/*********
	FRONT END
	*********/
	public function listInFrontEnd(){
		$post_type_slug = $_GET['post_type'];
		$list_post_type = get_web_option('post_type');
		foreach($list_post_type as $post_type){
			if($post_type[1] === $post_type_slug){
				$post_type_title = $post_type[0];
				break;
			}
		}

		require_once('models/mPost.php');
		$model = new mPost();

		$listLastestPost = $model->getListLastestPost($post_type_slug);
		$listCategories = $model->getListCategories($post_type_slug);
		$listRandomPosts = $model->getListRandomPosts($post_type_slug);
		$page_title = 'Danh sách '.strtolower($post_type_title);
		$action = 'list-post';
		require_once('views/post/index.php');
	}

	public function showPost()
	{
		require_once('models/mPost.php');
		$url = $_GET['url'];
		$model = new mPost();
		$post = $model->getPostByUrl($url);

		$post_type_slug = $post['post_type'];
		$list_post_type = get_web_option('post_type');
		foreach($list_post_type as $post_type){
			if($post_type[1] === $post_type_slug){
				$post_type_title = $post_type[0];
				break;
			}
		}

		$listRandomPosts = $model->getListRandomPosts($post_type_slug);

		$action = 'show-post';
		$page_title = $post['post_title'];
		require_once('views/post/show.php');
	}
}

?>