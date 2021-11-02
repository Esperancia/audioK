<?php
	// Disable PHP notices
	error_reporting(E_ALL & ~E_NOTICE);

	// Include database helper functions
	include('./database.php');

	// Initialize database
	//$db = new Database('test', 'localhost', 'root', ''); // (database_name, host, user, password)
	$db = new Database('audiok', 'audiok_db_1', 'root', 'root');

	/*
		MySQL samples
		*************
		
		// Select single row (returns an object, or false if no entry is found)
		$row = $db->fetch_row("
			SELECT id
			FROM tablename
			WHERE id = ?
		", array(999));
		if ( $row !== false )
		{
		}

		// Select multiple rows (returns an array of objects, or false if no entry is found)
		$rows = $db->fetch_rows("
			SELECT id
			FROM tablename
		", array());
		if ( $rows !== false )
		{
		}
		
		// Insert, Delete, Update (returns false if the query failed)
		$result = $db->query("INSERT INTO tablename ( id, value ) VALUES (?,?)", array($id, $value));
		if ( $result !== false )
		{
		}
	*/

	/* Your PHP here */
	
?>
<!DOCTYPE HTML>
<html>
<head>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<style>
	/* Your CSS here */
	</style>
	<script>
	$(document).ready(function() {
		/* Your JQuery here */
	});
	</script>
</head>
<body>
	<!-- Your HTML here -->
</body>
</html>
