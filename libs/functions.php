<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if(file_exists('libs/user/functions.php'))
	require 'libs/user/functions.php';
else
	require_once('user/functions.php');

if(file_exists('libs/post/functions.php'))
	require 'libs/post/functions.php';
else
	require_once('post/functions.php');

if(file_exists('libs/setting_functions.php'))
	require 'libs/setting_functions.php';
else
	require_once('setting_functions.php');

if(file_exists('libs/extension_functions.php'))
	require 'libs/extension_functions.php';
else
	require_once('extension_functions.php');

if(file_exists('libs/menu_functions.php'))
	require 'libs/menu_functions.php';
else
	require_once('menu_functions.php');

if(file_exists('libs/number_class.php'))
	require 'libs/number_class.php';
else
	require_once('number_class.php');

if(file_exists('../Facebook/autoload.php'))
	require '../Facebook/autoload.php';
else
	require_once('Facebook/autoload.php');

function get_post_image($id){
	$nkdb = new Database();

	return get_web_url().$nkdb->getRow("SELECT post_thumbnail FROM posts WHERE ID = '$id'")['post_thumbnail'];
}

function get_last_property_sort_order(){
	$nkdb = new Database();

	return $nkdb->getRow("SELECT sort_order FROM property ORDER BY sort_order DESC")['sort_order'];
}

function get_print_curcuit_permalink($id){
	$nkdb = new Database();

	$id = $nkdb->escape_string($id);

	return get_web_url().'/print-curcuit/'.$nkdb->getRow("SELECT url FROM print_curcuit WHERE ID = '$id'")['url'];
}

function get_print_curcuit_feature_image($id, $type = 'front-end'){
	$nkdb = new Database();

	$id = $nkdb->escape_string($id);

	if($type == 'front-end')
		return get_web_url().$nkdb->getRow("SELECT feature_image FROM print_curcuit WHERE ID = '$id'")['feature_image'];
	else
		return $nkdb->getRow("SELECT feature_image FROM print_curcuit WHERE ID = '$id'")['feature_image'];
}

function get_print_curcuit_price($id){
	$nkdb = new Database();

	$listPrice = $nkdb->getList("SELECT property_chose_value.price FROM `property_chose_value` JOIN print_curcuit_properties ON print_curcuit_properties.value = property_chose_value.ID WHERE print_curcuit_properties.print_curcuit = '$id'");
	$result = 0;
	foreach ($listPrice as $price){
		$result += $price['price'];
	}

	return $result;
}

?>