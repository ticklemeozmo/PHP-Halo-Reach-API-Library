<?php
	require_once('GlobalFunctions.php');
	class ReachFileSet{
		private $Id; //Integer
		private $Name; //String
	
		public function __construct($FileSet){
			$this->Id = $FileSet->Id;
			$this->Name = $FileSet->Name;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>
