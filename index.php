<?php
require_once('libs/functions.php');
if(!file_exists('nk-config.php')){

	require_once('controllers/cInstall.php');

	$controller = new cInstall();

	$controller->step1();
}else{

	require_once('libs/database.php');
	require_once('libs/pagi.php');

	$action = $_GET['action'];

	$controller = 'c'.$_GET['controller'];

	require_once('controllers/'.$controller.'.php');

	$controller = new $controller();

	$controller->$action();	
}



?>