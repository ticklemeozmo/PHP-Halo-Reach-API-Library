<?php
	require_once('GlobalFunctions.php');
	class Enemy{
		private $Description; //String
		private $Id; //Integer
		private $ImageName; //String
		private $Name; //String
	
		public function __construct($Enemy){
			$this->Description = $Enemy->Description;
			$this->Id = $Enemy->Id;
			$this->ImageName = $Enemy->ImageName;
			$this->Name = $Enemy->Name;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>
