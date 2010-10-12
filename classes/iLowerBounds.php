<?php
	require_once("GlobalFunctions.php");
	interface iLowerBounds{
		public function getLeastAssists();
		public function getLowestAverageDeathDistance();
		public function getLowestAverageKillDistance();
		public function getLeastBetrayals();
		public function getLeastDeaths();
		public function getLeastHeadshots();		
		public function getLeastKills();
		public function getLowestMultiMedalCount();
		public function getLowestOtherMedalCount();
		public function getLowestRating();
		public function getLowestScore();
		public function getLowestSpreeMedalCount();
		public function getLowestStyleMedalCount();
		public function getLeastSuicides();
		public function getLowestTotalMedalCount();
		public function getLowestUniqueMultiMedalCount();
		public function getLowestUniqueOtherMedalCount();
		public function getLowestUniqueSpreeMedalCount();
		public function getLowestUniqueStyleMedalCount();
		public function getLowestUniqueTotalMedalCount();
		public function getLowestKillDeathSpread();
		public function getLowestKillDeathRatio();
	}
?>
