<?php 

require 'class.php';

function get_current_user_info(){
	$nkdb = new Database();
	$user = $_SESSION['user'];
	$user_info = $nkdb->getRow("SELECT * FROM users WHERE ID='$user'");
	$user = $user_info;
	
	return new User($user);
}

function is_user_logged_in(){
	if(!empty($_SESSION['user']))
		return true;
	return false;
}

function is_admin(){
	if(!is_user_logged_in())
		return false;
	$user = get_current_user_info();
	if($user->role == 'admin')
		return true;
	return false;
}

function is_editor(){
	if(!is_user_logged_in())
		return false;
	$user = get_current_user_info();
	if($user->role == 'editor')
		return true;
	return false;
}

function get_user_by_ID($id){
	$nkdb = new Database();
	$id = (string)(int)$id;
	$id = preg_replace('/[^0-9]/', '', $id);
	$id = $nkdb->escape_string($id);
	$user = $nkdb->getRow("SELECT * FROM users WHERE ID='$id'");
	
	return new User($user);
}

function destroy_session(){
	if(isset($_SESSION['user']) && $_SESSION['user'] != '')
		unset($_SESSION['user']);
}

function logout_user_after_timeout_session(){
	if(!empty($_SESSION['user']))
		if(time() >= $_SESSION['session_time_out']){
			unset($_SESSION['user']);
			unset($_SESSION['session_time_out']);
		}
}

function increase_timeout_session(){
	if(!empty($_SESSION['user']))
		$_SESSION['session_time_out'] = time() + 10800;
}

function get_user_avatar_link($id){
	$nkdb = new Database();
	$user_info = $nkdb->query("SELECT avatar, fb_id FROM users WHERE ID='$id'");
	$user = mysqli_fetch_array($user_info);
	if(empty($user['fb_id'])){
		$avatar_file_name = $user['avatar'];
		$link = get_web_url().$avatar_file_name;
	}else{
		$link = 'https://graph.facebook.com/'.$user['fb_id'].'/picture?type=normal';
	}
	return $link;
}

function user_exists($username){
	$nkdb = new Database();
	$user = $nkdb->query("SELECT ID FROM users WHERE username = '$username'");
	if(mysqli_num_rows($user) > 0)
		return true;
	return false;
}

function is_email_exists($email, $type='users'){
	$nkdb = new Database();
	$email = $nkdb->escape_string($email);
	$query = $nkdb->query("SELECT email FROM $type WHERE email = '$email' LIMIT 0, 1");
	if(mysqli_num_rows($query) > 0)
		return true;
	return false;
}

function is_fb_user_exists($fb_id){
	$nkdb = new Database();
	$fb_id = $nkdb->escape_string($fb_id);
	$query = $nkdb->query("SELECT fb_id FROM users WHERE fb_id = '$fb_id'");
	if(mysqli_num_rows($query) > 0)
		return true;
	return false;
}

function is_email($email){
	if(strpos($email, '@') !== false)
		return true;
	return false;
}

function is_user_facebook_logged_in(){
	$cookieName = sha1(sha1(sha1('facebookSession')));
	if(isset($_COOKIE[$cookieName])){
		return empty($_SESSION['user']) ? true : false;
	}
	return false;
}

function get_current_user_profile_link($user_id){
	return get_web_url().'/user-profile'.$user_id;
}

?>