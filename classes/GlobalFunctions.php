<?php	
	//Requests
	function APIRequest($path){
		define('BASE_URL', 'http://www.bungie.net/api/reach/reachapijson.svc', false);
		$request = preg_replace('#/.{46}/#', '/', $path);
		$localpath = "/home/htdocs/halo/cache" . strtolower(substr($request,0,strrpos($request,"/")));
		$localfile = $localpath . strtolower(strrchr($request,"/")) . ".json";

		// Horribly embarassing caching check, never show anyone
		if (!@filemtime($localfile)) { $docache = true; }
		else
		{
			if (strpos($path, "file", 1)   && (time() - filemtime($localpath) > 600)) { $docache = true; }
			if (strpos($path, "player", 1) && (time() - filemtime($localpath) > 600)) { $docache = true; }
		}

		if ($docache)
		{
		    echo "<!-- Using Live Content for $request -->";	
			$rawjson = @file_get_contents(BASE_URL . $path);

			if(!$rawjson){
				throw new Exception('file_get_contents failed');
			}
			
			$json = json_decode($rawjson);
			if(!$json){
				throw new Exception('json_decode failed');
			}

			if (!file_exists($localpath)) { mkdir($localpath, 0777, true) or die ("cannot create $localpath"); }
			$cache=fopen("$localfile", "w") or die("cannot open $localfile for writing");
			fwrite($cache, $rawjson) or die("cannot write $localfile");  //write contents of feed to cache file
			fclose($cache);
		}
		else
		{
			echo "<!-- Using Cache for $request -->";
			$rawjson = @file_get_contents($localfile);

			if(!$rawjson){
				throw new Exception('file_get_contents failed');
			}

			$json = json_decode($rawjson);
			if(!$json){
				throw new Exception('json_decode failed');
			}
		}
		return $json;
	}
	function getGameMetadata($useLocalCopy = true){
		///game/metadata/{identifier}
		
		if($useLocalCopy){
			$json = file_get_contents("resources/metadata.json");
			$json = json_decode($json);
			return new MetaDataResponse($json);
		}
		
		$path = '/game/metadata/' . rawurlencode(APIKEY);
		return new MetaDataResponse(APIRequest($path));
	}
	function getGameHistory($gamertag, $variant_class = 'Unknown', $iPage = 0){
		///player/gamehistory/{identifier}/{gamertag}/{variant_class_string}/{iPage}
		//variant_class = {"Campaign", "Firefight", "Competitive", "Arena", "Unknown"}
		$path = '/player/gamehistory/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag) . '/' . rawurlencode($variant_class) . '/' . $iPage;
		return new GameHistoryResponse(APIRequest($path));
	}
	function getGameDetails($gameId){
		///game/details/{identifier}/{gameId}
		$path = '/game/details/' . rawurlencode(APIKEY) . '/' . $gameId;
		return new GameDetailsResponse(APIRequest($path));
	}
	function getPlayerDetailsWithStatsByMap($gamertag){
		///player/details/bymap/{identifier}/{gamertag}
		$path = '/player/details/bymap/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag);
		return new PlayerDetailsResponse(APIRequest($path));
	}
	function getPlayerDetailsWithStatsByPlaylist($gamertag){
		///player/details/byplaylist/{identifier}/{gamertag}
		$path = '/player/details/byplaylist/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag);
		return new PlayerDetailsResponse(APIRequest($path));
	}
	function getPlayerDetailsWithNoStats($gamertag){
		///player/details/nostats/{identifier}/{gamertag}
		$path = '/player/details/nostats/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag);
		return new PlayerDetailsResponse(APIRequest($path));
	}
	function getPlayerFileShare($gamertag){
		///file/share/{identifier}/{gamertag}
		$path = '/file/share/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag);
		return new FileResponse(APIRequest($path));
	}
	function getFileDetails($fileId){
		///file/details/{identifier}/{fileId}
		$path = '/file/details/' . rawurlencode(APIKEY) . '/' . $fileId;
		return new FileResponse(APIRequest($path));
	}
	function getPlayerRecentScreenshots($gamertag){
		///file/screenshots/{identifier}/{gamertag}
		$path = '/file/screenshots/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag);
		return new FileResponse(APIRequest($path));
	}
	function getPlayerFileSets($gamertag){
		///file/sets/{identifier}/{gamertag}
		$path = '/file/sets/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag);
		return new FileResponse(APIRequest($path));
	}
	function getPlayerFileSetFiles($gamertag, $fileSetId){
		///file/sets/files/{identifier}/{gamertag}/{fileSetId}	
		$path = '/file/sets/files/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag) . '/' . $fileSetId;
		return new FileResponse(APIRequest($path));
	}
	function getPlayerRenderedVideos($gamertag, $iPage = 0){
		///file/videos/{identifier}/{gamertag}/{iPage}
		$path = '/file/videos/' . rawurlencode(APIKEY) . '/' . rawurlencode($gamertag) . '/' . $iPage;
		return new FileResponse(APIRequest($path));
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
		return new FileResponse(APIRequest($path));
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
	function parseJSONDate($theDate){
		$theDate = str_replace(array('/Date(', ')/'), '', $theDate);
		
		$expr = '/^\d{10}|(-|\+)\d+$/';
		preg_match_all($expr, $theDate, $theDate, PREG_PATTERN_ORDER);
		
		date_default_timezone_set('America/Los_Angeles');
		
		//$theDate = date_create_from_format('U O', ($theDate[0][0] . ' ' . $theDate[0][1]));
		//Webhost has old[er] PHP version, refer to function below for compatibile workaround

		$theDate = date_create('@' . $theDate[0][0]);
		$theDate->setTimezone(new DateTimeZone('America/Los_Angeles'));
		
		return $theDate;	
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

?>
