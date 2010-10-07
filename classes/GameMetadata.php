<?php
	require_once('GlobalFunctions.php');
	class GameMetadata{
		private $AllCommendationsById = array(); //Array of Commendation
		private $AllEnemiesById = array(); //Array of Enemy
		private $AllMapsById = array(); //Array of Map
		private $AllMedalsById = array(); //Array of Medal
		private $AllWeaponsById = array(); //Array of Weapon
		private $GameVariantClassesKeysAndValues = array(); //Array
	
		public function __construct($GameMetaData){
			foreach($GameMetaData->AllCommendationsById as $Commendation){
				array_push($this->AllCommendationsById, new Commendation($Commendation->Value));
			}
			foreach($GameMetaData->AllEnemiesById as $Enemy){
				array_push($this->AllEnemiesById, new Enemy($Enemy->Value));
			}
			foreach($GameMetaData->AllMapsById as $Map){
				array_push($this->AllMapsById, new Map($Map->Value));
			}
			foreach($GameMetaData->AllMedalsById as $Medal){
				array_push($this->AllMedalsById, new Medal($Medal->Value)); 
			}
			foreach($GameMetaData->AllWeaponsById as $Weapon){
				array_push($this->AllWeaponsById, new Weapon($Weapon->Value));
			}
			$this->GameVariantClassesKeysAndValues = $GameMetaData->GameVariantClassesKeysAndValues;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
		
		//Custom
		public function getCommendationById($id){
			foreach($this->AllCommendationsById as $Commendation){
				if($Commendation->Id == $id){
					return $Commendation;
				}
			}
		}
		public function getEnemyById($id){
			foreach($this->AllEnemiesById as $Enemy){
				if($Enemy->Id == $id){
					return $Enemy;
				}
			}
		}
		public function getMapById($id){
			foreach($this->AllMapsById as $Map){
				if($Map->Id == $id){
					return $Map;
				}
			}
		}
		public function getMedalById($id){
			foreach($this->AllMedalsById as $Medal){
				if($Medal->Id == $id){
					return $Medal;
				}
			}
		}
		public function getWeaponById($id){
			foreach($this->AllWeaponsById as $Weapon){
				if($Weapon->Id == $id){
					return $Weapon;
				}
			}
		}
		public function getGameVariantClassById($id){
			foreach($this->GameVariantClassesKeysAndValues as $KeyAndValue){
				if($KeyAndValue->Key == $id){
					return $KeyAndValue;
				}
			}
		}
	}
?>
