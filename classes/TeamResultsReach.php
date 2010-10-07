<?php
	require_once('GlobalFunctions.php');
	class TeamResultsReach{
		private $DeathsOverTime; //Array
		private $Exists; //Boolean
		private $Index; //Integer
		private $KillsOverTime; //Integer
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
		
		public function __construct($TeamResultsReach){
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
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>