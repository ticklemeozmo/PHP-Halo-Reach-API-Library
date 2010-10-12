<?php
	require_once('GlobalFunctions.php');
	class Game implements iTotals, iAverages, iCollections, iUpperBounds, iLowerBounds{
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
				
				//Custom
					//Find all players which have the same Team index, pass array of them to constructor
					$TeamPlayers = array();
					foreach($this->Players as $Player){
						if($TeamResultsReach->Index === $Player->Team){
							array_push($TeamPlayers, $Player);
						}
					}
				//End Custom
					array_push($this->Teams, new TeamResultsReach($TeamResultsReach, $TeamPlayers)); //$TeamPlayers is custom
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
		
		//Custom
		
		//iTotals
		public function getTotalAssists(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalAssists();
			}
			return $sum;
		}
		public function getTotalBetrayals(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalBetrayals();
			}
			return $sum;
		}
		public function getTotalDeaths(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalDeaths();
			}
			return $sum;
		}
		public function getTotalDNFs(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalDNFs();
			}
			return $sum;
		}
		public function getTotalHeadshots(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalHeadshots();
			}
			return $sum;
		}
		public function getTotalGuests(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalGuests();
			}
			return $sum;
		}
		public function getTotalKills(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalKills();
			}
			return $sum;
		}
		public function getTotalMultiMedalCount(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalMedalCount();
			}
			return $sum;
		}
		public function getTotalOtherMedalCount(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalOtherMedalCount();
			}
			return $sum;
		}
		public function getTotalRating(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalRating();
			}
			return $sum;
		}
		public function getTotalScore(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalScore();
			}
			return $sum;
		}
		public function getTotalSpreeMedalCount(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalSpreeMedalCount();
			}
			return $sum;
		}
		public function getTotalStyleMedalCount(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalStyleMedalCount();
			}
			return $sum;
		}
		public function getTotalSuicides(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalSuicides();
			}
			return $sum;
		}
		public function getTotalMedalCount(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalMedalCount();
			}
			return $sum;
		}
		public function getTotalUniqueMultiMedalCount(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalUniqueMultiMedalCount();
			}
			return $sum;
		}
		public function getTotalUniqueOtherMedalCount(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalUniqueOtherMedalCount();
			}
			return $sum;
		}
		public function getTotalUniqueSpreeMedalCount(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalUniqueSpreeMedalCount();
			}
			return $sum;
		}
		public function getTotalUniqueStyleMedalCount(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalUniqueStyleMedalCount();
			}
			return $sum;
		}
		public function getTotalUniqueTotalMedalCount(){
			$sum = 0;
			foreach($this->Players as $Player){
				$sum += $Player->getTotalUniqueTotalMedalCount();
			}
			return $sum;
		}
		public function getTotalKillDeathRatio(){
			$kills = $this->getTotalKills();
			$deaths = $this->getTotalDeaths();
			if($deaths != 0){
				return $kills / $deaths;
			}
			return $kills;
		}
		public function getTotalKillDeathSpread(){
			$kills = $this->getTotalKills();
			$deaths = $this->getTotalDeaths();
			return $kills - $deaths;
		}
	
		//iAverages
		public function getAverageAssists(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalAssists();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageDeathDistance(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getAverageDeathDistance();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageKillDistance(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getAverageKillDistance();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageBetrayals(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalBetrayals();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageDeaths(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalDeaths();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageDNFs(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalDNFs();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageHeadshots(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalHeadshots();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageGuests(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalGuests();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageKills(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalKills();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageMultiMedalCount(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalMultiMedalCount();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageOtherMedalCount(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalOtherMedalCount();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageRating(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalRating();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageScore(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalScore();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageSpreeMedalCount(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalSpreeMedalCount();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageStyleMedalCount(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalStyleMedalCount();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageSuicides(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalSuicides();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageTotalMedalCount(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalMedalCount();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageUniqueMultiMedalCount(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalUniqueMultiMedalCount();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageUniqueOtherMedalCount(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalUniqueOtherMedalCount();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageUniqueSpreeMedalCount(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalUniqueSpreeMedalCount();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageUniqueStyleMedalCount(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalUniqueStyleMedalCount();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageUniqueTotalMedalCount(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalUniqueTotalMedalCount();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageKillDeathSpread(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalKillDeathSpread();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		public function getAverageKillDeathRatio(){
			$avg = 0;
			$count = 0;
			foreach($this->Players as $Player){
				$avg += $Player->getTotalKillDeathRatio();
				$count++;
			}
			if($count != 0){
				return ($avg / $count);
			}
			return $avg;
		}
		
		//iCollections
		public function getAllAiEventAggregates(){
			$arr = array();
			foreach($this->Players as $Player){
				foreach($Player->AiEventAggregates as $AiEventAggregate){
					array_push($arr, $AiEventAggregate);
				}
			}
			return $arr;
		}
		public function getAllDeathsOverTime(){
			$arr = array();
			foreach($this->Players as $Player){
				foreach($Player->DeathsOverTime as $DeathOverTime){
					array_push($arr, $DeathOverTime);
				}
			}
			return $arr;
		}
		public function getAllKillsOverTime(){
			$arr = array();
			foreach($this->Players as $Player){
				foreach($Player->KillsOverTime as $KillOverTime){
					array_push($arr, $KillOverTime);
				}
			}
			return $arr;
		}
		public function getAllMedalsOverTime(){
			$arr = array();
			foreach($this->Players as $Player){
				foreach($Player->MedalsOverTime as $MedalOverTime){
					array_push($arr, $MedalOverTime);
				}
			}
			return $arr;
		}
		public function getAllPlayerDetails(){
			$arr = array();
			foreach($this->Players as $Player){
				array_push($arr, $Player->PlayerDetail);
			}
			return $arr;
		}
		public function getAllPointsOverTime(){
			$arr = array();
			foreach($this->Players as $Player){
				foreach($Player->PointsOverTime as $PointOverTime){
					array_push($arr, $PointOverTime);
				}
			}
			return $arr;
		}
		public function getAllSpecificMedalCounts(){
			$arr = array();
			foreach($this->Players as $Player){
				foreach($Player->SpecificMedalCounts as $SpecificMedalCount){
					array_push($arr, $SpecificMedalCount);
				}
			}
			return $arr;
		}
		public function getAllWeaponCarnageReports(){
			$arr = array();
			foreach($this->Players as $Player){
				foreach($Player->WeaponCarnageReport as $WeaponCarnage){
					array_push($arr, $WeaponCarnage);
				}
			}
			return $arr;
		}
		public function getAllGuests(){
			$arr = array();
			foreach($this->Players as $Player){
				if($Player->IsGuest){
					array_push($arr, $Player);
				}
			}
			return $arr;
		}
		public function getAllNonGuests(){
			$arr = array();
			foreach($this->Players as $Player){
				if(!$Player->IsGuest){
					array_push($arr, $Player);
				}
			}
			return $arr;
		}
		public function getAllDNFs(){
			$arr = array();
			foreach($this->Players as $Player){
				if($Player->DNF){
					array_push($arr, $Player);
				}
			}
			return $arr;
		}
		public function getAllNonDNFs(){
			$arr = array();
			foreach($this->Players as $Player){
				if(!$Player->DNF){
					array_push($arr, $Player);
				}
			}
			return $arr;
		}
	
		//iUpperBounds
		private function getHighestAggregate($type, $methodName){
			$get;
			$arr;
		
			if($type == 'RETURN_TEAM_AGGREGATE' || $type == 'RETURN_TEAMS'){
				$arr = $this->Teams;
			}
			else{
				$arr = $this->Players;
			}
				
			if($type == 'RETURN_PLAYERS' || $type == 'RETURN_TEAMS'){
				$arg;
				if($type == 'RETURN_PLAYERS'){
					$arg = 'RETURN_PLAYER_AGGREGATE';
				}
				else{
					$arg = 'RETURN_TEAM_AGGREGATE';
				}
					
				$agg = call_user_func(array(__CLASS__, __FUNCTION__), $arg, $methodName);
				$get = array();
				foreach($arr as $item){
					if($item->$methodName() == $agg){
						array_push($get, $item);
					}
				}
				return $get;
			}
			else{
				foreach($arr as $item){
					if(!isset($get) || ($item->$methodName() > $get->$methodName())){
						$get = $item;
					}
				}
				return $get->$methodName();
			}
			return null;
		}
		
		public function getMostAssists($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalAssists');
		}
		public function getHighestAverageDeathDistance($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getAverageDeathDistance');
		}
		public function getHighestAverageKillDistance($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getAverageKillDistance');
		}
		public function getMostBetrayals($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalBetrayals');
		}
		public function getMostDeaths($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalDeaths');
		}
		public function getMostHeadshots($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalHeadshots');
		}		
		public function getMostKills($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalKills');
		}
		public function getHighestMultiMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalMultiMedalCount');
		}
		public function getHighestOtherMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalOtherMedalCount');
		}
		public function getHighestRating($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalRating');
		}
		public function getHighestScore($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalScore');
		}
		public function getHighestSpreeMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalSpreeMedalCount');
		}
		public function getHighestStyleMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalStyleMedalCount');
		}
		public function getMostSuicides($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalSuicides');
		}
		public function getHighestTotalMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalMedalCount');
		}
		public function getHighestUniqueMultiMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalUniqueMultiMedalCount');
		}
		public function getHighestUniqueOtherMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalUniqueOtherMedalCount');
		}
		public function getHighestUniqueSpreeMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalUniqueSpreeMedalCount');
		}
		public function getHighestUniqueStyleMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalUniqueStyleMedalCount');
		}
		public function getHighestUniqueTotalMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalUniqueTotalMedalCount');
		}
		public function getHighestKillDeathSpread($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalKillDeathSpread');
		}
		public function getHighestKillDeathRatio($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getHighestAggregate($type, 'getTotalKillDeathRatio');
		}
	
		//iLowerBounds
		private function getLowestAggregate($type, $methodName){
			$get;
			$arr;
			
			if($type == 'RETURN_TEAM_AGGREGATE' || $type == 'RETURN_TEAMS'){
				$arr =& $this->Teams;
			}
			else{
				$arr =& $this->Players;
			}
			
			if($type == 'RETURN_PLAYERS' || $type == 'RETURN_TEAMS'){
				$arg;
				if($type == 'RETURN_PLAYERS'){
					$arg = 'RETURN_PLAYER_AGGREGATE';
				}
				else{
					$arg = 'RETURN_TEAM_AGGREGATE';
				}
				
				$agg = call_user_func(array(__CLASS__, __FUNCTION__), $arg, $methodName);
				$get = array();
				foreach($arr as $item){
					if($item->$methodName() == $agg){
						array_push($get, $item);
					}
				}
				return $get;
			}
			else{
				foreach($arr as $item){
					if(!isset($get) || ($item->$methodName() < $get->$methodName())){
						$get = $item;
					}
				}
				return $get->$methodName();
			}
			return null;
		}
		
		public function getLeastAssists($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalAssists');
		}
		public function getLowestAverageDeathDistance($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getAverageDeathDistance');
		}
		public function getLowestAverageKillDistance($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getAverageKillDistance');
		}
		public function getLeastBetrayals($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalBetrayals');
		}
		public function getLeastDeaths($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalDeaths');
		}
		public function getLeastHeadshots($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalHeadshots');
		}		
		public function getLeastKills($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalKills');
		}
		public function getLowestMultiMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalMultiMedalCount');
		}
		public function getLowestOtherMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalOtherMedalCount');
		}
		public function getLowestRating($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalRating');
		}
		public function getLowestScore($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalScore');
		}
		public function getLowestSpreeMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalSpreeMedalCount');
		}
		public function getLowestStyleMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalStyleMedalCount');
		}
		public function getLeastSuicides($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalSuicides');
		}
		public function getLowestTotalMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalMedalCount');
		}
		public function getLowestUniqueMultiMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalUniqueMultiMedalCount');
		}
		public function getLowestUniqueOtherMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalUniqueOtherMedalCount');
		}
		public function getLowestUniqueSpreeMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalUniqueSpreeMedalCount');
		}
		public function getLowestUniqueStyleMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalUniqueStyleMedalCount');
		}
		public function getLowestUniqueTotalMedalCount($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalUniqueTotalMedalCount');
		}
		public function getLowestKillDeathSpread($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalKillDeathSpread');
		}
		public function getLowestKillDeathRatio($type = 'RETURN_PLAYER_AGGREGATE'){
			return $this->getLowestAggregate($type, 'getTotalKillDeathRatio');
		}
	}
?>
