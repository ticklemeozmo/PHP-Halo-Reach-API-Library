<?php
	require_once("classes/GlobalFunctions.php");
	
	//Don't forget to remove the above line of code after you're sure everything is working correctly.
	
	/*This file contains some examples to get you started. Classes are structed almost identically to the
		schemas provided by bungie.net / the object browser in Visual Studio. You should look in the
		class files for definite answers, however.
		
		Check back to the thread on bungie.net for updates to this.
	*/
	
	//These variables are examples only. They may or may not work and are for demonstrative purposes only.
	
	/*
		getGameMetadata();
		
		This function assumes you have a metadata file in your resources folder named
		"resources.json". If it's not there, make sure you get a copy.
		
		Arguments:
			$useLocalCopy = true: Specifies whether to use a locally cached copy, or
				make a request to bungie.net; default is true (use the cached copy).
		
		Returns:
			MetaDataResponse
	*/
	/*
		$metadata = getGameMetadata();
		echo $metadata->Data->getCommendationById(3)->Description;
	*/
	
	
	
	/*
		getGameHistory();
	
		Returns a list of recent games
	
		Arguments:
			$gamertag: A player's gamertag
			$variant_class: Type of variant list to filter by ("Campaign", "Firefight", "Competitive", "Arena", "Unknown"). Default is "Unknown"
			$iPage: 0-based pagination. Default is 0
			$json = false: If true, returns the JSON as a string.
	
		Returns:
			GameHistoryResponse
	*/
	/*
		$history = getGameHistory($gamertag);
		foreach($history->RecentGames as $RecentGame){
			echo '<a href="game.php?gameId=' . $RecentGame->GameId . '">game.php?gameId=' . $RecentGame->GameId . '</a><br />';
		}		
	*/
	
	
	
	/*
		getGameDetails();
		
		Returns details about a game
		
		Arguments:
			$gameId: A gameId value
			$json = false: If true, returns the JSON as a string.
	
		Returns:
			Game	
	*/
/*	
		$game = getGameDetails($gameId);
		echo $game->GameDetails->MapName;
*/	
	
	
	
	/*
		getPlayerDetailsWithStatsByMap();
	
		Returns an absolute -blam!-load of stats about a player and maps they've played on.
		
		Arguments:
			$gamertag: A player's gamertag
			$json = false: If true, returns the JSON as a string.
			
		Returns:
			PlayerDetailsResponse
	*/
	/*
		$statsByMap = getPlayerDetailsWithStatsByMap($gamertag);
		echo '<img src="http://bungie.net' . $statsByMap->PlayerModelUrl . '" />';
	*/
	
	
	
	/*
		getPlayerDetailsWithStatsByPlaylist();
		
		Returns loads of stats about a player and the playlists they've played in.
		
		Arguments:
			$gamertag: A player's gamertag
			$json = false: If true, returns the JSON as a string.
			
		Returns:
			PlayerDetailsResponse
	*/
	/*
		$statsByPlaylist = getPlayerDetailsWithStatsByPlaylist($gamertag);
		foreach($statsByPlaylist->StatisticsByPlaylist as $StatisticByPlaylist){
			//Iterate over each playlist, output total kills for each
			echo $StatisticByPlaylist->total_kills . '<br />';
		}
	*/
	
	
	
	/*
		getPlayerDetailsWithNoStats();
		
		Returns basic details about a player (much less than the other two function above)
		
		Arguments:
			$gamertag: A player's gamertag
			$json = false: If true, returns the JSON as a string.
			
		Returns:
			PlayerDetailsResponse
	*/
	
		$noStats = getPlayerDetailsWithNoStats($gamertag);
       
		// display player details
		echo "<div>";
		printf("<img src=http://bungie.net%s width=104 height=198>", $noStats->PlayerModelUrl);
		printf("<br/>Player Details: %s (%s)", $noStats->Player->gamertag, $noStats->Player->service_tag);

		 // Challenges information
		 printf("<br/>Campaign Progress Single Player: %s", $noStats->Player->CampaignProgressSp);
		 printf("<br/>Commendation Progress: %2d%%", 100*$noStats->Player->commendation_completion_percentage);
		 printf("<br/>Daily Challenges Completed: %d", $noStats->Player->daily_challenges_completed);
		 printf("<br/>Weekly Challenges Completed: %d", $noStats->Player->weekly_challenges_completed);

		 // Last game type played
		 printf("<br/>Last Game Type Played: %s", $noStats->Player->LastGameVariantClassPlayed);

		echo "</div>";
	
		/*

	   getPlayerFileShare();
	
		Returns a list of files and file sets in a player's file share
		
		Arguments:
			$gamertag: A player's gamertag
			$json = false: If true, returns the JSON as a string.
	
		Returns:
			FileResponse
	*/
	/*
		$fileShare = getPlayerFileShare($gamertag);
		foreach($fileShare->Files as $File){
			echo $File->Title . ': ' . $File->FileId . '<br />'; //Iterate over each file and output its title
		}
	*/
	
	
	
	/*
		getFileDetails();
		
		Returns details about a file
	
		Arguments:
			$fileId: Id value of a file
			$json = false: If true, returns the JSON as a string.
			
		Returns:
			ReachFile
	*/
	/*
		$file = getFileDetails($fileId);
		echo $file->Files[0]->Author;
	*/
	
	
	
	/*
		getPlayerRecentScreenshots();
	
		Returns a list of a player's recent screenshots
		
		Arguments:
			$gamertag: A player's gamertag
	
		Returns:
			FileResponse
	*/
	/*
		$recentSShots = getPlayerRecentScreenshots($gamertag);
		foreach($recentSShots->Files as $SShot){
			echo '<img src="http://bungie.net' . $SShot->ScreenshotThumbnailUrl . '" /><br />';
		}
	*/
	
	
	
	/*
		getPlayerFileSets();
		
		Returns a list of a player's file sets
		
		Arguments:
			$gamertag: A player's gamertag
			$json = false: If true, returns the JSON as a string.
			
		Returns:
			FileResponse
	*/
	/*
		$fileSets = getPlayerFileSets($gamertag);
		foreach($fileSets->FileSets as $fileSet){
			echo $fileSet->Name . ': ' . $fileSet->Id . '<br />'; //Each file set's Name and Id
		}
	*/
	
	
	
	/*
		getPlayerFileSetFiles();
		
		Returns a list of files in a file set
	
		Arguments:
			$gamertag: A player's gamertag
			$fileSetId: Id of a file set the player has
			$json = false: If true, returns the JSON as a string.
			
		Returns:
			FileResponse
	*/
	/*
		$fileSetFiles = getPlayerFileSetFiles($gamertag, $fileSetId);
		foreach($fileSetFiles->Files as $File){
			echo $File->Title . '<br />';
		}
	*/
	
	
	
	/*
		getPlayerRenderedVideos();
	
		Returns a list of rendered videos
		
		Arguments:
			$gamertag: A player's gamertag
			$iPage: 0-based pagination. Default is 0
			$json = false: If true, returns the JSON as a string.
			
		Returns:
			FileResponse
	*/
	/*
		$renderedVideos = getPlayerRenderedVideos($gamertag);
		foreach($renderedVideos->Files as $renderedVideo){
			echo '<a href="' . $renderedVideo->RenderedWMVPath . '">Download!</a><br />';
		}
	*/
	
	
	
	/*
		doReachFileSearch();
	
		Returns a list of files based on search terms
		
		Arguments:
			$file_category: The category to search in ("Image", "GameClip", "GameMap", "GameSettings")
			$iPage: 0-based pagination. Default is 0
			$mapFilter: A mapId. Default is "null" which is essentially no map filter
			$engineFiler: Game mode to filter by ("Campaign", "Forge", "Multiplayer", "Firefight", "null"). Default is "null"
			$dateFilter: Self explanatory ("Day", "Week", "Month", "All"). Default is "All"
			$sortFilter: Further filtering ("MostRelevant", "MostRecent", "MostDownloads", "HighestRated"). Default is "MostRelevant"
			$tags: Semicolon delimited list of tags to include. Default is "" (no tags)
			$json = false: If true, returns the JSON as a string.
	
		Returns:
			FileResponse
	*/
	/*
		//The following are valid argument lists
		$fileSearch = doReachFileSearch('GameClip');
		$fileSearch = doReachFileSearch('Image', 0, 5010, 'Campaign', 'Month', 'MostDownloads', 'carter;kat;noble');
		$fileSearch = doReachFileSearch('GameClip', 3, '5020', 'null', 'Week', 'HighestRated', '');
		
		//This is an INVALID search
		//$fileSearch = doReachFileSearch('Image', , 7030); //You cannot skip a default argument then specify another to the right of it
	
		foreach($fileSearch->Files as $File){
			echo '&quot;' . $File->Title . '&quot; which is a ' . $File->FileCategory . ' and is by ' . $File->Author . '<br />';
		}
	
	*/	
?>
