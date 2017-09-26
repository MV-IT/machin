<?php

/**
* author Niku
*/
class mOrder extends Database
{
	
	public function addNew($orderinfo, $list_print_curcuit){
		if($this->insert('orders', $orderinfo))
			$order_id = $this->getRow("SELECT ID FROM orders ORDER BY ID DESC LIMIT 0, 1")['ID'];

		if(!empty($order_id) && $order_id != NULL){
			$total_cost = 0;
			foreach ($list_print_curcuit as $key => $printcurcuit){
				$this->insert('order_print_curcuits', array(
					'print_curcuit_id' => $printcurcuit['id'],
					'order_id' => $order_id,
					'number' => $printcurcuit['num'],
					'cost' => $printcurcuit['price']
					));
				$total_cost += $printcurcuit['price'];
			}

			$this->update('orders', array('total_cost' => $total_cost), "ID = '$order_id'");
			return $order_id;
		}
		return false;
	}

	public function listOrders($limit = 0, $num_per_page = 24, $s = '')
	{
		$limit = (int)$limit;
        $num_per_page = (int)$num_per_page;
		
		if(!empty($s)){
			$s = $this->escape_string($s);
			$sql = "SELECT orders.ID, orders.code, orders.customer_name, orders.total_cost, GROUP_CONCAT(print_curcuit.name, '|', order_print_curcuits.number separator ';') as list_print_curcuit FROM orders JOIN print_curcuit JOIN order_print_curcuits ON ((orders.customer_name LIKE '%$s%' OR orders.code LIKE '%$s%' OR orders.customer_email LIKE '%$s%' OR orders.customer_phone LIKE '%$s%') AND order_print_curcuits.order_id = orders.ID AND order_print_curcuits.print_curcuit_id = print_curcuit.ID) OR (print_curcuit.name LIKE '%$s%' AND order_print_curcuits.order_id = orders.ID AND order_print_curcuits.print_curcuit_id = print_curcuit.ID AND print_curcuit.type = 'order') GROUP BY orders.ID ORDER BY orders.ID DESC LIMIT $limit, $num_per_page";
		}else{
			$sql = "SELECT orders.ID, orders.code, orders.customer_name, orders.total_cost, GROUP_CONCAT(print_curcuit.name, '|', order_print_curcuits.number separator ';') as list_print_curcuit FROM orders JOIN print_curcuit JOIN order_print_curcuits ON orders.ID = order_print_curcuits.order_id AND order_print_curcuits.print_curcuit_id = print_curcuit.ID GROUP BY orders.ID ORDER BY orders.ID DESC";
			$sql .= " LIMIT $limit, $num_per_page";
		}

		return $this->getList($sql);
	}

	public function numOrders($s = ''){
		
		if(!empty($s)){
			$s = $this->escape_string($s);
			$sql = "SELECT orders.ID, orders.customer_name, orders.total_cost, GROUP_CONCAT(print_curcuit.name separator '|') as list_print_curcuit FROM orders JOIN print_curcuit JOIN order_print_curcuits ON ((orders.customer_name LIKE '%$s%' OR orders.code LIKE '%$s%' OR orders.customer_email LIKE '%$s%' OR orders.customer_phone LIKE '%$s%') AND orders.ID = order_print_curcuits.order_id AND order_print_curcuits.print_curcuit_id = print_curcuit.ID) OR (print_curcuit.name LIKE '%$s%' AND order_print_curcuits.order_id = orders.ID AND order_print_curcuits.print_curcuit_id = print_curcuit.ID AND print_curcuit.type = 'order') GROUP BY orders.ID";
			return $this->getNumRows($sql);
		}else{
			$sql = "SELECT orders.ID, orders.customer_name, orders.total_cost, GROUP_CONCAT(print_curcuit.name, '|', order_print_curcuits.number separator ';') as list_print_curcuit FROM orders JOIN print_curcuit JOIN order_print_curcuits ON orders.ID = order_print_curcuits.order_id AND order_print_curcuits.print_curcuit_id = print_curcuit.ID GROUP BY orders.ID";
		}
		return $this->getNumRows($sql);
	}

	public function getOrderInfo($order_id){
		$order_id = (int)$order_id;
		return $this->getRow("SELECT orders.*, GROUP_CONCAT(order_print_curcuits.print_curcuit_id, '|', order_print_curcuits.number, '|', order_print_curcuits.cost SEPARATOR ';') as list_printcurcuit FROM orders JOIN order_print_curcuits ON orders.ID = order_print_curcuits.order_id AND orders.ID = '$order_id' GROUP BY orders.ID");
	}

	public function edit($order_id, $orderinfo, $list_printcurcuit){
		if($this->update('orders', $orderinfo, "ID = '$order_id'")){
			$total_cost = 0;
			foreach ($list_printcurcuit as $key => $printcurcuit){
				$print_curcuit_id = $printcurcuit['id'];
				$num_printcurcuit = $this->getNumRows("SELECT print_curcuit_id FROM order_print_curcuits WHERE print_curcuit_id = '$print_curcuit_id' AND order_id = '$order_id'");
				if($num_printcurcuit == 0){
					$this->insert('order_print_curcuits', array(
						'print_curcuit_id' => $printcurcuit['id'],
						'order_id' => $order_id,
						'number' => $printcurcuit['num'],
						'cost' => $printcurcuit['price']
						));
				}else{
					$this->update('order_print_curcuits', array(
						'order_id' => $order_id,
						'number' => $printcurcuit['num'],
						'cost' => $printcurcuit['price']
						), "print_curcuit_id = '$print_curcuit_id' AND order_id = '$order_id'");
				}
				$total_cost += $printcurcuit['price'];
			}

			$this->update('orders', array('total_cost' => $total_cost), "ID = '$order_id'");
			return $order_id;
		}
		return false;
	}

	public function deleteOrder($order_id){
		if(file_exists('models/mPrintCurcuit.php'))
			require_once('models/mPrintCurcuit.php');
		else if(file_exists('mPrintCurcuit.php'))
			require_once('mPrintCurcuit.php');
		else
			require_once('../models/mPrintCurcuit.php');

		//Get list print circuit in order
		$list_printcurcuit = $this->getRow("SELECT group_concat(print_curcuit_id) AS list_printcurcuit FROM order_print_curcuits WHERE order_id = '$order_id'")['list_printcurcuit'];
		$list_printcurcuit = explode(',', $list_printcurcuit);
		$status = true;
		//Start delete order
		$status = $this->deleteRow('orders', "ID = '$order_id'") ? true : false;
		//Delete row in order_print_curcuits table
		$status = $this->deleteRow('order_print_curcuits', "order_id = '$order_id'") ? true : false;
		//Delete print circuit in order
		$mPrintCurcuit = new mPrintCurcuit();
		foreach ($list_printcurcuit as $print_curcuit_id){
			$status = $mPrintCurcuit->deletePrintCurcuit($print_curcuit_id) ? true : false;
		}
		return $status;
	}
}

?>