<?php

/**
 * author Niku
 */

class cUser
{

	public function login(){
		$header = !empty($_GET['header']) ? $_GET['header'] : get_web_url();
		$header = my_urldecode($header);
		if(isset($_POST['user-login'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			require_once('models/mUser.php');
			$model = new mUser();
			$login_status = $model->login($username, $password);
			if($login_status === true){
				header('location: '.$header);
			}else{
				$error = 'Sai tên đăng nhập hoặc mật khẩu!';
			}
		}
		$page_title = 'Trang đăng nhập';
		require_once('views/user/login.php');
	}

	public function logout(){
		$header = !empty($_GET['header']) ? $_GET['header'] : get_web_url();
		$header = my_urldecode($header);
		if(is_user_logged_in()){
			require_once('models/mUser.php');
			$mUser = new mUser();
			$user = $mUser->getUser($_SESSION['user']);
			if(!empty($user['fb_id'])){
				unset_cookie(sha1(sha1(sha1('facebookSession'))));
			}
			unset($_SESSION['user']);
			unset($_SESSION['session_time_out']);
		}
		header('location: '.$header);
	}

	public function loginWithFacebook(){
		$header = !empty($_GET['header']) ? $_GET['header'] : my_urlencode(get_web_url());
		$fb = new Facebook\Facebook ([
			'app_id' => '484044788647869', 
			'app_secret' => '4d68219a98310f8f1f7cfd5605069c5f',
			'default_graph_version' => 'v2.2',
			]);

		$helper = $fb->getRedirectLoginHelper(get_web_url().'/login-with-facebook');

		try {
			$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
  		// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
  		// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		if (! isset($accessToken)) {
  	  		$permissions = array('public_profile','email'); // Optional permissions
  	  		$loginUrl = $helper->getLoginUrl(get_web_url().'/login-with-facebook?header='.$header, $permissions);
    		header("Location: ".$loginUrl);
    		exit;
		}

		try {
	  	// Returns a `Facebook\FacebookResponse` object
			$fields = array('id', 'name', 'email', 'gender');
			$response = $fb->get('/me?fields='.implode(',', $fields).'', $accessToken);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		$user = $response->getGraphUser();
		require_once('models/mUser.php');
		$model = new mUser();
		if($model->loginWithFacebook($user)){
			$cookieName = sha1(sha1(sha1('facebookSession')));
			setcookie(
				$cookieName,
				sha1(sha1(sha1($user['id']))),
				time() + (10 * 365 * 24 * 60 * 60),
				'/'
			);
			header('location: '.my_urldecode($header));
		}
	}

	public function register(){
		error_reporting(-1);
		$header = !empty($_GET['header']) ? $_GET['header'] : get_web_url();
		$header = my_urldecode($header);

		$userinfo = array();

		if(isset($_POST['user-register']) && $_POST['key_register'] == $_SESSION['key_register']){
			$userinfo['avatar'] = $_FILES['ava'];
			if(!empty($_POST['image_cropped']))
				$userinfo['avatar'] = $_POST['image_cropped'];
			$userinfo['username'] = $_POST['username'];
			$userinfo['password'] = $_POST['password'];
			$userinfo['display_name'] = $_POST['dpname'];
			$userinfo['email'] = $_POST['email'];
			$userinfo['sex'] = $_POST['sex'];
			$userinfo['birth_date'] = $_POST['birthdate'];

			require_once('models/mUser.php');
			$model = new mUser();
			$user_id = $model->addNew($userinfo);

			if($user_id !== false){
				header('location: '.$header);
			}else{
				$error_register = 'Đăng ký không thành công, hãy kiểm tra lại thông tin và thử lại sau!';
			}
		}
		$page_title = 'Trang đăng ký';
		$rand_key = rand_key(32);
		$_SESSION['key_register'] = $rand_key;
		require_once('views/user/register.php');
	}

	/********
	BACK END
	********/
	
	public function edit()
	{
		$user_id = $_GET['user_id'];
		$page_title = 'Chỉnh sửa tài khoản';
		$action = 'edit-user';

		require_once('models/mUser.php');
		$model = new mUser();

		if(isset($_POST['edit-user'])){
			$userinfo['avatar'] = $_FILES['ava'];
			if(!empty($_POST['image_cropped']))
				$userinfo['avatar'] = $_POST['image_cropped'];
			$userinfo['display_name'] = $_POST['dpname'];
			$userinfo['email'] = $_POST['email'];
			$userinfo['sex'] = $_POST['sex'];
			$userinfo['birth_date'] = $_POST['birthdate'];
			$userinfo['role'] = $_POST['role'];

			require_once('models/mUser.php');
			$model = new mUser();
			$user_id = $model->editUser($user_id, $userinfo);

			if($user_id !== false){
				header('location: '.current_url());
			}
		}

		if(isset($_POST['delete-user'])){
			$user_id = $_POST['delete-user'];
			if($model->deleteUser($user_id))
				header('location: '.get_admin_url().'/user/list');
		}

		$user_edit = $model->getUser($user_id);
		require_once('views/admin/user/edit.php');
	}

	public function addNew(){
		$page_title = 'Thêm tài khoản';
		$action = 'add-new-user';

		if(isset($_POST['add-new-user']) && $_POST['key_register'] == $_SESSION['key_register']){
			$userinfo['avatar'] = $_FILES['ava'];
			if(!empty($_POST['image_cropped']))
				$userinfo['avatar'] = $_POST['image_cropped'];
			$userinfo['username'] = $_POST['username'];
			$userinfo['password'] = $_POST['password'];
			$userinfo['display_name'] = $_POST['dpname'];
			$userinfo['email'] = $_POST['email'];
			$userinfo['sex'] = $_POST['sex'];
			$userinfo['birth_date'] = $_POST['birthdate'];
			$userinfo['role'] = $_POST['role'];

			require_once('models/mUser.php');
			$model = new mUser();
			$user_id = $model->addNew($userinfo);

			if($user_id !== false){
				header('location: '.get_admin_url().'/user/edit/'.$user_id);
			}else{
				$error_register = 'Đăng ký không thành công, hãy kiểm tra lại thông tin và thử lại sau!';
			}
		}
		$rand_key = rand_key(32);
		$_SESSION['key_register'] = $rand_key;
		require_once('views/admin/user/add-new.php');
	}

	public function listInAdmin(){
		$page_title = 'Danh sách tài khoản';
		$action = 'list-user';

		require_once('models/mUser.php');
		$model = new mUser();

		if(isset($_POST['delete-user'])){
			$user_id = $_POST['delete-user'];
			if($model->deleteUser($user_id))
				header('location: '.current_url());
		}

		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$num_per_page = 24;
		$limit = ($page - 1) * $num_per_page;
		$search = !empty($_GET['s']) ? $_GET['s'] : '';
		$list_user = $model->getListUser($limit, $num_per_page, $search);
		$total = $model->getNumUsers($search);

		$pagi = new pagination($total, $page, $num_per_page, 5);
		require_once('views/admin/user/list.php');
	}

}

?>