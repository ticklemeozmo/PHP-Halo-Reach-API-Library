<?php
	require_once('GlobalFunctions.php');
	class PlayerAiAggregateDetailReach extends PlayerAggregateDetailReach{	
		private $biggest_kill_points; //Integer
		private $biggest_kill_streak; //Integer
		private $DeathsByEnemyTypeClass; //Array
		private $game_difficulty; //Integer
		private $high_score_coop; //Integer
		private $high_score_solo; //Integer
		private $highest_game_kills; //Integer
		private $highest_set; //Integer
		private $highest_skull_multiplier; //Integer
		private $KillsByEnemyTypeClass; //Array
		private $PointsByDamageType; //Array
		private $PointsByEnemyTypeClass; //Array
		private $total_enemy_players_killed; //Integer
		private $total_generators_destroyed; //Integer
		private $total_missions_beating_par; //Integer
		private $total_missions_not_dying; //Integer
		private $total_score_coop; //Integer
		private $total_score_solo; //Integer
		private $total_waves_completed; //Integer
		
		public function __construct($PlayerAiAggregateDetailReach){
			$this->biggest_kill_points = $PlayerAiAggregateDetailReach->biggest_kill_points;
			$this->biggest_kill_streak = $PlayerAiAggregateDetailReach->biggest_kill_streak;
			$this->DeathsByDamageType = $PlayerAiAggregateDetailReach->DeathsByDamageType;
			$this->DeathsByEnemyTypeClass = $PlayerAiAggregateDetailReach->DeathsByEnemyTypeClass;
			$this->game_count = $PlayerAiAggregateDetailReach->game_count;
			$this->game_difficulty = $PlayerAiAggregateDetailReach->game_difficulty;
			$this->high_score = $PlayerAiAggregateDetailReach->high_score;
			$this->high_score_coop = $PlayerAiAggregateDetailReach->high_score_coop;
			$this->high_score_solo = $PlayerAiAggregateDetailReach->high_score_solo;
			$this->highest_game_kills = $PlayerAiAggregateDetailReach->highest_game_kills;
			$this->highest_set = $PlayerAiAggregateDetailReach->highest_set;
			$this->highest_skull_multiplier = $PlayerAiAggregateDetailReach ->highest_skull_multiplier;
			$this->HopperId = $PlayerAiAggregateDetailReach->HopperId;
			$this->KillsByDamageType = $PlayerAiAggregateDetailReach->KillsByDamageType;
			$this->KillsByEnemyTypeClass = $PlayerAiAggregateDetailReach->KillsByEnemyTypeClass;
			$this->MapId = $PlayerAiAggregateDetailReach->MapId;
			$this->MedalChestCompletionPercentage = $PlayerAiAggregateDetailReach->MedalChestCompletionPercentage;
			$this->MedalCountsByType = $PlayerAiAggregateDetailReach->MedalCountsByType;
			$this->PointsByDamageType = $PlayerAiAggregateDetailReach->PointsByDamageType;
			$this->PointsByEnemyTypeClass = $PlayerAiAggregateDetailReach->PointsByEnemyTypeClass;
			$this->season_id = $PlayerAiAggregateDetailReach->season_id;
			$this->total_assists = $PlayerAiAggregateDetailReach->total_assists;
			$this->total_betrayals = $PlayerAiAggregateDetailReach->total_betrayals;
			$this->total_deaths = $PlayerAiAggregateDetailReach->total_deaths;
			$this->total_enemy_players_killed = $PlayerAiAggregateDetailReach->total_enemy_players_killed;
			$this->total_first_place = $PlayerAiAggregateDetailReach->total_first_place;
			$this->total_generators_destroyed = $PlayerAiAggregateDetailReach->total_generators_destroyed;
			$this->total_kills = $PlayerAiAggregateDetailReach->total_kills;
			$this->total_missions_beating_par = $PlayerAiAggregateDetailReach->total_missions_beating_par;
			$this->total_missions_not_dying = $PlayerAiAggregateDetailReach->total_missions_not_dying;
			$this->total_playtime = $PlayerAiAggregateDetailReach->total_playtime;
			$this->total_score = $PlayerAiAggregateDetailReach->total_score;
			$this->total_score_coop = $PlayerAiAggregateDetailReach->total_score_coop;
			$this->total_score_solo = $PlayerAiAggregateDetailReach->total_score_solo;
			$this->total_top_half_place = $PlayerAiAggregateDetailReach->total_top_half_place;
			$this->total_top_third_place = $PlayerAiAggregateDetailReach->total_top_third_place;
			$this->total_waves_completed = $PlayerAiAggregateDetailReach->total_waves_completed;
			$this->total_wins = $PlayerAiAggregateDetailReach->total_wins;
			$this->TotalMedals = $PlayerAiAggregateDetailReach->TotalMedals;
			$this->VariantClass = $PlayerAiAggregateDetailReach->VariantClass;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>