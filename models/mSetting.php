<?php

/**
 * author Niku
 */
class mSetting extends Database
{
	public function add_post_type($post_type_title, $post_type_slug)
	{
		$num = $this->getNumRows("SELECT * FROM options WHERE option_name = 'post_type'");
		if($num > 0){
			$list_post_type = get_web_option('post_type');
			if(empty($list_post_type))
				$list_post_type = array();
			array_push($list_post_type, array($post_type_title, $post_type_slug));
		}else{
			$list_post_type[] = array($post_type_title, $post_type_slug);
		}
		return update_option('post_type', $list_post_type);
	}

	public function delete_post_type($id){
		if(isset($id) && !is_numeric($id))
			return false;
		$list_post_type = get_web_option('post_type');
		unset($list_post_type[$id]);

		return isset($list_post_type[$id]) ? false : update_option('post_type', $list_post_type);
	}

	public function edit_post_type($post_type_id, $post_type_title, $post_type_slug){
		$list_post_type = get_web_option('post_type');
		$post_posttype = $list_post_type[$post_type_id][1];
		$this->update('posts', array('post_type' => $post_type_slug), "post_type = '$post_posttype'");

		$list_post_type[$post_type_id][0] = $post_type_title;
		$list_post_type[$post_type_id][1] = $post_type_slug;

		return update_option('post_type', $list_post_type);
	}

	public function updateOption($listOption){
		foreach ($listOption as $optionName => $optionValue){
			if(!is_string($optionValue))
				$optionValue = serialize($optionValue);

			if(get_web_option($optionName) !== false){
				$this->update('options', array(
					'option_value' => $optionValue
					), "option_name = '$optionName'");
			}
			else{
				$this->insert('options', array(
					'option_name' => $optionName,
					'option_value' => $optionValue
					));
			}
		}
	}

	public function updateIndexOption($listOption)
	{
		return $this->updateOption($listOption);
	}

	public function updateGeneralOption($optionValue)
	{
		return $this->updateOption($optionValue);
	}

	public function updateHeaderOption($listOption)
	{
		foreach ($_FILES as $key => $file) {
			if(!empty($file['name'])){
				$fileName = save_file_upload($file, 'theme');
				if(get_web_option("$key") !== false){
					delete_file(get_web_option($key), 'theme');
					if(!$this->update('options', array('option_value' => $fileName), "option_name = '$key'"))
						die(mysqli_error($this->getConn()));
				}
				else{
					$this->insert('options', array('option_name' => $key, 'option_value' => $fileName));
				}
			}
		}

		return $this->updateOption($listOption);
	}
}

?>