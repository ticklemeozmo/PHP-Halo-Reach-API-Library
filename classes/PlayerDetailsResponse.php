<?php
	require_once('GlobalFunctions.php');
	class PlayerDetailsResponse extends APIResponse{
		private $AiStatistics = array(); //Array of PlayerAiAggregateDetailReach
		private $CurrentSeasonArenaStatistics = array(); //Array of PlayerArenaDetail
		private $Player; //PlayerDetailReachAggregate
		private $PlayerModelUrl; //String
		private $PlayerModelUrlHiRes; //String
		private $PriorSeasonArenaStatistcs = array(); //Array of PlayerArenaDetail
		private $StatisticsByMap = array(); //Array of PlayerAggregateDetailReach
		private $StatisticsByPlaylist = array(); //Array of PlayerAggregateDetailReach

		public function __construct($APIResponse){
			$this->reason = $APIResponse->reason;
			$this->status = $APIResponse->status;
			
			if(isset($APIResponse->AiStatistics)){
				foreach($APIResponse->AiStatistics as $AiStatistic){
					array_push($this->AiStatistics, new PlayerAiAggregateDetailReach($AiStatistic));
				}
			}
			else{
				$this->AiStatistics = $APIResponse->AiStatistics;
			}
			
			if(isset($APIResponse->CurrentSeasonArenaStatistics)){
				foreach($APIResponse->CurrentSeasonArenaStatistics as $CurrentSeasonArenaStatistic){
					array_push($this->CurrentSeasonArenaStatistics, new PlayerArenaDetail($CurrentSeasonArenaStatistic));
				}
			}
			else{
				$this->CurrentSeasonArenaStatistics = $APIResponse->CurrentSeasonArenaStatistics;
			}
			
			$this->Player = new PlayerDetailReachAggregate($APIResponse->Player);
			$this->PlayerModelUrl = $APIResponse->PlayerModelUrl;
			$this->PlayerModelUrlHiRes = $APIResponse->PlayerModelUrlHiRes;
			
			if(isset($APIResponse->PriorSeasonArenaStatistics)){
				foreach($APIResponse->PriorSeasonArenaStatistics as $PriorSeasonArenaStatistic){
					array_push($this->PriorSeasonArenaStatistcs, new PlayerArenaDetail($PriorSeasonArenaStatistic));
				}
			}
			else{
				$this->PriorSeasonArenaStatistcs = $APIResponse->PriorSeasonArenaStatistics;
			}
			
			if(isset($APIResponse->StatisticsByMap)){
				foreach($APIResponse->StatisticsByMap as $StatisticByMap){
					array_push($this->StatisticsByMap, new PlayerAggregateDetailReach($StatisticByMap));
				}
			}
			else{
				$this->StatisticsByMap = $APIResponse->StatisticsByMap;
			}
			
			if(isset($APIResponse->StatisticsByPlaylist)){
				foreach($APIResponse->StatisticsByPlaylist as $StatisticByPlaylist){
					array_push($this->StatisticsByPlaylist, new PlayerAggregateDetailReach($StatisticByPlaylist));
				}
			}
			else{
				$this->StatisticsByPlaylist = $APIResponse->StatisticsByPlaylist;
			}
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>