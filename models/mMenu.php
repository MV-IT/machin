<?php

/**
 * author Niku
 */
class mMenu extends Database
{
   	public function getListItem($parent_id)
    {
    	return $this->getList("SELECT * FROM menu WHERE parent_id = '$parent_id' ORDER BY sort_order");
    }

    public function itemHasChild($id){
    	if($this->getRow("SELECT ID FROM menu WHERE parent_id = '$id'") > 0)
    		return true;
    	return false;
    }
}

?>