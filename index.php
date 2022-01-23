<?php
// Initialiser la session
require('config.php');
require ('navigation.html');
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["username"])) {
	header("Location: login.php");
	exit();
}
?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="post.css" />
	<link rel="stylesheet" href="navbar.css" />
</head>

<body>

	<div class="sucess">
		<h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
		<p>Voici les derniers articles.</p>
	</div>

	<?php
			// SQL query
			$strSQL = "SELECT * FROM articles ORDER BY date DESC";

			// Execute the query (the recordset $rs contains the result)
			$rs = mysqli_query($conn, $strSQL);

			// Loop the recordset $rs
			// Each row will be made into an array ($row) using mysqli_fetch_array
			while ($row = mysqli_fetch_array($rs)) {


			echo"<div class=\"wrapper\">
			<div class=\"blog_post\">
		  <div class=\"container_copy\">
			<h3>".$row['date']."</h3>
			<h1>".$row['title']."</h1>
			<p>" . $row['description'] . "</p>
			
		  </div>
		  <a class=\"btn_primary\" href=\"details.php?ID=".$row['ID']."\">Read More</a>
		</div>
	  </div>";
	  

			}
		?>
	

</body>

</html>