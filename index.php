<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style/style.css" />
		<link rel="stylesheet" type="text/css" href="style/jquery.dataTables.css" />
		<script src="js/jquery-1.10.2.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#f00').dataTable({
					'aaSorting': [[1, 'desc']]
				});
			} );
		</script>
	</head>
	<body>
		<div id="wrapper">
<?php

require "admin/config.php";

$db = new mysqli("$db_host","$db_user","$db_pass","$db_name");
$query = $db->query("SELECT * FROM $dbn_players");
$amount = $query->num_rows;
?>
			<table id="f00">
				<thead>
					<tr><td colspan="1">Name</td><td>Elo</td><td>Wins</td><td>Losses</td><td>W/L ratio</td><td>Games played</td></tr>
				</thead>
				<tbody>
<?php

for ($i=0; $i<$amount; $i++)
{
	$row = $query->fetch_assoc();
	
	$flag = getFlag($row['elo']);
	$wins = $row['wins'];
	$losses = $row['losses'];
	if ($losses == 0)
	{
		$wl = 0;
	}
	else
	{
		$wl = $wins / $losses;
		$wl = substr($wl,0,4);
	}
	$games = $wins + $losses;
	echo "<tr><td><img src=\"style/rank/rank$flag.png\" width=\"18\" /> ", $row['username'], "</td><td>", $row['elo'], "</td><td>", $wins, "</td><td>", $losses, "</td><td>", $wl, "</td><td>", $games, "</td></tr>";
}

?>
				</tbody>
			</table>
		</div>
	</body>
</html>

<?php

function getFlag($elo) {
		if ($elo > 2950) { return 15; }
	elseif ($elo > 2500) { return 14; }
	elseif ($elo > 2000) { return 13; }
	elseif ($elo > 1700) { return 12; }
	elseif ($elo > 1550) { return 11; }
	elseif ($elo > 1450) { return 10; }
	elseif ($elo > 1375) { return 9; }
	elseif ($elo > 1300) { return 8; }
	elseif ($elo > 1250) { return 7; }
	elseif ($elo > 1200) { return 6; }
	elseif ($elo > 1150) { return 5; }
	elseif ($elo > 1100) { return 4; }
	elseif ($elo > 1050) { return 3; }
	elseif ($elo > 1000) { return 2; }
	elseif ($elo <= 1000) { return 1; }
}

?>