<?php
	require_once('GlobalFunctions.php');
	class PlayerAggregateDetailReach {
		protected $DeathsByDamageType; //Array
		protected $game_count; //Integer
		protected $high_score; //Integer
		protected $HopperId; //Integer
		protected $KillsByDamageType; //Array
		protected $MapId; //Integer
		protected $MedalChestCompletionPercentage; //Float
		protected $MedalCountsByType; //Array
		protected $season_id; //Integer
		protected $total_assists; //Integer
		protected $total_betrayals; //Integer
		protected $total_deaths; //Integer
		protected $total_first_place; //Integer
		protected $total_kills; //Integer
		protected $total_playtime; //DateTime or Integer
		protected $total_score; //Integer
		protected $total_top_half_place; //Integer
		protected $total_top_third_place; //Integer
		protected $total_wins; //Integer
		protected $TotalMedals; //Integer
		protected $VariantClass; //Integer
		
		public function __construct($PlayerAggregateDetailReach){
			$this->DeathsByDamageType = $PlayerAggregateDetailReach->DeathsByDamageType;
			$this->game_count = $PlayerAggregateDetailReach->game_count;
			$this->high_score = $PlayerAggregateDetailReach->high_score;
			$this->HopperId = $PlayerAggregateDetailReach->HopperId;
			$this->KillsByDamageType = $PlayerAggregateDetailReach->KillsByDamageType;
			$this->MapId = $PlayerAggregateDetailReach->MapId;
			$this->MedalChestCompletionPercentage = $PlayerAggregateDetailReach->MedalChestCompletionPercentage;
			$this->MedalCountsByType = $PlayerAggregateDetailReach->MedalCountsByType;
			$this->season_id = $PlayerAggregateDetailReach->season_id;
			$this->total_assists = $PlayerAggregateDetailReach->total_assists;
			$this->total_betrayals = $PlayerAggregateDetailReach->total_betrayals;
			$this->total_deaths = $PlayerAggregateDetailReach->total_deaths;
			$this->total_first_place = $PlayerAggregateDetailReach->total_first_place;
			$this->total_kills = $PlayerAggregateDetailReach->total_kills;
			$this->total_playtime = $PlayerAggregateDetailReach->total_playtime;
			$this->total_score = $PlayerAggregateDetailReach->total_score;
			$this->total_top_half_place = $PlayerAggregateDetailReach->total_top_half_place;
			$this->total_top_third_place = $PlayerAggregateDetailReach->total_top_third_place;
			$this->total_wins = $PlayerAggregateDetailReach->total_wins;
			$this->TotalMedals = $PlayerAggregateDetailReach->TotalMedals;
			$this->VariantClass = $PlayerAggregateDetailReach->VariantClass;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>