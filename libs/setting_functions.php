<?php

function get_web_option($option_name){
	$nkdb = new Database();;
	$query = $nkdb->query("SELECT * FROM options WHERE option_name = '$option_name'");
	if(mysqli_num_rows($query) > 0){
		$value = mysqli_fetch_array($query)['option_value'];
		if(is_serialized($value) !== false)
			return unserialize($value);
		return $value;
	}else{
		return false;
	}
	return '';
}

?>