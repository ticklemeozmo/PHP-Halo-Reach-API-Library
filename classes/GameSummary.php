<?php
	require_once('GlobalFunctions.php');
	class GameSummary{
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
		private $PlaylistName; //String
		private $RequestedPlayerAssists; //Integer
		private $RequestedPlayerDeaths; //Integer
		private $RequestedPlayerKills; //Integer
		private $RequestedPlayerRating; //Integer
		private $RequestedPlayerScore; //Integer
		private $RequestedPlayerStanding; //Integer
		
		public function __construct($RecentGame){
			$this->CampaignDifficulty = $RecentGame->CampaignDifficulty;
			$this->CampaignGlobalScore = $RecentGame->CampaignGlobalScore;
			$this->CampaignMetagameEnabled = $RecentGame->CampaignMetagameEnabled;
			$this->GameDuration = $RecentGame->GameDuration;
			$this->GameId = $RecentGame->GameId;
			$this->GameTimestamp = parseJSONDate($RecentGame->GameTimestamp);
			$this->GameVariantClass = $RecentGame->GameVariantClass;
			$this->GameVariantHash = $RecentGame->GameVariantHash;
			$this->GameVariantName = $RecentGame->GameVariantName;
			$this->HasDetails = $RecentGame->HasDetails;
			$this->IsTeamGame = $RecentGame->IsTeamGame;
			$this->MapName = $RecentGame->MapName;
			$this->MapVariantHash = $RecentGame->MapVariantHash;
			$this->PlayerCount = $RecentGame->PlayerCount;
			$this->PlaylistName = $RecentGame->PlaylistName;
			$this->RequestedPlayerAssists = $RecentGame->RequestedPlayerAssists;
			$this->RequestedPlayerDeaths = $RecentGame->RequestedPlayerDeaths;
			$this->RequestedPlayerKills = $RecentGame->RequestedPlayerKills;
			$this->RequestedPlayerRating = $RecentGame->RequestedPlayerRating;
			$this->RequestedPlayerScore = $RecentGame->RequestedPlayerScore;
			$this->RequestedPlayerStanding = $RecentGame->RequestedPlayerStanding;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>
