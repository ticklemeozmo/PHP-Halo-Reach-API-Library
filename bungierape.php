<?php
/*
   bungierape.php

   Pre-caches game files for a gamertag.

   Game files do not change once they are posted, so there is never a need to
   redownload them.  In the event you want to import the games or use metrics
   across many games, it's better to have them local than to grab them in an
   unsafe manner.

   NOTE: You are highly cautioned to NOT remove the sleep() command.  Bungie
   allows 300 requests per minute on your API key and removal of that line
   will loop as fast as your processor will allow.
*/

require_once("config.php");

if (validatePlayerGamertag($_GET['gamertag'])){
	$gamertag = $_GET['gamertag'];
}
else
{
	die("No gamertag supplied.  Rerun with bungierape.php?gamertag=SomeGamerTag");
}

?>
<script>
function pageScroll() {
	window.scrollBy(0,50); // horizontal and vertical scroll increments
	scrolldelay = setTimeout('pageScroll()',100); // scrolls every 100 milliseconds
}
setTimeout('pageScroll()',100);
</script>
<?
$more = true;
$count = 0;

echo "Pre-caching games for $gamertag...<br/>";

while($more)
{
	$history = getGameHistory($gamertag, "Unknown", $count);
	foreach($history->RecentGames as $Game){
		echo 'Downloading: ' . $Game->GameId . ' - ' . $Game->GameVariantName . ' on ' . $Game->MapName . '<br />';
		flush_buffers();
		$game = getGameDetails($Game->GameId);
	}
	sleep(3);		// THIS IS IMPORTANT! Removal of this line could ban your API key, you only get 300 requests per minute!
	$more = $history->HasMorePages;
	$count++;
	if ($more) { echo "Retrieving page $count<br/>"; }
	flush_buffers();
}

?>

