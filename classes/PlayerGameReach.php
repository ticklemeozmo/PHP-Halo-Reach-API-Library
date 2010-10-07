<?php
	require_once('GlobalFunctions.php');
	class PlayerGameReach{
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
	}
?>