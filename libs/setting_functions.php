<?php

function get_web_option($option_name){
	$nkdb = new Database();;
	$query = $nkdb->query("SELECT * FROM options WHERE option_name = '$option_name'");
	if(mysqli_num_rows($query) > 0){
		$value = mysqli_fetch_array($query)['option_value'];
		if(unserialize($value) !== false)
			return unserialize($value);
		return $value;
	}else{
		return false;
	}
	return '';
}

function update_all_option($domain, $title, $description, $gmap, $address, $phone, $email, $yt, $fb, $tt){
	update_option('domain', $domain);
	update_option('title', $title);
	update_option('description', $description);
	update_option('gmap', $gmap);
	update_option('address', $address);
	update_option('phone', $phone);
	update_option('email', $email);
	update_option('youtube_social', $yt);
	update_option('facebook_social', $fb);
	update_option('twitter_social', $tt);
}

function update_option($option, $value){
	$nkdb = new Database();;
	$option = $nkdb->escape_string($option);
	if(is_string($value))
		$value = $nkdb->escape_string($value);
	else
		$value = serialize($value);
	$num_option = $nkdb->query("SELECT * FROM options WHERE option_name = '$option'");
	if(mysqli_num_rows($num_option) > 0){
		$nkdb->query("UPDATE options SET option_value = '$value' WHERE option_name = '$option'");
	}else{
		$nkdb->query("INSERT INTO options (option_name, option_value) VALUES ('$option', '$value')");
	}

	$num_option = $nkdb->query("SELECT * FROM options WHERE option_name = '$option'");
	if(mysqli_num_rows($num_option) > 0){
		if(mysqli_fetch_array($num_option)['option_value'] == $value)
			return true;
	}
	return false;
}

?>