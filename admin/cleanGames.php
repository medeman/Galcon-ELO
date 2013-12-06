<?php

require "config.php";

$db = new mysqli("$db_host","$dba_user","$dba_pass","$db_name");

if (isset($_GET['rows']))
{
	$rows = $_GET['rows'];
	$entry = "DELETE FROM $dbn_gamedata ORDER by abs(id) ASC LIMIT $rows";
}
/*else if (isset($_GET['years']) && isset($_GET['months']) && isset($_GET['days']))
{
	$years = $_GET['years'];
	$months = $_GET['months'];
	$days = $_GET['days'];
	echo "Date mode.";
}*/
else
{
	echo "Invalid input.";
}

$query = $db->query($entry);

echo "Script finished.";

?>