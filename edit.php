<!DOCTYPE html>
<html>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: index.php");
        exit();
    }

    require('config.php');

    $author = $_SESSION["ID"];
    //echo $author;
    //echo $_SESSION["username"];
    if (isset($_POST['nvTitre'])) {
       // echo "salit";
        $nvTitre = stripslashes($_REQUEST['nvTitre']);
        $nvTitre = mysqli_real_escape_string($conn, $nvTitre);
        $query = "UPDATE `articles` SET  title='$nvTitre' where author='$author'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
        $message = "<b>Titre modifié avec succès.</b><br>";
        //echo "submit";
    } elseif (isset($_POST['article'])) {
        //echo "mail";
        $article = stripslashes($_REQUEST['article']);
        $article = mysqli_real_escape_string($conn, $article);
        $query = "UPDATE `articles` SET  description='$article' where author='$author'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
        $message2 = "<b>Article modifié avec succès.</b><br>";
    }


    if (is_string($_GET['ID']) && preg_match('#^[0-9]+$#', $_GET['ID'])) {
        //echo 'Bonjour ' . htmlspecialchars($_GET["ID"]) . '!';
        $ID = htmlspecialchars($_GET["ID"]);
        $query = "SELECT * FROM Articles INNER JOIN users ON Articles.author = Users.ID WHERE Articles.ID = '$ID'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            while ($row = mysqli_fetch_array($result)) {

                if ($row['username'] != $_SESSION["username"]) {
                    echo "Vous ne pouvez pas faire cela.";
                } else {
    ?>
                    <form class="box" action="" method="post" name="titre">
                        <p>Modifier le titre</p>
                        <input type="text" class="box-input" name="nvTitre" placeholder="Nouveau titre">
                        <input type="submit" value="Modifier " name="submit" class="box-button">
                        <?php if (!empty($message)) { ?>
                            <p class="errorMessage"><?php echo $message; ?></p>
                        <?php } ?>
                    </form>

                    <form class="box" action="" method="post" name="article">
                        <p>Modifier l'article</p>
                        <textarea name="article" rows="5" cols="40"></textarea>
                        <br>
                        <input type="submit" value="Modifier " name="submit" class="box-button">
                        <?php if (!empty($message2)) { ?>
                            <p class="errorMessage"><?php echo $message2; ?></p>
                        <?php } ?>
                    </form>
                    <br>
    <?php
                    echo "<b>Titre : </b>" . $row['title'] . "<br />";
                    echo "<b>Article : </b>" . $row['description'] . "<br {/>";
                }
            }
        } else {
            echo "L'ID est incorrect.";
        }
    } else
        echo "Format incorrect.";
    ?>

    <br>

    <a href="index.php">Accueil</a>
    <a href="new.php">Créer un article</a>
    <a href="account.php">Mon compte</a>
    <a href="logout.php">Déconnexion</a>
    <a href="login_admin.php">Admin</a>

</body>

</html>