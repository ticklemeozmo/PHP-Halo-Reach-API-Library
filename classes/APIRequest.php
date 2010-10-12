<?php
	require_once('GlobalFunctions.php');
	abstract class APIRequest{
		const BASE_URL = 'http://www.bungie.net/api/reach/reachapijson.svc';
		/*
			The following variables/constants are used in conjunction with the readSemaphore(),
			incrementSemaphore(), decrementSemaphore(), and OKSemaphore() functions as well as
			some code which is commented out within makeRequest().
		
			They are used to enforce rate limiting (5 per second) for any requests coming in. If
			you choose to use what's here, be sure to point the SEM_REQ_FILENAME constant to a
			file containing a single integer value. This value should NEVER be less than 0, nor
			greater than 5. When you create the file, place a "0" in it.
			
			There may be still be some problems with this (ie. race conditions, exceptions not
			being thrown properly, etc...), which is why it's commented out. If you choose to
			use it, then here's a starting point.
		
			const SEM_REQ_FILENAME = '../ReachAPI_PHP-JSON/resources/SEM_REQ.txt';
			const MAX_SEM_LOCK_WAIT = 250000; //in microseconds (millionth of a second), 250000 is 0.25 seconds
			const MAX_SEM_LOCK_TRIES = 5;
		
			const MAX_REQ_TRIES = 5;
			const MAX_REQ_WAIT = 250000;
		
			const MAX_API_REQ = 5;
		
			private static $CUR_LOCK_TRIES = 0;
			private static $CUR_REQ_TRIES = 0;
		*/
		
		private function readSemaphore(){
			if(file_exists(self::SEM_REQ_FILENAME)){
				if(is_readable(self::SEM_REQ_FILENAME) && is_writeable(self::SEM_REQ_FILENAME)){
					$file = fopen(self::SEM_REQ_FILENAME, "r");
					while(!flock($file, LOCK_EX)){
						self::$CUR_REQ_TRIES++;
						if(self::$CUR_REQ_TRIES > self::MAX_SEM_LOCK_TRIES){
							throw new Exception("Couldn't get a lock");
						}
						usleep(self::MAX_SEM_LOCK_WAIT);
					}
						
					$sem = fread($file, 1);
					flock($file, LOCK_UN);
					fclose($file);
					
					return $sem;
				}
			}
		}
		private function incrementSemaphore(){
			$sem = self::readSemaphore();
			$file = fopen(self::SEM_REQ_FILENAME, "w+");
			flock($file, LOCK_EX);
			$sem++;
			fwrite($file, $sem);
			flock($file, LOCK_UN);
			fclose($file);
		}
		private function decrementSemaphore(){
			$sem = self::readSemaphore();
			$file = fopen(self::SEM_REQ_FILENAME, "w+");
			flock($file, LOCK_EX);
			$sem--;
			fwrite($file, $sem, 1);
			flock($file, LOCK_UN);
			fclose($file);
		}
		private function OKSemaphore(){		
			while(self::$CUR_REQ_TRIES < self::MAX_REQ_TRIES){
				$sem = self::readSemaphore();
				if($sem < self::MAX_API_REQ){
					return true;
				}
				self::$CUR_REQ_TRIES++;
				continue;
			}
			throw new Exception("API request timeout");
		}
		
		private function makeRequest($path){
			//Semaphore-based requests, commented out by default
			/*
			try{
				self::OKSemaphore();			
				self::incrementSemaphore();
				//Critical section
				
				if(function_exists('curl_init')){
					//Use cURL
					$ch = curl_init($path);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_HEADER, false);
					$result = curl_exec($ch);
				}
				else{
					//Use file_get_contents
					$result = file_get_contents($path);			
				}

			}
			catch(Exception $e){
				self::decrementSemaphore();
				throw new Exception($e);
			}
			
			self::decrementSemaphore();
			//End Critical section
			*/
			
			if(function_exists('curl_init')){
				//Use cURL
				$ch = curl_init($path);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, false);
				$result = curl_exec($ch);
			}
			else{
				//Use file_get_contents
				$result = file_get_contents($path);			
			}
			
			if(!$path || (isset($ch) && curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200)){
				throw new Exception('transfer failed');
			}
				
			if(isset($ch)){
				curl_close($ch);
			}
				
			$result = json_decode($result);
			if(!$result){
				throw new Exception('json_decode failed');
			}
				
			return $result;
		}
		
		//Public members
		public static function getGameMetadata($id, $useLocalCopy = true){
			///game/metadata/{identifier}
			
			if($useLocalCopy){
				$json = file_get_contents("resources/metadata.json");			
				$json = json_decode($json);
				return new MetaDataResponse($json);
			}
			
			$path = self::BASE_URL . '/game/metadata/' . rawurlencode($id);
			return new MetaDataResponse(self::makeRequest($path));
		}
		public static function getGameHistory($id, $gamertag, $variant_class = 'Unknown', $iPage = 0){
		///player/gamehistory/{identifier}/{gamertag}/{variant_class_string}/{iPage}
		
		//variant_class = {"Campaign", "Firefight", "Competitive", "Arena", "Unknown"}
		
		$path = self::BASE_URL . '/player/gamehistory/' . rawurlencode($id) . '/' . rawurlencode($gamertag) . '/' . rawurlencode($variant_class) . '/' . $iPage;
		return new GameHistoryResponse(self::makeRequest($path));
	}
		public static function getGameDetails($id, $gameId){
			///game/details/{identifier}/{gameId}
			$path = self::BASE_URL . '/game/details/' . rawurlencode($id) . '/' . $gameId;
			return new GameDetailsResponse(self::makeRequest($path));
		}
		public static function getPlayerDetailsWithStatsByMap($id, $gamertag){
			///player/details/bymap/{identifier}/{gamertag}
			$path = self::BASE_URL . '/player/details/bymap/' . rawurlencode($id) . '/' . rawurlencode($gamertag);
			return new PlayerDetailsResponse(self::makeRequest($path));
		}
		public static function getPlayerDetailsWithStatsByPlaylist($id, $gamertag){
			///player/details/byplaylist/{identifier}/{gamertag}
			$path = self::BASE_URL . '/player/details/byplaylist/' . rawurlencode($id) . '/' . rawurlencode($gamertag);
			return new PlayerDetailsResponse(self::makeRequest($path));
		}
		public static function getPlayerDetailsWithNoStats($id, $gamertag){
			///player/details/nostats/{identifier}/{gamertag}
			$path = self::BASE_URL . '/player/details/nostats/' . rawurlencode($id) . '/' . rawurlencode($gamertag);
			return new PlayerDetailsResponse(self::makeRequest($path));
		}
		public static function getPlayerFileShare($id, $gamertag){
			///file/share/{identifier}/{gamertag}
			$path = self::BASE_URL . '/file/share/' . rawurlencode($id) . '/' . rawurlencode($gamertag);
			return new FileResponse(self::makeRequest($path));
		}
		public static function getFileDetails($id, $fileId){
			///file/details/{identifier}/{fileId}
			$path = self::BASE_URL . '/file/details/' . rawurlencode($id) . '/' . $fileId;
			return new FileResponse(self::makeRequest($path));
		}
		public static function getPlayerRecentScreenshots($id, $gamertag){
			///file/screenshots/{identifier}/{gamertag}
			$path = self::BASE_URL . '/file/screenshots/' . rawurlencode($id) . '/' . rawurlencode($gamertag);
			return new FileResponse(self::makeRequest($path));
		}
		public static function getPlayerFileSets($id, $gamertag){
			///file/sets/{identifier}/{gamertag}
			$path = self::BASE_URL . '/file/sets/' . rawurlencode($id) . '/' . rawurlencode($gamertag);
			return new FileResponse(self::makeRequest($path));
		}
		public static function getPlayerFileSetFiles($id, $gamertag, $fileSetId){
			///file/sets/files/{identifier}/{gamertag}/{fileSetId}	
			$path = self::BASE_URL . '/file/sets/files/' . rawurlencode($id) . '/' . rawurlencode($gamertag) . '/' . $fileSetId;
			return new FileResponse(self::makeRequest($path));
		}
		public static function getPlayerRenderedVideos($id, $gamertag, $iPage = 0){
			///file/videos/{identifier}/{gamertag}/{iPage}
			$path = self::BASE_URL . '/file/videos/' . rawurlencode($id) . '/' . rawurlencode($gamertag) . '/' . $iPage;
			return new FileResponse(self::makeRequest($path));
		}
		public static function doReachFileSearch($id, $file_category, $iPage = 0, $mapFilter = 'null', $engineFilter = 'null', $dateFilter = 'All', $sortFilter = 'MostRelevant', $tags = ''){
			///file/search/{identifier}/{file_category}/{MapFilter}/{engineFilter}/{DateFilter}/{SortFilter}/{iPage}?tags={tags}
			
			//file_category = {"Image", "GameClip", "GameMap", "GameSettings"}
			//mapFilter = {mapId, "null"}
			//engineFilter = {"Campaign", "Forge", "Multiplayer", "Firefight", "null"}
			//dateFilter = {"Day", "Week", "Month", "All"}
			//sortFilter = {"MostRelevant", "MostRecent", "MostDownloads", "HighestRated"}
			//tags = a semicolon delimited list of tags, otherwise blank
			
			$path = self::BASE_URL . '/file/search/' . rawurlencode($id) . '/' . $file_category . '/' . $mapFilter . '/' . $engineFilter . '/' . $dateFilter . '/' . $sortFilter . '/' . $iPage . '?tags=' . $tags;
			return new FileResponse(self::makeRequest($path));
		}
		public function __toString(){
			return __CLASS__;
		}
	}
?>
