<?php
	require_once('GlobalFunctions.php');
	class Weapon{
		private $Description; //String
		private $Id; //Integer
		private $Name; //String
	
		public function __construct($Weapon){
			$this->Description = $Weapon->Description;
			$this->Id = $Weapon->Id;
			$this->Name = $Weapon->Name;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>
