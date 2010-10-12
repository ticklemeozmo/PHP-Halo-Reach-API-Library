<?php
	require_once('GlobalFunctions.php');
	class AiEventAggregate{
		private $aiTypeClass; //Integer
		private $PenaltyPoints; //Integer
		private $PlayerBetrayedAiCount; //Integer
		private $PlayerKilledAiAverageDistanceInMeters; //Float
		private $PlayerKilledAiCount; //Integer
		private $PlayerKilledAiDistancesInMeters; //Array
		private $PlayerKilledAiPerHour; //Float
		private $PlayerKilledAiTimeIndexes; //Array
		private $PlayerKilledByAiAverageDistanceInMeters; //Float
		private $PlayerKilledByAiCount; //Integer
		private $PlayerKilledByAiDistancesInMeters; //Array
		private $PlayerKilledByAiTimeIndexes; //Array
		private $Points; //Integer
		
		public function __construct($AiEventAggregate){
			$this->aiTypeClass = $AiEventAggregate->aiTypeClass;
			$this->PenaltyPoints = $AiEventAggregate->PenaltyPoints;
			$this->PlayerBetrayedAiCount = $AiEventAggregate->PlayerBetrayedAiCount;
			$this->PlayerKilledAiAverageDistanceInMeters = $AiEventAggregate->PlayerKilledAiAverageDistanceInMeters;
			$this->PlayerKilledAiCount = $AiEventAggregate->PlayerKilledAiCount;
			$this->PlayerKilledAiDistancesInMeters = $AiEventAggregate->PlayerKilledAiDistancesInMeters;
			$this->PlayerKilledAiPerHour = $AiEventAggregate->PlayerKilledAiPerHour;
			$this->PlayerKilledAiTimeIndexes = $AiEventAggregate->PlayerKilledAiTimeIndexes;
			$this->PlayerKilledByAiAverageDistanceInMeters = $AiEventAggregate->PlayerKilledByAiAverageDistanceInMeters;
			$this->PlayerKilledByAiCount = $AiEventAggregate->PlayerKilledByAiCount;
			$this->PlayerKilledByAiDistancesInMeters = $AiEventAggregate->PlayerKilledByAiDistancesInMeters;
			$this->PlayerKilledByAiTimeIndexes = $AiEventAggregate->PlayerKilledByAiTimeIndexes;
			$this->Points = $AiEventAggregate->Points;
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>
