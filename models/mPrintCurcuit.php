<?php

/**
 * author Niku
 */
class mPrintCurcuit extends Database
{
	public function listPrintCurcuit($limit = 0, $num_per_page = 24, $s = '')
	{
		$limit = (int)$limit;
        $num_per_page = (int)$num_per_page;

		$sql = "SELECT * FROM print_curcuit";
		if(!empty($s)){
			$s = $this->escape_string($s);
			$sql .= " WHERE name LIKE '%$s%'";
		}
		$sql .= " LIMIT $limit, $num_per_page";
		return $this->getList($sql);
	}

	public function numPrintCurcuit($s = ''){
		$sql = "SELECT * FROM print_curcuit";
		if(!empty($s)){
			$s = $this->escape_string($s);
			$sql .= " WHERE name LIKE '%$s%'";
		}
		return $this->getNumRows($sql);
	}

	public function addNew($name = '', $list_chosed, $type = 'Mẫu', $feature_image, $featured){
		if(empty($list_chosed) || !is_array($list_chosed))
			return false;

		if(empty($type))
			$type = 'Mẫu';

		$url = make_slug($name);
		if(!is_array($feature_image))
			$featureName = save_file_from_data_url($feature_image, 'print-curcuit');
		else $featureName = save_file_upload($feature_image, 'print-curcuit');

		$featureImageUrl = ($featureName === false || empty($featureName)) ? '/images/print-curcuit/default.png' : '/images/print-curcuit/'.$featureName;

		if($this->insert('print_curcuit', array('name' => $name, 'type' => $type, 'url' => $url, 'feature_image' => $featureImageUrl, 'featured' => $featured)))
			$print_curcuit_id = $this->getRow("SELECT * FROM print_curcuit ORDER BY ID DESC")['ID'];

		if(!empty($print_curcuit_id))
			foreach($list_chosed as $property_id => $value){
				$this->insert('print_curcuit_properties', array('property' => $property_id, 'print_curcuit' => $print_curcuit_id, 'value' => $value));
			}

			return $print_curcuit_id;
		}

		public function editPrintCurcuit($id, $name, $list_chosed, $type = 'Mẫu', $feature_image, $featured)
		{
			if(empty($list_chosed) || !is_array($list_chosed))
				return false;

			$featureImageUrl = get_print_curcuit_feature_image($id, 'admin');

			if(is_array($feature_image) && !empty($feature_image['name'])){
				$imageName = basename($featureImageUrl);
				delete_file($imageName, 'print-curcuit');
				$featureImageUrl = '/images/print-curcuit/'.save_file_upload($feature_image, 'print-curcuit');
			}else if(is_string($feature_image) && !empty($feature_image)){
				$imageName = basename($featureImageUrl);
				delete_file($imageName, 'print-curcuit');
				$featureImageUrl = '/images/print-curcuit/'.save_file_from_data_url($feature_image, 'print-curcuit');
			}

			$url = make_slug($name);

			$result = $this->update('print_curcuit', array('name' => $name, 'type' => $type, 'url' => $url, 'feature_image' => $featureImageUrl, 'featured' => $featured), "ID = '$id'") ? true : false;

			foreach($list_chosed as $property_id => $value){
				if($this->getNumRows("SELECT ID FROM print_curcuit_properties WHERE print_curcuit = '$id' AND property = '$property_id'") > 0)
					$result = $this->update('print_curcuit_properties', array('value' => $value), "print_curcuit = '$id' AND property = '$property_id'") ? true : false;
				else
					$result = $this->insert('print_curcuit_properties', array('value' => $value, 'print_curcuit' => $id, 'property' => $property_id)) ? true : false;
			}

			return $result;
		}

		public function deletePrintCurcuit($print_curcuit_id){
			$print_curcuit_id = $this->escape_string($print_curcuit_id);
			$this->deleteRow('print_curcuit', "ID = '$print_curcuit_id'");
			return $this->deleteRow('print_curcuit_properties', "print_curcuit = '$print_curcuit_id'");
		}

		public function getPrintCurcuit($print_curcuit_id){
			return (object)$this->getRow("SELECT print_curcuit.*, GROUP_CONCAT(print_curcuit_properties.value) as property_value FROM print_curcuit JOIN print_curcuit_properties ON print_curcuit.ID = print_curcuit_properties.print_curcuit WHERE print_curcuit.ID = '$print_curcuit_id'");
		}

		public function addProperty($property_title, $list_chose){
			$this->insert('property', array('name' => $property_title, 'sort_order' => get_last_property_sort_order() + 1));
			$id = $this->getRow("SELECT ID FROM property ORDER BY sort_order DESC")['ID'];

			foreach ($list_chose as $key => $value) {
				$value['property'] = $id;

				$this->insert('property_chose_value', $value);
			}

			if($this->getNumRows("SELECT * FROM property_chose_value WHERE property = '$id'") > 0)
				return true;
			return false;
		}

		public function listProperties(){
			return $this->getList("SELECT * FROM property ORDER BY sort_order ASC");
		}

		public function listPropertiesWithChose(){
			return $this->getList("SELECT property.ID, property.name, group_concat(property_chose_value.ID, '|', property_chose_value.value, '|', property_chose_value.price) as 'list_chose' FROM property INNER JOIN property_chose_value ON property.ID = property_chose_value.property GROUP BY property.ID ORDER BY sort_order ASC");
		}

		public function editProperty($id, $property_title, $list_chose){
			$this->update('property', array('name' => $property_title), "ID = '$id'");
			$this->deleteRow('property_chose_value', "property = '$id'");
			foreach($list_chose as $chose){
				$chose['property'] = $id;
				$this->insert('property_chose_value', $chose);
			}

			if($this->getNumRows("SELECT * FROM property_chose_value WHERE property = '$id'") > 0)
				return true;
			return false;
		}

		public function deleteProperty($property_id){
			$this->deleteRow('property_chose_value', "property = '$property_id'");
			return $this->deleteRow('property', "ID = '$property_id'");
		}

		//Front End
		
		public function getListFeatured($num = ''){
			$sql = "SELECT * FROM print_curcuit WHERE type = 'Mẫu' AND featured = '1' ORDER BY ID DESC";
			if(!empty($num))
				$sql .= " LIMIT 0, $num";
			return $this->getList($sql);
		}

		public function getListByRand($num = ''){
			$sql = "SELECT * FROM print_curcuit WHERE type = 'Mẫu' ORDER BY RAND()";
			if(!empty($num))
				$sql .= " LIMIT 0, $num";
			return $this->getList($sql);
		}
	}

	?>