<?php 
	
	/**
	* author Niku
	*/
	class printCurcuit
	{
		public $ID;
		public $name;
		public $properties;

		function __construct($printCurcuit)
		{
			$this->ID = $printCurcuit['ID'];
			$this->name = $printCurcuit['name'];
			$this->properties = $printCurcuit['properties'];
		}
	}

 ?>