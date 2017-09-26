<?php 
	
	/**
	* author Niku
	*/
	class Cost
	{

		public $number;
		public $currency = '<sup>đ</sup>';
		
		function __construct($string)
		{
			$this->number = $string;
		}

		public function __toString(){
			$string = strrev($this->number);
			$result = '';

			for($i = 0; $i < strlen($string); $i++){
				$result .= $string[$i];
				if(($i + 1)%3 == 0 && $i != strlen($string) - 1){
					$result .= '.';
				}
			}
			$result = strrev($result).$this->currency;
			return $result;
		}

		public function string(){
			$string = strrev($this->number);
			$result = '';

			for($i = 0; $i < strlen($string); $i++){
				$result .= $string[$i];
				if(($i + 1)%3 == 0 && $i != strlen($string) - 1){
					$result .= '.';
				}
			}
			$result = strrev($result).$this->currency;
			return $result;
		}

	}
 ?>