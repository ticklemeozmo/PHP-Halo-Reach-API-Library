<?php
	require_once('GlobalFunctions.php');
	class Game{
		private $BaseMapName; //String
		private $CampaignDifficulty; //String
		private $CampaignGlobalScore; //Integer
		private $CampaignMetagameEnabled; //Boolean
		private $GameDuration; //Integer
		private $GameId; //Integer
		private $GameTimestamp; //DateTime
		private $GameVariantClass; //Integer
		private $GameVariantHash; //Integer
		private $GameVariantName; //String
		private $HasDetails; //Boolean
		private $IsTeamGame; //Boolean
		private $MapName; //String
		private $MapVariantHash; //Integer
		private $PlayerCount; //Integer
		private $Players = array(); //Array of PlayerGameReach
		private $PlaylistName; //String
		private $Teams = array(); //Array of TeamResultsReach
		
		public function __construct($GameDetails){
			$this->BaseMapName = $GameDetails->BaseMapName;
			$this->CampaignDifficulty = $GameDetails->CampaignDifficulty;
			$this->CampaignGlobalScore = $GameDetails->CampaignGlobalScore;
			$this->CampaignMetagameEnabled = $GameDetails->CampaignMetagameEnabled;
			$this->GameDuration = $GameDetails->GameDuration;
			$this->GameId = $GameDetails->GameId;
			$this->GameTimestamp = parseJSONDate($GameDetails->GameTimestamp);
			$this->GameVariantClass = $GameDetails->GameVariantClass;
			$this->GameVariantHash = $GameDetails->GameVariantHash;
			$this->GameVariantName = $GameDetails->GameVariantName;
			$this->HasDetails = $GameDetails->HasDetails;
			$this->IsTeamGame = $GameDetails->IsTeamGame;
			$this->MapName = $GameDetails->MapName;
			$this->MapVariantHash = $GameDetails->MapVariantHash;
			$this->PlayerCount = $GameDetails->PlayerCount;
			foreach($GameDetails->Players as $PlayerGameReach){
				array_push($this->Players, new PlayerGameReach($PlayerGameReach));
			}
			$this->PlaylistName = $GameDetails->PlaylistName;
			if(isset($GameDetails->Teams)){
				foreach($GameDetails->Teams as $TeamResultsReach){
					array_push($this->Teams, new TeamResultsReach($TeamResultsReach));
				}
			}
			else{
				$this->Teams = $GameDetails->Teams;
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