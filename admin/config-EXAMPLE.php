<?php
	// // // // // // // // // // // // // // // // // //
	// // //  BEGIN OF CONFIGURATION PARAMETERS  // // //
	// // // // // // // // // // // // // // // // // //
	
	// Set to "fusion" to use the Galcon Fusion dump, or set to "iphone" to use the iGalcon dump
	$dumpType = "fusion";
	
	// Database name and host server (required)
	$db_name = "galcon_elo";
	$db_host = "localhost";
	
	// Database username and password (required)
	$db_user = "";
	$db_pass = "";
	
	/* 
	 * Database "admin" username and password (optional)
	 * ( This is a security feature. You can enter an account with
	 *   full rights to the specified database here and specify an
	 *   account with only SELECT rights above. This feature is to
	 *   prevent SQL injection from causing any harm, however it's
	 *   optional. If you leave these fields blank, the user above
	 *   requires full db access rights for the Galcon ELO to work )
	 */
	$dba_user = "";
	$dba_pass = "";
	
	/* Table names (optional)
	 * ( If unspecified, default names will be used. )
	 */
	$dbn_gamedata = "";
	$dbn_players = "";
	
	// // // // // // // // // // // // // // // // //
	// // // END OF CONFIGURATION PARAMETERS  // // //
	// // // // // // // // // // // // // // // // //
	
	if ( $db_name == "" || $db_host == "" || $db_user == "" || $db_pass == "")
	{
		echo "<h2>Configuration invalid.</h2>";
	}
	
	if ( $dba_user == "" || $dba_pass == "" )
	{
		$dba_user = $db_user;
		$dba_pass = $db_pass;
	}
	
	if ( $dbn_gamedata == "")
	{
		$dbn_gamedata = "gamedata";
	}
	
	if ( $dbn_players == "")
	{
		$dbn_players = "players";
	}
?>