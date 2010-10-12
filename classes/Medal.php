<?php
	require_once('GlobalFunctions.php');
	class Medal{
		private $Description; //Stirng
		private $Id; //Integer
		private $ImageName; //String
		private $Name; //String
	
		public function __construct($Medal){
			$this->Description = $Medal->Description;
			$this->Id = $Medal->Id;
			$this->ImageName = $Medal->ImageName;
			$this->Name = $Medal->Name;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>
