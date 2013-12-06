<?php

require "config.php";

$db = new mysqli("$db_host","$dba_user","$dba_pass","$db_name");

$days = $_GET['days'];
$msc = microtime(true); //timer
$allGames = file("http://www.galcon.com/$dumpType/dump.php?days=$days", FILE_IGNORE_NEW_LINES);
$msc = microtime(true) - $msc; //timer
tookSeconds("download",$msc); //timer
$allGamesCount = count($allGames);

$entry = "SELECT id FROM $dbn_gamedata ORDER by abs(id) DESC";
$msc = microtime(true); //timer
$query = $db->query($entry);
$msc = microtime(true) - $msc; //timer
tookSeconds("query1",$msc); //timer
$row = $query->fetch_assoc();
$lastId = $row['id'];
$id = $lastId + 1;

for ($a = 0; $a < $allGamesCount; $a++)
{
	$currentGame = explode("|",$allGames[$a]);
	$currentGameCount = count($currentGame);
	
	if ($currentGameCount == 3)
	{
		$winnerArray = explode(":",$currentGame[0]);
		$loserArray = explode(":",$currentGame[1]);
		$timestampArray = explode(" ",$currentGame[2]);
		$timestampDateArray = explode("	",$timestampArray[0]);
		$timestampTimeArray = explode("	",$timestampArray[1]);
		$timestamp = "$timestampDateArray[1] $timestampTimeArray[0]";
		$winner = $winnerArray[0];
		$loser = $loserArray[0];
		
		$entry2 = "SELECT * FROM $dbn_gamedata WHERE timestamp LIKE '$timestamp' AND winner LIKE '$winner' AND loser LIKE '$loser'";
		$msc = microtime(true); //timer
		$query2 = $db->query($entry2);
		$msc = microtime(true) - $msc; //timer
		tookSeconds("query2",$msc); //timer
		$exists2 = $query2->num_rows;
		
		if ($exists2 == 0)
		{
			$entry = "INSERT INTO $dbn_gamedata (id, timestamp, winner, loser) VALUES ('$id','$timestamp','$winner','$loser')";
			$msc = microtime(true); //timer
			$query2 = $db->query($entry);
			$msc = microtime(true) - $msc; //timer
			tookSeconds("query3",$msc); //timer
			$id++;
		}
	}
}

echo "Script finished.";

function tookSeconds($name, $seconds) {
	echo "$name took $seconds seconds<br />";
}

?>