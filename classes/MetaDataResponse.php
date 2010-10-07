<?php
	require_once('GlobalFunctions.php');
	class MetaDataResponse extends APIResponse{
		private $Data; //GameMetadata
		
		public function __construct($MetaDataResponse){
			$this->reason = $MetaDataResponse->reason;
			$this->status = $MetaDataResponse->status;
			$this->Data = new GameMetadata($MetaDataResponse->Data);
		}
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>