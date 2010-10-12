<?php
	require_once('GlobalFunctions.php');
	class TeamResultsReach implements iTotals, iAverages, iCollections, iUpperBounds, iLowerBounds{
		private $DeathsOverTime; //Array
		private $Exists; //Boolean
		private $Index; //Integer
		private $KillsOverTime; //Array
		private $MedalsOverTime; //Array
		private $MetagameScore; //Integer
		private $Score; //Integer
		private $Standing; //Integer
		private $TeamTotalAssists; //Integer
		private $TeamTotalBetrayals; //Integer
		private $TeamTotalDeaths; //Integer
		private $TeamTotalGameVariantCustomStat_1; //Integer
		private $TeamTotalGameVariantCustomStat_2; //Integer
		private $TeamTotalGameVariantCustomStat_3; //Integer
		private $TeamTotalGameVariantCustomStat_4; //Integer
		private $TeamTotalKills; //Integer
		private $TeamTotalMedals; //Integer
		private $TeamTotalSuicides; //Integer
		
		//Custom
		private $TeamPlayers = array(); //Array of PlayerGameReach instances relating to the current team
		//End Custom
		
		public function __construct($TeamResultsReach, $TeamPlayers = null){ //$TeamPlayers is custom
			$this->DeathsOverTime = $TeamResultsReach->DeathsOverTime;
			$this->Exists = $TeamResultsReach->Exists;
			$this->Index = $TeamResultsReach->Index;
			$this->KillsOverTime = $TeamResultsReach->KillsOverTime;
			$this->MedalsOverTime = $TeamResultsReach->MedalsOverTime;
			$this->MetagameScore = $TeamResultsReach->MetagameScore;
			$this->Score = $TeamResultsReach->Score;
			$this->Standing = $TeamResultsReach->Standing;
			$this->TeamTotalAssists = $TeamResultsReach->TeamTotalAssists;
			$this->TeamTotalBetrayals = $TeamResultsReach->TeamTotalBetrayals;
			$this->TeamTotalDeaths = $TeamResultsReach->TeamTotalDeaths;
			$this->TeamTotalGameVariantCustomStat_1 = $TeamResultsReach->TeamTotalGameVariantCustomStat_1;
			$this->TeamTotalGameVariantCustomStat_2 = $TeamResultsReach->TeamTotalGameVariantCustomStat_2;
			$this->TeamTotalGameVariantCustomStat_3 = $TeamResultsReach->TeamTotalGameVariantCustomStat_3;
			$this->TeamTotalGameVariantCustomStat_4 = $TeamResultsReach->TeamTotalGameVariantCustomStat_4;
			$this->TeamTotalKills = $TeamResultsReach->TeamTotalKills;
			$this->TeamTotalMedals = $TeamResultsReach->TeamTotalMedals;
			$this->TeamTotalSuicides = $TeamResultsReach->TeamTotalSuicides;
			
			//Custom
			if(isset($TeamPlayers)){
				$this->TeamPlayers = $TeamPlayers;
			}
			//End Custom
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
			return $this->TeamTotalAssists;
		}
		public function getTotalBetrayals(){
			return $this->TeamTotalBetrayals;
		}
		public function getTotalDeaths(){
			return $this->TeamTotalDeaths;
		}
		public function getTotalDNFs(){
			$sum = 0;
			foreach($this->TeamPlayers as $TeamPlayer){
				if($TeamPlayer->DNF){
					$sum += 1;
				}
			}
			return $sum;
		}
		public function getTotalHeadshots(){
			$sum = 0;
			foreach($this->TeamPlayers as $TeamPlayer){
				$sum += $TeamPlayer->Headshots;
			}
			return $sum;
		}
		public function getTotalGuests(){
			$sum = 0;
			foreach($this->TeamPlayers as $TeamPlayer){
				if($TeamPlayer->IsGuest){
					$sum += 1;
				}
			}
			return $sum;
		}
		public function getTotalKills(){
			return $this->TeamTotalKills;
		}
		public function getTotalMultiMedalCount(){
			$sum = 0;
			foreach($this->TeamPlayers as $TeamPlayer){
				$sum += $TeamPlayer->MultiMedalCount;
			}
			return $sum;
		}
		public function getTotalOtherMedalCount(){
			$sum = 0;
			foreach($this->TeamPlayers as $TeamPlayer){
				$sum += $TeamPlayer->OtherMedalCount;
			}
			return $sum;
		}
		public function getTotalRating(){
			$sum = 0;
			foreach($this->TeamPlayers as $TeamPlayer){
				$sum += $TeamPlayer->Rating;
			}
			return $sum;
		}
		public function getTotalScore(){
			return $this->Score;
		}
		public function getTotalSpreeMedalCount(){
			$sum = 0;
			foreach($this->TeamPlayers as $TeamPlayer){
				$sum += $TeamPlayer->SpreeMedalCount;
			}
			return $sum;
		}
		public function getTotalStyleMedalCount(){
			$sum = 0;
			foreach($this->TeamPlayers as $TeamPlayer){
				$sum += $TeamPlayer->StyleMedalCount;
			}
			return $sum;
		}
		public function getTotalSuicides(){
			return $this->TeamTotalSuicides;
		}
		public function getTotalMedalCount(){
			return $this->TeamTotalMedals;
		}
		public function getTotalUniqueMultiMedalCount(){
			$sum = 0;
			foreach($this->TeamPlayers as $TeamPlayer){
				$sum += $TeamPlayer->UniqueMultiMedalCount;
			}
			return $sum;
		}
		public function getTotalUniqueOtherMedalCount(){
			$sum = 0;
			foreach($this->TeamPlayers as $TeamPlayer){
				$sum += $TeamPlayer->UniqueOtherMedalCount;
			}
			return $sum;
		}
		public function getTotalUniqueSpreeMedalCount(){
			$sum = 0;
			foreach($this->TeamPlayers as $TeamPlayer){
				$sum += $TeamPlayer->UniqueSpreeMedalCount;
			}
			return $sum;
		}
		public function getTotalUniqueStyleMedalCount(){
			$sum = 0;
			foreach($this->TeamPlayers as $TeamPlayer){
				$sum += $TeamPlayer->UniqueStyleMedalCount;
			}
			return $sum;
		}
		public function getTotalUniqueTotalMedalCount(){
			$sum = 0;
			foreach($this->TeamPlayers as $TeamPlayer){
				$sum += $TeamPlayer->UniqueTotalMedalCount;
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalAssists();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getAverageDeathDistance();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getAverageKillDistance();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalBetrayals();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalDeaths();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalDNFs();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalHeadshots();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalGuests();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalKills();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalMultiMedalCount();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalOtherMedalCount();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalRating();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalScore();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalSpreeMedalCount();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalStyleMedalCount();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalSuicides();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalMedalCount();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalUniqueMultiMedalCount();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalUniqueOtherMedalCount();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalUniqueSpreeMedalCount();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalUniqueStyleMedalCount();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalUniqueTotalMedalCount();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalKillDeathSpread();
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
			foreach($this->TeamPlayers as $TeamPlayer){
				$avg += $TeamPlayer->getTotalKillDeathRatio();
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
			foreach($this->TeamPlayers as $Player){
				foreach($Player->AiEventAggregates as $AiEventAggregate){
					array_push($arr, $AiEventAggregate);
				}
			}
			return $arr;
		}
		public function getAllDeathsOverTime(){
			return $this->DeathsOverTime;
		}
		public function getAllKillsOverTime(){
			return $this->KillsOverTime;
		}
		public function getAllMedalsOverTime(){
			return $this->MedalsOverTime;
		}
		public function getAllPlayerDetails(){
			$arr = array();
			foreach($this->TeamPlayers as $Player){
				array_push($arr, $Player->PlayerDetail);
			}
			return $arr;
		}
		public function getAllPointsOverTime(){
			$arr = array();
			foreach($this->TeamPlayers as $Player){
				foreach($Player->PointsOverTime as $PointOverTime){
					array_push($arr, $PointOverTime);
				}
			}
			return $arr;
		}
		public function getAllSpecificMedalCounts(){
			$arr = array();
			foreach($this->TeamPlayers as $Player){
				foreach($Player->SpecificMedalCounts as $SpecificMedalCount){
					array_push($arr, $SpecificMedalCount);
				}
			}
			return $arr;
		}
		public function getAllWeaponCarnageReports(){
			$arr = array();
			foreach($this->TeamPlayers as $Player){
				foreach($Player->WeaponCarnageReport as $WeaponCarnage){
					array_push($arr, $WeaponCarnage);
				}
			}
			return $arr;
		}
		public function getAllGuests(){
			$arr = array();
			foreach($this->TeamPlayers as $Player){
				if($Player->IsGuest){
					array_push($arr, $Player);
				}
			}
			return $arr;
		}
		public function getAllNonGuests(){
			$arr = array();
			foreach($this->TeamPlayers as $Player){
				if(!$Player->IsGuest){
					array_push($arr, $Player);
				}
			}
			return $arr;
		}
		public function getAllDNFs(){
			$arr = array();
			foreach($this->TeamPlayers as $Player){
				if($Player->DNF){
					array_push($arr, $Player);
				}
			}
			return $arr;
		}
		public function getAllNonDNFs(){
			$arr = array();
			foreach($this->TeamPlayers as $Player){
				if(!$Player->DNF){
					array_push($arr, $Player);
				}
			}
			return $arr;
		}
		
		//iUpperBounds
		private function getHighestAggregate($type, $methodName){				
			$get;
			if($type == 'RETURN_PLAYERS'){
				$get = array();
				$agg = call_user_func(array(__CLASS__, __FUNCTION__), 'RETURN_PLAYER_AGGREGATE', $methodName);
				foreach($this->TeamPlayers as $TeamPlayer){
					if($TeamPlayer->$methodName() == $agg){
						array_push($get, $TeamPlayer);
					}
				}
				return $get;
			}
			else{
				foreach($this->TeamPlayers as $TeamPlayer){
					if(!isset($get) || ($TeamPlayer->$methodName() > $get->$methodName())){
						$get = $TeamPlayer;
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
			if($type == 'RETURN_PLAYERS'){
				$get = array();
				$agg = call_user_func(array(__CLASS__, __FUNCTION__), 'RETURN_PLAYER_AGGREGATE', $methodName);
				foreach($this->TeamPlayers as $TeamPlayer){
					if($TeamPlayer->$methodName() == $agg){
						array_push($get, $TeamPlayer);
					}
				}
				return $get;
			}
			else{
				foreach($this->TeamPlayers as $TeamPlayer){
					if(!isset($get) || ($TeamPlayer->$methodName() < $get->$methodName())){
						$get = $TeamPlayer;
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
