<?php
	require_once('GlobalFunctions.php');
	class PlayerArenaDetail{
		private $current_daily_rating; //Integer
		private $division; //Integer
		private $game_count; //Integer
		private $playlist_system_name; //Integer
		private $qualifying_days; //Integer
		private $required_daily_games; //Integer
		private $required_days; //Integer
		private $seasonID; //Integer

		public function __construct($ArenaStatistic){
			$this->current_daily_rating = $ArenaStatistic->current_daily_rating;
			$this->division = $ArenaStatistic->division;
			$this->game_count = $ArenaStatistic->game_count;
			$this->playlist_system_name = $ArenaStatistic->playlist_system_name;
			$this->qualifying_days = $ArenaStatistic->qualifying_days;
			$this->required_daily_games = $ArenaStatistic->required_daily_games;
			$this->required_days = $ArenaStatistic->required_days;
			$this->seasonID = $ArenaStatistic->seasonID;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>
