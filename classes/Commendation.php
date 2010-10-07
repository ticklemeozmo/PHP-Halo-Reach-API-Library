<?php
	require_once('GlobalFunctions.php');
	class Commendation{
		private $Bronze; //Integer
		private $Description; //String
		private $Gold; //Integer
		private $Id; //Integer
		private $Iron; //Integer
		private $Max; //Integer
		private $Name; //String
		private $Onyx; //Integer
		private $Silver; //Integer
	
		public function __construct($Commendation){
			$this->Bronze = $Commendation->Bronze;
			$this->Description = $Commendation->Description;
			$this->Gold = $Commendation->Gold;
			$this->Id = $Commendation->Id;
			$this->Iron = $Commendation->Iron;
			$this->Max = $Commendation->Max;
			$this->Name = $Commendation->Name;
			$this->Onyx = $Commendation->Onyx;
			$this->Silver = $Commendation->Silver;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>