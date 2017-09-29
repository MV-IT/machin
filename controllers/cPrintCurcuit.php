<?php

/**
 * author Niku
 */
class cPrintCurcuit
{
	public function listInAdmin()
	{
		$search = !empty($_GET['s']) ? $_GET['s'] : '';

		$num_per_page = 24;

		$page = !empty($_GET['page']) ?$_GET['page'] : 1;

		$limit = ($page - 1) * $num_per_page;

		require_once('models/mPrintCurcuit.php');
		$model = new mPrintCurcuit();
		if(!empty($_POST['delete-print_curcuit'])){
			$print_curcuit_id = $_POST['delete-print_curcuit'];
			if($model->deletePrintCurcuit($print_curcuit_id))
				header('location: '.current_url());
		}

		$list_print_curcuit = $model->listPrintCurcuit($limit, $num_per_page, $search);

		$total = $model->numPrintCurcuit($search);

		$pagi = new pagination($total, $page, $num_per_page , 5);
		$action = 'list-print-curcuit';
		$page_title = 'Danh sách mạch in';
		require_once('views/admin/print-curcuit/list.php');
	}

	public function addNew(){
		$action = 'add-new-print-curcuit';
		$page_title = 'Thêm mạch in';

		require_once('models/mPrintCurcuit.php');
		$model = new mPrintCurcuit();

		if(!empty($_POST['add-new'])){
			$name = !empty($_POST['printcurcuit-name']) ? $_POST['printcurcuit-name'] : '';
			$feature_image = !empty($_POST['image_cropped']) ? $_POST['image_cropped'] : $_POST['feature_image'];
			$featured = !empty($_POST['featured']) ? $_POST['featured'] : 0;
			$list_chosed = array();
			foreach($_POST as $k => $value){
				if(strpos($k, 'property_') !== false){
					$property_id = get_number_from_string($k);
					$list_chosed[$property_id] = $value;
				}
			}
			$print_curcuit_id = $model->addNew($name, $list_chosed, '',$feature_image, $featured);
			if($print_curcuit_id !== false)
				header('location: '.get_admin_url().'/print-curcuit/edit/'.$print_curcuit_id);
		}

		$list_properties = $model->listPropertiesWithChose();
		require_once('views/admin/print-curcuit/add-new.php');
	}

	public function edit(){
		$print_curcuit_id = $_GET['print_curcuit_id'];
		$action = 'edit-print-curcuit';
		$page_title = 'Sửa 	mạch in';

		require_once('models/mPrintCurcuit.php');
		$model = new mPrintCurcuit();

		if(!empty($_POST['delete-print_curcuit'])){
			$print_curcuit_id = $_POST['delete-print_curcuit'];
			if($model->deletePrintCurcuit($print_curcuit_id))
				header('location: '.get_admin_url().'/print-curcuit/list');
		}

		if(!empty($_POST['edit'])){
			$name = !empty($_POST['printcurcuit-name']) ? $_POST['printcurcuit-name'] : '';
			$feature_image = !empty($_POST['image_cropped']) ? $_POST['image_cropped'] : $_POST['feature_image'];
			$featured = !empty($_POST['featured']) ? $_POST['featured'] : 0;
			$type = $_POST['pr_type'];
			$list_chosed = array();
			foreach($_POST as $k => $value){
				if(strpos($k, 'property_') !== false){
					$property_id = get_number_from_string($k);
					$list_chosed[$property_id] = $value;
				}
			}
			$status = $model->editPrintCurcuit($print_curcuit_id, $name, $list_chosed, $type, $feature_image, $featured);
			if($status !== false)
				header('location: '.current_url());
		}

		$print_curcuit = $model->getPrintCurcuit($print_curcuit_id);

		$list_print_curcuit_properties_value = explode(',', $print_curcuit->property_value);

		$list_properties = $model->listPropertiesWithChose();
		require_once('views/admin/print-curcuit/edit.php');
	}

	public function properties(){
		$action = 'printcurcuit-properties';
		$page_title = 'Thuộc tính mạch in';

		require_once('models/mPrintCurcuit.php');
		$model = new mPrintCurcuit();

		if(!empty($_POST['add-property'])){
			//Get property title
			$property_title = $_POST['add-title'];
			//Get property chose value

			$list_chose = array();
			foreach ($_POST as $k => $v){
				if(strpos($k, 'chose-title') !== false){
					$id = get_number_from_string($k);
					array_push($list_chose, array(
						'value' => $v,
						'price' => $_POST['chose-price-'.$id]
						));
				}
			}

			if($model->addProperty($property_title, $list_chose))
				header('location: '.current_url());
		}

		if(!empty($_POST['edit-property'])){
			
			$list_chose = array();
			foreach ($_POST as $k => $v){
				if(strpos($k, 'chose-title') !== false){
					$id = get_number_from_string($k);
					array_push($list_chose, array(
						'value' => $v,
						'price' => $_POST['chose-price-'.$id]
						));
				}
				echo $k.' '.$v.' ';
			}

			//Get property title
			$property_title = $_POST['edit-title'];
			//Get property chose value
			$property_id = $_POST['edit-property'];

			if($model->editProperty($property_id, $property_title, $list_chose))
				header('location: '.current_url());
		}

		if(!empty($_POST['delete-property'])){
			$property_id = $_POST['delete-property'];
			if($model->deleteProperty($property_id))
				header('location: '.current_url());
		}

		$list_properties = $model->listProperties();
		require_once('views/admin/print-curcuit/properties.php');
	}

	public function order()
	{
		$action = 'print-order';
		$page_title = 'Đặt mạch in';
		require_once 'views/print-circuit/order.php';
	}
}

?>