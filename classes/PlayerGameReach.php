<?php
	require_once('GlobalFunctions.php');
	class PlayerGameReach implements iTotals, iAverages, iCollections{
		private $AiEventAggregates = array(); //Array of AiEventAggregate
		private $Assists; //Integer
		private $AvgDeathDistanceMeters; //Float
		private $AvgKillDistanceMeters; //Float
		private $Betrayals; //Integer
		private $Deaths; //Integer
		private $DeathsOverTime; //Array
		private $DNF; //Boolean
		private $Headshots; //Integer
		private $IndividualStandingWithNoRegardForTeams; //Integer
		private $IsGuest; //Boolean
		private $KilledMostByCount; //Integer
		private $KilledMostCount; //Integer
		private $Kills; //Integer
		private $KillsOverTime; //Array
		private $MedalsOverTime; //Array
		private $MultiMedalCount; //Integer
		private $OtherMedalCount; //Integer
		private $PlayerDataIndex; //Integer
		private $PlayerDetail; //PlayerDetailReachBasic
		private $PlayerKilledByMost; //String
		private $PlayerKilledMost; //String
		private $PointsOverTime; //Array
		private $Rating; //Integer
		private $Score; //Integer
		private $SpecificMedalCounts; //Array
		private $SpreeMedalCount; //Integer
		private $Standing; //Integer
		private $StyleMedalCount; //Integer
		private $Suicides; //Integer
		private $Team; //Integer
		private $TeamScore; //Integer
		private $TotalMedalCount; //Integer
		private $UniqueMultiMedalCount; //Integer
		private $UniqueOtherMedalCount; //Integer
		private $UniqueSpreeMedalCount; //Integer
		private $UniqueStyleMedalCount; //Integer
		private $UniqueTotalMedalCount; //Integer
		private $WeaponCarnageReport = array(); //Array
	
		public function __construct($PlayerGameReach){
			if(isset($PlayerGameReach->AiEventAggregates)){
				foreach($PlayerGameReach->AiEventAggregates as $AiEventAggregate){
					array_push($this->AiEventAggregates, new AiEventAggregate($AiEventAggregate->Value));
				}
			}
			else{
				$this->AiEventAggregates = $PlayerGameReach->AiEventAggregates;
			}
			$this->Assists = $PlayerGameReach->Assists;
			$this->AvgDeathDistanceMeters = $PlayerGameReach->AvgDeathDistanceMeters;
			$this->AvgKillDistanceMeters = $PlayerGameReach->AvgKillDistanceMeters;
			$this->Betrayals = $PlayerGameReach->Betrayals;
			$this->DNF = $PlayerGameReach->DNF;
			$this->Deaths = $PlayerGameReach->Deaths;
			$this->DeathsOverTime = $PlayerGameReach->DeathsOverTime;
			$this->Headshots = $PlayerGameReach->Headshots;
			$this->IndividualStandingWithNoRegardForTeams = $PlayerGameReach->IndividualStandingWithNoRegardForTeams;
			$this->IsGuest = $PlayerGameReach->IsGuest;
			$this->KilledMostByCount = $PlayerGameReach->KilledMostByCount;
			$this->KilledMostCount = $PlayerGameReach->KilledMostCount;
			$this->Kills = $PlayerGameReach->Kills;
			$this->KillsOverTime = $PlayerGameReach->KillsOverTime;
			$this->MedalsOverTime = $PlayerGameReach->MedalsOverTime;
			$this->MultiMedalCount = $PlayerGameReach->MultiMedalCount;
			$this->OtherMedalCount = $PlayerGameReach->OtherMedalCount;
			$this->PlayerDataIndex = $PlayerGameReach->PlayerDataIndex;
			$this->PlayerDetail = new PlayerDetailReachBasic($PlayerGameReach->PlayerDetail);
			$this->PlayerKilledByMost = $PlayerGameReach->PlayerKilledByMost;
			$this->PlayerKilledMost = $PlayerGameReach->PlayerKilledMost;
			$this->PointsOverTime = $PlayerGameReach->PointsOverTime;
			$this->Rating = $PlayerGameReach->Rating;
			$this->Score = $PlayerGameReach->Score;
			$this->SpecificMedalCounts = $PlayerGameReach->SpecificMedalCounts;
			$this->SpreeMedalCount = $PlayerGameReach->SpreeMedalCount;
			$this->Standing = $PlayerGameReach->Standing;
			$this->StyleMedalCount = $PlayerGameReach->StyleMedalCount;
			$this->Suicides = $PlayerGameReach->Suicides;
			$this->Team = $PlayerGameReach->Team;
			$this->TeamScore = $PlayerGameReach->TeamScore;
			$this->TotalMedalCount = $PlayerGameReach->TotalMedalCount;
			$this->UniqueMultiMedalCount = $PlayerGameReach->UniqueMultiMedalCount;
			$this->UniqueOtherMedalCount = $PlayerGameReach->UniqueOtherMedalCount;
			$this->UniqueSpreeMedalCount = $PlayerGameReach->UniqueSpreeMedalCount;
			$this->UniqueStyleMedalCount = $PlayerGameReach->UniqueStyleMedalCount;
			$this->UniqueTotalMedalCount = $PlayerGameReach->UniqueTotalMedalCount;
			if(isset($PlayerGameReach->WeaponCarnageReport)){
				foreach($PlayerGameReach->WeaponCarnageReport as $WeaponCarnageReport){
					array_push($this->WeaponCarnageReport, new WeaponCarnageStats($WeaponCarnageReport));
				}
			}
			else{
				$this->WeaponCarnageReport = $PlayerGameReach->WeaponCarnageReport;
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
			return $this->Assists;
		}
		public function getTotalBetrayals(){
			return $this->Betrayals;
		}
		public function getTotalDeaths(){
			return $this->Deaths;
		}
		public function getTotalDNFs(){
			return (int)$this->DNF;
		}
		public function getTotalHeadshots(){
			return $this->Headshots;
		}
		public function getTotalGuests(){
			return (int)$this->IsGuest;
		}
		public function getTotalKills(){
			return $this->Kills;
		}
		public function getTotalMultiMedalCount(){
			return $this->MultiMedalCount;
		}
		public function getTotalOtherMedalCount(){
			return $this->OtherMedalCount;
		}
		public function getTotalRating(){
			return $this->Rating;
		}
		public function getTotalScore(){
			return $this->Score;
		}
		public function getTotalSpreeMedalCount(){
			return $this->SpreeMedalCount;
		}
		public function getTotalStyleMedalCount(){
			return $this->StyleMedalCount;
		}
		public function getTotalSuicides(){
			return $this->Suicides;
		}
		public function getTotalMedalCount(){
			return $this->TotalMedalCount;
		}
		public function getTotalUniqueMultiMedalCount(){
			return $this->UniqueMultiMedalCount;
		}
		public function getTotalUniqueOtherMedalCount(){
			return $this->UniqueOtherMedalCount;
		}
		public function getTotalUniqueSpreeMedalCount(){
			return $this->UniqueSpreeMedalCount;
		}
		public function getTotalUniqueStyleMedalCount(){
			return $this->UniqueStyleMedalCount;
		}
		public function getTotalUniqueTotalMedalCount(){
			return $this->UniqueTotalMedalCount;
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
			return $this->Assists;
		}
		public function getAverageDeathDistance(){
			return $this->AvgDeathDistanceMeters;
		}
		public function getAverageKillDistance(){
			return $this->AvgKillDistanceMeters;
		}
		public function getAverageBetrayals(){
			return $this->Betrayals;
		}
		public function getAverageDeaths(){
			return $this->Deaths;
		}
		public function getAverageDNFs(){
			return (int)$this->DNF;
		}
		public function getAverageHeadshots(){
			return $this->Headshots;
		}
		public function getAverageGuests(){
			return (int)$this->IsGuest;
		}
		public function getAverageKills(){
			return $this->Kills;
		}
		public function getAverageMultiMedalCount(){
			return $this->MultiMedalCount;
		}
		public function getAverageOtherMedalCount(){
			return $this->OtherMedalCount;
		}
		public function getAverageRating(){
			return $this->Rating;
		}
		public function getAverageScore(){
			return $this->Score;
		}
		public function getAverageSpreeMedalCount(){
			return $this->SpreeMedalCount;
		}
		public function getAverageStyleMedalCount(){
			return $this->StyleMedalCount;
		}
		public function getAverageSuicides(){
			return $this->Suicides;
		}
		public function getAverageTotalMedalCount(){
			return $this->TotalMedalCount;
		}
		public function getAverageUniqueMultiMedalCount(){
			return $this->UniqueMultiMedalCount;
		}
		public function getAverageUniqueOtherMedalCount(){
			return $this->UniqueOtherMedalCount;
		}
		public function getAverageUniqueSpreeMedalCount(){
			return $this->UniqueSpreeMedalCount;
		}
		public function getAverageUniqueStyleMedalCount(){
			return $this->UniqueStyleMedalCount;
		}
		public function getAverageUniqueTotalMedalCount(){
			return $this->UniqueTotalMedalCount;
		}
		public function getAverageKillDeathSpread(){
			return $this->getTotalKillDeathRatio();
		}
		public function getAverageKillDeathRatio(){
			return $this->getTotalKillDeathSpread();
		}
		
		//iCollections
		public function getAllAiEventAggregates(){
			return $this->AiEventAggregates;
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
			return array($this->PlayerDetails);
		}
		public function getAllPointsOverTime(){
			return $this->PointsOverTime;
		}
		public function getAllSpecificMedalCounts(){
			return $this->SpecificMedalCounts;
		}
		public function getAllWeaponCarnageReports(){
			return $this->WeaponCarnageReport;
		}
		public function getAllGuests(){
			if($this->IsGuest){
				return array($this);
			}
			return array();
		}
		public function getAllNonGuests(){
			if(!$this->IsGuest){
				return array($this);
			}
			return array();
		}
		public function getAllDNFs(){
			if($this->DNF){
				return array($this);
			}
			return array();
		}
		public function getAllNonDNFs(){
			if(!$this->DNF){
				return array($this);
			}
			return array();
		}
	}
?>
