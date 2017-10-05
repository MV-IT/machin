<?php

function get_web_url(){
	$nkdb = new Database();
	$value = $nkdb->getRow("SELECT * FROM options WHERE option_name = 'web-domain'");
	$value = $value['option_value'];
	if(is_serialized($value) !== false)
		return unserialize($value);
	return $value;
}

function get_admin_url(){
	return get_web_url().'/admin';
}

function get_logout_url($header = ''){
	$link = get_web_url().'/dang-xuat';
	if(empty($header)){
		$header = get_web_url();
	}
	$header = my_urlencode($header);
	$link .= '/header/'.$header;
	return $link;
}

function get_login_url($header = ''){
	$link = get_web_url().'/dang-nhap';
	if(empty($header)){
		$header = get_web_url();
	}
	$header = my_urlencode($header);
	$link .= '/header/'.$header;
	return $link;
}

function get_register_url($header = ''){
	$link = get_web_url().'/dang-ky';
	if(empty($header)){
		$header = get_web_url();
	}
	$header = my_urlencode($header);
	$link .= '/header/'.$header;
	return $link;
}

function get_web_title(){
	$nkdb = new Database();
	$query = $nkdb->query("SELECT * FROM options WHERE option_name= 'web-title'");
	$value = mysqli_fetch_array($query)['option_value'];
	if(is_serialized($value) !== false)
		return unserialize($value);
	return $value;
}

function get_web_description(){
	$nkdb = new Database();
	$query = $nkdb->query("SELECT * FROM options WHERE option_name= 'web-description'");
	$value = mysqli_fetch_array($query)['option_value'];
	if(is_serialized($value) !== false)
		return unserialize($value);
	return $value;
}

function save_file_upload($file, $folder = ''){
	if($folder !== '')
		$folder .= '/';

	if(!is_dir(root_path.'/images'))
		mkdir(root_path.'/images');
	if(!is_dir(root_path.'/images/'.$folder) && !empty($folder))
		mkdir(root_path.'/images/'.$folder);
	
	$tmp_name = $file['tmp_name'];
	$name = $file['name'];
	$path = root_path.'/images/'.$folder;
	$path_old = $path;
	$path .= $name;
	if(file_exists($path)){
		$file_path = pathinfo( $name, PATHINFO_EXTENSION );
		$name = rand_key(12).'.'.$file_path;
		$path = $path_old.$name;
	}
	move_uploaded_file($tmp_name, $path);
	if(file_exists($path))
		return $name;
	return false;
}

function save_file_from_data_url($data, $folder = ''){
	if(!empty($folder))
		$folder .= '/';

	if(!is_dir(root_path.'/images'))
		mkdir(root_path.'/images');
	if(!is_dir(root_path.'/images/'.$folder) && !empty($folder))
		mkdir(root_path.'/images/'.$folder);

	$data = substr($data,strpos($data,",")+1);
	$data = base64_decode($data);
	$file = rand_key(12).'.png';
	$array_dir = scandir(getcwd());
	$path = root_path.'/images/'.$folder;
	$path .= $file;
	file_put_contents($path, $data);
	return $file;
}

function get_image_url($file_name, $folder){
	$folder = !empty($folder) ? $folder.'/' : '';
	return get_web_url().'/images/'.$folder.$file_name; 
}

function delete_file($file_name, $folder = ''){
	if($folder !== '')
		$folder .= '/';
	$file_path = root_path.'/images/'.$folder.$file_name;

	if(!file_exists($file_path))
		return false;
	return unlink($file_path);
}

function max_word($string, $max = 15){
	$string1 = str_word_count($string);
	if($string1 > $max){
		$words = str_word_count($string, 1, '!@#$%^&*()_+-={}|\][;/.,:"?><…”“1234567890Đđáàảãạâầấẩẫậăắằẳẵặèẽẹẻéêềếệễểùúụủũưứừửựữòóỏọõôồốổộỗơớờởợỡíìỉịĩýỳỷỵỹ');
		$count = count($words);
		for($i = 0; $i < $max; $i++){
			if($i != $max - 1)
				$string2 .= $words[$i].' ';
			else $string2 .= $words[$i].'…';
		}
		return $string2;
	}
	return $string;
}

function rand_key($lenght = 32){
	$source = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$key = '';
	for($i = 0; $i < $lenght; $i++){
		$key .= $source[rand(0, strlen($source) - 1)];
	}
	return $key;
}

function is_serialized( $data, $strict = true ) {
        // if it isn't a string, it isn't serialized.
	if ( ! is_string( $data ) ) {
		return false;
	}
	$data = trim( $data );
	if ( 'N;' == $data ) {
		return true;
	}
	if ( strlen( $data ) < 4 ) {
		return false;
	}
	if ( ':' !== $data[1] ) {
		return false;
	}
	if ( $strict ) {
		$lastc = substr( $data, -1 );
		if ( ';' !== $lastc && '}' !== $lastc ) {
			return false;
		}
	} else {
		$semicolon = strpos( $data, ';' );
		$brace     = strpos( $data, '}' );
                // Either ; or } must exist.
		if ( false === $semicolon && false === $brace )
			return false;
                // But neither must be in the first X characters.
		if ( false !== $semicolon && $semicolon < 3 )
			return false;
		if ( false !== $brace && $brace < 4 )
			return false;
	}
	$token = $data[0];
	switch ( $token ) {
		case 's' :
		if ( $strict ) {
			if ( '"' !== substr( $data, -2, 1 ) ) {
				return false;
			}
		} elseif ( false === strpos( $data, '"' ) ) {
			return false;
		}
                        // or else fall through
		case 'a' :
		case 'O' :
		return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
		case 'b' :
		case 'i' :
		case 'd' :
		$end = $strict ? '$' : '';
		return (bool) preg_match( "/^{$token}:[0-9.E-]+;$end/", $data );
	}
	return false;
}

function current_url() {
	$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
	$url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
	$url .= $_SERVER["REQUEST_URI"];
	return $url;
}

function current_time(){
	return gmdate('d/m/Y H:i:s', time() + 7*3600);
}

function get_time_from_string($string){
	return explode(" ", $string);
}

function my_urlencode($url){
	$url = str_replace('/', '2F-1M', $url);
	$url = str_replace(':', '3A-1M', $url);
	return $url;
}

function my_urldecode($url){
	$url = str_replace('2F-1M', '/', $url);
	$url = str_replace('3A-1M', ':', $url);
	return $url;
}

function make_slug($text){
	$text = strtolower(utf8convert($text));
	$text = str_replace( "ß", "ss", $text);
	$text = str_replace( "%", "", $text);
	$text = preg_replace("/[^_a-zA-Z0-9 -] /", "",$text);
	$text = str_replace(array('%20', ' '), '-', $text);
	$text = str_replace("----","-",$text);
	$text = str_replace("---","-",$text);
	$text = str_replace("--","-",$text);
	$text = str_replace("&","-",$text);
	
	return $text;
}

function utf8convert($str) {
	if(!$str) return false;
	$utf8 = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		'd'=>'đ|Đ',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
		);
	foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
	return $str;
}

function get_number_from_string($string){
	$int = intval(preg_replace('/[^0-9]+/', '', $string), 10);
	return $int;
}

function get_city_ID($city_name){
	$nkdb = new Database();
	$city_name = $nkdb->escape_string($city_name);
	
	return mysqli_fetch_array($nkdb->query("SELECT * FROM thanh_pho WHERE thanh_pho = '$city_name'"))['ID'];
}

function get_city_by_ID($id){
	$nkdb = new Database();
	$id = (string)(int)$id;
	$id = preg_replace('/[^0-9]/', '', $id);
	$id = $nkdb->escape_string($id);

	return mysqli_fetch_array($nkdb->query("SELECT * FROM thanh_pho WHERE ID = '$id'"))['thanh_pho'];
}

function get_country_by_ID($id){
	$nkdb = new Database();
	$id = (string)(int)$id;
	$id = preg_replace('/[^0-9]/', '', $id);
	$id = $nkdb->escape_string($id);

	return mysqli_fetch_array($nkdb->query("SELECT * FROM quan_huyen WHERE ID = '$id'"))['quan_huyen'];
}

function get_list_country_in_city($city_name){
	$nkdb = new Database();
	$city_name = $nkdb->escape_string($city_name);

	$query = $nkdb->query("SELECT * FROM quan_huyen WHERE thanh_pho = '$city_name'");
	while($country = mysqli_fetch_array($query)){
		$country_item['id'] = $country['ID'];
		$country_item['text'] = $country['quan_huyen'];
		$array_countries[] = $country_item;
	}
	return $array_countries;
}

function get_list_option_city($city_name = ''){
	$nkdb = new Database();
	$city_name = $nkdb->escape_string($city_name);

	$query = $nkdb->query("SELECT * FROM thanh_pho ORDER BY thanh_pho");
	while($city = mysqli_fetch_array($query)){ 
		if(!empty($city['thanh_pho'])){
			if(empty($city_name)){
	?>
		<option value="<?php echo $city['ID'] ?>"><?php echo $city['thanh_pho'] ?></option>
	<?php }else{ ?>
		<option value="<?php echo $city['ID'] ?>"	<?php if($city['thanh_pho'] == $city_name) echo 'selected' ?>><?php echo $city['thanh_pho'] ?></option>
	<?php } }}
}

function get_list_option_country($country_name = ''){
	$nkdb = new Database();
	$country_name = $nkdb->escape_string($country_name);

	$query = $nkdb->query("SELECT * FROM quan_huyen ORDER BY quan_huyen");
	while($country = mysqli_fetch_array($query)){ 
		if(!empty($country['quan_huyen'])){
			if(empty($country_name)){
	?>
		<option value="<?php echo $country['ID'] ?>"><?php echo $country['quan_huyen'] ?></option>
	<?php }else{ ?>
		<option value="<?php echo $country['ID'] ?>"	<?php if($country['quan_huyen'] == $country_name) echo 'selected' ?>><?php echo $country['quan_huyen'] ?></option>
	<?php } }}
}

function array_address_from_string($string){

	$address['city'] = substr($string, strrpos($string, '/') + 1);
	$string = substr($string, 0, strlen($string) - (strlen($string) - strrpos($string, '/')));
	$address['country'] = substr($string, strrpos($string, '/') + 1);
	$address['street'] = substr($string, 0, strlen($string) - (strlen($string) - strrpos($string, '/')));
	return $address;
}

function unset_cookie($cookieName){
	while (isset($_COOKIE[$cookieName])) {
		unset($_COOKIE[$cookieName]);
		setcookie($cookieName, null, -1, '/');
		return true;
	}
	return false;
}

?>