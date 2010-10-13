<?php
	/* GameDifficulties */
	define ('EASY', '0');
	define ('NORMAL', '1');
	define ('HEROIC', '2');
	define ('LEGENDARY', '3');
	define ('ALL', '255');
	
	/* GameVariants */
	define ('UNKNOWN', '0');
	define ('INVASION', '1');
	define ('ARENA', '2');
	define ('COMPETITIVE', '3');
	define ('CAMPAIGN', '4');
	define ('FIREFIGHT', '5');
	define ('CUSTOM', '6');


	function APIRequest($path){
		define('BASE_URL', 'http://www.bungie.net/api/reach/reachapijson.svc', false);
		$request = preg_replace('#/'.rawurlencode(APIKEY).'#', '', $path);	/* Remove the APIkey for additional use. */
		$localpath = LOCALCACHE . strtolower(substr($request,0,strrpos($request,"/")));
		$localfile = $localpath . strtolower(strrchr($request,"/")) . ".json";


		/* Horribly embarassing caching check, never show anyone */
		if (!@filemtime($localfile)) { $docache = true; }
		else
		{
			/*
			   Expire file and player content after 10 minutes. 10 minutes was chosen 
			   because that is the average time of a given match. Games do NOT expire.
			   A downloaded game will never need to be refreshed.
			*/

			if (strpos($path, "file", 1)   && (time() - filemtime($localpath) > 600)) { $docache = true; }
			if (strpos($path, "player", 1) && (time() - filemtime($localpath) > 600)) { $docache = true; }
		}

		if ($docache)
		{
		    // echo "<!-- Using Live Content for $request -->";	
			$rawjson = @file_get_contents(BASE_URL . $path);

			if(!$rawjson){
				throw new Exception('file_get_contents failed');
			}
			
			$json = json_decode($rawjson);
			if(!$json){
				throw new Exception('json_decode failed');
			}

			/* If the decode succeeded, proceed to cache the file locally. */
			if (!file_exists($localpath)) { mkdir($localpath, 0777, true) or die ("cannot create $localpath"); }
			$cache=fopen("$localfile", "w") or die("cannot open $localfile for writing");
			fwrite($cache, $rawjson) or die("cannot write $localfile");
			fclose($cache);
		}
		else
		{
			// echo "<!-- Using Cache for $request -->";
			$rawjson = @file_get_contents($localfile);

			if(!$rawjson){
				throw new Exception('file_get_contents failed');
			}

			$json = json_decode($rawjson);
			if(!$json){
				throw new Exception('json_decode failed');
			}
		}
		return $rawjson;
	}
	function getGameMetadata($useLocalCopy = true){
		///game/metadata/{identifier}
		
		if($useLocalCopy){
			$json = file_get_contents("resources/metadata.json");
			$json = json_decode($json);
			return new MetaDataResponse($json);
		}
		
		$path = '/game/metadata/' . rawurlencode(APIKEY);
		return new MetaDataResponse(json_decode(APIRequest($path)));
	}
	
	/*!	@function getCurrentChallenges
		@abstract returns a DateTime object from the Bungie formatted JSON date string.
		@param json string - if set, returns the json string
		@result GameChallengesResponse Object - challenges for the day
		@result string - json string unparsed
	 */
	function getCurrentChallenges($json = false){
		///game/challenges/{identifier}/
		$path = '/game/challenges/' . rawurlencode(APIKEY);
		$return = APIRequest($path);
		if ($json) { return $return; } else { return new GameDetailsResponse(json_decode($return)); }
	}
	
	function getGameHistory($gamertag, $variant_class = 'Unknown', $iPage = 0, $json = false){
		///player/gamehistory/{identifier}/{gamertag}/{variant_class_string}/{iPage}
		//variant_class = {"Campaign", "Firefight", "Competitive", "Arena", "Unknown"}
		$path = '/player/gamehistory/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag) . '/' . rawurlencode($variant_class) . '/' . $iPage;
		$return = APIRequest($path);
		if ($json) { return $return; } else { return new GameHistoryResponse(json_decode($return)); }
	}
	
	function getGameDetails($gameId, $json = false){
		///game/details/{identifier}/{gameId}
		$path = '/game/details/' . rawurlencode(APIKEY) . '/' . $gameId;
		$return = APIRequest($path);
		if ($json) { return $return; } else { return new GameDetailsResponse(json_decode($return)); }
	}
	
	function getPlayerDetailsWithStatsByMap($gamertag, $json = false){
		///player/details/bymap/{identifier}/{gamertag}
		$path = '/player/details/bymap/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag);
		$return = APIRequest($path);
		if ($json) { return $return; } else { return new PlayerDetailsResponse(json_decode($return)); }
	}
	
	function getPlayerDetailsWithStatsByPlaylist($gamertag, $json = false){
		///player/details/byplaylist/{identifier}/{gamertag}
		$path = '/player/details/byplaylist/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag);
		$return = APIRequest($path);
		if ($json) { return $return; } else { return new PlayerDetailsResponse(json_decode($return)); }
	}
	
	function getPlayerDetailsWithNoStats($gamertag, $json = false){
		///player/details/nostats/{identifier}/{gamertag}
		$path = '/player/details/nostats/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag);
		$return = APIRequest($path);
		if ($json) { return $return; } else { return new PlayerDetailsResponse(json_decode($return)); }
	}
	
	function getPlayerFileShare($gamertag, $json = false){
		///file/share/{identifier}/{gamertag}
		$path = '/file/share/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag);
		$return = APIRequest($path);
		if ($json) { return $return; } else { return new FileResponse(json_decode($return)); }
	}
	
	function getFileDetails($fileId, $json = false){
		///file/details/{identifier}/{fileId}
		$path = '/file/details/' . rawurlencode(APIKEY) . '/' . $fileId;
		$return = APIRequest($path);
		if ($json) { return $return; } else { return new FileResponse(json_decode($return)); }
	}
	function getPlayerRecentScreenshots($gamertag, $json = false){
		///file/screenshots/{identifier}/{gamertag}
		$path = '/file/screenshots/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag);
		$return = APIRequest($path);
		if ($json) { return $return; } else { return new FileResponse(json_decode($return)); }
	}
	function getPlayerFileSets($gamertag, $json = false){
		///file/sets/{identifier}/{gamertag}
		$path = '/file/sets/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag);
		$return = APIRequest($path);
		if ($json) { return $return; } else { return new FileResponse(json_decode($return)); }
	}
	function getPlayerFileSetFiles($gamertag, $fileSetId, $json = false){
		///file/sets/files/{identifier}/{gamertag}/{fileSetId}	
		$path = '/file/sets/files/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag) . '/' . $fileSetId;
		$return = APIRequest($path);
		if ($json) { return $return; } else { return new FileResponse(json_decode($return)); }
	}
	function getPlayerRenderedVideos($gamertag, $iPage = 0, $json = false){
		///file/videos/{identifier}/{gamertag}/{iPage}
		$path = '/file/videos/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag) . '/' . $iPage;
		$return = APIRequest($path);
		if ($json) { return $return; } else { return new FileResponse(json_decode($return)); }
	}
	function doReachFileSearch($file_category, $iPage = 0, $mapFilter = 'null', $engineFilter = 'null', $dateFilter = 'All', $sortFilter = 'MostRelevant', $tags = ''){
		///file/search/{identifier}/{file_category}/{MapFilter}/{engineFilter}/{DateFilter}/{SortFilter}/{iPage}?tags={tags}
		
		//file_category = {"Image", "GameClip", "GameMap", "GameSettings"}
		//mapFilter = {mapId, "null"}
		//engineFilter = {"Campaign", "Forge", "Multiplayer", "Firefight", "null"}
		//dateFilter = {"Day", "Week", "Month", "All"}
		//sortFilter = {"MostRelevant", "MostRecent", "MostDownloads", "HighestRated"}
		//tags = a semicolon delimited list of tags, otherwise blank
		
		$path = '/file/search/' . rawurlencode(APIKEY) . '/' . $file_category . '/' . $mapFilter . '/' . $engineFilter . '/' . $dateFilter . '/' . $sortFilter . '/' . $iPage . '?tags=' . $tags;
		$return = APIRequest($path);
		if ($json) { return $return; } else { return new FileResponse(json_decode($return)); }
	}

	//Other
	function __autoload($className){
		require_once($className . '.php');
	}
	function getBoolStr($bool){
		if($bool){
			return 'true';
		}
		return 'false';
	}
	function getPlacingSuffix($str){
		if($str === '11' || $str === '12' || $str === '13'){
			return 'th';
		}
		$sub = $str[strlen($str) - 1];
		if($sub === '1'){
			return 'st';
		}
		if($sub === '2'){
			return 'nd';
		}
		else if($sub === '3'){
			return 'rd';
		}
		else{
			return 'th';
		}
	}

	/*!	@function parseJSONDate
		@abstract returns a DateTime object from the Bungie formatted JSON date string.
		@param theDate string - string in "/Date(1234567890000-0000)/" format.
		@result DateTime Object - for ease of parsing and displaying in your timezone.
		@availability PHP 5.2 or greater.
		@discussion To display in your timezone:  date_timezone_set($date, timezone_open('America/New_York'));  echo date_format($date, 'Y-m-d H:i:sP') . "\n";
	 */
	function parseJSONDate($theDate)
	{
		$theDate = str_replace(array('/Date(', ')/'), '', $theDate);
		
		$expr = '/^\d{10}|(-|\+)\d+$/';
		preg_match_all($expr, $theDate, $theDate, PREG_PATTERN_ORDER);
		

		/* PHP 5.3.0 or greater */
		// $theDate = date_create_from_format('U O', ($theDate[0][0] . ' ' . $theDate[0][1]));
		// date_default_timezone_set(TIMEZONE);

		/* PHP 5.2.x */
		$theDate = date_create('@' . $theDate[0][0]);
		$theDate->setTimezone(new DateTimeZone(TIMEZONE));

		return $theDate;	
	}

	/*!	@function parseJSONTime
		@abstract returns a DateTime object from the Bungie formatted JSON playtime string.
		@param playtime string - string in "PT12D12H12M12S" format.
		@result array - array consistinging of total seconds and combined years, days, hours, minutes, and seconds
	 */
	function parseJSONTime($playtime)
	{
		$playtime = str_replace('PT', '', $playtime);
		$expr = '/\d+\w/';

		preg_match_all($expr, $playtime, $playtime, PREG_PATTERN_ORDER);

		$return = array("total" => 0, "years" => 0, "days" => 0, "hours" => 0, "minutes" => 0, "seconds" => 0);

		foreach($playtime[0] as $k=>$v)
		{
			if (substr($v,-1) == "S") { $return["seconds"] = substr($v,0,-1); $return["total"] += substr($v,0,-1); }
			if (substr($v,-1) == "M") { $return["minutes"] = substr($v,0,-1); $return["total"] += substr($v,0,-1)*60; }
			if (substr($v,-1) == "H") { $return["hours"] = substr($v,0,-1);   $return["total"] += substr($v,0,-1)*60*60; }
			if (substr($v,-1) == "D") { $return["days"] = substr($v,0,-1);    $return["total"] += substr($v,0,-1)*60*60*24; }
			if (substr($v,-1) == "Y") { $return["years"] = substr($v,0,-1);   $return["total"] += substr($v,0,-1)*60*60*24*365; }
		}

		return (array) $return;
	}

	function validateIPage($pageNum){
		$expr = '/^[1-9]+[0-9]*$/'; //Numbers shouldn't be beginning with a 0
		if(preg_match($expr, $page)){
			return true;
		}
		return false;
	}

	function validatePlayerGamertag($gamertag){
		/*
			Xbox gamertag rules
		
			1–15 characters
			a–z, A–Z, 0–9 and space
			it must begin alphabetically
			it cannot end in a space
			and it cannot contain two spaces in a row.
		*/
		
		$gamertagRegex = '/^(?=.{1,15}$)[a-zA-Z][a-zA-Z0-9]*(?: [a-zA-Z0-9]+)*$/';

		if(preg_match($gamertagRegex, $gamertag)){
			return true;
		}
		return false;
	}

	function generateEmblem($emblem, $size){
		$size=96;

		$bi = $emblem->background_index;
		$fi = $emblem->foreground_index;
		$fl = $emblem->flags;
		$c0 = $emblem->change_colors[0];
		$c1 = $emblem->change_colors[1];
		$c2 = $emblem->change_colors[2];
		$c3 = $emblem->change_colors[3]; 
	
		return "http://www.bungie.net/Stats/emblem.ashx?s=$size&0=$c0&1=$c1&2=$c2&3=$c3&fi=$fi&bi=$bi&fl=$fl&m=3";
	}

	function flush_buffers(){ 
		// Proper Flush Buffers command.
		ob_end_flush(); 
		ob_flush(); 
		flush(); 
		ob_start(); 
	} 

?>
