<?php
	require_once("GlobalFunctions.php");
	interface iTotals{
		public function getTotalAssists();
		public function getTotalBetrayals();
		public function getTotalDeaths();
		public function getTotalDNFs();
		public function getTotalHeadshots();
		public function getTotalGuests();		
		public function getTotalKills();
		public function getTotalMultiMedalCount();
		public function getTotalOtherMedalCount();
		public function getTotalRating();
		public function getTotalScore();
		public function getTotalSpreeMedalCount();
		public function getTotalStyleMedalCount();
		public function getTotalSuicides();
		public function getTotalMedalCount();
		public function getTotalUniqueMultiMedalCount();
		public function getTotalUniqueOtherMedalCount();
		public function getTotalUniqueSpreeMedalCount();
		public function getTotalUniqueStyleMedalCount();
		public function getTotalUniqueTotalMedalCount();
		public function getTotalKillDeathRatio();
		public function getTotalKillDeathSpread();
	}
?>
