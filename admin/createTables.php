<?php

require "config.php";

$db = new mysqli("$db_host","$dba_user","$dba_pass","$db_name");

$entry = "DROP TABLE IF EXISTS `$dbn_gamedata`";
$query = $db->query($entry);

$entry = "CREATE TABLE IF NOT EXISTS `$dbn_gamedata` (`id` int(11) NOT NULL, `elofied` int(11) NOT NULL, `timestamp` datetime NOT NULL, `winner` text NOT NULL, `loser` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$query = $db->query($entry);

$entry = "DROP TABLE IF EXISTS `$dbn_players`";
$query = $db->query($entry);

$entry = "CREATE TABLE IF NOT EXISTS `$dbn_players` (`username` text NOT NULL, `elo` int(11) NOT NULL, `wins` int(11) NOT NULL, `losses` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$query = $db->query($entry);

echo "Script finished.";

?>