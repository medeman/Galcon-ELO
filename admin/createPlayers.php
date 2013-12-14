<?php

require "config.php";

$db = new mysqli("$db_host","$dba_user","$dba_pass","$db_name");

$entry = "SELECT winner, loser FROM $dbn_gamedata";
$query = $db->query($entry);
$count = $query->num_rows;

for ($i=0; $i<$count; $i++)
{
	$row = $query->fetch_assoc();
	
	$winner = $row['winner'];
	$loser = $row['loser'];
	
	$entry2 = "SELECT username FROM $dbn_players WHERE username LIKE '" . str_replace('_', '\\_',$winner) . "'";
	$query2 = $db->query($entry2);
	$count2 = $query2->num_rows;
	
	if ($count2 == 0)
	{
		$entry2 = "INSERT INTO $dbn_players(username, elo) VALUES ('$winner','1200')";
		$query2 = $db->query($entry2);
	}
	
	$entry2 = "SELECT username FROM $dbn_players WHERE username LIKE '" . str_replace('_', '\\_',$loser) . "'";
	$query2 = $db->query($entry2);
	$count2 = $query2->num_rows;
	
	if ($count2 == 0)
	{
		$entry2 = "INSERT INTO $dbn_players(username, elo) VALUES ('$loser','1200')";
		$query2 = $db->query($entry2);
	}
}

echo "Script finished.";

?>