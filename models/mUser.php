<?php

/**
 * author Niku
 */

class mUser extends Database
{
	public function login($username, $password)
	{
		$username = $this->escape_string($username);
		$password = $this->escape_string($password);
		$user_num = $this->getNumRows("SELECT * FROM users WHERE username = '$username'");
		if($user_num < 1){
			return false;
		}
		$user = $this->getRow("SELECT * FROM users WHERE username = '$username'");
		$password = sha1(sha1($password).sha1($user['token_pass']));
		if($password == $user['password']){
			if(session_status() == PHP_SESSION_NONE){
				session_start();
			}
			$_SESSION['user'] = $user['ID'];
			$_SESSION['session_time_out'] = time() + 10800;
			return true;
		}
	}

	public function loginWithFacebook($user){
		$fb_id = $user['id'];
		$cookieName = sha1(sha1(sha1('facebookSession')));
		$fb_id = $this->escape_string($fb_id);
		if(is_fb_user_exists($fb_id)){
			if(empty($_COOKIE[$cookieName]) || $_COOKIE[$cookieName] == sha1(sha1(sha1($fb_id)))){
				$user_id = $this->getRow("SELECT ID FROM users WHERE fb_id = '$fb_id'");
				$_SESSION['user'] = $user_id['ID'];
				$_SESSION['session_time_out'] = time() + 10800;
				return true;
			}
		}else if(empty($_COOKIE[$cookieName])){
			$password =rand_key(12);
			$token_pass = rand_key(12);
			$password =sha1(sha1($password).sha1($token_pass));
			$userinfo = array(
				'username' => make_slug($user['name']),
				'display_name' => $user['name'],
				'fb_id' => $user['id'],
				'email' => $user['email'],
				'password' => $password,
				'token_pass' => $token_pass
				);
			$userinfo['sex'] = $user['gender'] == 'male' ? 'Nam' : 'Nữ';
			if($this->insert('users', $userinfo)){
				$user = $this->getRow("SELECT ID FROM users WHERE fb_id = '$fb_id'");
				$_SESSION['user'] = $user['ID'];
				$_SESSION['session_time_out'] = time() + 10800;
				return true;
			}
			return false;
		}
	}

	public function addNew($userinfo){
		$token = rand_key(12);
		$userinfo['password'] = sha1(sha1($userinfo['password']).sha1($token));
		$userinfo['token_pass'] = $token;

		if(empty($userinfo['role']))
			$userinfo['role'] = 'user';

		if(user_exists($userinfo['username'])  || is_email_exists($userinfo['email'])){
			return false;
		}

		if(!empty($userinfo['avatar']['name']))
			$avaname = save_file_upload($userinfo['avatar'], 'avatar');
		else if(!is_array($userinfo['avatar'])){
			$avaname = save_file_from_data_url($userinfo['avatar'], 'avatar');
		}else{
			$avaname = 'default_user.png';
		}

		$avalink = '/images/avatar/'.$avaname;
		$userinfo['avatar'] = $avalink;

		//If user isn't exists insert new
		$this->insert('users', $userinfo);

		//Check insert successful
		$check_user = $this->query("SELECT ID FROM users WHERE username = '".$userinfo['username']."'");
		if(mysqli_num_rows($check_user) > 0){
			$user = mysqli_fetch_assoc($check_user);
			return $user['ID'];
		}
		return false;
	}

	public function getListUser($limit, $num_per_page, $s){
		$sql = "SELECT * FROM users";

        $limit = (int)$limit;
        $num_per_page = (int)$num_per_page;
        
        if(!empty($s)){
            $s = $this->escape_string($s);
            $sql .= " WHERE display_name LIKE '%$s%' OR email LIKE '%$s%' OR username LIKE '%$s%' ORDER BY ID DESC";
        }
        $sql .= " LIMIT $limit, $num_per_page";
        return $this->getList($sql);
	}

	public function getNumUsers($s){
		$sql = "SELECT * FROM users";
        
        if(!empty($s)){
            $s = $this->escape_string($s);
            $sql .= " WHERE display_name LIKE '%$s%' OR email LIKE '%$s%' OR username LIKE '%$s%' ORDER BY ID DESC";
        }
        return $this->getNumRows($sql);
	}

	public function getUser($user_id){
		return $this->getRow("SELECT * FROM users WHERE ID = '$user_id'");
	}

	public function getUserAvatar($user_id){
		return $this->getRow("SELECT avatar FROM users WHERE ID = '$user_id'")['avatar'];
	}

	public function editUser($user_id, $userinfo){

		if(!empty($userinfo['avatar']['name']))
			$avaname = save_file_upload($userinfo['avatar'], 'avatar');
		else if(!is_array($userinfo['avatar']) && !empty($userinfo['avatar'])){
			$avaname = save_file_from_data_url($userinfo['avatar'], 'avatar');
		}else{
			$userinfo['avatar'] = $this->getUserAvatar($user_id);
		}

		return $this->update('users', $userinfo, "ID = '$user_id'");
	}

	public function deleteUser($user_id){
		$avaname = basename($this->getUserAvatar($user_id));
		delete_file($avaname, 'avatar');
		return $this->deleteRow('users', "ID = '$user_id'");
	}
}

?>