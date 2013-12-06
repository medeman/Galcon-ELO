<?php

require "config.php";

include_once 'eloRatingSystem.php';

$elo = new EloRatingSystem();

$db = new mysqli("$db_host","$dba_user","$dba_pass","$db_name");

$entry = "SELECT id, winner, loser, elofied FROM $dbn_gamedata WHERE elofied LIKE '0'";
$msc = microtime(true); //timer
$query = $db->query($entry);
$msc = microtime(true) - $msc; //timer
tookSeconds("query1",$msc); //timer
$count = $query->num_rows;

for ($i=0; $i<$count; $i++)
{
	$row = $query->fetch_assoc();
	
	$winner = $row['winner'];
	$loser = $row['loser'];
	$id = $row['id'];
	
	$entry2 = "SELECT elo, wins, losses FROM $dbn_players WHERE username LIKE '$winner'";
	$msc = microtime(true); //timer
	$query2 = $db->query($entry2);
	$msc = microtime(true) - $msc; //timer
	tookSeconds("query2",$msc); //timer
	$row2 = $query2->fetch_assoc();
	$winnerElo = $row2['elo'];
	$wins = $row2['wins'] + 1;
	$gamesA = $wins + $row2['losses'];
	
	$entry2 = "SELECT elo, wins, losses FROM $dbn_players WHERE username LIKE '$loser'";
	$msc = microtime(true); //timer
	$query2 = $db->query($entry2);
	$msc = microtime(true) - $msc; //timer
	tookSeconds("query3",$msc); //timer
	$row2 = $query2->fetch_assoc();
	$loserElo = $row2['elo'];
	$losses = $row2['losses'] + 1;
	$gamesB = $row2['wins'] + $losses; //currently unused
	
	if ($gamesA <= 30)
	{
		$kValue = 25;
	}
	else if ($winnerElo < 2400)
	{
		$kValue = 15;
	}
	else
	{
		$kValue = 10;
	}
	
	$game = $elo -> setGame( $winnerElo, $loserElo, 1, $kValue );
	
	// 0 = player A
	$newEloA = $elo -> getEloPlayers( 0 );
	$winnerElo = $newEloA['newElo'];
	
	// 1 = player B
	$newEloB = $elo -> getEloPlayers( 1 );
	$loserElo = $newEloB['newElo'];
	
	$entry2 = "UPDATE $dbn_players SET elo='$winnerElo', wins='$wins' WHERE username LIKE '$winner'";
	$msc = microtime(true); //timer
	$query2 = $db->query($entry2);
	$msc = microtime(true) - $msc; //timer
	tookSeconds("query4",$msc); //timer
	
	$entry2 = "UPDATE $dbn_players SET elo='$loserElo', losses='$losses' WHERE username LIKE '$loser'";
	$msc = microtime(true); //timer
	$query2 = $db->query($entry2);
	$msc = microtime(true) - $msc; //timer
	tookSeconds("query5",$msc); //timer
	
	$entry2 = "UPDATE $dbn_gamedata SET elofied='1' WHERE id LIKE '$id'";
	$msc = microtime(true); //timer
	$query2 = $db->query($entry2);
	$msc = microtime(true) - $msc; //timer
	tookSeconds("query6",$msc); //timer
}

echo "Script finished.";

function tookSeconds($name, $seconds) {
	echo "$name took $seconds seconds<br />";
}

?>