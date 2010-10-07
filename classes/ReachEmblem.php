<?php
	require_once('GlobalFunctions.php');
	class ReachEmblem{
		private $background_index; //Integer
		private $change_colors; //Array
		private $flags; //Integer
		private $foreground_index; //Integer
		
		public function __construct($ReachEmblem){
			$this->background_index = $ReachEmblem->background_index;
			$this->change_colors = $ReachEmblem->change_colors;
			$this->flags = $ReachEmblem->flags;
			$this->foreground_index = $ReachEmblem->foreground_index;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>