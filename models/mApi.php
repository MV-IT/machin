<?php 

/**
* author Niku
*/
class mApi extends Database
{
	
	public function user($id)
	{
		$id = $this->escape_string($id);
		$user = $this->getRow("SELECT * FROM users WHERE ID = '$id'");
		return json_encode($user);
	}

	public function printcircuit($id){
		$id = $this->escape_string($id);
		$printcircuit = $this->getRow("SELECT print_curcuit.*, GROUP_CONCAT(print_curcuit_properties.value) as property_value FROM print_curcuit JOIN print_curcuit_properties ON print_curcuit.ID = print_curcuit_properties.print_curcuit WHERE print_curcuit.ID = '$id'");
		return json_encode($printcircuit);
	}
}

?>