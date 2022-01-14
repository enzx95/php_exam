<!DOCTYPE html>
<html>


<body>
    <?php
    require('config.php');
    if (is_string($_GET['ID']) && preg_match('#^[0-9]+$#', $_GET['ID'])) {
        //echo 'Bonjour ' . htmlspecialchars($_GET["ID"]) . '!';
        $ID = htmlspecialchars($_GET["ID"]);
        $query = "SELECT * FROM Articles INNER JOIN users ON Articles.author = Users.ID WHERE Articles.ID = '$ID'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn, $query));
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            while ($row = mysqli_fetch_array($result)) {
                // Write the value of the column FirstName (which is now in the array $row)
                echo "<b>Titre : </b>" . $row['title'] . "<br />";
                echo "<b>Article : </b>" . $row['description'] . "<br {/>";
                echo "<b>Date : </b>" . $row['date'] . "<br {/>";
                echo "<b>Autheur : </b>" . $row['username'] . "<br {/>";
            }
        } else {
            echo "L'ID est incorrect.";
        }
    } else
        // entry is incorrect
        echo "Format incorrect.";
    ?>

    <br>

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