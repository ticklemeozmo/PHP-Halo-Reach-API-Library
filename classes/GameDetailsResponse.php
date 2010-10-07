<?php
	require_once('GlobalFunctions.php');
	class GameDetailsResponse extends APIResponse{
		private $GameDetails; //Game

		public function __construct($GameDetailsResponse){
			$this->reason = $GameDetailsResponse->reason;
			$this->status = $GameDetailsResponse->status;
			$this->GameDetails = new Game($GameDetailsResponse->GameDetails);
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>