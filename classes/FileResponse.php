<?php
	require_once('GlobalFunctions.php');
	class FileResponse extends APIResponse{
		private $Files = array(); //Array of ReachFile
		private $FileSets = array(); //Array of ReachFileSet
		
		public function __construct($APIResponse){
			$this->reason = $APIResponse->reason;
			$this->status = $APIResponse->status;
			
			if(isset($APIResponse->Files)){
				foreach($APIResponse->Files as $File){
					array_push($this->Files, new ReachFile($File));
				}
			}
			else{
				$this->Files = $APIResponse->Files;
			}
			
			if(isset($APIResponse->FileSets)){
				foreach($APIResponse->FileSets as $FileSet){
					array_push($this->FileSets, new ReachFileSet($FileSet));
				}
			}
			else{
				$this->FileSets = $APIResponse->FileSets;
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