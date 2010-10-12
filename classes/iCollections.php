<?php
	require_once("GlobalFunctions.php");
	interface iCollections{
		public function getAllAiEventAggregates();
		public function getAllDeathsOverTime();
		public function getAllKillsOverTime();
		public function getAllMedalsOverTime();
		public function getAllPlayerDetails();
		public function getAllPointsOverTime();
		public function getAllSpecificMedalCounts();
		public function getAllWeaponCarnageReports();
		public function getAllGuests();
		public function getAllNonGuests();
		public function getAllDNFs();
		public function getAllNonDNFs();
	}
?>
