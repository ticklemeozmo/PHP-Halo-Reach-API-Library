<?php
	require_once('GlobalFunctions.php');
	class PlayerDetailReachAggregate extends PlayerDetailReachBasic{
		private $commendation_completion_percentage; //Float
		private $CommendationState; //Array
		
		public function __construct($PlayerDetailReachAggregate){
			$this->commendation_completion_percentage = $PlayerDetailReachAggregate->commendation_completion_percentage;
			$this->CommendationState = $PlayerDetailReachAggregate->CommendationState;
			$this->armor_completion_percentage = $PlayerDetailReachAggregate->armor_completion_percentage;
			$this->CampaignProgressCoop = $PlayerDetailReachAggregate->CampaignProgressCoop;
			$this->CampaignProgressSp = $PlayerDetailReachAggregate->CampaignProgressSp;
			$this->daily_challenges_completed = $PlayerDetailReachAggregate->daily_challenges_completed;
			$this->first_active = parseJSONDate($PlayerDetailReachAggregate->first_active);
			$this->gamertag = $PlayerDetailReachAggregate->gamertag;
			$this->games_total = $PlayerDetailReachAggregate->games_total;
			$this->Initialized = $PlayerDetailReachAggregate->Initialized;
			$this->IsGuest = $PlayerDetailReachAggregate->IsGuest;
			$this->last_active = parseJSONDate($PlayerDetailReachAggregate->last_active);
			$this->LastGameVariantClassPlayed = $PlayerDetailReachAggregate->LastGameVariantClassPlayed;
			$this->ReachEmblem = new ReachEmblem($PlayerDetailReachAggregate->ReachEmblem);
			$this->service_tag = $PlayerDetailReachAggregate->service_tag;
			$this->weekly_challenges_completed = $PlayerDetailReachAggregate->weekly_challenges_completed;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>
