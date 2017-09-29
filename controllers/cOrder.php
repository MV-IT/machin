<?php

/**
* author Niku
*/
class cOrder
{
	public function addNew(){
		$action = 'add-new-order';
		$page_title = 'Thêm đơn hàng mới';

		require_once('models/mPrintCurcuit.php');
		$mPrintCurcuit = new mPrintCurcuit();

		//Add order on submit
		if(!empty($_POST['add-new-order'])){
			//Get order info
			$order = array();
			$order['customer_name'] = $_POST['customer-name'];
			$order['customer_email'] = $_POST['customer-email'];
			$order['customer_phone'] = $_POST['customer-phone'];
			$order['address'] = $_POST['address'].'/'.get_country_by_ID($_POST['country']).'/'.get_city_by_ID($_POST['city']);

			$order['receive_after'] = $_POST['receive-after'];
			$order['ship_to_home'] = $_POST['ship-to-home'];
			$order['status'] = 0;
			$order['code'] = rand_key(6);
			$order['view_code'] = rand_key(6);

			$num_printcurcuit = $_POST['num-printcurcuit'];

			//Get list print circuit
			for($i = 0; $i <= $num_printcurcuit; $i++){
				if(!empty($_POST['printcurcuit_'.$i])){
					$printcurcuit = $_POST['printcurcuit_'.$i];
					$name = !empty($printcurcuit['name']) ? $printcurcuit['name'] : 'Mạch in '.strtoupper(rand_key(10));

					foreach ($printcurcuit as $key => $value){
						if(strpos($key, 'property_') !== false){
							$property_id = get_number_from_string($key);
							$list_chosed[$property_id] = $value;
						}
					}

					$list_print_curcuit[$i]['id'] = $mPrintCurcuit->addNew($name, $list_chosed, 'Order');
					$list_print_curcuit[$i]['num'] = !empty($printcurcuit['num']) ? $printcurcuit['num'] : 1;
					$list_print_curcuit[$i]['price'] = $printcurcuit['price-num'];
				}
			}
			require_once('models/mOrder.php');
			$mOrder = new mOrder();

			//Add new order
			$order_id = $mOrder->addNew($order, $list_print_curcuit);
			if($order_id !== false)
				header('location: '.get_admin_url().'/order/edit/'.$order_id);
		}

		$list_property = $mPrintCurcuit->listPropertiesWithChose();

		require_once('views/admin/order/add-new.php');
	}

	public function listInAdmin(){
		$action = 'list-order';
		$page_title = 'Danh sách đơn hàng';

		$search = !empty($_GET['s']) ? $_GET['s'] : '';
		$num_per_page = 24;
		$page = !empty($_GET['page']) ?$_GET['page'] : 1;
		$limit = ($page - 1) * $num_per_page;

		require_once('models/mOrder.php');
		$model = new mOrder();

		if(!empty($_POST['delete-order'])){
			$order_id = $_POST['delete-order'];
			if($model->deleteOrder($order_id)){
				header('location: '.current_url());
			}
		}

		$list_order = $model->listOrders($limit, $num_per_page, $search);
		$total = $model->numOrders($search);
		$pagi = new pagination($total, $page, $num_per_page , 5);
		require_once('views/admin/order/list.php');
	}

	public function edit(){
		$action = 'edit-order';
		$page_title = 'Chỉnh sửa đơn hàng';

		$order_id = (int)$_GET['order_id'];

		require_once('models/mOrder.php');
		require_once('models/mPrintCurcuit.php');
		$mOrder = new mOrder();
		$mPrintCurcuit = new mPrintCurcuit();

		//Delete order
		if(!empty($_POST['delete-order'])){
			$order_id = $_POST['delete-order'];
			if($mOrder->deleteOrder($order_id)){
				header('location: '.get_admin_url().'/order/list');
			}
		}

		//Update order info on submit
		if(!empty($_POST['edit-order'])){
			//Get new order info
			$order = array();
			$order['customer_name'] = $_POST['customer-name'];
			$order['customer_email'] = $_POST['customer-email'];
			$order['customer_phone'] = $_POST['customer-phone'];
			$order['address'] = $_POST['address'].'/'.get_country_by_ID($_POST['country']).'/'.get_city_by_ID($_POST['city']);

			$order['receive_after'] = $_POST['receive-after'];
			$order['ship_to_home'] = $_POST['ship-to-home'];
			$order['status'] = $_POST['status'];
			$order['accept_time'] = $_POST['accept-time'];
			$order['will_receive_time'] = $_POST['will-receive-time'];
			$order['receive_time'] = $_POST['receive-time'];

			$num_printcurcuit = $_POST['num-printcurcuit'];

			//Get list print circuit
			for($i = 0; $i <= $num_printcurcuit; $i++){
				if(!empty($_POST['printcurcuit_'.$i])){
					$printcurcuit = $_POST['printcurcuit_'.$i];
					$name = !empty($printcurcuit['name']) ? $printcurcuit['name'] : 'Mạch in '.strtoupper(rand_key(10));

					$id = $printcurcuit['id'];

					foreach ($printcurcuit as $key => $value){
						if(strpos($key, 'property_') !== false){
							$property_id = get_number_from_string($key);
							$list_chosed[$property_id] = $value;
						}
					}
					if($mPrintCurcuit->editPrintCurcuit($id, $name, $list_chosed, 'Order')){
						$list_print_curcuit[$i]['id'] = $id;
						$list_print_curcuit[$i]['num'] = !empty($printcurcuit['num']) ? $printcurcuit['num'] : 1;
						$list_print_curcuit[$i]['price'] = $printcurcuit['price-num'];
					}
				}
			}
			
			$status = $mOrder->edit($order_id, $order, $list_print_curcuit);
			
		}

		$order = $mOrder->getOrderInfo($order_id);

		$address = array_address_from_string($order['address']);

		$list_printcurcuit = explode(';', $order['list_printcurcuit']);
		$list_property = $mPrintCurcuit->listPropertiesWithChose();

		require_once('views/admin/order/edit.php');
	}

	public function frontEnd()
	{
		require_once('models/mPrintCurcuit.php');
		$mPrintCurcuit = new mPrintCurcuit();

		//Add order on submit
		if(!empty($_POST['add-new-order'])){
			//Get order info
			$order = array();
			$order['customer_name'] = $_POST['customer-name'];
			$order['customer_email'] = $_POST['customer-email'];
			$order['customer_phone'] = $_POST['customer-phone'];
			$order['address'] = $_POST['address'].'/'.get_country_by_ID($_POST['country']).'/'.get_city_by_ID($_POST['city']);

			$order['receive_after'] = $_POST['receive-after'];
			$order['ship_to_home'] = $_POST['ship-to-home'];
			$order['status'] = 0;
			$order['code'] = rand_key(6);
			$order['view_code'] = rand_key(6);

			$num_printcurcuit = $_POST['num-printcurcuit'];

			//Get list print circuit
			for($i = 0; $i <= $num_printcurcuit; $i++){
				if(!empty($_POST['printcurcuit_'.$i])){
					$printcurcuit = $_POST['printcurcuit_'.$i];
					$name = !empty($printcurcuit['name']) ? $printcurcuit['name'] : 'Mạch in '.strtoupper(rand_key(10));

					foreach ($printcurcuit as $key => $value){
						if(strpos($key, 'property_') !== false){
							$property_id = get_number_from_string($key);
							$list_chosed[$property_id] = $value;
						}
					}

					$list_print_curcuit[$i]['id'] = $mPrintCurcuit->addNew($name, $list_chosed, 'Order');
					$list_print_curcuit[$i]['num'] = !empty($printcurcuit['num']) ? $printcurcuit['num'] : 1;
					$list_print_curcuit[$i]['price'] = $printcurcuit['price-num'];
				}
			}
			require_once('models/mOrder.php');
			$mOrder = new mOrder();
			//Add new order
			$order_id = $mOrder->addNew($order, $list_print_curcuit);
			if($order_id !== false)
				header('location: '.get_admin_url().'/order/edit/'.$order_id);
		}

		$list_property = $mPrintCurcuit->listPropertiesWithChose();

		$action = 'print-order';
		$page_title = 'Đặt mạch in';
		require_once 'views/print-circuit/order.php';
	}
}

?>