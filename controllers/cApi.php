<?php

/**
* author Niku
*/
class cApi
{
	
	public function user()
	{
		$id = $_GET['id'];

		require_once('models/mApi.php');
		$model = new mApi();
		echo $model->user($id);
	}

	public function printcircuit()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$id = $_GET['id'];
		require_once('models/mApi.php');
		$model = new mApi();
		echo $model->printcircuit($id);
		echo '<br/>';
		$arrayName = array(0 => 1, 1 => 'string');
		var_dump($arrayName);
	}
}

?>