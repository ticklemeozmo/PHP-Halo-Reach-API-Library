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
			$this->flags = ($ReachEmblem->flags % 2);
			$this->foreground_index = $ReachEmblem->foreground_index;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
		
		//Custom
		public function getEmblemURL($size = '70'){
			$url = 'http://bungie.net/stats/emblem.ashx?';
			$url .= "s=" . $size; //size in pixels
			$url .= "&0=" . $this->change_colors[0];
			$url .= "&1=" . $this->change_colors[1];
			$url .= "&2=" . $this->change_colors[2];
			$url .= "&3=" . $this->change_colors[3];
			$url .= "&fi=" . $this->foreground_index;
			$url .= "&bi=" . $this->background_index;
			$url .= "&fl=" . $this->flags;
			$url .= "&m=3";
			return $url;
		}
	}
?>
