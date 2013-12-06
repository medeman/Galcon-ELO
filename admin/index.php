<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../style/style.css" />
		<title>Galcon ELO Admin Panel</title>
	</head>
	<body style="color: #FFF;">
		<!-- Step 1: Fetch the dump file and put it into gamedata table -->
		<h3>Fetch dump file</h3>
		<form name="input" action="fetchDump.php" method="get">
			Days (1-14): <input type="number" name="days">
			<input type="submit" value="Fetch now!">
		</form>
		
		<!-- Step 2: Generate player entries from gamedata table -->
		<h3>Create player entries</h3>
		<form name="input" action="createPlayers.php" method="get">
			<input type="submit" value="Create players!">
		</form>
		
		<!-- Step 3: Calculate the ELO values -->
		<h3>Calculate ELO</h3>
		<form name="input" action="calcElo.php" method="get">
			<input type="submit" value="Calculate ELO!">
		</form>
		
		<!-- Clean gamedata table -->
		<h3>Clean game list</h3>
		<form name="input" action="cleanGames.php" method="get">
			Rows: <input type="number" name="rows">
			<input type="submit" value="Delete">
		</form>
		<!-- <form name="input" action="cleanGames.php" method="get">
			From date (YYYY-MM-DD): <input type="date" name="years" maxlength="4" style="width: 36px;"> - <input type="date" name="months" maxlength="2" style="width: 22px;"> - <input type="date" name="days" maxlength="2" style="width: 22px;">
			<input type="submit" value="Delete">
		</form> -->
		
		<!-- Re(c)reate tables -->
		<h3>(Re)create tables (!! deletes existing tables)</h3>
		<form name="input" action="createTables.php" method="get">
			<input type="submit" value="Delete">
		</form>
	</body>
</html>