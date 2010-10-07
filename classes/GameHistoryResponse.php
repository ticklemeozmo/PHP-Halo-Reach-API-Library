<?php
	require_once('GlobalFunctions.php');
	class GameHistoryResponse extends APIResponse{
		private $RecentGames = array(); //Array of GameSummary
		private $HasMorePages; //Boolean
		
		public function __construct($GameHistoryResponse){
			$this->reason = $GameHistoryResponse->reason;
			$this->status = $GameHistoryResponse->status;
			foreach($GameHistoryResponse->RecentGames as $RecentGame){
				array_push($this->RecentGames, new GameSummary($RecentGame)); 
			}
			$this->HasMorePages = $GameHistoryResponse->HasMorePages;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>