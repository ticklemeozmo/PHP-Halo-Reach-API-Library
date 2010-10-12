<?php
	require_once("GlobalFunctions.php");
	interface iAverages{
		public function getAverageAssists();
		public function getAverageDeathDistance();
		public function getAverageKillDistance();
		public function getAverageBetrayals();
		public function getAverageDeaths();
		public function getAverageDNFs();
		public function getAverageHeadshots();
		public function getAverageGuests();
		public function getAverageKills();
		public function getAverageMultiMedalCount();
		public function getAverageOtherMedalCount();
		public function getAverageRating();
		public function getAverageScore();
		public function getAverageSpreeMedalCount();
		public function getAverageStyleMedalCount();
		public function getAverageSuicides();
		public function getAverageTotalMedalCount();
		public function getAverageUniqueMultiMedalCount();
		public function getAverageUniqueOtherMedalCount();
		public function getAverageUniqueSpreeMedalCount();
		public function getAverageUniqueStyleMedalCount();
		public function getAverageUniqueTotalMedalCount();
		public function getAverageKillDeathSpread();
		public function getAverageKillDeathRatio();
	}
?>
