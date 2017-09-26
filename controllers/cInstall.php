<?php

/**
 * author Niku
 */

error_reporting(0);
class cInstall
{

	public function step1(){

		if(isset($_POST['db_submit'])){
			$db_name = $_POST['db_name'];
			$db_user = $_POST['db_user'];
			$db_pass = $_POST['db_pass'];
			$db_host = $_POST['db_host'];
			if(!empty($db_name) && !empty($db_user) && !empty($db_host)){
				require_once('models/mInstall.php');
				$model = new mInstall();

				$noti = $model->step1($db_host, $db_user, $db_pass, $db_name);
			}
		}

		require_once('views/nk-install.php');
	}

	public function step2(){
		if(isset($_POST['web-install'])){

			$domain = substr(current_url(),0, strrpos(current_url(), "/"));

			$title = $_POST['web-title'];
			$description = $_POST['web-description'];
			$email = $_POST['web-email'];

			$token = rand_key(12);
			$admin_name = $_POST['admin-name'];
			$admin_pass = $_POST['admin-pass'];
			$admin_displayname = $_POST['admin-displayname'];

			$admin_pass = sha1(sha1($token).sha1($admin_pass));
			$user_info = array(
				'username' => $admin_name,
				'password' => $admin_pass,
				'display_name' => $admin_displayname,
				'avatar' => $domain.'/images/avatar/default_user.png';
				'token_pass' => $token,
				'role' => 'admin'
				);

			require_once('models/mInstall.php');
			$model = new mInstall();
			$noti = $model->step2($user_info, $title, $description, $email, $domain);
			if(isset($_POST['step']))
				unset($_POST['step']);
		}
		require_once('views/nk-install.php');
	}
}

?>