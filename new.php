<!DOCTYPE html>
<html>


<body>
    <?php
    require('config.php');
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

    <br>
    <form class="box" action="" method="post" name="login">
        <h1 class="box-title">Créer un article</h1>
        Titre: <input type="text" name="title" value="">
        <br><br>
        Article: <textarea name="article" rows="5" cols="40"></textarea>
        <br><br>
        <?php if (!empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>
        <input type="submit" name="submit" value="Créer">
        <br><br>
    </form>

    <a href="index.php">Accueil</a>
    <a href="account.php">Mon compte</a>
    <a href="logout.php">Déconnexion</a>
    <a href="login_admin.php">Admin</a>

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