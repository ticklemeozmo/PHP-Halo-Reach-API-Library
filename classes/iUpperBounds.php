<?php
	require_once("GlobalFunctions.php");
	interface iUpperBounds{
		public function getMostAssists();
		public function getHighestAverageDeathDistance();
		public function getHighestAverageKillDistance();
		public function getMostBetrayals();
		public function getMostDeaths();
		public function getMostHeadshots();		
		public function getMostKills();
		public function getHighestMultiMedalCount();
		public function getHighestOtherMedalCount();
		public function getHighestRating();
		public function getHighestScore();
		public function getHighestSpreeMedalCount();
		public function getHighestStyleMedalCount();
		public function getMostSuicides();
		public function getHighestTotalMedalCount();
		public function getHighestUniqueMultiMedalCount();
		public function getHighestUniqueOtherMedalCount();
		public function getHighestUniqueSpreeMedalCount();
		public function getHighestUniqueStyleMedalCount();
		public function getHighestUniqueTotalMedalCount();
		public function getHighestKillDeathSpread();
		public function getHighestKillDeathRatio();
	}
?>
