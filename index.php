<?php
// Initialiser la session
require('config.php');
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["username"])) {
	header("Location: login.php");
	exit();
}
?>
<!DOCTYPE html>
<html>
<style>
	table,
	th,
	td {
		border: 1px solid black;
		border-collapse: collapse;
	}
</style>

<head>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<div class="sucess">
		<h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
		<p>C'est votre tableau de bord.</p>


		<table>
			<tr>
				<th>Titre</th>
				<th>Article</th>
			</tr>
			<?php
			// SQL query
			$strSQL = "SELECT * FROM articles ORDER BY date DESC";

			// Execute the query (the recordset $rs contains the result)
			$rs = mysqli_query($conn, $strSQL);

			// Loop the recordset $rs
			// Each row will be made into an array ($row) using mysqli_fetch_array
			while ($row = mysqli_fetch_array($rs)) {

				// Write the value of the column FirstName (which is now in the array $row)
				// echo "<h3>" . $row['title'] . "</h3></b>";
				// echo "<h4>" . $row['description'] . "</h4></b>";
				echo "<tr>
				<td>" . $row['title'] . "</td>
				<td>" . $row['description'] . "</td>
			</tr>";
			}
			?>
		</table>
		<br>
		<a href="account.php">Mon compte</a>
		<a href="logout.php">Déconnexion</a>
	</div>
</body>

</html>