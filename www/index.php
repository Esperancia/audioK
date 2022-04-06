<?php
	// Disable PHP notices
	error_reporting(E_ALL & ~E_NOTICE);

	// Include database helper functions
	include('./database.php');

	// Initialize database
	//$db = new Database('test', 'localhost', 'root', ''); // (database_name, host, user, password)
	$db = new Database('audiok', 'audiok_db_1', 'root', 'root');


	$sql_createTableUser = $sql = "CREATE TABLE IF NOT EXISTS user (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		firstname VARCHAR(30) NOT NULL,
		lastname VARCHAR(50),
		age int
	)";

	$db->query($sql_createTableUser, array());

	//var_dump($_POST);

	$error = false;
	if (!isset($_POST["firstname"]) || !isset($_POST["lastname"]) || !isset($_POST["age"])) {
		$error = true;
	}
	if (empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["age"])) {
		$error = true;
	}

	if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["age"])) {
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$age = (int)$_POST["age"];
			
		$result = $db->fetch_row("select * from user where firstname=? and lastname=? and age=?", array($firstname, $lastname, $age));
		
		if ( $result !== false )
		{
			echo "utilisateur existant \r\n";
		} else {		
			$result = $db->query("INSERT INTO user (firstname, lastname, age ) VALUES (?,?,?)", array($firstname, $lastname, $age));
			if ( $result !== false )
			{
				echo "Utilisateur enregistré \r\n";
				$_POST = array();
			}
		}

	}
		
	
	$all_users = $db->fetch_rows("select * from user", array());
	//var_dump(print_r($all_users, true));

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
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="styles.css">
	
	<style>
	/* Your CSS here */
	</style>
	<script>
	$(document).ready(function() {
		/* Your JQuery here */
		$('#list').DataTable( {
        	"order": [[ 0, "asc" ]]
    	});
	});
	</script>
</head>
<body>
	<!-- Your HTML here -->
	<div>
		<h1>Veuillez remplir le formulaire. Toutes les informations sont obligatoires</h1>
		<?php ($error == true) ? "Toutes les infos obligatoires": '' ?>
		<br>
		<form action="#" method="post">
			<div class="row">
				<label for="firstName">Firstname:</label>
				<input type="text" name="firstname" id="firstname" value="<?php ($_POST["fistname"]) ? $_POST["fistname"] : '' ?>" required>
			</div>
			<div class="row">
				<label for="lastName">Lastname:</label>
				<input type="text" name="lastname" id="lastname" value="<?php ($_POST["lastname"]) ? $_POST["lastname"] : '' ?>" required>
			</div>
			<div class="row">
				<label for="age">Age:</label>
				<input type="text" name="age" id="age" value="<?php ($_POST["age"]) ? $_POST["age"] : '' ?>" required>
			</div>
			<input type="submit" value="Save">
		</form>
	</div>

	<table id="list">
		<thead>
			<tr>
				<td>id</td>
				<td>firstname</td>
				<td>lastname</td>
				<td>age</td>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($all_users as $key => $u) {
					echo '<tr>';
						echo '<td>';
							echo $u->id;
						echo '</td>';

						echo '<td>';
							echo $u->firstname;
						echo '</td>';

						echo '<td>';
							echo $u->lastname;
						echo '</td>';

						echo '<td>';
							echo $u->age;
						echo '</td>';
					echo '</tr>';
				}
			?>
		</tbody>
	</table>
</body>
</html>
