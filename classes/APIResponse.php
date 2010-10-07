<?php
	require_once('GlobalFunctions.php');
	abstract class APIResponse{
		protected $reason; //String
		protected $status; //Integer
		
		public function __get($a){
			return $this->$a;
		}
		public function __toString(){
			return __CLASS__;
		}		
		
		//Custom
		public function isValidResponse(){
			if(isset($this->status) && $this->status === 0){
				return true;
			}
			return false;
		}
	}
?>