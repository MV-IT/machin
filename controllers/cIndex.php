<?php

/**
 * author Niku
 */
require_once('libs/functions.php');
class cIndex
{
	public function show_frontend()
	{

		$page_title = 'Trang chủ';
		$action = 'index_frontend';

		$listSliderItem = get_web_option('index_slider');

		require_once('models/mPrintCurcuit.php');
		$mPrintCurcuit = new mPrintCurcuit();
		$listPrintCurcuitFeature = $mPrintCurcuit->getListFeatured(4);
		$listRandPrintCurcuit = $mPrintCurcuit->getListByRand(6);

		require_once('views/index.php');
	}

	public function show_backend(){
		$page_title = 'Trang quản trị';
		$action = 'admin-index';
		require_once('views/admin/index.php');
	}
}

?>