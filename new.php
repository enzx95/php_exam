<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="new.css" />
</head>


<body>
    <?php
    require('config.php');
    require ('navigation.html');
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: index.php");
        exit();
    }
    $username = $_SESSION["username"];
    $today = date('Y-m-d');
    //echo $today;
    $ID = $_SESSION["ID"];
    if (isset($_POST['title'])) {
        $title = stripslashes($_REQUEST['title']);
        $title = mysqli_real_escape_string($conn, $title);
        $article = stripslashes($_REQUEST['article']);
        $article = mysqli_real_escape_string($conn, $article);
        if ($title == null || $article == null) {
            $message = "Veuillez remplir tout les champs.";
        } else {
            $query = "INSERT INTO articles (title, description, date, author) VALUES ('$title', '$article', '$today','$ID')";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
            if ($result) {
                $message = "Article créer avec succès.";
            } else {
                $message = "Erreur.";
            }
        }
    }
    ?>

    <div class="container-contact100">

		<div class="wrap-contact100">
            <form class="box" action="" method="post" name="login">
				<span class="contact100-form-title">
					Créer votre article
				</span>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="title" value="" placeholder="Titre">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" >
					<textarea class="input100" name="article" placeholder="Description"></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						<span>
                        <?php if (!empty($message)) { ?>
                            <p class="errorMessage"><?php echo $message; ?></p>
                        <?php } ?>
						<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true" type="submit" name="submit" value="Créer"></i>
							Créer
						</span>
					</button>
				</div>
			</form>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

</body>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

</html>