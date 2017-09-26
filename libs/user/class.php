<?php 
	
	/**
	* author Niku
	*/
	class User
	{
		public $ID;
		public $username;
		public $display_name;
		public $email;
		public $birth_date;
		public $sex;
		public $role;
		public $avatar;
		public $address;
		public $phone;

		function __construct($user_info)
		{
			$this->ID = $user_info['ID'];
			$this->username = $user_info['username'];
			$this->display_name = $user_info['display_name'];
			$this->email = $user_info['email'];
			$this->birth_date = $user_info['birth_date'];
			$this->sex = $user_info['sex'];
			$this->role = $user_info['role'];
			$this->avatar = $user_info['avatar'];
			$this->address = $user_info['address'];
			$this->phone = $user_info['phone'];
		}

		public function get_avatar_url(){
			return $this->avatar;
		}
	}

 ?>