<?php
	require_once('GlobalFunctions.php');
	class WeaponCarnageStats{
		private $Deaths; //Integer
		private $Headshots; //Integer
		private $Kills; //Integer
		private $Penalties; //Integer
		private $WeaponId; //Integer
		
		public function __construct($WeaponCarnageStats){
			$this->Deaths = $WeaponCarnageStats->Deaths;
			$this->Headshots = $WeaponCarnageStats->Headshots;
			$this->Kills = $WeaponCarnageStats->Kills;
			$this->Penalties = $WeaponCarnageStats->Penalties;
			$this->WeaponId = $WeaponCarnageStats->WeaponId;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>
