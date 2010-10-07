<?php
	require_once('GlobalFunctions.php');
	class PlayerDetailReachBasic{
		protected $armor_completion_percentage; //Float
		protected $CampaignProgressCoop; //String
		protected $CampaignProgressSp; //String
		protected $daily_challenges_completed; //Integer
		protected $first_active; //DateTime
		protected $gamertag; //String
		protected $games_total; //Integer
		protected $Initialized; //Boolean
		protected $IsGuest; //Boolean
		protected $last_active; //DateTime
		protected $LastGameVariantClassPlayed; //String
		protected $ReachEmblem; //ReachEmblem
		protected $service_tag; //String
		protected $weekly_challenges_completed; //Integer
		
		public function __construct($PlayerDetailReachBasic){
			$this->armor_completion_percentage = $PlayerDetailReachBasic->armor_completion_percentage;
			$this->CampaignProgressCoop = $PlayerDetailReachBasic->CampaignProgressCoop;
			$this->CampaignProgressSp = $PlayerDetailReachBasic->CampaignProgressSp;
			$this->daily_challenges_completed = $PlayerDetailReachBasic->daily_challenges_completed;
			$this->first_active = parseJSONDate($PlayerDetailReachBasic->first_active);
			$this->gamertag = $PlayerDetailReachBasic->gamertag;
			$this->games_total = $PlayerDetailReachBasic->games_total;
			$this->Initialized = $PlayerDetailReachBasic->Initialized;
			$this->IsGuest = $PlayerDetailReachBasic->IsGuest;
			$this->last_active = parseJSONDate($PlayerDetailReachBasic->last_active);
			$this->LastGameVariantClassPlayed = $PlayerDetailReachBasic->LastGameVariantClassPlayed;
			$this->ReachEmblem = new ReachEmblem($PlayerDetailReachBasic->ReachEmblem);
			$this->service_tag = $PlayerDetailReachBasic->service_tag;
			$this->weekly_challenges_completed = $PlayerDetailReachBasic->weekly_challenges_completed;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>