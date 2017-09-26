<?php

/**
 * author Niku
 */

require_once('libs/database.php');

class mInstall extends Database
{
	public function step1($db_host, $db_user, $db_pass, $db_name)
	{
		$this->__construct($db_host, $db_user, $db_pass, $db_name);
		$result = array();
		if(!$this->connect_error){
			$root_path = getcwd();
			$contents = "<?php\n\tdefine('db_name', '$db_name');\n\tdefine('db_user', '$db_user');\n\tdefine('db_pass', '$db_pass');\n\tdefine('db_host', '$db_host');\n\tdefine('root_path', '$root_path');\n?>";
			file_put_contents('nk-config.php', $contents);

			$result['step'] = 2;

			$table = $this->getRow("SELECT COUNT(DISTINCT `table_name`) FROM `information_schema`.`columns` WHERE `table_schema` = '$db_name'");
			if($table['COUNT(DISTINCT `table_name`)'] == 0){
				$this->insertDatabaseFile('libs/database.sql');
				$result['dbhastable'] = false;
			}else{
				$result['dbhastable'] = true;
			}
		}
		else $result['error'] = 'Kết nối không thành công :( Hãy kiểm tra lại thông tin!';

		return $result;
	}

	public function step2($user_info, $title, $description, $email, $domain){
		$noti = array();

		$this->insert('users', $user_info);

		$this->insert('options', array(
			'option_name' => 'web-domain',
			'option_value' => $domain
			));

		$this->insert('options', array(
			'option_name' => 'web-title',
			'option_value' => $title,
			));

		$this->insert('options', array(
			'option_name' => 'web-description',
			'option_value' => $description
			));

		$this->insert('options', array(
			'option_name' => 'web-email',
			'option_value' => $email
			));
		$noti['step'] = 4;

		return $noti;
	}
}

?>