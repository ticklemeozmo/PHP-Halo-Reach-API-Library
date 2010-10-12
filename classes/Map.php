<?php
	require_once('GlobalFunctions.php');
	class Map{
		private $Id; //Integer
		private $ImageName; //String
		private $MapType; //String
		private $Name; //String
	
		public function __construct($Map){
			$this->Id = $Map->Id;
			$this->ImageName = $Map->ImageName;
			$this->MapType = $Map->MapType;
			$this->Name = $Map->Name;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>
